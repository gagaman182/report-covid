<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';

 

 $sql = "SELECT
 quarantine.cid,
   quarantine.day,
 quarantine.datecontact,
 IF(quarantine.sick = 'yes','มีอาการ','ไม่มีอาการ') as sick,
 GROUP_CONCAT(symptom.name) as symptom,
 quarantine_symptom.symptom_other
 FROM
   quarantine
 left JOIN quarantine_symptom ON quarantine.cid = quarantine_symptom.cid
 AND quarantine. DAY = quarantine_symptom. DAY
 left JOIN symptom on quarantine_symptom.symptom = symptom.id
 GROUP BY quarantine.cid,
   quarantine.day";


$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
	
     array_push($return_arr,$row);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);








?>
