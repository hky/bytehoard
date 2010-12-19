<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: login.inc.php,v 1.1.1.1 2005/02/28 21:50:16 andrewgodwin Exp $
 *
 */
 
#name Login Form
#author Andrew Godwin
#description Displays the login form so login info can be submitted.

# Open layout object
$layoutobj = new bhadminlayout("login");

# Send the file listing to the layout, along with directory name
$layoutobj->title = $bhlang['title:login'];
$layoutobj->content1 = $bhlang['explain:login'];

$layoutobj->display();