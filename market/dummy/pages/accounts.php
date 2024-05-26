<?php

session_start();

include("header.php");

$username = $auth->getUsername($_COOKIE['auth_session']);

$user = $auth->getUserData($username);

$userid = $user['uid'];

if(isset($_GET['id'])){

        $contest_id = $_GET['id'];
}

?>

<div class="row header">

  <div class="col-md-6"> <img src="img/Logo2small.png" /> </div>

  <div class="col-md-12 col-lg-12 col-sm-12">

    <div class="clearfix pull-right"><a href="?page=home" class="btn btn-primary btn-sm "><i class="glyphicon glyphicon-home"></i> Home</a> <a href="?page=portfolioDetails&id=<?php echo $contest_id?>" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-briefcase"></i> My Portfolio</a> <a href="?page=change-password" class="btn btn-warning btn-sm "><i class="glyphicon glyphicon-lock"></i> Change Password</a> <a href="?page=change-email" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-envelope"></i> Change Email</a> <a href="?page=logout" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-off"></i> Logout</a> </div>

  </div>

</div>

<div class="row">

<div class="col-md-12">

<center><h3>Your Portfolio History</h3></center>

<table class="table table-responsive table-bordered" id="myTable">

<thead>

  <tr>

    <th>Ticker</th>

    <th>Buy Date</th>

    <th>Buy Price</th>

    <th>Buy Volume</th>

    <th>Buy Commision</th>

    <th>Total Buy TK</th>

    <th>Sell Date</th>

    <th>Sell Price</th>

    <th>Sell Volume</th>

    <th>Sell Commision</th>

    <th>Total Sell TK</th>

    

    <th>Net Gain/Loss</th>

    

  </tr>

</thead>

<tbody>

<tr>

<?php $query = showAccounts($userid,$contest_id);// Get portfolio of the current user   

$lbp = 0;

while($info = mysql_fetch_array($query)) {?>

  <td><?php echo $info['code'];?></td>

  <td><?php echo $info['buy_date'];?></td>

  <td><?php echo $info['buy_price'];?></td>

  <td><?php echo $info['buy_amount'];?></td>

  <td><?php echo $info['buy_commision'];?></td>

  <td><?php  $bp =((($info['buy_price']*$info['buy_amount'])+$info['buy_commision']));

    if($info['buy_date']>0){echo $bp;}else{echo "";}

  ?></td>

<td><?php echo $info['sell_date'];?></td>

<td><?php echo $info['sell_price'];?></td>

<td><?php echo $info['sell_amount'];?></td>

<td><?php echo $info['sell_commision'];?></td>

<td><?php  $sp =((($info['sell_price']*$info['sell_amount'])-$info['sell_commision']));

 if($info['sell_date']>0){ echo $sp;} else{ echo "";}?></td>

<td>

<?php 

if ($info['buy_price'] == "") {

} else {

  $lbp = $info['buy_price'];

}

  $bs = $lbp*$info['sell_amount'];

   $gl = ($sp-($bs+($bs*0.005)));

  if($info['sell_date']>0) { 

    echo $gl;

  } else {

    echo "";

    }

?></td>

</tr>

<?php } ?>

</tbody></table></div></div>

