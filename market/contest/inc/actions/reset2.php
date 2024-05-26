<?php

if(isset($_POST['key'])) { $key = $_POST['key']; } else { echo 1; exit(); }

$key = $auth->isResetValid($key);

$return = array();

switch($key['code'])
{
	case 0:
		$return['error'] = 1;
		$return['message'] = "You are temporarily locked out of the system. Please try again in 30 minutes.";
		break;
	case 1:
		$return['error'] = 1;
		$return['message'] = "Reset key is invalid";
		break;
	case 2:
		$return['error'] = 1;
		$return['message'] = "Reset key is incorrect";
		break;
	case 3:
		$return['error'] = 1;
		$return['message'] = "Reset key has expired";
		break;
	case 4:
		$return['error'] = 0;
		$return['message'] = "Reset key valid. Please wait...";
		break;
	default:
		$return['error'] = 1;
		$return['message'] = "System error encountered";
		break;
}

$return = json_encode($return);

echo $return;

?>