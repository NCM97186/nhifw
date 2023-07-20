<?php ob_start();

session_start();
include("../../includes/config.inc.php");
include("../../includes/useAVclass.php");
include("../../includes/functions.inc.php");
include("../../includes/def_constant.inc.php");
include_once 'ckeditor/ckeditor.php';
include_once 'ckfinder/ckfinder.php';
$useAVclass = new useAVclass();
$useAVclass->connection();
$role_id=$_SESSION['dbrole_id'];
$user_id=$_SESSION['admin_auto_id_sess'];
$model_id= "7";
$role_map=role_permission($user_id,$role_id,$model_id);
$role_id_page=role_permission_page($user_id,$role_id,$model_id);

$_GET['editid'] = isset($_GET['editid'])?base64_decode($_GET['editid']):'';

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
$txtlanguage= check_input($_POST['txtlanguage']);
$txtename = check_input($_POST['txtename']);
$texttype= check_input($_POST['texttype']);
$newicons = check_input($_POST['newicons']);
$sortcontentdesc= check_input($_POST['sortcontentdesc']);
$txtstatus=check_input($_POST['txtstatus']);
$originalstartDate = check_input($_POST['startdate']);;
$startdate = date("Y-m-d", strtotime($originalstartDate));
$originalexpairydate = check_input($_POST['expairydate']);
$expairydate = date("Y-m-d", strtotime($originalexpairydate));
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
		if(trim($newicons)=="")
		{
			$errmsg .="Please select Display New Icons."."<br>";
		}
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Short Description."."<br>";
		}
		
		if ($_FILES["txtuplodepdf"]["tmp_name"]!="")
		{
		$tempfile=($_FILES["txtuplodepdf"]["tmp_name"]);
		$imageinfo = ($_FILES["txtuplodepdf"]["type"]);
		$head = fgets(fopen($tempfile, "r"),5);
		$section = strtoupper(base64_encode(file_get_contents($tempfile)));
		$nsection=substr($section,0,8);
		
		
		if($imageinfo != "application/pdf" )
		{
		$errmsg .= 'Sorry, we accept PDF files only.'."<br>";
		}
		
		else if($head != "%PDF") 
		{
		$errmsg .= 'Sorry,we accept PDF files only.'."<br>";
		}
		
		
		elseif($nsection!="JVBERI0X")
		{
		$errmsg .= 'Sorry,we accept PDF files only.'."<br>";
		}
		
		
		}


		if(trim($originalstartDate)=="")
		{
			$errmsg .="Please enter Start Date:<br>";
		}
		if(trim($originalexpairydate)=="") 
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
			if (preg_match("/^[a-zA-Z0-9'-_() &amp;\"]{2,300}$/i", $txtename) === 0)
						{
						$errmsg .= "Name must be Alphanumeric and Special Characters( _.,:()&amp ) that should be minimum 2 and maximum 300."."<br>";
						}
		}
		
		if(trim($newicons)=="")
		{
			$errmsg .="Please select Display New Icons."."<br>";
		}
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Short Description."."<br>";
		}
		if(trim($sortcontentdesc)!="")
		{
			 if (preg_match('/[^a-zA-Z0-9\s\w-&]/i',$sortcontentdesc))
			{
				$errmsg .= "Short Description must be Alphanumeric that should be minimum 2 and maximum 100."."<br>";
			}
		}
	
	
			
			
				 if ($_FILES["txtuplodepdf"]["tmp_name"]!="")
					{
						$tempfile=($_FILES["txtuplodepdf"]["tmp_name"]);
						$imageinfo = ($_FILES["txtuplodepdf"]["type"]);
						$head = fgets(fopen($tempfile, "r"),5);
						$section = strtoupper(base64_encode(file_get_contents($tempfile)));
						$nsection=substr($section,0,8);
				
				
						/*if($imageinfo != "application/pdf" && $imageinfo != "application/vnd.openxmlformats-officedocument.presentationml.presentation" && $imageinfo != "application/vnd.ms-powerpoint" && $imageinfo != "application/octet-stream")
						{
							$errmsg .= 'Sorry, we only accept valid files(pdf,pptx,doc) only'."<br>";
						}*/
				
						/*else if($head != "%PDF") 
						{
							$errmsg .= 'Sorry,we accept PDF files only'."<br>";
						}*/
				
				if($nsection!="JVBERI0X" &&  $nsection!="UESDBBQA" &&  $nsection!="UESDBBQA" &&  $nsection!="0M8R4KGX")
						{
							$errmsg .= 'Sorry,we only accept PDF,Doc and xls files only';
						}

					}
		
	
		if(trim($originalstartDate)=="")
		{
			$errmsg .="Please enter Start Date:<br>";
		}
		if(trim($originalexpairydate)=="") 
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
		if(trim($txtstatus)=="")
		{
			$errmsg .="Please Select Page Status."."<br>";
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

		if ($_FILES["txtuplodepdf"]["name"]!="")
		{
				$txtuplodepdf=$_FILES['txtuplodepdf']['name'];
				$txtuplode = preg_replace("/[^a-zA-Z0-9.]/", "", $txtuplodepdf);
				$uniq = uniqid("");
				$txtuplodepdf=$uniq.$txtuplodepdf;		
				$PATH="../../upload/tender/";					
				$PATH=$PATH."/"; 
				$val=move_uploaded_file($_FILES["txtuplodepdf"]["tmp_name"],$PATH.$txtuplodepdf);
				$size=filesize($PATH.$txtuplodepdf);
				$size=ceil($size/1024);
				$found="false";
		
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
$tableName_send="tender";

$tableFieldsName_old=array("language_id","m_name","m_short","m_title","m_content","page_url","start_date","end_date","approve_status","admin_id","c_new_status","create_date","docs_file","ext_url","content_type","m_keyword","m_description");
$tableFieldsValues_send=array("$txtlanguage","$txtename","$sortcontentdesc","$m_title","$txtcontentdesc","$url","$startdate","$expairydate","$txtstatus","$user_id","$newicons","$createdate","$txtuplodepdf","$txtweblink","$texttype","$txtekeyword","$txtmeta_description");
$page_id=$useAVclass->insertQuery($tableName_send,$tableFieldsName_old,$tableFieldsValues_send);
// $page_id=mysqli_insert_id($conn);
if($txtstatus=='3')
{
	$sql="INSERT INTO tender_publish (m_publish_id,language_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,approve_status,admin_id,c_new_status,create_date,docs_file,ext_url,content_type,m_keyword,m_description)
	 SELECT m_id, language_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,approve_status,admin_id,c_new_status,create_date,docs_file,ext_url,content_type,m_keyword,m_description
   FROM tender WHERE m_id=$page_id";
//    echo $sql;
//    die();
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
header("location:manage_tenders.php");
exit;	
}
}
if(isset($_POST['cmdsubmit']) && $_GET['editid']!='')
{
$cid=$_GET['editid'];
$txtlanguage= check_input($_POST['txtlanguage']);
$txtename = check_input($_POST['txtename']);
$create_version = check_input($_POST['create_version']);
$newicons = check_input($_POST['newicons']);
$sortcontentdesc= check_input($_POST['sortcontentdesc']);
$texttype= check_input($_POST['texttype']);
$txtekeyword=check_input($_POST['txtekeyword']);
$txtmeta_description=check_input($_POST['txtmeta_description']);
$txtcontentdesc= check_input($_POST['txtcontentdesc']);
$txtweblink= check_input($_POST['txtweblink']);
$txtstatus=check_input($_POST['txtstatus']);
$m_title1=check_input($_POST['page_url']);
$url=seo_url($page_url);
$originalstartDate = check_input($_POST['startdate']);;
$startdate = date("Y-m-d", strtotime($originalstartDate));
$originalexpairydate = check_input($_POST['expairydate']);
$expairydate = date("Y-m-d", strtotime($originalexpairydate));
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
		
		if(trim($newicons)=="")
		{
			$errmsg .="Please select Display New Icons."."<br>";
		}
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Short Description."."<br>";
		}
		
		 if ($_FILES["txtuplodepdf"]["tmp_name"]!="")
					{
						$tempfile=($_FILES["txtuplodepdf"]["tmp_name"]);
						$imageinfo = ($_FILES["txtuplodepdf"]["type"]);
						$head = fgets(fopen($tempfile, "r"),5);
						$section = strtoupper(base64_encode(file_get_contents($tempfile)));
						$nsection=substr($section,0,8);
				
				
						if($imageinfo != "application/pdf" && $imageinfo != "application/vnd.openxmlformats-officedocument.presentationml.presentation" && $imageinfo != "application/vnd.ms-powerpoint" && $imageinfo != "application/octet-stream")
						{
							$errmsg .= 'Sorry, we accept PDF,Doc files only';
						}
				
						else if($head != "%PDF") 
						{
							$errmsg .= 'Sorry,we accept PDF files only';
						}
				
				
							elseif($nsection!="JVBERI0X" &&  $nsection!="UESDBBQA" &&  $nsection!="UESDBBQA" &&  $nsection!="0M8R4KGX")
						{
							$errmsg .= 'Sorry,we only accept PDF,Doc and xls files only';
						}
				

					}
	
		if(trim($originalstartDate)=="")
		{
			$errmsg .="Please enter Start Date:<br>";
		}
		if(trim($originalexpairydate)=="") 
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
			if (preg_match("/^[a-zA-Z0-9'-_() &amp;\"]{2,300}$/i", $txtename) === 0)
						{
						$errmsg .= "Name must be Alphanumeric and Special Characters( _.,:()&amp ) that should be minimum 2 and maximum 300."."<br>";
						}
		}
	
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Short Description."."<br>";
		}
		if(trim($sortcontentdesc)!="")
		{
			 if (preg_match('/[^a-zA-Z0-9\s\w-&]/i',$sortcontentdesc))
			{
				$errmsg .= "Short Description must be Alphanumeric that should be minimum 2 and maximum 100."."<br>";
			}
		}
	
		if($_FILES["txtuplodepdf"]["tmp_name"]!="")
					{
						$tempfile=($_FILES["txtuplodepdf"]["tmp_name"]);
						$imageinfo = ($_FILES["txtuplodepdf"]["type"]);
						$head = fgets(fopen($tempfile, "r"),5);
						$section = strtoupper(base64_encode(file_get_contents($tempfile)));
						$nsection=substr($section,0,8);
				
				
						if($imageinfo != "application/pdf" )
						{
							$errmsg .= 'Sorry, we accept PDF files only';
						}
				
						else if($head != "%PDF") 
						{
							$errmsg .= 'Sorry,we accept PDF files only';
						}
				
				
						elseif($nsection!="JVBERI0X")
						{
							$errmsg .= 'Sorry,we accept PDF files only';
						}
				

					}
		
		if(trim($originalstartDate)=="")
		{
			$errmsg .="Please enter Start Date:<br>";
		}
		if(trim($originalexpairydate)=="") 
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
		if(trim($txtstatus)=="")
		{
			$errmsg .="Please Select Page Status."."<br>";
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
	if ($_FILES["txtuplodepdf"]["name"]!="")
			{
			$sql = "select docs_file FROM tender WHERE m_id=$cid";
			$rs = mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($rs);
			$image_path = "../../upload/tender/".$row['docs_file'];
			unlink($image_path);
   
			/*if ($_FILES["txtuplode"]["size"] < 500000)
			{*/
			$txtuplodepdf=$_FILES['txtuplodepdf']['name'];
			$uniq = uniqid("");
			$txtuplodepdf=$uniq.$txtuplodepdf;		
			$PATH="../../upload/tender";					
			$PATH=$PATH."/"; 
			$val=move_uploaded_file($_FILES["txtuplodepdf"]["tmp_name"],$PATH.$txtuplodepdf);
			$size=filesize($PATH.$txtuplodepdf);
			$size=ceil($size/1024);
			$found="false";
			$txtuplodepdf=addslashes($txtuplodepdf); 
			$whereclause="m_id=$cid";
			$tableName_send="tender";
			$old =array("docs_file");
			$new =array("$txtuplodepdf");
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
$tableName_send="tender";
$old=array("language_id","m_name","m_short","m_title","m_content","page_url","start_date","end_date","approve_status","admin_id","c_new_status","create_date","ext_url","content_type","m_keyword","m_description","update_date");
$new=array("$txtlanguage","$txtename","$sortcontentdesc","$m_title1","$txtcontentdesc","$url","$startdate","$expairydate","$txtstatus","$user_id","$newicons","$create_date","$txtweblink","$texttype","$txtekeyword","$txtmeta_description","$update_date");
	$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);
//if($txtstatus=='3'){

	$tableName_send="tender_publish";
	$whereclause="where m_publish_id='$cid'";
$sql=mysqli_query($conn,"Select * from tender_publish $whereclause");
$row=mysqli_num_rows($sql); 

	if($row >0)
	{
$update="UPDATE tender_publish,tender SET tender_publish.m_publish_id = tender.m_id,tender_publish.language_id = tender.language_id,tender_publish.m_name = tender.m_name,tender_publish.m_short = tender.m_short,tender_publish.m_title = tender.m_title,tender_publish.m_content = tender.m_content,tender_publish.page_url = tender.page_url,tender_publish.start_date = tender.start_date,tender_publish.end_date = tender.end_date,tender_publish.approve_status = tender.approve_status,tender_publish.admin_id = tender.admin_id,tender_publish.c_new_status = tender.c_new_status,tender_publish.create_date = tender.create_date,tender_publish.docs_file = tender.docs_file,tender_publish.ext_url = tender.ext_url,tender_publish.content_type = tender.content_type,tender_publish.m_keyword = tender.m_keyword,tender_publish.m_description = tender.m_description,tender_publish.update_date = tender.update_date WHERE tender_publish.m_publish_id =tender.m_id and tender.m_id=$cid";
  mysqli_query($conn,$update);
	}
	else {
$sql="INSERT INTO tender_publish (m_publish_id,language_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,approve_status,admin_id,c_new_status,create_date,docs_file,ext_url,content_type,m_keyword,m_description,update_date)
	 SELECT m_id, language_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,approve_status,admin_id,c_new_status,create_date,docs_file,ext_url,content_type,m_keyword,m_description,update_date
   FROM tender WHERE m_id=$cid";
  mysqli_query($conn,$sql);
  }
//}
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
header("location:manage_tenders.php");
exit;	
}
}


