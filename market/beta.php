<?php //include_once("cache.php")?>

<?php include_once("header.php"); ?>

  <link rel="stylesheet" type="text/css" href="css/datepicker.css">

  <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css">

  <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>

  <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>

  <?php $page = "capitalgain"; ?>

  <?php include_once("navigation.php"); ?>

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


      <div class="col-md-12">

        <div class="row">

          <div class="col-xs-4">


<?php 
$query = mysql_query("SELECT
  c.code,
    t1.entry_date,
    t1.ltp,
    t1.ltp - t2.ltp as day_change

FROM eod_stock t1
LEFT JOIN eod_stock t2 
ON t2.entry_date = subdate(t1.entry_date, 1)
AND t2.company_id = t1.company_id
LEFT OUTER JOIN company AS c
ON c.ID = t1.company_id;");

$query2 = mysql_query("SELECT
t3.IDX_DATE_TIME,
t3.IDX_CAPITAL_VALUE - t4.IDX_CAPITAL_VALUE as index_chnage
FROM idx t3
LEFT JOIN idx t4 
ON t4.IDX_DATE_TIME = subdate(t3.IDX_DATE_TIME, 1);")
?>
<table cellpadding="0" cellspacing="0" border="0" class="display table-bordered table-striped table" id="example">

                    <thead>

                      <tr>

                        <th>Date</th>

                        <th>Code</th>
                        <th>Daily Change</th>
                        <th>Index Change</th>

                      </tr>

                    </thead>

                    <tbody>
<?php while($info = mysql_fetch_array($query)) 
while($info2 = mysql_fetch_array($query2)) {
{



  ?>              <tr>


  <td><?php echo  $info['entry_date']; ?></td>
  <td><?php echo  $info['code']; ?></td>
  <td><?php echo  $info['day_change']; ?></td>
  </tr>
<?php } }?>  


                    </tbody>
                  </table>
</div>
</div>

<?php include_once("footer.php"); ?>