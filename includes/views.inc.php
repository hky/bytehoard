<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   View functions
 *   $Id: views.inc.php,v 1.2 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
/*

Directory view funcs.

*/

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# Returns the text
function bh_view($username, $filepath) {
	
	# Get our prefs for this dir, if we have any
	$filepathrows = select_bhdb("usersviews", array("username"=>$username, "filepath"=>$filepath), 1);
	
	if (empty($filepathrows)) {
		
		return "tiles";
		
	} else {
	
		return $filepathrows[0]['view'];
	
	}
}

# Sets the view for a directory
function bh_setview($username, $filepath, $view) {

	# Get our prefs for this dir, if we have any
	$filepathrows = select_bhdb("usersviews", array("username"=>$username, "filepath"=>$filepath), 1);
	
	if (empty($filepathrows)) {
		
		insert_bhdb("usersviews", array("username"=>$username, "filepath"=>$filepath, "view"=>$view), "");
		
	} else {
	
		update_bhdb("usersviews", array("view"=>$view), array("username"=>$username, "filepath"=>$filepath));
	
	}

}