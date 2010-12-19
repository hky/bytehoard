<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: deletefolder.inc.php,v 1.2 2005/07/26 21:55:09 andrewgodwin Exp $
 *
 */
 
#name Delete Folder
#author Andrew Godwin
#description Deletes the folder supplied.
#iscore 1

# Note: no layouts here, of course. Unless we get an error.

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }


$filepath = bh_fpclean($_GET['filepath']);
$filename = bh_get_filename($filepath);

if (bh_file_exists($filepath) == true) {

	# Stop them deleting their hoe directory or the root directory. Fools.
	$userobj = new bhuser($bhsession['username']);
	if (($userobj->homedir == $filepath) || ($filepath == "/") || ($filepath == "")) {
		$layoutobj = new bhlayout('generic');
		$layoutobj->content1 = $bhlang['error:cannot_delete_that'];
		$layoutobj->title = $bhlang['title:deleting_'].bh_get_filename($filepath);
			
		$layoutobj->display();
	} else {
		if ($_POST['dodelete'] == 1) {
			$delfileobj = new bhfile($filepath);
			$delfileobj->smartdeletefile();
			unset($delfileobj);
			bh_log($bhlang['notice:folder_deleted'], "BH_FOLDER_DELETED");
			$_GET['filepath'] = bh_get_parent($filepath);
			require "modules/viewdir.inc.php";
		} else {
			$layoutobj = new bhlayout('deletefolderform');
			$layoutobj->filepath = $filepath;
			$layoutobj->title = $bhlang['title:deleting_'].bh_get_filename($filepath);
			
			$layoutobj->display();
		}
	}
} else {
	bh_log($bhlang['error:file_not_exist'], "BH_NOPAGE");
	require "modules/error.inc.php";
}