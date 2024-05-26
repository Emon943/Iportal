<?php include("header.php");
$username = $auth->getUsername($_COOKIE['auth_session']);
$user = $auth->getUserData($username);
$userid = $user['uid'];
?>
<style type="text/css">#page-wrap                      { width: 500px; margin: 30px auto; position: relative; }
#chat-wrap                      { border: 1px solid #000; margin: 0 0 15px 0; }
#chat-area                      { height: 300px; overflow: auto; border: 1px solid #666; padding: 20px; background: black; }
#chat-area span                 { color: white; background: #333; padding: 4px 8px; -moz-border-radius: 5px; -webkit-border-radius: 8px; margin: 0 5px 0 0; }
#chat-area p                    { padding: 8px 0; border-bottom: 1px solid #000; }
#name-area                      { position: absolute; top: 12px; right: 0; color: white; font: bold 12px "Lucida Grande", Sans-Serif; text-align: right; }   
#name-area span                 { color: #fa9f00; }
#send-message-area p            { float: left; color: #999; padding-top: 27px; font-size: 14px; }
#sendie                         { border: 3px solid #999; width: 360px; padding: 10px; font: 12px "Lucida Grande", Sans-Serif; float: right; }</style>
<script type="text/javascript">
    
        // ask user for name with popup prompt    
        var name = "<?php echo $username; ?>";
        
        // default name is 'Guest'
        if (!name || name === ' ') {
           name = "Guest";  
        }
        
        // strip tags
        name = name.replace(/(<([^>]+)>)/ig,"");
        
        // display name on page
        $("#name-area").html("You are: <span>" + name + "</span>");
        
        // kick off chat
        var chat =  new Chat();
        $(function() {
        
             chat.getState(); 
             
             // watch textarea for key presses
             $("#sendie").keydown(function(event) {  
             
                 var key = event.which;  
           
                 //all keys including return.  
                 if (key >= 33) {
                   
                     var maxLength = $(this).attr("maxlength");  
                     var length = this.value.length;  
                     
                     // don't allow new content if length is maxed out
                     if (length >= maxLength) {  
                         event.preventDefault();  
                     }  
                  }  
                                                                                                                                                                                                            });
             // watch textarea for release of key press
             $('#sendie').keyup(function(e) {   
                                 
                  if (e.keyCode == 13) { 
                  
                    var text = $(this).val();
                    var maxLength = $(this).attr("maxlength");  
                    var length = text.length; 
                     
                    // send 
                    if (length <= maxLength + 1) { 
                     
                        chat.send(text, name);  
                        $(this).val("");
                        
                    } else {
                    
                        $(this).val(text.substring(0, maxLength));
                        
                    }   
                    
                    
                  }
             });
            
        });
    </script>
<?php
date_default_timezone_set('Asia/Dhaka');
$newdate = date('Y-m-d', time());
$contest_id = $_GET['cid'];
$_SESSION['contest_id'] = $contest_id;
echo $time = date('H:i:s');
$query = checkBalance($userid,$contest_id);
while($info = mysql_fetch_array($query)) {
    $balance = $info['avail_amount'];
}
?>
<!--<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script> -->
<script src="js/vex.combined.min.js"></script>
<script>vex.defaultOptions.className = 'vex-theme-os';</script>
<link rel="stylesheet" href="css/vex.css" />
<link rel="stylesheet" href="css/vex-theme-os.css" />
<script type="text/javascript" src="js/jquery.sumtr.js"></script>
<div class="row header">
  <div class="col-md-6"> <img src="img/Logo2small.png" /> </div>
  <div class="col-md-6 col-lg-6 col-sm-6">
    <div class="clearfix pull-right"><a href="?page=home" class="btn btn-primary btn-sm "><i class="glyphicon glyphicon-home"></i> Home</a> <a href="?page=accounts" class="btn btn-default btn-sm "><i class="glyphicon glyphicon-euro"></i> Accounts</a> <a href="?page=change-password" class="btn btn-warning btn-sm "><i class="glyphicon glyphicon-lock"></i> Change Password</a> <a href="?page=change-email" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-envelope"></i> Change Email</a> <a href="?page=logout" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-off"></i> Logout</a> </div>
  </div>
