<?php 
$con = mysql_connect("localhost","smartus_capmbd","QAZXSW!@#$%^");
$db = mysql_select_db("smartus_iportal",$con);
?>
<table>
<tr>
<?php

$query = mysql_query("SELECT
lDX_PERCENTAGE_DEVIATION, 
IDX_DATE_TIME, 
getchange(IDX_DATE_TIME,59) as changes 
FROM idx WHERE IDX_DATE_TIME >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) 
ORDER by IDX_DATE_TIME ASC");


while($info = mysql_fetch_array($query)) {

	$idx[] = $info['lDX_PERCENTAGE_DEVIATION'];
	 $c[] = $info['changes'];
	 
}

echo stats_variance($idx);

