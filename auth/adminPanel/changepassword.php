<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
<?php
ob_start();
session_start();
error_reporting(0);
@extract($_GET);
@extract($_POST);
@extract($_SESSION);
require_once "../includes/connection.php";
require_once("../includes/frontconfig.inc.php");
include("../includes/useAVclass_1.php");
require_once "../includes/functions.inc.php";
include('../design.php');
if($_SESSION['admin_auto']=='')
	{		
		$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:index.php");
		exit;	
	}
	
$useAVclass = new useAVclass();
$useAVclass->connection();

if ($_SESSION['salt'] == "")
{
	$salt =rand(59999, 199999);
	$salt1 =rand(59999, 199999);
	$salt2 =rand(59999, 199999);
	$_SESSION['salt' ]=$salt;
	$_SESSION['salt1' ]=$salt1;
	$_SESSION['salt2' ]=$salt2;
}
$uid=$_SESSION['admin_auto'];
if($cmdsubmit == "Update")
{
$sql="Select user_pass from signup where id='$uid'";
$result=mysqli_query($conn,$sql);
$numrow=mysqli_num_rows($result);
$line_reset=mysqli_fetch_array($result); 
@extract($line_reset);

$txtpwd= clean($_POST['txtpwd']);
$txtnpwd= clean($_POST['txtnpwd']);
$txtcpwd = clean($_POST['txtcpwd']);
$convertpwd = strtoupper($txtpwd);
//$convertpwd = strtoupper(hash("sha512",$convertpwd));
if(trim($txtpwd)=="")
{
	$errmsg ="Please enter Old Password."."<br>";
}
if(trim($txtnpwd)=="")
{
	$errmsg.="Please enter New Password."."<br>";
}
else if(preg_match("/^[0-9a-zA-Z_]{6,}$/", $txtnpwd) === 0)
  {
  $errmsg.="New Password minimum lenght is 6 character and contain only digits, letters and underscore."."<br>";
  }
if(trim($txtcpwd)=="")
{
	$errmsg .="Please enter Confirm Password."."<br>";
}
else if(preg_match("/^[0-9a-zA-Z_]{6,}$/", $txtcpwd) === 0)
{    
	$errmsg.="Confirm Password minimum lenght is 6 character and contain only digits, letters and underscore."."<br>";
}

elseif($convertpwd!=$user_pass)
{
		$errmsg.="Please enter the correct old password.";
}
elseif($txtnpwd!=$txtcpwd)
{
$errmsg.="Password mismatch! Please enter the same password.";
}

elseif($txtpwd==$txtnpwd)
{
	$errmsg.="Old Password will not be the New Password! Please enter the New password.";
}






if($errmsg=="")
	{
	if($_SESSION['logtoken']!=$_POST['random'])
		{
			session_unset($admin_auto_id_sess);
			session_unset($login_name);
			session_unset($dbrole_id);
			$msg = "Login to Access Admin Panel";
			$_SESSION['sess_msg'] = $msg ;
			header("Location:page.php");
			exit();
		}
		//echo $txtnpwd = strtoupper(hash("sha512",$txtnpwd)); die();

		$dtime=date("Y-m-d H:i:s");	
		$tableName_send="admin_pwdhistory";
		$tableFieldsName_send=array("user_pass","id","date");
		$tableFieldsValues_send=array("$txtnpwd","$uid","$dtime");
		$useAVclass->insertQuery($tableName_send,$tableFieldsName_send,$tableFieldsValues_send);

die();



		$tableName_send="signup";
		$whereclause = "id = '$uid'";
		$old = array("user_pass");
		$new =array("$txtnpwd");
		$useAVclass->UpdateQuery($tableName_send, $whereclause, $old, $new);


		


die();





		$user_login_id=$_SESSION['admin_auto'];
$page_id=$val;
	$msg = "Your Password has been Update Successfully";
	$_SESSION['edit_prof'] = $msg;
	header("location: profile.php");
	exit;
 }
}

?>
  <head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Change Paswword::<?php echo $sitename;?></title>
