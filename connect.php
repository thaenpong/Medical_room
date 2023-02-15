<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical"; //ชื่อฐานข้อมูล

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "set character set utf8");
// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $db->connect_error);
//}
