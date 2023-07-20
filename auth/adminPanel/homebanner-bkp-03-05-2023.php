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
}$useAVclass = new useAVclass();
$useAVclass->connection();
$role_id=$_SESSION['dbrole_id'];
$user_id=$_SESSION['admin_auto_id_sess'];
$model_id= "15";
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

if($role_id_page==0)
{
$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:error.php");
		exit;	
}
if(isset($_POST['cmdsubmit']) && $_GET['editid']=='')
{
	
 $txtename = content_desc(check_input($_POST['txtename']));
        $txtepage_title= content_desc(check_input($_POST['txtepage_title']));
        $txtepage_titlehi= content_desc(check_input($_POST['txtepage_titlehi']));
        $url=seo_url($txtepage_title);
        $sortcontentdesc=check_input(content_desc($_POST['sortcontentdesc']));
        $txtlanguage= content_desc(check_input($_POST['txtlanguage']));
        $txtstatus=content_desc(check_input($_POST['txtstatus']));
$createdate=date('Y-m-d');
$errmsg="";  
if(trim($txtlanguage)=="")
		{
			$errmsg ="Please Select Language."."<br>";
		
		}
		
// if($txtlanguage=='2')
// {
// 		if(trim($txtename)=="")
// 		{
// 			$errmsg .="Please enter Banner Name."."<br>";
// 		}
// 		if(trim($txtepage_title)=="")
// 		{
// 		$errmsg .="Please enter Banner Title."."<br>";
// 		}
// 		if(trim($sortcontentdesc)=="")
// 		{
// 		$errmsg .="Please enter Banner Short Description."."<br>";
// 		}
// 		if($_FILES["txtuplode"]["tmp_name"]=="")
// 		{
// 		$errmsg .= "Please Uploade GIF,PNG,JPG and JPEG images."."<br>";
// 		}
// 		else if ($_FILES["txtuplode"]["tmp_name"]!="")
// 	{
// 		$tempfile=($_FILES["txtuplode"]["tmp_name"]);
// 		$imageinfo = ($_FILES["txtuplode"]["type"]);
// 		$section = strtoupper(base64_encode(file_get_contents($tempfile)));
// 		 $nsection=substr($section,0,8);
	
// 		$imageinfo = getimagesize($_FILES["txtuplode"]["tmp_name"]);

// 		if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/jpg' && $imageinfo['mime'] != 'image/png' && isset($imageinfo))
// 		{
// 			$errmsg .= 'Sorry, we only accept GIF,PNG,JPG and JPEG images'.'<br>';
// 		}

// 		if(($nsection=="/9J/4AAQ")  OR ($nsection=="IVBORW0K") OR ($nsection=="R0LGODLH"))
// 		{}
// 		else
// 		{
// 				$errmsg .= 'Sorry, we only accept GIF,PNG,JPG and JPEG images'.'<br>';
// 		}
		
// if ($_FILES["txtuplode"]["size"] >=1048576)
// 				{
// 				$errmsg .= IMAGE_SIZE_LIMIT."<br>";
// 				}

// 	}
// 			if(trim($txtstatus)=="")
// 		{
// 			$errmsg .="Please Select Banner Status."."<br>";
// 		}
		

// }
// else
// {

// 		if(trim($txtename)=="")
// 		{
// 			$errmsg .="Please enter Banner Name."."<br>";
// 		}
// 		else if (preg_match("/^[a-zA-Z0-9 _.,:()&amp;\"\']{3,100}$/i", $txtename) === 0)
// 		{
// 			$errmsg .= "Banner Name must be Alphanumeric and Special Characters( _.,:()&amp ) that should be minimum 3 and maximum 100."."<br>";
// 		}
// 		if(trim($txtepage_title)=="")
// 		{
// 		$errmsg .="Please enter Banner Title."."<br>";
// 		}
// 		else if (preg_match("/^[a-zA-Z0-9 _.,:()&amp;\"\']{3,100}$/i", $txtepage_title) === 0)
// 		{
// 		$errmsg .= "Banner Title must be Alphanumeric and Special Characters( _.,:()&amp ) that should be minimum 3 and maximum 100."."<br>";
// 		}
// 		if(trim($sortcontentdesc)=="")
// 		{
// 		$errmsg .="Please enter Banner Short Description."."<br>";
// 		}
// 		if($_FILES["txtuplode"]["tmp_name"]=="")
// 		{
// 		$errmsg .= "Please Uploade GIF,PNG,JPG and JPEG images."."<br>";
// 		}
// 	elseif ($_FILES["txtuplode"]["tmp_name"]!="")
// 	{
// 		$tempfile=($_FILES["txtuplode"]["tmp_name"]);
// 		$imageinfo = ($_FILES["txtuplode"]["type"]);
// 		$section = strtoupper(base64_encode(file_get_contents($tempfile)));
// 		 $nsection=substr($section,0,8);
	
// 		$imageinfo = getimagesize($_FILES["txtuplode"]["tmp_name"]);

// 		if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/jpg' && $imageinfo['mime'] != 'image/png' && isset($imageinfo))
// 		{
// 			$errmsg .= 'Sorry, we only accept GIF,PNG,JPG and JPEG images';
// 		}

// 		/*if(($nsection=="/9J/4AAQ")  OR ($nsection=="IVBORW0K") OR ($nsection=="R0LGODLH"))
// 		{}
// 		else
// 		{
// 				$errmsg .= 'Sorry, we only accept GIF,PNG,JPG and JPEG images';
// 		}*/
// if ($_FILES["txtuplode"]["size"] >=1048576)
// 				{
// 				$errmsg .= IMAGE_SIZE_LIMIT."<br>";
// 				}

// 	}
// 		if(trim($txtstatus)=="")
// 		{
// 		$errmsg .="Please Select Banner Status."."<br>";
// 		}
// }
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
	
		if ($_FILES["txtuplode"]["tmp_name"]!="")
		{
		//$max_upload_width = 568;
		//$max_upload_height = 239;

			if ($_FILES["txtuplode"]["size"] < 1048576)
			{
			
			if($_FILES["txtuplode"]["type"] == "image/jpeg" || $_FILES["txtuplode"]["type"] == "image/pjpeg"){	
			$image_source = imagecreatefromjpeg($_FILES["txtuplode"]["tmp_name"]);
			}	
				
			// if uploaded image was GIF
			if($_FILES["txtuplode"]["type"] == "image/gif"){	
			$image_source = imagecreatefromgif($_FILES["txtuplode"]["tmp_name"]);
			}
				
			// BMP doesn't seem to be supported so remove it form above image type test (reject bmps)	
			// if uploaded image was BMP
			if($_FILES["txtuplode"]["type"] == "image/bmp"){	
			$image_source = imagecreatefromwbmp($_FILES["txtuplode"]["tmp_name"]);
			}
						
			// if uploaded image was PNG
			if($_FILES["txtuplode"]["type"] == "image/png"){
			$image_source = imagecreatefrompng($_FILES["txtuplode"]["tmp_name"]);
			}
			
				$filename1=$_FILES['txtuplode']['name'];
				//echo $filename1; 
				$uniq = uniqid("");
				$filename1=$uniq.$filename1;
				$PATH="../../upload/banner/";
					
					if(!is_dir($PATH)){  
					mkdir($PATH,0777);
					}
					$PATH=$PATH."/";
				
		$remote_file = $PATH.$filename1;
		$test=imagejpeg($image_source,$remote_file,100);
					$size=filesize($PATH.$filename1);
					$size=ceil($size/1024);
					$found="false";

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
				
			//    $new_width = $max_upload_width;
			// 	 $new_height = $max_upload_height;
				 $max_upload_width = 700;
				 $max_upload_height = 500;
				///*echo $new_width = round($max_upload_height*$proportions);
				// echo $new_height = round($max_upload_width/$proportions);*/
				
			}
					
			$new_image = imagecreatetruecolor(750 , 500);
			$image_source = imagecreatefromjpeg($remote_file);
			
			imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
			imagejpeg($new_image,$remote_file,100);
			
			imagedestroy($new_image);
		}
		imagedestroy($image_source);
		
				}
				else{
							$msg=IMAGE_SIZE_LIMIT;
							$_SESSION['sess_img']=$msg;
							header("location:manage_banner.php#");
							exit;
					}	
