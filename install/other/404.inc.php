<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Installer2 - Page File
 *   $Id$
 *
 */

# Page not found page

$pagearray['title'] = $bhlang['install:title:bytehoard_installation']." :: ".$bhlang['install:title:page_not_found'];

$pagearray['content'] = "".$bhlang['install:error:page_not_found']."";

return $pagearray;