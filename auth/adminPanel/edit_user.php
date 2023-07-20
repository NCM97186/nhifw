<?php ob_start();
session_start();
include("../../includes/config.inc.php");
include("../../includes/useAVclass.php");
include("../../includes/functions.inc.php");
include("../../includes/def_constant.inc.php");
@extract($_GET);
@extract($_POST);
@extract($_SESSION);
$useAVclass = new useAVclass();
$useAVclass->connection();
 $role_id=$_SESSION['dbrole_id'];  
 
if($_SESSION['admin_auto_id_sess']=='')
	{	
			
		$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:index.php");
		exit;	
	}
if($role_id > 0)
{
	
		$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:error.php");
		exit;	
}
if($_SESSION['saltCookie'] !=$_COOKIE['Temp'])
{
	
		session_unset($admin_auto_id_sess);
		session_unset($login_name);
		session_unset($dbrole_id);
		$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:error.php");
		exit;	
}

/*if($role_id !="0")
{
session_unset($admin_auto_id_sess);
session_unset($login_name);
session_unset($dbrole_id);
$msg = "Login to Access Admin Panel";
$_SESSION['sess_msg'] = $msg ;
header("Location:error.php");
exit();	
}*/

if(isset($cmdsubmit))
{
	
//$pwd=generatePassword();
$txtename = check_input($_POST['txtename']);
$txtemail = check_input($_POST['txtemail']);
$txtphone = check_input($_POST['txtphone']);
$dateofbirth= check_input($_POST['dob']);
$sta=explode('-',$dateofbirth);
$dob=$sta['2']."-".$sta['1']."-".$sta['0'];
$roleid = check_input($_POST['roleid']);
$user_status=check_input($_POST['user_status']);
//$modulename=$_POST['modulename'];
$errmsg="";        // Initializing the message to hold the error messages

	if(trim($txtename)=="")
	{
		$errmsg .="Please enter Name."."<br>";
	}
else if(preg_match("/^[aA-zZ][a-zA-Z -]{2,30}+$/", $txtename) == 0)
{
$errmsg .= "Name must be from letters that should be minimum 3 and maximum 30."."<br>";
}
	if(trim($txtemail)=="")
	{
		$errmsg .="Please enter Email Id."."<br>";
	
	}
	elseif(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $txtemail) == 0){   
		$errmsg=$errmsg."Please enter valid email Id."."<br>";
	
	}
	elseif(trim($txtemail)!="")
		{
		$tableName_send="admin_login";
		$field_name="user_email";
		$field_id="id";
		$id=$cid;
		$checkuniqe=edit_check_unique($tableName_send,$field_name,$txtemail,$field_id,$id);
		if($checkuniqe >0)
			{
				$errmsg=$errmsg."User Email Id already exits."."<br>";
			}
			
		}
		if(trim($designation)=="")
	{
		$errmsg .="Please enter Designation."."<br>";
	}
	else if(preg_match("/^[aA-zZ][a-zA-Z -]{2,30}+$/", $designation) == 0)
	{
	$errmsg .= "Designation must be from letters that should be minimum 3 and maximum 30."."<br>";
	}
	if(trim($txtphone)=="")
	{
		$errmsg .="Please enter Phone Number."."<br>";
	
	}
	elseif(!is_numeric(trim($txtphone)))
	{
		$errmsg .="Phone Number should be numeric."."<br>";
	
	}
	else if(preg_match("/^[0-9]{8,12}$/", trim($txtphone)) === 0)
	{
	$errmsg.="Phone Number should be 8 to 12 digits."."<br>";
	}
	if($errmsg == '')
	{
if($_SESSION['logtoken']!=$_POST['random'])
		{
		
		$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:error.php");
		exit();
		}
		else {
		$_COOKIE['Temp']="";
		$_SESSION['saltCookie']="";
		$_SESSION['Temptest']="";
		$saltCookie =uniqid(rand(59999, 199999));
		$_SESSION['saltCookie'] =$saltCookie;
		$_SESSION['Temptest']=$_SESSION['saltCookie'];
		setcookie("Temp",$_SESSION['saltCookie']);
		$_SESSION['logtoken'] =md5(uniqid(mt_rand(), true));
	
	}

	    if($user_status=='1')
		{	
		$salt =rand(19999, 29999);
		$salt1 =rand(31999, 59999);
		$sql_admin_email = "SELECT user_email,user_name,user_status FROM admin_login where id=$cid ";
		$res_admin_email =mysqli_query($conn,$sql_admin_email);
		$res_num_rows=mysqli_num_rows($res_admin_email);
		$data=mysqli_fetch_array($res_admin_email);
		
		if($data['user_status']=='0')
		{	
		
		
		$userid=$salt.$data['id'].$salt1;  
		$email_from = 'dwivedianil007@gmail.com'; // Who the email is from 
		$email_subject = "Password Notification"; // The Subject of the email
		$email_to= $data['user_email'];
		$headers.= "From: ".$email_from."\r\n"; 
		$headers.= "Content-type: text/html; charset=iso-8859-1\n"; 
		$email_message.="<table width='100%'  border='0' cellspacing='0' cellpadding='0' align='left'>
		<tr><td colspan='3' align='left' class='text_mail' >Dear  ".$data['user_name'].",</td></tr>
		<tr><td colspan='3' class='text_mail'>&nbsp;</td></tr>
		<tr> <td colspan='3' align='left' class='text_mail'>Your admin panel login details are as follows:</td></tr>
		<tr><td  colspan='3' class='text_mail'>&nbsp;</td></tr>
		<tr><td width='40%' colspan='3' >
		<table width='50%'  border='0' cellspacing='0' cellpadding='0' align='left'>
		<tr><td width='10%' class='text_mail' align='left' >
		<a href='$HomeURL/auth/adminPanel/reset_password.php?uid=$userid'> Reset your Password</a>
		</td><td width='25%' align='left'>$txtlog </td></tr>
		<tr><td class='text_mail'>&nbsp;</td></tr> </table>
		</td></tr>
		<tr><td class='text_mail' colspan='3'align='left'> LPAI </td></tr>
		</table>";	

		if(mail($email_to, $email_subject, $email_message, $headers))
			{
				$status=1;
			
			}
			else
			{
			
				$status=0;
			}

		$dtime=date("Y-m-d H:i:s");
		//$rest = substr($userid, -8,3);
		$tableName_send="resetpass";
		$tableFieldsName_send=array("username","passtime","uid");
		$tableFieldsValues_send=array("$userid","$dtime","$id");
		$useAVclass->insertQuery($tableName_send,$tableFieldsName_send,$tableFieldsValues_send);
}
		}
		
		
$tableName_send="admin_login";
$whereclause="id='$cid'";
$old=array("user_name","user_email","user_phone","user_status","designation");

$new=array("$txtename","$txtemail","$txtphone","$user_status","$designation");
// print_r($new);
// die();
$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);

