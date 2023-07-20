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
$_GET['id']=content_desc(base64_decode($_GET['id']));
 if(!is_numeric($_GET['id']) && $_GET['id'] !='')
{
        
        $msg = "Login to Access Admin Panel";
        $_SESSION['sess_msg'] = $msg ;
        header("Location:error.php");
        exit();
}  

@extract($_GET);
@extract($_POST);
@extract($_SESSION);
$role_id=$_SESSION['dbrole_id'];
$user_id=$_SESSION['admin_auto_id_sess'];
$model_id= "16";
$role_map=role_permission($user_id,$role_id,$model_id);
$role_id_page=role_permission_page($user_id,$role_id,$model_id);
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

if(isset($_POST['Submit_g']) && $_GET['id']=='')
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
	

		$user_status=content_desc(check_input($_POST['user_status']));
		$cat_id=content_desc(check_input($_POST['hometype']));
		$txtename= content_desc(check_input($txtename));
		$txtenamehi= content_desc(check_input($txtenamehi));
		$errmsg="";
		
		if(trim($cat_id)=="")
				{
				$errmsg .="Please select media Gallery."."<br>";
				}
		
				if(trim($txtename)=="")
				{
				$errmsg .="Please enter name."."<br>";
				}
			/*	else if(preg_match("/^[a-zA-Z0-9 _.,:\"\']{5,50}+$/", $txtename) === 0)
				{
				$errmsg .= "name must be Alphabet and Special Characters( _.,: ) that should be minimum 5 and maximum 50."."<br>";
				}*/
				if(trim($txtenamehi)=="")
				{
				$errmsg .="Please enter hindi name."."<br>";
				}
			
				
				if(trim($user_status)=="")
				{
				$errmsg .="Please select status."."<br>";
				}
			if($errmsg=='')
			{
			$tableName_send="category";
			$tableFieldsName_old=array("c_name","c_namehi","c_status","cat_id");
			$tableFieldsValues_send=array("$txtename","$txtenamehi","$user_status","$cat_id");
					$value=$useAVclass->insertQuery($tableName_send,$tableFieldsName_old,$tableFieldsValues_send);
					$page_id=mysqli_insert_id($conn);
					$msg=CONTENTADD;
					$_SESSION['SESS_MSG']=$msg;
					header("location:gallery-category.php");
					exit;	
			
			
		
		}		
		
}

}
//	Update Record Start

if(isset($_POST['Submit_g']) && $_GET['id']!='')
		{
		$user_status=content_desc(check_input($_POST['user_status']));
		$txtename1= content_desc(check_input(mysqli_real_escape_string($conn,$txtename)));
		$txtenamehi= content_desc(check_input(mysqli_real_escape_string($conn,$txtenamehi)));
		$cat_id=content_desc(check_input($_POST['hometype']));
				
					if(trim($cat_id)=="")
				{
				$errmsg .="Please select media Gallery."."<br>";
				}
			
				if(trim($txtename)=="")
				{
				$errmsg .="Please enter name."."<br>";
				}
				/*else if(preg_match("/^[a-zA-Z0-9 _.,:\"\']{5,50}+$/", $txtename) === 0)
				{
				$errmsg .= "name must be Alphabet and Special Characters( _.,: ) that should be minimum 5 and maximum 50."."<br>";
				}*/
					if(trim($txtenamehi)=="")
				{
				$errmsg .="Please enter hindi name."."<br>";
				}
				if(trim($user_status)=="")
				{
				$errmsg .="Please select status."."<br>";
				}
		 if($errmsg=='')
		 { 
	$tableName_send="category";
	$whereclause="c_id='".$_GET['id']."'";
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

	$old =array("c_name","c_namehi","c_status","cat_id");
$new =array("$txtename","$txtenamehi","$user_status","$cat_id");
$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);



$msg=CONTENTUPDATE;
$_SESSION['SESS_MSG']=$msg;
//$_SESSION['token'] = "";
//$_SESSION['uniq'] = "";
header("location:gallery-category.php");
exit;	
				
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
		mysqli_query($conn,"delete from category where c_id='$did'");
		$_SESSION['SESS_MSG'] = " Record Successfully Delete";
		header("Location:gallery-category.php");
		exit;
	
	}
 	
 }
			
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Media Categories : <?php echo $sitename;?></title>
<script src="js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="js/demo.js"></script>
<link href="style/admin.css" rel="stylesheet" type="text/css">
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
  <div  id="msgclose" class="status success">
<div class="closestatus" style="float: none;">
<p class="closestatus" style="float: right;"><img alt="Attention" src="images/close.png" class="margintop"></p>
<p><img alt="Attention" src="images/approve.png" class="margintop"> <span>Attention! </span><?php echo $_SESSION['SESS_MSG']; ?></p>
</div>
</div>
          <?php }?>	
      	<div class="clear"></div>
     
        	<div class="addmenu"> 
    <div class="internalpage_heading">
 <h3 class="manageuser">Manage Media Categories </h3>
<div class="right-section">

			 <!--<ul>
			
<?php if($role_map['draft']=='DR' || $user_id=='101'){?><li  class="new-icon">
<a href="gallery-category.php" title="New"><span class="icon-28-new"></span>New</a></li>
              <li class="divider"> </li><?php }?>
             
            </ul>
			-->
 </div>
 </div>	
        <div class="grid_view">
		<form action="" method="post" enctype="multipart/form-data" style="margin:0px; padding:0px;">
		<?php	
	if($_GET['id']!='')
	{
		$rq = mysqli_query($conn,"select * from category where c_id='".$_GET['id']."'");
		//echo "select * from category where c_id='".$_GET['id']."'";
		$rr = mysqli_fetch_array($rq);
		$id=$rr['p_type'];
		$module=$rr['m_type'];
		//print_r($rr);
		}
		
	