$add_img='../../upload/banner/'.$filename1;
$add_thumb='../../upload/banner/thumb/'.$filename1;
generate_image_thumbnail($add_img,$add_thumb);

}		
	
	$filename1=addslashes($filename1); 
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
			
$tableName_send="banner";
$tableFieldsName_old=array("b_name","b_title","h_title","	b_language","b_short_desc","b_image_path","approve_status","admin_id","page_postion");
$tableFieldsValues_send=array("$txtename","$txtepage_title","$txtepage_titlehi","$txtlanguage","$sortcontentdesc","$filename1","$txtstatus","$user_id","");
$value=$useAVclass->insertQuery($tableName_send,$tableFieldsName_old,$tableFieldsValues_send);
$page_id=$value;
if($txtstatus=='3')
{
	$tableName_send="banner_publish";
	$tableFieldsName_old=array("publish_id","b_name","b_title","h_title","b_language","b_short_desc","b_image_path","approve_status","admin_id","page_postion");
	$tableFieldsValues_send=array("$page_id","$txtename","$txtepage_title","$txtepage_titlehi","$txtlanguage","$sortcontentdesc","$filename1","$txtstatus","$user_id","");
	$useAVclass->insertQuery($tableName_send,$tableFieldsName_old,$tableFieldsValues_send);
	$sql="INSERT INTO banner_publish (publish_id,b_name,b_title,h_title,b_language,b_short_desc,b_image_path,approve_status,admin_id,start_date,page_postion)
	 SELECT b_id,b_name,b_title,h_title,b_language,b_short_desc,b_image_path,approve_status,admin_id,page_postion  FROM banner WHERE b_id=$page_id";
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
header("location:manage_banner.php");
exit;	
}	
}
if(isset($_POST['cmdsubmit']) && $_GET['editid']!='')
{
	
$cid=content_desc($_GET['editid']);
$txtename = content_desc(check_input($_POST['txtename']));
$txtepage_title= content_desc(check_input($_POST['txtepage_title']));
$txtepage_titlehi= content_desc(check_input($_POST['txtepage_titlehi']));
$url=seo_url($txtepage_title);
$sortcontentdesc= check_input(content_desc($_POST['sortcontentdesc']));	
$txtlanguage= content_desc(check_input($_POST['txtlanguage']));
$txtstatus=check_input($_POST['txtstatus']);
	if($txtstatus =="")
	{
	 $txtstatus='1';
	}
$errmsg="";        // Initializing the message to hold the error messages
if(trim($txtlanguage)=="")
		{
			$errmsg ="Please Select Language."."<br>";
		
		}
if($txtlanguage=='2')
{
		if(trim($txtename)=="")
		{
			$errmsg .="Please enter Banner Name."."<br>";
		}
		if(trim($txtepage_title)=="")
		{
		$errmsg .="Please enter Banner Title."."<br>";
		}
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Banner Short Description."."<br>";
		}
		
if ($_FILES["txtuplode"]["tmp_name"]!="")
	{
		$tempfile=($_FILES["txtuplode"]["tmp_name"]);
		$imageinfo = ($_FILES["txtuplode"]["type"]);
		$section = strtoupper(base64_encode(file_get_contents($tempfile)));
		 $nsection=substr($section,0,8);
	
		$imageinfo = getimagesize($_FILES["txtuplode"]["tmp_name"]);

		if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/jpg' && $imageinfo['mime'] != 'image/png' && isset($imageinfo))
		{
			$errmsg .= 'Sorry, we only accept GIF,PNG,JPG and JPEG images'.'<br>';
		}

		/*if(($nsection=="/9J/4AAQ")  OR ($nsection=="IVBORW0K") OR ($nsection=="R0LGODLH"))
		{}
		else
		{
				$errmsg .= 'Sorry, we only accept GIF,PNG,JPG and JPEG images'.'<br>';
		}*/
        if ($_FILES["txtuplode"]["size"] >=1048576)
				{
				$errmsg .= IMAGE_SIZE_LIMIT."<br>";
				}

	}
			if(trim($txtstatus)=="")
		{
			$errmsg .="Please Select Banner Status."."<br>";
		}
		

}
else
{
		if(trim($txtename)=="")
		{
			$errmsg .="Please enter Banner Name."."<br>";
		}
		else if (preg_match("/^[a-zA-Z0-9 _.,:()&amp;\"\']{3,100}$/i", $txtename) === 0)
		{
			$errmsg .= "Banner Name must be Alphanumeric and Special Characters( _.,:()&amp ) that should be minimum 3 and maximum 100."."<br>";
		}
		if(trim($txtepage_title)=="")
		{
		$errmsg .="Please enter Banner Title."."<br>";
		}
		else if (preg_match("/^[a-zA-Z0-9 _.,:()&amp;\"\']{3,100}$/i", $txtepage_title) === 0)
		{
		$errmsg .= "Banner Title must be Alphanumeric and Special Characters( _.,:()&amp ) that should be minimum 3 and maximum 100."."<br>";
		}
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Banner Short Description."."<br>";
		}
	if ($_FILES["txtuplode"]["tmp_name"]!="")
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
		$errmsg .="Please Select Banner Status."."<br>";
		}
}
if($errmsg == '')
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
 
