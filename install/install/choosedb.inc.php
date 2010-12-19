<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Installer2 - Page File
 *   $Id$
 *
 */

$pagearray = array();

$pagearray['title'] = $bhlang['install:title:bytehoard_installation']." :: ".$bhlang['install:title:choose_database'];

$pagearray['content'] .= "<center><table>";
$pagearray['content'] .= "<form action='index.php?page=install_configure_database' method='POST'>";
$pagearray['content'] .= "<tr><td></td><td><b>Name</b></td><td>&nbsp;&nbsp;&nbsp;</td><td><b>Description</b></td></tr>";


# Get database modules
$dir = "../includes/db/";
$dh = opendir($dir);
while (false !== ($filename = readdir($dh))) {
	if (strpos($filename, ".inc.php") != 0) {
		$files[] = $filename;
	}
}
sort($files);

# Go through them nabbing details
foreach ($files as $file) {
	if (is_readable($dir.$file)) {
		
		$filearray = file($dir.$file);
		
		$namearray = preg_grep("/^#name/", $filearray);
		
		# This doesn't seem to work right on some systems. Use a foreach loop instead (it's not nice I know)
		#sort($namearray);
		#$name = substr($namearray[0], 6);
		foreach ($namearray as $bigname) {
			$name = substr($bigname, 6);
		}
		
		$descarray = preg_grep("/^#description/", $filearray);
		#sort($descarray);
		#$desc = substr($descarray[0], 13);
		foreach ($descarray as $bigdesc) {
			$desc = substr($bigdesc, 13);
		}
		
		$extarray = preg_grep("/^#extension/", $filearray);
		#sort($descarray);
		#$desc = substr($descarray[0], 13);
		foreach ($extarray as $bigext) {
			$ext = trim(substr($bigext, 10));
		}
		
		if (!empty($ext)) {
			if (bhi_check_extension($ext) == true) {	
				$filenumber += 1;
				if ($filenumber == 1) {
					$pagearray['content'] .= "<tr><td><input type='radio' name='install_dbmod' value='".$file."' checked></td><td>".$name."<br><font color='gray'>".$file."</font></td><td></td><td>".$desc."</td></tr>";
				} else {
					$pagearray['content'] .= "<tr><td><input type='radio' name='install_dbmod' value='".$file."'></td><td>".$name."<br><font color='gray'>".$file."</font></td><td></td><td>".$desc."</td></tr>";
				}
			}
		} else {
			if ($filenumber == 1) {
				$pagearray['content'] .= "<tr><td><input type='radio' name='install_dbmod' value='".$file."' checked></td><td>".$name."<br><font color='gray'>".$file."</font></td><td></td><td>".$desc."</td></tr>";
			} else {
				$pagearray['content'] .= "<tr><td><input type='radio' name='install_dbmod' value='".$file."'></td><td>".$name."<br><font color='gray'>".$file."</font></td><td></td><td>".$desc."</td></tr>";
			}
		}
	}
}
		
	
$pagearray['content'] .= "<tr><td colspan='4' align='center'><br><br><input type='submit' value='".$bhlang['button:next']."'></td></tr>";
$pagearray['content'] .= "</form></table></center>";

return $pagearray;