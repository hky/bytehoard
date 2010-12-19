<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2003-2004
 *
 *   Updates Functions File
 *   $Id: packages.inc.php,v 1.1 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
/*

Here is the update stuff - this has functions for listing, downloading and installing updates.

*/


# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# Load Archive_Tar
require_once realpath(dirname(__FILE__)."/archive/tar.inc.php");

function bh_packages_serveraddr() {
	# Try setting this, in case.
	ini_set("allow_url_fopen", 1);
	if (ini_get("allow_url_fopen") == 0) { bh_die("error:system_setup_wrong"); }
	$serveraddrfilearray = file("http://bytehoard.sourceforge.net/updateserverlocation.php") or bh_die("error:cannot_determine_update_server");
	return $serveraddress = trim(implode("", $serveraddrfilearray));
}

function bh_detect_compression() {
	if (!extension_loaded("zlib") && !@dl("zlib.so") && !@dl("zlib.dll")) {
		return "none";
	} else {
		return "gz";
	}
}

# Taken from the wonderful php.net comments.
# Thanks to brausepaule at gmx dot de for this
function bh_remote_filesize($uri) {
	$url_p = parse_url ($uri);
	$host = $url_p['host'];
	
	if(isset ($url_p['port'])) {
		$remote_port = $url_p['port'];
	} else {
		$remote_port = 80;
	}
	
	$fp = @fsockopen ($host, $remote_port);
	if(!$fp) {
		return 0;
	} else {
		fputs($fp, 'HEAD '.$uri." HTTP/1.1\r\n");
		fputs($fp, 'HOST: '.$host."\r\n");
		fputs($fp, "Connection: close\r\n\r\n");
		$headers = '';
		while (!feof ($fp))
			$headers .= fgets ($fp, 128);
	}
	fclose ($fp);

	if (preg_match('/Content-Length:\s([0-9].+?)\s/', $headers, $matches)) {
		return $matches[1]; 
	} else {
		return 0; 
	}
}

class bhpackage {
	var $code;
	var $name;
	var $description;
	var $version;
	var $type;
	var $filepath;
	
	function bhpackage($identifier) {
		if (substr($identifier, 0, 7)=="file://") {
			$this->filepath = substr($identifier, 7);
			$this->loadfromfile();
		} else {
			$this->code = $identifier;
			$this->loadfromcode();
		}
	}
	
	function download() {
		global $bhconfig;
		
		if (bh_detect_compression() == "gz") { $fileext = ".tgz"; } else { $fileext = ".tar"; }
		
		$downloadto = $bhconfig['bhfilepath']."/cache/".$this->code.".bhpackage".$fileext;
		
		$downloadfrom = trim(implode(file(bh_packages_serveraddr()."?packagecode=".$this->code."&action=download")));
		
		# Download loop. We call the bh_download_progress function if it exists to let the user know about things.
		$to = fopen($downloadto, "w") or bh_die("error:cannot_write_to_package");
		$from = fopen($downloadfrom, "rb") or bh_die("error:cannot_download_package");
		$done = 0;
		$filesize = bh_remote_filesize($downloadfrom)
		while (!feof($from)) {
			$buffer = fread($from, 4096);
			$done += strlen($buffer); 
			if (function_exists("bh_download_progress")) { 
				($filesize != 0) ? bh_download_progress($done/$filesize); : bh_download_progress($done."B");
			}
			fwrite($to, $buffer, strlen($buffer));
			$buffer = NULL;
		}
		fclose($to); fclose($from);
	}

function updates_list() {
	# Will get a list of updates off of the ByteHoard server, and determine which ones are relevant.
	# First, find out where the server is from sf.net (this is in case we lose bytehoard.org someday)
	
	global $bhconfig;
	
	
	
	# Now, contact that server and get the updates list
	$updatesfilearray = file($serveraddress."?bhversion=".$bhcon);
	
	$packages = array();
	
	# The package file format is pkgname;description;version;type
	foreach ($updatesfilearray as $updatesfileline) {
		$linearray = explode(";", trim(substr($updatesfilearray, 1)));
		$packages[$linearray[0]] = array("name"=>$linearray[0], "description"=>$linearray[1], "version"=>$linearray[2], "type"=>$linearray[3]);
	}
	
	# Go through and see if there are any which we already have installed.
	foreach ($packages as $package) {
		if (empty(select_bhdb("packages", )));
	}
	
	return $packages;
}