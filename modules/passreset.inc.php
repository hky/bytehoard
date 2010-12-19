<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2005
 *
 *   Module
 *   $Id: passreset.inc.php,v 1.3 2005/07/28 22:15:18 andrewgodwin Exp $
 *
 */
 
#name Password Reset
#author Andrew Godwin
#description Displays the login form so login info can be submitted.

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# See if there is a reset request
if (!empty($_POST['reset_username'])) {
	# See if the username exists
	$username = $_POST['reset_username'];
	$userrows = select_bhdb("users", array("username"=>$username), "");
	if (empty($userrows)) {
		# Open layout object
		$layoutobj = new bhlayout("generic");
		# Send the file listing to the layout, along with directory name
		$layoutobj->title = $bhlang['title:recover_password'];
		$layoutobj->content1 = "<br><br>".$bhlang['error:username_doesnt_exist'];
		$layoutobj->display();
	} else {
		# Insert a password reset request row for that username
		$resetid = md5(time().rand(1, 99999).rand(54, time()));
		insert_bhdb("passwordresets", array("username"=>$username, "resetid"=>$resetid, "time"=>time()));
		
		# Get their email address
		$userirows = select_bhdb("userinfo", array("username"=>$username, "itemname"=>"email"), "");
		$emailaddr = $userirows[0]['itemcontent'];
		
		# Email them about it with the validation link
		$emailobj = new bhemail($emailaddr);
		$emailobj->subject = str_replace("#SITENAME#", $bhconfig['sitename'], $bhlang['emailsubject:passreset_request']);
		$emailobj->message = str_replace("#LINK#", bh_get_weburi()."/index.php?page=passreset&doresetid=$resetid&username=$username", $bhlang['email:passreset_request']);
		$emailaway = $emailobj->send();
		if ($emailaway == false) {
			# Open layout object
			$layoutobj = new bhlayout("generic");
			# Send the file listing to the layout, along with directory name
			$layoutobj->title = $bhlang['title:signup'];
			$layoutobj->content1 = "<br><br>".$bhlang['error:email_error'];
			$layoutobj->display();
		} else {
			# Open layout object
			$layoutobj = new bhlayout("generic");
			# Send the file listing to the layout, along with directory name
			$layoutobj->title = $bhlang['title:signup'];
			$layoutobj->content1 = "<br><br>".$bhlang['notice:passreset_request_sent'];
			$layoutobj->display();
		}
	}
}
# Or one for an email
elseif (!empty($_POST['reset_email'])) {
	# See if the email exists
	$email = $_POST['reset_email'];
	$userirows = select_bhdb("userinfo", array("itemcontent"=>$email, "itemname"=>"email"), "");
	if (empty($userirows)) {
		# Open layout object
		$layoutobj = new bhlayout("generic");
		# Send the file listing to the layout, along with directory name
		$layoutobj->title = $bhlang['title:recover_password'];
		$layoutobj->content1 = "<br><br>".$bhlang['error:email_doesnt_exist'];
		$layoutobj->display();
	} else {
		# Insert a password reset request row for that username
		$username = $userirows[0]['username'];
		$resetid = md5(time().rand(1, 99999).rand(54, time()));
		insert_bhdb("passwordresets", array("username"=>$username, "resetid"=>$resetid, "time"=>time()));
		
		# Get their email address
		$emailaddr = $userirows[0]['itemcontent'];
		
		# Email them about it with the validation link
		$emailobj = new bhemail($emailaddr);
		$emailobj->subject = str_replace("#SITENAME#", $bhconfig['sitename'], $bhlang['emailsubject:passreset_u_request']);
		$emailobj->message = str_replace("#LINK#", bh_get_weburi()."/index.php?page=passreset&doresetid=$resetid&username=$username", str_replace("#USERNAME#", $username, $bhlang['email:passreset_u_request']));
		$emailaway = $emailobj->send();
		if ($emailaway == false) {
			# Open layout object
			$layoutobj = new bhlayout("generic");
			# Send the file listing to the layout, along with directory name
			$layoutobj->title = $bhlang['title:signup'];
			$layoutobj->content1 = "<br><br>".$bhlang['error:email_error'];
			$layoutobj->display();
		} else {
			# Open layout object
			$layoutobj = new bhlayout("generic");
			# Send the file listing to the layout, along with directory name
			$layoutobj->title = $bhlang['title:signup'];
			$layoutobj->content1 = "<br><br>".$bhlang['notice:passreset_request_sent'];
			$layoutobj->display();
		}
	}
	
}
elseif (!empty($_GET['doresetid'])) {
	$resetid = $_GET['doresetid'];
	
	# Get the details from the database.
	$resetrows = select_bhdb("passwordresets", array("resetid"=>$resetid), "");
	if (empty($resetrows)) {
		# Open layout object
		$layoutobj = new bhlayout("generic");
		# Send the file listing to the layout, along with directory name
		$layoutobj->title = $bhlang['title:recover_password'];
		$layoutobj->content1 = "<br><br>".$bhlang['error:passreset_link_invalid'];
		$layoutobj->display();
	} else {
	
		# Check the user still exists
		$userrows = select_bhdb("users", array("username"=>$resetrows[0]['username']), "");
		if (empty($userrows)) {
			# Open layout object
			$layoutobj = new bhlayout("generic");
			# Send the file listing to the layout, along with directory name
			$layoutobj->title = $bhlang['title:signup'];
			$layoutobj->content1 = "<br><br>".$bhlang['error:username_invalid'];
			$layoutobj->display();
		} else {
			# Generate a random new ten-letter password
			$alphabetanumba = "abcdefghijklmnopqrstuvwxyz0123456789";
			
			$newpass = "";
			$max=strlen($alphabetanumba)-1;
			$length = 10;
			for ($i=0;$i<=$length;$i++) {
				$newpass .= substr($alphabetanumba, rand(0, $max), 1);
			}
			
			$userirows = select_bhdb("userinfo", array("username"=>$resetrows[0]['username'], "itemname"=>"email"), "");
			$emailaddr = $userirows[0]['itemcontent'];
			
			# Send the email with the new password
			# Email them about it with the validation link
			$emailobj = new bhemail($emailaddr);
			$emailobj->subject = str_replace("#SITENAME#", $bhconfig['sitename'], $bhlang['emailsubject:passreset_new_password']);
			$emailobj->message = str_replace("#PASSWORD#", $newpass, $bhlang['email:passreset_new_password']);
			$emailaway = $emailobj->send();
			if ($emailaway == false) {
				# Open layout object
				$layoutobj = new bhlayout("generic");
				# Send the file listing to the layout, along with directory name
				$layoutobj->title = $bhlang['title:signup'];
				$layoutobj->content1 = "<br><br>".$bhlang['error:email_error'];
				$layoutobj->display();
			} else {
				# Update the database with it.
				bh_auth_set_password($resetrows[0]['username'], $newpass);
				# Open layout object
				$layoutobj = new bhlayout("generic");
				# Send the file listing to the layout, along with directory name
				$layoutobj->title = $bhlang['title:signup'];
				$layoutobj->content1 = "<br><br>".$bhlang['notice:passreset_new_password_sent'];
				$layoutobj->display();
			}
		}
	}

}
else {
	
	# Open layout object
	$layoutobj = new bhlayout("passreset");
	
	# Send the file listing to the layout, along with directory name
	$layoutobj->title = $bhlang['title:recover_password'];
	$layoutobj->content1 = $bhlang['explain:recover_password'];
	
	$layoutobj->display();

}

?>