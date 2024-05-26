<?php include("header.php"); ?>
<div class="row">
<div class="col-md-4 center-block form">
<h2 class="form-signin-heading">Change you password here.</h2>
<h5>password should have minimum 3 characters. </h5>
	<form id="changepass" method="post" class="form-signin">
		<input type="password" name="currpass" id="password" placeholder="Current Password" class="form-control" /><br/>
		<input type="password" name="newpass" id="password" placeholder="New Password" class="form-control" /><br/>
		<input type="submit" id="changepass" value="Change Password" class="btn btn-lg btn-warning btn-block btn-rounded" />
	</form>

<div class="small">
	<a href="?page=home">Return to home page</a><br/>
	<a href="?page=logout">Logout</a>
</div>
</div></div>
<script type="text/javascript">
$(document).ready(function(){
	var myForm = $('#changepass');
 
	myForm.validate({
			errorClass: "errormessage",
			onkeyup: false,
			errorClass: 'error',
			validClass: 'valid',
			rules: {
				currpass: { required: true, minlength: 3, maxlength: 100 },
				newpass: { required: true, minlength: 3, maxlength: 100 }
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

$("#changepass").submit(function(event) {
	if($("#changepass").valid()) {
		event.preventDefault(); 

		var $form = $( this ),
			cpass = $().crypt({method:"sha1",source:$().crypt({method:"sha1",source:$form.find('input[name="currpass"]').val()})}),
			npass = $().crypt({method:"sha1",source:$().crypt({method:"sha1",source:$form.find('input[name="newpass"]').val()})});

		$.post("inc/action.php?a=change-password", {currpass: cpass, newpass: npass},
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