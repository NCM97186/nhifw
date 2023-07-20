<?php ob_start();

@extract($_GET);
@extract($_POST);
@extract($_SESSION);
session_start();

			  ?>


    <!-- Grid Area start-->
  <div class="grid_area">
 <div id="menu_holder">
        <div id="menu">
          <div class="navigation_a" id="MainContent">
            <div class="topLinks">
           
<a href="welcome.php" title="Manage DashBoard" class="menuitem">DashBoard</a>
<a href="profile.php" title="Manage Profile" class="menuitem">View Profile</a>
	<?php 
	
	$user_id=$_SESSION['admin_auto_id_sess'];
	$user_role_id=$_SESSION['dbrole_id'];
$sql="SELECT * FROM admin_role where admin_role.user_id='$user_id'";

//echo $sql; die;
	$rs=mysqli_query($conn,$sql);
	$role_module=mysqli_fetch_array($rs);
	 $module_id =$role_module['module_id'];
        if($module_id=='ALL')
		  { 
			?>
		<a href="manage_user.php" title="User Management" class="menuitem submenuheader">User Management</a>
				<div class="submenu">

				<ul>
				<li class="menuitem"><a href="manage_user.php" title="Manage User" >Manage User</a></li> 
				<li class="menuitem"><a href="manage_role.php" title="Manage Role" >Manage Role</a></li> 
				</ul>
			</div>
			
			<!-- <a href="manage_onlineform.php" title="User Management" class="menuitem submenuheader">Managed by Admin</a> -->
			<a href="welcome.php" title="User Management" class="menuitem submenuheader">Managed by Admin</a>
				<div class="submenu">
			<ul>
			
			<li class="<?php echo $uclass2; ?>"><a title="Manage Employee Category" href="emp_category.php">Manage Employee Category </a></li>
			<li class="<?php echo $uclass2; ?>"><a title="Manage Publication Category" href="publication_category.php">Manage Publication Category </a></li>
			<li class="<?php echo $uclass2; ?>"><a title="Manage What's New" href="manage_whatsnew_archive.php">Archive What's New </a></li>
			<li class="<?php echo $uclass2; ?>"><a title="Manage Meeting / Workshop" href="manage_latest_information_archive.php">Archive Meeting / Workshop </a></li>
			<li class="<?php echo $uclass2; ?>"><a title="Manage Important Information" href="manage_importent_information_archive.php">Archive Important Information </a></li>
			<li class="<?php echo $uclass2; ?>"><a title="Manage Tenders" href="manage_tenders_archive.php">Archive Tenders </a></li>
			<li class="<?php echo $uclass2; ?>"><a title="Manage Vacancy" href="manage_recruitment_archive.php">Archive Vacancy </a></li>

			</ul>
			</div>
			<?php  
			$query="Select * FROM module where module_status ='Active' and publish_id_module !='2'  order by `module_id` asc"; 
			 $query=mysqli_query($conn,$query)	;
			while($data=mysqli_fetch_array($query))
			{
			@extract($data);
			?>
	<a href="<?php echo $page_url;?>" title="<?php echo $module_name;  ?>" class="menuitem"><?php echo $module_name; ?></a>
	<?php }?>
	<?php  
			$sqlquery="Select * FROM module where module_status ='Active' and publish_id_module ='2'  order by `module_id` DEsc"; 
			 $query=mysqli_query($conn,$sqlquery)	;
			
			?>

			<a href="javascript:void(0);" title="National Documentation Centre" class="menuitem submenuheader">Manage NDC</a>
			<div class="submenu">
		<ul>
			<li class="<?php echo $uclass1; ?>"><a href="manage_ndc_lhn.php" title="Latest Health News">Latest Health News</a></li>
		<li class="<?php echo $uclass1; ?>"><a href="manage_ndc_health_repository.php" title="Health News Repository">Health News Repository</a> </li>
		<li class="<?php echo $uclass1; ?>"><a href="manage_ndc_current_awareness_services.php" title="Current Awareness Service">Current Awareness Service</a> </li>
<li class="<?php echo $uclass1; ?>">
	<a href="manage_ndc_health_family_welfare.php" title="Health and Family Welfare">Health and Family Welfare</a>
</li>
<li class="<?php echo $uclass1; ?>">
	<a href="manage_ndc_training_courses.php" title="Training Courses">  Training Courses</a>
</li>

<li class="<?php echo $uclass1; ?>"><a href="javascript:void(0);" title="Rare and Special Collections ">Rare and Special Collections </a> 
					<ul>
					<li class="menuitem"><a title="Add Gallery Categories" href="manage_ndc_legislations.php">Legislations</a></li>
				</ul>
		</li>
		
		</ul>
			
		</div>	

		<a href="javascript:void(0);" title="Distance Learning Cell" class="menuitem submenuheader">Manage DLC</a>
 <div class="submenu">
<ul>
 <li class="<?php echo $uclass1; ?>"><a href="manage_dlc_hfwmc.php" title="Latest Health News">Health & Family Welfare management Course</a></li>
 <li class="<?php echo $uclass1; ?>">
 	<a href="manage_dlc_hmc.php" title="Health News Repository">Hospital Management Course</a> 
 </li>
		<li class="<?php echo $uclass1; ?>"><a href="manage_dlc_hpc.php" title="Current Awareness Service">Health Promotion Course</a> </li>
<li class="<?php echo $uclass1; ?>">
	<a href="manage_dlc_phnc.php" title="Health and Family Welfare">Public Health Nutrition Course</a>
</li>
<li class="<?php echo $uclass1; ?>">
	<a href="manage_dlc_aec.php" title="Training Courses">  Applied Epidemiology Course</a>
</li>
<li class="<?php echo $uclass1; ?>"><a href="manage_dlc_hcc.php" title="Rare and Special Collections ">Health Communication Course</a> 	 
		</li>
 
</ul> 
</div> 
			<!-- <a href="manage_publication.php" title="Manage Training" class="menuitem">Manage Publication</a> -->
			<a href="manage_training.php" title="Manage Training" class="menuitem">Manage Training</a>
	<a href="#" title="Manage Media" class="menuitem submenuheader">Manage Media Center</a>
		<div class="submenu">
			<ul>
			<?php while($res=mysqli_fetch_array($query))
			{
			@extract($res); ?>
			<li class="<?php echo $uclass1; ?>">
				<a href="<?php echo $page_url;?>" title="<?php echo $module_name;  ?>"><?php echo $module_name;  ?> </a>
			<?php 
			} 
			?>
				<ul>
						<li class="menuitem">
							<a title="Add Gallery Categories" href="gallery-category.php">Add Category</a>
						</li>
				</ul>
			</li>
		</ul>
		</div>
		  <?php 
		  }
	  else
	  {	
		
	$query="SELECT map_role.module_id,map_role.role_id,module.module_name,module.page_url FROM map_role join module on module.module_id=map_role.module_id where map_role.user_id ='$user_id' and module.publish_id_module!='2' and publish_id_module!='3' order by `map_role`.`module_id` ASC"; 
			$query=mysqli_query($conn,$query)	;
			while($result=mysqli_fetch_array($query))
			{
			@extract($result);
			?>
				 <ul>
				<li><a href="<?php echo $page_url;?>" title="<?php echo $module_name;  ?>" class="menuitem"><?php echo $module_name; ?></a></li> 

			<?php }
$sqlquery="SELECT map_role.module_id,map_role.role_id,module.module_name,module.page_url FROM map_role join module on module.module_id=map_role.module_id where map_role.role_id ='$user_role_id' and publish_id_module ='2' and publish_id_module!='1' and publish_id_module!='3' order by `map_role`.`module_id` DESC";


		 $query=mysqli_query($conn,$sqlquery);
		 $num=mysqli_num_rows($conn,$sqlquery);
				?>
				
				 <a href="#" title="Manage Media Center" class="menuitem submenuheader">Manage Media Center</a>
					<div class="submenu">
					<ul>
						
							<?php 
								while($data=mysqli_fetch_array($query))
							{
							@extract($data);
							///echo $module_id;
							 ?>
							<li class="<?php echo $uclass1; ?>"><a href="<?php echo $page_url;?>" title="<?php echo $module_name;  ?>"><?php echo $module_name;  ?></a>
						<?php } ?>
				<ul>
					<li class="menuitem"><a title="Add Gallery Categories" href="gallery-category.php">Add Category</a></li>
				</ul>
			
			</li>
			
		</ul>
				</div>	
			




     <?php 


}
   ?>
  
				


		            </ul>
            </div>
          </div>
        </div>
      </div>
<script src="js/jquery-1.9.0.js"></script>
<script src="js/jquery-migrate-1.0.0.js"></script>
<script type="text/javascript" src="js/ddaccordion.js"></script>
