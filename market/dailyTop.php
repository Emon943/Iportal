<?php //include_once("cache.php"); ?>
<?php include_once("header.php"); ?>
<?php $page = "dailyTop"; ?>
<?php include_once("navigation.php"); ?>
<?php include_once("db.php");?>
<div class="col-md-9">
  <div class="row">
    <div class="col-md-12">
      
    </div>
    <div class="col-md-12 placeholder">
      <h4>Guide</h4>
      <p>Cras risus ipsum, posuere non vulputate sed, convallis non sapien. Nunc ligula dolor, dapibus eu commodo non, lacinia malesuada risus. Integer pharetra suscipit metus ut euismod. Donec ac viverra lacus. Cras egestas orci nec nisl lacinia, at ullamcorper dolor vulputate. Maecenas id nibh non elit tempor commodo. Curabitur consectetur molestie magna eget luctus. Nunc auctor odio sed lacus ornare bibendum. Curabitur at elit erat. Etiam rhoncus turpis sed pretium sodales. </p>
    </div>
  </div>
  
    
 <div class="row">
 	Select Top Ten Gainers By:
 		<form id="topBottom" method="GET" class="form-horizontal" role="form" action='dailyTop.php'>
 			<select name='orderBY' onChange="this.form.submit()">
 				   <option value="">-</option>
 					<option value="priceDesc">Price</option>
 					<option value="volumeDesc">Volume</option>
 					<option value="turnoverDesc">Turnover</option>
 					<option value="turnoverGrowthDesc">Turnover Growth</option>
 					<option value ="marketcapDesc">Market Capital</option>
 					
			</select>
 		</form><br>
        <div class="col-md-12">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-responsive table-stripe" id="daily_top">
	<thead>
		<tr class="success">
         	<th>Symbol</th>
			<th>Price Change%</th>
			<th>Volume</th>
			<th>Turnover</th>
			<th>Trade</th>
			<th>Turnover Growth</th>
			<th>Market CAP</th>
            <th>EPS</th>
            <th>P/E</th>
            
		</tr>
	</thead>
	<tbody>
		<tr><?php
		$order = $_GET['orderBY'];
		if($order == 'priceDesc') {
			$orderw = 'changes';
		
			$query = tableForGainer($orderway = $orderw);// mysql query to get top ten companies of the day by price
		
		}elseif($order == 'volumeDesc'){
			$orderw = 'volume';
		
			$query = tableForGainer($orderway = $orderw);// mysql query to get top ten companies of the day by Volume
		
		}elseif($order == 'turnoverDesc'){
			$orderw = 'turnover';
		
			$query = tableForGainer($orderway = $orderw);// mysql query to get top ten companies of the day by Volume
		}elseif($order == 'turnoverGrowthDesc'){
			$orderw = 'turnover_growth';
		
			$query = tableForGainer($orderway = $orderw);// mysql query to get top ten companies of the day by Volume
		}elseif($order == 'marketcapDesc'){
			$orderw = 'mcap';
		
			$query = tableForGainer($orderway = $orderw);// mysql query to get top ten companies of the day by Volume
		}else{
			$orderw = 'changes';
		
			$query = tableForGainer($orderway = $orderw);// mysql query to get top ten companies of the day by Volume
		}
	while($info = mysql_fetch_array($query)) {?>
    
    
			<td><?php echo $info['code']; ?></td>
			<td><?php echo $info['changes'];?> </td>
			<td><?php echo $info['volume']; ?></td>
			<td><?php echo number_format($info['turnover']); ?></td>
			<td><?php echo number_format($info['trade']); ?></td>
			<td><?php echo number_format($info['turnover_growth'],2); ?></td>
            <td><?php echo number_format($info['mcap'],2);?> </td>
            <td><?php echo $info['eps'];?> </td>
            <td><?php echo $info['pe'];?> </td>
            
		</tr>
<?php } ?>
		
	</tbody>
	<tfoot>
		<tr>
        	<th>Symbol</th>
			<th>Price Change</th>
			<th>Volume</th>
			<th>Turnover</th>
			<th>Trade</th>
			<th>Turnover Growth</th>
			<th>Market CAP</th>
            <th>EPS</th>
            <th>P/E</th>
            <th>By Rank</th>
		</tr>
	</tfoot>
</table>
          
         </div>
        </div>
        
        <div class="row">
        <div class="col-md-5">
        	<!---the top tens---->
            	<div class="row">
                	<div class="col-md-12">
                    <h5><strong>Top Ten Gainer By Price</strong></h5>
                     <table cellpadding="0" cellspacing="0" border="0" class="table table-responsive" id="daily_top">
	<thead>
		<tr>
         	<th>Symbol</th>
			<th>Open(a)</th>
			<th>CP(e)</th>
			<th>Change(e-a)</th>
            <th>Start date(a)</th>
            <th>End date(e)</th>
            
		</tr>
	</thead>
	<tbody>
		<tr>
