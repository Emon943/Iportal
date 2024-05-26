<?php

if(isset($_POST['email'])) { $email = $_POST['email']; } else { echo 1; exit(); }
if(isset($_POST['username'])) { $username = $_POST['username']; } else { echo 1; exit(); }
if(isset($_POST['password'])) { $password = $_POST['password']; } else { echo 1; exit(); }

$register = $auth->register($email, $username, $password);

$return = array();

switch($register['code'])
{
	case 0:
		$return['error'] = 1;
		$return['message'] = "You are temporarily locked out of the system. Please try again in 30 minutes.";
		break;
	case 1:
		$return['error'] = 1;
		$return['message'] = "Username / Password is invalid";
		break;
	case 2:
		$return['error'] = 1;
		$return['message'] = "Email is already in use";
		break;
	case 3:
		$return['error'] = 1;
		$return['message'] = "Username is already in use";
		break;
	case 4:
		$return['error'] = 0;
		$return['message'] = "Account created ! Activation email sent to " . $register['email'];
		break;
	default:
		$return['error'] = 1;
		$return['message'] = "System error encountered";
		break;
}

$return = json_encode($return);

echo $return;

?>