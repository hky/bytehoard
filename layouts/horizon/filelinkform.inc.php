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
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'><b>".$bhlang['title:filemail']."</b></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br><br>
			".$bhlang['explain:filemail']."<br><br>
			<form action='index.php?page=filelink&filepath=".$this->filepath."' method='POST'>
			<table>
			<tr><td>".$bhlang['label:expires_in']." </td><td><input type='textbox' name='filemail[expires]' size='4'> ".$bhlang['text:days']." ".str_replace("#NUM#", $bhconfig['maxexpires'], $bhlang['text:max_#NUM#_days'])."</td></tr>
			<tr><td>".$bhlang['label:remind_in']." </td><td><input type='textbox' name='filemail[remind]' size='4'> ".$bhlang['text:days_before_expiry']." </td></tr>
			<tr><td>".$bhlang['label:linkonly']." </td><td><input type='checkbox' name='filemail[linkonly]'></td></tr>
			<tr><td>".$bhlang['label:downloadnotice']." </td><td><input type='checkbox' name='filemail[notify]'></td></tr>
			<tr><td>".$bhlang['label:email']." </td><td><input type='textbox' name='filemail[email]' size='50'></td></tr>
			<tr><td>".$bhlang['label:subject']." </td><td><input type='textbox' name='filemail[subject]' size='50'></td></tr>
			<tr><td>".$bhlang['label:message']." </td><td><textarea name='filemail[message]' rows='5' cols='35'></textarea></td></tr>
			<tr><td colspan='2' align='center'><input type='submit' value='".$bhlang['button:send']."'></td></tr>
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