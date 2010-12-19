<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2003-2004
 *
 *   Miscellaneous Functions File
 *   $Id: misc.inc.php,v 1.4 2005/07/28 23:06:07 andrewgodwin Exp $
 *
 */

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# Fixes ISS request_uri
if(!isset($_SERVER['REQUEST_URI'])) {
   $arr = explode("/", $_SERVER['PHP_SELF']);
   $_SERVER['REQUEST_URI'] = "/" . $arr[count($arr)-1];
   if ($_SERVER['argv'][0]!="")
    $_SERVER['REQUEST_URI'] .= "?" . $_SERVER['argv'][0];
 }
 


function bh_getskins() {
	global $bhconfig;
	
	# Open layouts folder
	$handle = opendir($bhconfig['bhfilepath']."/layouts/");
	# For each layout:
	while (false !== ($layout = readdir($handle))) {
		if (file_exists($bhconfig['bhfilepath']."/layouts/".$layout."/main.inc.php")) {
			# Open that layout's skins folder
			$handle2 = opendir($bhconfig['bhfilepath']."/layouts/".$layout."/skins/");
			# And for each skin:
			while (false !== ($skin = readdir($handle2))) {
				if (file_exists($bhconfig['bhfilepath']."/layouts/".$layout."/skins/".$skin."/skin.inc.php")) {
					# Load the defs file
					$bhskin = array();
					require $bhconfig['bhfilepath']."/layouts/".$layout."/skins/".$skin."/skin.inc.php";
					foreach ($bhskin as $key=>$value) {
						$bhskins[$layout.".".$skin][$key] = $value;
					}
					$bhskins[$layout.".".$skin]['layout'] = $layout;
					$bhskins[$layout.".".$skin]['skin'] = $skin;
				}
			}
		}
	}
	
	return $bhskins;
}

# To fix weird bugs
function bh_get_docroot() {
	return str_replace($_SERVER['PHP_SELF'], "", $_SERVER['SCRIPT_FILENAME']);
}

function htmlpath($relative_path) {
	$realpath=realpath($relative_path);
	$htmlpath=str_replace(bh_get_docroot(),'',$realpath);
	return $htmlpath;
}

function bh_get_weburi() {
	global $bhconfig;
	
	if (!empty($bhconfig['baseuri'])) {
		if (substr($bhconfig['baseuri'], -1) != "/") { $bhconfig['baseuri'] .= "/"; }
		return $bhconfig['baseuri'];
	} else {
		if($_SERVER['HTTPS']=='on'){$httpsuff = 's';}
		if(defined("BH_ROOT")) { $htmlpath = BH_ROOT; } else { $htmlpath = "."; }
		return $sysurl = "http".$httpsuff."://".$_SERVER['HTTP_HOST'].htmlpath($htmlpath)."/";
	}
}

# Humanises times
function bh_humanise_time($time) {
	if ($time == 0) { $time = "Now"; }
	elseif (($time) < (60)) { $time = $time." seconds"; }
	elseif (($time) < (60*60)) { $time = ceil($time/60)." mins"; }
	elseif (($time) < (60*60*24)) { $time = ceil($time/(60*60))." hours"; }
	elseif (($time) < (60*60*24*7)) { $time = ceil($time/(60*60*24))." days"; }
	elseif (($time) < (60*60*24*365)) { $time = ceil($time/(60*60*24*7))." weeks"; }
	elseif (($time) < (60*60*24*365*5)) { $time = ceil($time/(60*60*24*7*365))." years"; }
	elseif (($time) < (60*60*24*365*5*10)) { $time = ceil($time/(60*60*24*7*365))." decades"; }
	elseif (($time) < (60*60*24*365*5*100)) { $time = ceil($time/(60*60*24*7*365))." centuries"; }
	elseif (($time) < (60*60*24*365*5*1000)) { $time = ceil($time/(60*60*24*7*365))." millenia"; }
	else { $time = "Nearly forever"; }
	
	return $time;
}

# Humanises file sizes
function bh_humanise_filesize($size) {
	$counter=0;
	while ($size > 1024) {$size=$size/1024; ++$counter;}
	switch ($counter) {
		case 2: $mysymbol="MB"; break;
		case 1: $mysymbol="KB"; break;
		case 0: $mysymbol="B"; break;
		case 3: $mysymbol="GB";  break;
		case 4: $mysymbol="TB";  break;
		case 5: $mysymbol="PB";  break;
		case 6: $mysymbol="EB";  break;
		case 7: $mysymbol="ZB";  break;
		case 8: $mysymbol="YB";  break;
	}
	return sprintf("%01.1f %s", $size, $mysymbol);
}