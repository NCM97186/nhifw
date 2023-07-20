<?php ob_start();
session_start();
include("../../includes/config.inc.php");
include("../../includes/useAVclass.php");
include("../../includes/functions.inc.php");
include("../../includes/def_constant.inc.php");
include_once 'ckeditor/ckeditor.php';
include_once 'ckfinder/ckfinder.php';

 $_GET['editid']=content_desc(base64_decode($_GET['editid']));

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
$model_id= "2";
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

if(isset($_POST['cmdsubmit']) && $_GET['editid']=='')
{
@extract($_POST);
$txtlanguage= content_desc(check_input($_POST['txtlanguage']));
$txtename = content_desc(check_input($_POST['txtename']));
$cat_id=content_desc(check_input($_POST['hometype']));
$sortcontentdesc= content_desc(check_input($_POST['sortcontentdesc']));
$title = content_desc(check_input($_POST['title']));
$txtcontentdesc= check_input($_POST['txtcontentdesc']);
$txtstatus=content_desc(check_input($_POST['txtstatus']));
$designation=content_desc(check_input($_POST['designation']));

if($txtlanguage=='2')
		{		
		$url=seo_url($title.'-hi'); }
		else { $url=seo_url($title);
		}
		$designation = check_input($_POST['designation']);

$createdate=date('Y-m-d');
$errmsg=""; 
	if(trim($txtlanguage)=="")
	{
	$errmsg .="Please Select Language."."<br>";
	}
if($txtlanguage=='2')
{
	
	
		/*elseif(trim($hometype)!="")
		{
			$tableName_send="message";
			$field_name="m_type";
			$checkuniqe=check_message_unique($hometype,$field_name,$tableName_send,$txtlanguage);
			if($checkuniqe >0)
			{
			$errmsg=$errmsg."Content Home Page already exits."."<br>";
			}
		}*/
		if(trim($title)=="")
		{
			$errmsg .="Please enter Title."."<br>";
		}
		if(trim($txtename)=="")
		{
			$errmsg .="Please enter Name."."<br>";
		}
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Short Description."."<br>";
		}
				if ($_FILES["txtuplode"]["name"] != "")
		{
		$tempfile=($_FILES["txtuplode"]["tmp_name"]);
		$imageinfo = ($_FILES["txtuplode"]["type"]);
		$section = strtoupper(base64_encode(file_get_contents($tempfile)));
		 $nsection=substr($section,0,8);
	
		$imageinfo = getimagesize($_FILES["txtuplode"]["tmp_name"]);

		if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/jpg' && $imageinfo['mime'] != 'image/png' && isset($imageinfo))
		{
			$errmsg .= 'Sorry, we only accept GIF,PNG,JPG and JPEG images';
		}

		/*if(($nsection=="/9J/4AAQ")  OR ($nsection=="IVBORW0K") OR ($nsection=="R0LGODLH"))
		{}
		else
		{
				$errmsg .= 'Sorry, we only accept GIF,PNG,JPG and JPEG images';
		}*/
		if ($_FILES["txtuplode"]["size"] >=1048576)
		{
		$errmsg .= IMAGE_SIZE_LIMIT."<br>";
		}
		}	

		if(trim($txtstatus)=="")
		{
			$errmsg .="Please Select Page Status."."<br>";
		}
}
else
{
		
	
		/*elseif(trim($hometype)!="")
		{
			$tableName_send="message";
			$field_name="m_type";
			$checkuniqe=check_message_unique($hometype,$field_name,$tableName_send,$txtlanguage);
			if($checkuniqe >0)
			{
			$errmsg=$errmsg."Content Home Page already exits."."<br>";
			}
		}*/
		if(trim($txtename)=="")
		{
			$errmsg .="Please enter Name."."<br>";
		}
		if(trim($title)=="")
		{
			$errmsg .="Please enter Title."."<br>";
		}
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Short Description."."<br>";
		}
		if (trim($txtstatus) == "") {
		$errmsg .="Please select page status." . "<br>";
		}
				
 if ($_FILES["txtuplode"]["name"] != "")
	 {
	 	$tempfile=($_FILES["txtuplode"]["tmp_name"]);
		$imageinfo = ($_FILES["txtuplode"]["type"]);
		$section = strtoupper(base64_encode(file_get_contents($tempfile)));
		 $nsection=substr($section,0,8);
	
		$imageinfo = getimagesize($_FILES["txtuplode"]["tmp_name"]);

		if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/jpg' && $imageinfo['mime'] != 'image/png' && isset($imageinfo))
		{
			$errmsg .= 'Sorry, we only accept GIF,PNG,JPG and JPEG images';
		}

		/*if(($nsection=="/9J/4AAQ")  OR ($nsection=="IVBORW0K") OR ($nsection=="R0LGODLH"))
		{}
		else
		{
				$errmsg .= 'Sorry, we only accept GIF,PNG,JPG and JPEG images';
		}*/
		 if ($_FILES["txtuplode"]["size"] >=1048576)
				{
				$errmsg .= IMAGE_SIZE_LIMIT."<br>";
				}
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
			
 if ($_FILES["txtuplode"]["name"] != "")
	 {
		
			if($_FILES["txtuplode"]["type"] == "image/jpeg" || $_FILES["txtuplode".$i]["type"] == "image/pjpeg" || $_FILES["txtuplode".$i]["type".$i] == "image/gif" || $_FILES["txtuplode".$i]["type".$i] == "image/bmp" || $_FILES["txtuplode".$i]["type".$i] == "image/png"){	
			$image_source = imagecreatefromjpeg($_FILES["txtuplode".$i]["tmp_name"]);
			}		
			$filename1 = $_FILES['txtuplode'.$i]['name'];
			$filename1 = preg_replace("/[^a-zA-Z0-9.]/", "", $filename1);
			$uniq = uniqid("");
			$filename1 = $uniq . $filename1;
			$PATH = "../../upload/message";
			$PATH1="../../upload/message/thumb";
			if(!is_dir($PATH)){  
			mkdir($PATH,0775);
			}
			$PATH=$PATH."/";

			if(!is_dir($PATH1)){  
			mkdir($PATH1,0775);
			}
			$PATH1=$PATH1."/";

			$remote_file = $PATH.$filename1;
			$val = move_uploaded_file($_FILES["txtuplode".$i]["tmp_name"], $PATH . $filename1);
			$size = filesize($PATH . $filename1);
			$size = ceil($size / 1024);
			$found = "false";
			
			list($image_width, $image_height) = getimagesize($remote_file);
		if($image_width>$max_upload_width || $image_height >$max_upload_height)
		{
				 $proportions = $image_width/$image_height;
			if($image_width>$image_height)
			{
				
				$new_width = 1024;
				$new_height = 1024;
			// 	  $new_width = $max_upload_width;
			//  $new_height = $max_upload_height;
				/*echo $new_height = round($max_upload_width/$proportions);
				echo $new_width = round($max_upload_height*$proportions);*/
			}		
			else
			{
			   $new_width = $max_upload_width;
				 $new_height = $max_upload_height;
				/*echo $new_width = round($max_upload_height*$proportions);
				echo $new_height = round($max_upload_width/$proportions);*/
			}		
			
			$new_image = imagecreatetruecolor(1024 , 1024);
			// $image_source = imagecreatefromjpeg($remote_file);
		
			// imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
			// imagejpeg($new_image,$remote_file,100);
			
			// imagedestroy($new_image);
		}
		
			// imagedestroy($image_source);
			$add_img='../../upload/message/'.$filename1;
			$add_thumb='../../upload/message/thumb/'.$filename1;
			generate_image_thumbnail($add_img,$add_thumb);
		}
		$image_file=$filename1;
	 
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
			$create_date = date("y-m-d");				
$tableName_send="message";
$tableFieldsName_old=array("language_id","m_name","m_url","m_title","m_description","content","approve_status","admin_id","image_file","create_date","designation");
$tableFieldsValues_send=array("$txtlanguage","$txtename","$url","$title","$sortcontentdesc","$txtcontentdesc","$txtstatus","$user_id","$image_file","$create_date","$designation");
$value = $useAVclass->insertQuery($tableName_send,$tableFieldsName_old,$tableFieldsValues_send);
$page_id= $value;

if($txtstatus=='3')
{	
$sql="INSERT INTO message_publish (m_publish_id,language_id,m_name,m_url,m_title,m_description,content,approve_status,admin_id,image_file,create_date,designation)
	 SELECT m_id, language_id,m_name,m_url,m_title,m_description,content,approve_status,admin_id,image_file,create_date,designation FROM message WHERE m_id=$page_id";
	
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
	$msg="update successfully";
$_SESSION['content']=$msg;
header("location:manage_message.php");
exit;	
}
}
if(isset($_POST['cmdsubmit']) && $_GET['editid']!='')
{
$cid=content_desc($_GET['editid']);
$txtlanguage= content_desc(check_input($_POST['txtlanguage']));
$txtename = content_desc(check_input($_POST['txtename']));
$cat_id=content_desc(check_input($_POST['hometype']));
$sortcontentdesc= content_desc(check_input($_POST['sortcontentdesc']));
$title = content_desc(check_input($_POST['title']));
$txtcontentdesc= check_input($_POST['txtcontentdesc']);
$txtstatus=content_desc(check_input($_POST['txtstatus']));
if($txtlanguage=='2')
		{		
		$url=seo_url($title.'-hi'); }
		else { $url=seo_url($title);
		}
		
		$designation = check_input($_POST['designation']);

$errmsg=""; 
if(trim($txtlanguage)=="")
		{
		$errmsg .="Please Select Language."."<br>";
}
 
if($txtlanguage=='2')
{
	
	
		/*elseif(trim($hometype)!="")
		{
		$tableName_send="home_page";
		$field_name="m_type";
		$field_id="m_id";
		$id=$cid;
		$checkuniqe=edit_check_home_page_unique($tableName_send,$field_name,$hometype,$field_id,$id,$txtlanguage);
		if($checkuniqe >0)
			{
					$errmsg=$errmsg."Content Home Page already exits."."<br>";
			}
			
		}*/
		if(trim($title)=="")
		{
			$errmsg .="Please enter Title."."<br>";
		}
		if(trim($txtename)=="")
		{
			$errmsg .="Please enter Name."."<br>";
		}
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Short Description."."<br>";
		}
		if ($_FILES["txtuplode"]["name"] != "")
		{
		$tempfile=($_FILES["txtuplode"]["tmp_name"]);
		$imageinfo = ($_FILES["txtuplode"]["type"]);
		$section = strtoupper(base64_encode(file_get_contents($tempfile)));
		 $nsection=substr($section,0,8);
	
		$imageinfo = getimagesize($_FILES["txtuplode"]["tmp_name"]);

		if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/jpg' && $imageinfo['mime'] != 'image/png' && isset($imageinfo))
		{
			$errmsg .= 'Sorry, we only accept GIF,PNG,JPG and JPEG images';
		}

		/*if(($nsection=="/9J/4AAQ")  OR ($nsection=="IVBORW0K") OR ($nsection=="R0LGODLH"))
		{}
		else
		{
				$errmsg .= 'Sorry, we only accept GIF,PNG,JPG and JPEG images';
		}*/
		if ($_FILES["txtuplode"]["size"] >=1048576)
		{
		$errmsg .= IMAGE_SIZE_LIMIT."<br>";
		}
		}	

		
		if(trim($txtstatus)=="")
		{
			$errmsg .="Please Select Page Status."."<br>";
		}
}
else
{
		
		/*elseif(trim($hometype)!="")
		{
		$tableName_send="home_page";
		$field_name="m_type";
		$field_id="m_id";
		$id=$cid;
		$checkuniqe=edit_check_home_page_unique($tableName_send,$field_name,$hometype,$field_id,$id,$txtlanguage);
		if($checkuniqe >0)
			{
					$errmsg=$errmsg."Content Home Page already exits."."<br>";
			}
			
		}*/
		if(trim($txtename)=="")
		{
			$errmsg .="Please enter Name."."<br>";
		}
		if(trim($title)=="")
		{
			$errmsg .="Please enter Title."."<br>";
		}
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Short Description."."<br>";
		}
		if (trim($txtstatus) == "") {
		$errmsg .="Please select page status." . "<br>";
		}
		if ($_FILES["txtuplode"]["name"] != "")
		{
		 $tempfile=($_FILES["txtuplode"]["tmp_name"]);
		$imageinfo = ($_FILES["txtuplode"]["type"]);
		$section = strtoupper(base64_encode(file_get_contents($tempfile)));
		 $nsection=substr($section,0,8);
	
		$imageinfo = getimagesize($_FILES["txtuplode"]["tmp_name"]);

		if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/jpg' && $imageinfo['mime'] != 'image/png' && isset($imageinfo))
		{
			$errmsg .= 'Sorry, we only accept GIF,PNG,JPG and JPEG images';
		}

		/*if(($nsection=="/9J/4AAQ")  OR ($nsection=="IVBORW0K") OR ($nsection=="R0LGODLH"))
		{}
		else
		{
				$errmsg .= 'Sorry, we only accept GIF,PNG,JPG and JPEG images';
		}*/
		if ($_FILES["txtuplode"]["size"] >=1048576)
		{
		$errmsg .= IMAGE_SIZE_LIMIT."<br>";
		}
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
 if ($_FILES["txtuplode"]["name"] != "")
	 {
			if($_FILES["txtuplode".$i]["type"] == "image/jpeg" || $_FILES["txtuplode".$i]["type"] == "image/pjpeg" || $_FILES["txtuplode".$i]["type".$i] == "image/gif" || $_FILES["txtuplode".$i]["type".$i] == "image/bmp" || $_FILES["txtuplode".$i]["type".$i] == "image/png"){
				
			$image_source = imagecreatefromjpeg($_FILES["txtuplode".$i]["tmp_name"]);
			}	
			  $sql = "select image_file FROM message WHERE m_id=$cid";
    $rs = mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($rs);

    $image_path = "../../upload/message/".$row['image_file'];
    $image_path2 = "../../upload/message/thumb/".$row['image_file'];
    unlink($image_path);
   unlink($image_path2);	
			
			$filename1 = $_FILES['txtuplode'.$i]['name'];
			$filename1 = preg_replace("/[^a-zA-Z0-9.]/", "", $filename1);
			$uniq = uniqid("");
			$filename1 = $uniq . $filename1;
			$PATH = "../../upload/message";
			$PATH1="../../upload/message/thumb";
			if(!is_dir($PATH)){  
			mkdir($PATH,0775);
			}
			$PATH=$PATH."/";

			if(!is_dir($PATH1)){  
			mkdir($PATH1,0775);
			}
			$PATH1=$PATH1."/";

			$remote_file = $PATH.$filename1;
			$val = move_uploaded_file($_FILES["txtuplode".$i]["tmp_name"], $PATH . $filename1);
			$size = filesize($PATH . $filename1);
			$size = ceil($size / 1024);
			$found = "false";
			list($image_width, $image_height) = getimagesize($remote_file);
		if($image_width>$max_upload_width || $image_height >$max_upload_height)
		{
				 $proportions = $image_width/$image_height;
			if($image_width>$image_height)
			{
			
				  $new_width = $max_upload_width;
			 $new_height = $max_upload_height;
				/*echo $new_height = round($max_upload_width/$proportions);
				echo $new_width = round($max_upload_height*$proportions);*/
			}		
			else
			{
			   $new_width = $max_upload_width;
				 $new_height = $max_upload_height;
				/*echo $new_width = round($max_upload_height*$proportions);
				echo $new_height = round($max_upload_width/$proportions);*/
			}		
			$new_image = imagecreatetruecolor($new_width , $new_height);
			$image_source = imagecreatefromjpeg($remote_file);
			
			imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
			imagejpeg($new_image,$remote_file,100);
			
			imagedestroy($new_image);
		}
			imagedestroy($image_source);
			$add_img='../../upload/message/'.$filename1;
			$add_thumb='../../upload/message/thumb/'.$filename1;
			generate_image_thumbnail($add_img,$add_thumb);

				$filename1=addslashes($filename1);
	$tableName_send="message";
	$whereclause="m_id=$cid";
	$old =array("image_file");
	$new =array("$filename1");
	$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);
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
	$whereclause="m_id=$cid";
$tableName_send="message";
$old=array("language_id","m_name","m_url","m_title","m_description","content","approve_status","admin_id","designation");
$new=array("$txtlanguage","$txtename","$url","$title","$sortcontentdesc","$txtcontentdesc","$txtstatus","$user_id","$designation");
	$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);
