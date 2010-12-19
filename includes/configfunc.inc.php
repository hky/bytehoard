<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Confiuration functions
 *   $Id: configfunc.inc.php,v 1.3 2005/07/28 20:11:47 andrewgodwin Exp $
 *
 */
 
/*

Configuration loaders and savers.

*/

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# Loads configuration
function bh_loadconfig() {
	global $bhconfig;

	# Load configuration
	$rows = select_bhdb("config", "", "");
	if (!empty($rows)) {
		foreach ($rows as $row) {
			$bhconfig[$row['variable']] = stripslashes($row['value']);
		}
	}
	
	# Add defaults if nothing
	if (empty($bhconfig['authmodule'])) { $bhconfig['authmodule'] = "bytehoard.inc.php"; }
	if (empty($bhconfig['filesystemmodule'])) { $bhconfig['filesystemmodule'] = "filesystem"; }
	if (empty($bhconfig['lang'])) { $bhconfig['lang'] = "en"; }
	
	# Tidy up fileroot if needed
	if ((substr($bhconfig['fileroot'], 0, 1) != "/") && (substr($bhconfig['fileroot'], 2, 1) != ":")) {
		if (defined("BH_ROOT")) {
			$bhconfig['fileroot'] = realpath(str_replace("//", "/", (BH_ROOT."/".$bhconfig['fileroot'])));
		} else {
			$bhconfig['fileroot'] = realpath($bhconfig['fileroot']);
		}
	}
}

# Nice configuration changing function. Adds the configuration if it doesn't exist.
function bh_changeconfig($variable, $value) {
	global $bhconfig;
	
	# See if it's already in the db.
	$rows = select_bhdb("config", array("variable"=>$variable), 1);
	
	# If it is...
	if (!empty($rows)) {
		# Update it
		update_bhdb("config", array("value"=>addslashes($value)), array("variable"=>$variable));
	} else {
		# Add it
		insert_bhdb("config", array("variable"=>$variable, "value"=>addslashes($value)));
	}
}

# Checks text configuration actually exists, and, if not, kills the process w/a html error, or redirects to the install.php if it exists.
function bh_checkconfig() {
	global $bhconfig;
	
	if (!file_exists("config.inc.php")) { 
	
		if (file_exists("install/index.php")) {
			header("Location: install/index.php"); die();
		} else {
			$str = "
			<html>
			<head>
			<title>ByteHoard ".$bhconfig['version']." :: Configuration File Not Found</title>
			<style>
				a {text-decoration:none;color:#336699;}
				a:hover {text-decoration:underline;color:#6699AA;}
				body { font-family: arial,sans; }
			</style>
			</head>
			<body>
			<center><font size=\"+2\">
			<b>Configuration File Not Found</b>
			</font></center>
			<br /><br />
			ByteHoard cannot locate the configuration file. Please (re)run the installer (see documentation for details).
			<br /><br />
			Note to end users: The ByteHoard development team are in no way affiliated with this website. Do not contact us about any problems you experience with this website. Please direct your problems to the website administrator.
			<br /><br />
			<font size=\"-1\">Powered by <a href=\"http://www.bytehoard.org\">ByteHoard</a> version ".$bhconfig['version']."</font>
			</body>
			</html>";
		
			die($str);
		}
	 
	}
}

# Checks text configuration actually exists, and, if not, kills the process w/a html error, or redirects to the install.php if it exists. For admim area.
function bh_checkconfigadmin() {
	global $bhconfig;
	
	if (!file_exists("../config.inc.php")) { 
	
		if (file_exists("../install.php")) {
			header("Location: ../install.php"); die();
		} else {
			$str = "
			<html>
			<head>
			<title>ByteHoard ".$bhconfig['version']." :: Configuration File Not Found</title>
			<style>
				a {text-decoration:none;color:#336699;}
				a:hover {text-decoration:underline;color:#6699AA;}
				body { font-family: arial,sans; }
			</style>
			</head>
			<body>
			<center><font size=\"+2\">
			<b>Configuration File Not Found</b>
			</font></center>
			<br /><br />
			ByteHoard cannot locate the configuration file. Please (re)run the installer (see documentation for details).
			<br /><br />
			Note to end users: The ByteHoard development team are in no way affiliated with this website. Do not contact us about any problems you experience with this website. Please direct your problems to the website administrator.
			<br /><br />
			<font size=\"-1\">Powered by <a href=\"http://www.bytehoard.org\">ByteHoard</a> version ".$bhconfig['version']."</font>
			</body>
			</html>";
		
			die($str);
		}
	 
	}
}

# From PHP manual
function bh_return_bytes($val) {
    $val = trim($val);
    $last = $val{strlen($val)-1};
    switch($last) {
        case 'k':
        case 'K':
            return (int) $val * 1024;
            break;
        case 'm':
        case 'M':
            return (int) $val * 1048576;
            break;
        default:
            return $val;
    }
 }

# Dynamic loading function. Stuck in here since this gets loaded before the database modules.

function bh_dl($ext) {
	if (!extension_loaded($ext)) {
		if (strtoupper(substr(PHP_OS, 0, 3) == 'WIN')) {
			dl('php_'.$ext.'.dll');
		} else {
			dl($ext.'.so');
		}
	}
}