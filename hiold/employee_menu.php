<div class="left-sidebar"> 
 <?php 
	$whereClause="status='1' && language_id='2'  order by id asc" ;
			$emprows=$mydb->gettable_Rows_whereCluse("emp_category",$whereClause); 
			 foreach($emprows as $key=>$value){ 
 ?>  
            	<ul>
					<li>
					 
				  	<a href="<?php echo $HomeURL;?>/hi/employee_corner.php?page_id=<?php echo base64_encode($value['id']);?>" target="_self" title="<?php echo $value['name'];?>"><?php echo $value['name'];?></a>

				  <?php } ?>
					</li>
				</ul>
            </div>


