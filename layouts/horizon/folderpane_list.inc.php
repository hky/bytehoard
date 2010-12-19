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
				<b>".$this->subtitle1."</b>
			</td></tr></table>
		</td>
		<td width='10'><img src='".$this->skinpath."images/sidebar/rc.png' width='10' height='30'></td>
	</tr>
	<tr>
		<td width='10' background='".$this->skinpath."images/sidebar/lc.png'>&nbsp;</td>
		<td valign='middle' align='center'><br>
			<table width='100%' align='center' cellspacing='6' cellpadding='3'>
		";
if (is_array($this->content1)) {
	
	foreach ($this->content1 as $file) {
		
		
		$file['filepath'] = bh_fpclean($file['filepath']);
		
		unset($fileobj);
		$fileobj = new bhfile($file['filepath']);
		
		# Get system's description of file on *nix systems.
		if (bh_os() == "nix") {
			$cmdstr = "file -b ".escapeshellarg($fileobj->absfilepath);
			$systemdesc2 = `$cmdstr`;
			$systemdescarray = explode(",", $systemdesc2);
			$systemdesc = $systemdescarray[0];
			$systemdesc{0} = strtoupper($systemdesc{0});
		} else {
			$systemdesc = strtoupper(bh_get_extension($file['filepath']))." file";
		}
		
		# Get any possible description from metadata
		if (!empty($fileobj->fileinfo['description'])) {
			$systemdesc = $fileobj->fileinfo['description'];
		} elseif (!empty($fileobj->fileinfo['desc'])) {
			$systemdesc = $fileobj->fileinfo['desc'];
		}
		
		# Stop JS/HTML insertion
		$systemdesc = strip_tags($systemdesc);
		
		
		if (empty($bhconfig['defaultfilemodule'])) { $defaultfilemodule = "viewfile"; } else { $defaultfilemodule = $bhconfig['defaultfilemodule'];}
		
		if ($fileobj->is_dir() == true) {
			$str .= "<tr><td width='20'><a href='index.php?page=viewdir&filepath=".$file['filepath']."'><img src='".$this->geticon($file['filepath'], 16)."' border='0'></a></td><td><a href='index.php?page=viewdir&filepath=".$file['filepath']."' class='filenamelink'>".$file['filename']."</a></td><td>".$systemdesc."</td><td>".$fileobj->numberfiles().$bhlang['label:_files']."</td></tr>";
		} else {
			$str .= "<tr><td width='20'><a href='index.php?page=$defaultfilemodule&filepath=".$file['filepath']."'><img src='".$this->geticon($file['filepath'], 16)."' border='0'></a></td><td><a href='index.php?page=$defaultfilemodule&filepath=".$file['filepath']."' class='filenamelink'>".$file['filename']."</a></td><td>".$systemdesc."</td><td>".bh_humanfilesize($file['filesize'])."</td></tr>";
		}
	}
}

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