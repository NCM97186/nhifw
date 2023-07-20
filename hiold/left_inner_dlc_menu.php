 <div class="left-sidebar">
            <h3>Distance Learning Cell</h3>
            	
            </div>
<ul class="menu-class treeview">
<?php 
		//if($mydb->checkTable_threeRow("project_publish","m_flag_id",$rootid1,"menu_positions",1,"approve_status",3)>0){
			$whereClause="approve_status='3' && language_id='2' && m_flag_id='0'  order by page_postion desc" ;
			$leftrows=$mydb->gettable_Rows_whereCluse("distance_learning_publish",$whereClause); 
		// }
?>
<?php foreach($leftrows as $key=>$value){
	// if($mydb->checkTable_threeRow("project_publish","m_publish_id",$value['m_publish_id'],"menu_positions",1,"approve_status",3)>0){
			$whereClause="approve_status='3' && language_id='2' && m_flag_id=".$value['m_publish_id']."'  order by page_postion desc" ;
			$leftrows1=$mydb->gettable_Rows_whereCluse("distance_learning_publish",$whereClause); 
//} ?>
  <li class="has-sub collapsed expandable">
  <a role="link" title="<?php echo $value['m_name'];?>" class="icgmenuFirstNode" href="<?php echo $HomeURL;?>/hi/dlc/<?php echo $value['m_url']; ?>"><span><?php echo $value['m_name'];?></span></a>
<?php foreach($leftrows1 as $key=>$value1){
?>
  <ul class="ddsubmenustyle blackwhite">
  <li  class="collapsed expandable"><a role="link" title="<?php echo $value['m_name'];?>" href="<?php echo $HomeURL;?>/hi/dlc/<?php echo $value1['m_url']; ?>"><?php echo $value1['m_name'];?></a></li>
  </ul>
  <?php }?>
  </li>
  <?php } ?>
  </ul>
  

