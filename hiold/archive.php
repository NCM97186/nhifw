<?php
require_once "includes/connection.php";
require_once("includes/config.inc.php");
require_once "includes/functions.inc.php";
require_once "includes/functions-data.php";
include("includes/ps_pagination.php");

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
   <li class = "active">Archive</li>
   

</ol>
 <a onClick="javascript: window.print()" title="Print" href="javascript: void(0)"><p class="glyphicon glyphicon-print  print"></p></a>
</div>
</div>
    		</div>

    <!--Middle Part Start -->   
	<div class="container background-white">
    	<div class="row">
        
        
        <!-- <div class="col-md-3 for-print">

 <div class="left-heading">          
 <h3><a href="#" title="Research">Research</a></h3>
 <h3><a href="#" title="Examination">Examination</a></h3>
 <h3><a href="#" title="Awards">Awards</a></h3>
 <h3><a href="#" title="Orations">Orations</a></h3>
 </div>
 
          </div> -->
          
          
 
<div class="col-md-12 content-area">
                <h2 class="heading">Archive</h2>
                
<div class="archive-grid">  
<form  action="#" name="searchform" method="post">
<input type="hidden" value="013280925726808751639:savuhp8r-pi" name="cx">
<input type="hidden" value="FORID:10" name="cof">
<input type="hidden" value="UTF-8" name="ie" />
<div class="acchive-div">
<label for="textcatgory"><strong>Category:</strong></label>
<select name="textcatgory" id="textcatgory">
    
 <option value="">Select</option>
<?php 
foreach($archive_cat as $key=>$value)
{
	?>
<option value="<?php echo content_desc($key); ?>" <?php if($key==$textcatgory){ echo 'selected="selected"'; } else { }?>><?php echo $value; ?></option>
<?php }
 ?>
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


<?php if(isset($cmdsubmit))
{
/*$textcatgory=content_desc(textcatgory);
$startdate=content_desc(startdate);

$expairydate=content_desc(expairydate);*/

$sta=split('-',$startdate);
$startdate1=$sta['2']."-".$sta['1']."-".$sta['0'];
$exp=split('-',$expairydate);
$expairydate1=$exp['2']."-".$exp['1']."-".$exp['0'];
if(trim($textcatgory) !="")
{
	
			//$querywhere ="AND n_type='".trim($textcatgory)."'";
			//$querywhere1 ="AND mod_type='".trim($textcatgory)."'";
			}


if($exp['2'] < $sta['2'])
{
$errmsg =" From Date should be lesser than To Date."."<br>";
} 
else if(($exp['2'] == $sta['2']) && ($exp['1'] < $sta['1'])) 
{
$errmsg .=" From Date should be lesser than To Date."."<br>";
} 
else if((($exp['2'] == $sta['2']) && ($exp['1'] == $sta['1'])) && ($exp['0'] < $sta['0'])) 
{
$errmsg .="Please enter From Date lesser than To Date."."<br>";
}
		if($startdate !="" && $expairydate !="")
		{
			if(preg_match("/^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$/", $expairydate) === 0)
						{
						$errmsg .= 'Date should be in DD-MM-YYYY format<br>';
						}
						if(preg_match("/^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$/", $startdate) === 0)
						{
						$errmsg .= 'Date should be in DD-MM-YYYY format<br>';
						}
						else
						{
							$startdate1=changeformate($startdate);
							$expairydate1=changeformate($expairydate);
							// if($textcatgory=='3'){
							//$tender ="and end_date between '$startdate1' and '$expairydate1' ";
							//}
							//else {
								$querywhere ="and end_date between '$startdate1' and '$expairydate1' ";
							//	}
						}
			}
		if($errmsg=="")
		{
		 if($textcatgory=='5'){
		 	 $date=date('Y-m-d');
	      $sql="SELECT * FROM tender_publish where language_id='2' and approve_status='3' and date(end_date) < '$date' $querywhere";
		 }
		  else if($textcatgory=='1'){
		 	 $date=date('Y-m-d');
	      $sql="SELECT * FROM whatsnew_publish where language_id='2' and approve_status='3' and date(end_date) < '$date' $querywhere";
		 }
		  else if($textcatgory=='2'){
		 	 $date=date('Y-m-d');
	      $sql="SELECT * FROM latest_information_publish where language_id='2' and approve_status='3' and date(end_date) < '$date' $querywhere";
		 }

		 else  if($textcatgory=='3'){
		 	 $date=date('Y-m-d');
	      $sql="SELECT * FROM importent_information_publish where language_id='2' and cat_id='1' and approve_status='3' and date(end_date) < '$date' $querywhere";
		 }
		 else if($textcatgory=='4'){
		 	 $date=date('Y-m-d');
	      $sql="SELECT * FROM importent_information_publish where language_id='2' and cat_id='2' and approve_status='3' and date(end_date) < '$date' $querywhere";
		 }
		  else if($textcatgory=='6'){
		 	 $date=date('Y-m-d');
	      $sql="SELECT * FROM recruitment_publish where language_id='2' and approve_status='3' and date(end_date) < '$date' $querywhere";
		 }
		 else if($textcatgory=='7'){
		 $date=date('Y-m-d');
		 $sql="SELECT * FROM employee_corner_publish where language_id='2'  and approve_status='3' and date(end_date ) < '$date' $querywhere ";
		  }
			}
		}

		else {
			$date=date('Y-m-d');
	 $sql="SELECT * FROM whatsnew_publish where language_id='2' and approve_status='3' and date(end_date ) < '$date'";
		  }
		
	
	  /* $sql=mysqli_query($sql);
		   $num_rows=mysqli_num_rows($sql);*/
			$pager = new PS_Pagination($link, $sql, 10, 5, "");
			 $rs = $pager->paginate();
		   ?>
		   	<table width="100%"   class="table table-bordered">
                <?php if($errmsg!=""){
				
					?>
                <tr>
                  <td colspan="5" align="center" class="table table-bordered" class="redBold"><strong> <?php echo $errmsg; ?></strong></td>
                </tr>
               <?php } ?>
                <tr>
                  <th width="8%">Sl. No.</th>
                  <th width="50%">Page Title</th>
                  <th width="15%">Start Date</th>
                  <th  width="13%">Expiry Date</th>
                </tr>
              <?php
						
