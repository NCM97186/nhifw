<?php ob_start();
session_start();
include("../../includes/config.inc.php");
include("../../includes/useAVclass.php");
include("../../includes/functions.inc.php");
include("../../includes/def_constant.inc.php");
include_once 'ckeditor/ckeditor.php';
include_once 'ckfinder/ckfinder.php';

$_GET['editid']=content_desc($_GET['editid']);

if(!is_numeric($_GET['editid']) && $_GET['editid'] !='')
{
        /*session_unset($admin_auto_id_sess);
        session_unset($login_name);
        session_unset($dbrole_id);*/
        $msg = "Login to Access Admin Panel";
        $_SESSION['sess_msg'] = $msg ;
        header("Location:error.php");
        exit();
}  


$useAVclass = new useAVclass();
$useAVclass->connection();
$role_id=$_SESSION['dbrole_id'];
$user_id=$_SESSION['admin_auto_id_sess'];
$model_id= "3";
$role_map=role_permission($user_id,$role_id,$model_id);
$role_id_page=role_permission_page($user_id,$role_id,$model_id);
if($_SESSION['admin_auto_id_sess']=='')
	{	
	session_unset($admin_auto_id_sess);
	session_unset($login_name);
	session_unset($dbrole_id);
	$msg = "Login to Access Admin Panel";
	$_SESSION['sess_msg'] = $msg ;
	header("Location:index.php");
	exit;	
	}
if($role_id_page==0)
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

if($_SESSION['lname']=='English')
{
$lan='1';
}
else if($_SESSION['lname']=='Hindi')
{
$lan='2';
}
if(isset($cmdsubmit) && $_GET['editid']=='')
{
$txtlanguage= content_desc(check_input($_POST['txtlanguage']));
$txtename = content_desc(check_input($_POST['txtename']));
$title = content_desc(check_input($_POST['txtetitle']));

$sortcontentdesc= content_desc(check_input($_POST['sortcontentdesc']));
$newicons = content_desc(check_input($_POST['newicons']));
$txtcontentdesc= content_desc(check_input($_POST['txtcontentdesc']));
$txtstatus=content_desc(check_input($_POST['txtstatus']));
$txtcategory=content_desc(check_input($_POST['txtcategory']));
$url=seo_url($txtetitle);
$startdate1 = content_desc(check_input($_POST['startdate']));
$expairydate1 = content_desc(check_input($_POST['expairydate']));
$sta = split('-', $startdate1);
$startdate = $sta['2'] . "-" . $sta['1'] . "-" . $sta['0'];
$exp = split('-', $expairydate1);
$expairydate = $exp['2'] . "-" . $exp['1'] . "-" . $exp['0'];
$createdate=date('Y-m-d');
$errmsg=""; 
	if(trim($txtlanguage)=="")
	{
	$errmsg .="Please Select Language."."<br>";
	}
if($txtlanguage=='2')
{
	
		if(trim($txtename)=="")
		{
			$errmsg .="Please enter Name."."<br>";
		}
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Short Description."."<br>";
		}
		
		if(trim($txtstatus)=="")
		{
			$errmsg .="Please Select Page Status."."<br>";
		}
}
else
{
		if(trim($txtename)=="")
		{
			$errmsg .="Please enter Name."."<br>";
		}
		if(trim($txtename)!="")
		{			
			if (preg_match("/^[a-zA-Z0-9'-_() &amp;\"]{3,100}$/i", $txtename) === 0)
			{
				$errmsg .= "Name must be Alphanumeric that should be minimum 2 and maximum 100."."<br>";
			}
		}
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Short Description."."<br>";
		}
		if(trim($sortcontentdesc)!="")
		{			
			if (preg_match("/^[a-zA-Z0-9'-_() &amp;\"]{3,200}$/i", $sortcontentdesc) === 0)
			{
				$errmsg .= "Sort description must be Alphanumeric that should be minimum 2 and maximum 200."."<br>";
			}
		}
		
		if(trim($startdate1)=="")
		{
			$errmsg .="Please enter Start Date:<br>";
		}
		if(trim($expairydate1)=="") 
		{
			$errmsg .="Please enter Termination Date.<br>";
		}
		else if($exp['2'] < $sta['2'])
		{
			$errmsg .="Please enter Start Date less then Termination Date.<br>";
		} 
		else if(($exp['2'] == $sta['2']) && ($exp['1'] < $sta['1'])) 
		{
			$errmsg .="Please enter Start Date less then Termination Date.<br>";
		} 
		else if((($exp['2'] == $sta['2']) && ($exp['1'] == $sta['1'])) && ($exp['0'] < $sta['0'])) 
		{
			$errmsg .="Please enter Start Date less then Termination Date.<br>";
		}
		if (trim($txtstatus) == "") {
		$errmsg .="Please select page status." . "<br>";
		}
	
		
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

			
 
	 
			$check_status=check_status($user_id,$role_id,$txtstatus,$model_id);
			if($check_status >0)
			{
			$txtstatus;
			}
			else
			{
			$msg = "Login to Access Admin Panel";
			$_SESSION['sess_msg'] = $msg ;
			header("Location:error.php");
			exit();
			}
