<ul class="projects">
<?php 
		if($mydb->checkTable_TwoRow("menu_publish","m_flag_id",226,"approve_status",3)>0){
			//$leftrows=$mydb->gettable_RowsthreeColumn_where("project_publish","m_flag_id",$rootid,"approve_status",3,"language_id",1);
			$whereClause="m_flag_id='226' && approve_status='3' && language_id='2' order by page_postion asc limit 0,6" ;
			$leftrows=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause);
		 }
?>
<?php foreach($leftrows as $key=>$value){
		 ?>
  <li>
  <a title="<?php echo $value['m_name'];?>"  href="<?php echo $HomeURL;?>/hi/cms/<?php echo $value['m_url']; ?>"><span><?php echo $value['m_name'];?></span></a> 
  </li>
  <?php } ?>
  </ul>
 
	<div style="text-align:right;" class="heading"><a href="<?php echo $HomeURL;?>/hi/viewall_project.php"  title="View All projects">सभी देखें</a></div>
	