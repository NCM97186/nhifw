<?php ob_start();
session_start();

include("../../includes/config.inc.php");
include("../../includes/connection.php");
include("../../includes/functions.inc.php");
include("../../includes/useAVclass.php");
include("../../includes/def_constant.inc.php");
include_once 'ckeditor/ckeditor.php';
include_once 'ckfinder/ckfinder.php';
require_once("../../includes/ps_pagination.php");
$useAVclass = new useAVclass();
$useAVclass->connection();
@extract($_GET);
@extract($_POST);
@extract($_SESSION);
$role_id= $_SESSION['dbrole_id'];
$model_id='Manage Employee Category';
$user_id= $_SESSION['admin_auto_id_sess'];
// $role_map= role_permission($user_id,$model_id);


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

if(($role_map['draft'] !='DR' || $role_map['medit'] !='ED') && $user_id !='101')
{
$msg = "Login to Access Admin Panel";
$_SESSION['sess_msg'] = $msg ;
header("Location:error.php");
exit;	
}
if(isset($_POST['Submit_g']) && $_GET['id']=='')
		{
		
		$txtlanguage= check_input($_POST['txtlanguage']);
		$a_status1=check_input($_POST['a_status1']);
		$txtename1= content_desc(check_input($txtename1));
		$r_url=seo_url($txtename1);

		if($txtlanguage=='2')
		{
	
		}
		else {
		if (trim($txtlanguage) == "") {
				$errmsg .= "Please Select Language." . "<br>";
		}
				
		
		
		if(trim($txtename1)=="")
		{
		$errmsg = "Category name must be Alphanumeric and Special ."."<br>";
		}
		if(trim($txtename1)!="")
		{		
		 if (preg_match('/[^a-zA-Z0-9\s\w-&]/i',$txtename1))
			{
				$errmsg .= "Category name must be Alphanumeric and Special Characters( _.,:()&amp ) that should be minimum 2 and maximum 100."."<br>";
			}
			
		}
		
		
		
		
		
		if (trim($a_status1) == "") {
		$errmsg .= "Please select page status." . "<br>";
		}	
		}
		 if($errmsg=='')
		 { 
	 if($_SESSION['logtoken']!=$_POST['random'])
			{
			session_unset($admin_auto_id_sess);
			session_unset($login_name);
			session_unset($dbrole_id);
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
		
			$tableName_send="emp_category";
			$tableFieldsName_old=array("name","status","language_id","page_url");
			$tableFieldsValues_send=array("$txtename1","$a_status1","$txtlanguage","$r_url");
					$value=$useAVclass->insertQuery($tableName_send,$tableFieldsName_old,$tableFieldsValues_send);
					$page_id=mysqli_insert_id($conn);
					$msg=CONTENTADD;
					$_SESSION['SESS_MSG']=$msg;
					header("location:emp_category.php");
					exit;	
			}
			
	}			  
			  

//	Update Record Start
if(isset($_POST['Submit_g']) && $_GET['id']!='')
		{
		
		$txtlanguage= check_input($_POST['txtlanguage']);
		$a_status1=check_input($_POST['a_status1']);
		$txtename1= content_desc(check_input($txtename1));
		$r_url=seo_url($txtename1);
		if (trim($txtlanguage) == "") {
				$errmsg .= "Please Select Language." . "<br>";
		}
				
		if(trim($txtename1)=="")
		{
		$errmsg = "Category name must be Alphanumeric and Special ."."<br>";
		}
		if(trim($txtename1)!="")
		{		
		 if (preg_match('/[^a-zA-Z0-9\s\w-&]/i',$txtename1))
			{
				$errmsg .= "Category name must be Alphanumeric and Special Characters( _.,:()&amp ) that should be minimum 2 and maximum 100."."<br>";
			}
			
		}
		
		
		if (trim($a_status1) == "") {
		$errmsg .= "Please select page status." . "<br>";
		}	
		 if($errmsg=='')
		 { 
	$tableName_send="emp_category";
	$whereclause="id='".base64_decode($_GET['id'])."'";
		if($_SESSION['logtoken']!=$_POST['random'])
		{
		$msg = "Login to Access Admin Panel";
		$_SESSION['SESS_MSG']= $msg ;
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

					
				$old =array("name","status","language_id","page_url");
$new =array("$txtename1","$a_status1","$txtlanguage","$r_url");
$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);
$msg=CONTENTUPDATE;
$_SESSION['SESS_MSG']=$msg;
//$_SESSION['token'] = "";
//$_SESSION['uniq'] = "";
header("location:emp_category.php");
exit();
				
				}
				}
	


 if($_GET['did']!='')
 {
 if(($_SESSION['logtoken']!=$random) or (!is_numeric(trim($did))))
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
		mysqli_query($conn,"delete from emp_category where id='$did'");
		$_SESSION['SESS_MSG'] = " Record Successfully Delete";
		header("Location:emp_category.php");
		exit;
	
	}
 	
 }
			
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Employee Category: NIHFW</title>
<script src="js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="js/demo.js"></script>
<link href="style/admin.css" rel="stylesheet" type="text/css">
<link href="style/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/drop_down.js"></script>
<script language="JavaScript" src="js/validation.js"></script>
<script type="text/javascript" src="js/jsDatePick.js"></script>
<link href="style/jsDatePick.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-latest.js"></script>
<script src="js/jquery.tinylimiter.js"></script>