$create_date=date('y-m-d');
$cat_id='1';
$tableName_send="combine";
$tableFieldsName_old=array("language_id","cat_id","m_name","m_short","m_title","m_content","page_url","start_date","end_date","approve_status","admin_id","c_new_status","image_file","create_date");
$tableFieldsValues_send=array("$txtlanguage","$cat_id","$txtename","$sortcontentdesc","$title","$txtcontentdesc","$url","$startdate","$expairydate","$txtstatus","$user_id","$newicons","$image_file","$create_date");
$value=$useAVclass->insertQuery($tableName_send,$tableFieldsName_old,$tableFieldsValues_send);
$page_id=mysqli_insert_id($conn);
if($txtstatus=='3')
{
	/*$tableName_send="combine_publish";
	$tableFieldsName_old=array("m_publish_id","language_id","cat_id","m_name","m_short","m_title","m_content","page_url","start_date","end_date","approve_status","admin_id","c_new_status","image_file","create_date");
	$tableFieldsValues_send=array("$page_id","$txtlanguage","$cat_id","$txtename","$sortcontentdesc","$title","$txtcontentdesc","$url","$startdate","$expairydate","$txtstatus","$user_id","$newicons","$image_file","$create_date");
	$useAVclass->insertQuery($tableName_send,$tableFieldsName_old,$tableFieldsValues_send);*/
	$sql="INSERT INTO combine_publish (m_publish_id,language_id,cat_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,approve_status,admin_id,c_new_status,create_date,image_file)
	 SELECT m_id, language_id,cat_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,approve_status,admin_id,c_new_status,create_date,image_file
   FROM combine WHERE m_id=$page_id";
  mysqli_query($conn,$sql);
}

		$user_id=$_SESSION['admin_auto_id_sess'];
		$page_id=mysqli_insert_id($conn);
		$action="Insert";
		$categoryid='1'; 
		$date=date("Y-m-d h:i:s");
		$ip=$_SERVER['REMOTE_ADDR'];
		$tableName="audit_trail";
		$tableFieldsName_old=array("user_login_id","page_id","page_name","page_action","page_category","page_action_date","ip_address","lang","page_title","approve_status");
$tableFieldsValues_send=array("$user_id","$page_id","$txtename","$action","$model_id","$date","$ip","$txtlanguage","$txtepage_title","$txtstatus");
	$value=$useAVclass->insertQuery($tableName,$tableFieldsName_old,$tableFieldsValues_send);
	$msg=CONTENTADD;
