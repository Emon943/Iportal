<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5118158701703492"
     crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="google-adsense-account" content="ca-pub-5118158701703492">
<title>Home</title>
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
var d = new Date();
var strDate = d.getDate() + "/" + (d.getMonth()+1) + "/" + d.getFullYear();


$(function () {
        $('#container').highcharts({
            chart: {
                type: 'column',
				height: 400
            },
            title: {
                text: 'Todays Sector Up/Down Ratio' 
            },
            xAxis: {
                categories: ['Bank', 'Engineering', 'Food & Allied', 'Fuel & Power', 'Jute','Textile','Pharmaceuticals','Paper & Printing','Serv. & R. Estate', 'Cement','Miscellaneous','Insurance','NBFI','IT Sector','Travel & Leisure','Ceramics','Mutual Funds','Tannery','Telecom'],
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
                
            },
            yAxis: {
                min: 0,
                labels:
			{
 	        enabled: false
		},
                title: {
                    text: strDate
                },
                stackLabels: {
                    enabled: true,
					style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'left',
                x: 20,
                verticalAlign: 'top',
                y: 20,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>'+
                        'Total: '+ this.point.stackTotal;
                }
            },
            plotOptions: {
				 series: {
                minPointLength:15,
				borderColor: '#f2f2f2',
				borderWidth: 2,
				shadow: true
            },
                column: {
                    stacking: 'normal',
					 pointPadding: 0.1,
					 dataLabels: {
                        enabled: false,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
						verticalAlign: 'top'
						
                    }
				
                }
				
            },
            credits: {
    enabled: false
  },
            series: [{
                name: 'Positive Return',
                data: [15, 20, 14, 7, 1, 20,15,1,2,5,4,20,15,2,2,3,35,2,2],
				color: '#008000',
            }, {
                name: '0 Return',
                data: [5, 2, 2, 3, 1, 9,8,0,1,1,3,5,5,2,0,1,5,3,0],
				color: '#1F497D',
            }, {
                name: 'Negetive Return',
                data: [10, 5, 1 , 5, 1, 3,2,0,1,1,2,21,3,2,1,1,3,0,0],
				color: '#F40909',
            }]
        });
    });
var data = [3.5, 4.2, 11.5, 5.2, -0.051, -2.5, -4.25, 5, 5, 6.6, 3.3, 5.2,12.5,4.2,1.5,2.5,3.5,3.6,4.9,7.8];
var dataSum = 0;
for (var i=0;i < data.length;i++) {
    dataSum += data[i]
}
$(function () {
    $('#sector').highcharts({
        chart: {
            type: 'column',
			
        },
   title: {
                text: 'Todays Sector Performance' 
            },
        xAxis: {
          
		       categories: ['Bank', 'Engineering','DSEX', 'Food & Allied', 'Fuel & Power', 'Jute','Textile','Pharmaceuticals','Paper & Printing','Serv. & R. Estate', 'Cement','Miscellaneous','Insurance','NBFI','IT Sector','Travel & Leisure','Ceramics','Mutual Funds','Tannery','Telecom'],
			   labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
        },
        
        plotOptions: {
            series: {
                minPointLength: 8,
				borderColor: '#f2f2f2',
				borderWidth: 2,
				shadow: true
            }
        },
		credits: {
    enabled: false
  },
  legend: {
	  enabled: false
  },
        
        column: { dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
						verticalAlign: 'top'
						
                    }
				
                },
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
    series: [{
			name: 'Index Changes',
            data: [-5.2,-4.2,-3.5,-1.5,0.051,1.5,2.5,2.5,3.3,3.5,3.6,4.2,4.25,4.9,5,5,5.2,6.6,7.8,12.5],
			color: '#008000',
			negativeColor: '#FF0000'
       }]
    });
});  

