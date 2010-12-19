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
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'><b>".$bhlang['title:signup']."</b></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br><br>
			".$bhlang['explain:signup']."<br><br>
			<form action='index.php?page=signup' method='POST'>
			<table>
			<tr><td>".$bhlang['label:username']." </td><td><input type='textbox' name='signup[username]' value='".$this->content1['username']."'></td></tr>
			<tr><td>".$bhlang['label:password']." </td><td><input type='password' name='signup[pass1]'></td></tr>
			<tr><td>".$bhlang['label:repeat_password']." </td><td><input type='password' name='signup[pass2]'></td></tr>
			<tr><td>".$bhlang['label:email']." </td><td><input type='textbox' name='signup[email]' size='60' value='".$this->content1['email']."'></td></tr>
			<tr><td>".$bhlang['label:full_name']." </td><td><input type='textbox' name='signup[fullname]' size='40' value='".$this->content1['fullname']."'></td></tr>
			<tr><td colspan='2' align='center'><br><input type='submit' value='".$bhlang['button:signup']."'></td></tr>
			</table>
			</form>
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