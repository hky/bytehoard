<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: url.inc.php,v 1.2 2005/06/17 18:52:02 andrewgodwin Exp $
 *
 */
 
#name URL Link Page
#author Andrew Godwin
#description Displays the URL of the given filepath.
#iscore 1

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

	$layoutobj = new bhlayout("generic");
	# Send the file listing to the layout, along with directory name
	$layoutobj->title = $bhlang['title:error'];
	$layoutobj->content1 = $bhlang['explain:the_url_to_that_file_is_'];
	$layoutobj->display();