if ($_FILES["txtuplode"]["name"]!=""){
			if ($_FILES["txtuplode"]["size"] < 1048576)
				{
	   $sql = "select b_image_path FROM banner WHERE b_id=$cid";
    $rs = mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($rs);

	$path ="../../upload/banner";
	$path2 ="../../upload/banner/thumb";
unlink($path . "/" .$row['b_image_path']);
unlink($path2 . "/" .$row['b_image_path']);


	
	
						//$max_upload_width = 700;
						//$max_upload_height = 500;
						if ($_FILES["txtuplode"]["size"] < 1048576)
						{
						
						if($_FILES["txtuplode"]["type"] == "image/jpeg" || $_FILES["txtuplode"]["type"] == "image/pjpeg"){	
						$image_source = imagecreatefromjpeg($_FILES["txtuplode"]["tmp_name"]);
						}		
						// if uploaded image was GIF
						if($_FILES["image_upload_box"]["type"] == "image/gif"){	
						$image_source = imagecreatefromgif($_FILES["txtuplode"]["tmp_name"]);
						}	
						// BMP doesn't seem to be supported so remove it form above image type test (reject bmps)	
						// if uploaded image was BMP
						if($_FILES["image_upload_box"]["type"] == "image/bmp"){	
						$image_source = imagecreatefromwbmp($_FILES["txtuplode"]["tmp_name"]);
						}			
						// if uploaded image was PNG
						if($_FILES["image_upload_box"]["type"] == "image/x-png"){
						$image_source = imagecreatefrompng($_FILES["txtuplode"]["tmp_name"]);
						}
		
						$filename1=$_FILES['txtuplode']['name'];
						$uniq = uniqid("");
										$filename1=$uniq.$filename1;

						$PATH="../../upload/banner/";
						
						if(!is_dir($PATH)){  
						mkdir($PATH,0777);
						}
						$PATH=$PATH."/";
						
						$remote_file = $PATH.$filename1;
						$test=imagejpeg($image_source,$remote_file,100);
						$size=filesize($PATH.$filename1);
						$size=ceil($size/1024);
						$found="false";
						
						
list($image_width, $image_height) = getimagesize($remote_file);
if($image_width>$max_upload_width || $image_height >$max_upload_height)
{
$proportions = $image_width/$image_height;

if($image_width>$image_height)
{
/*$new_width = $max_upload_width;
$new_height = round($max_upload_width/$proportions);
*/
  $new_width = $max_upload_width;
			 $new_height = $max_upload_height;

}		
else{
/*$new_height = $max_upload_height;
$new_width = round($max_upload_height*$proportions);*/
  $new_width = $max_upload_width;
				 $new_height = $max_upload_height;
}		


$new_image = imagecreatetruecolor($new_width , $new_height);
$image_source = imagecreatefromjpeg($remote_file);

imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
imagejpeg($new_image,$remote_file,100);

imagedestroy($new_image);
}
imagedestroy($image_source);
		/*
					move_uploaded_file($_FILES["txtuplode"]["tmp_name"],$PATH.$filename1);
					$size=filesize($PATH.$filename1);
					$size=ceil($size/1024);
					$found="false";*/
					
				}
else{
			$msg=IMAGE_SIZE_LIMIT;
			$_SESSION['sess_msg']=$msg;
			header("location:edit_banner.php");
			exit;
}	




$add_img='../../upload/banner/'.$filename1;
$add_thumb='../../upload/banner/thumb/'.$filename1;
//$add_thumb1='../../upload/photogallery/front_thumb/'.$filename1;
generate_image_thumbnail($add_img,$add_thumb);
//generate_image_frontthaumb($add_img,$add_thumb1);

	$filename1=addslashes($filename1);
	$tableName_send="banner";
	$whereclause="b_id='$cid'";
	$old =array("b_image_path");
	$new =array("$filename1");
	$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);

}	
}		
		$tableName_send="banner";
	$whereclause="b_id='$cid'";
