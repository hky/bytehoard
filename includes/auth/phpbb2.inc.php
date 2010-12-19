<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Authentication include
 *   $Id: phpbb2.inc.php,v 1.2 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
/*

Second generation of authentication. The main script queries these functions to determine what to do.
Session handling is included. Yippee.

For phpBB2.

*/

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }


# Configuration:
$bhconfig['phpbb_db'] = $dbconfig['db'];
$bhconfig['phpbb_prefix'] = "phpbb_";

# Need this to del with phpbbised ips
if (!function_exists("encode_ip")) {
	function encode_ip($dotquad_ip)
	{
		$ip_sep = explode('.', $dotquad_ip);
		return sprintf('%02x%02x%02x%02x', $ip_sep[0], $ip_sep[1], $ip_sep[2], $ip_sep[3]);
	}
}

# This function returns an array with the current session details, which have to be the same for everything.
# Currentely, only the current username is returned.
# If you want auto handling of user creation (i.e. creation if their session comes in without an account here), creation should go here.
function bh_session() {
	global $dbconfig, $bhconfig;
	
	# Get the phpBB cookie
	$sessid = $_COOKIE['phpbb2mysql_sid'];
	
	# Retrieve the session details from the phpbb database.
	# (set the prefix to phpbb_ first)
	$oldprefix = $dbconfig['prefix'];
	$olddb = $dbconfig['db'];
	$dbconfig['prefix'] = $bhconfig['phpbb_prefix'];
	$dbconfig['db'] = $bhconfig['phpbb_db'];
	
	$sessrows = select_bhdb("sessions", array("session_id"=>$sessid, "session_logged_in"=>1), "");
	
	
	
	# If there's nothing there return nothing
	if (empty($sessrows)) { $dbconfig['prefix'] = $oldprefix; $dbconfig['db'] = $olddb; return array("username"=>""); }
	else {
		# Get the userid for this row
		foreach ($sessrows as $sessrow) {
			$userid = $sessrow['session_user_id'];
		}
		
		# Get the username for that id
		$userrows = select_bhdb("users", array("user_id"=>$userid), 1);
		foreach ($userrows as $userrow) {
			$username = $userrow['username'];
		}
		
		$dbconfig['prefix'] = $oldprefix;
		$dbconfig['db'] = $olddb;
		
		$userobj = new bhuser($username);
		
		return array("username"=>$username);
	}
	
	
}

# This function starts up a session for the specified username. For logging in, really.
# Returns the bhsession array as above.
function bh_session_create($username) {
	global $dbconfig, $bhconfig;
	
	# Create the session id
	srand(microtime()*microtime());
	$sessionid = md5(rand(1, 9999999).rand(1, 9999999).rand(1, 9999999).rand(1, 9999999));
	
	
	$oldprefix = $dbconfig['prefix'];
	$olddb = $dbconfig['db'];
	$dbconfig['prefix'] = $bhconfig['phpbb_prefix'];
	$dbconfig['db'] = $bhconfig['phpbb_db'];
	
	# Get the user id for the username
	$userrows = select_bhdb("users", array("username"=>$username), 1);
	foreach ($userrows as $userrow) {
		$userid = $userrow['user_id'];
	}
		
	# Insert session row
	insert_bhdb("sessions", array("session_id"=>$sessionid, "session_user_id"=>$user_id, "session_start"=>time(), "session_time"=>time(), "session_ip"=>encode_ip($_SERVER['REMOTE_ADDR']), "session_page"=>"0", "session_logged_in"=>"1"));
	
	$dbconfig['prefix'] = $oldprefix;
	$dbconfig['db'] = $olddb;

	return array("username"=>$username);
}

# This function ends the user's session. For logout.
# Returns the bhsession array as above.
function bh_session_destroy() {
	global $dbconfig, $bhconfig;
	
	# Mark the session as not logged in
	$oldprefix = $dbconfig['prefix'];
	$olddb = $dbconfig['db'];
	$dbconfig['prefix'] = $bhconfig['phpbb_prefix'];
	$dbconfig['db'] = $bhconfig['phpbb_db'];
	
	update_bhdb("sessions", array("session_logged_in"=>"0", "session_user_id"=>"-1"), array("session_id"=>$sessid));
	
	$dbconfig['prefix'] = $oldprefix;
	$dbconfig['db'] = $olddb;

	return array("username"=>"");
}

# Returns true on correct login, false otherwise. 
# It just tries to select a row with a matching uname/password, and if it does, you're allowed in.
function bh_authenticate($username, $password) {
	global $dbconfig, $bhconfig;

	$oldprefix = $dbconfig['prefix'];
	$olddb = $dbconfig['db'];
	$dbconfig['prefix'] = $bhconfig['phpbb_prefix'];
	$dbconfig['db'] = $bhconfig['phpbb_db'];

	$md5password = md5($password);
	
	$authrows = select_bhdb("users", array('username'=>$username, 'user_password'=>$md5password), 1);
	
	$dbconfig['prefix'] = $oldprefix;
	$dbconfig['db'] = $olddb;
	
	if (empty($authrows)) { return 0; }
	else { return 1; }

}