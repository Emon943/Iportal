<?php

if(isset($_POST['key'])) { $activekey = $_POST['key']; } else { echo 1; exit(); }

$activate = $auth->activate($activekey);

$return = array();

switch($activate['code'])
{
	case 0:
		$return['error'] = 1;
		$return['message'] = "You are temporarily locked out of the system. Please try again in 30 minutes.";
		break;
	case 1:
		$return['error'] = 1;
		$return['message'] = "Activation key is invalid";
		break;
	case 2:
		$return['error'] = 1;
		$return['message'] = "Activation key is incorrect";
		break;
	case 3:
		$return['error'] = 1;
		$return['message'] = "Account already active";
		break;
	case 4:
		$return['error'] = 1;
		$return['message'] = "Activation key expired";
		break;
	case 5:
		$return['error'] = 0;
		$return['message'] = "Account activated, you can now login";
		break;
	default:
		$return['error'] = 1;
		$return['message'] = "System error encountered";
		break;
}

$return = json_encode($return);

echo $return;

?>