$old=array("b_name","b_title","h_title","b_language","b_short_desc","approve_status","admin_id");
$new=array("$txtename","$txtepage_title","$txtepage_titlehi","$txtlanguage","$sortcontentdesc","$txtstatus","$user_id");
$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);
if($txtstatus=='3')
{
	$tableName_send="banner_publish";
	$whereclause="where publish_id='$cid'";
	$page_id=$cid;
$sql=mysqli_query($conn,"Select * from banner_publish $whereclause");
$row=mysqli_num_rows($sql); 
	$whereclause="where b_id='$cid'";
	$sql=mysqli_query($conn,"Select * from banner $whereclause");
	 $rowss=mysqli_fetch_array($sql);
   $imagepath=$rowss['b_image_path']; 

if($row >0)
{
$whereclause="publish_id='$cid'";
$old =array("publish_id","b_name","b_title","h_title","b_language","b_short_desc","b_image_path","approve_status","admin_id");
$new =array("$page_id","$txtename","$txtepage_title","$txtepage_titlehi","$txtlanguage","$sortcontentdesc","$imagepath","$txtstatus","$user_id");
$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);
$user_id=$_SESSION['admin_auto_id_sess'];
}
else
{
	 $page_id=$cid; 
	$tableFieldsName_old=array("publish_id","b_name","b_title","h_title","b_language","b_short_desc","b_image_path","approve_status","admin_id","page_postion");
	$tableFieldsValues_send=array("$page_id","$txtename","$txtepage_title","$txtepage_titlehi","$txtlanguage","$sortcontentdesc","$imagepath","$txtstatus","$user_id","");
	$useAVclass->insertQuery($tableName_send,$tableFieldsName_old,$tableFieldsValues_send);
  }

}
$user_login_id=$_SESSION['admin_auto_id_sess'];
$page_id=$cid;
$action="Update";
$categoryid='3';
$date=date("Y-m-d h:i:s");
$ip=$_SERVER['REMOTE_ADDR'];
$tableName="audit_trail";
$tableFieldsName_send=array("user_login_id","page_id","page_name","page_action","page_category","page_action_date","ip_address","lang","page_title");
$tableFieldsValues_send=array("$user_login_id","$page_id","$url","$action","$model_id","$date","$ip","$txtlanguage","$txtepage_title");
$value=$useAVclass->insertQuery($tableName,$tableFieldsName_send,$tableFieldsValues_send);
$msg=UPDATE;
$_SESSION['content']=$msg;
$_SESSION['token'] = "";
	$_SESSION['uniq'] ="";
	
