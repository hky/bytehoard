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
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'><b>".$bhlang['title:editing_user_'].$this->content1."</b></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br><br>
			
			
			<table>
			<tr><td align='center' colspan='3'>".$bhlang['explain:edit_user']."<br/><br/></td></tr>
			<tr>
			<td align='center'>
				<form action='index.php?page=edituser&username=".$this->content1."' method='POST'>
				<table>
				<tr><td colspan='2'><b>".$bhlang['subtitle:details']."</b></td></tr>
				<tr><td>".$bhlang['label:email']."</td><td><input type='textbox' name='user[email]' value='".$this->content2['email']."' size='60'></td></tr>
				<tr><td>".$bhlang['label:full_name']."</td><td><input type='textbox' name='user[fullname]' value='".$this->content2['fullname']."' size='40'></td></tr>
				<tr><td>".$bhlang['label:quota']."</td><td><input type='textbox' name='user[quota]' value='".$this->content2['quota']."' size='8'> ".$bhlang['label:_mb']." ".$bhlang['explain_edit_quota']."</td></tr>
				<tr><td>".$bhlang['label:user_type']."</td><td><select name='user[type]'>";
				
				if ($this->content2['type'] == "admin") {
				$str .= "<option value='normal'>".$bhlang['value:normal']."</option>
					<option value='admin' selected>".$bhlang['value:admin']."</option>";
				} else {
				$str .= "<option value='normal' selected>".$bhlang['value:normal']."</option>
					<option value='admin'>".$bhlang['value:admin']."</option>";
				
				}
				
$str .= "			</select></td></tr>
				<tr><td colspan='2'><br></td></tr>
				<tr><td colspan='2'><b>".$bhlang['subtitle:password']."</b></td></tr>
				<tr><td>".$bhlang['label:new_password']."</td><td><input type='password' name='user[pass1]'></td></tr>
				<tr><td>".$bhlang['label:repeat_new_password']."</td><td><input type='password' name='user[pass2]'></td></tr>
				<tr><td colspan='2'><br></td></tr>
				<tr><td>".$bhlang['label:disabled']."</td><td><select name='user[disabled]'>";
				
				if ($this->content2['disabled'] == "1") {
				$str .= "<option value='0'>".$bhlang['value:enabled']."</option>
					<option value='1' selected>".$bhlang['value:disabled']."</option>";
				} else {
				$str .= "<option value='0' selected>".$bhlang['value:enabled']."</option>
					<option value='1'>".$bhlang['value:disabled']."</option>";
				
				}
				
$str .= "			</select></td></tr>
				<tr><td colspan='2'><br></td></tr>
				<tr><td colspan='2' align='center'><input type='submit' value='".$bhlang['button:save_user']."'><br><br></td></tr>
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