<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: error.inc.php,v 1.1.1.1 2005/02/28 21:50:16 andrewgodwin Exp $
 *
 */
 
#name Return to ByteHoard Page
#author Andrew Godwin
#description Returns you to the main BH page.
#iscore 1

header("Location: ../");
die();