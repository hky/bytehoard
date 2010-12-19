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

$pagearray['title'] = $bhlang['install:title:bytehoard_upgrade']." :: ".$bhlang['install:title:upgrading'];

require_once "upgrade/upgrades.def.php";
require_once "../config.inc.php";
require_once "../includes/db/".$dbconfig['dbmod'];

$upgradefrom = $_POST['upgradefrom'];
if (empty($upgradefrom)) { $upgradefrom = $_GET['upgradefrom']; }
if (empty($upgradefrom)) { $pagearray['content'] = $bhlang['install:error:no_upgradefrom']; return $pagearray; }
if (empty($upgradepath[$upgradefrom])) { $pagearray['content'] = $bhlang['install:error:invalid_upgradefrom']; return $pagearray; }

foreach ($upgradepath[$upgradefrom]['path'] as $num=>$name) {
	require "database/".$name.".inc.php";
}

$pagearray['content'] = $bhlang['install:upgrade:complete']."<br>";

if (!empty($bhlang['install:upgrade:specific:'.$upgradefrom])) {

	$pagearray['content'] = "<br><b>".$bhlang['install:upgrade:notes']."</b><br>";

}

return $pagearray;