<?php ob_start();
session_start();
@extract($_POST);
@extract($_SESSION);
error_reporting(0);

//$favoriteColor = isset($_POST["id"]) ? $_POST["id"] : "";
//$decrptid = base64_decode($_POST["id"]);

/*
$decrptid = is_numeric($_POST["id"]);
if($decrptid)
{
 echo $val=$decrptid;
}else { echo $val=0; }*/


if(is_numeric($_POST["id"]))
{

 echo $val=$_POST["id"];
 die();
}else { echo $val=0; }

?>


