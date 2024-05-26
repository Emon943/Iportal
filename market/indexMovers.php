<?php include_once("cache.php"); ?>

<?php include_once("header.php"); ?>

<?php $page = "indexMovers"; ?>

<?php include_once("navigation.php"); ?>

<?php include_once("db.php");?>



<div class="col-md-9">

  <div class="row">

    <div class="col-md-12">

      <div class="static-sub-menu">

        <ul>

          <li><a href="#">Stock market</a></li>

          <li><a href="#">Money Market</a></li>

          <li><a href="#">Commodity</a></li>

          <li><a href="#">Bonds</a></li>

          <li><a href="#">Currency</a></li>

          <li><a href="#">Economic Indicators</a></li>

        </ul>

      </div>

    </div>

    <div class="col-md-12 placeholder">

      <h4>Guide</h4>

      <p>Cras risus ipsum, posuere non vulputate sed, convallis non sapien. Nunc ligula dolor, dapibus eu commodo non, lacinia malesuada risus. Integer pharetra suscipit metus ut euismod. Donec ac viverra lacus. Cras egestas orci nec nisl lacinia, at ullamcorper dolor vulputate. Maecenas id nibh non elit tempor commodo. Curabitur consectetur molestie magna eget luctus. Nunc auctor odio sed lacus ornare bibendum. Curabitur at elit erat. Etiam rhoncus turpis sed pretium sodales. </p>

    </div>

  </div>

  <div class="row">

    

  </div>

   <div class="table-responsive">

              <table cellpadding="0" cellspacing="0" border="0" class="display table-bordered table-striped table" id="example">

                <thead>

                  <tr>

                    <th>Symbol</th>

                    <th>Company Name</th>

                    <th>Close Price</th>

                    <th>Volume</th>

                    <th>Trades</th>

                    <th>Changes%</th>

                    <th>High</th>

                    <th>Low</th>

                    <th>Date</th>

                    <th>CSE Price</th>

                    <th>CSE Volume</th>

                  </tr>

                </thead>

                <tbody>

                  <tr class="gradeX">

<?php $query = mysql_query("select  eod_stock.company_code,  max(eod_stock.close),  max(eod_stock.total_volume),   max(eod_stock.total_trade),   eod_stock.high,   eod_stock.low,   eod_stock.ltp, eod_stock.ycp,   max(eod_stock.datetime),   company.name  from   eod_stock    inner join company on (company.code = eod_stock.company_code) group by eod_stock.company_code ORDER BY max(eod_stock.total_volume) ASC;

") OR die("mysql_error()");





  while($info = mysql_fetch_array($query)) {

    

   

    ?>





  





                    <td><a href="" title="" target="_blank"><?php echo $info['company_code']; ?></a></td>

                    <td class="center"><?php echo $info['name']; ?></td>

                    <td class="center"><?php if($info['max(eod_stock.close']=0.00) {

                      echo $info['ltp'];

                    } else {

                      echo $info['max(eod_stock.close)'];

                    } ?> </td>

                    <td class="center"><?php echo number_format($info['max(eod_stock.total_volume)']); ?></td>

                    <td class="center"><?php echo number_format($info['max(eod_stock.total_trade)']); ?></td>

                    <td class="center"><?php if($info['max(eod_stock.close']=0.00) {

                      $change = ((($info['ltp']- $info['ycp'])/$info['ycp'])*100);

            

            echo number_format((float)$change, 2, '.', '');

                    } else {

            $change = ((($info['max(eod_stock.close)']- $info['ycp'])/$info['ycp'])*100);

            

                      echo number_format((float)$change, 2, '.', '');

                    } ?> </td>

                    <td class="center"><?php echo $info['high']; ?></td>

                    <td class="center"><?php echo $info['low']; ?></td>

                    <td class="center"><?php $date = $info['max(eod_stock.datetime)']; echo date('h:i A', strtotime($date)); ?></td>

                    <td class="center">0</td>

                    <td class="center">0</td>

                  </tr>

<?php } ?>

                 

                </tbody>

                <tfoot>

                  <tr>

                    <th>Symbol</th>

                    <th>Company Name</th>

                    <th>Close Price</th>

                    <th>Volume</th>

                    <th>Trades</th>

                    <th>Changes%</th>

                    <th>High</th>

                    <th>Low</th>

                    <th>Date</th>

                    <th>CSE Price</th>

                    <th>CSE Volume</th

    >

                  </tr>

                </tfoot>

              </table>

            </div>

          </div>

        </div>

</div>
<?php include_once("footer.php"); ?>
<?php include_once("cache_footer.php"); ?>

