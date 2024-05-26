<?php //include_once("cache.php")?>
<?php include_once("header.php"); ?>
<?php $page = "market_stats"; ?>
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
  <div class="row">
    <div class="col-md-6 placeholder right">
      <div id="sectorperformancechart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
      <script type="text/javascript"><?php sectorPerformance(); ?></script> 
    </div>
    <div class="col-md-6 placeholder left">
      <div id="sectorupdownchart" style="height: 400px"></div>
      <script type="text/javascript"><?php sectorUpdown(); ?></script> 
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <h2 class="pull-left">DSE Broad Index(DSE X) </h2>
      <div class="pull-right top-padding">
        <form id="topBottom" method="GET" class="form-horizontal" role="form" action='sectorInfo.php'>
          <select name='sectorID' onChange="this.form.submit()">
            <option value="">Select Sector</option>
            <?php $query = sectorDropDown(); while($info = mysql_fetch_array($query)) {?>
            <option value="<?php echo $info['sector_ID']; ?>"><?php echo $info['name'] ?></option>
            <?php } ?>
          </select>
        </form>
      </div>
    </div>
    <div class="col-md-3">
      <h2 class="price text-center"><strong>1,077.22</strong></h2>
      <table class="table table-responsive noborder">
        <tr>
          <td>Change</td>
          <td>:</td>
          <td>0.0</td>
          <td>0.00%</td>
        </tr>
        <tr>
          <td>Volume</td>
          <td>:</td>
          <td colspan="2">0</td>
        </tr>
        <tr>
          <td>Value (BDT)</td>
          <td>:</td>
          <td colspan="2">0</td>
        </tr>
      </table>
      <table class="table table-responsive">
        <tr>
          <td>Open</td>
          <td>:</td>
          <td>1,077.20</td>
        </tr>
        <tr>
          <td>Pre close</td>
          <td>:</td>
          <td><h4 class="pull-right">1,077.20</h4></td>
        </tr>
        <tr>
          <td><span class="pull-left">High<br/>
            <small>0.00</small></span></td>
          <td>&nbsp;</td>
          <td><span class="pull-right">Low<br/>
            <small>0.00</small></span></td>
        </tr>
        <tr class="noborder">
          <td colspan="3"><div class="progress progress-striped">
              <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"> <span class="sr-only">100% Complete (warning)</span> </div>
            </div></td>
        </tr>
      </table>
    </div>
    <div class="col-md-9"> 
      <script type="text/javascript" src="http://extra.amcharts.com/public/swfobject.js"></script>
      <div id="amcharts_1389174633442">You need to upgrade your Flash Player</div>
      <script type="text/javascript">
  var so = new SWFObject("http://extra.amcharts.com/public/amstock.swf", "amstock", "650", "400", "8", "#FFFFFF");
  so.addVariable("path", "amstock/");
  so.addVariable("chart_settings", encodeURIComponent("<settings><margins>12</margins><number_format><letters><letter number='1000'>K</letter><letter number='1000000'>M</letter><letter number='10000000'>B</letter></letters></number_format><data_sets><data_set><title>East Stock</title><short>ES</short><color>003399</color><file_name>data/data-at-irregular-intervals.txt</file_name><csv><reverse>1</reverse><separator>,</separator><columns><column>date</column><column>volume</column><column>close</column></columns><data>2008-04-18,2190920000,2402.97\n2008-04-17,1779300000,2341.83\n2008-04-16,2128770000,2350.11\n2008-04-15,1884750000,2286.04\n2008-04-14,1626710000,2275.82\n2008-04-11,1902540000,2290.24\n2008-04-10,2159000000,2351.70\n2008-04-09,1922050000,2322.12\n2008-04-08,1635290000,2348.76\n2008-04-07,1730020000,2364.83\n2008-04-04,1977560000,2370.98\n2008-04-03,1993480000,2363.30\n2008-04-02,1996680000,2361.40\n2008-04-01,2160120000,2362.75\n2008-03-31,1788360000,2279.10\n2008-03-28,1785770000,2261.18\n2008-03-27,2038770000,2280.83\n2008-03-26,1915210000,2324.36\n2008-03-25,2099060000,2341.05\n2008-03-24,2312600000,2326.75\n2008-03-20,2764480000,2258.11\n2008-03-19,2265420000,2209.96\n2008-03-18,2411630000,2268.26\n2008-03-17,2338210000,2177.01\n2008-03-14,2547310000,2212.49\n2008-03-13,2419220000,2263.61\n2008-03-12,2077140000,2243.87\n2008-03-11,2526040000,2255.76\n2008-03-10,2101010000,2169.34\n2008-03-07,2386980000,2212.49\n2008-03-06,2165090000,2220.50\n2008-03-05,2209090000,2272.81\n2008-03-04,2669980000,2260.28\n2008-03-03,2145070000,2258.60\n2008-02-29,2405360000,2271.48\n2008-02-28,2032040000,2331.57\n2008-02-27,2216540000,2353.78\n2008-02-26,2263650000,2344.99\n2008-02-25,2152880000,2327.48\n2008-02-22,2324450000,2303.35\n2008-02-21,2277540000,2299.78\n2008-02-20,2258180000,2327.10\n2008-02-19,1988690000,2306.20\n2008-02-15,1999540000,2321.80\n2008-02-14,2267580000,2332.54\n2008-02-13,2174670000,2373.93\n2008-02-12,2183530000,2320.04\n2008-02-11,2072270000,2320.06\n2008-02-08,2229330000,2304.85\n2008-02-07,2946360000,2293.03\n2008-02-06,2362020000,2278.75\n2008-02-05,2501820000,2309.57\n2008-02-04,2050940000,2382.85\n2008-02-01,3060180000,2413.36\n2008-01-31,2813420000,2389.86\n2008-01-30,2618850000,2349.00\n2008-01-29,2160040000,2358.06\n2008-01-28,2033860000,2349.91\n2008-01-25,2599410000,2326.20\n2008-01-24,2928900000,2360.92\n2008-01-23,3650250000,2316.41\n2008-01-22,3161430000,2292.27\n2008-01-18,2991360000,2340.02\n2008-01-17,2785930000,2346.90\n2008-01-16,3397330000,2394.59\n2008-01-15,2390120000,2417.59\n2008-01-14,2134230000,2478.30\n2008-01-11,2355490000,2439.94\n2008-01-10,2640400000,2488.52\n2008-01-09,2821160000,2474.55\n2008-01-08,2566480000,2440.51\n2008-01-07,2600100000,2499.46\n2008-01-04,2516310000,2504.65\n2008-01-03,1970200000,2602.68\n2008-01-02,2076690000,2609.63\n2007-12-31,1454550000,2652.28\n2007-12-28,1338850000,2674.46\n2007-12-27,2324820000,2676.79\n2007-12-26,1241830000,2724.41\n2007-12-24,778620000,2713.50\n2007-12-21,2508800000,2691.99\n2007-12-20,1960470000,2640.86\n2007-12-19,1835920000,2601.01\n2007-12-18,1982590000,2596.03\n2007-12-17,1873110000,2574.46\n2007-12-14,1902390000,2635.74\n2007-12-13,2143760000,2668.49\n2007-12-12,2311900000,2671.14\n2007-12-11,2195200000,2652.35\n2007-12-10,1776540000,2718.95\n2007-12-07,1855070000,2706.16\n2007-12-06,1970680000,2709.03\n2007-12-05,2258840000,2666.36\n2007-12-04,2044740000,2619.83\n2007-12-03,1994710000,2637.13\n2007-11-30,2571340000,2660.96\n2007-11-29,2157170000,2668.13\n2007-11-28,2518580000,2662.91\n2007-11-27,2166930000,2580.80\n2007-11-26,2019400000,2540.99</data></csv></data_set></data_sets><charts><chart><title>Value</title><height>60</height><column_width>100</column_width><grid/><values><x><bg_color>EEEEEE</bg_color></x><y_left><bg_color>000000</bg_color><unit>$</unit><unit_position>left</unit_position><digits_after_decimal><data>2</data></digits_after_decimal></y_left></values><legend><show_date>1</show_date></legend><comparing><recalculate_from_start>0</recalculate_from_start><use_open_value_as_base>0</use_open_value_as_base></comparing><events/><trend_lines/><graphs><graph><bullet>round_outline</bullet><data_sources><close>close</close></data_sources><legend><date title='0' key='0'>{close}</date><period title='0' key='0'><![CDATA[open:<b>{open}</b> low:<b>{low}</b> high:<b>{high}</b> close:<b>{close}</b>]]></period></legend></graph></graphs></chart><chart><title>Volume</title><height>30</height><column_width>100</column_width><grid><y_left><approx_count>3</approx_count></y_left></grid><values><x><enabled>0</enabled></x></values><legend/><comparing><recalculate_from_start>0</recalculate_from_start><use_open_value_as_base>0</use_open_value_as_base></comparing><events/><trend_lines/><graphs><graph><type>step</type><period_value>average</period_value><alpha>0</alpha><fill_alpha>100</fill_alpha><data_sources><close>volume</close></data_sources><legend><date title='0' key='0'>{average}</date><period title='0' key='0'><![CDATA[open:<b>{open}</b> low:<b>{low}</b> high:<b>{high}</b> close:<b>{close}</b>]]></period></legend></graph></graphs></chart></charts><data_set_selector><enabled>0</enabled><drop_down><scroller_color>C7C7C7</scroller_color></drop_down></data_set_selector><period_selector><periods_title>Zoom:</periods_title><custom_period_title>Custom period:</custom_period_title><periods><period pid='0' type='DD' count='10'>10D</period><period pid='1' type='MM' count='1' selected='1'>1M</period><period pid='2' type='MM' count='3'>3M</period><period pid='3' type='YYYY' count='1'>1Y</period><period pid='4' type='YYYY' count='3'>3Y</period><period pid='5' type='YTD' count='0'>YTD</period><period pid='6' type='MAX' count='0'>MAX</period></periods></period_selector><header><enabled>0</enabled></header><balloon><border_color>B81D1B</border_color></balloon><background><alpha>100</alpha></background><scroller><graph_data_source>close</graph_data_source><playback><enabled>1</enabled><speed>3</speed></playback></scroller><export_as_image><color>CC3399</color></export_as_image><context_menu><default_items><print>0</print></default_items></context_menu></settings>"));
  so.addVariable("data_file", encodeURIComponent("amstock/amstock_data.null"));
  so.write("amcharts_1389174633442");
