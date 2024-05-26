<?php //include_once("cache.php")?>



<?php include_once("header.php"); ?>



  <?php $page = "market_stats"; ?>



  <?php include_once("navigation.php"); ?>



    



    <div class="col-md-9">



      <div class="row">



        <div class="col-md-12">



          <div class="static-sub-menu">



            <ul>



              <li><a href="mutualFund.php">Mutual Funds</a></li>



              <li><a href="#">NAV Graph</a></li>



              <li><a href="#">Mutual Fund Performance</a></li>



              <li><a href="#">News</a></li>



                



            </ul>



          </div>



        </div>



        <div class="col-md-12 placeholder">



          <h4>Guide</h4>



          <p>Cras risus ipsum, posuere non vulputate sed, convallis non sapien. Nunc ligula dolor, dapibus eu commodo non, lacinia malesuada risus. Integer pharetra suscipit metus ut euismod. Donec ac viverra lacus. Cras egestas orci nec nisl lacinia, at ullamcorper dolor vulputate. Maecenas id nibh non elit tempor commodo. Curabitur consectetur molestie magna eget luctus. Nunc auctor odio sed lacus ornare bibendum. Curabitur at elit erat. Etiam rhoncus turpis sed pretium sodales. </p>



        </div>



      </div>



      <div class="row">



        



                <div class="table-responsive">



            <table cellpadding="0" cellspacing="0" border="0" class="display table-bordered table-striped table" id="example">



                    <thead>



                      <tr>



                        <th>Symbol</th>



                        <th>Company Name</th>



                        <th>Current Price</th>



                        <th>NAV at Market Value</th>



                        <th>Cost Price</th>



                        <th>Price to NAV Ratio</th>



                        <th>NAV at Market Value/Cost Price</th>



                        <th>Weekly Protfolio Return (In terms of NAV)</th>



                        <th>Weekly Changes in Price %</th>



                        <th>Listing Year</th>



                      </tr>



                    </thead>



                    <tbody>



                      <tr class="gradeX">

<?php



$query = mutualFund();// Daily Stock arket table					

while($info = mysql_fetch_array($query)) {						



?>          						<td><a href="" title="" target="_blank"><?php echo $info['code']; ?></a></td>

                        <td><?php echo $info['name']; ?></td>

                        <td class="center"><?php  echo $info['ltp'];?></td>

                        

                        <td class="center"><?php echo $info['navmv']; ?></td>

                        <td class="center"><?php echo $info['cost_price'];  ?></td>

                        <td class="center"><?php echo $info['price_to_nav']; ?></td>

                        <td class="center"><?php echo $info['nav_cost_price']; ?></td>

                        <td class="center"><?php  ?></td>

                        <td class="center"><?php  ?></td>

                        <td class="center"><?php  echo $info['listing_year'];?></td>

                      </tr>

                      <?php } ?>



                    </tbody>



                    <tfoot>



                      <tr>



                        <th>Symbol</th>



                        <th>Company Name</th>



                        <th>Current Price</th>



                      



                        <th>NAV at Market Value</th>



                        <th>Cost Price</th>



                        <th>Price to NAV Ratio</th>



                        <th>NAV at Market Value/Cost Price</th>



                        <th>Weekly Protfolio Return (In terms of NAV)</th>



                        <th>Weekly Changes in Price %</th>



                        <th>Listing Year</th>



                     </tr>



                    </tfoot>



                  </table>



                </div>



              </div>



            </div>







           



          </div>



        </div>



      </div>



    </div>



    <?php include_once("footer.php"); ?>



<?php //include_once("cache_footer.php"); ?>



