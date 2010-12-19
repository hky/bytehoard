<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: sharing.inc.php,v 1.3 2005/07/26 21:55:09 andrewgodwin Exp $
 *
 */
 
#name Sharing Configration Page
#author Andrew Godwin
#description Allows users to share files
#iscore 1

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# Get the filepath/name
$filepath = bh_fpclean($_GET['filepath']);
$filename = bh_get_filename($filepath);

# Open a file object
$fileobj = new bhfile($filepath);

# See if we need to respond to an action

# Add user
if (!empty($_POST['adduser'])) {
	# Add user to file permissions with inital level 0.
	$fileobj->set_userrights($_POST['adduser'], 0);
	bh_log($bhlang['notice:permissions_user_added'], "BH_NOTICE");
}

# Delete user
if (!empty($_POST['deluser'])) {
	# Delete user from file db
	$fileobj->set_userrights($_POST['deluser'], -1);
	bh_log($bhlang['notice:permissions_user_deleted'], "BH_NOTICE");
}

# Add group
if (!empty($_POST['addgroup'])) {
	# Add group to file permissions with inital level 0.
	$fileobj->set_grouprights($_POST['addgroup'], 0);
	bh_log($bhlang['notice:permissions_group_added'], "BH_NOTICE");
}

# Delete group
if (!empty($_POST['delgroup'])) {
	# Delete user from file db
	$fileobj->set_grouprights($_POST['delgroup'], -1);
	bh_log($bhlang['notice:permissions_group_deleted'], "BH_NOTICE");
}

# User perms change
if ((!empty($_GET['user']))||($_GET['user']==="0")) {
	if ($_GET['username'] == $bhsession['username']) {
		bh_log($bhlang['error:permissions_self'], "BH_ERROR");
	} else {
		$fileobj->set_userrights($_GET['username'], $_GET['user']);
		bh_log($bhlang['notice:permissions_changed'], "BH_NOTICE");
	}
}

# Group perms change
if ((!empty($_GET['group']))||($_GET['group']==="0")) {
	$fileobj->set_grouprights($_GET['groupname'], $_GET['group']);
		bh_log($bhlang['notice:permissions_changed'], "BH_NOTICE");
}

# Public perms change
if (($_GET['public']==="0")||($_GET['public']==="1")||($_GET['public']==="2")) {
	# Change the public permissions to whatever was sent
	$fileobj->set_publicrights($_GET['public']);
	
	# Display the message
	bh_log($bhlang['notice:permissions_changed'], "BH_NOTICE");
}

# Get the users, groups and public permissions
$usersrights = $fileobj->usersrights();
$groupsrights = $fileobj->groupsrights();
$publicrights = $fileobj->publicrights();

# Open the layout
$layoutobj = new bhlayout("sharing");

# Give it the content
$layoutobj->content1 = $usersrights;
$layoutobj->content2 = $groupsrights;
$layoutobj->content3 = $publicrights;

# And the name
$layoutobj->subtitle1 = $bhlang['title:sharing_'].$filename;

# And the filepath
$layoutobj->filepath = $filepath;

# Diiiiisplay.
$layoutobj->display();