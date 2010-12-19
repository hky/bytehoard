<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Installer2 - Page File
 *   $Id$
 *
 */

$pagearray = array();

$pagearray['title'] = $bhlang['install:title:bytehoard_installation']." :: ".$bhlang['install:title:configure_database'];

require "../includes/db/".$_POST['install_dbmod'];

if (count($dbconfigneeded)>0) { 
	$pagearray['content'] .= $bhlang['install:configdb:intro']."<br><br><form action='index.php?page=install_init_database&install_dbmod=".$_POST['install_dbmod']."' method='POST'><table width='90%' cellspacing='10'>";
	foreach ($dbconfigneeded as $variable=>$configdata) {
		switch ($configdata['type']) {
		
			case "string":
			
			$pagearray['content'] .= "<tr>".
				"<td align='right'><input type='textbox' name='install_dbconf[".$variable."]' value='".$configdata['default']."'></td>".
				"<td>".$configdata['name'].
				"<br><span style='font-size: 10px; color: gray;'>".$configdata['description']."</span></td></tr>";
			break;
			
			case "password":
			
			$pagearray['content'] .= "<tr>".
				"<td align='right'><input type='password' name='install_dbconf[".$variable."]' value='".$configdata['default']."'></td>".
				"<td>".$configdata['name'].
				"<br><span style='font-size: 10px; color: gray;'>".$configdata['description']."</span></td></tr>";
			break;
		
		}
	}
	$pagearray['content'] .= "<tr><td colspan='2' align='center'><input type='submit' value='".$bhlang['button:ok']."'></td></tr></table></form>";
} else {
	$pagearray['content'] .= $bhlang['install:configdb:nont_needed']."<br><br><a href='index.php?page=install_init_database&install_dbmod=".$_POST['install_dbmod']."'><img src='images/next.png' border='0'></a>"; 
}

return $pagearray;