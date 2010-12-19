<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: appearance.inc.php,v 1.1 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
#name Appearance Module
#author Andrew Godwin
#description Lets you choose between skins.
#iscore 1

if (!empty($_GET['setskin'])) {
	bh_changeconfig("skin", $_GET['setskin']);
	bh_changeconfig("layout", $_GET['setlayout']);
	bh_log($bhlang['notice:skin_changed'], "BH_NOTICE");
	$bhconfig['skin'] = $_GET['setskin'];
	$bhconfig['layout'] = $_GET['setlayout'];
}

$layoutobj = new bhadminlayout("skinslist");

$skins = bh_getskins();
$layoutobj->content1 = $skins;
$layoutobj->content2 = $bhconfig['layout'].".".$bhconfig['skin'];
$layoutobj->title = $bhlang['title:appearance'];
$layoutobj->display();
