<?php include("header.php");
$username = $auth->getUsername($_COOKIE['auth_session']);

$user = $auth->getUserData($username);

$userid = $user['uid'];

date_default_timezone_set('Asia/Dhaka');

$newdate = date('Y-m-d', time());

$portfolio_id = $_GET['id'];

$_SESSION['portfolio_id'] = $portfolio_id;

$time = date('H:i:s');?>
<script src="js/amcharts.js" type="text/javascript"></script> 
<script src="js/pie.js" type="text/javascript"></script> 
<!-- scripts for exporting chart as an image --> 

<!-- Exporting to image works on all modern browsers except IE9 (IE10 works fine) --> 

<!-- Note, the exporting will work only if you view the file from web server --> 

<!--[if (!IE) | (gte IE 10)]> --> 

<!-- <script src="js/amexport.js" type="text/javascript"></script>

<script src="js/rgbcolor.js" type="text/javascript"></script>

<script src="js/canvg.js" type="text/javascript"></script>

<script src="js/jspdf.js" type="text/javascript"></script>

<script src="js/filesaver.js" type="text/javascript"></script>

<script src="js/jspdf.plugin.addimage.js" type="text/javascript"></script> --> 

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
      <li><a href="#"><i class="glyphicon glyphicon-briefcase"></i>&nbsp;Portfolio</a></li>
      <li><a href="#"><i class="glyphicon glyphicon-random"></i>&nbsp;Research</a></li>
      <li class="active"><a href="?page=allocation&id=<?php echo $portfolio_id; ?>"><i class="glyphicon glyphicon-align-justify"></i>&nbsp;Allocation</a></li>
      <li><a href="?page=company&id=<?php echo $portfolio_id; ?>"><i class="glyphicon glyphicon-file"></i>&nbsp;Company Details</a></li>
      <li><a href="?page=accounts&id=<?php echo $portfolio_id; ?>"><i class="glyphicon glyphicon-file"></i>&nbsp;Accounts</a></li>
      <li><a href="#"><i class="glyphicon glyphicon-certificate"></i>&nbsp;Statements</a></li>
      <li class="pull-right"><a href="#"><i class="glyphicon glyphicon-flag"></i>&nbsp;Alert</a></li>
    </ul>
  </div>
<div class="col-md-6 m-t-md">
<div id="chartdiv" style="width: 100%; height: 800px;"></div></div>
<div class="col-md-6 m-t-md">
<div id="chartdiv2" style="width: 100%; height: 400px;"></div>
</div></div>
<?php include("footer.php");  ?>
