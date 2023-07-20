<?php ob_start();
session_start();
include("../../includes/config.inc.php");
include("../../includes/useAVclass.php");
include("../../includes/functions.inc.php");
include("../../includes/def_constant.inc.php");
include_once 'ckeditor/ckeditor.php';
include_once 'ckfinder/ckfinder.php';
$_GET['editid']=content_desc(base64_decode($_GET['editid']));

 if(!is_numeric($_GET['editid']) && $_GET['editid'] != '')
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
 //echo "<pre>"; print_r($_POST);

if(isset($_POST['cmdsubmit']) && $_GET['editid']=='')
{

$txtlanguage= content_desc($_POST['txtlanguage']);
$txtename = content_desc($_POST['txtename']);

$texttype= content_desc($_POST['texttype']);
$txtekeyword=content_desc($_POST['txtekeyword']);
$txtmeta_description=content_desc($_POST['txtmeta_description']);
$txtcontentdesc= content_desc($_POST['txtcontentdesc']);
$txtweblink= content_desc($_POST['txtweblink']);
$txtstatus=content_desc($_POST['txtstatus']);
$m_title=content_desc($_POST['page_url']);

$startdate1 = content_desc($_POST['startdate']);
$expairydate1 = content_desc($_POST['expairydate']);

$sta = explode('-', $startdate1);
//$sta = $startdate1;

$startdate = $sta['2'] . "-" . $sta['1'] . "-" . $sta['0'];
$exp = explode('-', $expairydate1);
//$exp = $expairydate1;

$expairydate = $exp['2'] . "-" . $exp['1'] . "-" . $exp['0'];
$createdate=date('Y-m-d');
$errmsg="";
$department_id = $_SESSION['department'];

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

		if(trim($texttype)=="")
		{
			$errmsg .="Please Select Content Type."."<br>";
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


                                                                }else {
                                                                        $errmsg .="Please upload supported document.<br>";
                                                                }
                                                        }
			 if($texttype=='3')
			  {	if(trim($txtweblink)=="")
				{
				$errmsg .="Please enter web link ."."<br>";

				}
				if(trim($txtweblink) !="")
				{
					if (!validateURL($txtweblink))
					 {
					$errmsg .="URL address not valid.<br>";
					}
				}

			}
		}
		if(trim($startdate1)=="")
		{
			$errmsg .="Please enter Start Date:<br>";
		}
		if(trim($expairydate1)=="")
		{
			$errmsg .="Please enter Expiry Date.<br>";
		}
		else if($exp['2'] < $sta['2'])
		{
			$errmsg .="Please enter Start Date less then Expiry Date.<br>";
		}
		else if(($exp['2'] == $sta['2']) && ($exp['1'] < $sta['1']))
		{
			$errmsg .="Please enter Start Date less then Expiry Date.<br>";
		}
		else if((($exp['2'] == $sta['2']) && ($exp['1'] == $sta['1'])) && ($exp['0'] < $sta['0']))
		{
			$errmsg .="Please enter Start Date less then Expiry Date.<br>";
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
		/*if(trim($newicons)=="")
		{
			$errmsg .="Please select Display New Icons."."<br>";
		}
		if(trim($sortcontentdesc)=="")
		{
		$errmsg .="Please enter Short Description."."<br>";
		} */


		if(trim($texttype)=="")
		{
			$errmsg .="Please Select Content Type."."<br>";
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

						/*else if($head != "%PDF")
						{
                                                        echo "aaaaaaaaaaaaaaaaaaaaa"; exit;
							$errmsg .= 'Sorry,we accept PDF files only';
						} */


						/*elseif($nsection!="JVBERI0X")
						{
                                                        echo "gggggggggggggg"; exit;
							$errmsg .= 'Sorry,we accept PDF files only';
						}
				*/

					}else{
                                                                                $errmsg .="Please upload supported document ."."<br>";
                                                                         }
				}
			 if($texttype=='3')
			  {	if(trim($txtweblink)=="")
				{
				$errmsg .="Please enter web link ."."<br>";

				}
				if(trim($txtweblink) !="")
				{
					if (!validateURL($txtweblink))
					 {
					$errmsg .="URL address not valid.<br>";
					}
				}

			}
		}
		if(trim($startdate1)=="")
		{
			$errmsg .="Please enter Start Date:<br>";
		}
		if(trim($expairydate1)=="")
		{
			$errmsg .="Please enter Expity Date.<br>";
		}
		else if($exp['2'] < $sta['2'])
		{
			$errmsg .="Please enter Start Date less then Expity Date.<br>";
		}
		else if(($exp['2'] == $sta['2']) && ($exp['1'] < $sta['1']))
		{
			$errmsg .="Please enter Start Date less then Expity Date.<br>";
		}
		else if((($exp['2'] == $sta['2']) && ($exp['1'] == $sta['1'])) && ($exp['0'] < $sta['0']))
		{
			$errmsg .="Please enter Start Date less then Expity Date.<br>";
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
                $PATH="../../upload/whatsnew/";
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
		

        $url=seo_url($page_url);
		
$tableName_send="whatsnew";
$tableFieldsName_old=array("language_id","cat_id","m_name","m_short","m_title","m_content","page_url","start_date","end_date","approve_status","admin_id","create_date","docs_file","ext_url","content_type","m_keyword","m_description");
$tableFieldsValues_send=array("$txtlanguage","$cat_id","$txtename","$sortcontentdesc","$m_title","$txtcontentdesc","$url","$startdate","$expairydate","$txtstatus","$user_id","$createdate","$txtuplodepdf","$txtweblink","$texttype","$txtekeyword","$txtmeta_description");
$page_id=$useAVclass->insertQuery($tableName_send,$tableFieldsName_old,$tableFieldsValues_send);

if($txtstatus=='3')
{
	$sql="INSERT INTO whatsnew_publish (m_publish_id,language_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,approve_status,admin_id,c_new_status,create_date,docs_file,ext_url,content_type,m_keyword,m_description)
	 SELECT m_id, language_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,approve_status,admin_id,c_new_status,create_date,docs_file,ext_url,content_type,m_keyword,m_description
   FROM whatsnew WHERE m_id='$page_id'";

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
	$msg="insert successfully";
$_SESSION['content']=$msg;
header("location:manage_whatsnew.php");
exit;
}
}

