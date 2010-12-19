<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: users.inc.php,v 1.2 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
#name Types List
#author Andrew Godwin
#description Displays a list of groups, and lets you add users to them.
#iscore 1

$layout = new bhadminlayout("typeslist");

if (empty($_POST)) { $_POST = array(); } 
if (empty($_GET)) { $_GET = array(); } 
$type = array_merge($_POST, $_GET); 

function loadtypes() {
	global $bhconfig, $types;
	
	if (empty($bhconfig['types'])) {
		$typeslist = array();
	} else {
		$typeslist = explode(";;;", $bhconfig['types']);
	}
	
	$types = array();
	
	foreach ($typeslist as $typesection) {
		$ts = explode("@@@", $typesection);
		$types[$ts[0]] = $ts[1];
	}
}

loadtypes();

function savetypes($types) {
	global $bhconfig;
	$str = "";
	foreach ($types as $name=>$type) {
		$str .= $name."@@@".$type.";;;";
	}
	$str = substr($str, 0, -3);
	bh_changeconfig("types", $str);
}

if ($type['action'] == "add") {
	if ((empty($type['name'])) || (empty($type['size']))) {
		bh_add_error($bhlang['error:missed_something']);
		require "error.inc.php";
		return;
	}
	$types[$type['name']] = ((1024*1024) * $type['size']);
	savetypes($types);
	
	bh_log($bhlang['notice:type_updated'], "BH_NOTICE");
}

if ($type['action'] == "remove") {
	if (empty($type['name'])) {
		bh_add_error($bhlang['error:missed_something']);
		require "error.inc.php";
		return;
	}
	unset($types[$type['name']]);
	savetypes($types);
}

$layout->content1 = $types;
$layout->title = $bhlang['title:types_administration'];
$layout->display();
