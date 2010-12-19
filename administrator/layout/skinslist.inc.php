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
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'><b>".$this->title."</b></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br><br>
			".$bhlang['explain:appearance']."<br><br>
			
			<table width='95%' cellspacing='5' cellpadding='5'>
			";
			

foreach ($this->content1 as $layskin=>$properties) {

	if ($layskin == $this->content2) {
		$str .= "<tr><td><b>".$properties['name']."</b>
		<br>".$properties['description']."
		<br>".$bhlang['label:author'].$properties['author']."<br><br>
		<b>".$bhlang['explain:current_skin']."</b></td>
		<td><img src='../layouts/".$properties['layout']."/skins/".$properties['skin']."/".$properties['previewpng']."' border='0' /><br><br></td></tr>";
	} else {
		$str .= "<tr><td><b>".$properties['name']."</b>
		<br>".$properties['description']."
		<br>".$bhlang['label:author'].$properties['author']."<br><br>
		<form action='index.php?page=appearance&setskin=".$properties['skin']."&setlayout=".$properties['layout']."' method='POST'>
		<input type='submit' value='".$bhlang['button:use_this_skin']."'>
		</form></td>
		<td><img src='../layouts/".$properties['layout']."/skins/".$properties['skin']."/".$properties['previewpng']."' border='0' /><br><br></td></tr>";
	}
		$str .= "<tr><td colspan='2' style='border-top: 1px solid #CCCCCC'><br></td></tr>";

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