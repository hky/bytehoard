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
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'><b>".$bhlang['title:delete_user']."</b></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br><br>
			
			
			<table>
			<tr><td align='center' colspan='3'>".$bhlang['explain:delete_user']."<br/><br/></td></tr>
			<tr>
			<td align='center'>
				<form action='index.php?page=users' method='POST'><input type='submit' value='".$bhlang['button:cancel']."'></form>
			</td>
			<td align='center'>
				<form action='index.php?page=deleteuser&username=".$this->content1."' method='POST'><input type='hidden' name='dodelete' value='1'><input type='submit' value='".$bhlang['button:delete_user']."'></form>
			</td>
			<td align='center'>
				<form action='index.php?page=deleteuser&username=".$this->content1."' method='POST'><input type='hidden' name='dodelete' value='2'><input type='submit' value='".$bhlang['button:delete_user_and_files']."'></form>
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