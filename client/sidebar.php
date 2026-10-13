<?php
// echo '<pre>';
// print_r($LoginInfo);
// echo '</pre>';

// echo $LoginInfo->getProfilepic();
?>
<!-- <div id="preloader">
    <div id="ctn-preloader" class="ctn-preloader">
        <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="txt-loading">
                <span data-text-preloader="L" class="letters-loading">
                    L
                </span>
                
                <span data-text-preloader="O" class="letters-loading">
                    O
                </span>
                
                <span data-text-preloader="A" class="letters-loading">
                    A
                </span>
                
                <span data-text-preloader="D" class="letters-loading">
                    D
                </span>
                
                <span data-text-preloader="I" class="letters-loading">
                    I
                </span>
                
                <span data-text-preloader="N" class="letters-loading">
                    N
                </span>
                
                <span data-text-preloader="G" class="letters-loading">
                    G
                </span>
            </div>
        </div>	
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
</div> -->
<!-- <div class="overlay">
    <div class="overlayDoor"></div>
    <div class="overlayContent">
        <div class="loader">
            <div class="inner"></div>
        </div>		
    </div>
</div> -->


<div class="loder-div mainloader d-none">
    <div class="chart-loading" style="">
        <img alt="loading-img" src="assets/img/loading.gif">
    </div>
</div>
<div class="row set-btn-rs d-none">
    <button class="res-btn-set">
        <i></i>
    </button>
</div>
<div class="widthset width-mobile-set">
    <aside class="main-sidebar msside fixed offcanvas sidebar-content" data-toggle='offcanvas'>
        <div class="sidebar">
            <div class="">
               
            </div>
            <ul class="sidebar-menu setmrtpse mt-0 pt-0">
                <!-- <div class="side-barbutton">
                        <i class="fas fa-chevron-right"></i>
                    </div> -->
                <!-- <li class="treeview"><a href="aboutus.php"><div class="sidemenu-img"><img src="<?php echo $config->getimageurl() ?>images/sidemenu/profile.svg" alt="profile" title="profile"></div><span>profile</span></a></li> -->
                <li class="treeview"><a href="<?php echo $config->getportalbaseurl(); ?>home">
                        <div class="sidemenu-img"><img
                                src="<?php echo $config->getimageurl() ?>images/sidemenu/Group 30216.svg" alt="home"
                                title="home"></div><span>home</span> <?php
                                if ($DB->getpackagewiseuserright($LoginInfo->getUid(), 1)['attributeval'] == 1 || $DB->getpackagewiseuserright($LoginInfo->getUid(), 6)['attributeval'] == 1) {
                                    ?>
                    <li class="treeview"><a href="<?php echo $config->getportalbaseurl(); ?>diamond">
                            <div class="sidemenu-img"><img
                                    src="<?php echo $config->getimageurl() ?>images/sidemenu/Group 30217.svg" alt="diamond"
                                    title="diamond"></div><span>Diamond</span>
                        </a></li>
                <?php
                                }
                                if ($DB->getpackagewiseuserright($LoginInfo->getUid(), 2)['attributeval'] == 1 || $DB->getpackagewiseuserright($LoginInfo->getUid(), 7)['attributeval'] == 1) {
                                    ?>
                    <li class="treeview no-b"><a href="<?php echo $config->getportalbaseurl(); ?>jewellery">
                            <div class="sidemenu-img"><img
                                    src="<?php echo $config->getimageurl() ?>images/sidemenu/Group 30218.svg"
                                    alt="Jewellery" title="Jewellery"></div><span>Jewellery</span>
                        </a></li>
                <?php
                                }
                                if ($DB->getpackagewiseuserright($LoginInfo->getUid(), 5)['attributeval'] == 1 || $DB->getpackagewiseuserright($LoginInfo->getUid(), 4)['attributeval'] == 1) {
                                    ?>
                    <li class="treeview"><a href="<?php echo $config->getportalbaseurl(); ?>buyrequest">
                            <div class="sidemenu-img"><img
                                    src="<?php echo $config->getimageurl() ?>images/sidemenu/Group 30219.svg"
                                    alt="Buy Request" title="Buy Request"></div><span>Request</span>
                        </a></li>
                <?php
                                }
                                if ($DB->getpackagewiseuserright($LoginInfo->getUid(), 4)['attributeval'] == 1) {
                                    ?>
                    <li class="treeview"><a href="<?php echo $config->getportalbaseurl(); ?>chat">
                            <div class="sidemenu-img"><img
                                    src="<?php echo $config->getimageurl() ?>images/sidemenu/Group 30220.svg" alt="Chat"
                                    title="Chat"></div><span>Chat</span>
                        </a></li>
                <?php
                                }
                                ?>
                <li class="treeview"><a href="<?php echo $config->getportalbaseurl(); ?>support">
                        <ul>
                            <li>
                                <div class="sidemenu-img"><img
                                        src="<?php echo $config->getimageurl() ?>images/question.png" alt="support"
                                        title="support"></div><span>Support</span>
                            </li>
                            <li><span class="nav-text"></span></li>
                        </ul>
                    </a></li>
                <li class="treeview"><a href="<?php echo $config->getportalbaseurl(); ?>profile">
                        <ul>
                            <li>
                                <div class="sidemenu-img"><img
                                        src="<?php echo $config->getimageurl() ?>images/profile.svg" alt="profile"
                                        title="profile"></div><span>Profile</span>
                            </li>
                            <li><span class="nav-text"></span></li>
                        </ul>
                    </a></li>
                <li class="treeview"><a href="javacript:void(0);" id="btnlogout">
                        <div class="sidemenu-img"><img
                                src="<?php echo $config->getimageurl() ?>images/sidemenu/logout.svg" alt="logout"
                                title="logout"></div><span>logout</span>
                    </a></li>
            </ul>
 <div class="savani-logo-text">
                    <!-- <h1 class="sec-desc">Savani</h1> -->
                    <div class="image">
                        <a href="<?php echo $config->getportalbaseurl(); ?>home">
                            <span class="imgsetside">
                                <img class="user_avatar"
                                    src="<?php echo $config->getimageurl() ?>images/defaultjewellery.png"
                                    alt="<?php echo $LoginInfo->getFullname(); ?>">
                                <!-- <span><?php echo $LoginInfo->getFullname(); ?></span> -->
                            </span>
                        </a>
                    </div>
                </div>
        </div>
    </aside>
</div>