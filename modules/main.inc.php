<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: main.inc.php,v 1.5 2005/07/26 21:55:09 andrewgodwin Exp $
 *
 */
 
#name Main Page
#author Andrew Godwin
#description Displays the main page.
#iscore 1

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }


if ($bhcurrent['userobj']->type == "guest") {
	# Open layout object
	$layoutobj = new bhlayout("generic");
	# Send the file listing to the layout, along with directory name
	$layoutobj->title = $bhlang['title:main'];
	$layoutobj->content1 = $bhtexts['main_loggedout'];
	$layoutobj->display();
} else {
	# Send the file listing to the layout, along with directory name
	# Open layout object
	$layoutobj = new bhlayout("filelist");
	
	# Grab the directory we're looking in
	$filepath = bh_fpclean($bhcurrent['userobj']->homedir);
	
	# Open the file object for the directory
	if (empty($filepath)) { $filepath = "/"; }
	$directoryobj = new bhfile($filepath);
	
	if ($directoryobj->is_dir() == FALSE) { bh_error($bhlang['error:not_a_dir'], "BH_INVALID_PATH"); }
	
	$modulestouse = bh_listmodulesdirectory($filepath);
	
	# Get listing mode for this directory
	$view = bh_view($bhcurrent['userobj']->username, $filepath);
	# Grab a listing of the files
	$files = $directoryobj->loadfile();
	# Send the file listing to the layout, along with directory name
	$layoutobj->title = $bhlang['title:viewing_directory']." ".$filepath;
	$layoutobj->subtitle1 = $filepath;
	$layoutobj->content1 = $files;
	$layoutobj->content2 = $modulestouse;
	$layoutobj->filepath = $filepath;
	$layoutobj->view = $view;
	$layoutobj->display();
}