$_SESSION['content']=$msg;
header("location:manage_whatnews.php");
exit;	
}
}
if(isset($cmdsubmit) && $_GET['editid']!='')
{
$cid=content_desc($_GET['editid']);
$txtlanguage= content_desc(check_input($_POST['txtlanguage']));
$txtename = content_desc(check_input($_POST['txtename']));
$sortcontentdesc= content_desc(check_input($_POST['sortcontentdesc']));
$newicons = content_desc(check_input($_POST['newicons']));
$txtcontentdesc= check_input($_POST['txtcontentdesc']);
$txtstatus=content_desc(check_input($_POST['txtstatus']));
$title = content_desc(check_input($_POST['txtetitle']));

$url=seo_url($title);
$startdate1 = content_desc(check_input($_POST['startdate']));
$expairydate1 = content_desc(check_input($_POST['expairydate']));
$sta = split('-', $startdate1);
$startdate = $sta['2'] . "-" . $sta['1'] . "-" . $sta['0'];
$exp = split('-', $expairydate1);
$expairydate = $exp['2'] . "-" . $exp['1'] . "-" . $exp['0'];
$createdate=date('Y-m-d');
	$update_date=date('Y-m-d h:i:s');
$errmsg=""; 
if(trim($txtlanguage)=="")
		{
		$errmsg .="Please Select Language."."<br>";
}
 
if($txtlanguage=='2')
{
	
		if(trim($txtename)=="")
		{
			$errmsg .="Please enter Name."."<br>";
		}
		
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Short Description."."<br>";
		}
		
		if(trim($txtstatus)=="")
		{
			$errmsg .="Please Select Page Status."."<br>";
		}
}
else
{
	 if(trim($txtename)=="")
		{
			$errmsg .="Please enter Name."."<br>";
		}
		
		 if (preg_match("/^[a-zA-Z0-9'-_() &amp;\"]{3,100}$/i", $txtename) === 0)
			{
				$errmsg .= "Name must be Alphanumeric that should be minimum 2 and maximum 100."."<br>";
			}
		
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Short Description."."<br>";
		}
		
			
		if(trim($startdate1)=="")
		{
			$errmsg .="Please enter Start Date:<br>";
		}
		if(trim($expairydate1)=="") 
		{
			$errmsg .="Please enter Termination Date.<br>";
		}
		else if($exp['2'] < $sta['2'])
		{
			$errmsg .="Please enter Start Date less then Termination Date.<br>";
		} 
		else if(($exp['2'] == $sta['2']) && ($exp['1'] < $sta['1'])) 
		{
			$errmsg .="Please enter Start Date less then Termination Date.<br>";
		} 
		else if((($exp['2'] == $sta['2']) && ($exp['1'] == $sta['1'])) && ($exp['0'] < $sta['0'])) 
		{
			$errmsg .="Please enter Start Date less then Termination Date.<br>";
		}
		if (trim($txtstatus) == "") {
		$errmsg .="Please select page status." . "<br>";
		}
	
		
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
 
		$check_status=check_status($user_id,$role_id,$txtstatus,$model_id);
			if($check_status >0)
			{
			$txtstatus;
			}
			else
			{
			$msg = "Login to Access Admin Panel";
			$_SESSION['sess_msg'] = $msg ;
			header("Location:error.php");
			exit();
			}
$create_date=date('y-m-d');
$cat_id='1';
	$whereclause="m_id=$cid";
$tableName_send="combine";
$old=array("language_id","cat_id","m_name","m_short","m_title","m_content","page_url","start_date","end_date","approve_status","admin_id","c_new_status","create_date","update_date","whatsNew_cat");
$new=array("$txtlanguage","$cat_id","$txtename","$sortcontentdesc","$title","$txtcontentdesc","$url","$startdate","$expairydate","$txtstatus","$user_id","$newicons","$create_date","$update_date","$txtcategory");
	$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);
if($txtstatus=='3')
{
	$tableName_send="combine_publish";
	$whereclause="where m_publish_id='$cid'";
$sql=mysqli_query($conn,"Select * from combine_publish $whereclause");
$row=mysqli_num_rows($sql);

	if($create_version==1 and $row >0){ 
$sql="INSERT INTO combine_publish_versions (m_publish_id,language_id,cat_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,approve_status,admin_id,c_new_status,create_date,image_file,create_versions_date,whatsNew_cat)
	 SELECT m_publish_id, language_id,cat_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,approve_status,admin_id,c_new_status,create_date,image_file,update_date,whatsNew_cat
   FROM combine_publish WHERE m_publish_id=$cid";
  mysqli_query($conn,$sql);
		}
	if($row >0)
	{
 $update="UPDATE combine_publish,combine SET combine_publish.m_publish_id = combine.m_id,combine_publish.language_id = combine.language_id,combine_publish.cat_id = combine.cat_id,combine_publish.m_name = combine.m_name,combine_publish.m_short = combine.m_short,combine_publish.m_title = combine.m_title,combine_publish.m_content = combine.m_content,combine_publish.page_url = combine.page_url,combine_publish.start_date = combine.start_date,combine_publish.end_date = combine.end_date,combine_publish.approve_status = combine.approve_status,combine_publish.admin_id = combine.admin_id,combine_publish.c_new_status = combine.c_new_status,combine_publish.create_date = combine.create_date,combine_publish.image_file = combine.image_file,combine_publish.update_date = combine.update_date,combine_publish.whatsNew_cat=combine.whatsNew_cat WHERE combine_publish.m_publish_id =combine.m_id and combine.m_id=$cid";
  mysqli_query($conn,$update);
	}
	else {
$sql="INSERT INTO combine_publish (m_publish_id,language_id,cat_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,approve_status,admin_id,c_new_status,create_date,image_file,update_date,whatsNew_cat)
	 SELECT m_id, language_id,cat_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,approve_status,admin_id,c_new_status,create_date,image_file,update_date,whatsNew_cat
   FROM combine WHERE m_id=$cid";
  mysqli_query($conn,$sql);
  }
}
		$user_id=$_SESSION['admin_auto_id_sess'];
		$page_id=mysqli_insert_id($conn);
		$action="Insert";
		$categoryid='1'; 
		$date=date("Y-m-d h:i:s");
		$ip=$_SERVER['REMOTE_ADDR'];
		$tableName="audit_trail";
		$tableFieldsName_old=array("user_login_id","page_id","page_name","page_action","page_category","page_action_date","ip_address","lang","page_title","approve_status");