header("location:manage_banner.php");
exit;

}


}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Home Banner add/update: <?php echo $sitename;?></title>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link href="style/admin.css" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="js/jsDatePick.js"></script>
<link href="style/jsDatePick.css" rel="stylesheet" type="text/css" />
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
			<span class="submenuclass"><a href="manage_banner.php" title="Manage What's New">Manage Home Banner</a></span>
			 <span class="submenuclass">>> </span> 
			<span class="submenuclass">Add/Update Home Banner</span>
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
 <h3 class="manageuser">Add/Update Home Banner </h3>
 <div class="right-section">
 
 </div>
 </div>		
         <div class="grid_view">
<form action="" method="post" name="form1"  autocomplete="off" enctype="multipart/form-data"  onsubmit="return add_cp('form1')">
	<?php	
	if($_GET['editid']!='')
	{
		$rq = mysqli_query($conn,"select * from banner where b_id='".$_GET['editid']."'");
		//echo "select * from category where c_id='".$_GET['id']."'";
		$rr = mysqli_fetch_array($rq);
				//print_r($rr);
		}
		
	
?>   
<div class="frm_row"> <span class="label1">
              <label for="txtlanguage">Page Language :</label>
              <span class="star">*</span></span> <span class="input1">
              <input type="radio" name="txtlanguage" autocomplete="off" value="1" <?php if($rr['b_language']=='1'){ echo 'checked'; } ?> id="txtlanguage" />English &nbsp;<input type="radio" name="txtlanguage" autocomplete="off" value="2" <?php if($rr['b_language']=='2'){ echo 'checked'; } ?>/>Hindi 
               </span>
              <div class="clear"></div>
			  <div class="loading"></div>
            </div>
			<div class="frm_row"> <span class="label1">
				<label for="txtename">Name:</label>
				<span class="star">*</span></span> <span class="input1">
				<input name="txtename" autocomplete="off" type="text" class="input_class" id="txtename" size="30"   value="<?php echo $rr['b_name']; ?>"/>
				
				</span>
				<div class="clear"></div>
			</div>
			<div class="frm_row"> <span class="label1">
				<label for="txtepage_title">Title:</label>
				<span class="star">*</span></span> <span class="input1">
				<input name="txtepage_title" autocomplete="off" type="text" class="input_class" id="txtepage_title" size="30"   value="<?php echo $rr['b_title']; ?>"/>
				
				</span>
				<div class="clear"></div>
			</div>
		<div class="frm_row"> <span class="label1">
				<label for="txtepage_title">Hindi Title:</label>
				</span> <span class="input1">
				<input name="txtepage_titlehi" autocomplete="off" type="text" class="input_class" id="txtepage_titlehi" size="30"   value="<?php echo $rr['h_title']; ?>"/>
				
				</span>
				<div c
            <div class="frm_row"> <span class="label1">
            <label for="txtuplode">Image Upload :</label>
            </span> <span class="input1">
           <input type="file" name="txtuplode" id="txtuplode"/><?php if($rr['b_image_path'] !='') {?>
		   <img src="../../upload/banner/<?php echo $rr['b_image_path'];?>" alt="" title="" align="center" width="80" height="90" />
		   <?php }?> 
            </span>
			<strong> <a href="http://pixlr.com/editor/" title="If images not less then 1 MB, online reduce the image size." onclick="sitevisit();" target="_blank">Image upload less then 1 MB</a></strong>
            <div class="clear"></div>
            </div>
			<div class="frm_row"> <span class="label1">
        <label for="txtcontentdesc">Short Description :</label>
        <span class="star"></span></span> <span class="input_fck" id="">
