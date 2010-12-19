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
		<td valign='middle' align='center'><br><br>
			
			<table>
			<tr><td align='center' colspan='2'>
			".$bhlang['explain:copy']."<br><br>
			<form action='index.php?page=choosefolder&returnto=copy&returnfilepath=".$this->filepath."' method='POST'>
			".$bhlang['label:copy_to'].$this->infolder." &nbsp; <input type='submit' value='".$bhlang['button:change_folder']."'>
			</form>
			<br><br>
			</td></tr>
			<form action='index.php?page=copyfolder&infolder=".$this->infolder."&filepath=".$this->filepath."' method='POST'>
			<tr>
			<td align='center'>
				".$bhlang['label:new_name']."<input type='textbox' name='newname' value='".$this->content1."'>
			</td>
			<td align='center'>
				<input type='submit' value='".$bhlang['button:copy']."'>
			</td>
			</tr>
			</form>
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