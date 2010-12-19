<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2003-2004
 *
 *   Packages Functions File
 *   $Id: updates.inc.php,v 1.2 2005/07/26 21:55:09 andrewgodwin Exp $
 *
 */
 
/*

Here is the package stuff - this has functions for listing, downloading and installing updates.

*/


# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# Load Archive_Tar
require_once realpath(dirname(__FILE__)."/archive/tar.inc.php");

# Function that returns the server string
function bh_update_server() {
	global $bhconfig, $bhlang;
	
	# Try setting this, in case.
	ini_set("allow_url_fopen", 1);
	if (ini_get("allow_url_fopen") == 0) { die $bhlang['error:systemwrong']; }
	$serveraddrfilearray = file("http://bytehoard.sourceforge.net/updateserverlocation.php");
	return $serveraddress = trim(implode("", $serveraddrfilearray));
}

function bh_get_update_status() {
	# Checks the ByteHoard server to see if there is an update
	
	$serveraddress = bh_update_server();
	
	# Now, contact that server and get the updates list
	$updatesfilearray = file($serveraddress."?action=update_status&bhversion=".$bhconfig['version']);
	
	# Implode the response and trim it.
	$updatesresponse = trim(implode("", $updatesfilearray));
	
	# Check what it is
	if (substr{0} == "U") {
		# The line format is pkgcode;pkgname;description;version;type
		$linearray = explode(";", trim(substr($updatesresponse, 1)));
		$packages[$linearray[0]] = array("code"=>$linearray[0], "name"=>$linearray[1], "description"=>$linearray[2], "version"=>$linearray[3], "type"=>$linearray[4]);
	} else {
		$linearray = false;
	}
	
	return $linearray;
}

function bh_packages_list() {
	# Will get a list of updates off of the ByteHoard server, and determine which ones are relevant.
	# First, find out where the server is from sf.net (this is in case we lose bytehoard.org someday)
	# [Yes, I am paranoid]
	
	global $bhconfig, $bhlang;
	
	# Try setting this, in case.
	ini_set("allow_url_fopen", 1);
	if (ini_get("allow_url_fopen") == 0) { die $bhlang['error:systemwrong']; }
	$serveraddrfilearray = file("http://bytehoard.sourceforge.net/updateserverlocation.php");
	$serveraddress = trim(implode("", $serveraddrfilearray));
	
	# Now, contact that server and get the updates list
	$updatesfilearray = file($serveraddress."?action=package_list&bhversion=".$bhconfig['version']);
	
	$packages = array();
	$newpackages = array();
	
	# The package file format is pkgcode;pkgname;description;version;type
	foreach ($updatesfilearray as $updatesfileline) {
		$linearray = explode(";", trim(substr($updatesfilearray, 1)));
		$packages[$linearray[0]] = array("code"=>$linearray[0], "name"=>$linearray[1], "description"=>$linearray[2], "version"=>$linearray[3], "type"=>$linearray[4]);
	}
	
	return $packages;
}

# This one takes a package code and tells you if it's installed (returns NULL if not) and its version (returned if it is installed)
function bh_package_status($packagecode) {
	$pkgrows = select_bhdb("packages", array("code"=>$packagecode), "");
	if (empty($pkgrows)) { return NULL; }
	else { return $pkgrows[0]['version']; }
}

# This one finds out the version available on the remote server of the package. Returns NULL if it doesn't exist and the version string if it does.
function bh_remote_package_status($packagecode) {
	$serveraddress = bh_update_server();
	
	# Now, contact that server and get the updates list
	$statusfilearray = file($serveraddress."?action=package_status&pkgcode=$packagecode&bhversion=".$bhconfig['version']);
	
	# Implode the response and trim it.
	$statusresponse = trim(implode("", $statusfilearray));
	
}

# This function detects what compression extensions are installed and returns the appropriate filetype
function bh_package_get_type() {
	#if (extension_loaded("bzip2")) { return "tbz2"; }
	#elseif (extension_loaded("zlib")) { return "tgz"; }
	# Will stick to GZip and raw tar for now.
	if (extension_loaded("zlib")) { return "tgz"; }
	else { return "tar"; }
}

# This one downloads the package.
function bh_package_download($packagecode) {

	global $bhconfig, $bhlang;
	
	# Try setting this, in case.
	ini_set("allow_url_fopen", 1);
	if (ini_get("allow_url_fopen") == 0) { die $bhlang['error:systemwrong']; }
	$serveraddrfilearray = file("http://bytehoard.sourceforge.net/updateserverlocation.php");
	$serveraddress = trim(implode("", $serveraddrfilearray));
	
	$type = bh_package_get_type();
	
	# Now, contact that server and get the updates list
	$packagefilepointer = fopen($serveraddress."?action=package_get&packagetype=$type&packagecode=".$packagecode, "rb");
	$localpackagefilepointer = fopen($bhconfig['bhfilepath']."/cache/".$packagecode.".".$type, "wb")
	while(!feof($wp)) {
		$buffer .= fread($wp,4096);
		fwrite($localpackagefilepointer, $buffer, strlen($buffer));
	}
	fclose($packagefilepointer); fclose($localpackagefilepointer);

}

# This function (obviously) installs the package file given to the system.
function bh_package_install($packagefilepath) {
	global $bhconfig, $bhlang;
	
	# Open an Archive_Tar object for it and extract
	(bh_package_get_type() == "tgz") ? ($a_ttype = "gz") : ($a_ttype = NULL);
	$tar_object = new Archive_Tar("tarname.tar", $a_ttype);
	$tar_object->setErrorHandling(PEAR_ERROR_PRINT);
	$tar_object->extract($bhconfig['bhfilepath']);

}