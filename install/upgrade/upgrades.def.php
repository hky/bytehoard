<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Installer2 - Upgrade Paths Definition File
 *   $Id$
 *
 */
 
$upgradepath['2.1.b']['name'] = "ByteHoard 2.1 Beta";
$upgradepath['2.1.b']['path'][0] = "2.1.b_to_2.1.g";

$upgradepath['2.1.a']['name'] = "ByteHoard 2.1 Alpha";
$upgradepath['2.1.a']['path'][0] = "2.1.a_to_2.1.b";
$upgradepath['2.1.a']['path'][1] = "2.1.b_to_2.1.g";

$upgradepath['2.0.x']['name'] = "ByteHoard 2.0.x";
$upgradepath['2.0.x']['path'][0] = "2.0.x_to_2.1.g";