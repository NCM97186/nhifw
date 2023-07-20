<?php 
include("includes/useAVclass.php");
require_once "includes/connection.php";
require_once("includes/config.inc.php");
require_once "includes/functions-front.inc.php";
require_once "includes/functions-front.php";
require_once "securimage/securimage.php";
require_once "design.php";
require_once "securimage/securimage.php";

//for left menu section in just feadback.php page
//$url = "feedback.php";
//if($mydb->checkTable_threeRow("menu_publish","m_url",$url,"approve_status",3,"language_id",1)>0){
			//$contentrows=$mydb->gettable_RowsthreeColumn_where("menu_publish","m_url",$url,"approve_status",3,"language_id",1);  

		 //}
		 
foreach($contentrows as $key=>$value){ 
			$page_id=$value['m_publish_id'];
			 $page_name=$value['m_name'];
			$position=$value['menu_positions'];
			 $rootid=get_root_parent($page_id);
			 $parentid=parentid($page_id);
			$m_name=get_page($page_id);
		$m_url=$value['m_url'];
			 $sub_flag_id=$value['m_id'];
			$title=$value['m_name'];
			$page='content';
}
//eof left menu section

$useAVclass = new useAVclass();
$useAVclass->connection(); 
  
@extract($_GET);
@extract($_POST);
@extract($_SESSION);