?>   

<div class="frm_row"> 
			<span class="label1">
			<label for="hometype">Media Gallery:</label>
			<span class="star">*</span></span> <span class="input1">
			<select name="hometype" id="hometype"  autocomplete="off">
			<option value=""> Select </option> 	
			<?php  foreach($media_type as $key=>$value){?>
				<option value="<?php echo content_desc($key);?>" <?php if($rr['cat_id']==$key){ echo 'selected'; } ?>> <?php echo $value;?> </option>
			
			<?php }
				?>
			</select>
			</span>
			<div class="clear"></div>
			</div>
		
     		   <div class="frm_row"> <span class="label1">
              <label for="txtename"> Name:</label>
              <span class="star">*</span></span> <span class="input1">
			   <input name="txtename" type="text" size="50" class="input_class" id="txtename" value="<?php echo html_entity_decode($rr['c_name']);?>" />
				
				</span>
				<div class="clear"></div>
			  </div>

	    <div class="frm_row"> <span class="label1">
              <label for="txtenamehi">Hindi Name:</label>
              <span class="star">*</span></span> <span class="input1">
			   <input name="txtenamehi" type="text" size="50" class="input_class" id="txtenamehi" value="<?php echo html_entity_decode($rr['c_namehi']);?>" />
				
				</span>
				<div class="clear"></div>
			  </div>
	  <div class="frm_row"> <span class="label1">
              <label for="user_status">Status:</label>
              <span class="star">*</span></span> <span class="input1">
	<select name="user_status" id="user_status" autocomplete="off">
	<option value=""> Select </option>
<?php 
foreach($status as  $key => $value)
{
	?>
<option value="<?php echo content_desc($key) ?>"<?php if($key==$rr['c_status']) echo 'selected="selected"';?>><?php echo $value; ?></option>
<?php }
 ?>
</select></span>
				<div class="clear"></div>
			  </div>
    
      <div class="frm_row"> <span class="button_row">
		<input name="Submit_g" type="submit" class="button" id="cmdsubmit" value="Submit" />
            <input type="hidden" name="random" value="<?php echo $_SESSION['logtoken'];?>">
            <input name="cmdreset" type="reset" class="button" id="cmdreset" value="Reset" />
             <input type="button" class="button" value="Back" onClick="javascript:location.href = 'manage_photo_gallery.php';" />
	</span>
</div>
<div class="clear"></div>

  </form>
<table width="100%" border="0" align="right" cellpadding="2" cellspacing="2" style="border:1px solid #cccccc">
	  <tr bgcolor="whitesmoke">
    <th width="38" align="left" valign="top" bgcolor="whitesmoke" class="topheader_td">S.No</th>
    <th width="510" align="left" valign="top" bgcolor="whitesmoke" class="topheader_td"><span class="left-text">Name</span></th>
	<th width="510" align="left" valign="top" bgcolor="whitesmoke" class="topheader_td"><span class="left-text">Hindi Name</span></th>
	 <th width="47" align="center" valign="top" bgcolor="whitesmoke" class="topheader_td">Status</th>
    <th width="47" align="center" valign="top" bgcolor="whitesmoke" class="topheader_td">Edit</th>
    <th width="63" align="center" valign="top" bgcolor="whitesmoke" class="topheader_td">Delete</th>
    </tr>
	<?php 
	$columns = "select * ";
$sql = "from category where 1 ";
$order_by == '' ? $order_by = 'c_id' : true;
$order_by2 == '' ? $order_by2 = 'DESC' : true;
$sql .= "order by $order_by $order_by2 ";
$sql_count = "select count(*) ".$sql; 
$sql = $columns.$sql;
	$pager = new PS_Pagination($conn, $sql,"");
			$rows = $pager->paginate($conn, $sql,"");
    // $rows = mysqli_query($conn,$sql);
	if($rows==0) { ?>
    <tr><td style="color:#F00;" height="30" align="center" colspan="6"><b>Sorry.. No records available.</b></td></tr>
<?php	}else	{	?>
    
<?php 
while($data=mysqli_fetch_array($rows)){
if($data['c_status']=='1')
	{
	$status="Active";
	}
	else
	{
		$status="Inactive";
	}



?>
  <tr valign="top" onMouseMove="javascript: this.style.background='#ECF1F2'" onMouseOut="javascript: this.style.background='#FFFFFF'">
    <td width="38" align="left"  class="left-tdtext"><?php echo ++$counter;?></td>
      <td width="510" align="left" class="left-tdtext"><?php echo html_entity_decode($data['c_name']);?></td>
	    <td width="510" align="left" class="left-tdtext"><?php echo html_entity_decode($data['c_namehi']);?></td>
	   <td width="50" align="left" class="left-tdtext"><?php echo html_entity_decode($status);?></td>
    <td width="47" align="center" class="left-tdtext"><a href="gallery-category.php?id=<?php echo base64_encode($data['c_id']);?>" class="bluelink"><input type="image" border="0" alt="Edit" src="images/edit.png"  title="Edit" /></a></td>
	
    <td width="63" align="center" class="left-tdtext"><a href="gallery-category.php?did=<?php echo $data['c_id'];?>&random=<?php echo $_SESSION['logtoken'];?>" class="bluelink" onClick="return confirm('Are you sure want to delete record')"><input type="image" border="0" alt="Delete" src="images/deletes-icon.png"  title="Delete" /></a></td>
  </tr>
<?php	}?>
	<tr>
<td colspan="6" align="center"><?php echo $pager->renderFullNav();?></td>
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

