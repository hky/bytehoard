<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2005
 *
 *   Module
 *   $Id: login.inc.php,v 1.2 2005/06/17 18:52:01 andrewgodwin Exp $
 *
 */
 
#name Login Form
#author Andrew Godwin
#description Displays the login form so login info can be submitted.

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# Test for confirmation of disclaimer
if (($_GET['disclaimed'] == 1) or (!file_exists("disclaimer.txt"))) {

	# Open layout object
	$layoutobj = new bhlayout("login");
	
	# Send the file listing to the layout, along with directory name
	$layoutobj->title = $bhlang['title:login'];
	$layoutobj->content1 = $bhlang['explain:login'];
	
	$layoutobj->display();

} else {
	
	# Open layout object
	$layoutobj = new bhlayout("generic");
	
	# Send the file listing to the layout, along with directory name
	$layoutobj->title = "Disclaimer";
	$layoutobj->content1 = "Do you accept the following disclaimer?<br><br>".implode("<br>", file("disclaimer.txt"))."<br><br><a href='index.php'>I Do Not Accept</a> &nbsp; <a href='index.php?page=login&disclaimed=1'>I Accept</a>";
	
	$layoutobj->display();
	
}