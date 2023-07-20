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
$page_id1=content_desc(base64_decode($page_id));
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
$edit_contrator ="select * from whatsnew where m_id='$page_id1'";
$contrator_result = mysqli_query($conn,$edit_contrator);
$res_rows=mysqli_num_rows($contrator_result);
$fetch_result=mysqli_fetch_array($contrator_result);
@extract($fetch_result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $m_name; ?> :<?php echo $sitename; ?></title>
<link href="style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>
</head>
<body>


<div class="right_col1">

<div class="clear"></div>
<?php if($errmsg!=""){?>
<div  id="msgerror" class="status error">
<div class="closestatus" style="float: none;">
<p class="closestatus" style="float: right;"><img alt="Attention" src="images/close.png" class="margintop"></p>
<p><img alt="error" src="images/error.png"> <span>Attention! <br /></span><?php echo $errmsg; ?></p>
</div>
</div>
          <?php }?>
      	<div class="clear"></div>


	<div class="addmenu">
            <div class="internalpage_heading" >
 <h3 class="manageuser" style="width:100%"><?php echo $m_name;?></h3>
 <div class="right-section">

 </div>
 </div>
         <div class="grid_view">
<div style="height:10px"></div>
<div class="heading-holder" style=" min-height:500px;">
          <div class="heading-area" >
            <h2></h2>
          </div>
		   <div class="clear"></div>
		   <div style="height:10px"></div>
        <div>

		<body>
<?php //include('top_header.php'); ?>
<div style="height:10px"></div>
<div class="heading-holder" style=" min-height:500px;">
          <div class="heading-area" >
            <h2><?php echo $m_name;?></h2>
          </div>
		   <div class="clear"></div>
		   <div style="height:20px"></div>
                   <div style="height:20px"> <span align="left" colspan="2" class="label1"><strong>Title : </strong> <?php echo  $m_name; ?></span></div>

        <?php if($content_type == 1){?>
                      <div style="height:20px"> <span align="left" colspan="2" class="label1"><strong>Meta Title : </strong><?php echo  stripslashes(html_entity_decode($m_title)); ?></span></div>
                   <div style="height:20px"> <span align="left" colspan="2" class="label1"><strong>Keyword : </strong><?php echo  stripslashes(html_entity_decode($m_keyword)); ?></span></div>
                   <div style="height:20px"><span align="left" colspan="2" class="label1"><strong>Short Description : </strong><?php echo  stripslashes(html_entity_decode($m_description)); ?></span></div>
                   <div style="height:20px"><span align="left" colspan="2" class="label1"><strong>Content : </strong><?php echo  stripslashes(html_entity_decode($m_content)); ?></span></div>
        <?php } else if($content_type == 2) {?>

         <div style="height:20px"><span align="left" colspan="2" class="label1"><strong> Uploaded Document : </strong><a href="../../upload/whatsnew/<?php echo $docs_file; ?>" download>Download</a></span></div>
        <?php }
        else if($content_type == 3) {?>
        <div style="height:20px"><span align="left" colspan="2" class="label1"><strong> External Link : </strong><a href="<?php echo  $ext_url; ?>" target="_blank"><?php echo  $ext_url; ?></a></span></div>
        <?php }?>
        <div style="height:20px"><span align="left" colspan="2" class="label1"><strong>Start Date : </strong><?php echo $start_date; ?></span></div>
                   <div style="height:20px"><span align="left" colspan="2" class="label1"><strong>End Date : </strong><?php echo $end_date; ?></span></div>
        </div>

        </div>

  </div>
    	 <div align="center"><input type="button" class="button" value="Close" onclick="MM_callJS('window.close();')" >

 </div>

	</body>
</html>


