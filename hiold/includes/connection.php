<?php
// @extract($_GET);
// @extract($_POST);
// @extract($_SESSION);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "nihfw@123";
$db = "nihfwdb";

// Create connection
// $conn = new mysqli($servername, $username, $password, $db);

 $conn =  new mysqli($servername, $username, $password, $db);

 if (!$conn->set_charset("utf8")) {
  echo "Error loading character set utf8: %s\n", $conn->error;
} else {
 // echo "Current character set: %s\n", $conn->character_set_name();
}
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
//echo "Connected successfully";
}


// $sql = "INSERT INTO category (c_name, c_namehi, c_status, cat_id)
// VALUES ('John', 'Doe', '1', '1')";

// if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }


   

// $tableName_send ="feedback_form";
// $field_name = "name";
// $txtename   = "zxdcxzcxz";

// $sql="select * from ".$tableName_send." where ".$field_name."='".$txtename."'";
// $rs=mysqli_query($conn,$sql);
// $result_rows = mysqli_fetch_row($rs);
// print_r($result_rows);
// die();


?>


