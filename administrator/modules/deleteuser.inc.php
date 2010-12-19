<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: deleteuser.inc.php,v 1.2 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
#name Delete User
#author Andrew Godwin
#description Deletes a user,
#iscore 1

$deleteusername = $_GET['username'];

if ($_POST['dodelete'] == 1) {

	# Delete the user
	delete_bhdb("users", array("username"=>$deleteusername));
	# Say so
	bh_log($bhlang['notice:user_deleted'], "BH_NOTICE");
	# Show user list
	require "modules/users.inc.php";

} elseif ($_POST['dodelete'] == 2) {

	# Delete the user
	delete_bhdb("users", array("username"=>$deleteusername));
	# Get their files
	$userfiles = bh_user_files($deleteusername);
	# Delete zem.
	foreach ($userfiles as $userfile) {
		$userfileobj = new bhfile($userfile);
		$userfileobj->deletefile();
		unset($userfileobj);
	}
	# Say so
	bh_log($bhlang['notice:user_and_files_deleted'], "BH_NOTICE");
	# Show user list
	require "modules/users.inc.php";

} else {

	$layout = new bhadminlayout("deleteuserform");
	$layout->content1 = $deleteusername;
	$layout->title = $bhlang['title:delete_user'];
	$layout->display();

}