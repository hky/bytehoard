<?php

$str .= "
<br>
<table class='toolbar' cellspacing='0' cellpadding='0' width='100%' align='center'>
	<tr height='10'>
		<td width='10'><img src='".$this->skinpath."images/sidebar/tl.png'></td>
		<td background='".$this->skinpath."images/sidebar/tc.png'></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/tr.png'></td>
	</tr>
	<tr height='30'>
		<td width='10'><img src='".$this->skinpath."images/sidebar/lc.png' width='10' height='30'></td>
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'>
			<table cellpadding='0' cellspacing='0' width='100%'><tr><td width='32' align='center'>
				<img src='".$this->geticon($this->filepath, "16")."' border='0'>
			</td><td align='center'>
				<b>".bh_get_filename($this->filepath)."</b>
			</td></tr></table>
		</td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br>
			<table width='90%' align='center' cellspacing='6' cellpadding='3'>
		";
if (is_array($this->content1)) {
	$even = 1;
	foreach ($this->content1 as $modulearray) {
		$even = 1 - $even;
		if ($even == 0) {$str .= "<tr>";}
		
		$str .= "<td width='50'><a href='index.php?page=".$modulearray['module']."&filepath=".$this->filepath."'><img src='".$this->getmoduleicon($modulearray['module'])."' border='0'></a></td><td><a href='index.php?page=".$modulearray['module']."&filepath=".$this->filepath."' class='filenamelink'>".bh_moduletitle($modulearray['module'])."</a><br><font color='gray'>".bh_moduledescription($modulearray['module'])."<br></font></td>";
		
		if ($even == 1) {$str .= "</tr>";}
	}
}

if ($even = 0) {$str .= "<td width='50'></td><td></td></tr>";}

$str .= "		</table><br>
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