$tableFieldsValues_send=array("$user_id","$page_id","$txtename","$action","$model_id","$date","$ip","$txtlanguage","$txtepage_title","$txtstatus");
	$value=$useAVclass->insertQuery($tableName,$tableFieldsName_old,$tableFieldsValues_send);
	$msg=CONTENTADD;
$_SESSION['content']=$msg;
header("location:manage_whatnews.php");
exit;	
}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage What News add/update: LPAI</title>
<!-- admin css  -->
<link href="style/admin.css" rel="stylesheet" type="text/css">
<!-- Ckeditor js  -->
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<!-- start Calender js and css  -->
 <script type="text/javascript" src="js/jsDatePick.js"></script>
<link href="style/jsDatePick.css" rel="stylesheet" type="text/css" />
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
<!-- end  Calender js and css  -->
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="style/ie7.css">
<![endif]-->

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

  

  <?php
		include_once('main_menu.php');
	 ?>
  <!-- Header end -->
  

  
  <div class="main_con">
  <div class="admin-breadcrum">
<div class="breadcrum">
  <span class="submenuclass"><a href="welcome.php" title="Dashboard">Dashboard</a></span>
			 <span class="submenuclass">>> </span> 
			<span class="submenuclass"><a href="manage_whatnews.php" title="Manage What's New">Manage What's New</a></span>
			 <span class="submenuclass">>> </span> 
			<span class="submenuclass">Add/Update What's New</span>
	</div>
<div class="clear"> </div>
</div>  
       
<div class="right_col1">
          
		  <div class="clear"></div>
		  <?php if($errmsg!=""){?>
<div  id="msgerror" class="status error">
<div class="closestatus" style="float: none;">
<p class="closestatus" style="float: right;"><img alt="Attention" src="images/close.png" class="margintop"></p>
<p><img alt="error" src="images/error.png"> <span>Attention! <br /></span><?php echo $errmsg; ?></p>
</div>
</div>
          <?php }?>
      	<div class="clear"></div>
 
        
	<div class="addmenu"> 
    <div class="internalpage_heading">
 <h3 class="manageuser">Add/Update What's New</h3>
 <div class="right-section">
 
 </div>
 </div>		
         <div class="grid_view">
<form action="" method="post" name="form1"  autocomplete="off" enctype="multipart/form-data"  onsubmit="return add_cp('form1')">
	<?php	
	if($_GET['editid']!='')
	{
		$rq = mysqli_query($conn,"select * from combine where 	m_id='".$_GET['editid']."'");
		//echo "select * from category where c_id='".$_GET['id']."'";
		$rr = mysqli_fetch_array($rq);
				//print_r($rr);
		}
		
	
