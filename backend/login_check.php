<?php
	   header('Content-Type:application/json');
	   header('Access-Control-Allow-Origin: *');
	   header('Access-Control-Allow-Methods: POST');
	   header('Access-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization');
	   $data = json_decode(file_get_contents('php://input'),true);
	   $user = $data['user'];
	   $pass = $data['pass'];
	  
	   include 'conn.php';
	//   $username = $_GET["username"];
	//   $password = $_GET["password"];
	

session_start();

$return_arr = array();

   $sql = "select *  from user where  username   like '".$user."' and password  like '".$pass."'";
//  $sql = "select * from user ";

$runcheck = mysqli_query($conn,$sql);
if (mysqli_num_rows($runcheck) > 0)
{
	while ($row = mysqli_fetch_assoc($runcheck)) {
    $row_array['token'] = session_id();
	$row_array['message'] = 'ยืนยันตัวตนถูกต้อง';
	$row_array['state'] = 'ok';
	$row_array['fullname'] =  $row['fullname'];
	array_push($return_arr,$row_array);
	}
}else{
	$row_array['token'] = '';
	$row_array['message'] = 'ท่านไม่สามรถเข้าสู่ระบบได้';
	$row_array['state'] = 'no';

     array_push($return_arr,$row_array);
}

	
		


mysqli_close($conn);

echo json_encode($return_arr);

// print json_encode($rows);







?>
