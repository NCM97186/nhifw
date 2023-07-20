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
$user_id=$_SESSION['admin_auto_id_sess'];
$model_id= "4";
$role_map=role_permission($user_id,$role_id,$model_id);
$role_id_page=role_permission_page($user_id,$role_id,$model_id);
$editid = base64_decode($_GET['editid']);

if($_SESSION['admin_auto_id_sess']=='')
	{		
		$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:index.php");
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
if($role_id_page==0)
{
$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:error.php");
		exit;	
}

if(isset($_POST['cmdsubmit']))
{

$txtename =check_input($_POST['txtename']);
	$txtemail =check_input($_POST['txtemail']);
	$txtphone =check_input($_POST['txtphone']);
	$comments= check_input($_POST['comments']);
	$acomments= check_input($_POST['acomments']);
	$txtlanguage= check_input($_POST['txtlanguage']);
//	$txtstatus=check_input($_POST['txtstatus']);
	$sta=$feed_date;
	$feed_date=$sta['2']."-".$sta['1']."-".$sta['0'];
	if(trim($acomments)=="")
		{
			$errmsg .="Please enter comments.<br>";
		}
		if(trim($acomments)!="")
		{
			if (preg_match('/[^a-zA-Z0-9\s\w-&]/i',$acomments))
			{
				$errmsg .= "Comment must be Alphanumeric."."<br>";
			}
		}

if($errmsg == '')
	{
if($_SESSION['logtoken']!=$_POST['random'])
		{
		
		/*session_unset($admin_auto_id_sess);
		session_unset($login_name);
		session_unset($dbrole_id);*/
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
$currentdt=date('Y-m-d h:i:s');		
$tableName_send="feedback_form";
 $whereclause="id='$editid'";
$old=array("review_comment","review_date");
$new=array("$acomments","$currentdt");
$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);

$sql_admin1=mysqli_query($conn,"select * from admin_login");
			$line_admin1=mysqli_fetch_assoc($sql_admin1);
			@extract($line_admin1);
$sql_admin=mysqli_query($conn,"select * from feedback_form where id='$editid'");
	$line_admin=mysqli_fetch_array($sql_admin);
		@extract($line_admin);

		$admin_date=date('F j, Y');
		$feedback_date=date('F j, Y');
		$review_date=date('F j, Y');
		
		$email_from = $user_email; // Who the email is from 
		$email_subject = "Feedback Submission"; // The Subject of the email
		$email_to= $email;
		$headers.= "From: ".$email_from."\r\n"; 
		$headers.= "Content-type: text/html; charset=iso-8859-1\n"; 
		$email_message.="
		<table width='98%' border='0' align='center' cellpadding='2' cellspacing='2' class='normaltext'>
        <tr>
			<td colspan='3' align='left' valign='top'>Dear User,</td>
        </tr>
		    <tr>
			<td colspan='3' align='left' valign='top'>&nbsp;</td>
        </tr>
        <tr>
			<td colspan='3' align='left' valign='top'>Thankyou for your feedback. </td>
        </tr>

		 <tr>
			<td colspan='3' align='left' valign='top'>&nbsp;</td>
        </tr>
         <tr>
			  <td width='30%' align='left' valign='top'><strong>Name</strong></td>
			  <td width='1%' align='left' valign='top'><strong>:</strong></td>
			  <td width='69%' align='left' valign='top'>$name </td>
        </tr>
        <tr>
			<td align='left' valign='top'><strong>Email</strong></td>
			<td align='left' valign='top'><strong>:</strong></td>
			<td align='left' valign='top'>$email</td>
		</tr>

		<tr>
			<td align='left' valign='top'><strong>Phone Number</strong></td>
			<td align='left' valign='top'><strong>:</strong></td>
			<td align='left' valign='top'>$phone</td>
		</tr>

		<tr>
			<td align='left' valign='top'><strong>Comments</strong></td>
			<td align='left' valign='top'><strong>:</strong></td>
			<td align='left' valign='top'>$comments</td>
		</tr>
		<tr>
			<td align='left' valign='top'><strong>Feedback Date</strong></td>
			<td align='left' valign='top'><strong>:</strong></td>
			<td align='left' valign='top'>$feedback_date</td>
		</tr>
		<tr>
		<td align='left' valign='top'><strong>Admin Comments</strong></td>
		<td align='left' valign='top'><strong>:</strong></td>
		<td align='left' valign='top'>$review_comment</td>
		</tr>
		<tr>
		<td align='left' valign='top'><strong>Review Date</strong></td>
		<td align='left' valign='top'><strong>:</strong></td>
		<td align='left' valign='top'>$review_date</td>
		</tr>
		<tr>
			<td colspan='3' align='left' valign='top'>&nbsp;</td>
		</tr>

			<tr>
			<td colspan='3' align='left' valign='top'>Regards,</td>
			</tr>
			<tr>
			<td colspan='3' align='left' valign='top'>Admin</td>
			</tr>

		</table>";	


		$ok=@mail($email_to, $email_subject, $email_message, $headers);
		

//  mail to Admin Ends


  
$user_login_id=$cid;
$page_id=$cid;
$action="update creater mod aprove";
$url =substr(strrchr($_SERVER['PHP_SELF'], "/"), 1);
$categoryid='0';//super admin
$date=date("Y-m-d h:i:s");
$ip=$_SERVER['REMOTE_ADDR'];
	$tableName="audit_trail";
$tableFieldsName_send=array("user_login_id","page_id","page_name","page_action","page_category","page_action_date","ip_address","page_title");
$tableFieldsValues_send=array("$user_login_id","$page_id","$url","$action","$model_id","$date","$ip","$txtepage_title");
$value=$useAVclass->insertQuery($tableName,$tableFieldsName_send,$tableFieldsValues_send);



$msg=FEEDBACK;
$_SESSION['content']=$msg;
header("location:manage_feedback.php");
exit;
}
}
 if(!is_numeric(trim($editid)))
	{
		/*session_unset($admin_auto_id_sess);
		session_unset($login_name);
		session_unset($dbrole_id);*/
		$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:error.php");
		exit();
	}

 $edit="select * from feedback_form where id='$editid'";
 
$result = mysqli_query($conn,$edit);
$res_rows=mysqli_num_rows($result);
$fetch_result=mysqli_fetch_array($result);
@extract($fetch_result);
$sta=$review_date;
//echo $sta;
//exit();
$review_date=$sta['2']."-".$sta['1']."-".$sta['0'];
$create_date=date("d/m/Y", strtotime($create_date));

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reply Feedback: <?php echo $sitename;?></title>
<link rel="SHORTCUT ICON" href="images/favicon.ico" />


<link href="style/admin.css" rel="stylesheet" type="text/css">
<link href="style/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/drop_down.js"></script>
<link href="style/jquery.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/demo.js"></script>
<script language="JavaScript" src="js/validation.js"></script>
<script type="text/javascript" src="js/jquery-latest.js"></script>





<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="style/ie7.css">
<![endif]-->



<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"feed_date",
			dateFormat:"%d-%m-%Y"
		});
		
	};
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
       


