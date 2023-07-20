<?php ob_start();
session_start();

include("../../includes/config.inc.php");
include("../../includes/useAVclass.php");
include("../../includes/def_constant.inc.php");
include("../../includes/functions.inc.php");
$useAVclass = new useAVclass();
$useAVclass->connection();
if ($_SESSION['salt'] == "")
{
	$salt =rand(59999, 199999);
	$salt1 =rand(59999, 199999);
	$salt2 =rand(59999, 199999);
	$_SESSION['salt' ]=$salt;
	$_SESSION['salt1' ]=$salt1;
	$_SESSION['salt2' ]=$salt2;
}
if($_SESSION['admin_auto_id_sess']=='')
{		
	$msg = "Login to Access Admin Panel";
	$_SESSION['sess_msg'] = $msg ;
	header("Location:index.php");
	exit;	
}
$uid=$_SESSION['admin_auto_id_sess'];
@extract($_GET);
@extract($_POST);
@extract($_SESSION);
$sql = "select user_pass from admin_login where id='$admin_auto_id_sess'";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);
if($line=mysqli_fetch_assoc($result)){
@extract($line);
}

//if($cmdsubmit == "Update")
//$cmdsubmit
if($_POST == true)
{
	// echo $uid;
	// die();
$sql="Select user_pass from admin_login where id='$uid'";
//die();
$result=mysqli_query($conn,$sql);
$numrow=mysqli_num_rows($result);

$line_reset=mysqli_fetch_array($result); 
@extract($line_reset);

$txtpwd= $_POST['txtpwd'];
$txtnpwd= $_POST['txtnpwd'];
$txtcpwd = $_POST['txtcpwd'];

//$convertpwd = strtoupper($txtpwd);
//$oldcheckpwd = sha1($txtnpwd);
// $convertpwd = sha1($txtnpwd.'120020066152c6558e3fa461.30017740');

// echo $txtpwd;
// echo "<br>";
// echo $user_pass;
// //echo "<br>";
// die();

if(trim($txtpwd)=="")
{
	$errmsg ="Please enter Old Password."."<br>";
	
}
if(trim($txtnpwd)=="")
{
	$errmsg.="Please enter New Password."."<br>";
	
}
if($txtpwd==$txtnpwd)
{
$errmsg.="Please enter new password  should not be same as old password.";
$flag="NOTOK";   //setting the flag to error flag.
}
/*else if(preg_match("/^[0-9a-zA-Z_]{6,}$/", $txtnpwd) === 0)
  {
  $errmsg.="New Password minimum lenght is 6 character and contain only digits, letters and underscore."."<br>";
  }*/
  

if(trim($txtcpwd)=="")
{
	$errmsg .="Please enter Confirm Password."."<br>";

}
/*else if(preg_match("/^[0-9a-zA-Z_]{6,}$/", $txtcpwd) === 0)
{    
	$errmsg.="Confirm Password minimum lenght is 6 character and contain only digits, letters and underscore."."<br>";
}
*/
//if($convertpwd!=$user_pass)
// echo $txtpwd;
// echo "<br>";
// echo $user_pass;
// die();
if($txtpwd!= strtoupper($user_pass))
{
	$errmsg.="Please enter the correct old password.";
}

else if($txtnpwd!=$txtcpwd)
{
$errmsg.="Password mismatch! Please enter the same password."."<br>";
}
/*else if (!@preg_match("^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$",($_POST['txtnpwd'])))
  {
  $errmsg.="Password must be 8 characters long, contain at least 1 number, at least 1 lower case letter and at least 1 upper case letter."."<br>";
  }
	
else if (!@preg_match("^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$",($_POST['txtcpwd']))) 
  {
  $errmsg.="Password must be 8 characters long, contain at least 1 number, at least 1 lower case letter and at least 1 upper case letter"."<br>";
  }*/
else	
	
	{
	
	if($_SESSION['logtoken']!=$_POST['random'])
		{ 
		
		session_unset($admin_auto_id_sess);
		session_unset($login_name);
		session_unset($dbrole_id);
		$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:page.php");
		exit();
		}
			//$txtnpwd = strtoupper(hash("sha512",$txtnpwd));
		 	//$newpwd = hash("sha512", $txtnpwd.'120020066152c6558e3fa461.30017740');  
			// $newpwd=sha1($txtnpwd.'120020066152c6558e3fa461.30017740');
			$newpwd = $txtnpwd;
			//$testpwd=$newpwd.'120020066152c6558e3fa461.30017740';
			$user_login_id=$_SESSION['admin_auto_id_sess'];
			//echo "<BR/>".$newpwd;
			//die();
			
			$sql = "SELECT *  FROM admin_pwdhistory WHERE id='$admin_auto_id_sess' AND user_pass = '$newpwd'";
			$result=mysqli_query($conn,$sql);
			$num=mysqli_num_rows($result);
			
			if($num > 0){
				
				$errmsg.="Password already used. Please use new password."."<br>";
				
			}
			else  
			{
				
			$tableName_send="admin_login";
			$whereclause = "id = '$uid'";
			$old = array("user_pass","flag_id","login_flag","login_count");
			$new =array("$newpwd","0","0","0");
			$useAVclass->UpdateQuery($tableName_send, $whereclause, $old, $new);
			
			$tableFieldsName_send=array("user_pass","id");
			$tableFieldsValues_send=array("$newpwd","$user_login_id");
			$useAVclass->insertQuery('admin_pwdhistory',$tableFieldsName_send,$tableFieldsValues_send);
			
			$page_id=$val;
			$action="Update Password admin";
			$categoryid='0';//super admin
			$date=date("Y-m-d h:i:s");
			$ip=$_SERVER['REMOTE_ADDR'];
			$tableName="audit_trail";
			$tableFieldsName_send=array("user_login_id","page_id","page_name","page_action","page_category","page_action_date","ip_address");
			$tableFieldsValues_send=array("$user_login_id","$page_id","$url","$action","$categoryid","$date","$ip");
			$value=$useAVclass->insertQuery($tableName,$tableFieldsName_send,$tableFieldsValues_send);
			
			$msg = ADMIN_PASSWORD;
			$_SESSION['edit_prof'] = $msg;
			
			session_unset();
			session_destroy();
			header("location:index.php");
			exit;
	
	}
 }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password : <?php echo $sitename;?></title>
<link rel="SHORTCUT ICON" href="images/favicon.ico" />
<link href="style/admin.css" rel="stylesheet" type="text/css">
<script src="js/sha512.js" type="text/javascript"></script>

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="style/ie7.css">
<![endif]-->


</head>
<body>

<?php include('top_header.php'); ?>
<div id="container">
 <!-- Header start -->
  <?php
		include_once('main_menu.php');
	 ?>
  <!-- Header end -->
  <!--<div id="toolbar-box">
        <div class="m">
          <div class="pagetitle">
            <div class="pagetitle_passimg"></div>
            <div class="pagetitle_heading">
              <h2>Change Password</h2>
            </div>
          </div>
          <div id="toolbar" class="toolbar-list">
            <ul>
				
				<li><a href="editpassword.php" title="Change Password"><span class="icon-28-changepass"></span>Change Password</a></li>
              <li class="divider"> </li>
              <li><span class="icon-28-edit"></span><a href="editProfile.php" title="Manage Profile" >Edit Profile</a></li>
              <li class="divider"> </li>
                          <li><a href="logout.php?random=<?php echo $_SESSION['logtoken'];?>" title="Logout"><span class="icon-28-logout"></span>Logout</a></li> </ul>
          </div>
          <div class="clear"></div>
        </div>
      </div>-->
      
  <div class="main_con">
      <div class="admin-breadcrum">
<div class="breadcrum">
	<span class="submenuclass"><a href="welcome.php">Dashboard</a></span>
			<span class="submenuclass">>> </span>
			<span class="submenuclass">Change Password <?php if(!@preg_match("^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$",'Server@819')){ echo 'yes'; } else { echo 'no'; }?></span>
  </div>
<div class="clear"> </div>
</div>    
      
      <div class="content-content">
	  
	  <div class="right_col1">
			<?php
				if($_SESSION['edit_prof']!=''){?>
				<div  id="msgclose" class="status success">
				<div class="closestatus" style="float: none;">
				<p class="closestatus" style="float: right;"><img alt="Attention" src="images/close.png" class="margintop"></p>
				<p><img alt="Attention" src="images/approve.png" class="margintop"> <span>Attention! </span><?php echo $_SESSION['edit_prof'];
				$_SESSION['edit_prof']=""; ?>.</p>
				</div>
				</div>
				<?php } ?>

				 <?php if($errmsg!=""){?>
				<div  id="msgerror" class="status error">
				<div class="closestatus" style="float: none;">
				<p class="closestatus" style="float: right;"><img alt="Attention" src="images/close.png" class="margintop"></p>
				<p><img alt="error" src="images/error.png"> <span>Attention! <br /></span><?php echo $errmsg; ?></p>
				</div>
				</div>
				<?php }?>
             <div class="grid_view">
 <form id="changepass" name="changepass" method="post" action="" autocomplete="off" onSubmit="return changepassword('changepass');"> 
 
 
 <div class="cpanel-password">
                     <div class="cpanel-right_heading"><h3 class="editprofile">Change Password</h3>  </div>
	
              <div class="frm_row"> <span class="label1">
              <label for="txtpwd">Enter Old Password: </label><span class="star">*</span>
              </span><span class="input1">
              <input name="txtpwd" type="password" class="input_class" id="txtpwd" maxlength="512"  value="" size="40" autocomplete="off"/>
                   </span>
              <div class="clear"></div>
            </div>
            <div class="frm_row"> <span class="label1">
              <label for="txtnpwd">Enter New Password:</label>
              <span class="star">*</span></span> <span class="input1">
              <input name="txtnpwd" type="password" class="input_class" id="txtnpwd" maxlength="512" size="40" autocomplete="off" />
			  <br />
			 <span class="password_help">"Tip:Password must be 8 characters long, contain at least 1 number, at least 1 lower case letter and at least 1 upper case letter."</span>
              </span>
              <div class="clear"></div>
            </div>
 <div class="frm_row"> <span class="label1">
              <label for="txtcpwd">Confirm Password:</label>
              <span class="star">*</span></span> <span class="input1">
              <input name="txtcpwd" type="password" class="input_class" id="txtcpwd" maxlength="512" size="40" autocomplete="off" />
              </span>
              <div class="clear"></div>
            </div>
         <div class="frm_row"> <span class="button_row">
         <input name="cmdsubmit" type="button" class="button" id="cmdsubmit" value="Update" onClick ="return getPass();"/>  <!---onClick ="return getPass();" -->
             <input type="hidden" name="random" value="<?php echo $_SESSION['logtoken'];?>">
             <input name="cmdreset" type="reset" class="button" id="cmdreset" value="Reset" />
             <input type="button" class="button" value="Back" onClick="javascript:location.href = 'auth/adminPanel/index.php';" />
              </span>
              <div class="clear"></div>
            </div>
</form>
 </div>
          <!--<div class="return_dashboard"> <a href="welcome.php">Return to Dashboard</a></div>-->
          <div class="clear"></div>
        </div>

</div><!-- right col -->


    <div class="clear"></div>





  </div>  <!-- main con-->

  <!-- Footer start -->
  
  <?php 
  
			include("footer.inc.php");
    ?>
  <!-- Footer end -->

</div> <!-- Container div-->
<script type="text/javascript">
jQuery(".closestatus").click(function() {
jQuery("#msgclose").addClass("hide");
});
</script>
<script type="text/javascript">
jQuery(".closestatus").click(function() {
jQuery("#msgerror").addClass("hide");
});
</script>
	
<style>
.hide {display:none;}
</style>
<script type="text/javascript" language="javascript">
    function getPass()
    {
		var salt ='<?php print_r($_SESSION["salt"]); ?>'; 
		var salt1 ='<?php print_r($_SESSION["salt1"]); ?>'; 
		var salt2 ='<?php print_r($_SESSION["salt2"]); ?>'; 
		var exp= "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";
       
		var txtpwd = document.getElementById('txtpwd').value;
		var txtnpwd = document.getElementById('txtnpwd').value;
		var txtcpwd = document.getElementById('txtcpwd').value;
     
	  
		if (txtpwd=='')
        {
            alert('Please Enter old password');
            return false;
        }
		if(txtpwd !=''){
			// if (txtnpwd.search(exp)==-1) 
			// 	{
			// 		alert('New Password Minimum eight characters, at least one uppercase letter, one lowercase letter and one number.');
			// 			 return false;
	
			// 	}
		   
		}
		if (txtpwd==txtnpwd)
        {
            alert('New password should not be same as old password');
            return false;
        }
		if (txtcpwd !=txtnpwd)
		{
		 alert('New password and Confirm Password should be same');
            return false;
		} 
		else if (txtnpwd=='') 
        {
            alert('Please enter new password');
            return false;
        }

		else if (txtcpwd=='') 
        {
            alert('Please re-enter new password');
            return false;
        }
	
	
		 else
        {  
		
		// if (txtnpwd.search(exp)==-1) 
        //     {
		// 		alert('New Password must be 8 characters long, contain at least 1 number, at least 1 lower case letter and at least 1 upper case letter.');
		// 			 return false;

        //     }
			// if (txtcpwd.search(exp)==-1) 
            // {
			// 		 alert('Confirm Password must be 8 character long, include at least one special character.');
			// 		 return false;

            // }
			
			

            if ((txtpwd!='') && (txtnpwd!='') & (txtcpwd!='') )
            {
         
				var hash=hex_sha512(txtpwd);
				var hash1=hex_sha512(txtnpwd);
				var hash2=hex_sha512(txtcpwd);
				
				// hash = hex_sha512(txtpwd + '120020066152c6558e3fa461.30017740');
				// hash1 = hex_sha512(txtnpwd + '120020066152c6558e3fa461.30017740');
				// hash2 = hex_sha512(txtcpwd + '120020066152c6558e3fa461.30017740');
				//alert(hash);
                //document.getElementById('txtpassword').value=hash;
				
				
                document.getElementById('txtpwd').value=hash;
				document.getElementById('txtnpwd').value=hash1;
				document.getElementById('txtcpwd').value=hash2;
				
				document.getElementById("changepass").submit();
				
            }


        }
    }
</script>
</body>
</html>