//closing price
$(function () {
        $('#closingpricechart').highcharts({
            chart: {
                type: 'column',
               
            },
            title: {
                text: 'Fuel & Power Industry'
            },
            xAxis: {
                categories: [
                    'BDWELDING','BEDL','DESCO','EASTRNLUB','GBBPOWER','JAMUNAOIL','KPCL','LINDEBD','MJLBD','MPETROLEUM','PADMAOIL','POWERGRID',
'SPPCL','SUMITPOWER','TITASGAS'],
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            plotOptions: {
            series: {
               			minPointLength: 8,
				borderColor: '#f2f2f2',
				borderWidth: 2,
				shadow: true,
            }
        },
        credits: {
    			enabled: false
  	},
            yAxis: {
                min: 0,
                title: {
                    text: 'Index Movers (Positive)'
                }
            },
            legend: {
                enabled: false
            },
            column: { dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
						verticalAlign: 'top'
						
                    }
				
                },
            series: [{
                name: 'Closing Price',
                data: [23.4,33.7,57.1,318.0,29.9,89.4,48.6,617.8,75.2,206.1,251.1,52.8,60.9,38.1,73.0],
                color: '#008000',
            }]
        });
    });
    //closing Volume
$(function () {
        $('#closingvolumechart').highcharts({
            chart: {
                type: 'column',
               
            },
            title: {
                text: 'Fuel & Power Industry'
            },
            xAxis: {
                categories: [
                    'BDWELDING','BEDL','DESCO','EASTRNLUB','GBBPOWER','JAMUNAOIL','KPCL','LINDEBD','MJLBD','MPETROLEUM','PADMAOIL','POWERGRID',
'SPPCL','SUMITPOWER','TITASGAS'],
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            plotOptions: {
            series: {
               			minPointLength: 8,
				borderColor: '#f2f2f2',
				borderWidth: 2,
				shadow: true,
            }
        },
        credits: {
    			enabled: false
  	},
            yAxis: {
                min: 0,
                title: {
                    text: 'Volume'
                }
            },
            legend: {
                enabled: false
            },
            column: { dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
						verticalAlign: 'top'
						
                    }
				
                },
            series: [{
                name: 'Volume',
                data: [37000,104200,1000,15000,74600,75140,55000,78000,52141,25412,98222,78470,51000,14784,1500,],
                color: '#008000',
            }]
        });
    });
     //closing Trade
$(function () {
        $('#companytradechart').highcharts({
            chart: {
                type: 'column',
               
            },
            title: {
                text: 'Fuel & Power Industry'
            },
            xAxis: {
                categories: [
                    'BDWELDING','BEDL','DESCO','EASTRNLUB','GBBPOWER','JAMUNAOIL','KPCL','LINDEBD','MJLBD','MPETROLEUM','PADMAOIL','POWERGRID',
'SPPCL','SUMITPOWER','TITASGAS'],
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            plotOptions: {
            series: {
               			minPointLength: 8,
				borderColor: '#f2f2f2',
				borderWidth: 2,
				shadow: true,
            }
        },
        credits: {
    			enabled: false
  	},
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Trade'
                }
            },
            legend: {
                enabled: false
            },
            column: { dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
						verticalAlign: 'top'
						
                    }
				
                },
            series: [{
                name: 'Trade',
                data: [89,120,510,451,650,1254,784,1547,12,450,1254,410,698,145,125],
                color: '#008000',
            }]
        });
    });
/// Chnage chart
var data = [-3.5, 4.2, 1.5, 5.2, -0.051, -2.5, -4.25, 5, 5, 6.6, 3.3, 5.2,12.5,-2.2,1.2];
var dataSum = 0;
for (var i=0;i < data.length;i++) {
    dataSum += data[i]
}    
    $(function () {
    $('#companychagechart').highcharts({
        chart: {
            type: 'column',
			
        },
   title: {
                text: 'Index Movers (Negetive)' 
            },
        xAxis: {
          
		       categories: ['1JANATAMF','BAYLEASING','DHAKABANK','HAKKANIPUL','FUWANGFOOD','GLOBALINS','ICB','ICBIBANK','INTECH','ISLAMICFIN','NCCBANK','ORIONPHARM',
'PRAGATIINS','PRIMEBANK','PRIMETEX'],
			   labels: {
                    rotation: -90,
                    align: 'right',
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
        },
        
        plotOptions: {
            series: {
                minPointLength: 8,
				borderColor: '#f2f2f2',
				borderWidth: 2,
				shadow: true
            }
        },
		credits: {
    enabled: false
  },
  legend: {
	  enabled: false
  },
        
        column: { dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
						verticalAlign: 'top'
						
                    }
				
                },
        yAxis:{
        
        labels: {
            formatter:function() {
                var pcnt = (this.value / dataSum) * 100;
                return Highcharts.numberFormat(pcnt,0,',') + '%';
            },
		}
    },
    series: [{
			name: 'Price Changes',
            data: [-0.052,-1.1,-2,-2.3,-3.1,-3.2,-3.9,-4.5,-5,-5.1],
			color: '#008000',
			negativeColor: '#FF0000'
       }]
    });
}); 
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
});</script>
</head>

