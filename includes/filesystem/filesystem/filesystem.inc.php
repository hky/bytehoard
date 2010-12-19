<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   File and Folder object classes
 *   $Id: filesystem.inc.php,v 1.7 2005/07/28 20:11:47 andrewgodwin Exp $
 *
 */
 
/*

The file and folder classes handle both the actual file content and their metadata - permissions, descriptions, dates, and so forth.

This whole thing is designed so the include can be rewritten to support a different method of file storing (perhaps database, distributed or whatever, and then everything can be interchanged.

*/

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# File Class

class bhfile {
	var $filepath;		# The internal filepath.
	var $absfilepath;	# The real system filepath.
	var $fileinfo;		# Array holding various metadata & file info.
	var $filecontents;	# Variable holding the file contents, if necessary.

	# Constructor. Takes filepath and gets basic data about the file, and puts it into the variables.
	function bhfile($filepath) {
		global $bhconfig, $bhcurrent;
		
		$this->filepath = bh_fpclean($filepath);
		if (defined("BH_ROOT")) {
			$this->absfilepath = $bhconfig['fileroot'].$this->filepath;
		} else {
			$this->absfilepath = $bhconfig['fileroot'].$this->filepath;
		}
		$this->check();						# Check / create metadata.
		$this->loadmetadata();					# Load metadata.
		
	
	}
	
	# Creates a skeleton metadata if it is a new file.
	function check() {
		
		$metadatarows = select_bhdb("metadata", array("filepath"=>$this->filepath), "");	# Grab the array of metadata rows.
		$sizerows = select_bhdb("metadata", array("filepath"=>$filepath, "metaname"=>"filesize"), "");	# Get size row for this file.
		
		if (empty($sizerows)) {		# If there isn't one, then make one.
			$this->fileinfo['filesize'] = filesize($this->absfilepath);
			$this->savemetadata();
		}
		
		if (empty($metadatarows)) {
			$this->fileinfo['createdate'] = time();
			$this->fileinfo['moddate'] = time();
			$this->fileinfo['mimetype'] = bh_mimetype($this->filepath);
			$this->savemetadata();
		
			# Insert ACL entries of parent
			$parent = bh_fpclean(bh_get_parent($this->filepath));
			
			if ($parent != "/") {
			
				$acl_u_rows = select_bhdb("aclusers", array("filepath"=>$parent), "");
				foreach ($acl_u_rows as $acl_u_row) {
					$acl_u_row['filepath'] = $this->filepath;
					insert_bhdb("aclusers", $acl_u_row);
				}
				
				$acl_g_rows = select_bhdb("aclgroups", array("filepath"=>$parent), "");
				foreach ($acl_g_rows as $acl_g_row) {
					$acl_g_row['filepath'] = $this->filepath;
					insert_bhdb("aclgroups", $acl_g_row);
				}
				
				$acl_p_rows = select_bhdb("aclpublic", array("filepath"=>$parent), "");
				foreach ($acl_p_rows as $acl_p_row) {
					$acl_p_row['filepath'] = $this->filepath;
					insert_bhdb("aclpublic", $acl_p_row);
				}
			
			}
			
		}
		
	
	}
	
