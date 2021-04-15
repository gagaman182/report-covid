<?php
 header('Content-Type:application/json');
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: PUT');
 header('Access-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization');
 $data = json_decode(file_get_contents('php://input'),true);

 $idcard = $data['idcard'];
 
 $an = $data['an'];
 $symptom = $data['symptom'];
 $symptom_other = $data['symptom_other'];
 




include 'conn.php';





 // หา record ล่าสุด
$sql = "SELECT max(id) as total from symptom_use";
 
if ($result = mysqli_query( $conn, $sql )){
  
   while ($row = mysqli_fetch_assoc($result)) {

     $id=$row['total']+1;
 }
}




if (!empty($idcard)) {
 

    
       $strvisit  = "  INSERT INTO symptom_use(id,cid,an,symptom,symptom_other,addtime) 
        VALUES('".$id."','".$idcard."','".$an."','".$symptom."','".$symptom_other."',CURRENT_TIMESTAMP)";
        
        
        
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