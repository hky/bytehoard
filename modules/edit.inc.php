<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: edit.inc.php,v 1.3 2005/06/17 18:52:01 andrewgodwin Exp $
 *
 */
 
#name Editor
#author Andrew Godwin
#description Plaintext editor for files
#iscore 1

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

$filepath = bh_fpclean($_GET['filepath']);
$filename = bh_get_filename($filepath);

if (bh_file_exists($filepath) == true) {

	if ($_POST['iscontent']) {
	
		$fileobj = new bhfile($filepath);
		$sizediff = strlen($_POST['file_content'])-$fileobj->fileinfo['filesize'];
		if ($bhcurrent['userobj']->spaceremaining() < $sizediff) {
			bh_add_logvars(array("quota"=>$bhcurrent['userobj']->quota));
			bh_add_error($bhlang['error:quota_exceeded']);
			require "modules/error.inc.php";
		} else {
			$fileobj->filecontents = $_POST['file_content'];
			$fileobj->savefile();
			
			bh_log($bhlang['notice:file_saved'], "BH_NOTICE");
			bh_log(str_replace("#FILE#", $filepath, str_replace("#USER#", $bhsession['username'], $bhlang['log:#USER#_modified_#FILE#'])), "BH_FILE_MODIFIED");
			
			require "modules/viewfile.inc.php";
		}
	
	} else {

		$fileobj = new bhfile($filepath);
		$fileobj->loadfile();
		
		$layoutobj = new bhlayout("editform");
		$layoutobj->content1 = $fileobj->filecontents;
		$layoutobj->filepath = $filepath;
		$layoutobj->subtitle1 = str_replace("#FILE#", $filename, $bhlang['title:editing_#FILE#']);
		$layoutobj->title = str_replace("#FILE#", $filename, $bhlang['title:editing_#FILE#']);
		
		$layoutobj->display();
	
	}
	
	
} else {
	bh_log($bhlang['error:file_not_exist'], "BH_NOPAGE");
	require "modules/error.inc.php";
}