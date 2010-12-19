<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Installer2 - Page File
 *   $Id$
 *
 */

# Page not found page

$pagearray['title'] = $bhlang['install:title:bytehoard_installation']." :: ".$bhlang['install:title:system_information'];

$pagearray['content'] = "<br><b>ByteHoard Versions & checksums</b><br><br>";

function getid($file) {
	$fa = @file($file);
	if (empty($fa)) { $fa = array(); }
	foreach ($fa as $line) {
		if (strpos($line, "$"."Id") !== FALSE) {
			return $line;
		}
	}
}

function doid($file) {
	return str_replace("../", "", $file).": <br>&nbsp; &nbsp; ID[".getid($file)."] MD5[".getmd5($file)."]<br>";
}

function getmd5($file) {
	return @md5_file($file);
}

$pagearray['content'] .= doid("../includes/users.inc.php");
$pagearray['content'] .= doid("../includes/filesystem/filesystem/filesystem.inc.php");
$pagearray['content'] .= doid("../includes/filesystem/filesystem/mimetype.inc.php");
$pagearray['content'] .= doid("../includes/filesystem/filesystem/thumbnails.inc.php");
$pagearray['content'] .= doid("../includes/views.inc.php");
$pagearray['content'] .= doid("../includes/log.inc.php");
$pagearray['content'] .= doid("../includes/modules.inc.php");
$pagearray['content'] .= doid("../includes/texts.inc.php");
$pagearray['content'] .= doid("../includes/configfunc.inc.php");
$pagearray['content'] .= doid("../includes/detect.inc.php");
$pagearray['content'] .= doid("../index.php");
$pagearray['content'] .= doid("../install/index.php");

$pagearray['content'] .= "<br><br><br><b>PHP Information</b><br><br>";
$pagearray['content'] .= "PHP Version: ".phpversion()."<br>";
$pagearray['content'] .= "PHP Extensions: <br>";
$exts = get_loaded_extensions();
foreach ($exts as $ext) {
	$pagearray['content'] .= $ext." ".phpversion($ext)."<br>";
}$pagearray['content'] .= "<br>PHP Configuration options: <br>";
$opts = ini_get_all();
foreach ($opts as $optname=>$opt) {
	$pagearray['content'] .= $optname.": ".$opt['local_value']."<br>";
}

return $pagearray;