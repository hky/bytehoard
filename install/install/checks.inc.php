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

$pagearray['title'] = $bhlang['install:title:bytehoard_installation']." :: ".$bhlang['install:title:systemchecks'];

$pcrecheck = bhi_check_pcre();
$safemodecheck = bhi_check_safe_mode();
$phpcheck = bhi_check_php();

$imagesystems += $gdcheck = bhi_check_gd();
$imagesystems += $imcheck = bhi_check_imagemagick();

$cipcheck = bhi_check_permissions("../config.inc.php");
$cachecheck = bhi_check_permissions("../cache/writetest");

$pagearray['content'] = $bhlang['install:text:checking_system']."<br><br><b>".$bhlang['install:label:php']."</b><br>".$bhlang['install:check:php'];

if ($phpcheck == false) {
	$pagearray['content'] .= "<span class='failed'>".$bhlang['install:check:failedphp']."</span>";
	$fatals += 1;
} elseif ($phpcheck == 5) {
	$pagearray['content'] .= "<span class='failedoption'>".$bhlang['install:check:php5']."</span>";
	$warnings += 1;
} elseif ($phpcheck == 4) {
	$pagearray['content'] .= "<span class='passed'>".$bhlang['install:check:ok']."</span>";
} else {
	$pagearray['content'] .= "<span class='failed'>".$bhlang['install:check:failedphp']."</span>";
	$fatals += 1;
}

$pagearray['content'] .= "<br>".$bhlang['install:check:safe_mode'];

if ($safemodecheck == false) {
	$pagearray['content'] .= "<span class='failed'>".$bhlang['install:check:failedsafemode']."</span>";
	$warnings += 1;
} elseif ($safemodecheck == true) {
	$pagearray['content'] .= "<span class='passed'>".$bhlang['install:check:ok']."</span>";
} 

$pagearray['content'] .= "<br><br><b>".$bhlang['install:label:extensions']."</b><br>".$bhlang['install:check:pcre'];

if ($pcrecheck == false) {
	$pagearray['content'] .= "<span class='failed'>".$bhlang['install:check:failed']."</span>";
	$fatals += 1;
} elseif ($pcrecheck == true) {
	$pagearray['content'] .= "<span class='passed'>".$bhlang['install:check:ok']."</span>";
} 

$pagearray['content'] .= "<br>".$bhlang['install:check:gd'];

if ($gdcheck == false) {
	$pagearray['content'] .= "<span class='failedoption'>".$bhlang['install:check:failedoption']."</span>";
	$warnings += 1;
} elseif ($gdcheck == true) {
	$pagearray['content'] .= "<span class='passed'>".$bhlang['install:check:ok']."</span>";
} 

$pagearray['content'] .= "<br><br><b>".$bhlang['install:label:external_progs']."</b><br>".$bhlang['install:check:imagemagick'];

if ($imcheck == false) {
	$pagearray['content'] .= "<span class='failedoption'>".$bhlang['install:check:failedoption']."</span>";
	$warnings += 1;
} elseif ($imcheck == true) {
	$pagearray['content'] .= "<span class='passed'>".$bhlang['install:check:ok']."</span>";
} 

$pagearray['content'] .= "<br><br><b>".$bhlang['install:label:filesystem']."</b><br>".$bhlang['install:check:config.inc.php'];

if ($cipcheck == false) {
	$pagearray['content'] .= "<span class='failedoption'>".$bhlang['install:check:failedperm']."</span>";
	$fatals += 1;
} elseif ($cipcheck == true) {
	$pagearray['content'] .= "<span class='passed'>".$bhlang['install:check:ok']."</span>";
}  

$pagearray['content'] .= "<br>".$bhlang['install:check:cache'];

if ($cachecheck == false) {
	$pagearray['content'] .= "<span class='failedoption'>".$bhlang['install:check:failedperm']."</span>";
	$fatals += 1;
} elseif ($cachecheck == true) {
	$pagearray['content'] .= "<span class='passed'>".$bhlang['install:check:ok']."</span>";
} 

$pagearray['content'] .= "<br><br>";

if ($imagesystems < 1) { $pagearray['content'] .= $bhlang['install:text:thumbnails_disabled']."<br><br>"; }

if ($fatals > 0) {
	$pagearray['content'] .= $bhlang['install:text:checksfatals'];
} elseif ($warnings > 0) {
	$pagearray['content'] .= $bhlang['install:text:checkswarnings'];
	$pagearray['continue'] = 1;
} else {
	$pagearray['content'] .= $bhlang['install:text:checksok'];
	$pagearray['continue'] = 1;
}


return $pagearray;