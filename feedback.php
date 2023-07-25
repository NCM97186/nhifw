<?php 
// echo '<pre>';
// print_r($_SERVER['DOCUMENT_ROOT']);
// die();
session_start();

require_once "includes/useAVclass.php";
require_once "includes/connection.php";

require_once "includes/config.inc.php";
require_once "includes/functions-front.inc.php";
require_once "includes/function-front.php";
// require_once "securimage/securimage.php";
// echo "hii";
// die;
include($_SERVER['DOCUMENT_ROOT']."/includes/ps_pagination.php");
include('../design.php');
include('../counter.php');
include('../design.php');
include('../counter.php');
// echo "hiii";
// die();
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
// error_reporting(E_ALL ^ E_DEPRECATED);
$errmsg="";
$_SESSION['sess_msg'] = '';

#for left menu section in just feadback.php page
$url = "feedback.php";
// if($mydb->checkTable_threeRow("menu_publish","m_url",$url,"approve_status",3,"language_id",1)>0){
// 			$contentrows=$mydb->gettable_RowsthreeColumn_where("menu_publish","m_url",$url,"approve_status",3,"language_id",1);  
		
// 			// print_r($contentrows);
// 			// die();
// 		 }
		 
// foreach($contentrows as $key=>$value){ 
// 			$page_id=$value['m_publish_id'];
// 			 $page_name=$value['m_name'];
// 			$position=$value['menu_positions'];
// 			 $rootid=get_root_parent($page_id);
// 			 $parentid=parentid($page_id);
// 			$m_name=get_page($page_id);
// 		$m_url=$value['m_url'];
// 			 $sub_flag_id=$value['m_id'];
// 			$title=$value['m_name'];
// 			$page='content';
// 		}
//eof left menu section



  $useAVclass = new useAVclass();
   $useAVclass->connections(); 
  


