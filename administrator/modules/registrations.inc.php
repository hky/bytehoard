<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2005
 *
 *   Module
 *   $Id: registrations.inc.php,v 1.1 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
#name Registrations List
#author Andrew Godwin
#description Displays a list of pending registrations with an approval system.
#iscore 1

if (!empty($_GET['action'])) {
	if ($_GET['action'] == "accept") {
		$regrows = select_bhdb("registrations", array("regid"=>$_GET['regid'], "username"=>$_GET['username']), "");
		if (empty($regrows)) {
			log_bh($bhlang['error:registration_doesnt_exist'], "BH_ERROR");
		} else {
			# Add a user row
			insert_bhdb("users", array("username"=>$regrows[0]['username'], "password"=>$regrows[0]['password'], "type"=>"normal", "homedir"=>"/".$regrows[0]['username']));
			# Add that extra info we got
			insert_bhdb("userinfo", array("username"=>$regrows[0]['username'], "itemname"=>"fullname", "itemcontent"=>$regrows[0]['fullname']));
			insert_bhdb("userinfo", array("username"=>$regrows[0]['username'], "itemname"=>"email", "itemcontent"=>$regrows[0]['email']));
			# Delete the reg row
			delete_bhdb("registrations", array("regid"=>$_GET['regid'], "username"=>$_GET['username']));
			
			# Email the user
			$emailobj = new bhemail($regrows[0]['email']);
			$emailobj->subject = str_replace("#SITENAME#", $bhconfig['sitename'], $bhlang['emailsubject:registration_accepted']);
			$emailobj->message = str_replace("#USERNAME#", $regrows[0]['username'], $bhlang['email:registration_accepted']);
			$emailaway = $emailobj->send();
			
			# All done. Say so.
			bh_log(str_replace("#USER#", $_GET['username'], $bhlang['notice:#USER#_accepted']), "BH_NOTICE");
		}
	}
	
	if($_GET['action'] == "reject") {
	$regrows = select_bhdb("registrations", array("regid"=>$_GET['regid'], "username"=>$_GET['username']), "");
		if (empty($regrows)) {
			log_bh($bhlang['error:registration_doesnt_exist'], "BH_ERROR");
		} else {
			# Delete the reg row
			delete_bhdb("registrations", array("regid"=>$_GET['regid'], "username"=>$_GET['username']));
			
			# Email the user
			$emailobj = new bhemail($regrows[0]['email']);
			$emailobj->subject = str_replace("#SITENAME#", $bhconfig['sitename'], $bhlang['emailsubject:registration_rejected']);
			$emailobj->message = str_replace("#USERNAME#", $regrows[0]['username'], $bhlang['email:registration_rejected']);
			$emailaway = $emailobj->send();
			
			# All done. Say so.
			bh_log(str_replace("#USER#", $_GET['username'], $bhlang['notice:#USER#_rejected']), "BH_NOTICE");
		}
	}
}

if ($bhconfig['signupmoderation'] == 0) {
	$layout = new bhadminlayout("generic");
	$layout->content1 = $bhlang['notice:registration_moderation_off'];
	$layout->title = $bhlang['title:registrations_administration'];
	$layout->display();
} else {
	$layout = new bhadminlayout("regslist");
	$registrations = select_bhdb("registrations", array("status"=>"1"), "");
	
	$layout->content1 = $registrations;
	$layout->title = $bhlang['title:registrations_administration'];
	$layout->display();
}
