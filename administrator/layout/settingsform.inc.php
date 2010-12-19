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
		<td background='".$this->skinpath."images/sidebar/titlebg.png' align='center' valign='middle'><b>".$bhlang['title:settings']."</b></td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br><br>
			
			
			<table>
			<tr><td align='center' colspan='3'>".$bhlang['explain:settings']."<br/><br/></td></tr>
			<form action='index.php?page=settings' method='POST'>
			<tr>
			<td align='center'>
				<table cellpadding='5' cellspacing='7'>
					<tr><td><b>".$bhlang['label:settings_sitename']."</b><br>".$bhlang['explain:settings_sitename']."</td>
					<td colspan='2'><input type='textbox' name='bhconfig[sitename]' value='".$bhconfig['sitename']."'></td></tr>
					
					<tr><td><b>".$bhlang['label:settings_usetrash']."</b><br>".$bhlang['explain:settings_usetrash']."</td>
					<td>".$this->yesradio("usetrash")."</td><td>".$this->noradio("usetrash")."</td></tr>
					
					<tr><td><b>".$bhlang['label:settings_limitthumbs']."</b><br>".$bhlang['explain:settings_limitthumbs']."</td>
					<td>".$this->yesradio("limitthumbs")."</td><td>".$this->noradio("limitthumbs")."</td></tr>
					
					<tr><td><b>".$bhlang['label:settings_signupdisabled']."</b><br>".$bhlang['explain:settings_signupdisabled']."</td>
					<td>".$this->yesradio("signupdisabled")."</td><td>".$this->noradio("signupdisabled")."</td></tr>
					
					<tr><td><b>".$bhlang['label:settings_signupmoderation']."</b><br>".$bhlang['explain:settings_signupmoderation']."</td>
					<td>".$this->yesradio("signupmoderation")."</td><td>".$this->noradio("signupmoderation")."</td></tr>
					
					<tr><td><b>".$bhlang['label:settings_fromemail']."</b><br>".$bhlang['explain:settings_fromemail']."</td>
					<td colspan='2'><input type='textbox' name='bhconfig[fromemail]' value='".$bhconfig['fromemail']."'></td></tr>
					
					<tr><td><b>".$bhlang['label:settings_imageprog']."</b><br>".$bhlang['explain:settings_imageprog']."</td>
					<td colspan='2'><input type='textbox' name='bhconfig[imageprog]' value='".$bhconfig['imageprog']."'></td></tr>
					
					<tr><td><b>".$bhlang['label:settings_syspath_convert']."</b><br>".$bhlang['explain:settings_syspath_convert']."</td>
					<td colspan='2'><input type='textbox' name='bhconfig[syspath_convert]' value='".$bhconfig['syspath_convert']."'></td></tr>
					
					<tr><td><b>".$bhlang['label:settings_fileroot']."</b><br>".$bhlang['explain:settings_fileroot']."</td>
					<td colspan='2'><input type='textbox' name='bhconfig[fileroot]' value='".$bhconfig['fileroot']."'></td></tr>
					
					<tr><td><b>".$bhlang['label:settings_maxexpires']."</b><br>".$bhlang['explain:settings_maxexpires']."</td>
					<td colspan='2'><input type='textbox' name='bhconfig[maxexpires]' value='".$bhconfig['maxexpires']."'></td></tr>
					
					<tr><td><b>".$bhlang['label:settings_authmodule']."</b><br>".$bhlang['explain:settings_authmodule']."</td>
					<td colspan='2'><input type='textbox' name='bhconfig[authmodule]' value='".$bhconfig['authmodule']."'></td></tr>                                        				
					<tr><td><b>".$bhlang['label:settings_lang']."</b><br>".$bhlang['explain:settings_lang']."</td>
					<td colspan='2'><input type='textbox' name='bhconfig[lang]' value='".$bhconfig['lang']."'></td></tr>
					<tr><td><b>".$bhlang['label:settings_baseuri']."</b><br>".$bhlang['explain:settings_baseuri']."</td>
					<td colspan='2'><input type='textbox' name='bhconfig[baseuri]' value='".$bhconfig['baseuri']."'></td></tr>
				</table>
			</td>
			</tr>
			<tr><td align='center'>
				<input type='submit' value='".$bhlang['button:save_settings']."'><br><br>
			</td></tr>
			</form>
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
