<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Detection functions
 *   $Id: detect.inc.php,v 1.2 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
/*

OS Detection

*/

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

function bh_os() {
	global $bhconfig;
	
	if (!empty($bhconfig['os'])) { return $bhconfig['os']; }
	
	if (@file_exists("/usr")) { return "nix"; }
	if (@file_exists("/etc")) { return "nix"; }
	if (@file_exists("C:\\")) { return "windows"; }
	if (@file_exists("C:\\Windows\\")) { return "windows"; }
	if (@file_exists("C:\\WINNT\\")) { return "windows"; }
	return "unknown";

}