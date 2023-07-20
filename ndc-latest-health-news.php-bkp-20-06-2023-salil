<?php
require_once "includes/connection.php";
require_once("includes/config.inc.php");
require_once "includes/functions-front.inc.php";
require_once "includes/function-front.php";

include('../design.php');
include('../counter.php');

$url = strtolower(content_desc(htmlspecialchars($_SERVER['REQUEST_URI'])));
	 if(strstr($url,'script')!=FALSE)
	 {
	      $url=  str_replace(".php/",".php",content_desc(strtolower(htmlspecialchars($_SERVER['REQUEST_URI']))));
		 header("location:".$url); exit;
	 }
$_GET['page']=content_desc($_GET['page']);
 

if($_SERVER['REQUEST_URI'])
		{
		 $url=mysqli_real_escape_string($conn,$_SERVER['REQUEST_URI']); 
		 $val=explode('/', $url);
		//$url=$val['4'];
		$open=$val['3'];
		if( $_GET['page']!='') {
			$url=$_GET['page'];
		}
		else {
			$url=$val['4'];
		}
		
if($mydb->checkTable_threeRow("importent_information_publish","page_url",$url,"approve_status",3,"language_id",1)>0){
			$contentrows=$mydb->gettable_RowsthreeColumn_where("importent_information_publish","page_url",$url,"approve_status",3,"language_id",1);  

		 }

foreach($contentrows as $key=>$value){ 
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
	<link rel="stylesheet" href="<?php echo $HomeURL;?>/css/jquery.treeview.css" />
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
   <li class = ""><a href="view-all.php?menu=Important Information">Important Information</a> </li>
   <li class = "active">Daily Health News Bulletin</li>
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
        
        
        <div class="col-md-3 for-print">

		 <div class="left-menu">
		<div class="left">
		
		<?php include("left_outer_page_menu.php");?>
			
		</div>
		</div>

		<?php include("left_menu.php");?>
		 
		</div>
          
          
 
<div class="col-md-9 content-area">
                <h2 class="heading"> <?php if($_GET['page']!='') { ?> 
					<?php echo $page_name;?>
				 <?php }  else { ?>
				Daily Health News Bulletin
				<?php } ?></h2>
          <?php if($_GET['page']=='') { ?>           
           
  <table  class="table table-bordered">
			   <tr>
			   <th>Sl.No.</th>
			   <th>Title</th>
			   <th>Publish Date</th>
			   <th>Last Date</th>
			   </tr>
			    <?php if($mydb->checkTableRow("importent_information_publish")>0){
					$i=1;
					$date=date('Y-m-d');
				$whereClause="approve_status='3' && language_id='1' && cat_id='2' && date(end_date ) >= '$date'  order by start_date desc" ;
					$newsrows=$mydb->gettable_Rows_whereCluse("importent_information_publish",$whereClause); 
					if(is_array($newsrows)){
					  $no_of_rows= count($newsrows);
					 }else{
					  $no_of_rows= $newsrows;
					}
				}
				?>
				 <?php 
				 if($no_of_rows > 0){
				 foreach($newsrows as $key=>$value){ 
					 $docspath = $HomeURL.'/upload/importent/'.$value['docs_file'];
					 $file='upload/importent/'.$value['docs_file'];
				?>
			   <tr>
			   <td><?php echo $i;?></td>
			   <td>
			   <?php if($value['docs_file']!='') { ?>
			   <a href="<?php echo $docspath; ?>" title="<?php echo $value['m_name'];?>" target="_blank"><?php echo $value['m_name'];?>  &nbsp;&nbsp;<img src="<?php echo $HomeURL; ?>/images/pdf_icon.png" height="16" alt="PDF file" /> </a><?php echo ' size:( '.formatFilebytes($file,'MB'). ')'; ?>
			   <?php }
				else if($value['ext_url']!='') { ?>
			   <a href="<?php echo $value['ext_url']; ?>" title="<?php echo $value['m_name'];?>" target="_blank"><?php echo $value['m_name'];?>  &nbsp;&nbsp;<img src="<?php echo $HomeURL; ?>/images/extlink.png" height="16" alt="PDF file" /> </a>
			   <?php } else { ?>
			   <a href="<?php echo $HomeURL;?>/important_information/<?php echo $value['page_url']; ?>" title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a>
			   <?php } ?>
			   </td>
			   <td><?php echo date("d-m-Y", strtotime($value['start_date']));?></td>
			   <td><?php echo date("d-m-Y", strtotime($value['end_date']));?></td>
			   </tr>
			  <?php $i++; } } else { ?>
			   <tr><td   >No record found</td></tr>
			   <?php } ?>
			   </table>
                <?php } else { 
					
					echo $body; }
					?>         
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
