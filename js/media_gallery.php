<?php
require_once "../includes/connection.php";
require_once("../includes/config.inc.php");
require_once "../includes/functions.inc.php";
require_once "../includes/functions-data.php";

include('../design.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="en">
<meta name="title" content="Media Gallery">
<meta name="description" content="Media Gallery">
<meta name="keyword" content="Media Gallery">

    <title>Media Gallery : Postal Life Insurance</title>

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
	 <link href="<?php echo $HomeURL;?>/css/jquery.treeview.css" rel="stylesheet">

	<link href="<?php echo $HomeURL;?>/css/lightbox.css" rel="stylesheet" type="text/css" />
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
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
    
   <script src="<?php echo $HomeURL;?>/js/script.js"></script>


     



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


   <!--This is for Date picker -->
<!--<link href="<?php echo $HomeURL;?>/css/datepicker.css" rel="stylesheet">   
<script src="<?php echo $HomeURL;?>/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "dd/mm/yyyy"
                });
				
				 $('#test1').datepicker({
                    format: "dd/mm/yyyy"
                });    
            
            });
        </script>-->
        
        


    
</head>
<body id="fontSize">

	<!-- Accessbility Part Start -->
<div class="container-fluid accebility-bg">
       <?php include("accessibility.php");?>
</div>
    <!-- Accessbility Part End -->
    
    <!-- Logo Part Start -->
	<div class="container-fluid">
				   <?php include("header.php");?>

	</div>
    <!-- Logo Part Start --> 
    
<div id="main-nav" class="navigation-bg">
<nav>
		   <?php include("navigation.php");?>

</nav>
</div>
    
       

    <!-- Menu Part End --> 
    
    
         
    		<div class="container">
            <div class="col-md-12">
            <ol class = "breadcrumb breadcrum-margin-top">
   <li><a href = "<?php echo $HomeURL;?>/index.php" title="Home">Home</a></li>
   <li class = "active">Media Gallery</li>
   

</ol>
 <a onClick="javascript: window.print()" title="Print Document" href="javascript: void(0)"><p class="glyphicon glyphicon-print pull-right"></p></a>
</div>
    		</div>
		
    
          
    <div class="container-fluid"> 
    		<div class="container">
            
        
                <div class="col-md-12">
                <h1 class="heading">Media Gallery</h1>
                
                
     
                
<div class="photo_gallery" id="photo_gallery">

 <?php
								$photo_query = "select category.c_name,category.c_id,photogallery.sortdesc,photogallery.img_uplode,photogallery.gallery_type from photogallery inner join category on category.c_id = photogallery.category_id where photogallery.approve_status='3'  and photogallery.gallery_type='1' group by photogallery.category_id limit 0,5";
								$photo_result = mysql_query($photo_query);
								$res_rows = mysql_num_rows($photo_result);

								
								
								while ($fetch_result = mysql_fetch_array($photo_result)) {
								//@extract($fetch_result);
								$newid = $fetch_result['c_id'];
								$newimg_uplode = $fetch_result['img_uplode'];
								$categoryname = $fetch_result['c_name'];
								$categoryname1=htmlspecialchars($c_name);
								$categoryid = $fetch_result['c_id'];
								$eng_pagetitle = $fetch_result['eng_pagetitle'];
								 $image_path = $HomeURL.'/upload/photogallery/media/'.$newimg_uplode;

								?>
							
								
								<div class="photo_item">
<a href="<?php echo $image_path;?>" rel="lightbox[<?php echo $categoryid ?>]" title="<?php echo $fetch_result['sortdesc'];?>"><img src="<?php echo $image_path;?>" width="209" height="138" alt="<?php echo $fetch_result['sortdesc'];?>"  border="0" title="<?php echo $fetch_result['sortdesc'];?>"/></a>
</a>
<span class="gallery-img-title"><?php echo $categoryname;?></span>
</div>
								
								
								
								
								
								
								<?php
								$photo_query1 = "select category.c_name,photogallery.sortdesc,photogallery.img_uplode from photogallery inner join 
								category on category.c_id = photogallery.category_id where photogallery.approve_status='3' and photogallery.gallery_type='1'
								and photogallery.category_id ='$newid' limit 1,30 ";

								//and img_uplode!='$newimg_uplode'

								$photo_result1 = mysql_query($photo_query1);
								$res_rows1 = mysql_num_rows($photo_result1);

								while ($fetch_result1 = mysql_fetch_array($photo_result1)) {
								//echo "ggg".$newcat=$categoryid;
								$categoryname = $fetch_result1['categoryname'];
								$categoryname1=htmlspecialchars($categoryname);
								?> 
								<div class="set">
								<a href="<?php echo $HomeURL . "/upload/photogallery/media/" . $fetch_result1['img_uplode'] ?>" 
								rel="lightbox[<?php echo $categoryid ?>]" title="<?php echo $fetch_result1['sortdesc']; ?>" alt="<?php echo $fetch_result1['sortdesc']; ?>">
								</a>
								</div> <!-- set div -->	
								<?php 
								} }
								 ?>	
								 <div class="clear"></div>
								</p>

</div>
    </div>
                 
 </div>
			<?php
	
		$sql=mysql_query(" SELECT * FROM `audit_trail` WHERE `page_name` ='Media Gallery' AND `page_category`='1' ORDER BY `audit_trail`.`page_action_date` DESC");
		$res=mysql_fetch_array($sql); ?>
		<p style="text-align: right;">Page Last Updated On : <?php
		$update1 = $res['page_action_date'];
		echo $dt = date('d-m-Y', strtotime($update1));
	?>
		</p></div>
        


<!--Footer Logo -->
	<div class="container-fluid footer-logo-bg">
       <div class="container">
         <div class="ticker1 modern-ticker mt-round mt-scroll">
               <?php include('footer_logo.php')?>
		</div>		 
    </div>
</div>
	<!--Footer Logo end -->


  <div class="container-fluid fa-border">
    <div class="container">
      <?php include("footer.php");?>
    </div>
  </div>



  <div class="container-fluid">
    <div class="container">
     <?php include("copyright.php");?>
   
    </div>
    </div>
       
        
     <script type="text/javascript">
// perform JavaScript after the document is scriptable.
$(function() {
    // setup ul.tabs to work as tabs for each div directly under div.panes
    $("ul.tabs").tabs("div.panals >div");
});
</script>


<script type="text/jscript">
jQuery(document).ready(function () {
    jQuery('#main-nav nav').meanmenu()
});
</script>
<script src="<?php echo $HomeURL;?>/js/jquery-1.7.2.min.js"></script>
<script src="<?php echo $HomeURL;?>/js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="<?php echo $HomeURL;?>/js/jquery.smooth-scroll.min.js"></script>
<script src="<?php echo $HomeURL;?>/js/lightbox.js"></script>
<script>
                jQuery(document).ready(function($) {
                    $('a').smoothScroll({
                        speed: 1000,
                        easing: 'easeInOutCubic'
                    });

                    $('.showOlderChanges').on('click', function(e){
                        $('.changelog .old').slideDown('slow');
                        $(this).fadeOut();
                        e.preventDefault();
                    })
                });

                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-2196019-1']);
                _gaq.push(['_trackPageview']);

                (function() {
                    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                })();

            </script>
     
        
</body>
</html>
