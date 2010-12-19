<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: download.inc.php,v 1.5 2005/07/26 21:55:09 andrewgodwin Exp $
 *
 */
 
#name Download
#author Andrew Godwin
#description Sends the file to the client.
#iscore 1

# Note: no layouts here, of course. Unless we get an error.

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }


$filepath = bh_fpclean($_GET['filepath']);
$filename = bh_get_filename($filepath);

if (bh_file_exists($filepath) == true) {
	$fileobj = new bhfile($filepath);
	#if ($fileobj->fileinfo['size'] == 0) {
	#	bh_log($bhlang['error:file_not_exist'], "BH_NOPAGE");
	#	require "modules/error.inc.php";
	#} else {
		# Log bandwidth usage. New feature, for those who like Absolute Control(tm). This comment shamelessly copied from upload.inc.php.
		bh_bandwidth($bhsession['username'], "down", $fileobj->fileinfo['filesize']);
		
		header("Content-type: ".$fileobj->mimetype());
		
		# If there's a Secret Message from the view image script not to include download headers, don't.
		
		if ($_GET['nodownheaders'] == 1) {
			header("Content-Disposition:  filename=".$filename);
		} else {
			header("Content-Disposition: attachment; filename=".$filename);
		}
		
		header("Content-length: ".$fileobj->fileinfo['filesize']);
		# IE SSL fix
		header("Pragma: ");
		header("Cache-Control: ");
		$fileobj->readfile();
	#}
} else {
	bh_log($bhlang['error:file_not_exist'], "BH_NOPAGE");
	require "modules/error.inc.php";
}