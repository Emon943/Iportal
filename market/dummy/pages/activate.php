<?php include("header.php"); ?>
<div class="row">
<div class="col-md-4 center-block form">
<div class="form">
	<form id="activate" method="post" class="form-signin">
		<input class="form-control" type="text" name="activekey" id="password" placeholder="Activation Key" <?php if(isset($_GET['key'])) { echo "value=\"" . $_GET['key'] . "\""; } ?> />
		<br><input class="btn btn-lg btn-info btn-block btn-rounded" type="submit" id="activate" value="Activate" /><br>
	</form>
</div>
<div class="small">
	<a href="?page=login">I've already activated my account</a><br/>
	<a href="?page=activation-resend">I haven't received my activation email</a>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	var myForm = $('#activate');
 
	myForm.validate({
			errorClass: "errormessage",
			onkeyup: false,
			errorClass: 'error',
			validClass: 'valid',
			rules: {
				activekey: { required: true, minlength: 20, maxlength: 20 }
			},
			errorPlacement: function(error, element)
			{
				var elem = $(element),
					corners = ['right center', 'left center'],
					flipIt = elem.parents('span.right').length > 0;
 
				if(!error.is(':empty')) {
					elem.filter(':not(.valid)').qtip({
						overwrite: false,
						content: error,
						position: {
							my: corners[ flipIt ? 0 : 1 ],
							at: corners[ flipIt ? 1 : 0 ],
							viewport: $(window)
						},
						show: {
							event: false,
							ready: true
						},
						hide: false,
						style: {
							classes: 'ui-tooltip-red'
						}
					})
					.qtip('option', 'content.text', error);
				}
				else { elem.qtip('destroy'); }
			},
			success: $.noop,
	})
});

$("#activate").submit(function(event) {
	if($("#activate").valid()) {
		event.preventDefault(); 

		var $form = $( this ),
			activekey = $form.find('input[name="activekey"]').val()
		

		$.post("inc/action.php?a=activate", {key: activekey},
			function(data) {
				if(data['error'] == 1)
				{
					$("#message").remove();
					
					$(".form").prepend('<div id="message"></div>');
					
					$("#message").message({type: "error", dismiss: false, message: data['message']});
					
					$("#message").effect("shake", {times: 2, distance: 10}, 200);
				}
				else if(data['error'] == 0)
				{			
					$("#message").remove();
					
					$(".form").prepend('<div id="message"></div>');
					
					$("#message").message({type: "info", dismiss: false, message: data['message']});
					
					$("#message").effect("pulsate", {times: 2}, 200);
				}
			}, "json"

			
		);
	}
	else
	{
		$("[id^=ui-tooltip-]").effect("pulsate", {times: 3}, 300);
		return false;
	}
});
</script>
<?php include("footer.php"); ?>