<body>
<div class="container"> 
  
  <!---header start----->
  <div class="row">
    <div class="col-md-2">
      <h1>iPortal</h1>
    </div>
    <div class="col-md-4">
    <form class="form-inline" role="form">
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label class="sr-only" for="exampleInputPassword2">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox"> Remember me
    </label>
  </div><br/>
  <button type="submit" class="btn btn-default btn-xs pull-right">Sign in</button>
</form>

    </div>

    <div class="col-md-6 placeholder">
      <h2 class="label label-default">ad space</h2>
    </div>
  </div>
  <?php
$file = file_get_contents('http://dsebd.org'); 
 
libxml_use_internal_errors(true); //Prevents Warnings, remove if desired
$dom = new DOMDocument();
$dom->loadHTML($file);
$node = $dom->getElementById("mq2");
$output = $dom->saveHTML($node);


		
?>
  <div class="row">
    
  
 <!-- <div class="row">
    <div class="navbar navbar-default yamm">
      <div class="navbar-header">
        <button class="navbar-toggle" data-target="#navbar-collapse-1" data-toggle="collapse" type="button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      </div>
      <div class="navbar-collapse collapse" id="navbar-collapse-grid">
        <ul class="nav navbar-nav">
          
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
  </div>-->
  <!--static sidebar menu---->
    <div class="col-md-2">
      <div class="sidebar-menu click-nav">
        <ul class="no-js">
          <li class="haschild clicker"><a href="#">Today's Market<span class="glyphicon glyphicon-chevron-down"></span></a>
          		<ul>
                <li><a href="#">Stock Market</a></li>
                <li><a href="#">Money Market</a></li>
                <li><a href="#">Commodity</a></li>
                <li><a href="#">Bonds</a></li>
                <li><a href="#">Currency</a></li>
                <li><a href="#">Economic Indicators</a></li>
                <li><a href="#">Global Capital Market</a></li>
               </ul>
          </li>
          <li><a href="sectorIndex.php">Company Fundamentals and Change</a></li>
          <li><a href="#">All financial News and Reports</a></li>
          <li><a href="#">Company Financials</a></li>
          <li><a href="#">Dummy Trading and VAS</a></li>
          <li><a href="#">Blog and Resources</a></li>
          <li><a href="#">Financial Job Portal</a></li>
        </ul>
      </div>
    </div>
    
    
 
   
    
    <div class="col-md-10">
    <div class="row">
   
    <div class="col-md-5"> <p>
  <button type="button" class="btn btn-primary btn-sm">Stock Depth</button>
  <button type="button" class="btn btn-default btn-sm">Call :</button>
</p> 
<p>
  <button type="button" class="btn btn-primary btn-sm">How To Use</button>
  <button type="button" class="btn btn-default btn-sm">RSS Feed:</button>
</p> 
<p>
  <button type="button" class="btn btn-primary btn-sm">Dummy Trading</button>
  <button type="button" class="btn btn-default btn-sm">Free Subscribe</button>
