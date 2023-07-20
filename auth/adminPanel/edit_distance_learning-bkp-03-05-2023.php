<?php ob_start();
session_start();
include("../../includes/config.inc.php");
include("../../includes/useAVclass.php");
include("../../includes/functions.inc.php");
include("../../includes/def_constant.inc.php");
include_once 'ckeditor/ckeditor.php';
include_once 'ckfinder/ckfinder.php';
require_once("../../includes/ps_pagination.php");

@extract($_GET);
@extract($_POST);
@extract($_SESSION);
$useAVclass = new useAVclass();
$useAVclass->connection();
$role_id=$_SESSION['dbrole_id'];
$user_id=$_SESSION['admin_auto_id_sess'];
$model_id= "13";
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
if($role_id >0 && $role_map['medit']=='')
{
$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:error.php");
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
if($_SESSION['lname']=='English')
{
 $lan='1';
}
else if($_SESSION['lname']=='Hindi')
{
$lan='2';
}
$cid= check_input($_POST['cid']);
$sid= check_input($_POST['sid']);
$newid=md5($cid.$sid);
if($cmdsubmit=='Update') 
{
$txtename = content_desc(check_input($_POST['txtename']));
$page_url = content_desc(check_input($_POST['page_url']));
$distance_learningcategory= content_desc(check_input($_POST['distance_learningcategory']));
$txtekeyword= content_desc(check_input($_POST['txtekeyword']));
$txtmeta_description= content_desc(check_input($_POST['txtmeta_description']));
$txtcontentdesc= content_desc(check_input(($_POST['txtcontentdesc'])));	
$link=content_desc(check_input($_POST['txtweblink']));
$txtpostion= content_desc(check_input($_POST['txtpostion']));
$txtlanguage= content_desc(check_input($_POST['txtlanguage']));
$txtstatus=content_desc(check_input($_POST['txtstatus']));
$txtuplode= content_desc(check_input($_POST['txtuplode']));
	$createdate=date('Y-m-d');
	$cid= check_input($_POST['cid']);
	$update_date=date('Y-m-d h:i:s');
	$flag_id=0;

if(trim($txtlanguage)=="")
		{
		}
		     // Initializing the message to hold the error messages
if($txtlanguage=='2')
		{
		
			if(trim($texttype)=="")
			{
			$errmsg.="Please Select distance_learning Content Type."."<br>";
			
			}
			
		if(trim($txtlanguage)!="")
		{
			// if(trim($distance_learningcategory)=="")
			// {
			// $errmsg.="Please Select Primary Link."."<br>";
			
			// }		
		}
		
		if(trim($texttype)!="")
		{
		if($texttype=='1')
		{	
			if(trim($page_url)=="")
			{
			$errmsg.= "Meta Title must be Alphanumeric "."<br>";
			}
			if(trim($txtcontentdesc)=="")
			{
			$errmsg.="Please enter Content Description."."<br>";
			}
		}
		if($texttype=='3')
		{	if(trim($txtweblink)=="")
			{
			$errmsg.="Please enter web link ."."<br>";
			
			}
			if(trim($link) !="")
			{
				if (!validateURL($link))
				{
				$errmsg.="URL address not valid.<br>";
				}
			}
		}
		
		}
		
		if(trim($txtstatus)=="")
		{
		$errmsg.="Please Select Page Status."."<br>";
		}
		}
	else
		{
		if(trim($txtename)=="")
		{
		$errmsg = "distance_learning Title must be Alphanumeric and Special ."."<br>";
		}
		if(trim($txtename)!="")
		{		
		/* if (preg_match('/[^a-zA-Z0-9\s\w-&]/i',$txtename))
			{
				$errmsg .= "distance_learning Title must be Alphanumeric and Special Characters( _.,:()&amp ) that should be minimum 2 and maximum 100."."<br>";
			}
			*/
		}
		// if(trim($distance_learningcategory)=="")
		// {
		// $errmsg .="Please Select Primary Link.<br>";
		
		// }
		if(trim($texttype)!="")
		{
		if($texttype=='1')
		{
		if(trim($page_url)=="")
		{
		$errmsg .= "Page  Url must be Alphanumeric "."<br>";
		}
			if(trim($page_url)!="")
					{			
						/*if (preg_match('/[^a-zA-Z0-9\s\w-&]/i',$page_url))
						{
						$errmsg .= "Meta Title must be Alphanumeric that should be minimum 2 and maximum 100."."<br>";
						}*/

					}
				if(trim($txtekeyword)!="")
					{			
						/*if (preg_match('/[^a-zA-Z0-9\s\w-&]/i',$txtekeyword))
						{
						$errmsg .= "Meta Keyword must be Alphanumeric  that should be minimum 2 and maximum 100."."<br>";
						}*/
					}
					if(trim($txtmeta_description)!="")
					{			
						/*if (preg_match('/[^a-zA-Z0-9\s\w-&]/i',$txtmeta_description))
						{
						$errmsg .= "Meta Description Title must be Alphabet that should be minimum 2 and maximum 100."."<br>";
						}*/
					}
		if(trim($txtcontentdesc)=="")
		{
		$errmsg.="Please enter Content Description.<br>";
		}
		
		}
		if($texttype=='3')
			{
			if(trim($txtweblink)=="")
			{
			$errmsg.="Please enter web link .<br>";
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
	
		if ($_FILES["txtuplode"]["tmp_name"]!="")
		{
		$tempfile=($_FILES["txtuplode"]["tmp_name"]);
		$imageinfo = ($_FILES["txtuplode"]["type"]);
		$head = fgets(fopen($tempfile, "r"),5);
		$section = strtoupper(base64_encode(file_get_contents($tempfile)));
		$nsection=substr($section,0,8);
		
		
		if($imageinfo != "application/pdf" )
		{
		$errmsg.= 'Sorry, we accept PDF files only';
		}
		
		else if($head != "%PDF") 
		{
		$errmsg.= 'Sorry,we accept PDF files only';
		}
		
		
		elseif($nsection!="JVBERI0X")
		{
		$errmsg.= 'Sorry,we accept PDF files only';
		}
		}
		
		
		if(trim($txtstatus)=="")
		{
		$errmsg.="Please Select Page Status.<br>";
		}
		}
if($errmsg=="")
{
	$tableName_send="distance_learning";
	$whereclause="m_id='$cid'";
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
		$check_status;
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

if ($_FILES["txtuplode"]["name"]!="")
			{
				
			$sql = "select doc_uplode FROM distance_learning WHERE m_id=$cid";
			$rs = mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($rs);
			$image_path = "../../upload/".$row['doc_uplode'];
			unlink($image_path);
   			$txtuplode=$_FILES['txtuplode']['name'];
			$uniq = uniqid("");
			$txtuplode=$uniq.$txtuplode;		
			$PATH="../../upload/distance_learning";					
			$PATH=$PATH."/"; 
			$val=move_uploaded_file($_FILES["txtuplode"]["tmp_name"],$PATH.$txtuplode);
			$size=filesize($PATH.$txtuplode);
			$size=ceil($size/1024);
			$found="false";
			$txtuplode=addslashes($txtuplode); 
			//echo $txtuplode; 
			$old =array("doc_uplode");
			$new =array("$txtuplode");
			$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);
			}	else
				{
				$whereclause="m_id='$cid'";
				$sql=mysqli_query($conn,"Select * from distance_learning where $whereclause");
				$res=mysqli_fetch_array($sql);
				$txtuplode=$res['doc_uplode'];
				}
	if($txtlanguage=='2')
		{		
		$url=seo_url($page_url.'-hi'); }
		else { $url=seo_url($page_url);	}
	$old =array("m_flag_id","m_type","language_id","m_name","m_url","m_title","m_keyword","m_description","content","doc_uplode","linkstatus","update_date","approve_status","admin_id");
	$new =array("$distance_learningcategory","$texttype","$txtlanguage","$txtename","$url","$page_url","$txtekeyword","$txtmeta_description","$txtcontentdesc","$txtuplode","$link","$update_date","$txtstatus","$user_id");
	
	$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);
	$page_id=$cid;

if($txtstatus=='3')
{

	$tableName_send="distance_learning_publish";
	$whereclause="where m_publish_id='$cid'";
$sql=mysqli_query($conn,"Select * from distance_learning_publish $whereclause");
$row=mysqli_num_rows($sql); 
	
	if($row >0)
	{
	$whereclause="m_publish_id='$cid'";
	$old =array("m_type","m_flag_id","language_id","m_name","m_url","m_title","m_keyword","m_description","content","doc_uplode","linkstatus","update_date","approve_status","admin_id");
	$new =array("$texttype","$distance_learningcategory","$txtlanguage","$txtename","$url","$page_url","$txtekeyword","$txtmeta_description","$txtcontentdesc","$txtuplode","$link","$update_date","$txtstatus","$user_id");
$useAVclass->UpdateQuery($tableName_send,$whereclause,$old,$new);
		
$user_id=$_SESSION['admin_auto_id_sess'];
$page_id=$cid;
$action="Update";
$categoryid='1';
$date=date("Y-m-d h:i:s");
$ip=$_SERVER['REMOTE_ADDR'];

$tableName="audit_trail";
$tableFieldsName_send=array("user_login_id","page_id","page_name","page_action","page_category","page_action_date","ip_address","lang","page_title","approve_status");
$tableFieldsValues_send=array("$user_id","$page_id","$txtename","$action","$model_id","$date","$ip","$txtlanguage","$txtepage_title","$txtstatus");
$value=$useAVclass->insertQuery($tableName,$tableFieldsName_send,$tableFieldsValues_send);
	}
	else
	{
	$tableFieldsName_send=array("m_type","m_publish_id","m_flag_id","language_id","m_name","m_url","m_title","m_keyword","m_description","content","doc_uplode","linkstatus","update_date","approve_status","admin_id");
	$tableFieldsValues_send=array("$texttype","$page_id","$distance_learningcategory","$txtlanguage","$txtename","$url","$page_url","$txtekeyword","$txtmeta_description","$txtcontentdesc","$txtuplode","$link","$update_date","$txtstatus","$user_id");
	$useAVclass->insertQuery($tableName_send,$tableFieldsName_send,$tableFieldsValues_send);
	  }
}
		$msg=CONTENTUPDATE;
$_SESSION['content']=$msg;
$_SESSION['token'] = "";
$_SESSION['uniq'] = "";
header("location:manage_distance_learning.php?txtstatus=" .$txtstatus);
}

}
$editid = base64_decode($_GET['editid']);

 $edit_contrator ="select * from distance_learning where m_id='$editid'";
$contrator_result = mysqli_query($conn,$edit_contrator);
$res_rows=mysqli_num_rows($contrator_result);

$fetch_result=mysqli_fetch_array($contrator_result);
@extract($fetch_result);
$module=$module_id;
$editors=$content; 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Edit Distance Learning: <?php echo $sitename;?></title>
<link rel="SHORTCUT ICON" href="images/favicon.ico" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link href="style/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script language="JavaScript" src="js/validation.js"></script>

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="style/ie7.css">
<![endif]-->
<script type="text/javascript">
function getPage(id) {

    //generate the parameter for the php script
    var data = 'language=' + id;
    $.ajax({
        url: "primarylink-distance_learning.php",  
        type: "POST", 
        data: data,     
        cache: false,
        success: function (html) {  
         
            //hide the progress bar
            $('#loading').hide();   
             
            //add the content retrieved from ajax and put it in the #content div
            $('#content1').html(html);
             
            //display the body with fadeIn transition
            $('#content1').fadeIn('slow');       
        }       
    });
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
  <?php
		include_once('main_menu.php');
	 ?>
  <!-- Header end -->
  
  <div class="main_con">
   <div class="admin-breadcrum">
<div class="breadcrum">
  <span class="submenuclass"><a href="welcome.php">Dashboard</a></span>

  
			
			 <span class="submenuclass">>> </span> 
			<span class="submenuclass"><a href="manage_distance_learning.php?module_id=1">Manage Distance Learning</a></span>
			 <span class="submenuclass">>> </span> 
			<span class="submenuclass">Edit Distance Learning</span>
			</span>
</div>
<div class="clear"> </div>
</div>       

<div class="right_col1">
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
 <h3 class="manageuser">Edit Distance Learning</h3>
<!-- <div class="right-section">
  <ul>
<?php if($role_map['draft']=='DR' || $user_id=='101'){?>
 <li  class="new-icon"><a href="add_distance_learning.php?module_id=<?php echo $model_id;?>" title="New"><span class="icon-28-new"></span>New</a>            </li><?php }?>
              
            </ul>
			
 
 </div>-->
 
 </div>	
         <div class="grid_view">
<form action="" method="post" name="form1"  autocomplete="off" enctype="multipart/form-data" onsubmit="return edit_content('form1')">
<div class="frm_row"> <span class="label1">
              <label for="txtename">Title:</label>
              </span> <span class="input1">
              <input name="txtename" autocomplete="off" type="text" class="input_class" id="txtename" size="30" value="<?php echo stripslashes($m_name);?>"/>
                                       </span>
              <div class="clear"></div>
            </div>
			
		<div class="frm_row"> <span class="label1">
              <label for="txtlanguage">Page Language :</label>
              <span class="star">*</span></span> <span class="input1">
            <input type="radio" name="txtlanguage" autocomplete="off"  value="1"<?php if($language_id=='1') echo 'checked=checked'?> onclick="getPage(this.value);"/>English &nbsp;<input type="radio" name="txtlanguage" autocomplete="off" value="2"<?php if($language_id=='2') echo 'checked=checked'?> onclick="getPage(this.value);"/>Hindi
			
               </span>
              <div class="clear"></div>
			  <div class="loading"></div>
            </div>
			
<div id="content1">
<div class="frm_row"> <span class="label1">
                    <label for="distance_learningcategory">Primary Link:</label>
                    <span class="star">*</span></span> <span class="input1">
                    
            <?php
// $nav_query = mysqli_query($conn,"select * from distance_learning where approve_status='3' and m_flag_id='0' and language_id='$language_id'");
// $tree = "";                         // Clear the directory tree
// $depth = 1;                         // Child level depth.
// $top_level_on = 1;               // What top-level category are we on?
// $exclude = array();               // Define the exclusion array
// array_push($exclude, 0);     // Put a starting value in it

// if($m_flag_id==0){ $val="selected"; } else {$val='';}
//  $tree = '<option value ="0"'.$val.'>It is Root Category</option>'; 
// while ($nav_row = mysqli_fetch_array($nav_query) )
// {
//      $goOn = 1;               // Resets variable to allow us to continue building out the tree.
//      for($x = 0; $x < count($exclude); $x++ )          // Check to see if the new item has been used
//      {
//           if ( $exclude[$x] == $nav_row['m_id'] )
//           {
//                $goOn = 0;
//                break;                    // Stop looking b/c we already found that it's in the exclusion list and we can't continue to process this node
//           }
//      }
//      if ( $goOn == 1 )
//      {
	 
// 	if($m_flag_id==$nav_row['m_id']){ $root="selected"; }
// 	else {$root='';}
// 	      $tree .= '<strong><option value="'.$nav_row['m_id'].'"'.$root.'>'.$nav_row['m_name'].'</option></strong>';                    // Process the main tree node
//           array_push($exclude, $nav_row['m_id']);          // Add to the exclusion list
//           if ( $nav_row['m_id'] < 6 )
//           { $top_level_on = $nav_row['m_id']; }
 
//           $tree .= build_child($nav_row['m_id']);          // Start the recursive function of building the child tree
//      }
// }
 
function build_child($oldID)               // Recursive function to get all of the children...unlimited depth
{
     GLOBAL $exclude, $depth,$m_flag_id;               // Refer to the global array defined at the top of this script
     $child_query = mysqli_query($conn,"select * from distance_learning where approve_status='3' and m_flag_id='$oldID'");
     while ( $child = mysqli_fetch_array($child_query) )
     {
          if ( $child['m_id'] != $child['m_flag_id'] )
          {
		  
               for ( $c=0;$c<$depth;$c++ )               // Indent over so that there is distinction between levels
               { $temp.= "&nbsp;&nbsp;&nbsp;"; }
           		  if($m_flag_id==$child['m_id']){ $subroot="selected"; }
	else {$subroot='';}
			  $tempTree.='<option value="'.$child['m_id'].'"'.$subroot.'>'.$temp.'--'.$child['m_name'].'</option>';
			  // <option value="'.$nav_row['division_id'].'">'.$nav_row['distance_learning_name'].'</option>
               $depth++;          // Incriment depth b/c we're building this child's child tree  (complicated yet???)
               $tempTree .= build_child($child['m_id']);          // Add to the temporary local tree
               $depth--;  
			   $temp='';        // Decrement depth b/c we're done building the child's child tree.
               array_push($exclude, $child['m_id']);               // Add the item to the exclusion list
          }
     }
 
     return $tempTree;          // Return the entire child tree
}

echo '<select id="distance_learningcategory" name="distance_learningcategory">'.$tree.'</select>';


?>

                    </span>
                    <div class="clear"></div>
                    </div>
</div>
			
  

<div class="frm_row"> <span class="label1">
<label for="texttype">distance_learning Type :</label>
<span class="star">*</span></span> <span class="input1">
<select name="texttype" id="texttype" autocomplete="off">
<option value="">Select</option>
<?php 
foreach($menutype as $key=>$value)
{
if ($m_type==$key)
{
	
	?>

<option value="<?php echo content_desc($key); ?>"<?php if ($m_type==$key) echo 'selected="selected"';?>><?php echo $value; ?></option><?php } }
 ?>
</select></span>
<div class="clear"></div>
</div>

<div id="txtDoc" <?php if($m_type=='1') {?> style="display:block" <?php } else {?>style="display:none" <?php } ?>>

<div class="frm_row"> <span class="label1">
				<label for="page_url">Meta Title:</label> <span class="star">*</span>
				</span> <span class="input1">
				<input name="page_url" autocomplete="off" type="text" class="input_class" id="page_url" size="30"   value="<?php echo stripslashes($m_title);?>"/>
				
				</span>
				<div class="clear"></div>
				</div>

   <div class="frm_row"> <span class="label1">
              <label for="txtekeyword">Meta Keyword:</label>
              
			  </span> <span class="input1">
              <textarea rows="2" cols="35" name="txtekeyword" autocomplete="off" id="txtekeyword"><?php echo stripslashes($m_keyword);?></textarea>
                                       </span>
              <div class="clear"></div>
            </div>
            <div class="frm_row"> <span class="label1">
              <label for="txtmeta_description">Meta Description:</label>
              </span> <span class="input1">
              <textarea rows="2" cols="35" name="txtmeta_description" autocomplete="off" id="txtmeta_description"><?php echo stripslashes($m_description);?>
</textarea>
                                       </span>
              <div class="clear"></div>
            </div>
        <div class="frm_row"> <span class="label1">
        <label for="txtcontentdesc">Description :</label>
        <span class="star">*</span></span> <span class="input_fck">
<?php
		
		$ckeditor = new CKEditor();
		$ckeditor->basePath = '/ckeditor/';
		$ckeditor->config['filebrowserBrowseUrl'] = ''.$folder.'/auth/adminPanel/ckfinder/ckfinder.html';
		$ckeditor->config['filebrowserImageBrowseUrl'] = ''.$folder.'/auth/adminPanel/ckfinder/ckfinder.html?type=Images';
		$ckeditor->config['filebrowserUploadUrl'] = ''.$folder.'/auth/adminPanel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		$ckeditor->config['filebrowserImageUploadUrl'] = ''.$folder.'/auth/adminPanel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
		$ckeditor->editor('txtcontentdesc',stripslashes(html_entity_decode($editors)));
		?>        </span>
        <div class="clear"></div>
        </div>
</div>
<div id="txtPDF"  <?php if($m_type=='2') {?> style="display:block" <?php } else {?>style="display:none" <?php } ?>>
            <div class="frm_row"> <span class="label1">
            <label for="txtuplode">Document Upload :</label>
            <span class="star">*</span></span> <span class="input1">
           <input type="file" name="txtuplode" id="txtuplode"/>
            </span>
            <div class="clear"></div>
            </div>
</div>

<div id="txtweb"  <?php if($m_type=='3') {?> style="display:block" <?php } else {?>style="display:none" <?php } ?>>
   <div class="frm_row"> <span class="label1">
            <label for="txtweblink">Web Site Link :</label>
            <span class="star">*</span></span> <span class="input1">
          <input type="text" name="txtweblink" id="txtweblink" size="30" value="<?php echo stripslashes($linkstatus);?>" class="textbox">
		  <span class="date"><strong>Example : https://www.xyz.com</strong></span>
            </span>
            <div class="clear"></div>
            </div>
</div>


        
             <div class="frm_row"> <span class="label1">
              <label for="txtstatus">Page Status:</label>
              <span class="star">*</span></span> <span class="input1">
              <select name="txtstatus" id="txtstatus" autocomplete="off" onchange="divcomment(this.value)">
	<option value=""> Select </option>
	 <?php if($user_id =='101')
	{
	$sql=mysqli_query($conn,"select * from content_state where state_status='1'");

		while($row=mysqli_fetch_array($sql))
		{  
		?>
		<option value="<?php echo content_desc($row['state_id']);?>" <?php if ($approve_status==$row['state_id']) echo 'selected="selected"';?>><?php echo $row['state_name']; ?></option>
		<?php }
	}
	else if($user_id !='101' )
	     {
		 $sql=mysqli_query($conn,"select * from content_state");

		 while($row=mysqli_fetch_array($sql))
		{  
			if($row['state_short']==$role_map['draft']){
			?>
			<option value="<?php echo content_desc($row['state_id']);?>"<?php if ($approve_status==$row['state_id']) echo 'selected="selected"';?>><?php echo $row['state_name']; ?></option>
			<?php }
			if($row['state_short']==$role_map['mapprove']){
			?>
			<option value="<?php echo content_desc($row['state_id']);?>" <?php if ($approve_status==$row['state_id']) echo 'selected="selected"';?>><?php echo $row['state_name']; ?></option>
			<?php }
			if($row['state_short']==$role_map['publish']){
			?>
			<option value="<?php echo content_desc($row['state_id']);?>"<?php if ($approve_status==$row['state_id']) echo 'selected="selected"';?>><?php echo $row['state_name']; ?></option>
			<?php }
			if($row['state_short']==$role_map['review']){
			?>
			<option value="<?php echo content_desc($row['state_id']);?>" <?php if ($approve_status==$row['state_id']) echo 'selected="selected"';?>><?php echo $row['state_name']; ?></option>
			<?php }
			
			
		
		}
		 }
 ?>
	</select>
                                       </span>
              <div class="clear"></div>
            </div>

<div class="frm_row"> 
<span class="button_row">   
<input name="cmdsubmit" type="submit" class="button" id="cmdsubmit" value="Update" /><input name="cid" type="hidden" value="<?php echo $m_id;?>" /><input type="hidden" name="random" value="<?php echo $_SESSION['logtoken'];?>">&nbsp;<input name="cmdreset" type="reset" class="button" id="cmdreset" value="Reset" />&nbsp;
<input type="button" class="button" value="Back" onClick="javascript:location.href = 'manage_distance_learning.php'" />
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
<script type="text/javascript">
$(".closestatus").click(function() {
$("#msgerror").addClass("hide").hide();
});
</script>
	
<style>
.hide {display:none;}
</style>