?>   
<div class="frm_row"> <span class="label1">
              <label for="txtlanguage">Page Language :</label>
              <span class="star">*</span></span> <span class="input1">
              <input type="radio" name="txtlanguage" autocomplete="off" value="1" <?php if($rr['language_id']=='1'){ echo 'checked'; } ?> id="txtlanguage" />English &nbsp;<input type="radio" name="txtlanguage" autocomplete="off" value="2" <?php if($rr['language_id']=='2'){ echo 'checked'; } ?>/>Hindi 
               </span>
              <div class="clear"></div>
			  <div class="loading"></div>
            </div>
			<div class="frm_row"> <span class="label1">
				<label for="txtename">Name:</label>
				<span class="star">*</span></span> <span class="input1">
				<input name="txtename" autocomplete="off" type="text" class="input_class" id="txtename" size="30"   value="<?php if($txtename!=""){ echo content_desc($txtename);} else { echo $rr['m_name']; }?>"/>
				
				</span>
				<div class="clear"></div>
			</div>
			<div class="frm_row"> <span class="label1">
				<label for="txtename">Page URL/ Page Title:</label>
				<span class="star">*</span></span> <span class="input1">
				<input name="txtetitle" autocomplete="off" type="text" class="input_class" id="txtetitle" size="30"   value="<?php if($txtetitle!=""){ echo content_desc($txtetitle);} else { echo $rr['m_title'];} ?>"/>
				
				</span>
				<div class="clear"></div>
			</div>
				<div class="frm_row"> <span class="label1">
              <label for="sortcontentdesc">Short Description: </label>
              <span class="star">*</span></span> <span class="input1">
              <textarea rows="2" cols="35" name="sortcontentdesc" autocomplete="off"  id="sortcontentdesc" onkeyup="Javascript:charactersRemaining(this.form.sortcontentdesc, 500, this.form.msg_left); characterLimit(this.form.sortcontentdesc, 500, this.form.sortcontentdesc);" onkeypress="Javascript:charactersRemaining(this.form.sortcontentdesc, 500, this.form.msg_left); characterLimit(this.form.sortcontentdesc, 500, this.form.sortcontentdesc);" onmouseout="Javascript:charactersRemaining(this.form.sortcontentdesc, 500, this.form.msg_left); characterLimit(this.form.sortcontentdesc, 500, this.form.sortcontentdesc);" tabindex="1" ><?php if($sortcontentdesc!=""){ echo content_desc($sortcontentdesc);} else { echo $rr['m_short'];} ?>
</textarea> <label style="float:right; margin-right:30px;" class="free" for="textarea_field">
		<script type="text/javascript">
			document.write("&nbsp;&nbsp;&nbsp;<input type='text' name='msg_left' id='msg_left' style='text-align:right;' size='3' value='500' readonly='readonly' /> left of 500 characters maximum.");
		</script>
		<noscript><span class="date">(text limited to 500 characters)</span></noscript>
		</label>
              </span>
              <div class="clear"></div>
          
            </div>
			
			
			<div class="frm_row"> <span class="label1">
              <label for="newicons">Display New Icons :</label>
              <span class="star">*</span></span> <span class="input1">
              <input type="radio" name="newicons" id="newicons" autocomplete="off"  value="1" <?php if($rr['c_new_status']=='1'){ echo 'checked';} else ?> checked="checked" />Yes &nbsp;<input type="radio" name="newicons" autocomplete="off" value="2" <?php if($rr['c_new_status']=='2'){ echo 'checked'; } ?>/>No 
               </span>
              <div class="clear"></div>
			  <div class="loading"></div>
            </div>

			<div class="frm_row"> <span class="label1">
        <label for="txtcontentdesc">Description :</label>
        <span class="star"></span></span> <span class="input_fck" id="">