<?php
		
		$ckeditor = new CKEditor();
		$ckeditor->basePath = '/ckeditor/';
		$ckeditor->config['filebrowserBrowseUrl'] = '/auth/adminPanel/ckfinder/ckfinder.html';
		$ckeditor->config['filebrowserImageBrowseUrl'] = '/auth/adminPanel/ckfinder/ckfinder.html?type=Images';
		$ckeditor->config['filebrowserUploadUrl'] = '/auth/adminPanel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		$ckeditor->config['filebrowserImageUploadUrl'] = '/auth/adminPanel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
		$ckeditor->editor('sortcontentdesc',stripslashes(html_entity_decode($rr['b_short_desc'])));
		?>        </span>
        <div class="clear"></div>
        </div>	
	
          <div class="frm_row"> 
			<span class="label1">
			<label for="txtstatus">Page Status:</label>
			<span class="star">*</span></span> <span class="input1">
			<select name="txtstatus" id="txtstatus"  autocomplete="off" onchange="divcomment(this.value)">
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
		<input type="button" class="button" value="Back" onClick="javascript:location.href ='manage_banner.php';" />
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
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript">
$(".closestatus").click(function() {
$("#msgerror").addClass("hide").hide();
});
</script>
	<script type="text/javascript">
function sitevisit()
{
if (! confirm('This is external link, Are you sure you want to continue?')) 
return false;
}
</script>
<style>
.hide {display:none;}
</style>