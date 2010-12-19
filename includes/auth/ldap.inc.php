<?php

/*
 * ByteHoard 2.1
 * Copyright (c) 2006
 *
 *   Authentication include against LDAP
 *   NEED some more configuration parameters in config table
 *   ldapsrv : host or ip for the ldap server
 *   ldapport : port number, default is 389
 *   ldapbase : base for ldap search. Must allow anonymous search
 *   ldapattr : attribute name to use for search of users. filters will be $ldapattr=$login
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
	global $bhconfig;
	$port = ($bhconfig['ldapport'] ? $bhconfig['ldapport']:389);
	
	// Connect to LDAP server
	$ds=@ldap_connect($bhconfig['ldapsrv'],$port);
	
	if ($ds) {
		// Bind as anonymous
		$r=@ldap_bind($ds);
		
		// find user entry in the tree
		$sr=@ldap_search($ds,
			$bhconfig['ldapbase'],
			$bhconfig['ldapattr']."=$username"
			); 
   		
   		// Must find one entry, no more no less
   		if (@ldap_count_entries($ds,$sr) != 1) {
   			// user unknown
   			@ldap_close($ds);
   			return 0;
   		}

		// find entry in the result set
		if (($entry=@ldap_first_entry($ds, $sr))==false) {
   			// user unknown
   			@ldap_close($ds);
   			return 0;
		}

		// bind as the user to verify pasword
		$dn=ldap_get_dn($ds,$entry);
		$r=@ldap_bind($ds,$dn,$password);
		
		// Link no longer needed
		@ldap_close($ds);
		if ($r) {
			return 1;
		} else {
			return 0;
		}
	} else {
		return 0;
	}
}

# Changes passwords. MUST return TRUE on success and FALSE on failure.
function bh_auth_set_password($username, $password) {
	# NOT SUPPORTED
	return false;
}