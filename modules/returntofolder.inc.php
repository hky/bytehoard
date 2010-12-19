<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: returntofolder.inc.php,v 1.1 2005/07/26 21:55:09 andrewgodwin Exp $
 *
 */
 
#name Return To Folder
#author Andrew Godwin
#description Goes to the folder that the passed file is in.
#iscore 1

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# Get the directory
$filepath = bh_fpclean(bh_get_parent($_GET['filepath']));
$_GET['filepath'] = $filepath;

# Include the viewdir module
require "modules/viewdir.inc.php";