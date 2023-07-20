<?php


require_once "../includes/connection.php";
require_once("../includes/config.inc.php");
require_once "../includes/functions.inc.php";
include('../../design.php');
require_once "../includes/functions-data.php";

$page11=base64_decode($_GET['page']);


if($_SERVER['REQUEST_URI'])
		{
		
		$url=mysql_real_escape_string($_SERVER['REQUEST_URI']); 
		$val=explode('/', $url);
		$url=$val['3'];
		$open=$val['2'];
		
if($mydb->checkTable_threeRow("menu_publish","m_url",$url,"approve_status",3,"language_id",1)>0){
			$contentrows=$mydb->gettable_RowsthreeColumn_where("menu_publish","m_url",$url,"approve_status",3,"language_id",1);  
		 }

foreach($contentrows as $key=>$value){ 
  		  
        $page_id=$value['m_publish_id'];
        $m_description=$value['m_description'];
        $page_name=$value['m_name'];
  			$position=$value['menu_positions'];
  			$rootid=get_root_parent($page_id);
  			$parentid=parentid($page_id);
  			$m_name=get_page($page_id);
  		  $m_url=$value['m_url'];
  			$sub_flag_id=$value['m_id'];
  			$title=$value['m_name'];
  			$page='content';
         
        if($m_url=='upload-information.php')
        {
        
        header("Location:".$HomeURL."/online_submission.php");
        exit();
        
        } 


        if($m_url=='health-news-repository.php')
        {

          header("Location:".$HomeURL."/ndc-health-news-repository.php");
          exit();

        }

        if($m_url=='current-awareness-service-of-journals.php')
        {

          header("Location:".$HomeURL."/ndc-current-awareness-service-of-journals.php");
          exit();

        }

        if($m_url=='training-courses.php')
        {

          header("Location:".$HomeURL."/ndc-training-courses.php");
          exit();

        }

        //legislations.php
        if($m_url=='legislations.php')
        {
          header("Location:".$HomeURL."/ndc-legislations.php");
          exit();
        }

        if($m_url=='health-and-family-welfare-abstract.php')
        {
          header("Location:".$HomeURL."/ndc-health-and-family-welfare-abstract.php");
          exit();
        }

        



  			if($m_url=='feedback.php')
  			{
  			header("Location:".$HomeURL."/feedback.php");
  			exit();
  			} 
  			
            if($m_url=='archive.php')
        {
        header("Location:".$HomeURL."/archive.php");
        exit();
        } 
       

  			if($m_url=='tender.php')
  			{
  			header("Location:".$HomeURL."/tender.php");
  			exit();
  			}

  			if($m_url=='latest-health-news.php')
  			{

  				header("Location:".$HomeURL."/ndc-latest-health-news.php");
  				exit();

  			}

  			if($m_url=='vacancy.php')
  			{
  			header("Location:".$HomeURL."/vacancy.php");
  			exit();
  			}
  			if($m_url=='employee-corner.php')
  			{
  			header("Location:".$HomeURL."/employee/circulars-and-notifications.php");
  			exit();
  			}
  			if($m_url=='sitemap.php')
  			{
  			header("Location:".$HomeURL."/sitemap.php");
  			exit();
  			}
  			if($page_id=='31')
  			{
  			header("Location:".$HomeURL."/daily-health-news-bulletin.php");
  			exit();
  			}
  			
  			if($page_id=='332')
  			{
    			header("Location:".$HomeURL."/photogallery.php");
    			exit();
  			}

  			if($page_id=='28')
  			{
    			header("Location:".$HomeURL."/important-circulars.php");
    			exit();
        }
  			
  			if($page_id=='50')
  			{
    			header("Location:".$HomeURL."/cms/journal.php");
    			exit();
  			}

        if($page_id=='347')
        {

          header("Location:".$HomeURL."/central-training-plan-List.php");
          exit();

        }

        if($page_id=='384')
        {

          header("Location:".$HomeURL."/online_submission.php");
          exit();

        }


      // -------------------------------


if($page_id=='47' || $page_id=='336')
			{
			header("Location:".$HomeURL."/cms/ndc-home.php");
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


    $query = mysql_query("select page_action_date as lastupdate from audit_trail where page_id=$page_id ORDER BY audit_id DESC LIMIT 0, 1");
            if(mysql_num_rows($query) > 0)
            {
                $row = mysql_fetch_assoc($query);
                $pageLastUpdate = $row['lastupdate'];
            } else
            {
                $pageLastUpdate = false;
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
  
    <link href="<?php echo $HomeURL;?>/css/print.css" rel="stylesheet"  media="print">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php echo $HomeURL;?>/css/responsive.css" />
    
    <link rel="stylesheet" href="<?php echo $HomeURL;?>/css/meanmenu.css" />

    <!-- Custom Fonts -->
    <link href="font-awesome/<?php echo $HomeURL;?>/css/font-awesome.min.css" rel="stylesheet" >
    <link rel="alternate stylesheet" href="<?php echo $HomeURL;?>/css/change.css" media="screen" title="change" />

<style type="text/css">
  .pagination {
    display: inline-block;
    padding-left: 0;
    margin: 20px 0;
    border-radius: 4px;
    min-width:500px;
        float: right;
}
.pagination>li {
    display: inline !important;
    background: #fff !important;
}

.pagination>li>.Active {
         background-color: #055193;
    color: #fff;
}
 
</style>
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


<!-- For Left Menu -->
<link rel="stylesheet"  href="<?php echo $HomeURL;?>/css/leftmenu.css">
<link rel="stylesheet"  href="<?php echo $HomeURL;?>/css/jquery.treeview.css">
<link rel="stylesheet"  href="<?php echo $HomeURL;?>/css/ajaxtabs.css">
<script  src="<?php echo $HomeURL;?>/js/jquery.treeview.js"></script>

<script>
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

 var zxcMarquee={
 init:function(o){
  var mde=o.Mode,mde=typeof(mde)=='string'&&mde.charAt(0).toUpperCase()=='H'?['left','offsetWidth','top','width']:['top','offsetHeight','left','height'],id=o.ID,srt=o.StartDelay,ud=o.StartDirection,p=document.getElementById(id),obj=p.getElementsByTagName('DIV')[0],sz=obj[mde[1]],clone,nu=Math.ceil(p[mde[1]]/sz)+1,z0=1;
  p.style.overflow='hidden';
  obj.style.position='absolute';
  obj.style[mde[0]]='0px';
  obj.style[mde[3]]=sz+'px';
  for (;z0<nu;z0++){
   clone=obj.cloneNode(true);
   clone.style[mde[0]]=sz*z0+'px';
   clone.style[mde[2]]='0px';
   obj.appendChild(clone);
  }
  o=this['zxc'+id]={
   obj:obj,
   mde:mde[0],
   sz:sz*(z0-1)
  }
  if (typeof(srt)=='number'){
   o.dly=setTimeout(function(){ zxcMarquee.scroll(id,typeof(ud)=='number'?ud:-1); },srt);
  }
  else {
   this.scroll(id,0)
  }
 },

 scroll:function(id,ud){
  var oop=this,o=this['zxc'+id],p;
  if (o){
   ud=typeof(ud)=='number'?ud:0;
   clearTimeout(o.dly);
   p=parseInt(o.obj.style[o.mde])+ud;
   if ((ud>0&&p>0)||(ud<0&&p<-o.sz)){
    p+=o.sz*(ud>0?-1:1);
   }
   o.obj.style[o.mde]=p+'px';
   o.dly=setTimeout(function(){ oop.scroll(id,ud); },50);
  }
 }

}
	
	</script>
<script >
    $(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');
});
</script>
<script  >
       $(function () {
            $('#scrollToBottom').bind("click", function () {
               $('html, body').animate({ scrollTop: $(document).height() }, 1200);
                return false;
            });
         
        });
		
    </script>
    <script >
        jQuery(document).ready(function () {
            jQuery('.left-menu .left ').menu-class()
        });
</script>

<style type="text/css">
 /* .treeview .hitarea
  {
    background:url(../images/treeview-default1.gif) -64px -25px no-repeat!important; 
  }*/
</style>
</head>
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
	
	<?php  
	$bcName = explode("/", $pgprntnams);
	$bcLink    = '';
	$bcfName   = str_replace("</a>", "", (str_replace("<a> ", "", $bcName[0])));
	//$bcfName   = str_replace("</a>", "", $bcfName);
	$bclName   = str_replace("a>", "", $bcName[2]);

	if (strpos($pgprntnams, 'Important Information') !== false) {
		$bcLink    = '<a href="../view-all.php?menu=Important Information">'.$bcfName.'</a> /  '.$bclName;
	}
	if (strpos($pgprntnams, 'More') !== false) {
		$bcLink    = '<a href="../view-all.php?menu=More">'.$bcfName.'</a> /  '.$bclName;
	}
	if (strpos($pgprntnams, 'Contact Us') !== false) {
		$bcLink    = '<a href="../view-all.php?menu=Contact Us">'.$bcfName.'</a> /  '.$bclName;
	}
	?>

<div class="container background-white">
<div class="row">
      <div class="col-md-12">
            <ol class = "breadcrumb breadcrum-margin-top">
  <li class="first"><?php echo "<a href=".$HomeURL."/>Home</a>"?></li>
  <?php  if($ $page!='') { ?>
		<li class = "active f">
		 
    <?php if($pgprntnams !=""){ echo $pgprntnams; }?>
		</li>
   <?php } else  { ?>
   		<li class = "active s"><?php    if($pgprntnams !=""){ echo $bcLink == '' ? $pgprntnams : $bcLink;  } ?></li>
<?php }?>

</ol>
 <a onClick="javascript: window.print()" title="Print" href="javascript: void(0)"><p class="glyphicon glyphicon-print  print"></p></a>
      </div>
    </div>
</div>

<!-- <div align="right" class="backtop">
<a id="scrollToBottom" href="#" role="button"  class="btn btn-danger btn-lg back-to-top" title="Top to Bottom" data-toggle="tooltip" data-placement="bottom">
<span class="glyphicon glyphicon-chevron-down"> Top to Bottom</span>
</a>
</div>-->
    <!--Middle Part Start -->   
	<div class="container background-white"  >
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
<div class="left ok1">
  <?php $page=base64_decode($_GET['page']);
if($page!='') {
 ?>
<!--<ul class="menu-class treeview">

  <?php 
      $whereClause="m_flag_id='".$page."' && menu_positions='3' && approve_status='3' && language_id='1' order by page_postion asc" ;
      $bottomrows=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
     foreach($bottomrows as $key=>$value){  ?>
      <li class="has-sub collapsed expandable"><a href="#" title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a></li>
      <?php } ?>
      </ul>-->
      <?php //include('left_menu.php');?>

      <?php }
      else if($position=='3') { ?>
      
  <div class="left-sidebar l1">
   <h3 data-my="<?php echo $page;?>"><?php echo $m_name;?></h3>
</div>

  
  
<ul class="menu-class treeview" data-my="<?php echo $page;?>"  data-my='ok' >
  <?php 
    if($mydb->checkTable_threeRow("menu_publish","m_flag_id",$rootid,"menu_positions",3,"approve_status",3)>0){
    
      $whereClause="m_flag_id='$rootid' && menu_positions='3' && approve_status='3' && language_id='1'  order by page_postion asc" ;
      $leftrows=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
      //$leftrows=$mydb->gettable_RowsthreeColumn_where("menu_publish","m_flag_id",0,"menu_positions",1,"approve_status",3);
      $num=$mydb->countTableRow("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",1,"approve_status",3);
     }
?>
  <?php foreach($leftrows as $key=>$value){
       if($mydb->checkTable_threeRow("menu_publish","m_publish_id",$value['m_publish_id'],"menu_positions",3,"approve_status",3)>0){
      $leftrows1=$mydb->gettable_RowsfourColumn_where("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",3,"approve_status",3,"language_id",1);
      $num1=$mydb->countTableRow("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",3,"approve_status",3,"language_id",1);
        } 
      if($value['m_url']==$url)
      {
      $class="active";
      }
        
      $sql1 = mysql_query("select * from menu_publish where m_flag_id='".$value['m_publish_id']."' and menu_positions='3' and language_id='1' and approve_status='3' ORDER BY page_postion ASC");
      //echo $value['m_name']."".
      $row2 = mysql_num_rows($sql1);

       if($row2 > 0){


        if ($value['m_url'] == 'important-circulars.php') {


        ?>  
        <li class="ook">
        <a href="<?php echo $HomeURL;?>/cms/<?php echo $value['m_url']; ?>"  title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a> </li> 

        <?php
          }elseif ($value['m_url'] == 'daily-health-news-bulletin.php') {
            ?> 
 <li class="ook">
        <a href="<?php echo $HomeURL;?>/cms/<?php echo $value['m_url']; ?>"  title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a> </li>
            <?php
          }
          else
          {
 
          ?>
 
      <li class="has-sub collapsed expandable">
        <a href="<?php echo $HomeURL;?>/cms/<?php echo $value['m_url']; ?>"  title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a>
      <?php 
      if($num1 >0) { ?>
      <ul  class="ddsubmenustyle blackwhite" style="display: none;">
        <?php foreach($leftrows1 as $key=>$value1){ 
        if($mydb->checkTable_threeRow("menu_publish","m_publish_id",$value1['m_publish_id'],"menu_positions",3,"approve_status",3)>0){
        $leftrows3=$mydb->gettable_RowsfourColumn_where("menu_publish","m_flag_id",$value1['m_publish_id'],"menu_positions",3,"approve_status",3,"language_id",1);
        $num2=$mydb->countTableRow("menu_publish","m_flag_id",$value1['m_publish_id'],"menu_positions",3,"approve_status",3,"language_id",1);
        }
        $sql2 = mysql_query("select * from menu_publish where m_flag_id='".$value1['m_publish_id']."' and menu_positions='3' and language_id='1' and approve_status='3' ORDER BY page_postion ASC");
        $row3 = mysql_num_rows($sql2);
       if($row3 > 0){
        ?>
        <li class="collapsed expandable"><a href="javascript:void(0);" title="<?php echo $value1['m_name'];?>"><?php echo $value1['m_name'];?> </a>
      <?php 
      if($num2 >0) { ?>
      <ul   class="ddsubmenustyle blackwhite" style="display: none;">
        <?php foreach($leftrows3 as $key=>$value3){
      if($value3['doc_uplode']=='') {?>
        <li    class="collapsed expandable"><a href="<?php echo $HomeURL;?>/cms/<?php echo $value3['m_url']; ?>" title="<?php echo $value3['m_name'];?>"><?php echo $value3['m_name'];?></a></li>
      <?php } else { ?>
       <li    class="collapsed expandable"><a href="<?php echo $HomeURL;?>/upload/<?php echo $value3['doc_uplode']; ?>" title="<?php echo $value3['m_name'];?>" target="_blank"><?php echo $value3['m_name'];?> </a></li>
      <?php }
       }  ?>
       </ul>
       
       <?php } ?>
       </li> <?php }
        elseif($row3 == 0 ){
    ?>
<!--     <li  ><a href="<?php echo $HomeURL;?>/cms/<?php echo $value1['m_url']; ?>" title="<?php echo $value1['m_name'];?>"><?php echo $value1['m_name'];?>hello</a></li> -->
    <?php  } 
        }  ?>
      </ul>
      <?php }  }?>
      </li>
   
  <?php }
  elseif($row2 == 0 ){ ?>
    
    <li><a href="<?php echo $HomeURL;?>/cms/<?php echo $value['m_url']; ?>" title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a></li>
<?php }  }?>
      </ul> 
    <?php    
      }  
      else if($position=='2') { ?>
      
  <div class="left-sidebar l1">
   <h3><?php echo $m_name;?></h3>
</div>

  
  
<ul class="menu-class treeview" data-my='ok1'>
  <?php 
    if($mydb->checkTable_threeRow("menu_publish","m_flag_id",$rootid,"menu_positions",2,"approve_status",3)>0){
    
      $whereClause="m_flag_id='$rootid' && menu_positions='2' && approve_status='3' && language_id='1'  order by page_postion asc" ;
      $leftrows=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
      //$leftrows=$mydb->gettable_RowsthreeColumn_where("menu_publish","m_flag_id",0,"menu_positions",1,"approve_status",3);
      $num=$mydb->countTableRow("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",2,"approve_status",3);
     }
?>
  <?php foreach($leftrows as $key=>$value){
       if($mydb->checkTable_threeRow("menu_publish","m_publish_id",$value['m_publish_id'],"menu_positions",2,"approve_status",3)>0){
      $leftrows1=$mydb->gettable_RowsfourColumn_where("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",2,"approve_status",3,"language_id",1);
      $num1=$mydb->countTableRow("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",2,"approve_status",3,"language_id",1);
        } 
      if($value['m_url']==$url)
      {
      $class="active";
      }
        
      $sql1 = mysql_query("select * from menu_publish where m_flag_id='".$value['m_publish_id']."' and menu_positions='2' and language_id='1' and approve_status='3' ORDER BY page_postion ASC");
      //echo $value['m_name']."".
      $row2 = mysql_num_rows($sql1);
         if($row2 > 0){ ?>
      <li class="has-sub collapsed expandable"><a href="#" title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a>
      <?php 
      if($num1 >0) { ?>
      <ul  class="ddsubmenustyle blackwhite">
        <?php foreach($leftrows1 as $key=>$value1){ 
        if($mydb->checkTable_threeRow("menu_publish","m_publish_id",$value1['m_publish_id'],"menu_positions",2,"approve_status",3)>0){
        $leftrows3=$mydb->gettable_RowsfourColumn_where("menu_publish","m_flag_id",$value1['m_publish_id'],"menu_positions",2,"approve_status",3,"language_id",1);
        $num2=$mydb->countTableRow("menu_publish","m_flag_id",$value1['m_publish_id'],"menu_positions",2,"approve_status",3,"language_id",1);
        }
        $sql2 = mysql_query("select * from menu_publish where m_flag_id='".$value1['m_publish_id']."' and menu_positions='2' and language_id='1' and approve_status='3' ORDER BY page_postion ASC");
        $row3 = mysql_num_rows($sql2);
       if($row3 > 0){
        ?>
        <li   class="collapsed expandable"><a href="#" title="<?php echo $value1['m_name'];?>"><?php echo $value1['m_name'];?> </a>
      <?php 
      if($num2 >0) { ?>
      <ul   class="ddsubmenustyle blackwhite">
        <?php foreach($leftrows3 as $key=>$value3){
      if($value3['doc_uplode']=='') {?>


        <li  data-my="oook"  class="collapsed expandable"><a href="<?php echo $HomeURL;?>/cms/<?php echo $value3['m_url']; ?>" title="<?php echo $value3['m_name'];?>"><?php echo $value3['m_name'];?> </a></li>


      <?php } else { ?>
       <li  data-my="oook1"    class="collapsed expandable"><a href="<?php echo $HomeURL;?>/upload/<?php echo $value3['doc_uplode']; ?>" title="<?php echo $value3['m_name'];?>" target="_blank"><?php echo $value3['m_name'];?> </a></li>
      <?php }
       }  ?>
       </ul>
       
       <?php } ?>
       </li> <?php }
        elseif($row3 == 0 ){
    ?>
    <li><a  data-my="oook"  href="<?php echo $HomeURL;?>/cms/<?php echo $value1['m_url']; ?>" title="<?php echo $value1['m_name'];?>"><?php echo $value1['m_name'];?></a></li>
    <?php  } 
        }  ?>
      </ul>
      
      <?php } ?>
      </li>
  <?php }
  elseif($row2 == 0 ){ 
    if ($value['m_url'] == '.php') {
    ?>
<li><a  data-my="<?php echo $url; ?>"  href="<?php echo $value['linkstatus']; ?>"  target="_blank" title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a></li>
    <?php }else{ 

    ?>
    
    <li><a  data-my="<?php echo $url; ?>"  href="<?php echo $HomeURL;?>/cms/<?php echo $value['m_url']; ?>" title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a></li>

<?php } } }?>
      </ul>

      
      
    <?php   
      
      
      }
      
      
      
      
      else {
        
        ?>
<div class="left-sidebar l2">
   <h3 data-my="<?php echo $rootid;?>" ><?php echo $m_name;?></h3>
</div>

  
  
<ul class="menu-class treeview" data-my='ok3'>
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
        
      $sql1 = mysql_query("select * from menu_publish where m_flag_id='".$value['m_publish_id']."' and menu_positions='1' and language_id='1' and approve_status='3' ORDER BY page_postion ASC");
      //echo $value['m_name']."".
      $row2 = mysql_num_rows($sql1);
         if($row2 > 0){ ?>
      <li class="has-sub collapsed expandable"><a href="#" title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a> 
      
      <?php 
      if($num1 >0) { ?>
      <ul  class="ddsubmenustyle blackwhite">
        <?php foreach($leftrows1 as $key=>$value1){ 
        if($mydb->checkTable_threeRow("menu_publish","m_publish_id",$value1['m_publish_id'],"menu_positions",1,"approve_status",3)>0){
        $leftrows3=$mydb->gettable_RowsfourColumn_where("menu_publish","m_flag_id",$value1['m_publish_id'],"menu_positions",1,"approve_status",3,"language_id",1);
        $num2=$mydb->countTableRow("menu_publish","m_flag_id",$value1['m_publish_id'],"menu_positions",1,"approve_status",3,"language_id",1);
        }
        $sql2 = mysql_query("select * from menu_publish where m_flag_id='".$value1['m_publish_id']."' and menu_positions='1' and language_id='1' and approve_status='3' ORDER BY page_postion ASC");
        $row3 = mysql_num_rows($sql2);
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
    <?php  } 
        }  ?>
      </ul>
      
      <?php } ?>
      </li>
  <?php }
  elseif($row2 == 0 ){ ?>
    
    <li ook><a href="<?php echo $HomeURL;?>/cms/<?php echo $value['m_url']; ?>" title="<?php echo $value['m_name'];?>" class="<?php echo $value['m_url']==$url?"selected":""; ?>"><?php echo $value['m_name'];?></a></li>
<?php }  }?>
      </ul>


  
  
  
  
  
  
  
  
  
  
  
  
        <?php } ?>
	


</div>
</div>
 <?php include("../left_menu.php");?>

          </div>
                
                
                
<div class="col-md-9 content-area">
              <h2 class="heading" ><?php //echo $m_description;   ?> </h2>
      <?php 
			   if($page11!='') {
			//echo $content;
			$whereClause="m_flag_id='".$page11."' && menu_positions='3' && approve_status='3' && language_id='1' order by page_postion asc" ;
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
		<li><a href="<?php echo $HomeURL;?>/content/cms/<?php echo $value1['m_url']; ?>" title="<?php echo $value1['m_name'];?>"><?php echo $value1['m_name'];?></a></li>


              <?php } }?>
              </ul>
              
              <?php } else { ?>
<?php 
			$path='../../';
			  
			  //echo type_of_extention_size_file($body,$HomeURL,$path);
?>
<?php } ?>

 </div> 

    
    </div>


    </div>        

<div align="right" class="backtop">
<a  id="back-to-top" href="#" class="btn btn-danger btn-lg back-to-top" role="button" title="Back to Top" data-toggle="tooltip" data-placement="top">
  <span class="glyphicon glyphicon-chevron-up"></span>
</a>

 

</div>    
<div>
         <?php 
        if($pageLastUpdate !== false)
        { 
        ?>
        <div class="pull-right" >
        <?php 
         echo "Last Updated:".date('d-m-Y', strtotime($pageLastUpdate));
        ?>
        </div>
        <?php 
         }
        ?>
            </div>
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
