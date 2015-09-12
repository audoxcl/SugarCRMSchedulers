<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

function post_install(){
	$job = BeanFactory::getBean('Schedulers');
	$job->name = 'Custom Scheduler';
	$job->job = 'function::CustomScheduler';
	$job->date_time_start = '2005-01-01 00:00:00';
	$job->job_interval = '*::*::*::*::*';
	$job->status = 'Active';
	$job->catch_up = '1';
	$job->save();
}

?>