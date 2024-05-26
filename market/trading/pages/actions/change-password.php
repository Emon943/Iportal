<?php

if(!$uid = $auth->sessionUID($hash)) { exit(); }

if(isset($_POST['currpass'])) { $currpass = $_POST['currpass']; } else { echo 1; exit(); }
if(isset($_POST['newpass'])) { $newpass = $_POST['newpass']; } else { echo 1; exit(); }

$changepass = $auth->changePassword($uid, $currpass, $newpass);

$return = array();

switch($changepass['code'])
{
	case 0:
		$return['error'] = 1;
		$return['message'] = "You are temporarily locked out of the system. Please try again in 30 minutes.";
		break;
	case 1:
		$return['error'] = 1;
		$return['message'] = "Current / New password is invalid";
		break;
	case 2:
		$return['error'] = 1;
		$return['message'] = "UID Error";
		break;
	case 3:
		$return['error'] = 1;
		$return['message'] = "New password and current password cannot match";
		break;
	case 4:
		$return['error'] = 1;
		$return['message'] = "Current password is incorrect";
		break;
	case 5:
		$return['error'] = 0;
		$return['message'] = "Password changed. Redirecting to homepage.";
		break;
	default:
		$return['error'] = 1;
		$return['message'] = "System error encountered";
		break;
}

$return = json_encode($return);

echo $return;

?>