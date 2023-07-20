<?php
// error_reporting(E_ALL); ini_set('display_errors', 1);
ini_set('session.cookies_samesite', 'Lax');
ob_start();
session_start();
include("../../includes/config.inc.php");
include("../../includes/useAVclass.php");
include("../../includes/functions.inc.php");
include("../../includes/def_constant.inc.php");

@extract($_GET);
@extract($_POST);
@extract($_SESSION);

$useAVclass = new useAVclass();
$useAVclass->connection();

if ($_SESSION['admin_auto_id_sess'] == '') {
    session_unset($admin_auto_id_sess);
    session_unset($login_name);
    session_unset($dbrole_id);
    $msg = "Login to Access Admin Panel";
    $_SESSION['sess_msg'] = $msg;
    header("Location:index.php");
    exit;
}
if ($_SESSION['saltCookie'] != $_COOKIE['Temp']) {
    session_unset($admin_auto_id_sess);
    session_unset($login_name);
    session_unset($dbrole_id);
    $msg = "Login to Access Admin Panel";
    $_SESSION['sess_msg'] = $msg;
    header("Location:error.php");
    exit;
}

else {
   
		$_COOKIE['Temp']="";
		$_SESSION['saltCookie']="";
		$_SESSION['Temptest']="";
		$saltCookie =uniqid(rand(59999, 199999));
		$_SESSION['saltCookie'] =$saltCookie;
		$_SESSION['Temptest']=$_SESSION['saltCookie'];
		setcookie("Temp",$_SESSION['saltCookie']);
		$_SESSION['logtoken'] =md5(uniqid(mt_rand(), true));
	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dashboard: <?php echo $sitename;?> </title>
</title> 
<link rel="SHORTCUT ICON" href="images/favicon.ico" />
<link href="style/admin.css" rel="stylesheet" type="text/css">
<link href="style/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/access.js"></script>
<script type="text/javascript" src="js/jquery-1.9.0.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.0.0.js"></script>
<script type="text/javascript" src="js/validation.js"></script>


<script type = "text/javascript" >
       function burstCache() {
        if (!navigator.onLine) {
            document.body.innerHTML = 'Loading...';
            window.location = 'index.php';
        }
    }
</script>
<script>
var a=navigator.onLine;
if(a){
//alert('online');
}else{
alert('ofline');
window.location='index.php';
} </script>
<script>
var a=navigator.onLine;
if(a){
//alert('online');
}else{
alert('ofline');
window.location='index.php';
} </script>


<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="style/ie7.css">
<![endif]-->




                    </head>
                    <body class="noJS">
<?php include('top_header.php'); ?>
                           
                    
                    <div id="welcome_p">
                        <div id="container">

                      
<?php
include_once('main_menu.php');
?>
                            <!-- Header end -->

                            <div class="main_con">
                                <div class="right_col1">
                                
                                    <div class="dashboard">
                                    <div class="dashboard_heading">
                                   
                                    <h3> Dashboard : <?php echo $browsertitle;?> </title>
 </h3>
                                    </div>
									
									
									
									
									
                                    <div class="das-box">
                                        <ul>
										
                                         			
<?php
//print_r($_SESSION);
	$user_id=$_SESSION['admin_auto_id_sess'];
	$user_role_id=$_SESSION['dbrole_id'];
$sql="SELECT * FROM admin_role where admin_role.user_id='$user_id'";
	$rs=mysqli_query($conn,$sql)	;
	$role_module=mysqli_fetch_array($rs);
	 $module_id =$role_module['module_id'];
        if($module_id=='ALL')
		  { ?>
     <li><a href="manage_user.php" title="Manage User"><img src="images/manage_user.png" alt="Manage User" width="35" height="37" border="0" /><br />
                                                    Manage User</a></li>
													<li><a href="manage_role.php" title="Manage Role"><img src="images/managerole.png" alt="Manage Role" width="35" height="37" border="0" /><br />
                                                    Manage Role</a></li>

												 <li><a href="profile.php" title="Manage Profile"><img src="images/manageprofile.png" alt="Manage Profile" width="35" height="37" border="0" /><br />
                                                    Manage Profile</a></li>
													<li><a href="manage_menu.php" title="Manage Menu"><img src="images/managecontent.png" alt="Manage Schemes" width="35" height="37" border="0" />  Manage Menu</a></li>
                                         			 <!-- <li><a href="profile.php" title="Manage Profile"><img src="images/manageprofile.png" alt="Manage Profile" width="35" height="37" border="0" /><br />
                                                    Manage Profile</a></li> -->
													
                                                    
                                         			 <li><a href="manage_audit.php" title="Manage Audit Trail"><img src="images/audit_icon.png" alt=" Manage Audit Trail" width="35" height="37" border="0" /><br />
                                                    Manage Audit Trail</a></li>
													  <li><a href="manage_whatsnew.php" title="Manage What's New"><img src="images/news.png" alt="Manage What's New" width="35" height="37" border="0" /><br />
                                                   Manage What's New</a></li>
													
													
                                         			 <li><a href="manage_tenders.php" title="Manage Tender"><img src="images/tender.jpg" alt="Manage Tender" width="35" height="37" border="0" /><br />
													
                                                   Manage Tender</a></li>
												   
													 <li><a href="manage_student.php" title="Manage Student"><img src="images/students.jpg" alt="Manage Student" width="35" height="37" border="0" /><br />
                                                   Manage Student</a></li>
													
                                         			
														
														
														


  
                                        <?php     
                                            } 
											
											
											else {
                            $query="SELECT map_role.module_id,map_role.role_id,module.module_name,module.page_url FROM map_role join module on module.module_id=map_role.module_id where map_role.user_id ='$user_id' and module.publish_id_module!='2' and module.publish_id_module!='1' and module.publish_id_module='3' order by `map_role`.`module_id` ASC"; 
			$rs = mysqli_query($conn,$sql);
			$query=mysqli_query($conn,$query)	;
			while($result=mysqli_fetch_array($query))
			{
			@extract($result);
		
				echo $id=$data['publish_id_module'];
							@extract($data);
							///echo $module_id;
							 ?>
					<?php if($id=='3') {?>
					<li class="<?php echo $uclass1; ?>"><a href="<?php echo "application/".$page_url;?>" title="<?php echo $module_name;  ?>"><?php echo $module_name;  ?></a>
						<?php } else { ?>
					<li class="<?php echo $uclass1; ?>"><a href="<?php echo "application/".$page_url;?>" title="<?php echo $module_name;  ?>"><?php echo $module_name;  ?></a>

			<?php } }
			
			 $query="SELECT map_role.module_id,map_role.role_id,module.module_name,module.page_url FROM map_role join module on module.module_id=map_role.module_id where map_role.user_id ='$user_id' and module.publish_id_module!='2' and module.publish_id_module='1' and module.publish_id_module!='3' order by `map_role`.`module_id` ASC"; 
				$rs = mysqli_query($conn,$sql);
				$query=mysqli_query($conn,$query)	;
			while($result=mysqli_fetch_array($query))
			{
			@extract($result);
		
				 $id=$data['publish_id_module'];
							@extract($data);
							///echo $module_id;
							 ?>
					
					<li class="<?php echo $uclass1; ?>"><a href="<?php echo $page_url;?>" title="<?php echo $module_name;  ?>"><?php echo $module_name;  ?></a>
					
			<?php } 
                                       
					$sqlquery="SELECT map_role.module_id,map_role.role_id,module.module_name,module.page_url FROM map_role join module on module.module_id=map_role.module_id where map_role.role_id ='$user_role_id' and publish_id_module ='2' order by `map_role`.`module_id` DESC";


		
			$query=mysqli_query($conn,$sqlquery)	;
			while($result=mysqli_fetch_array($query))
			{
			@extract($result);
			?>
				
				<li><a href="<?php echo $page_url;?>" title="<?php echo $module_name;  ?>" class="menuitem"><?php echo $module_name; ?></a></li> 

			<?php }
				
				}
				?>  				   


							<li><a href="logout.php?random=<?php echo $_SESSION['logtoken']; ?>" title="Logout"><img src="images/dashboard_images/logout.png"  alt="Logout" width="35" height="37" border="0"/><br/>Logout</a></li>


                                        </ul>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="cpanel-right">
                                    <div class="cpanel-right_heading"><h3>Last 4 Activity</h3>  </div>
                                    
                                    
                                        <table width='100%' border='0' cellpadding="0" cellspacing="0">
                                            <tr>
                                                <th width="25%">Name</th>
                                                <th width="15%">User Id</th>
                                                <th width="25%">Date</th>
                                                <th width="15%">Activity</th>
                                                <th width="20%">IP Address</th>
                                            </tr>
											
											  <?php
											  
											  
											  		
			
			   if($_SESSION['admin_auto_id_sess'] == true){

			   $sqlal = "UPDATE admin_login SET login_flag = '1', login_count = login_count + 1 WHERE id = '".$user_id."'";
               mysqli_query($conn,$sqlal);
			   
			   }
			
			
                                            $sql = "SELECT admin_login.*	FROM admin_login INNER JOIN  `audit_trail` ON  `audit_trail`.user_login_id = admin_login.id
			WHERE 1 ORDER BY  `audit_trail`.`audit_id` DESC LIMIT 0 , 4";
                                            $sqlresult = mysqli_query($conn,$sql);
                                            $res_rows = mysqli_num_rows($sqlresult);
                                            if ($res_rows > 0) {
                                                while ($data = mysqli_fetch_array($sqlresult)) {
													
													//echo '<pre/>';print_r($data);
                                                    @extract($data);
                                                    if ($class == "odd") {
                                                        $class = "even";
                                                    } else {
                                                        $class = "odd";
                                                    }
												}
											}
                                                    ?>


                                             <?php
                                            $sql = "SELECT admin_login.user_name, admin_login.login_name,  `audit_trail`.user_login_id,  `audit_trail`.page_action,  `audit_trail`.page_action_date, `audit_trail`.ip_address
			FROM admin_login INNER JOIN  `audit_trail` ON  `audit_trail`.user_login_id = admin_login.id
			WHERE 1 ORDER BY  `audit_trail`.`audit_id` DESC LIMIT 0 , 4";
                                            $sqlresult = mysqli_query($conn,$sql);
                                            $res_rows = mysqli_num_rows($sqlresult);
                                            if ($res_rows > 0) {
                                                while ($data = mysqli_fetch_array($sqlresult)) {
													
													//print_r($data);
                                                    @extract($data);
                                                    if ($class == "odd") {
                                                        $class = "even";
                                                    } else {
                                                        $class = "odd";
                                                    }
                                                    ?>


                                                    <tr class="<?php echo $class; ?>">
                                                        <td><?php echo $user_name; ?></td>
                                                        <td><?php echo $login_name; ?></td>
                                                        <td><?php echo date("d-m-Y H:i:s", strtotime($page_action_date)); ?></td>
                                                        <td><?php echo $page_action; ?></td>
                                                        <td><?php echo $ip_address; ?></td>
                                                    </tr>


                                                <?php }
                                            } ?>

                                        </table>


                                    </div>
                                    <div class="clear"></div> 

                                </div><!-- right col -->

                                <div class="clear"></div>

                                <!-- Content Area end -->

                            </div>  <!-- main con-->

                            <!-- Footer start -->

<?php include("footer.inc.php"); ?>
                            <!-- Footer end -->

                        </div> <!-- Container div-->
</div>
</div>
                    </body>
                    </html>
