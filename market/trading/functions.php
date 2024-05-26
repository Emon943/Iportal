<?php

error_reporting(0);

//setting timezone

date_default_timezone_set('Asia/Dhaka');

//importaing DB Class

include_once("db.php");

$base_url = "http://localhost/iportal/market/trading/";

//Importaing highcharts wrapper class

//include_once('libraries/Highchart.php');

// Get List of curretn Month

function getPortfoliolist($userid){

	$query = mysql_query("SELECT *FROM tr_profile WHERE user_id = '$userid'");

	return $query;

}

//details of portfolio

function getPortfolio($userid,$portfolio_id){

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
CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) AS changes,
CAST(((e.ltp-p.buy_price)/p.buy_price)*100 AS DECIMAL(10,2)) AS buy_change_percentage,
(e.ltp-p.buy_price) AS buy_chnage, 
e.ltp
FROM company AS c
LEFT OUTER JOIN tr_portfolio AS p
ON p.company_id = c.ID
LEFT OUTER JOIN eod_stock AS e
ON p.company_id = e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)
WHERE user_id = $userid AND profile_id = $portfolio_id");

	return $query;

}

function checkBalance($userid,$portfolio_id){

	$query = mysql_query("SELECT portfolio_amount,comission_rate FROM tr_profile WHERE user_id = $userid AND ID = $portfolio_id");

	return $query;

}

function stockDetails(){

  $query = mysql_query("SELECT 

c.ID,

c.code,

e.ltp,

e.entry_date AS `date`

-- , e.*

FROM eod_stock AS e

LEFT OUTER JOIN company AS c

ON c.ID = e.company_id

WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)");

return $query;

}

function executeOrder($userid,$profile_id,$balance,$company_id,$amount,$buy_price,$buy_date,$order_val){

   $commision = ($order_val-($buy_price*$amount));

   $query = mysql_query("INSERT INTO tr_portfolio (user_id,profile_id,company_id,share_amount,buy_price,total_buy_price,buy_date,commision) VALUES ('$userid', '$profile_id', '$company_id', '$amount', '$buy_price','$order_val','$buy_date','$commision')");
    
   $query = mysql_query("INSERT INTO tr_accounts (portfolio_id,profile_id,user_id,company_id,buy_price, buy_amount,buy_commision,buy_date) VALUES (LAST_INSERT_ID(),'$profile_id', '$userid', '$company_id', '$buy_price', '$amount', '$commision', '$buy_date')");

	$query = mysql_query("UPDATE tr_profile SET portfolio_amount = $balance WHERE user_id = $userid AND ID = $profile_id");	

	if($query){

 		$response_array['status'] = 'success';
    
 	} else{

 		$response_array['status'] = 'error';
    


 	}
    echo json_encode($response_array);
}

function investmentHolding($userid,$profile_id){

$query1 = mysql_query("SELECT

portfolio_amount as cash

FROM tr_profile

WHERE user_id = $userid AND ID = $profile_id;");

	while($info = mysql_fetch_array($query1)) {

    $balance = $info['cash'];

}

	

$query = mysql_query("SELECT

c.code,

sum(p.share_amount*e.ltp) AS cash

FROM company AS c

LEFT JOIN tr_portfolio AS p

ON p.company_id = c.ID

LEFT JOIN eod_stock AS e

ON p.company_id = e.company_id

WHERE user_id = $userid AND profile_id = $profile_id AND p.total_buy_price>0 AND p.share_amount>p.sell_share_amount AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)

GROUP BY c.code;

");

// Print out rows

$prefix = '';

echo "[\n";

echo $prefix . " {\n";

  echo '  "company": "Cash",' . "\n";

  echo '  "TK": ' . $balance . ',' . "\n";

  echo " }";

  $prefix = ",\n";

while ( $row = mysql_fetch_assoc($query) ) {

	$total += $row['total_buy_price'];

  echo $prefix . " {\n";

  echo '  "company": "' . $row['code'] . '",' . "\n";

  echo '  "TK": ' . $row['cash'] . ',' . "\n";

  echo " }";

  $prefix = ",\n";

}

echo "\n]";

}

function businessSegment($userid,$portfolio_id){

	$query = mysql_query("SELECT

c.code,

s.name,

sum(p.share_amount*e.ltp) AS cash

FROM company AS c

LEFT JOIN tr_portfolio AS p

ON c.ID = p.company_id

RIGHT JOIN sector AS s

ON c.sector_id = s.sector_ID

LEFT JOIN eod_stock AS e

ON p.company_id = e.company_id

WHERE p.user_id = $userid AND profile_id = $portfolio_id AND p.total_buy_price > 0 AND p.share_amount>p.sell_share_amount AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)

GROUP BY s.name;");

// Print out rows

$prefix = '';

echo "[\n";

while ( $row = mysql_fetch_assoc($query) ) {

  echo $prefix . " {\n";

  echo '  "Sector": "' . $row['name'] . '",' . "\n";

  echo '  "Total": ' . $row['cash'] . ',' . "\n";

    echo " }";

  $prefix = ",\n";

}

echo "\n]";

}

function correlation($userid) {

$query = mysql_query("SELECT

DISTINCT c.code,

e.entry_date,

e.ltp

FROM company AS c

LEFT JOIN tr_portfolio AS p

ON p.company_id = c.ID

RIGHT JOIN eod_stock AS e

ON e.company_id = p.company_id 

WHERE p.user_id = 1 AND e.entry_date >= DATE_SUB(CURDATE(), INTERVAL 2 MONTH)

ORDER BY c.code DESC;");

return $query;

}

function portfolioYield($userid,$profile_id){

  $query = mysql_query("SELECT

DISTINCT c.code,

(p.share_amount*e.ltp) AS investment,

d.div_cash,

e.ltp

FROM company AS c

LEFT OUTER JOIN tr_portfolio AS p

ON p.company_id = c.ID

LEFT OUTER JOIN eod_stock AS e

ON p.company_id = e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)

LEFT JOIN dp_dividend AS d 

ON c.code = d.code AND d.div_year = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))

where p.user_id = $userid AND p.profile_id = $profile_id ");

return $query;

}