if(isset($cmdsubmit) || content_desc($_POST['cmdsubmit']=='Submit'))
{
	 $txtinstitution_type = content_desc(check_input($_POST['txtinstitution_type']));
	 $txtmanagement = content_desc(check_input($_POST['txtmanagement']));
	 $txtname = content_desc(check_input($_POST['txtname']));
	 $txtaddress = content_desc(check_input($_POST['txtaddress']));
     $txtcity = content_desc(check_input($_POST['txtcity']));
     $txtdistrict = content_desc(check_input($_POST['txtdistrict']));
     $txtpincode = content_desc(check_input($_POST['txtpincode']));
     $txtstate = content_desc(check_input($_POST['txtstate']));
     $txtemail = content_desc(check_input($_POST['txtemail']));
     $txtphone = content_desc(check_input($_POST['txtphone']));
     $txtfax = content_desc(check_input($_POST['txtfax']));
     //$txtfax=strip_tags($txtfax1);
     $txtcontact = content_desc(check_input($_POST['txtcontact']));
     $txtdesignation = content_desc(check_input($_POST['txtdesignation']));
     $txtphone = content_desc(check_input($_POST['txtphone']));
     $txtemailcontact = content_desc(check_input($_POST['txtemailcontact']));
     $txtfaxcontact = content_desc(check_input($_POST['txtfaxcontact']));
     $txttotalstrength = content_desc(check_input($_POST['txttotalstrength']));
     $txtcomputer = content_desc(check_input($_POST['txtcomputer']));
     $txtprinter = content_desc(check_input($_POST['txtprinter']));
     $txtfacility = content_desc(check_input($_POST['txtfacility']));
     $radInternet = content_desc(check_input($_POST['radInternet']));
    // $areaofinterest = content_desc(check_input($_POST['mytext']));
    $areaofinterest1 = content_desc(check_input(implode(",",$_POST['mytext'])));
    $currentactivity = content_desc(check_input(implode(",",$_POST['currentact'])));
    $expectation = content_desc(check_input(implode(",",$_POST['expectation'])));
    $proposed = content_desc(check_input(implode(",",$_POST['proposed'])));
    $venue = content_desc(check_input(implode(",",$_POST['venue'])));
    $suggestion = content_desc(check_input(implode(",",$_POST['suggestion'])));
    // $areaofinterest1 = implode("",$areaofinterest);
     
	 
$code = content_desc(check_input($_POST['code']));

$errmsg="";

  if(trim($txtinstitution_type)=="")
  {
    $errmsg .="<font color='black'>Please Select Institution Type .</font>"."<br>";
  } 

  if(trim($txtmanagement)=="")
  {
    $errmsg .="<font color='black'>Please Select Type of Management  .</font>"."<br>";
  }   

 	if(trim($txtname)=="")
 	{
 		$errmsg .="<font color='black'>Please Enter Institution Name</font>"."<br>";
 	}

 	else if(preg_match("/^[aA-zZ][a-zA-Z -]{2,100}+$/", $txtname) == 0)
 	{
 	$errmsg .= "<font color='black'>Institution Name must be from letters that should be minimum 3 and maximum 100.</font>"."<br>";
 	}
	
if(trim($txtaddress)=="")
  {
    $errmsg .="<font color='black'>Please Enter Address.</font><br>";
  }

  else if(preg_match("/^[aA-zZ0-9][a-zA-Z0-9 -.]{5,300}+$/", $txtaddress) == 0)
  {
  $errmsg .= "<font color='black'>Please Enter Address Alphanumeric Characters,with a maximum of 200 characters only.</font>"."<br>";
  }  


  if(trim($txtcity)=="")
  {
    $errmsg .="<font color='black'>Please Enter City Name</font>"."<br>";
  }
  else if(preg_match("/^[aA-zZ][a-zA-Z -]{2,30}+$/", $txtcity) == 0)
  {
  $errmsg .= "<font color='black'>City Name must be from letters that should be minimum 3 and maximum 30.</font>"."<br>";
  } 


if(trim($txtdistrict)=="")
  {
    $errmsg .="<font color='black'>Please Enter District Name</font>"."<br>";
  }
  else if(preg_match("/^[aA-zZ][a-zA-Z -]{2,30}+$/", $txtdistrict) == 0)
  {
  $errmsg .= "<font color='black'>District Name must be from letters that should be minimum 3 and maximum 30.</font>"."<br>";
  } 


  // if(!preg_match("/^[0-6]$/", $txtpincode)) { 
  //   if (strlen($txtpincode) < 6)
  //     {
  //       $errmsg .="<font color='black'>Please Enter  6 digits in pin code number." . "<br>";
  //     }
          
  //   }

  if(trim($txtpincode)=="")
  {
    $errmsg .="Please enter Pincode Number."."<br>";
  }
  if(!is_numeric(trim($txtpincode)))
  {
    $errmsg .="Pincode number should be numeric."."<br>";
  }


 if(trim($txtstate)=="")
  {
    $errmsg .="<font color='black'>Please Select State  .</font>"."<br>";
  } 


 	if(trim($txtemail)=="")
 	{
		$errmsg .="<font color='black'>Please Enter your Email Id.</font>"."<br>";
	
	}



 	elseif(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $txtemail)){   
		$errmsg=$errmsg."<font color='black'>Please enter valid email Id.</font>"."<br>";
	}
	
  // if(trim($txtphone)=="")
  // {
  //   $errmsg .="<font color='black'>Please Enter Phone No Number</font>"."<br>";
  // }

 	// else if (!preg_match('/^[0-9]*$/', $txtphone)) {
  //       // Error
  //   } else {
  //       // Continue
  //   }
	
	if($_POST['code']=="")
	{
 		$errmsg .="<font color='black'>Please enter correct image code .</font><br>";
	}
	
 	if($_POST['code']!="")
 	{

				$img = new Securimage();
				$valid = $img->check($_POST['code']);
				
 				if($valid == true) 
 				{
				
				}
				else
 				{
					$errmsg .="<font color='black'>Please enter correct image code.</font>";
					$_SESSION['sess_msg'] = $msg;
			
			}
	}
	
	if($errmsg == '')

		{	
			$create_date=date('Y-m-d'); 	
			$tableName_send="online_submission";
			$tableFieldsName_send=array("institution_type","management_type","institution_name","address","city","district","pincode","state","email","phone","vax_no","contact_person","designation_person","phone_contact","email_contact","fax_contact","tatal_strength","no_of_computer","no_of_printer","facility","no_of_printers","area_of_interest","current_activity","expectation","proposes_activity","venue_activity","suggestion","create_date");
			$tableFieldsValues_send=array("$txtinstitution_type","$txtmanagement","$txtname","$txtaddress","$txtcity","$txtdistrict","$txtpincode","$txtstate","$txtemail","$txtphone","$txtfax","$txtcontact","$txtdesignation","$txtphone","$txtemailcontact","$txtfaxcontact","$txttotalstrength","$txtcomputer","$txtprinter","$txtfacility","$radInternet","$areaofinterest1","$currentactivity","$expectation","$proposed","$venue","$suggestion","$create_date");
			$useAVclass->insertQuery($tableName_send,$tableFieldsName_send,$tableFieldsValues_send);
  
			//print_r($tableFieldsValues_send);
			//die();

			$id=mysqli_insert_id();
			
				
//  mail to Admin Ends

		$msg=FEED_NOTIFICATION;
		$_SESSION['sess_feedmsg']=$msg;
		echo $_SESSION['sess_feedmsg'];
		header("location:online_submission.php");
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
    <style>
    	.form-horizontal .control-label {
    		padding-top: 7px;
    		margin-bottom: 0;
    		text-align: left;
		}
		.input-group {
    position: relative;
    display: inherit;
    border-collapse: separate;
}
.addin{margin-top:15px;}
.star { color: red; }
    </style>


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
   
   <li class = "active">Online Information Submission</li>
   

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
<?php include("left_inner_page_menu.php");?>
	
</div>
</div>

<?php include("left_menu.php");?>
 
</div>
          
          
 
<div class="col-md-9 content-area">
                <h2 class="heading">Online Information Submission</h2>
                
<form class="well form-horizontal" method="post" name='form1'  id="online_submission" onSubmit="return validateForm()">
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
							<?php	} ?>
