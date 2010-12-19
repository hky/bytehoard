<?php

$str .= "

<br>
<table class='toolbar' cellspacing='0' cellpadding='0' width='90%' align='center'>
	<tr height='10'>
		<td width='10'><img src='".$this->skinpath."images/sidebar/tl.png'></td>
		<td background='".$this->skinpath."images/sidebar/tc.png'></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/tr.png'></td>
	</tr>
	<tr height='30'>
		<td width='10'><img src='".$this->skinpath."images/sidebar/lc.png' width='10' height='30'></td>
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'><b>".$bhlang['title:registrations_administration']."</b></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br><br>
			".$bhlang['explain:registration_administration']."<br><br>
			
			<table width='95%' cellpadding='3' cellspacing='0'>
			<tr bgcolor='#DDDDDD'><td>Username</td><td>Full Name</td><td>Email Address</td><td></td><td></td></tr>
			<tr></tr>
			";
			
$bgcolor[1] = "#EEEEEE";
$bgcolor[0] = "#FFFFFF";
foreach ($this->content1 as $regdetails) {
	$bgcolornum = 1-$bgcolornum;
	
	$str .= "<tr bgcolor=".$bgcolor[$bgcolornum]."><td><b>".$regdetails['username']."</b></td><td>".$regdetails['fullname']."</td><td>".$regdetails['email']."</td><form action='index.php?page=registrations&action=accept&regid=".$regdetails['regid']."&username=".$regdetails['username']."' method='POST'><td align='center'><input type='submit' value='".$bhlang['button:accept']."'></td></form><form action='index.php?page=registrations&action=reject&regid=".$regdetails['regid']."&username=".$regdetails['username']."' method='POST'><td align='center'><input type='submit' value='".$bhlang['button:reject']."'></td></form></tr>";

}

$str .= "
			</table>
			<br><br>
		</td>
		<td width='10' background='".$this->skinpath."images/sidebar/rc.png'>&nbsp;</td>
	</tr>
	<tr height='10'>
		<td width='10'><img src='".$this->skinpath."images/sidebar/bl.png'></td>
		<td background='".$this->skinpath."images/sidebar/bc.png'></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/br.png'></td>
	</tr>
</table>
";

?>