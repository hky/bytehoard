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

$pagearray['title'] = $bhlang['install:title:bytehoard_installation']." :: ".$bhlang['install:title:set_paths'];

# Get miscellaneous include
require_once "../includes/misc.inc.php";

$pagearray['content'] = $bhlang['install:paths:intro']."
<br><br>
<form action='index.php?page=install_complete' method='POST'>
<table><tr><td>".$bhlang['install:paths:system_url']."</td><td><input type='textbox' name='install[baseuri]' value='".bh_get_weburi()."' size='50'></td></tr>
<tr><td>".$bhlang['install:paths:file_storage_directory']."</td><td><input type='textbox' name='install[fileroot]' value='filestorage/' size='50'></td></tr>
<tr><td colspan='2'><input type='submit' value='".$bhlang['button:save_settings']."'></td></tr></table></form>";


return $pagearray;