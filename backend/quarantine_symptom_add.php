<?php
 header('Content-Type:application/json');
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: PUT');
 header('Access-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization');
 $data = json_decode(file_get_contents('php://input'),true);

 $idcard = $data['idcard'];
 $day = $data['day'];
 $symptom = $data['symptom'];
 $symptom_other = $data['symptom_other'];
 




include 'conn.php';





 // หา record ล่าสุด
$sql = "SELECT max(id) as total from quarantine_symptom";
 
if ($result = mysqli_query( $conn, $sql )){
  
   while ($row = mysqli_fetch_assoc($result)) {

     $id=$row['total']+1;
 }
}




if (!empty($idcard)) {
 

    
       $strvisit  = "  INSERT INTO quarantine_symptom(id,cid,symptom,symptom_other,day,addtime) 
        VALUES('".$id."','".$idcard."','".$symptom."','".$symptom_other."','".$day."',CURRENT_TIMESTAMP)";
        
        
        
        if ($conn->query($strvisit) === TRUE) {
          
            
            $return_message = array();
            $row_array['message'] = "เพิ่มข้อมูลสำเร็จ";
            array_push($return_message,$row_array);
        
        
        } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
            $return_message = array();
            $row_array['message'] = "เพิ่มข้อมูลไม่สำเร็จ";
            array_push($return_message,$row_array);
            
        }


      }
      
mysqli_close($conn);
	
echo json_encode($return_message);

?>