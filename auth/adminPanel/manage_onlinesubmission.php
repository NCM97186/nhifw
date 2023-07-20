<?php ob_start();
session_start();
include("../../includes/config.inc.php");
require_once "../../includes/connection.php";
include("../../includes/useAVclass.php");
include("../../includes/def_constant.inc.php");
include("../../includes/functions.inc.php");
require_once("../../includes/ps_pagination.php");
@extract($_GET);
@extract($_POST);
@extract($_SESSION);
$useAVclass = new useAVclass();
$useAVclass->connection();
$role_id=$_SESSION['dbrole_id'];
$user_id=$_SESSION['admin_auto_id_sess'];
$model_id='Manage Feedback';

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
if($_SESSION['lname'] =="")
{
$_SESSION['lname']='English';
}
if($_SESSION['lname']=='English')
{
$language='1';
}
else if($_SESSION['lname']=='Hindi')
{
$language='2';
}

if($deleteid !='')
{
if(($_SESSION['logtoken']!=$random) or (!is_numeric(trim($deleteid))))
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
$check_status=check_delete($role_id,$txtstatus,$model_id);
if($check_status >0)
{
		$sql="Delete From online_submission where id='$deleteid'";
		$res=mysqli_query($conn,$sql);
		$page_id=mysqli_insert_id($conn);
		$SQL1 = "SELECT * FROM audit_trail where page_id='$deleteid'";
		$Query = mysqli_query($conn,$SQL1);
		$pagename  = mysqli_fetch_assoc($Query,0,'page_name');
		$txtlanguage  = mysqli_fetch_assoc($Query,0,'lang');
		$txtstatus  = mysqli_fetch_assoc($Query,0,'approve_status');
		$gallery_categoryname  = mysqli_fetch_assoc($Query,0,'page_title');
		$user_id=$_SESSION['admin_auto_id_sess'];			
		$page_id=mysqli_insert_id($conn);
		$action="Delete";
		$categoryid='1'; //mol_content
		$date=date("Y-m-d h:i:s");
		$ip=$_SERVER['REMOTE_ADDR'];
		$model_id='Manage Feedback';

		$tableName="audit_trail";
		$tableFieldsName_send=array("user_login_id","page_id","page_name","page_action","page_category","page_action_date","ip_address","lang","page_title","approve_status");
		$tableFieldsValues_send=array("$user_id","$deleteid","$pagename","$action","$model_id","$date","$ip","$txtlanguage","$gallery_categoryname","$txtstatus");
		$useAVclass->insertQuery($tableName,$tableFieldsName_send,$tableFieldsValues_send);

		if($res)
		{	
		header("location:delete.php?status=deletefeedback");
		}
}
else
{
$msg = "Login to Access Admin Panel";
$_SESSION['sess_msg'] = $msg ;
header("Location:error.php");
exit();
}	
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Manage Feedback: <?php echo $sitename;?></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jsDatePick.js"></script>
	<link href="style/jsDatePick.css" rel="stylesheet" type="text/css" />

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
alert('ofline');
window.location='index.php';
} </script>

<script type="">

			var delete_id = '';
			var searchUrl = '?';
			var search_q = '';
			function doSearch()
			{  // alert("2");

				var searchParam = '';
				var btneng = $.trim($('#btneng').val());
				var startdate = $.trim($('#startdate').val());
				var expairydate = $.trim($('#expairydate').val());
				
				
				console.log(btneng);
				

				if(btneng !='')
				{
					searchParam += '&btneng='+btneng;

				}
				if(startdate != '')
				{
				   searchParam += '&startdate='+startdate;

				}
				if(expairydate != '')
				{
				   searchParam += '&expairydate='+expairydate;

				}
				console.log( searchUrl+searchParam);
				window.location = searchUrl+searchParam;

			}
		</script>


	</head>
	<body>