<link rel="SHORTCUT ICON" href="<?php echo $HomeURL;?>/images/favicon.ico" />
<meta name="keywords" content="Change Paswword " />
<meta name="description" content="Change Paswword " />
<meta name="title" content="Change Paswword :: Department of Disability Affairs" />
<meta name="language" content="en" />
<!--This is main stylesheet -->
<link href="<?php echo $HomeURL;?>/style/style.css" rel="stylesheet" type="text/css" /> <link href="<?php echo $HomeCss;?>style/page-background.css" rel="stylesheet" type="text/css"> <link href="<?php echo $HomeURL;?>/style/responsive.css" rel="stylesheet" type="text/css" /> <link href="<?php echo $HomeCss;?>style/page-responsive.css" rel="stylesheet" type="text/css"> 
<script src="<?php echo $HomeURL; ?>/js/sha512.js" type="text/javascript"></script>
<!--This is for mobile menu -->
<!--for dropdownmenu -->
<script type="text/javascript" src="<?php echo $HomeURL;?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $HomeURL;?>/js/access.js"></script>
<script type="text/javascript" src="<?php echo $HomeURL;?>/js/dropdown.js"></script>

<script type="text/javascript">
      // initialise plugins
      jQuery(function () {
          dropdown('nav', 'hover', 1);
      });
</script>

<script>

    $(document).ready(function () {

        var i = false;

        $('.menu-icon').click(function () {

            $('.drop-down').stop(true, false).slideToggle(200);

        });

    });

