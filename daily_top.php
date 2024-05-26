<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daily Top</title>
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
  <?php
$file = file_get_contents('https://dsebd.org'); 
 
libxml_use_internal_errors(true); //Prevents Warnings, remove if desired
$dom = new DOMDocument();
$dom->loadHTML($file);
$node = $dom->getElementById("mq2");
$output = $dom->saveHTML($node);


		
?>
  <div class="row">
    <div class="col-md-12  placeholder"> <?php echo $output; ?> </div>
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
          <li><a href="#">Beta</a></li>
          <li><a href="#">Correlation</a></li>
          <li><a href="#">Capital gain</a></li>
          <li><a href="#">Stock P/E chart</a></li>
          <li><a href="#">Volatility</a></li>
          <li><a href="#">Daily Top</a></li>
          <li><a href="#">Mutual Fund Data</a></li>
          <li><a href="#">EPS and NPAT Data</a></li>
          <li><a href="#">Management Info</a></li>
          <li><a href="#">Dividend Details</a></li>
          <li><a href="#">Moving Average</a></li>
          <li><a href="#">Technical Screener</a></li>
          <li><a href="#">Fundamental & Quantitative Screener</a></li>
          <li><a href="#">Company Basic Info</a></li>
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
        <div class="col-md-12">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-responsive table-stripe" id="daily_top">
	<thead>
		<tr class="success">
         	<th>Name</th>
			<th>Price</th>
			<th>Volume</th>
			<th>Turnover</th>
			<th>Turnover Growth</th>
			<th>Market CAP</th>
            <th>EPS</th>
            <th>P/E</th>
            <th>By Rank</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Trident</td>
			<td>Internet
				 Explorer 4.0</td>
			<td>Win 95+</td>
			<td>4</td>
			<td>X</td>
            <td>X</td>
            <td>X</td>
            <td>X</td>
            <td>X</td>
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet
				 Explorer 5.0</td>
			<td>Win 95+</td>
			<td>5</td>
			<td>C</td>
            <td>X</td>
            <td>X</td>
            <td>X</td>
            <td>X</td>
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet
				 Explorer 5.5</td>
			<td>Win 95+</td>
			<td>5.5</td>
			<td>A</td>
            <td>X</td>
            <td>X</td>
            <td>X</td>
            <td>X</td>
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet
				 Explorer 6</td>
			<td>Win 98+</td>
			<td>6</td>
			<td>A</td>
            <td>X</td>
            <td>X</td>
            <td>X</td>
            <td>X</td>
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 7</td>
			<td>Win XP SP2+</td>
			<td>7</td>
			<td>A</td>
            <td>X</td>
            <td>X</td>
            <td>X</td>
            <td>X</td>
		</tr>
		<tr>
			<td>Trident</td>
			<td>AOL browser (AOL desktop)</td>
			<td>Win XP</td>
			<td>6</td>
			<td>A</td>
            <td>X</td>
            <td>X</td>
            <td>X</td>
            <td>X</td>
            
		</tr>
		
	</tbody>
	<tfoot>
		<tr>
        	<th>Name</th>
			<th>Price</th>
			<th>Volume</th>
			<th>Turnover</th>
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
         	<th>Company</th>
			<th>YCP</th>
			<th>CP</th>
			<th>% Change</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 4.0</td>
			<td>Win 95+</td>
			<td>4</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet
				 Explorer 5.0</td>
			<td>Win 95+</td>
			<td>5</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 5.5</td>
			<td>Win 95+</td>
			<td>5.5</td>
			
        
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 6</td>
			<td>Win 98+</td>
			<td>6</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 7</td>
			<td>Win XP SP2+</td>
			<td>7</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>AOL browser (AOL desktop)</td>
			<td>Win XP</td>
			<td>6</td>
			
            
		</tr>
		
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
                     <h5><strong>Top Ten Gainer By Turnover Growth</strong></h5>
                     <table cellspacing="0" cellpadding="0" border="0" id="daily_top" class="table table-responsive">
	<thead>
		<tr>
         	<th>Company</th>
			<th>Y.To</th>
			<th>T.To</th>
			<th>% Change</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 4.0</td>
			<td>Win 95+</td>
			<td>4</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet
				 Explorer 5.0</td>
			<td>Win 95+</td>
			<td>5</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 5.5</td>
			<td>Win 95+</td>
			<td>5.5</td>
			
        
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 6</td>
			<td>Win 98+</td>
			<td>6</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 7</td>
			<td>Win XP SP2+</td>
			<td>7</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>AOL browser (AOL desktop)</td>
			<td>Win XP</td>
			<td>6</td>
			
            
		</tr>
		
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
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 4.0</td>
			<td>Win 95+</td>
			<td>4</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet
				 Explorer 5.0</td>
			<td>Win 95+</td>
			<td>5</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 5.5</td>
			<td>Win 95+</td>
			<td>5.5</td>
			
        
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 6</td>
			<td>Win 98+</td>
			<td>6</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 7</td>
			<td>Win XP SP2+</td>
			<td>7</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>AOL browser (AOL desktop)</td>
			<td>Win XP</td>
			<td>6</td>
			
            
		</tr>
		
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
                     <h5><strong>Top Ten Loosers By Turnover </strong></h5>
                     <table cellpadding="0" cellspacing="0" border="0" class="table table-responsive" id="daily_top">
	<thead>
		<tr>
         	<th>Company</th>
			<th>Turnover</th>
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
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 4.0</td>
			<td>Win 95+</td>
			<td>4</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet
				 Explorer 5.0</td>
			<td>Win 95+</td>
			<td>5</td>
			
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 5.5</td>
			<td>Win 95+</td>
			<td>5.5</td>
			
        
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 6</td>
			<td>Win 98+</td>
			<td>6</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>Internet Explorer 7</td>
			<td>Win XP SP2+</td>
			<td>7</td>
		
		</tr>
		<tr>
			<td>Trident</td>
			<td>AOL browser (AOL desktop)</td>
			<td>Win XP</td>
			<td>6</td>
			
            
		</tr>
		
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
    </div>
    <!--main column end for body---> 
  </div>
  <!--body end---> 
</div>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
<script>
$(function() {
	// degrade gracefully
	$('.click-nav > ul').toggleClass('no-js js');
	// hide dropdown menus
	$('.click-nav .js ul').hide();
	// reveal filter dropdown menu on click rather than hover
	$('.click-nav .js li.clicker').click(function(e) {
		// slideUp any open dropdown menus
		if ($('.click-nav .js ul').not($(this).find('ul')).is(':visible')) {
				$('.click-nav .js ul').not($(this).find('ul')).stop(true, true).slideUp();
				$('.click-nav .js li.clicker').removeClass('active');
			};
			
			// slide current dropdown menu up or down
			$(this).find('ul').stop(true, true).slideToggle(200);
			$(this).toggleClass('active');
			// instead of return false; or preventDefault(), use stopPropagation which keeps all links clickable in the dropdown menu
			e.stopPropagation();
	});
	
	// click anywhere on the page to slide up any visible dropdown menus
	$(document).click(function() {
		if ($('.click-nav .js ul').is(':visible')) {
			$('.click-nav .js ul', this).stop(true, true).slideUp();
			$('.clicker').removeClass('active');
		}
	});
});
</script>
</body>
</html>
