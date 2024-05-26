<?php include("header.php"); ?>
<div class="form">
	<form id="reset" method="post">
		<input type="text" name="resetkey" id="password" placeholder="Reset Key" <?php if(isset($_GET['key'])) { echo "value=\"" . $_GET['key'] . "\" "; } ?>/>
		<input type="submit" id="reset" value="Reset Password" />
	</form>
</div>
<div class="small">
	<a href="?page=login">I know my password</a><br/>
</div>

<script type="text/javascript">
$(document).ready(function(){
	
	$('#reset').validate({
		errorClass: "errormessage",
		onkeyup: false,
		errorClass: 'error',
		validClass: 'valid',
		rules: {
			resetkey: { required: true, minlength: 20, maxlength: 20 }
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
		success: $.noop
	})
});

$("#reset").submit(function(event) {
	if($("#reset").valid()) {
		event.preventDefault(); 

		var $form = $( this ),
			resetkey = $form.find('input[name="resetkey"]').val();
		

		$.post("inc/action.php?a=reset2", {key: resetkey},
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
					
					window.setTimeout(function() 
					{ 
						$(".form").empty();
						$(".form").append('<form id="resetpass" method="post"></form>');
						$("#resetpass").append('<input type="hidden" name="resetkey" value="'+resetkey+'" />');
						$("#resetpass").append('<input type="password" name="password" id="password" placeholder="New Password" />');
						$("#resetpass").append('<input type="submit" id="reset" value="Reset Password" />');
						
						$('#resetpass').validate({
							errorClass: "errormessage",
							onkeyup: false,
							errorClass: 'error',
							validClass: 'valid',
							rules: {
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
							success: $.noop
						})
						
						$("#resetpass").submit(function(event) {
							if($("#resetpass").valid()) {
								event.preventDefault(); 

								var $form = $( this ),
									key = $form.find('input[name="resetkey"]').val(),
									pass = $().crypt({method:"sha1",source:$().crypt({method:"sha1",source:$form.find('input[name="password"]').val()})});
								

								$.post("inc/action.php?a=reset3", {key: resetkey, password: pass},
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
											
											window.setTimeout(function() { location.href = "?page=login"; }, 2000);
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
					}, 2000);
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