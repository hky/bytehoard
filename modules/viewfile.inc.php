<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: viewfile.inc.php,v 1.2 2005/06/17 18:52:02 andrewgodwin Exp $
 *
 */
 
#name File Viewer
#author Andrew Godwin
#description Shows actions that can be done for a file
#iscore 1

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

if (bh_file_exists($filepath) == true) {
	# Open layout object
	$layoutobj = new bhlayout("filepane");
	
	# Grab the file we're looking at
	$filepath = bh_fpclean($_GET['filepath']);
	if (empty($filepath)) { bh_log($bhlang['error:no_file_specified'], "BH_INVALID_PATH"); }
	$fileobj = new bhfile($filepath);

	if ($fileobj->is_dir() == TRUE) { bh_error($bhlang['error:not_a_file'], "BH_INVALID_PATH"); }
	
	# Get the modules it's allowed
	$modulestouse = bh_listmodulesfile($filepath);
	
	# Send the stuff to the layout.
	# Note:
	# content1 - the list of modules it is allowed
	# subtitle1 - the filename
	# subtitle2 - the description
	
	$layoutobj->title = $bhlang['title:viewing_file']." ".$filepath;
	$layoutobj->subtitle1 = $filepath;
	$layoutobj->content1 = $modulestouse;
	$layoutobj->filepath = $filepath;
	
	$layoutobj->display();
} else {
	bh_log($bhlang['error:file_not_exist'], "BH_NOPAGE");
	require "modules/error.inc.php";
}