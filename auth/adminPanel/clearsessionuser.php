<?php 

session_start();
require_once "../../includes/connection.php";
require_once("../../includes/useAVclass.php");
require_once("../../includes/functions.inc.php");


//$sqlal = "UPDATE admin_login SET login_flag = '0', login_count = '0'";
//mysqli_query($sqlal);
 $sqlal = "UPDATE admin_login set flag_id='0',login_flag='0',login_count='0' WHERE id='".$_SESSION['admin_auto_id_sess']."'";
 @mysqli_query($conn,$sqlal); //exit;
				



?>