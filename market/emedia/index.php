<?php
include_once("functions.php");
$result = getlist();
$data = array();
?>

<table>
    
    <thead>
        <tr><td>Name</td>
            <td>Closing<br> Price</td>
            <td>Total Vol<br>(000)</td>
            <td>Total Share<br>(mn)</td>
            <td>MCAP<br>(mn)</td>
            <td>Avg <br>Price</td>
            <td>Beta</td>
            <td>RSI</td>
            
        </tr>
    </thead>
    
        <tr>

<?php
// build a multi-dimensional array from the result set
while ($row = mysql_fetch_assoc($result)) {
    $data[($row['name'])][($row['code'])][] = array(
        'name' => "{$row['name']}",
        'code' => $row['code'],
		'closing' => $row['ltp'],
        'volume'  => $row['total_volume'],
        'total_share'   => $row['total_share'],
        'mcap'          => ($row['ltp'])*($row['total_share']),
        'company_id'    => $row['ID'],
    );
}
// sql finishes here
    // html rendering 
    // use htmlentities to escape any html chars, such as < > etc
    foreach ($data as $sectorName => $companies) {
        echo '<td>',htmlentities($sectorName),'</td></tr><tr>';
        foreach ($companies as $comanyName => $codes) {
            foreach ($codes as $code) {
                echo '<td>',htmlentities($comanyName),'</td>';
				echo '<td>',  ($code['closing']),'</td>';
                echo '<td>',  bd_th_number($code['volume']),'</td>';
                echo '<td>',  $code['total_share'] , '</td>';
                echo '<td>',  bd_mn_number($code['mcap']),'</td>';
               print '<td>'. (call_user_func('end',array_values(trader_avgprice(getPrice($code['company_id'])[0],getPrice($code['company_id'])[1],getPrice($code['company_id'])[2],getPrice($code['company_id'])[3])))) .'</td>';
                echo '<td>', number_format(stats_covariance(idxDev($code['company_id']),comChange($code['company_id']))/stats_variance(idxDev($code['company_id'])),4), '</td>';
              	print '<td>'. trader_rsi(getrsi($code['company_id']),14). '</td>';
			   echo '</tr>'; 
            }
        }
    }
?>
</table>

<?php
