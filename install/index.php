<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Installer2
 *   $Id$
 *
 */

# This is the new, modular Installer2. I'm making everything less monolithic, and this was the last one to do.
# The idea is that all the install functions/pages are in /install/install, and the upgrade functions in /install/upgrade.

define("IN_BH", 1);
define("BH_ROOT", "../");

# First, we include the library files
require_once "../includes/version.inc.php";
require_once "../includes/configfunc.inc.php";
require_once "checks.inc.php";
require_once "display.inc.php";
require_once "files.inc.php";
require_once "../langs/en.lang.php";

# Fix for some parts of the install
if (empty($_POST['install_dbmod'])) { $_POST['install_dbmod'] = $_GET['install_dbmod']; }

# Then check to see what page is requested

$page = $_GET['page'];
if (empty($page)) { $page = $_POST['page']; }
if (empty($page)) { $page = "splash"; }

switch ($page) {

	default:
		$pagea[] = include("other/404.inc.php");
		echo bhi_create_sectionpage($pagea);
	break;

	case "splash":
		$pagea = include("other/splash.inc.php");
		echo bhi_create_nobannerpage($pagea);
	break;

	case "menu":
		$pagea = include("other/menu.inc.php");
		echo bhi_create_page($pagea);
	break;

	case "system_information":
		$pagea = include("other/sysinfo.inc.php");
		echo bhi_create_page($pagea);
	break;

	case "install_start":
		$pagea[1] = include("install/intro.inc.php");
		$pagea[2] = include("install/checks.inc.php");
		if ($pagea[2]['continue'] == 1) {
			$pagea[] = include("install/choosedb.inc.php");
		}
		echo bhi_create_sectionpage($pagea);
	break;

	case "install_choose_database":
		$pagea[] = include("install/choosedb.inc.php");
		echo bhi_create_sectionpage($pagea);
	break;

	case "install_configure_database":
		$pagea[] = include("install/configdb.inc.php");
		echo bhi_create_sectionpage($pagea);
	break;

	case "install_init_database":
		$pagea[1] = include("install/testdb.inc.php");
		if ($pagea[1]['continue'] == 1) {
			$pagea[2] = include("install/writeconfig.inc.php");
			if ($pagea[2]['continue'] == 1) {
				$pagea[3] = include("install/initdb.inc.php");
				$pagea[4] = include("install/paths.inc.php");
			}
		}
		echo bhi_create_sectionpage($pagea);
	break;

	case "install_complete":
		$pagea[1] = include("install/savepaths.inc.php");
		if ($pagea[1]['continue'] == 1) {
			$pagea[2] = include("install/createadmin.inc.php");
			if ($pagea[2]['continue'] == 1) {
				$pagea[3] = include("install/finish.inc.php");
			}
		}
		echo bhi_create_sectionpage($pagea);
	break;

	case "upgrade_start":
		$pagea[1] = include("upgrade/intro.inc.php");
		$pagea[2] = include("upgrade/choose.inc.php");
		echo bhi_create_sectionpage($pagea);
	break;

	case "upgrade_do":
		$pagea[1] = include("upgrade/do.inc.php");
		echo bhi_create_sectionpage($pagea);
	break;
	
	
}