<?php
		
		$ckeditor = new CKEditor();
		$ckeditor->basePath = '/ckeditor/';
		$ckeditor->config['filebrowserBrowseUrl'] = '/lpai/auth/adminPanel/ckfinder/ckfinder.html';
		$ckeditor->config['filebrowserImageBrowseUrl'] = '/lpai/auth/adminPanel/ckfinder/ckfinder.html?type=Images';
		$ckeditor->config['filebrowserUploadUrl'] = '/lpai/auth/adminPanel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		$ckeditor->config['filebrowserImageUploadUrl'] = '/lpai/auth/adminPanel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
		$ckeditor->editor('txtcontentdesc',stripslashes(html_entity_decode($rr['m_content'])));
		?>        </span>
        <div class="clear"></div>
        </div>	

    <div class="frm_row"> <span class="label1">
                                                        <label for="startdate">Start Date:</label><span class="star">*</span>
                                                    </span> <span class="input1">
                                          <input type="text" name="startdate" id="startdate" readonly="readonly"  autocomplete="off" value="<?php if (htmlspecialchars($startdate != "")) { echo htmlspecialchars(content_desc($startdate));} if($rr['start_date'] !=''){ echo changeformate($rr['start_date']); } else { } ?>"/><span class="date">[dd-mm-yyyy]</span> 

                                                    </span>
                                                    <div class="clear"></div>
            </div> 
                                                <div class="frm_row"> <span class="label1">
                                                        <label for="expairydate">Termination Date:</label><span class="star">*</span>
                                                    </span> <span class="input1">
                                                        <input type="text" name="expairydate" autocomplete="off" readonly="readonly"  id="expairydate" value="<?php if (htmlspecialchars($expairydate != "")) { echo htmlspecialchars(content_desc($expairydate));} if($rr['end_date'] !=''){  echo changeformate($rr['end_date']); }else {}
                                                               
                                                           ?>"/><span class="date">[dd-mm-yyyy]</span> 

                                                    </span>
                                                    <div class="clear"></div>
            </div>  
	
          <div class="frm_row"> 
			<span class="label1">
			<label for="txtstatus">Page Status:</label>
			<span class="star">*</span></span> <span class="input1">
			<select name="txtstatus" id="txtstatus"  autocomplete="off">
			<option value=""> Select </option>
			<?php 
			if($user_id =='101')
			{
			$sql=mysqli_query($conn,"select * from content_state where state_status=1");
			
			while($row=mysqli_fetch_array($sql))
			{ 
			?>
		<option value="<?php echo content_desc($row['state_id']);?>" <?php if ($rr['approve_status']==$row['state_id']) echo 'selected="selected"';?>><?php echo $row['state_name']; ?></option>
			<?php }
			}
			else if($user_id !='101' )
			{
			$sql=mysqli_query($conn,"select * from content_state");
			
			while($row=mysqli_fetch_array($sql))
			{  
			if($row['state_short']==$role_map['draft']){
			?>
			<option value="<?php echo content_desc($row['state_id']);?>" <?php if ($rr['approve_status']==$row['state_id']) echo 'selected="selected"';?>><?php echo $row['state_name']; ?></option>
			<?php }
			
			if($row['state_short']==$role_map['mapprove']){
			?>
                <option value="<?php echo content_desc($row['state_id']);?>"><?php echo $row['state_name']; ?></option>
                <?php }
			if($row['state_short']==$role_map['publish']){
			?>
			<option value="<?php echo content_desc($row['state_id']);?>" <?php if ($rr['approve_status']==$row['state_id']) echo 'selected="selected"';?>><?php echo $row['state_name']; ?></option>
			<?php }
		
			
			}
			} ?>
			</select>
			</span>
			<div class="clear"></div>
			</div>
			<div class="clear"></div>

            <div class="frm_row"> <span class="button_row">
            <input name="cmdsubmit" type="submit" class="button" id="cmdsubmit" value="<?php if($_GET['editid']!='') { echo 'Update';} else { echo'Submit';}?>" />&nbsp;
			<input name="cmdreset" type="reset" class="button" id="cmdreset" value="Reset" />
			<input type="hidden" name="random" value="<?php echo $_SESSION['logtoken'];?>" /><!-- <a href="employee.php"><input type="button" name="back" value="Back" class="button1"></a> -->&nbsp;
		<input type="button" class="button" value="Back" onClick="javascript:location.href ='manage_whatnews.php';" />
         </span>
              <div class="clear"></div>
            </div>

</form>

</div>
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
<!--left of 150 characters maximum-->
<script type="text/javascript">
<!--
	// This is just one validation technique, with frm parameter being the submitted form
	// function to validate the submitted form's textarea field
	function validate_textarea (frm)  
	{
		var result = false; // assume the worst
		frm.textarea_field.className=""; // sets display field style to be normal (could be a specific class)

		if (frm.textarea_field.value.length == 0) {
			// show error
			alert ("You must enter some text (10 characters minimum)!");
		} else if (frm.textarea_field.value.length < 10) {
			// show error
			alert ("You must enter atleast 10 characters!");
		} else {
			// OK
			result = true;
		}

		if (!result) {
			// focus in and highlight input field
			frm.textarea_field.className="err"; // assumes 'err' style class defined
			frm.textarea_field.focus();
		} else {
			alert ("Text entered:\n\n"+frm.textarea_field.value);
			frm.textarea_field.blur();
			frm.textarea_validate.blur();
		}

		return result;
	}

	function charactersRemaining(input, max, out) {
		if (input.value.length <= max) {
			out.value = (max - input.value.length);
		}
		else {
			out.value = 0;
		}
		//alert("charactersRemaining("+input.value+","+max+","+out.value+")");
	}

	function characterLimit(input, max) {
		if(input.value.length > max){
			// set field's value equal to first N characters.
			input.value = input.value.substring(0, max);
			//  move cursor out of form element to stop overwrite of the first character"
			input.blur();
			alert("No more text can be entered");
		}
	}
//-->
</script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<!--message display error and hide-->
<script type="text/javascript">
$(".closestatus").click(function() {
$("#msgerror").addClass("hide").hide();
});
</script>
	
<style>
.hide {display:none;}
</style>