<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="style/ie7.css">
<![endif]-->

<script>
$(document).ready( function() {
	var elem = $("#chars");
	$("#text").limiter(250, elem);
});
</script>

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
       


	<div class="right_col1">
             <?php if($errmsg!=""){?>
          <div  id="msgerror" class="status error">
<div class="closestatus" style="float: none;">
<p class="closestatus" style="float: right;"><img alt="Attention" src="images/close.png" class="margintop"></p>
<p><img alt="error" src="images/error.png"> <span>Attention! <br /></span><?php echo $errmsg; ?></p>
</div>
</div>
          <?php }?>
		  <?php if($_SESSION['SESS_MSG']!=""){?>
<div  id="msgerror" class="status success">
<div class="closestatus" style="float: none;">
<p class="closestatus" style="float: right;"><img alt="Attention" src="images/close.png" class="margintop"></p>
<p><img alt="error" src="images/approve.png"> <span>Attention! <br /></span><?php echo $_SESSION['SESS_MSG']; ?></p>
</div>
</div>
          <?php }?>	
      	<div class="clear"></div>
     
        	<div class="addmenu"> 
    <div class="internalpage_heading">
 <h3 class="manageuser">Manage Employee Category</h3>
<div class="right-section">

			<!-- <ul>
			
<?php if($role_map['draft']=='DR' || $user_id=='101'){?><li  class="new-icon">
<a href="institution_trade.php" title="New"><span class="icon-28-new"></span>New</a></li>
              <li class="divider"> </li><?php }?>
             
            </ul>-->
			
			
			
			
			
 
 </div>
 </div>	
        <div class="grid_view">
		<form action="" method="post" enctype="multipart/form-data" style="margin:0px; padding:0px;">
		<?php	
	if($_GET['id']!='')
	{
		$rq = mysqli_query($conn,"select * from emp_category where id='".base64_decode($_GET['id'])."'");
		
		$rr = mysqli_fetch_array($rq);
		//print_r($rr);
		}
		
	
?>   

		
     <div class="frm_row"> 
				<span class="label1">
              <label for="txtlanguage">Page Language :</label>
              <span class="star">*</span></span> 
			    <span class="input1">
				<input type="radio" name="txtlanguage" id="txtlanguage" autocomplete="off"  value="1"<?php if($txtlanguage==1){ echo "checked"; } if($rr['language_id']==1){ echo 'checked="checked"';   }?> >English &nbsp;
				 <input type="radio" name="txtlanguage" autocomplete="off" id="txtlanguage"  value="2"<?php if($txtlanguage==2){ echo "checked"; } if($rr['language_id']==2){ echo 'checked="checked"';   }?>/>Hindi
               </span>
              <div class="clear"></div>
			  <div class="loading"></div>
            </div>	

		
		   <div class="frm_row"> <span class="label1">
              <label for="txtename1">Category Name</label>
              <span class="star">*</span></span> <span class="input1">
			   <input name="txtename1" type="text" size="50" class="input_class" id="txtename1" value="<?php if($txtename1!=""){ echo content_desc($txtename1);}  else   echo html_entity_decode($rr['name']);?>" />
				
				</span>
				<div class="clear"></div>
			  </div>
			

	    
	  <div class="frm_row"> <span class="label1">
              <label for="a_status1">Status:</label>
              <span class="star">*</span></span> <span class="input1">
	<select name="a_status1" id="a_status1" autocomplete="off">
	<option value=""> Select </option>
