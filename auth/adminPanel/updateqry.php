<?php 

require_once "../../includes/connection.php";
require_once("../../includes/useAVclass.php");
require_once("../../includes/functions.inc.php");
require_once("../../includes/config.inc.php");


$password = 'Admin@1234';
$sha = '120020066152c6558e3fa461.30017740';
echo  $password = sha1($password.$sha);
echo $sqlal = "UPDATE admin_login SET sha_key = '120020066152c6558e3fa461.30017740', user_pass = '".$password."' WHERE id = '201'";
mysqli_query($conn,$sqlal);




?>