<div class="container">
   <ul class="clearfix sf-menu" id="example">
      <li class="current"><a href="<?php echo $HomeURL;?>" title="Home">Home</a></li>
      <?php 
         if($mydb->checkTable_threeRow("menu_publish","m_flag_id",0,"menu_positions",1,"approve_status",3)>0){
  
         	$whereClause="m_flag_id='0' && menu_positions='1' && approve_status='3' && language_id='1' and m_publish_id!=67 order by page_postion asc" ;
         	$leftrows=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
         	//$leftrows=$mydb->gettable_RowsthreeColumn_where("menu_publish","m_flag_id",0,"menu_positions",1,"approve_status",3);
         	$num=$mydb->countTableRow("menu_publish","m_flag_id","menu_positions",1,"approve_status",3);
          
          }
        
         ?>
      <?php foreach($leftrows as $key=>$value){
         if($mydb->checkTable_threeRow("menu_publish","m_publish_id",$value['m_publish_id'],"menu_positions",1,"approve_status",3)>0){
         $whereClause="m_flag_id='".$value['m_publish_id']."' && menu_positions='1' && approve_status='3' && language_id='1' order by page_postion asc" ;
         $leftrows1=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
         
         //$leftrows1=$mydb->gettable_RowsfourColumn_where("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",1,"approve_status",3,"language_id",1);
         
         $num1=$mydb->countTableRow("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",1,"approve_status",3,"language_id",1);
         } 
         if($value['m_url']==$url)
         {
         $class="active";
         }	
         
         $sql1 = mysqli_query($conn,"select * from menu_publish where m_flag_id='".$value['m_publish_id']."' and menu_positions='1' and language_id='1' and approve_status='3' ORDER BY page_postion ASC");
         //echo $value['m_name']."".
         $row2 = mysqli_num_rows($sql1);
          if($row2 > 0){ ?>
      <li class="<?php if($num1 >0) {echo "has-sub";} echo $class;?>">
         <a href="#" title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a> 
         <?php if($num1 >0) { ?>
         <ul>
            <?php foreach($leftrows1 as $key=>$value1){	
               if($mydb->checkTable_threeRow("menu_publish","m_publish_id",$value1['m_publish_id'],"menu_positions",1,"approve_status",3)>0){
               $leftrows3=$mydb->gettable_RowsfourColumn_where("menu_publish","m_flag_id",$value1['m_publish_id'],"menu_positions",1,"approve_status",3,"language_id",1);
               $num2=$mydb->countTableRow("menu_publish","m_flag_id",$value1['m_publish_id'],"menu_positions",1,"approve_status",3,"language_id",1);
               }
                $sql2 = mysqli_query($conn,"select * from menu_publish where m_flag_id='".$value1['m_publish_id']."' and menu_positions='1' and language_id='1' and approve_status='3' ORDER BY page_postion ASC");
                $row3 = mysqli_num_rows($sql2);
                
               if($row3 > 0){
               ?>
	            <li>
	               <a href="<?php echo $HomeURL;?>/cms/<?php echo $value1['m_url']; ?>" title="<?php echo $value1['m_name'];?>"><?php echo $value1['m_name'];?></a>
	               <?php  if($num2 >0) { ?>
	               <ul>
	                  <?php foreach($leftrows3 as $key=>$value3){
	                     if($value3['doc_uplode']=='') {?>
	                  <li><a href="<?php echo $HomeURL;?>/cms/<?php echo $value3['m_url']; ?>" title="<?php echo $value3['m_name'];?>"><?php echo $value3['m_name'];?></a></li>
	                  <?php } 
	                     elseif($value3['linkstatus']!='') {?>
	                  <li><a href="<?php echo $value3['linkstatus']; ?>" title="<?php echo $value3['m_name'];?>"><?php echo $value3['m_name'];?></a></li>
	                  <?php }
	                     else { ?>
	                  <li><a href="<?php echo $HomeURL;?>/upload/<?php echo $value3['doc_uplode']; ?>" title="<?php echo $value3['m_name'];?>" target="_blank"><?php echo $value3['m_name'];?></a></li>
	                  <?php }
	                     }  ?>
	               </ul>
	               <?php } ?>
            	</li>
            <?php } elseif($row3 == 0 ){ ?>
            	<?php if($value1['doc_uplode']!='') {?>
            		<li><a href="<?php echo $HomeURL;?>/upload/<?php echo $value1['doc_uplode']; ?>" title="<?php echo $value1['m_name'];?>" target="_blank"><?php echo $value1['m_name'];?></a></li>
	            <?php } elseif($value1['linkstatus']!='') {?>
	            	<li><a href="<?php echo $value1['linkstatus']; ?>" title="<?php echo $value1['m_name'];?>"><?php echo $value1['m_name'];?></a></li>
	            <?php }  else { ?>
	            	<li><a href="<?php echo $HomeURL;?>/cms/<?php echo $value1['m_url']; ?>" title="<?php echo $value1['m_name'];?>"><?php echo $value1['m_name'];?></a></li>
	            <?php } ?>

             <?php  } 
               	}  ?>
         </ul>
         <?php } ?>
      </li>
      <?php } elseif($row2 == 0 ){ ?>
     	 <li><a href="<?php echo $HomeURL;?>/cms/<?php echo $value['m_url']; ?>" title="<?php echo $value['m_name'];?>"><?php echo $value['m_name'];?></a></li>
      <?php	}  }?>
   </ul>
</div>