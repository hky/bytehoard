<?php

$str .= "
<br>
<table class='toolbar' cellspacing='0' cellpadding='0' width='70%' align='center'>
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
		<td valign='middle' align='center'><br><br><table><tr><td align='center'>
			".$bhlang['explain:edit']."<br/><br/></td></tr><tr><td align='center'>
			<form action='index.php?page=edit&filepath=".$this->filepath."' method='POST'>
			<table>
			<tr><td align='center'><textarea name='file_content' rows='15' cols='80'>".$this->content1."</textarea>
			<input type='hidden' name='iscontent' value='1'></td></tr>
			<tr><td align='center'><input type='submit' value='".$bhlang['button:save']."'></td></tr>
			</table>
			</form>
			</td></tr></table>
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