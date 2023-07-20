<div class="container">
        <div>
    	<div>
        <ul class="top-menu" id="example1">
        <li>
<a href="#"><img src="<?php echo $HomeURL;?>/images/ico-skip.png" width="24" height="24" alt="Skip Main Content" title="Skip Main Content"></a></li>
        
        
        <li><a href="<?php echo $HomeURL;?>/hi/screenreaderaccess.php"><img src="<?php echo $HomeURL;?>/images/sc.png" width="24" height="24" alt="Screen-Reader-Access" title="Screen Reader Access"></a></li>
        
        <li><a href="#"><img src="<?php echo $HomeURL;?>/images/ico-accessibility.png" width="24" height="24" alt="Accessibility-option" title="Accessibility Option"></a>
       		<ul>
            	<li><a href="javascript:void(0);" title="Increase font size" onClick="set_font_size('increase')">A<sup>+</sup><span class="hidethis">Increase font size</span></a></li>
                <li><a href="javascript:void(0);" title="Reset font size" onClick="set_font_size('')">A <span class="hidethis">Reset font size</span></a></li>
                <li><a href="javascript:void(0);" title="Decrease font size" onClick="set_font_size('decrease')" >A<sup>-</sup> <span class="hidethis">Decrease font size</span></a></li>
                <li class="hight-contrast"><a href="javascript:void(0);" title="High Contrast" class="hc" onclick="chooseStyle('change', 60);">A <span class="hidethis">High Contrast</span></a></li>
                <li><a href="javascript:void(0);" title="Normal" class="normal"  onclick="chooseStyle('style', 60);">A <span class="hidethis">Normal</span></a></li>
            </ul>
        </li>
        <li><a href="#"><img src="<?php echo $HomeURL;?>/images/ico-social.png" width="24" height="24" alt="Social Icons" title="Social Icons"></a>
        <ul>
            	<li><a href="#"><img src="<?php echo $HomeURL;?>/images/facebook-icons.jpg" width="22" height="22" alt="facebook-icons" title="Facebook"></a></li>
                <li><a href="#"><img src="<?php echo $HomeURL;?>/images/twitter.jpg" width="22" height="22" alt="twitter-icons" title="Twitter"></a></li>
                <li><a href="#"><img src="<?php echo $HomeURL;?>/images/you-tube.jpg" width="22" height="22" alt="Youtube-icons" title="Youtube"></a></li>
                
            </ul>
        
        </li>
        <li><a href="<?php echo $HomeURL;?>/hi/sitemap.php"><img src="<?php echo $HomeURL;?>/images/ico-site-search.png" width="24" height="24" title="Icons Site Search" alt="site-search"></a>
        
        <ul>
        <li class="slave">
        <label for="q">Search</label>
		<form  action="<?php echo $HomeURL;?>/hi/search.php" id="cse-search-box" name="searchform" onsubmit=" if(this.q.value == '' || this.q.value.length < 1) { alert('Please enter a Search Keyword'); return false; }else {return gsearch('searchform')}">
			<input type="hidden" name="cx" value="009166207481149357514:qxrolw6qhkq" />
			<input type="hidden" name="cof" value="FORID:10"/>
			<input type="hidden" name="ie" value="UTF-8"/>
			<label for="q"></label>
			<input type="text" class="search" id="q"  name="q" placeholder="Enter Your Keyword"/>
			<button type="submit"  class="search-buttion"/>
			<!-- <input type="button" class="search-buttion" title="Search" value="submit"> -->
			</form>
<!-- <input type="text" class="search" id="q"  name="Search" placeholder="Enter Your Keyword">
<input type="button" class="search-buttion" title="Search" value="submit"> -->
        </li> 
        </ul>
        
        </li>
        <li><a href="<?php echo $HomeURL;?>/hi/sitemap.php"><img src="<?php echo $HomeURL;?>/images/ico-sitemap.png" width="24" height="24" alt="sitemap" title="Sitemap"></a></li>
        <li class="contact-show"><a href="<?php echo $HomeURL;?>" class="last-font" title="हिंदी">English<span class="hidethis">Hindi Link:This will open in new window.</span></a></li>
	</ul>
        </div>
        </div>
        </div>