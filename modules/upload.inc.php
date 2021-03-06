<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: upload.inc.php,v 1.5 2005/07/28 20:11:48 andrewgodwin Exp $
 *
 */
 
#name Upload Page
#author Andrew Godwin
#description Lets people upload files.
#iscore 1

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

if (empty($infolder)) { $infolder = $_GET['infolder']; }
if (empty($infolder)) { $infolder = $_POST['infolder']; }
if (empty($infolder)) { $infolder = $_SESSION['lastdir']; }
if (empty($infolder)) { $infolder = $bhcurrent['userobj']->homedir; }

# Loop through any posted files and save details in array
$fupload = array();
if (is_array($_FILES)) {
	foreach($_FILES as $varname => $fileinfo ){
		if(empty($fileinfo["name"]) !== TRUE) {
			$fupload[] = array('tempname' => $fileinfo["tmp_name"], 'name' => $fileinfo["name"], 'size' => $fileinfo["size"]);
		}
	}
} else {
	die("No uploaded files recieved. Fatal error.");
}

if ($_GET['uploadstatuspage'] == 1) {

	$uploadrows = select_bhdb("uploads", array("sessionid"=>session_id()), 1);
	if ((empty($uploadrows)) || ($uploadrows[0]['status'] == "uploading")) {
		
		$layoutobj = new bhlayout("popup_upload");
		$layoutobj->display();
		
	} elseif ($uploadrows[0]['status'] = "finished") {
	
		# Echo window closing script
		$str = "<html>\n<head>\n</head>\n<body>\n<script>self.close();</script>\n</body>\n</html>";
		echo $str;
		
		# Remove entry in DB
		delete_bhdb("uploads", array("sessionid"=>session_id()));
	
	} else {
	
		bh_log("Fatal error in upload notification system", "BH_ERROR");
		
	}

}
# If there are uploaded files...
elseif (count($fupload) > 0) {

	# Notify the popup to close
	$uploadrows = select_bhdb("uploads", array("sessionid"=>session_id()), 1);
	if (empty($uploadrows)) {
		insert_bhdb("uploads", array("sessionid"=>session_id(), "status"=>"finished"));
	} else {
		update_bhdb("uploads", array("status"=>"finished"), array("sessionid"=>session_id()));
	}

	# Calculate used bandwidth
	foreach($fupload as $fileinfo) {
		bh_bandwidth($bhsession['username'], "up", $fileinfo['size']);
	}

	# Check they can write to the destination directory
	if (bh_checkrights($infolder, $bhsession['username']) >= 2) {
		foreach($fupload as $fileinfo) {
			# If it's a valid upload...
			if (empty($fileinfo['name']) !== TRUE) {
				# Check the file actually exists.
				if (file_exists($fileinfo['tempname'])) {
					# Create thing of banned exts
					$bannedexts = array("exexexexex"=>1);
					$invalid = False;
					foreach ($bannedexts as $ext=>$one) {
						if (substr($fileinfo['name'], 0-(strlen($ext))) == $ext) {
							$invalid = True;
						}
					}
					# Check the file would not exceed the quota
					if ($bhcurrent['userobj']->spaceremaining() < $fileinfo['size']) {
						bh_add_logvars(array("quota"=>bh_humanise_filesize($bhcurrent['userobj']->quota)));
						bh_add_error($bhlang['error:quota_exceeded']);
					} elseif ($invalid) {
						print("You have tried to upload an invalid filetype.");
						exit();
					} else {
						# All fine, continue
						$badcharacters = array("'", '"', "\\");
						$newfilepath = bh_fpclean($infolder."/".str_replace($badcharacters, "", $fileinfo['name']));
						$tmppath = $fileinfo['tempname'];
						
						bh_move_uploaded_file($tmppath, $newfilepath);
						
						# Make it add info into the db.
						$newfileobj = new bhfile($newfilepath);
						unset($newfileobj);
						
						bh_log(str_replace("#FILE#", $fileinfo['name'], $bhlang['notice:file_#FILE#_upload_success']), "BH_NOTICE");
						bh_log(str_replace("#USER#", $bhsession['username'], str_replace("#FILE#", $newfilepath, $bhlang['log:#USER#_uploaded_#FILE#'])), "BH_FILE_UPLOAD");
					}
				} else {
					# Error???
					$newfilepath = bh_fpclean($infolder."/".$fileinfo['name']);
					bh_add_logvars(array("file"=>$fileinfo['name'], "user"=>$bhsession['username'], "username"=>$bhsession['username']));
					bh_add_error($bhlang['notice:file_#FILE#_upload_failure']);
					bh_add_log($bhlang['log:#USER#_failed_upload_#FILE#'], "BH_FILE_UPLOAD");
				}
			}
		}
		
		# Show directory where they went
		$_GET['filepath'] = $infolder;
		require "modules/viewdir.inc.php";
		
	} else {
		# Sorry, no access.
		bh_log($bhlang['error:no_write_permission'], "BH_ACCESS_DENIED");
		require "modules/error.inc.php";
	}

} else {


$layoutobj = new bhlayout("uploadform");
# Send the file listing to the layout, along with directory name
$layoutobj->title = $bhlang['title:upload'];
$layoutobj->content1 = $bhlang['explain:upload'];
$layoutobj->filepath = $infolder;
$layoutobj->display();

}