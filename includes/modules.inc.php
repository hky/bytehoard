<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module functions
 *   $Id: modules.inc.php,v 1.3 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
/*

module listers, permission checkers, etc.

*/

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

function bh_checkmodulepermission($module, $usertype) {

	$modulepermrows = select_bhdb("modulesusertype", array("module"=>$module, "usertype"=>$usertype), "");

	$status = $modulepermrows[0]['status'];
	
	switch ($status) {
		case "y":
		case "1":
		case "ok":
		case "TRUE":
		case "true":
			$highestperm = 1; break;
		default:
			$highestperm = 0;
	}
	
	
	$modulepermrows = select_bhdb("modulesusertype", array("module"=>$module, "usertype"=>"*"), "");

	if (!empty($modulepermrows)) {
		$status = $modulepermrows[0]['status'];
		
		switch ($status) {
			case "y":
			case "1":
			case "ok":
			case "TRUE":
			case "true":
				$highest2perm = 1; break;
			default:
				$highest2perm = 0;
		}
	}
	
	
	$modulepermrows = select_bhdb("modulesusertype", array("module"=>$module, "usertype"=>"-".$usertype), "");

	if (!empty($modulepermrows)) {
		$status = $modulepermrows[0]['status'];
		
		switch ($status) {
			case "y":
			case "1":
			case "ok":
			case "TRUE":
			case "true":
				return 0;
			default:
				$highest3perm = 0;
		}
	}
	
	
	
	if ($highestperm > $highest2perm) { return $highestperm; } else { return $highest2perm; }
	
}

function bh_checkmodulemenu($module, $menu) {
	
	$modulepermrows = select_bhdb("modulesmenu", array("module"=>$module, "menu"=>$menu), "");
	
	$status = $modulepermrows[0]['status'];
	
	switch ($status) {
		case "y":
		case "1":
		case "ok":
		case "TRUE":
		case "true":
			return 1; break;
		default:
			return 0;
	}
	
}

function bh_checkadminmodulemenu($module, $menu) {
	
	$modulepermrows = select_bhdb("adminmodulesmenu", array("module"=>$module, "menu"=>$menu), "");
	
	$status = $modulepermrows[0]['status'];
	
	switch ($status) {
		case "y":
		case "1":
		case "ok":
		case "TRUE":
		case "true":
			return 1; break;
		default:
			return 0;
	}
	
}

function bh_checkmodulefilepath($module, $filepath, $username) {
	
	$accesslevel = bh_checkrights($filepath, $username);
	
	if ($accesslevel == 0) { return 0; }
	
	$modulepermrows = select_bhdb("modulesaccesslevel", array("module"=>$module, "accesslevel"=>$accesslevel), "");
	
	$status = $modulepermrows[0]['status'];
	
	switch ($status) {
		case "y":
		case "1":
		case "ok":
		case "TRUE":
		case "true":
			return 1; break;
		default:
			return 0;
	}
	
}

function bh_listmodulesusertype($usertype = "guest") {

	# Get list of modules
	$modrows = select_bhdb("modules", "", "");
	
	# Go through and select those the user is allowed to access
	foreach ($modrows as $modrow) {
		if (bh_checkmodulepermission($modrow['module'], $usertype) == 1) {
			$allowedmods[$modrow['module']] = $modrow;
		}
	}
	
	return $allowedmods;

}

function bh_listmodulesmenu($menu = "page") {
	global $bhconfig;
	
	# Get list of modules
	$modrows = select_bhdb("modulesmenu", array("menu"=>$menu), "");
	
	# Go through and select those the user is allowed to access
	foreach ($modrows as $modrow) {
		if (bh_checkmodulemenu($modrow['module'], $menu) == 1) {
			if ( !(($bhconfig['signupdisabled'] == 1) && ($modrow['module'] == "signup")) ) {
				$allowedmods[$modrow['module']] = $modrow;
			}
		}
	}
	
	return $allowedmods;

}

function bh_listadminmodulesmenu($menu = "page") {
	
	# Get list of modules
	$modrows = select_bhdb("adminmodulesmenu", array("menu"=>$menu), "");
	
	# Go through and select those the user is allowed to access
	foreach ($modrows as $modrow) {
		if (bh_checkadminmodulemenu($modrow['module'], $menu) == 1) {
			$allowedmods[$modrow['module']] = $modrow;
		}
	}
	
	return $allowedmods;

}