<fieldset>


<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" for="txtinstitution_type">Select Institution Type <span class="star">*
  </span></label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">

 <select name="txtinstitution_type" id="txtinstitution_type"  class="inputbox form-control" autocomplete="off">
<option value="">Select</option>
<?php

foreach ($Institution_type as $key => $value) {
?>

<option value="<?php echo "$key"; ?>" 
<?php if($key=="$txtinstitution_type") { echo 'selected="selected"'; } else { } ?> > <?php echo "$value"; ?>
	
</option>

<?php } ?>
 </select>
 </div>
 </div>
</div>

<!-- Text input-->

<!-- Text input-->
   <div class="form-group">
  <label class="col-md-4 control-label" for="txtmanagement">Type of Management <span class="star">* </span></label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
 
  <select name="txtmanagement" id="txtmanagement" class="inputbox form-control" autocomplete="off">
  <option value="">Select</option>
<?php

foreach ($Management as $key => $value) {
?>

<option value="<?php echo "$key"; ?>" 
<?php if($key=="$txtmanagement") { echo 'selected="selected"'; } else { } ?> > <?php echo "$value"; ?>
	
</option>

<?php } ?>
</select>
   </div>
  </div>
</div>


 <div class="form-group">
  <label class="col-md-4 control-label" for="txtname">Institution Name (Full Name) <span class="star">* </span></label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <input name="txtname" value="<?php echo $txtname ?>" placeholder="Institution Name" class="form-control"  type="text" id="txtname">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Address <span class="star">*</span></label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        
       <textarea class="form-control" name="txtaddress" placeholder="Address" id="txtaddress"></textarea>
  </div>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="txtcity">City <span class="star">*</span> </label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <input name="txtcity" value="<?php echo $txtcity ?>" placeholder="City" class="form-control"  type="text" id="txtcity">
    </div>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="txtdistrict">District <span class="star">*</span></label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <input name="txtdistrict" value="<?php echo $txtdistrict; ?>" placeholder="District" class="form-control"  type="text" id="txtdistrict">
    </div>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="txtpincode">Pin Code <span class="star">*</span></label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <input name="txtpincode" value="<?php echo $txtpincode ?>" placeholder="Pincode" class="form-control"  type="text" id="txtpincode" maxlength="6">
    </div>
  </div>
