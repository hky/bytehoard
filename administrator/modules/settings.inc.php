<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: settings.inc.php,v 1.2 2005/07/26 21:55:08 andrewgodwin Exp $
 *
 */
 
#name Settings
#author Andrew Godwin
#description Displays the settings page.
#iscore 1

if (!empty($_POST['bhconfig'])) {
	$newbhconfig = $_POST['bhconfig'];
	foreach ($newbhconfig as $newvar=>$newval) {
		if ($newvar == "fileroot") { if (substr($newval, -1) == "/") { $newval = substr($newval, 0, -1); }}
		bh_changeconfig($newvar, $newval);
	}
	bh_loadconfig();
	bh_log($bhlang['notice:settings_saved'], "BH_NOTICE");
}

if (!empty($_GET['bhconfig'])) {
	$newbhconfig = $_GET['bhconfig'];
	foreach ($newbhconfig as $newvar=>$newval) {
		if ($newvar == "fileroot") { if (substr($newval, -1) == "/") { $newval = substr($newval, 0, -1); }}
		bh_changeconfig($newvar, $newval);
	}
	bh_loadconfig();
	bh_log($bhlang['notice:settings_saved'], "BH_NOTICE");
}

$layoutobj = new bhadminlayout("settings");
$layoutobj->content1 = $bhconfig;
$layoutobj->title = $bhlang['title:settings'];
$layoutobj->display();