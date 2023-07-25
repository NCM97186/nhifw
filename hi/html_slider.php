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
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS  -->
    <link href="css/style.css" rel="stylesheet">  
    
    <link href="css/print.css" rel="stylesheet" type="text/css" media="print">
     
    <!-- Color Theme CSS -->
	<link rel="alternate stylesheet" href="css/change.css" media="screen" title="change" />   
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/meanmenu.css" />
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="js_html/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js_html/bootstrap.min.js"></script>    
    <!-- Menu Access for Tab Key -->
	<script src="js_html/superfish.js"></script>    
    <!-- font Size Increase Decrease -->
    <script src="js_html/font-size.js"></script>    
	<script src="js_html/swithcer.js"></script>
	
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


	<script src="js/modern-ticker.js" type="text/javascript"> </script>
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
    
	<script type="text/javascript" src="js/jquery.totemticker.js"></script>
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
    
	<script src="js/jquery.meanmenu.js"></script>   
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
<body>
      
    <div class="container-fluid"> 
    <div class="row">
				<!-- Carousel -->
  				<div id="homeCarousel" class="col-lg-12 carousel slide" data-ride="carousel">
    			<ol class="carousel-indicators">
      				<li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
      				<li data-target="#homeCarousel" data-slide-to="1" ></li>
      				<li data-target="#homeCarousel" data-slide-to="2" ></li>
    			</ol>
    	<!-- Items -->
    	<div class="carousel-inner">
      	<!-- Item 1 -->
          <?php $sqlquery=mysqli_query($conn,"select * from banner_publish where approve_status=3 limit 0,5");
	
    $i=0;
    
    while($result=mysqli_fetch_array($sqlquery))
    {
        @extract($result);

        $image_path = $HomeURL.'/upload/banner/'.$b_image_path;
        
    ?>
    
        <div class="item <?php echo $i==0?'active':''; $i++; ?>"><img src="<?php echo $image_path;?>" alt="slider" class="img-responsive center-block"></div>
<?php } ?>
    	</div>
  
    
    	<!--Carousel controls -->
    	<a class="carousel-control left" title="left" href="#homeCarousel" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a> <a class="carousel-control right" title="Right" href="#homeCarousel" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a>
    <!-- Controls -->
    <div id="carouselButtons">
      <button id="playButton" type="button" class="btn btn-default btn-xs" title="Play">
        <span class="glyphicon glyphicon-play"></span>
      </button>
      
      <button id="pauseButton" type="button" class="btn btn-default btn-xs" title="Pause">
        <span class="glyphicon glyphicon-pause"></span>
      </button>
    </div>
  </div>
              
		</div>
</div>
<!--Carousel End -->

</body>
</html>