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
$edit_contrator ="select * from photogallery where id='$page_id1'";
$contrator_result = mysqli_query($conn,$edit_contrator);
$res_rows=mysqli_num_rows($contrator_result);
$fetch_result=mysqli_fetch_array($contrator_result);
@extract($fetch_result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Page <?php echo $sitename;?></title>
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
   
       
<div class="right_col1">
          
		  <div class="clear"></div>

      	<div class="clear"></div>
 
        
	<div class="addmenu"> 
    <div class="internalpage_heading">
 <h3 class="manageuser">Media Gallery</h3>
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
		
		  <table width="98%"  align="center" border="0" cellspacing="2" cellpadding="2" summary="" style="border:1px solid #cccccc">
 <tbody>

	
 <tr>
    <td colspan="3" align="left">&nbsp;</td>
  </tr>

  <tr>
    <td align="left" valign="top" width="35%" class="label2" >English Title: </td><td width="1%">:</td>
    <td align="left" width="64%" class="label1"><label for="select"></label><label for="member">
     <?php  echo html_entity_decode($sortdesc); ?>
    </label></td>
  </tr>
   <tr>
    <td align="left" valign="top" width="35%" class="label2" >Hindi Title: </td><td width="1%">:</td>
    <td align="left" width="64%" class="label1"><label for="select"></label><label for="member">
    <?php  echo html_entity_decode($sort_desc_hindi); ?>
    </label></td>
  </tr>

	<tr>
<td align="left" class="label2"  width="25%">
 <?php if($img_uplode!='' && $gallery_type=='1') {?>Image: </td><td width="1%">:</td>
	
            </span>   <td align="left" width="64%" class="label1"><label for="select"></label><label for="member">
		  	 <img src="../../upload/photogallery/media/<?php echo $img_uplode;?>" alt="" title="" align="center" width="80" height="90" />
		       </span>
            <div class="clear"></div>
            </div>
			</label>
			</td>
			</tr>
		</tbody>
</table>	
		   <?php }?> 
		     <?php if($img_uplode!='' && $gallery_type=='2') {?>
			 <div class="photo_gallery" id="photo_gallery">
    <SCRIPT  type="text/javascript" src="<?php echo $HomeURL;?>/flowplayerjs/head.min.js"></SCRIPT> 
              <SCRIPT type="text/javascript" language="JavaScript">
head.js(
"<?php echo $HomeURL;?>/flowplayerjs/jquery.tools.min.js",
"<?php echo $HomeURL;?>/flowplayerjs/flowplayer.min.js", function(){
});
head.ready(function() {
flowplayer("a.myPlayer", "<?php echo $HomeURL;?>/flowplayerjs/flowplayer.swf",{
plugins:  {
controls:  {
volume: false

}
}
});

});
</SCRIPT>

			<div class="photo_item"><a style="background-image:url(../upload/video_galery/thumb/<?php echo $video_row['img_uplode'];?>)"
           class="myPlayer" href="../../upload/video_galery/<?php echo $img_uplode;?>"><IMG alt="Demo video <?php echo $i;?>" src="../../flowplayerjs/play_large.png" ></a></div>
		                       					
          
</div>
		   <?php }?> 
        
        <?php if($m_content !=''){?>
		<span align="left" colspan="2" class="label1"><?php echo  stripslashes(html_entity_decode($m_content)); ?></span>
        <?php } else if($docs_file !='') {?>
        <span align="left" colspan="2" class="label1"><a href="../../upload/photogallery/media<?php echo $docs_file; ?>">Download</a></span>
        <?php }
        else if($ext_url !='') {?>
        <span align="left" colspan="2" class="label1"><a href="<?php echo  $ext_url; ?>" target="_blank"><?php echo  $ext_url; ?></a></span>
        <?php }?>
        </div>
      
    
    	 <div align="center"><input type="button" class="button" value="Close" onclick="MM_callJS('window.close();')" >
   
 </div>
	

		
</div>
</div>

</div><!-- right col -->
</body>
</html>
    