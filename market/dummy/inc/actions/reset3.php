<?php

if(isset($_POST['key'])) { $key = $_POST['key']; } else { echo 1; exit(); }
if(isset($_POST['password'])) { $password = $_POST['password']; } else { echo 1; exit(); }

$reset = $auth->resetPass($key, $password);

$return = array();

switch($reset['code'])
{
	case 0:
		$return['error'] = 1;
		$return['message'] = "You are temporarily locked out of the system. Please try again in 30 minutes.";
		break;
	case 1:
		$return['error'] = 1;
		$return['message'] = "Password is invalid";
		break;
	case 2:
		$return['error'] = 1;
		$return['message'] = "Reset key is incorrect / expired";
		break;
	case 3:
		$return['error'] = 1;
		$return['message'] = "Reset key deleted. Requested new password matches previous one";
		break;
	case 4:
		$return['error'] = 1;
		$return['message'] = "Password entered matches your existing password";
		break;
	case 5:
		$return['error'] = 0;
		$return['message'] = "Password changed !";
		break;
	default:
		$return['error'] = 1;
		$return['message'] = "System error encountered";
		break;
}

$return = json_encode($return);

echo $return;

?>