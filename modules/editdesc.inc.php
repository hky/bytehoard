<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: editdesc.inc.php,v 1.2 2005/06/17 18:52:01 andrewgodwin Exp $
 *
 */
 
#name Description Editor
#author Andrew Godwin
#description Edits the description
#iscore 1

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

$filepath = bh_fpclean($_GET['filepath']);
$filename = bh_get_filename($filepath);

if (bh_file_exists($filepath) == true) {

	if (!empty($_POST['isdescription'])) {
	
		$fileobj = new bhfile($filepath);
		$fileobj->fileinfo['description'] = strip_tags($_POST['description']);
		$fileobj->savemetadata();
		
		bh_log($bhlang['notice:file_description_saved'], "BH_NOTICE");
		
		require "modules/viewfile.inc.php";
	
	} else {

		$fileobj = new bhfile($filepath);
		$fileobj->loadfile();
		
		$layoutobj = new bhlayout("editdescform");
		$layoutobj->content1 = $fileobj->fileinfo['description'];
		$layoutobj->filepath = $filepath;
		$layoutobj->subtitle1 = str_replace("#FILE#", $filename, $bhlang['title:editing_description_#FILE#']);
		$layoutobj->title = str_replace("#FILE#", $filename, $bhlang['title:editing_description_#FILE#']);
		
		$layoutobj->display();
	
	}
	
	
} else {
	bh_log($bhlang['error:file_not_exist'], "BH_NOPAGE");
	require "modules/error.inc.php";
}