<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Authentication include
 *   $Id: bytehoard.inc.php,v 1.3 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
/*

Second generation of authentication. The main script queries these functions to determine what to do.
Session handling is included. Yippee.

*/

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# This function returns an array with the current session details, which have to be the same for everything.
# Currentely, only the current username is returned.
# If you want auto handling of user creation (i.e. creation if their session comes in without an account here), creation should go here.
function bh_session() {
	#session_start();
	return array("username"=>$_SESSION['username']);
}

# This function starts up a session for the specified username. For logging in, really.
# Returns the bhsession array as above.
function bh_session_create($username) {
	$_SESSION['username'] = $username;
	return array("username"=>$_SESSION['username']);
}

# This function ends the user's session. For logout.
# Returns the bhsession array as above.
function bh_session_destroy() {
	$_SESSION['username'] = "";
	return array("username"=>$_SESSION['username']);
}

# Returns true on correct login, false otherwise. 
# It just tries to select a row with a matching uname/password, and if it does, you're allowed in.
# -1 means disabled.
function bh_authenticate($username, $password) {

	$md5password = md5($password);
	
	$authrows = select_bhdb("users", array('username'=>$username, 'password'=>$md5password), 1);
	
	if (empty($authrows)) { return 0; }
	elseif ($authrows[0]['disabled'] == 1) { return -1; }
	else { return 1; }

}

# Changes passwords. MUST return TRUE on success and FALSE on failure.
function bh_auth_set_password($username, $password) {
	# Update the db row
	$result = update_bhdb("users", array("password"=>md5($password)), array("username"=>$username));
	# The _bhdb functions return false for success.
	return true;
}