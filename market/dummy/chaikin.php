<?php include_once("functions.php");

$query = mysql_query("select high,low, ltp,total_volume from eod_stock where company_id = 11;");
$high = array();

while(($row =  mysql_fetch_assoc($query))) {
    $high[] = $row['high'];
    $low [] = $row['low'];
    $close []= $row['ltp'];
    $volume [] = $row['total_volume'];
}

print_r(trader_ad($high,$low,$close,$volume));