/*if($mname !="")
	    {
			$sql=mysqli_query("Delete from map_role where role_id='$cid'");
				while (list ($key,$val) = @each ($mname))
				{
				
				//$selectmenu = implode(',', $_POST['menucategory']);
				//$username= $_POST['username'];
				
				$tableName_send="map_role";
				$tableFieldsName_send=array("role_id","page_id","user_id","module_id");
			$tableFieldsValues_send=array("$RoleArray","$val","$id","$modulename");
				$useAVclass->insertQuery($tableName_send,$tableFieldsName_send,$tableFieldsValues_send);
				
			}
		}
 */
$user_login_id=$cid;
$page_id=$cid;
$action="update creater mod aprove";
$url =substr(strrchr($_SERVER['PHP_SELF'], "/"), 1);
$categoryid='0';//super admin
$date=date("Y-m-d h:i:s");
$ip=$_SERVER['REMOTE_ADDR'];
	$tableName="audit_trail";
$tableFieldsName_send=array("user_login_id","page_id","page_name","page_action","page_action_date","ip_address");
$tableFieldsValues_send=array("$user_login_id","$page_id","$url","$action","$date","$ip");
// print_r($tableFieldsValues_send);
// die();
$value=$useAVclass->insertQuery($tableName,$tableFieldsName_send,$tableFieldsValues_send);
// echo "hiii";
// die();
$msg= "update successfully";
$_SESSION['manage_user']=$msg;
header("location:manage_user.php");
exit;
}
}

$incrytid = base64_decode($editid);
 /*if(!is_numeric(trim($incrytid)))
	{
		/*session_unset($admin_auto_id_sess);
		session_unset($login_name);
		session_unset($dbrole_id);*/
		/*$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:error.php");
		exit();
	}*/

 $editid1=content_desc($incrytid);

 $edit="select user_name,id,login_name,user_email,user_phone,user_dob,role_id as rollstatus,user_status,designation from admin_login where id='$editid1'";
 
$result = mysqli_query($conn,$edit);

$res_rows=mysqli_num_rows($result);
$fetch_result=mysqli_fetch_array($result);

@extract($fetch_result);


$sta= explode('-',$user_dob);

//echo $sta;
//exit();
$date_of_birth=$sta['2']."-".$sta['1']."-".$sta['0'];


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit User : <?php echo $sitename;?></title>
<link rel="SHORTCUT ICON" href="images/favicon.ico" />
<link href="style/admin.css" rel="stylesheet" type="text/css">
<link href="style/jsDatePick.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery-1.11.2.js"></script>
<script language="JavaScript" src="js/validation.js"></script>
<script type="text/javascript" src="js/jsDatePick.js"></script>

<script type="text/javascript">    dropdown('nav', 'hover', 1);</script>

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="style/ie7.css">
<![endif]-->
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"dob",
			dateFormat:"%d-%m-%Y"
		});
		
	};
