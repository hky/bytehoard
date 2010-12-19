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

# 2.0.x -> 2.1g

# Write new configuration file
$dbconfig['dbmod'] = "mysql.inc.php";
$result = bhi_write_config_file($install_dbconf);

if ($result == false) {
	$pagearray['content'] = $bhlang['install:writeconfig:not_saved'];
	return $pagearray;
}

require "../config.inc.php";

# Import 7 old tables (useractivity, userconfig, comments, texts, logins have no counterpart, registrations won't match up and aren't really worth it)
$aclrows = select_bhdb("acl", "", "");
$aclgroupsrows = select_bhdb("aclgroups", "", "");
$aclusersrows = select_bhdb("aclusers", "", "");
$configrows = select_bhdb("config", "", "");
$filelinkrows = select_bhdb("filelink", "", "");
$groupusersrows = select_bhdb("groupusers", "", "");
$usersrows = select_bhdb("users", "", "");

# Drop 13 old tables
drop_bhdb("acl");
drop_bhdb("aclgroups");
drop_bhdb("aclusers");
drop_bhdb("config");
drop_bhdb("filelink");
drop_bhdb("groupusers");
drop_bhdb("registrations");
drop_bhdb("users");
drop_bhdb("useractivity");
drop_bhdb("userconfig");
drop_bhdb("comments");
drop_bhdb("texts");
drop_bhdb("logins");

# Create a fresh new 2.1 install
require "database/fresh_2.1.g.inc.php";

# Re-import old data

# acl: import owner data
foreach ($aclrows as $aclrow) {
	$newaclusersrow = array("username"=>$aclrow['owner'], "filepath"=>$aclrow['filepath'], "status"=>3);
	insert_bhdb("aclusers", $newaclusersrow);
}

# aclgroups: hahaha, exactly the same
foreach ($aclgroupsrows as $aclgroupsrow) {
	insert_bhdb("aclgroups", $aclgroupsrow);
}

# aclusers: again, the same. Skipping empty username entries, though, seems to be a bug in 2.0.
foreach ($aclusersrows as $aclusersrow) {
	if (!empty($aclusersrow['username'])) {
		insert_bhdb("aclusers", $aclusersrow);
	}
}

# config: only redoing pertinent values.
foreach ($configrows as $configrow) {
	switch ($configrow['variable']) {
		case "sitename":
			bh_changeconfig("sitename", $configrow['value']); break;
		case "sitedesc":
			bh_changeconfig("siteslogan", $configrow['value']); break;
		case "fromaddr":
			bh_changeconfig("fromemail", $configrow['value']); break;
		case "openreg":
			bh_changeconfig("signupmoderation", 1 - $configrow['value']); break;
		case "fileroot":
			bh_changeconfig("fileroot", $configrow['value']); break;
	}
}

# filelink: try to update these
foreach ($filelinkrows as $filelinkrow) {
	$filelinkrow['filecode'] = $filelinkrow['code']
	unset($filelinkrow['code']);
	$filelinkrow['email'] = "(none - from 2.0)";
	$filelinkrow['notify'] = "0";
	insert_bhdb("filecodes", filelinkrow);
}

# groupusers: just add a status field
foreach ($groupusersrows as $groupusersrow) {
	$groupusersrow['status'] = 1;
	insert_bhdb("groupusers", $groupusersrow);
}

# users: make new users row and put extra info in userinfo.
foreach ($usersrows as $usersrow) {
	if ($usersrow['type'] == 3) { $type = "admin"; } else { $type = "normal"; }
	$newusersrow = array("username"=>$usersrow['username'], "password"=>$usersrow['password'], "homedir"=>"/".$usersrow['username'], "type"=>$type, "disabled"=>"0");
	insert_bhdb("users", $newusersrow);
	
	insert_bhdb("userinfo", array("username"=>$usersrow['username'], "itemname"=>"email", "itemcontent"=>=>$usersrow['email']));
	insert_bhdb("userinfo", array("username"=>$usersrow['username'], "itemname"=>"fullname", "itemcontent"=>=>$usersrow['fullname']));
}

# Done. Phew.
