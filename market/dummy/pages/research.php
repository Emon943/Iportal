<?php include("header.php");?>
<div class="row header">
  <div class="col-md-2"> <img src="img/logo.png" class="img-responsive" /> </div>
  <div class="col-md-6 pull-right m-t-xs text-right"> <span>Welcome <strong><?php echo $username; ?></strong>!</span> <br/>
    <br/>
    <a href="?page=home" class="btn btn-primary btn-sm "><i class="glyphicon glyphicon-home"></i> Home</a> <a href="?page=change-password" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-lock"></i> Change Password</a> <a href="?page=change-email" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-envelope"></i> Change Email</a> <a href="?page=logout" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-off"></i> Logout</a> </div>
  <div class="col-md-12 divider">
    <hr/>
  </div>
</div>
<div class="row"> 
  
  <!-- Nav tabs -->
  <div class="col-md-12 portfolio-nav">
    <ul>
      <li><a href="#"><i class="glyphicon glyphicon-briefcase"></i>&nbsp;Portfolio</a></li>
      <li  class="active"><a href="?page=research&id=<?php echo $portfolio_id; ?>"><i class="glyphicon glyphicon-random"></i>&nbsp;Research</a></li>
      <li><a href="?page=allocation&id=<?php echo $portfolio_id; ?>"><i class="glyphicon glyphicon-align-justify"></i>&nbsp;Allocation</a></li>
      <li><a href="?page=company&id=<?php echo $portfolio_id; ?>"><i class="glyphicon glyphicon-file"></i>&nbsp;Company Details</a></li>
      <li><a href="?page=accounts&id=<?php echo $portfolio_id; ?>"><i class="glyphicon glyphicon-file"></i>&nbsp;Accounts</a></li>
      <li><a href="#"><i class="glyphicon glyphicon-certificate"></i>&nbsp;Statements</a></li>
      <li class="pull-right"><a href="#"><i class="glyphicon glyphicon-flag"></i>&nbsp;Alert</a></li>
    </ul>
  </div>
<div class="col-md-12">
<?php $username = $auth->getUsername($_COOKIE['auth_session']);

$user = $auth->getUserData($username);

$userid = $user['uid'];

date_default_timezone_set('Asia/Dhaka');

$newdate = date('Y-m-d', time());

$portfolio_id = $_GET['id'];

$_SESSION['portfolio_id'] = $portfolio_id;

$time = date('H:i:s');?>

 <h3>Portfolio Yield<small>@ market price</small></h3>
    <?php $query = portfolioYield($userid,$portfolio_id); 

while($info = mysql_fetch_array($query)) {

   

  $cashDividend     = ($info['div_cash']*10);

  $lTradePrice      =  $info['ltp'];

  $investments      = $info['investment'];

  

  $weight           = ($investments/$marketValue);

  $yield            = $cashDividend/$lTradePrice;

  $weightedYeild   += $weight*$yield;

}

?>
    <p><?php echo number_format(($weightedYeild*100),2). "%"; ?></p>
    <h3>Portfolio PE</h3>
    <?php $query = portfolioPE($userid,$portfolio_id); 

while($info = mysql_fetch_array($query)) {

   

  $eps     = ($info['eps']);

  $lTradePrice      =  $info['ltp'];

  $investments      = $info['investment'];

  $weight           = ($investments/$marketValue);

  $yield            = $lTradePrice/$eps;

  $wYeild          += $weight*$yield;

}

?>
    <p><?php echo number_format(($wYeild),2); ?></p>
    <h3>Portfolio Payout</h3>
    <?php $query = portfolioPayout($userid,$portfolio_id); 

while($info = mysql_fetch_array($query)) {

   

 $cashDividend     = ($info['div_cash']*10);

 $eps              = ($info['eps']);

 $investments      = $info['investment'];

 $weight           = ($investments/$marketValue);

 $payout           = ($cashDividend/$eps);

 $wPayout         += ($weight*$payout);

}

?>
    <p><?php echo number_format(($wPayout*100),2) . "%"; ?></p>
    <?php 

calcCovariance($userid,$portfolio_id);?>
    <h3>Portfolio Beta</h3>
    <?php $query = portfolioWeight($userid,$portfolio_id); 

$idx_array = array();

