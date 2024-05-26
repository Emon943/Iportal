<?php

if(isset($_POST['email'])) { $email = $_POST['email']; } else { echo 1; exit(); }

$email = $auth->requestReset($email);

$return = array();

switch($email['code'])
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
		$return['message'] = "Password reset already requested within the last 24 hours";
		break;
	case 4:
		$return['error'] = 0;
		$return['message'] = "Password reset request sent to " . $email['email'];
		break;
	default:
		$return['error'] = 1;
		$return['message'] = "System error encountered";
		break;
}

$return = json_encode($return);

echo $return;

?>