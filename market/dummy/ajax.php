<?php include_once("functions.php");
$function = $_REQUEST['function'];
$id = $_REQUEST['id'];
if($function=='buy'){
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
 	'name'			=> $info['name'],
 	'cat'			=> $info['category'],
 	'mlot'			=> $info['market_lot'],
 	'ltp'			=> $info['ltp'],
	'lot_val'		=> ($info['ltp']+($info['ltp']*.5)/100)*$info['market_lot'],
	);
}
echo json_encode($result);
}

elseif($function=='sell') {

	$user_id = $_REQUEST['uid'];
	$profile_id = $_REQUEST['con_id'];
	$company_id = $_REQUEST['cid'];
	$arr = explode(',', $company_id); //split string into array seperated by ', '

	$comp_id 	= $arr[0];
	$port_id    = $arr[1];




	$query = mysql_query("SELECT
e.ltp,
c.code,
c.market_lot,
(e.ltp*c.market_lot) AS pvl,
p.share_amount,
p.portfolio_ID
FROM company AS c
LEFT OUTER JOIN dp_portfolio AS p
ON p.company_id = c.ID 
LEFT OUTER JOIN eod_stock AS e 
ON c.ID = e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)
WHERE p.user_id = $user_id AND p.profile_id = $profile_id AND p.company_id = $comp_id AND p.portfolio_ID = $port_id;");

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

}

