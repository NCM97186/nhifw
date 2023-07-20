<?php
error_reporting(0);
require_once "../includes/connection.php";
require_once("../includes/frontconfig.inc.php");
require_once "../includes/functions.inc.php";
require_once "../includes/functions-data.php";

require_once "../securimage/securimage.php";
include('../design.php');
include("../includes/useAVclass.php");
$useAVclass = new useAVclass();
$useAVclass->connection();
@@extract($_POST);
$_SESSION['salt'] == "";
$_SESSION['saltCookie'] == "";

if ($_SESSION['salt'] == "")
{
	$salt =uniqid(rand(59999, 199999));
	$saltCookie =uniqid(rand(59999, 199999));
	$_SESSION['salt' ]=$salt;
	$_SESSION['saltCookie'] =$saltCookie;
}
if($_SESSION['admin_auto']!='')
	{		
		header("Location:sdfsfdsf.php");
		exit;	
	}
elseif($cmdsubmit)
{
$login = clean($_POST['txtusername']);
$password = clean($_POST['txtpassword']);

	if(($login=="") && ($password==""))
	{
		$msg="Please enter username and password.";
		$_SESSION['sess_msg'] = $msg;
	}
	elseif($_POST['code']!="")
	{

			$img = new Securimage();
			$valid = $img->check($_POST['code']);
	if($valid === true) 
			{
			
			}
			else
			{
				$msg="Please enter correct image code";
				$_SESSION['sess_msg'] = $msg;
				header("Location: index.php");
				exit;
			}
if($msg == '')
{	
		 //$qry="SELECT * from admin_login where user_status='1' and user_type='$user_type'"; 
	$qry="SELECT * from employee_login where user_status='1'"; 
		$result=mysqli_query($conn,$qry);
		while($data = mysqli_fetch_assoc($result))
		{
			//print_r($data);
			@extract($data);
			$db_admin =$data['id'];
			$username =$data['login_name'];
			$user_name =$data['user_name'];
			$user_email =$data['user_email'];
			$db_pwd =$data['user_pass'];

			$newpwd=strtoupper(hash("sha512",$db_pwd.$salt));



			//if($password==$newpwd && $login_name==$login)
		if($login_name==$login)
			{

				session_regenerate_id();
				$admin_auto =$db_admin;
				$_SESSION['cookie_fullname']=$user_name;
				$_SESSION['cookie_email']=$user_email;
				$_SESSION['admin_auto'] = $admin_auto;
				$_SESSION['logintype'] = $user_type;
				//echo ($_SESSION['admin_auto_id_sess']) ;
				$_SESSION['login_user'] =$username;
				$_SESSION['Temp']=$_SESSION['saltCookie'];
				setcookie("Temp",$_SESSION['saltCookie']);
				$_SESSION['IsAuthorized']=true;
				
				$_SESSION['Temptest']=$_SESSION['saltCookie'];
										
										$expire=0; 
										$path=''; 
										$domain='';
										$secure=false;
										$httponly=true;

										setcookie("Temp",$_SESSION['saltCookie'],$expire,$path,$domain,$secure,$httponly);
									$_SESSION['logtoken'] =md5(uniqid(mt_rand(), true));
				session_write_close();
					$user_id=$_SESSION['admin_auto'];
										//echo $user_id; exit();
										$page_id=mysqli_insert_id($conn,);
										$action="Login";
										$model_id='Front Login';
										$categoryid='1'; //mol_content
										$date=date("Y-m-d h:i:s");
										$ip=$_SERVER['REMOTE_ADDR'];
										$tableName="audit_trail";
									$tableFieldsName_send=array("user_login_id","page_id","page_name","page_action","page_category","page_action_date","ip_address","lang","page_title","approve_status");
										$tableFieldsValues_send=array("$user_id","$page_id","$txtename","$action","$model_id","$date","$ip","$txtlanguage","$txtepage_title","$txtstatus");
										//echo $user_type; die;
										$value=$useAVclass->insertQuery($tableName,$tableFieldsName_send,$tableFieldsValues_send);
			
				
								header("location:../content/employee_corner.php");

				
				
			}
			else
			 {
					$msg="Please enter correct username and password.";
					$_SESSION['sess_msg'] = $msg;
				/*	header("Location: index.php");
					exit;*/
			 }
			

		}

 
	}

else
				{
					$msg="Please enter username and password.";
					$_SESSION['sess_msg'] = $msg;
					header("Location: index.php");
					exit;
		
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
		alert('gggg');
		var salt ='<?php print_r($_SESSION[salt]); ?>'; 
	
		var exp=/((?=.*\d)(?=.*[a-z])(?=.*[@#$%]).{6,10})/;
       
		var value = document.getElementById('<?php echo txtpassword; ?>').value;
		if (value=='')
        {
           /* alert('Enter username and password');
            return false;*/
        }
        else
        {
            if (value.search(exp)==-1) 
            {
              
              //  return false;
            }
            if (value!='')
            {
				//alert(salt);
				//alert(hex_sha512(value)+salt);
				//alert(hex_sha512(hex_sha512(value)+salt));
                var hash=hex_sha512(hex_sha512(value)+salt);
                document.getElementById('<?php echo txtpassword; ?>').value=hash;
				
            }


        }
    }



</script>


<script>
function ClearFields() {
     document.getElementById("code").value = "";

}
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
   <li class = "active">Employee Login</li>
   

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
                <h2 class="heading">Employee Login</h2>
                
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
  <label class="col-md-4 control-label" for="txtusername">User login Id:</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="txtusername" placeholder="Valid User Name" class="form-control"  type="text" id="txtusername" required>
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="txtpassword">Password:<strong class="text3">*</strong></label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="txtpassword" placeholder="Valid Password" class="form-control"  type="password" id="txtpassword" required>
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

  <p class="n_text">Enter above characters being displayed in above image </p>
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
		<input type="submit" name="cmdsubmit" id="cmdsubmit" value="Login" class="btn btn-warning" title="Login" onClick ="return getPass();"/> 
 <span class="forget">&nbsp; &nbsp;<a href="employee_registration.php" title="Sign Up?">Sign Up?</a> </span>  </div>
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
