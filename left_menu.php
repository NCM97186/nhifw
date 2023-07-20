<div class="left-sidebar ook"> 
 <?php 
	$whereClause="m_flag_id='0' && menu_positions='2' && approve_status='3' && language_id='1'  order by page_postion asc" ;
			$bottomrows=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
			 foreach($bottomrows as $key=>$value){ 
$title=$value['m_name'];
$page=$value['m_id'];
 ?>  
            	<ul>
					<li>


					 <?php if($page=='40') {?>
				  <a href="<?php echo $HomeURL;?>/dlc/health--and-family-welfare-management-course.php"  target="_self" title="<?php echo $title;?>"><?php echo $title;?></a>
				  <?php }
				  else if($title == 'Memorandam Of Association'){
				  	echo '';
				  }

				  else if($page=='44') {?>
				  <a href="<?php echo $HomeURL;?>/student/enrolled.php" target="_self" title="<?php echo $title;?>"><?php echo $title;?></a>
				  <?php }
				   else { ?>
				  	<a href="<?php echo $HomeURL.'/cms/'.$value['m_url'];?>" target="_self" title="<?php echo $title;?>"><?php echo $title;?></a>

				  <?php } ?>
					</li>

</ul>

				 <?php } ?>

					<!--<li><a href="<?php echo $HomeURL;?>/project/rch--nhm-traning-unit.php" title="<?php echo $title;?>">Projects</a></li>-->
				
            </div>