	# Reads a file into the filecontents variable.
	function loadfile() {
		global $bhconfig, $bhsession;
		# Check if it's a directory.
		# For directories, loadfile still returns the contents of the filepath - the directory listing. Everything is a file.
		
		if ($this->is_dir()) {
		
			$files = array();
			$handle = opendir($this->absfilepath);
			while (false !== ($file = readdir($handle))) {
			
				# Open and close the file, to assign permissions to new files.
				$tempfileobj = new bhfile($this->filepath."/".$file);
				unset($tempfileobj);
				
				if (bh_checkrights($this->filepath."/".$file, $bhsession['username']) > 0) {
				
					if ($bhconfig['hidedotfiles'] == 1) {
						if (!preg_match("/^\.{1,2}/", $file)) {
							$files[] = array("filename"=>$file, "filepath"=>$this->filepath."/".$file, "filesize"=>filesize($this->absfilepath."/".$file), "filedate"=>filemtime($this->absfilepath."/".$file), "absfilepath"=>($this->absfilepath."/".$file));
						}
					} else {
						if (!preg_match("/^\.{1,2}$/", $file)) {
							$files[] = array("filename"=>$file, "filepath"=>$this->filepath."/".$file, "filesize"=>filesize($this->absfilepath."/".$file), "filedate"=>filemtime($this->absfilepath."/".$file), "absfilepath"=>($this->absfilepath."/".$file));
						}
					}
				}
			}
			closedir($handle);
			$this->filecontents = $files;
			return $files;
		} else {
			# Check to use file_get_contents (apparentely faster) or fread (compatable)
			if (function_exists("file_get_contents")) {
				$this->filecontents = file_get_contents($this->absfilepath);
			} else {
				$filepointer0 = fopen($this->absfilepath, "rb");
				$this->filecontents = fread($filepointer0, filesize($this->filecontents));
				fclose($filepointer0);
			}
		}
	
	}
	
	function filescan() {
		if ($this->is_dir()) {
			$files = array();
			$handle = opendir($this->absfilepath);
			while (false !== ($file = readdir($handle))) {
				# Call filescan on these files too
				$tempfileobj = new bhfile($this->filepath."/".$file);
				$tempfileobj->filescan();
			}
		}
	}
	
	function numberfiles() {
		if ($this->is_dir() == true) {
			$files = $this->loadfile();
			return count($files);
		} else {
			return 1;
		}
	}
	
	# Saves a file into a file from the filecontents variable
	function savefile() {
	
		# Check it's not a directory
		if ($this->is_dir()) { return "ERROR_FS_NOSAVEDIR"; }
	
		$filepointer0 = fopen($this->absfilepath, "wb");
		fwrite($filepointer0, $this->filecontents, strlen($this->filecontents));
		fclose($filepointer0);
		chmod($this->absfilepath, 0777);
		$this->rescan();
	
	}
	
	# Loads the metadata into the fileinfo array
	function loadmetadata() {
		$metadatarows = select_bhdb("metadata", array("filepath"=>$this->filepath), NULL);	# Grab the array of metadata rows.
		
		foreach ($metadatarows as $metadatarow) {		# Loop through the rows, and assign metadata to the array.
			$this->fileinfo[$metadatarow['metaname']] = $metadatarow['metacontent'];
		}
	}
	
	# Writes all metadata values in fileinfo into the database.
	function savemetadata() {
	
		foreach ($this->fileinfo as $metaname=>$metacontent) {
			$metarows = select_bhdb("metadata", array("filepath"=>$this->filepath, "metaname"=>$metaname), "");
			if (empty($metarows)) {
				insert_bhdb("metadata", array("filepath"=>$this->filepath, "metaname"=>$metaname, "metacontent"=>$metacontent));
			} else {
				update_bhdb("metadata", array("metacontent"=>$metacontent), array("filepath"=>$this->filepath, "metaname"=>$metaname));
			}
		}
	
	}

	
	# Writes a particular metadata value into the database.
	function saveametadata($metaname, $metacontent) {
	
		insert_bhdb("metadata", array("filepath"=>$this->filepath, "metaname"=>$metaname, "metacontent"=>$metacontent));
		$this->loadmetadata();		# Refresh the metadata array.
	
	}
	
	# Returns true if this is actually a directory. I follow the everything-is-a-file mentality, so no separate classes.
	function is_dir() {
		return is_dir($this->absfilepath);
	
	}
	
	function deletefile() {
	
		if ($this->is_dir()) {
			$this->loadfile();
			foreach ($this->filecontents as $file2delete) {
				$file2deleteobj = new bhfile($file2delete['filepath']);
				$file2deleteobj->deletefile();
				unset($filetodeleteobj);
			}
			rmdir($this->absfilepath);
		} else {
			unlink($this->absfilepath);
		}
		$this->rescan();
		
		$this->removedb();
	
	}
	
