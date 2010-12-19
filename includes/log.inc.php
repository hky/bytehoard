<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2003-2004
 *
 *   Log Functions File
 *   $Id: log.inc.php,v 1.3 2005/07/28 20:11:47 andrewgodwin Exp $
 *
 */
 
/*

This include contains the logging function - pass it a message and the message type and it will do what it needs to do.

*/

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# Log function
function bh_log($message, $type) {
	global $bhlang, $bhcurrent, $bhconfig, $bherrors;
	# This is the all-singing, all-dancing logging system.
	
	# First, retrieve all actions matching this type from the database
	$matchingactions = select_bhdb("logactions", array("type"=>$type), "");
	
	# Then, see if there are some, and go through them if there are.
	if (!empty($matchingactions)) {
		foreach ($matchingactions as $matchingaction) {
		
			# Try to match the action to the ones we know about.
			switch ($matchingaction['action']) {
				
				case "fileappend":
				case "logtofile":
					# Append to a file. Check if we have a filename, or just log to the default one.
					if (!empty($matchingaction['parameters'])) {
						$fn = @fopen($bhconfig['bhfilepath']."/".$matchingaction['parameters'], "a");
						@fputs($fn, time().":".$_SERVER['REMOTE_ADDR'].":".$message."\n");
						@fclose($fn);
					} elseif (!empty($bhconfig['logfile'])) {
						$fn = @fopen($bhconfig['bhfilepath']."/".$bhconfig['logfile'], "a");
						@fputs($fn, time().":".$_SERVER['REMOTE_ADDR'].":".$message."\n");
						@fclose($fn);
					} else {
						$fn = @fopen($bhconfig['bhfilepath']."/log", "a");
						@fputs($fn, time().":".$_SERVER['REMOTE_ADDR'].":".$message."\n");
						@fclose($fn);
					}
				break;
				
				case "email":
					# Email it to someone. Check for a specified email address, or fail.
					if (!empty($matchingaction['parameters'])) {
						$emailobj = new bhemail($matchingaction['parameters']);
						$emailobj->subject = "Notification from ByteHoard @ ".$_SERVER['HTTP_HOST'];
						$emailobj->sig = "\n\n\nPowered by ByteHoard ".$bhconfig['version']." / Sent at ".date("l dS F Y h:i:s A");
						$emailobj->message = $message;
						$emailobj->send();
					} else {
						# Nothing to do. Oh well.
					}
				break;
				
				case "emailtype":
					# Email it to them. Check for a specified type, or fail.
					if (!empty($matchingaction['parameters'])) {
						$emailobj = new bhemail();
						$emailobj->subject = "Notification from ByteHoard @ ".$_SERVER['HTTP_HOST'];
						$emailobj->sig = "\n\n\nPowered by ByteHoard ".$bhconfig['version']." / Sent at ".date("l dS F Y h:i:s A");
						$emailobj->message = $message;
						$emailobj->sendtotype($matchingaction['parameters']);
					} else {
						# Nothing to do. Oh well.
					}
				break;
				
				case "onscreen":
					# Set error in template thingmywatsit.
					$bherrors[] = array('message'=>$message, 'type'=>$matchingaction['parameters']);
				break;
			}
		}
	} else {
		# Set error in template thingmywatsit.
		$bherrors[] = array('message'=>$message, 'type'=>'warning');
	}
}

# Sets logging variables to parse lang strings.
function bh_add_logvars($vars) {
	global $bhlogvars;
	
	if (is_array($vars)) {
		if (is_array($bhlogvars)){
			$bhlogvars = array_merge($vars, $bhlogvars);
		} else {
			$bhlogvars = $vars;
		}
	}
}

# Set some on script inclusion
bh_add_logvars(array("ip"=>$_SERVER['REMOTE_ADDR']));

# Will parse a string and replace #THESE# with their logvar, if found.
function bh_parse_logvars($string) {
	global $bhlogvars;
	
	if (is_array($bhlogvars)) { 
	foreach ($bhlogvars as $var=>$val) {
		$string = str_replace("#".strtoupper($var)."#", $val, $string);
	}
	}
	
	return $string;
}

# Displays a notice
function bh_add_notice($message) {
	global $bherrors, $bhlogvars;
	
	$bherrors[] = array('message'=>bh_parse_logvars($message), 'type'=>'notice');
}

# Displays a warning
function bh_add_warning($message) {
	global $bherrors, $bhlogvars;
	
	$bherrors[] = array('message'=>bh_parse_logvars($message), 'type'=>'warning');
}

# Displays an error
function bh_add_error($message) {
	global $bherrors, $bhlogvars;
	
	$bherrors[] = array('message'=>bh_parse_logvars($message), 'type'=>'error');
}

function bh_add_log($message, $type) {
	global $bhlogvars;
	
	bh_log(bh_parse_logvars($message), $type);
}

# Alias for bh_log
function bh_error($message, $type) {
	return bh_log($message, $type);
}

# Internationalised die function
function bh_die($langkey) {
	global $bhlang, $bhconfig;
	
	if (empty($bhlang[$langkey])) {$str = "A fatal system error has occured for which there is no explanation. Please contact the ByteHoard team as soon as possible."; } else { $str = $bhlang[$langkey]; }
	
	die("<html><head><title>ByteHoard Error</title></head><body><h1>Error</h1><br>$str<br><hr><i>ByteHoard ".$bhconfig['version']."</i></body></html>");
}