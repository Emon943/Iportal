<?php

if(!$uid = $auth->sessionUID($hash)) { exit(); }

if(isset($_POST['email'])) { $email = $_POST['email']; } else { echo 1; exit(); }
if(isset($_POST['password'])) { $password = $_POST['password']; } else { echo 1; exit(); }

$changeemail = $auth->changeEmail($uid, $email, $password);

$return = array();

switch($changeemail['code'])
{
	case 0:
		$return['error'] = 1;
		$return['message'] = "You are temporarily locked out of the system. Please try again in 30 minutes.";
		break;
	case 1:
		$return['error'] = 1;
		$return['message'] = "Email / Password is invalid";
		break;
	case 2:
		$return['error'] = 1;
		$return['message'] = "UID Error";
		break;
	case 3:
		$return['error'] = 1;
		$return['message'] = "Password is incorrect";
		break;
	case 4:
		$return['error'] = 1;
		$return['message'] = "New email is the same as current email";
		break;
	case 5:
		$return['error'] = 0;
		$return['message'] = "Email Address changed. Redirecting to homepage.";
		break;
	default:
		$return['error'] = 1;
		$return['message'] = "System error encountered";
		break;
}

$return = json_encode($return);

echo $return;

?>