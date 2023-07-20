 <div class="left-sidebar">
            <h3>Distance Learning Cell</h3>
            	
            </div>
<ul class="menu-class treeview">
<?php 
    //if($mydb->checkTable_threeRow("project_publish","m_flag_id",$rootid1,"menu_positions",1,"approve_status",3)>0){
      $whereClause="approve_status=3 && language_id=1 && m_flag_id=0  order by page_postion desc" ;
      $leftrows=$mydb->gettable_Rows_whereCluse("distance_learning_publish",$whereClause); 
    // }
?>
<?php foreach($leftrows as $key=>$value){
  // if($mydb->checkTable_threeRow("project_publish","m_publish_id",$value['m_publish_id'],"menu_positions",1,"approve_status",3)>0){
      $whereClause="approve_status=3 && language_id=1 && m_flag_id=".$value['m_publish_id']."  order by page_postion desc" ;
      $leftrows1=$mydb->gettable_Rows_whereCluse("distance_learning_publish",$whereClause); 

    if($value['m_url'] == 'health--and-family-welfare-management-course.php') 
        {
          $url_show = 'dlc-health-family-welfare-management-course.php';
                  $active1 = 'selected';
        }
    else if ($value['m_url'] == 'hospital-management-course.php') {
            $url_show = 'dlc-hospital-management-course.php';
                  $active1 = 'selected';
        }   
    else if ($value['m_url'] == 'health-promotion-course.php') {
            $url_show = 'dlc-health-promotion-course.php';
                  $active1 = 'selected';
        }    
    else if ($value['m_url'] == 'applied-epidemiology-course.php') {
            $url_show = 'dlc-applied-epidemiology-course.php';
                  $active1 = 'selected';
        }   
    else if ($value['m_url'] == 'health-communication-course.php') {
            $url_show = 'dlc-health-communication-course.php';
                  $active1 = 'selected';
        }
    else if ($value['m_url'] == 'public-health-nutrition-course.php') {
            $url_show = 'dlc-public-health-nutrition-course.php';
                  $active1 = 'selected';
        }
    else
    {
      $url_show = 'dlc/'.$value['m_url'];
                              $active1 = '';
    }       
//} 
        ?>
  <li class="has-sub collapsed expandable">
  <a role="link" title="<?php echo $value['m_name'];?>" class="icgmenuFirstNode" href="<?php echo $HomeURL;?>/<?php echo $url_show; ?>"><span><?php echo $value['m_name'];?></span></a>
<?php foreach($leftrows1 as $key=>$value1){
?>
  <ul class="ddsubmenustyle blackwhite">
  <li  class="collapsed expandable"><a role="link" title="<?php echo $value['m_name'];?>" href="<?php echo $HomeURL;?>/dlc/<?php echo $value1['m_url']; ?>"><?php echo $value1['m_name'];?></a></li>
  </ul>
  <?php }?>
  </li>
  <?php } ?>
  </ul>
  

