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
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'><b>".$this->subtitle1."</b></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br><br>
			
			<table>
			<tr><td align='center' colspan='2'>
			".$bhlang['explain:sharingfolder']."
			<br><br>
			</td></tr>
			<tr><td>
			<table width='100%'><tr><td align='left' colspan='3'><b>".$bhlang['label:users']."</b></td></tr>
			";

if (!empty($this->content1)) {
	foreach ($this->content1 as $user=>$status) {
		switch ($status) {
			case 0:
			default:
				$str .= "<tr><td width='20'><img src='".$this->skinpath."images/sharingmodes/hidden.png'></td><td><b>".$user.": ".$bhlang['label:sharingfolder_hidden']."</b> &nbsp; ".$bhlang['explain:sharingfolder_hidden']." &nbsp;  &nbsp;</td><td> ".$bhlang['label:change_to']."<a href='index.php?page=sharingfolder&filepath=".$this->filepath."&user=1&username=".$user."' class='sharingformlink'>".$bhlang['label:sharingfolder_viewable']."</a> &nbsp; <a href='index.php?page=sharingfolder&filepath=".$this->filepath."&user=2&username=".$user."' class='sharingformlink'>".$bhlang['label:sharingfolder_writable']."</a> &nbsp; <a href='index.php?page=sharingfolder&filepath=".$this->filepath."&user=3&username=".$user."' class='sharingformlink'>".$bhlang['label:sharingfolder_owner']."</a></td></tr>";
			break;
			case 1:
				$str .= "<tr><td width='20'><img src='".$this->skinpath."images/sharingmodes/viewable.png'></td><td><b>".$user.": ".$bhlang['label:sharingfolder_viewable']."</b> &nbsp; ".$bhlang['explain:sharingfolder_viewable']." &nbsp;  &nbsp;</td><td> ".$bhlang['label:change_to']."<a href='index.php?page=sharingfolder&filepath=".$this->filepath."&user=0&username=".$user."' class='sharingformlink'>".$bhlang['label:sharingfolder_hidden']."</a> &nbsp; <a href='index.php?page=sharingfolder&filepath=".$this->filepath."&user=2&username=".$user."' class='sharingformlink'>".$bhlang['label:sharingfolder_writable']."</a> &nbsp; <a href='index.php?page=sharingfolder&filepath=".$this->filepath."&user=3&username=".$user."' class='sharingformlink'>".$bhlang['label:sharingfolder_owner']."</a></td></tr>";
			break;
			case 2:
				$str .= "<tr><td width='20'><img src='".$this->skinpath."images/sharingmodes/writable.png'></td><td><b>".$user.": ".$bhlang['label:sharingfolder_writable']."</b> &nbsp; ".$bhlang['explain:sharingfolder_writable']." &nbsp;  &nbsp;</td><td> ".$bhlang['label:change_to']."<a href='index.php?page=sharingfolder&filepath=".$this->filepath."&user=0&username=".$user."' class='sharingformlink'>".$bhlang['label:sharingfolder_hidden']."</a> &nbsp; <a href='index.php?page=sharingfolder&filepath=".$this->filepath."&user=1&username=".$user."' class='sharingformlink'>".$bhlang['label:sharingfolder_viewable']."</a> &nbsp; <a href='index.php?page=sharingfolder&filepath=".$this->filepath."&user=3&username=".$user."' class='sharingformlink'>".$bhlang['label:sharingfolder_owner']."</a></td></tr>";
			break;
			case 3:
				$str .= "<tr><td width='20'><img src='".$this->skinpath."images/sharingmodes/owner.png'></td><td><b>".$user.": ".$bhlang['label:sharingfolder_owner']."</b> &nbsp; ".$bhlang['explain:sharingfolder_owner']." &nbsp;  &nbsp;</td><td>".$bhlang['label:change_to']."<a href='index.php?page=sharingfolder&filepath=".$this->filepath."&user=0&username=".$user."' class='sharingformlink'>".$bhlang['label:sharingfolder_hidden']."</a> &nbsp; <a href='index.php?page=sharingfolder&filepath=".$this->filepath."&user=1&username=".$user."' class='sharingformlink'>".$bhlang['label:sharingfolder_viewable']."</a> &nbsp; <a href='index.php?page=sharingfolder&filepath=".$this->filepath."&user=2&username=".$user."' class='sharingformlink'>".$bhlang['label:sharingfolder_writable']."</a></td></tr>";
			break;
		}
	}
} else {
	$str .= "<tr><td colspan='3'><i>".$bhlang['explain:no_users_sharing_to']."</i></td></tr>";
}

