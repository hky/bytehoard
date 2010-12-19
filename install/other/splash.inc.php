<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Installer2 - Page File
 *   $Id$
 *
 */

# This does the splash screen bit

$pagearray['title'] = $bhlang['install:title:bytehoard_installation'];

$pagearray['content'] = "<table class='splash'><tr><td valign='middle' align='center'><a href='index.php?page=menu'><img src='images/bhlogo_500.png' border='0'></a><br><b>".$bhconfig['version']."</b></td></tr></table>

<a href='index.php?page=menu'><img src='images/next.png' class='stillnext' border='0'></a>";

return $pagearray;