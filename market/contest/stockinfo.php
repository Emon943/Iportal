<p class="personPopupResult"></p>
<?php

include("functions.php");

$stock = $_REQUEST['guid'];
$pieces = explode(",", $stock);

$code = $pieces[0];
$id = $pieces[1];


$query = mysql_query("SELECT eps FROM dp_eps WHERE code = '$code'");

while($info = mysql_fetch_array($query)){

	echo "EPS:" . $info['eps'];


}



mysql_close($con);
?>


