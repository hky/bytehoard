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

$pagearray['title'] = $bhlang['install:title:bytehoard_installation']." :: ".$bhlang['install:title:complete'];

require_once "../config.inc.php";
require_once "../includes/db/".$dbconfig['dbmod'];
require_once "../includes/filesystem/filesystem/filesystem.inc.php";
require_once "../includes/users.inc.php";
require_once "../includes/configfunc.inc.php";



$pagearray['content'] = $bhlang['install:finish:explain']."<br><br>".$bhlang['install:finish:label:url']." <a href='".$bhconfig['baseuri']."'>".$bhconfig['baseuri']."</a><br>".$bhlang['install:finish:label:adminurl']." <a href='".$bhconfig['baseuri']."/administrator/'>".$bhconfig['baseuri']."/administrator/</a>";

return $pagearray;