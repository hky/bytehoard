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

# Fresh BH 2.1g installation

$insttables['aclgroups'] = array(	"group"=>array("type"=>"varchar"),
					"filepath"=>array("type"=>"text"),
					"status"=>array("type"=>"varchar")		);

$insttables['aclpublic'] = array(	"filepath"=>array("type"=>"text"),
					"status"=>array("type"=>"varchar")		);
					
$insttables['aclusers'] = array(	"username"=>array("type"=>"varchar"),
					"filepath"=>array("type"=>"text"),
					"status"=>array("type"=>"varchar")		);

$insttables['adminmodulesmenu'] = array("module"=>array("type"=>"varchar"),
					"menu"=>array("type"=>"varchar"),
					"status"=>array("type"=>"varchar"),
					"menuorder"=>array("type"=>"varchar")		);

$insttables['bandwidth'] = array(	"username"=>array("type"=>"varchar"),
					"time"=>array("type"=>"varchar"),
					"type"=>array("type"=>"varchar"),
					"bytes"=>array("type"=>"varchar"),		);

$insttables['config'] = array(		"variable"=>array("type"=>"varchar"),
					"value"=>array("type"=>"text")			);

$insttables['filecodes'] = array(	"filecode"=>array("type"=>"varchar"),
					"filepath"=>array("type"=>"text"),
					"expires"=>array("type"=>"varchar"),
					"username"=>array("type"=>"varchar"),
					"email"=>array("type"=>"text"),
					"notify"=>array("type"=>"varchar")		);

$insttables['filecodereminders'] = array("filecode"=>array("type"=>"varchar"),
					"remindat"=>array("type"=>"varchar")		);

$insttables['groupusers'] = array(	"username"=>array("type"=>"varchar"),
					"group"=>array("type"=>"varchar"),
					"status"=>array("type"=>"varchar"),		);

$insttables['log'] = array(		"entryid"=>array("type"=>"varchar"),
					"time"=>array("type"=>"varchar"),
					"username"=>array("type"=>"varchar"),
					"ip"=>array("type"=>"varchar"),
					"type"=>array("type"=>"varchar"),
					"page"=>array("type"=>"text"),
					"filepath"=>array("type"=>"text"),
					"data"=>array("type"=>"text")		);

$insttables['logactions'] = array(	"type"=>array("type"=>"varchar"),
					"action"=>array("type"=>"varchar"),
					"parameters"=>array("type"=>"text")		);

$insttables['metadata'] = array(	"filepath"=>array("type"=>"text"),
					"metaname"=>array("type"=>"varchar"),
					"metacontent"=>array("type"=>"text")		);

$insttables['modules'] = array(		"module"=>array("type"=>"varchar"),
					"file"=>array("type"=>"varchar"),
					"name"=>array("type"=>"varchar"),
					"description"=>array("type"=>"text"),
					"author"=>array("type"=>"varchar")		);

$insttables['modulesaccesslevel'] = array("module"=>array("type"=>"varchar"),
					"accesslevel"=>array("type"=>"varchar"),
					"status"=>array("type"=>"varchar")		);

$insttables['modulesdirectory'] = array("module"=>array("type"=>"varchar"),
					"status"=>array("type"=>"varchar")		);

$insttables['modulesfiletype'] = array(	"module"=>array("type"=>"varchar"),
					"filetype"=>array("type"=>"varchar"),
					"status"=>array("type"=>"varchar")		);

$insttables['modulesmenu'] = array(	"module"=>array("type"=>"varchar"),
					"menu"=>array("type"=>"varchar"),
					"status"=>array("type"=>"varchar"),
					"menuorder"=>array("type"=>"varchar")		);

