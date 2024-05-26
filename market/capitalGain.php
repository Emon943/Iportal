<?php //include_once("cache.php")?>



<?php include_once("header.php"); ?>





<link rel="stylesheet" type="text/css" href="css/datepicker.css">



<script type="text/javascript" src="js/bootstrap-datepicker.js"></script> 



<script language="Javascript">







function SelectMoveRows(SS1,SS2)

{

    var SelID='';

    var SelText='';

    // Move rows from SS1 to SS2 from bottom to top

    for (i=SS1.options.length - 1; i>=0; i--)

    {

        if (SS1.options[i].selected == true)

        {

            SelID=SS1.options[i].value;

            SelText=SS1.options[i].text;

            var newRow = new Option(SelText,SelID);

            SS2.options[SS2.length]=newRow;

            SS1.options[i]=null;

        }

    }

    SelectSort(SS2);



}



function SelectSort(SelList)



{

    var ID='';

    var Text='';

    for (x=0; x < SelList.length - 1; x++)

    {

        for (y=x + 1; y < SelList.length; y++)

        {

            if (SelList[x].text > SelList[y].text)

            {

               // Swap rows

                ID=SelList[x].value;

                Text=SelList[x].text;

                SelList[x].value=SelList[y].value;

                SelList[x].text=SelList[y].text;

                SelList[y].value=ID;

                SelList[y].text=Text;

            }

        }

    }

}

</script>



<script type="text/javascript">

$(document).ready(function() {

   $('#result').click( function() {

function serealizeSelects (select) {

    var array = [];

    select.each(function(){ array.push($(this).val()) });

    return array;
}

var beg_date = $("#beg_date").val();
var end_date = $("#end_date").val();
var sel2 = $('.FeatureCodes');

  sel2.find('option').each(function(){

    $(this).attr('selected',true);

  }); 

var course_ids = serealizeSelects(sel2);


$.ajax({

    type: "POST",
    url: "ajax.php?function=com",
    data: {'id' : course_ids, 'beg_date' : beg_date, 'end_date' : end_date},
    dataType: "json",
    async: true,
	success:  function (data) {
              $("#capitalGain tbody").empty(tableRow);
         for(var i = 0; i<= data.length; i++){
                    var tableRow = "<tr class='gradeX'><td>" + data[i].id + "</td><td>" + data[i].name + "</td><td>" + data[i].begning_price + "</td><td>" + data[i].end_price + "</td><td>" + data[i].capital_gain + "</td><td>"
                    + data[i].interim_date + "</td><td>" + data[i].interim_stock + "</td><td>"+ data[i].interim_cash + "</td><td>"+ data[i].annual_date + "</td><td>"+ data[i].annual_stock + "</td><td>"+ data[i].annual_cash + "</td></tr>";
                    $("#capitalGain tbody").append(tableRow)
		 }
    			}
});

   })

   
$('#sector').click( function() {

 

  var sectorid = $('#sectorId').val();
  var beg_date = $("#beg_date").val();
  var end_date = $("#end_date").val();

$.ajax({

    type: "POST",
    url: "ajax.php?function=sect",
    data: {'sid' : sectorid, 'beg_date' : beg_date, 'end_date' : end_date},
    dataType: "json",
    async: true,
  success:  function (data) {

           $("#capitalGain tbody").empty(tableRow);
         for(var i = 0; i<= data.length; i++){
                    var tableRow = "<tr class='gradeX'><td>" + data[i].id + "</td><td>" + data[i].name + "</td><td>" + data[i].begning_price + "</td><td>" + data[i].end_price + "</td><td>" + data[i].capital_gain + "</td><td>"
                    + data[i].interim_date + "</td><td>" + data[i].interim_stock + "</td><td>"+ data[i].interim_cash + "</td><td>"+ data[i].annual_date + "</td><td>"+ data[i].annual_stock + "</td><td>"+ data[i].annual_cash + "</td></tr>";
                    $("#capitalGain tbody").append(tableRow)

//chart
$(function () {
        $('#closingpricechart').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Column chart with negative values'
            },
            xAxis: {
                categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'John',
                data: [5, 3, 4, 7, 2]
            }, {
                name: 'Jane',
                data: [2, -2, -3, 2, 1]
            }, {
                name: 'Joe',
                data: [3, 4, 4, -2, 5]
            }]
        });
    });

//close chart
     }
          }
});



});

