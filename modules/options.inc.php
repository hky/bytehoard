<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2005
 *
 *   Module
 *   $Id: options.inc.php,v 1.2 2005/07/26 21:55:09 andrewgodwin Exp $
 *
 */
 
#name Options Form
#author Andrew Godwin
#description Lets users change options

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# See if there's an incoming password change
if (!empty($_POST['changepass'])) {
	$changepass = $_POST['changepass'];
	# Check the old password is correct
	$oldcheck = bh_authenticate($bhsession['username'], $changepass['old']);
	if ($oldcheck == TRUE) {
		# See if the two new passwords match
		if  ($changepass['new'] == $changepass['new2']) {
			# If they're using a blank password, warn them, but don't stop them
			(empty($changepass['new'])) ? (bh_log($bhlang['warning:blank_password'], "BH_WARNING")) : null;
			# OK, update their password.
			# (That's 5 Es, btw. Got to make this a bit more challenging. Wait till I use MD5sums as names)
			$reeeeesult = bh_auth_set_password($bhsession['username'], $changepass['new']);
			# And give them heaps of praise. Or tell them bad things have happened.
			if ($reeeeesult == TRUE) {
				bh_log($bhlang['notice:password_changed'], "BH_NOTICE");
			} else {
				bh_log($bhlang['error:unknown'], "BH_NOTICE");
			}
		} else {
			# They've been bad.
			bh_log($bhlang['error:passwords_dont_match'], "BH_ERROR");
		}
	} else {
		# Tell them what they did wrong
		bh_log($bhlang['error:old_password_invalid'], "BH_ERROR");
	}
}

# See if there's an incoming profile change request
if (!empty($_POST['changeprofile'])) {
	# Go through the options and add/update them
	foreach ($_POST['changeprofile'] as $option=>$value) {
		$optionrows = select_bhdb("userinfo", array("username"=>$bhsession['username'], "itemname"=>$option), "");
		if (empty($optionrows)) {
			insert_bhdb("userinfo", array("username"=>$bhsession['username'], "itemname"=>$option, "itemcontent"=>$value));
		} else {
			update_bhdb("userinfo", array("itemcontent"=>$value), array("username"=>$bhsession['username'], "itemname"=>$option));
		}
	}
	# Say it's updated
	bh_log($bhlang['notice:profile_saved'], "BH_NOTICE");
}

# Get user profile info
$profilerows = select_bhdb("userinfo", array("username"=>$bhsession['username']), "");
$profile = array();
foreach ($profilerows as $profilerow) {
	$profile[$profilerow['itemname']] = $profilerow['itemcontent'];
}

# Open layout object
$layoutobj = new bhlayout("options");

# Send the content to the layout
$layoutobj->title = $bhlang['title:options'];
$layoutobj->content1 = $profile;

$layoutobj->display();