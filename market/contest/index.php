<?php
//include("headers.php");
include("inc/class/auth.class.php");
$dbh = @new PDO("mysql:dbname=iportal;host=localhost", "root", "");
$auth = new cuonic\PHPAuth2\Auth($dbh);

if(isset($_COOKIE['auth_session']))
{
	$hash = $_COOKIE['auth_session'];

	if($auth->checkSession($hash))
	{
		$loggedin = 1;
	}
	else
	{
		$loggedin = 0;
	}
}
else
{
	$loggedin = 0;
}

if(isset($_GET['page'])) { 
	$page = $_GET['page']; 
} else{


  header("Location: ?page=home"); exit(); 
	}


switch($page)
{
	case 'home':
		if($loggedin == 1) { include("pages/home-loggedin.php"); }
		else { include("pages/home-loggedout.php"); }
		break;
	case 'login':
		if($loggedin == 1) { header("Location: ?page=home"); exit(); }
		include("pages/login.php");
		break;
	case 'register':
		if($loggedin == 1) { header("Location: ?page=home"); exit(); }
		include("pages/register.php");
		break;
	case 'activate':
		if($loggedin == 1) { header("Location: ?page=home"); exit(); }
		include("pages/activate.php");
		break;
	case 'activation-resend':
		if($loggedin == 1) { header("Location: ?page=home"); exit(); }
		include("pages/activation-resend.php");
		break;
	case 'reset':
		if($loggedin == 1) { header("Location: ?page=home"); exit(); }
		if(isset($_GET['step'])) { $step = $_GET['step']; } else { $step = 1; }
		if($step == 1)
		{
			include("pages/reset1.php");
		}
		elseif($step == 2)
		{
			include("pages/reset2.php");
		}
		else
		{
			include("pages/reset1.php");
		}
		break;
	case 'logout':
		if($loggedin == 0) { header("Location: ?page=login&m=2"); exit(); }
		include("pages/logout.php");
		break;
	case 'change-password':
		if($loggedin == 0) { header("Location: ?page=login&m=2"); exit(); }
		include("pages/change-password.php");
		break;
	case 'change-email':
		if($loggedin == 0) { header("Location: ?page=login&m=2"); exit(); }
		include("pages/change-email.php");
		break;
	case 'contestDetails':
		if($loggedin == 0) { header("Location : ?page=login&m=2"); exit();}
		include("pages/contestDetails.php");
		break;
	case 'portfolio':
		if($loggedin == 0) { header("Location : ?page=login&m=2"); exit();}
		include("pages/portfolio.php");
		break;
	case 'buy':
		if($loggedin == 0) { header("Location : ?page=login&m=2"); exit();}
		include("pages/buyShare.php");
		break;
	case 'accounts':
		if($loggedin == 0) { header("Location : ?page=login&m=2"); exit();}
		include("pages/accounts.php");
		break;

	default:
		include("pages/404.php");
		break;
}

?>