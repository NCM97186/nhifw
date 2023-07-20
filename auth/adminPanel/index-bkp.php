<?php 
ini_set('session.cookies_samesite', 'Lax');
ob_start();
session_start();
// echo $_SESSION['CAPTCHA_CODE'];
// die();
error_reporting(E_ALL); ini_set('display_errors', 1);
require_once "../../includes/connection.php";
require_once "../../includes/def_constant.inc.php";
require_once "../../includes/config.inc.php";
require_once "../../includes/functions.inc.php";
require_once "../../securimage/securimage.php";
include("../../includes/useAVclass.php");

$useAVclass = new useAVclass();
$useAVclass->connection();
@extract($_POST);
$salt = isset($_SESSION['salt']) ? $_SESSION['salt'] : '';
$saltCookie = isset($_SESSION['saltCookie']) ? $_SESSION['saltCookie'] : '';

if ($salt == "")
{
	
	$salt =uniqid(rand(59999, 199999));
	$saltCookie = uniqid(rand(59999, 199999));
	$_SESSION['salt']=$salt;
	$_SESSION['saltCookie'] =$saltCookie;
  
}

//echo date('H:i:s', time()).' '.date('H:i:s', strtotime($_SESSION['loginattempttime']));

if(isset($_SESSION['loginattempttime'])&&$_SESSION['loginattempttime'] == true){
	
//$difference = date_diff(date('h:i:s', time()), date('h:i:s', strtotime($_SESSION['loginattempttime']))); 
$dateTimeObject1 = date_create(date('H:i:s', time())); 
$dateTimeObject2 = date_create(date('H:i:s', strtotime($_SESSION['loginattempttime']))); 
  
$difference = date_diff($dateTimeObject1, $dateTimeObject2); 

//echo ("The difference in hours is:");
 $difference->h;
//echo "\n";
$minutes = $difference->days * 24 * 60;
$minutes += $difference->h * 60;
$minutes += $difference->i;
//echo("The difference in minutes is:");
//echo $minutes.' minutes';

if($minutes >= 30){
	
	$_SESSION['loginattempt'] = 0;
}

}

if(isset($_SESSION['login_name'])&&$_SESSION['login_name'] == true){
	header("Location: welcome.php"); 
			exit; 
	}
