<?php include("header.php");
$username = $auth->getUsername($_COOKIE['auth_session']);
$user = $auth->getUserData($username);
$userid = $user['uid'];
date_default_timezone_set('Asia/Dhaka');
$newdate = date('Y-m-d', time());
$portfolio_id = $_GET['id'];
$_SESSION['portfolio_id'] = $portfolio_id;
$time = date('H:i:s');
$query = checkBalance($userid,$portfolio_id);
while($info = mysql_fetch_array($query)) {
    $balance = $info['portfolio_amount'];
    $comission = $info['comission_rate'];
}
?>
<!--<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script> -->
<script src="js/vex.combined.min.js"></script>
<script>vex.defaultOptions.className = 'vex-theme-os';</script>
<link rel="stylesheet" href="css/vex.css" />
<link rel="stylesheet" href="css/vex-theme-os.css" />
<script src="js/amcharts.js" type="text/javascript"></script>
<script src="js/pie.js" type="text/javascript"></script>
<!-- scripts for exporting chart as an image -->
<!-- Exporting to image works on all modern browsers except IE9 (IE10 works fine) -->
<!-- Note, the exporting will work only if you view the file from web server -->
<!--[if (!IE) | (gte IE 10)]> -->
<script src="js/amexport.js" type="text/javascript"></script>
<script src="js/rgbcolor.js" type="text/javascript"></script>
<script src="js/canvg.js" type="text/javascript"></script>
<script src="js/jspdf.js" type="text/javascript"></script>
<script src="js/filesaver.js" type="text/javascript"></script>
<script src="js/jspdf.plugin.addimage.js" type="text/javascript"></script>
<!-- <![endif]-->
<script type="text/javascript">
            
