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
<script>
$(document).ready(function() {
         $("#sidemenu").mmenu({
            offCanvas: {
               position  : "right",
               zposition : "front"
            }
         });
      });      
</script>
<a class="btn btn-add" href="#sidemenu">
<h3>+</h3>
</a>
<div id="sidemenu" class="dark add-panel">
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
      <li class="active"><a href="#"><i class="glyphicon glyphicon-briefcase"></i>&nbsp;Portfolio</a></li>
      <li><a href="?page=research&id=<?php echo $portfolio_id; ?>"><i class="glyphicon glyphicon-random"></i>&nbsp;Research</a></li>
      <li><a href="?page=allocation&id=<?php echo $portfolio_id; ?>"><i class="glyphicon glyphicon-align-justify"></i>&nbsp;Allocation</a></li>
      <li><a href="?page=company&id=<?php echo $portfolio_id; ?>"><i class="glyphicon glyphicon-file"></i>&nbsp;Company Details</a></li>
      <li><a href="?page=accounts&id=<?php echo $portfolio_id; ?>"><i class="glyphicon glyphicon-file"></i>&nbsp;Accounts</a></li>
      <li><a href="#"><i class="glyphicon glyphicon-certificate"></i>&nbsp;Statements</a></li>
      <li class="pull-right"><a href="#"><i class="glyphicon glyphicon-flag"></i>&nbsp;Alert</a></li>
    </ul>
  </div>
  <div class="col-md-12 m-t-md">
    <div class="table-responsive">
      <h4>Your Available Balance is: <?php echo number_format($balance,2);?> TK</h4>
      <h5>Your current Portfolio: <?php echo $_GET['name']; ?> </h5>
      <table class="table table-striped table-portfolio" id="myTable">
        <thead>
          <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Change%</th>
            <th>Holding</th>
            <th>P.Date</th>
            <th>P.Price</th>
            <th>P.Commission</th>
            <th>P.Value<small>&nbsp;(incl com)</small></th>
            <th>Gain/Loss</th>
            <th>%Portfolio</th>
            <th>S.Value<small>&nbsp;(excl com)</small></th>
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
            <td><a href="http://bing.com" target="_blank" class="livepreview"><?php echo $info['code'];?></a></td>
            <td><?php echo $lastTradePrice =  $info['ltp'];?></td>
            <?php if($info['changes']>0){?>
            <td class="text-success">+<?php echo $info['changes'];?></td>
            <?php } else {?>
            <td class="text-danger"><?php echo $info['changes'];?></td>
            <?php };?>
            <td><?php echo $stk =($info['share_amount'] - $info['sell_share_amount']);?></td>
            <td><?php $date = $info['buy_date']; echo date('jS F Y', strtotime($date));  ?></td>
            <td><?php echo  $info['buy_price'];?></td>
            <td><?php echo $com =(($stk*$info['buy_price'])*.5/100); ?></td>
            <td class="sum"><?php $buyprice = ($stk*$info['buy_price']); echo number_format(($buyprice+$com),2);
                          $total_buy += ($buyprice+$com);?></td>
            <td class="colorize"><?php $sellPrice = ($info['ltp']*$stk); 
                          $totalsell += $sellPrice;
                          $sell_com = (($info['ltp']*$stk)*.5/100);
                          $gl += ($sellPrice-$buyprice);
                          echo number_format(($sellPrice-$buyprice),2);
                          $sellValue +=($lastTradePrice*$stk);?>
              TK</td>
            <td><?php echo number_format((($buyprice+$com)/($balance+$total_buy))*100,2); ?>%</td>
            <td><?php echo number_format(($lastTradePrice*$stk),2); ?></td>
            <td><button type ="submit" class='sell btn btn-danger btn-sm' name="sell" value='<?php echo $info['ID'].','. $info['portfolio_ID'] ?>'>Sell</button></td>
          </tr>
          <?php    $marketValue += $lastTradePrice*$stk; ?>
          <?php } }?>
        </tbody>
      </table><br/>
       <h4 class="m-t-md">Totals</h4>
    <table class="portfolio-totals table text-center">
				<thead><tr>
					<th class="first">Asset Cost</th>
					<th>Asset value</th>
					<th>Net cash</th>
					<th>% change</th>
					<th>Profit / loss</th>
					<th>Total value</th>
				</tr>
                </thead>
				<tbody><tr>
					<td class="first"><?php echo number_format($total_buy,2); ?></td>
					<td class="change-down"><?php echo number_format($sellValue,2);?></td>
					<td> <?php echo number_format($balance,2);?></td>
					<td class="colorize"><?php echo number_format((($sellValue - $total_buy )/$total_buy),2); ?></td>
					<td class="change-down colorize"><?php echo number_format($gl,2); ?></td>
					<td><?php echo number_format(($balance+$gl+$total_buy),2); ?> </td>
				</tr>
			</tbody></table>
    </div>
  </div>
    
   
<script type="text/javascript">
$(document).ready(function () {
//colorize
  $("td.colorize:contains('-')").addClass('red');
  $("td.colorize:contains('+')").addClass('green');
  $(".colorize").each(function() {
  var text = $(this).text();
  if (/[+-]?\d+(\.\d+)?/.test(text)) {
    var num = parseFloat(text);
    if (num < 0) {
      $(this).addClass("red");
    } else if (num > 0) {
      $(this).addClass("green");
    }
  }
});
//
 var cost = $(".first").text();
 
 var sellp = $(".change-down").text();
 
 if(sellp < cost) {
	
	$(".change-down").addClass('text-danger');
	 
 }
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
                            'prof_id': portfolio_id,
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
                            //location.reload();
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
