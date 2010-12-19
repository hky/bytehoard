<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Layout Master Include
 *   $Id: main.inc.php,v 1.6 2005/07/26 21:55:09 andrewgodwin Exp $
 *
 */
 
/*

The whole templates thing was getting messy, so, now, there are layouts and skins.
Skins go over layouts. Layouts manipulate the raw data from the core.

*/

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

class bhlayout {
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
	
	function bhlayout($type) {
		global $bhconfig;
	
		$this->type = $type;
		$this->layoutpath = "layouts/horizon/";
		$this->skinpath = "layouts/horizon/skins/".$bhconfig['skin']."/";
	
	}

	function display() {
		global $bhlang, $bherrors, $bhcurrent, $bhconfig, $bhsession;
		
		switch($this->type) {
		
			case "popup_upload":
				require $this->layoutpath."popup_upload.inc.php";
				echo $str;
				
			break;
			
			
			case "filelist":
				require $this->layoutpath."pagetop.inc.php";
				$str .= "<table width='100%' align='center' cellspacing='0' cellpadding='0'><tr><td colspan='2'>";
				require $this->layoutpath."toolbar.inc.php";
				require $this->layoutpath."errorbar.inc.php";
				$str .= "<tr><td width='220' valign='top'>";
				require $this->layoutpath."viewbar.inc.php";
				#$str .= "<br/>";
				require $this->layoutpath."folderbar.inc.php";
				$str .= "</td><td valign='top'>";
				
				switch ($this->view) {
					case "thumbs":
					require $this->layoutpath."folderpane_thumbs.inc.php"; break;
					
					default:
					case "tiles":
					require $this->layoutpath."folderpane_tiles.inc.php"; break;
					
					# Not implmented yet
					#case "html":
					#require $this->layoutpath."folderpane_html.inc.php"; break;
					
					case "list":
					require $this->layoutpath."folderpane_list.inc.php"; break;
				}
				
				$str .= "</td></tr></table>";
				require $this->layoutpath."pagebottom.inc.php";
				echo $str;
			
			break;
			
			case "filepane":
				require $this->layoutpath."pagetop.inc.php";
				$str .= "<table width='100%' align='center' cellspacing='0' cellpadding='0'><tr><td colspan='2'>";
				require $this->layoutpath."toolbar.inc.php";
				require $this->layoutpath."errorbar.inc.php";
				$str .= "<tr><td width='220' valign='top'>";
				require $this->layoutpath."folderbar.inc.php";
				$str .= "</td><td valign='top'>";
				require $this->layoutpath."filepane.inc.php";
				$str .= "</td></tr></table>";
				require $this->layoutpath."pagebottom.inc.php";
				echo $str;
			
			break;
			
			case "login":
				require $this->layoutpath."pagetop.inc.php";
				$str .= "<table width='100%' align='center' cellspacing='0' cellpadding='0'><tr><td>";
				require $this->layoutpath."toolbar.inc.php";
				require $this->layoutpath."errorbar.inc.php";
				$str .= "</td></tr><tr><td valign='top' align='center'>";
				require $this->layoutpath."loginform.inc.php";
				$str .= "</td></tr></table>";
				require $this->layoutpath."pagebottom.inc.php";
				echo $str;
			break;
			
			case "options":
				require $this->layoutpath."pagetop.inc.php";
				$str .= "<table width='100%' align='center' cellspacing='0' cellpadding='0'><tr><td>";
				require $this->layoutpath."toolbar.inc.php";
				require $this->layoutpath."errorbar.inc.php";
				$str .= "</td></tr><tr><td valign='top' align='center'>";
				require $this->layoutpath."optionsform.inc.php";
				$str .= "</td></tr></table>";
				require $this->layoutpath."pagebottom.inc.php";
				echo $str;
			break;
			
			case "passreset":
				require $this->layoutpath."pagetop.inc.php";
				$str .= "<table width='100%' align='center' cellspacing='0' cellpadding='0'><tr><td>";
				require $this->layoutpath."toolbar.inc.php";
				require $this->layoutpath."errorbar.inc.php";
				$str .= "</td></tr><tr><td valign='top' align='center'>";
				require $this->layoutpath."passresetform.inc.php";
				$str .= "</td></tr></table>";
				require $this->layoutpath."pagebottom.inc.php";
				echo $str;
			break;
			
			case "signup":
				require $this->layoutpath."pagetop.inc.php";
				$str .= "<table width='100%' align='center' cellspacing='0' cellpadding='0'><tr><td>";
				require $this->layoutpath."toolbar.inc.php";
				require $this->layoutpath."errorbar.inc.php";
				$str .= "</td></tr><tr><td valign='top' align='center'>";
				require $this->layoutpath."signupform.inc.php";
				$str .= "</td></tr></table>";
				require $this->layoutpath."pagebottom.inc.php";
				echo $str;
			break;
			
			case "choosefolder":
			
				require $this->layoutpath."pagetop.inc.php";
				$str .= "<table width='100%' align='center' cellspacing='0' cellpadding='0'><tr><td>";
				require $this->layoutpath."toolbar.inc.php";
				require $this->layoutpath."errorbar.inc.php";
				$str .= "</td></tr><tr><td valign='top' align='center'>";
				require $this->layoutpath."choosefolderform.inc.php";
				$str .= "</td></tr></table>";
				require $this->layoutpath."pagebottom.inc.php";
				echo $str;
			
			break;
			
			case "sharing":
			
				require $this->layoutpath."pagetop.inc.php";
				$str .= "<table width='100%' align='center' cellspacing='0' cellpadding='0'><tr><td>";
				require $this->layoutpath."toolbar.inc.php";
				require $this->layoutpath."errorbar.inc.php";
				$str .= "</td></tr><tr><td valign='top' align='center'>";
				require $this->layoutpath."sharingform.inc.php";
				$str .= "</td></tr></table>";
				require $this->layoutpath."pagebottom.inc.php";
				echo $str;
			
			break;
			
			case "sharingfolder":
			
				require $this->layoutpath."pagetop.inc.php";
				$str .= "<table width='100%' align='center' cellspacing='0' cellpadding='0'><tr><td>";
				require $this->layoutpath."toolbar.inc.php";
				require $this->layoutpath."errorbar.inc.php";
				$str .= "</td></tr><tr><td valign='top' align='center'>";
				require $this->layoutpath."sharingfolderform.inc.php";
				$str .= "</td></tr></table>";
				require $this->layoutpath."pagebottom.inc.php";
				echo $str;
			
			break;
				
			case "generic":
			
				require $this->layoutpath."pagetop.inc.php";
				$str .= "<table width='100%' align='center' cellspacing='0' cellpadding='0'><tr><td>";
				require $this->layoutpath."toolbar.inc.php";
				require $this->layoutpath."errorbar.inc.php";
				$str .= "</td></tr><tr><td valign='top' align='center'>";
				$str .= $this->content1;
				$str .= "</td></tr></table>";
				require $this->layoutpath."pagebottom.inc.php";
				echo $str;
			
			break;
			
			default:
			
				require $this->layoutpath."pagetop.inc.php";
				$str .= "<table width='100%' align='center' cellspacing='0' cellpadding='0'><tr><td>";
				require $this->layoutpath."toolbar.inc.php";
				require $this->layoutpath."errorbar.inc.php";
				$str .= "</td></tr><tr><td valign='top' align='center'>";
				require $this->layoutpath.$this->type.".inc.php";
				$str .= "</td></tr></table>";
				require $this->layoutpath."pagebottom.inc.php";
				echo $str;
			
			break;
		}
		
	}
	
	
	function dirlist() {
		global $bhcurrent;
	
		$dirsarray = bh_foldersarray("/", 0, $this->filepath."/", $bhcurrent['userobj']->username);
		
		$str = "<table>";
		
		foreach ($dirsarray as $dirrow) {
		
			$patharray = explode("/", $dirrow['path']);
			$title = $patharray[count($patharray)-2];
			if ($dirrow['path'] == "/") { $title = "/"; }
			
			# Special icon for trash
			if (strtolower($title) == "trash") {
				$str .= "<tr><td>".str_repeat("&nbsp;", (4*$dirrow['level']))." <a href='index.php?page=viewdir&filepath=".$dirrow['path']."' class='folderlink'><img src='".$this->skinpath."images/trash.png' border='0' alt='T' /> ".$title."</a></td></tr>";
			} else {
				$str .= "<tr><td>".str_repeat("&nbsp;", (4*$dirrow['level']))." <a href='index.php?page=viewdir&filepath=".$dirrow['path']."' class='folderlink'><img src='".$this->skinpath."images/folder.png' border='0' alt='F' /> ".$title."</a></td></tr>";
			}
		
		}
		
		$str .= "</table>";
		
		return $str;
		
	}
	
	
	function viewlist() {
		global $bhcurrent;
		
		# Hardcoded list of views for now.
		$views = array(		array("name"=>"tiles", "title"=>"Tiles"),
					array("name"=>"thumbs", "title"=>"Thumbnails"),
					array("name"=>"list", "title"=>"List")	);
		
		$str = "<table><tr>";
		
		foreach ($views as $view) {
			
			if ($view['name'] == $this->view) {
				$str .= "<td><img src='".$this->skinpath."images/views/".$view['name'].".png' border='0' alt='".$view['name']."' title='".$view['title']."' border='0'/></td>";
			} else {
				$str .= "<td><a href='index.php?page=viewdir&filepath=".$this->filepath."&view=".$view['name']."' class='folderlink'><img src='".$this->skinpath."images/views/".$view['name'].".png' border='0' alt='".$view['name']."' title='".$view['title']."' border='0'/></a></td>";
			}
		
		}
		
		$str .= "</tr></table>";
		
		return $str;
		
	}
	
	
	function choosedirlist() {
		global $bhcurrent;
		
		$dirsarray = bh_foldersarray("/", 0, $this->filepath."/", $bhcurrent['userobj']->username, 1, 2);
		
		$str = "<table>";
		
		foreach ($dirsarray as $dirrow) {
		
			$patharray = explode("/", $dirrow['path']);
			$title = $patharray[count($patharray)-2];
			if ($dirrow['path'] == "/") { $title = "/"; }
			
			$str .= "<tr><td>".str_repeat("&nbsp;", (4*$dirrow['level']))." <a href='".$this->returnto."&infolder=".$dirrow['path']."'><img src='".$this->skinpath."images/folder.png' border='0' alt='[F]' /> ".$title."</a></td></tr>";
		
		}
		
		$str .= "</table>";
		
		return $str;
		
	}
	
