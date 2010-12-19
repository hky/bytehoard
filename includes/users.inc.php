<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   User object class
 *   $Id: users.inc.php,v 1.10 2005/07/28 20:11:47 andrewgodwin Exp $
 *
 */
 
/*

This include handles the users and their profiles; it loads their data and checks their permissions on files if asked. Logins aren't handled here; they're part of another section.

*/

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

class bhuser {
	var $username;
	var $userinfo;
	var $homedir;
	var $type;
	var $disabled;
	var $quota;
	
	# Constructor
	function bhuser($username) {
		if (empty($username)) { $username = "guest"; }
		$this->username = $username;		# Make sure we know who we are.
		
		$userdatarows = select_bhdb("users", array("username"=>$this->username), "");	# Grab the user's data row.
		$this->homedir = $userdatarows[0]['homedir'];					# Put out their home directory.
		if ($username == "guest") { $this->homedir = "/"; }				# If guest, home dir is /
		if (empty($this->homedir)) { $this->homedir = "/".$username; }			# If they haven't got a home dir, use /user.
		if (!bh_file_exists($this->homedir)) { 						# If home dir doesn't exist, make it.
			bh_mkdir($this->homedir);
			$dirobj = new bhfile($this->homedir);
			$dirobj->set_userrights($username, 3);
		}		
		$this->type = $userdatarows[0]['type'];
		$this->disabled = $userdatarows[0]['disabled'];
		$this->quota = $userdatarows[0]['quota'];
		$this->loaduserinfo();			# Load profile information
	}
	
	# Loads the profile data into the userinfo array
	function loaduserinfo() {
		$userinforows = select_bhdb("userinfo", array("username"=>$this->username), "");	# Grab the array of metadata rows.
		
		foreach ($userinforows as $userinforow) {		# Loop through the rows, and assign metadata to the array.
			$this->userinfo[$userinforow['itemname']] = $userinforow['itemcontent'];
		}
	}
	
	# Saves the profile data
	function saveuserinfo() {
	
		foreach ($this->userinfo as $itemname=>$itemcontent) {
			$inforows = select_bhdb("userinfo", array("username"=>$this->username, "itemname"=>$itemname), "");
			
			if (empty($inforows)) {
				insert_bhdb("userinfo", array("username"=>$this->username, "itemname"=>$itemname, "itemcontent"=>$itemcontent));
			} else {
				update_bhdb("userinfo", array("itemcontent"=>$itemcontent), array("username"=>$this->username, "itemname"=>$itemname));
			}
		}
	}
	
	function getbandwidth($type = "down", $fromtime = "", $totime = "") {
	
		# Get all the rows applicable
		$bandrows = select_bhdb("bandwidth", array("username"=>$this->username, "type"=>$type), "");
		
		# Count them all up
		foreach ($bandrows as $bandrow) {
			# If there's a time limit, only use it
			if (!empty($fromtime)) {
				if ($bandrow['time'] >= $fromtime) {
					# If there's a top limit too, enforce that
					if (!empty($totime)) {
						if ($bandrow['time'] <= $totime) {
							$totalbandwidth += $bandrow['bytes'];
						}
					} else {
						$totalbandwidth += $bandrow['bytes'];
					}
				}
			} else {
				$totalbandwidth += $bandrow['bytes'];
			}
		}
		
		return $totalbandwidth;
	
	}
	
	function getusedspace() {
	
		$totalsize = 0;
	
		# Select all metadata size rows for that user + add them
		# Get all users' files. If they own it, we consider it theirs.
		$filerows = select_bhdb("aclusers", array("username"=>$this->username, "status"=>"3"), "");
		
		foreach ($filerows as $filerow) {
			$sizerows = select_bhdb("metadata", array("filepath"=>$filerow['filepath'], "metaname"=>"filesize"), 1);
			# Just in case the key changes.
			foreach ($sizerows as $sizerow) {
				$totalsize += $sizerow['metacontent'];
			}
		}
		
		return $totalsize;
	
	}
	
	function spaceremaining() {
		if ($this->quota == 0) {
			return 1024*1024*1024*1024;
		} else {
			return ($this->quota - $this->getusedspace());
		}
	}
	
	function changepassword($to) {
	
		# Update the row with the new password
		update_bhdb("users", array("password"=>md5($to)), array("username"=>$this->username));
	
	}
}

# Adds a user.
function bh_adduser($username, $password, $homedir = "/", $type="normal") {
	
	# Check user not already in db
	$userrows = select_bhdb("users", array("username"=>$username), 1);
	
	if (empty($userrows)) {
		insert_bhdb("users", array("username"=>$username, "password"=>md5($password), "homedir"=>$homedir, "type"=>$type));
	} else {
		update_bhdb("users", array("password"=>md5($password), "homedir"=>$homedir, "type"=>$type), array("username"=>$username));
	}

}

# Gets an array of groups with their users inside them
function bh_usersbygroup() {

	$grouprows = select_bhdb("groupusers", "", "");

	$usersbygroup = array();
	
	foreach ($grouprows as $grouprow) {
		$usersbygroup[$grouprow['group']][] = $grouprow['username'];
	}
	
	$allusers = select_bhdb("users", "", "");
	
	foreach ($allusers as $alluser) {
		if ($username != "guest") {
			$usersbygroup['All'][] = $alluser['username'];
		}
	}
	
	return $usersbygroup;

}

# Provides a human-readable filesize, not some long number of bytes.
# Future compataility with exabytes and petabytes and whatnot. I hope it will never be needed, though.
function bh_humanfilesize($size) {

  $sizes = Array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
  $ext = $sizes[0];
  for ($i=1; (($i < count($sizes)) && ($size >= 1024)); $i++) {
   $size = $size / 1024;
   $ext  = $sizes[$i];
  }
  return round($size, 2)." ".$ext;
  
}

# Retrieves what profile options are currentely in use.
function bh_get_profile_options() {
	# Get db row
	$optionrows = select_bhdb("config", array("variable"=>"profileoptions"), "");
	# If empty return the default (email & full name)
	if (empty($optionrows)) { return array("fullname", "email"); }
	# Return an array of those
	return explode(",", $optionrows[0]['value']);
}

# Wipes all old registration requests from the database
function bh_purge_old_registrations() {
	$rows = select_bhdb("registrations", array("status"=>"0"), "");
	foreach ($rows as $row) {
		if ($row['regtime'] < (time()-(60*60*24*7))) {
			delete_bhdb("registrations", array("regid"=>$row['regid']));
		}
	}
}

# Wipes all old password requests from the database
function bh_purge_old_passresets() {
	$rows = select_bhdb("passwordresets", "", "");
	foreach ($rows as $row) {
		if ($row['time'] < (time()-(60*60*24*2))) {
			delete_bhdb("passwordresets", array("resetid"=>$row['resetid']));
		}
	}
}

# Wipes all old stuff from the database
function bh_purge_old() {
	bh_purge_old_registrations();
	bh_purge_old_passresets();
	bh_filelink_remove_expired();
}