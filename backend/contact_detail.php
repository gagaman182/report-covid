<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';

 

 $sql = "SELECT
 contact.id,
 contact.cid,
 CONCAT(prename,contact.name,' ',lastname) as fullname,
 mobile,
 department,
 contact.an,
 DATE_FORMAT(datecontact,'%d-%m-%Y') AS datecontact,
 timecontact,
 if(concat_person = 'yes','ใช่','ไม่ใช่') as concat_person,
 if(concat_secretion = 'yes','ใช่','ไม่ใช่') as concat_secretion,
 if(concat_aerosol = 'yes','ใช่','ไม่ใช่') as concat_aerosol,
 if(temp = 'yes','มีไข้','ไม่มีไข้' ) as temp,
 temp_other,
 contact.addtime,
 GROUP_CONCAT(DISTINCT clothing.name) as clothing ,
 GROUP_CONCAT(DISTINCT symptom.name) as symptom 
 
 
 
 FROM
   contact
 left JOIN clothing_use on contact.cid = clothing_use.cid and contact.an = clothing_use.an
 INNER JOIN clothing on clothing_use.clothing = clothing.id
 left join symptom_use on contact.cid = symptom_use.cid and contact.an = symptom_use.an
 INNER JOIN symptom on symptom_use.symptom = symptom.id
 GROUP BY contact.id,
 contact.cid,
 contact.an";


$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
	
     array_push($return_arr,$row);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);








?>
