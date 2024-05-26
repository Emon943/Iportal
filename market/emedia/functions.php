<?php
//setting timezone
date_default_timezone_set('Asia/Dhaka');
//importaing DB Class
include_once("db.php");
$base_url = "http://localhost/iportal/market/emedia/";
//Importaing highcharts wrapper class
//include_once('libraries/Highchart.php');
// Get contest List of curretn Month
function getlist() {
	
	$query = mysql_query("SELECT
s.name,
c.ID,
c.code,
e.ltp,
e.total_volume,
t.total_share
FROM sector AS s
LEFT JOIN company AS c
ON s.sector_id = c.sector_id
LEFT OUTER JOIN share_percentage AS t
ON c.ID = t.company_id
LEFT OUTER JOIN eod_stock AS e
ON e.company_id = c.ID AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock) 
WHERE e.ltp IS NOT NULL ORDER BY s.sector_ID ASC,c.code;");
return $query;
	
}

function bd_th_number($n) {
        // first strip any formatting;
        $n = (0+str_replace(",","",$n));
       
        // is this a number?
        if(!is_numeric($n)) return false;
       
        // now filter it;
        if($n>100) 
        return round(($n/1000),1);
       
        return number_format($n);
 }

 function bd_mn_number($n) {
        // first strip any formatting;
        $n = (0+str_replace(",","",$n));
       
        // is this a number?
        if(!is_numeric($n)) return false;
       
        // now filter it;
        if($n>100) 
        return round(($n/1000000),1);
       
        return number_format($n);
 }

 function idxDev($id){// list the array of index return (daily changes) of all days' 
//wheather or not traded of stock
        
        $query1 = mysql_query("SELECT
IDX_PERCENTAGE_DEVIATION, 
IDX_DATE_TIME, 
getchange(IDX_DATE_TIME,$id) as changes 
FROM idx WHERE IDX_DATE_TIME >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) 
ORDER by IDX_DATE_TIME DESC");
while($info1 = mysql_fetch_assoc($query1)) {
    $idx[] = $info1['IDX_PERCENTAGE_DEVIATION'];
    
}//close while 2
return $idx;
        
}
function comChange($id){// list array of daily chnages (return)
        
        $query1 = mysql_query("SELECT
IDX_PERCENTAGE_DEVIATION, 
IDX_DATE_TIME, 
getchange(IDX_DATE_TIME,$id) as changes 
FROM idx WHERE IDX_DATE_TIME >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) 
ORDER by IDX_DATE_TIME DESC");
while($info1 = mysql_fetch_assoc($query1)) {
    $c[] = $info1['changes'];
    
        
}//close while 2
        return $c;
}

function closingPrice($id){// list array of daily chnages (return)
        
        $query1 = mysql_query("SELECT
ltp FROM eod_stock WHERE company_id = $id ORDER BY entry_date ASC;");
while($info1 = mysql_fetch_assoc($query1)) {

    $c[] = $info1['ltp'];
    
        
}//close while 2
        return $c;
}

function getPrice($id){// list array of daily chnages (return)
        
        $query1 = mysql_query("SELECT
open,high,low,ltp FROM eod_stock WHERE company_id = $id ORDER BY entry_date ASC;");
while($info1 = mysql_fetch_assoc($query1)) {

    $o[] = $info1['open'];
    $h[] = $info1['high'];
    $l[] = $info1['low'];          
    $c[] = $info1['ltp'];
    
        
}//close while 2
        return array($o,$h,$l,$c);
}
function getrsi($id) {
	
	$query = mysql_query("SELECT ltp FROM eod_stock WHERE company_id = $id AND entry_date >= DATE_SUB(CURDATE(), INTERVAL 20 DAY) ORDER by entry_date DESC;");
	
	while($info = mysql_fetch_assoc($query)) {

    $c[] = $info['ltp'];
    
        
	}
	return $c;
}