<div class="right_col1">
      		 <?php if($errmsg!=""){?>
          <div  id="msgerror" class="status error">
<div class="closestatus" style="float: none;">
<p class="closestatus" style="float: right;"><img alt="Attention" src="images/close.png" class="margintop"></p>
<p><img alt="error" src="images/error.png"> <span>Attention! <br /></span><?php echo $errmsg; ?>.</p>
</div>
</div>
          <?php }?>
		
<div class="clear"></div>

        <div class="addmenu"> 
    <div class="internalpage_heading">
 <h3 class="manageuser">Edit Feedback</h3>

 </div>	
<form action="" method="post" name="form1"  autocomplete="off" enctype="multipart/form-data" onsubmit="return edit_user('form1')">

            <div class="frm_row"> <span class="label1">
              <label>Name:</label>
            </span> <span class="fdinput_class">
             <?php echo $fetch_result['name'];?>
                         </span>
              <div class="clear"></div>
            </div>
            
            <div class="frm_row"> <span class="label1">
              <label>Email:</label>
            </span> <span class="fdinput_class">
              <?php echo $fetch_result['email'];?>
                         </span>
              <div class="clear"></div>
            </div>
               <div class="frm_row"> <span class="label1">
              <label>Phone Number:</label>
               </span> <span class="fdinput_class">
              <?php echo $fetch_result['phone'];?>
                         </span>
              <div class="clear"></div>
            </div>
			<div class="frm_row"> <span class="label1">
              <label>Comments:</label>
			</span> <span class="fdinput_class">
              <?php echo stripslashes($fetch_result['comments']);?>
               </span>
              <div class="clear"></div>
            </div>
			<div class="frm_row"> <span class="label1">
				<label>Date:</label>
			</span> <span class="fdinput_class">
				<?php echo $create_date;?>
				
				</span>
				<div class="clear"></div>
				</div> 
			 <div class="frm_row"> <span class="label1">
              <label>Admin Comment:</label>
               <span class="star">*</span></span> <span class="input1">
             <textarea rows="5" cols="35" name="acomments" autocomplete="off"  id="acomments" ><?php echo stripslashes($review_comment);?></textarea>
               </span>
              <div class="clear"></div>
            </div>
			

  <div class="frm_row"> <span class="button_row"> 
  

<input name="cmdsubmit" type="submit" class="button" id="cmdsubmit" value="Update" />&nbsp;
	<input name="cmdreset" type="reset" class="button" id="cmdreset" value="Reset" />&nbsp <input name="cid" type="hidden" value="<?php echo $fetch_result['id'];?>"/><input type="hidden" name="random" value="<?php echo $_SESSION['logtoken'];?>">&nbsp;<input type="button" class="button" value="Back" onClick="javascript:location.href = 'manage_feedback.php';" />
	</span>
              <div class="clear"></div>
            </div>
</form>
</div>
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

