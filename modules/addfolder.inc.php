<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: addfolder.inc.php,v 1.3 2005/06/17 18:52:01 andrewgodwin Exp $
 *
 */
 
#name Directory Creator
#author Andrew Godwin
#description Lets you add a directory/folder
#iscore 1

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

if (empty($infolder)) { $infolder = $_GET['infolder']; }
if (empty($infolder)) { $infolder = $_POST['infolder']; }
if (empty($infolder)) { $infolder = $_SESSION['lastdir']; }
if (empty($infolder)) { $infolder = $bhcurrent['userobj']->homedir; }

if (!empty($_POST['foldername'])) {

	# Check they have permission to write in the folder
	if (bh_checkrights(bh_fpclean($infolder), $bhsession['username']) >= 2) {
		bh_mkdir(bh_fpclean($infolder."/".$_POST['foldername']));
		$fileobj = new bhfile(bh_fpclean($infolder."/".$_POST['foldername']));
		unset($fileobj);
		
		bh_log($bhlang['notice:folder_created'], "BH_NOTICE");
		bh_log(str_replace("#USER#", $bhsession['username'], str_replace("#FOLDER#", bh_fpclean($infolder."/".$_POST['foldername']), $bhlang['log:#USER#_created_#FOLDER#'])), "BH_FOLDER_CREATED");
		
		$_GET['filepath'] = bh_fpclean($infolder."/".$_POST['foldername']);
		require "modules/viewdir.inc.php";
	} else {
		bh_log($bhlang['error:access_denied'], "BH_ERROR");
		bh_log(str_replace("#USER#", $bhsession['username'], str_replace("#PAGE#", $_SERVER['REQUEST_URI'], $bhlang['log:#USER#_denied_#PAGE#'])), "BH_ACCESS_DENIED");
		require "modules/error.inc.php";
	}

} else {
	
	# Open layout object
	$layoutobj = new bhlayout("addfolderform");
	$layoutobj->filepath = $infolder;
	$layoutobj->display();

}