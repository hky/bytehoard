<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Installer2 - Database Script File
 *   $Id$
 *
 */

# Database scripts expect the following:
#  - $dbconfig (config.inc.php) loaded
#  - All bhdb_* functions loaded
#  - configfunc.inc.php loaded

# 2.1b -> 2.1g

# Import filecodes and users into memory
$filecoderows = select_bhdb("filecodes", "", "");
$userrows = select_bhdb("users", "", "");

# Remove old tables
drop_bhdb("filecodes");
drop_bhdb("users");

$insttables['filecodes'] = array(	"filecode"=>array("type"=>"varchar"),
					"filepath"=>array("type"=>"text"),
					"expires"=>array("type"=>"varchar"),
					"username"=>array("type"=>"varchar"),
					"email"=>array("type"=>"text"),
					"notify"=>array("type"=>"varchar")		);

$insttables['log'] = array(		"entryid"=>array("type"=>"varchar"),
					"time"=>array("type"=>"varchar"),
					"username"=>array("type"=>"varchar"),
					"ip"=>array("type"=>"varchar"),
					"type"=>array("type"=>"varchar"),
					"page"=>array("type"=>"text"),
					"filepath"=>array("type"=>"text"),
					"data"=>array("type"=>"text")		);

$insttables['users'] = array(		"username"=>array("type"=>"varchar"),
					"password"=>array("type"=>"varchar"),
					"homedir"=>array("type"=>"text"),
					"type"=>array("type"=>"varchar"),
					"disabled"=>array("type"=>"varchar"),
					"quota"=>array("type"=>"varchar")		);

$insttables['filecodereminders'] = array("filecode"=>array("type"=>"varchar"),
					"remindat"=>array("type"=>"varchar")		);

$insttables['satellitetransfers'] = array("transferid"=>array("type"=>"varchar"),
					"file"=>array("type"=>"text"),
					"offset"=>array("type"=>"varchar"),
					"length"=>array("type"=>"varchar")		);
	

# Add them
foreach ($insttables as $tablename=>$tablecontent) {
	$result = create_bhdb($tablename, $tablecontent);
	if ($result === FALSE) {
		$errors[] = $dbmoderror;
	}
}

# Correct them & add
foreach ($filecoderows as $key=>$filecoderow) {
	$filecoderow['notify'] = 0;
	insert_bhdb("filecodes", $filecoderow);
}

foreach ($userrows as $key=>$userrow) {
	$userrow['disabled'] = 0;
	insert_bhdb("users", $userrow);
}


	insert_bhdb("adminmodulesmenu", array("module"=>"return", "menu"=>"page", "status"=>"1", "menuorder"=>"90"));
	insert_bhdb("modulesusertype", array("module"=>"admin", "usertype"=>"admin", "status"=>"1"));
	insert_bhdb("modulesmenu", array("module"=>"admin", "menu"=>"page", "status"=>"1", "menuorder"=>"90"));
	insert_bhdb("adminmodulesmenu", array("module"=>"groups", "menu"=>"page", "status"=>"1", "menuorder"=>"4"));
