<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: choosefolder.inc.php,v 1.2 2005/06/17 18:52:01 andrewgodwin Exp $
 *
 */
 
#name Folder Chooser
#author Andrew Godwin
#description A way of changing the folder for uploads, downloads, etc.
#iscore 1

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

	$filepath = $_GET['returnfilepath'];
	if (empty($filepath)) { $filepath = $_POST['returnfilepath']; }

	$layoutobj = new bhlayout("choosefolder");
	# Send the file listing to the layout, along with directory name
	$layoutobj->title = $bhlang['title:choose_folder'];
	$layoutobj->returnto = "index.php?page=".$_GET['returnto']."&filepath=".$filepath;
	$layoutobj->display();