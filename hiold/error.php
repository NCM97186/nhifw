<?php
require_once "includes/connection.php";
require_once("includes/config.inc.php");
require_once "includes/functions.inc.php";
require_once "includes/functions-data.php";

include('../design.php');
include('../counter.php');


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
	


</head>

<body id="fontSize">

	
    
    <!-- Logo Part Start -->
	<div class="container-fluid">
		<?php include('header.php');?>
	</div>
    <!-- Logo Part Start -->
    

    <!-- Menu Part End --> 



          
 
<div class="col-md-12 content-area">

<div id="errorpage">
<h2></h2>
			<div>&nbsp;</div>
			              <p>  <h2 class="heading">Sorry! Error 404 - Page Not Found</h2></p>

				<p>The page you are attempting to access cannot be found. It may have been moved / renamed or may no longer exist.
				We have recently redesigned our website to make it easier and faster for you to find the information you need. This means the bookmarks and addresses you have used in the past may no longer work.</p>
				<p>To find the information you are looking for please try one of the following.</p>
				<p>&nbsp;</p>
				<ol type="a">
					 <li>If you typed the page URL, check the spelling.</li>
					 <li> Go to our <a href="<?php echo $HomeURL.'/'; ?>"> <strong>Home</strong> </a> page and browse through our topics for the information you want.</li>
					  <li> Go to our <a href="#" onClick="history.go(-1);return false;"> <strong>Previous</strong> </a> page and browse through our topics for the information you want.</li>
				</ol> 
				 
	

 </div>


                
 </div> 

    
    </div>
    </div>        



	


</body>
</html>