</div>

<?php
$state_query="select * from state";
$state_result=mysqli_query($conn,$state_query);
$row12=mysqli_fetch_array($state_result);

?>

<div class="form-group">
  <label class="col-md-4 control-label" for="txtstate">State  <span class="star">*</span></label>  
    <div class="col-md-4 inputGroupContainer">
   <div class="input-group">
  <select name="txtstate" id="txtstate" class="inputbox form-control" autocomplete="off">
  <option value="">Select</option>
<?php

while ($row12=mysqli_fetch_array($state_result)) {
	echo $row12[1];

?>

<option value="<?php echo "$row12[0]"; ?>" > 
<?php echo $row12[1] ?>
</option>

<?php } ?>
 </select>
</div>
</div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="txtemail">E-mail  <span class="star">*</span></label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <input name="txtemail" value="<?php echo $txtemail; ?>" placeholder="Email" class="form-control"  type="text" id="txtemail">
    </div>
  </div>
</div>


<!-- Text input-->
       
<div class="form-group">
  <label class="col-md-4 control-label" for="txtphone">Phone  <span class="star">*</span></label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        
  <input name="txtphone" value="<?php echo $txtphone; ?>" placeholder="(845)555-1212" class="form-control" type="text" id="txtphone" maxlength="12">
    </div>
  </div>
</div>

<!-- Text area -->

<div class="form-group">
  <label class="col-md-4 control-label" for="txtfax">Fax</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <input name="txtfax" value="<?php echo $txtfax; ?>" placeholder="Fax" class="form-control"  type="text" id="txtfax" maxlength="50">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="txtcontact">Contact Person </label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <input name="txtcontact" value="<?php echo $txtcontact; ?>" placeholder="Contact Person" class="form-control"  type="text" id="txtcontact" maxlength="50">
  </div>
  </div>
</div>
  
<div class="form-group">
  <label class="col-md-4 control-label" for="txtdesignation">Designation of Contact Person  </label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <input name="txtdesignation" value="<?php echo $txtdesignation; ?>" placeholder="Designation of Contact Person " class="form-control"  type="text" id="txtdesignation" maxlength="50">
    </div>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="txtphone">Phone of Contact Person </label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
 <input name="txtphone" value="<?php echo $txtphone; ?>" placeholder="Phone of Contact Person" class="form-control"  type="text" id="txtphone" maxlength="12">
    </div>
  </div>
</div>
  
  <div class="form-group">
  <label class="col-md-4 control-label" for="txtemailcontact">Email of Contact Person</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
 <input name="txtemailcontact" value="<?php echo $txtemailcontact; ?>" placeholder="Email of Contact Person" class="form-control"  type="text" id="txtemailcontact" maxlength="50">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="txtfaxcontact">Fax of Contact Person</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
 <input name="txtfaxcontact" value="<?php echo $txtfaxcontact ?>" placeholder="Fax of Contact Person " class="form-control"  type="text" id="txtfaxcontact" maxlength="50">
    </div>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="txttotalstrength">Total strength in department including residents </label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
 <input name="txttotalstrength" value="<?php echo $txttotalstrength; ?>" placeholder="Total strength in department including" class="form-control"  type="text" id="txttotalstrength" maxlength="50">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="txtcomputer">Number of Computers</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
 <input name="txtcomputer" value="<?php echo $txtcomputer; ?>" placeholder="Number of Computers" class="form-control"  type="text" id="txtcomputer" maxlength="50">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="txtprinter">Number of Printers</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
 <input name="txtprinter" placeholder="Number of Printers" class="form-control"  type="text" id="txtprinter" maxlength="50">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="txtfacility">Internet Facilty</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
 <input name="txtfacility" value="<?php echo $txtfacility; ?>" placeholder="Internet Facilty" class="form-control"  type="text" id="txtfacility" maxlength="50">
    </div>
  </div>
</div>