/*
$to_time = strtotime("10:42:00");
$from_time = strtotime("10:21:00");
$minutes = round(abs($to_time - $from_time) / 60,2);
echo("The difference in minutes is: $minutes minutes.");
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Panel: <?php echo $sitename;?></title>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script src="../../includes/sha512.js" type="text/javascript"></script>
<script src="js/cutome.js" type="text/javascript"></script>
<link rel="SHORTCUT ICON" href="images/favicon.ico" />
<link href="style/admin.css" rel="stylesheet" type="text/css">

<?php 

if(isset($_POST['txtusername'])&&$_POST['txtusername'] == true)	
{	
	
if($_SESSION['loginattempt'] == '' || $_SESSION['loginattempt'] == false){
	
	$_SESSION['loginattempt'] = 0;
	
}

if($_SESSION['loginattempt'] >= 3){
				
				$msg="You have already use max 3 attempt Kindly try login after 30 Minutes ";   
				$_SESSION['sess_msg'] = $msg;
					header("Location: index.php"); 
			exit;
}

$login = $_POST['txtusername'];
$password = $_POST['txtpassword'];
//echo parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST).'   g'.$_SERVER["SERVER_NAME"]; exit;
	if(parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST) != $_SERVER["SERVER_NAME"]){
			 $sqlal = "UPDATE admin_login SET login_flag = '0' WHERE login_name = '".$login."'"; 
             mysqli_query($conn,$sqlal);
	}
	
	if(($login=="") && ($password==""))
	{
		$msg="Please enter username and password.";
		$_SESSION['sess_msg'] = $msg;
	}

	else if($_POST['code']!="")
	{
		if($_SESSION['CAPTCHA_CODE'] == $_POST['code']) 
		{	
		}
		else
		{
			$msg="Please enter correct code.";
			$_SESSION['sess_msg'] = $msg;      
			header("Location: index.php"); 
			exit;
		}
        
		   $password1 = $password;
		  //$qry="SELECT id,login_name,user_name,sha_key,user_pass,role_id,last_login_date,flag_id,login_flag,login_count from admin_login where user_status='1' "; 
		  
		 // $qry="SELECT id,login_name,user_name,sha_key,user_pass,role_id,last_login_date,flag_id,login_flag,login_count from admin_login where user_status='1' AND login_name = '".trim($_POST['txtusername'])."' AND user_pass = '".trim($password1)."' "; //exit;
		 $qry="SELECT id,login_name,user_name,sha_key,user_pass,role_id,last_login_date,flag_id,login_flag,login_count from admin_login where user_status='1' AND login_name = '".trim($_POST['txtusername'])."' "; //exit;

 
	 	$result=mysqli_query($conn,$qry); 
		$renvalue = mysqli_fetch_array($result);
	
		if(count($renvalue) > 1){
			
			//echo 'hiii';
			// print_r($renvalue);
			// die();
			$data = $renvalue;
	
			@extract($data);


	       // print_r($data);exit;
			$db_admin =$data['id'];
			$flag_id =$data['flag_id'];
			$admin_username =$data['login_name'];
			$db_pwd =$data['user_pass'];
		 	$newpwd=strtoupper(hash("sha512",$db_pwd.$salt));
		 	$date=date('Y-m-d');
			
			$login_flag = $data['login_flag'];
			

			if($login_flag == 1){
				
			$msg="You may also be logged in from another system. Kindly log out and try agains";   
			$_SESSION['sess_msg'] = $msg;
			header("Location: index.php");
			exit;
			
			}
;
                   
					 
			if($login_name == $admin_username && $db_pwd = trim($password1))
			{
			// if($login_name == $admin_username)
			// {

 		    	//$days = (strtotime(date("Y-m-d")) - strtotime($last_login_date)) / (60 * 60 * 24); 
				  $days = (strtotime(date("Y-m-d")) - strtotime($last_login_date)) / (60 * 60 * 24); 
				 // if($days < 90)
					//{
				//echo 'fddf';

						session_regenerate_id();
						$admin_auto_id_sess =$db_admin;
						
						$_SESSION['state_id'] = $state_id1;
						$_SESSION['region'] = $region1;
						$_SESSION['admin_auto_id_sess'] = $admin_auto_id_sess;
						$_SESSION['login_name'] =$admin_username;
						$_SESSION['dbrole_id'] =$role_id;
						$_SESSION['module_name'] =$user_name;
						$sql = mysqli_query($conn,"update admin_login set last_login_date='".$date."', flag_id='1' where id='".$admin_auto_id_sess."'");		
						//$_SESSION['saltCookie']=$_SESSION['salt'];
						$_SESSION['Temptest']=$_SESSION['saltCookie'];
						//echo "ffff"; die;
						$expire=0; 
						$path='/nihfw'; 
						$domain='';
						$secure=false;
						$httponly=true;
						setcookie("Temp",$_SESSION['saltCookie'],$expire,$path,$domain,$secure,$httponly);
						$uniqsalt=mt_rand();
						//$_SESSION['newuniq'] = $uniqsalt;
						//$_SESSION['logtoken'] =md5(uniqid(mt_rand(), true));
						$_SESSION['IsAuthorized']=true;
						$_SESSION['logtoken'] =md5(uniqid(mt_rand(), true));
						session_write_close();
						$user_id=$_SESSION['admin_auto_id_sess'];
						//echo $user_id; exit();
						$page_id=mysqli_insert_id($conn);
						$action="Login";
						$categoryid='1'; //mol_content
						$date=date("Y-m-d h:i:s");
						$ip=$_SERVER['REMOTE_ADDR'];
						$tableName="audit_trail";
						$tableFieldsName_send=array("user_login_id","page_id","page_name","page_action","page_category","page_action_date","ip_address","lang","page_title","approve_status");
						$tableFieldsValues_send=array($user_id,$page_id,$txtename,$action,$model_id,$date,$ip,$txtlanguage,$txtepage_title,$txtstatus);

						$value=$useAVclass->insertQuery($tableName,$tableFieldsName_send,$tableFieldsValues_send);
						
						header("location:welcome.php");
						exit;
					
			}
			else
			{
					$_SESSION['loginattempt'] = (int)$_SESSION['loginattempt'] + 1;
					//echo $_SESSION['login_attempt']	;
					$msg="Please enter correct username and password. Attempt ".$_SESSION['loginattempt'];
					$_SESSION['sess_msg'] = $msg;
					
					
				
				if($_SESSION['loginattempt'] >= 3){
					
					$_SESSION['loginattempttime'] = date('his',time());
					$msg="You have already use max 3 attempt Kindly try login after 30 Minutes ".$_SESSION['loginattempttime'];   
					$_SESSION['sess_msg'] = $msg;
					
				}
				
			}	
		//}
	}
		else{
			
					$_SESSION['loginattempt'] = (int)$_SESSION['loginattempt'] + 1;
					//echo $_SESSION['login_attempt']	;
					$msg="Please enter correct username and password. Attempt ".$_SESSION['loginattempt'];
					$_SESSION['sess_msg'] = $msg;
					
					
				
				if($_SESSION['loginattempt'] >= 3){
					
					$_SESSION['loginattempttime'] = date('his',time());
					$msg="You have already use max 3 attempt Kindly try login after 30 Minutes ".$_SESSION['loginattempttime'];   
					$_SESSION['sess_msg'] = $msg;
				}
			header("Location: index.php"); 
			exit;
		}
	}
	else
	{
		$msg="Please enter username and passwords.";
		$_SESSION['sess_msg'] = $msg;
		header("Location: index.php");
		exit;
	}
}
?>
<script type="text/javascript" language="javascript">
    
	function getPass()
    {
		
		//var salt = '<?php // print_r($_SESSION[salt]); ?>'; 
	
		var exp= /((?=.*\d)(?=.*[a-z])(?=.*[@#$%]).{6,10})/;
       
		var value = document.getElementById('txtpassword').value;

      
		if (value=='')
        {
            alert('Please enter username and password');
            return false;
        }
        else
        {
			
            
            if (value!='')
            {
				
				<?php 
         			   $password = isset($_POST['txtpassword']) && $_POST['txtpassword'] == "";
					//    $password1 = sha1($password.'120020066152c6558e3fa461.30017740');
					   $password1 = hash("sha512", $password.'120020066152c6558e3fa461.30017740'); 
				 ?>
				 
				 var hash= '';
			
				 hash = hex_sha512(value + '120020066152c6558e3fa461.30017740');
				//	alert(hash);
                document.getElementById('txtpassword').value=hash;
				document.getElementById("loginform").submit();

				return true;
            }

        }
    }
	

</script>
<script type="text/javascript">
		$(document).ready(function () {
		$('#txtusername').keypress(function(event){
		$('#msg-txtuser').html('Valid user Name')
		});
		$('#txtpassword').keypress(function(event){
	$('#msg-txtpass').html('Valid Password')
});
// 		 $('#code').keypress(function(event){
// 	$('#msg-txtcode').html('Valid Captcha code')
// });
		});
			</script>
			<script>
// function ClearFields() {
//      document.getElementById("code").value = "";

// }
</script>


<script type = "text/javascript" >
			
       function burstCache() {
        if (!navigator.onLine) {
            document.body.innerHTML = 'Loading...';
            window.location = 'index.php';
        }
    }
</script>
<script>
var a=navigator.onLine;
if(a){
//alert('online');
}else{
//alert('ofline');
//window.location='index.php';
} </script>
</head>
<body>

 <?php if(isset($_SESSION['sess_msg'])&&$_SESSION['sess_msg']!=""){?> 
         <div class="error_msgs">
          <div class="status1 error">
            <p class="closestatus"> <a title="Close" href="">x</a></p>
            <p><img alt="error" src="images/error.png"> <span>Attention! <br /></span><a href="#"><?php echo $_SESSION['sess_msg'];
			$_SESSION['sess_msg']='';
			 unset($_SESSION['sess_msg']);; ?>.</a></p>
          </div>
          </div>
          <?php }?>		
      	<div class="clear"></div>
 <div class="admin_panel">
	
<div class="admin-heading"> <h1><img src="<?php echo $HomeURL;?>/images/nihfw-logo.jpg" class="img-responsive" title="NIHFW" alt="NIHFW" width='350' height='100' > <br /> <br /><i>Administration </i></h1></div>
      
     
        <form name="loginform" id="loginform" action="" method="post" autocomplete="off">	
      <div class="admin_row">
         <span class="label2"><label for="txtusername">User ID  * </label><span class="red-text"></span></span>
         <span class="input2"> <input name="txtusername" type="text" class="input_class2" id="txtusername" maxlength="30" autocomplete="off" placeholder ="User Id" autofocus/></span>
        <div class="clear"> </div>
      </div>
      
      <div class="admin_row">
         <span class="label2"><label for="txtpassword">Password  *</label><span class="red-text"></span></span>
         <span class="input2"><input name="txtpassword" type="password" class="input_class2" id="txtpassword" maxlength="50"  autocomplete="off" placeholder ="Password"/></span>
        <div class="clear"> </div>
      </div>
      
      <div class="captcha_row">
       
       <div class="captcha"><div style="width: 258px; float: left; height: 70px">
	   <img src="../../includes/captcha.php" alt="PHP Captcha">

			</div></div>
        <div class="clear"> </div>
      </div>
      
 
      
        <div class="admin_row1">
         <span class="input2"><input name="code" id="code"  type="text" class="input_class2" maxlength="6" autocomplete="off" placeholder="Captcha Code"/></span>
        <div class="clear"> </div>
      </div>
      
       <div class="admin_rowin">
       <input type="button" name="cmdsubmit" id="cmdsubmit" value="Submit" class="button" onClick ="return getPass();" />
         <input type="submit" name="cmdreset" id="cmdreset" value="Reset" class="button" /> 
        <div class="clear"> </div>
      </div>
      </form>
      <div class="forget_link">
        <a href="forgot_password.php" title="Forgot Password">Forgot Password</a>
        <div class="clear"> </div>
      </div>  
      
    </div>
	<!--onClick ="return getPass();" -->
</body>
</html>
