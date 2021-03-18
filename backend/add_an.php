<?php
 header('Content-Type:application/json');
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: PUT');
 header('Access-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization');
 $data = json_decode(file_get_contents('php://input'),true);

  $date = $data['date'];
  $an = $data['an'];
  $ward = $data['ward'];

 
include 'conn.php';



if (!empty($an)) {

   // หา record ล่าสุด
// $sql = "SELECT count(*) as total from covid";
 
// if ($result = mysqli_query( $conn, $sql )){
  
//    while ($row = mysqli_fetch_assoc($result)) {

//      $num=$row['total']+1;
//  }
// }


 
       $strvisit  = "  INSERT INTO covid(date,an,ward) 
        VALUES('".$date."','".$an."','".$ward."')";
        
        
        
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