<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Texts functions
 *   $Id: texts.inc.php,v 1.2 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
/*

Text loaders and savers.

*/

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }


# Returns the text
function bh_text($textname) {
	$textrows = select_bhdb("texts", array("textname"=>$textname), 1);
	return $textrows[0]['textbody'];
}