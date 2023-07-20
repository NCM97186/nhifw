<?php ob_start();
session_start();
require_once "../../includes/connection.php";
require_once "../../includes/def_constant.inc.php";
require_once "../../includes/config.inc.php";
require_once "../../includes/functions.inc.php";
require_once "../../securimage/securimage.php";
include("../../includes/useAVclass.php");
$useAVclass = new useAVclass();
$useAVclass->connection();
@extract($_POST);
$_SESSION['salt'] == "";
$_SESSION['saltCookie'] == "";
if ($_SESSION['salt'] == "")
{
	$salt =uniqid(rand(59999, 199999));
	$saltCookie =uniqid(rand(59999, 199999));
	$_SESSION['salt' ]=$salt;
	$_SESSION['saltCookie'] =$saltCookie;
	//echo $saltCookie;
}
if($cmdsubmit)
{
//Sanitize the POST values
$login = clean($_POST['txtusername']);
$password = clean($_POST['txtpassword']);
if(($login=="") && ($password==""))
	{
		$msg="Please enter username and password.";
		$_SESSION['sess_msg'] = $msg;
	}

	elseif($_POST['code']!="")
	{

			 $img = new Securimage();
			$valid = $img->check($_POST['code']);

			
			if($valid === true) 
			{
			
			}
			else
			{
				$msg="Please enter correct code.";
				$_SESSION['sess_msg'] = $msg;
				header("Location: index.php");
				exit;
			}

	 $qry="SELECT id,login_name,user_name,user_pass,role_id,last_login_date,state,region from admin_login where user_status='1'"; 

		//where user_status='1'
	 $result=mysqli_query($conn,$qry); 
	
		while($data = mysqli_fetch_assoc($result))
		{
			@extract($data);
			$db_admin =$data['id'];
			$state_id1 =$data['state'];
			$region1 =$data['region'];
			$admin_username =$data['login_name'];
			$db_pwd =$data['user_pass'];
		 $newpwd=strtoupper(hash("sha512",$db_pwd.$salt));
		if($password==$newpwd && $login_name==$login)
		{
 			 $days = (strtotime(date("Y-m-d")) - strtotime($last_login_date)) / (60 * 60 * 24); 
				  // if($days < 90)
					//	 {
										$date=date('Y-m-d');
										session_regenerate_id();
										$admin_auto_id_sess =$db_admin;
									
										$_SESSION['state_id'] = $state_id1;
										$_SESSION['region'] = $region1;
										$_SESSION['admin_auto_id_sess'] = $admin_auto_id_sess;
										$_SESSION['login_name'] =$admin_username;
										$_SESSION['dbrole_id'] =$role_id;
										$_SESSION['module_name'] =$user_name;
										mysqli_query($conn,"update admin_login set last_login_date='".$date."' where id='".$admin_auto_id_sess."'");	 	
										//$_SESSION['saltCookie']=$_SESSION['salt'];
										$_SESSION['Temptest']=$_SESSION['saltCookie'];
										//echo "ffff"; die;
										$expire=0; 
										$path=''; 
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
										$tableFieldsValues_send=array("$user_id","$page_id","$txtename","$action","$model_id","$date","$ip","$txtlanguage","$txtepage_title","$txtstatus");
										$value=$useAVclass->insertQuery($tableName,$tableFieldsName_send,$tableFieldsValues_send);
										header("location:welcome.php");
										exit;
						/* }
						 else if($days >=90)
							 {
				 		mysqli_query("update admin_login set user_status='0' where id='".$db_admin."'");	 	
								$msg="Please contact adminstrator.";
									$_SESSION['sess_msg'] = $msg;
										header("location:index.php");
										exit;
							 }	*/		
		
		}else
			{
				$msg="Please enter correct username and password.";
					$_SESSION['sess_msg'] = $msg;
					
			}
			
			}
		}
else
				{
					$msg="Please enter username and password.";
					$_SESSION['sess_msg'] = $msg;
					header("Location: index.php");
					exit;
		
				}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Panel:Epil</title>
<script src="../../includes/sha512.js" type="text/javascript"></script>
<link rel="SHORTCUT ICON" href="images/favicon.ico" />
<link href="style/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="javascript">
    function getPass()
    {
		
		var salt ='<?php print_r($_SESSION[salt]); ?>'; 
	
		var exp=/((?=.*\d)(?=.*[a-z])(?=.*[@#$%]).{6,10})/;
       
		var value = document.getElementById('<?php echo txtpassword; ?>').value;

		if (value=='')
        {
            alert('Please enter username and password');
            return false;
        }
        else
        {
            if (value.search(exp)==-1) 
            {
              
              //  return false;
            }
            if (value!='')
            {
				//alert(salt);
				//alert(hex_sha512(value)+salt);
				//alert(hex_sha512(hex_sha512(value)+salt));
                var hash=hex_sha512(hex_sha512(value)+salt);
                document.getElementById('<?php echo txtpassword; ?>').value=hash;
				
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
		 $('#code').keypress(function(event){
	$('#msg-txtcode').html('Valid Captcha code')
});
		});
			</script>
			<script>
function ClearFields() {
     document.getElementById("code").value = "";

}
</script>
</head>
<body>
<div class="logo_row">
                                   <div class="admin">
                                               
                                            </div>
                                            
                                            <div class="right-links">
                                            
                                           
                                            </div>          
                               
                                <div class="clear"> </div>
                            </div>
                    

 <?php if($_SESSION['sess_msg']!=""){?> 
         <div class="error_msgs">
          <div class="status1 error">
            <p class="closestatus"> <a title="Close" href="">x</a></p>
            <p><img alt="error" src="images/error.png"> <span>Attention! <br /></span><a href="#"><?php echo 					$_SESSION['sess_msg'];
			$_SESSION['sess_msg']='';
			 unset($_SESSION['sess_msg']);; ?>.</a></p>
          </div>
          </div>
          <?php }?>		
      	<div class="clear"></div>
 <div class="admin_panel">
<div class="admin-heading"> <img src="images/epil-logo.png" style="margin-left:100px;width:100px; margin-top: 20px;" /><h1>EPIL Administration  </h1>  </div>
      
     
        <form name="loginform" action="" method="post" autocomplete="off">	
      <div class="admin_row">
         <span class="label2"><label for="txtusername">User ID  * </label><span class="red-text"></span></span>
         <span class="input2"> <input name="txtusername" type="text" class="input_class2" id="txtusername" maxlength="100" autocomplete="off" placeholder ="User Id" autofocus/></span>
        <div class="clear"> </div>
      </div>
      
      <div class="admin_row">
         <span class="label2"><label for="txtpassword">Password  *</label><span class="red-text"></span></span>
         <span class="input2"><input name="txtpassword" type="password" class="input_class2" id="txtpassword"  maxlength="512" autocomplete="off"placeholder ="Password"/></span>
        <div class="clear"> </div>
      </div>
      
      <div class="captcha_row">
       
       <div class="captcha"><div style="width: 258px; float: left; height: 70px">
			<img id="siimage" align="left" style="padding-right: 5px; border: 0" src="../../securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" />
			
			<a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '../../securimage/securimage_show.php?sid=' + Math.random(),ClearFields(); return false"><img src="../../securimage/images/refresh_icon-big.png" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" /></a>
			 <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle" title="Audio">
<param name="allowScriptAccess" value="sameDomain" />
<param name="allowFullScreen" value="false" />
<param name="movie" value="../../securimage/securimage_play.swf?audio=../../securimage/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
<param name="quality" value="high" />
<param name="bgcolor" value="#ffffff" />
<embed src="../../securimage/securimage_play.swf?audio=../../securimage/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
			</div></div>
        <div class="clear"> </div>
      </div>
      
      <div class="message_row"><label for="code">
       Enter above characters(not case sensitive) being displayed in above image *</label>
        
      </div>
      
        <div class="admin_row1">
       
         <span class="input2"><input name="code" id="code"  type="text" class="input_class2" maxlength="6" autocomplete="off" placeholder="Captcha Code"/></span>
        <div class="clear"> </div>
      </div>
      
       <div class="admin_rowin">
       <input type="submit" name="cmdsubmit" id="cmdsubmit" value="Submit" class="button"  onClick ="return getPass();"/>
         <input type="submit" name="cmdreset" id="cmdreset" value="Reset" class="button" /> 
        <div class="clear"> </div>
      </div>
      </form>
      <div class="forget_link">
        <a href="forgot_password.php" title="Forgot Password">Forgot Password</a>
        <div class="clear"> </div>
      </div>  
      
    </div>
	
<?php include("footer.inc.php"); ?>
</body>
</html>