if($rs>0)
{	 
				
						$counter=1;
				while($row=mysqli_fetch_array($rs))
	{
		
		$exten=substr($row['doc_uplode'],-4);
		@extract($row);
	     $counter=$counter++ ;
		if($textcatgory=='1') {
				$docspath = $HomeURL.'/upload/whatsnew/'.$docs_file;
			}
			if($textcatgory=='2') {
				$docspath = $HomeURL.'/upload/latest/'.$docs_file;
			}
			if($textcatgory=='3' || $textcatgory=='4') {
				$docspath = $HomeURL.'/upload/importent/'.$docs_file;
			}
			if($textcatgory=='5') {
				$docspath = $HomeURL.'/upload/tender/'.$docs_file;
			}
			if($textcatgory=='7') {
				$docspath = $HomeURL.'/upload/employee/'.$docs_file;
				$m_name=$m_title;
			}
			if($textcatgory=='6') {
				$docspath = $HomeURL.'/upload/recruitment/'.$docs_file;
			}
		  
					?>		

			
		
					<tr>
					<td ><?php echo $counter;?></td>
					
					<td>
				<?php if($docs_file!='') { ?>
			   <a href="<?php echo $docspath; ?>" title="<?php echo $m_name;?>" target="_blank"><?php echo $m_name;?>  &nbsp;&nbsp;<img src="<?php echo $HomeURL; ?>/images/pdf_icon.png" height="16" alt="PDF file" /> </a>
			   <?php }
				else if($ext_url!='') { ?>
			   <a href="<?php echo $ext_url; ?>" title="<?php echo $m_name;?>" target="_blank"><?php echo $m_name;?>  &nbsp;&nbsp;<img src="<?php echo $HomeURL; ?>/images/extlink.png" height="16" alt="PDF file" /> </a>
			   <?php } else { 
					
					if($textcatgory=='2') {
					?>
			   <a href="<?php echo $HomeURL;?>/hi/meeting.php?page=<?php echo $page_url; ?>" title="<?php echo $m_name;?>"><?php echo $m_name;?></a>
			   <?php } 
					if($textcatgory=='3' || $textcatgory=='4') {
					?>
			   <a href="<?php echo $HomeURL;?>/hi/important_circulars.php?page=<?php echo $page_url; ?>" title="<?php echo $m_name;?>"><?php echo $m_name;?></a>
			   <?php }
					if($textcatgory=='5') {
					?>
			   <a href="<?php echo $HomeURL;?>/hi/tender.php?page=<?php echo $page_url; ?>" title="<?php echo $m_name;?>"><?php echo $m_name;?></a>
			   <?php }
					if($textcatgory=='6') {
					?>
			   <a href="<?php echo $HomeURL;?>/hi/vacancy.php?page=<?php echo $page_url; ?>" title="<?php echo $m_name;?>"><?php echo $m_name;?></a>
			   <?php }
					if($textcatgory=='7') {
					?>
			   <a href="<?php echo $HomeURL;?>/hi/employee_corner.php?page=<?php echo $page_url; ?>" title="<?php echo $m_name;?>"><?php echo $m_name;?></a>
			   <?php }
					
					
					else { ?>
				 <a href="<?php echo $HomeURL;?>/hi/news/<?php echo $page_url; ?>" title="<?php echo $m_name;?>"><?php echo $m_name;?></a>

				<?php } ?>





			   <?php } ?>

					</td>	
				
			
					<td><?php echo changeformate($row['start_date']);?></td>
					<td ><?php echo changeformate($row['end_date']);?></td>
					</tr>
					<?php 
						$counter++;
						}	 
						?>
						<tr>
						<td colspan="4" align="center"><?php   echo $pager->renderFullNav();?></td>
						</tr>
						<?php 
						}
						else
						{?>
						<tr>
						<td colspan="4" align="center" style="text-align:center;">No record found </td>
						</tr>
						<?php 
						}

						?>
              </table>

  </div></p>
                
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
