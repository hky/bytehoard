<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: returntofolder.inc.php,v 1.1 2005/07/26 21:55:09 andrewgodwin Exp $
 *
 */
 
#name Admin Center Redirect
#author Andrew Godwin
#description Makes the user go to the admin center.
#iscore 1

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# Send header and die
header("Location: administrator/");
die();