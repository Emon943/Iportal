<?php include("header.php"); ?>
<div class="row">
  <div class="col-md-4 center-block form">
    <form id="register" method="post" class="form-signin">
    <h2 class="form-signin-heading">Please Fill Your Information</h2>
      <input type="text" name="email" id="email" placeholder="Email Address"  class="form-control" required="required"/>
      <br/>
      <input type="text" name="username" id="username" placeholder="Username" class="form-control" required="required" />
      <br/>
      <input type="password" name="password" id="password" placeholder="Password" class="form-control" required="required" />
      <br/>
      <input type="submit" id="register" value="Register" class="btn btn-lg btn-info btn-block btn-rounded" /><br />
    </form>
  
  <div class="small"> <a href="?page=login">I already have an account</a><br/>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var myForm = $('#register');
 
	myForm.validate({
			errorClass: "errormessage",
			onkeyup: false,
			errorClass: 'error',
			validClass: 'valid',
			rules: {
				email: { required: true, email: true, minlength: 3, maxlength: 100 },
				username: { required: true, minlength: 3, maxlength: 30 },
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
});

$("#register").submit(function(event) {
	if($("#register").valid()) {
		event.preventDefault(); 

		var $form = $( this ),
			mail = $form.find('input[name="email"]').val(),
			user = $form.find('input[name="username"]').val(),
			pass = $().crypt({method:"sha1",source:$().crypt({method:"sha1",source:$form.find('input[name="password"]').val()})});

		$.post("inc/action.php?a=register", {email: mail, username: user, password: pass},
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
