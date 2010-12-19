<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: main.inc.php,v 1.3 2005/04/18 19:45:44 andrewgodwin Exp $
 *
 */
 
#name Main Page
#author Andrew Godwin
#description Displays the main page.
#iscore 1

$layoutobj = new bhadminlayout("main");
$layoutobj->title = $bhlang['title:welcome_to_administration'];
$layoutobj->display();
