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

              <li><a href="#">Corporate Actions</a></li>

              <li><a href="#">Events</a></li>

              <li><a href="#">Corporate Event Calender</a></li>

              <li><a href="announcement.php">Announcement</a></li>

              <li><a href="#">News Chart</a></li>

              

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

            

            <!-- Building News Category: -->
<select class="multiselect" multiple="multiple">
<option value="dividend">Dividend News</option>
<option value="agm">AGM News</option>
<option value="egm">EGM News</option>
<option value="right">Right Share News</option>
<option value="Board of Director">Directors News</option>
<option value="quarterly">Quarterly Earnings</option>
<option value="half yearly">Half Yearly Report</option>
<option value="record date">Record Date</option>
<option value="Sponsor/Director">Sponsors Buy & Sell</option>
<option value="new company">New Company Listing</option>
<option value="BSEC">BSEC News</option>
<option value="cdbl">CDBL News</option>
<option value="DSE NEWS">DSE News</option>
<option value="pepperoni">Board Meeting</option>
<option value="Inquiry">DSE Query</option>
<option value="Spot market">Spot Market Trading</option>
<option value="credit">Credit Rating</option>
<option value="purchase">Fixed Asset Acquisition</option>
<option value="Mutual Fund">Mutual Fund NAV</option>
<option value="Bond">Bond Issue</option>
<option value="other">Other News</option>

</select><br>
 <!-- Building News Category: -->
<select class="sector" multiple="multiple">
<?php $query = getSector(); while($info = mysql_fetch_array($query)) {?>
<option value="<?php echo $info['sector_ID']; ?>"><?php echo $info['name']; ?></option>
<?php } ?>
</select><br>
<p class="pull-right"><button type="button" class="btn-sm btn-info" id="result">Show Results</button></p>
          </div>

        </div>

      </div>

      <table cellpadding="0" cellspacing="0" border="0" class="display table-bordered table-striped table" id="example">

                    <thead>

                      <tr>

                        <th>Date</th>
                        <th>Symbol</th>

                        <th>News Title</th>

                      </tr>

                    </thead>

                    <tbody>

                      <tr class="gradeX">


                    </tbody>
                  </table>

    </div>
 

<!-- Initialize the plugin: -->
<script type="text/javascript">
$(document).ready(function() {
$('.multiselect').multiselect({


    selectAllValue: 'multiselect-all',
    enableCaseInsensitiveFiltering: true,
    enableFiltering: true,
    maxHeight: '300',
    buttonWidth: '235',
    includeSelectAllOption: true,
    onChange: function(element, checked) {
        var brands = $('.multiselect option:selected');
        selected = [];
        $(brands).each(function(index, brand){
            selected.push([$(this).val()]);
        });
      }

       
   
});
$('.sector').multiselect({


    selectAllValue: 'multiselect-all',
    enableCaseInsensitiveFiltering: true,
    enableFiltering: true,
    maxHeight: '300',
    buttonWidth: '235',
    includeSelectAllOption: true,
    onChange: function(element, checked) {
        var brands = $('.sector option:selected');
        sectors = [];
        $(brands).each(function(index, brand){
            sectors.push([$(this).val()]);
        });
      }

       
   
});
$('#result').click(function() {
           console.log(sectors);

var beg_date = $("#beg_date").val();
var end_date = $("#end_date").val();

$.ajax({
 
    type: "POST",
    url: "ajax.php?function=announcement",
    data: {'search' : selected, 'beg_date' : beg_date, 'end_date' : end_date, 'sectors' : sectors},
    dataType: "json",
    async: true,
   success: function (data) {

           $("#example tbody").empty(tableRow);
         for(var i = 0; i<= data.length; i++){
                    var tableRow = "<tr class='gradeX'><td>" + data[i].ndate + "</td><td>"+ data[i].symbol + "</td><td><a href='announcementDetails.php?id=" + data[i].id + "'target ='_blank'>"+ data[i].title + "</a></td></tr>";
                    $("#example tbody").append(tableRow)
     }
          }

});
  
});


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


});
</script>

<?php include_once("footer.php"); ?>