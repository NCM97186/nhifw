<?php


$sql="SELECT * FROM visitors WHERE visitors_ip='".$_SERVER['HTTP_CLIENT_IP']."'";

$result=mysqli_query($conn,$sql);
$rows=mysqli_fetch_array($result);
$count=mysqli_num_rows($result);

if($count >0)
  {
	$addcounter=$rows['visitors_count']+1;
	$sql2="update visitors set visitors_count='$addcounter'";
	$result2=mysqli_query($conn,$sql2);
  }
else
{
	$date=date('Y-m-d');
	$visitors_count=1;
 $visitors_ip=$_SERVER['HTTP_CLIENT_IP'];
	$sql1="INSERT INTO visitors (`visitors_ip` ,`visitors_count` , `page_name`,`visitors_date_time`) VALUES('$visitors_ip','$visitors_count' ,'$url','$date')";
	$result1=mysqli_query($conn,$sql1);
	die();

}

?>