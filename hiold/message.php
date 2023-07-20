<div class="director-desk">
<?php $sqlquery=mysqli_query($conn,"select * from message_publish where approve_status=3 and language_id='2' limit 0,1");
							$i=1;
							while($result=mysqli_fetch_array($sqlquery))
							{
								@extract($result);
								$image_path = $HomeURL.'/upload/message/'.$image_file;
							?>
                <h2 class="heading-whats-new">निदेशक की क़लम से</h2>
            		<!-- <img src="<?php echo $image_path;?>" alt="NIHFW Director" title="EPI" class="NIHFW Director" width="145px" height="115"> -->
                    <p><?php echo limit_words($m_description,20);?> </p>
                    <span style="padding-left:9px;"> (<?php echo ($designation);?>) </span> <span><?php echo $m_name;?> </span>  <br/>
    <div class="director-v-all"><a href="<?php echo $HomeURL;?>/hi/director_message.php" title="View All">अधिक पढ़ें...</a></div>
	
              	</div>
                
                <?php } ?>
                
                
            
            	<div class="director-desk">
                <h2 class="heading-metting">बैठक / घटनाएँ  / कार्यशालाएं / ट्रेनिंग</h2>

					<?php
  $date=date('Y-m-d');
  if($mydb->checkTableRow("latest_information_publish")>0){
// $whereClause="approve_status='3' && language_id='1' && date(end_date ) >= '$date'  order by start_date desc" ;
  $whereClause="approve_status='3' && language_id='1'   order by start_date desc" ;

   $newsrows=$mydb->gettable_Rows_whereCluse("latest_information_publish",$whereClause); 
   if(is_array($newsrows)){
					  $no_of_rows= count($newsrows);
					 }else{
					  $no_of_rows= $newsrows;
					}
 }
 ?>


            	<ul class="metting">
				
           <?php 
		  if($no_of_rows > 0){
		 
		 foreach($newsrows as $key=>$value){ 
			  $docspath = $HomeURL.'/upload/latest/'.$value['docs_file'];
			?>

				 <li>
		  <?php if($value['docs_file']!='') { ?>
			   <a href="<?php echo $docspath; ?>" title="<?php echo $value['m_name'];?>" target="_blank"><?php echo $value['m_name'];?>  &nbsp;&nbsp;<img src="<?php echo $HomeURL; ?>/images/pdf_icon.png" height="16" alt="PDF file" /> </a>
			   <?php }
				else if($value['ext_url']!='') { ?>
			   <a href="<?php echo $value['ext_url']; ?>" title="<?php echo $value['m_name'];?>" target="_blank"><?php echo $value['m_name'];?>  &nbsp;&nbsp;<img src="<?php echo $HomeURL; ?>/images/extlink.png" height="16" alt="PDF file" /> </a>
			   <?php } else { ?>
			   <a href="<?php echo $HomeURL;?>/meeting/<?php echo $value['page_url']; ?>" title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a>
			   <?php } ?>
          <span><?php echo date('d-m-Y', strtotime($value['start_date']));?></span></li>
		  <?php }
		 } else { ?>
		   <li>कोई रिकॉर्ड नहीं मिला</li>
		  
		  <?php } ?>


              </ul>
    <div class="director-v-all"><a href="<?php echo $HomeURL;?>/hi/meeting.php" title="View All">अधिक पढ़ें...</a></div>
              	</div>
                

