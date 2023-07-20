<?php
require_once "../includes/connection.php";
require_once("../includes/config.inc.php");
require_once "../includes/functions.inc.php";
require_once "../includes/functions-data.php";

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
  
    <!-- Color Theme CSS
    <link href="<?php echo $HomeURL;?>/css/hight-contrast.css" rel="stylesheet"> -->

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php echo $HomeURL;?>/css/responsive.css" />
    
    <link rel="stylesheet" href="<?php echo $HomeURL;?>/css/meanmenu.css" />

    <!-- Custom Fonts -->
    <link href="font-awesome/<?php echo $HomeURL;?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="alternate stylesheet" href="<?php echo $HomeURL;?>/css/change.css" media="screen" title="change" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?php echo $HomeURL;?>/js/html5shiv.js"></script>
        <script src="<?php echo $HomeURL;?>/js/respond.min.js"></script>
    <![endif]-->

    
        <!-- jQuery -->
    <script src="<?php echo $HomeURL;?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $HomeURL;?>/js/jquery_002.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $HomeURL;?>/js/bootstrap.min.js"></script>
    
    <!-- Menu Access for Tab Key -->
	<script src="<?php echo $HomeURL;?>/js/superfish.js"></script>
    
    <!-- font Size Increase Decrease -->
    <script src="<?php echo $HomeURL;?>/js/font-size.js"></script>
    
<script src="<?php echo $HomeURL;?>/js/swithcer.js"></script>



	<link href="<?php echo $HomeURL;?>/css/lightbox.css" rel="stylesheet" type="text/css" />






 <script src="<?php echo $HomeURL;?>/js/jquery.meanmenu.js"></script>
 <script type="text/jscript">
jQuery(document).ready(function () {
    jQuery('#main-nav nav').meanmenu()
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
   <li><a href = "<?php echo $HomeURL;?>/hi" title="मुखपृष्ठ ">मुखपृष्ठ </a></li>
   <li class = "active">फोटो गैलरी</li>
   

</ol>
 <a onClick="javascript: window.print()" title="Print" href="javascript: void(0)"><p class="glyphicon glyphicon-print  print"></p></a>
</div>
</div>
    		</div>

    <!--Middle Part Start -->   
	<div class="container background-white">
    	<div class="row">
    	
    <div class="col-md-3">
		
            <div class="left-sidebar">
            <h3>फोटो गैलरी</h3>
            	<ul>
					<li><a href="#" title="Photo Gallery">फोटो गैलरी</a></li>
					
						</ul>
            </div>
<?php include('left_menu.php');?>
 
          </div>
                
                
                
<div class="col-md-9 content-area">
                <h2 class="heading">फोटो गैलरी</h2>
<div class="photo_gallery" id="photo_gallery">

<?php
								$photo_query = "select category.c_name,category.c_id,photogallery.sortdesc,photogallery.img_uplode,photogallery.gallery_type from photogallery inner join category on category.c_id = photogallery.category_id where photogallery.approve_status='3'  and photogallery.gallery_type='1' group by photogallery.category_id limit 0,5";
								$photo_result = mysqli_query($conn,$photo_query);
								$res_rows = mysqli_num_rows($photo_result);

								
								
								while ($fetch_result = mysqli_fetch_array($photo_result)) {
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
<a href="<?php echo $image_path;?>" rel="lightbox[<?php echo $categoryid ?>]" title="<?php echo $fetch_result['sortdesc'];?>" class="photo_item_link fancybox"><img src="<?php echo $image_path;?>" width="209" height="138" alt="<?php echo $fetch_result['sortdesc'];?>"  border="0" title="<?php echo $fetch_result['sortdesc'];?>"/></a>
</a>
<br/>
<span class="gallery-img-title"><?php echo $categoryname;?></span>
</div>
								
								
								
								
								
								
								<?php
								$photo_query1 = "select category.c_name,photogallery.sortdesc,photogallery.img_uplode from photogallery inner join 
								category on category.c_id = photogallery.category_id where photogallery.approve_status='3' and photogallery.gallery_type='1'
								and photogallery.category_id ='$newid' limit 1,30 ";

								//and img_uplode!='$newimg_uplode'

								$photo_result1 = mysqli_query($conn,$photo_query1);
								$res_rows1 = mysqli_num_rows($photo_result1);

								while ($fetch_result1 = mysqli_fetch_array($photo_result1)) {
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

 <!--This is for gallery -->


<script type="text/javascript" src="<?php echo $HomeURL;?>/js/jquery1.js"></script>

<link rel="stylesheet" href="<?php echo $HomeURL;?>/css/jquery.css" type="text/css" media="screen">
<script src="<?php echo $HomeURL;?>/js/jquery-1.7.2.min.js"></script>
<script src="<?php echo $HomeURL;?>/js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="<?php echo $HomeURL;?>/js/jquery.smooth-scroll.min.js"></script>
<script src="<?php echo $HomeURL;?>/js/lightbox.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		// enable fancybox if device window is more than 550
		if (screen.width > 550) {
			$('.fancybox').fancybox({
				padding: "7",
				mouseWheel: false,
				fitToView: true
			});
		}
		
		// skip the top nav chrome if on iPhone
		if ((navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPod") != -1)) {
			 window.scrollTo(0, 1);
		}
	});
	
	
	
</script>      
</body>
</html>