</script>
<!--End -->
<script type="text/javascript" language="javascript">
    function getPass()
    {
		
	
		var salt ='<?php print_r($_SESSION[salt]); ?>'; 
		var salt1 ='<?php print_r($_SESSION[salt1]); ?>'; 
		var salt2 ='<?php print_r($_SESSION[salt2]); ?>'; 
		var exp=/((?=.*\d)(?=.*[a-z])(?=.*[@#$%]).{6,10})/;
       
		var txtpwd = document.getElementById('<?php echo txtpwd; ?>').value;
		var txtnpwd = document.getElementById('<?php echo txtnpwd; ?>').value;
		var txtcpwd = document.getElementById('<?php echo txtcpwd; ?>').value;
     
	  
		if (txtpwd=='')
        {
          /*  alert('Please Enter old password');
            return false;*/
        }
		else if (txtnpwd=='') 
        {
            /*alert('Please enter new password');
            return false;*/
        }

		else if (txtcpwd=='') 
        {
           /* alert('Please re-enter new password');
            return false;*/
        }
	
	
		 else
        {  
		
		if (txtnpwd.search(exp)==-1) 
            {
				alert('Password must 8 characters long, contain at least 1 number, at least 1 lower case letter, at least 1 upper case letter.');
					 return false;

            }
			if (txtcpwd.search(exp)==-1) 
            {
					 alert('Password must 8 character long, include at least one special character.');
					 return false;

            }

            if ((txtpwd!='') && (txtnpwd!='') & (txtcpwd!='') )
            {
         
				var hash=hex_sha512(txtpwd);
				var hash1=hex_sha512(txtnpwd);
				var hash2=hex_sha512(txtcpwd);
				
                 document.getElementById('<?php echo txtpwd; ?>').value=hash;
				document.getElementById('<?php echo txtnpwd; ?>').value=hash1;
				document.getElementById('<?php echo txtcpwd; ?>').value=hash2;
				
            }


        }
    }
</script>

<style>
#register-form label.errors{
    color: #FB3A3A;
    display: inline-block;
    margin: 0px;;
    padding: 0px;
    text-align: left;
    width: 220px;
}
	#msgerror label{
	color: #FB3A3A;
	display: inline-block;
	margin: 0px;;
	padding: 0px;
	text-align: left;
	}
</style>
<script language="JavaScript" src="<?php echo $HomeURL; ?>/js/jquery.validate.min.js"></script>
<script type="text/javascript">
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#register-form").validate({
                rules: {
				 txtpwd:{
						required: true
								},
						txtnpwd: {
						required: true,
						minlength: 8
						},
						txtcpwd: {
						required: true,
						minlength: 8,
						equalTo: "#txtnpwd"
						}
					
                },
                messages: {
                    txtpwd: { required:"Please Enter Old Passweord"
					},
					txtnpwd: {
				required: "Please  Enter New Password",
				minlength: "Your Password must be 8 characters long, contains one digit, a lower case letter , one upper case letter and a special character.Example:Super@123"
			},
			txtcpwd: {
				required: "Please Enter Confirm Password",
				minlength: "Your Password must be 8 characters long, contains one digit, a lower case letter , one upper case letter and a special character.Example:Super@123",
				equalTo: "Please enter the same password as above"
			}
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);
</script>
</head>

<body>

<!--Accessibility-->
<!--Accessibility-->
 <?php include('../content/accessbility-menu.php'); ?>
<!--Header-->


<!--Home page content-->
<!--Home page content-->
<div class="bottom-shadow">
<section>
  
<div class="menu-icon">
<div class="bar"> </div>
<div class="bar"> </div>
<div class="bar"> </div>
</div>
            
            
<div id="mcontent">
<nav class="drop-down tk-museo-sans">
    	   <?php include('../content/navigation.php'); ?>

    </nav>
  </div>  

    <div id="nav-banner-bottom">
     <?php include('../content/navigation-second.php'); ?>
    </div>
    <div class="clear"> </div>
    <div id="content-section">
      
      <div id="right-part-inner-page">
      <div id="about-us-buttons">
      <h2><a href="<?php echo $HomeURL;?>" title="Home">Home</a> >> Change Paswword</h2>
      </div>
	     <?php 
	 include('menu.php');?>
      <div class="about-us-heading">
      <h2>Change Paswword</h2>
     <div class="int-content feedback"> 
	 <form id="register-form" name="changepass" method="post" action="" autocomplete="off"> 
 <?php if($errmsg!=""){?>
						<div  id="msgerror" class="status error">
						<div class="closestatus" style="float: none;">
						<p class="closestatus" style="float: right;"><img alt="Attention" src="<?php echo $HomeURL;?>/images/close1.png" class="margintop"></p>
						<p><img alt="error" src="<?php echo $HomeURL;?>/images/error.png"> <span>Attention! <br /></span>
						
						<?php echo $errmsg; ?></p>
						</div>
						</div>
						<?php }?>
   <div class="frm_row"> <span class="label1">
              <label for="txtpwd">Enter Old Password: </label><span class="star">*</span>
              </span><span class="input1">
              <input name="txtpwd" type="password" class="input_class" id="txtpwd" maxlength="512"  value="" size="40" autocomplete="off" />
                   </span>
              <div class="clear"></div>
            </div>
            <div class="frm_row"> <span class="label1">
              <label for="txtnpwd">Enter New Password:</label>
              <span class="star">*</span></span> <span class="input1">
              <input name="txtnpwd" type="password" class="input_class" id="txtnpwd" maxlength="512" size="40" autocomplete="off" />
			  <br />
			<!-- <span class="password_help">[Password must be 8 characters long, contains one digit, a lower case letter , one upper case letter and a special character.Example:Super@123]</span>-->
              </span>
              <div class="clear"></div>
            </div>
 <div class="frm_row"> <span class="label1">
              <label for="txtcpwd">Enter Confirm Password:</label>
              <span class="star">*</span></span> <span class="input1">
              <input name="txtcpwd" type="password" class="input_class" id="txtcpwd" maxlength="512" size="40" autocomplete="off" />
              </span>
              <div class="clear"></div>
            </div>
         <div class="frm_row"> <span class="button_row">
         <input name="cmdsubmit" type="submit" class="button" id="cmdsubmit" value="Update" title="Update" onClick ="return getPass();"/>
             <input type="hidden" name="random" value="<?php echo $_SESSION['logtoken'];?>">
             <input name="cmdreset" type="reset" class="button" id="cmdreset" value="Reset" title="Reset" />
             <input type="button" class="button" value="Back" title="Back" onClick="javascript:location.href = 'profile.php';" />
              </span>
              <div class="clear"></div>
            </div>

</form>
<div class="clear"> </div>
 </div>
<div class="clear"> </div>
</div>
</div>
<aside id="left-nav-inner-pages">
        <div>
<div id="main-points-section-inner-page"><?php if($_SESSION['admin_auto'] !=''){ include('left_menu_inner.php'); }?><?php include('../content/left_menu_inner.php');?></div>
 <div id="social-icons-inner-page"><?php include('../content/soical_media.php');?></div>
 
        </div>
      </aside> 
      <div class="clear"> </div>
    </div>
  </section>
</div>

<!--footer Section -->
<footer> 
<?php include('../content/footer.php');?>
</footer>
</body>
</html>
