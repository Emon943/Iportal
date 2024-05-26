<?php include("header.php");
$username = $auth->getUsername($_COOKIE['auth_session']);
$user = $auth->getUserData($username);
$userid = $user['uid'];
$newdate = date('Y-m-d', time());
$portfolio_id = $_GET['pid'];
$query = checkBalance($userid,$portfolio_id);
while($info = mysql_fetch_array($query)) {
    $balance 	= $info['portfolio_amount'];
    $comission  = $info['comission_rate'];
}
?>
<link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css">
<div class="row header">
  <div class="col-md-6"> <img src="img/Logo2small.png" /> </div>
  <div class="col-md-6 col-lg-6 col-sm-6">
    <div class="clearfix pull-right"><a href="?page=home" class="btn btn-primary btn-sm "><i class="glyphicon glyphicon-home"></i> Home</a> <a href="?page=accounts&id=<?php echo $portfolio_id ?>" class="btn btn-default btn-sm "><i class="glyphicon glyphicon-euro"></i> Accounts</a> <a href="?page=change-password" class="btn btn-warning btn-sm "><i class="glyphicon glyphicon-lock"></i> Change Password</a> <a href="?page=change-email" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-envelope"></i> Change Email</a> <a href="?page=logout" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-off"></i> Logout</a> </div>
  </div>
</div>
<div class="row"> 
  
  <!-- Nav tabs -->
  
  <ul class="nav nav-tabs">
    <li class="active"><a href="#portfolio" data-toggle="tab">Order</a></li>
    <li><a href="#dm" data-toggle="tab">Tab 2</a></li>
    <li><a href="#pv" data-toggle="tab">Tab 3</a></li>
  </ul>
   <!-- Tab panes -->
  
  <div class="tab-content">
    <div class="tab-pane active" id="portfolio">
      <div class="row">
        <div class="col-md-12 jumbotron">
          <h3>Your Available Balance is: <?php echo number_format($balance,2);?> TK</h3>
        </div>
        <div class="col-md-8 jumbotron">
          <!-- <form role="form" method="POST" action="#"> -->
            <?php $data= (companyDetails($_GET['company_id']));?>
            <div class="table-responsive">
  <table class="table">
   <tr><td>Ticker:</td><td><strong><?php echo $data['code']; ?></strong></td><td>Market Lot:</td><td><?php echo $data['mlot']; ?></tr>
   
   <tr><td>Current Price:</td><td><?php echo $data['ltp']; ?></td><td>Per Lot Value<br><small>including commission</small></td><td><?php echo $data['lot_val'];?></td> </tr>
  
            <tr><td>Order Type</td><td>
            <select class="form-control ot" id="ot" name="order_type">

                <option value="4">Market order</option>
                <option value="1">GTC</option>
                <option value="2">GFD</option>
                <option value="3">GTD</option>

                
                
            </select></td>
    <td>Buy Price</td><td><input type="text" id="buy_price" disabled="disabled"  name="buy_price" value="<?php echo $data['ltp'];?>" ></td></tr>
    <tr><td>Volume:</td><td><input type="text" name="vol" id="amount" class="vol" ></td>
      <td>Expiry Date</td>
      <td><div class='input-group date' id='expiry_date' data-date-format="YYYY-MM-DD">
        <input type='text' class="form-control" disabled="disabled" id="exp" name="expiry_date" />
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    
                </div></td></tr>
      <tr><td>Order Value:</td><td><span class='order_val text-success' id="order_val">&nbsp</span></td>
        <td>Remaining Balance:</td><td><span class="rem_bal">&nbsp</span></td> </tr>

        <tr><td><button  name="buy_execute" id="buy_execute" class="buy btn btn-success btn-sm">Buy</button></td></td>
          <!-- </form> -->