if(isset($_POST['cmdsubmit']) && $_GET['editid']!='')
{

@extract($_POST);
$cid=$_GET['editid'];
$txtlanguage= content_desc($_POST['txtlanguage']);
$txtename = content_desc($_POST['txtename']);
$create_version = content_desc($_POST['create_version']);
$newicons = content_desc($_POST['newicons']);
$sortcontentdesc= content_desc($_POST['sortcontentdesc']);
$cat_id= content_desc($_POST['texcat']);
$addphoto= content_desc($_POST['addphoto']);
$texttype= content_desc($_POST['texttype']);
$txtekeyword=content_desc($_POST['txtekeyword']); 
$txtmeta_description=content_desc($_POST['txtmeta_description']);
$txtcontentdesc= $_POST['txtcontentdesc'];
$txtweblink= content_desc($_POST['txtweblink']);
$txtstatus=content_desc($_POST['txtstatus']);
$m_title1=content_desc($_POST['page_url']);
$url=seo_url($page_url);  
$startdate1 = content_desc($_POST['startdate']);
$expairydate1 = content_desc($_POST['expairydate']);
$txtcategory = content_desc($_POST['txtcategory']); 

// $sta = split('-', $startdate1); 
$sta = explode('-',$startdate1);
$startdate = $sta['2'] . "-" . $sta['1'] . "-" . $sta['0'];
//$exp = split('-', $expairydate1);
$exp = explode('-',$expairydate1);
$expairydate = $exp['2'] . "-" . $exp['1'] . "-" . $exp['0'];
$createdate=date('Y-m-d'); 
	$update_date=date('Y-m-d h:i:s');
        $department_id = $_SESSION['department'];
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

		if(trim($texttype)=="")
		{
			$errmsg .="Please Select Content Type."."<br>";
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
		if(trim($startdate1)=="")
		{
			$errmsg .="Please enter Start Date:<br>";
		}
		if(trim($expairydate1)=="")
		{
			$errmsg .="Please enter Expiry Date.<br>";
		}
		elseif($exp['2'] < $sta['2'])
		{
			$errmsg .="Please enter Start Date less then Expiry Date.<br>";
		}
		elseif(($exp['2'] == $sta['2']) && ($exp['1'] < $sta['1']))
		{
			$errmsg .="Please enter Start Date less then Expiry Date.<br>";
		}
		elseif((($exp['2'] == $sta['2']) && ($exp['1'] == $sta['1'])) && ($exp['0'] < $sta['0']))
		{
			$errmsg .="Please enter Start Date less then Expiry Date.<br>";
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

		if(trim($texttype)=="")
		{
			$errmsg .="Please Select Content Type."."<br>";
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


						if($nsection!="JVBERI0X")
						{
							$errmsg .= 'Sorry,we accept PDF files only';
						}


					}else {
                                                                                $errmsg .="Please upload supported document ."."<br>";
                                                                        }
				}
			 if($texttype=='3')
			  {	if(trim($txtweblink)=="")
				{
				$errmsg .="Please enter web link ."."<br>";

				}
				if(trim($txtweblink) !="")
				{
					if (!validateURL($txtweblink))
					 {
					$errmsg .="URL address not valid.<br>";
					}
				}

			}
		}
		if(trim($startdate1)=="")
		{
			$errmsg .="Please enter Start Date:<br>";
		}
		if(trim($expairydate1)=="")
		{
			$errmsg .="Please enter Expiry Date.<br>";
		}
		else if($exp['2'] < $sta['2'])
		{
			$errmsg .="Please enter Start Date less then Expiry Date.<br>";
		}
		else if(($exp['2'] == $sta['2']) && ($exp['1'] < $sta['1']))
		{
			$errmsg .="Please enter Start Date less then Expiry Date.<br>";
		}
		else if((($exp['2'] == $sta['2']) && ($exp['1'] == $sta['1'])) && ($exp['0'] < $sta['0']))
		{
			$errmsg .="Please enter Start Date less then Expiry Date.<br>";
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

			$sql = "select docs_file FROM whatsnew WHERE m_id=$cid";
			$rs = mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($rs);
			$image_path = "../../upload/whatsnew/".$row['docs_file'];
			unlink($image_path);

			/*if ($_FILES["txtuplode"]["size"] < 500000)
			{*/
			$txtuplodepdf=$_FILES['txtuplodepdf']['name'];
			$uniq = uniqid("");
			$txtuplodepdf=$uniq.$txtuplodepdf;
			$PATH="../../upload/whatsnew/";
			$PATH=$PATH."/";
			$val=move_uploaded_file($_FILES["txtuplodepdf"]["tmp_name"],$PATH.$txtuplodepdf);
			$size=filesize($PATH.$txtuplodepdf);
			$size=ceil($size/1024);
			$found="false";
			$txtuplodepdf=addslashes($txtuplodepdf);
			$whereclause="m_id=$cid";
			$tableName_send="whatsnew";
			$old =array("docs_file");
			$new =array("$txtuplodepdf");
			$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);
			}
			else
				{
				$whereclause="m_id='$cid'";
				$sql=mysqli_query($conn,"Select * from whatsnew where $whereclause");
				$res=mysqli_fetch_array($sql);
				$txtuplode=$res['docs_file'];
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
$tableName_send="whatsnew";
$old=array("language_id","m_name","m_short","m_title","m_content","page_url","start_date","end_date","approve_status","admin_id","create_date","ext_url","content_type","m_keyword","m_description","update_date");
$new=array("$txtlanguage","$txtename","$sortcontentdesc","$m_title1","$txtcontentdesc","$url","$startdate","$expairydate","$txtstatus","$user_id","$create_date","$txtweblink","$texttype","$txtekeyword","$txtmeta_description","$update_date");

	$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);

