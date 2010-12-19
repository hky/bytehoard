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

# 2.1a -> 2.1b

# Import filecodes into memory
$filecoderows = select_bhdb("filecodes", "", "");

# Remove old filecodes table
drop_bhdb("filecodes");

$insttables['modulesdirectory'] = array("module"=>array("type"=>"varchar"),
					"status"=>array("type"=>"varchar")		); 

$insttables['packages'] = array(	"code"=>array("type"=>"varchar"),
					"name"=>array("type"=>"varchar"),
					"description"=>array("type"=>"text"),
					"version"=>array("type"=>"varchar"),
					"type"=>array("type"=>"varchar")		); 

$insttables['passwordresets'] = array(	"username"=>array("type"=>"varchar"),
					"resetid"=>array("type"=>"varchar"),
					"time"=>array("type"=>"varchar")		);

$insttables['registrations'] = array(	"regid"=>array("type"=>"varchar"),
					"username"=>array("type"=>"varchar"),
					"password"=>array("type"=>"varchar"),
					"email"=>array("type"=>"text"),
					"fullname"=>array("type"=>"text"),
					"status"=>array("type"=>"varchar"),
					"regtime"=>array("type"=>"varchar")		); 
					
$insttables['filecodes'] = array(	"filecode"=>array("type"=>"varchar"),
					"filepath"=>array("type"=>"text"),
					"expires"=>array("type"=>"varchar"),
					"username"=>array("type"=>"varchar"),
					"email"=>array("type"=>"text")		);
	

# Add them
foreach ($insttables as $tablename=>$tablecontent) {
	$result = create_bhdb($tablename, $tablecontent);
	if ($result === FALSE) {
		$errors[] = $dbmoderror;
	}
}
	
# Right. Now add New Stuff (TM)
insert_bhdb("logactions", array("type"=>"BH_SIGNUP_VALIDATED", "action"=>"logtofile"));
insert_bhdb("logactions", array("type"=>"BH_SIGNUP_M_PENDING", "action"=>"emailtype", "parameters"=>"admin"));

insert_bhdb("modulesaccesslevel", array("module"=>"deletefolder", "accesslevel"=>"2", "status"=>"1"));
insert_bhdb("modulesaccesslevel", array("module"=>"deletefolder", "accesslevel"=>"3", "status"=>"1"));
insert_bhdb("modulesaccesslevel", array("module"=>"copyfolder", "accesslevel"=>"1", "status"=>"1"));
insert_bhdb("modulesaccesslevel", array("module"=>"copyfolder", "accesslevel"=>"2", "status"=>"1"));
insert_bhdb("modulesaccesslevel", array("module"=>"copyfolder", "accesslevel"=>"3", "status"=>"1"));
insert_bhdb("modulesaccesslevel", array("module"=>"sharing", "accesslevel"=>"3", "status"=>"1"));
insert_bhdb("modulesaccesslevel", array("module"=>"sharingfolder", "accesslevel"=>"3", "status"=>"1"));
insert_bhdb("modulesaccesslevel", array("module"=>"returntofolder", "accesslevel"=>"1", "status"=>"1"));
insert_bhdb("modulesaccesslevel", array("module"=>"returntofolder", "accesslevel"=>"2", "status"=>"1"));
insert_bhdb("modulesaccesslevel", array("module"=>"returntofolder", "accesslevel"=>"3", "status"=>"1"));
insert_bhdb("modulesfiletype", array("module"=>"sharing", "filetype"=>"*", "status"=>"1"));
insert_bhdb("modulesfiletype", array("module"=>"editdesc", "filetype"=>"*", "status"=>"1"));
insert_bhdb("modulesfiletype", array("module"=>"returntofolder", "filetype"=>"*", "status"=>"1"));
delete_bhdb("modulesfiletype", array("module"=>"move", "filetype"=>"*", "status"=>"1"));
insert_bhdb("modulesdirectory", array("module"=>"deletefolder", "status"=>"1"));
insert_bhdb("modulesdirectory", array("module"=>"copyfolder", "status"=>"1"));
insert_bhdb("modulesdirectory", array("module"=>"sharingfolder", "status"=>"1"));
insert_bhdb("adminmodulesmenu", array("module"=>"registrations", "menu"=>"page", "status"=>"1", "menuorder"=>"4"));
insert_bhdb("adminmodulesmenu", array("module"=>"appearance", "menu"=>"page", "status"=>"1", "menuorder"=>"5"));
insert_bhdb("modulesmenu", array("module"=>"passreset", "menu"=>"page", "status"=>"1", "menuorder"=>"8"));
insert_bhdb("modulesmenu", array("module"=>"options", "menu"=>"page", "status"=>"1", "menuorder"=>"50"));
insert_bhdb("modulesusertype", array("module"=>"passreset", "usertype"=>"guest", "status"=>"1"));
insert_bhdb("modulesusertype", array("module"=>"options", "usertype"=>"*", "status"=>"1"));
insert_bhdb("modulesusertype", array("module"=>"options", "usertype"=>"-guest", "status"=>"1"));
insert_bhdb("modulesusertype", array("module"=>"deletefolder", "usertype"=>"*", "status"=>"1"));
insert_bhdb("modulesusertype", array("module"=>"copyfolder", "usertype"=>"*", "status"=>"1"));
insert_bhdb("modulesusertype", array("module"=>"sharingfolder", "usertype"=>"*", "status"=>"1"));
insert_bhdb("modulesusertype", array("module"=>"returntofolder", "usertype"=>"*", "status"=>"1"));
insert_bhdb("aclpublic", array("filepath"=>"/", "status"=>"1"));
# 27/7/05: filelink
insert_bhdb("modulesaccesslevel", array("module"=>"filelink", "accesslevel"=>"3", "status"=>"1"));
insert_bhdb("modulesfiletype", array("module"=>"filelink", "filetype"=>"*", "status"=>"1"));
insert_bhdb("modulesusertype", array("module"=>"filelink", "usertype"=>"*", "status"=>"1"));
insert_bhdb("modulesusertype", array("module"=>"filelink", "usertype"=>"-guest", "status"=>"1"));
insert_bhdb("adminmodulesmenu", array("module"=>"filelinks", "menu"=>"page", "status"=>"1", "menuorder"=>"6"));

bh_changeconfig("signupmoderation", "1");
bh_changeconfig("profileoptions", "fullname,email");
bh_changeconfig("maxexpires", "60");
bh_changeconfig("lang", "en");
bh_changeconfig("authmodule", "bytehoard.inc.php");
bh_changeconfig("filesystemmodule", "filesystem");

# Correct them & add
foreach ($filecoderows as $key=>$filecoderow) {
	$filecoderow['username'] = "(none - from 2.1.a)";
	$filecoderow['email'] = "(none - from 2.1.a)";
	insert_bhdb("filecodes", $filecoderow);
}
