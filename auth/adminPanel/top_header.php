<div class="logo_row">
                                   <div class="admin">
                                                <h1><?php echo $sitename;?> Administration</h1>
                                            </div>
                                            
                                            <div class="right-links">
                                            <div class="dates">
                                            <div class="date-box">
                                            <div class="date-icon"> </div>
                                            <div class="date-text"> <?php echo date('d, M y'); ?> </div>
                                               </div>
                                            
											
											<!--<div class="time-box">
                                                      <div class="time-icon">   </div>
                                            <div class="date-text"> <?php //echo date('H:i A'); ?> </div>
                                              </div>-->
											  
											  <?php

													$t=time();
											?>
										<div class=time-box>
										<div class="time-icon">   </div>
												<div class="date-text"> <?php //echo date('H:i A'); ?>
												<?php date_default_timezone_set('Asia/Kolkata');

												$t=time();

												echo(date("H:i A",$t)); ?>

												</div>
										</div>

											  
											  
											  
											  
											  
											  
											  
                                            <div class="clear"> </div>
                                             </div>
                                            <div class="settings">
                                            
                                            <ul id="nav">
<li class='MenuLi MenuLi1'><a href="#" class='menuFirstNode'><?php echo ucfirst($_SESSION['login_name']); ?> </a>
<ul class='menuSubUl'>
          <li class="firstMenuLi editprofile"><a class='firstMenuLiA editprofile' href="editProfile.php" title="Edit Profile">Edit Profile</a></li>
                  <li class="changepassword"><a href="editpassword.php" title="Change Password" class="change-password">Change Password</a></li>
                  <li class="logout"><a href="logout.php?random=<?php echo $_SESSION['logtoken']; ?>" title="Logout" class="logouts">Logout</a></li>

                </ul>

 </li>
</ul>
                                     
                                              </div>
                                            </div>          
                               
                                <div class="clear"> </div>
                            </div>
                    