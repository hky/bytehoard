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
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'><b>".$bhlang['title:filelinks']."</b></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br><br>
			".$bhlang['explain:filelinks']."<br><br>
			
			<table width='95%'>
			";
			

if (!empty($this->content1)) {
foreach ($this->content1 as $username=>$emailarray) {

	$str .= "<tr><td colspan='5' style='font-size:16px;'><b>$username</b></td></tr>";
	$str .= "<tr style='font-size:12px;'><td> &nbsp; &nbsp; </td><td>".$bhlang['column:email']."</td><td>".$bhlang['column:file']."</td><td>".$bhlang['column:expires_in']."</td><td></td></tr>";
	foreach ($emailarray as $email=>$codearray) {
		foreach ($codearray as $filecode=>$filearray) {
			$filepath = $filearray['filepath'];
			$expiresin = $filearray['expires']-time();
			$filelink = bh_filelink_uri($filecode);
			$str .= "<tr><td> &nbsp; &nbsp; </td><td>$email</td><td>$filepath</td><td>".bh_humanise_time($expiresin)."</td><td><a href='$filelink'>".$bhlang['button:link']."</a> &nbsp; <a href='index.php?page=filelinks&deletelink=$filecode'>".$bhlang['button:delete']."</a></td></tr>";
		}
	}

}
}

$str .= "
			</table>
			<br><br>
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