</div>
<div class="row">
    
<div class="col-md-12 jumbotron">
<h3>Your Available Balance is:  <?php echo number_format($balance,2);?> TK</h3>
</div></div>

<div class="row">
<div class="col-md-8">
<h5>Your current Portfolio:</h5>
  <table class="table table-responsive table-bordered table-condensed" id="myTable">
    <thead>
      <tr>
        <th>Ticker</th>
        <th>LTP</th>
        <th>Change%</th>
        <th>Total Shares</th>
        <th>Buy Date</th>
        <th>Buy Price</th>
        <th>Buy Comm</th>
        <th>Total Buy Price</th>
        <th>Portfolio Market Value TK</th>
        <th>TK Gain/ Loss Total(Unrealized & Excl Comm)</th>
        <th>Portfolio Weight %</th>
        <th>Gain/loss %</th>
        <th>Sell</th>
      </tr>
    </thead>
    <tbody>
      <tr>
<?php 
$query = getPortfolio($userid,$contest_id);// Get portfolio of the current user		
while($info = mysql_fetch_array($query)) {
    if($info['sell_share_amount']!=$info['share_amount'] OR $info['share_amount']> $info['sell_share_amount']){
?>
        <td><?php echo $stk = $info['code'];?><br>
          <small><?php echo $info['name'];?></small></td>
        <td><?php echo $info['ltp'];?></td>
        <td><?php echo $info['changes'];?></td>
        <td><?php echo $stk =($info['share_amount'] - $info['sell_share_amount']);?></td>
        <td><?php $date = $info['buy_date']; echo date('jS F Y', strtotime($date));  ?></td>
        <td><?php echo $info['buy_price'];?> TK</td>
        <td><?php echo $com =(($stk*$info['buy_price'])*.5/100); ?> TK</td>
        <td class="sum"><?php $buyprice = ($stk*$info['buy_price']); echo number_format(($buyprice+$com),2);
        $total_buy += ($buyprice+$com); 
        ?> TK</td>
        
        <td><?php $sellPrice = ($info['ltp']*$stk); 
                $totalsell += $sellPrice;
            $sell_com = (($info['ltp']*$stk)*.5/100);
        echo number_format($sellPrice,2);?> TK</td>
        <td><?php echo number_format(($sellPrice-$buyprice),2);?> TK</td>
        <td><?php echo number_format($info['weight'],2);?>%</td>
        <td><?php echo $info['buy_change_percentage'];?></td>
        <?php  if(maturity($date,$newdate) > 3){
                if($time >'10:30:00' && $time < '14:30:00') {
        ?>
        <td><button type ="submit" class='sell btn btn-danger btn-sm' name="sell" value='<?php echo $info['ID'].','. $info['portfolio_ID'] ?>'>Sell</button></td>
        <?php } else{ echo "<td><small>You can sell at Trading hour </small>.</td>"; } } else{ echo "<td><small>You can sell after maturity </small>.</td>"; }?>
      </tr>
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
        <td><?php echo number_format($totalsell,2); ?></td>
        <td></td>
        
      </tr>
      <tr>
        <td>Portfolio Growth</td>
        <td><?php echo ((($totalsell+$balance)/100000)-1)*100 ."%"; ?>
    </tbody>
  </table>
</div>
<div class="col-md-4">
<h5> Buy new shares: </h5>
  <table id="example" class="table table-responsive table-striped">
    <thead>
      <tr>
        <th class="center">Ticker</th>
        <th class="center">LTP</th>
        <th class="center">YCP</th>
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
        <td><?php echo $info['ycp']; ?></td>
        <?php if($time >'10:30:00' && $time < '14:30:00') {?>
        <td><button type ="submit" class='buy btn btn-success btn-sm' name="buy" value='<?php echo $info['ID'] ?>'>Buy</button></td>
        <?php } else {?>
        <td>Buy at Trading Hour</td>
        <?php } ?>
      </tr>
      <?php } ?>
    </tbody>
  </table>

</div>
</div>
<div class="row">
<div class="col-md-6 chatbox">
<div id="page-wrap">
    
        <h2>Contest Chat</h2>
        
        <p id="name-area"></p>
        
        <div id="chat-wrap"><div id="chat-area"></div></div>
        
        <form id="send-message-area">
            <p>Your message: </p>
            <textarea id="sendie" maxlength = '100' ></textarea>
        </form>
    
    </div>
    </div></div>
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
            per_lot_value = data.lot_val; //parseFloat(Math.round((data.ltp + (data.ltp * .5) / 100) * lot)).toFixed(2);
        }
        vex.dialog.open({
            message: 'BUY :' + '<strong>&nbsp;' + stockname + '</strong><br><center><div class="msg text-danger">&nbsp</div></center>',
            input: "<div class='row'><div class='col-md-12'><div class='equalize'><label>Buy Price:</label></div>" + ltp + " TK</div><div class='col-md-12'><div class='equalize'><label>Total Purchase Power:</label></div>" + balance + " TK</div><div class='col-md-12'><div class='equalize'><label class='text-success'>Order Value:</label></div><span class='order_val text-success'>&nbsp;</span> TK</div><div class='col-md-12'><div class='equalize'><label class='text-danger'> Remaining Balance:</label></div><span class='rem_bal text-danger'>&nbsp;</span></div><div class='col-md-12'><div class='equalize'><label>Stock Per Lot:</label></div>" + lot + "</div><div class='col-md-12'><div class='equalize'><label>Per Lot Value (Incl commission):</label></div>" + per_lot_value + "</div></div><div class='equalize'>Buy Quantity: </div><input name=\"amount\" type=\"text\" id=\"amount\" placeholder=\"No Of Shares\" required /><br/><p></p>",
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
                    
                    contest_id = <?php echo $_GET['cid']; ?>;
                    
                    buy_date = "<?php echo $newdate; ?>";
                    $.ajax({
                        type: "POST",
                        url: "ajax.php?function=execute",
                        data: {
                            'amount': data.amount,
                            'com_id': value,
                            'user': user_id,
                            'con_id': contest_id,
                            'buy_date': buy_date,
                            'buy_price': ltp,
                            'order_val': order_value
                        },
                        dataType: "json",
                        async: true,
                        success: function (s, x) {
                            $(this).html(s);
                        },
                        complete: function () {
                            //vex.dialog.alert ('You Have Successfully Joined This Contest. Best of Luck!!');
                            location.reload();
                        }
                    });
                }
                //console.log('amount', data.amount)
                ;
            }
        });
        //
        $('#amount').on('inputchange', function () {
            order_value = ((per_lot_value * ($("#amount").val()) / lot));
            $('.order_val').text(order_value);
            remaining_bal = (balance - order_value);
            $('.rem_bal').text(remaining_bal);
            //
            //
            amount = $("#amount").val();
            remainder = (amount / lot);
            divisiable = (remainder % 100);
            oddlot = (divisiable % 1);
            //
        }); //
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
    contest_id = <?php echo $_GET['cid']; ?>;
        $.ajax({
            type: "POST",
            url: "ajax.php?function=sell",
            data: {'cid': value, 'uid': user_id, 'con_id': contest_id},
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
                    
                    contest_id = <?php echo $_GET['cid']; ?>;
                    
                    sell_date = "<?php echo $newdate; ?>";
                    $.ajax({
                        type: "POST",
                        url: "ajax.php?function=sellexecute",
                        data: {
                            'amount': data.amount,
                            'com_id': value,
                            'user': user_id,
                            'con_id': contest_id,
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