</table>
<small>*A GTC order is the order that remains in the system for a period not exceeding one calendar week or the member cancels it.</small><br><br>
<small>*A GFD is the order, which is valid for the day on which it is entered. If the order is not matched during the day, the order gets cancelled automatically at the end of the trading day</small><br><br>
<small>*A GTD order allows the member to specify the number of days not exceeding one calendar week for which the order shall stay in the stay in the system. At the end of this period the order shall be deleted from the system</small><br><br>
<small>*Market Order is an order to buy or sell a certain quantity of particular security at the best price or prices prevailing in the market at that point of time</small><br>
</div>
        </div>
      </div>
    </div><!-- tab 1 close  -->
  </div>
<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  $(".ot").change(function () {// order type change
    if (this.value == '4') {//if market order then disable price 
      var ltp = <?php echo $data['ltp'];?>;
      
      $('#buy_price').val(ltp);
      $('#buy_price').attr('disabled', 'disabled');
      $('#exp').attr('disabled', 'disabled');
    } else {
      $('#buy_price').removeAttr('disabled');
      $('#exp').removeAttr('disabled');

    }
  });// eof order type
  $(function () {
                $('#expiry_date').datetimepicker({
                    pickTime: false,
                    daysOfWeekDisabled:[5,6],
                    //maxDate :"+5",
                });
                
            });//eof datetime




  // amount inout box on change calculation
    $('#amount').on('input', function () {
      var lot = <?php echo $data['mlot']; ?>;
      var balance = <?php echo $balance; ?>;
          per_lot_value = (($("#buy_price").val()*lot)+(($("#buy_price").val()*lot)*.5/100));
            order_value = (((per_lot_value)* ($("#amount").val()) / lot));
            $('.order_val').text(order_value);

            var ov = order_value;
            remaining_bal = (balance - order_value);
            $('.rem_bal').text(remaining_bal);
            //
           
            //$('.per_order_val').text(per_lot_value);
            //
            amount = $("#amount").val();
            remainder = (amount / lot);
            divisiable = (remainder % 100);
            oddlot = (divisiable % 1);
          
    }); //


    $("#buy_execute").click(function () {

      if(remaining_bal < 0 ){

        alert("You Can not Exeed your Balance");

        return false;

      } else if(oddlot !== 0) {

        alert("You can't buy odd lot")

        return false;

      } else if($('.ot').val()==4) {


   


   $.ajax({
      'url': 'ajax.php?function=execute', 
      'type': 'POST',
      'data': {
               'po_id'     :<?php echo $portfolio_id; ?>,
               'user'      :<?php echo $userid; ?>,
               'amount'    :amount,
               'buy_date'  :"<?php echo $newdate; ?>",
               'com_id'    :<?php echo  $_GET['company_id']; ?>,
               'buy_price' :$('#buy_price').val(),
               'order_val' :$('#order_val').text(),
               'balance'   :remaining_bal,

}, 
      'dataType': 'json',    
      'success': function (data) {
                    
                    if(data.status=='success'){

                      alert("Order Executed");

                      window.location.href = "http://capm.smartsolutionpro.us/iportal/market/trading/?page=portfolioDetails&id=<?php echo $portfolio_id; ?>"
                    }

        }
   });

 }else {

  $.ajax({
      'url': 'ajax.php?function=stay', 
      'type': 'POST',
      'data': {
               'po_id'         :<?php echo $portfolio_id; ?>,
               'user'          :<?php echo $userid; ?>,
               'amount'        :amount,
               'buy_date'      :"<?php echo $newdate; ?>",
               'com_id'        :<?php echo  $_GET['company_id']; ?>,
               'buy_price'     :$('#buy_price').val(),
               'order_val'     :$('#order_val').text(),
               'expiry_date'   :$('#exp').val(),
               'order_type'    :$('.ot').val(),
               

}, 
      'dataType': 'json',    
      'success': function (data) {
                    
                    if(data.status=='success'){

                      alert("Order Executed");

                      window.location.href = "http://capm.smartsolutionpro.us/iportal/market/trading/?page=portfolioDetails&id=<?php echo $portfolio_id; ?>"
                    }

        }
   });
 }//other else


  });//eof buy
  
}); // masterEOF
</script>