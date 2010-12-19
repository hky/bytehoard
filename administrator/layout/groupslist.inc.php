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
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'><b>".$bhlang['title:group_administration']."</b></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br><br>
			".$bhlang['explain:group_administration']."<br><br>
			
			<form action='index.php?page=groups' method='POST'>
			<table><tr><td>".$bhlang['label:username']."</td><td><input type='textbox' name='group[username]'></td><td>&nbsp; &nbsp;</td><td>".$bhlang['label:group']."</td><td><input type='textbox' name='group[group]'></td><td>&nbsp; &nbsp;</td><td>
			<input type='hidden' name='group[action]' value='add'>
			<input type='submit' value='".$bhlang['button:add_to_group']."'></td></tr></table></form>
			<br><br>
			<table width='95%'>
			";
			

foreach ($this->content1 as $group=>$users) {
	if ($group != "All") {
		$rowsdone++;
		$str .= "<tr bgcolor='#DEE1F8'><td><b><font color='#000000'> ".$bhlang['label:group']." ".$group."</font></b></td></tr>\n\r<tr><td><table cellpadding='5' cellspacing='0'>";
		# Table heading. Column names, etc.
		$str .= "\n\r";
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
			<td align='center'><b>".$thisuserobj->username."</b></td>
			
			<td align='center'> &nbsp;<a href='index.php?page=groups&group[action]=remove&group[group]=".$group."&group[username]=".$thisuserobj->username."' style='text-decoration:none; color: black;'>".$bhlang['button:remove']."</a> </td>
			</tr><tr height='5'></tr>";
			
			}
		}
		$str .= "</table></td></tr>";
	}
}

if ($rowsdone == 0) {
	$str .= $bhlang['text:no_groups'];
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