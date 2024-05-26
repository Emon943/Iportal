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

         
            <?php 
            $id = $_GET['id'];

            $query = mysql_query("SELECT News_Date, News_Subject, News_Details FROM v_news WHERE News_ID='$id'");

            while($info = mysql_fetch_array($query)) {
$news_date = date('Y-m-d',  strtotime($info['News_Date']));

echo "Date : " .$news_date . "<br><br><br>";

$parts = explode(':', $info['News_Details']);

$title = $parts[0]; 

echo   $info['News_Subject'] . "&nbsp". $title . "<br><br>";


             echo  $info['News_Details'];

            }


            ?>

          </div>
        </div>
<?php include_once("footer.php"); ?>