//if($txtstatus=='3'){
	$tableName_send="whatsnew_publish";
	$whereclause="where m_publish_id='$cid'";
$sql=mysqli_query($conn,"Select * from whatsnew_publish $whereclause");
$row=mysqli_num_rows($sql);

	if($row >0)
	{
		
  $update="UPDATE whatsnew_publish,whatsnew SET  whatsnew_publish.m_publish_id = whatsnew.m_id,whatsnew_publish.language_id = whatsnew.language_id,whatsnew_publish.m_name = whatsnew.m_name,whatsnew_publish.m_short = whatsnew.m_short,whatsnew_publish.m_title = whatsnew.m_title,whatsnew_publish.m_content = whatsnew.m_content,whatsnew_publish.page_url = whatsnew.page_url,whatsnew_publish.start_date = whatsnew.start_date,whatsnew_publish.end_date = whatsnew.end_date,whatsnew_publish.approve_status = whatsnew.approve_status,whatsnew_publish.admin_id = whatsnew.admin_id,whatsnew_publish.c_new_status = whatsnew.c_new_status,whatsnew_publish.create_date = whatsnew.create_date,whatsnew_publish.ext_url = whatsnew.ext_url,whatsnew_publish.content_type = whatsnew.content_type,whatsnew_publish.m_keyword = whatsnew.m_keyword,whatsnew_publish.m_description = whatsnew.m_description,whatsnew_publish.update_date = whatsnew.update_date,whatsnew_publish.docs_file = whatsnew.docs_file WHERE whatsnew_publish.m_publish_id =whatsnew.m_id and whatsnew.m_id=$cid";
	
 mysqli_query($conn,$update);
	}
	else {
	
$sql="INSERT INTO whatsnew_publish (m_publish_id,language_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,approve_status,admin_id,c_new_status,create_date,docs_file,ext_url,content_type,m_keyword,m_description,update_date)
	 SELECT m_id, language_id,m_name,m_short,m_title,m_content,page_url,start_date,end_date,approve_status,admin_id,c_new_status,create_date,docs_file,ext_url,content_type,m_keyword,m_description,update_date
   FROM whatsnew WHERE m_id='$cid'";

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
header("location:manage_whatsnew.php");
exit;
}
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>What's New : <?php echo $sitename;?></title>
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
			<span class="submenuclass"><a href="manage_whatsnew.php" title="What's New">What's New</a></span>
			 <span class="submenuclass">>> </span>
			<span class="submenuclass">Add/Update What's New</span>	</div>
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
		$rq = mysqli_query($conn,"select * from whatsnew where 	m_id='".$_GET['editid']."'");
		//echo "select * from category where c_id='".$_GET['id']."'";
		$rr = mysqli_fetch_array($rq);
				//print_r($rr);
		}


