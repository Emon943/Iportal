<?php

if(isset($_POST['email'])) { $email = $_POST['email']; } else { echo 1; exit(); }

$activate = $auth->resendActivation($email);

$return = array();

switch($activate['code'])
{
	case 0:
		$return['error'] = 1;
		$return['message'] = "You are temporarily locked out of the system. Please try again in 30 minutes.";
		break;
	case 1:
		$return['error'] = 1;
		$return['message'] = "Email is invalid";
		break;
	case 2:
		$return['error'] = 1;
		$return['message'] = "Email is incorrect";
		break;
	case 3:
		$return['error'] = 1;
		$return['message'] = "Account already activated";
		break;
	case 4:
		$return['error'] = 1;
		$return['message'] = "Activation request already exists. Please wait for the request to expire (24 hours)";
		break;
	case 5:
		$return['error'] = 0;
		$return['message'] = "Activation email resent";
		break;
	default:
		$return['error'] = 1;
		$return['message'] = "System error encountered";
		break;
}

$return = json_encode($return);

echo $return;

?>