$('#dsex').click( function() {

 

  var beg_date = $("#beg_date").val();
  var end_date = $("#end_date").val();

$.ajax({

    type: "POST",
    url: "ajax.php?function=dsex",
    data: {'beg_date' : beg_date, 'end_date' : end_date},
    dataType: "json",
    async: true,
  success:  function (data) {

           $("#capitalGain tbody").empty(tableRow);
         for(var i = 0; i<= data.length; i++){
                    var tableRow = "<tr class='gradeX'><td>" + data[i].id + "</td><td>" + data[i].name + "</td><td>" + data[i].begning_price + "</td><td>" + data[i].end_price + "</td><td>" + data[i].capital_gain + "</td><td>"
                    + data[i].interim_date + "</td><td>" + data[i].interim_stock + "</td><td>"+ data[i].interim_cash + "</td><td>"+ data[i].annual_date + "</td><td>"+ data[i].annual_stock + "</td><td>"+ data[i].annual_cash + "</td></tr>";
                    $("#capitalGain tbody").append(tableRow)
     }
          }
});



});
  

});





</script>



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



<div class="panel-group full-width" id="accordion">



<div class="panel panel-default">



  <div class="panel-heading">



    <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Capital Gain By Company </a><i class="glyphicon glyphicon-chevron-up pull-right"></i> </h4>



  </div>



  <div id="collapseOne" class="panel-collapse collapse in">



    <div class="panel-body">



      <div class="row">



        <div class="col-xs-4">



          <div class="form-group">



            <label class="control-label">From:</label>



            <div class="input-group date" id="dp3" data-date-format="dd-mm-yyyy">



              <input class="form-control" type="text" name ="beg_date" id = "beg_date">



              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> </div>



          </div>



        </div>



        <div class="col-xs-1">&nbsp;</div>



        <div class="col-xs-4">



          <div class="form-group">



            <label class="control-label">To:</label>



            <div class="input-group date" id="dp4"  data-date-format="dd-mm-yyyy">



              <input class="form-control" type="text" name = "end_date" id = "end_date">



              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> </div>



          </div>



        </div>



      </div>



      <div class="row">



        <div class="col-xs-9">



          <p>Select Companies</p>



          <form name="Example" class="example" method="post">



            <table border="0" cellpadding="3" cellspacing="0">



              <tr>



                <td><select name="Features" size="9" id="company" MULTIPLE>



                    <?php $query = companyDropDown(); while($info = mysql_fetch_array($query)) {?>



                    <option value="<?php echo $info['cid']; ?>"><?php echo $info['code'] ?></option>



                    <?php } ?>



                  </select></td>



                <td><input type="Button" value="Add >>" style="width:89px" onClick="SelectMoveRows(document.Example.Features,document.Example.FeatureCodes)">



                  <br>



                  <br>



                  <input type="Button" value="<< Remove" style="width:89px" onClick="SelectMoveRows(document.Example.FeatureCodes,document.Example.Features)"></td>



                <td><select name="FeatureCodes[]"  class="FeatureCodes" id = "FeatureCodes" size="9" MULTIPLE>



                  </select></td>



              </tr>



            </table><br/>



            <p class="pull-right"><button type="button" class="btn-sm btn-info" id="result">Show Results</button></p>



          </form>



        </div>



      </div>



    </div>



  </div>



</div>



<div class="panel panel-default">



  <div class="panel-heading">



    <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"> Capital Gain By Sector </a><i class="glyphicon glyphicon-chevron-down pull-right"></i> </h4>



  </div>



  <div id="collapseTwo" class="panel-collapse collapse">



    <div class="panel-body"> 

      <div class="row">



        <div class="col-xs-4">



          <div class="form-group">



            <label class="control-label">From:</label>



            <div class="input-group date" id="dp3" data-date-format="dd-mm-yyyy">



              <input class="form-control" type="text" name ="beg_date" id = "beg_date">



              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> </div>



          </div>



        </div>



        <div class="col-xs-1">&nbsp;</div>



        <div class="col-xs-4">



          <div class="form-group">



            <label class="control-label">To:</label>



            <div class="input-group date" id="dp4"  data-date-format="dd-mm-yyyy">



              <input class="form-control" type="text" name = "end_date" id = "end_date">



              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> </div>



          </div>



        </div>



      </div><!--date close-->

<div class="row">



        <div class="col-xs-9">



          <p>Select Sector</p>
          <form name ="sector" action = "post">
            <select name='sectorID' id='sectorId'>
          <?php $query = sectorDropDown(); while($info = mysql_fetch_array($query)) {?>
           <option value="<?php echo $info['sector_ID']; ?>"><?php echo $info['name'] ?></option>
          <?php } ?>
        </select>

        <p class="pull-right"><button type="button" class="btn-sm btn-info" id="sector">Show Results</button></p>
        </form>



        </div>
      </div>

  </div>



</div>



