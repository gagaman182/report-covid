
 <?php
 header('Content-Type:application/json');
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: PUT');
 header('Access-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization');
 $data = json_decode(file_get_contents('php://input'),true);
 $num = $data['num'];
 $date = $data['date'];
 $an = $data['an'];
 $ward = $data['ward'];
 

 include 'conn.php';
 

	

	if (!empty($an)) {
	 
		$sql = "UPDATE covid
		SET date = '" . $date ."',
		an = '" . $an ."',
		ward = '" . $ward ."'
		WHERE num = '" . $num ."' ";
		
		
		$return_arr = array();
		
		if ($conn->query($sql) === TRUE) {
			
			
				$row_array['message'] = "แก้ไขข้อมูลสำเร็จ";
				array_push($return_arr,$row_array);
			
				
				
			
		} else {
			$row_array['message'] =  "ไม่สามารถแก้ไขข้อมูลได้ " ;
			array_push($return_arr,$row_array);
		}
	
	
		  }
	
 
 


mysqli_close($conn);

echo json_encode($return_arr);


?>