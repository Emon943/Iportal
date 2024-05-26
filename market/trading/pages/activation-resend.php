<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>PHPAuth 2.0 - Resend Activation</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />

<link href="css/ui-lightness/jquery-ui.custom.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.qtip.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>

<script type="text/javascript" src="js/plugins/jquery.message.js"></script>
<script type="text/javascript" src="js/plugins/jquery.validate.js"></script>
<script type="text/javascript" src="js/plugins/jquery.qtip.js"></script>
</head>

<body>
<div class="logo"></div>
<div class="form">
	<form id="activate" method="post">
		<input type="text" name="email" id="email" placeholder="Email Address" />
		<input type="submit" id="activate" value="Resend Activation" />
	</form>
</div>
<div class="small">
	<a href="?page=login">I've already activated my account</a><br/>
	<a href="?page=activate">I've received my activation email</a>
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

$("#activate").submit(function(event) {
	if($("#activate").valid()) {
		event.preventDefault(); 

		var $form = $( this ),
			mail = $form.find('input[name="email"]').val()
		

		$.post("inc/action.php?a=activation-resend", {email: mail},
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
</body>
</html>