</script> 
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 styled-tab">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tables" data-toggle="tab">Show Stock price in Table</a></li>
        <li><a href="#profile" data-toggle="tab">Show Stock price in graph</a></li>
      </ul>
      
      <!-- Tab panes -->
      
      <div class="tab-content">
        <div class="tab-pane active" id="tables">
          <div class="tabbed-padding">
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
                    <th>Date/Time</th>
                    <th>CSE Price</th>
                    <th>CSE Volume</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="gradeX">
                    <?php

$query = stockMarket();// Daily Stock arket table					
while($info = mysql_fetch_array($query)) {						

?>
                    <td><a href="" title="" target="_blank"><?php echo $info['code']; ?></a></td>
                    <td class="center"><?php echo $info['name']; ?></td>
                    <td class="center"><?php  echo $info['ltp'];?></td>
                    <td class="center"><?php echo number_format($info['total_volume']); ?></td>
                    <td class="center"><?php echo number_format($info['total_trade']); ?></td>
                    <td class="center"><?php echo $info['changes']; ?></td>
                    <td class="center"><?php echo $info['high']; ?></td>
                    <td class="center"><?php echo $info['low']; ?></td>
                    <td class="center"><?php $date = $info['date']; echo date('d F', strtotime($date)); ?></td>
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
        <div class="tab-pane" id="profile">
          <div class="tabbed-padding">
            <ul class="nav nav-pills nav-justified">
              <li class="active"><a href="#secondaryprice" data-toggle="tab">Close Price</a></li>
              <li><a href="#secondaryvolume" data-toggle="tab">Volume</a></li>
              <li><a href="#secondaryvalue" data-toggle="tab">Value</a></li>
              <li><a href="#secondarytrades" data-toggle="tab">Trades</a></li>
              <li><a href="#secondarychange" data-toggle="tab">Change (%)</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="secondaryprice">
                <div class="tabbed-padding"> </div>
              </div>
              <div class="tab-pane" id="secondaryvolume">
                <div class="tabbed-padding">
                  <div id="closingvolumechart" style="height: 400px"></div>
                </div>
              </div>
              <div class="tab-pane" id="secondaryvalue">
                <div class="tabbed-padding"> this is the secondary value </div>
              </div>
              <div class="tab-pane" id="secondarytrades">
                <div class="tabbed-padding">
                  <div id="companytradechart" style="height: 400px"></div>
                </div>
              </div>
              <div class="tab-pane" id="secondarychange">
                <div class="tabbed-padding">
                  <div id="companychagechart" style="height: 400px"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once("footer.php"); ?>
<?php //include_once("cache_footer.php"); ?>
