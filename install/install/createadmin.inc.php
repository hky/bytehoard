<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Installer2 - Page File
 *   $Id$
 *
 */

$pagearray = array();

$pagearray['title'] = $bhlang['install:title:bytehoard_installation']." :: ".$bhlang['install:title:create_administrator'];


# Random string function. Author: Aidan Lister <aidan at php dot net>.
# From http://aidan.dotgeek.org/lib/?file=function.str_rand.php
function str_rand($length = 8, $seeds = 'abcdefghijklmnopqrstuvwxyz0123456789') {
	$str = '';
	$seeds_count = strlen($seeds);
	
	// Seed
	list($usec, $sec) = explode(' ', microtime());
	$seed = (float) $sec + ((float) $usec * 100000);
	mt_srand($seed);
	
	// Generate
	for ($i = 0; $length > $i; $i++) {
		$str .= $seeds{mt_rand(0, $seeds_count - 1)};
	}
	
	return $str;
}
require_once "../config.inc.php";
require_once "../includes/db/".$dbconfig['dbmod'];
require_once "../includes/filesystem/filesystem/filesystem.inc.php";
require_once "../includes/users.inc.php";
require_once "../includes/configfunc.inc.php";
bh_loadconfig();

# Create administrator user with random password and add to database
$adminuser = "admin";
$adminpass = str_rand();
bh_adduser($adminuser, $adminpass, "/".$adminuser, "admin");

$pagearray['content'] = $bhlang['install:createadmin:explain']."<br><br>".$bhlang['label:username']." ".$adminuser."<br>".$bhlang['label:password']." ".$adminpass;

$pagearray['continue'] = 1;

return $pagearray;