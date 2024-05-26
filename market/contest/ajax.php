<?php include_once("functions.php");

$function = $_REQUEST['function'];

$id = $_REQUEST['id'];

if($function=='com'){

$query = companyDetails($id);

while($info = mysql_fetch_array($query)) {

$result = array(



 	'code'			=> $info['code'],

 	'name'			=>$info['name'],

 	'cat'			=>$info['category'],

 	'mlot'			=> $info['market_lot'],

 	'ltp'			=> $info['ltp'],

 	'balance'		=> $info['pamount'],



	);

}

echo json_encode($result);



}elseif($function=='buy'){



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



	'code'			=> $info['code'],

 	'name'			=>$info['name'],

 	'cat'			=> $info['category'],

 	'mlot'			=> $info['market_lot'],

 	'ltp'			=> $info['ltp'],

	'lot_val'		=> ($info['ltp']+($info['ltp']*.5)/100)*$info['market_lot'],

	);

}



echo json_encode($result);



}elseif($function=='joinContest'){



	$conest_id  = $_REQUEST['contest_id']; 

	$userid 	= $_REQUEST['userid'];

	$username 	= $_REQUEST['username'];

	$joiningdate= $_REQUEST['join_date'];



joinContest($conest_id,$userid,$username,$joiningdate);

}elseif($function=='execute'){



	$contest_id  = $_REQUEST['con_id']; 

	$userid 	= $_REQUEST['user'];

	$amount 	= $_REQUEST['amount'];

	$buy_date	= $_REQUEST['buy_date'];

	$company_id = $_REQUEST['com_id'];

	$buy_price  = $_REQUEST['buy_price'];

	$order_val  = $_REQUEST['order_val'];



	executeOrder($userid,$contest_id,$company_id,$amount,$buy_price,$buy_date,$order_val);



}



elseif($function=='sell') {



	$user_id = $_REQUEST['uid'];

	$contest_id = $_REQUEST['con_id'];

	$company_id = $_REQUEST['cid'];

	

	$com = explode(",", $company_id);



	$query = mysql_query("SELECT

e.ltp,

c.code,

c.market_lot,

(e.ltp*c.market_lot) AS pvl,

sum(p.share_amount-p.sell_share_amount) AS share_amount,

p.portfolio_ID

FROM company AS c

LEFT OUTER JOIN portfolio AS p

ON p.company_id = c.ID 

LEFT OUTER JOIN eod_stock AS e 

ON c.ID = e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)

WHERE p.user_id = $user_id AND p.contest_id = $contest_id AND p.company_id = $com[0] AND portfolio_ID = $com[1];");



while($info = mysql_fetch_array($query)) {



$result = array(



	'code'			=> $info['code'],

 	'mlot'			=> $info['market_lot'],

 	'ltp'			=> $info['ltp'],

	'lot_val'		=> $info['pvl'],

	'shares'		=> $info['share_amount'],

	'pid'			=> $info['portfolio_ID'],

	);

}

echo json_encode($result);



} elseif($function=='sellexecute'){



	$portfolio_ID = $_REQUEST['pid'];

	$user_id 	  = $_REQUEST['user'];

	$contest_id	  = $_REQUEST['con_id'];

	$company	  = $_REQUEST['com_id'];

	$com = explode(",", $company);

	$company_id = $com[0];

	$sell_share_amount = $_REQUEST['amount'];

	$sell_price  = $_REQUEST['sell_price'];

	$sell_date 	= $_REQUEST['sell_date'];

	$sell_com  = (($sell_price*$sell_share_amount)*.5/100);

	$total_sell_price  = (($sell_price*$sell_share_amount)- $sell_com);







	$query  = mysql_query("UPDATE portfolio SET sell_share_amount = sell_share_amount + $sell_share_amount, sell_price = $sell_price, total_sell_price = total_sell_price +  $total_sell_price,  `sell_date` = CAST('$sell_date' AS DATE), sell_commision = sell_commision + $sell_com WHERE portfolio_ID = $portfolio_ID;");

	

	$query = mysql_query("INSERT INTO contest_accounts (portfolio_id, contest_id, user_id, company_id, sell_price, sell_amount, sell_commision, sell_date) VALUES('$portfolio_ID','$contest_id','$user_id','$company_id','$sell_price', '$sell_share_amount','$sell_com', CAST('$sell_date' AS DATE))");

	

	$query = mysql_query("UPDATE participants SET avail_amount = avail_amount + $total_sell_price WHERE user_id = $user_id AND contest_ID = $contest_id");

	if($query) {



		echo "Success";

	}else{echo mysql_error($con);}

}

elseif($function=='stockChart'){

	$id = $_REQUEST['id'];


$query = mysql_query("SELECT entry_date,open,high,low, ltp, total_volume FROM eod_stock WHERE company_id = '$id'");

while ($info = mysql_fetch_array($query)) {

	

	$entry_date =  $info['entry_date'];

	$floatDate = date('Y,n,j', strtotime($entry_date));

	$result = array(

		/*'qdate' => $floatDate,
		'open'  => $info['open'],
		'high'  => $info['high'],
		'low'   => $info['low'],
		'close' => $info['ltp'],
		'vol'   => $info['total_volume']*/


$floatDate,
	 $info['open'],
	 $info['high'],
	 $info['low'],
	 $info['ltp'],
	$info['total_volume']

	);


	echo json_encode($result);
}


}



?>