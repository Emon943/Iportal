<?php include("functions.php"); 



?>
<html>
<head>


	</head>
	<body>
<script type="text/javascript" src="/iportal/market/contest/js/jquery.min.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="/js/flot/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="/iportal/market/contest/js/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="/iportal/market/contest/js/flot/jquery.flot.time.js"></script>    
<script type="text/javascript" src="/iportal/market/contest/js/flot/jshashtable-2.1.js"></script>    
<script type="text/javascript" src="/iportal/market/contest/js/flot/jquery.numberformatter-1.2.3.min.js"></script>
<script type="text/javascript" src="/iportal/market/contest/js/flot/jquery.flot.symbol.js"></script>
<script type="text/javascript" src="/iportal/market/contest/js/flot/jquery.flot.axislabels.js"></script>
<script>
//******* 
//temp
 
var data1 = [
<?php
$query = mysql_query("SELECT entry_date, total_volume FROM eod_stock WHERE company_id = 106");
while($info = mysql_fetch_array($query)) {

	

	$entry_date =  $info['entry_date'];

	$floatDate = date('Y,n,j', strtotime($entry_date));

	$tmp_vol[]= '[gd('.$floatDate. '),' .$info['total_volume'] . ']';

}

echo implode(',',$tmp_vol);

?>];



var data2 = [
<?php
$query = mysql_query("SELECT entry_date, ltp FROM eod_stock WHERE company_id = 106");
while($info = mysql_fetch_array($query)) {

	

	$entry_date =  $info['entry_date'];

	$floatDate = date('Y,n,j', strtotime($entry_date));

	$tmp_arr[] =  '[gd('.$floatDate. '),' .$info['ltp'] . ']';


}
	echo implode(',',$tmp_arr);

?>];



var dataset = [
    {
        label: "Volume",
        data: data1,         
        color: "#756600",
        bars: {
            show: true, 
            align: "center",
            barWidth: 24 * 60 * 60 * 600,
            lineWidth:1
        }
    }, {
        label: "Price",
        data: data2,
        yaxis: 2,
        color: "#0062FF",
        //points: { symbol: "triangle", fillColor: "#0062FF", show: true },
        lines: {show:true}
    }, 
];

    
var options = {
    xaxis: {
        mode: "time",
        tickSize: [3, "day"],        
        tickLength: 0,
        axisLabel: "Date",
        axisLabelUseCanvas: true,
        axisLabelFontSizePixels: 12,
        axisLabelFontFamily: 'Verdana, Arial',
        axisLabelPadding: 10,
        color: "black"
    },
    yaxes: [{
            position: "left",
            max: 1070,
            color: "black",
            axisLabel: "Volume",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 3            
        }, {
            position: "right",
            clolor: "black",
            axisLabel: "Price",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 3            
        },
    ],
    legend: {
        noColumns: 1,
        labelBoxBorderColor: "#000000",
        position: "nw"        
    },
    grid: {
        hoverable: true,
        borderWidth: 3,        
        backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
    }
};

$(document).ready(function () {
    $.plot($("#flot-placeholder"), dataset, options);
    $("#flot-placeholder").UseTooltip();
});




function gd(year, month, day) {
    return new Date(year, month - 1, day).getTime();
}

var previousPoint = null, previousLabel = null;

$.fn.UseTooltip = function () {
    $(this).bind("plothover", function (event, pos, item) {
        if (item) {
            if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                previousPoint = item.dataIndex;
                previousLabel = item.series.label;
                $("#tooltip").remove();
                //console.log(item.datapoint);
                var x = item.datapoint[0];
                var y = item.datapoint[1];

                var color = item.series.color;
                var date = "Jan " + new Date(x).getDate();

                //console.log(item);
                var unit = "";

                if (item.series.label == "Sea Level Pressure") {
                    unit = "hPa";
                } else if (item.series.label == "Wind Speed") {
                    unit = "km/hr";
                } 

                showTooltip(item.pageX, item.pageY, color,
                            "<strong>" + item.series.label + "</strong><br>" + date +
                            " : <strong>" + y + "</strong> " + unit + "");
            }
        } else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
};

function showTooltip(x, y, color, contents) {
    $('<div id="tooltip">' + contents + '</div>').css({
        position: 'absolute',
        display: 'none',
        top: y - 40,
        left: x - 120,
        border: '2px solid ' + color,
        padding: '3px',
        'font-size': '9px',
        'border-radius': '5px',
        'background-color': '#fff',
        'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
        opacity: 0.9
    }).appendTo("body").fadeIn(200);
}




</script>
<!-- HTML -->
<div id="flot-placeholder" style="width:550px;height:300px;margin:0 auto"></div>		
	</body>
	</html>