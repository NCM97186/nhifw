<?php 

ob_start();
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
$model_id= "6";
$role_map=role_permission($user_id,$role_id,$model_id);
$role_id_page=role_permission_page($user_id,$role_id,$model_id);
$_GET['editid'] = base64_decode($_GET['editid']);

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
	@extract($_POST);;
$txtlanguage= check_input($_POST['txtlanguage']);
$txtename = check_input($_POST['txtename']);
$cat_id = check_input($_POST['texcat']);



$expairydate_time = check_input($_POST['expairydate_time']);

$startdate_time = check_input($_POST['startdate_time']);

$newicons = check_input($_POST['newicons']);
$sortcontentdesc= check_input($_POST['sortcontentdesc']);
$texttype= check_input($_POST['texttype']);
$txtekeyword=check_input($_POST['txtekeyword']);
$txtmeta_description=check_input($_POST['txtmeta_description']);
$txtcontentdesc= check_input($_POST['txtcontentdesc']);
$txtweblink= check_input($_POST['txtweblink']);
$txtstatus=check_input($_POST['txtstatus']);
$m_title=check_input($_POST['page_url']);
$url=seo_url($page_url);
$originalstartDate = check_input($_POST['startdate']);;
$startdate = date("Y-m-d", strtotime($originalstartDate));
$originalexpairydate = check_input($_POST['expairydate']);
$expairydate = date("Y-m-d", strtotime($originalexpairydate));
$txtcategory = check_input($_POST['txtcategory']);
$update_date = $update_date=date('Y-m-d h:i:s');
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
			$errmsg .="Please enter Title."."<br>";
		}

		if(trim($cat_id)=="")
		{
			$errmsg .="Please select Category Type."."<br>";
		}
		if(trim($newicons)=="")
		{
			$errmsg .="Please select Display New Icons."."<br>";
		}
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Collaborating Organisation."."<br>";
		}
		
		
		
		if(trim($texttype)=="")
		{
			$errmsg .="Please Select Menu Type."."<br>";
		}
		if(trim($texttype)!="")
		{

			if($texttype=='1')
			  {	

				if(trim($page_url)=="")
				{
				$errmsg .= "Meta Title must be Alphanumeric "."<br>";
				}

				if(trim($txtcontentdesc)=="")
				{
				$errmsg .="Please enter Meta Description."."<br>";
				
				}
			}
			 if($texttype=='2')
			  {	
				 if ($_FILES["txtuplodepdf"]["tmp_name"]!="")
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
				}
			 if($texttype=='3')
			  {	if(trim($txtweblink)=="")
				{
				$errmsg .="Please enter web link ."."<br>";
				
				}
				if(trim($link) !="")
				{
					if (!validateURL($link))
					 {
					$errmsg .="URL address not valid.<br>";
					}
				}
				
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
			$errmsg .="Please enter Title."."<br>";
		}
		if(trim($newicons)=="")
		{
			$errmsg .="Please select Display New Icons."."<br>";
		}
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Collaborating Organisation."."<br>";
		}
		
		
		if(trim($texttype)=="")
		{
			$errmsg .="Please Select Menu Type."."<br>";
		}
		if(trim($texttype)!="")
		{

			if($texttype=='1')
			  {	

				if(trim($page_url)=="")
				{
				$errmsg .= "Meta Title must be Alphanumeric "."<br>";
				}

				if(trim($txtcontentdesc)=="")
				{
				$errmsg .="Please enter Meta Description."."<br>";
				
				}
			}
			 if($texttype=='2')
			  {	
				 if ($_FILES["txtuplodepdf"]["tmp_name"]!="")
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
				}
			 if($texttype=='3')
			  {	if(trim($txtweblink)=="")
				{
				$errmsg .="Please enter web link ."."<br>";
				
				}
				if(trim($link) !="")
				{
					if (!validateURL($link))
					 {
					$errmsg .="URL address not valid.<br>";
					}
				}
				
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
				$PATH="../../upload/latest/";					
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
$tableName_send="latest_information";

$tableFieldsName_old=array("language_id","cat_id","m_name","m_short","m_title","m_content","page_url","start_date","end_date","start_time","end_time","approve_status","admin_id","c_new_status","create_date","docs_file","ext_url","content_type","m_keyword","m_description","update_date");
$tableFieldsValues_send=array("$txtlanguage","$cat_id","$txtename","$sortcontentdesc","$m_title","$txtcontentdesc","$url","$startdate","$expairydate","$startdate_time","$expairydate_time","$txtstatus","$user_id","$newicons","$createdate","$txtuplodepdf","$txtweblink","$texttype","$txtekeyword","$txtmeta_description","$update_date");

$value=$useAVclass->insertQuery($tableName_send,$tableFieldsName_old,$tableFieldsValues_send);
 $page_id=$value;

if($txtstatus=='3')
{

//  $tableName_send_pub="latest_information_publish";

// $tableFieldsName_old_pub=array("language_id","cat_id","m_name","m_short","m_title","m_content","page_url","start_date","end_date","start_time","end_time","approve_status","admin_id","c_new_status","create_date","docs_file","ext_url","content_type","m_keyword","m_description","update_date");
// $tableFieldsValues_send_pub=array("$txtlanguage","$cat_id","$txtename","$sortcontentdesc","$m_title","$txtcontentdesc","$url","$startdate","$expairydate","$startdate_time","$expairydate_time","$txtstatus","$user_id","$newicons","$createdate","$txtuplodepdf","$txtweblink","$texttype","$txtekeyword","$txtmeta_description","$update_date");

// $value_pub=$useAVclass->insertQuery($tableName_send_pub,$tableFieldsName_old_pub,$tableFieldsValues_send_pub);

// $page_id=$value_pub;

 $sql="INSERT INTO latest_information_publish (m_publish_id,language_id,cat_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,start_time,end_time,approve_status,admin_id,c_new_status,create_date,docs_file,ext_url,content_type,m_keyword,m_description,update_date)
	 SELECT m_id, language_id,cat_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,start_time,end_time,approve_status,admin_id,c_new_status,create_date,docs_file,ext_url,content_type,m_keyword,m_description,update_date
   FROM latest_information WHERE m_id=$page_id";
  
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
header("location:manage_latest_information.php");
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
$cat_id= check_input($_POST['texcat']);
$addphoto= check_input($_POST['addphoto']);
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
$expairydate = date("Y-m-d", strtotime($originalexpairydate));;
$txtcategory = check_input($_POST['txtcategory']);
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
			$errmsg .="Please enter Title."."<br>";
		}
		//if(trim($create_version)=="")
			//{
			//$errmsg.="Please Select Create New Versions."."<br>";
			
			//}

			if(trim($cat_id)=="")
		{
			$errmsg .="Please select Category Type."."<br>";
		}
		if(trim($newicons)=="")
		{
			$errmsg .="Please select Display New Icons."."<br>";
		}
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Collaborating Organisation."."<br>";
		}
		
		if(trim($cat_id)=="")
		{
			$errmsg .="Please Select Category Type."."<br>";
		}
		if(trim($cat_id)=="3")
		{
			if(trim($addphoto)=="")
			{
			$errmsg .="Please Select Add More Photo."."<br>";
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
		if(trim($texttype)=="")
		{
			$errmsg .="Please Select Menu Type."."<br>";
		}
		if(trim($texttype)!="")
		{

			if($texttype=='1')
			  {	

				if(trim($m_title1)=="")
				{
				$errmsg .= "Meta Title must be Alphanumeric "."<br>";
				}

				if(trim($txtcontentdesc)=="")
				{
				$errmsg .="Please enter Meta Description."."<br>";
				
				}
			}
			if($texttype=='2')
			  {	
				if ($_FILES["txtuplodepdf"]["tmp_name"]!="")
				{
				$tempfile=($_FILES["txtuplodepdf"]["tmp_name"]);
				$imageinfo = ($_FILES["txtuplodepdf"]["type"]);
				$head = fgets(fopen($tempfile, "r"),5);
				$section = strtoupper(base64_encode(file_get_contents($tempfile)));
				$nsection=substr($section,0,8);
				
				/*if($imageinfo != "application/pdf" )
				{
				$errmsg .= 'Sorry, we accept PDF files only';
				}
				
				else if($head != "%PDF") 
				{
				$errmsg .= 'Sorry,we accept PDF files only';
				}*/
				
				if($nsection!="JVBERI0X")
				{
				$errmsg .= 'Sorry,we accept PDF files only';
				}
			  }
			}
			if($texttype=='3')
			  {	if(trim($txtweblink)=="")
				{
				$errmsg .="Please enter web link ."."<br>";
				
				}
				if(trim($link) !="")
				{
					if (!validateURL($link))
					 {
					$errmsg .="URL address not valid.<br>";
					}
				}
				
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
		elseif($exp['2'] < $sta['2'])
		{
			$errmsg .="Please enter Start Date less then Termination Date.<br>";
		} 
		elseif(($exp['2'] == $sta['2']) && ($exp['1'] < $sta['1'])) 
		{
			$errmsg .="Please enter Start Date less then Termination Date.<br>";
		} 
		elseif((($exp['2'] == $sta['2']) && ($exp['1'] == $sta['1'])) && ($exp['0'] < $sta['0'])) 
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
			$errmsg .="Please enter Title."."<br>";
		}

		//if(trim($create_version)=="")
			//{
			//$errmsg.="Please Select Create New Versions."."<br>";
		//}

		if(trim($cat_id)=="")
		{
			$errmsg .="Please select Category Type."."<br>";
		}
		if(trim($newicons)=="")
		{
			$errmsg .="Please select Display New Icons."."<br>";
		}
		if(trim($sortcontentdesc)=="")
		{

		$errmsg .="Please enter Collaborating Organisation."."<br>";

		}
		
		if(trim($cat_id)=="")
		{
			$errmsg .="Please Select Category Type."."<br>";
		}

		if(trim($cat_id)=="3")
		{
			/*if(trim($addphoto)=="")
			{
			$errmsg .="Please Select Add More Photo."."<br>";
			}*/
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
		if(trim($texttype)=="")
		{
			$errmsg .="Please Select Menu Type."."<br>";
		}
		if(trim($texttype)!="")
		{

			if($texttype=='1')
			  {	

				if(trim($m_title1)=="")
				{
				$errmsg .= "Meta Title must be Alphanumeric "."<br>";
				}

				if(trim($txtcontentdesc)=="")
				{
				$errmsg .="Please enter Meta Description."."<br>";
				
				}
			}
			 if($texttype=='2')
			  {	
				 if ($_FILES["txtuplodepdf"]["tmp_name"]!="")
					{
						$tempfile=($_FILES["txtuplodepdf"]["tmp_name"]);
						$imageinfo = ($_FILES["txtuplodepdf"]["type"]);
						$head = fgets(fopen($tempfile, "r"),5);
						$section = strtoupper(base64_encode(file_get_contents($tempfile)));
						$nsection=substr($section,0,8);
				
				
						/*if($imageinfo != "application/pdf" )
						{
							$errmsg .= 'Sorry, we accept PDF files only';
						}
				
						else if($head != "%PDF") 
						{
							$errmsg .= 'Sorry,we accept PDF files only';
						}*/
				
				
						if($nsection!="JVBERI0X")
						{
							$errmsg .= 'Sorry,we accept PDF files only';
						}
				

					}
				}
			 if($texttype=='3')
			  {	if(trim($txtweblink)=="")
				{
				$errmsg .="Please enter web link ."."<br>";
				
				}
				if(trim($link) !="")
				{
					if (!validateURL($link))
					 {
					$errmsg .="URL address not valid.<br>";
					}
				}
				
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
				
			$sql = "select docs_file FROM latest_information WHERE m_id=$cid";
			$rs = mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($rs);
			$image_path = "../../upload/latest/".$row['docs_file'];
			unlink($image_path);
   
			/*if ($_FILES["txtuplode"]["size"] < 500000)
			{*/
			$txtuplodepdf=$_FILES['txtuplodepdf']['name'];
			$uniq = uniqid("");
			$txtuplodepdf=$uniq.$txtuplodepdf;		
			$PATH="../../upload/latest/";					
			$PATH=$PATH."/"; 
			$val=move_uploaded_file($_FILES["txtuplodepdf"]["tmp_name"],$PATH.$txtuplodepdf);
			$size=filesize($PATH.$txtuplodepdf);
			$size=ceil($size/1024);
			$found="false";
			$txtuplodepdf=addslashes($txtuplodepdf); 
			$whereclause="m_id=$cid";
			$tableName_send="latest_information";
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
$tableName_send="latest_information";
$old=array("language_id","m_name","cat_id","m_short","m_title","m_content","page_url","start_date","end_date","start_time","end_time","approve_status","admin_id","c_new_status","create_date","ext_url","content_type","m_keyword","m_description","update_date");
$new=array("$txtlanguage","$txtename","$cat_id","$sortcontentdesc","$m_title1","$txtcontentdesc","$url","$startdate","$expairydate","$startdate_time","$expairydate_time","$txtstatus","$user_id","$newicons","$create_date","$txtweblink","$texttype","$txtekeyword","$txtmeta_description","$update_date");

$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);


if($txtstatus=='3' || $txtstatus=='2' || $txtstatus=='1')
{ 
	
	$create_date=date('y-m-d');
	$whereclause_m="where m_publish_id=$cid";
$sql=mysqli_query($conn,"Select * from latest_information_publish $whereclause_m");
$row=mysqli_num_rows($sql); 
	if($row >0)
	{
 	$create_date=date('y-m-d');
	$whereclause_pub="m_publish_id=$cid";
$tableName_send_pub="latest_information_publish";
$old_pub=array("language_id","m_name","cat_id","m_short","m_title","m_content","page_url","start_date","end_date","start_time","end_time","approve_status","admin_id","c_new_status","create_date","ext_url","content_type","m_keyword","m_description","update_date");
$new_pub=array("$txtlanguage","$txtename","$cat_id","$sortcontentdesc","$m_title1","$txtcontentdesc","$url","$startdate","$expairydate","$startdate_time","$expairydate_time","$txtstatus","$user_id","$newicons","$create_date","$txtweblink","$texttype","$txtekeyword","$txtmeta_description","$update_date");


	$useAVclass->UpdateQuery($tableName_send_pub,$whereclause_pub,$old_pub,$new_pub);
	

	}
	else {
// $tableName_send12 = 'latest_information_publish';
// $tableFieldsName_send12=array("language_id","m_name","cat_id","m_short","m_title","m_content","page_url","start_date","end_date","start_time","end_time","approve_status","admin_id","c_new_status","create_date","ext_url","content_type","m_keyword","m_description","update_date");
// 	$tableFieldsValues_send12=array("$txtlanguage","$txtename","$cat_id","$sortcontentdesc","$m_title1","$txtcontentdesc","$url","$startdate","$expairydate","$startdate_time","$expairydate_time","$txtstatus","$user_id","$newicons","$create_date","$txtweblink","$texttype","$txtekeyword","$txtmeta_description","$update_date");
// 	$useAVclass->insertQuery($tableName_send12,$tableFieldsName_send12,$tableFieldsValues_send12);


$sql="INSERT INTO latest_information_publish (m_publish_id,language_id,cat_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,start_time,end_time,approve_status,admin_id,c_new_status,create_date,docs_file,ext_url,m_keyword,m_description,update_date)
	 SELECT m_id, language_id,cat_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,start_time,end_time,approve_status,admin_id,c_new_status,create_date,docs_file,ext_url,m_keyword,m_description,update_date
   FROM latest_information WHERE m_id ='$cid'";
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
header("location:manage_latest_information.php");
exit;	
}

}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Meeting / Workshop : <?php echo $sitename;?></title>
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
<script language="javascript" type="text/javascript">
	function eventhi(id) {
	if(id=='3')
		{ 	document.getElementById('des').style.display = 'block';
			document.getElementById('other').style.display = 'none';
			
		}
		else 
		{	document.getElementById('des').style.display = 'none';
			document.getElementById('other').style.display = 'block';
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
	function addevent(id) {
	if(id=='3')
		{ 	document.getElementById('txtevent').style.display = 'block';
		}
		else if(id=='5')
		{ 	document.getElementById('txtevent').style.display = 'block';
		}
		else if( id == '2'){
			document.getElementById('category').style.display = 'block';
		}
		else 
		{	
		document.getElementById('txtevent').style.display = 'none';
		
		}	
		if( id != '2'){
			document.getElementById('category').style.display = 'none';
		}
	}
  	

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
			<span class="submenuclass"><a href="manage_latest_information.php" title="Manage Circular / Events">Manage Meeting / Workshop</a></span>
			 <span class="submenuclass">>> </span> 
			<span class="submenuclass">Add/Update Meeting / Workshop</span>	</div>
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
 <h3 class="manageuser">Add/Update Meeting / Workshop </h3>
 <div class="right-section">
 
 </div>
 </div>		
         <div class="grid_view">
<form action="" method="post" name="form1"  autocomplete="off" enctype="multipart/form-data"  onsubmit="return add_cp('form1')">
	<?php	
	if($_GET['editid']!='')
	{
		$rq = mysqli_query($conn,"select * from latest_information where 	m_id='".$_GET['editid']."'");
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
				<label for="txtename">Title:</label>
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
              <label for="sortcontentdesc">Collaborating Organisation: </label>
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
<label for="texcat">Category Type :</label>
<span class="star">*</span></span> <span class="input1">
<select name="texcat" id="texcat" autocomplete="off" onChange="addevent(this.value)" >
<option value="">Select</option>
<?php 
foreach($latest_category as $key=>$value)
{
	?>
<option value="<?php echo $key; ?>" <?php if($key==$rr['cat_id']){ echo 'selected="selected"'; } else { }?>><?php echo $value; ?></option>
<?php }
 ?>
</select></span>
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
		$ckeditor->config['filebrowserBrowseUrl'] = ''.$folder.'/auth/adminPanel/ckfinder/ckfinder.html';
		$ckeditor->config['filebrowserImageBrowseUrl'] = ''.$folder.'/auth/adminPanel/ckfinder/ckfinder.html?type=Images';
		$ckeditor->config['filebrowserUploadUrl'] = ''.$folder.'/auth/adminPanel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		$ckeditor->config['filebrowserImageUploadUrl'] = ''.$folder.'/auth/adminPanel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
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

                                             <input type="text" name="startdate_time" id="startdate_time"    autocomplete="off" value="<?php if($rr['start_time'] !=''){ echo $rr['start_time']; } else { } ?>"/><span class="date">[00-00 AM/PM]</span> 

                                                    </span>
                                                    <div class="clear"></div>
          </div> 
                                                <div class="frm_row"> <span class="label1">
                                                        <label for="expairydate">Termination Date:</label><span class="star">*</span>
                                                    </span> <span class="input1">
                                                        <input type="text" name="expairydate" autocomplete="off" readonly="readonly"  id="expairydate" value="<?php if($rr['end_date'] !=''){  echo changeformate($rr['end_date']); }else {}
                                                               
                                                           ?>"/><span class="date">[dd-mm-yyyy]</span> 

                                                                  <input type="text" name="expairydate_time" id="expairydate_time"    autocomplete="off" value="<?php if($rr['end_time'] !=''){ echo $rr['end_time']; } else { } ?>"/><span class="date">[00-00 AM/PM]</span> 
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
		<input type="button" class="button" value="Back" onClick="javascript:location.href ='manage_latest_information.php';" />
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
        <?php include("footer.php"); ?>
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