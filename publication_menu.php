<div class="left-sidebar"> 
 <?php 
	$whereClause="status='1' && language_id='1'  order by id asc" ;
			$emprows=$mydb->gettable_Rows_whereCluse("publication_category",$whereClause); 
			 foreach($emprows as $key=>$value){ 
 ?>  
            	<ul>
					<li>
					 
				  	<a href="<?php echo $HomeURL;?>/publication/<?php echo $value['page_url'];?>" target="_self" title="<?php echo $value['name'];?>"><?php echo $value['name'];?></a>

				  <?php } ?>
					</li>
				</ul>
            </div>