	# Moves the file to the Trash rather than deleteing it.
	function safedeletefile() {
	
		
		if ($this->is_dir()) {
			$this->loadfile();
			foreach ($this->filecontents as $file2delete) {
				$file2deleteobj = new bhfile($file2delete['filepath']);
				$file2deleteobj->removedb();
				unset($filetodeleteobj);
			}
			$this->removedb();
		} else {
			$this->removedb();
		}
		
		bh_trash($this->absfilepath);
	
	}
	
	# Chooses which method to do, based on config & location
	function smartdeletefile() {
		global $bhconfig;
		
		if (($bhconfig['usetrash'] == 0) || (substr(strtolower($this->filepath), 6) == "/trash") || (substr(strtolower($this->filepath), 5) == "trash")) { $this->deletefile(); }
		else { $this->safedeletefile(); }
	
	}
	
	function readfile() {
		global $bhlang;
		
		if ($this->is_dir() == false) {
			readfile($this->absfilepath);
		} else {
			bh_log($bhlang['error:not_a_file'], "BH_INVALID_PATH");
		}
	}
	
	function mimetype() {
	
		#if (!empty($this->fileinfo['mimetype'])) {
		#	return $this->fileinfo['mimetype'];
		#} else {
			return bh_mimetype($this->filepath);
		#}
	
	}
	
	# This moves the uploaded file to the right place.
	function uploaded_file($tmppath) {
		global $bhconfig;
		
		move_uploaded_file($tmppath, $this->absfilepath);
		
		chmod($this->absfilepath, 0777);
		$this->rescan();
	}
	
	# This recalculates size and mimetype
	function rescan() {
	
		$this->fileinfo['filesize'] = filesize($this->absfilepath);
		$this->fileinfo['moddate'] = time();
		$this->fileinfo['mimetype'] = bh_mimetype($this->filepath);
		$this->savemetadata();
	
	}
	
	# This removes all database entries for the file. Useful for when you're removing or moving it.
	function removedb() {
		
		delete_bhdb("aclusers", array("filepath"=>$this->filepath));
		delete_bhdb("aclgroups", array("filepath"=>$this->filepath));
		delete_bhdb("aclpublic", array("filepath"=>$this->filepath));
		delete_bhdb("metadata", array("filepath"=>$this->filepath));
		delete_bhdb("filecodes", array("filepath"=>$this->filepath));
	
	}
	
	# This function moves the files while retaining all permissions, etc.
	function moveto($newfilepath) {
		global $bhconfig;
		
		# Clean up filepath
		$newfilepath = bh_fpclean($newfilepath);
		
		rename($this->absfilepath, $bhconfig['fileroot'].$newfilepath);
		
		# Insert ACL/metadata/filecode entries of old self			
			$acl_u_rows = select_bhdb("aclusers", array("filepath"=>$this->filepath), "");
			foreach ($acl_u_rows as $acl_u_row) {
				$acl_u_row['filepath'] = $newfilepath;
				insert_bhdb("aclusers", $acl_u_row);
			}
			
			$acl_g_rows = select_bhdb("aclgroups", array("filepath"=>$this->filepath), "");
			foreach ($acl_g_rows as $acl_g_row) {
				$acl_g_row['filepath'] = $newfilepath;
				insert_bhdb("aclgroups", $acl_g_row);
			}
			
			$acl_p_rows = select_bhdb("aclpublic", array("filepath"=>$this->filepath), "");
			foreach ($acl_p_rows as $acl_p_row) {
				$acl_p_row['filepath'] = $newfilepath;
				insert_bhdb("aclpublic", $acl_p_row);
			}
			
			$fc_rows = select_bhdb("filecodes", array("filepath"=>$this->filepath), "");
			foreach ($fc_rows as $fc_row) {
				$fc_row['filepath'] = $newfilepath;
				insert_bhdb("filecodes", $fc_row);
			}
			
			$md_rows = select_bhdb("metadata", array("filepath"=>$this->filepath), "");
			foreach ($md_rows as $md_row) {
				$md_row['filepath'] = $newfilepath;
				insert_bhdb("metadata", $md_row);
			}
			
		# Remove old db entries
		$this->removedb();
		
		# Change identity
		$this->filepath = $newfilepath;
		$this->absfilepath = $bhconfig['fileroot'].$this->filepath;
		$this->check();						# Check / create metadata.
		$this->loadmetadata();					# Load metadata.
		
		chmod($this->absfilepath, 0777);
		$this->rescan();
		
		# Done.
		
	}
	