elseif($function=='execute'){
	$profile_id = $_REQUEST['po_id']; 
	$userid 	= $_REQUEST['user'];
	$amount 	= $_REQUEST['amount'];
	$buy_date	= $_REQUEST['buy_date'];
	$company_id = $_REQUEST['com_id'];
	$buy_price  = $_REQUEST['buy_price'];
	$order_val  = $_REQUEST['order_val'];
	$balance 	= $_REQUEST['balance'];
	executeOrder($userid,$profile_id,$balance,$company_id,$amount,$buy_price,$buy_date,$order_val);
}
elseif($function=='createPortfolio'){
		
	$userid 			= filter_var($_REQUEST['user'],FILTER_SANITIZE_NUMBER_INT);
	$portfolio_name		= filter_var($_REQUEST['name'],FILTER_SANITIZE_STRING);
	$portfolio_amount	= filter_var($_REQUEST['investment'],FILTER_SANITIZE_NUMBER_INT);
	$comission_rate		= filter_var($_REQUEST['com_rate'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
	if(validateDate($_REQUEST['create_date'])){
			$creation_date		= $_REQUEST['create_date'];
	}
	
 $sql = "INSERT INTO dp_profile (user_id,portfolio_name,portfolio_amount,comission_rate,creation_date) VALUES('$userid', '$portfolio_name', '$portfolio_amount', '$comission_rate', '$creation_date')";
 $sql2 ="INSERT INTO dp_investment (profile_id, user_id, amount) VALUES (LAST_INSERT_ID(), '$userid', '$portfolio_amount')";
 $query = mysql_query($sql);
 $query2 = mysql_query($sql2);
 if($query2){
 	echo "Success";
 }
}
elseif($function=='getBalance'){
	$portfolio_id = $_POST['profile_id'];
	$userid 	  = $_POST['user_id'];
	$query = mysql_query("SELECT portfolio_amount FROM dp_profile WHERE ID = $portfolio_id AND user_id = $userid");
	while($info = mysql_fetch_array($query)) {
		$data = array(
		'amount' =>  $info['portfolio_amount']
		);
}
echo  json_encode($data);
}
elseif($function=='addFund'){
	$portfolio_id = $_POST['portfolio_id'];
	$userid 	  = $_POST['user_id'];
	$fund 		  = $_POST['fund'];
$query 	= mysql_query("UPDATE dp_profile SET portfolio_amount = portfolio_amount + $fund WHERE ID = $portfolio_id and user_id= $userid");
$query2 = mysql_query("INSERT INTO dp_investment (`profile_id`, `user_id`, `amount`) VALUES ('$portfolio_id', '$userid', '$fund')");

if($query2){
	echo "success";
	}
else{ print mysql_error();}
}
//withdraw
elseif($function=='withdrawFund'){
	$portfolio_id = $_POST['portfolio_id'];
	$userid 	  = $_POST['user_id'];
	$fund 		  = $_POST['fund'];
$query 	= mysql_query("UPDATE dp_profile SET portfolio_amount = portfolio_amount - $fund WHERE ID = $portfolio_id and user_id= $userid");
$query2 = mysql_query("INSERT INTO dp_withdraw (`profile_id`, `user_id`, `amount`) VALUES ('$portfolio_id', '$userid', '$fund')");

if($query2){
	echo "success";
	}
else{ print mysql_error();}
}
//
elseif($function=='getprofile'){
	$portfolio_id = $_POST['profile_id'];
	$userid 	  = $_POST['user_id'];

$query 	= mysql_query("SELECT portfolio_name, comission_rate FROM dp_profile WHERE ID = '$portfolio_id' AND user_id = '$userid'");


while($info = mysql_fetch_array($query)) {
		$data = array(
		'name' =>  $info['portfolio_name'],
		'comission_rate' => $info['comission_rate']
		);
echo  json_encode($data);
}
}

//edit profile
elseif($function=='editPortfolio'){
	$portfolio_id 	= $_POST['portfolio_id'];
	$userid 	  	= $_POST['user_id'];
	$com 		  	= $_POST['com'];
	$portfolio_name = $_POST['portfolio_name'];
$query 	= mysql_query("UPDATE dp_profile SET portfolio_name = '$portfolio_name', comission_rate = '$com'  WHERE ID = $portfolio_id and user_id= $userid");

	}

//delete profile
elseif($function=='deleteProfile'){
	$portfolio_id 	= $_POST['portfolio_id'];
	$userid 	  	= $_POST['user_id'];
	
$query 	= mysql_query("DELETE FROM dp_profile
WHERE ID = '$portfolio_id' AND user_id = '$userid'");

	if($query){

	echo 'success';
	}
}


elseif($function=='sellexecute'){

	$portfolio_ID = $_REQUEST['pid'];
	$user_id 	  = $_REQUEST['user'];
	$profile_id	  = $_REQUEST['prof_id'];
	$company_id	  = $_REQUEST['com_id'];
	$sell_share_amount = $_REQUEST['amount'];
	$sell_price  = $_REQUEST['sell_price'];
	$sell_date 	= $_REQUEST['sell_date'];
	$sell_com  = (($sell_price*$sell_share_amount)*.5/100);
	$total_sell_price  = (($sell_price*$sell_share_amount)- $sell_com);

	$arr = explode(',', $company_id); //split string into array seperated by ', '

	$comp_id 		 = $arr[0];
	$portfolio_ID    = $arr[1];



	$query  = mysql_query("UPDATE dp_portfolio SET sell_share_amount = sell_share_amount + $sell_share_amount, sell_price = $sell_price, total_sell_price = $total_sell_price,  `sell_date` = CAST('$sell_date' AS DATE), sell_commision = $sell_com WHERE portfolio_ID = '$portfolio_ID' AND company_id = '$comp_id';");

	$query = mysql_query("INSERT INTO dp_accounts (`portfolio_id`,`profile_id`,`user_id`,`company_id`,`sell_price`,`sell_amount`,`sell_commision`,`sell_date`) VALUES ('$portfolio_ID','$profile_id','$user_id','$comp_id','$sell_price','$sell_share_amount','$sell_com',CAST('$sell_date' AS DATE))");

	$query = mysql_query("UPDATE dp_profile SET portfolio_amount = portfolio_amount + $total_sell_price WHERE user_id = $user_id AND ID = $profile_id");
	if($query) {

		echo "Success";
	} else {

		echo "fail";
		print mysql_error($con);
	}
}
?>