<div class="left-sidebar"> 
				<ul>
 <?php 
	$whereClause="m_flag_id='0' && menu_positions='2' && approve_status='3' && language_id='2'  order by page_postion asc" ;
			$bottomrows=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
			 foreach($bottomrows as $key=>$value){ 
$title=$value['m_name'];
$page=$value['m_id'];
 ?>  
            	
					<li>
					 <?php if($page=='40') {?>
				  <a href="<?php echo $HomeURL;?>/hi/dlc/health--and-family-welfare-management-course.php" target="_self" title="<?php echo $title;?>"><?php echo $title;?></a>
				  <?php }
				  else if($page=='44') {?>
				  <a href="<?php echo $HomeURL;?>/hi/student/enrolled.php" target="_self" title="<?php echo $title;?>"><?php echo $title;?></a>
				  <?php }
				   else { ?>
				  	<a href="<?php echo $HomeURL.'/hi/cms/'.$value['m_url'];?>" target="_self" title="<?php echo $title;?>"><?php echo $title;?></a>

				  <?php } ?>
					</li>
				 <?php } ?>

					<!--<li><a href="<?php echo $HomeURL;?>/hi/project/reproductive-and-child-health-training--and-administrative-unit-hi.php" title="<?php echo $title;?>">परियोजनाएं</a></li>-->
				</ul>
            </div>


