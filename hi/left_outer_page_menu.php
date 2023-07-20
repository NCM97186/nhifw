 <?php 
if($_SERVER['REQUEST_URI'])
{
		 $url=mysqli_real_escape_string($conn,$_SERVER['REQUEST_URI']);  
		 $val=explode('/', $url); 
		 $url=$val['2'];
		$open=$val['1'];
		
		if($mydb->checkTable_threeRow("menu_publish","m_url",$url,"approve_status",3,"language_id",1)>0){
			$contentrows=$mydb->gettable_RowsthreeColumn_where("menu_publish","m_url",$url,"approve_status",3,"language_id",1);
		}

	//	print_R($contentrows); die();
		foreach($contentrows as $key=>$value){ 

			$page_id=$value['m_publish_id'];
			$page_name=$value['m_name'];
			$position=$value['menu_positions'];
			$rootid=get_root_parent($page_id);
			$parentid=parentid($page_id);
			$m_name=get_page($page_id);
			$m_url=$value['m_url'];
			$sub_flag_id=$value['m_id'];
			$title=$value['m_name'];
			$page='content';
			
			if($page_id!='0' && $page_id!='')
			{

			$method="mapping";
			$pgprntnams=pagebreadcrumb($page_id,0,$method,1,$page);
			$btitle=pagebreadcrumb1($page_id,0,$method,1,$page);
			
			}
			$body=stripslashes(html_entity_decode($value['content']));
		}
}

$page=base64_decode($_GET['page']);
if($page!='') {
 ?>
<!--<ul class="menu-class treeview">-->

	<?php 
			$whereClause="m_flag_id='".$page."' && menu_positions='3' && approve_status='3' && language_id='1' order by page_postion asc" ;
			$bottomrows=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
		 foreach($bottomrows as $key=>$value){	?>

			<?php } ?>

			<?php }
			else if($position=='3' || $position=='2') { ?>
			
	<div class="left-sidebar">
   <h3><?php echo $m_name;?></h3>
</div>

<ul class="menu-class treeview">
	<?php 
		if($mydb->checkTable_threeRow("menu_publish","m_flag_id",$rootid,"menu_positions",3,"approve_status",3)>0){
		
			$whereClause="m_flag_id='$rootid' && menu_positions='3' && approve_status='3' && language_id='1'  order by page_postion asc" ;
			$leftrows=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
			
			$num=$mydb->countTableRow("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",1,"approve_status",3);
		 }
		 
?>
	<?php foreach($leftrows as $key=>$value){
			 if($mydb->checkTable_threeRow("menu_publish","m_publish_id",$value['m_publish_id'],"menu_positions",3,"approve_status",3)>0){
				$leftrows1=$mydb->gettable_RowsfourColumn_where("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",3,"approve_status",3,"language_id",1);
				$num1=$mydb->countTableRow("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",3,"approve_status",3,"language_id",1);
			} 
			$class="";
			if($value['m_url']==$url)
			{
			$class="selected";
			}
				
			$sql1 = mysqli_query($conn,"select * from menu_publish where m_flag_id='".$value['m_publish_id']."' and menu_positions='3' and language_id='1' and approve_status='3' ORDER BY page_postion ASC");
			$row2 = mysqli_num_rows($sql1);

		//if($row2 == 0 ){ ?>
		<li>
		<a href="<?php echo $HomeURL;?>/cms/<?php echo $value['m_url']; ?>" title="<?php echo $value['m_name'];?>" class="<?php echo $class; ?>"><?php echo $value['m_name'];?></a>
		</li>
<?php	//} 
 }?>
			</ul>

		<?php 	
		
			}	
			
  