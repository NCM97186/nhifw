<?php

require_once "includes/connection.php";
require_once ("includes/config.inc.php");
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
   <li><a href = "<?php echo $HomeURL;?>" title="Home">Home</a></li>
   <li class = ""> Academics  </li>
      <li class = ""> Training Programme  </li>
   <li class = "active">Central Training Plan</li>

</ol>
 <a onclick="javascript: window.print()" title="Print" href="javascript: void(0)"><p class="glyphicon glyphicon-print  print"></p></a>
</div>
</div>
    		</div>

    <!--Middle Part Start -->   
	<div class="container background-white">
    	<div class="row">
        <div class="col-md-3 for-print">
		 <div class="left-menu">
		<div class="left">

		       <?php 



               $page=base64_decode($_GET['page']);
if($page!='') {
 ?>
 

            <?php }
            else if($position=='3') { ?>
            
    <div class="left-sidebar l1">
   <h3 data-my="<?php echo $page;?>"><?php echo $m_name;?></h3>
</div>
<?php   
            }   
            
            
            
            else if($position=='3') { ?>
            
    <div class="left-sidebar l1">
   <h3><?php echo $m_name;?></h3>
</div>

  
  


            
            
        <?php   
            
            
            }
            
            
            
            
            else {
                
                ?>
<div class="left-sidebar l2">
   <h3 data-my="<?php echo $rootid;?>" ><?php echo $m_name;?></h3>
</div>

  
  
<ul class="menu-class treeview">
    <?php 
        if($mydb->checkTable_threeRow("menu_publish","m_flag_id",$rootid,"menu_positions",1,"approve_status",3)>0){
        
            $whereClause="m_flag_id='$rootid' && menu_positions='1' && approve_status='3' && language_id='1' and m_publish_id!=67 order by page_postion asc" ;
            $leftrows=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
            //$leftrows=$mydb->gettable_RowsthreeColumn_where("menu_publish","m_flag_id",0,"menu_positions",1,"approve_status",3);
            $num=$mydb->countTableRow("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",1,"approve_status",3);
         }
?>
    <?php foreach($leftrows as $key=>$value){
             if($mydb->checkTable_threeRow("menu_publish","m_publish_id",$value['m_publish_id'],"menu_positions",1,"approve_status",3)>0){
            $leftrows1=$mydb->gettable_RowsfourColumn_where("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",1,"approve_status",3,"language_id",1);
            $num1=$mydb->countTableRow("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",1,"approve_status",3,"language_id",1);
                } 
            if($value['m_url']==$url)
            {
            $class="active";
            }
                
            $sql1 = mysqli_query($conn,"select * from menu_publish where m_flag_id='".$value['m_publish_id']."' and menu_positions='1' and language_id='1' and approve_status='3' ORDER BY page_postion ASC");
            //echo $value['m_name']."".
            $row2 = mysqli_num_rows($sql1);
                 if($row2 > 0 &&  $value['m_name'] == 'Academics'){ ?>
            <li class="has-sub collapsed expandable"><a href="#" title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a> 
            
            <?php 
            if($num1 >0) { ?>
            <ul  class="ddsubmenustyle blackwhite">
                <?php foreach($leftrows1 as $key=>$value1){ 
                if($mydb->checkTable_threeRow("menu_publish","m_publish_id",$value1['m_publish_id'],"menu_positions",1,"approve_status",3)>0){
                $leftrows3=$mydb->gettable_RowsfourColumn_where("menu_publish","m_flag_id",$value1['m_publish_id'],"menu_positions",1,"approve_status",3,"language_id",1);
                $num2=$mydb->countTableRow("menu_publish","m_flag_id",$value1['m_publish_id'],"menu_positions",1,"approve_status",3,"language_id",1);
                }
              $sql2 = mysqli_query($conn,"select * from menu_publish where m_flag_id='".$value1['m_publish_id']."' and menu_positions='1' and language_id='1' and approve_status='3' ORDER BY page_postion ASC");
              $row3 = mysqli_num_rows($sql2);
             if($row3 > 0){
                ?>
              <li   class="collapsed expandable"><a href="#" title="<?php echo $value1['m_name'];?>"><?php echo $value1['m_name'];?></a>
            <?php 
            if($num2 >0) { ?>
            <ul   class="ddsubmenustyle blackwhite">
                <?php foreach($leftrows3 as $key=>$value3){
            if($value3['doc_uplode']=='') {?>
              <li    class="collapsed expandable"><a href="<?php echo $HomeURL;?>/cms/<?php echo $value3['m_url']; ?>" title="<?php echo $value3['m_name'];?>"><?php echo $value3['m_name'];?></a></li>
            <?php } else { ?>
             <li    class="collapsed expandable"><a href="<?php echo $HomeURL;?>/upload/<?php echo $value3['doc_uplode']; ?>" title="<?php echo $value3['m_name'];?>" target="_blank"><?php echo $value3['m_name'];?></a></li>
            <?php }
             }  ?>
             </ul>
             
             <?php } ?>
             </li> <?php }
                elseif($row3 == 0 ){
        ?>
        <li><a href="<?php echo $HomeURL;?>/cms/<?php echo $value1['m_url']; ?>" title="<?php echo $value1['m_name'];?>"><?php echo $value1['m_name'];?></a></li>
        <?php    } 
                }  ?>
            </ul>
            
            <?php } ?>
            </li>
    <?php }
    elseif($row2 == 0 ){ ?>
        
        <li><a href="<?php echo $HomeURL;?>/cms/<?php echo $value['m_url']; ?>" title="<?php echo $value['m_name'];?>" class="<?php echo $value['m_url']==$url?"selected":""; ?>"><?php echo $value['m_name'];?></a></li>
<?php   }  }?>
            </ul>

 
            <?php } ?>

		</div>
		</div>
		
		<?php //include("left_menu.php");	?>
		
		</div>
<div class="col-md-9 content-area">
                <h2 class="heading">Central Training Plan List	</h2>
                <ul>
					
 
                 <?php 

$whereClause="m_type='2'  && approve_status='3' && language_id='1' order by page_postion asc" ;
			$leftrows11=$mydb->gettable_Rows_whereCluse("tbl_training_publish",$whereClause);

	//	print_r($leftrows11);
			//echo $leftrows11;
			foreach ($leftrows11 as $key => $value) {

echo '<li><a href="central-training-plan-details.php?details='.base64_encode($value['m_id']).'" target="_self" title="">'.$value['m_name'].'</a></li>';

			}
                 ?>

</ul>
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
