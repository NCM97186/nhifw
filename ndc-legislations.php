<?php
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


    <style type="text/css">
        .left-menu {
    background-color: #0b5196;
    overflow: hidden;
    margin: 0px auto 0px;
    height: auto;
}
.left-menu .left-sidebar {
    margin: 0px;
    padding: 0px;
    margin-top: 0px;
}
.treeview, .treeview ul {
    padding: 0;
    margin: 0;
    list-style: none;
    font-weight: bold;
}
.treeview li {
    margin: 0;

}
.treeview li a {
    color: #fff;
    text-decoration: none;
    padding: 7px 0pt 7px 18px;
    background: url(../images/pattern.png) no-repeat 7px 11px;
    border-bottom: 1px solid #a7cdf1;
    display: block;
    font-size: 90%;
    font-weight: normal;
    line-height: 21px;
}
.treeview a.selected {
    background: #6aa7e2;
}
    </style>

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
                row_height  :   '100px',
                next        :   '#ticker-next',
                previous    :   '#ticker-previous',
                stop        :   '#stop',
                start       :   '#start',
                mousestop   :   true,
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
     <li class = "">National Documentation Centre</li>
                    <li class = "active">Latest Health News </li>
                </ol>
            <a onClick="javascript: window.print()" title="Print" href="javascript: void(0)"><p class="glyphicon glyphicon-print  print"></p></a>
        </div>
    </div>
</div>

<div class="container background-white">
    <div class="row">
    <div class="col-md-3 for-print">
<div class="left-sidebar l1">
   <h3>National Documentation Centre</h3>
</div>
  
<div class="left-menu">
    <div class="left ok1">
       
             <ul class="menu-class treeview">
                  <?php 
                      $whereClause="m_flag_id='47' && menu_positions='2' && approve_status='3' && language_id='1' order by page_postion asc" ;
                      $bottomrows=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause);
                       
                      foreach($bottomrows as $key=>$value){  

                  
                        if ($value['m_url'] == 'legislations.php') {
                             $url_show = 'ndc-legislations.php';
                            $active1 = 'selected';
                        }
                        else
                        {
                            $url_show = 'cms/'.$value['m_url'];
                              $active1 = '';
                        }

                        ?>



                          <li  >
                            <a  href="<?php echo $url_show;?>" title="<?php echo $value['m_title'];?>" class="<?php echo $active1; ?>" ><?php echo $value['m_title'];?> </a>



                        </li>
                      <?php } ?>
             </ul> 
            </div>
        </div>

            <?php include("left_menu.php");?>
    </div>
    <?php
    $date=date('Y-m-d');
    if($mydb->checkTableRow("ndc_legislations_publish")>0){
    $whereClause="approve_status='3' && language_id='1' && date(end_date ) >= '$date'  order by start_date desc" ;
    //$whereClause="approve_status='3' && language_id='1'   order by start_date desc" ;
   $newsrows=$mydb->gettable_Rows_whereCluse("ndc_legislations_publish",$whereClause); 
   if(is_array($newsrows)){
                      $no_of_rows= count($newsrows);
                     }else{
                      $no_of_rows= $newsrows;
                    }
 }
 ?>
<div class="col-md-9 content-area">
                <h2 class="heading">Legislations Publish</h2>
                
 <table width="100%"  class="table table-bordered">
<caption> Legislations Publish </caption>
        <tbody>
            <tr>
                <th>
                    Sr.</th>
                <th>
                    Title</th>
                <th>
                    Publish Date</th>
            </tr>
             <?php $i=1;
          if($no_of_rows > 0){
         
         foreach($newsrows as $key=>$value){ 
              $docspath = $HomeURL.'/upload/ndc/'.$value['docs_file'];
               $file='upload/ndc/'.$value['docs_file'];
            ?>
            <tr>
                <td class="odd">
                    <?php echo $i;?></td>
                <td>
                     <?php if($value['docs_file']!='') { ?>
               <a href="<?php echo $docspath; ?>" title="<?php echo $value['m_name'];?>" target="_blank"><?php echo $value['m_name'];?>  &nbsp;&nbsp;<img src="<?php echo $HomeURL; ?>/images/pdf_icon.png" height="16" alt="PDF file" /> </a><?php echo ' size:( '.formatFilebytes($file,'MB'). ')'; ?>
               <?php }
                else if($value['ext_url']!='') { ?>
               <a href="<?php echo $value['ext_url']; ?>" title="<?php echo $value['m_name'];?>" target="_blank"><?php echo $value['m_name'];?>  &nbsp;&nbsp;<img src="<?php echo $HomeURL; ?>/images/extlink.png" height="16" alt="External Link" /> </a>
               <?php } else { ?>
               <a href="<?php echo $HomeURL;?>/content/news/<?php echo $value['page_url']; ?>" title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a>
               <?php } ?></td>
                <td>
                    <?php echo date('d-m-Y', strtotime($value['start_date']));?></span></td>
            </tr>
            <?php $i++; } } else { ?>
            <tr><td colspan="6" >No record found</td></tr>
            <?php } ?>
        </tbody>
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
