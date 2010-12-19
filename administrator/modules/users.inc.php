<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: users.inc.php,v 1.2 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */
 
#name Users List
#author Andrew Godwin
#description Displays a list of users.
#iscore 1

$layout = new bhadminlayout("userslist");

$group = $_GET['group'];

if (empty($group)) { $group = $_POST['group']; }
if (empty($group)) { $group = "All"; }

$usersbygroup = bh_usersbygroup();

$layout->content1 = $usersbygroup;
$layout->content2 = $group;
$layout->title = $bhlang['title:user_administration'];
$layout->display();
