<?php
include_once("db.php");

$query  = mysql_query("SELECT
 s.name,
 SUM(a.pos) AS pos,
 SUM(a.neg) AS neg,
 SUM(a.none) AS none
FROM sector AS s
LEFT OUTER JOIN
 (
  SELECT 
   c.sector_id,
   IF(CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) > 0, 1, 0) AS pos,
   IF(CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) < 0, 1, 0) AS neg,
   IF(!(CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) > 0) AND !(CAST(((e.ltp-e.ycp)/e.ycp)*100 AS DECIMAL(10,2)) < 0), 1, 0) AS none
  FROM company AS c
  LEFT OUTER JOIN eod_stock AS e
  ON e.entry_date = (SELECT MAX(entry_date) FROM eod_stock) AND e.company_id = c.ID
  WHERE e.company_id
 ) AS a
ON a.sector_id = s.sector_ID
GROUP BY s.sector_ID");

while($info = mysql_fetch_array($query)) {
    $name[] =$info['name'];
	$pos[] = $info['pos'];
	$neg[] = $info['neg'];
	$none[] = $info['none'];
}

 $sector   = json_encode($name);
 $positive = json_encode($pos);
 $negetive = json_encode($neg);
 $noresult = json_encode($none);
 
 
print_r (json_decode($sector));
 

	
?>