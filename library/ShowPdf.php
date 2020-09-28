<?php
date_default_timezone_set('Asia/Kolkata');
$date=date("d-m-Y");
//$file ="C:/Users/Zaid/Desktop/pdfs/".$date.".pdf";

$file=$date.".pdf";
$filename= $date.'.pdf';
header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="' . $filename . '"');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($file));
    header('Accept-Ranges: bytes');

    @readfile($file);





?>