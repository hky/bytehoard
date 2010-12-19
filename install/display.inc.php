<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Installer2 Display Functions
 *   $Id$
 *
 */

function bhi_create_section($contentarray) {
	return "<br><div class='section'><span class='title'>".$contentarray['title']."</span><br>".$contentarray['content']."<br>&nbsp;</div><br>";
}

function bhi_create_nobannerpage($pagearray) {

	$str .= "<html>\n".
	"<head>\n".
	"<title>".$pagearray['title']."</title>\n".
	"<link href=\"install.css\" title=\"ByteHoard Installer\" rel=\"stylesheet\" type=\"text/css\">\n".
	"</head>\n".
	"<body>\n".
	$pagearray['content']."\n".
	"</body></html>";
	
	return $str;
	
}

function bhi_create_page($pagearray) {

	$str .= "<html>\n".
	"<head>\n".
	"<title>".$pagearray['title']."</title>\n".
	"<link href=\"install.css\" title=\"ByteHoard Installer\" rel=\"stylesheet\" type=\"text/css\">\n".
	"</head>\n".
	"<body>\n".
	"<div class='installbanner'><img src='images/header.png'></div>\n".
	$pagearray['content']."\n".
	"</body></html>";
	
	return $str;
	
}

function bhi_create_sectionpage($sectionarray) {
	
	foreach ($sectionarray as $section) {
		$page['content'] .= bhi_create_section($section);
		$page['title'] = $section['title'];
	}
	
	return bhi_create_page($page);
	
}