@extract($_GET);
@extract($_POST);
@extract($_SESSION);
if(!empty($_POST['cmdsubmit'])){
if($_POST['cmdsubmit']=='Submit')
{
	//echo $_POST['cmdsubmit'];
	 $txtename = content_desc(check_input($_POST['txtename']));
	 $txtemail = content_desc(check_input($_POST['txtemail']));
	 $txtphone = content_desc(check_input($_POST['txtphone']));
	 $txtcomment = content_desc(check_input($_POST['txtcomment']));
	  $code = content_desc(check_input($_POST['code']));

$errmsg="";  

	if(trim($txtename)=="")
	{
		$errmsg .="<font color='black'>Please enter name.</font>"."<br>";
	}
	else if(preg_match("/^[aA-zZ][a-zA-Z -]{2,30}+$/", $txtename) == 0)
	{
	$errmsg .= "<font color='black'>Name must be from letters that should be minimum 3 and maximum 30.</font>"."<br>";
	}
	
	if(trim($txtemail)=="")
	{
		$errmsg .="<font color='black'>Please enter your Email Id.</font>"."<br>";
	
	}
	elseif(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $txtemail) == 0){   
		$errmsg=$errmsg."<font color='black'>Please enter valid email Id.</font>"."<br>";
	}
	
  
  if(!preg_match("/^[0-9]{12}$/", $txtphone)) { 
		if (strlen($txtphone) < 10)
			{
				$errmsg .="<font color='black'>Please enter  10-12 digits in contact number." . "<br>";
			}
					
		}
	
	if(trim($txtcomment)=="")
	{
		$errmsg .="<font color='black'>Please enter descriptions.</font><br>";
	}
	// else if(preg_match("/^[aA-zZ0-9][a-zA-Z0-9 -.]{5,200}+$/", $txtcomment) == 0)
	// {
	// $errmsg .= "<font color='black'>Please enter Alphanumeric Characters,with a maximum of 200 characters only.</font>"."<br>";
	// }   
	
	if($_POST['code']=="")
	{
		$errmsg .="<font color='black'>Please enter correct image code .</font><br>";
	}
	
	if($_SESSION['CAPTCHA_CODE'] == $_POST['code']) 
	{	
	}
	else
	{
		$errmsg .="<font color='black'>Please enter correct image code.</font>";
		$_SESSION['sess_msg'] = $msg;      
		// header("Location: index.php"); 
		// exit;
	}
	
	
	if($errmsg == '')
		{
			
			

		
			$create_date=date('Y-m-d'); 	
			$tableName_send="feedback_form";
			$tableFieldsName_send=array("name","email","phone","comments","create_date");
			$tableFieldsValues_send=array("$txtename","$txtemail","$txtphone","$txtcomment","$create_date");
			$value = $useAVclass->insertQueryfeedback($tableName_send,$tableFieldsName_send,$tableFieldsValues_send);
			$id= $value;
            $_SESSION['sess_msg']="Feedback has been submitted successfuly.";
			



			$sql_admin=mysqli_query($conn,"select * from admin_login where id='101'");
			$line_admin=mysqli_fetch_assoc($sql_admin);
			@extract($line_admin);
			$feedback_date=date('F j, Y');

			$name=$txtename;
			$to= $txtemail;
			$subject = "User Feedback Notification"; // The Subject of the email
			$header.= "From: ".$user_email."\r\n"; 
			$header.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			 $message.="<table width='100%'  border='0' cellspacing='0' cellpadding='0' align='left'>
			<tr><td colspan='3' align='left' class='text_mail' >Dear&nbsp;".$name.",</td></tr>
			<tr><td colspan='3' align='left' class='text_mail' >&nbsp;</td></tr>
			<tr><td colspan='3' class='text_mail'>Thank you for sharing your feedback with us. We will follow up with you regarding your questions, concerns or comments as soon as possible.</td></tr>
			<tr><td colspan='3' class='text_mail'></td></tr>
			<tr><td width='40%' colspan='3' >&nbsp;</td></tr>
			<tr><td class='text_mail' colspan='3' align='left'>Warm Regards,</td></tr>
			<tr><td class='text_mail' colspan='3' align='left'>NIHFW Web Admin</td></tr>
			<tr><td class='text_mail' colspan='3' align='left'><a href='#' target='_blank'></a> </td></tr>
			<tr><td class='text_mail' colspan='3' align='left'> </td></tr>
			</table>";	
				
			$ok=mail($to, $subject, $message, $header);

			$email_from = $txtemail; // Who the email is from 
			$email_subject = "Feedback"; // The Subject of the email
			$email_to= $user_email;
			$headers.= "From: ".$email_from."\r\n"; 
			$headers.= "Content-type: text/html; charset=iso-8859-1\n"; 
			$email_message.="
			<table width='98%' border='0' align='center' cellpadding='2' cellspacing='2' class='normaltext'>
			<tr>
			<td colspan='3' align='left' valign='top'>Dear Admin,</td>
			</tr>
				<tr>
				<td colspan='3' align='left' valign='top'>&nbsp;</td>
			</tr>
			<tr>
				<td colspan='3' align='left' valign='top'>Please find below an enquiry submitted. </td>
			</tr>

			 <tr>
				<td colspan='3' align='left' valign='top'>&nbsp;</td>
			</tr>
			 <tr>
				  <td width='30%' align='left' valign='top'><strong>Name</strong></td>
				  <td width='1%' align='left' valign='top'><strong>:</strong></td>
				  <td width='69%' align='left' valign='top'>$txtename </td>
			</tr>
			<tr>
				<td align='left' valign='top'><strong>Email</strong></td>
				<td align='left' valign='top'><strong>:</strong></td>
				<td align='left' valign='top'>$txtemail</td>
			</tr>

			<tr>
				<td align='left' valign='top'><strong>Phone Number</strong></td>
				<td align='left' valign='top'><strong>:</strong></td>
				<td align='left' valign='top'>$txtphone</td>
			</tr>

			<tr>
				<td align='left' valign='top'><strong>Comments</strong></td>
				<td align='left' valign='top'><strong>:</strong></td>
				<td align='left' valign='top'>$txtcomment</td>
			</tr>
			<tr>
				<td align='left' valign='top'><strong>Feedback Date</strong></td>
				<td align='left' valign='top'><strong>:</strong></td>
				<td align='left' valign='top'>$feedback_date</td>
			</tr>

			<tr>
				<td colspan='3' align='left' valign='top'>&nbsp;</td>
			</tr>

				<tr>
				<td colspan='3' align='left' valign='top'>Regards,</td>
				</tr>
				<tr>
				<td colspan='3' align='left' valign='top'>$txtename</td>
				</tr>

			</table>";	


		$ok=@mail($email_to, $email_subject, $email_message, $headers);
		$_SESSION['sess_msg']="Feedback has been submitted successfuly.";
		header("Location:feedback.php");
		exit;

//  mail to Admin Ends


		$msg="Feedback submited successfully";
		$_SESSION['sess_feedmsg']=$msg;
		echo $_SESSION['sess_feedmsg'];
		header("location:feedback.php");
		exit;

		}
	
}
}