<div class="form-group">
<label class="col-md-4 control-label" for="txtfacility">Number of Printers</label>
<div class="col-md-4"><input name="radInternet" value="yes" checked="" type="radio">Yes<input name="radInternet" value="no" type="radio">No </div>
</div>

<div class="form-group">
<label class="col-md-4 control-label" for="txtfacility">Area of interest (Work / Reasearch / Training / Speciality) </label>
<div class="input_fields_wrap col-md-4">
   
<div ><input type="text" name="mytext[]" class="form-control" maxlength="50"> </div>
  
</div>

<div class="col-md-3"><button class="add_field_button btn btn-primary">Add More Fields</button>
<br>
<span class="add_field_button_span"></span>
</div>
</div>

<div class="form-group">
<label class="col-md-4 control-label" for="txtcurrent">Current activities going on </label>
<div class="input_fields_current col-md-4">
   
  <div ><input type="text" name="currentact[]" class="form-control" maxlength="50"> </div>
  
</div>
<div class="col-md-3"><button class="add_field_button1 btn btn-primary">Add More Fields</button>
<br>
<span class="add_field_button_span1"></span>
</div>
</div>

<div class="form-group">
<label class="col-md-4 control-label" for="txtexpectation">Expectation from NIHFW </label>
<div class="input_fields_expectation col-md-4">
   
<div ><input type="text" name="expectation[]" class="form-control" maxlength="50"> </div>
  
</div>
 <div class="col-md-3"><button class="add_field_button3 btn btn-primary">Add More Fields</button>
<br>
<span class="add_field_button_span12"></span>

 </div>
</div>


<div class="form-group">
<label class="col-md-4 control-label" for="txtproposed">Proposed collaborative activity (Joint workshop / Seminar /Training Programme /Research) </label>
<div class="input_fields_proposed col-md-4">
   
  <div ><input type="text" name="proposed[]" class="form-control" maxlength="50"> </div>
  
</div>
<div class="col-md-3"><button class="add_field_button4 btn btn-primary">Add More Fields</button>
<br>
<span class="add_field_button_span13"></span>
</div>
</div>


<div class="form-group">
<label class="col-md-4 control-label" for="txtvenue">Venue for above activity</label>
<div class="input_fields_venue col-md-4">
   
  <div ><input type="text" name="venue[]" class="form-control" maxlength="50"> </div>
  
</div>
<div class="col-md-3"><button class="add_field_button5 btn btn-primary">Add More Fields</button>

<br>
<span class="add_field_button_span14"></span>
</div>
</div>


<div class="form-group">
<label class="col-md-4 control-label" for="txtsuggestion">Any suggestion</label>
<div class="input_fields_suggestion col-md-4">
   
  <div ><input type="text" name="suggestion[]" class="form-control" maxlength="50"> </div>
  
</div>
<div class="col-md-3"><button class="add_field_button6 btn btn-primary">Add More Fields</button>
<br>
<span class="add_field_button_span15"></span>
</div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="code">Captcha <span class="star">*</span></label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
       <span> 
        	<img id="siimage" style="vertical-align:middle;"  src="<?php echo $HomeURL;?>/securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" alt="Captcha" /></span>
                    <div class="ref"><a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onClick="document.getElementById('siimage').src = '<?php echo $HomeURL;?>/securimage/securimage_show.php?sid=' + Math.random(); return false"><img src="<?php echo $HomeURL;?>/securimage/images/refresh_icon-big.png" alt="Reload Image"  onClick="this.blur()" /></a>

  </div>
  </div>
  <br/>

  <div class="n_text">Enter above characters being displayed in above image </div>
  <br/>
                        <div class="clear">  </div>
<div class="">
                    <span class="input-group">
					<!--<input name="confirm password" type="text" class="input_class" id="confirm password" />-->
				<input name="code" type="text" id="code" placeholder='Captcha Code' class="form-control" maxlength="6"/>
				
				</span>
					
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