	# This copies the file while retaining all permissions, etc. It doesn't assume the identity of the new file after.
	function copyto($newfilepath, $aclonly = 0) {
		global $bhconfig;
		
		# Clean up filepath
		$newfilepath = bh_fpclean($newfilepath);
		
		if ($aclonly == 0) {
			if ($this->is_dir()) {
			
			} else {
				copy($this->absfilepath, $bhconfig['fileroot'].$newfilepath);
				
				chmod($bhconfig['fileroot'].$newfilepath, 0777);
			}
		}
		
		# If directory, do the ACL stuff for all files.
		if ($this->is_dir()) {
			$this->loadfile();
			if ($aclonly == 0) {
				@mkdir($bhconfig['fileroot'].$newfilepath, 0777);
			}
			foreach ($this->filecontents as $file2copy) {
				#echo "(".$file2copy['filepath']." --to-- ".bh_fpclean($newfilepath."/".bh_get_filename($file2copy['filename'])).") ";
				$file2copyobj = new bhfile($file2copy['filepath']);
				$file2copyobj->copyto(bh_fpclean($newfilepath."/".bh_get_filename($file2copy['filename'])));
				unset($filetocopyobj);
			}
		}
		
		# Insert ACL/metadata/filecode entries of old self			
			$acl_u_rows = select_bhdb("aclusers", array("filepath"=>$this->filepath), "");
			foreach ($acl_u_rows as $acl_u_row) {
				$acl_u_row['filepath'] = $newfilepath;
				insert_bhdb("aclusers", $acl_u_row);
			}
			
			$acl_g_rows = select_bhdb("aclgroups", array("filepath"=>$this->filepath), "");
			foreach ($acl_g_rows as $acl_g_row) {
				$acl_g_row['filepath'] = $newfilepath;
				insert_bhdb("aclgroups", $acl_g_row);
			}
			
			$acl_p_rows = select_bhdb("aclpublic", array("filepath"=>$this->filepath), "");
			foreach ($acl_p_rows as $acl_p_row) {
				$acl_p_row['filepath'] = $newfilepath;
				insert_bhdb("aclpublic", $acl_p_row);
			}
			
			$md_rows = select_bhdb("metadata", array("filepath"=>$this->filepath), "");
			foreach ($md_rows as $md_row) {
				$md_row['filepath'] = $newfilepath;
				insert_bhdb("metadata", $md_row);
			}
			
		
			
		# Done.
		
	}
	
	# This function returns an associative array of users and their rights to this file (only those in db).
	# e.g. array(username=>rights)
	function usersrights() {
		
		# Select all db (aclusers) rows that have us in them
		$aclusersrows = select_bhdb("aclusers", array("filepath"=>$this->filepath), "");
		
		# Loop through and create the associative array
		foreach ($aclusersrows as $aclusersrow) {
			$aclusers[$aclusersrow['username']] = $aclusersrow['status'];
		}
		
		# Return array
		return $aclusers;
		
	}
	