<?php 
		$query = weeklyBottom();// mysql query to get top ten companies of the day by price
		while($info = mysql_fetch_array($query)) {?> 
    
			<td><?php echo $info['code']; ?></td>
			<td><?php echo $info['open'];?> </td>
			<td><?php echo $info['close']; ?></td>
            <td><?php echo $info['changes']; ?></td>
            <td><?php echo $info['adate']; ?></td>
            <td><?php echo $info['edate']; ?></td>
        </tr>
<?php } ?>
	</tbody>
</table>
                </div>
            </div>
			<div class="row">
                	<div class="col-md-12">
                     <h5><strong>Top Ten Gainers By Volume</strong></h5>
                     <table cellspacing="0" cellpadding="0" border="0" id="daily_top" class="table table-responsive">
	<thead>
		<tr>
         	<th>Company</th>
			<th>Volume</th>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php $query = toptenByVolume();// mysql query to get top ten companies of the day by volume
 		while($info = mysql_fetch_array($query)) {?>
			<td><?php echo $info['code']; ?></td>
			<td><?php echo number_format($info['volume']);?> </td>
		</tr>
<?php } ?>
	</tbody>
</table>
                    </div>
                 </div>
                 
                 <div class="row">
                	<div class="col-md-12">
                     <h5><strong>Top Ten Gainers By Turnover </strong></h5>
                     <table cellspacing="0" cellpadding="0" border="0" id="daily_top" class="table table-responsive">
	<thead>
		<tr>
         	<th>Company</th>
			<th>Turnover</th>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php $query = toptenByTurnover();// mysql query to get top ten companies of the day by turnover
while($info = mysql_fetch_array($query)) {?>
			<td><?php echo $info['code']; ?></td>
			<td><?php echo number_format($info['turnover']);?> </td>
		</tr>
<?php } ?>
	</tbody>
</table>
                    </div>
                 </div>
                 
                 <div class="row">
                	<div class="col-md-12">
                     <h5><strong>Top Ten Gainer By Turnover Growth</strong></h5>
                     <table cellspacing="0" cellpadding="0" border="0" id="daily_top" class="table table-responsive">
	<thead>
		<tr>
         	<th>Company</th>
         	<th>Y.To</th>
			<th>T.To</th>
			<th>Change %</th>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php $query = toptenByturnoverGrowths();//Get Top Ten companies by Turnover Growth
while($info = mysql_fetch_array($query)) {?>
			<td><?php echo $info['name']; ?></td>			
			<td><?php echo number_format($info['prevday_turnover']); ?></td>
			<td><?php echo number_format($info['today_turnover']); ?></td>
			<td><?php echo number_format($info['turnover_growth'],3)*100; ?></td>
      		
		</tr>
<?php } ?>
	</tbody>
</table>
                    </div>
                 </div>
                 
                 <div class="row">
                	<div class="col-md-12">
                     <h5><strong>Highest market capital</strong></h5>
                     <table cellspacing="0" cellpadding="0" border="0" id="daily_top" class="table table-responsive">
	<thead>
		<tr>
         	<th>Company</th>
			<th>MCAP</th>
		</tr>
	</thead>
	<tbody>
		<tr><?php $query = toptenByMcap();//Get Top Ten companies by Market Capitalization
while($info = mysql_fetch_array($query)) {?>
			<td><?php echo $info['code']; ?></td>
			<td><?php echo number_format($info['mcap']); ?></td>
      		
		</tr>
<?php } ?>
		</tbody>
</table>
                    </div>
                 </div>
                 
                 <div class="row">
                	<div class="col-md-12">
                     <h5><strong>Top Ten Gainers by EPS</strong></h5>
                     <table cellpadding="0" cellspacing="0" border="0" class="table table-responsive" id="daily_top">
	<thead>
		<tr>
         	<th>Company</th>
			<th>Total EPS</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Trident</td>
			<td>4</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>5</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>5.5</td>
			
        
		</tr>
		<tr>
			<td>Trident</td>
			<td>6</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>7</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>6</td>         
		</tr>
		</tbody>
</table>
                    </div>
                 </div>
                 
                 <div class="row">
                	<div class="col-md-12">
                     <h5><strong>Top Ten Gainers by P/E Ratio</strong></h5>
                     <table cellpadding="0" cellspacing="0" border="0" class="table table-responsive" id="daily_top">
	<thead>
		<tr>
         	<th>Company</th>
			<th>P/E Ratio</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Trident</td>
			<td>4</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>5</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>5.5</td>
			
        
		</tr>
		<tr>
			<td>Trident</td>
			<td>6</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>7</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>6</td>         
		</tr>
		</tbody>
</table>
                    </div>
                 </div>
         
        </div><!---the top tens---->
      <div class="col-md-2 blue-placeholder"><p>&nbsp;</p></div>
       <div class="col-md-5">
       <!---the bottom tens---->
            	<div class="row">
                	<div class="col-md-12">
                     <h5><strong>Top Ten Loosers By Price</strong></h5>
                     <table cellpadding="0" cellspacing="0" border="0" class="table table-responsive" id="daily_top">
	<thead>
		<tr>
         	<th>Company</th>
			<th>YCP</th>
			<th>CP</th>
			<th>% Change</th>
		</tr>
	</thead>
	<tbody>
		<tr><?php 
		$query = bottomtenByPrice();// mysql query to get bottom ten companies of the day by price
		while($info = mysql_fetch_array($query)) {?> 
    
			<td><?php echo $info['code']; ?></td>
			<td><?php echo $info['ycp'];?> </td>
			<td><?php echo $info['ltp']; ?></td>
            <td><?php echo $info['changes']; ?></td>
        </tr>
<?php } ?>
		
	</tbody>
