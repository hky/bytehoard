<?php

# ByteHoard Batching

# Users

# File format
# username,password,email[,fullname[,type]]
# Lines starting with # or ; are ignored

define("IN_BH", 1);
define("BH_ROOT", "../");

# Get includes
require "../includes/version.inc.php";				# Version
require "../includes/configfunc.inc.php";			# Config functions
bh_checkconfigadmin();						# Check the config exists, or don't bother with the rest.
require "../config.inc.php";					# Load config file
require "../includes/db/".$dbconfig['dbmod'];			# Database functions (TODO: make user-selectable)
bh_loadconfig();						# Load configuration

require "../includes/auth/".$bhconfig['authmodule'];		# Authentication functions 
require "../langs/".$bhconfig['lang'].".lang.php";					# Language File 
require "../includes/filesystem/".$bhconfig['filesystemmodule']."/filesystem.inc.php";	# Filesystem functions 
require "../includes/filesystem/".$bhconfig['filesystemmodule']."/mimetype.inc.php";	# Mimetype functions
require "../includes/filesystem/".$bhconfig['filesystemmodule']."/thumbnails.inc.php";	# Thumbnail functions 
require "../includes/log.inc.php";				# Logging functions
require "../includes/users.inc.php";				# User functions
require "../includes/modules.inc.php";				# Module functions
require "../includes/detect.inc.php";				# Detection functions
require "../includes/views.inc.php";				# View functions
require "../includes/bandwidth.inc.php";			# Bandwidth functions
require "../includes/misc.inc.php";				# Miscellaneous functions
require "../includes/email.inc.php";				# Email functions
require "../includes/filelink.inc.php";				# FileLink/FileMail functions

# File array
$file = file($_GET['file']) or die("I'm sorry. That isn't a valid file.");

# Loooop through
foreach ($file as $num=>$line) {
	if ((substr($line, 0, 1) == "#") || (substr($line, 0, 1) == ";") || (trim($line)=="")) {
		
	} else {
		$linearray = explode(",", $line);
		if (empty($linearray[0])) { die("No username provided! Line ".($num+1)); }
		elseif (empty($linearray[1])) { die("No password provided! Line ".($num+1)); }
		elseif (empty($linearray[2])) { die("No email provided! Line ".($num+1)); }
		else { 
			$userrows = select_bhdb("users", array("username"=>$linearray[0]), "");
			if (empty($userrows)) {
				if (empty($linearray[4])) { $linearray[4] = "normal"; }
				bh_adduser($linearray[0], $linearray[1], bh_fpclean("/".$linearray[0]), $linearray[4]); 
				insert_bhdb("userinfo", array("username"=>$linearray[0], "itemname"=>"fullname", "itemcontent"=>empty($linearray[3])));
				insert_bhdb("userinfo", array("username"=>$linearray[0], "itemname"=>"email", "itemcontent"=>empty($linearray[2])));
				echo("User ".$linearray[0]." added! <br>\n\r");
			} else {
				echo("User ".$linearray[0]." exists, not added. <br>\n\r");
			}
		}
	}
}

echo(($num+1)." lines processed. Finished.");
