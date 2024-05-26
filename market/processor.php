<?php 

 $results = $_POST['id'];

 $a = $_POST['beg_date'];

 $b = $_POST['end_date'];
 
 foreach($results as $result) {

 print_r($result);
 
 echo $ids = join(',',$result);  
 
 }

 //echo $a . $b;

//echo json_encode($result);

	

	?>