<?php

# Horizon Template Header File


$str .= "
<html>
<head>
<link rel='stylesheet' type='text/css' title='Style' href='".$this->skinpath."css/main.css' />
<title>".$bhconfig['sitename']." :: ".$this->title."</title>

<!-- compliance patch for microsoft browsers -->
<!--
<script type=\"text/javascript\">
IE7_PNG_SUFFIX = \".png\";
</script>
<script src=\"../ie7/ie7-standard-p.js\" type=\"text/javascript\">
</script>
-->

<!-- tinyMCE -->
 <script language=\"javascript\" type=\"text/javascript\" src=\"tiny_mce/tiny_mce.js\"></script>
 <script language=\"javascript\" type=\"text/javascript\">
    tinyMCE.init({
       mode : \"specific_textareas\",
       theme : \"advanced\"
   });
 </script>
 <!-- /tinyMCE -->

</head>
<body>
<table width='100%' cellspacing='0' cellpadding='0'>
<tr height='71'><td background='".$this->skinpath."images/topbarbgt.png' align='left' valign='middle'>
	<span class='toptitle'>".$bhcurrent['userobj']->username." @ ".$bhconfig['sitename']." ".$bhlang['title:__administration']."</span>
</td></tr>
<tr height='29'><td background='".$this->skinpath."images/topbarbgb.png' align='left' valign='middle'>
	<span class='topbottomtitle'><table cellspacing='0' cellpadding='0'><tr>";
		
$menumods = $this->getmodulesmenu('page');

if ($_GET['page'] == "login") { $menumods = array(); }

if (!empty($menumods)) {
foreach ($menumods as $mod) {
	$modsdone++;
	$str .= "<td class='toolbarimgtd'><a href='index.php?page=".$mod['module']."' class='toolbarlink'><img src='".$mod['icon']."' border='0'></a></td>";
	$str .= "<td class='toolbartxttd'><a href='index.php?page=".$mod['module']."' class='toolbarlink'>".$mod['title']."</a></td>";
	if ($modsdone > 5) { 
		$str .= "</tr></table></span></td></tr><tr height='29'><td background='".$this->skinpath."images/topbarbgb.png' align='left' valign='middle'>
		<span class='topbottomtitle'><table cellspacing='0' cellpadding='0'><tr>"; 
		$modsdone = 0; 
	}
}
}
$str .= "</tr></table></span>
</td></tr>
</table>";

global $bherrors;

if (is_array($bherrors)) {
	foreach ($bherrors as $bherror) {
	
		switch ($bherror['type']) {
			case "warning":
			default:
				$leftimage = "warning.png"; break;
			case "error":
				$leftimage = "error.png"; break;
			case "info":
			case "notice":
				$leftimage = "info.png"; break;
		}
		
		$str .= "<table width='100%' cellspacing='0' cellpadding='0' class='errorbartable'>
		<tr height='29'><td align='left' valign='middle'>
			<table cellspacing='0' cellpadding='0'><tr><td class='toolbarimgtd'><img src='".$this->skinpath."images/erroricons/toolbar/".$leftimage."' border='0'></td><td class='toolbartxttd'>&nbsp;&nbsp;".$bherror['message']."</td></tr></table>
		</td></tr>
		</table>
		";
		
	}
}



?>