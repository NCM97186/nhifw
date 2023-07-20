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
		 header("location:".$url); 
		 exit;
	 }

$_POST['page']=content_desc($_POST['page']);

if($_SERVER['REQUEST_URI'])
		{
		 $url=mysqli_real_escape_string($conn,$_SERVER['REQUEST_URI']); 
		 $val=explode('/', $url);
		//$url=$val['4'];
		$open=$val['3'];
		if( $_POST['page']!='') {
			$url=$_POST['page'];
		}
		else {
			$url=$val['4'];
		}
		
if($mydb->checkTable_threeRow("latest_information_publish","page_url",$url,"approve_status",3,"language_id",1)>0){
			$contentrows=$mydb->gettable_RowsthreeColumn_where("latest_information_publish","page_url",$url,"approve_status",3,"language_id",1);

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

/*$url_data = array();

foreach (getallheaders() as $name => $value) {
    $url_data[] = "$name: $value\n";
}

print_r($url_data);

echo '<hr>';

$headers = apache_request_headers();

$new_data = array();
foreach ($headers as $header => $value) {
    $new_data[] = "$header: $value <br />\n";
}

 print_r($new_data);


echo '<hr>';

  $res  = array_serach('Upgrade-Insecure-Requests',$new_data);

echo $res.'hello';

 echo '<hr>';
 

exit();*/

if (isset($textcatgory)) {

	$textcatgory = mysqli_real_escape_string($conn,$_POST['textcatgory']);
		

  $date1=date('Y-m-d');
  if($mydb->checkTableRow("latest_information_publish",$conn)>0){
  

  if ($textcatgory != '') {
  	$whereClause12 ="and cat_id=$textcatgory " ;
  }
  else
  {
  	$whereClause12 ="" ;	
  }

  $whereClause1="approve_status='3' && language_id='1' $whereClause12  order by start_date desc" ;
   $newsrows1=$mydb->gettable_Rows_whereCluse("latest_information_publish",$whereClause1); 
   if(is_array($newsrows1)){
					  $no_of_rows1= count($newsrows1);
					 }else{
					  $no_of_rows1= $newsrows1;
					}
 }


 if ($no_of_rows1 > 0) {

$j = 1;
echo '<table width="100%" class="table table-bordered" id="backend">
<caption> Meetings &amp; Events / Workshop &amp; Training</caption><tbody><tr>
				<th>Sr.</th>
				<th width="13%">Date</th>
				<th width="13%">Time of Meeting	</th>
				<th>Meeting Details</th>
				<th>Collaborating Organisation</th>
			</tr>';
 	 foreach($newsrows1 as $key=>$value){

 		$docspath1 = $HomeURL.'/upload/latest/'.$value['docs_file'];
		$file1 ='../upload/latest/'.$value['docs_file'];

		echo '<tr> <td>'.$j.'</td>';
		echo '<td>'; echo date('d-m-Y', strtotime($value['start_date']));
		echo '</td>';
		echo '<td>'; 
			if ($value['end_time'] != '') {
						echo $value['start_time'].' - '.$value['end_time'];
					}else{ echo $value['start_time']; }
		echo '</td>';
		echo '<td>';
		if($value['docs_file']!='') {

			echo '<a href="'.$docspath1.'" title="'.$value['m_name'].'" target="_blank">'.$value['m_name'].'&nbsp;&nbsp;<img src="'.$HomeURL.'/images/pdf_icon.png" height="16" alt="PDF file" /> </a>Size: '.formatFilebytes($file,'MB').'';

		}

		elseif ($value['ext_url']!='') {
			 
			 echo '<a href="'.$value['ext_url'].'" title="'.$value['m_name'].'" target="_blank"> '.$value['m_name'].'  &nbsp;&nbsp;<img src="'.$HomeURL.'/images/extlink.png" height="16" alt="PDF file" /> </a>';
		}
		else {
			echo $value['m_name'];
		}
		echo '</td>';
		echo '<td>'.$value['m_short'].'</td></tr>';
		$j++;
 	 }

echo '</tbody></table>'; 	 
 	 die();
 }
 else
 {
 	echo 'null';
 	die();
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
		<script type="text/javascript" src="<?php echo $HomeURL;?>/js/jsDatePick.js"></script>
<link href="<?php echo $HomeURL;?>/css/jsDatePick.css" rel="stylesheet" type="text/css" />
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

 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


	<script src="<?php echo $HomeURL;?>/js/modern-ticker.js" type="text/javascript"> </script>
	<script type="text/javascript">

		 window.onload = function(){
	new JsDatePick({
		useMode:2,
		target:"startdate",
		dateFormat:"%d-%m-%Y"
	});
	new JsDatePick({
		useMode:2,
		target:"expairydate",
		dateFormat:"%d-%m-%Y"
	});
}; 


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
   <li class = "active"><a href="<?php echo $HomeURL;?>/meeting.php" title="Meetings & Events / Workshop & Training">Meetings & Events / Workshop & Training</a></li>
	 <?php if($_POST['page']!='') { ?> 
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
 <?php include("left_menu.php");?>
</div>
          
  <?php
  $date=date('Y-m-d');
  if($mydb->checkTableRow("latest_information_publish",$conn)>0){
$whereClause="approve_status='3' && language_id='1' &&  end_date  >= '$date'  order by start_date desc" ;
    //$whereClause="approve_status='3' && language_id='1'   order by start_date desc" ;

   $newsrows=$mydb->gettable_Rows_whereCluse("latest_information_publish",$whereClause); 
   //print_r($newsrows);
   if(is_array($newsrows)){
					  $no_of_rows= count($newsrows);
					  //print_r($no_of_rows);
					 }else{
					  $no_of_rows= $newsrows;
					}
 }
 ?>
<div class="col-md-9 content-area">
                <h2 class="heading">
					 <?php if($_POST['page']!='') { ?> 
					<?php echo $page_name;?>
				 <?php }  else { ?>
				Meetings & Events / Workshop & Training
				<?php } ?>
				</h2>

				<p style="text-align:right; font-size:14px; color:black; font-weight:bold;">
    <a href="archive.php?cat=2" > Archive</a></p>

<div class="archive-grid">  
	<form  action="" name="searchform" id="searchform" method="post">
		
		<div class="acchive-div">
				<label for="textcatgory"><strong>Category:</strong></label>
				<select name="textcatgory" id="textcatgory">
					 <option value="">Select</option>
					 <option value="1">Meetings/Events</option>
					 <option value="2">Workshop/Training</option>
				</select>
		</div>
				

		<div class="acchive-div">
			<label for="startdate">From Date:</label>
			<input type="text" name="startdate"  readonly="readonly" id="startdate" value="<?php echo content_desc($_POST['startdate']);?>"/>
			<input type="hidden" id="strtdate" />
		</div>
		
		<div class="acchive-div">
			<label for="expairydate">To Date:</label>
			<input type="text" name="expairydate" readonly="readonly"  id="expairydate" value="<?php echo content_desc($_POST['expairydate']);?>"/>
			<input type="hidden" id="edate" />
		</div>
		 
		 <div class="acchive-div">
		 	      <input type="submit"  name="cmdsubmit"  id="cmdsubmit" value="Go" class="go" >
		 </div>

	</form>

<div class="clear"></div>
</div>

<div id="tbl_newdata"> 

</div>
	<script type="text/javascript">
		
		$('#cmdsubmit').click(function(){
           

			var mydata = $('#searchform').serializeArray();
			//alert(mydata);
			//$('#backend').show();
			$.ajax({
					type:'Post',
					data:{mydata:mydata},
					url:"meeting.php",
					dataType: "html", 
					success:function(data){
						alert(data);
						//console.log(data);
						 $('#tbl_data').hide();

						 $('#tbl_newdata').show();
						 $('#tbl_newdata').html(data);

					}
			});

		});
	</script>
     <?php 




      if($_POST['page']=='') { ?>           
 <table width="100%"  class="table table-bordered" id="tbl_data">
<caption> Meetings & Events / Workshop & Training</caption>
		<tbody>
			<tr>
				<th>Sr.</th>
				<th width="13%">Date</th>
				<th width="13%">Time of Meeting	</th>
				<th>Meeting Details</th>
				<th>Collaborating Organisation</th>
			</tr>
			 <?php 
			 $i=1;



		  if($no_of_rows > 0){
		 
		 foreach($newsrows as $key=>$value){ 
			  $docspath = $HomeURL.'/upload/latest/'.$value['docs_file'];
			  $file='../upload/latest/'.$value['docs_file'];
			?>
			<tr>
				<td class="odd">
					<?php echo $i;?></td>
					<td>
					<?php echo date('d-m-Y', strtotime($value['start_date']));?></span></td>
					<td>
					<?php if ($$value['end_time'] != '') {
						echo $value['start_time'].' - '.$value['end_time'];
					}else{ echo $value['start_time']; } ?></span></td>
				<td>

					 <?php if($value['docs_file']!='') { ?>
			   <a href="<?php echo $docspath; ?>" title="<?php echo $value['m_name'];?>" target="_blank"><?php echo $value['m_name'];?>  &nbsp;&nbsp;<img src="<?php echo $HomeURL; ?>/images/pdf_icon.png" height="16" alt="PDF file" /> </a><?php echo ' size:( '.formatFilebytes($file,'MB'). ')'; ?>
			   <?php }
				else if($value['ext_url']!='') { ?>
			   <a href="<?php echo $value['ext_url']; ?>" title="<?php echo $value['m_name'];?>" target="_blank"><?php echo $value['m_name'];?>  &nbsp;&nbsp;<img src="<?php echo $HomeURL; ?>/images/extlink.png" height="16" alt="PDF file" /> </a>
			   <?php } else { ?>
			   	<?php echo $value['m_name'];?>
			   <!-- <a href="<?php echo $HomeURL;?>/meeting/<?php echo $value['page_url']; ?>" title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a> -->
			   <?php } ?></td>
				<td>
					<?php echo  $value['m_short']; ?></span></td>
			</tr>
			<?php $i++; } } else { ?>
			<tr><td>No record found</td></tr>
			<?php } ?>
		</tbody>
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
	<script type="text/javascript">

	$('#startdate').datetimepicker({
 
});


	$('#expairydate').datetimepicker({
 
});

/*window.onload = function(){
	new JsDatePick({
		useMode:2,
		target:"startdate",
		dateFormat:"%d-%m-%Y"
	});
	new JsDatePick({
		useMode:2,
		target:"expairydate",
		dateFormat:"%d-%m-%Y"
	});
};*/
</script>
</body>
</html>
