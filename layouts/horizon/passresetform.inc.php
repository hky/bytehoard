<?php

$str .= "

<br>
<table class='toolbar' cellspacing='0' cellpadding='0' width='50%' align='center'>
	<tr height='10'>
		<td width='10'><img src='".$this->skinpath."images/sidebar/tl.png'></td>
		<td background='".$this->skinpath."images/sidebar/tc.png'></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/tr.png'></td>
	</tr>
	<tr height='30'>
		<td width='10'><img src='".$this->skinpath."images/sidebar/lc.png' width='10' height='30'></td>
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'><b>".$this->title."</b></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center' style='padding: 3px'><br><br>
			".$this->content1."<br><br>
			<form action='index.php?page=passreset' method='POST'>
			<table>
			<tr><td>".$bhlang['label:username']." </td><td><input type='textbox' name='reset_username'></td><td align='center'><input type='submit' value='".$bhlang['button:go']."'></td></tr>
			<tr><td colspan='3' align='center'><i><font color='gray'>".$bhlang['text:or']."</font></i></td></tr>
			<tr><td>".$bhlang['label:email']." </td><td><input type='textbox' name='reset_email'></td><td align='center'><input type='submit' value='".$bhlang['button:go']."'></td></tr>
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