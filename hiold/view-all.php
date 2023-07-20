<?php
require_once "includes/connection.php";
require_once("includes/config.inc.php");
require_once "includes/functions.inc.php";
require_once "includes/functions-data.php";

include('../design.php');
include('../counter.php');


	$url = strtolower(content_desc(htmlspecialchars($_SERVER['REQUEST_URI'])));

	if(strstr($url,'script')!=FALSE)
	{
		$url=  str_replace(".php/",".php",content_desc(strtolower(htmlspecialchars($_SERVER['REQUEST_URI']))));
		header("location:".$url); exit;
	}
 
	$mainmenu = content_desc($_GET['menu']);
 
	if($mainmenu != 'ContactUs'){
		
		$mp = 3;
		$whereClause = "m_flag_id='0' && menu_positions='3' && approve_status='3' && language_id='2' and m_publish_id!='19' and m_name = '$mainmenu' " ;
		
	}else{
	
		$mp = 1;
		$whereClause = "m_flag_id='0' && menu_positions='1' && approve_status='3' && language_id='2' and m_publish_id='7' order by page_postion asc limit 0,1" ;
	
	}
	
	$supermenu 	 = $mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
	
	$whereClauseSub 	= "m_flag_id='".$supermenu[0]['m_publish_id']."' && menu_positions='$mp' && approve_status='3' && language_id='2' order by page_postion asc " ;
	$submenu 				= $mydb->gettable_Rows_whereCluse("menu_publish", $whereClauseSub); 
	$countSubMenu 		= $mydb->countTableRowWhereClause("menu_publish", $whereClauseSub);
	
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
   <li><a href = "<?php echo $HomeURL;?>/hi/content" title="मुख्य पृष्ठ">मुख्य पृष्ठ</a></li>
   <li class = "active"><a href="<?php echo $url;?>" title="<?php echo $mainmenu; ?>"><?php echo $mainmenu; ?></a></li>
    <?php if($_GET['page']!='') { ?> 
	   <li class = "active"><?php echo $page_name;?></li>

	 <?php } ?>
   

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
				<h3><?php echo $mainmenu; ?></h3>
            </div>
			<?php include("left_menu.php");?>
		</div>
          
		<div class="col-md-9 content-area" style="margin-top: 10px;">
			<table  class="table table-bordered">
				<?php if($countSubMenu > 0){ ?>
					<?php foreach($submenu as $sub){  ?>
						<tr>
							<td>
								<?php  if($sub['doc_uplode'] != '') { ?>
									<a href="<?php echo $HomeURL;?>/upload/<?php echo $sub['doc_uplode']; ?>" target="_blank"><?php echo $sub['m_name']; ?></a>
								<?php } else if($sub['linkstatus'] != '') { ?>
									<a href="<?php echo $sub['linkstatus']; ?>" target="_blank"><?php echo $sub['m_name']; ?></a>
								<?php } else { ?>
									<a href="<?php echo $HomeURL;?>/cms/<?php echo $sub['m_url']; ?>"><?php echo $sub['m_name']; ?></a>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				<?php }else{ ?>
					<tr>
						<td>No record founds</td>
					</tr>
				<?php } ?>
			</table>
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
