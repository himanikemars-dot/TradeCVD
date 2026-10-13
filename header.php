<!--====================  preloader ====================-->

<div class="preloader-activate preloader-active">
   <div class="preloader-area-wrap">
        <div class="logo-stage" aria-label="Trade CVD animated logo">
           <div class="glow" aria-hidden="true"></div>
           <span class="sparkle sparkle-one" aria-hidden="true"></span>
           <span class="sparkle sparkle-two" aria-hidden="true"></span>
           <span class="sparkle sparkle-three" aria-hidden="true"></span>
           <div class="logo-wrap">
              <img src="<?php echo $config->getImageurl() ?>images/header-sticky.svg"" alt="Trade CVD">
          </div>
       </div>
    </div> 
   
</div>
<!-- <div class="acr-preloader">
    <div class="acr-preloader-inner">
        <img src="<?php echo $config->getImageurl() ?>images/loader.gif" class="img-fluid" alt="logo" width="100px" height="100px">
    </div>
</div> -->
<!--====================  End of preloader  ====================-->
<!--====================  header area ====================-->
<div class="header-area header-sticky ">
    <div class="header-area__desktop header-area__desktop--default">
        <!--=======  header navigation area  =======-->
        <div class="header-navigation-area header-navigation-area-dark white-bg-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-2 setres my-auto">
                        <div class="logo">
                            <a class="clspageparentmenu" pagename="home" href="<?php echo $config->getWeburl(); ?>home">
                                <!-- <img src="<?php echo $config->getImageurl() ?>images/logo-w.png" class="img-fluid" alt="img"> -->
                                <!-- <p>Trade CVD</p> -->
                                <?php
                                //  $pgname=basename($_SERVER['PHP_SELF']);
                                 if(basename($_SERVER['PHP_SELF'])=='index.php')
                                 {
                                    ?>
                                    <!--<img src="<?php echo $config->getImageurl() ?>images/footer-logo.svg" class="img-fluid header-logo-first" alt="img">-->
                                    <img src="<?php echo $config->getImageurl() ?>images/header-sticky.svg" class="img-fluid header-logo-first" alt="img">
                                    <?php
                                 }else{
                                    ?>
                                    <img src="<?php echo $config->getImageurl() ?>images/header-sticky.svg" class="img-fluid header-logo-first" alt="img">
                                    <?php
                                 }
                                ?>
                                <!-- <img src="<?php echo $config->getImageurl() ?>images/footer-logo.svg" class="img-fluid header-logo-first" alt="img"> -->
                                <img src="<?php echo $config->getImageurl() ?>images/header-sticky.svg" class="img-fluid header-sticky-img" alt="img">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-10  my-auto">
                        <!-- header navigation -->
                        <div class="header-navigation position-relative">
                            <!-- logo -->
                            
                            <div class="header-navigation__nav position-static">
                                <nav>
                                    <ul>
                                        <li class="lidiamond"><a href="<?php echo $config->getWeburl(); ?>buying-diamonds">Diamonds </a>
                                           <!-- <ul class="submenulist">
                                                <li><a  class="clspageparentmenu" pagename="pricing-tools" href="<?php echo $config->getWeburl(); ?>pricing-tools">Pricing Tools</a></li> 
                                                <li><a class="clspageparentmenu" pagename="buying-diamonds" href="<?php echo $config->getWeburl(); ?>buying-diamonds">Buying Diamonds</a></li>
                                                <li><a class="clspageparentmenu" pagename="selling-diamonds" href="<?php echo $config->getWeburl(); ?>selling-diamonds">Selling Diamonds</a></li>
                                            </ul> -->
                                        </li>
                                        <li class="liaboutus"><a href="<?php echo $config->getWeburl(); ?>buying-jewelry" class="clspageparentmenu">Jewelry</a>
                                           <!-- <ul class="submenulist">
                                                <li><a href="<?php echo $config->getWeburl(); ?>buying-jewelry" class="clspageparentmenu" pagename="buying-jewelry">Buying Jewelry</a></li>
                                                <li><a href="<?php echo $config->getWeburl(); ?>selling-jewelry" class="clspageparentmenu" pagename="selling-jewelry">Selling Jewelry</a></li>
                                            </ul> -->
                                        </li>
                                       <!-- <li class="liblog"><a class="clspageparentmenu" pagename="blog" href="<?php echo $config->getWeburl(); ?>blogs">Blog</a></li> -->
                                        <li class="liaboutus"><a class="clspageparentmenu" pagename="brand" href="<?php echo $config->getWeburl(); ?>aboutus">About Us</a></li>
                                        <li class="licontactus"><a class="clspageparentmenu" pagename="contactus" href="<?php echo $config->getWeburl(); ?>contactus">Contact Us</a></li>
                                        <?php 
                                        if($LoginInfo->getIsguestuser()==0)
                                        {
                                            ?>
                                                <li class="my-auto"><a class="head-btn btn btn-primary set-color" onclick="logout();" href="javascript:void(0);">Logout</a></li>

                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <li class="lilogin my-auto"><a class="head-btn btn btn-primary set-color clspageparentmenu btn-gradient-green" pagename="login" href="<?php echo $config->getWeburl(); ?>login">Login</a></li>
                                            <?php
                                        }
                                        
                                        ?>        
                                        
                                        <li class="limembershipplan my-auto"><a class="head-btn btn transparent-btn clspageparentmenu buying-choose" pagename="membershipplan" href="<?php echo $config->getWeburl(); ?>membershipplan">Choose Plan</a></li>
                                    </ul>
                                </nav>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--====================  End of header area  ====================-->

