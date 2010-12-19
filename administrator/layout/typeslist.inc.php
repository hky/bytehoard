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
			".$bhlang['explain:types_administration']."<br><br>
			
			<table width='95%'>
			<tr bgcolor='#EBEBEB'><td align='center'>".$bhlang['column:type_name']."</td><td align='center''>".$bhlang['column:type_size']."</td><td align='center'>".$bhlang['column:edit_quota']."</td><td align='center'>".$bhlang['column:delete']."</td></tr>";
			

if (is_array($this->content1)) {
foreach ($this->content1 as $name=>$quota) {
	$quota = ($quota / (1024*1024));
	$str .= "<tr><td>$name</td><td>$quota MB</td><form action='index.php?page=types&action=add&name=$name' method='POST'><td><input type='textbox' name='size' value='$quota'>MB <input type='submit' value='Save'></td></form></tr>";

}
}

$str .= "
			</tr>
			</table>
			<br>
			<br>
			<form action='index.php?page=types&action=add' method='POST'>
			<table>
			<tr><td align='center' colspan='2'><b>Add Type</b></td></tr>
			<tr><td>Name:</td><td><input type='textbox' name='name'></td></tr>
			<tr><td>Quota:</td><td><input type='textbox' name='size'>MB </td></tr>
			<tr><td align='center' colspan='2'><input type='submit' value='Add'></td></tr>
			</table>
			</form>
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