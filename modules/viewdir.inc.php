<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: viewdir.inc.php,v 1.2 2005/06/17 18:52:02 andrewgodwin Exp $
 *
 */
 
#name Directory Viewer
#author Andrew Godwin
#description Shows the files and directories inside a directory
#iscore 1

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# Open layout object
$layoutobj = new bhlayout("filelist");

# Grab the directory we're looking in
$filepath = bh_fpclean($_GET['filepath']);

# Open the file object for the directory
if (empty($filepath)) { $filepath = "/"; }
$directoryobj = new bhfile($filepath);

if ($directoryobj->is_dir() == FALSE) { bh_error($bhlang['error:not_a_dir'], "BH_INVALID_PATH"); }

# Set last directory cookie (for upload/create files/folders)
$_SESSION['lastdir'] = $filepath;

# See if there's a mode to set
if (!empty($_GET['view'])) { bh_setview($bhcurrent['userobj']->username, $filepath, $_GET['view']); }

# Get listing mode for this directory
$view = bh_view($bhcurrent['userobj']->username, $filepath);

$modulestouse = bh_listmodulesdirectory($filepath);

# Grab a listing of the files
$files = $directoryobj->loadfile();

# Send the file listing to the layout, along with directory name
$layoutobj->title = $bhlang['title:viewing_directory']." ".$filepath;
$layoutobj->subtitle1 = $filepath;
$layoutobj->content1 = $files;
$layoutobj->content2 = $modulestouse;
$layoutobj->filepath = $filepath;
$layoutobj->view = $view;


$layoutobj->display();