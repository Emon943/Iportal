<?php include("header.php"); ?>
<div class="container">


<?php $query = companyDropDown(); ?>

<form name="company" action="#">
<select name ="company_id" id="company_id">
<?php while($info = mysql_fetch_array($query)) {?>
<option value="<?php echo $info['cid']; ?>"><?php echo $info['code']; ?></option>
<?php }?>
</select>
</form>
<div id="demo"></div>
<div class="table-responsive">

<table class="table" id="buyshare">
	<tbody>         			
<tr><td>Buy Amount:</td>
<td><input type="text" name="share_amount" id="amount"></td></tr>

</tbody></table>

<script type="text/javascript">

$(document).ready(function() {
$('#company_id').on('change', function() {
 	id = $(this).val();
  	//alert(id); // or $(this).val()
$.ajax({

    type: "POST",
    url: "./ajax.php?function=com",
    data: {'id' : id},
    dataType: "json",
    async: true,
    success:  function (data) {

        marketlot = (data.mlot);
             
             $('#demo').html('<table class="table"><tr><th>TICKER</th><td>' + data.code + '</td></tr><tr><th>Name</th><td>' + data.name + '</td></tr><tr><th>CATEGORY</th><td>' +data.cat + '</td></tr><tr><th>MARKET LOT</th><td>' + data.mlot + '</td></tr><tr><th>Last Traded Price (DSE)</th><td>' + data.ltp +'</td></tr><tr><th>Account Balance</th><td>' + data.balance +'</td></tr><table');
       
         
            }
});


});

$('#amount').on('change', function() {
    amount = $(this).val();

    remainder = (amount/marketlot);

    divisiable = (remainder % 100);

    oddlot = (divisiable % 1);

if(oddlot !==0) {

    alert("You can't buy odd lot");
}

    


    //alert(marketlot); // or $(this).val()
});
});

</script>
<?php include("footer.php"); ?>