<?php include('top_header.php'); ?>
<div id="container">     

  <?php
		include_once('main_menu.php');
	 ?>
  <!-- Header end -->
  <div class="main_con">
       
      <div id="validterror" style="color:#F00" align="center"></div>   
        <div class="right_col1">
            <div class="clear"></div>
			<?php 
				$querywhere ='';
				if($btnsubmit=="Search")
				{
				$filter_search1 =content_desc(check_input($_POST['filter_search']));
				$institution =content_desc(check_input($_POST['institution']));

				//$txtstatus1 =content_desc(check_input($_POST['txtstatus']));
					
		if($filter_search!='')
		{

			if(preg_match("/^[aA-zZ][a-zA-Z -]{2,20}+$/", trim($filter_search)) == 0)
				{
				$errmsg = 'Name must be from letters that should be minimum 2 and maximum 20.<br>';
				}
				else
				 {
					$querywhere .=" and name LIKE '%$filter_search1%'"; 
				 }
		}	
	}
		else{
			$query ="select * from online_submission";
			}
			?> 
 
 <?php if($_SESSION['content']!=""){?>
  <div  id="msgclose" class="status success">
<div class="closestatus" style="float: none;">
<p class="closestatus" style="float: right;"><img alt="Attention" src="images/close.png" class="margintop"></p>
<p><img alt="Attention" src="images/approve.png" class="margintop"> <span>Attention! </span><?php echo $_SESSION['content'];
$_SESSION['content']=""; ?>.</p>
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

 <div class="internalpage_heading">
 <h3 class="manageuser">Manage Onlinesubmission
</h3>
 <div class="right-section">
 <ul>

 <?php if($_SESSION['admin_auto_id_sess']=='101'){ ?>
	<!--<li>
		<a href="download_feedback_excel.php" title="Export Feedback"><span class="icon-28-new"></span>Export Feedback</a>
	</li>-->
	
	
	<li class="divider"> </li>			  
		<?php }?>
	</ul>
 </div>
</div>
 <script type="">
                  function checkEmpty(href) {
                    if(href=='#'){
                       alert('please select item which you want to edit');
                        return false;
                    }
                      else {
                        return true;
                    }

	}
  </script>
    

<div class="tab-container" id="outer-container"  style="padding:5px 5px -12px  0px">
<div class="grid_view">
<div class="new-gried">
<div class="add_audit"> 

<form id="manage_menu" name="manage_menu" method="post" action="">
 <div class="filter-select fltrt">          
<label class="filter-search-lbl" for="filter_search">Filter:</label>
<input id="filter_search" type="text" title="Search title or Menu Name." value="" name="filter_search">
<select name="institution" id="institution" autocomplete="off" onChange="addevent(this.value)" >
<option value="">Select</option>
<?php 
foreach($Institution_type as $key=>$value)
{
	?>
<option value="<?php echo $key; ?>" <?php if($key==$institution){ echo 'selected="selected"'; } else { }?>><?php echo $value; ?></option>
<?php }
 ?>
</select>
  <input type="submit" name="btnsubmit" value="Search" class="button_m"/>	

	<a href="onlinesubmission_export.php?pid=" class="btn btn-primary"><input name="btnsubmit" value="Export to Excel" class="button_m" type="button"></a>		
 
		
</div>
			
</div>
<div class="clear"></div>
          
 </form>

<table width="100%" border="1" cellspacing="2" cellpadding="2" summary="" >
  <tr>			 
  <th width="20%">Institution Name</th>
  <th width="20%">Email</th>
  <th width="12%">Phone</th>
  <th width="14%">Options</th>
</tr>
</table>
		
  <div id="list">
    <div id="response"> </div>  

		<?php	
				if($btneng !=''){
					$string_url = "btneng=".$btneng;
				}
				if($startdate !=''){
					$string_url .= "&startdate=".$startdate;
				}
				if($expairydate !=''){
					$string_url .= "&expairydate=".$expairydate;
				}
				
				$pagn=$_GET['page'];
				if($pagn!=''){
				 $pagnn="&page=".$pagn;
					}

		$pager = new PS_Pagination($conn, $query,$string_url);
		$rs = $pager->paginate($conn, $query,$string_url);
					// $rs = mysqli_query($conn,$query); 
		if($rs > 0){
		?>
		<ul class="">
		<?php 
		while($data = mysqli_fetch_array($rs))
		{ 
		@extract($data);
		if($class=="odd")
		{
		$class="even";
		}
		else
		{
		$class="odd";
		}
		?>
		<li id="arrayorder_<?php echo $id ?>" class="<?php echo $class;?>">
			
		<span class="space-menuname"><?php echo $institution_name ; ?></span>		
		<span class="space-menuname"><?php echo $email; ?></span>
	    <span class="space-lang"><?php echo $phone; ?></span>	
        
		<span class="space-option">
			<a href="javascript:void(0);" class="cat_link" title="View" onclick="MM_openBrWindow('onlinesubmissionview.php?page_id=<?php echo base64_encode($id);?>','window','width=900,height=400,scrollbars=yes')">View </a> 
		</span>
		<div class="clear"></div>
		</li><?php }?>

		</ul>
		<div class="page" style="text-align:center;"><?php echo $pager->renderFullNav();?></div>
			<?php } else
		{ ?><ul> <li style="text-align:center"> No record found.</li></ul>
		<?php } ?>
  </div>
			</div>
</div>
		<!-- right col -->

<div class="clear"></div>
</div>	
  </div>
  <!-- main con-->  
  
       
 </div>
         
           
    </div>
<!-- Container div-->
    <!-- Footer start --> 
  <script type="text/javascript">
		  function getUrl(id) {

			  document.getElementById('edit').href='edit_feedback.php?editid='+btoa(id)+'<?php echo $pagnn; echo '&'.$string_url;?>';
		  }
</script>

 <?php include("footer.php");  ?>
<!-- Footer end --> 
<script src="http://code.jquery.com/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script> 
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.colorbox.js"></script>
<script src="js/jquery.cookie.js" type="text/javascript"></script>
<script src="js/jquery.treeview.js" type="text/javascript"></script>
<script type="text/javascript" src="js/validation.js"></script>
<script src="js/demo.js" type="text/javascript"></script> 

<script>
	function MM_openBrWindow(theURL,winName,features) 
	{ 
		window.open(theURL,winName,features);
	}
	</script>
	<script type="text/javascript">

jQuery(document).ready(function(){ 	
	  function slideout(){
  setTimeout(function(){
  jQuery("#response").slideUp("slow", function () {
      });
    
}, 2000);}
	
    jQuery("#response").hide();
	jQuery(function() {
	jQuery("#list ul").sortable({ opacity: 0.8, cursor: 'move', update: function() {
			
			var order = jQuery(this).sortable("serialize") + '&update=update' + '&tab=manage'; 
			jQuery.post("updateList.php", order, function(theResponse){
				jQuery("#response").html(theResponse);
				jQuery("#response").slideDown('slow');
				slideout();
			}); 															 
		}								  
		});
	});

});	

$(function() { 
   
	$("#start").datepicker({
		dateFormat:'yy-mm-dd',
		onSelect: function(selected) {
			$("#end").datepicker("option","minDate", selected)
		}
	});
	$("#end").datepicker({
		dateFormat:'yy-mm-dd',
		onSelect: function(selected) {
			$("#start").datepicker("option","maxDate", selected)
		}
	});
});

</script>
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
</script>
</body>
</html>
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
</body>
</html>
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