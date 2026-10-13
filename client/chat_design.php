<?php 
// require_once dirname(__DIR__, 1).'/config/config.php';
// $config = new config();

require_once dirname(__DIR__, 1).'/config/init.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tag Start -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Trade CVD" />
    <meta name="author" content="Trade CVD" />
    <meta name="robots" content="Trade CVD" />
    <meta name="description" content="Trade CVD" />
    <meta property="og:title" content="Trade CVD" />
    <meta property="og:url" content="Trade CVD" />
    <meta property="og:description" content="Trade CVD"/>
    <meta property="og:image" content=""/>
    <link rel="icon" type="image/x-icon" href=""/>
    <!-- Meta Tag End -->

    <!--title-->
    <title>Trade CVD</title>
    
    <!-- CSS Start -->
    <?php include('css.php'); ?>
    
 
    
    <!-- CSS End -->
    <script src="assets/js/vendor/jquery.min.js"></script>
</head>
<body class="bg-white home-page">
    <div class="page-wrapper">
        <!-- Header Start -->
        <div class="has-sidebar-left">
        <header class="bg-white accent-3 relative nav-sticky tab-box-shadow">
            <div class="container-fluid text-white">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 p-4">
                        <h4 class="mb-0 sec-desc header-desc text-blue">Chat</h4>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <!-- Header End -->
    <div class="main" id="web-content">
        <?php include('sidebar.php'); ?>
        <div class="has-sidebar-left">
            <div class="container-fluid relative animatedParent animateOnce">
                <div class="tab-content p-2" id="v-pills-tabContent">
                    <!--Today Tab Start-->
                    <div class="tab-pane  show active" id="v-pills-1">
                        <div class="row row-eq-height">
                            <!-- Chat Widget Start -->
                            <div class="col-md-12">
                                <div class="card chat-card border-0 bg-light-gray">
                                    <div class="card-body chat-widget slimScroll p-0" data-height="100%">
                                        <div class="app-content content chat-application">
                                            <div class="content-overlay"></div>
                                            <div class="header-navbar-shadow"></div>
                                            <!-- START CONTAINER -->
                                            <div class="content-area-wrapper mt-0">
                                                <div class="sidebar-left">
                                                    <div class="chat-sidebar">
                                                        <!-- <div class="col-md-3"> -->
                                                            <div class="sidebar-content card">
                                                                <span class="sidebar-close-icon">
                                                                    <i class="fas fa-times gridbtn"></i>
                                                                </span>
                                                                <div id="users-list" class="chat-user-list list-group position-relative">
                                                                    <div class="users-tab-list">
                                                                        <ul class="wh-nav wh-nav-tabs d-flex text-center p-0" role="tablist">
                                                                            <li class="wh-nav-item w-50 active">
                                                                                <a class="wh-nav-link tab-click"  data-toggle="tab" href="#tab1" aria-controls="tab1" role="tab" aria-selected="true">Sell</a>
                                                                            </li>
                                                                            <li class="wh-nav-item w-50">
                                                                                <a class="wh-nav-link tab-click "  data-toggle="tab" href="#tab2" aria-controls="tab2" role="tab" aria-selected="false">Buy</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="tab-content users-tabcontent chat-users-list-tab">
                                                                        <div class="tab-pane active" id="tab1" aria-labelledby="tab1" role="tabpanel">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="chat-fixed-search">
                                                                                        <fieldset class="form-group position-relative has-icon-left my-0 w-100">
                                                                                            <input class="input-text" type="text" id="chat-search" placeholder="Search">
                                                                                            <span class="searchbutton"><i class="fa fa-search" aria-hidden="true"></i></span>
                                                                                            <!-- <div class="form-control-position">
                                                                                                <i class="feather icon-search"></i>
                                                                                            </div> -->
                                                                                        </fieldset>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 p-0 chat-list-data">
                                                                                    <ul class="chat-users-list-wrapper media-list" id="chatlist" data-page="1">
                                                                                        <li id="chat-1" data-contactid="1" data-personname="AB" data-contactno="999999999">
                                                                                            <div class="chat-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div>
                                                                                            <div class="user-chat-info">
                                                                                                <div class="contact-info">
                                                                                                    <h5 >Kundan Kumar</h5>
                                                                                                    <div class="chat-info-desc">
                                                                                                        <p >Hello, I want to purchase Dimond</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="contact-meta m-auto">
                                                                                                    <span class="lastchat-date">11:30 am</span>
                                                                                                    <span class="badge badge-primary badge-pill badge">1</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li id="chat-2" data-contactid="2" data-personname="CD" data-contactno="999999999">
                                                                                            <div class="chat-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div>
                                                                                                <div class="user-chat-info">
                                                                                                <div class="contact-info">
                                                                                                    <h5 >Kundan Kumar</h5>
                                                                                                    <!-- <a class="text-blue" href="#">Heer Dimond</a> -->
                                                                                                    <div class="chat-info-desc">
                                                                                                    <p >Hello, I want to purchase Dimond</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="contact-meta m-auto">
                                                                                                    <span class="lastchat-date">11:30 am</span>
                                                                                                    <span class="badge badge-primary badge-pill badge">1</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li id="chat-3" data-contactid="3" data-personname="EF" data-contactno="999999999">
                                                                                            <div class="chat-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div>
                                                                                                <div class="user-chat-info">
                                                                                                <div class="contact-info">
                                                                                                    <h5 >Kundan Kumar</h5>
                                                                                                    <!-- <a class="text-blue" href="#">Heer Dimond</a> -->
                                                                                                    <div class="chat-info-desc">
                                                                                                    <p >Hello, I want to purchase Dimond</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="contact-meta m-auto">
                                                                                                    <span class="lastchat-date">11:30 am</span>
                                                                                                    <span class="badge badge-primary badge-pill badge">1</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li id="chat-4" data-contactid="4" data-personname="GH" data-contactno="999999999">
                                                                                            <div class="chat-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div>
                                                                                                <div class="user-chat-info">
                                                                                                <div class="contact-info">
                                                                                                    <h5 >Kundan Kumar</h5>
                                                                                                    <!-- <a class="text-blue" href="#">Heer Dimond</a> -->
                                                                                                    <div class="chat-info-desc">
                                                                                                    <p >Hello, I want to purchase Dimond</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="contact-meta m-auto">
                                                                                                    <span class="lastchat-date">11:30 am</span>
                                                                                                    <span class="badge badge-primary badge-pill badge">1</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li id="chat-5" data-contactid="5" data-personname="IK" data-contactno="999999999">
                                                                                            <div class="chat-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div>
                                                                                                <div class="user-chat-info">
                                                                                                <div class="contact-info">
                                                                                                    <h5 >Kundan Kumar</h5>
                                                                                                    <!-- <a class="text-blue" href="#">Heer Dimond</a> -->
                                                                                                    <div class="chat-info-desc">
                                                                                                    <p >Hello, I want to purchase Dimond</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="contact-meta m-auto">
                                                                                                    <span class="lastchat-date">11:30 am</span>
                                                                                                    <span class="badge badge-primary badge-pill badge">1</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li id="chat-10" data-contactid="10" data-personname="TU" data-contactno="999999999">
                                                                                            <div class="chat-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div>
                                                                                                <div class="user-chat-info">
                                                                                                <div class="contact-info">
                                                                                                    <h5 >Kundan Kumar</h5>
                                                                                                    <!-- <a class="text-blue" href="#">Heer Dimond</a> -->
                                                                                                    <div class="chat-info-desc">
                                                                                                    <p >Hello, I want to purchase Dimond</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="contact-meta m-auto">
                                                                                                    <span class="lastchat-date">11:30 am</span>
                                                                                                    <span class="badge badge-primary badge-pill badge">1</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li id="chat-10" data-contactid="10" data-personname="TU" data-contactno="999999999">
                                                                                            <div class="chat-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div>
                                                                                                <div class="user-chat-info">
                                                                                                <div class="contact-info">
                                                                                                    <h5 >Kundan Kumar</h5>
                                                                                                    <!-- <a class="text-blue" href="#">Heer Dimond</a> -->
                                                                                                    <div class="chat-info-desc">
                                                                                                    <p >Hello, I want to purchase Dimond</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="contact-meta m-auto">
                                                                                                    <span class="lastchat-date">11:30 am</span>
                                                                                                    <span class="badge badge-primary badge-pill badge">1</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li id="chat-10" data-contactid="10" data-personname="TU" data-contactno="999999999">
                                                                                            <div class="chat-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div>
                                                                                                <div class="user-chat-info">
                                                                                                <div class="contact-info">
                                                                                                    <h5 >Kundan Kumar</h5>
                                                                                                    <!-- <a class="text-blue" href="#">Heer Dimond</a> -->
                                                                                                    <div class="chat-info-desc">
                                                                                                    <p >Hello, I want to purchase Dimond</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="contact-meta m-auto">
                                                                                                    <span class="lastchat-date">11:30 am</span>
                                                                                                    <span class="badge badge-primary badge-pill badge">1</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane" id="tab2" aria-labelledby="tab2" role="tabpanel">
                                                                        <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="chat-fixed-search">
                                                                                        <fieldset class="form-group position-relative has-icon-left my-0 w-100">
                                                                                            <input class="input-text" type="text" id="chat-search" placeholder="Search Contact">
                                                                                            <span class="searchbutton"><i class="fa fa-search" aria-hidden="true"></i></span>
                                                                                            <!-- <div class="form-control-position">
                                                                                                <i class="feather icon-search"></i>
                                                                                            </div> -->
                                                                                        </fieldset>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 p-0 chat-list-data">
                                                                                    <ul class="chat-users-list-wrapper media-list" id="chatlist" data-page="1">
                                                                                        <li id="buy-1" data-contactid="1" data-personname="AB" data-contactno="999999999">
                                                                                            <div class="chat-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div>
                                                                                            <div class="user-chat-info">
                                                                                                <div class="contact-info">
                                                                                                    <h5 >Akash Kumar</h5>
                                                                                                    <div class="chat-info-desc">
                                                                                                        <p >Hello, I want to Buy Dimond</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="contact-meta m-auto">
                                                                                                    <span class="lastchat-date">11:30 am</span>
                                                                                                    <span class="badge badge-primary badge-pill badge">1</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li id="buy-2" data-contactid="2" data-personname="CD" data-contactno="999999999">
                                                                                            <div class="chat-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div>
                                                                                                <div class="user-chat-info">
                                                                                                <div class="contact-info">
                                                                                                    <h5 >Akash Kumar</h5>
                                                                                                    <!-- <a class="text-blue" href="#">Heer Dimond</a> -->
                                                                                                    <div class="chat-info-desc">
                                                                                                    <p >Hello, I want to Buy Dimond</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="contact-meta m-auto">
                                                                                                    <span class="lastchat-date">11:30 am</span>
                                                                                                    <span class="badge badge-primary badge-pill badge">1</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li id="buy-3" data-contactid="3" data-personname="EF" data-contactno="999999999">
                                                                                            <div class="chat-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div>
                                                                                                <div class="user-chat-info">
                                                                                                <div class="contact-info">
                                                                                                    <h5 >Kundan Kumar</h5>
                                                                                                    <!-- <a class="text-blue" href="#">Heer Dimond</a> -->
                                                                                                    <div class="chat-info-desc">
                                                                                                    <p >Hello, I want to purchase Dimond</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="contact-meta m-auto">
                                                                                                    <span class="lastchat-date">11:30 am</span>
                                                                                                    <span class="badge badge-primary badge-pill badge">1</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <div class="ps__rail-x"><div class="ps__thumb-x" tabindex="0"></div></div><div class="ps__rail-y"><div class="ps__thumb-y" tabindex="0"></div></div></div>
                                                            </div>
                                                        <!-- </div>     -->                            

                                                    </div>
                                                </div>
                                                <div class="content-right">
                                                    <div class="content-wrapper">
                                                        <div class="content-header row">
                                                        </div>
                                                        <div class="content-body">
                                                            <div class="chat-overlay"></div>
                                                            <section class="chat-app-window">
                                                                <div class="start-chat-area">
                                                                    <span class=" far fa-comment-alt mb-1 start-chat-icon icon-message-square"></span>
                                                                    <!-- <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Start Conversation</h4> -->
                                                                    <h4 class="py-50 px-1 start-chat-text">Start Conversation</h4>
                                                                </div>
                                                                <div class="active-chat hidden">
                                                                    <div class="chat_navbar">
                                                                        <header class="chat_header d-flex justify-content-between align-items-center">
                                                                            <div class="vs-con-items d-flex align-items-center">
                                                                                <div class="sidebar-toggle d-block d-lg-none mr-1"><i class="feather icon-menu font-large-1"></i></div>
                                                                                <div class="chat-img chat-nav-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div>
                                                                                <div class="chatheaderdata">
                                                                                    <a href="javascript:void(0)">
                                                                                    <!-- <h6 class="mb-0 " id="chatpersonname">Varun Kapoor</h6> -->
                                                                                    <h6 class="mb-0">Kundan Kumar</h6>
                                                                                    <div class="chatheaderdata-title">
                                                                                        <p>Unique Diamond & Jewelry</p>
                                                                                    </div>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </header>
                                                                        <ul class="d-flex tabs-list">
                                                                            <li><div class="stage-step pt-2 pb-3">
                                                                            <ul class="d-flex">
                                                                                <li><span class="bg-light-purplec border-rounded">Pear Diamond</span></li>
                                                                                <li><span class="bg-light-bluec border-rounded">Sending order</span></li>
                                                                                <li><span class="bg-light-greenc border-rounded">Pending Payment</span></li>
                                                                            </ul>
                                                                        </div></li>
                                                                            <li><div class="stage-step pt-2 pb-3">
                                                                            <ul class="d-flex">
                                                                            <span class="serch-content"><i class="fa fa-search" aria-hidden="true"></i></span> 
                                                                            </ul>
                                                                        </div></li>
                                                                        </ul>
                                                                        
                                                                        
                                                                    </div>
                                                                    <div class="user-chats" data-show="1" data-page="2">
                                                                        <div class="chats" id="userchatlist">
                                                                            <div class="chat">
                                                                                <div class="chat-body-date">
                                                                                    <p>12 June 2022</p>
                                                                                </div>
                                                                                <div class="chating-body">
                                                                                    <div class="chating-left">
                                                                                        <div class="chating-left-content chat-content chat-content-data">
                                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                                                        </div>
                                                                                        <div class="chat-info-list">
                                                                                            <ul class="d-flex">
                                                                                                <li><div class="chat-img-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div></li>
                                                                                                <li><div class="chat-meta-title"><p>Varun Kapoor</p></div></li>
                                                                                                <li><div class="chat-meta-data text-light-gray"><p>12 June 2022</p> </div></li>
                                                                                                <li><div class="chat-meta-time text-light-gray"><p>01:30am </p></div></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="chating-left">
                                                                                        <div class="chating-left-content chat-content chat-content-data">
                                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                                                        </div>
                                                                                        <div class="chat-info-list">
                                                                                            <ul class="d-flex">
                                                                                                <li><div class="chat-img-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div></li>
                                                                                                <li><div class="chat-meta-title"><p>Varun Kapoor</p></div></li>
                                                                                                <li><div class="chat-meta-data text-light-gray"><p>12 June 2022</p> </div></li>
                                                                                                <li><div class="chat-meta-time text-light-gray"><p>01:30am </p></div></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                        <div class="datesetchat">
                                                                                            <div class="chat-body-date text-center">
                                                                                                <p>12 June 2022</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    <div class="chating-right">
                                                                                        <div class="chating-right-content chat-content chat-content-data">
                                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                                                        </div>
                                                                                        <div class="chating-right-content chat-content chat-content-data">
                                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
                                                                                        </div>
                                                                                        <div class="chat-info-list">
                                                                                            <ul class="d-flex chat-meta-right-list">
                                                                                            <li><div class="chat-meta-data text-light-gray"><p>12 June 2022</p> </div></li>
                                                                                                <li><div class="chat-meta-time text-light-gray"><p>01:30am </p></div></li>
                                                                                                <li><div class="chat-meta-title"><p>Varun Kapoor</p></div></li>
                                                                                                <li><div class="chat-img-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="datesetchat">
                                                                                        <div class="chat-body-date text-center">
                                                                                            <p>12 June 2022</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="chating-left">
                                                                                        <div class="chating-left-content chat-content chat-content-data">
                                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                                                        </div>
                                                                                        <div class="chat-info-list">
                                                                                            <ul class="d-flex">
                                                                                                <li><div class="chat-img-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div></li>
                                                                                                <li><div class="chat-meta-title"><p>Varun Kapoor</p></div></li>
                                                                                                <li><div class="chat-meta-data text-light-gray"><p>12 June 2022</p> </div></li>
                                                                                                <li><div class="chat-meta-time text-light-gray"><p>01:30am </p></div></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="datesetchat">
                                                                                        <div class="chat-body-date text-center">
                                                                                            <p>12 June 2022</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="chating-right">
                                                                                        <div class="chating-right-content chat-content chat-content-data">
                                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                                                        </div>
                                                                                        <div class="chating-right-content chat-content chat-content-data">
                                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
                                                                                        </div>
                                                                                        <div class="chat-info-list">
                                                                                            <ul class="d-flex chat-meta-right-list">
                                                                                            <li><div class="chat-meta-data text-light-gray"><p>12 June 2022</p> </div></li>
                                                                                                <li><div class="chat-meta-time text-light-gray"><p>01:30am </p></div></li>
                                                                                                <li><div class="chat-meta-title"><p>Varun Kapoor</p></div></li>
                                                                                                <li><div class="chat-img-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="datesetchat">
                                                                                        <div class="chat-body-date text-center">
                                                                                            <p>12 June 2022</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="chating-left">
                                                                                        <div class="chating-left-content chat-content chat-content-data">
                                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                                                        </div>
                                                                                        <div class="chat-info-list">
                                                                                            <ul class="d-flex">
                                                                                                <li><div class="chat-img-img"><img src="<?php echo $config->getimageurl() ?>images/user.png"></div></li>
                                                                                                <li><div class="chat-meta-title"><p>Varun Kapoor</p></div></li>
                                                                                                <li><div class="chat-meta-data text-light-gray"><p>12 June 2022</p> </div></li>
                                                                                                <li><div class="chat-meta-time text-light-gray"><p>01:30am </p></div></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- <div class="ps__rail-x">
                                                                                <div class="ps__thumb-x" tabindex="0"></div>
                                                                            </div>
                                                                            <div class="ps__rail-y">
                                                                                <div class="ps__thumb-y" tabindex="0"></div>
                                                                            </div> -->
                                                                        </div>
                                                                    </div>
                                                                    <div class="chat-app-form">
                                                                        <div class="row align-items-center">
                                                                            <div class="col col-chat-footer col-chat-footer-icon">
                                                                                <a href="#" class="smile-text">
                                                                                <img src="<?php echo $config->getimageurl() ?>images/smile.svg" alt="" title=""> 
                                                                                </a>
                                                                            </div>
                                                                            <div class="col col-chat-footer col-chat-footer-input">
                                                                                <form class="chat-app-input d-flex" onsubmit="enter_chat();" id="chatmessageForm" action="javascript:void(0);">
                                                                                    <textarea class="form-control message mr-1 ml-50" id="iconLeft4-1" autocomplete="off" placeholder="Enter Here" rows="1"></textarea>
                                                                                </form>
                                                                                <form class="chat-app-media d-flex hidden" action="javascript:void(0);">
                                                                                    <input type="hidden" id="mediapath" name="mediapath">
                                                                                    <input type="hidden" id="whatsappmediatype" name="whatsappmediatype">
                                                                                    <img src="" id="mediapath-new-preview  " class="image-preview mr-25">
                                                                                    <a class="hidden mediadocclickhere" id="mediadocclickhere" href="javascript:void(0)" target="_blank">Click Here Open File</a>
                                                                                    
                                                                                </form>
                                                                            </div>
                                                                            <div class="col col-chat-footer col-chat-footer-icon">
                                                                                <div class="chat-attachment">
                                                                                    <ul class="chat-attachment-list">
                                                                                        <li class="chat-attachment-item">
                                                                                            <input type="file" class="phsec">
                                                                                            <a class="media-selection photo-sec"  data-mediatype="1" href="javascript:void(0)" data-toggle="tooltip" title="" data-placement="right" data-type="whatsapp" data-ratio="1:1" data-size="900,900" data-field="mediapath" data-original-title="Photos">
                                                                                                <svg viewBox="0 0 53 53" width="53" height="53" class="svg-img-click"><defs><circle id="image-SVGID_1_" cx="26.5" cy="26.5" r="25.5"></circle></defs><clipPath id="image-SVGID_2_"><use xlink:href="#image-SVGID_1_" overflow="visible"></use></clipPath><g clip-path="url(#image-SVGID_2_)"><path fill="#AC44CF" d="M26.5-1.1C11.9-1.1-1.1 5.6-1.1 27.6h55.2c-.1-19-13-28.7-27.6-28.7z"></path><path fill="#BF59CF" d="M53 26.5H-1.1c0 14.6 13 27.6 27.6 27.6s27.6-13 27.6-27.6H53z"></path><path fill="#AC44CF" d="M17 24.5h18v9H17z"></path></g><g fill="#F5F5F5"><path id="svg-image" d="M18.318 18.25h16.364c.863 0 1.727.827 1.811 1.696l.007.137v12.834c0 .871-.82 1.741-1.682 1.826l-.136.007H18.318a1.83 1.83 0 0 1-1.812-1.684l-.006-.149V20.083c0-.87.82-1.741 1.682-1.826l.136-.007h16.364zm5.081 8.22l-3.781 5.044c-.269.355-.052.736.39.736h12.955c.442-.011.701-.402.421-.758l-2.682-3.449a.54.54 0 0 0-.841-.011l-2.262 2.727-3.339-4.3a.54.54 0 0 0-.861.011zm8.351-5.22a1.75 1.75 0 1 0 .001 3.501 1.75 1.75 0 0 0-.001-3.501z"></path></g></svg>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li class="chat-attachment-item">
                                                                                            <input type="file" class="phsec">
                                                                                            <a class="media-selection video-sec" data-mediatype="3" href="javascript:void(0)" data-toggle="tooltip" title="" data-placement="right" data-type="whatsapp" data-ratio="1:1" data-size="900,900" data-field="mediapath" data-original-title="Videos">
                                                                                                <svg width="53" height="53" viewBox="0 0 53 53" fill="none" class=""><g clip-path="url(#clip0_850:74884)"><circle cx="26.5" cy="26.5" r="26.5" fill="#0063CB"></circle><path d="M53 26.5C53 41.136 41.136 53 26.5 53S0 41.136 0 26.5h53Z" fill="#0070E6"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M36.002 22.17v4.32c-.24.321-.624.53-1.056.53H33.14a6.12 6.12 0 0 0-6.12 6.12v1.804c0 .434-.209.818-.532 1.058H22.17a5.17 5.17 0 0 1-5.17-5.17V22.17A5.17 5.17 0 0 1 22.17 17h8.662a5.17 5.17 0 0 1 5.17 5.17Zm-5.48 3.33.937-2.063 2.063-.937-2.063-.938-.937-2.062-.938 2.063-2.062.937 2.062.938.938 2.062Zm-7.022-3 1.406 3.094L28 27l-3.094 1.406L23.5 31.5l-1.406-3.094L19 27l3.094-1.406L23.5 22.5Z" fill="#F7F7F7"></path><path d="M34.946 28.52c.352 0 .69-.065 1-.183a3.87 3.87 0 0 1-1.078 2.088l-4.443 4.443a3.87 3.87 0 0 1-2.087 1.079 2.81 2.81 0 0 0 .184-1.003V33.14a4.62 4.62 0 0 1 4.62-4.62h1.804Z" fill="#F7F7F7"></path></g><defs><clipPath id="clip0_850:74884"><path fill="#fff" d="M0 0h53v53H0z"></path></clipPath></defs></svg>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li class="chat-attachment-item">
                                                                                            <input type="file" class="phsec">
                                                                                            <a class="media-selection document-sec" data-mediatype="2" href="javascript:void(0)" data-toggle="tooltip" title="" data-placement="right" data-type="whatsapp" data-field="mediapath" data-original-title="Documents">
                                                                                                <svg viewBox="0 0 53 53" width="53" height="53" class=""><defs><circle id="document-SVGID_1_" cx="26.5" cy="26.5" r="25.5"></circle></defs><clipPath id="document-SVGID_2_"><use xlink:href="#document-SVGID_1_" overflow="visible"></use></clipPath><g clip-path="url(#document-SVGID_2_)"><path fill="#5157AE" d="M26.5-1.1C11.9-1.1-1.1 5.6-1.1 27.6h55.2c-.1-19-13-28.7-27.6-28.7z"></path><path fill="#5F66CD" d="M53 26.5H-1.1c0 14.6 13 27.6 27.6 27.6s27.6-13 27.6-27.6H53z"></path></g><g fill="#F5F5F5"><path id="svg-document" d="M29.09 17.09c-.38-.38-.89-.59-1.42-.59H20.5c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H32.5c1.1 0 2-.9 2-2V23.33c0-.53-.21-1.04-.59-1.41l-4.82-4.83zM27.5 22.5V18l5.5 5.5h-4.5c-.55 0-1-.45-1-1z"></path></g></svg>
                                                                                            </a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <a href="javascript:void(0)" class="link-chat-attachment" data-toggle="tooltip" title="" data-original-title="Select Media">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                                                                                </a>
                                                                            </div>
                                                                            <div class="col col-chat-footer col-chat-footer-icon ">
                                                                                <form class="chat-app-media d-flex" action="javascript:void(0);">
                                                                                    <a href="javascript:void(0)" class="send-btn" data-toggle="tooltip" title="" onclick="enter_chat_media();" data-original-title="Send Media">
                                                                                        <img src="<?php echo $config->getimageurl() ?>images/send-btn.svg" alt="" title="">
                                                                                    </a>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </section>
                                                            </div>
                                                            <!-- User Chat profile right area -->
                                                            <div class="user-profile-sidebar hidden">
                                                                <header class="user-profile-header">
                                                                    <span class="close-icon">
                                                                        <i class="fas fa-times gridbtn"></i>
                                                                    </span>
                                                                    <div class="header-profile-sidebar">
                                                                        <div class="avatar">
                                                                            <img src="https://worldhome.totalityre.com/whatsapp/assets/images/default.png" alt="user_avatar" width="70" height="70">
                                                                            <!-- <span class="avatar-status-busy avatar-status-lg"></span> -->
                                                                        </div>
                                                                        <h4 class="chat-user-name">Brock Lee</h4>
                                                                    </div>
                                                                </header>
                                                                <div class="user-profile-sidebar-area p-2 ps">
                                                                    
                                                            <div class="scroll-area">
                                                                <h6>About</h6>
                                                                <div class="about-user">
                                                                    <fieldset class="mb-0">
                                                                        <textarea data-length="120" class="form-control char-textarea" id="textarea-counter" rows="5" placeholder="About User" data-toggle="popover" data-content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vitae justo sagittis, commodo nisi at, euismod lectus." data-original-title="Title" data-trigger="focus" data-placement="top">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce risus diam, luctus eu diam vel, ornare fermentum tortor.</textarea>
                                                                    </fieldset>
                                                                    <small class="counter-value float-right"><span class="char-count">108</span> / 120 </small>
                                                                </div>
                                                                <h6 class="mt-3">Status</h6>
                                                                <ul class="list-unstyled user-status mb-0">
                                                                    <li class="pb-50">
                                                                        <fieldset>
                                                                            <div class="vs-radio-con vs-radio-success">
                                                                                <input class="input-text" type="radio" name="" value="online" checked="checked">
                                                                                <span class="vs-radio">
                                                                                    <span class="vs-radio--border"></span>
                                                                                    <span class="vs-radio--circle"></span>
                                                                                </span>
                                                                                <span class="">Active</span>
                                                                            </div>
                                                                        </fieldset>
                                                                    </li>
                                                                    <li class="pb-50">
                                                                        <fieldset>
                                                                            <div class="vs-radio-con vs-radio-danger">
                                                                                <input class="input-text" type="radio" name="" value="busy">
                                                                                <span class="vs-radio">
                                                                                    <span class="vs-radio--border"></span>
                                                                                    <span class="vs-radio--circle"></span>
                                                                                </span>
                                                                                <span class="">Do Not Disturb</span>
                                                                            </div>
                                                                        </fieldset>
                                                                    </li>
                                                                    <li class="pb-50">
                                                                        <fieldset>
                                                                            <div class="vs-radio-con vs-radio-warning">
                                                                                <input class="input-text" type="radio" name="" value="away">
                                                                                <span class="vs-radio">
                                                                                    <span class="vs-radio--border"></span>
                                                                                    <span class="vs-radio--circle"></span>
                                                                                </span>
                                                                                <span class="">Away</span>
                                                                            </div>
                                                                        </fieldset>
                                                                    </li>
                                                                    <li class="pb-50">
                                                                        <fieldset>
                                                                            <div class="vs-radio-con vs-radio-secondary">
                                                                                <input class="input-text" type="radio" name="" value="offline">
                                                                                <span class="vs-radio">
                                                                                    <span class="vs-radio--border"></span>
                                                                                    <span class="vs-radio--circle"></span>
                                                                                </span>
                                                                                <span class="">Offline</span>
                                                                            </div>
                                                                        </fieldset>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <script type="text/javascript" src="<?php echo $panelurl?>js/jquery.min.js"></script>
                <script type="text/javascript" src="<?php echo $panelurl?>js/jquery-ui/jquery-ui.min.js"></script>
                <script src="<?php echo $panelurl?>js/bootstrap/bootstrap.min.js"></script>
                <script src="../savanigems-portal/assets/js/slim.kickstart.min.js"></script>
                <script src="../js/toastr.min.js"></script>
                <script src="../js/perfect-scrollbar.min.js"></script> 
                <script src="../js/chat.js" type="text/javascript"></script>
                 <!-- JS Start -->
                <?php include('js.php'); ?>
                <!-- JS End -->
                <script type="text/javascript">
                    $(document).ready(function(){

                        $('[data-toggle="tooltip"]').tooltip(); 

                        $('.sidebar-open-button').addClass('hidden');
                        $('#top').addClass('topmenu-hidden');
                        $('.sidebar').addClass('sidebarmenu-hidden');

                        // var contactid = <?php echo $contactid?>;
                        // if(contactid != 0)
                        // {
                        //     setTimeout(() => {
                        //         getchats(1,0,'lastchat_dateiso',contactid);
                        //         //$('#chat-'+contactid).click();
                        //     }, 300);
                        // }else{
                        //     getchats(1,0,'lastchat_dateiso');
                        // }
                    });


                    //Click Event Of Chat Person
                $('#chatlist li').on('click',function(){
                    // alert();
                    $('.new-customer-sidebar').removeClass('show');
                    $('.new-broadcast-sidebar').removeClass('show');
                    $('.template-sidebar').removeClass('show');
                    $('.user-profile-sidebar').removeClass('show');
                    $('.media-selection-view-sidebar').removeClass('show');
                    $('.view-customer-sidebar').removeClass('show');
                    $('.theme-sidebar-overlay').removeClass('show');


                    var contactid = $(this).attr('data-contactid');
                    $('.badge-'+contactid).hide();
                    if($('.chat-users-list-tab ul li').hasClass('active')){
                        $('.chat-users-list-tab ul li').removeClass('active');
                    }
                    $(this).addClass("active");
                    $(this).find(".badge").remove();
                    if($('.chat-users-list-tab ul li').hasClass('active')){
                        $('.start-chat-area').addClass('hidden');
                        $('.active-chat').removeClass('hidden');
                    }
                    else{
                        $('.start-chat-area').removeClass('hidden');
                        $('.active-chat').addClass('hidden');
                    }
                    $('.start-chat-area').attr('id','chat-area-'+contactid);
                    $('.active-chat').attr('id','active-chat-area-'+contactid);
                    $('.active-chat').attr('data-contactid',contactid);
                    var personname = $(this).attr('data-personname');
                    var contactno = $(this).attr('data-wa_id');
                    
                    var htmldata = personname;
                        
                    $('#chatpersonname').html(personname);
                    $('#chatcontactno').html(contactno);

                    // var statustypeid = $(this).attr('data-statustypeid');
                    // $('#chatstatustypeid').val(statustypeid);
                    
                    $('.letter-div').attr('data-letters',$(this).attr('data-short-personname'));
                });
                
                $('.chat-user-list').on('scroll', function() {
            
                        if($(this).scrollTop() +
                            $(this).innerHeight() >=
                            $(this)[0].scrollHeight) {
                            //var dataact = getpagename();
                        // var show = $('#tableDataList').attr('data-show');

                            //if (show == 1) {
                                var page = $('#chatlist').attr('data-page');

                                //alert(page);

                                getchats(page,0,'lastchat_dateiso');
                            //}
                        }
                    });

                $('body').on('click','.chat-application .chat-users-list-tab ul li',function(){
                    $('.new-customer-sidebar').removeClass('show');
                    $('.new-broadcast-sidebar').removeClass('show');
                    $('.template-sidebar').removeClass('show');
                    $('.user-profile-sidebar').removeClass('show');
                    // $('.media-selection-view-sidebar').removeClass('show');
                    // $('.media-selection-view-sidebar').addClass('show');
                    $('.view-customer-sidebar').removeClass('show');
                    $('.theme-sidebar-overlay').removeClass('show');
                    
                    var contactid = $(this).attr('data-contactid');
                        $('.badge-'+contactid).hide();
                        if($('.chat-users-list-tab ul li').hasClass('active')){
                            $('.chat-users-list-tab ul li').removeClass('active');
                        }
                        $(this).addClass("active");
                        $(this).find(".badge").remove();
                        if($('.chat-users-list-tab ul li').hasClass('active')){
                            $('.start-chat-area').addClass('hidden');
                            $('.active-chat').removeClass('hidden');
                        }
                        else{
                            $('.start-chat-area').removeClass('hidden');
                            $('.active-chat').addClass('hidden');
                        }
                        $('.start-chat-area').attr('id','chat-area-'+contactid);
                        $('.active-chat').attr('id','active-chat-area-'+contactid);
                        $('.active-chat').attr('data-contactid',contactid);
                        getchatlist(1,0,1);
                        var personname = $(this).attr('data-personname');
                        var contactno = $(this).attr('data-wa_id');
                        
                        var htmldata = personname;
                            
                        $('#chatpersonname').html(personname);
                        $('#chatcontactno').html(contactno);

                        var statustypeid = $(this).attr('data-statustypeid');
                        $('#chatstatustypeid').val(statustypeid);
                        
                        $('.letter-div').attr('data-letters',$(this).attr('data-short-personname'));
                    });

                    // photo-sec
                    
                    $('.photo-sec').click(function () {
                        $('.fixed-sidebar').toggleClass('sidebar-control', 500);
                        $('.v-sidebar-fade').fadeIn(500);
                    });

                    $('.close-sidebar').click(function () {
                        $('.fixed-sidebar').toggleClass('sidebar-control', 500);
                        $('.v-sidebar-fade').fadeOut(500);
                    });
        
                    // video-sec

                    $('.video-sec').click(function () {
                        $('.fixed-sidebar').toggleClass('sidebar-control', 500);
                        $('.v-sidebar-fade').fadeIn(500);
                    });

                    $('.close-sidebar').click(function () {
                        $('.fixed-sidebar').toggleClass('sidebar-control', 500);
                        $('.v-sidebar-fade').fadeOut(500);
                    });
                    
                    //  document-sec

                    $('.document-sec').click(function () {
                        $('.fixed-sidebar').toggleClass('sidebar-control', 500);
                        $('.v-sidebar-fade').fadeIn(500);
                    });
                    $('.close-sidebar').click(function () {
                        $('.fixed-sidebar').toggleClass('sidebar-control', 500);
                        $('.v-sidebar-fade').fadeOut(500);
                    });

        

        
        //Click Event Of Person Tab (Chats | Contacts)
        $('.tab-click').click(function (e) { 
            $('.active-chat').attr('data-contacid')
        });

                    //Change Event Of Filter Chat Status Type
                    $('body').on('change','#fltchatstatustypeid',function(){
                        $('.start-chat-area').removeClass('hidden');
                        $('.active-chat').addClass('hidden');
                        getchats(1,0,'lastchat_dateiso');
                    });

                    //Chat Scroll
                        $(".user-chats").scroll(function() {
                            //.box is the class of the div
                            if ($(this).scrollTop() ==0) {
                                var page = $(this).attr('data-page');
                                var show = $(this).attr('data-show');
                                if(show==1){
                                    getchatlist(page,show,1);
                                }
                                console.log('scroll');
                            }
                        });


                        
                        //Click Evet Of Options For Chats (Media,Video etc)
                        $(".link-chat-attachment").click(function(){
                            $(".chat-attachment").toggleClass("attachment-open");
                        })


                        //Click Event Of Person Tab (Chats | Contacts)
                        $('.tab-click').click(function (e) { 
                            $('.active-chat').attr('data-contacid')
                        });

                        
                        function enter_chat(source) {
                            var message = $(".message").val();
                            if(message != ""){
                                sendmessage(message);

                            }
                        }
                        
                        $('.wh-nav li').on('click', function(){
                            $(this).addClass('active').siblings().removeClass('active');
                        });

                        tinymce.init({
                        selector: "#mytextarea",
                        plugins: "emoticons autoresize",
                        toolbar: "emoticons",
                        toolbar_location: "bottom",
                        menubar: false,
                        statusbar: false
                        });

                        // $("p").click(function(){
                        //     alert("file-upload-button");
                        // });
                    </script> 
            </div>
        </div>
    </div>
</body>
</html>




