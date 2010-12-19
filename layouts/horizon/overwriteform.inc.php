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
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'><b>".$bhlang['title:overwriting_'].bh_get_filename($this->filepath)."</b></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br><br>
			
			
			<table>
			<tr><td align='center' colspan='2'>".$bhlang['explain:overwrite']."<br/><br/></td></tr>
			<tr>
			<td align='center'>
				<form action='index.php?page=viewfile&filepath=".$this->filepath."' method='POST'><input type='submit' value='".$bhlang['button:cancel']."'></form>
			</td>
			<td align='center'>
				<form action='index.php?page=delete&filepath=".$this->filepath."' method='POST'><input type='hidden' name='dodelete' value='1'><input type='submit' value='".$bhlang['button:delete_file']."'></form>
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