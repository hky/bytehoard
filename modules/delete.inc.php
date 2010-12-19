<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: delete.inc.php,v 1.3 2005/06/17 18:52:01 andrewgodwin Exp $
 *
 */
 
#name Delete
#author Andrew Godwin
#description Deletes a file.
#iscore 1

# Note: no layouts here, of course. Unless we get an error.

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }


$filepath = bh_fpclean($_GET['filepath']);
$filename = bh_get_filename($filepath);

if (bh_file_exists($filepath) == true) {
	if ($_POST['dodelete'] == 1) {
		$delfileobj = new bhfile($filepath);
		$delfileobj->smartdeletefile();
		unset($delfileobj);
		bh_log($bhlang['notice:file_deleted'], "BH_FILE_DELETED");
		$_GET['filepath'] = bh_get_parent($filepath);
		require "modules/viewdir.inc.php";
	} else {
		$layoutobj = new bhlayout('deleteform');
		$layoutobj->filepath = $filepath;
		$layoutobj->title = $bhlang['title:deleting_'].bh_get_filename($filepath);
		
		$layoutobj->display();
	}
} else {
	bh_log($bhlang['error:file_not_exist'], "BH_NOPAGE");
	require "modules/error.inc.php";
}