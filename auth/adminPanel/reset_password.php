<!DOCTYPE HTML>
<html>
<?php
session_start();
error_reporting(0);
include("../includes/useAVclass.php");
require_once "../includes/functions.inc.php";
require_once "../securimage/securimage.php";
include("../includes/def_constant.inc.php");
include('../design.php');
@extract($_GET);
@extract($_POST);
@extract($_SESSION);
$useAVclass = new useAVclass();
$useAVclass->connection();

if ($_SESSION['salt'] == "")
{
	$salt =rand(59999, 199999);
	$salt1 =rand(59999, 199999);
	
	$_SESSION['salt']=$salt;
	$_SESSION['salt1']=$salt1;
	
}

@extract($_GET);
@extract($_POST);
@extract($_SESSION);
if ($uid=="")
{

	$msg = ADMIN_NOENTRY;
	$_SESSION['sess_msg'] = $msg;
	header("location:notification.php");
	exit;
}
$newuserid=$uid;
$rest = substr($newuserid, -8,3);
$newid= check_input($_GET['uid']);
 $sql_reset = "SELECT status,username,passtime,uid FROM resetpass WHERE username ='$newuserid' and uid='$rest' ORDER BY resetPassId DESC Limit 0,1"; 
$reset_result=mysqli_query($conn,$sql_reset);
 $numrow=mysqli_num_rows($reset_result);
$line_reset=mysqli_fetch_array($reset_result); 
@extract($line_reset);
 $sql="select resetPassId,username,status,passtime  from resetpass where username ='$username' order by resetPassId desc  limit 0,1 ";
$rs=mysqli_query($conn,$sql);
$data=mysqli_fetch_array($rs);
@extract($data);
$sql1="SELECT passtime,uid,resetPassId,DATE_ADD(passtime, INTERVAL 1 DAY) AS incremtime  from `resetpass` WHERE username ='$newid' and status !='1' order by resetPassId desc  limit 0,1 ";
$rs1=mysqli_query($conn,$sql1);
$data1=mysqli_fetch_array($rs1);
@extract($data1);
$curtime=date("Y-m-d H:i:s");
if($numrow ==0)
{
	header("location:error.php");
	exit;
}
if($curtime>$incremtime)
{
	header("location:error.php");
	exit;
}
if(isset($cmdsubmit))
{

$txtnpwd= check_input($_POST['txtnpwd']);
$txtcpwd = check_input($_POST['txtcpwd']);



if(trim($txtnpwd)=="")
{
	$errmsg ="Please enter New Password.";
	$flag="NOTOK";   //setting the flag to error flag.
}

elseif(strlen($txtnpwd) <=5)
{    
	$errmsg=$errmsg."New Password minimum lenght is 6 character.";
	$flag="NOTOK";   //setting the flag to error flag.
}

elseif(strlen($txtcpwd) <=5)
{    
	$errmsg=$errmsg."Confirm Password minimum lenght is 6 character.";
	$flag="NOTOK";   //setting the flag to error flag.
}
elseif($datedif >1)
{ 
	$errmsg ="Please request Forgot Password."."<a href='$HomeURL/adminPanel/forgot_password.php' TARGET='_blank'> Forget Password</a>";
	$flag="NOTOK";   //setting the flag to error flag.
	
}
elseif(trim($txtcpwd)=="")
{
	$errmsg ="Please enter Confirm Password.";
	$flag="NOTOK";   //setting the flag to error flag.
	
}

else
{
	if($txtnpwd!=$txtcpwd)
	{
	$errmsg=$errmsg."Please enter same password.";
	$flag="NOTOK";
	}
	else
	{
	$img = new Securimage();
			$valid = $img->check($_POST['code']);
			
			if($valid == true) 
			{
			$date=date('Y-m-d');
			$tableName_send="admin_login";
			$whereclause = "id = '$rest'";
			$old = array("user_pass","last_login_date");
			$new =array("$txtnpwd","$date");
			$useAVclass->UpdateQuery($tableName_send, $whereclause, $old, $new);
			$tableName_send="resetpass";
			$whereclause = "username = '$newuserid'";
			$old = array("uid","status");
			$new =array("$rest","1");
			$useAVclass->UpdateQuery($tableName_send, $whereclause, $old, $new);
			$sql=mysqli_query($conn,"DELETE FROM resetpass WHERE uid ='$rest' and status ='0'");
		
	$msg = ADMIN_PASSWORD;
	$_SESSION['sess_msg'] = $msg;
	header("location: notification.php");
	exit;
			}
			else
			{
				$errmsg.="Please enter correct image code.<br>";
		
			}
	//$txtnpwd = strtoupper(hash("sha512",$txtnpwd));
			

	}
 }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>National Institute of Health & Family Welfare</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $HomeURL;?>/css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS  -->
    <link href="<?php echo $HomeURL;?>/css/style.css" rel="stylesheet">  
    
    <link href="<?php echo $HomeURL;?>/css/print.css" rel="stylesheet" type="text/css" media="print">

    <!-- Color Theme CSS -->
	<link rel="alternate stylesheet" href="<?php echo $HomeURL;?>/css/change.css" media="screen" title="change" />   
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php echo $HomeURL;?>/css/responsive.css" />
    <link rel="stylesheet" href="<?php echo $HomeURL;?>/css/meanmenu.css" />
    <!-- Custom Fonts -->
    <link href="font-awesome/<?php echo $HomeURL;?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?php echo $HomeURL;?>/js/html5shiv.js"></script>
        <script src="<?php echo $HomeURL;?>/js/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<?php echo $HomeURL;?>/js/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $HomeURL;?>/js/bootstrap.min.js"></script>    
    <!-- Menu Access for Tab Key -->
	<script src="<?php echo $HomeURL;?>/js/superfish.js"></script>    
    <!-- font Size Increase Decrease -->
    <script src="<?php echo $HomeURL;?>/js/font-size.js"></script>    
	<script src="<?php echo $HomeURL;?>/js/swithcer.js"></script>
	
	<script>

        // initialise plugins
     if(getCookie("mysheet") == "change" ) {
        setStylesheet("change") ;
    }else if(getCookie("mysheet") == "style" ) {
        setStylesheet("style") ;
    }else if(getCookie("mysheet") == "green" ) {
        setStylesheet("green") ;
    } else if(getCookie("mysheet") == "orange" ) {
        setStylesheet("orange") ;
    }else   {
        setStylesheet("") ;
    }
	</script>

	<script>

	(function($){ //create closure so we can safely use $ as alias for jQuery
	
	$(document).ready(function(){
	
	// initialise plugin
	var example = $('#example').superfish({
	//add options here if required
	});
	
	// buttons to demonstrate Superfish's public methods
	$('.destroy').on('click', function(){
	example.superfish('destroy');
	});
	
	$('.init').on('click', function(){
	example.superfish();
	});
	
	$('.open').on('click', function(){
	example.children('li:first').superfish('show');
	});
	
	$('.close').on('click', function(){
	example.children('li:first').superfish('hide');
	});
	});
	
	})(jQuery);
	</script>

	<script>
   function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
	      {
		  alert("Please enter numbers only");
              return false;
		  }
		else
		  {
              return true;
		  }
    }      </script>


	
	
	<script src="<?php echo $HomeURL;?>/js/jquery.meanmenu.js"></script>   
    <script type="text/jscript">
    jQuery(document).ready(function () {
        jQuery('#main-nav nav').meanmenu()
    });
    </script>   

	<script type='text/javascript'>//<![CDATA[ 
    $(window).load(function(){
    $(function () {
        $('#homeCarousel').carousel({
            interval:2000,
            pause: "false"
        });
        $('#playButton').click(function () {
            $('#homeCarousel').carousel('cycle');
        });
        $('#pauseButton').click(function () {
            $('#homeCarousel').carousel('pause');
        });
    });
    });//]]>  
    </script> 
