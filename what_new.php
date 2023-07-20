	<?php
  $date=date('Y-m-d');
  if($mydb->checkTableRow("whatsnew_publish")>0){
$whereClause="approve_status='3' && language_id='1' && date(end_date ) >= '$date'  order by start_date desc" ;
  $whereClause="approve_status='3' && language_id='1'   order by start_date desc" ;

   $newsrows=$mydb->gettable_Rows_whereCluse("whatsnew_publish",$whereClause); 
   if(is_array($newsrows)){
					  $no_of_rows= count($newsrows);
					 }else{
					  $no_of_rows= $newsrows;
					}
 }
 ?>
	
	
	<h2 class="heading-whats-new">What’s New</h2>
     	<div class="play-pause-control-m">
            <p class="n-play-pause">
                <!--<a href="#" id="ticker-previous" title="Previous"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i></a>
                <a href="#" id="ticker-next" title="Next"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i></a>-->
                <a id="stop" href="#" title="Stop">Stop</a>
                <a id="start" href="#" title="Play">Play</a>
            </p>
		</div>
		<div class="whats-new">
            <ul id="vertical-ticker">

           <?php 
		  if($no_of_rows > 0){
		 
		 foreach($newsrows as $key=>$value){ 
			  $docspath = $HomeURL.'/upload/whatsnew/'.$value['docs_file'];
			  $file='upload/whatsnew/'.$value['docs_file'];
			?>
		  <li>
		  <?php if($value['docs_file']!='') { ?>
			   <a href="<?php echo $docspath; ?>" title="<?php echo $value['m_name'];?>" target="_blank"><?php echo $value['m_name'];?>  &nbsp;&nbsp;<img src="<?php echo $HomeURL; ?>/images/pdf_icon.png" height="16" alt="PDF file" /> </a><?php //echo ' size:( '.formatFilebytes($file,'MB'). ')'; ?>
			   <?php }
				else if($value['ext_url']!='') { ?>
			   <a href="<?php echo $value['ext_url']; ?>" title="<?php echo $value['m_name'];?>" target="_blank"><?php echo $value['m_name'];?>  &nbsp;&nbsp;<img src="<?php echo $HomeURL; ?>/images/extlink.png" height="16" alt="PDF file" /> </a>
			   <?php } else { ?>
			   <a href="<?php echo $HomeURL;?>/news/<?php echo $value['page_url']; ?>" title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a>
			   <?php } ?>
          <span><?php echo date('d-m-Y', strtotime($value['start_date']));?></span></li>
		  <?php }
		 } else { ?>
		   <li>No record found</li>
		  
		  <?php } ?>
		</ul>

		<div class="v-all"><a href="<?php echo $HomeURL;?>/viewall_whatsnew.php" title="View All What's New">View All</a></div>
        </div>