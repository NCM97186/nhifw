<?php 

session_start();
require_once "../../includes/connection.php";
require_once("../../includes/useAVclass.php");
require_once("../../includes/functions.inc.php");


print_r($_SESSION);
$sqlal = "UPDATE admin_login SET login_flag = '0', login_count = '0'";
mysqli_query($conn,$sqlal); 




?>