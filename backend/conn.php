<?php

// hospital
// $servername = "192.168.5.187";
// $username = "root";
// $password = "123456";
// $dbname = "leave";
// $port = "3333";
// // home
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "contact-covid";
$port = "3306";




// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn -> set_charset("utf8");

?>