<?php
 //phpinfo();
require_once "includes/connection.php";
require_once("includes/config.inc.php");
require_once "includes/functions-front.inc.php";
require_once "includes/function-front.php";
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
<link href="<?php echo $HomeURL;?>/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo $HomeURL;?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $HomeURL;?>/css/style.css" rel="stylesheet">
<link href="<?php echo $HomeURL;?>/css/print-home.css" rel="stylesheet" type="text/css" media="print">
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
<noscript>
<link rel="stylesheet" href="<?php echo $HomeURL;?>/css/jsoff.css" />
</noscript>
<!-- jQuery -->
<script src="<?php echo $HomeURL;?>/js/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo $HomeURL;?>/js/bootstrap.min.js"></script>
<!-- Menu Access for Tab Key -->
<script src="<?php echo $HomeURL;?>/js/superfish.js"></script>
<!-- font Size Increase Decrease -->
<script src="<?php echo $HomeURL;?>/js/font-size.js"></script>
<script src="<?php echo $HomeURL;?>/js/swithcer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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

</head>
<body id="fontSize">
<noscript>
<div class="nos">
  <p>JavaScript must be enabled in order for you to use the Site in standard view. However, it seems JavaScript is either disabled or not supported by your browser. To use standard view, enable JavaScript by changing your browser options.</p>
</div>
</noscript>
<!-- Accessability Part Start -->
<div class="container-fluid accebility-bg">
  <?php include('accessibility_menu.php');?>
</div>
<!-- Accessability Part End -->
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
<div class="container-fluid">
  <div class="row"> 
    <!-- Carousel -->
    <?php include('slider.php');?>
  </div>
</div>
<!--Carousel End --> 

    <!--Middle Part Start --> 
    
  <div class="container-fluid">    
	<div class="container background-white">
    	<div class="row">
        
        <!--Director message -->
            <div class="col-md-4">
            	
            
            	
                <?php include('message.php');?>	
                
                
			</div>
          
        
        <!--What's New -->
    	<div class="col-md-5">          
     	<?php
  $date=date('Y-m-d');
  if($mydb->checkTableRow("whatsnew_publish")>0){
$whereClause="approve_status='3' && language_id='1'   order by start_date desc" ;
   $newsrows=$mydb->gettable_Rows_whereCluse("whatsnew_publish",$whereClause); 
   if(is_array($newsrows)){
					  $no_of_rows= count($newsrows);
					 }else{
					  $no_of_rows= $newsrows;
					}
 }
 ?>
	<h2 class="heading-whats-new">नया क्या है</h2>
     	<div class="play-pause-control-m">
            <p class="n-play-pause">
                <a href="#" id="ticker-previous" title="Previous"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i></a>
                <a href="#" id="ticker-next" title="Next"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i></a>
                <a id="stop" href="#" title="Stop"><i class="fa fa-stop" aria-hidden="true"></i></a>
                <a id="start" href="#" title="Play"><i class="fa fa-play" aria-hidden="true"></i></a>
            </p>
		</div>
		<div class="whats-new">
            <ul id="vertical-ticker">

           <?php 
		  if($no_of_rows > 0){
		 
		 foreach($newsrows as $key=>$value){ 
			  $docspath = $HomeURL.'/upload/whatsnew/'.$value['docs_file'];
			  $file='../upload/whatsnew/'.$value['docs_file'];
			?>
		  <li>
		  <?php if($value['docs_file']!='') { ?>
			   <a href="<?php echo $docspath; ?>" title="<?php echo $value['m_name'];?>" target="_blank"><?php echo $value['m_name'];?>  &nbsp;&nbsp;<img src="<?php echo $HomeURL; ?>/images/pdf_icon.png" height="16" alt="PDF file" /> </a><?php echo ' size:( '.formatFilebytes($file,'MB'). ')'; ?>
			   <?php }
				else if($value['ext_url']!='') { ?>
			   <a href="<?php echo $value['ext_url']; ?>" title="<?php echo $value['m_name'];?>" target="_blank"><?php echo $value['m_name'];?>  &nbsp;&nbsp;<img src="<?php echo $HomeURL; ?>/images/extlink.png" height="16" alt="PDF file" /> </a>
			   <?php } else { ?>
			   <a href="<?php echo $HomeURL;?>/hi/news/<?php echo $value['page_url']; ?>" title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a>
			   <?php } ?>
          <span><?php echo date('d-m-Y', strtotime($value['start_date']));?></span></li>
		  <?php }
		 } else { ?>
		   <li>कोई रिकॉर्ड नहीं मिला</li>
		  
		  <?php } ?>
		</ul>


		<div class="v-all"><a href="<?php echo $HomeURL;?>/hi/viewall_whatsnew.php" title="सभी देखें नया क्या है">सभी देखें</a></div>
        </div>
        </div>
    
    <!--Photo Gallery -->
    <div class="col-md-3">
    <h2 class="heading-whats-new">परियोजनाएं</h2>
    
    <?php include('projects.php');?>
    </div>
    <!--End Gallery -->
    
    </div>
    </div>
    </div>        

    <div class="container-fluid footer-icons">
    	<div class="row">
        	<div class="container">
            
	<?php 

	$whereClause="m_flag_id='0' && menu_positions='2' && approve_status='3' && language_id='2'  order by page_postion asc" ;
			$bottomrows=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
			 foreach($bottomrows as $key=>$value){ 
$image_path = $HomeURL.'/upload/bottom_image/'.$value['upload_img'];
$title=$value['m_name'];
 $page=$value['m_id'];
 ?>
                <div class="buttons-b">
                  <img src="<?php echo $image_path;?>" alt="<?php echo $title;?>" title="<?php echo $title;?>" class="center-block" width="57px" height="47px">
                  <h3>
				  <?php if($page=='40') {?>
				  <a href="<?php echo $HomeURL;?>/hi/dlc/health--and-family-welfare-management-course.php" target="_self" title="<?php echo $title;?>"><?php echo $title;?></a>
				  <?php }
				  else if($page=='44') {?>
				  <a href="<?php echo $HomeURL;?>/hi/student/enrolled.php" target="_self" title="<?php echo $title;?>"><?php echo $title;?></a>
				  <?php }
				   else if($page=='47') {?>
				 <a href="<?php echo $HomeURL.'/hi/cms/ndc-home.php';?>" target="_self" title="<?php echo $title;?>"><?php echo $title;?></a>
				  <?php }
				    
				   else { ?>
				  	<a href="<?php echo $HomeURL.'/hi/cms/'.$value['m_url'];?>" target="_self" title="<?php echo $title;?>"><?php echo $title;?></a>

				  <?php } ?>
				  </h3>
                </div>
           <?php } ?> 
           
                
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