$url = strtolower(content_desc(htmlspecialchars($_SERVER['REQUEST_URI'])));
	if(strstr($url,'script')!=FALSE)
	 	{
	    	$url=  str_replace(".php/",".php",content_desc(strtolower(htmlspecialchars($_SERVER['REQUEST_URI']))));
			header("location:".$url); exit;
		}
		
	@$_GET['page']=content_desc($_GET['page']);

	if($_SERVER['REQUEST_URI'])
		{
			$url=mysqli_real_escape_string($conn,$_SERVER['REQUEST_URI']); 
			$val=explode('/', $url);
			//$url=$val['4'];
			@$open=$val['3'];
			if( $_GET['page']!='') 
				{
					$url=$_GET['page'];
				}
			else 	
				{
					@$url=$val['4'];
				}
		
			if($mydb->checkTable_threeRow("recruitment_publish","page_url",$url,"approve_status",3,"language_id",1)>0)
				{

					$contentrows=$mydb->gettable_RowsthreeColumn_where("recruitment_publish","page_url",$url,"approve_status",3,"language_id",1);  

		 		}
			if(is_array(@$contentrows) ){
				foreach($contentrows as $key=>$value)
					{ 
						$page_id=$value['m_publish_id'];
						$page_name=$value['m_name'];
						$position=$value['menu_positions'];
						
					
						if($page_id!='0' && $page_id!='')
							{
								$method="mapping";
								$pgprntnams=pagebreadcrumb($page_id,0,$method,1,$page);
								$btitle=pagebreadcrumb1($page_id,0,$method,1,$page);
							}

						$body=stripslashes(html_entity_decode($value['m_content']));


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
    <link href="<?php echo $HomeURL;?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
    
    
    <!-- For Left Menu -->
    <link rel="stylesheet" type="text/css" href="<?php echo $HomeURL;?>/css/leftmenu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $HomeURL;?>/css/jquery.treeview.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $HomeURL;?>/css/ajaxtabs.css">
    <script  src="<?php echo $HomeURL;?>/js/jquery.treeview.js"></script>
    <script >
    jQuery(document).ready(function () {
        jQuery('li.dropdown:has(ul:empty)').remove();
        jQuery('ul.menu-class li:has(ul)').addClass('collapsed');
        jQuery("ul.menu-class").treeview({
            collapsed: true,
            unique: true,
            persist: "location"
        });
        return false;
    });
	</script>

    <script >
        jQuery(document).ready(function () {
            jQuery('.left-menu .left ').menu-class();
        });
	</script>
    
    
    
	
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
    (function($){ //create closure so we can safely use $ as alias for jQuery
    
    $(document).ready(function(){
    
    // initialise plugin
    var example = $('#example1').superfish({
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


	<script src="<?php echo $HomeURL;?>/js/modern-ticker.js" > </script>
	<script >
            $(function () {
                $(".ticker1").modernTicker({
                    effect: "scroll",
                    scrollInterval: 20,
                    transitionTime: 500,
                    autoplay: true
                });
                });
		
	</script>
    
	<script  src="<?php echo $HomeURL;?>/js/jquery.totemticker.js"></script>
	<script >
		$(function(){
			$('#vertical-ticker').totemticker({
				row_height	:	'100px',
				next		:	'#ticker-next',
				previous	:	'#ticker-previous',
				stop		:	'#stop',
				start		:	'#start',
				mousestop	:	true,
			});
		});
	</script>
    
	<script src="<?php echo $HomeURL;?>/js/jquery.meanmenu.js"></script>   
    <script >
    jQuery(document).ready(function () {
        jQuery('#main-nav nav').meanmenu()
    });
    </script>   

	<script >//<![CDATA[ 
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
    	<?php include('accessibility_menu.php');?>
</div>
    <!-- Accessbility Part End -->
    
    <!-- Logo Part Start -->
	<div class="container-fluid">
		<?php include('header.php');?>
	</div>
    <!-- Logo Part Start -->
    
<div id="main-nav" class="navigation-bg">
		<nav>
			<div class="container">
					<?php include('navigation.php');?>	
			</div>
		</nav>
	</div>
    <!-- Menu Part End --> 

<div class="container background-white">
<div class="row">
          <div class="col-md-12">
            <ol class = "breadcrumb breadcrum-margin-top">
   <li><a href = "<?php echo $HomeURL;?>" title="Home">Home</a></li>
   <li class = "active"><a href="view-all.php?menu=Contact Us">Contact Us</a> </li>
   <li class = "active">Feedback</li>
   

</ol>
 <a onClick="javascript: window.print()" title="Print" href="javascript: void(0)"><p class="glyphicon glyphicon-print  print"></p></a>
</div>
</div>
    		</div>

    <!--Middle Part Start -->   
	<div class="container background-white">
    	<div class="row">
        
        
        <div class="col-md-3 for-print">

 <div class="left-menu">
<div class="left">
<?php //include("left_inner_page_menu.php");?>
	<div class="left ok1">
  <div class="left-sidebar l2">
   <h3 data-my="7" >ContactUs</h3>
</div>

  
  
<ul class="menu-class treeview" data-my='ok3'>
        
    <li ook><a href="http://117.239.177.100/nihfw/cms/feedback.php" title="Feedback" class="selected">Feedback</a></li>
    
    <li ook><a href="http://117.239.177.100/nihfw/cms/email--fax--telephones.php" title="Email, Fax, Telephones" >Email, Fax, Telephones</a></li>
    
    <li ook><a href="http://117.239.177.100/nihfw/cms/directors-office.php" title="Directors Office" class="">Directors Office</a></li>
    
    <li ook><a href="http://117.239.177.100/nihfw/cms/office-of-dean.php" title="Office of Dean" class="">Office of Dean</a></li>
    
    <li ook><a href="http://117.239.177.100/nihfw/cms/vigilance-officer.php" title="Vigilance Officer" class="">Vigilance Officer</a></li>
    
    <li ook><a href="http://117.239.177.100/nihfw/cms/public-information-officer.php" title="Public Information Officer" class="">Public Information Officer</a></li>
    
    <li ook><a href="http://117.239.177.100/nihfw/cms/location-map.php" title="Location Map" class="">Location Map</a></li>
    
    <li ook><a href="http://117.239.177.100/nihfw/cms/how-to-reach.php" title="How to Reach" class="">How to Reach</a></li>
    
    <li ook><a href="http://117.239.177.100/nihfw/cms/enquiry.php" title="Enquiry" class="">Enquiry</a></li>
      </ul>
  </div>
</div>
</div>

<?php //include("left_menu.php");?>
 
          </div>
          
          
 
<div class="col-md-9 content-area">
	
                <h2 class="heading">Feedback</h2>
                
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
	 else if($_SESSION['sess_msg']!='') { ?>
							<div  id="msgclose" class="status success">
							<div class="closestatus" style="float: none;">
							<p class="closestatus" style="float: right;"><img alt="Attention" src="<?php echo $HomeURL;?>/images/close1.png" class="margintop"></p>
							<p style="color: green;"><img alt="Attention" src="<?php echo $HomeURL?>/images/approve.png" class="margintop"> <span>Attention! </span><?php echo $_SESSION['sess_msg'];
							$_SESSION['sess_msg']=""; ?></p>
							</div>
							</div>
							<?php	} ?>
<fieldset>


<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" for="txtename">Name</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="txtename" placeholder="First Name" value="" class="form-control"  type="text" id="txtename" required>
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
  <input name="txtemail" placeholder="E-Mail Address" value="" class="form-control"  type="text" id="txtemail" required>
    </div>
  </div>
</div>


<!-- Text input-->
       
<div class="form-group">
  <label class="col-md-4 control-label" for="txtphone">Phone</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
  <input name="txtphone" maxlength="10" placeholder="(845)555-1212" class="form-control" value=""  type="text" id="txtphone" required>
    </div>
  </div>
</div>

<!-- Text area -->
  
<div class="form-group">
  <label class="col-md-4 control-label"  >Description</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        	<textarea class="form-control" name="txtcomment" placeholder="Description" id="txtcomment" value=""  required></textarea>
  </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="code">Captcha <span class="star">*</span></label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
       <span> 
	   <img src="includes/captcha.php" alt="PHP Captcha">
	   <a tabindex="-1" style="border-style: none" href="feedback.php" title="Refresh Image" ><img src="images/refresh_icon-big.png" alt="Reload Image" border="0"  align="bottom" /></a>

  </div>
  </div>
  <br/>

  <div class="n_text">Enter above characters being displayed in above image </div>
	 
	                     <div class="clear">  </div>
					
<div class="form-group">
<label class="col-md-4 control-label"  >Description</label>
    <div class="col-md-4 inputGroupContainer">
                    <span class="input-group">
					<!--<input name="confirm password" type="text" class="input_class" id="confirm password" />-->
					<input name="code" type="text" id="code" placeholder='Captcha Code' class="form-control" maxlength="6"/>
				
					</span>
					
					</div>
</div>
	 </div>
</div>

<!-- Button -->

	
	<div class="form-group">
  <label class="col-md-4 control-label"  ></label>
  <div class="col-md-4" style="font-size:12px;">
    <!-- <button type="submit" class="btn btn-warning" id="submit">Send <span class="glyphicon glyphicon-send"></span></button> -->
		<input name="cmdsubmit" type="submit" class="btn btn-warning" id="cmdsubmit" title="Submit" value="Submit" />
  </div>
</div>
	
	
	
	
	
	</fieldset>
</form>
  
</div>



                 
  
</div>
</div>


	<!--Footer Logo -->
	<div class="container-fluid footer-logo-bg">
    
    
          <?php include('footer_logo.php');?>	
    
	</div>
	<!--Footer Logo end -->

<!-- Footer part -->
	<div class="container-fluid background-dark-gray">
    	 <?php include('footer.php');?>	
    </div>
	<!-- Footer part -->    
</body>
</html>