if($txtstatus=='3')
{
	$tableName_send="message_publish";
	$whereclause="where m_publish_id='$cid'";
$sql=mysqli_query($conn,"Select * from message_publish $whereclause");
$row=mysqli_num_rows($sql); 
	if($row >0)
	{
$update="UPDATE message_publish,message SET message_publish.m_publish_id = message.m_id,message_publish.language_id = message.language_id,message_publish.m_type = message.m_type,message_publish.m_name = message.m_name,message_publish.m_description = message.m_description,message_publish.m_title = message.m_title,message_publish.content = message.content,message_publish.m_url = message.m_url,message_publish.approve_status = message.approve_status,message_publish.admin_id = message.admin_id,message_publish.create_date = message.create_date,message_publish.image_file = message.image_file,message_publish.designation = message.designation WHERE message_publish.m_publish_id =message.m_id and message.m_id=$cid";

  mysqli_query($conn,$update);
	}
	else {
	$sql="INSERT INTO message_publish (m_type,m_publish_id,language_id,m_name,m_url,m_title,m_description,content,approve_status,admin_id,image_file,create_date,designation)
	 SELECT m_type,m_id,language_id,m_name,m_url,m_title,m_description,content,approve_status,admin_id,image_file,create_date,designation FROM message WHERE m_id=$cid";
  mysqli_query($conn,$sql);
  }
}
		$user_id=$_SESSION['admin_auto_id_sess'];
		$page_id=mysqli_insert_id($conn);
		$action="Update";
		$categoryid='1'; 
		$date=date("Y-m-d h:i:s");
		$ip=$_SERVER['REMOTE_ADDR'];
		$tableName="audit_trail";
		$tableFieldsName_old=array("user_login_id","page_id","page_name","page_action","page_category","page_action_date","ip_address","lang","page_title","approve_status");
