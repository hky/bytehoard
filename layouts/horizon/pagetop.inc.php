<?php

# Horizon Template Header File


$str .= "
<html>
<head>
<link rel='stylesheet' type='text/css' title='Style' href='".$this->skinpath."css/main.css' />
<!-- compliance patch for microsoft browsers -->
<!--
<script type=\"text/javascript\">
IE7_PNG_SUFFIX = \".png\";
</script>
<script src=\"ie7/ie7-standard-p.js\" type=\"text/javascript\">
</script>
-->
<title>".$bhconfig['sitename']." :: ".$this->title."</title>

<!-- tinyMCE -->
 <script language=\"javascript\" type=\"text/javascript\" src=\"tiny_mce/tiny_mce.js\"></script>
 <script language=\"javascript\" type=\"text/javascript\">
    tinyMCE.init({
       mode : \"specific_textareas\",
       theme : \"advanced\"
   });
 </script>
 <!-- /tinyMCE -->

</head>
<body>

";


?>