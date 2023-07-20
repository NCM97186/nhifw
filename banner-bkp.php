<?php
require_once "includes/connection.php";
require_once("includes/config.inc.php");
require_once "includes/functions-front.inc.php";


$quer = mysqli_query($conn,"select * from banner_publish Where approve_status='3' AND b_language='1'");
$qnumRows = mysqli_num_rows($quer);

?>

<div id="homeCarousel" class="carousel slide" data-ride="carousel">

    	<!-- <ol class="carousel-indicators">
		<?php
		//for($i=0; $i < $qnumRows; $i++) { ?>
		<li data-target="#homeCarousel" data-slide-to="<?php echo $i;?>" class="active"></li>
		<?php // } ?>

    	</ol> -->

    	<!-- Items -->
    	<div class="carousel-inner">
				 
					
						<?php $sqlquery=mysqli_query($conn,"select * from banner_publish where approve_status=3 limit 0,1");
							$i=1;
							while($result=mysqli_fetch_array($sqlquery))
							{
								@extract($result);
								$image_path = $HomeURL.'/upload/banner/'.$b_image_path;
							?>
							
								<div class="item active"><img src="<?php echo $image_path;?>" alt="slider-img-2" class="img-responsive center-block"></div>
						<?php } ?>
					
					
					<?php $sqlquery=mysqli_query($conn,"select * from banner_publish where approve_status=3 limit 1,3");
						$i=1;
						while($result=mysqli_fetch_array($sqlquery))
						{
							@extract($result);
							$image_path = $HomeURL.'/upload/banner/'.$b_image_path;
						?>
						
						<div class="item"> <img src="<?php echo $image_path;?>" alt="slider-img-2" class="img-responsive center-block"> </div>	

					<?php } ?>	
				</div>


    	<!--Carousel controls -->
    	<!-- <a class="carousel-control left" title="Left Button"  data-slide="prev"> <span class="hidethis">Left Button</span> <span class="glyphicon glyphicon-chevron-left"></span> </a> <a class="carousel-control right" title="Right"  data-slide="Right Button"> <span class="hidethis">Right Button</span> <span class="glyphicon glyphicon-chevron-right"></span> </a> -->
    <!-- Controls -->
    <div id="carouselButtons">
      <button id="playButton" type="button" class="btn btn-default btn-xs" title="Play">
        <span class="glyphicon glyphicon-play"></span> <span class="hidethis">Play</span> 
      </button>
      
      <button id="pauseButton" type="button" class="btn btn-default btn-xs" title="Pause">
        <span class="glyphicon glyphicon-pause"></span> <span class="hidethis">Pause</span>
      </button>
    </div>
  </div>
  <script type='text/javascript'>
	$(document).ready(function(){
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

</script>