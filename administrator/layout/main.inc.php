<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Layout Master Include
 *   $Id: main.inc.php,v 1.6 2005/07/28 20:11:47 andrewgodwin Exp $
 *
 */
 
/*

The whole templates thing was getting messy, so, now, there are layouts and skins.
Skins go over layouts. Layouts manipulate the raw data from the core.
This is _the_ admin layout. No visual changes possible at runtime save for skins if implemented.

*/

class bhadminlayout {
	var $type;
	var $title;
	var $subtitle1;
	var $subtitle2;
	var $content1;
	var $content2;
	var $content3;
	var $content4;
	var $content5;
	var $filepath;
	var $layoutpath;
	var $skinpath;
	var $returnto;
	var $infolder;
	var $view;
	
	function bhadminlayout($type) {
		global $bhconfig;
	
		$this->type = $type;
		$this->layoutpath = "layout/";
		$this->skinpath = $this->layoutpath."skins/horizonblue/";
	
	}

	function display() {
		global $bhlang, $bherrors, $bhcurrent, $bhconfig;
		
		switch($this->type) {
		
			case "generic":
			
				require $this->layoutpath."pagetop.inc.php";
				$str .= $this->content1;
				require $this->layoutpath."pagebottom.inc.php";
			
			break;
			
			case "userslist":
			
				require $this->layoutpath."pagetop.inc.php";
				require $this->layoutpath."userslist.inc.php";
				require $this->layoutpath."pagebottom.inc.php";
			
			break;
			
			case "regslist":
			
				require $this->layoutpath."pagetop.inc.php";
				require $this->layoutpath."regslist.inc.php";
				require $this->layoutpath."pagebottom.inc.php";
			
			break;
			
			case "settings":
			
				require $this->layoutpath."pagetop.inc.php";
				require $this->layoutpath."settingsform.inc.php";
				require $this->layoutpath."pagebottom.inc.php";
			
			break;
			
			case "edituser":
			
				require $this->layoutpath."pagetop.inc.php";
				require $this->layoutpath."edituserform.inc.php";
				require $this->layoutpath."pagebottom.inc.php";
			
			break;
			
			case "skinslist":
			
				require $this->layoutpath."pagetop.inc.php";
				require $this->layoutpath."skinslist.inc.php";
				require $this->layoutpath."pagebottom.inc.php";
			
			break;
			
			case "main":
			
				require $this->layoutpath."pagetop.inc.php";
				require $this->layoutpath."mainform.inc.php";
				require $this->layoutpath."pagebottom.inc.php";
			
			break;
			
			case "login":
			
				require $this->layoutpath."pagetop.inc.php";
				require $this->layoutpath."loginform.inc.php";
				require $this->layoutpath."pagebottom.inc.php";
			
			break;
			
			default:
			
				require $this->layoutpath."pagetop.inc.php";
				require $this->layoutpath.$this->type.".inc.php";
				require $this->layoutpath."pagebottom.inc.php";
			
			break;
			
		}
		
		echo $str;
	}
	
	function getmodulesmenu($menu) {
		global $bhcurrent, $bherrors;
		
		$modulesarray = bh_listadminmodulesmenu($menu);
		
		# Order by... order
		foreach ($modulesarray as $key=>$module) {
			$modulesorder[$key] = $module['menuorder'];
		}
		
		array_multisort($modulesorder, SORT_ASC, SORT_NUMERIC, $modulesarray);
		
		if (!empty($modulesarray)) {
			foreach ($modulesarray as $module=>$modrow) {
				#if (bh_checkmodulepermission($module, $bhcurrent['userobj']->type) == 1) {
					$menumods[] = array("module"=>$module, "icon"=>$this->getmoduleicon($module), "title"=>bh_moduletitle($module));
				#}
			}
		}
		
		return $menumods;
		
	}
	
	function getmoduleicon($module) {
		if (file_exists($this->skinpath."images/moduleicons/toolbar/".$module.".png")) {
			return $this->skinpath."images/moduleicons/toolbar/".$module.".png";
		} elseif (file_exists($this->skinpath."images/moduleicons/toolbar/".$module.".gif")) {
			return $this->skinpath."images/moduleicons/toolbar/".$module.".gif";
		} else {
			return "images/moduleicons/".$module.".png";
		}
	}
	
	# Creates a yes/no radio button combination of the specified bhconfig $var.
	function yesnoradio($var) {
		global $bhconfig, $bhlang;
		
		if ($bhconfig[$var] == 1) {
			return "<input type='radio' name='bhconfig[".$var."]' value='1' checked> ".$bhlang['label:yes']." &nbsp; &nbsp;".
				"<input type='radio' name='bhconfig[".$var."]' value='0'> ".$bhlang['label:no'];
		} else {
			return "<input type='radio' name='bhconfig[".$var."]' value='1'> ".$bhlang['label:yes']." &nbsp; &nbsp;".
				"<input type='radio' name='bhconfig[".$var."]' value='0' checked> ".$bhlang['label:no'];
		}
	}
	
	# These two produce ony one radio of the above, for table-based layouts etc.
	function yesradio($var) {
		global $bhconfig, $bhlang;
		
		if ($bhconfig[$var] == 1) {
			return "<input type='radio' name='bhconfig[".$var."]' value='1' checked> ".$bhlang['label:yes']." &nbsp; &nbsp;";
		} else {
			return "<input type='radio' name='bhconfig[".$var."]' value='1'> ".$bhlang['label:yes']." &nbsp; &nbsp;";
		}
	}
	
	function noradio($var) {
		global $bhconfig, $bhlang;
		
		if ($bhconfig[$var] == 1) {
			return "<input type='radio' name='bhconfig[".$var."]' value='0'> ".$bhlang['label:no'];
		} else {
			return "<input type='radio' name='bhconfig[".$var."]' value='0' checked> ".$bhlang['label:no'];
		}
	}
	
	function radio($var, $val) {
		global $bhconfig, $bhlang;
		
		if ($bhconfig[$var] == 1) {
			return "<input type='radio' name='bhconfig[".$var."]' value='$val'> ".$bhlang['label:no'];
		} else {
			return "<input type='radio' name='bhconfig[".$var."]' value='$val' checked> ".$bhlang['label:no'];
		}
	}
	
}