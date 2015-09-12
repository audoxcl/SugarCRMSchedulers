<?php

/*********************************************************************************
* This code was developed by:
* Audox Ingeniería Ltda.
* You can contact us at:
* Web: www.audox.cl
* Email: info@audox.cl
* Skype: audox.ingenieria
********************************************************************************/

$manifest = array(
	'acceptable_sugar_flavors' => array(
		'CE',
		'PRO',
		'ENT',
		'CORP',
		'ULT',
	),
	'acceptable_sugar_versions' => array(
		'6*',
		'7*',
	),
	'is_uninstallable' => true,
	'name' => 'Custom Schedulers',
	'author' => 'Audox Ingenieria Ltda',
	'description' => 'Custom Schedulers',
	'published_date' => '2015/09/12',
	'version' => 'v1.0',
	'type' => 'module',
);

$installdefs = array (
	'id' => 'CustomSchedulers',
	'language' => array (
		array(
			'from'=> '<basepath>/en_us.customschedulers.php',
			'to_module'=> 'Schedulers',
			'language'=>'en_us'
		),
	),
	'scheduledefs' => array (
		array (
			'from' => '<basepath>/CustomSchedulers.php',
		),
	),
);
?>