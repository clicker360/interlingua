<?php
$a = urldecode(@$_GET['a']);

if (strstr(strtolower($a), ".xml") != "") {
	header('Content-type: text/xml');
	readfile($a);
} else if (strstr(strtolower($a), ".pdf") != "") {
	header('Content-type: application/pdf');
	readfile($a);
}

?>