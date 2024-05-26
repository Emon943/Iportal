<?php
include("header.php");
include("../inc/class/auth.class.php");
$dbh = @new PDO("mysql:dbname=smartus_user;host=localhost", "smartus_contest", "QAZXSW!@#$%^");
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
 
?>
<div class="small">
	<a href="?page=change-password">Change Password</a><br/>
	<a href="?page=change-email">Change Email</a><br/>
	<a href="?page=logout">Logout</a>
</div>