<script>
$(document).ready(function() {
    var max_fields      = 9; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper 
    var add_button      = $(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $('.add_field_button_span').css('display','none');
            $(wrapper).append('<div><input type="text" class="form-control addin" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box

              if(x>8){
                $('.add_field_button_span').css('display','block');
                $('.add_field_button_span').html('<span class="star">max field 8 !<span>');
             }

        }

    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
      $('.add_field_button_span').css('display','none');
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>


<script>
$(document).ready(function() {
    var max_fields1      = 9; //maximum input boxes allowed
    var wrapper1         = $(".input_fields_current"); //Fields wrapper 
    var add_button1      = $(".add_field_button1"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button1).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields1){ //max input box allowed
          $('.add_field_button_span1').css('display','none');
            x++; //text box increment
            $(wrapper1).append('<div><input type="text" class="form-control addin" name="currentact[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box

             if(x>8){
                $('.add_field_button_span1').css('display','block');
                $('.add_field_button_span1').html('<span class="star">max field 8 !<span>');
             }
        }
    });
   
    $(wrapper1).on("click",".remove_field", function(e){ //user click on remove text
       $('.add_field_button_span1').css('display','none');
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>


<script>
$(document).ready(function() {
    var max_fields2      = 9; //maximum input boxes allowed
    var wrapper2         = $(".input_fields_expectation"); //Fields wrapper
    var add_button2      = $(".add_field_button3"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button2).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields2){ //max input box allowed

          
            x++; //text box increment
            $(wrapper2).append('<div><input type="text" class="form-control addin" name="expectation[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
            if(x>8){
                $('.add_field_button_span12').css('display','block');
                $('.add_field_button_span12').html('<span class="star">Max Field 8 !<span>');
             }
        }
    });
   
    $(wrapper2).on("click",".remove_field", function(e){ //user click on remove text
       $('.add_field_button_span12').css('display','none');
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>


<script>
$(document).ready(function() {
    var max_fields3      = 9; //maximum input boxes allowed
    var wrapper3         = $(".input_fields_proposed"); //Fields wrapper
    var add_button3      = $(".add_field_button4"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button3).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields3){ //max input box allowed
            x++; //text box increment
            $(wrapper3).append('<div><input type="text" class="form-control addin" name="proposed[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box

            if(x>8){
                $('.add_field_button_span13').css('display','block');
                $('.add_field_button_span13').html('<span class="star">Max Field 8 !<span>');
             }
        }
    });
   
    $(wrapper3).on("click",".remove_field", function(e){ //user click on remove text
      $('.add_field_button_span13').css('display','none');
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>


<script>
$(document).ready(function() {
    var max_fields5      = 9; //maximum input boxes allowed
    var wrapper5         = $(".input_fields_venue"); //Fields wrapper
    var add_button5      = $(".add_field_button5"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button5).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields5){ //max input box allowed
            x++; //text box increment
            $(wrapper5).append('<div><input type="text" class="form-control addin" name="venue[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box

             if(x>8){
                $('.add_field_button_span14').css('display','block');
                $('.add_field_button_span14').html('<span class="star">Max Field 8 !<span>');
             }
        }
    });
   
    $(wrapper5).on("click",".remove_field", function(e){ //user click on remove text
      $('.add_field_button_span14').css('display','none');
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>

<script>
$(document).ready(function() {

  $('.margintop').click(function(){

    $('#msgerror').hide('show');
  });
//
  //


    var max_fields6      = 9; //maximum input boxes allowed
    var wrapper6         = $(".input_fields_suggestion"); //Fields wrapper
    var add_button6      = $(".add_field_button6"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button6).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields6){ //max input box allowed
            x++; //text box increment
            $(wrapper6).append('<div><input type="text" class="form-control addin" name="suggestion[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box

            if(x>8){
                $('.add_field_button_span15').css('display','block');
                $('.add_field_button_span15').html('<span class="star">Max Field 8 !<span>');
             }
        }
    });
   
    $(wrapper6).on("click",".remove_field", function(e){ //user click on remove text
      $('.add_field_button_span15').css('display','none');
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>


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