	# This function returns an associative array of groups and their rights to this file (only those in db).
	# e.g. array(group=>rights)
	function groupsrights() {
		
		# Select all db (aclgroups) rows that have us in them
		$aclgroupsrows = select_bhdb("aclgroups", array("filepath"=>$this->filepath), "");
		
		# Loop through and create the associative array
		foreach ($aclgroupsrows as $aclgroupsrow) {
			$aclgroups[$aclgroupsrow['group']] = $aclgroupsrow['status'];
		}
		
		# Return array
		return $aclgroups;
		
	}
	
	# This function returns the public right to the file
	function publicrights() {
		
		# Select the aclpublic row(s) that has us in it
		$aclpublicrows = select_bhdb("aclpublic", array("filepath"=>$this->filepath), "");
		
		# Loop through and assign them to the same variable
		# This way we only get the last one. And I don't have to use sort() or aclgrouprows[0]
		foreach ($aclpublicrows as $aclpublicrow) {
			$aclpublic = $aclpublicrow['status'];
		}
		
		# Return value
		return $aclpublic;
		
	}
	
	# This sets the public right to the parameter
	function set_publicrights($status, $recursion = 1) {
		if ($this->is_dir() && $recursion == 1) {
			$this->loadfile();
			foreach ($this->filecontents as $file2set) {
				$file2setobj = new bhfile($file2set['filepath']);
				$file2setobj->set_publicrights($status);
			}
		}
		$publicrows = select_bhdb("aclpublic", array("filepath"=>$this->filepath), "");
		if (!empty($publicrows)) {
			update_bhdb("aclpublic", array("status"=>$status), array("filepath"=>$this->filepath));
		} else {
			insert_bhdb("aclpublic", array("filepath"=>$this->filepath, "status"=>$status));
		}
		
	}
	
	# This sets the user's right to the parameter
	function set_userrights($username, $status, $recursion = 1) {
		if ($this->is_dir() && $recursion == 1) {
			$this->loadfile();
			foreach ($this->filecontents as $file2set) {
				$file2setobj = new bhfile($file2set['filepath']);
				$file2setobj->set_userrights($username, $status);
			}
		}
		
		if ($status >= 0) {
			$userrows = select_bhdb("aclusers", array("username"=>$username, "filepath"=>$this->filepath), "");
			if (!empty($userrows)) {
				update_bhdb("aclusers", array("status"=>$status), array("username"=>$username, "filepath"=>$this->filepath));
			} else {
				insert_bhdb("aclusers", array("username"=>$username, "filepath"=>$this->filepath, "status"=>$status));
			}
		} else {
			delete_bhdb("aclusers", array("username"=>$username, "filepath"=>$this->filepath));
		}
	}
	
	# This sets the group's right to the parameter
	function set_grouprights($group, $status, $recursion = 1) {
		if ($this->is_dir() && $recursion == 1) {
			$this->loadfile();
			foreach ($this->filecontents as $file2set) {
				$file2setobj = new bhfile($file2set['filepath']);
				$file2setobj->set_grouprights($group, $status);
			}
		}
		
		if ($status >= 0) {
			$grouprows = select_bhdb("aclgroups", array("group"=>$group, "filepath"=>$this->filepath), "");
			if (!empty($grouprows)) {
				update_bhdb("aclgroups", array("status"=>$status), array("group"=>$group, "filepath"=>$this->filepath));
			} else {
				insert_bhdb("aclgroups", array("group"=>$group, "filepath"=>$this->filepath, "status"=>$status));
			}
		} else {
			delete_bhdb("aclgroups", array("group"=>$group, "filepath"=>$this->filepath));
		}
	}
	
	# Returns a file stream pointer. For WebDAV, mostly.
	function filestream() {
		return fopen($this->absfilepath, "r");
	}
	
	# Reads the file from a stream into the file. For... WebDAV.
	function filefromstream(&$stream) {
		$this->filecontents = "";
		while ($filedata = fread($stream, 2048)) {
			$this->filecontents .= $filedata;
		}
		$this->savefile();
		
	}
	
