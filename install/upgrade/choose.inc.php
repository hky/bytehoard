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

$pagearray['title'] = $bhlang['install:title:bytehoard_upgrade']." :: ".$bhlang['install:title:choose_old_version'];

require_once "upgrade/upgrades.def.php";

$pagearray['content'] = $bhlang['install:upgrade:choose_text']."<br><br><form action='index.php?page=upgrade_do' method='POST'>
<table>\n";

foreach ($upgradepath as $id=>$apath) {
	$pagearray['content'] .= "<tr><td><input type='radio' name='upgradefrom' value='$id'></td><td>".$apath['name']."</td></tr>\n";
}

$pagearray['content'] .= "</table><input type='submit' value='".$bhlang['button:upgrade']."'></form>";

return $pagearray;