var chart1Data = <?php investmentHolding($userid,$portfolio_id); ?>;
var chart2Data = <?php businessSegment($userid,$portfolio_id); ?>;
var colorList = ["#59a80f", "#28BF4E", "#109431", "#FCD202", "#F8FF01", "#B0DE09", "#04D215", "#0D8ECF", "#0D52D1", "#2A0CD0", "#8A0CCF", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
AmCharts.ready(function() {
    // PIE CHART 1
    var chart1 = new AmCharts.AmPieChart();
    chart1.dataProvider = chart1Data;
    chart1.titleField = "company";
    chart1.valueField = "TK";
    chart1.sequencedAnimation = true;
    chart1.startEffect = "elastic";
    chart1.innerRadius = "30%";
    chart1.startDuration = 2;
    chart1.colors = colorList;
    
    
    chart1.labelRadius = 10;
    chart1.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
  
    // this makes the chart 3D
                chart1.depth3D = 10;
                chart1.angle = 30;
    // LEGEND
    legend = new AmCharts.AmLegend();
    legend.position = "right";
    legend.markerType = "circle";
    legend.marginRight = 80;
    legend.autoMargins = false;
    chart1.addLegend(legend);
    //Write
    chart1.write("chartdiv");
    // PIE CHART 2
    var chart3 = new AmCharts.AmPieChart();
    chart3.dataProvider = chart2Data;
    chart3.titleField = "Sector";
    chart3.valueField = "Total";
    chart3.sequencedAnimation = true;
    chart3.startEffect = "elastic";
    chart3.innerRadius = "30%";
    chart3.startDuration = 2;
    chart3.labelRadius = 10;
    chart3.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
    // this makes the chart 3D
                chart3.depth3D = 10;
                chart3.angle = 30;
    //Write
    chart3.write("chartdiv2");
});
            
</script>
<div class="row header">
  <div class="col-md-6"> <img src="img/Logo2small.png" /> </div>
  <div class="col-md-6 col-lg-6 col-sm-6">
    <div class="clearfix pull-right"><a href="?page=home" class="btn btn-primary btn-sm "><i class="glyphicon glyphicon-home"></i> Home</a> <a href="?page=accounts" class="btn btn-default btn-sm "><i class="glyphicon glyphicon-euro"></i> Accounts</a> <a href="?page=change-password" class="btn btn-warning btn-sm "><i class="glyphicon glyphicon-lock"></i> Change Password</a> <a href="?page=change-email" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-envelope"></i> Change Email</a> <a href="?page=logout" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-off"></i> Logout</a> </div>
  </div>
</div>
<div class="row"> 
  
  <!-- Nav tabs -->
  
  <ul class="nav nav-tabs">
    <li class="active"><a href="#portfolio" data-toggle="tab">Portfolio</a></li>
    <li><a href="#dm" data-toggle="tab">Diversity Model</a></li>
    <li><a href="#pv" data-toggle="tab">Portfolio  Variance</a></li>
  </ul>
  
  <!-- Tab panes -->
  
  <div class="tab-content">
    <div class="tab-pane active" id="portfolio">
      <div class="row">
        <div class="col-md-12 jumbotron">
          <h3>Your Available Balance is: <?php echo number_format($balance,2);?> TK</h3>
        </div>
        <div class="col-md-8" style="overflow-x:scroll">
          <h5>Your current Portfolio:</h5>
          <table class="table table-responsive table-bordered table-condensed" id="myTable">
            <thead>
              <tr>
                <th>Company Code</th>
                <th>Last Trade Price</th>
                <th>Change%</th>
                <th>No of Stocks</th>
                <th>Purchase Date</th>
                <th>Purchase Price</th>
                <th>Purchase Commission</th>
                <th>Purchase Value</th>
                <th>Gain/Loss</th>
                <th>%Change</th>
                <th>Change in Value</th>
                <th>%Portfolio</th>
                <th>Sell Price
                  
                  (Excluding Commission)</th>
                <th>Sell Value</th>
                <th>Sell</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php 
$query = getPortfolio($userid,$portfolio_id);// Get portfolio of the current user		
while($info = mysql_fetch_array($query)) {
    if($info['sell_share_amount']!=$info['share_amount'] OR $info['share_amount']> $info['sell_share_amount']){
?>
                <td><?php echo $stk = $info['code'];?><br>
                  <small><?php echo $info['name'];?></small></td>
                <td><?php echo $lastTradePrice =  $info['ltp'];?></td>
                <td><?php echo $info['changes'];?></td>
                <td><?php echo $stk =($info['share_amount']);?></td>
                <td><?php $date = $info['buy_date']; echo date('jS F Y', strtotime($date));  ?></td>
                <td><?php echo  $info['buy_price'];?> TK</td>
                <td><?php echo $com =(($stk*$info['buy_price'])*.5/100); ?> TK</td>
                <td class="sum"><?php $buyprice = ($stk*$info['buy_price']); echo number_format(($buyprice+$com),2);
        $total_buy += ($buyprice+$com); 
       
        ?>
                  TK</td>
                <td><?php $sellPrice = ($info['ltp']*$stk); 
                $totalsell += $sellPrice;
            $sell_com = (($info['ltp']*$stk)*.5/100);
        echo number_format(($sellPrice-$buyprice),2);?>
                  TK</td>
                <td><?php echo $gl+= number_format(($sellPrice-$buyprice),2);?> TK</td>
                <td></td>
                <td><?php echo number_format((($buyprice+$com)/($balance+$total_buy))*100,2); ?>%</td>
                <td></td>
                <td></td>
                <td><button type ="submit" class='sell btn btn-danger btn-sm' name="sell" value='<?php echo $info['ID'].','. $info['portfolio_ID'] ?>'>Sell</button></td>
              </tr>
              <?php    $marketValue += $lastTradePrice*$stk; ?>
              <?php } }?>
              <tr class="summary success">
                <td>Total:</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?php echo number_format($total_buy,2); ?></td>
                <td><?php echo number_format($gl,2); ?></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-3 col-md-offset-1">
          <h5> Add new shares: </h5>
          <table id="example" class="table table-responsive table-striped">
            <thead>
              <tr>
                <th class="center">Ticker</th>
                <th class="center">Last Trading Price</th>
                <th class="center">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php $query = stockDetails();// List of stock purchased
while($info = mysql_fetch_array($query)) {
?>
                <td><?php echo $info['code']; ?></td>
                <td><?php echo $info['ltp']; ?></td>
                <td><button type ="submit" class='buy btn btn-success btn-sm' name="buy" value='<?php echo $info['ID'] ?>'>Add</button></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="tab-pane" id="dm">
      <h3>Investment Holding</h3>
      <div id="chartdiv" style="width: 100%; height: 400px;"></div>
      <h3>Business Segment</h3>
      <div id="chartdiv2" style="width: 100%; height: 400px;"></div>
      <h3>Portfolio Yield</h3>
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
calcCovariance($userid,$portfolio_id);
  
  
?>


 <h3>Portfolio Beta</h3>
     <?php $query = portfolioWeight($userid,$portfolio_id); 
while($info = mysql_fetch_array($query)) {
            
      $totInvestment +=$info['investment']; 
      $totWeight += ($info['investment']/$marketValue)*100;
      $coid = $info['ID'];
      $iBeta = number_format(stats_covariance(idxDev($coid),comChange($coid))/stats_variance(idxDev($coid)),4);
      $totbeta +=$iBeta;
      $totPbeta +=  ($iBeta*($info['investment']/$marketValue));
 }?>
          
        <strong><?php echo $totPbeta; ?></strong>

    </div>
    <div class="tab-pane" id="pv">
      <h3> Stock Weight</h3>
      <table class="table table-bordered">
        <thead>
        <th>Ticker</th>
          <th>Investment</th>
          <th>Weight% <small> (MARKET PRICE)</small></th>
            </thead>
        <tbody>
          <tr>
            <?php $query = portfolioWeight($userid,$portfolio_id); 
 // $totalWeight += ($info['investment']/$marketValue);
  
  
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
  </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
   //On key change 
    $.event.special.inputchange = {
        setup: function () {
            var self = this,
                val;
            $.data(this, 'timer', window.setInterval(function () {
                val = self.value;
                if ($.data(self, 'cache') != val) {
                    $.data(self, 'cache', val);
                    $(self).trigger('inputchange');
                }
            }, 20));
        },
        teardown: function () {
            window.clearInterval($.data(this, 'timer'));
        },
        add: function () {
            $.data(this, 'cache', this.value);
        }
    };
    //EOF
    //function for seprating valuefrom comma
 function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }
  //EOF
    //calculate total of total_buy_price
     var sum = 0;
$('.sum').each(function() {
    sum += parseFloat($(this).text().replace(/,/g, ''));
});
$('#gt_tbp').html(commaSeparateNumber(sum) + " TK");
    //EOF
    // initalize vex modal on click for buy
    $(".buy").click(function () {
        value = $(this).attr("value");
        $.ajax({
            type: "POST",
            url: "ajax.php?function=buy",
            data: {'id': value},
            dataType: "json",
            async: false,
            success: success
        });
        function success(data) {
            // continue your work here.
            stockname = data.code;
            ltp = data.ltp;
            lot = data.mlot;
            order_value = '';
            balance = <?php echo $balance;?>;
            
             //parseFloat(Math.round((data.ltp + (data.ltp * .5) / 100) * lot)).toFixed(2);
        }
        vex.dialog.open({
            message: 'BUY :' + '<strong>&nbsp;' + stockname + '</strong><br><center><div class="msg text-danger">&nbsp</div></center>',
            input: "<div class='row'><div class='col-md-12'><div class='equalize'><label>Your Commission rate:</label></div><input name=\"comm\" type=\"text\" id=\"comm\" placeholder=\".5\" required /> %</div><div class='col-md-12'><div class='equalize'><label>Buy Price<small> (ex-commission)</small>:</label></div><input name=\"buy_price\" type=\"text\" id=\"buy_price\" placeholder=\"Your Buy Price\" required /> TK</div><div class='col-md-12'><div class='equalize'><label>Total Purchase Power:</label></div>" + balance + " TK</div><div class='col-md-12'><div class='equalize'><label class='text-success'>Order Value:</label></div><span class='order_val text-success'>&nbsp;</span> TK</div><div class='col-md-12'><div class='equalize'><label class='text-info'> Remaining Balance:</label></div><span class='rem_bal text-info'>&nbsp;</span></div><div class='col-md-12'><div class='equalize'><label>Stock Per Lot:</label></div>" + lot + "</div><div class='col-md-12'><div class='equalize'><label>Per Lot Value (Incl commission):</label></div><span class='per_order_val'>&nbsp;</span> TK</div></div><div class='equalize'>Buy Quantity: </div><input name=\"amount\" type=\"text\" id=\"amount\" placeholder=\"No Of Shares\" required /><br/><p></p>",
            buttons: [
                $.extend({}, vex.dialog.buttons.YES, {
                    text: 'Execute Order'
                }), $.extend({}, vex.dialog.buttons.NO, {
                    text: 'Back'
                })
            ],
            callback: function (data) {
                if (data === false) {
                    return console.log('Cancelled');
                } else if (remaining_bal < 0) {
                    $('.msg').text("You Can not Exeed your Balance");
                    (data).stop();
                    return false;
                    data = false;
                    //vex.dialog.alert ('You can not exceed your balance. Please try purchase lower number of shares');
                } else if (oddlot !== 0) {
                    $('.msg').text("You can't buy odd lot");
                    (data).stop();
                    return false;
                    data = false;
                } else {
                    vex.dialog.alert('Congratulation! your order is executed');
                    //console.log('amount', data.amount);
                    //console.log(oddlot);
                    user_id = <?php echo $userid; ?>;
                    
                    portfolio_id = <?php echo $_GET['id']; ?>;
                    
                    buy_date = "<?php echo $newdate; ?>";
                    $.ajax({
                        type: "POST",
                        url: "ajax.php?function=execute",
                        data: {
                            'amount': data.amount,
                            'com_id': value,
                            'user': user_id,
                            'po_id': portfolio_id,
                            'buy_date': buy_date,
                            'buy_price': data.buy_price,
                            'order_val': order_value,
                            'com_rate' : data.comm,
                            'balance'  : remaining_bal
                        },
                        dataType: "json",
                        async: true,
                        success: function (s, x) {
                            $(this).html(s);
                        },
                        complete: function () {
                            //vex.dialog.alert ('You Have Successfully Joined This Contest. Best of Luck!!');
                            //location.reload();
                        }
                    });
                }
                //console.log('amount', data.amount)
                ;
            }
        });
        // amount inout box on change calculation
        $('#amount').on('inputchange', function () {
            order_value = (((per_lot_value)* ($("#amount").val()) / lot));
            $('.order_val').text(order_value);
            remaining_bal = (balance - order_value);
            $('.rem_bal').text(remaining_bal);
            //
            per_lot_value = (($("#buy_price").val()*lot)+(($("#buy_price").val()*lot)*($('#comm').val())/100));
            $('.per_order_val').text(per_lot_value);
            //
            amount = $("#amount").val();
            remainder = (amount / lot);
            divisiable = (remainder % 100);
            oddlot = (divisiable % 1);
           
            //
        }); //
        //buy price input on change
        $('#buy_price').on('inputchange', function () {
            per_lot_value = (($("#buy_price").val()*lot)+(($("#buy_price").val()*lot)*($('#comm').val())/100));
            $('.per_order_val').text(per_lot_value);
        });  // EOF
        $('.msg').each(function () {
            var elem = $(this);
            setInterval(function () {
                if (elem.css('visibility') == 'hidden') {
                    elem.css('visibility', 'visible');
                } else {
                    elem.css('visibility', 'hidden');
                }
            }, 3000);
        });
    });
// Vex modal for sell
$(".sell").click(function () {
    value = $(this).attr("value");
    user_id = <?php echo $userid; ?>;
    portfolio_id = <?php echo $_GET['id']; ?>;
        $.ajax({
            type: "POST",
            url: "ajax.php?function=sell",
            data: {'cid': value, 'uid': user_id, 'con_id': portfolio_id},
            dataType: "json",
            async: false,
            success: success
        });
        function success(data) {
            // continue your work here.
            stockname = data.code;
            ltp = data.ltp;
            lot = data.mlot;
            per_lot_value = data.lot_val;
            pid = data.pid;
            share_amount = data.shares;
             //parseFloat(Math.round((data.ltp + (data.ltp * .5) / 100) * lot)).toFixed(2);
        }
    vex.dialog.open({
                            
            message: 'SELL :' + '<strong>&nbsp;' + stockname + '</strong><br><center><div class="msg text-danger">&nbsp</div></center>',
                            input: "<div class='row'><div class='col-md-12'><div class='equalize'><label>Sell Price:</label></div>" + ltp + " TK</div><div class='col-md-12'><div class='equalize'><label>Stocks Per Lot:</label></div>" + lot + " TK</div><div class='col-md-12'><div class='equalize'><label>Per Lot Value:</label></div>"+ per_lot_value +"TK</div><div class='col-md-12'><div class='equalize'><label> Stocks In Your Portfolio:</label></div>"+share_amount +"</div></div><div class='equalize'>Sell Quantity: </div><input name=\"amount\" type=\"text\" id=\"amount\" placeholder=\"No Of Shares\" required /><br/><p></p>",
                            buttons: [
                                $.extend({}, vex.dialog.buttons.YES, { text: 'Execute' }),
                                $.extend({}, vex.dialog.buttons.NO, { text: 'Calcel' })
                            ],
                            callback: function (data) {
                                if (data === false) {
                                        return console.log('Cancelled');
                                }else if (oddlot !== 0) {
                    $('.msg').text("You can't sell odd lot");
                    (data).stop();
                    return false;
                    data = false;
                } else if(data.amount> share_amount) {
                    
                    $('.msg').text("You can't sell more than that you own");
                    (data).stop();
                    return false;
                    data = false;
                } else {
                    
                    //console.log('amount', data.amount);
                    //console.log(oddlot);
                    user_id = <?php echo $userid; ?>;
                    
                    portfolio_id = <?php echo $_GET['id']; ?>;
                    
                    sell_date = "<?php echo $newdate; ?>";
                    $.ajax({
                        type: "POST",
                        url: "ajax.php?function=sellexecute",
                        data: {
                            'amount': data.amount,
                            'com_id': value,
                            'user': user_id,
                            'con_id': portfolio_id,
                            'sell_date': sell_date,
                            'sell_price': ltp,
                            'pid': pid,
                        },
                        dataType: "json",
                        async: true,
                        success: function (s, x) {
                            $(this).html(s);
                        },
                        complete: function () {
                            //vex.dialog.alert ('You Have Successfully Joined This Contest. Best of Luck!!');
                            //location.reload();
                            vex.dialog.alert('Congratulation! your order is executed');
                            location.reload();
                        }
                    });
                }
                            
                            }
                        });
        $('#amount').on('inputchange', function () {
            amount = $("#amount").val();
            remainder = (amount / lot);
            divisiable = (remainder % 100);
            oddlot = (divisiable % 1);
        });
                        
})
});
</script>
<?php include("footer.php");  ?>
