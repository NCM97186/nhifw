<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <?php $sqlquery=mysqli_query($conn,"select * from banner_publish where approve_status=3 limit 0,3");
	
							$i=0;
							
							while($result=mysqli_fetch_array($sqlquery))
							{
								@extract($result);

								$image_path = $HomeURL.'/upload/banner/'.$b_image_path;
							?>
							
								<div class="carousel-item <?php echo $i==0?'active':''; $i++; ?>"><img src="<?php echo $image_path;?>" alt="slider" class="d-block w-100"></div>
						<?php } ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
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
	$('#carouselExampleControls').carousel({
		interval:5000,
		pause: "false"
	});
	$('#playButton').click(function () {
		$('#carouselExampleControls').carousel('cycle');
	});
	$('#pauseButton').click(function () {
		$('#carouselExampleControls').carousel('pause');
	});
});

</script>
