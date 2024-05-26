    </div>

    <!--main column end for body---> 

  </div>

  <!--body end--> 

</div>

<script type="text/javascript">

/*$(document).ready(function() {

				$('#example').dataTable({

					"aaSorting": [[ 1, "ASC" ]],

					"bPaginate": false

				});*/

				

		$(document).ready(function(){    

    $('#accordion .panel-collapse').on('shown.bs.collapse', function () {

       $(".glyphicon-chevron-down").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");

    });



    $('#accordion .panel-collapse').on('hidden.bs.collapse', function () {

       $(".glyphicon-chevron-up").removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");

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

	

	

	



</script>

<script src="js/bootstrap.min.js"></script>

<script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>

</body>

</html>