	# Calculates MD5 hash
	function md5() {
		global $bhlang;
		
		# If the file is >100MB, then don't calculate.
		if ($this->fileinfo['filesize'] > (1024*1024*100)) {
			return $bhlang['error:md5_file_too_large'];
		} else {
			return md5_file($this->absfilepath);
		}
	}

}

# This function cleans any string passed to it so it's a valid filepath - in case something sends a bad one.
function bh_fpclean($filepath) {
	
	$filepath = urldecode(str_replace("/..", "", $filepath));		# Get rid of any nasty directory ups and URL encodes.
		  
	if (substr($filepath, -1) == "/") {
		  $filepath = substr($filepath, 0, -1);		# Get rid of any trailing slashes.
	}
	
	if (substr($filepath, 0, 1) != "/") {
		$filepath = "/".$filepath;			# Add a root slash if one's missing.
	}
	
	$badcharacters = array("'", '"', "\\");
	
	$filepath = str_replace($badcharacters, "", $filepath);		# Get rid of any bad characters
	$filepath = str_replace("//", "/", $filepath);		# Get rid of any double slashes
	
	return $filepath;
}

# This returns the filepath of the file's parent directory.
function bh_fpparent($filepath) {
	
	# Explode path
	$folderarray = explode("/", $filepath);
	
	# Set nextlevel to root.
	$nextlevel = "/";
	
	# For each level, add it until it's one less than the real path, then strip the trailing slash.
	foreach ($folderarray as $key=>$level) {
 		if ($key != count($folderarray)-1) {
 			$nextlevel .= $level."/";
 		} else {
			$nextlevel = substr($nextlevel, 0, -1);
			last;
 		}
 	}
	# And relax.
	return bh_fpclean($nextlevel);
	
}

# This returns an array containing the folders as keys and their level as value. Pass it a filepath to expand there.
function bh_foldersarray($path = "/", $level = 0, $opento = "/", $username = "guest", $fulllist = 0, $accesslevel = 1) {
	global $bhconfig;
	
	$files = array();
	
	$files[] = array('path'=>$path, 'level'=>$level);
	
	if ($fulllist == 0) {
		# See if we're too deep anyway
		if (substr_count($path, "/")>substr_count($opento, "/")) { return $files; }
		
		# Check to see if we're allowed to search this directory
		if ($path != substr($opento, 0, strlen($path))) { return $files; }
	}
	if (defined("BH_ROOT")) {
		$handle = opendir($bhconfig['fileroot'].$path);
	} else {
		$handle = opendir($bhconfig['fileroot'].$path);
	}
	
	while (false !== ($file = readdir($handle))) {
		# Check to see if we're allowed to view it.
		if (bh_checkrights($path.$file."/", $username) >= $accesslevel) {
			if ($bhconfig['hidedotfiles'] == 1) {
				if ((!preg_match("/^\.{1,2}/", $file)) && (is_dir($bhconfig['fileroot'].$path.$file))) {
					$files = array_merge($files, bh_foldersarray($path.$file."/", ($level+1), $opento, $username, $fulllist, $accesslevel));
				}
			} else {
				if ((!preg_match("/^\.{1,2}$/", $file)) && (is_dir($bhconfig['fileroot'].$path.$file))) {
					$files = array_merge($files, bh_foldersarray($path.$file."/", ($level+1), $opento, $username, $fulllist, $accesslevel));
				}
			}
		}
	}
	closedir($handle);
	
	return $files;
	
}

