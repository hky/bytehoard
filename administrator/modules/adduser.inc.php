<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: edituser.inc.php,v 1.2 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
#name Add User
#author Andrew Godwin
#description Lets you edit a user.
#iscore 1

$addusername = $_GET['username'];

if (!empty($_POST['user'])) {
	$signup = $_POST['user'];
	
	$username = strtolower($signup['username']);
	$usernamerows = select_bhdb("users", array("username"=>$username), "");
	$regusernamerows = select_bhdb("registrations", array("username"=>$username), "");
	
	if ((!empty($usernamerows)) || (!empty($regusernamerows)) || ($username == "guest") || ($username == "admin") || ($username == "administrator") || ($username == "all")) {
		bh_log($bhlang['error:username_in_use'], BH_ERROR);
		# Open layout object
		$layoutobj = new bhadminlayout("generic");
		# Send the file listing to the layout, along with directory name
		$layoutobj->title = $bhlang['title:add_user'];
		$layoutobj->display();
	} elseif (strlen($username) > 255) {
		bh_log($bhlang['error:username_too_long'], BH_ERROR);
		# Open layout object
		$layoutobj = new bhadminlayout("generic");
		# Send the file listing to the layout, along with directory name
		$layoutobj->title = $bhlang['title:add_user'];
		$layoutobj->display();
	} else {
		
		# Right. Now check the passwords match, or that there is one at all
		if ($signup['pass1'] != $signup['pass2']) {
			bh_log($bhlang['error:passwords_dont_match'], BH_ERROR);
			# Open layout object
			$layoutobj = new bhadminlayout("generic");
			# Send the file listing to the layout, along with directory name
			$layoutobj->title = $bhlang['title:add_user'];
			$layoutobj->display();
		} elseif (empty($signup['pass1'])) {
			bh_log($bhlang['error:password_empty'], BH_ERROR);
			# Open layout object
			$layoutobj = new bhadminlayout("generic");
			# Send the file listing to the layout, along with directory name
			$layoutobj->title = $bhlang['title:add_user'];
			$layoutobj->display();
		# Or the emails
		} elseif (empty($signup['email'])) {
			bh_log($bhlang['error:email_empty'], BH_ERROR);
			# Open layout object
			$layoutobj = new bhadminlayout("generic");
			# Send the file listing to the layout, along with directory name
			$layoutobj->title = $bhlang['title:add_user'];
			$layoutobj->display();
		} elseif ((!is_numeric($signup['quota'])) || ($signup['quota'] < 0)) {
			bh_add_error($bhlang['error:quota_not_a_number']);
			# Open layout object
			$layoutobj = new bhadminlayout("generic");
			# Send the file listing to the layout, along with directory name
			$layoutobj->title = $bhlang['title:add_user'];
			$layoutobj->display();
		} else {
			if (($signup['quota'] == "0") || (trim($signup['quota']) == "")) {
				$quota = "";
			} else {
				$quota = round($signup['quota']*1024*1024);
			}
			
			if ($signup['homedir'] == "/") {
				$homedir = "/";
			} else {
				$homedir = "/".$signup['username'];
			}
		
			# Yippee. Add them.
			insert_bhdb("users", array("username"=>$signup['username'], "password"=>md5($signup['pass1']), "type"=>$signup['type'], "homedir"=>$homedir, "quota"=>$quota));
			# Add that extra info we got
			insert_bhdb("userinfo", array("username"=>$signup['username'], "itemname"=>"fullname", "itemcontent"=>$signup['fullname']));
			insert_bhdb("userinfo", array("username"=>$signup['username'], "itemname"=>"email", "itemcontent"=>$signup['email']));
			
			# Add any group associations.
			if (!empty($signup['groups'])) {
				$groups = explode(",", $signup['groups']);
				foreach ($groups as $group) {
					$group = trim($group);
					insert_bhdb("groups", array("username"=>$signup['username'], "group"=>$group, "status"=>"1"));
				}
			}
			
			bh_log($bhlang['notice:user_added'], BH_NOTICE);
			# Redirect to user list
			require "modules/users.inc.php";
			
		}
	}
} else {

	$layout = new bhadminlayout("adduserform");
	$layout->title = $bhlang['title:add_user'];
	$layout->display();

}