$sqlimg = "SELECT * FROM tender WHERE m_id ='".$_GET['editid']."'";

$rsimg	 = mysqli_query($conn,$sqlimg);
$imgg	 = mysqli_fetch_array($rsimg);

// print_r($imgg); die;
//@extract($imgg);

//echo $docs_file;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Tenders Add/Update: <?php echo $sitename;?></title>
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
<script language="javascript" type="text/javascript">
	function addmenutype(id) {
	if(id=='1')
		{ 	document.getElementById('txtDoc').style.display = 'block';
			document.getElementById('txtPDF').style.display = 'none';
			document.getElementById('txtweb').style.display = 'none';
			document.getElementById('media').style.display = 'none';
		}
		else if(id=='2')
		{	document.getElementById('txtDoc').style.display = 'none';
			document.getElementById('txtPDF').style.display = 'block';
			document.getElementById('txtweb').style.display = 'none';
			document.getElementById('media').style.display = 'none';
		}
		else if(id=='3')
		{	document.getElementById('txtDoc').style.display = 'none';
			document.getElementById('txtPDF').style.display = 'none';
			document.getElementById('txtweb').style.display = 'block';
			document.getElementById('media').style.display = 'none';
		}	
		else 
		{	document.getElementById('txtDoc').style.display = 'none';
			document.getElementById('txtPDF').style.display = 'none';
			document.getElementById('txtweb').style.display = 'none';
			document.getElementById('media').style.display = 'block';
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
			<span class="submenuclass"><a href="manage_tenders.php" title="Manage Tenders">Manage Tenders</a></span>
			 <span class="submenuclass">>> </span> 
			<span class="submenuclass">Add/Update Tenders</span>
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
 <h3 class="manageuser">Add/Update Tenders</h3>
 <div class="right-section">
 
 </div>
 </div>		
         <div class="grid_view">
<form action="" method="post" name="form1"  autocomplete="off" enctype="multipart/form-data"  onsubmit="return add_cp('form1')">
	<?php	
	if($_GET['editid']!='')
	{
		$rq = mysqli_query($conn,"select * from tender where 	m_id='".$_GET['editid']."'");
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
				<input name="txtename" autocomplete="off" type="text" class="input_class" id="txtename" size="30"   value="<?php echo $rr['m_name']; ?>"/>
				
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
              <label for="sortcontentdesc">Short Description: </label>
              <span class="star">*</span></span> <span class="input1">
              <!--<textarea rows="2" cols="35" name="sortcontentdesc" autocomplete="off"  id="sortcontentdesc" onkeyup="Javascript:charactersRemaining(this.form.sortcontentdesc, 150, this.form.msg_left); characterLimit(this.form.sortcontentdesc, 150, this.form.sortcontentdesc);" onkeypress="Javascript:charactersRemaining(this.form.sortcontentdesc, 150, this.form.msg_left); characterLimit(this.form.sortcontentdesc, 150, this.form.sortcontentdesc);" onmouseout="Javascript:charactersRemaining(this.form.sortcontentdesc, 150, this.form.msg_left); characterLimit(this.form.sortcontentdesc, 150, this.form.sortcontentdesc);" tabindex="1" ><?php  echo $rr['m_short']; ?>
</textarea> <label style="float:right; margin-right:30px;" class="free" for="textarea_field">
		<script type="text/javascript">
			document.write("&nbsp;&nbsp;&nbsp;<input type='text' name='msg_left' id='msg_left' style='text-align:right;' size='3' value='150' readonly='readonly' /> left of 150 characters maximum.");
		</script>
		<noscript>(text limited to 150 characters)</noscript>-->
		<textarea rows="5" cols="35" name="sortcontentdesc" autocomplete="off"  id="sortcontentdesc"><?php  echo $rr['m_short']; ?></textarea>
		
		</label>
              </span>
              <div class="clear"></div>
          
            </div>
		


<div class="frm_row"> <span class="label1">
<label for="texttype">Menu Type :</label>
<span class="star">*</span></span> <span class="input1">
<select name="texttype" id="texttype" autocomplete="off"  onChange="addmenutype(this.value)" >
<option value="">Select</option>
<?php 
foreach($menutype as $key=>$value)
{
	?>
<option value="<?php echo $key; ?>" <?php if($key==$rr['content_type']){ echo 'selected="selected"'; } else { }?>><?php echo $value; ?></option>
<?php }
 ?>
</select></span>
<div class="clear"></div>
</div>
<div id="txtDoc" <?php if($texttype=='1' || $rr['content_type']=='1') {?> style="display:block" <?php } else {?>style="display:none" <?php } ?>>
		<div class="frm_row"> <span class="label1">
				<label for="page_url">Meta Title:</label> <span class="star">*</span>
				</span> <span class="input1">
				<input name="page_url" autocomplete="off" type="text" class="input_class" id="page_url" size="30"   value="<?php if($rr['m_title']!=""){ echo $rr['m_title'];} ?>"/>
				
				</span>
				<div class="clear"></div>
				</div>
 <div class="frm_row"> <span class="label1">
              <label for="txtekeyword">Meta Keyword:</label>
              </span> <span class="input1">
              <textarea rows="2" cols="35" name="txtekeyword" autocomplete="off" id="txtekeyword"><?php if($rr['m_keyword']!=""){ echo $rr['m_keyword'];} ?></textarea>
              </span>
              <div class="clear"></div>
            </div>
            <div class="frm_row"> <span class="label1">
              <label>Meta Description:</label>
              </span> <span class="input1">
              <textarea rows="2" cols="35" name="txtmeta_description" autocomplete="off"  id="txtmeta_description" ><?php if($rr['m_description']!=""){ echo $rr['m_description'];} ?>
</textarea>
              </span>
              <div class="clear"></div>
            </div>
        <div class="frm_row"> <span class="label1">
        <label>Description :</label>
        <span class="star">*</span></span> <span class="input_fck">
<?php
		
		$ckeditor = new CKEditor();
		$ckeditor->basePath = '/ckeditor/';
		$ckeditor->config['filebrowserBrowseUrl'] = '/auth/adminPanel/ckfinder/ckfinder.html';
		$ckeditor->config['filebrowserImageBrowseUrl'] = '/auth/adminPanel/ckfinder/ckfinder.html?type=Images';
		$ckeditor->config['filebrowserUploadUrl'] = '/auth/adminPanel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		$ckeditor->config['filebrowserImageUploadUrl'] = '/auth/adminPanel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
		$ckeditor->editor('txtcontentdesc',stripslashes(html_entity_decode($rr['m_content'])));
		?>        </span>
        <div class="clear"></div>
        </div>
</div>
<div id="txtPDF"  <?php if($texttype=='2' || $rr['content_type']=='2') {?> style="display:block" <?php } else {?>style="display:none" <?php } ?>>
            <div class="frm_row"> <span class="label1">
            <label for="txtuplodepdf">Document Upload :</label>
            <span class="star">*</span></span> <span class="input1">
           <input type="file" name="txtuplodepdf" id="txtuplodepdf"/>
            </span>
            <div class="clear"></div>
            </div>
</div>

<div id="txtweb"<?php if($texttype=='3' || $rr['content_type']=='3') {?> style="display:block" <?php } else {?>style="display:none" <?php } ?>>
   <div class="frm_row"> <span class="label1">
            <label for="txtweblink">Web Site Link :</label>
            <span class="star">*</span></span> <span class="input1">
          <input type="text" name="txtweblink" id="txtweblink" size="30" class="textbox" value="<?php if($rr['ext_url']!=""){ echo $rr['ext_url'];} ?>">
		<span class="date"><strong>Example : https://www.xyz.com</strong></span>

            </span>
            <div class="clear"></div>
            </div>
</div>

    <div class="frm_row"> <span class="label1">
                                                        <label for="startdate">Start Date:</label><span class="star">*</span>
                                                    </span> <span class="input1">
                                          <input type="text" name="startdate" id="startdate" readonly="readonly"  autocomplete="off" value="<?php if($rr['start_date'] !=''){ echo changeformate($rr['start_date']); } else { } ?>"/><span class="date">[dd-mm-yyyy]</span> 

                                                    </span>
                                                    <div class="clear"></div>
            </div> 
                                                <div class="frm_row"> <span class="label1">
                                                        <label for="expairydate">Termination Date:</label><span class="star">*</span>
                                                    </span> <span class="input1">
                                                        <input type="text" name="expairydate" autocomplete="off" readonly="readonly"  id="expairydate" value="<?php if($rr['end_date'] !=''){  echo changeformate($rr['end_date']); }else {}
                                                               
                                                           ?>"/><span class="date">[dd-mm-yyyy]</span> 

                                                    </span>
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
		<option value="<?php echo $row['state_id'];?>" <?php if ($rr['approve_status']==$row['state_id']) echo 'selected="selected"';?>><?php echo $row['state_name']; ?></option>
			<?php }
			}
			else if($user_id !='101' )
			{
			$sql=mysqli_query($conn,"select * from content_state");
			
			while($row=mysqli_fetch_array($sql))
			{  
			if($row['state_short']==$role_map['draft']){
			?>
			<option value="<?php echo $row['state_id'];?>" <?php if ($rr['approve_status']==$row['state_id']) echo 'selected="selected"';?>><?php echo $row['state_name']; ?></option>
			<?php }
			
			if($row['state_short']==$role_map['mapprove']){
			?>
                <option value="<?php echo $row['state_id'];?>"><?php echo $row['state_name']; ?></option>
                <?php }
			if($row['state_short']==$role_map['publish']){
			?>
			<option value="<?php echo $row['state_id'];?>" <?php if ($rr['approve_status']==$row['state_id']) echo 'selected="selected"';?>><?php echo $row['state_name']; ?></option>
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
		<input type="button" class="button" value="Back" onClick="javascript:location.href ='manage_circular_events.php';" />
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

  

</div> <!-- Container div-->
<!-- Footer start -->      
      <?php include("footer.php");    ?>
      <!-- Footer end --> 
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