while($info = mysql_fetch_array($query)) {

      $idx_array = (idxDev($info['ID']));   

      $totInvestment +=$info['investment']; 

      $totWeight     += ($info['investment']/$marketValue)*100;

      $coid           = $info['ID'];

      $iBeta          = number_format(stats_covariance(idxDev($coid),comChange($coid))/stats_variance(idxDev($coid)),4);

      $totbeta       +=$iBeta;

      $totPbeta      +=  ($iBeta*($info['investment']/$marketValue));

 }?>
    <strong><?php echo $totPbeta; ?></strong>
    <h4>Expected Return</h4>
    <table class="table table-responsive table-striped table-portfolio">
      <thead>
        <tr>
          <th>Ticker</th>
          <th>Risk Free Rate</th>
          <th>Beta</th>
          <th>Average Market Return</th>
          <th>Expected Return</th>
        </tr>
      </thead>
      <tbody>
          
        <tr>
        <?php $query = portfolioWeight($userid,$portfolio_id); 



$rf = 0.08;

while($info = mysql_fetch_array($query)) {?>
      <td><?php echo $info['code']; ?></td>
        <td><?php echo ($rf*100) . "%"; ?></td>
        <td><?php echo $iBeta = number_format(stats_covariance(idxDev($info['ID']),comChange($info['ID']))/stats_variance(idxDev($info['ID'])),4);?></td>
        <td><?php 
        $marketReturn = (array_sum($idx_array)/count($idx_array));
        echo (number_format($marketReturn,4)*100); ?>
          %</td>
        <td><?php  $expectedReturn =  ($rf+$iBeta*($marketReturn-$rf)); 
            echo number_format(($rf+$iBeta*($marketReturn-$rf)),2)*100;
          ?>
          %</td>
      </tr>
      <?php

        $averagestockReturn = array_sum(comChange($info['ID']))/count(comChange($info['ID']));

        $averagemarketRerurn = array_sum(idxDev($info['ID']))/count(idxDev($info['ID']));

        $totaInvestment +=$info['investment']; 

        $Weightofstock     =+ ($info['investment']/$marketValue);

        $portfolioReturn += $expectedReturn*$Weightofstock;

        $wasr += $averagestockReturn*$Weightofstock;

        $marketstdv = stats_standard_deviation(idxDev($info['ID']));

        


         } ?>
        </tbody>
      
    </table>
    <h4>Portfolio Expected Return:</h4>
    <small><?php echo number_format($portfolioReturn,3)*100; ?>%</small>
    <h4>Treynor Measure: (Market)</h4>
    <small><?php echo number_format((($marketReturn-$rf)/$totPbeta),2);?></small>
    <h4>Treynor Measure: (Portfolio)</h4>
    <small><?php echo number_format((($wasr-$rf)/$totPbeta),2);?></small>
    <h4>Jensen Measure:</h4>
    <small><?php echo number_format(($wasr-($rf+$totPbeta*($averagemarketRerurn-$rf))),4)*100;?>%</small>
    <h4>Sharpe Measure: (Market)</h4>
    <small><?php echo number_format(($averagemarketRerurn-$rf)/$marketstdv);?></small> </div>
  <div class="tab-pane" id="pv">
    <h3> Stock Weight</h3>
    <table class="table table-responsive table-striped table-portfolio">
      <thead>
      <th>Ticker</th>
        <th>Investment</th>
        <th>Weight% <small> (MARKET PRICE)</small></th>
          </thead>
      <tbody>
        <tr>
          <?php $query = portfolioWeight($userid,$portfolio_id); 

 

while($info = mysql_fetch_array($query)) {?>
          <td><?php echo $info['code']; ?></td>
          <td><?php $totalInvestment +=$info['investment']; echo $info['investment']; ?></td>
          <td><?php $totalWeight += ($info['investment']/$marketValue)*100; echo number_format(($info['investment']/$marketValue)*100,2) . "%"; ?></td>
        </tr>
        <?php }?>
        <tr>
          <td><strong>Total</strong></td>
          <td><strong><?php echo number_format($totalInvestment,2); ?></strong></td>
          <td><strong><?php echo $totalWeight . "%"; ?></strong></td>
        </tr>
      </tbody>
    </table>
  </div>

    
  
  <!-- close company details --> 
  
</div>
</div>
<?php include("footer.php");  ?>