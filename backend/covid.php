<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';

 

 $sql = "select
 num,
  concat(
   DATE_FORMAT(date, '%d'),
   '-',
   DATE_FORMAT(date, '%m'),
   '-',
   DATE_FORMAT(date, '%YY')+ 543
 )AS date,
  an,
  ward
 from covid";


$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
	
     array_push($return_arr,$row);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);








?>
