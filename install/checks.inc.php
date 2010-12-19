<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Installer2 Checking Functions
 *   $Id$
 *
 */

# These functions perform checks on the system

function bhi_check_imagemagick() {
	if (file_exists("/usr/bin/convert") || file_exists("/bin/convert") || file_exists("/usr/local/bin/convert")) {
		return true;
	} else {
		return false;
	}
}

function bhi_check_magic_quotes() {
	if ((get_magic_quotes_runtime() == 0) && (get_magic_quotes_gpc() == 0)) {
		return true;
	} else {
		return false;
	}
}

function bhi_check_extension($ext) {
	bhi_dl($ext);
	if (extension_loaded($ext)) {
		return true;
	} else {
		return false;
	}
}

function bhi_dl($ext) {
	if (!extension_loaded($ext)) {
		if (strtoupper(substr(PHP_OS, 0, 3) == 'WIN')) {
			dl('php_'.$ext.'.dll');
		} else {
			dl($ext.'.so');
		}
	}
}

function bhi_check_gd() {
	bhi_dl('gd');
	if (extension_loaded("gd")) {
		return true;
	} else {
		return false;
	}
}

function bhi_check_pcre() {
	if (function_exists("preg_grep")) {
		return true;
	} else {
		return false;
	}
}

function bhi_check_php() {
	if (function_exists("version_compare")) {
		if (ver_cmp('>=', "4.2")) {
			if (ver_cmp('<', "5")) {
				return 4;
			} else {
				return 5;
			}
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function bhi_check_safe_mode() {
	if ((ini_get("safe_mode") == "1") || (ini_get("safe_mode") == "on") || (ini_get("safe_mode") == "On")) { 
		return false;
	} else {
		return true;
	}
}

function bhi_check_permissions($file) {
	if (!file_exists($file)) {
		$fn = @fopen($file, "w");
		@fwrite($fn, "0");
		@fclose($fn);
	}
	
	if (is_writeable($file)) {
		return true;
	} else {
		return false;
	}
}

function bhi_check_bh20() {
	global $bhierrors, $bhiwarnings;
	
	if (!file_exists("includes/common.inc.php")) {
		return true;
	} else {
		return false;
	}
}

# Computes version relationships
function ver_cmp($arg1, $arg2 = null, $arg3 = null) {
	static $phpversion = null;
	if ($phpversion===null) $phpversion = phpversion();
	switch (func_num_args()) {
		case 1: return version_compare($phpversion, $arg1);
		case 2:
			if (preg_match('/^[lg][te]|[<>]=?|[!=]?=|eq|ne|<>$/i', $arg1))
				return version_compare($phpversion, $arg2, $arg1);
			elseif (preg_match('/^[lg][te]|[<>]=?|[!=]?=|eq|ne|<>$/i', $arg2))
				return version_compare($phpversion, $arg1, $arg2);
			return version_compare($arg1, $arg2);
		default:
			$ver1 = $arg1;
			if (preg_match('/^[lg][te]|[<>]=?|[!=]?=|eq|ne|<>$/i', $arg2))
				return version_compare($arg1, $arg3, $arg2);
			return version_compare($arg1, $arg2, $arg3);
	}
}