<!--====================  mobile menu overlay ====================-->
<div class="mobile-menu-overlay inactive" id="mobile-menu-overlay">
    <div class="mobile-menu-overlay__header px-3">
        <div class="row align-items-center">
            <div class="col">
                <!-- logo -->
                <div class="logo">
                    <a href="<?php echo $config->getWeburl(); ?>home"  class="clsparentmenu" pagename="home">
                        <img src="<?php echo $config->getImageurl() ?>images/header-sticky.svg" class="img-fluid header-logo-first" alt="img">
                    </a>
                </div>
            </div>
            <div class="col-auto">
                <!-- mobile menu content -->
                <div class="mobile-menu-content">
                    <a class="mobile-navigation-close-icon" id="mobile-menu-close-trigger"
                        href="javascript:void(0)">
                        <i class="ion-ios-close-empty"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-menu-overlay__body">
        <nav class="offcanvas-navigation">
        <ul>
            <li class="lidiamond"><a href="<?php echo $config->getWeburl(); ?>buying-diamonds">Diamonds </a>
                <!-- <ul class="mobilesubmenulist">
                    <li><a  class="clspageparentmenu" pagename="pricing-tools" href="<?php echo $config->getWeburl(); ?>pricing-tools">Pricing Tools</a></li>
                    <li><a class="clspageparentmenu" pagename="buying-diamonds" href="<?php echo $config->getWeburl(); ?>buying-diamonds">Buying Diamonds</a></li>
                    <li><a class="clspageparentmenu" pagename="selling-diamonds" href="<?php echo $config->getWeburl(); ?>selling-diamonds">Selling Diamonds</a></li>
                </ul> -->
            </li>
            <li class="lijewelry"><a href="<?php echo $config->getWeburl(); ?>buying-jewelry" class="clspageparentmenu">Jewelry</a>
                <!-- <ul class="mobilesubmenulist2">
                    <li><a href="<?php echo $config->getWeburl(); ?>buying-jewelry" class="clspageparentmenu" pagename="buying-jewelry">Buying Jewelry</a></li>
                    <li><a href="<?php echo $config->getWeburl(); ?>selling-jewelry" class="clspageparentmenu" pagename="selling-jewelry">Selling Jewelry</a></li>
                </ul> -->
            </li>
            <li class="liblog"><a class="clspageparentmenu" pagename="blog" href="<?php echo $config->getWeburl(); ?>blogs">Blog</a></li>
            <li class="liaboutus"><a class="clspageparentmenu" pagename="brand" href="<?php echo $config->getWeburl(); ?>aboutus">About Us</a></li>
            <li class="licontactus"><a class="clspageparentmenu" pagename="contactus" href="<?php echo $config->getWeburl(); ?>contactus">Contact Us</a></li>
            <?php 
            if($LoginInfo->getIsguestuser()==0)
            {
                ?>
                    <li class="my-auto"><a class="head-btn btn btn-primary " onclick="logout();" href="javascript:void(0);">Logout</a></li>

                <?php
            }
            else
            {
                ?>
                    <li class="lilogin my-auto"><a class="head-btn btn btn-primary clspageparentmenu" pagename="login" href="<?php echo $config->getWeburl(); ?>login">Login</a></li>
                <?php
            }
            
            ?>        
            
            <li class="limembershipplan my-auto"><a class="head-btn btn transparent-btn clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getWeburl(); ?>membershipplan">Choose Plan</a></li>
        </ul>
        </nav>
    </div>
</div>
<!--====================  End of mobile menu overlay  ====================-->