# Add user form
$str .= "<form action='index.php?page=sharingfolder&filepath=".$this->filepath."' method='POST'><tr><td colspan='2'><br>".$bhlang['label:add_user']." <input type='textbox' name='adduser'> <input type='submit' value='".$bhlang['button:add']."'></td></form>";

# Delete user form
$str .= "<form action='index.php?page=sharingfolder&filepath=".$this->filepath."' method='POST'><td><br>".$bhlang['label:delete_user']." <select name='deluser'>";

if (!empty($this->content1)) {
	foreach ($this->content1 as $user=>$status) {
		if ($user != $bhsession['username']) {
			$str .= "\n<option value='".$user."'>".$user."</option>";
		}
	}
}

$str .= "</select> <input type='submit' value='".$bhlang['button:delete']."'></td></tr></form>";

$str .= "<tr><td colspan='3'><br><br></td></tr><tr><td align='left' colspan='3'><b>".$bhlang['label:groups']."</b></td></tr>";

if (!empty($this->content2)) {
	foreach ($this->content2 as $group=>$status) {
		switch ($status) {
			case 0:
			default:
				$str .= "<tr><td width='20'><img src='".$this->skinpath."images/sharingmodes/hidden.png'></td><td><b>".$group.": ".$bhlang['label:sharingfolder_hidden']."</b> &nbsp; ".$bhlang['explain:sharingfolder_hidden']." &nbsp;  &nbsp;</td><td> ".$bhlang['label:change_to']."<a href='index.php?page=sharingfolder&filepath=".$this->filepath."&group=1&groupname=".$group."' class='sharingformlink'>".$bhlang['label:sharingfolder_viewable']."</a> &nbsp; <a href='index.php?page=sharingfolder&filepath=".$this->filepath."&group=2&groupname=".$group."' class='sharingformlink'>".$bhlang['label:sharingfolder_writable']."</a></td></tr>";
			break;
			case 1:
				$str .= "<tr><td width='20'><img src='".$this->skinpath."images/sharingmodes/viewable.png'></td><td><b>".$group.": ".$bhlang['label:sharingfolder_viewable']."</b> &nbsp; ".$bhlang['explain:sharingfolder_viewable']." &nbsp;  &nbsp;</td><td> ".$bhlang['label:change_to']."<a href='index.php?page=sharingfolder&filepath=".$this->filepath."&group=0&groupname=".$group."' class='sharingformlink'>".$bhlang['label:sharingfolder_hidden']."</a> &nbsp; <a href='index.php?page=sharingfolder&filepath=".$this->filepath."&group=2&groupname=".$group."' class='sharingformlink'>".$bhlang['label:sharingfolder_writable']."</a></td></tr>";
			break;
			case 2:
				$str .= "<tr><td width='20'><img src='".$this->skinpath."images/sharingmodes/writable.png'></td><td><b>".$group.": ".$bhlang['label:sharingfolder_writable']."</b> &nbsp; ".$bhlang['explain:sharingfolder_writable']." &nbsp;  &nbsp;</td><td> ".$bhlang['label:change_to']."<a href='index.php?page=sharing&filepath=".$this->filepath."&group=0&groupname=".$group."' class='sharingformlink'>".$bhlang['label:sharingfolder_hidden']."</a> &nbsp; <a href='index.php?page=sharingfolder&filepath=".$this->filepath."&group=1&groupname=".$group."' class='sharingformlink'>".$bhlang['label:sharingfolder_viewable']."</a></td></tr>";
			break;
		}
	}
} else {
	$str .= "<tr><td colspan='3'><i>".$bhlang['explain:no_groups_sharing_to']."</i></td></tr>";
}

