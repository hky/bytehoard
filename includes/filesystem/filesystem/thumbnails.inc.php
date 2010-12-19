<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2003-2004
 *
 *   Thumbnails Functions File
 *   $Id: thumbnails.inc.php,v 1.4 2005/07/26 21:55:09 andrewgodwin Exp $
 *
 */
 
/*

This include has the thumbnailing functions.

*/

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

function bh_createthumbnail($filepath, $size) {
	global $bhconfig;
	
	# See what thumbnailing method we're using
	switch ($bhconfig['imageprog']) {
		case "imagemagick":
		default:
		
			if (empty($bhconfig['syspath_convert'])) { $bhconfig['syspath_convert'] = "convert"; }
			
			$execline = $bhconfig['syspath_convert']." -size ".$size."x".$size." ".escapeshellarg($bhconfig['fileroot'].$filepath)." -thumbnail ".$size."x".$size." ".$bhconfig['bhfilepath']."/cache/thumbnail-".$size."-".md5_file($bhconfig['fileroot'].$filepath).".png";
			
			$result = `$execline`;
		
		break;
		
		case "gd":
		
			if (!extension_loaded("gd")) {
				if (!dl("gd.so") && !dl("gd.dll")) {
					bh_die("error:no_gd");
				}
			}
		
			# Read in file
			$fn = fopen($bhconfig['fileroot'].$filepath, "rb");
			while (!feof($fn)) {
				$imagestring .= fread($fn, 4096);
			}
			fclose($fn);
			
			# Create image from string
			$origimg = imagecreatefromstring($imagestring);
			$origsizearray = getimagesize($bhconfig['fileroot'].$filepath);
			$origwidth = $origsizearray[0];
			$origheight = $origsizearray[1];
			
			# Find new width/height
			if ($origwidth > $origheight) {
				$ratio = $size/$origwidth;
				$newwidth = $size;
				$newheight = $ratio*$origheight;
			} else {
				$ratio = $size/$origheight;
				$newheight = $size;
				$newwidth = $ratio*$origwidth;
			}
			
			# Create new image
			$newimg = imagecreatetruecolor($newwidth, $newheight);
			$white = imagecolorallocate($newimg, 255, 255, 255);
			imagefill($newimg, 0,0, $white); # This isn't necessary, but...
			# Resample image down
			imagecopyresampled($newimg, $origimg, 0, 0, 0, 0, $newwidth, $newheight, $origwidth, $origheight);
			# Save the image
			imagepng($newimg, $bhconfig['bhfilepath']."/cache/thumbnail-".$size."-".md5_file($bhconfig['fileroot'].$filepath).".png");
		
		break;
	}
	

}

function bh_thumbnail($filepath, $size) {
	global $bhconfig;
	
	# Check if we can handle this filetype
	switch (strtolower(bh_get_extension($filepath))) {
		case "jpg":
		case "jpeg":
		case "gif":
		case "png":
				$dothumbnail = true; break;
		
		case "svg":
		case "xpm":
		case "xcf":
			if ($bhconfig['imageprog'] == "imagemagick") { $dothumbnail = true; } else { return false; } break;
		
		default:
			return false;
	}
	
	if ($dothumbnail != true) { return false; }
	
	# Check for really big files that would choke md5/imagemagick/gd on slower systems
	if ((filesize($bhconfig['fileroot'].$filepath) > (5*1024*1024)) && ($bhconfig['limitthumbs'] == 1)) { return false; }
	
	if (file_exists("cache/thumbnail-".$size."-".md5_file($bhconfig['fileroot'].$filepath).".png")) {
		 return "cache/thumbnail-".$size."-".md5_file($bhconfig['fileroot'].$filepath).".png";
	} else {
		bh_createthumbnail($filepath, $size);
		if (!file_exists("cache/thumbnail-".$size."-".md5_file($bhconfig['fileroot'].$filepath).".png")) {
			if (!file_exists("cache/thumbnail-".$size."-".md5_file($bhconfig['fileroot'].$filepath).".png.0")) {
				return false;
			} else {
				return "cache/thumbnail-".$size."-".md5_file($bhconfig['fileroot'].$filepath).".png.0";
			}
		} else {
			return "cache/thumbnail-".$size."-".md5_file($bhconfig['fileroot'].$filepath).".png";
		}
	}
}

