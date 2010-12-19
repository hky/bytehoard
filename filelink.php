<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   filelink.php
 *   $Id: filelink.php,v 1.3 2005/07/28 20:53:21 andrewgodwin Exp $
 *
 */
 
/*

This file handles the FileMail codes. It takes in the codes, checks them, and either dishes out the file or a warning message.

*/

define("IN_BH", 1);
session_start();

 
# Temporary layout fix
#$bhconfig['layout'] = "discoverer";
#$bhconfig['skin'] = "roundedsolid";

# Get includes
require "includes/version.inc.php";				# Version
require "includes/configfunc.inc.php";				# Config functions
bh_checkconfig();						# Check the config exists, or don't bother with the rest.
require "config.inc.php";					# Load config file
require "includes/db/".$dbconfig['dbmod'];			# Database functions 
bh_loadconfig();						# Load configuration

require "includes/auth/".$bhconfig['authmodule'];		# Authentication functions 
require "langs/".$bhconfig['lang'].".lang.php";					# Language File 
require "includes/filesystem/".$bhconfig['filesystemmodule']."/filesystem.inc.php";	# Filesystem functions 
require "includes/filesystem/".$bhconfig['filesystemmodule']."/mimetype.inc.php";	# Mimetype functions
require "includes/filesystem/".$bhconfig['filesystemmodule']."/thumbnails.inc.php";	# Thumbnail functions 
require "layouts/".$bhconfig['layout']."/main.inc.php";		# Layout file 
require "includes/log.inc.php";					# Logging functions
require "includes/users.inc.php";				# User functions
require "includes/modules.inc.php";				# Module functions
require "includes/detect.inc.php";				# Detection functions
require "includes/views.inc.php";				# View functions
require "includes/bandwidth.inc.php";				# Bandwidth functions
require "includes/misc.inc.php";				# Miscellaneous functions
require "includes/email.inc.php";				# Email functions
require "includes/filelink.inc.php";				# FileLink/FileMail functions

require "includes/pear/PEAR.php";				# Inbuilt PEAR file. This is bad, I know, but we need it.
require "includes/pear/Archive/tar.inc.php";			# And the Archive_Tar library. Slightly modified.

bh_updatemoduledb();						# Add any new modules
bh_purge_old();							# Purge old requests for things


# Right. See if there is a file code
if (empty($_GET['filecode'])) { bh_die("error:no_filecode"); }

$filecode = $_GET['filecode'];

if (bh_filelink_destination($filecode) == false) { bh_log(str_replace("#FILELINK", $filecode, $bhlang['log:filelink_denied']), "BH_FILELINK_ACCESSED"); bh_die("error:filecode_invalid"); }

# Well, it must be valid.
$filepath = bh_filelink_destination($filecode);
$filename = bh_get_filename($filepath);
$fileobj = new bhfile($filepath);
$username = bh_filelink_get($filecode, "username");
$userobj = new bhuser($username);
$fullname = $userobj->userinfo['fullname'];
$emailfrom = $userobj->userinfo['email'];
# If it is a download:

if ($_GET['download'] == 1) {
	$replarray1 = array("#FILELINK#", "#FILEPATH#", "#FILENAME#", "#IP#", "#TIME#", "#EMAIL#", "#EXPIRES#");
	$replarray2 = array($filecode, $filepath, $filename, $_SERVER['REMOTE_ADDR'], date("l dS F Y g:i A"), bh_filelink_get($filecode, "email"), date("l dS F Y g:i A", bh_filelink_get($filecode, "expires")));
	
	# Log it
	bh_log(str_replace($replarray1, $replarray2, $bhlang['log:filelink_accessed']), "BH_FILELINK_ACCESSED");
	
	# Email it ##
	
	if (bh_filelink_get_notify($filecode) == 1) {
	
		$username = bh_filelink_get($filecode, "username");
		$userobj = new bhuser($username);
		
		$emailobj = new bhemail($userobj->userinfo['email']);
		$emailobj->subject = str_replace($replarray1, $replarray2, $bhlang['emailsubject:filemail_link_accessed']);
		$emailobj->message = str_replace($replarray1, $replarray2, $bhlang['email:filemail_link_accessed']);
		$emailobj->send();
	
	}
	
	#############
	
	header("Content-type: ".$fileobj->mimetype());
	header("Content-Disposition: attachment; filename=".$filename);
	header("Content-length: ".$fileobj->fileinfo['filesize']);
	# IE SSL fix
	header("Pragma: ");
	header("Cache-Control: ");
	$fileobj->readfile();
	die();
} else {
	bh_add_logvars(array("filename"=>$filename, "filepath"=>$filepath));

	if (empty($fullname)) { $dstr = $emailfrom; }
	else { $dstr = $fullname." [".$emailfrom."]"; }

	# Display a page with information
	$str = "<head><title>".$bhlang['title:file_download']."</title><meta http-equiv='refresh' content='5;url=".bh_filelink_uri($filecode)."&download=1'><style>body {font-family: sans-serif;}</style></head>
	<body><b>".$bhlang['title:file_download']."</b><br><br><table><tr><td>".$bhlang['label:from']."</td><td>".$dstr."</td></tr><tr><td>".$bhlang['label:filename']."</td><td>".$filename."</td></tr><tr><td>".$bhlang['label:filesize']."</td><td>".bh_humanise_filesize($fileobj->fileinfo['filesize'])."</td></tr><tr><td>".$bhlang['label:md5']."</td><td>".$fileobj->md5()."</td></tr></table><br>".$bhlang['explain:filelink_download']."<br><br><a href='".bh_filelink_uri($filecode)."&download=1'>".bh_parse_logvars($bhlang['button:download_file'])."</a></body></html>";
	die($str);
}

?> 