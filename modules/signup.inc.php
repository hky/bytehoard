<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: signup.inc.php,v 1.3 2005/07/28 22:15:18 andrewgodwin Exp $
 *
 */
 
#name Login Form
#author Andrew Godwin
#description Displays the login form so login info can be submitted.

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

if ($bhconfig['signupdisabled'] == 0)  {
	if (!empty($_POST['signup'])) {
		$signup = $_POST['signup'];
		
		# Check username isn't reserved or in use. We test for admin, administrator, guest, and all because they may all get used.
		# Even though a few are in the users table anyway.
		$username = strtolower($signup['username']);
		$usernamerows = select_bhdb("users", array("username"=>$username), "");
		$regusernamerows = select_bhdb("registrations", array("username"=>$username), "");
		
		if ((!empty($usernamerows)) || (!empty($regusernamerows)) || ($username == "guest") || ($username == "admin") || ($username == "administrator") || ($username == "all")) {
			bh_log($bhlang['error:username_in_use'], BH_ERROR);
			# Open layout object
			$layoutobj = new bhlayout("signup");
			
			# Send the file listing to the layout, along with directory name
			$layoutobj->title = $bhlang['title:signup'];
			$layoutobj->content1 = $_POST['signup'];
			
			$layoutobj->display();
		} elseif (strlen($username) > 255) {
			bh_log($bhlang['error:username_too_long'], BH_ERROR);
			# Open layout object
			$layoutobj = new bhlayout("signup");
			
			# Send the file listing to the layout, along with directory name
			$layoutobj->title = $bhlang['title:signup'];
			$layoutobj->content1 = $_POST['signup'];
			
			$layoutobj->display();
		} else {
			
			# Right. Now check the passwords match, or that there is one at all
			if ($signup['pass1'] != $signup['pass2']) {
				bh_log($bhlang['error:passwords_dont_match'], BH_ERROR);
				# Open layout object
				$layoutobj = new bhlayout("signup");
				
				# Send the file listing to the layout, along with directory name
				$layoutobj->title = $bhlang['title:signup'];
				$layoutobj->content1 = $_POST['signup'];
				
				$layoutobj->display();
			} elseif (empty($signup['pass1'])) {
				bh_log($bhlang['error:password_empty'], BH_ERROR);
				# Open layout object
				$layoutobj = new bhlayout("signup");
				
				# Send the file listing to the layout, along with directory name
				$layoutobj->title = $bhlang['title:signup'];
				$layoutobj->content1 = $_POST['signup'];
				
				$layoutobj->display();
			# Or the emails
			} elseif (empty($signup['email'])) {
				bh_log($bhlang['error:email_empty'], BH_ERROR);
				# Open layout object
				$layoutobj = new bhlayout("signup");
				
				# Send the file listing to the layout, along with directory name
				$layoutobj->title = $bhlang['title:signup'];
				$layoutobj->content1 = $_POST['signup'];
				
				$layoutobj->display();
			} else {
				
				# Good. Now sign them up.
				# Add a registrations row
				$regid = md5(rand(1, 99999999).rand(1, time()).microtime());
				
				
				# Dispatch an email
				$emailobj = new bhemail($signup['email']);
				$emailobj->subject = str_replace("#SITENAME#", $bhconfig['sitename'], $bhlang['emailsubject:registration_validation']);
				$emailobj->message = str_replace("#LINK#", bh_get_weburi()."/index.php?page=signup&confirmregid=$regid&username=$username", $bhlang['email:registration_validation']);
				$emailaway = $emailobj->send();
				
				if ($emailaway == false) {
					# Open layout object
					$layoutobj = new bhlayout("generic");
					# Send the file listing to the layout, along with directory name
					$layoutobj->title = $bhlang['title:signup'];
					$layoutobj->content1 = "<br><br>".$bhlang['error:email_error'];
					$layoutobj->display();
				} else {
					insert_bhdb("registrations", array("regid"=>$regid, "username"=>$username, "password"=>md5($signup['pass1']), "fullname"=>$signup['fullname'], "email"=>$signup['email'], "status"=>"0", "regtime"=>time()));
					bh_log($bhlang['log:user_signed_up_'].$username, "BH_SIGNUP");
					# Open layout object
					$layoutobj = new bhlayout("generic");
					# Send the file listing to the layout, along with directory name
					$layoutobj->title = $bhlang['title:signup'];
					$layoutobj->content1 = "<br><br>".$bhlang['notice:do_email_validation'];
					$layoutobj->display();
				}
			}
		
		}
	} elseif (!empty($_GET['confirmregid'])) {
	
		if ($bhconfig['signupmoderation'] == 0) {
			# Grab user details from registration row
			$regrows = select_bhdb("registrations", array("regid"=>$_GET['confirmregid'], "username"=>$_GET['username']), "");
			if (empty($regrows)) {
				# Open layout object
				$layoutobj = new bhlayout("generic");
				# Send the file listing to the layout, along with directory name
				$layoutobj->title = $bhlang['title:signup'];
				$layoutobj->content1 = "<br><br>".$bhlang['error:validation_link_wrong'];
				$layoutobj->display();
			} else {
				# Add a user row
				insert_bhdb("users", array("username"=>$regrows[0]['username'], "password"=>$regrows[0]['password'], "type"=>"normal", "homedir"=>"/".$regrows[0]['username']));
				# Add that extra info we got
				insert_bhdb("userinfo", array("username"=>$regrows[0]['username'], "itemname"=>"fullname", "itemcontent"=>$regrows[0]['fullname']));
				insert_bhdb("userinfo", array("username"=>$regrows[0]['username'], "itemname"=>"email", "itemcontent"=>$regrows[0]['email']));
				# Delete the reg row
				delete_bhdb("registrations", array("regid"=>$_GET['confirmregid'], "username"=>$_GET['username']));
				
				# All done. Say so.
				bh_log($bhlang['log:user_validated_'].$username, "BH_SIGNUP_VALIDATED");
				bh_log($bhlang['notice:signup_successful_can_login'], "BH_NOTICE");
				require "modules/login.inc.php";
			}
		} else {
			# This means that The Administrator must Approve this User.
			# So, up the status of the regrow to 1 if it exists. Or tell them to go away.
			$regrows = select_bhdb("registrations", array("regid"=>$_GET['confirmregid'], "username"=>$_GET['username']), "");
			if (empty($regrows)) {
				# Open layout object
				$layoutobj = new bhlayout("generic");
				# Send the file listing to the layout, along with directory name
				$layoutobj->title = $bhlang['title:signup'];
				$layoutobj->content1 = "<br><br>".$bhlang['error:validation_link_wrong'];
				$layoutobj->display();
			} else {
				# check if it's already at stage 1.
				$regs1rows = select_bhdb("registrations", array("regid"=>$_GET['confirmregid'], "username"=>$_GET['username'], "status"=>"0"), "");
				if (empty($regs1rows)) {
					# Open layout object
					$layoutobj = new bhlayout("generic");
					# Send the file listing to the layout, along with directory name
					$layoutobj->title = $bhlang['title:signup'];
					$layoutobj->content1 = "<br><br>".$bhlang['notice:validation_already_done_pending_approval'];
					$layoutobj->display();
				} else {
					# Up the reg row status
					update_bhdb("registrations", array("status"=>"1"), array("regid"=>$_GET['confirmregid'], "username"=>$_GET['username']));
					
					# All done. Say so.
					bh_log($bhlang['log:user_validated_'].$username, "BH_SIGNUP_VALIDATED");
					bh_log($bhlang['log:user_signup_m_pending_'].$username, "BH_SIGNUP_M_PENDING");
					# Open layout object
					$layoutobj = new bhlayout("generic");
					# Send the file listing to the layout, along with directory name
					$layoutobj->title = $bhlang['title:signup'];
					$layoutobj->content1 = "<br><br>".$bhlang['notice:moderation_now_pending'];
					$layoutobj->display();
				}
			}
		}
	
	} else {
		# Open layout object
		$layoutobj = new bhlayout("signup");
		
		# Send the file listing to the layout, along with directory name
		$layoutobj->title = $bhlang['title:signup'];
		$layoutobj->content1 = array();
		
		$layoutobj->display();
	}
} else {
# Open layout object
	$layoutobj = new bhlayout("generic");
	
	# Send the file listing to the layout, along with directory name
	$layoutobj->title = $bhlang['title:signup'];
	$layoutobj->content1 = "<br><br>".$bhlang['error:signup_disabled'];
	
	$layoutobj->display();
}