function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
	      {
              return false;
		  }
		else
		  {
              return true;
		  }
    }  

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
// alert('online');
}else{
alert('offline');
window.location='index.php';
} 
</script>
</head>
<body>
<?php include('top_header.php'); ?>
<div id="container">

<!-- Header start -->
  

  <?php
		include_once('main_menu.php');
	 ?>
  <!-- Header end -->
  
  <div class="main_con">
<div class="admin-breadcrum">
<div class="breadcrum">
	<span class="submenuclass"><a href="welcome.php">Dashboard</a></span>
			 <span class="submenuclass">>> </span> 
			<span class="submenuclass"><a href="manage_user.php">Manage User Management</a></span>
			<span class="submenuclass">>> </span>
			<span class="submenuclass">Edit User</span>
  </div>
<div class="clear"> </div>
</div>    


<div class="right_col1">
      		 <?php if($errmsg!=""){?>
          <div  id="msgerror" class="status error">
<div class="closestatus" style="float: none;">
<p class="closestatus" style="float: right;"><img alt="Attention" src="images/close.png" class="margintop"></p>
<p><img alt="error" src="images/error.png"> <span>Attention! <br /></span><?php echo $errmsg; ?></p>
</div>
</div>
          <?php }?>
	<div class="addmenu"> 
    <div class="internalpage_heading">
 <h3 class="manageuser">Edit  User</h3>
 
 

 </div>		
<div class="clear"></div>
 <p>&nbsp;</p>
<form action="" method="post" name="form1"  autocomplete="off" enctype="multipart/form-data" onsubmit="return edit_user('form1')">
<div class="frm_row"> <span class="label1">
              <label>User Id :</label>
             </span><span class="label2"><?php echo $fetch_result['login_name'];?>
              
                         </span>
              <div class="clear"></div>
            </div>
            
            <div class="frm_row"> <span class="label1">
              <label for="txtename">Name:</label>
              <span class="star">*</span></span> <span class="input1">
              <input name="txtename" autocomplete="off" type="text" class="input_class" id="txtename" size="30" value="<?php echo $fetch_result['user_name'];?>"/>
                         </span>
              <div class="clear"></div>
            </div>
            
            <div class="frm_row"> <span class="label1">
              <label for="txtemail">Email:</label>
              <span class="star">*</span></span> <span class="input1">
               <input name="txtemail" autocomplete="off" type="text" class="input_class" id="txtemail" size="30" value="<?php echo $fetch_result['user_email'];?>"/>
                         </span>
              <div class="clear"></div>
            </div>
			 <div class="frm_row"> <span class="label1">
              <label for="designation">Designation:</label>
              <span class="star">*</span></span> <span class="input1">
               <input name="designation" autocomplete="off" type="text" class="input_class" id="designation" size="30" value="<?php echo $fetch_result['designation'];?>"/>
                         </span>
              <div class="clear"></div>
            </div>
               <div class="frm_row"> <span class="label1">
              <label for="txtphone">Phone Number:</label>
              <span class="star">*</span></span> <span class="input1">
              <input name="txtphone" autocomplete="off" type="text" class="input_class" id="txtphone" maxlength="12" size="13" value="<?php echo $fetch_result['user_phone'];?>" onkeypress="return isNumberKey(event)"/>
                         </span>
              <div class="clear"></div>
            </div>

			           
            <div class="frm_row"> <span class="label1">
              <label for="user_status">User Status:</label>
            </span> <span class="input1">
              <select name="user_status" id="user_status" autocomplete="off">
	<option value=""> Select </option>
<?php 
foreach($status as  $key => $value)
{
	?>
<option value="<?php echo $key; ?>"<?php if($key==$fetch_result['user_status']) echo 'selected="selected"';?>><?php echo $value; ?></option>
<?php }
 ?>
</select>
                         </span>
              <div class="clear"></div>
            </div>
 




</div>

<div class="frm_row"> <span class="button_row"> 
  

<input name="cmdsubmit" type="submit" class="button" id="cmdsubmit" value="Update" />&nbsp;
	<input name="cmdreset" type="submit" class="button" id="cmdreset" value="Reset" />&nbsp <input name="cid" type="hidden" value="<?php echo $fetch_result['id'];?>"/><input type="hidden" name="random" value="<?php echo $_SESSION['logtoken'];?>">&nbsp;<input type="button" class="button" value="Back" onClick="javascript:location.href = 'manage_user.php';" />
	</span>
              <div class="clear"></div>
            </div>
</form>
</div><!-- right col -->


    <div class="clear"></div>





<!-- Content Area end -->





  </div>  <!-- area div-->
  </div>  <!-- main con-->

  <!-- Footer start -->
  
  <?php 
  
			include("footer.inc.php");
    ?>
  <!-- Footer end -->

</div> <!-- Container div-->
</body>
</html>
<script type="text/javascript">
$(".closestatus").click(function() {
$("#msgerror").addClass("hide");
});
</script>
	
<style>
.hide {display:none;}
</style>

