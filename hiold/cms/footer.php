<div class="row">
            <div class="container">
            <?php 
		if($mydb->checkTable_threeRow("menu_publish","m_flag_id",0,"menu_positions",3,"approve_status",3)>0){
		
			$whereClause="m_flag_id='0' && menu_positions='3' && approve_status='3' && language_id='2' and m_publish_id!='290'order by page_postion asc limit 0,4" ;
			$leftrows=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
			//$leftrows=$mydb->gettable_RowsthreeColumn_where("menu_publish","m_flag_id",0,"menu_positions",1,"approve_status",3);
			$num=$mydb->countTableRow("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",1,"approve_status",3);
		 }
?>
<?php foreach($leftrows as $key=>$value){
			 if($mydb->checkTable_threeRow("menu_publish","m_publish_id",$value['m_publish_id'],"menu_positions",3,"approve_status",3)>0){
			//$leftrows1=$mydb->gettable_RowsfourColumn_where("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",3,"approve_status",3,"language_id",1);
			$whereClause="m_flag_id='".$value['m_publish_id']."' && menu_positions='3' && approve_status='3' && language_id='2' order by page_postion asc limit 0,5" ;
			$leftrows1=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
			$num1=$mydb->countTableRow("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",3,"approve_status",3,"language_id",1);
				} 
			if($value['m_url']==$url)
			{
			$class="active";
			} ?>



            <div class="col-md-3">
            <h3 class="footer-heading"><a href="#" title="<?php echo $value1['m_name'];?>"><?php echo $value['m_name'];?></a></h3>
            
              <ul class="footer">
               <?php foreach($leftrows1 as $key=>$value1){	?>

              <?php if($value1['doc_uplode']!='') {?>
				<li><a href="<?php echo $HomeURL;?>/upload/<?php echo $value1['doc_uplode']; ?>" title="<?php echo $value1['m_name'];?>" target="_blank"><?php echo $value1['m_name'];?></a></li>
			<?php } else if($value1['linkstatus']!='') {?>
			 <li><a href="<?php echo $value1['linkstatus'];?>" title="<?php echo $value1['m_name'];?>" target="_blank" onclick="return sitevisit();"><?php echo $value1['m_name'];?></a></li>
			<?php } else { ?>
		<li><a href="<?php echo $HomeURL;?>/hi/cms/<?php echo $value1['m_url']; ?>" title="<?php echo $value1['m_name'];?>"><?php echo $value1['m_name'];?></a></li>


              <?php } }?>
              </ul>
              
              <div class="v-all"><a href="<?php echo $HomeURL;?>/hi/cms/<?php echo $value1['m_url']; ?>" title="सभी देखें">सभी देखें</a></div>
              
              </div>
              <?php } ?>
              
           
		   <?php 
		if($mydb->checkTable_threeRow("menu_publish","m_flag_id",0,"menu_positions",1,"approve_status",3)>0){
		
			$whereClause="m_flag_id='0' && menu_positions='1' && approve_status='3' && language_id='2' and m_publish_id='228'order by page_postion asc limit 0,4" ;
			$leftrows=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
			//$leftrows=$mydb->gettable_RowsthreeColumn_where("menu_publish","m_flag_id",0,"menu_positions",1,"approve_status",3);
			$num=$mydb->countTableRow("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",1,"approve_status",3);
		 }
?>
<?php foreach($leftrows as $key=>$value){
			 if($mydb->checkTable_threeRow("menu_publish","m_publish_id",$value['m_publish_id'],"menu_positions",1,"approve_status",3)>0){
			//$leftrows1=$mydb->gettable_RowsfourColumn_where("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",3,"approve_status",3,"language_id",1);
			$whereClause="m_flag_id='".$value['m_publish_id']."' && menu_positions='1' && approve_status='3' && language_id='2' order by page_postion asc limit 0,5" ;
			$leftrows1=$mydb->gettable_Rows_whereCluse("menu_publish",$whereClause); 
			$num1=$mydb->countTableRow("menu_publish","m_flag_id",$value['m_publish_id'],"menu_positions",1,"approve_status",3,"language_id",1);
				} 
			if($value['m_url']==$url)
			{
			$class="active";
			} ?>



            <div class="col-md-3">
            <h3 class="footer-heading"><a href="#" title="<?php echo $value1['m_name'];?>"><?php echo $value['m_name'];?></a></h3>
            
              <ul class="footer">
               <?php foreach($leftrows1 as $key=>$value1){	?>

              <?php if($value1['doc_uplode']!='') {?>
				<li><a href="<?php echo $HomeURL;?>/upload/<?php echo $value1['doc_uplode']; ?>" title="<?php echo $value1['m_name'];?>" target="_blank"><?php echo $value1['m_name'];?></a></li>
			<?php } else if($value1['linkstatus']!='') {?>
			 <li><a href="<?php echo $value1['linkstatus'];?>" title="<?php echo $value1['m_name'];?>" target="_blank" onclick="return sitevisit();"><?php echo $value1['m_name'];?></a></li>
			<?php } else { ?>
		<li><a href="<?php echo $HomeURL;?>/hi/cms/<?php echo $value1['m_url']; ?>" title="<?php echo $value1['m_name'];?>"><?php echo $value1['m_name'];?></a></li>


              <?php } }?>
              </ul>
              
              <div class="v-all"><a href="<?php echo $HomeURL;?>/hi/cms/<?php echo $value1['m_url']; ?>" title="सभी देखें">सभी देखें</a></div>
              
              </div>
              <?php } ?>
              
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
              
            </div>
        </div>
	</div>
    
	<div class="container-fluid background-dark-black">
    	<div class="container">
			<div class="footer-left">  </div>
			
    		<div class="footer-left">इस वेबसाइट पर सामग्री स्वास्थ्य और परिवार कल्याण के राष्ट्रीय संस्थान द्वारा प्रकाशित और प्रबंधित की गई है। कॉपीराइट © 2017. सभी अधिकार सुरक्षित<br>
			<?php  $sqlv=mysqli_query($conn,"select * from visitors");
				$countv=mysqli_num_rows($sqlv);
				?>
				<?php  $sql=mysqli_query($conn,"SELECT page_action_date 
					FROM  audit_trail 
					ORDER BY  page_action_date DESC 
					LIMIT 0,1");
					$row=mysqli_fetch_array($sql);
					$date=explode(' ',$row['page_action_date']);
					$m=explode('-',$date[0]);
					$d=$m[0];
					$d1=$m[1];
					$d2=$m[2];

					?>
अंतिम अपडेट: <?php echo $d2.'-'.$d1.'-'.$d;?>&nbsp;&nbsp;आगंतुक काउंटर - <?php echo $countv;?>  </div>
    		<div class="footer-right icons-p">
            <ul class="social-icons icon-circle icon-rotate list-unstyled list-inline"> 
	      <li> <a href="#" title="Facebook" onclick="return sitevisit();"><i class="fa fa-facebook"></i> <span class="hidethis">Facebook</span> </a></li>  
	      <li> <a href="#" title="Twitter" onclick="return sitevisit();"><i class="fa fa-twitter"></i> <span class="hidethis">Twitter</span> </a></li> 
	      <li> <a href="#" title="Youtube" onclick="return sitevisit();"><i class="fa fa-youtube"></i> <span class="hidethis">Youtube</span> </a></li>   
	  	</ul>
            
            </div>
    	</div>

<script type="text/javascript">
function sitevisit()
{
	var returnvalue = confirm("This is an external link.Do you want to continue.");
	if(returnvalue == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}


</script>
	 