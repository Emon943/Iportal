<html>
<head><title>Contest Admin</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="css/custom.css">

<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</head>

<body>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
    
       
       	<form role="form" name="contest" id="contest" method="post">
            <div class="form-group">
				<label for="contest name">Contest Name:</label>
   				 <input type="text" class="form-control" id="name" name="name" placeholder="Enter Contest Name">
 			 </div>
 			 <div class="form-group">
 			 	<label>Contest Amount</label>
 			 	<input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Contest Amount">

 			 </div>


 			 <div class="form-group">
 			 	<label>Start Date</label>
                <div class='input-group date' id='start_date' data-date-format="YYYY-MM-DD">
                    <input type='text' class="form-control" name="start_date" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
       
        
            <div class="form-group">
            	<label>End  Date</label>
                <div class='input-group date' id='end_date' data-date-format="YYYY-MM-DD">
                    <input type='text' class="form-control" name="end_date" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>

            <div class="form-group">
 			 	<label>Contest Type</label>
 			 	<select class="form-control" id="type" name="type">
 			 		<option value="1">General</option>
 			 		<option value="2">University</option>
 			 	</select>
 			 </div>

 			 <div class="form-group">
 			 	<label>Access</label>
 			 	<select class="form-control" id="access" name="access">
 			 		<option value="1">Public</option>
 			 		<option value="2">Private</option>
 			 	</select>
 			 </div>

 			 <div class="form-group">
				<label for="contest name">Created By:</label>
   				 <input type="text" class="form-control" id="created_by" name="created_by" placeholder="Enter Name"><br>
   				 <input type="button" class="btn btn-success"   id="submit" value="Create">
   				</form>
 			 </div>
 			</div>
 		</div>
 	</div>
</div>
        
  
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
        $(function () {
            $('#start_date').datetimepicker();
            $('#end_date').datetimepicker();
            $("#start_date").on("dp.change",function (e) {
               $('#end_date').data("DateTimePicker").setMinDate(e.date);
            });
            $("#end_date").on("dp.change",function (e) {
               $('#start_date').data("DateTimePicker").setMaxDate(e.date);
            });
        });


    $("#submit").click(function(){
	var form = $("#contest");

	console.log($("form").serialize());

	alert(form.serialize());
    $.ajax({

         type: "POST",
         url: "process.php",
         data: form.serialize(),
         dataType: "json",
		 async: false,
		 success: function(data){

		 }
});

        });
    });
    </script>

</body>
</html>