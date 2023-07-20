
<div class="container">


	<?php if($mydb->checkTableRow("bottom_logo")>0){
   $logorows=$mydb->gettable_Rows_where("bottom_logo","approve_status",3); 
 }
 ?>
<div class="ticker1 modern-ticker mt-round mt-scroll">
<div class="mt-news" style="width: 35px;">
 <ul class="footer-logo">
 <?php foreach($logorows as $key=>$value){ 
$image_path = $HomeURL.'/upload/logo/'.$value['img_uplode'];
$title=$value['title'];
$l_url=$value['l_url'];

?>
      <li class="col-xs-6 col-md-3"><a href="<?php echo $l_url;?>" target="_blank" onclick="return sitevisit();"><img src="<?php echo $image_path;?>" alt="<?php echo $title;?>" title="<?php echo $title;?> : External website that opens in a new window" class="img-responsive"></a></li>
      <?php } ?>
      </ul>
	  </div>
				
					<div class="mt-controls">
						<div class="mt-prev"></div>
						<div class="mt-next"></div>
					</div>
				</div>
			</div>