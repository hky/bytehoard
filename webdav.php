<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   webdav.php
 *   $Id$
 *
 */


# WebDAV Server file
define("IN_BH", 1);

# Get includes
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
require "includes/bandwidth.inc.php";				# Bandwidth functions


require "includes/webdav/server.php";

class webdav extends HTTP_WebDAV_Server {

	# Constructor - Initialises settings, etc.
	function webdav() {
		global $bhconfig;
	
		parent::HTTP_WebDAV_Server();
		$this->http_auth_realm = $bhconfig['sitename'];
	}
	
	function check_auth($type, $username, $password) {
		global $bhconfig, $bhcurrent, $bhsession;
		
		$bhcurrent['in_webdav'] = 1;
		
		if (bh_authenticate($username, $password) == false) {
			$bhcurrent['username'] = "guest";
			$bhsession['username'] = "guest";
			$bhcurrent['usertype'] = "guest";
			return false;
		} else {
			$bhcurrent['username'] = $username;
			$bhsession['username'] = $username;
			$bhcurrent['userobj'] = new bhuser($username);
			$bhcurrent['usertype'] = $bhcurrent['userobj']->type;
			return true;
		}
	}
	
	function GET(&$options) {
		global $bhsession;
	
		$fileexist = bh_user_file_exists($options['path']);
		
		if (!$fileexist) {
			return "404 Not found";
		}
	
		$fileobj = new bhfile($options['path']);
		$options['path'] = $options['path'];
		if ($fileobj->is_dir() == 1) {
			$options['mimetype'] = "directory";
		} else {
			$options['mimetype'] = $fileobj->mimetype();
		}
		$options['mtime'] = $fileobj->fileinfo['createdate'];
		$options['size'] = $fileobj->fileinfo['filesize'];
		$options['stream'] = $fileobj->filestream();
		
		
		return true;
	}
	
	function PUT(&$options) {
		global $bhsession;
	
		#$fn = fopen("wdlog", "w");
		#fwrite($fn, print_r($options, true));
		#fclose($fn);
		
		$newfilepath = bh_fpclean($options['path']);
		
		if (bh_checkrights(bh_get_parent($newfilepath), $bhsession['username']) >= 2) {
		
			$newfileobj = new bhfile($newfilepath);
			$newfileobj->filefromstream($options['stream']);
			return '201 Created';
		
		} else {
		
			$newfileobj = new bhfile($newfilepath);
			$newfileobj->filefromstream($options['stream']);
			return '201 Created';
		
		}
		
	}
	
	function DELETE(&$options) {
		global $bhsession;
		
		$fileexist = bh_user_file_exists($options['path']);
		a($options['path']);
		if (!$fileexist) {
			return "404 Not found";
		}
		
		$fileobj = new bhfile($options['path']);
		$fileobj->smartdeletefile();
		
		return "204 No Content";
	}
	
	function MKCOL(&$options) {
		global $bhsession;
		
		$filepath = bh_fpclean($options['path']);
		
		$infolder = bh_get_parent($filepath);
		
		if (bh_checkrights(bh_fpclean($infolder), $bhsession['username']) >= 2) {
			bh_mkdir($filepath);
			$fileobj = new bhfile($filepath);
			unset($fileobj);
			
			return "201 Created";
		} else {
			return "403 Forbidden";
		}
	}
	
	function MOVE(&$options) {
		global $bhsession;
		
		$destfilepath = bh_fpclean($options['dest']);
		$filepath = bh_fpclean($options['path']);
		$infolder = bh_get_parent($destfilepath);
		$fileexist = bh_user_file_exists($filepath);
		
		if (!$fileexist) { return "404 Not Found"; }
		if (bh_checkrights(bh_fpclean($infolder), $bhsession['username']) <= 1) { a($infolder); return "403 Forbidden"; }
		
		$fileobj = new bhfile($filepath);
		$fileobj->copyto($destfilepath);
		$fileobj->smartdeletefile();
		
		return "201 Created";
	
	}
	
	function COPY(&$options) {
		global $bhsession;
	
		
		$destfilepath = bh_fpclean($options['dest']);
		$filepath = bh_fpclean($options['path']);
		$infolder = bh_get_parent($destfilepath);
		$fileexist = bh_user_file_exists($filepath);
		
		if (!$fileexist) { return "404 Not Found"; }
		if (bh_checkrights(bh_fpclean($infolder), $bhsession['username']) <= 1) { return "403 Forbidden"; }
		
		$fileobj = new bhfile($filepath);
		$fileobj->copyto($destfilepath);
		
		return "204 No Content";
	
	}
	
	function PROPFIND(&$options, &$files) {
		global $bhsession;
		
		$filepath = bh_fpclean($options['path']);
		$fileobj = new bhfile($filepath);
		$files['files'][] = $this->fileinfo($options['path']);
		
		if ($fileobj->is_dir() == 1) {
			$filelist = $fileobj->loadfile();
			foreach ($filelist as $afile) {
				$files['files'][] = $this->fileinfo($afile['filepath']);
			}
		}
		
		return "200 OK";
	}
	
	function fileinfo($filepath) {
		$return = array();
		$filepath = bh_fpclean($filepath);
		
		$fileobj = new bhfile($filepath);
		
		$filename = bh_get_filename($filepath);
		$return['path'] = utf8_encode($filepath);
		$return['props'][] = $this->mkprop("getdisplayname", $filepath);
		$return['props'][] = $this->mkprop("displayname", $filepath);
		$return['props'][] = $this->mkprop("creationdate", $fileobj->fileinfo['createdate']);
		if (!empty($fileobj->fileinfo['moddate'])) {
			$return['props'][] = $this->mkprop("getlastmodified", $fileobj->fileinfo['moddate']);
		} else {
			$return['props'][] = $this->mkprop("getlastmodified", $fileobj->fileinfo['createdate']);
		}
		$return['props'][] = $this->mkprop("getcontentlength", $fileobj->fileinfo['filesize']);
		if ($fileobj->is_dir() == 1) {
			$return['props'][] = $this->mkprop('getcontenttype', "directory");
			#$return['props'][] = $this->mkprop('contenttype', "directory");
			$return['props'][] = $this->mkprop('resourcetype', 'collection');
		} else {
			$return['props'][] = $this->mkprop('getcontenttype', $fileobj->mimetype());
			#$return['props'][] = $this->mkprop('contenttype', $fileobj->mimetype());
			$return['props'][] = $this->mkprop('resourcetype', '');
		}
		return $return;
		
	}
	
	
	
}

function a($a) { $fn = fopen('debuglog', 'a'); fputs($fn, "\n".time().":".$a); fclose($fn); };

$webdav = new webdav();
$webdav->ServeRequest();