$insttables['modulesusertype'] = array(	"module"=>array("type"=>"varchar"),
					"usertype"=>array("type"=>"varchar"),
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

$insttables['satellitetransfers'] = array("transferid"=>array("type"=>"varchar"),
					"file"=>array("type"=>"text"),
					"offset"=>array("type"=>"varchar"),
					"length"=>array("type"=>"varchar")		);

$insttables['texts'] = array(		"textname"=>array("type"=>"varchar"),
					"textbody"=>array("type"=>"text")		);

$insttables['uploads'] = array(		"sessionid"=>array("type"=>"varchar"),
					"status"=>array("type"=>"varchar")		);

$insttables['userinfo'] = array(	"username"=>array("type"=>"varchar"),
					"itemname"=>array("type"=>"varchar"),
					"itemcontent"=>array("type"=>"text"),
					"type"=>array("type"=>"varchar")		);

$insttables['users'] = array(		"username"=>array("type"=>"varchar"),
					"password"=>array("type"=>"varchar"),
					"homedir"=>array("type"=>"text"),
					"type"=>array("type"=>"varchar"),
					"disabled"=>array("type"=>"varchar"),
					"quota"=>array("type"=>"varchar")		);

$insttables['usersviews'] = array(	"username"=>array("type"=>"varchar"),
					"filepath"=>array("type"=>"text"),
					"view"=>array("type"=>"varchar")		);

# Add them
foreach ($insttables as $tablename=>$tablecontent) {
	$result = create_bhdb($tablename, $tablecontent);
	if ($result === FALSE) {
		$errors[] = $dbmoderror;
	}
}

	bh_changeconfig("layout", "horizon");
	bh_changeconfig("skin", "horizonblue");
	bh_changeconfig("usetrash", "1");
	bh_changeconfig("limitthumbs", "1");
	bh_changeconfig("sitename", "ByteHoard");
	bh_changeconfig("siteslogan", "");
	bh_changeconfig("signupmoderation", "1");
	bh_changeconfig("profileoptions", "fullname,email");
	bh_changeconfig("maxexpires", "60");
	bh_changeconfig("lang", "en");
	bh_changeconfig("authmodule", "bytehoard.inc.php");
	bh_changeconfig("filesystemmodule", "filesystem");
	bh_changeconfig("signupdisabled", "0");
	bh_changeconfig("fromemail", 'do_not_reply@'.$_SERVER['SERVER_NAME']);
	
	if (bhi_check_imagemagick() == TRUE) {
		bh_changeconfig("imageprog", "imagemagick");
		bh_changeconfig("syspath_convert", "convert");
	} elseif (bhi_check_gd() == TRUE) {
		bh_changeconfig("imageprog", "gd");
	}
	
	bh_changeconfig("bhfilepath", realpath("../"));

# LOGACTIONS
	insert_bhdb("logactions", array("type"=>"BH_ERROR", "action"=>"onscreen", "parameters"=>"error"));
	insert_bhdb("logactions", array("type"=>"BH_WARNING", "action"=>"onscreen", "parameters"=>"warning"));
	insert_bhdb("logactions", array("type"=>"BH_NOTICE", "action"=>"onscreen", "parameters"=>"notice"));
	insert_bhdb("logactions", array("type"=>"BH_ONSCREEN", "action"=>"onscreen", "parameters"=>"warning"));
	insert_bhdb("logactions", array("type"=>"BH_LOGOUT", "action"=>"logtofile"));
	insert_bhdb("logactions", array("type"=>"BH_LOGIN_SUCCESS", "action"=>"logtofile"));
	insert_bhdb("logactions", array("type"=>"BH_LOGIN_FAILURE", "action"=>"logtofile"));
	insert_bhdb("logactions", array("type"=>"BH_FILE_UPLOAD", "action"=>"logtofile"));
	insert_bhdb("logactions", array("type"=>"BH_ACCESS_DENIED", "action"=>"logtofile"));
	insert_bhdb("logactions", array("type"=>"BH_FOLDER_CREATED", "action"=>"logtofile"));
	insert_bhdb("logactions", array("type"=>"BH_FILE_COPIED", "action"=>"logtofile"));
	insert_bhdb("logactions", array("type"=>"BH_FILE_MODIFIED", "action"=>"logtofile"));
	insert_bhdb("logactions", array("type"=>"BH_FILE_MOVED", "action"=>"logtofile"));
	insert_bhdb("logactions", array("type"=>"BH_SIGNUP", "action"=>"logtofile"));
	insert_bhdb("logactions", array("type"=>"BH_SIGNUP_VALIDATED", "action"=>"logtofile"));
	insert_bhdb("logactions", array("type"=>"BH_SIGNUP_M_PENDING", "action"=>"emailtype", "parameters"=>"admin"));
	
# MODULESACCESSLEVEL
	insert_bhdb("modulesaccesslevel", array("module"=>"delete", "accesslevel"=>"2", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"delete", "accesslevel"=>"3", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"deletefolder", "accesslevel"=>"2", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"deletefolder", "accesslevel"=>"3", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"download", "accesslevel"=>"1", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"download", "accesslevel"=>"2", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"download", "accesslevel"=>"3", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"viewdir", "accesslevel"=>"1", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"viewdir", "accesslevel"=>"2", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"viewdir", "accesslevel"=>"3", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"viewfile", "accesslevel"=>"1", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"viewfile", "accesslevel"=>"2", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"viewfile", "accesslevel"=>"3", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"edit", "accesslevel"=>"2", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"edit", "accesslevel"=>"3", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"htmledit", "accesslevel"=>"2", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"htmledit", "accesslevel"=>"3", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"copy", "accesslevel"=>"1", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"copy", "accesslevel"=>"2", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"copy", "accesslevel"=>"3", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"copyfolder", "accesslevel"=>"1", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"copyfolder", "accesslevel"=>"2", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"copyfolder", "accesslevel"=>"3", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"sharing", "accesslevel"=>"3", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"sharingfolder", "accesslevel"=>"3", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"editdesc", "accesslevel"=>"3", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"returntofolder", "accesslevel"=>"1", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"returntofolder", "accesslevel"=>"2", "status"=>"1"));
	insert_bhdb("modulesaccesslevel", array("module"=>"returntofolder", "accesslevel"=>"3", "status"=>"1"));
	
	
# MODULESFILETYPE
	insert_bhdb("modulesfiletype", array("module"=>"delete", "filetype"=>"*", "status"=>"1"));
	insert_bhdb("modulesfiletype", array("module"=>"download", "filetype"=>"*", "status"=>"1"));
	insert_bhdb("modulesfiletype", array("module"=>"edit", "filetype"=>"application/x-empty", "status"=>"1"));
	insert_bhdb("modulesfiletype", array("module"=>"edit", "filetype"=>"text/plain", "status"=>"1"));
	insert_bhdb("modulesfiletype", array("module"=>"edit", "filetype"=>"text/x-c", "status"=>"1"));
	insert_bhdb("modulesfiletype", array("module"=>"htmledit", "filetype"=>"text/html", "status"=>"1"));
	insert_bhdb("modulesfiletype", array("module"=>"htmledit", "filetype"=>"text/x-html", "status"=>"1"));
	insert_bhdb("modulesfiletype", array("module"=>"htmledit", "filetype"=>"html", "status"=>"1"));
	insert_bhdb("modulesfiletype", array("module"=>"htmledit", "filetype"=>"htm", "status"=>"1"));
	insert_bhdb("modulesfiletype", array("module"=>"copy", "filetype"=>"*", "status"=>"1"));
	insert_bhdb("modulesfiletype", array("module"=>"sharing", "filetype"=>"*", "status"=>"1"));
	insert_bhdb("modulesfiletype", array("module"=>"editdesc", "filetype"=>"*", "status"=>"1"));
	insert_bhdb("modulesfiletype", array("module"=>"returntofolder", "filetype"=>"*", "status"=>"1"));
	
# MODULESDIRECTORY
	insert_bhdb("modulesdirectory", array("module"=>"deletefolder", "status"=>"1"));
	insert_bhdb("modulesdirectory", array("module"=>"copyfolder", "status"=>"1"));
	insert_bhdb("modulesdirectory", array("module"=>"sharingfolder", "status"=>"1"));
	
# ADMINMODULESMENU
	insert_bhdb("adminmodulesmenu", array("module"=>"main", "menu"=>"page", "status"=>"1", "menuorder"=>"1"));
	insert_bhdb("adminmodulesmenu", array("module"=>"users", "menu"=>"page", "status"=>"1", "menuorder"=>"3"));
	insert_bhdb("adminmodulesmenu", array("module"=>"settings", "menu"=>"page", "status"=>"1", "menuorder"=>"2"));
	insert_bhdb("adminmodulesmenu", array("module"=>"registrations", "menu"=>"page", "status"=>"1", "menuorder"=>"5"));
	insert_bhdb("adminmodulesmenu", array("module"=>"appearance", "menu"=>"page", "status"=>"1", "menuorder"=>"6"));
	insert_bhdb("adminmodulesmenu", array("module"=>"adduser", "menu"=>"page", "status"=>"1", "menuorder"=>"7"));
	insert_bhdb("adminmodulesmenu", array("module"=>"groups", "menu"=>"page", "status"=>"1", "menuorder"=>"4"));
	insert_bhdb("adminmodulesmenu", array("module"=>"return", "menu"=>"page", "status"=>"1", "menuorder"=>"90"));
	insert_bhdb("adminmodulesmenu", array("module"=>"logout", "menu"=>"page", "status"=>"1", "menuorder"=>"99"));
	
# MODULESMENU
	insert_bhdb("modulesmenu", array("module"=>"main", "menu"=>"page", "status"=>"1", "menuorder"=>"1"));
	insert_bhdb("modulesmenu", array("module"=>"login", "menu"=>"page", "status"=>"1", "menuorder"=>"2"));
	insert_bhdb("modulesmenu", array("module"=>"logout", "menu"=>"page", "status"=>"1", "menuorder"=>"99"));
	insert_bhdb("modulesmenu", array("module"=>"find", "menu"=>"page", "status"=>"1", "menuorder"=>"30"));
	insert_bhdb("modulesmenu", array("module"=>"upload", "menu"=>"page", "status"=>"1", "menuorder"=>"5"));
	insert_bhdb("modulesmenu", array("module"=>"addfolder", "menu"=>"page", "status"=>"1", "menuorder"=>"10"));
	insert_bhdb("modulesmenu", array("module"=>"signup", "menu"=>"page", "status"=>"1", "menuorder"=>"6"));
	insert_bhdb("modulesmenu", array("module"=>"passreset", "menu"=>"page", "status"=>"1", "menuorder"=>"8"));
	insert_bhdb("modulesmenu", array("module"=>"options", "menu"=>"page", "status"=>"1", "menuorder"=>"50"));
	insert_bhdb("modulesmenu", array("module"=>"admin", "menu"=>"page", "status"=>"1", "menuorder"=>"90"));

# MODULESUSERTYPE
	insert_bhdb("modulesusertype", array("module"=>"main", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"login", "usertype"=>"guest", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"logout", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"logout", "usertype"=>"-guest", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"viewdir", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"addfolder", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"download", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"delete", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"addfolder", "usertype"=>"-guest", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"viewfile", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"viewfolder", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"upload", "usertype"=>"-guest", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"choosefolder", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"upload", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"edit", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"htmledit", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"copy", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"sharing", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"signup", "usertype"=>"guest", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"editdesc", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"passreset", "usertype"=>"guest", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"options", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"options", "usertype"=>"-guest", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"deletefolder", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"copyfolder", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"sharingfolder", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"returntofolder", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"admin", "usertype"=>"admin", "status"=>"1"));

# USERS (GUEST USER)
	insert_bhdb("users", array("username"=>"guest", "password"=>"", "homedir"=>"/", "type"=>"guest"));
	insert_bhdb("aclpublic", array("filepath"=>"/", "status"=>"1"));

# 27/7/05: filelink
	insert_bhdb("modulesaccesslevel", array("module"=>"filelink", "accesslevel"=>"3", "status"=>"1"));
	insert_bhdb("modulesfiletype", array("module"=>"filelink", "filetype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"filelink", "usertype"=>"*", "status"=>"1"));
	insert_bhdb("modulesusertype", array("module"=>"filelink", "usertype"=>"-guest", "status"=>"1"));
	insert_bhdb("adminmodulesmenu", array("module"=>"filelinks", "menu"=>"page", "status"=>"1", "menuorder"=>"6"));