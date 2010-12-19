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

$pagearray['title'] = $bhlang['install:title:bytehoard_installation']." :: ".$bhlang['install:title:save_paths'];

require_once "../config.inc.php";
require_once "../includes/db/".$dbconfig['dbmod'];

$fileroot = $_POST['install']['fileroot'];
$baseuri = $_POST['install']['baseuri'];

if ((empty($baseuri)) || (strpos($baseuri,"://") === FALSE) || (substr($baseuri, -1) != "/")) {
	$pagearray['content'] = $bhlang['install:savepaths:error_baseuri'];
} elseif (empty($fileroot)) {
	$pagearray['content'] = $bhlang['install:savepaths:error_fileroot'];
} else {
	bh_changeconfig("fileroot", $fileroot);
	bh_changeconfig("baseuri", $baseuri);
	$pagearray['content'] = $bhlang['install:savepaths:message'];
	$pagearray['continue'] = 1;
}

return $pagearray;