# Add group form
$str .= "<form action='index.php?page=sharingfolder&filepath=".$this->filepath."' method='POST'><tr><td colspan='2'><br>".$bhlang['label:add_group']." <input type='textbox' name='addgroup'> <input type='submit' value='".$bhlang['button:add']."'></td></form>";

# Delete user form
$str .= "<form action='index.php?page=sharingfolder&filepath=".$this->filepath."' method='POST'><td><br>".$bhlang['label:delete_group']." <select name='delgroup'>";
if (!empty($this->content2)) {
foreach ($this->content2 as $group=>$status) {
	$str .= "\n<option value='".$group."'>".$group."</option>";
}
}
$str .= "</select> <input type='submit' value='".$bhlang['button:delete']."'></td></tr></form>";

$str .= "<tr><td colspan='3'><br><br></td></tr><tr><td align='left' colspan='3'><b>".$bhlang['label:public']."</b></td></tr>";

# Now, do a row based on what the public can do...
switch ($this->content3) {
	case 0:
	default:
		$str .= "<tr><td width='20'><img src='".$this->skinpath."images/sharingmodes/hidden.png'></td><td><b>".$bhlang['label:sharingfolder_hidden']."</b> &nbsp; ".$bhlang['explain:sharingfolder_hidden']." &nbsp;  &nbsp; </td><td>".$bhlang['label:change_to']."<a href='index.php?page=sharingfolder&filepath=".$this->filepath."&public=1' class='sharingformlink'>".$bhlang['label:sharingfolder_viewable']."</a> &nbsp; <a href='index.php?page=sharingfolder&filepath=".$this->filepath."&public=2' class='sharingformlink'>".$bhlang['label:sharingfolder_writable']."</a></td></tr>";
	break;
	case 1:
		$str .= "<tr><td width='20'><img src='".$this->skinpath."images/sharingmodes/viewable.png'></td><td><b>".$bhlang['label:sharingfolder_viewable']."</b> &nbsp; ".$bhlang['explain:sharingfolder_viewable']." &nbsp;  &nbsp; </td><td>".$bhlang['label:change_to']."<a href='index.php?page=sharingfolder&filepath=".$this->filepath."&public=0' class='sharingformlink'>".$bhlang['label:sharingfolder_hidden']."</a> &nbsp; <a href='index.php?page=sharingfolder&filepath=".$this->filepath."&public=2' class='sharingformlink'>".$bhlang['label:sharingfolder_writable']."</a></td></tr>";
	break;
	case 2:
		$str .= "<tr><td width='20'><img src='".$this->skinpath."images/sharingmodes/writable.png'></td><td><b>".$bhlang['label:sharingfolder_writable']."</b> &nbsp; ".$bhlang['explain:sharingfolder_writable']." &nbsp;  &nbsp; </td><td>".$bhlang['label:change_to']."<a href='index.php?page=sharingfolder&filepath=".$this->filepath."&public=0' class='sharingformlink'>".$bhlang['label:sharingfolder_hidden']."</a> &nbsp; <a href='index.php?page=sharingfolder&filepath=".$this->filepath."&public=1' class='sharingformlink'>".$bhlang['label:sharingfolder_viewable']."</a></td></tr>";
	break;
}

$str .= "<tr><td colspan='3'><br><br></td></tr><tr><td align='center' colspan='3'><form action='index.php?page=viewdir&filepath=".$this->filepath."' method='POST'><input type='submit' value='".$bhlang['button:return']."'></form></td></tr>";

$str .= "		</table></td></tr>
			</table><br><br>
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