# This returns the passed username's access rights to a specified filepath.
function bh_checkrights($filepath, $username = "") {

	$filepath = bh_fpclean($filepath);

	$maxaccesslevel = 0;
	
	# Check their user type
	$userobj = new bhuser($username);
	if ($userobj->type == "admin") { $maxaccesslevel = 3; }
	
	# Check their username rights
	if ($aclrows = select_bhdb("aclusers", array("filepath"=>$filepath, "username"=>$username), "")) {
		if ($aclrows[0]['status'] > $maxaccesslevel) { $maxaccesslevel = $aclrows[0]['status']; }
	}
	
	# Check their group rights
	$grouprows = select_bhdb("groupusers", array("username"=>$username), "");
	foreach ($grouprows as $grouprow) {
		if ($aclrows = select_bhdb("aclgroups", array("filepath"=>$filepath, "group"=>$group), "")) {
			if ($aclrows[0]['status'] > $maxaccesslevel) { $maxaccesslevel = $aclrows[0]['status']; }
		}
	}
	
	# Check the public rights
	if ($aclrows = select_bhdb("aclpublic", array("filepath"=>$filepath), "")) {
		if ($aclrows[0]['status'] > $maxaccesslevel) { $maxaccesslevel = $aclrows[0]['status']; }
	}
	
	return $maxaccesslevel;

}

function bh_get_extension($filepath) {
	$filepatharray = explode(".", $filepath);
	return $filepatharray[count($filepatharray)-1];
}

function bh_get_filename($filepath) {
	$filepatharray = explode("/", $filepath);
	return $filepatharray[count($filepatharray)-1];
}

function bh_file_exists($filepath) {
	global $bhconfig;
	if (defined("BH_ROOT")) {
		return file_exists($bhconfig['fileroot'].$filepath);
	} else {
		return file_exists($bhconfig['fileroot'].$filepath);
	}
	
}

# Sees if the file exists based on permissions
function bh_user_file_exists($filepath) {
	global $bhconfig, $bhsession;
	
	$filepath = bh_fpclean($filepath);
	
	$really = bh_file_exists($filepath);
	if ($really == 0) { return false; }
	else {
		if (bh_checkrights($filepath, $bhsession['username']) > 0) {
			return true;
		} else {
			return false;
		}
	}
}

# alias for bh_fpparent
function bh_get_parent($filepath) {
	return bh_fpparent($filepath);
}

# Used for uploads
function bh_move_uploaded_file($tmppath, $newpath) {
	global $bhconfig;
	
	if (defined("BH_ROOT")) {
		move_uploaded_file($tmppath, $bhconfig['fileroot'].$newpath);
	} else {
		move_uploaded_file($tmppath, $bhconfig['fileroot'].$newpath);
	}
	
	
	if ($bhconfig['webserving'] == 1) {
		chmod($newpath, 0755);
	}
	
}

# Creates a directory
function bh_mkdir($filepath) {
	global $bhconfig;
	if (defined("BH_ROOT")) {
		return mkdir($bhconfig['fileroot'].$filepath, 0777);
	} else {
		return mkdir($bhconfig['fileroot'].$filepath, 0777);
	}
	
}

# Returns an array of the files owned by the specified user
function bh_user_files($username) {

	$files = array();
	$filerows = select_bhdb("aclusers", array("username"=>$username, "status"=>3), "");
	foreach ($filerows as $filerow) {
		$files[] = $filerow['filepath'];
	}
	return $files;

}

# Trashes (i.e. puts into a 'recycle bin') the file. Instead of deleting.
function bh_trash($absfilepath) {
	global $bhconfig;

	if (!bh_file_exists(bh_fpclean("/trash"))) {
		bh_mkdir(bh_fpclean("/trash"), 0777);
	}
	
	if (defined("BH_ROOT")) {
		rename($absfilepath, ($bhconfig['fileroot'].bh_fpclean("/trash")."/".bh_get_filename($absfilepath)));
		chmod(($bhconfig['fileroot'].bh_fpclean("/trash")."/".bh_get_filename($absfilepath)), 0777);
	} else {
		rename($absfilepath, ($bhconfig['fileroot'].bh_fpclean("/trash")."/".bh_get_filename($absfilepath)));
		chmod(($bhconfig['fileroot'].bh_fpclean("/trash")."/".bh_get_filename($absfilepath)), 0777);
	}
	
}