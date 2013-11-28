<?php
$filename = 'reporte_interlingua_'.date('Y-m-d_H:i:s');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename.xls");
header("Pragma: no-cache");
header("Expires: 0");
header("Accept-Charset: utf-8;");

echo utf8_decode($content_for_layout);
?>
