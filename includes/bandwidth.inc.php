<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2003-2004
 *
 *   Bandwidth Functions File
 *   $Id: bandwidth.inc.php,v 1.3 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
/*

This file contains the functions that log the bandwidth use of users for up/down.
It's new, it's Orwellian, and it's not entirely accurate.
If you download and then cancel you're logged as having used the entire file's worth.
Page views aren't counted, including thumbnails.
For this reason, I don't plan on stopping people uploading/downloading based on it.
It's a very rough guide, and should be treated as such.
I need to put that in the docs...

*/

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

function bh_bandwidth($username, $type, $bytes) {

	# Was going to make it do cumulative records, but per-date is probably better, as we can see for periods of time, i.e. days of week, hours, etc., should someone want that.

	# Create new record
	insert_bhdb("bandwidth", array("username"=>$username, "time"=>time(), "type"=>$type, "bytes"=>$bytes));

}

function bh_get_total_bandwidth($username, $type) {

	$bandrows = select_bhdb("bandwidth", array("username"=>$username, "type"=>$type), "");
	
	foreach ($bandrows as $bandrow) {
	
		$totalbytes += $bandrow['bytes'];
	
	}
	
	return $totalbytes; 

}