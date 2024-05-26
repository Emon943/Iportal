<?php
//setting timezone
date_default_timezone_set('Asia/Dhaka');
//importaing DB Class
include_once("db.php");
//Importaing highcharts wrapper class
include_once('libraries/Highchart.php');
// @param dseTicker
// gets all ticker information from dse
function dseTicker() {
$file = file_get_contents('https://dsebd.org/'); 
libxml_use_internal_errors(true); //Prevents Warnings, remove if desired
$dom = new DOMDocument();
$dom->loadHTML($file);
$node = $dom->getElementById("mq2");
$output = $dom->saveHTML($node);
	return $output;
}
//Todays sector performance function
function sectorPerformance() {
$chart = new Highchart();
$chart->chart->renderTo = "sectorperformancechart";
$chart->chart->type = "column";
$chart->title->text = "Todays Sector Performance";
$chart->xAxis->categories = array(
'Bank', 
'Engineering',
'DSE30', 
'Food & Allied', 
'Fuel & Power', 
'Jute','Textile',
'Pharmaceuticals',
'Paper & Printing',
'Serv. & R. Estate', 
'Cement','Miscellaneous',
'Insurance',
'NBFI',
'IT Sector',
'Travel & Leisure',
'Ceramics',
'Mutual Funds',
'Tannery',
'Telecom'
);
$chart->xAxis->labels->rotation = - 45;
$chart->xAxis->labels->align = "right";
$chart->xAxis->labels->style->font = "normal 10px Verdana, sans-serif";
$chart->plotOptions->series->minPointLength = 8;
$chart->plotOptions->series->borderColor= "#F2F2F2";
$chart->plotOptions->series->borderWidth = 2;
$chart->plotOptions->series->shadow = true;
$chart->credits->enabled = false;
$chart->legend->enabled = false;
$chart->yAxis->labels->formatter = new HighchartJsExpr(
		"function () {
        return this.value + '%';
		}"
);
$chart->series[] = array(
    'name' => 'Index Changes',
    'data' => array(3.5, 4.2, 11.5, 5.2, -0.051, -2.5, -4.25, 5, 5, 6.6, 3.3, 5.2,12.5,4.2,1.5,2.5,3.5,3.6,4.9,7.8),
    'color'=> '#008000',
	'negativeColor'=> '#FF0000');
echo $chart->render("chart1");
}
//Stock Data Graph Close Price
function stockGraphClosePrice($id) {
$ID = $id;
$query = mysql_query("SELECT name FROM sector WHERE sector_id ='$ID'");
$row = mysql_fetch_array($query);
$stockMarketquery = mysql_query("SELECT 
c.code,
c.name,
e.ltp,
e.entry_date AS `date`,
FROM_UNIXTIME(e.entry_timestamp, '%h:%i') AS `time`
-- , e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock) AND sector_id = '$ID' ORDER BY ltp");
$name = $row['name'];
while($info = mysql_fetch_array($stockMarketquery)) {
$cats[] =$info['name'];
$close[] = $info['ltp'];
}
$total_name = json_encode($cats);
$total_ltp = json_encode($close);
$close_price= str_replace('"', '', $total_ltp);
$chart = new Highchart();
$chart->chart->renderTo = "closingpricechart";
$chart->chart->type = "column";
$chart->title->text = $name;
$chart->xAxis->categories = json_decode($total_name);
$chart->xAxis->labels->rotation = - 90;
$chart->xAxis->labels->align = "right";
$chart->xAxis->labels->style->font = "normal 10px Verdana, sans-serif";
$chart->plotOptions->series->borderColor= "#F2F2F2";
$chart->plotOptions->series->borderWidth = 2;
$chart->plotOptions->series->shadow = true;
$chart->credits->enabled = false;
$chart->legend->enabled = false;
$chart->yAxis->title->text = 'Closing Price';
$chart->yAxis->labels->formatter = new HighchartJsExpr(
		"function () {
	       return this.value;
		}"
);
$chart->series[] = array(
    'name' => 'Closing Price',
    'data' => json_decode($close_price),
    'color'=> '#008000');