<option value="1" <?php if($a_status1=='1') { echo  'selected="selected"';}  if($rr['status']=='1') { echo 'selected="selected"'; } else {}?>>Active</option>
<option value="0"  <?php if($a_status1=='0') { echo  'selected="selected"';} if($rr['status']=='0') { echo 'selected="selected"'; } else {}?>>Inactive</option>
</select></span>
				<div class="clear"></div>
			  </div>
    
      <div class="frm_row"> <span class="button_row">
		<input name="Submit_g" type="submit" class="button" id="cmdsubmit" value="Submit" />
            <input type="hidden" name="random" value="<?php echo $_SESSION['logtoken'];?>">
            <input name="cmdreset" type="reset" class="button" id="cmdreset" value="Reset" />
             <input type="button" class="button" value="Back" onClick="javascript:location.href = 'welcome.php';" />
	</span>
</div>
<div class="clear"></div>

  </form>
<table width="100%" border="0" align="right" cellpadding="2" cellspacing="2" style="border:1px solid #cccccc">
	  <tr bgcolor="whitesmoke">
    <th width="38" align="left" valign="top" bgcolor="whitesmoke" class="topheader_td">S.No</th>
    <th width="510" colspan="2" align="left" valign="top" bgcolor="whitesmoke" class="topheader_td"><span class="left-text">Name</span></th>
	<th width="510" colspan="2" align="left" valign="top" bgcolor="whitesmoke" class="topheader_td"><span class="left-text">Page Status</span></th>
    <th width="47" align="center" valign="top" bgcolor="whitesmoke" class="topheader_td">Edit</th>
    <th width="63" align="center" valign="top" bgcolor="whitesmoke" class="topheader_td">Delete</th>
    </tr>
	<?php 
$columns = "select * ";
$sql = "from emp_category where 1 ";
$order_by == '' ? $order_by = 'name' : true;
$order_by2 == '' ? $order_by2 = 'ASC' : true;
$sql .= "order by $order_by $order_by2 ";
$sql_count = "select count(*) ".$sql; 
$sql = $columns.$sql;

	$pager = new PS_Pagination($conn, $sql,"");
    $rows = $pager->paginate($conn, $sql,"");
	
	if($rows==0) { ?>
    <tr><td style="color:#F00;" height="30" align="center" colspan="5"><b>Sorry.. No records available.</b></td></tr>
<?php	}else	{	?>
    
<?php 
while($data=mysqli_fetch_array($rows)){
if($data['status']=='0')
{
$status='Inactive';
}
else
{
$status='Active';
}

?>
  <tr valign="top" onMouseMove="javascript: this.style.background='#ECF1F2'" onMouseOut="javascript: this.style.background='#FFFFFF'">
    <td width="38" align="left"  class="left-tdtext"><?php echo ++$counter;?></td>
      <td width="510" colspan="2" align="left" class="left-tdtext"><?php echo html_entity_decode($data['name']);?></td>
	  <td width="510" colspan="2" align="left" class="left-tdtext"><?php echo html_entity_decode($status);?></td>
    <td width="47" align="center" class="left-tdtext"><a href="emp_category.php?id=<?php echo base64_encode($data['id']);?>" class="bluelink"><input type="image" border="0" alt="Edit" src="images/edit.png"  title="Edit" /></a></td>
    <td width="63" align="center" class="left-tdtext"><a href="emp_category.php?did=<?php echo $data['id'];?>&random=<?php echo $_SESSION['logtoken'];?>" class="bluelink" onClick="return confirm('Are you sure you want to delete record')"><input type="image" border="0" alt="Delete" src="images/deletes-icon.png"  title="Delete" /></a></td>
  </tr>
<?php	}?>
	<tr>
<td colspan="5" align="center"><?php echo $pager->renderFullNav();?></td>
</tr>
  <?php }	?> 
	</table>
          			 <div class="clear"></div>
          </div>
          </div>
</div>

<!-- right col -->


    <div class="clear"></div>





<!-- Content Area end -->





 
  </div>  <!-- main con-->

  <!-- Footer start -->
  
  <?php 
  $_SESSION['SESS_MSG']='';
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

