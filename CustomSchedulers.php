<?php

/*********************************************************************************
* This code was developed by:
* Audox Ingeniería Ltda.
* You can contact us at:
* Web: www.audox.cl
* Email: info@audox.cl
* Skype: audox.ingenieria
********************************************************************************/

$job_strings[] = 'CustomScheduler';

function SendEmail($emailsTo, $emailSubject, $emailBody){
	$emailObj = new Email();
	$defaults = $emailObj->getSystemDefaultEmail();
	$mail = new SugarPHPMailer();
	$mail->setMailerForSystem();
	$mail->From = $defaults['email'];
	$mail->FromName = $defaults['name'];
	$mail->ClearAllRecipients();
	$mail->ClearReplyTos();
	$mail->Subject=from_html($emailSubject);
	$mail->Body=$emailBody;
	$mail->AltBody=from_html($emailBody);
	$mail->prepForOutbound();
	foreach($emailsTo as &$value){
		$mail->AddAddress($value);
	}
	if(@$mail->Send()){
	}
}

function CustomScheduler(){
	global $current_user, $db;
	$timeDate = new TimeDate();
	$timeDateNow = $timeDate->getNow(true)->asDb();
	$GLOBALS['log']->fatal("Checking Opportunities...");
	$query = "select id from opportunities
	where opportunities.sales_stage != 'Closed Won'
	and DATEDIFF(opportunities.date_modified,'".$timeDateNow."') < 15
	and !opportunities.deleted";
	// $res = $focus->db->query($sql, true);
	$res = $db->query($query, true, 'Error: ');
	while($row = $db->fetchByAssoc($res)){
		$opportunity = new Opportunity();
		if(!is_null($opportunity->retrieve($row['id']))){
			$user = new User();
			if(!is_null($user->retrieve($opportunity->assigned_user_id))){
				$emailsTo = array();
				$emailSubject = "Opportunity Alert";
				$emailBody = "The Opportunity ".$bean->name." has 15 days without changes.<br /><br />
				Sales Stage: ".$bean->sales_stage."<br />
				Amount: ".$bean->amount."<br />
				Date Close: ".$bean->date_closed."<br /><br />
				You can see the opportunity here:<br />
				<a href=\"".$sugar_config['site_url']."/index.php?module=Opportunities&action=DetailView&record=".$bean->id."\">".$bean->name."</a>";
				$emailsTo[] = $user->email1;
				SendEmail($emailsTo, $emailSubject, $emailBody);
			}
		}
	}
	$GLOBALS['log']->fatal("Opportunities checked");
	return true;
}

?>