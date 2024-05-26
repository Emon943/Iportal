<?php

include("class/auth.class.php");

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

if(isset($_GET['a']))
{
	$action = strtolower($_GET['a']);
	
	switch($action)
	{
		case 'login':
			if($loggedin == 1) { exit(); }
			include("actions/login.php");
			break;
		case 'register':
			if($loggedin == 1) { exit(); }
			include("actions/register.php");
			break;
		case 'activate':
			if($loggedin == 1) { exit(); }
			include("actions/activate.php");
			break;
		case 'reset1':
			if($loggedin == 1) { exit(); }
			include("actions/reset1.php");
			break;
		case 'reset2':
			if($loggedin == 1) { exit(); }
			include("actions/reset2.php");
			break;
		case 'reset3':
			if($loggedin == 1) { exit(); }
			include("actions/reset3.php");
			break;
		case 'activation-resend':
			if($loggedin == 1) { exit(); }
			include("actions/activation-resend.php");
			break;
		case 'change-password':
			if($loggedin == 0) { exit(); }
			include("actions/change-password.php");
			break;
		case 'change-email':
			if($loggedin == 0) { exit(); }
			include("actions/change-email.php");
			break;
		default:
			exit();
	}
}
else
{
	exit();
}