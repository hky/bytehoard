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

$pagearray['title'] = $bhlang['install:title:bytehoard_installation']." :: ".$bhlang['install:title:test_database_configuration'];

$install_dbconf = $_POST['install_dbconf'];
$install_dbmod = $_GET['install_dbmod'];
$install_dbconf['dbmod'] = $install_dbmod;

$dbconfig = $install_dbconf;
require_once "../includes/db/".$dbconfig['dbmod'];
$result = test_bhdb($install_dbconf);

if ($result == true) {
	$pagearray['content'] = $bhlang['install:testdb:ok'];
	$pagearray['continue'] = 1;
} else {
	$pagearray['content'] = $bhlang['install:testdb:failed']."<br><br>".$dbmoderror;
}

return $pagearray;