</p> 
</div>
    
    <div class="col-md-5  placeholder"> <?php echo $output; ?> </div>
       
          
        </div>
        <div class="row">
        <div class="col-md-12 " style="border:1px solid #ccc">
        <p>placeholder for big chart</p>
        </div>
        
      </div>
      <div class="row">
      <div class="col-md-12"><h3 class="text-center">Recent Nespaper News and DSE Articles</h3></div>
        <div class="col-md-5 right " style="border:1px solid #ccc">
          <!--<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">-->
          
          business and economy</div>
        
        <div class="col-md-5 col-md-offset-1 left" style="border:1px solid #ccc">
         <!--<div id="sector" style="height: 400px">-->global market</div>
       
       </div>
       <div class="row">
     
        <div class="col-md-5 right" style="border:1px solid #ccc">
          <!--<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">-->
          
          capital market</div>
        
        
        <div class="col-md-5 col-md-offset-1 left" style="border:1px solid #ccc">
         <!--<div id="sector" style="height: 400px">-->announcement</div>
        
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
            <th>Date</th>
            <th>CSE Price</th>
            <th>CSE Volume</th>
            
		</tr>
	</thead>
	<tbody>
		<tr class="gradeX">
			<td><a href="" title="" target="_blank">GOLDENSON</a></td>
			<td class="center">GOLDEN SON LIMITED</td>
			<td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
            
		</tr>
		<tr class="gradeC">
			<td><a href="" title="" target="_blank">ARGONDENIM</a></td>
			<td>ARGON DENIMS LIMITED</td>
			<td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
		</tr>
		<tr class="gradeA">
			<td><a href="" title="" target="_blank">APOLOISPAT</a></td>
			<td>APPOLLO ISPAT COMPLEX LIMITED</td>
		    <td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
		</tr>
		<tr class="gradeA">
			<td><a href="" title="" target="_blank">RNSPIN</a></td>
			<td>R.N. SPINNING MILLS LIMITED</td>
		    <td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
		</tr>
		<tr class="gradeA">
			<td><a href="" title="" target="_blank">BAYLEASING</a></td>
			<td>BAY LEASING & INVESTMENT LIMITED</td>
		    <td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
		<tr class="gradeA">
			<td><a href="" title="" target="_blank">NATLIFEINS</a></td>
			<td>NATIONAL LIFE INSURANCE</td>
			    <td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
		</tr>
		<tr class="gradeA">
			<td><a href="" title="" target="_blank">GENNEXT</a></td>
			<td>GENERATION NEXT FASHIONS LIMITED</td>
		    <td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
		</tr>
		<tr class="gradeA">
			<td><a href="" title="" target="_blank">LANKABAFIN</a></td>
			<td>LANKABANGLA FINANCE LTD</td>
		    <td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
		<tr class="gradeA">
			<td><a href="" title="" target="_blank">PLFSL</a></td>
			<td>PEOPLES LEASING AND FIN. SERVICES LTD.</td>
		    <td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
		<tr class="gradeA">
			<td><a href="" title="" target="_blank">DELTALIFE</a></td>
			<td>DELTA LIFE INSURANCE</td>
		    <td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
		</tr>
		<tr class="gradeA">
			<td><a href="" title="" target="_blank">Gecko</a></td>
			<td>Camino 1.0</td>
		    <td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
		</tr>
		<tr class="gradeA">
			<td>Gecko</td>
			<td>Camino 1.5</td>
            <td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
		</tr>
		<tr class="gradeA">
			<td>Gecko</td>
			<td>Netscape 7.2</td>
		    <td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
		</tr>
		<tr class="gradeA">
			<td>Gecko</td>
			<td>Netscape Browser 8</td>
		    <td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
		</tr>
		<tr class="gradeA">
			<td>Gecko</td>
			<td>Netscape Navigator 9</td>
	        <td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
		</tr>
		<tr class="gradeA">
			<td>Gecko</td>
			<td>Mozilla 1.0</td>
		    <td>63.8</td>
			<td class="center">2,549,500 </td>
			<td class="center">1,733</td>
            <td class="center">2.57%</td>
            <td class="center">64.9</td>
            <td class="center">61.1</td>
            <td class="center">29-Dec-2013</td>
            <td class="center">63.8</td>
            <td class="center">281,257.00</td>
		</tr>
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
		></tr>
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
                 <div class="tabbed-padding">
                 <div id="closingpricechart" style="height: 400px"></div>
                 </div>
                 </div>
                 
                 <div class="tab-pane" id="secondaryvolume">
                <div class="tabbed-padding">
                  <div id="closingvolumechart" style="height: 400px"></div>
                </div>
                 </div>
                 
                 <div class="tab-pane" id="secondaryvalue">
                <div class="tabbed-padding">
                 this is the secondary value
                </div>
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
    </div>
    <!--main column end for body---> 
  </div>
  <!--body end---> 
</div>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
</body>
</html>
