﻿<?php
require_once "../../includes/connection.php";
require_once("../../includes/config.inc.php");
require_once "../../includes/functions.inc.php";
include('../../design.php');
require_once "../../includes/functions-data.php";
 $page11=base64_decode($_GET['page']);
if($_SERVER['REQUEST_URI'])
		{
		 $url=mysqli_real_escape_string($conn,$_SERVER['REQUEST_URI']); 
		 $val=explode('/', $url);
		$url=$val['4'];
		$open=$val['3'];
		
if($mydb->checkTable_threeRow("menu_publish","m_url",$url,"approve_status",3,"language_id",2)>0){
			$contentrows=$mydb->gettable_RowsthreeColumn_where("menu_publish","m_url",$url,"approve_status",3,"language_id",2);  

		 }

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
			if($m_url=='feedback-hi.php')
			{
			header("Location:".$HomeURL."/hi/feedback.php");
			exit();
			} 
			
			if($m_url=='tender.php')
			{
			header("Location:".$HomeURL."/hi/tender.php");
			exit();
			}
			if($m_url=='vacancy.php')
			{
			header("Location:".$HomeURL."/hi/vacancy.php");
			exit();
			}
			if($m_url=='employee-corner-hi.php')
			{
			header("Location:".$HomeURL."/employee/circulars-and-notifications.php");
			exit();
			}
			if($m_url=='publication-hi.php')
			{
			header("Location:".$HomeURL."/cms/publication.php");
			exit();
			}
			if($m_url=='sitemap.php')
			{
			header("Location:".$HomeURL."/hi/sitemap.php");
			exit();
			}
			if($page_id=='31')
			{
			header("Location:".$HomeURL."/hi/daily_bulletin.php");
			exit();
			}

			if($page_id=='28')
			{
			header("Location:".$HomeURL."/hi/important_circulars.php");
			exit();
			}
			
		if($page_id=='333')
			{
			header("Location:".$HomeURL."/hi/photogallery.php");
			exit();
			}
			if($page_id!='0' && $page_id!='')
			{
			$method="mapping";
			$pgprntnams=pagebreadcrumb($page_id,0,$method,1,$page);
			$btitle=pagebreadcrumb1($page_id,0,$method,1,$page);
			}	
			$body=stripslashes(html_entity_decode($value['content']));


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
    <title>राष्ट्रीय स्वास्थ्य और परिवार कल्याण संस्थान</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $HomeURL;?>/css/bootstrap.css" rel="stylesheet">
    

    <!-- Custom CSS  -->
    <link href="<?php echo $HomeURL;?>/css/style.css" rel="stylesheet"> 
  
    <link href="<?php echo $HomeURL;?>/css/print.css" rel="stylesheet" type="text/css" media="print">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php echo $HomeURL;?>/css/responsive.css" />
    
    <link rel="stylesheet" href="<?php echo $HomeURL;?>/css/meanmenu.css" />

    <!-- Custom Fonts -->
    <link href="<?php echo $HomeURL;?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="alternate stylesheet" href="<?php echo $HomeURL;?>/css/change.css" media="screen" title="change" />

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

<script src="<?php echo $HomeURL;?>/js/modern-ticker.js" type="text/javascript"> </script>
	<script type="text/javascript">
            $(function () {
                $(".ticker1").modernTicker({
                    effect: "scroll",
                    scrollInterval: 20,
                    transitionTime: 500,
                    autoplay: true
                });
                });
				
				
</script>



	<script type="text/javascript" src="<?php echo $HomeURL;?>/js/jquery.totemticker.js"></script>
	<script type="text/javascript">
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


<!-- For Left Menu -->
<link rel="stylesheet" type="text/css" href="<?php echo $HomeURL;?>/css/leftmenu.css">
<link rel="stylesheet" type="text/css" href="<?php echo $HomeURL;?>/css/jquery.treeview.css">
<link rel="stylesheet" type="text/css" href="<?php echo $HomeURL;?>/css/ajaxtabs.css">
<script type="text/javascript" src="<?php echo $HomeURL;?>/js/jquery.treeview.js"></script>

<script type="text/javascript">
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

    <script type="text/jscript">
        jQuery(document).ready(function () {
            jQuery('.left-menu .left ').menu-class()
        });
</script></head>
<body id="fontSize">
<noscript>
<div class="nos">
<p>JavaScript must be enabled in order for you to use the Site in standard view. However, it seems JavaScript is either disabled or not supported by your browser. To use standard view, enable JavaScript by changing your browser options.</p></div>
</noscript>
	<!-- Accessbility Part Start -->
	<div class="container-fluid accebility-bg">
    	    	<?php include('../accessibility_menu.php');?>

</div>
    <!-- Accessbility Part End -->
    
    <!-- Logo Part Start -->
	<div class="container-fluid">
			<?php include('../header.php');?>
	</div>
    <!-- Logo Part Start -->
    
	<div id="main-nav" class="navigation-bg">
		<nav>
			<div class="container">
				<?php include('../navigation.php');?>	
			</div>
		</nav>
	</div>
    <!-- Menu Part End --> 

<div class="container background-white">
<div class="row">
            <div class="col-md-12">
            <ol class = "breadcrumb breadcrum-margin-top">
  <li class="first"><?php echo "<a href=".$HomeURL."/hi/ title='मुख्य पृष्ठ'>मुख्य पृष्ठ</a>"?></li>
  <?php  if($ $page!='') { ?>
		<li class = "active"><?php if($pgprntnams !="") echo $pgprntnams; ?></li>
   <?php } else  { ?>
   		<li class = "active"><?php if($pgprntnams !="") echo $pgprntnams; ?></li>
<?php }?>

</ol>
 <a onClick="javascript: window.print()" title="Print" href="javascript: void(0)"><p class="glyphicon glyphicon-print  print"></p></a>
</div>
</div>
    		</div>

    <!--Middle Part Start -->   
	<div class="container background-white">
    	<div class="row">
    	
    <div class="col-md-3 for-print">
		
            <!-- <div class="left-sidebar">
            <h3>About NIHFW</h3>
            	<ul>
					<li><a href="#" title="What is Smart City">NIHFW</a></li>
					<li><a href="#" title="Vision and Mission">Vision and Mission</a></li>
					<li><a href="#" title="Organisation Chart">Organisation Chart</a></li>
					<li><a href="#" title="Previous Directors">Previous Directors</a></li>
                    <li><a href="#" title="Governing Body">Governing Body</a></li>
						</ul>
            </div> -->
            
<div class="left-menu">
<div class="left">
<?php include("../left_inner_page_menu.php"); ?>

	
</div>
</div>
 <?php include("../left_menu.php");?>

          </div>
                
                
                
<div class="col-md-9 content-area">
                <h2 class="heading"><?php echo $page_name;?></h2>
               <?php 
			   if($page11!='') {
			   //echo $content; 

			$whereClause="m_flag_id='".$page11."' && menu_positions='3' && approve_status='3' && language_id='2' order by page_postion asc" ;
			$leftrows11=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
?>
              <ul>
			  <?php foreach($leftrows11 as $key=>$value1){
			  	?>

              <?php if($value1['doc_uplode']!='') {?>
				<li><a href="<?php echo $HomeURL;?>/upload/<?php echo $value1['doc_uplode']; ?>" title="<?php echo $value1['m_name'];?>" target="_blank"><?php echo $value1['m_name'];?></a></li>
			<?php } else if($value1['linkstatus']!='') {?>
			 <li><a href="<?php echo $value1['linkstatus'];?>" title="<?php echo $value1['m_name'];?>" target="_blank" onClick="return sitevisit();"><?php echo $value1['m_name'];?></a></li>
			<?php } else { ?>
		<li><a href="<?php echo $HomeURL;?>/hi/cms/<?php echo $value1['m_url']; ?>" title="<?php echo $value1['m_name'];?>"><?php echo $value1['m_name'];?></a></li>


              <?php } }?>
              </ul>
              
              <?php } else { ?>
<?php 
			$path='../../';
			  
			  echo type_of_extention_size_file($body,$HomeURL,$path);
?>
<?php } ?>

 </div> 

    
    </div>
    </div>        



	<!--Footer Logo -->
	<div class="container-fluid footer-logo-bg">
    
    
          <?php include('../footer_logo.php');?>	
    
	</div>
	<!--Footer Logo end -->

	<!-- Footer part -->
	<div class="container-fluid background-dark-gray">
    	 <?php include('../footer.php');?>	
    </div>
	<!-- Footer part -->     
</body>
</html>