$tableFieldsValues_send=array("$user_id","$page_id","$txtename","$action","$model_id","$date","$ip","$txtlanguage","$txtepage_title","$txtstatus");
	$value=$useAVclass->insertQuery($tableName,$tableFieldsName_old,$tableFieldsValues_send);
	$msg=CONTENTADD;
$_SESSION['content']=$msg;
header("location:manage_message.php");
exit;	
}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Ministry message Add/Update: <?php echo $sitename;?></title>
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
			<span class="submenuclass"><a href="manage_message.php" title="Manage Home page">Manage Message</a></span>
			 <span class="submenuclass">>> </span> 
			<span class="submenuclass">Add/Update Message</span>
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
 <h3 class="manageuser">Add/Update Message</h3>
 <div class="right-section">
 
 </div>
 </div>		
         <div class="grid_view">
<form action="" method="post" name="form1"  autocomplete="off" enctype="multipart/form-data"  onsubmit="return add_cp('form1')">
	<?php	
	if($_GET['editid']!='')
	{
		$rq = mysqli_query($conn,"select * from message where m_id='".$_GET['editid']."'");
		//echo "select * from message where m_id='".$_GET['editid']."'";
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
				<input name="txtename" autocomplete="off" type="text" class="input_class" id="txtename" size="30"   value="<?php if (htmlspecialchars($txtename != "")) { echo htmlspecialchars(content_desc($txtename));} if(htmlspecialchars($rr['m_name']!="")){ echo htmlspecialchars($rr['m_name']);}?>"/>
				
				</span>
				<div class="clear"></div>
			</div>

			<div class="frm_row"> <span class="label1">
				<label for="title">Designation:</label>
				<span class="star">*</span></span> <span class="input1">
				<input name="designation" autocomplete="off" type="text" class="input_class" id="designation" size="30"   value="<?php if (htmlspecialchars($designation != "")) { echo htmlspecialchars(content_desc($designation));} if(htmlspecialchars($rr['designation']!="")){ echo htmlspecialchars($rr['designation']);}?>"/>				
				</span>
				<div class="clear"></div>
			</div>
			
			<div class="frm_row"> <span class="label1">
				<label for="title">Title / Page Url:</label>
				<span class="star">*</span></span> <span class="input1">
				<input name="title" autocomplete="off" type="text" class="input_class" id="title" size="30"   value="<?php if (htmlspecialchars($title != "")) { echo htmlspecialchars(content_desc($title));} if(htmlspecialchars($rr['m_title']!="")){ echo htmlspecialchars($rr['m_title']);} ?>"/>				
				</span><span class="date">[Title should be only in English]</span>
				<div class="clear"></div>
			</div>
				<div class="frm_row"> <span class="label1">
              <label for="sortcontentdesc">Short Description: </label>
              <span class="star">*</span></span> <span class="input1">
              <textarea rows="6" cols="35" name="sortcontentdesc" autocomplete="off"  id="sortcontentdesc" onkeyup="Javascript:charactersRemaining(this.form.sortcontentdesc, 500, this.form.msg_left); characterLimit(this.form.sortcontentdesc, 500, this.form.sortcontentdesc);" onkeypress="Javascript:charactersRemaining(this.form.sortcontentdesc, 500, this.form.msg_left); characterLimit(this.form.sortcontentdesc, 500, this.form.sortcontentdesc);" onmouseout="Javascript:charactersRemaining(this.form.sortcontentdesc, 500, this.form.msg_left); characterLimit(this.form.sortcontentdesc, 500, this.form.sortcontentdesc);" tabindex="1" ><?php  echo $rr['m_description']; ?>
</textarea> <label style="float:right; margin-right:30px;" class="free" for="textarea_field">
		<script type="text/javascript">
			document.write("&nbsp;&nbsp;&nbsp;<input type='text' name='msg_left' id='msg_left' style='text-align:right;' size='3' value='500' readonly='readonly' /> left of 500 characters maximum.");
		</script>
		<noscript>(text limited to 500 characters)</noscript>
		</label>
              </span>
              <div class="clear"></div>
          
            </div>
			
            <div class="frm_row"> <span class="label1">
            <label for="txtuplode">Image Upload :</label>
            </span> <span class="input1">
           <input type="file" name="txtuplode" id="txtuplode"/><?php if($rr['image_file'] !='') {?>
		   <img src="../../upload/message/<?php echo $rr['image_file'];?>" alt="" title="" align="center" width="80" height="90" />
		   <?php }?> 
            </span>
            <div class="clear"></div>
            </div>
		<div class="frm_row"> <span class="label1">
        <label for="txtcontentdesc">Description :</label>
        <span class="star"></span></span> <span class="input_fck" id="">
<?php
		
		$ckeditor = new CKEditor();
		$ckeditor->basePath = '/ckeditor/';
		$ckeditor->config['filebrowserBrowseUrl'] = ''.$folder.'/auth/adminPanel/ckfinder/ckfinder.html';
		$ckeditor->config['filebrowserImageBrowseUrl'] = ''.$folder.'/auth/adminPanel/ckfinder/ckfinder.html?type=Images';
		$ckeditor->config['filebrowserUploadUrl'] = ''.$folder.'/auth/adminPanel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		$ckeditor->config['filebrowserImageUploadUrl'] = ''.$folder.'/auth/adminPanel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';

		$ckeditor->editor('txtcontentdesc',stripslashes(html_entity_decode($rr['content'])));
		?>        </span>
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
		<input type="button" class="button" value="Back" onClick="javascript:location.href ='manage_message.php';" />
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
<!--left of 325 characters maximum-->
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