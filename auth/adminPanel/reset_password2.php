<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reset Page:AERA</title>
<script src="../../includes/sha512.js" type="text/javascript"></script>
<link href="style/admin.css" rel="stylesheet" type="text/css">
<link href="style/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/drop_down.js"></script>
<link href="style/jquery.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/demo.js"></script>

</head>
<body>
<?php //include('top_header.php'); ?>
 
 <div id="container1">
  
  
  <?php if($errmsg!=""){?>
 <div class="error_msgs">
<div  id="msgerror" class="status error">
<div class="closestatus" style="float: none;">
<p class="closestatus" style="float: right;"><img alt="Attention" src="images/close.png" class="margintop"></p>
<p><img alt="error" src="images/error.png"> <span>Attention! <br /></span><?php echo $errmsg; ?>.</p>
</div>
</div>
</div>
<?php }?>

       <?php
		if($_SESSION['sess_msg']!=''){?>
          <div class="status1 success">
            <p class="closestatus"> <a title="Close" href="">x</a></p>
            <p><img alt="Attention" src="images/approve.png" class="margintop"> <span>Attention! </span><a href="#"><?php echo $_SESSION['sess_msg'];
			 $_SESSION['sess_msg']=""; ?></a>.</p>
          </div>
          <?php
		}
		?>


      	  <div class="admin_panel">
		<div class="admin-heading"><h1>Reset Password</h1>  </div>

         <form id="changepass" name="changepass" method="post" action="" autocomplete="off">
      <div class="admin_row_fp">
         <span class="label2">Enter New Password <span class="red-text">*</span></span>
         <span class="input2"> <input name="txtnpwd"  type="password" class="input_class2" id="txtnpwd"  maxlength="512" autocomplete="off"/> </span><br/>
		   <div class="reset_msg1">Password must contain at least  8 characters long, must contain at least 1 number, at least 1 lower case letter, and at least 1 upper case letter.</div>
        <div class="clear"> </div>
      </div>

     	<div class="clear"></div>
        
      <div class="admin_row_fp">
         <span class="label2">Enter Re-Enter Password <span class="red-text">*</span></span>
         <span class="input2"> <input name="txtcpwd"  type="password" class="input_class2" id="txtcpwd"  maxlength="512" autocomplete="off"/> </span><br/>
		   <div class="reset_msg1">Password must contain at least  8 characters long, must contain at least 1 number, at least 1 lower case letter, and at least 1 upper case letter.</div>
        <div class="clear"> </div>
      </div>



      <div class="captcha_row">
       
       <div class="captcha"><div style="width: 258px; float: left; height: 70px">
						<img id="siimage" align="left" style="padding-right: 5px; border: 0" src="../../securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" />

						<a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '../../securimage/securimage_show.php?sid=' + Math.random(); return false"><img src="../../securimage/images/refresh_icon-big.png" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" /></a>
						</div></div>
        <div class="clear"> </div>
      </div>
      
      <div class="message_row">
       Enter above characters being displayed in above image
        
      </div>
      
        <div class="admin_row1_fp">
       
         <span class="input2"><input name="code"  type="text" class="input_class2" maxlength="6" autocomplete="off"/></span>
        <div class="clear"> </div>
      </div>
      
			<div class="admin_row1_fp1">
			<input type="submit" name="cmdsubmit" id="cmdsubmit" value="Submit" class="button" onClick ="return getPass();"/> 
			<input type="submit" name="cmdreset" id="cmdreset" value="Reset" class="button" />
			<div class="clear"> </div>
      </div>
      </form>
     <div class="forget_link_rp">
        <a href="index.php" title="return to Index page">Back</a>
        <div class="clear"> </div>
      </div> 
      
    </div>

  </div>
  <div class="footer"></div>
</div>

</body>
</html>
