<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: error.inc.php,v 1.3 2005/06/17 18:52:01 andrewgodwin Exp $
 *
 */
 
#name Error Page
#author Andrew Godwin
#description Displays the error page if needed.
#iscore 1

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

	$layoutobj = new bhlayout("generic");
	$layoutobj->title = $bhlang['title:error'];
	$layoutobj->content1 = $bhlang['explain:error_occured'];
	$layoutobj->display();