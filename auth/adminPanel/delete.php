<?php ob_start();
session_start();
include("../../includes/config.inc.php");
include("../../includes/useAVclass.php");
include("../../includes/functions.inc.php");
include("../../includes/def_constant.inc.php");
include_once 'ckeditor/ckeditor.php';
include_once 'ckfinder/ckfinder.php';
@extract($_GET);
@extract($_POST);
@extract($_SESSION);
$useAVclass = new useAVclass();
$useAVclass->connection();
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

/*
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
*/
 

if($status=='deleteid_user')
{
 $msg=CONTENTDELETE; 
	$_SESSION['manage_user']=$msg;
		header("Location:manage_user.php");
		exit();
}

if($status=='deleteid')
{
 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("Location:manage_menu.php");
		exit();
}
if($status=='inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_menu.php");
}
if($status=='whatsnew_deleteid')
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_whatsnew.php");
}
if($status=='whatsnew_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_whatsnew.php");
}

if($status=='circualr_deleteid')
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_circular_events.php");
}
if($status=='circualr_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_circular_events.php");
}
if($status=='minister_deleteid')
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:minister_speech.php");
}
if($status=='minister_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:minister_speech.php");
}

if($status=='important_deleteid')
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_important_link.php");
}
if($status=='important_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_important_link.php");
}

if($status=='tenders_deleteid')
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_tenders.php");
}
if($status=='tenders_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_tenders.php");
}
if($status=='recruitement_deleteid')
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_recruitment.php");
}
if($status=='recruitement_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_recruitment.php");
}
if($status=='information_deleteid')
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_importent_information.php");
}
if($status=='information_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_importent_information.php");
}


if($status=='latest_deleteid')
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_latest_information.php");
}
if($status=='latest_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_latest_information.php");
}








if($status=='home_deleteid')
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_message.php");
}
if($status=='home_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_message.php");
}


if($status=='deleteid_roleid' )
{
     
	$msg=CONTENTDELETE; 
	$_SESSION['manage_user']=$msg;
	header("location:manage_role.php");
        exit;
}

if($status=='banner' )
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_banner.php");
}
if($status=='bannerdelete' )
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_banner.php");
}
if($status=='video_gallerydelete' )
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_video_gallery.php");
}
if($status=='video_gallery' )
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_video_gallery.php");
}
if($status=='photo_gallerydelete' )
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_photo_gallery.php");
}
if($status=='photo_gallery' )
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_photo_gallery.php");
}
if($status=='deleteid' )
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_submenu.php");
}


if($status=='recruitement_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_recruitment.php");
}
if($status=='employee_deleteid')
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_employee_corner.php");
}
if($status=='employee_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_employee_corner.php");
}

if($status=='distance_deleteid')
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_distance_learning.php");
}
if($status=='distance_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_distance_learning.php");
}


if($status=='distance_deleteid')
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_distance_learning.php");
}
if($status=='distance_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_distance_learning.php");
}


if($status=='student_deleteid')
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_student.php");
}
if($status=='student_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_student.php");
}


if($status=='project_deleteid')
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_project.php");
}
if($status=='project_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_project.php");
}

if($status=='recruitment_deleteid')
{
	 $msg=CONTENTDELETE; 
	$_SESSION['content']=$msg;
		header("location:manage_recruitment.php");
}
if($status=='recruitment_inactiveid')
{
	 $msg=CONTENTINACTIVE; 
	$_SESSION['content']=$msg;
		header("location:manage_recruitment.php");
}












?>




