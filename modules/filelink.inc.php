<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2005
 *
 *   Module
 *   $Id: filelink.inc.php,v 1.1 2005/07/28 20:11:47 andrewgodwin Exp $
 *
 */
 
#name File Link Module
#author Andrew Godwin
#description Does the one-time time-expiring links. This only generates them, serving them is done by a separate PHP process (filelink.php)

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

$filepath = $_GET['filepath'];
if (empty($filepath)) { $filepath = $_POST['filepath']; }
if (empty($filepath)) { bh_die("error:no_filepath"); }
$filepath = bh_fpclean($filepath);

# See if we have details passed to us in the POST
if (!empty($_POST['filemail'])) {
	# Check to see if we email or not
	if ($_POST['filemail']['linkonly'] == "on") {
		# Check expiry date
		$expiresin = $_POST['filemail']['expires'];
		if (is_numeric($expiresin) && ($expiresin > 0)) { 
			if ($expiresin > $bhconfig['maxexpires']) {
				bh_log($bhlang['error:expires_too_much'], "BH_ERROR");
			} else {
				if ($_POST['filemail']['notify'] == "on") { $notify = 1; } else { $notify = 0; }
				$expires = time() + round($expiresin*60*60*24);
				$filecode = bh_filelink_add($filepath, $expires, $bhsession['username'], "--none--", $notify);
				$str = "<br>".str_replace("#EXPIRE#", $expiresin, $bhlang['text:link__expire_in_#EXPIRE#'])." <a href='".bh_filelink_uri($filecode)."'>".bh_filelink_uri($filecode)."</a><br><br><br>";
				if ((bh_get_extension($filepath) == "png")||(bh_get_extension($filepath) == "gif")||(bh_get_extension($filepath) == "jpg")||(bh_get_extension($filepath) == "jpeg")||(bh_get_extension($filepath) == "tif")||(bh_get_extension($filepath) == "tiff")||(bh_get_extension($filepath) == "bmp")) {
					$str .= $bhlang['title:image_tags']."<br><br>".$bhlang['label:html']."<br>&lt;img src=\"".bh_filelink_uri($filecode)."&download=1\" /&gt;<br><br>";
					$str .= $bhlang['label:bbcode']."<br>[img]".bh_filelink_uri($filecode)."&download=1[/img]<br>";
				}
			}
		} else {
			bh_log($bhlang['error:expires_invalid'], "BH_ERROR");
		}
	} else {
		# Check for empty subject
		if (empty($_POST['filemail']['subject'])) {
			bh_log($bhlang['error:no_emailsubj'], "BH_ERROR");
		} else {
			# Check expiry date
			$expiresin = $_POST['filemail']['expires'];
			if (is_numeric($expiresin) && ($expiresin > 0)) { 
				if ($expiresin > $bhconfig['maxexpires']) {
					bh_log($bhlang['error:expires_too_much'], "BH_ERROR");
				} else {
					$expires = time() + round($expiresin*60*60*24);
					# Split email addresses up
					$emails = explode(",", $_POST['filemail']['email']);
					# Loop through them and then check & send
					foreach ($emails as $email) {
						if (empty($email)) { if (empty($_POST['filemail']['email'])) { bh_log($bhlang['error:no_emailaddr'], "BH_ERROR"); } }
						elseif (strpos($email, "@") === FALSE) {
							bh_log(str_replace("#EMAIL#", $email, $bhlang['error:invalid_email_#EMAIL#']), "BH_ERROR");
						} 
						else {
							if ($_POST['filemail']['notify'] == "on") { $notify = 1; } else { $notify = 0; }
						
							$userobj = new bhuser($bhsession['username']);
							$emailfrom = $userobj->userinfo['email'];
							
							$filecode = bh_filelink_add($filepath, $expires, $bhsession['username'], $email, $notify);
							$emailobj = new bhemail($email);
							$emailobj->subject = $_POST['filemail']['subject'];
							
							$fileobj = new bhfile($filepath);
							$filesize = bh_humanise_filesize($fileobj->fileinfo['filesize']);
							
							
							$findarr = array("#DATE#", "#LINK#", "#SYSTEMNAME#", "#FILENAME#", "#FILESIZE#", "#MD5#");
							$replarr = array(date("l dS F Y g:i A", $expires), bh_filelink_uri($filecode), $bhconfig['sitename'], bh_get_filename($filepath), $filesize, $fileobj->md5());
							
							$emailobj->message = $_POST['filemail']['message']."\n\n".str_replace($findarr, $replarr, $bhlang['email:filemail_footer']);
							if (!empty($emailfrom)) { $emailobj->from = $emailfrom; }
							$emailobj->send();
							bh_log(str_replace("#EMAIL#", $email, $bhlang['notice:email_sent_to_#EMAIL#']), "BH_NOTICE");
						}
					}
				}
			} else {
				bh_log($bhlang['error:expires_invalid'], "BH_ERROR");
			}
		}
	}
	# Open layout object
	$layoutobj = new bhlayout("generic");
	$layoutobj->title = $bhlang['title:filemail'];
	$layoutobj->content1 = $str."<br><br><a href='javascript:history.go(-1);'>".$bhlang['button:back']."</a>";
	$layoutobj->display();

} else {
	$filename = bh_get_filename($filepath);
	# Pass the filepath and filename to the layout.
	# Open layout object
	$layoutobj = new bhlayout("filelinkform");
	
	# Generate the select box for the expiry time.
	
	
	# Send the file listing to the layout, along with directory name
	$layoutobj->title = $bhlang['title:filemail'];
	$layoutobj->content1 = $filename;
	$layoutobj->filepath = $filepath;
	
	$layoutobj->display();
}

?>