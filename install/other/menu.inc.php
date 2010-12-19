<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Installer2 - Page File
 *   $Id$
 *
 */

# Page not found page

$pagearray['title'] = $bhlang['install:title:bytehoard_installation']." :: ".$bhlang['install:title:menu'];

$pagearray['content'] = "<br><br><br><center><table width='80%'><tr>
<td align='center'><a href='index.php?page=install_start'><img src='images/install.png' border='0'></a><br><br>".$bhlang['install:menu:install']."</td>
<td align='center'><a href='index.php?page=upgrade_start'><img src='images/upgrade.png' border='0'></a><br><br>".$bhlang['install:menu:upgrade']."</td>
<td align='center'><a href='../docs/guide/' target='_blank'><img src='images/docs.png' border='0'></a><br><br>".$bhlang['install:menu:documentation']."</td>
<td align='center'><a href='index.php?page=system_information'><img src='images/sysinfo.png' border='0'></a><br><br>".$bhlang['install:menu:systeminfo']."</td>
</tr></table></center>";

return $pagearray;