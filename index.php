<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Index.php
 *   $Id: index.php,v 1.6 2005/07/28 20:11:47 andrewgodwin Exp $
 *
 */
 
/*

This file handles all the web requests we get. It takes a look at what it recieves, and delegates the action to the appropriate file.

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
require "includes/db/".$dbconfig['dbmod'];			# Database functions (TODO: make user-selectable)
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

$bhsession = bh_session();					# Start session with auth module


bh_updatemoduledb();						# Add any new modules
bh_purge_old();							# Purge old requests for things

# See if we need to login
if (!empty($_POST['login_username'])) { 
	$loggedin = bh_authenticate($_POST['login_username'], $_POST['login_password']); 
	if ($loggedin > 0) {
		bh_log(str_replace("#USER#", $_POST['login_username'], $bhlang['notice:logged_in_as_#USER#']), "BH_NOTICE");
		bh_log(str_replace("#USER#", $_POST['login_username'], $bhlang['log:successful_login_#USER#']), "BH_LOGIN_SUCCESS");
		$bhsession = bh_session_create($_POST['login_username']);	# Start a session for the user.
		$_GET['page'] = "main";
	} else {
		if ($loggedin < 0) {
			bh_log($bhlang['notice:login_failed_disabled'], "BH_NOTICE");
			bh_log(str_replace("#USER#", $_POST['login_username'], $bhlang['log:failed_login_disabled_#USER#']), "BH_LOGIN_FAILURE");
			$_GET['page'] = "login";
		} else {
			bh_log($bhlang['notice:login_failed'], "BH_NOTICE");
			bh_log(str_replace("#USER#", $_POST['login_username'], $bhlang['log:failed_login_#USER#']), "BH_LOGIN_FAILURE");
			$_GET['page'] = "login";
		}
	}
}

# See if we need to log out
if (!empty($_GET['logout']) || ($_GET['page'] == "logout")) {
	bh_log($bhlang['notice:logged_out'], "BH_NOTICE");
	bh_log(str_replace("#USER#", $bhsession['username'], $bhlang['log:#USER#_logged_out']), "BH_LOGOUT");
	$bhsession = bh_session_destroy();	# Get rid of the session
	$_GET['page'] = "main";
}

# Set username
$bhcurrent['userobj'] = new bhuser($bhsession['username']);



# OK, all loaded, check the page they requested.
$page = $_GET['page'];    if (empty($page)) { $page = $_POST['page']; }    if (empty($page)) { $page = "main"; }

if (!file_exists("modules/".$page.".inc.php")) {  bh_log($bhlang['error:page_not_exist'], "BH_NOPAGE"); $page = "error"; }

### OK, now do security checks.

# Usertype check
if (bh_checkmodulepermission($page, $bhcurrent['userobj']->type) == 0) {
	bh_log($bhlang['error:access_denied'], "BH_ACCESS_DENIED"); 
	bh_log($bhlang['error:access_denied'], "BH_ERROR"); 
	$page = "error";
	
}

# fileperm check (if needed)
if (!empty($_GET['filepath'])) {
if (bh_checkmodulefilepath($page, $_GET['filepath'], $bhcurrent['userobj']->username) == 0) {
	bh_log($bhlang['error:access_denied'], "BH_ACCESS_DENIED"); 
	bh_log($bhlang['error:access_denied'], "BH_ERROR"); 
	$page = "error";
}
}

# Pass control to the requested page
require "modules/".$page.".inc.php";


# The End.

?> 