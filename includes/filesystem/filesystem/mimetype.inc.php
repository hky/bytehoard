<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Mimetype include
 *   $Id: mimetype.inc.php,v 1.2 2005/06/17 18:52:01 andrewgodwin Exp $
 *
 */
 
/*

This function returns a mimetype based on the extension/directory properties of the filepath it is sent.

*/

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

function bh_mimetype($filepath) {
	global $bhconfig;
	
	$fileobj = new bhfile($filepath);
	
	
	
	if ($fileobj->is_dir()) {
	
		return "bytehoard/directory";
	
	} else {
	
		# If we can use unix file, then YES! YES! YES!
		if (bh_os() == "nix") {
			# Get what file says
			$cmdstr = "file -bi ".escapeshellarg($bhconfig['fileroot'].$filepath);
			$fileoutput = `$cmdstr`;
			
			# Trim off any charset or language stuff
			$array1 = explode(",", $fileoutput);
			$fileoutput = $array1[0];
			$array1 = explode(";", $fileoutput);
			$fileoutput = $array1[0];
			$fileoutput = trim($fileoutput);
			$fileoutput = str_replace("\n", "", $fileoutput);
			
			return $fileoutput;
		}
	
		$extension = bh_get_extension($filepath);
		
		switch ($extension) {
			case "txt": return "text/plain"; break;
			case "html": case "htm": case "txt": return "text/html"; break;
			case "png": return "image/png"; break;
			case "jpg": case "jpeg": case "jpe": return "image/jpeg"; break;
			case "gif": return "image/gif"; break;
			case "mp3": return "audio/x-mp3"; break;
			case "ogg": return "audio/x-vorbis"; break;
			case "wav": return "audio/wav"; break;
			case "doc": return "application/msword"; break;
			case "xls": return "application/vnd.ms-excel"; break;
			case "ppt": case "pps": return "application/vnd.ms-powerpoint"; break;
			default: return "application/octet-stream"; break;
		
		}
	
	}

}