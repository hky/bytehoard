<?php


$str .= "<table width='100%' cellspacing='0' cellpadding='0'>
<tr height='71'><td background='".$this->skinpath."images/topbarbgt.png' align='left' valign='middle'>
	<span class='toptitle'>".$bhcurrent['userobj']->username." @ ".$bhconfig['sitename']."</span>
</td></tr>
<tr height='29'><td background='".$this->skinpath."images/topbarbgb.png' align='left' valign='middle' style='background-repeat: repeat-x;'>
	<span class='topbottomtitle'><table cellspacing='0' cellpadding='0'><tr>";
		
$menumods = $this->getmodulesmenu('page');

foreach ($menumods as $mod) {

	$str .= "<td class='toolbarimgtd'><a href='index.php?page=".$mod['module']."' class='toolbarlink'><img src='".$mod['icon']."' border='0'></a></td>";
	$str .= "<td class='toolbartxttd'><a href='index.php?page=".$mod['module']."' class='toolbarlink'>".$mod['title']."</a></td>";

}

$str .= "</tr></table></span>
</td></tr>
</table>

";

?>