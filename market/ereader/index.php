<?php
 $ch = curl_init();
curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . "/certs/cacert.pem");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
$file = 'https://dsebd.org/datafile/quotes.txt';
$a = file_get_contents($file);


$filename = $a;
$fd = fopen($filename,"r");
$contents = fread ($fd,filesize ($filename));
fclose($fd);

$splitcontents = explode(" ", $contents);
$counter = 0;

foreach($splitcontents as $data){
	echo $counter++;
	echo ":  " . $data;
	}


?>