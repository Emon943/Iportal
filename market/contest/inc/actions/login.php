<?php

if(isset($_POST['username'])) { $username = $_POST['username']; } else { echo 1; exit(); }
if(isset($_POST['password'])) { $password = $_POST['password']; } else { echo 1; exit(); }

$login = $auth->login($username, $password);

$return = array();

switch($login['code'])
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
		$return['message'] = "Username / Password is incorrect";
		break;
	case 3:
		$return['error'] = 1;
		$return['message'] = "Account is not active";
		break;
	case 4:
		$return['error'] = 0;
		$return['message'] = "Logged in successfully, please wait...";
		$return['session_hash'] = $login['session_hash'];
		break;
	default:
		$return['error'] = 1;
		$return['message'] = "System error encountered";
		break;
}

$return = json_encode($return);

echo $return;

?>