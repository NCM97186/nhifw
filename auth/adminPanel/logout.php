<script>
document.cookie = "";
</script>
<?php 
session_start();
require_once "../../includes/connection.php";
require_once("../../includes/useAVclass.php");
require_once("../../includes/functions.inc.php");
require_once("../../includes/config.inc.php");
$useAVclass = new useAVclass();
$useAVclass->connection();
@extract($_POST);
@extract($_GET);

 $newrandom=$_GET['random'];
//$_SESSION['logtoken'];*/
/*echo $_SESSION['login_name']."<br>";
echo $_SESSION['temp']."<br>";*/

/* echo $temp=$_COOKIE['Temp']."<br>";
if (isset($temp))
   echo "<p>Your cookie value is - $temp</p>";
else
   echo "<p>Nothing in your cookie.</p>";

	$test=$_SESSION['Temptest'];


  echo $_SESSION['logtoken']."<br>";

  echo $newrandom."<br>";*/


$test=$_SESSION['Temptest'];


// print_r($_SESSION['logtoken']);
// echo "<br>".$newrandom;
// echo "<br>";
// print_r($_COOKIE['Temp']);
// echo "<br>";
// echo $test;
//die();
if($_SESSION['logtoken']!=$newrandom)
{
		session_unset($admin_auto_id_sess);
		session_unset($login_name);
		session_unset($dbrole_id);
		$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:error.php");
}
else if($_COOKIE['Temp']==$test && $_SESSION['logtoken']==$newrandom)
 {      
	

		$user_login_id=$_SESSION['admin_auto_id_sess'];
		$usersTable="admin_login";
		$whereclause="id='$user_login_id'";
        $old = array("flag_id");
        $new =array("0");
        $useAVclass->UpdateQuery($usersTable,$whereclause,$old,$new);

		mysqli_query($conn,"update admin_login set flag_id='0' where id='".$user_login_id."'");	
		$sqlal = "UPDATE admin_login SET login_flag = '0', login_count = login_count - 1 WHERE id = '".$user_login_id."'";
        mysqli_query($conn,$sqlal);
		//echo "update admin_login set flag_id='0' where id='".$user_login_id."'";
		$action="Logout";
		$role_id=$_SESSION['dbrole_id'];
		$model_id='Front Login';
		$date=date("Y-m-d h:i:s");
		$ip=$_SERVER['REMOTE_ADDR'];
		$tableName="audit_trail";
		$txtlanguage= 0;
		$txtepage_title= "";
		$url = "Logout";
		$page_id = 0;
		$tableFieldsName_send=array("user_login_id","page_id","page_name","page_action","page_category","page_action_date","ip_address","lang","page_title");
		$tableFieldsValues_send=array($user_login_id,$page_id,$url,$action,$model_id,$date,$ip,$txtlanguage,$txtepage_title);
		$value=$useAVclass->insertQuery($tableName,$tableFieldsName_send,$tableFieldsValues_send);
		
		
		$msg = "You have successfully logged out.";
		$_SESSION['sess_msg'] = $msg;
		session_unset();
		session_destroy();
		
		header("Cache-Control: no-store, no-cache, must-revalidate"); 
		header("Cache-Control: post-check=0, pre-check=0", false );
		header("Pragma: no-cache"); 
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		header("location:index.php");
		exit(); 
  }
  else 
   {
	   
   }
 
?>