function bh_listmodulesfile($filepath) {
	global $bhcurrent;
	
	$fileobj = new bhfile($filepath);
	$filetype = $fileobj->fileinfo['mimetype'];
	$fileext = bh_get_extension($filepath);
	
	# Get lists of modules it's allowed
	$modrows = array_merge(select_bhdb("modulesfiletype", array("filetype"=>"*", "status"=>"1"), ""), select_bhdb("modulesfiletype", array("filetype"=>$fileext, "status"=>"1"), ""), select_bhdb("modulesfiletype", array("filetype"=>$filetype, "status"=>"1"), ""));
	
	# Get list of modules it's not allowed
	$modnorows = array_merge(select_bhdb("modulesfiletype", array("filetype"=>"-".$filetype, "status"=>"1"), ""), select_bhdb("modulesfiletype", array("filetype"=>"-".$fileext, "status"=>"1"), ""));
	
	# Go through and select those the user is allowed to access
	foreach ($modrows as $modrow) {
		$displayit = 1;
		foreach ($modnorows as $modnorow) {
			if ($modnorow['module'] == $modrow['module']) {
				$displayit = 0;
			}
		}
		if ((bh_checkmodulefilepath($modrow['module'], $filepath, $bhcurrent['userobj']->username) == 1)) {
			$allowedmods[$modrow['module']] = $modrow;
		}
	}
	
	return $allowedmods;

}

function bh_listmodulesdirectory($filepath) {
	global $bhcurrent, $bhsession;
	
	# Get lists of modules it's allowed
	$modrows = select_bhdb("modulesdirectory", array("status"=>"1"), "");
	
	$userobj = new bhuser($bhsession['username']);
	# Go through and select those the user is allowed to access
	foreach ($modrows as $modrow) {
		if (bh_checkmodulepermission($modrow['module'], $userobj->type) == 1) {
			if ((bh_checkmodulefilepath($modrow['module'], $filepath, $bhsession['username']) == 1)) {
				# Special provision for the deletefolder module
				if (!(($modrow['module'] == "deletefolder") && (($filepath == "/") || ($filepath == "") || ($filepath == $userobj->homedir)))) {
					$allowedmods[$modrow['module']] = $modrow;
				}
			}
		}
	}
	
	return $allowedmods;

}

function bh_updatemoduledb() {
	global $bhconfig;
	
	# Open modules folder
	$handle = opendir($bhconfig['bhfilepath']."/modules/");
	
	# Go through and see if modules are in db.
	while (false !== ($file = readdir($handle))) {
		if (!preg_match("/^\.{1,2}$/", $file)) {
			$filerow = select_bhdb("modules", array("file"=>$file), "");
			if (empty($filerow)) {
				# Open file and check through for name etc.
				$filearray = file($bhconfig['bhfilepath']."/modules/".$file);
				$nameline = preg_grep("/^#name.*$/", $filearray);
				$name = substr(current($nameline), 6);
				$descline = preg_grep("/^#description.*$/", $filearray);
				$desc = substr(current($descline), 13);
				$authline = preg_grep("/^#author.*$/", $filearray);
				$auth = substr(current($authline), 8);
				
				insert_bhdb("modules", array("module"=>str_replace(".inc.php", "", $file), "file"=>$file, "name"=>$name, "author"=>$auth, "description"=>$desc));
			}
		}
	}

}

# Returns a language-relevant title
function bh_moduletitle($module) {
	global $bhconfig, $bhlang;

	if (file_exists("modules/".$module.".lang.php")) {
		require "modules/".$module.".lang.php";
		return $modlang[$bhconfig['lang']]['title'];
	} elseif (!empty($bhlang['module:'.$module])) {
		return $bhlang['module:'.$module];
	} else {
		return $module;
	}

}

# Returns a language-relevant description
function bh_moduledescription($module) {
	global $bhconfig, $bhlang;

	if (file_exists("modules/".$module.".lang.php")) {
		require "modules/".$module.".lang.php";
		return $modlang[$bhconfig['lang']]['description'];
	} elseif (!empty($bhlang['moduledesc:'.$module])) {
		return $bhlang['moduledesc:'.$module];
	} else {
		return $module;
	}

}