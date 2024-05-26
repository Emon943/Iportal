<?php if(!$uid = $auth->sessionUID($hash)) { exit(); } $email = $auth->getEmail($uid); ?>

<?php include("header.php"); ?>
<div class="form">
	<form id="changeemail" method="post">
		<input type="text" name="email" id="email" placeholder="New Email Address" /><br/>
		<input type="password" name="password" id="password" placeholder="Password" />
		<input type="submit" id="changeemail" value="Change Email" />
	</form>
</div>
<div class="small">
	<a href="?page=home">Return to home page</a><br/>
	<a href="?page=logout">Logout</a>
</div>

<script type="text/javascript">
$(document).ready(function(){
	var myForm = $('#changeemail');
 
	myForm.validate({
			errorClass: "errormessage",
			onkeyup: false,
			errorClass: 'error',
			validClass: 'valid',
			rules: {
				email: { required: true, email: true, minlength: 3, maxlength: 100 },
				password: { required: true, minlength: 3, maxlength: 100 }
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
	<?php
	
	echo '$(".form").prepend(\'<div id="message"></div>\');' . "\r\n";
	echo '	$("#message").message({type: "info", dismiss: false, message: "Your email address is currently <strong>' . $email . '</strong>"});' . "\r\n";
	echo '	$("#message").effect("pulsate", {times: 3}, 300);' . "\r\n";
	
	?>
});

$("#changeemail").submit(function(event) {
	if($("#changeemail").valid()) {
		event.preventDefault(); 

		var $form = $( this ),
			mail = $form.find('input[name="email"]').val(),
			pass = $().crypt({method:"sha1",source:$().crypt({method:"sha1",source:$form.find('input[name="password"]').val()})});

		$.post("inc/action.php?a=change-email", {email: mail, password: pass},
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
					
					window.setTimeout(function() { location.href = "?page=home"; }, 3000);
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