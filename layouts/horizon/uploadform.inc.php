<?php

$str .= "


<script>
function popUP(mypage, myname, w, h, scroll, titlebar)
{
	var winl = (screen.width - w) / 2;
	var wint = (screen.height - h) / 2;
	winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable'
	win = window.open(mypage, myname, winprops)
	if (parseInt(navigator.appVersion) >= 4) {
		win.window.focus();
	}
}
</script>

<br>
<table class='toolbar' cellspacing='0' cellpadding='0' width='75%' align='center'>
	<tr height='10'>
		<td width='10'><img src='".$this->skinpath."images/sidebar/tl.png'></td>
		<td background='".$this->skinpath."images/sidebar/tc.png'></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/tr.png'></td>
	</tr>
	<tr height='30'>
		<td width='10'><img src='".$this->skinpath."images/sidebar/lc.png' width='10' height='30'></td>
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'><b>".$bhlang['title:upload']."</b></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br><br>
			
			
			<table>
			<tr><td align='center' colspan='2'>
			".$bhlang['explain:upload']."<br><br>
			<form action='index.php?page=choosefolder&returnto=upload' method='POST'>
			".$bhlang['label:uploading_to'].$this->filepath." &nbsp; <input type='submit' value='".$bhlang['button:change_folder']."'>
			</form>
			<br><br>
			</td></tr>
			<form action='index.php?page=upload&infolder=".$this->filepath."' method='POST' enctype='multipart/form-data' name='uploadform'>
			<tr>
			<td align='center'>
				<input type='file' name='fupload1' value=''><br>
				<input type='file' name='fupload2' value=''><br>
				<input type='file' name='fupload3' value=''><br>
				<input type='file' name='fupload4' value=''><br>
				<input type='file' name='fupload5' value=''><br>
			</td>
			<td align='center'>
				<input type='hidden' name='infolder' value='".$this->filepath."'><input type='submit' value='".$bhlang['button:upload']."' onClick=\"popUP('index.php?page=upload&uploadstatuspage=1','uploadwin',350,200,false,false);\">
			</td>
			</tr>
			</form>
			</table><br>
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