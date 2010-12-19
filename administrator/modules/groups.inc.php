<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: users.inc.php,v 1.2 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
#name Groups List
#author Andrew Godwin
#description Displays a list of groups, and lets you add users to them.
#iscore 1

$layout = new bhadminlayout("groupslist");

 if (empty($_POST['group'])) { $_POST['group'] = array(); } 
 if (empty($_GET['group'])) { $_GET['group'] = array(); } 
 $group = array_merge($_POST['group'], $_GET['group']); 

if ($group['action'] == "add") {
	$grouprows = select_bhdb("groupusers", array("username"=>$group['username'], "group"=>$group['group']), "");
	if (empty($grouprows)) {
		$userrows = select_bhdb("users", array("username"=>$group['username']), "");
		if (empty($userrows)) {
			bh_add_logvars(array("username"=>$group['username'], "group"=>$group['group']));
			bh_add_error($bhlang['error:user_does_not_exist']);
		} else {
			insert_bhdb("groupusers", array("username"=>$group['username'], "group"=>$group['group']));
			bh_add_logvars(array("username"=>$group['username'], "group"=>$group['group']));
			bh_add_notice($bhlang['notice:user_added_to_group']);
		}
	} else {
		bh_add_logvars(array("username"=>$group['username'], "group"=>$group['group']));
		bh_add_error($bhlang['error:user_is_in_group']);
	}
}
if ($group['action'] == "remove") {
	delete_bhdb("groupusers", array("username"=>$group['username'], "group"=>$group['group']));
	bh_add_logvars(array("username"=>$group['username'], "group"=>$group['group']));
	bh_add_notice($bhlang['notice:user_removed_from_group']);
}

$usersbygroup = bh_usersbygroup();

$layout->content1 = $usersbygroup;
$layout->title = $bhlang['title:group_administration'];
$layout->display();
