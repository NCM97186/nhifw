<?php 
session_start();
include("../includes/useAVclass.php");
require_once "../includes/connection.php";
require_once("../includes/config.inc.php");
require_once "../includes/functions.inc.php";
require_once "../includes/functions-data.php";
require_once "../securimage/securimage.php";
require_once "../design.php";

  $useAVclass = new useAVclass();
   $useAVclass->connection(); 
  

if(isset($cmdsubmit))
{
$salt =rand(19999, 29999);
$salt1 =rand(31999, 59999);
	$txtename =content_desc(check_input($_POST['txtename']));
	$txtlog = content_desc(check_input($_POST['txtlog']));
	$txtemail =content_desc(check_input($_POST['txtemail']));
	$txtphone =content_desc(check_input($_POST['txtphone']));
	$designation=content_desc(check_input($_POST['designation']));
	$errmsg="";        // Initializing the message to hold the error messages
if(trim($txtlog)=="")
	{
		$errmsg ="Please enter User Id Name."."<br>";	
	}
	else if(preg_match("/^[I-X0-9a-zA-Z_]{2,100}$/", $txtlog) === 0)
 		{
	          $errmsg .= "Please enter Alphanumeric value that should be minimum 3 and maximum 100."."<br>";
		}
	else if(trim($txtlog)!="")
		{
		$tableName_send="employee_login";
		$field_name="login_name";
		$checkuniqe=check_unique($txtlog,$field_name,$tableName_send);
		if($checkuniqe >0)
			{
				$errmsg=$errmsg."User Login Name already exits."."<br>";
			}
		}
	if(trim($txtename)=="")
	{
		$errmsg .="Please enter name."."<br>";
	}
	else if(preg_match("/^[aA-zZ][a-zA-Z -]{2,30}+$/", $txtename) == 0)
	{
	$errmsg .= "Name must be from letters that should be minimum 3 and maximum 30."."<br>";
	}
	if(trim($txtemail)=="")
	{
		$errmsg .="Please enter Email Id."."<br>";
	}
	elseif(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $txtemail)){   
		$errmsg=$errmsg."Please enter valid email Id."."<br>";
	}
	
	elseif(trim($txtemail)!="")
		{
		$tableName_send="employee_login";
		$field_name="user_email";
		$checkuniqe=check_unique($txtemail,$field_name,$tableName_send);
		if($checkuniqe >0)
			{
				$errmsg=$errmsg."User Email Id already exits."."<br>";
			}
			
		}
	if(trim($designation)=="")
	{
		$errmsg .="Please enter Designation."."<br>";
	}
	else if(preg_match("/^[aA-zZ][a-zA-Z -]{2,30}+$/", $designation) == 0)
	{
	$errmsg .= "Designation must be from letters that should be minimum 3 and maximum 30."."<br>";
	}
	if(trim($txtphone)=="")
	{
		$errmsg .="Please enter Phone Number."."<br>";
	
	}
	elseif(!is_numeric(trim($txtphone)))
	{
		$errmsg .="Phone Number should be numeric."."<br>";
	}
	else if(preg_match("/^[0-9]{8,12}$/", trim($txtphone)) === 0)
	{
	$errmsg.="Phone Number should be 8 to 12 digits."."<br>";
	}
	
	if($errmsg == '')
		{
		

		
				
		 $date=date('Y-m-d'); 	
		$tableName_send="employee_login";
		$tableFieldsName_send=array("user_name","login_name	","user_pass","user_email","user_phone","user_status","create_login_date","designation");
		$tableFieldsValues_send=array("$txtename","$txtlog","","$txtemail","$txtphone","1","$date","$designation");
		$useAVclass->insertQuery($tableName_send,$tableFieldsName_send,$tableFieldsValues_send);
		$id=mysqli_insert_id($conn);
	$sql_admin_email = "SELECT user_email,user_name FROM employee_login where id=$id ";
		$res_admin_email =mysqli_query($conn,$sql_admin_email);
		$res_num_rows=mysqli_num_rows($res_admin_email);
		$data=mysqli_fetch_array($res_admin_email);
		@extract($data);
		$userid=$salt.$id.$salt1;


		$email_from = $user_email; // Who the email is from 
		$email_subject = "Password Notification"; // The Subject of the email
		$email_to= $txtemail;
		$headers.= "From: ".$email_from."\r\n"; 
		$headers.= "Content-type: text/html; charset=iso-8859-1\n"; 
		$email_message.="<table width='100%'  border='0' cellspacing='0' cellpadding='0' align='left'>
		<tr><td colspan='3' align='left' class='text_mail' >Dear  $txtename,</td></tr>
		<tr><td colspan='3' class='text_mail'>&nbsp;</td></tr>
		<tr> <td colspan='3' align='left' class='text_mail'>Your control panel login details are as follows:</td></tr>
		<tr><td  colspan='3' class='text_mail'>&nbsp;</td></tr>
		<tr><td width='40%' colspan='3' >
		<table width='50%'  border='0' cellspacing='0' cellpadding='0' align='left'>
                <tr><td class='text_mail'>User Name :$txtlog</td></tr>
		<tr><td width='10%' class='text_mail' align='left' >
		<a href='$HomeURL/auth/reset_password.php?uid=$userid'> Reset your Password</a>
		</td><td width='25%' align='left'> </td></tr>
		<tr><td class='text_mail'>&nbsp;</td></tr> </table>
		</td></tr>
                  <tr><td  colspan='3'>&nbsp;</td></tr>
                <tr><td class='text_mail' colspan='3'align='left'>Regards,</td></tr>
		<tr><td class='text_mail' colspan='3'align='left'>;" .$sitename." </td></tr>
		</table>";	
	if(mail($email_to, $email_subject, $email_message, $headers))
			{
				$status=1;
			
			}
			else
			{
			
				$status=0;
			}

		$dtime=date("Y-m-d H:i:s");
		//$rest = substr($userid, -8,3);
		$tableName_send="resetpass";
		$tableFieldsName_send=array("username","passtime","uid");
		$tableFieldsValues_send=array("$userid","$dtime","$id");
		$useAVclass->insertQuery($tableName_send,$tableFieldsName_send,$tableFieldsValues_send);
		$msg=SENDING_DETAILS;
		$_SESSION['manage_user']=$msg;
		header("location:employee_registration.php");
		exit;

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

</head>

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
<?php if($errmsg!=""){?>
						<div  id="msgerror" class="status error">
						<div class="closestatus" style="float: none;">
						<p class="closestatus" style="float: right;"><img alt="Attention" src="<?php echo $HomeURL;?>/images/close1.png" class="margintop"></p>
						<p><img alt="error" src="<?php echo $HomeURL;?>/images/error.png"> <span><font color="black">Attention! </font><br /></span>
						
						<?php echo $errmsg; ?></p>
						</div>
						</div>
						<?php }
						else if($_SESSION['sess_msg']!=''){?>
							<div  id="msgclose" class="status success">
							<div class="closestatus" style="float: none;">
							<p class="closestatus" style="float: right;"><img alt="Attention" src="<?php echo $HomeURL;?>/images/close1.png" class="margintop"></p>
							<p><img alt="Attention" src="<?php echo $HomeURL?>/images/approve.png" class="margintop"> <span>Attention! </span><?php echo $_SESSION['sess_msg'];
							$_SESSION['sess_msg']=""; ?></p>
							</div>
							</div>
							<?php	} ?><fieldset>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtlog">User Id</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="txtlog" placeholder="User Id" class="form-control"  type="text" id="txtlog" required>
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="txtename">Name</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="txtename" placeholder="First Name" class="form-control"  type="text" id="txtename" required>
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
  <input name="txtphone" placeholder="(845)555-1212" class="form-control" type="text" id="txtphone" onkeypress="return isNumberKey(event)">
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
		<input name="cmdsubmit" type="submit" class="btn btn-warning" id="cmdsubmit" title="Submit" value="Submit" />
  </div>
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
