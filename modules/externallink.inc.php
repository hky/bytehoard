<?php

#name Main Site
#author Andrew Godwin
#description Links to an external address

$linkdestination = "http://www.the-link-here.com/wherever/";

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

header("Location: " . $linkdestination);