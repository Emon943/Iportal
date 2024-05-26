<?php include("header.php"); ?>

<div class="row">

<div class="col-md-4 center-block form">

	<form id="login" method="post" class="form-signin">

    <h2 class="form-signin-heading">Please sign in</h2>

		<input type="text" name="username" id="username" placeholder="Username"  class="form-control"/><br/>

		<input type="password" name="password" id="password" placeholder="Password"  class="form-control"/><br/>

		<input type="submit" id="login" value="Login" class="btn btn-lg btn-primary btn-block btn-rounded" />

	</form>



<div class="small">

	<a href="?page=register">I don't have an account yet</a><br/>

	<a href="?page=activate">I want to activate my account</a><br/>

	<a href="?page=reset&step=1">I've forgotten my password</a>

</div>

</div>

</div>

<script type="text/javascript">

$(document).ready(function(){

	var myForm = $('#login');

 

	myForm.validate({

			errorClass: "errormessage",

			onkeyup: false,

			errorClass: 'error',

			validClass: 'valid',

			rules: {

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

	<?php

	

	if(isset($_GET['m']))

	{

		$m = $_GET['m'];

		

		if($m == 1) 

		{ 

			echo '$(".form").prepend(\'<div id="message"></div>\');' . "\r\n";

			echo '	$("#message").message({type: "info", dismiss: false, message: "Successfully logged out"});' . "\r\n";

			echo '	$("#message").effect("pulsate", {times: 3}, 300);' . "\r\n";

			echo '	window.setTimeout(function() { $("#message").remove(); }, 3000);' . "\r\n";

		}

		elseif($m == 2) 

		{ 

			echo '$(".form").prepend(\'<div id="message"></div>\');' . "\r\n";

			echo '	$("#message").message({type: "error", dismiss: false, message: "You need to login to access protected areas"});' . "\r\n";

			echo '	$("#message").effect("pulsate", {times: 3}, 300);' . "\r\n";

			echo '	window.setTimeout(function() { $("#message").remove(); }, 3000);' . "\r\n";

		}

	}

	

	?>

});



$("#login").submit(function(event) {

	if($("#login").valid()) {

		event.preventDefault(); 



		var $form = $( this ),

			user = $form.find( 'input[name="username"]' ).val(),

			pass = $().crypt({method:"sha1",source:$().crypt({method:"sha1",source:$form.find('input[name="password"]').val()})});



		$.post("inc/action.php?a=login", {username: user, password: pass},

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

					$.cookie("auth_session", data['session_hash'], { expires: 30 });

					

					$("#message").remove();

					

					$(".form").prepend('<div id="message"></div>');

					

					$("#message").message({type: "info", dismiss: false, message: data['message']});

					

					$("#message").effect("pulsate", {times: 2}, 200);

					

					window.setTimeout(function() { location.href = "?page=home"; }, 2000);

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