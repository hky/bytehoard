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

$pagearray['title'] = $bhlang['install:title:bytehoard_installation']." :: ".$bhlang['install:title:save_database_configuration'];

$install_dbconf = $_POST['install_dbconf'];
$install_dbmod = $_GET['install_dbmod'];
$install_dbconf['dbmod'] = $install_dbmod;

$result = bhi_write_config_file($install_dbconf);

if ($result == true) {
	$pagearray['content'] = $bhlang['install:writeconfig:saved'];
	$pagearray['continue'] = 1;
} else {
	$pagearray['content'] = $bhlang['install:writeconfig:not_saved'];
}

return $pagearray;