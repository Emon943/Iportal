<?php include("header.php"); ?>
<div class="form">
	<form id="reset" method="post">
		<input type="text" name="email" id="email" placeholder="Email Address" />
		<input type="submit" id="reset" value="Reset Password" />
	</form>
</div>
<div class="small">
	<a href="?page=login">I know my password</a><br/>
	<a href="?page=reset&step=2">I already have a reset key</a>
</div>

<script type="text/javascript">
$(document).ready(function(){
	var myForm = $('#reset');
 
	myForm.validate({
			errorClass: "errormessage",
			onkeyup: false,
			errorClass: 'error',
			validClass: 'valid',
			rules: {
				email: { required: true, email: true, minlength: 3, maxlength: 100 }
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

$("#reset").submit(function(event) {
	if($("#reset").valid()) {
		event.preventDefault(); 

		var $form = $( this ),
			mail = $form.find('input[name="email"]').val()
		

		$.post("inc/action.php?a=reset1", {email: mail},
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