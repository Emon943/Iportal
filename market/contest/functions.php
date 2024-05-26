<?php
//setting timezone
date_default_timezone_set('Asia/Dhaka');
//importaing DB Class
include_once("db.php");
$base_url = "http://localhost/iportal/market/contest/";
//$base_url = "http://capm.smartsolutionpro.us/iportal/market/contest/";
//Importaing highcharts wrapper class
//include_once('libraries/Highchart.php');
// Get contest List of curretn Month
function getCurrentContest(){
	$query = mysql_query("SELECT ID,name,type,amount,start_date,end_date FROM contest WHERE  YEAR(start_date) = YEAR(CURDATE()) AND MONTH(start_date) = MONTH(CURDATE());");
	return $query;
}
// Type cast of contest
// @ return general for 1
// @ return university for 2
function contestType($type){
	if($type==1){
		return "General";
	} elseif($type==2){
		return "University";
	}
}
function participantList($id){
		$query = mysql_query("SELECT
p.user_name,
p.joining_date,
count(po.company_id),
sum(po.share_amount-po.sell_share_amount) AS total_shares,
((sum(e.ltp*(po.share_amount-po.sell_share_amount))+p.avail_amount)/100000)-1 AS growth,
(sum(e.ltp*(po.share_amount-po.sell_share_amount))+p.avail_amount) AS total_amount
FROM portfolio AS po
LEFT OUTER JOIN participants AS p
ON p.user_id = po.user_id
LEFT OUTER JOIN eod_stock AS e
ON e.company_id = po.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)
WHERE po.contest_id = $id AND MONTH(po.buy_date) = MONTH(NOW())
GROUP BY po.user_id
ORDER BY growth DESC;
");
return $query;
} 
function companyDropDown(){
  $query =mysql_query("select ID as cid, code from company where sector_id in (1,2,3,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21)");
  return $query;
}
function companyDetails($id){
	$query = mysql_query("SELECT c.ID,c.code, c.name, c.category, c.market_lot,(SELECT avail_amount FROM participants WHERE user_id = 1) AS pamount, e.ltp FROM company AS c LEFT OUTER JOIN eod_stock AS e ON e.company_id = c.ID WHERE e.company_id = $id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock) ");
	return $query;
}
function stockDetails(){
  
  $query = mysql_query("SELECT 
c.ID,
c.code,
e.ltp,
e.ycp,
e.entry_date AS `date`
-- , e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)");
return $query;
}
 function joinContest($conest_id,$userid,$username,$joiningdate){
 	$query = mysql_query("SELECT amount FROM contest WHERE ID = '$conest_id'");
 	while($info = mysql_fetch_array($query)) {
 		$amount = $info['amount'];
 	}
 	$query = mysql_query("INSERT INTO participants (contest_ID,user_id,user_name,joining_date,avail_amount) VALUES ('$conest_id', '$userid', '$username', '$joiningdate', '$amount')");
 	if($query){
 		echo "You Have Successfully Joined This Contest";
 	} else{
 		echo "There is an error!";
 	}
}
function checkUser($userid,$contest_id){
$query = mysql_query("SELECT ID FROM participants WHERE user_id = $userid AND contest_ID = $contest_id");
return $query;
}
function executeOrder($userid,$contest_id,$company_id,$amount,$buy_price,$buy_date,$order_val){
   $commision = ($order_val-($buy_price*$amount));
   $query = checkBalance($userid,$contest_id);
   while($info = mysql_fetch_array($query)) {
    $balance = $info['avail_amount'];
    };
    $new_balance = ($balance-$order_val);
	$query = mysql_query("INSERT INTO portfolio (user_id,contest_id,company_id,share_amount,buy_price,total_buy_price,buy_date,commision) VALUES ('$userid', '$contest_id', '$company_id', '$amount', '$buy_price','$order_val','$buy_date','$commision')");
	
	$query = mysql_query("INSERT INTO contest_accounts (portfolio_id,contest_id,user_id,company_id,buy_price, buy_amount,buy_commision,buy_date) VALUES (LAST_INSERT_ID(),'$contest_id', '$userid', '$company_id', '$buy_price', '$amount', '$commision', '$buy_date')");
	$query = mysql_query("UPDATE participants SET avail_amount = $new_balance WHERE user_id = $userid AND contest_ID = $contest_id");	
	if($query){
 		echo "You Have Successfully Purchased";
 	} else{
 		echo "There is an error!";
 	}
}
function getPortfolio($userid,$contest_id){
	$query = mysql_query("SELECT
c.ID,		
c.code,
c.name,
p.portfolio_ID, 
p.share_amount,
p.buy_date,
p.buy_price,
p.total_buy_price,
p.commision,
p.sell_share_amount,
(SELECT (p.total_buy_price/amount)*100  FROM contest WHERE ID = $contest_id) AS weight,
CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) AS changes,
CAST(((e.ltp-p.buy_price)/p.buy_price)*100 AS DECIMAL(10,2)) AS buy_change_percentage,
(e.ltp-p.buy_price) AS buy_chnage, 
e.ltp
FROM company AS c
LEFT OUTER JOIN portfolio AS p
ON p.company_id = c.ID
LEFT OUTER JOIN eod_stock AS e
ON p.company_id = e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)
where p.user_id = $userid AND p.contest_id = $contest_id;");
	return $query;
}
function checkBalance($userid,$contest_id){
	$query = mysql_query("SELECT avail_amount FROM participants WHERE user_id = $userid AND contest_ID = $contest_id");
	return $query;
}
function maturity($start_date,$end_date){
$datetime1 = new DateTime($start_date);
$datetime2 = new DateTime($end_date);
$interval = $datetime1->diff($datetime2);
$woweekends = 0;
for($i=0; $i<=$interval->d; $i++){
    $modif = $datetime1->modify('+1 day');
    $weekday = $datetime1->format('w');
    if($weekday != 5 && $weekday != 6){ // 0 for Sunday and 6 for Saturday
        $woweekends++;  
    }
}
return  $woweekends;
}
function showAccounts($user_id,$contest_id) {
	
	$query = mysql_query("SELECT
c.code,
a.company_id,
a.buy_price,
a.buy_amount,
a.buy_commision,
a.buy_date,
a.sell_price,
a.sell_amount,
a.sell_commision,
a.sell_date
FROM contest_accounts AS a
LEFT OUTER JOIN company AS c
ON c.ID = a.company_id
WHERE user_id = $user_id
AND contest_id = $contest_id
ORDER BY a.portfolio_id ASC;
");
	
	return $query;
}
function mempty()
{
    foreach(func_get_args() as $arg)
        if(empty($arg))
            continue;
        else
            return false;
    return true;
}
// hover chart Date and volume