echo $chart->render("chart1");
}
//Stock Data Graph Volume
function stockGraphVolume($id) {
	
$ID = $id;
$query = mysql_query("SELECT name FROM sector WHERE sector_id ='$ID'");
$row = mysql_fetch_array($query);
$stockMarketquery = mysql_query("SELECT 
c.code,
c.name,
e.total_volume,
e.entry_date AS `date`,
FROM_UNIXTIME(e.entry_timestamp, '%h:%i') AS `time`
-- , e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock) AND sector_id = '$ID' ORDER BY total_volume");
$name = $row['name'];
while($info = mysql_fetch_array($stockMarketquery)) {
$cats[] =$info['name'];
$volume[] = $info['total_volume'];
}
$total_name = json_encode($cats);
$total_volumes = json_encode($volume);
$$total_volume = str_replace('"', '', $total_volumes);
$chart = new Highchart();
$chart->chart->renderTo = "closingvolumechart";
$chart->chart->type = "column";
$chart->title->text = $name;
$chart->chart->height = 600;
$chart->xAxis->categories = json_decode($total_name);
$chart->xAxis->labels->rotation = - 90;
$chart->xAxis->labels->align = "right";
$chart->xAxis->labels->style->font = "normal 10px Verdana, sans-serif";
$chart->plotOptions->series->borderColor= "#F2F2F2";
$chart->plotOptions->series->borderWidth = 2;
$chart->plotOptions->series->shadow = true;
$chart->credits->enabled = false;
$chart->legend->enabled = false;
$chart->yAxis->title->text = 'Volumes';
$chart->plotOptions->series->minPointLength = 10;
$chart->yAxis->labels->formatter = new HighchartJsExpr(
		"function () {
        return this.value;
		}"
);
$chart->series[] = array(
    'name' => 'Volume',
    'data' => json_decode($$total_volume),
    'color'=> '#008000');
	echo $chart->render("chart2");
}
//Stock Data Graph Value
function stockGraphValue($id) {
$ID = $id;
$query = mysql_query("SELECT name FROM sector WHERE sector_id ='$ID'");
$row = mysql_fetch_array($query);
$stockMarketquery = mysql_query("SELECT 
c.code,
c.name,
e.total_value AS turnover,
e.entry_date AS `date`,
FROM_UNIXTIME(e.entry_timestamp, '%h:%i') AS `time`
-- , e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock) AND sector_id = '$ID' ORDER BY turnover");
$name = $row['name'];
while($info = mysql_fetch_array($stockMarketquery)) {
$cats[] =$info['name'];
$turnover[] = $info['turnover'];
}
$total_name = json_encode($cats);
$total_turnover = json_encode($turnover);
$value= str_replace('"', '',$total_turnover);
$chart = new Highchart();
$chart->chart->renderTo = "closingvaluechart";
$chart->chart->type = "bar";
$chart->chart->height = 600;
$chart->title->text = $name;
$chart->xAxis->categories = json_decode($total_name);
//$chart->xAxis->labels->rotation = - 90;
//$chart->xAxis->labels->align = "right";
$chart->xAxis->labels->style->font = "normal 10px Verdana, sans-serif";
$chart->plotOptions->series->borderColor= "#F2F2F2";
$chart->plotOptions->series->borderWidth = 2;
$chart->plotOptions->series->shadow = true;
$chart->credits->enabled = false;
$chart->legend->enabled = false;
$chart->plotOptions->series->minPointLength = 10;
$chart->yAxis->title->text = 'Value/Turnover';
$chart->yAxis->labels->formatter = new HighchartJsExpr(
		"function () {
        return this.value;
		}"
);
$chart->series[] = array(
    'name' => 'Value/Turnover',
    'data' => json_decode($value),
    'color'=> '#008000');
	echo $chart->render("chart3");
}
//Stock Data Graph Trade
function stockGraphTrade($id) {
$ID = $id;
$query = mysql_query("SELECT name FROM sector WHERE sector_id ='$ID'");
$row = mysql_fetch_array($query);
$stockMarketquery = mysql_query("SELECT 
c.code,
c.name,
e.total_trade AS trade,
e.entry_date AS `date`,
FROM_UNIXTIME(e.entry_timestamp, '%h:%i') AS `time`
-- , e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock) AND sector_id = '$ID' ORDER BY trade");
$name = $row['name'];
while($info = mysql_fetch_array($stockMarketquery)) {
$cats[] =$info['name'];
$trades[] = $info['trade'];
}
$total_name = json_encode($cats);
$total_trade = json_encode($trades);
$trade= str_replace('"', '', $total_trade);
$chart = new Highchart();
$chart->chart->renderTo = "companytradechart";
$chart->chart->type = "column";
$chart->chart->height = 600;
$chart->title->text = $name;
$chart->xAxis->categories = json_decode($total_name);
$chart->xAxis->labels->rotation = - 90;
$chart->xAxis->labels->align = "right";
$chart->xAxis->labels->style->font = "normal 10px Verdana, sans-serif";
$chart->plotOptions->series->borderColor= "#F2F2F2";
$chart->plotOptions->series->borderWidth = 2;
$chart->plotOptions->series->shadow = true;
$chart->credits->enabled = false;
$chart->legend->enabled = false;
$chart->plotOptions->series->minPointLength = 10;
$chart->yAxis->title->text = 'Trade';
$chart->yAxis->labels->formatter = new HighchartJsExpr(
		"function () {
        return this.value;
		}"
);
$chart->series[] = array(
    'name' => 'Trade',
    'data' => json_decode($trade),
    'color'=> '#008000');
	echo $chart->render("chart4");
}
//Stock Data Graph Changes
function stockGraphChanges($id) {
$ID = $id;
$query = mysql_query("SELECT name FROM sector WHERE sector_id ='$ID'");
$row = mysql_fetch_array($query);
$stockMarketquery = mysql_query("SELECT 
c.code,
c.name,
CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) AS changes,
e.entry_date AS `date`,
FROM_UNIXTIME(e.entry_timestamp, '%h:%i') AS `time`
-- , e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock) AND sector_id = '$ID' ORDER BY changes");
$name = $row['name'];
while($info = mysql_fetch_array($stockMarketquery)) {
$cats[] =$info['name'];
$changes[] = $info['changes'];
}
$total_name = json_encode($cats);
$total_changes = json_encode($changes);
$change= str_replace('"', '', $total_changes);
$chart = new Highchart();
$chart->chart->renderTo = "companychagechart";
$chart->chart->type = "column";
$chart->chart->height = 600;
$chart->title->text = $name;
$chart->xAxis->categories = json_decode($total_name);
$chart->xAxis->labels->rotation = - 90;
$chart->xAxis->labels->align = "right";
$chart->xAxis->labels->style->font = "normal 10px Verdana, sans-serif";
$chart->plotOptions->series->borderColor= "#F2F2F2";
$chart->plotOptions->series->borderWidth = 2;
$chart->plotOptions->series->shadow = true;
$chart->credits->enabled = false;
$chart->legend->enabled = false;
$chart->plotOptions->series->minPointLength = 10;
$chart->yAxis->title->text = 'Changes';
$chart->yAxis->labels->formatter = new HighchartJsExpr(
		"function () {
        return this.value + '%';
		}"
);
$chart->series[] = array(
    'name' => 'Price Changes',
    'data' => json_decode($change),
    'color'=> '#008000',
    'negativeColor'=> '#FF0000'
    );
	echo $chart->render("chart5");
}
// Todays sector updown ratio chart
function sectorUpdown() {
$query  = mysql_query("SELECT
s.name,
SUM(a.pos) AS pos,
SUM(a.neg) AS neg,
SUM(a.none) AS none
FROM sector AS s
LEFT OUTER JOIN
(SELECT 
c.sector_id,
IF(CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) > 0, 1, 0) AS pos, IF(CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) < 0, 1, 0) AS neg, 
IF(!(CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) > 0) AND !(CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) < 0), 1, 0) AS none 
FROM company AS c 
LEFT OUTER JOIN eod_stock AS e ON e.entry_date = (SELECT MAX(entry_date) FROM eod_stock) 
AND e.company_id = c.ID WHERE e.company_id  ) AS a ON a.sector_id = s.sector_ID GROUP BY s.sector_ID 
order by count(pos+neg+none) desc;");
while($info = mysql_fetch_array($query)) {
$name[] =$info['name'];
$pos[] = $info['pos'];
$neg[] = $info['neg'];
$none[] = $info['none'];
}
$sector   = json_encode($name);
$positiveenc = json_encode($pos);
$positive = str_replace('"', '', $positiveenc);
$negetiveenc = json_encode($neg);
$negetive = str_replace('"', '', $negetiveenc);
$noresultenc = json_encode($none);
$noresult = str_replace('"', '', $noresultenc);
$chart = new Highchart();
	$chart->chart->renderTo = "sectorupdownchart";
	$chart->chart->type = "column";
	$chart->title->text = "Todays Sector Up/Down Ratio";
	$chart->xAxis->categories = json_decode($sector);
	$chart->xAxis->labels->rotation = - 45;
	$chart->xAxis->labels->align = "right";
	$chart->xAxis->labels->style->font = "normal 10px Verdana, sans-serif";
	$chart->yAxix->labels->enabled = 0;
	$chart->yAxis->min = 0;
	$chart->yAxis->title->text = date("d M Y");;
	$chart->yAxis->stackLabels->enabled = 0;// top numbers
	$chart->yAxis->stackLabels->style->fontWeight = "bold";
	$chart->yAxis->stackLabels->style->color = new HighchartJsExpr(
    "(Highcharts.theme && Highcharts.theme.textColor) || 'gray'");
	$chart->legend->align = "left";
	$chart->legend->x = 20;
	$chart->legend->y = 20;
	$chart->legend->verticalAlign = "top";
	$chart->legend->floating = 1;
	$chart->legend->backgroundColor = new HighchartJsExpr(
    "(Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white'");
	$chart->legend->borderColor = "#CCC";
	$chart->legend->borderWidth = 1;
	$chart->legend->shadow = false;
	$chart->tooltip->formatter = new HighchartJsExpr(
	"function() {
         return '<b>'+ this.x +'</b><br/>'+
         this.series.name +': '+ this.y +'<br/>'+
         'Total: '+ this.point.stackTotal;
				}");
	$chart->plotOptions->series->borderColor = "#F2F2F2";
	$chart->plotOptions->series->borderWidth = 2;
	$chart->plotOptions->series->shadow = true;
	$chart->plotOptions->column->stacking = "normal";
	$chart->plotOptions->column->dataLabels->enabled = 0;
	$chart->plotOptions->column->dataLabels->color = new HighchartJsExpr(
    "(Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'");
	$chart->credits->enabled = 0;
	$chart->series[] = array(
		"name"  => 'Positive Return',
        "data"  => json_decode($positive),
		"color" => '#008000');
	$chart->series[] = array(
		"name"  => '0 Return',
        "data"  => json_decode($noresult),
		"color" => '#1F497D',
	);
	$chart->series[] = array(
		"name"  => 'Negetive Return',
        "data"  => json_decode($negetive),
		"color" => '#F40909',
	);
	echo $chart->render("chart2");
}
//Get Top Ten Company list By Price
function toptenByPrice(){
	$queryByPriceDesc = mysql_query("SELECT 
c.code,
e.ltp,
e.ycp,
e.ltp - e.ycp AS price,
e.total_volume AS volume,
e.total_value AS turnover,
CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) AS changes,
(e.total_value - IFNULL((SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = e.entry_date),0))/(SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = e.entry_date) AS turnover_growth,
(SELECT total_share FROM share_percentage WHERE company_id = e.company_id) - e.ltp AS mcap,
(SELECT q1+q2+q3+q4 FROM eps_continuing WHERE company_id = e.company_id AND eps_year = (SELECT MAX(eps_year) FROM eps_continuing WHERE company_id = e.company_id)) AS eps,
'' AS pe
-- ,e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock) 
ORDER BY changes DESC
LIMIT 0,10") OR die("mysql_error()");
	return $queryByPriceDesc;
}
//Get Top Ten Company list By Volume
function toptenByVolume(){
	$queryByVolumeDesc = mysql_query("SELECT 
c.code,
e.ltp,
e.ycp,
e.ltp - e.ycp AS price,
e.total_volume AS volume,
e.total_value AS turnover,
CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) AS changes,
(e.total_value - IFNULL((SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = e.entry_date),0))/(SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = e.entry_date) AS turnover_growth,
(SELECT total_share FROM share_percentage WHERE company_id = e.company_id) - e.ltp AS mcap,
(SELECT q1+q2+q3+q4 FROM eps_continuing WHERE company_id = e.company_id AND eps_year = (SELECT MAX(eps_year) FROM eps_continuing WHERE company_id = e.company_id)) AS eps,
'' AS pe
-- ,e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock) 
ORDER BY volume DESC
LIMIT 0,10") OR die("mysql_error()");
	return $queryByVolumeDesc;
}
//Get Top Ten Company list By Turnover
function toptenByTurnover(){
	$queryByTurnoverDesc = mysql_query("SELECT 
c.code,
e.ltp - e.ycp AS price,
e.total_volume AS volume,
e.total_value AS turnover,
(e.total_value - IFNULL((SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = e.entry_date-1),0))/(SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = e.entry_date-1) AS turnover_growth,
(SELECT total_share FROM share_percentage WHERE company_id = e.company_id) - e.ltp AS mcap,
(SELECT q1+q2+q3+q4 FROM eps_continuing WHERE company_id = e.company_id AND eps_year = (SELECT MAX(eps_year) FROM eps_continuing WHERE company_id = e.company_id)) AS eps,
'' AS pe
-- ,e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)
ORDER BY turnover DESC
LIMIT 0,10") OR die("mysql_error()");
	return $queryByTurnoverDesc;
}
//Get Top Ten Company list By Mcap
function toptenByMcap(){
	$queryByMcapDesc = mysql_query("SELECT 
c.code,
(SELECT total_share FROM share_percentage WHERE company_id = e.company_id limit 1) * e.ltp AS mcap
-- ,e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)
ORDER BY mcap DESC
LIMIT 0,10") OR die("mysql_error()");
	return $queryByMcapDesc;
}
//Get Bottom Ten Company list By Price
function bottomtenByPrice(){
	$queryByPriceAesc = mysql_query("SELECT 
c.code,
e.ltp,
e.ycp,
e.ltp - e.ycp AS price,
e.total_volume AS volume,
e.total_value AS turnover,
CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) AS changes,
(e.total_value - IFNULL((SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = e.entry_date),0))/(SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = e.entry_date) AS turnover_growth,
(SELECT total_share FROM share_percentage WHERE company_id = e.company_id) * e.ltp AS mcap,
(SELECT q1+q2+q3+q4 FROM eps_continuing WHERE company_id = e.company_id AND eps_year = (SELECT MAX(eps_year) FROM eps_continuing WHERE company_id = e.company_id)) AS eps,
'' AS pe
-- ,e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock) 
ORDER BY changes ASC
LIMIT 0,10") OR die("mysql_error()");
	return $queryByPriceAesc;
}
//Get Bottom Ten Company list By Volume
function bottomtenByVolume(){
	$queryByVolumeAsc = mysql_query("SELECT 
c.code,
e.ltp,
e.ycp,
e.ltp - e.ycp AS price,
e.total_volume AS volume,
e.total_value AS turnover,
CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) AS changes,
(e.total_value - IFNULL((SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = e.entry_date),0))/(SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = e.entry_date) AS turnover_growth,
(SELECT total_share FROM share_percentage WHERE company_id = e.company_id) - e.ltp AS mcap,
(SELECT q1+q2+q3+q4 FROM eps_continuing WHERE company_id = e.company_id AND eps_year = (SELECT MAX(eps_year) FROM eps_continuing WHERE company_id = e.company_id)) AS eps,
'' AS pe
-- ,e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock) 
ORDER BY volume ASC
LIMIT 0,10") OR die("mysql_error()");
	return $queryByVolumeAsc;
}
//Get Top Ten Companies by turnover Growth
function bottomtenByTurnover(){
	$queryByTurnoverAsc = mysql_query("SELECT 
c.code,
e.ltp - e.ycp AS price,
e.total_volume AS volume,
e.total_value AS turnover,
(e.total_value - 
IFNULL((SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = (SELECT entry_date FROM eod_stock WHERE entry_date < e.entry_date AND company_id = e.company_id ORDER BY entry_date DESC LIMIT 0,1)),0))/
(SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = (SELECT entry_date FROM eod_stock WHERE entry_date < e.entry_date AND company_id = e.company_id ORDER BY entry_date DESC LIMIT 0,1)) AS turnover_growth,
'' AS pe
-- ,e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)
ORDER BY turnover ASC
LIMIT 0,10") OR die("mysql_error()");
	return $queryByTurnoverAsc;
}
// get top ten companies by Turnover Growth
function toptenByturnoverGrowths() {
	$queryTurnoverGrowthDesc = mysql_query("SELECT 
name,
today_turnover,
prevday_turnover,
turnover_growth
FROM ( 
SELECT 
c.name,
e.total_value AS today_turnover,
(SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = (SELECT entry_date FROM eod_stock WHERE entry_date < e.entry_date AND company_id = e.company_id ORDER BY entry_date DESC LIMIT 0,1)) AS prevday_turnover,
(e.total_value - 
IFNULL((SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = (SELECT entry_date FROM eod_stock WHERE entry_date < e.entry_date AND company_id = e.company_id ORDER BY entry_date DESC LIMIT 0,1)),0))/
(SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = (SELECT entry_date FROM eod_stock WHERE entry_date < e.entry_date AND company_id = e.company_id ORDER BY entry_date DESC LIMIT 0,1)) AS turnover_growth
-- ,e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)
ORDER BY turnover_growth DESC
LIMIT 0,10
) AS a");
	return $queryTurnoverGrowthDesc;
}
// get bottom ten companies by Turnover Growth
function bottomtenByturnoverGrowths() {
	$queryTurnoverGrowthAsc = mysql_query("SELECT 
name,
today_turnover,
prevday_turnover,
turnover_growth
FROM
(SELECT 
c.name,
e.total_value AS today_turnover,
(SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = (SELECT entry_date FROM eod_stock WHERE entry_date < e.entry_date AND company_id = e.company_id ORDER BY entry_date DESC LIMIT 0,1)) AS prevday_turnover,
(e.total_value - 
IFNULL((SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = (SELECT entry_date FROM eod_stock WHERE entry_date < e.entry_date AND company_id = e.company_id ORDER BY entry_date DESC LIMIT 0,1)),0))/
(SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = (SELECT entry_date FROM eod_stock WHERE entry_date < e.entry_date AND company_id = e.company_id ORDER BY entry_date DESC LIMIT 0,1)) AS turnover_growth
-- ,e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)
ORDER BY turnover_growth ASC
LIMIT 0,10
) AS a");
	return $queryTurnoverGrowthAsc;
}
// Table for gainer
function tableForGainer($orderway){
	$ord = $orderway;
	$queryForGainer =  mysql_query("SELECT 
c.code,
e.ltp - e.ycp AS price,
e.total_volume AS volume,
e.total_value  AS  turnover,
e.total_trade AS trade,
CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) AS changes,
(e.total_value - 
IFNULL((SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = (SELECT entry_date FROM eod_stock WHERE entry_date < e.entry_date AND company_id = e.company_id ORDER BY entry_date DESC LIMIT 0,1)),0))/
(SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = (SELECT entry_date FROM eod_stock WHERE entry_date < e.entry_date AND company_id = e.company_id ORDER BY entry_date DESC LIMIT 0,1)) AS turnover_growth,
(SELECT total_share FROM share_percentage WHERE company_id = e.company_id limit 1) * e.ltp AS mcap,
(SELECT q1+q2+q3+q4 FROM eps_continuing WHERE company_id = e.company_id AND eps_year = (SELECT MAX(eps_year) FROM eps_continuing WHERE company_id = e.company_id)) AS eps,
'' AS pe
-- ,e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)
ORDER BY $ord DESC
LIMIT 0,10") or die(mysql_error());
	return $queryForGainer;
}
function test($val){
	echo $val;
}
//Get Bottom Ten Company list By Mcap
function bottomtenByMcap(){
	$queryByMcapASC = mysql_query("SELECT 
c.code,
e.ltp - e.ycp AS price,
e.total_volume AS volume,
e.total_value  AS  turnover,
(e.total_value - 
IFNULL((SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = (SELECT entry_date FROM eod_stock WHERE entry_date < e.entry_date AND company_id = e.company_id ORDER BY entry_date DESC LIMIT 0,1)),0))/
(SELECT total_value FROM eod_stock WHERE company_id = e.company_id AND entry_date = (SELECT entry_date FROM eod_stock WHERE entry_date < e.entry_date AND company_id = e.company_id ORDER BY entry_date DESC LIMIT 0,1)) AS turnover_growth,
(SELECT total_share FROM share_percentage WHERE company_id = e.company_id limit 1) * e.ltp AS mcap,
(SELECT q1+q2+q3+q4 FROM eps_continuing WHERE company_id = e.company_id AND eps_year = (SELECT MAX(eps_year) FROM eps_continuing WHERE company_id = e.company_id)) AS eps,
'' AS pe
-- ,e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)
HAVING (mcap) > 0
ORDER BY mcap ASC
LIMIT 0,10") OR die("mysql_error()");
	return $queryByMcapASC;
}
// Function Stock Market
function stockMarket(){
	 $stockMarketquery = mysql_query("SELECT 
c.code,
c.name,
e.ltp,
e.total_volume,
e.total_value,
e.total_trade,
CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) AS changes,
e.high,
e.low,
e.entry_date AS `date`,
FROM_UNIXTIME(e.entry_timestamp, '%h:%i') AS `time`
-- , e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)");	
	 return $stockMarketquery;
}
function sectorDropDown(){
	$query =mysql_query("select sector_ID, name from sector;");
	return $query;
}
// Function Sector Data by sector ID
function sectorData($id){
	$sector_id = $id;
	 $stockMarketquery = mysql_query("SELECT 
c.code,
c.name,
e.ltp,
e.total_volume,
e.total_value,
e.total_trade,
CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) AS changes,
e.high,
e.low,
e.entry_date AS `date`,
FROM_UNIXTIME(e.entry_timestamp, '%h:%i') AS `time`
-- , e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock) AND sector_id = '$sector_id'");	
	 return $stockMarketquery;
}
function sectorName($id){
	$ID = $id;
$query =mysql_query("SELECT name FROM sector WHERE sector_id ='$ID'");
$row = mysql_fetch_array($query);
echo $row['name'];
}
function companyDropDown(){
  $query =mysql_query("select ID as cid, code from company where sector_id in (1,2,3,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21)");
  return $query;
}
function capitalGainCompany($id,$begdate,$enddate){
$ids = $id;
$adate = $begdate;
$bdate = $enddate;
$query = mysql_query("SELECT c.code,c.name, a.ltp as begning, b.ltp as enddate,
d.interim_rec_date, d.interim_cash,d.interim_stock, 
d1.annual_rec_date,d1.annual_cash,d1.annual_stock, 
CAST(((b.ltp - a.ltp) / a.ltp * 100) AS DECIMAL(10, 2)) as chng
FROM eod_stock AS a
LEFT OUTER JOIN eod_stock AS b
ON a.company_id = b.company_id
LEFT OUTER JOIN company AS c
ON c.ID = a.company_id
LEFT OUTER JOIN dividend_info AS d
ON c.ID = d.company_id AND d.interim_rec_date BETWEEN '$adate' AND '$bdate'
LEFT OUTER JOIN dividend_info AS d1
ON c.ID = d1.company_id AND d1.annual_rec_date BETWEEN '$adate' AND '$bdate'
WHERE a.entry_date = ('$adate')
AND b.entry_date = ('$bdate')
AND a.company_id IN ($ids)");
while($info = mysql_fetch_array($query)) {   
$res[] = array(
'id' => $info['code'],
'name' => $info['name'],
'begning_price' => $info['begning'],
'end_price' => $info['enddate'],
'capital_gain' => $info['chng'],
'interim_date' => render($info['interim_rec_date']),
'interim_cash' => render($info['interim_cash']),
'interim_stock' => render($info['interim_stock']),
'annual_date' => render($info['annual_rec_date']),
'annual_cash' => render($info['annual_cash']),
'annual_stock' => render($info['annual_stock']),
       );
}
echo json_encode($res);
}
function capitalGainSector($sect,$begdate,$enddate){
$id = $sect;
$adate = $begdate;
$bdate = $enddate;
$query = mysql_query("SELECT c.code,c.name, a.ltp as begning, b.ltp as enddate,
d.interim_rec_date, d.interim_cash,d.interim_stock, 
d1.annual_rec_date,d1.annual_cash,d1.annual_stock, 
CAST(((b.ltp - a.ltp) / a.ltp * 100) AS DECIMAL(10, 2)) as chng
FROM eod_stock AS a
LEFT OUTER JOIN eod_stock AS b
ON a.company_id = b.company_id
LEFT OUTER JOIN company AS c
ON c.ID = a.company_id
LEFT OUTER JOIN dividend_info AS d
ON c.ID = d.company_id AND d.interim_rec_date BETWEEN '$adate' AND '$bdate'
LEFT OUTER JOIN dividend_info AS d1
ON c.ID = d1.company_id AND d1.annual_rec_date BETWEEN '$adate' AND '$bdate'
WHERE a.entry_date = ('$adate')
AND b.entry_date = ('$bdate')
AND c.sector_id IN ($id);");
while($info = mysql_fetch_array($query)) {   
$res[] = array(
'id' => $info['code'],
'name' => $info['name'],
'begning_price' => $info['begning'],
'end_price' => $info['enddate'],
'capital_gain' => $info['chng'],
'interim_date' => render($info['interim_rec_date']),
'interim_cash' => render($info['interim_cash']),
'interim_stock' => render($info['interim_stock']),
'annual_date' => render($info['annual_rec_date']),
'annual_cash' => render($info['annual_cash']),
'annual_stock' => render($info['annual_stock']),
       );
}
echo json_encode($res);
}
//Capital Gain Of DSEX enlisted Companies
function capitalGainDsex($begdate,$enddate){
$adate = $begdate;
$bdate = $enddate;
$query = mysql_query("SELECT c.code,c.name, a.ltp as begning, b.ltp as enddate,
d.interim_rec_date, d.interim_cash,d.interim_stock, 
d1.annual_rec_date,d1.annual_cash,d1.annual_stock, 
CAST(((b.ltp - a.ltp) / a.ltp * 100) AS DECIMAL(10, 2)) as chng
FROM eod_stock AS a
LEFT OUTER JOIN eod_stock AS b
ON a.company_id = b.company_id
LEFT OUTER JOIN company AS c
ON c.ID = a.company_id
LEFT OUTER JOIN dividend_info AS d
ON c.ID = d.company_id AND d.interim_rec_date BETWEEN '$adate' AND '$bdate'
LEFT OUTER JOIN dividend_info AS d1
ON c.ID = d1.company_id AND d1.annual_rec_date BETWEEN '$adate' AND '$bdate'
WHERE a.entry_date = ('$adate')
AND b.entry_date = ('$bdate')
AND c.dsex IN (1);");
while($info = mysql_fetch_array($query)) {   
$res[] = array(
'id' => $info['code'],
'name' => $info['name'],
'begning_price' => $info['begning'],
'end_price' => $info['enddate'],
'capital_gain' => $info['chng'],
'interim_date' => render($info['interim_rec_date']),
'interim_cash' => render($info['interim_cash']),
'interim_stock' => render($info['interim_stock']),
'annual_date' => render($info['annual_rec_date']),
'annual_cash' => render($info['annual_cash']),
'annual_stock' => render($info['annual_stock']),
       );
}
echo json_encode($res);
}
function render($value){
    if($value === null){
        $value = '-';
    }
    return $value;
}
function mutualFund(){
	 $query = mysql_query("SELECT 
c.code,
c.name,
e.ltp,
m.navmv,
m.cost_price,
c.listing_year,
CAST(((e.ltp/m.navmv)) AS DECIMAL(10,2)) AS price_to_nav,
CAST(((m.navmv/m.cost_price))*100 AS DECIMAL(10,2)) AS nav_cost_price,
(SELECT MAX(entry_date) FROM mutual_fund_info ) AS cur_date,
(SELECT entry_date FROM mutual_fund_info WHERE entry_date = DATE_SUB(cur_date, INTERVAL 1 WEEK) LIMIT 1) as week_date,
FROM_UNIXTIME(e.entry_timestamp, '%h:%i') AS `time`
-- , e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
LEFT OUTER JOIN mutual_fund_info AS m
ON c.ID = m.company_id
WHERE e.company_id AND e.entry_date = (SELECT MAX(entry_date) FROM eod_stock)
AND m.entry_date =  (SELECT MAX(entry_date)FROM mutual_fund_info)
AND c.sector_id = 14") ;	
	 return $query;
}
// DSE Announcement
function getAnnouncement($search,$begdate,$enddate,$sectors) {
  
  $string = $search;
  $adate = $begdate;
  $bdate = $enddate;
  $sector = $sectors;

 foreach($sector as $sec) {

 	foreach($sec as $sid){

  	$sectid[] = $sid;
  	}

  }

   $sectorid = implode(',', $sectid);

$company_query = mysql_query("select code from company where sector_id in ($sectorid)");
while($info = mysql_fetch_array($company_query)) {

	$cname [] = $info['code'];
}  

$names = implode('|', $cname);

foreach($string as $str){

	foreach($str as $st){

		$newstring []= $st; 
	}

  	
  }

$niddle = implode('|', $newstring);

$query = mysql_query("SELECT 
News_ID,
News_Date,
News_Subject, 
News_Details  
FROM v_news 
WHERE News_Details REGEXP '$niddle $names'
AND News_DATE BETWEEN '$adate' AND '$bdate'");

while($info = mysql_fetch_array($query)) { 

if($info['News_Date']==date('Y-m-d')) {
  $news_date = date('H:i:s', strtotime($info['News_Date']));
} else {
    
  $news_date = date('Y-m-d',  strtotime($info['News_Date']));
} 

$parts = explode(':', $info['News_Details']);
$title = $parts[0];
$res[] = array(
'ndate' => $news_date,
'id' => $info['News_ID'],
'symbol' => $title,
'title' => $info['News_Subject'] . "&nbsp". $title,
 );
}
echo json_encode($res);
}

function getSector(){
$query = mysql_query("SELECT * FROM sector");
return $query;

}
/*SELECT c.code,c.name, a.ltp as begning, b.ltp as end, CAST(((b.ltp - a.ltp) / b.ltp * 100) AS DECIMAL(10, 2)) as chng
FROM eod_stock a
JOIN eod_stock b ON a.company_id = b.company_id
LEFT OUTER JOIN company AS c
ON c.ID = a.company_id
WHERE a.entry_date = "2013-09-24"
AND b.entry_date = "2013-09-25"
AND a.company_id IN (1, 2);
$ids = join("','", $galleries); $sql = "SELECT * FROM galleries WHERE id IN ('$ids')"; */

function weeklyTop() {

$query = mysql_query('SELECT 
c.code,
a.ycp AS open,
e.close AS close,
a.entry_date as adate,
e.entry_date as edate,
CAST(((e.close - a.ycp)/a.ycp)*100 AS DECIMAL(10,2)) AS changes
-- ,e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
LEFT JOIN eod_stock AS a
ON e.company_id = a.company_id AND a.entry_date = DATE("2014-12-21")
WHERE e.company_id AND e.entry_date = DATE("2014-12-24")
ORDER BY changes DESC
LIMIT 0,10');

return $query;
	
}

function weeklyBottom() {

$query = mysql_query('SELECT 
c.code,
a.ycp AS open,
e.close AS close,
a.entry_date as adate,
e.entry_date as edate,
CAST(((e.close - a.ycp)/a.ycp)*100 AS DECIMAL(10,2)) AS changes
-- ,e.*
FROM eod_stock AS e
LEFT OUTER JOIN company AS c
ON c.ID = e.company_id
LEFT JOIN eod_stock AS a
ON e.company_id = a.company_id AND a.entry_date = DATE("2014-12-21")
WHERE e.company_id AND e.entry_date = DATE("2014-12-24")
ORDER BY changes ASC
LIMIT 0,10');

return $query;
	
}
