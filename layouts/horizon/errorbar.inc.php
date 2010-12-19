<?php


global $bherrors;

if (is_array($bherrors)) {
	foreach ($bherrors as $bherror) {
	
		switch ($bherror['type']) {
			case "warning":
			default:
				$leftimage = "warning.png"; break;
			case "error":
				$leftimage = "error.png"; break;
			case "info":
			case "notice":
				$leftimage = "info.png"; break;
		}
		
		$str .= "<table width='100%' cellspacing='0' cellpadding='0' class='errorbartable'>
		<tr height='29'><td align='left' valign='middle'>
			<table cellspacing='0' cellpadding='0'><tr><td class='toolbarimgtd'><img src='".$this->skinpath."images/erroricons/toolbar/".$leftimage."' border='0'></td><td class='toolbartxttd'>&nbsp;&nbsp;".$bherror['message']."</td></tr></table>
		</td></tr>
		</table>
		";
		
	}
}

?>