<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: edituser.inc.php,v 1.2 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
#name Edit User
#author Andrew Godwin
#description Lets you edit a user.
#iscore 1

$editusername = $_GET['username'];

if (!empty($_POST['user'])) {
	$user = $_POST['user'];
	
	# Update details
	$userobj = new bhuser($editusername);
	$userobj->userinfo['fullname'] = $user['fullname'];
	$userobj->userinfo['email'] = $user['email'];
	$userobj->saveuserinfo();
	
	if (($user['quota'] == "0") || (trim($user['quota']) == "")) {
		$quota = "";
	} else {
		if ((!is_numeric($user['quota'])) || ($user['quota'] < 0)) {
			bh_add_error($bhlang['error:quota_not_a_number']);
			require "error.inc.php";
			return;
		} else {
			$quota = round($user['quota']*1024*1024);
		}
	}
	
	
	# Update type & disabled
	update_bhdb("users", array("type"=>$user['type'], "disabled"=>$user['disabled'], "quota"=>$quota), array("username"=>$editusername));
	
	# If new password, update it
	if (!empty($user['pass1'])) {
		if ($user['pass1'] == $user['pass2']) {
			update_bhdb("users", array("password"=>md5($user['pass1'])), array("username"=>$editusername));
			bh_log($bhlang['notice:user_updated'], "BH_NOTICE");
			require "modules/users.inc.php";
		} else {
			bh_log($bhlang['error:passwords_dont_match'], "BH_ERROR");
		}
	} else {
		bh_log($bhlang['notice:user_updated'], "BH_NOTICE");
		require "modules/users.inc.php";
	}
	
} else {
	$userobj = new bhuser($editusername);
	$userobj->userinfo['type'] = $userobj->type;
	$userobj->userinfo['disabled'] = $userobj->disabled;
	$userobj->userinfo['quota'] = round(($userobj->quota/(1024*1024)), 2);
	$layout = new bhadminlayout("edituser");
	$layout->content1 = $editusername;
	$layout->content2 = $userobj->userinfo;
	$layout->title = $bhlang['title:editing_user_'].$editusername;
	$layout->display();

}