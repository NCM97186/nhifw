<?php 
error_reporting(0);
  //$HomeURL = 'http://'.$_SERVER["HTTP_HOST"].'/nihfw'; 
  $HomeURL =  "http://localhost/nihfw";
  // $HomeURL=	"http://10.48.21.19";
//$HomeURL=	"http://117.239.180.196";

@extract($_GET);
@extract($_POST);
if($_SESSION['name_css'] !="")
{
	 
	 $HomeCss=$HomeURL.'/'.$_SESSION['name_css'];

}
else
{

	unset($_SESSION['name_css']); 
	$HomeCss=$HomeURL.'/style';
	$_SESSION['name_css']='style';  

}
echo $_SESSION['fontsize'];
?>