?>

<div class="frm_row"> <span class="label1">
              <label for="txtlanguage">Page Language :</label>
              <span class="star">*</span></span> <span class="input1">
              <input type="radio" name="txtlanguage" autocomplete="off" value="1" <?php if($rr['language_id']=='1'){ echo 'checked'; } else echo 'checked'; ?> id="txtlanguage" />English &nbsp;
              <input type="radio" name="txtlanguage" autocomplete="off" value="2" <?php if($rr['language_id']=='2'){ echo 'checked'; } ?>/>Hindi
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

         <!--  <div class="frm_row"> <span class="label1">
              <label for="newicons">Display New Icons :</label>
              <span class="star">*</span></span> <span class="input1">
              <input type="radio" name="newicons" id="newicons" autocomplete="off"  value="1" <?php if($rr['c_new_status']=='1'){ echo 'checked';} else ?> checked="checked" />Yes &nbsp;<input type="radio" name="newicons" autocomplete="off" value="2" <?php if($rr['c_new_status']=='2'){ echo 'checked'; } ?>/>No
               </span>
              <div class="clear"></div>
			  <div class="loading"></div>
            </div> -->


 <div class="frm_row"> <span class="label1">
<label for="texttype">Content Type :</label>
<span class="star">*</span></span> <span class="input1">
<select name="texttype" id="texttype" autocomplete="off"  onChange="addmenutype(this.value)" >
<option value="">Select</option>
<?php
foreach($menutype as $key=>$value)
{
	?>
<option value="<?php echo content_desc($key); ?>" <?php if($key==$rr['content_type']){ echo 'selected="selected"'; } else { }?>><?php echo $value; ?></option>
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

                                                    </span>
                                                    <div class="clear"></div>
          </div>

        <div class="frm_row"> <span class="label1">
                <label for="expairydate">Expiry Date:</label><span class="star">*</span>
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
		<input type="button" class="button" value="Back" onClick="javascript:location.href ='manage_whatsnew.php';" />
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