	function geticon($filepath, $size = 48) {
		
		# Open file object and see if it is a folder
		$fileobj = new bhfile($filepath);
		if ($fileobj->is_dir() == TRUE) {
			if (file_exists($this->skinpath."images/filetypes/".$size."x".$size."/folder.png")) {
				return $this->skinpath."images/filetypes/".$size."x".$size."/folder.png";
			} else {
				return $this->skinpath."images/filetypes/48x48/folder.png";
			}
		}
		
		# Get extension of file
		$filepatharray = explode(".", $filepath);
		$extension = $filepatharray[count($filepatharray)-1];
		
		# Find icon name
		switch ($extension) {
			case "png":
			case "jpg":
			case "jpeg":
			case "gif":
			case "mng":
			case "tif":
			case "tiff":
			case "bmp":
			case "xpm":
				$icon = "image.png"; break;
			case "svg":
			case "psd":
			case "xcf":
			case "ps":
				$icon = "vectorgfx.png"; break;
			case "htm":
			case "html":
			case "tpl":
				$icon = "html.png"; break;
			case "doc":
			case "oot":
			case "ott":
			case "sxw":
			case "rtf":
				$icon = "document.png"; break;
			case "xls":
			case "oos":
			case "ots":
			case "sxc":
				$icon = "spreadsheet.png"; break;
			case "mov":
			case "wmv":
			case "mpg":
			case "mpeg":
			case "ogv":
				$icon = "video.png"; break;
			case "ogg":
			case "mp3":
			case "wma":
			case "wav":
			case "flac":
				$icon = "sound.png"; break;
			case "chm":
				$icon = "help.png"; break;
			case "exe":
			case "dll":
				$icon = "winexe.png"; break;
			case "py":
				$icon = "source_python.png"; break;
			case "php":
			case "php3":
			case "php4":
			case "php5":
			case "phpx":
			case "phtml":
				$icon = "source_php.png"; break;
			case "zip":
			case "bz2":
			case "gz":
			case "tgz":
			case "tbz2":
			case "rar":
			case "7z":
			case "cab":
			case "sit":
			case "sitx":
				$icon = "compressed.png"; break;
			case "eml":
				$icon = "email.png"; break;
			case "txt":
				$icon = "txt.png"; break;
			case "mid":
			case "midi":
				$icon = "midi.png"; break;
			case "iso":
			case "cue":
				$icon = "cdimage.png"; break;
			case "bin":
				$icon = "binary.png"; break;
			case "pdf":
				$icon = "pdf.png"; break;
			case "deb":
				$icon = "deb.png"; break;
			case "rpm":
				$icon = "rpm.png"; break;
			case "log":
				$icon = "log.png"; break;
			default:
				$icon = "generic.png"; break;
		}
		
		if (file_exists($this->skinpath."images/filetypes/".$size."x".$size."/".$icon) == true) {
			return $this->skinpath."images/filetypes/".$size."x".$size."/".$icon;
		} else {
			if (file_exists($this->skinpath."images/filetypes/".$size."x".$size."/generic.png")) {
				return $this->skinpath."images/filetypes/".$size."x".$size."/generic.png";
			} else {
				return $this->skinpath."images/filetypes/48x48/".$icon;
			}
		}
	
	}
	
	function getmodulesmenu($menu) {
		global $bhcurrent, $bherrors;
		
		$modulesarray = bh_listmodulesmenu($menu);
		
		foreach ($modulesarray as $module=>$modrow) {
			if (bh_checkmodulepermission($module, $bhcurrent['userobj']->type) == 1) {
				$menumods[] = array("module"=>$module, "icon"=>$this->getmoduleicon($module), "title"=>bh_moduletitle($module));
			}
		}
		
		return $menumods;
		
	}
	
	function getmoduleicon($module, $type = "toolbar") {
		if (file_exists($this->skinpath."images/moduleicons/".$type."/".$module.".png")) {
			return $this->skinpath."images/moduleicons/".$type."/".$module.".png";
		} elseif (file_exists($this->skinpath."images/moduleicons/".$type."/".$module.".gif")) {
			return $this->skinpath."images/moduleicons/".$type."/".$module.".gif";
		} elseif (file_exists("images/moduleicons/".$type."/".$module.".png")) {
			return "images/moduleicons/".$type."/".$module.".png";
		} else {
			return "images/moduleicons/".$module.".png";
		}
	}

}