<script src="<?php echo $HomeURL;?>/js/sha512.js" type="text/javascript"></script>

<script type="text/javascript" language="javascript">
    function getPass()
    { 
	
		var salt ='<?php print_r($_SESSION[salt]); ?>'; 
		var salt1 ='<?php print_r($_SESSION[salt1]); ?>'; 
		
		var exp=/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,10})/;
       


		var txtnpwd = document.changepass.txtnpwd.value;
		var txtcpwd = document.changepass.txtcpwd.value;
		var code = document.changepass.code.value;


		 if(txtnpwd =="") 
        {
            alert('Please enter new password');
            return false;
        }

		else if(txtcpwd=="") 
        {
            alert('Please re-enter new password');
            return false;
        }
		else if(code=="") 
		{
		alert('Please enter image code');
		return false;
		}
	 else
        {
            if(txtnpwd.search(exp)==-1) 
            {
					 alert('Password must 8 character long, include at least one special character.');
					 return false;

            }
			if (txtcpwd.search(exp)==-1) 
            {
					 alert('Password must 8 character long, include at least one special character.');
					 return false;

            }


            if ((txtnpwd!='') && (txtcpwd!='') )
            {
				
				
				var hash=hex_sha512(txtnpwd);
				var hash1=hex_sha512(txtcpwd);
			    document.getElementById('<?php echo txtnpwd; ?>').value=hash;
				document.getElementById('<?php echo txtcpwd; ?>').value=hash1;
			
				
            }


        }
    }
</script>
<script>
function ClearFields() {
     document.getElementById("code").value = "";

}
</script></head>

<body id="fontSize">
<noscript>
<div class="nos">
<p>JavaScript must be enabled in order for you to use the Site in standard view. However, it seems JavaScript is either disabled or not supported by your browser. To use standard view, enable JavaScript by changing your browser options.</p></div>
</noscript>
	<!-- Accessbility Part Start -->
	<div class="container-fluid accebility-bg">
    	<?php include('../content/accessibility_menu.php');?>
</div>
    <!-- Accessbility Part End -->
    
    <!-- Logo Part Start -->
	<div class="container-fluid">
		<?php include('../content/header.php');?>
	</div>
    <!-- Logo Part Start -->
    
