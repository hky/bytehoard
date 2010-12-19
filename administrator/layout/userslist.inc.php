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
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'><b>".$bhlang['title:user_administration']."</b></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br><br>
			".$bhlang['explain:user_administration']."<br><br>
			
			<table width='95%'>
			";
			

foreach ($this->content1 as $group=>$users) {

	if ($group == $this->content2) {
		$str .= "<tr bgcolor='#DEE1F8'><td><b><font color='#000000'>".$group."</font></b></td></tr>\n\r<tr><td><table cellpadding='5' cellspacing='0'>";
		# Table heading. Column names, etc.
		$str .= "\n\r<tr bgcolor='#EBEBEB'><td align='center'>".$bhlang['column:user_type']."</td><td></td><td align='center''>".$bhlang['column:username']."</td><td align='center' colspan='2'>".$bhlang['column:used_space']."</td><td align='center'>".$bhlang['column:bandwidth_30_days']."</td><td align='center'>".$bhlang['column:actions']."</td></tr>";
		foreach ($users as $user) {
		
			# If the username is not shown then don't show it
			if ($user == "guest") {}
			else {
		
			$thisuserobj = new bhuser($user);
			$usrimgfile = $thisuserobj->type.".png";
			
			# This is pretty nasty. Lots of tables.
			# Note I use the humanfilesize() function here for bandwidth - it's bytes all the way, so it sort of makes sense.
			# Also, this is hardcoded to show last 30 days bandwidth. It may be possible to change this on the user end in the future.
			# Also note that getbandwidth() accepts a third parameter, end time. Might use it for graphs.
			#
			#                           sec  min  hr  days (rounded)
			$bandwidthstart = time() - (60 * 60 * 24 * 30);
			#
			# e.g. for a year
			#$bandwidthstart = time() - (60 * 60 * 24 * 356);
			#
			# or for last week
			#$bandwidthstart = time() - (60 * 60 * 24 * 7);
			#
			# or yesterday
			#$bandwidthstart = time() - (60 * 60 * 24);
			# etc.
			
			$str .= "
			<tr><td><img src='".$this->skinpath."images/userslist/".$usrimgfile."' title='".$thisuserobj->type."'></td>
			<td>&nbsp; &nbsp; </td>
			<td align='center'><a href='index.php?page=edituser&username=".$thisuserobj->username."' style='text-decoration:none; color: black;'><b>".$thisuserobj->username."</b></a></td>
			<td align='center'> &nbsp; &nbsp; &nbsp; &nbsp; <img src='".$this->skinpath."images/userslist/disk.png' alt='".$bhlang['label:disk_space_used']."' title='".$bhlang['label:disk_space_used']."'></td><td>&nbsp; ".bh_humanfilesize($thisuserobj->getusedspace())." &nbsp; &nbsp; &nbsp; &nbsp; </td>
			<td><table cellspacing='0'><tr><td><img src='".$this->skinpath."images/userslist/band_up.png'></td><td> &nbsp; ".bh_humanfilesize($thisuserobj->getbandwidth("up", $bandwidthstart))."</td></tr>
			<tr><td><img src='".$this->skinpath."images/userslist/band_down.png'></td><td> &nbsp; ".bh_humanfilesize($thisuserobj->getbandwidth("down", $bandwidthstart))."</td></tr></table></td>
			<td align='center'> &nbsp;<a href='index.php?page=edituser&username=".$thisuserobj->username."' style='text-decoration:none; color: black;'>".$bhlang['button:edit']."</a> &nbsp; &nbsp; <a href='index.php?page=deleteuser&username=".$thisuserobj->username."' style='text-decoration:none; color: black;'>".$bhlang['button:delete']."</a></td>
			</tr><tr height='5'></tr>";
			
			}
		}
		$str .= "</table></td></tr>";
	} else {
		$str .= "<tr bgcolor='#ECECEC'><td><a href='index.php?page=users&group=".$group."'><b><font color='#555555'>".$group."</font></b></a></td></tr>\n\r";
	}
	

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