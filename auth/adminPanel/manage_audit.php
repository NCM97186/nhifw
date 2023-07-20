<?php ob_start();
session_start();
include("../../includes/config.inc.php");
require_once "../../includes/connection.php";
include("../../includes/useAVclass.php");
include("../../includes/functions.inc.php");
include("../../includes/def_constant.inc.php");
require_once("../../includes/ps_pagination.php");
@extract($_GET);
@extract($_POST);
@extract($_SESSION);
$useAVclass = new useAVclass();
$useAVclass->connection();

$role_id=$_SESSION['dbrole_id'];
$user_id=$_SESSION['admin_auto_id_sess'];
// $role_map=role_permission($role_id,$model_id);


if($_SESSION['admin_auto_id_sess']=='')
	{		
		$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:index.php");
		exit;	
	}
if($_SESSION['saltCookie']!=$_COOKIE['Temp'])
{
		session_unset($admin_auto_id_sess);
		session_unset($login_name);
		session_unset($dbrole_id);
		$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:error.php");
		exit;	
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
if($role_id !='0' && $user_id !='101')
{
		$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:error.php");
		exit;	
}

if($btnsubmit=="Search" || $sub_flag_id!='')
{
	  $user =content_desc(check_input($_POST['user']));
		$sub_flag_id =content_desc(check_input($_POST['sub_flag_id']));
		$btneng =content_desc(check_input($_POST['btneng']));
$startdate =content_desc(check_input($_POST['startdate']));
		$expairydate =content_desc(check_input($_POST['expairydate']));
	  
	   if($user!='')
		{
				if(preg_match("/^[aA-zZ][a-zA-Z -]{2,20}+$/", trim($user)) == 0)
				{
					//$errmsg = 'Name must be from letters that should be minimum 3 and maximum 20.<br>';
				}
				else
				 {
					$querywhere .=" and page_name LIKE '%$user%'"; 
					
				 }
		}

		
	/*if($btneng!='')
	  {
		
		unset($_SESSION['lname']); 
		$_SESSION['lname']=$btneng;
			if($_SESSION['lname']=='English'){ $language='1';
				} else { $language='2';
			}
			$querywhere .=" and audit_trail.lang=$language";
	  }*/
	if($btneng!='')
	{	
		unset($_SESSION['lname']); 
		$_SESSION['lname']=$btneng;
			if($_SESSION['lname']=='English')
			{ 
				$language='1';
				} 
				else 
				{ 
				$language='2';

				if($module_id=='6' || $model_id=='8')
				  {
					$querywhere .=" and audit_trail.lang='0'";
					 
				  }
				  else
					{
					  $querywhere .=" and audit_trail.lang=$language";
					}

			}

			
	}
  if($sub_flag_id!='')
	  {
	
			$querywhere .=" and audit_trail.page_category='$sub_flag_id'";
	  }
	    if($startdate!='' && $expairydate !='')
	  {
	
	$sta=split('-',$startdate);
$startdate=$sta['2']."-".$sta['1']."-".$sta['0'];
$exp=split('-',$expairydate);
$expairydate=$exp['2']."-".$exp['1']."-".$exp['0'];
			$querywhere .=" and date(audit_trail.page_action_date) between '$startdate' and '$expairydate'";
	  }
	  
	  if($errmsg=='')	
	  {
$sqlquery1="SELECT admin_login.`user_name` , admin_login.`login_name`,audit_trail.* from audit_trail inner join admin_login ON audit_trail.user_login_id = admin_login.id  where 1 $querywhere order by audit_id desc";

//$sqlquery="SELECT admin_login.`user_name` , admin_login.`login_name`, content_state.state_name, audit_trail.* from audit_trail
//inner join admin_login ON audit_trail.user_login_id = admin_login.id 
//inner join content_state on audit_trail.approve_status = content_state.state_id where 1 $querywhere";
		}
		else
		{
			$_SESSION['errors']=$errmsg;
		}							

}
else 
{
$sqlquery1="SELECT admin_login.`user_name` , admin_login.`login_name`,audit_trail.* from audit_trail inner join admin_login ON audit_trail.user_login_id = admin_login.id  where 1 order by audit_id desc";

}
//echo $_SESSION['content'];
function user($id)
{
	require('includes/connection.php');
	$sql=mysqli_query($conn,"SELECT *
FROM `admin_login` where id=$id");
	$row=mysqli_fetch_array($sql);
	echo $name=$row['user_name'];
	$loginname=$row['login_name'];	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="content-Type" content="text/html; charset=utf-8" />
	<title>Manage Audit:<?php echo $sitename;?></title>
	<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
	<script src="js/jquery.cookie.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.colorbox.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script src="js/jquery.treeview.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/demo.js"></script>
	<link href="style/admin.css" rel="stylesheet" type="text/css" />
	<link href="style/dropdown.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/drop_down.js"></script>
	<script type="text/javascript" src="style/validation.js"></script>
	<script type="text/javascript" src="js/jsDatePick.js"></script>
	<link href="style/jsDatePick.css" rel="stylesheet" type="text/css" />



<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="style/ie7.css">
<![endif]-->








	<style></style>
<script type="text/javascript">
window.onload = function(){
	new JsDatePick({
		useMode:2,
		target:"startdate",
		dateFormat:"%d-%m-%Y"
	});
	new JsDatePick({
		useMode:2,
			target:"expairydate",
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

</script>	</head>

	<body>
<?php include('top_header.php'); ?>
<div id="container"> 
    

  <?php
		include_once('main_menu.php');
	 ?>
  <!-- Header end -->
  
  <div class="main_con">
      <div class="admin-breadcrum">
<div class="breadcrum">
  <span class="submenuclass"><a href="welcome.php">Dashboard</a></span>
  <span class="submenuclass">>> </span> 
<span class="submenuclass">Manage Audit Trail</span>

			
		
</div>
<div class="clear"> </div>
</div>    

          <div class="right_col1">
              <div class="clear"></div>

		 <?php if($_SESSION['content']!=""){?>
        <div  id="msgclose" class="status success">
<div class="closestatus" style="float: none;">
<p class="closestatus" style="float: right;"><img alt="Attention" src="images/close.png" class="margintop"></p>
<p><img alt="Attention" src="images/approve.png" class="margintop"> <span>Attention! </span><?php echo $_SESSION['content'];
$_SESSION['content']=""; ?></p>
</div>
</div>
                    <?php  
 }?>
  <?php if($_SESSION['errors']!=""){?> 
<div  id="msgerror" class="status error">
<div class="closestatus" style="float: none;">
<p class="closestatus" style="float: right;"><img alt="Attention" src="images/close.png" class="margintop"></p>
<p><img alt="error" src="images/error.png"> <span>Attention! <br /></span><?php echo $_SESSION['errors']; $_SESSION['errors']="";?></p>
</div>
</div>
  <?php }?>      
<div class="clear"></div>
<?php
$sql="SELECT * FROM admin_role where admin_role.user_id='$user_id'";
	$rs=mysqli_query($conn,$sql)	;
	$role_module=mysqli_fetch_array($rs);
	 $module_id =$role_module['module_id'];
        if($module_id=='ALL')
		  { 
	$edit_contrator ="SELECT * FROM module where module_language_id='1'  and module_id!='8' and module.module_status='Active' ";
$contrator_result = mysqli_query($conn,$edit_contrator);
$res_rows=mysqli_num_rows($contrator_result);
?>
<div class="addmenu"> 
<div class="internalpage_heading">
 <h3 class="manageuser">Manage Audit</h3>

 </div>
<div class="add_audit">


<form action="" method="post" name="frm1" autocomplete="off">
<label for="user" class="labelClass">Page name:</label>
<input id="user"   name="user" type="text" title="Search title or alias."   size="10" value="<?php echo content_desc($_POST['user']);?>" >
<label for="sub_flag_id" class="labelClass">Module:</label>
<select name="sub_flag_id" autocomplete="off" id="sub_flag_id"  size="1"  style="width: 225px">
<option value=""> Select </option>
<?php 
while($fetch_result=mysqli_fetch_array($contrator_result))
{ 
?>
<option value="<?php echo content_desc($fetch_result['module_id']); ?>"  <?php if ($sub_flag_id==$fetch_result['module_name']) echo 'selected="selected"';?>><?php echo $fetch_result['module_name']; ?> </option>
<?php
}
	  }
?>
						</select>
					<label for="startdate" >From Date:</label>
					
					<input type="text" name="startdate"  autocomplete="off" id="startdate" value="<?php echo htmlentities($startdate);?>" size="10"  onkeypress="return isNumberKey(event)"/>
					<label for="expairydate" >To Date:</label>
					<input type="text" name="expairydate"  autocomplete="off" id="expairydate" value="<?php echo htmlentities($expairydate);?>" size="10"  onkeypress="return isNumberKey(event)"/>
					<!--<label for="" class="labelClass">Language:</label>		
					<select class="inputbox" name="btneng">
					<option value="English"<?php if($_SESSION['lname']=='English') echo 'selected=selected'?>>English</option>
					<option value="Hindi"<?php if($_SESSION['lname']=='Hindi') echo 'selected=selected'?>>Hindi</option>
					</select>	-->
					<input type="submit" value="Search" class="button" name="btnsubmit"  />
					</form>
							</div>

 <div class="clear"></div>
 <div class="grid_view">

<?php 
$result=mysqli_query($conn,$sqlquery);
$auditdata = mysqli_fetch_array($result);

?>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                  <tr>

								 
                                  <th width="25%">Module Name / Page Name</th>
                                  <th width="30%">Title</th>
                                  <th width="10%">Page Date</th>
                                  <th width="10%">User Name</th>
                                  <th width="10%">Page Action</th>
								   <th width="10%">IP Address</th>
								   <th width="10%">Current State</th>
								  
                                </tr>
                                  <?php
								  
								
						$pager = new PS_Pagination($conn, $sqlquery1,"sub_flag_id=$sub_flag_id");
		 				$rs = $pager->paginate($conn, $sqlquery1,"sub_flag_id=$sub_flag_id");
                       // $rs = mysqli_query($conn,$sqlquery1);          
						if($rs > 0)
						{
						while($data1 = mysqli_fetch_array($rs))
						{ 
						//print_r($data1);
						@extract($data1);
						
					
						$page_action_date=date("d-m-Y", strtotime($page_action_date));

						if($class=="odd")
							{
								$class="even";
							}
							else
							{
								$class="odd";
							}
							?>
						
					
							

                                  <tr class="<?php echo $class;?>">
								
                                  <td align="left" class="black-text1">&nbsp;<?php 
										if(is_numeric($page_category))
										{echo $page_name;}
									else{echo $page_category;} ?></td>
                                  <td align="left" class="black-text1">&nbsp;<?php echo $page_name; ?></td>
                                  <td align="left" class="link2">&nbsp;
                                     <?php echo ($page_action_date); ?></td>
                                  <td align="left" class="black-text1">&nbsp;
                                      <?php user($user_login_id); ?></td>
                                  <td align="left" class="black-text1">&nbsp;
                                   <?php echo $page_action; ?>
								  </td>
								  <td align="left" class="black-text1">&nbsp;
                                   <?php echo $ip_address; ?>
								  </td>
								  <td align="left" class="black-text1">&nbsp;
                                   <?php status($approve_status); ?>
								  </td>
								

                                </tr>
                                  <?php 
						}
						?>
                                  <tr>
                                  <td colspan="7" align="center"><?php echo $pager->renderFullNav();?></td>
                                </tr>
                         
                                  <?php  }
						else
						{ 
						?>
                                  <tr>
                                  <td colspan="7" align="center">&nbsp; No record found.</td>
                                </tr>
                                  <?php 
						} ?>
                                </table>
							
          <!-- right col -->
          
          <div class="clear"></div>
          
          <!-- Content Area end --> 
          
  </div>
      <!-- main con--> 
      
      <!-- Footer start -->
      
      <?php 
  
			include("footer.inc.php");
    ?>
      <!-- Footer end --> 
      
 </div>
    </div>
<!-- Container div-->

<script type="text/javascript">
$(".closestatus").click(function() {
$("#msgclose").addClass("hide");
});
</script>
<script type="text/javascript">
$(".closestatus").click(function() {
$("#msgerror").addClass("hide");
});
</script>
	
<style>
.hide {display:none;}
</style>




</body>
</html>