<div id="main-nav" class="navigation-bg">
		<nav>
			<div class="container">
					<?php include('../content/navigation.php');?>	
			</div>
		</nav>
	</div>
    <!-- Menu Part End --> 

<div class="container background-white">
<div class="row">
          <div class="col-md-12">
            <ol class = "breadcrumb breadcrum-margin-top">
   <li><a href = "<?php echo $HomeURL;?>content/" title="Home">Home</a></li>
   <li class = "active">Employee Registration</li>
   

</ol>
 <a onClick="javascript: window.print()" title="Print" href="javascript: void(0)"><p class="glyphicon glyphicon-print  print"></p></a>
</div>
</div>
    		</div>

    <!--Middle Part Start -->   
	<div class="container background-white">
    	<div class="row">
        
        
        <div class="col-md-3 for-print">

 
<?php include("../content/left_menu.php");?>
 
          </div>
          
          
 
<div class="col-md-9 content-area">
                <h2 class="heading">Employee Registration</h2>
                
<form class="well form-horizontal" method="post" name='form1'  id="feedback-form" onSubmit="return validateForm()">
<?php if($_SESSION['sess_msg']!=""){?> <span class="label"><label>
					<?php echo $_SESSION['sess_msg'];
							$_SESSION['sess_msg']=""; ?>
					</label></span>
				<div class="clear"></div>
					<p>
					<?php }
					
					?>
					<fieldset>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtlog">Enter New Password :<strong class="text3">*</strong></label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
 <input name="txtnpwd"  type="password" class="input_class2" id="txtnpwd"  maxlength="512" autocomplete="off"/>    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="txtename">Enter Re-Enter Password :<strong class="text3">*</strong></label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
 <input name="txtcpwd"  type="password" class="input_class2" id="txtcpwd"  maxlength="512" autocomplete="off"/>
     </div>
  </div>
</div>

<!-- Text input-->


<!-- Text input-->
       <div class="form-group">
  <label class="col-md-4 control-label" for="txtemail">E-Mail</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input name="txtemail" placeholder="E-Mail Address" class="form-control"  type="text" id="txtemail" required>
    </div>
  </div>
</div>


<!-- Text input-->
       
<div class="form-group">
  <label class="col-md-4 control-label" for="txtphone">Phone</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
  <input name="txtphone" placeholder="(845)555-1212" class="form-control" type="text" id="txtphone" onKeyPress="return isNumberKey(event)">
    </div>
  </div>
</div>

<!-- Text area -->
  
<div class="form-group">
  <label class="col-md-4 control-label" for="description">Designation</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
<input name="designation" type="text" class="input_class" id="designation" size="30" value="<?php if($designation!=""){ echo  htmlentities(content_desc($designation));} ?>" autocomplete = "off" placeholder="Designation" required/>
  </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="code">Captcha <span class="star">*</span></label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        	<img id="siimage" style="vertical-align:middle;"  src="<?php echo $HomeURL;?>/securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" alt="Captcha" /></span>
                    <div class="ref"><a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onClick="document.getElementById('siimage').src = '<?php echo $HomeURL;?>/securimage/securimage_show.php?sid=' + Math.random(); return false"><img src="<?php echo $HomeURL;?>/securimage/images/refresh_icon-big.png" alt="Reload Image"  onClick="this.blur()" /></a>

 <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="allowFullScreen" value="false" />
<param name="movie" value="../securimage/securimage_play.swf?audio=../securimage/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
<param name="quality" value="high" />
<param name="bgcolor" value="#ffffff" />
<embed src="../securimage/securimage_play.swf?audio=../securimage/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>

  </div>
  </div>
  <br/>

  <div class="n_text">Enter above characters being displayed in above image </div>
                        <div class="clear">  </div>
<div class="form-group">
                    <span class="input-group">
					<!--<input name="confirm password" type="text" class="input_class" id="confirm password" />-->
					<input name="code" type="text" id="code" placeholder='Captcha Code' class="form-control" maxlength="6"/>
					<span id="codeError"  class="error"></span>
					</span>
					
					</div>
</div>
</div>

<!-- Button -->

	
	<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4" style="font-size:12px;">
    <!-- <button type="submit" class="btn btn-warning" id="submit">Send <span class="glyphicon glyphicon-send"></span></button> -->
<input type="submit" name="cmdsubmit" id="cmdsubmit" value="Submit" class="button" onClick ="return getPass();"/> 
			<input type="submit" name="cmdreset" id="cmdreset" value="Reset" class="button" />  </div>
</div>
	
	
	
	
	
	
  </div>
</div>

</fieldset>
</form>

                
 </div> 
  
</div>
</div>


	<!--Footer Logo -->
	<div class="container-fluid footer-logo-bg">
    
    
          <?php //include('../content/footer_logo.php');?>	
    
	</div>
	<!--Footer Logo end -->

<!-- Footer part -->
	<div class="container-fluid background-dark-gray">
    	 <?php include('../content/footer.php');?>	
    </div>
	<!-- Footer part -->    
</body>
</html>
