<?php
	
	 header('Content-Type:application/json');
	 header('Access-Control-Allow-Origin: *');
	 header('Access-Control-Allow-Methods: PUT');
	 header('Access-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization');
	 $data = json_decode(file_get_contents('php://input'),true);
	 $num = $data['num'];
	

	 include 'conn.php';


		$sql = "DELETE FROM covid WHERE num = '".$num."' ";


		$return_arr = array();
		
		if ($conn->query($sql) === TRUE) {
			
			
				$row_array['message'] = "ลบข้อมูลสำเร็จ";
				array_push($return_arr,$row_array);
			
				
				
			
		} else {
			$row_array['message'] =  "ลบข้อมูลไม่สำเร็จ " ;
			array_push($return_arr,$row_array);
		}


 	


mysqli_close($conn);

echo json_encode($return_arr);











?>
