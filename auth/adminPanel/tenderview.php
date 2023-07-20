<?php ob_start();
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
$page_id = base64_decode($_GET['page_id']);

if($_SESSION['admin_auto_id_sess']=='')
	{		
		$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:index.php");
		exit;	
	}
if($_SESSION['saltCookie'] !=$_COOKIE['Temp'])
{
		session_unset($admin_auto_id_sess);
		session_unset($login_name);
		session_unset($dbrole_id);
		$msg = "Login to Access Admin Panel";
		$_SESSION['sess_msg'] = $msg ;
		header("Location:error.php");
		exit;	
}

$page_id1=content_desc($page_id);
 if(!is_numeric($page_id1))
{
        /*session_unset($admin_auto_id_sess);
        session_unset($login_name);
        session_unset($dbrole_id);*/
        $msg = "Login to Access Admin Panel";
        $_SESSION['sess_msg'] = $msg ;
        header("Location:error.php");
        exit();
}
$edit_tender ="select * from tender where m_id='$page_id1'";
$tender_result = mysqli_query($conn,$edit_tender);
$res_rows=mysqli_num_rows($tender_result);
$fetch_result=mysqli_fetch_array($tender_result);
@extract($fetch_result);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tender View Details: <?php echo $sitename;?></title>
<link href="style/admin.css" rel="stylesheet" type="text/css" />
<link href="style/popadmin.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>
</head>
<body>
<?php //include('top_header.php'); ?>
<div style="height:10px"></div>
<div class="heading-holder" style=" min-height:500px;">
          <div class="heading-area" >
            <h2><?php echo $m_name;?></h2>
          </div>
		   <div class="clear"></div>
		   <div style="height:10px"></div>

        <div>
        <?php if($m_content !=''){?>
		<span align="left" colspan="2" class="label1"><?php echo  stripslashes(html_entity_decode($m_content)); ?></span>
        <?php } else if($docs_file !='') {?>
        <span align="left" colspan="2" class="label1"><a href="../../upload/tender/<?php echo $docs_file; ?>">Download</a></span>
        <?php }
        else if($ext_url !='') {?>
        <span align="left" colspan="2" class="label1"><a href="<?php echo  $ext_url; ?>" target="_blank"><?php echo  $linkstatus; ?></a></span>
        <?php }?>
        
        </div>
      
  </div>   
    	 <div align="center"><input type="button" class="button" value="Close" onclick="MM_callJS('window.close();')" >
   
 </div>
	
	</body>
</html>