function portfolioPE($userid,$profile_id){

  $query = mysql_query("SELECT

DISTINCT(c.code),

if((p.share_amount-p.sell_share_amount)>0,(p.share_amount-p.sell_share_amount)*e.ltp,NULL) AS investment,

d.eps,

e.ltp

FROM company AS c

LEFT OUTER JOIN tr_portfolio AS p

ON p.company_id = c.ID

LEFT OUTER JOIN eod_stock AS e

ON p.company_id = e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)

LEFT JOIN dp_eps AS d

ON c.code = d.code

where p.user_id = $userid AND p.profile_id = $profile_id ;");

return $query;

}

function portfolioPayout($userid,$profile_id){

  $query = mysql_query("SELECT

DISTINCT c.code,

(p.share_amount*e.ltp) AS investment,

d.div_cash,

ep.eps

FROM company AS c

LEFT OUTER JOIN tr_portfolio AS p

ON p.company_id = c.ID

LEFT OUTER JOIN eod_stock AS e

ON p.company_id = e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)

LEFT JOIN dp_dividend AS d

ON c.code = d.code

Left JOIN dp_eps AS ep

ON c.code = ep.code

where p.user_id = $userid AND p.profile_id = $profile_id AND d.div_year = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR));");

return $query;

}

function calcVariance(){

  $query = mysql_query("SELECT

c.code,

c.ID,

VAR_SAMP(e.ltp-e.ycp) AS vari

FROM company AS c

JOIN eod_stock AS e

on e.company_id = c.ID

WHERE e.entry_date between '2013-01-15' and CURDATE()

AND e.company_id in(1,12)

GROUP BY c.code;");

}

function portfolioWeight($userid,$profile_id){

  $query = mysql_query("SELECT
c.ID,
c.code,
(p.share_amount*e.ltp) AS investment
FROM company AS c
LEFT JOIN eod_stock AS e
ON c.ID = e.company_id and e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)
LEFT JOIN tr_portfolio AS p
ON c.ID = p.company_id
WHERE p.user_id =$userid and p.profile_id = $profile_id and p.share_amount>p.sell_share_amount;");
  return $query;
}

function calcCovariance($userid,$profile_id){

	

	echo "<table class='table table-bordered'>

        <thead>

		<th>Ticker</th>

		<th>Beta Of Stock</th>

		</thead><tbody><tr>";

	

	$query = mysql_query("SELECT 
DISTINCT p.company_id,
c.code
FROM tr_portfolio AS p
LEFT JOIN company AS c
ON c.ID = p.company_id
WHERE user_id = $userid AND profile_id = $profile_id and share_amount> sell_share_amount;");

while($info = mysql_fetch_assoc($query)) {

$id  = $info['company_id'];
$ccode =  $info['code'];

echo "<td>". $ccode. "</td><td>".number_format(stats_covariance(idxDev($id),comChange($id))/stats_variance(idxDev($id)),4) ."</td></tr>";

  }//while close

  echo "</tbody></table>";


} 



function idxDev($id){// list the array of index return (daily changes) of all days' 
//wheather or not traded of stock

	

	$query1 = mysql_query("SELECT

IDX_PERCENTAGE_DEVIATION, 

IDX_DATE_TIME, 

getchange(IDX_DATE_TIME,$id) as changes 

FROM idx WHERE IDX_DATE_TIME >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) 

ORDER by IDX_DATE_TIME ASC");



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

FROM idx WHERE IDX_DATE_TIME >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) 

ORDER by IDX_DATE_TIME ASC");



while($info1 = mysql_fetch_assoc($query1)) {



    $c[] = $info1['changes'];

    

	

}//close while 2



	return $c;

}

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function showAccounts($user_id,$profile_id) {

  

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

FROM tr_accounts
tr_accounts AS a

LEFT OUTER JOIN company AS c

ON c.ID = a.company_id

WHERE user_id = $user_id

AND profile_id = $profile_id

ORDER BY a.portfolio_id ASC;

");

  

  return $query;

}

function companyDetails($id){
  $query = mysql_query("SELECT 
c.code,
c.name,
c.category,
c.market_lot,
e.ltp
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id = $id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock);");
  while($info = mysql_fetch_array($query)) {
$result = array(
  'code'      => $info['code'],
  'name'      => $info['name'],
  'cat'       => $info['category'],
  'mlot'      => $info['market_lot'],
  'ltp'       => $info['ltp'],
  'lot_val'   => ($info['ltp']+($info['ltp']*.5)/100)*$info['market_lot'],
  );
}
return $result;
}


function stayOrder($userid,$profile_id,$order_type,$company_id,$amount,$buy_price,$buy_date,$order_val,$expiry_date){

   $commision = ($order_val-($buy_price*$amount));

   $query = mysql_query("INSERT INTO tr_stay (user_id,profile_id,order_type, order_date, expiry_date, company_id, volume, buy_price, total_buy_price, commision) VALUES ('$userid', '$profile_id', '$order_type', '$order_date', '$expiry_date',  '$company_id', '$amount', '$buy_price','$order_val','$commision')");
    

  if($query){

    $response_array['status'] = 'success';
    
  } else{

    $response_array['status'] = 'error';
    


  }
    echo json_encode($response_array);
}