<div class="panel panel-default">



  <div class="panel-heading">



    <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"> Capital Gain For DSE X Listed Companies </a><i class="glyphicon glyphicon-chevron-down pull-right"></i> </h4>



  </div>



  <div id="collapseThree" class="panel-collapse collapse">



    <div class="panel-body"> 

      <div class="row">



        <div class="col-xs-4">



          <div class="form-group">



            <label class="control-label">From:</label>



            <div class="input-group date" id="dp3" data-date-format="dd-mm-yyyy">



              <input class="form-control" type="text" name ="beg_date" id = "beg_date">



              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> </div>



          </div>



        </div>



        <div class="col-xs-1">&nbsp;</div>



        <div class="col-xs-4">



          <div class="form-group">



            <label class="control-label">To:</label>



            <div class="input-group date" id="dp4"  data-date-format="dd-mm-yyyy">



              <input class="form-control" type="text" name = "end_date" id = "end_date">



              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> </div>



          </div>



        </div>



      </div><!--date close-->
        <p class="pull-right"><button type="button" class="btn-sm btn-info" id="dsex">Show Results</button></p>

  </div>
</div>


  <div class="row">



    <div class="col-md-12 styled-tab">



      <ul class="nav nav-tabs">



        <li class="active"><a href="#tables" data-toggle="tab">Show in Table</a></li>



        <li><a href="#profile" data-toggle="tab">Show in Chart</a></li>



      </ul>



      



      <!-- Tab panes -->



      



      <div class="tab-content">



        <div class="tab-pane active" id="tables">



          <div class="tabbed-padding">



            <div class="table-responsive">



              <table cellpadding="0" cellspacing="0" border="0" class="display table-bordered table-striped table" id="capitalGain">



                <thead>



                  <tr>



                    <th rowspan="3">Symbol</th>



                    <th rowspan="3">Company Name</th>



                    <th rowspan="3">Begning Price</th>



                    <th rowspan="3">End Price</th>



                    <th rowspan="3">Capital Gain %</th>

                    <th class='center' colspan="6">Declaration</th>

                  



                  </tr>



                  <tr>



                    <th colspan="3" class="center">Interim</th>



                    <th colspan="3" class="center">Final</th>



                  </tr>

                  <tr>

<th colspan="1">Date</th>

                    <th>Stock</th>



                    <th>Cash</th><th colspan="1">Date</th>

                    <th>Stock</th>



                    <th>Cash</th>



                  </tr>



                </thead>



                <tbody>



              </tbody>



               <!-- <tfoot>



                  <tr>



                    <th rowspan="2">Symbol</th>



                    <th rowspan="2">Company Name</th>



                    <th rowspan="2">Begning Price</th>



                    <th rowspan="2">End Price</th>



                    <th rowspan="2">Capital Gain</th>



                    <th rowspan="2">Declaration Date</th>



                    <th class='center' colspan="2">Declaration</th>



                  </tr>



                  <tr>



                    <th>Stock</th>



                    <th>Cash</th>



                  </tr>



                </tfoot>-->



              </table>



            </div>



          </div>



        </div>



        <div class="tab-pane" id="profile">



          <div class="tabbed-padding">



            <ul class="nav nav-pills nav-justified">



              <li class="active"><a href="#secondaryprice" data-toggle="tab">Capital Gain</a></li>



              <li><a href="#secondaryvolume" data-toggle="tab">Divident Yeild</a></li>



              <li><a href="#secondaryvalue" data-toggle="tab">Divident Payout Ratio</a></li>



              <li><a href="#secondarytrades" data-toggle="tab">Declaration</a></li>



            </ul>



            <div class="tab-content">



              <div class="tab-pane active" id="secondaryprice">



                <div class="tabbed-padding">



                  <div id="closingpricechart" style="height:800px; min-width:700px; margin:0 auto"></div>



                </div>



              </div>



              <div class="tab-pane" id="secondaryvolume">



                <div class="tabbed-padding">



                  <div id="closingvolumechart" style="height: 600px"></div>



                </div>



              </div>



              <div class="tab-pane" id="secondaryvalue">



                <div class="tabbed-padding">



                  <div id="closingvaluechart" style="height: 600px"></div>



                </div>



              </div>



              <div class="tab-pane" id="secondarytrades">



                <div class="tabbed-padding">



                  <div id="companytradechart" style="height: 600px"></div>



                </div>



              </div>



              <div class="tab-pane" id="secondarychange">



                <div class="tabbed-padding">



                  <div id="companychagechart" style="height: 600px"></div>



                </div>



              </div>



            </div>



          </div>



        </div>



      </div>

      

     <script type="text/javascript">

	 

	 $(document).ready(function() {

    $('#example').dataTable( {

        "bProcessing": true,

        "sAjaxSource": 'response'

    } );

    $('#dp3').datepicker({

    startDate: "24/09/2013",

    

    orientation: "bottom auto",

    autoclose: true

    });

  $(".input-group.date").datepicker({ autoclose: true, //todayHighlight: true

    startDate: "24/09/2013",
  orientation: "bottom auto",


  });

  $('#dp4').datepicker({

   

    

    

    autoclose: true

    });


} );



</script>

      <?php include_once("footer.php"); ?>



<?php //include_once("cache_footer.php"); ?>