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
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'><b>".$bhlang['title:add_user']."</b></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br><br>
			
			
			<table>
			<tr><td align='center' colspan='3'>".$bhlang['explain:add_user']."<br/><br/></td></tr>
			<tr>
			<td align='center'>
				<form action='index.php?page=adduser&username=".$this->content1."' method='POST'>
				<table>
				<tr><td>".$bhlang['label:username']."</td><td><input type='textbox' name='user[username]' size='30'></td></tr>
				<tr><td>".$bhlang['label:new_password']."</td><td><input type='password' name='user[pass1]'></td></tr>
				<tr><td>".$bhlang['label:repeat_new_password']."</td><td><input type='password' name='user[pass2]'></td></tr>
				<tr><td>".$bhlang['label:email']."</td><td><input type='textbox' name='user[email]' size='60'></td></tr>
				<tr><td>".$bhlang['label:full_name']."</td><td><input type='textbox' name='user[fullname]' size='40'></td></tr>
				<tr><td>".$bhlang['label:quota']."</td><td><input type='textbox' name='user[quota]' size='8'> ".$bhlang['label:_mb']." ".$bhlang['explain_edit_quota']."</td></tr>
				<tr><td>".$bhlang['label:user_type']."</td><td><select name='user[type]'>
					<option value='normal' selected>".$bhlang['value:normal']."</option>
					<option value='admin'>".$bhlang['value:admin']."</option></select></td></tr>
				<tr><td>".$bhlang['label:disabled']."</td><td><select name='user[disabled]'>
					<option value='0' selected>".$bhlang['value:enabled']."</option>
					<option value='1'>".$bhlang['value:disabled']."</option></select></td></tr>
				<tr><td>".$bhlang['label:homedir']."</td><td><select name='user[homedir]'>
					<option value='' selected>".$bhlang['value:normal_homedir']."</option>
					<option value='/'>".$bhlang['value:root_homedir']."</option></select></td></tr>
				<tr><td>".$bhlang['label:groups']."</td><td><input type='textbox' name='user[groups]' size='60'></td></tr>
				<tr><td colspan='2'><br></td></tr>
				<tr><td colspan='2' align='center'><input type='submit' value='".$bhlang['button:add_user']."'><br><br></td></tr>
				</table>
				</form>
			</td>
			</tr>
			</table>
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