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
$model_id= "12";
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
if($role_id >0 && $role_map['draft']=='')
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
if(isset($_POST['cmdsubmit']))
{
$txtename = content_desc(check_input($_POST['txtename']));
$page_url = content_desc(check_input($_POST['page_url']));
$studentcategory= content_desc(check_input($_POST['studentcategory']));
$txtekeyword= content_desc(check_input($_POST['txtekeyword']));
$txtmeta_description= content_desc(check_input($_POST['txtmeta_description']));
$txtcontentdesc= content_desc(check_input(($_POST['txtcontentdesc'])));	
$link=content_desc(check_input($_POST['txtweblink']));
$txtlanguage= content_desc(check_input($_POST['txtlanguage']));
$txtstatus=content_desc(check_input($_POST['txtstatus']));
$txtuplode= content_desc(check_input($_POST['txtuplode']));
$texttype = content_desc(check_input($_POST['texttype']));

$createdate=date('Y-m-d');
$errmsg="";  
if(trim($txtlanguage)=="")
		{
		}
		
if($txtlanguage=='2')
{
	
	if(trim($txtename)=="")
		{
		$errmsg .= "Please Enter student Title "."<br>";
		}
		
		// if(trim($texttype)=="")
		// {
		// 	$errmsg .="Please Select student Type."."<br>";
			
		// }
		if(trim($txtlanguage)!="")
		{
			if(trim($studentcategory)=="")
			{
			$errmsg .="Please Select Primary Link."."<br>";
			
			}
		
		}
		
		if(trim($texttype)!="")
		{
			if($texttype=='1')
			  {
				if(trim($page_url)=="")
				{
				$errmsg .= "Meta Title must be Alphanumeric "."<br>";
				}
				/*if(trim($page_url)!="")
					{			
						if (preg_match("/^[a-zA-Z0-9'-_() &amp;\"]{2,100}$/i", $page_url) === 0)
						{
						$errmsg .= "student Title must be Alphanumeric and Special Characters( _.,:()&amp ) that should be minimum 2 and maximum 100."."<br>";
						}
					}*/
			  	if(trim($txtcontentdesc)=="")
				{
				$errmsg .="Please enter Content Description."."<br>";
				
				}
			}
			
			if($texttype=='2')
			  {
				
				if($_FILES["txtuplode"]["name"]=="")
				{
				$errmsg .="Please enter Document upload."."<br>";
				}
				
			}
			 if($texttype=='3')
			  {	if(trim($txtweblink)=="")
				{
				$errmsg .="Please enter web link ."."<br>";
				
				}
				if(trim($link)!="")
				{
					if (!validateURL($link))
					 {
					$errmsg .="URL address not valid.<br>";
						}
				}

			}
			
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
		$errmsg .= "student title should be alphanumeric "."<br>";
		}
		if(trim($txtename)!="")
		{			
			/* if (preg_match('/[^a-zA-Z0-9\s\w-&]/i',$txtename))
			{
				$errmsg .= "student Title must be Alphanumeric and Special Characters( _.,:()&amp ) that should be minimum 2 and maximum 100."."<br>";
			}*/
		}
		if(trim($txtlanguage)=="")
		{
			$errmsg .="Please Select Language"."<br>";
		}
		// if(trim($texttype)=="")
		// {
		// $errmsg .="Please Select student Type"."<br>";
		// }
		if(trim($texttype)!="")
		{

			if($texttype=='1')
			  {	

				if(trim($page_url)=="")
				{
				$errmsg .= "Meta Title must be Alphanumeric "."<br>";
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
				$errmsg .="Please enter  Description."."<br>";
				
				}
			}
			 if($texttype=='2')
			  {	
				if($_FILES["txtuplode"]["name"]=="")
				{
				$errmsg .="Please enter Document upload."."<br>";
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
		
				if ($_FILES["txtuplode"]["tmp_name"]!="")
					{
						$tempfile=($_FILES["txtuplode"]["tmp_name"]);
						$imageinfo = ($_FILES["txtuplode"]["type"]);
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
		if ($_FILES["txtuplode"]["name"]!="")
		{
				$txtuplode=$_FILES['txtuplode']['name'];
				$txtuplode = preg_replace("/[^a-zA-Z0-9.]/", "", $txtuplode);
				$uniq = uniqid("");
				$txtuplode=$uniq.$txtuplode;		
				$PATH="../../upload/student";					
				$PATH=$PATH."/"; 
				$val=move_uploaded_file($_FILES["txtuplode"]["tmp_name"],$PATH.$txtuplode);
				$size=filesize($PATH.$txtuplode);
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
	if($txtlanguage=='2')
		{		
		$url=seo_url($page_url.'-hi'); }
		else { $url=seo_url($page_url);
		}
		
$tableName_send="student";
$tableFieldsName_old=array("m_flag_id","m_type","language_id","m_name","m_url","m_title","m_keyword","m_description","content","doc_uplode","linkstatus","create_date","approve_status","admin_id");
$tableFieldsValues_send=array("$studentcategory","$texttype","$txtlanguage","$txtename","$url","$page_url","$txtekeyword","$txtmeta_description","$txtcontentdesc","$txtuplode","$link","$createdate","$txtstatus","$user_id");
$value=$useAVclass->insertQuery($tableName_send,$tableFieldsName_old,$tableFieldsValues_send);

$page_id=$value;
if($txtstatus=='3')
{

	$tableName_send="student_publish";
$tableFieldsName_old=array("m_type","m_publish_id","m_flag_id","language_id","m_name","m_url","m_title","m_keyword","m_description","content","doc_uplode","linkstatus","create_date","approve_status","admin_id");
$tableFieldsValues_send=array("$texttype","$page_id","$studentcategory","$txtlanguage","$txtename","$url","$page_url","$txtekeyword","$txtmeta_description","$txtcontentdesc","$txtuplode","$link","$createdate","$txtstatus","$user_id");
	$useAVclass->insertQuery($tableName_send,$tableFieldsName_old,$tableFieldsValues_send);
		
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
header("location:manage_student.php");
exit;	
}	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Student Corner: <?php echo $sitename;?></title>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link href="style/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script language="JavaScript" src="js/validation.js"></script>



<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="style/ie7.css">
<![endif]-->


<script language="javascript" type="text/javascript">
	function addstudenttype(id) {
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
<script type="text/javascript">
function getPage(id) {
    //generate the parameter for the php script
	//alert(id);
    var data = 'language=' + id;

    $.ajax({
        url: "primarylink-student.php",  
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

<script type="text/javascript">
function editlist(id) {
    //generate the parameter for the php script
    var data = 'id=' + id;
	//alert(id);
    $.ajax({
        url: "editid.php",  
        type: "POST", 
        data: data,     
        cache: false,
        success: function (html) {  
         
            //hide the progress bar
            $('#loading').hide();   
             $('#loading').hide();   
             
            //add the content retrieved from ajax and put it in the #content div
            $('#content1').html(html);
             
            //display the body with fadeIn transition
           
            //add the content retrieved from ajax and put it in the #content div
              
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
<script>
	$().ready(function() {
		// validate signup form on keyup and submit
		$("#demo-content").validate({
			rules: {
				txtename: "required"
			},
			messages: {
				txtename: "Please enter your firstname"
			}
		});
	});
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
			<span class="submenuclass"><a href="manage_student.php?module_id=1"><?php echo "Manage Student Corner";?></a></span>
			 <span class="submenuclass">>> </span> 
			<span class="submenuclass">Add Student Corner</span>
			
			 
			</span>

			
		
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
	<div class="internalpage_heading">
 <h3 class="manageuser">Add Student Corner</h3>
 
 </div>
</div>		
         <div class="grid_view">
<form action="" method="post" name="form1"  autocomplete="off" enctype="multipart/form-data"  onsubmit="return add_content('form1')">

			
			<div class="frm_row"> <span class="label1">
				<label for="txtename">Title:</label> <span class="star">*</span>
				</span> <span class="input1">
				<input name="txtename" autocomplete="off" type="text" class="input_class" id="txtename" size="30"   value="<?php if($txtename!=""){ echo content_desc($txtename);} ?>"/>
				
				</span>
				<div class="clear"></div>
				</div>
		
				
				<div class="frm_row"> 
				<span class="label1">
              <label for="txtlanguage">Page Language :</label>
              <span class="star">*</span></span> 
			    <span class="input1">
				<input type="radio" name="txtlanguage" autocomplete="off" onclick="getPage(this.value);" id="txtlanguage" value="1"<?php if($txtlanguage=='1'){ echo "checked"; }?> >English &nbsp;
				 <input type="radio" name="txtlanguage" autocomplete="off" id="txtlanguage"  onclick="getPage(this.value);" value="2"<?php if($txtlanguage=='2'){ echo "checked"; }?>/>Hindi

			               </span>
              <div class="clear"></div>
			  <div class="loading"></div>
            </div>
<div id="content1">

</div>

<div class="frm_row"> <span class="label1">
<label for="texttype">student Type :</label>
<span class="star">*</span></span> <span class="input1">
<select name="texttype" id="texttype" autocomplete="off"  onChange="addstudenttype(this.value)" >
<option value="">Select</option>
<?php 
foreach($menutype as $key=>$value)
{
	?>
<option value="<?php echo content_desc($key); ?>" <?php if($key==$texttype){ echo 'selected="selected"'; } else { }?>><?php echo $value; ?></option>
<?php }
 ?>
</select></span>
<div class="clear"></div>
</div>
<div id="txtDoc" <?php if($texttype=='1') {?> style="display:block" <?php } else {?>style="display:none" <?php } ?>>
		<div class="frm_row"> <span class="label1">
				<label for="page_url">Meta Title / Page URL:</label> <span class="star">*</span>
				</span> <span class="input1">
				<input name="page_url" autocomplete="off" type="text" class="input_class" id="page_url" size="30"   value="<?php if($page_url!=""){ echo content_desc($page_url);} ?>"/>
				
				</span>
				<div class="clear"></div>
				</div><span class="date">[Meta Title should be only in English]</span>
 <div class="frm_row"> <span class="label1">
              <label for="txtekeyword">Meta Keyword:</label>
              </span> <span class="input1">
              <textarea rows="2" cols="35" name="txtekeyword" autocomplete="off" id="txtekeyword"><?php if($txtekeyword!=""){ echo content_desc($txtekeyword);} ?></textarea>
              </span>
              <div class="clear"></div>
            </div>
            <div class="frm_row"> <span class="label1">
              <label for="txtmeta_description">Meta Description:</label>
              </span> <span class="input1">
              <textarea rows="2" cols="35" name="txtmeta_description" autocomplete="off"  id="txtmeta_description" ><?php if($txtmeta_description!=""){ echo content_desc($txtmeta_description);} ?>
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
		$ckeditor->editor('txtcontentdesc',stripslashes(html_entity_decode(content_desc($txtcontentdesc))));
		?>        </span>
        <div class="clear"></div>
        </div>
</div>
<div id="txtPDF"  <?php if($texttype=='2') {?> style="display:block" <?php } else {?>style="display:none" <?php } ?>>
            <div class="frm_row"> <span class="label1">
            <label>Document Upload :</label>
            <span class="star">*</span></span> <span class="input1">
           <input type="file" name="txtuplode" id="txtuplode"/>
            </span>
            <div class="clear"></div>
            </div>
</div>

<div id="txtweb"<?php if($texttype=='3') {?> style="display:block" <?php } else {?>style="display:none" <?php } ?>>
   <div class="frm_row"> <span class="label1">
            <label for="txtweblink">Web Site Link :</label>
            <span class="star">*</span></span> <span class="input1">
          <input type="text" name="txtweblink" id="txtweblink" size="30" class="textbox" value="<?php if($txtweblink!=""){ echo content_desc($txtweblink);} ?>">
		<span class="date"><strong>Example : https://www.xyz.com</strong></span>

            </span>
            <div class="clear"></div>
            </div>
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
			<option value="<?php echo content_desc($row['state_id']);?>" <?php if ($txtstatus==$row['state_id']) echo 'selected="selected"';?>><?php echo $row['state_name']; ?></option>
			<?php }
			}
			else if($user_id !='101' )
			{
			$sql=mysqli_query($conn,"select * from content_state");
			
			while($row=mysqli_fetch_array($sql))
			{  
			if($row['state_short']==$role_map['draft']){
			?>
			<option value="<?php echo content_desc($row['state_id']);?>" <?php if ($txtstatus==$row['state_id']) echo 'selected="selected"';?>><?php echo $row['state_name']; ?></option>
			<?php }
			
			if($row['state_short']==$role_map['mapprove']){
			?>
                <option value="<?php echo content_desc($row['state_id']);?>"><?php echo $row['state_name']; ?></option>
                <?php }
			if($row['state_short']==$role_map['publish']){
			?>
			<option value="<?php echo content_desc($row['state_id']);?>" <?php if ($txtstatus==$row['state_id']) echo 'selected="selected"';?>><?php echo $row['state_name']; ?></option>
			<?php }
			if($row['state_short']==$role_map['review'] && $role_type=='2'){
			?>
			<option value="<?php echo content_desc($row['state_id']);?>" <?php if ($txtstatus==$row['state_id']) echo 'selected="selected"';?>><?php echo $row['state_name']; ?></option>
			<?php }
			
			
			}
			} ?>
			</select>
			</span>
			<div class="clear"></div>
			</div>
			<div class="clear"></div>

            <div class="frm_row"> <span class="button_row">
            <input name="cmdsubmit" type="submit" class="button" id="cmdsubmit" value="Submit" />&nbsp;<input name="cmdreset" type="reset" class="button" id="cmdreset" value="Reset" /><input type="hidden" name="random" value="<?php echo $_SESSION['logtoken'];?>" /><!-- <a href="employee.php"><input type="button" name="back" value="Back" class="button1"></a> -->&nbsp;
		<input type="button" class="button" value="Back" onClick="javascript:location.href = 'manage_student.php';" />
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