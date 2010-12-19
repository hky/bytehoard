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

$pagearray['title'] = $bhlang['install:title:bytehoard_installation']." :: ".$bhlang['install:title:init_database'];

require_once "../config.inc.php";
require_once "../includes/db/".$dbconfig['dbmod'];

require "database/fresh_2.1.g.inc.php";

$pagearray['content'] = $bhlang['install:initdb:database_initialised'];

return $pagearray;