</table>
                    </div>
                 </div>
                 
                 
                 
                 <div class="row">
                	<div class="col-md-12">
                     <h5><strong>Top Ten Loosers By Volume</strong></h5>
                     <table cellpadding="0" cellspacing="0" border="0" class="table table-responsive" id="daily_top">
	<thead>
		<tr>
         	<th>Company</th>
			<th>Volume</th>
		</tr>
	</thead>
	<tbody>
		<tr><?php $query = bottomtenByVolume();// mysql query to bottom top ten companies of the day by volume
 		while($info = mysql_fetch_array($query)) {?>
			<td><?php echo $info['code']; ?></td>
			<td><?php echo number_format($info['volume']);?> </td>
		</tr>
<?php } ?>
		
	</tbody>
</table>
                    </div>
                 </div>
       
       
       <div class="row">
                	<div class="col-md-12">
                     <h5><strong>Top Ten Loosers By Turnover </strong></h5>
                     <table cellpadding="0" cellspacing="0" border="0" class="table table-responsive" id="daily_top">
	<thead>
		<tr>
         	<th>Company</th>
			<th>Turnover</th>
		</tr>
	</thead>
	<tbody>
		<tr><?php $query = bottomtenByTurnover();// mysql query to get bottom ten companies of the day by turnover
while($info = mysql_fetch_array($query)) {?>
			<td><?php echo $info['code']; ?></td>
			<td><?php echo number_format($info['turnover']);?> </td>
		</tr>
<?php } ?>
		
	</tbody>
</table>
                    </div>
                 </div>
                 
               
               
               <div class="row">
                	<div class="col-md-12">
                     <h5><strong>Top Ten Loosers By Turnover Growth</strong></h5>
                     <table cellpadding="0" cellspacing="0" border="0" class="table table-responsive" id="daily_top">
	<thead>
		<tr>
         	<th>Company</th>
			<th>Y.To</th>
			<th>T.To</th>
			<th>% Change</th>
		</tr>
	</thead>
	<tbody>
		<tr><?php $query = bottomtenByturnoverGrowths();//Get bottom Ten companies by Turnover Growth
while($info = mysql_fetch_array($query)) {?>
			<td><?php echo $info['name']; ?></td>			
			<td><?php echo number_format($info['prevday_turnover']); ?></td>
			<td><?php echo number_format($info['today_turnover']); ?></td>
			<td><?php echo number_format($info['turnover_growth'],3)*100; ?></td>
      		
		</tr>
<?php } ?>
		
	</tbody>
</table>
                    </div>
                 </div>
       		
            <div class="row">
                	<div class="col-md-12">
                     <h5><strong>Lowest market capital</strong></h5>
                     <table cellpadding="0" cellspacing="0" border="0" class="table table-responsive" id="daily_top">
	<thead>
		<tr>
         	<th>Company</th>
			<th>MCAP</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php $query = bottomtenByMcap();//Get bottom Ten companies by Market Capitalization
while($info = mysql_fetch_array($query)) {?>
			<td><?php echo $info['code']; ?></td>
			<td><?php echo number_format($info['mcap']); ?></td>
      		
		</tr>
<?php } ?>
		</tbody>
</table>
                    </div>
                 </div>
                 
             
             
              <div class="row">
                	<div class="col-md-12">
                     <h5><strong>Top Ten Losers By EPS</strong></h5>
                     <table cellpadding="0" cellspacing="0" border="0" class="table table-responsive" id="daily_top">
	<thead>
		<tr>
         	<th>Company</th>
			<th>Total EPS</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Trident</td>
			<td>4</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>5</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>5.5</td>
			
        
		</tr>
		<tr>
			<td>Trident</td>
			<td>6</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>7</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>6</td>         
		</tr>
		</tbody>
</table>
                    </div>
                 </div>
                 
                 
                  <div class="row">
                	<div class="col-md-12">
                     <h5><strong>Top Ten Losers by P/E Ratio</strong></h5>
                     <table cellpadding="0" cellspacing="0" border="0" class="table table-responsive" id="daily_top">
	<thead>
		<tr>
         	<th>Company</th>
			<th>P/E Ratio</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Trident</td>
			<td>4</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>5</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>5.5</td>
			
        
		</tr>
		<tr>
			<td>Trident</td>
			<td>6</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>7</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>6</td>         
		</tr>
		</tbody>
</table>
                    </div>
                 </div>
                 
                 
       </div><!---the bottom tens---->
       </div>
        
</div>
<?php include_once("footer.php"); ?>
<?php //include_once("cache_footer.php"); ?>
