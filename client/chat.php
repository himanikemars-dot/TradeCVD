<?php 

// require_once dirname(__DIR__, 1).'/config/config.php';

// $config = new config();



require_once dirname(__DIR__, 1).'/config/init.php';

$res=$DB->getpagemetadata(24);

if($LoginInfo) 

{

    if($LoginInfo->getAdlogin()!='' && $LoginInfo->getIsguestuser()==0)

    {



        

    }

    else

    {

        ?>

        <script>

            window.location='<?php echo $config->getWeburl(); ?>home';

        </script>

        <?php

    }

}

else

{

    ?>

    <script>

        window.location='<?php echo $config->getWeburl(); ?>home';

    </script>

    <?php

}





?>

<!DOCTYPE html>

<html lang="en">

<head>

    <!-- Meta Tag Start -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="keywords" content="<?php echo $res[0]['metakeywords']; ?>" />

    <meta name="author" content="<?php echo $res[0]['title']; ?>" />

    <meta name="robots" content="<?php echo $res[0]['title']; ?>" />

    <meta name="description" content="<?php echo $res[0]['metadescription']; ?>" />

    <meta property="og:title" content="<?php echo $res[0]['title']; ?>" />

    <meta property="og:url" content="<?php echo $config->getWeburl(); ?>" />

    <meta property="og:description" content="<?php echo $res[0]['metadescription']; ?>"/>

    <meta property="og:image" content="<?php echo $config->getImageurl(); ?>images/ogiseo.png"/>

    <link rel="icon" type="image/x-icon" href="<?php echo $config->getImageurl(); ?>images/gems.png"/>

    <!-- Meta Tag End -->



    <!--title-->

    <title><?php echo $res[0]['title']; ?></title>

    

    <!-- CSS Start -->

    <?php include('css.php'); ?>

    

 

    

    <!-- CSS End -->

    <script src="assets/js/vendor/jquery.min.js"></script>

</head>

<body class="bg-white home-page max-w-2560px">

    <?php 

    $CheckUserRights=$DB->checkpackagewiseuserright($LoginInfo->getUid());

    // echo $CheckUserRights['IsPackageExpire']; exit;

    if($CheckUserRights['IsPackageExpire']==1){

        ?>

        <script>

            Notiflix.Report.Warning('<?php echo $config->getPackageExpiredTitle(); ?>','<?php echo $config->getPackageExpiredMessage(); ?>', false, function(){window.location='<?php echo $config->getPackageExpiredURL(); ?>';});

            $('#preloader').addClass('d-none');

            $('#ctn-preloader').addClass('loaded');

       </script>

    <?php

    exit;

    }

    // 4 - Member to Member Chat

    $CanMemberToMemberChat = $DB->getpackagewiseuserright($LoginInfo->getUid(),4)['attributeval'];

    if($CanMemberToMemberChat!=1)

    {

        ?>

        <script>

            window.location='<?php echo $config->getportalbaseurl(); ?>home';

        </script>

        <?php

    }

    ?>

    <div class="page-wrapper">

        <!-- Header Start -->

        <div class="has-sidebar-left">

        <header class="bg-white accent-3 relative nav-sticky tab-box-shadow">

            <div class="container-fluid text-white">

                <div class="row justify-content-center">

                    <div class="col-12 col-md-12 p-4">

                        <h4 class="mb-0 sec-desc header-desc text-darkgreen">Chat</h4>

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

                    <div class="loder-div">

                        <div class="chart-loading">

                            <img alt="loading-img" src="assets/img/loading.gif">

                        </div>

                    </div>

                    <!--Today Tab Start-->

                    <?php 

                    if($CanMemberToMemberChat==1)

                    {

                    ?>

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

                                                                                <!-- <ul class="wh-nav wh-nav-tabs d-flex text-center p-0" id="Chat-Tab" role="tablist">

                                                                                    <li class="wh-nav-item w-50 active">

                                                                                        <a class="wh-nav-link tab-click " id="SellChatTab" onclick="listchatperson(2,1);">Sell</a>

                                                                                    </li>

                                                                                    <li class="wh-nav-item w-50">

                                                                                        <a class="wh-nav-link tab-click " id="BuyChatTab" onclick="listchatperson(1,1);">Buy</a>

                                                                                    </li>

                                                                                </ul> -->

                                                                                <ul class="wh-nav wh-nav-tabs d-flex text-center p-0" id="Chat-Tab" role="tablist">

                                                                                    <li class="wh-nav-item w-50 active">

                                                                                        <a class="wh-nav-link tab-click " id="SellChatTab" onclick="listchatperson(2,1);">Buy</a><!--for table sell -->

                                                                                    </li>

                                                                                    <li class="wh-nav-item w-50">

                                                                                        <a class="wh-nav-link tab-click " id="BuyChatTab" onclick="listchatperson(1,1);">Sell</a><!--for table buy -->

                                                                                    </li>

                                                                                </ul>

                                                                            </div>

                                                                            <div class="tab-content users-tabcontent chat-users-list-tab">

                                                                                <div class="tab-pane active" id="tab1" aria-labelledby="tab1" role="tabpanel">

                                                                                    <div class="row">

                                                                                        <div class="col-12">

                                                                                            <div class="chat-fixed-search">

                                                                                                <fieldset class="form-group position-relative has-icon-left my-0 w-100">

                                                                                                    <input class="input-text" type="text" data-type="2" id="chat-search" placeholder="Search">

                                                                                                    <span class="searchbutton"><i class="fa fa-search" aria-hidden="true"></i></span>

                                                                                                    <!-- <div class="form-control-position">

                                                                                                        <i class="feather icon-search"></i>

                                                                                                    </div> -->

                                                                                                </fieldset>

                                                                                            </div>

                                                                                        </div>

                                                                                        <div class="col-12 p-0 chat-list-data">

                                                                                            <ul class="chat-users-list-wrapper media-list listchatperson" id="chatlist" data-page="1">

                                                                                                <!-- <li id="chat-1" data-contactid="1" data-personname="AB" data-contactno="999999999">

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

                                                                                                            <div class="chat-info-desc">

                                                                                                            <p >Hello, I want to purchase Dimond</p>

                                                                                                            </div>

                                                                                                        </div>

                                                                                                        <div class="contact-meta m-auto">

                                                                                                            <span class="lastchat-date">11:30 am</span>

                                                                                                            <span class="badge badge-primary badge-pill badge">1</span>

                                                                                                        </div>

                                                                                                    </div>

                                                                                                </li> -->

                                                                                            </ul>

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                            <!--  <div class="tab-pane" id="tab2" aria-labelledby="tab2" role="tabpanel">

                                                                                    <div class="row">

                                                                                        <div class="col-12">

                                                                                            <div class="chat-fixed-search">

                                                                                                <fieldset class="form-group position-relative has-icon-left my-0 w-100">

                                                                                                    <input class="input-text" type="text" id="chat-search" placeholder="Search Contact">

                                                                                                    <span class="searchbutton"><i class="fa fa-search" aria-hidden="true"></i></span>

                                                                                                </fieldset>

                                                                                            </div>

                                                                                        </div>

                                                                                        <div class="col-12 p-0 chat-list-data">

                                                                                            <ul class="chat-users-list-wrapper media-list buyercontactlist" id="chatlist" data-page="1">

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

                                                                                </div> -->

                                                                            </div>

                                                                            <div class="ps__rail-x"><div class="ps__thumb-x" tabindex="0"></div>

                                                                        </div>

                                                                        <div class="ps__rail-y">

                                                                            <div class="ps__thumb-y" tabindex="0"></div>

                                                                        </div>

                                                                    </div>

                                                                <!-- </div> -->

                                                            </div>                                



                                                        </div>

                                                    </div>

                                                 

                                                <div class="content-right mobile-chat-right-d-none">

                                                    <div class="content-wrapper">

                                                        <div class="content-header row">

                                                        </div>

                                                        <div class="content-body">

                                                            <div class="chat-overlay"></div>

                                                                <section class="chat-app-window set-window-mobile" id="listchatmessage">

                                                                    <div class="start-chat-area">

                                                                        <span class=" far fa-comment-alt mb-1 start-chat-icon icon-message-square"></span>

                                                                        <h4 class="py-50 px-1 start-chat-text">Start Conversation</h4>

                                                                    </div>

                                                                    <!-- <div class="active-chat hidden" id="listchatmessage">

                                                                        

                                                                    </div> -->

                                                                </section>

                                                            </div>

                                                            <div class="user-profile-sidebar hidden">

                                                                <header class="user-profile-header">

                                                                    <span class="close-icon">

                                                                        <i class="fas fa-times gridbtn"></i>

                                                                    </span>

                                                                    <div class="header-profile-sidebar">

                                                                        <div class="avatar">

                                                                            <img src="https://worldhome.totalityre.com/whatsapp/assets/images/default.png" alt="user_avatar" width="70" height="70">

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

                    <?php 

                    } ?>    

                </div>

                <?php include('js.php'); ?>

                 <script type="text/javascript" src="<?php echo $config->getportalbaseurl(); ?>assets/js/jquery.min.js"></script>

                <script type="text/javascript" src="<?php echo $config->getportalbaseurl(); ?>assets/js/jquery-ui/jquery-ui.min.js"></script>

                <!-- <script src="<?php echo $config->getportalbaseurl(); ?>assets/js/bootstrap/bootstrap.min.js"></script> -->

                

                <script src="<?php echo $config->getportalbaseurl(); ?>assets/js/slim.kickstart.min.js"></script>

                <script src="<?php echo $config->getportalbaseurl(); ?>assets/js/toastr.min.js"></script>

                <script src="<?php echo $config->getportalbaseurl(); ?>assets/js/perfect-scrollbar.min.js"></script> 

                <script src="<?php echo $config->getportalbaseurl(); ?>assets/js/chat.js" type="text/javascript"></script>

                <script src="<?php echo $config->getportalbaseurl(); ?>assets/js/validate.js" type="text/javascript"></script>

                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

                <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

                 <!-- JS Start -->

                

                <!-- JS End -->

                <script type="text/javascript">

                    $(document).ready(function(){



                        // $('[data-toggle="tooltip"]').tooltip(); 



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

                        if (!window.__pendingOpenChat) {
                            listchatperson(2,1);
                        }



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

                                    // alert(123);

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

                        // getchatlist(1,0,1);

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

                   /*  $('.tab-click').click(function (e) { 

                        $('.active-chat').attr('data-contacid')

                    }); */



                    //Change Event Of Filter Chat Status Type

                    $('body').on('change','#fltchatstatustypeid',function(){

                        $('.start-chat-area').removeClass('hidden');

                        $('.active-chat').addClass('hidden');

                        getchats(1,0,'lastchat_dateiso');

                    });



                    //Chat Scroll

                        /* $(".user-chats").scroll(function() {

                            //.box is the class of the div

                            if ($(this).scrollTop() ==0) {

                                var page = $(this).attr('data-page');

                                var show = $(this).attr('data-show');

                                if(show==1){

                                    // getchatlist(page,show,1);

                                }

                                console.log('scroll');

                            }

                        }); */





                        

                        //Click Evet Of Options For Chats (Media,Video etc)

                        $(".link-chat-attachment").click(function(){

                            $(".chat-attachment").toggleClass("attachment-open");

                        })





                        //Click Event Of Person Tab (Chats | Contacts)

                       /*  $('.tab-click').click(function (e) { 

                            $('.active-chat').attr('data-contacid')

                        }); */



                        

                        function enter_chat(source) {

                            var message = $(".message").val();

                            if(message != ""){

                                sendmessage(message);



                            }

                        }

                        

                        $('.wh-nav li').on('click', function(){

                            $(this).addClass('active').siblings().removeClass('active');

                        });



                        /* tinymce.init({

                        selector: "#mytextarea",

                        plugins: "emoticons autoresize",

                        toolbar: "emoticons",

                        toolbar_location: "bottom",

                        menubar: false,

                        statusbar: false

                        }); */



                        // $("p").click(function(){

                        //     alert("file-upload-button");

                        // });



                        $("#chat-search").on("input", function() {

                            var value = $(this).val();

                            var type=$(this).data('type');

                            listchatperson(type,1,value);

                        

                        });



                        



                        function listchatperson(type,page,filter='')

                        {

                            $('#chat-search').attr('data-type',type);

                            var per_page = 20;

                            var nextpage=parseInt(page)+1; 

                            // if(isshow!=1)

                            // {

                                $('.start-chat-area').removeClass('hidden');

                                $('.active-chat').addClass('hidden');

                            // }

                            // showloader();

                            $('.chart-loading').show();

                            var pagename=getpagename();

                            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:true,responsetype: 'JSON'};



                            formdata = new FormData();

                            formdata.append("action", "listchatperson");

                            formdata.append("type", type);

                            formdata.append("per_page", per_page);

                            formdata.append("page", page);

                            formdata.append("nextpage", nextpage);

                            formdata.append("filter", filter);
                            if (window.__pendingOpenChat && window.__pendingOpenChat.chattype == type) {
                                formdata.append("groupid", window.__pendingOpenChat.groupid);
                                formdata.append("productid", window.__pendingOpenChat.productid);
                                formdata.append("producttype", window.__pendingOpenChat.producttype);
                            }

                            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>chat',formdata,headersdata,Onsuccesslistchatperson,OnErrorlistchatperson);

                            function Onsuccesslistchatperson(content)

                            {

                                var emptyblock='';

                                emptyblock+='<div class="start-chat-area">';

                                emptyblock+='    <span class=" far fa-comment-alt mb-1 start-chat-icon icon-message-square"></span>';

                                emptyblock+='    <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Start Conversation</h4>';

                                emptyblock+='</div>';

                                $('#listchatmessage').html(emptyblock);

                                var JsonData = JSON.stringify(content);

                                var resultdata = jQuery.parseJSON(JsonData);

                                // hideloader();

                                $('.chart-loading').hide();

                                var htmldata='';

                                if (resultdata.IsPackageExpire == 1) {

                                    Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});

                                }

                                else{

                                    if(resultdata.status==0)

                                    {

                                        $('.listchatperson').html('');
                                        if (window.__pendingOpenChat && window.__pendingOpenChat.chattype == type) {
                                            var p = window.__pendingOpenChat;
                                            if (!p.didFallback) {
                                                p.didFallback = true;
                                                p.chattype = type == 1 ? 2 : 1;
                                                if (p.chattype == 1) {
                                                    $('#Chat-Tab #BuyChatTab').click();
                                                } else {
                                                    $('#Chat-Tab #SellChatTab').click();
                                                }
                                            } else {
                                                Notiflix.Notify.Failure('The approved chat could not be found. Please refresh and try again.');
                                                window.__pendingOpenChat = null;
                                            }
                                        }

                                    }

                                    else if(resultdata.status==1)

                                    {   

                                    

                                        if (resultdata.result.length > 0) {



                                            for(var i in resultdata.result)

                                            {



                                                htmldata+='<li id="chat-'+resultdata.result[i].personid+'" data-groupid="'+resultdata.result[i].groupid+'" data-profileimg="'+resultdata.result[i].image+'" data-contactid="'+resultdata.result[i].personid+'" data-lastseen="'+resultdata.result[i].lseen+'" data-type="'+type+'" class="personchatdetail"  data-personid="'+resultdata.result[i].personid+'" data-personname="'+resultdata.result[i].personname+'" data-contactno="'+resultdata.result[i].contactno+'" data-diamondid="'+resultdata.result[i].diamondid+'" data-buyrequestid="'+resultdata.result[i].buyrequestid+'" data-jewelleryid="'+resultdata.result[i].jewelleryid+'">';

                                                htmldata+='    <div class="chat-img"><img src="'+resultdata.result[i].image+'"></div>';

                                                htmldata+='    <div class="user-chat-info">';

                                                htmldata+='        <div class="contact-info">';

                                                if(resultdata.result[i].responsetype==2)

                                                {

                                                    htmldata+='            <h5 >'+resultdata.result[i].personname+' (Buy Request : # '+resultdata.result[i].buyrequestname+')</h5>';

                                                    var dbid=resultdata.result[i].buyrequestid;

                                                }else if(resultdata.result[i].responsetype==3)

                                                {

                                                    htmldata+='            <h5 >'+resultdata.result[i].personname+' (Jewellery : # '+resultdata.result[i].jewelleryname+')</h5>';

                                                    var dbid=resultdata.result[i].jewelleryid;

                                                }else{

                                                    htmldata+='            <h5 >'+resultdata.result[i].personname+' (Diamond : # '+resultdata.result[i].diamondname+')</h5>';

                                                    var dbid=resultdata.result[i].diamondid;

                                                }

                                                htmldata+='            <div class="chat-info-desc">';

                                                if(resultdata.result[i].isdelete==0)

                                                {

                                                    htmldata+='<p id="lastchatmsg'+dbid+'">';

                                                    if(resultdata.result[i].msgfiletype==1)

                                                    {

                                                        htmldata+='<img src="<?php echo $config->getImageurl(); ?>images/image.png" width="15" height="15" />';

                                                    }else if(resultdata.result[i].msgfiletype==4)

                                                    {

                                                        htmldata+='<img src="<?php echo $config->getImageurl(); ?>images/video.png" width="15" height="15" />';

                                                    }else if(resultdata.result[i].msgfiletype==2)

                                                    {

                                                        htmldata+='<img src="<?php echo $config->getImageurl(); ?>images/docimg.png" width="15" height="15" />';

                                                    }else if(resultdata.result[i].msgfiletype==3)

                                                    {

                                                        htmldata+='<img src="<?php echo $config->getImageurl(); ?>images/audio.png" width="15" height="15" />';

                                                    }

                                                    htmldata+=resultdata.result[i].lastchatmsg+'</p>';

                                                }else{

                                                    htmldata+='                <p id="lastchatmsg'+resultdata.result[i].personid+'">This message was deleted.</p>';

                                                }

                                                htmldata+='            </div>';

                                                htmldata+='        </div>';

                                                htmldata+='        <div class="contact-meta m-auto">';

                                                htmldata+='            <span class="lastchat-date" id="lastchatdatetime">'+resultdata.result[i].lastchatdate+'</span>';

                                                if(resultdata.result[i].unreadmsg > 0)

                                                {

                                                    htmldata+='            <span class="badge badge-primary badge-pill badge">'+resultdata.result[i].unreadmsg+'</span>';

                                                }

                                                htmldata+='        </div>';

                                                htmldata+='    </div>';

                                                htmldata+='</li>';

                                            }

                                            

                                            

                                        }

                                        $('.listchatperson').html(htmldata);
                                        if (window.__pendingOpenChat && window.__pendingOpenChat.chattype == type) {
                                            var p = window.__pendingOpenChat;
                                            var productSelector = p.producttype == 1 ? 'data-diamondid' : 'data-jewelleryid';
                                            var $row = $('#chatlist li.personchatdetail[data-groupid="' + p.groupid + '"][' + productSelector + '="' + p.productid + '"]');
                                            if (!$row.length) {
                                                $row = $('#chatlist li.personchatdetail').filter(function () {
                                                    return $(this).attr('data-groupid') == p.groupid
                                                        && $(this).attr('data-personid') == p.personid;
                                                }).first();
                                            }
                                            if (!$row.length) {
                                                $row = $('#chatlist li.personchatdetail').filter(function () {
                                                    return $(this).attr('data-groupid') == p.groupid;
                                                }).first();
                                            }
                                            if ($row.length) {
                                                $row.attr('data-diamondid', p.producttype == 1 ? p.productid : '');
                                                $row.attr('data-buyrequestid', '');
                                                $row.attr('data-jewelleryid', p.producttype == 2 ? p.productid : '');
                                                $row.removeData('diamondid').removeData('buyrequestid').removeData('jewelleryid');
                                                $row.trigger('click');
                                                $row.addClass('active');
                                                $row[0].scrollIntoView({ block: 'center' });
                                                window.__pendingOpenChat = null;
                                            } else if (!p.didFallback) {
                                                p.didFallback = true;
                                                p.chattype = type == 1 ? 2 : 1;
                                                if (p.chattype == 1) {
                                                    $('#Chat-Tab #BuyChatTab').click();
                                                } else {
                                                    $('#Chat-Tab #SellChatTab').click();
                                                }
                                            } else {
                                                Notiflix.Notify.Failure('The approved chat could not be found. Please refresh and try again.');
                                                window.__pendingOpenChat = null;
                                            }
                                        }



                                      /*   $(".listchatperson").scroll(function() {

                                            //.box is the class of the div

                                            alert();

                                            if($(this).scrollTop() +

                                                $(this).innerHeight() >=

                                                $(this)[0].scrollHeight) {

                                                    

                                                    var type=$('#chat-search').data('type');

                                                    var page = $(this).attr('data-page');

                                                    listchatperson(type,page);

                                                

                                                }

                                            

                                        }); */

                                    /*   if(isshow==1 && personid)

                                        {

                                            console.log(isshow);

                                            $('#chat-'+personid).trigger('click');

                                        } */

                                    }

                                    else if(resultdata.status == -1)

                                    {

                                        $('#btnlogout').trigger('click');

                                    }

                                }    

                                

                                

                            }



                            function OnErrorlistchatperson(content)

                            { 

                                ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);

                            }

                           

                        }





                        

                        $('body').on('click','.btn-set-clos',function(){

                            $('.sidebar-left').removeClass('mobile-chat-left-d-none');

                            $('.content-right').addClass('mobile-chat-right-d-none');

                        });







                        //sidebar-left , content-right

                        $('body').on('click','.personchatdetail',function(){

                            $('.start-chat-area').addClass('hidden');

                            $('.active-chat').removeClass('hidden');

                            var type=$(this).data('type');

                            var personid=$(this).data('personid');

                            var groupid=$(this).data('groupid');

                            var diamondid=$(this).data('diamondid');

                            var buyrequestid=$(this).data('buyrequestid');

                            var jewelleryid=$(this).data('jewelleryid');



                            var personname=$(this).data('personname');

                            var profileimg=$(this).data('profileimg');

                            var lastseen=$(this).data('lastseen');





                            $('.sidebar-left').addClass('mobile-chat-left-d-none');

                            $('.content-right').removeClass('mobile-chat-right-d-none');



                            

                            var htmldata='';

                            htmldata+='<div class="active-chat ">';

                            htmldata+='    <div class="chat_navbar">';

                            htmldata+='<a href="" class="mobile-button-back"> <button class="btn-set-clos d-none"><i class="fa fa-arrow-left" aria-hidden="true"></i></button></a>';

                            htmldata+='        <header class="col-lg-6 col-md-6 col-sm-6 chat_header d-flex justify-content-between align-items-center">';

                            htmldata+='            <div class="vs-con-items d-flex align-items-center">';

                            htmldata+='                <div class="sidebar-toggle d-block d-lg-none mr-1"><i class="feather icon-menu font-large-1"></i></div>';

                            htmldata+='                <div class="chat-img chat-nav-img"><img src="'+profileimg+'"></div>';

                            htmldata+='                <div class="chatheaderdata">';

                            // htmldata+='                    <a href="javascript:void(0)">';

                            htmldata+='                    <h6 class="mb-0">'+personname+'</h6>';

                            htmldata+='                    <div class="chatheaderdata-title">';

                            htmldata+='                        <p>Last Seen : '+lastseen+'</p>';

                            htmldata+='                    </div>';

                            // htmldata+='                    </a>';

                            htmldata+='                </div>';

                            htmldata+='            </div>';

                            htmldata+='        </header>';

                            htmldata+='        <ul class="col-lg-6 col-md-6 d-flex tabs-list">';

                            htmldata+='            <li>';

                            // htmldata+='                  <div class="stage-step pt-2 pb-3">';

                            //             htmldata+='            <ul class="d-flex">';

                            //             htmldata+='                <li><span class="bg-light-purplec border-rounded">Pear Diamond</span></li>';

                            //             htmldata+='                <li><span class="bg-light-bluec border-rounded">Sending order</span></li>';

                            //             htmldata+='                <li><span class="bg-light-greenc border-rounded">Pending Payment</span></li>';

                            //             htmldata+='            </ul>';

                            //             htmldata+='        </div>';

                            htmldata+='             </li>';

                            htmldata+='            <li><div class="stage-step pt-2 pb-3 set-step-but">';

                            htmldata+='            <ul class="d-flex">';

                            htmldata+='            <span class="serch-content searchbtsetch"><input class="input-text form-control" type="text" data-type="2" id="chat-msg-search" placeholder="Search"><i class="fa fa-search" aria-hidden="true"></i></span> ';

                            htmldata+='            </ul>';

                            htmldata+='        </div></li>';

                            htmldata+='        </ul>';

                            htmldata+='    </div>';

                            htmldata+='    <div class="user-chats" data-show="1" data-page="2">';

                            htmldata+='        <div class="chats" >';

                            htmldata+='             <div class="chat">';

                            htmldata+='                 <div class="chating-body" id="userchatlist">';

                            htmldata+='                 </div>';

                            htmldata+='             </div>';

                            /* htmldata+='             <div class="ps__rail-x">';

                            htmldata+='                 <div class="ps__thumb-x" tabindex="0"></div>';

                            htmldata+='             </div>';

                            htmldata+='             <div class="ps__rail-y">';

                            htmldata+='                 <div class="ps__thumb-y" tabindex="0"></div>';

                            htmldata+='             </div>'; */

                            htmldata+='        </div>';

                            htmldata+='    </div>';

                            //Send Data FOrm Start

                                        // htmldata+='<div id="formDiv">';

                            htmldata+='<form class="chat-app-input d-flex" id="chatmessageForm" action="javascript:void(0);">';

                                    htmldata+='<div class="chat-app-form col-12">';

                                        htmldata+='<div class="row align-items-center">';

                                            // 

                                                // htmldata+='<div class="col col-chat-footer col-chat-footer-icon">';

                                                //     htmldata+='<a href="javascript:void(0)" class="smile-text">';

                                                //     // htmldata+='<img src="<?php echo $config->getimageurl() ?>images/smile.svg" alt="" title=""> ';

                                                //     htmldata+='</a>';

                                                // htmldata+='</div>';

                                                htmldata+='<div id="selectedFiles" class="setfilesch"></div>';

                                                htmldata+='<div class="col col-chat-footer col-chat-footer-input">';

                                                    

                                                        htmldata+='<input type="hidden" id="type" name="type" value="'+type+'">';

                                                        htmldata+='<input type="hidden" id="groupid" name="groupid" value="'+groupid+'">';

                                                        htmldata+='<input type="hidden" id="sendpersonid" name="sendpersonid" value="'+personid+'">';

                                                        htmldata+='<input type="hidden" id="personname" name="personname" value="'+personname+'">';

                                                        htmldata+='<input type="hidden" id="profileimg" name="profileimg" value="'+profileimg+'">';

                                                        htmldata+='<input type="hidden" id="lastseen" name="lastseen" value="'+lastseen+'">';

                                                        htmldata+='<input type="hidden" id="diamondid" name="diamondid" value="'+diamondid+'">';

                                                        htmldata+='<input type="hidden" id="buyrequestid" name="buyrequestid" value="'+buyrequestid+'">';

                                                        htmldata+='<input type="hidden" id="jewelleryid" name="jewelleryid" value="'+jewelleryid+'">';

                                                      

                                                        htmldata+='<input type="hidden" id="rplymsgid" name="rplymsgid" value="">';

                                                        htmldata+='<div class="col-md-12 mainreplymsgtextDiv">';

                                                    

                                                        htmldata+='</div>';

                                                        // htmldata+='<textarea class="form-control message mr-1 ml-50 msgtextarea" id="iconLeft4-1" autocomplete="off" placeholder="Enter Here" rows="1" id="message" name="message"> </textarea>';

                                                        htmldata+='<input class="form-control message mr-1 ml-50 msgtextarea" id="iconLeft4-1" autocomplete="off" placeholder="Type your message..." rows="1" id="message" name="message"> </input>';



                                                htmldata+='</div>';

                                                htmldata+='<div class="col-chat-footer col-chat-footer-icon">';

                                                    htmldata+='<div class="chat-attachment">';

                                                        htmldata+='<ul class="chat-attachment-list">';

                                                        

                                                            htmldata+='<li class="chat-attachment-item">';

                                                                htmldata+='<input name="attachment[]" type="file" id="attachment" multiple="multiple" class="phsec" accept=".mp4, .mov, .wmv, .avi,.flv,.jpg,.jpeg,.png,.gif,.tiff,.bmp,.svg">';

                                                                htmldata+='<a class="media-selection photo-sec"  data-mediatype="1" href="javascript:void(0)" data-toggle="tooltip" title="" data-placement="right" data-type="whatsapp" data-ratio="1:1" data-size="900,900" data-field="mediapath" data-original-title="Photos">';

                                                                    htmldata+='<svg viewBox="0 0 53 53" width="53" height="53" class="svg-img-click"><defs><circle id="image-SVGID_1_" cx="26.5" cy="26.5" r="25.5"></circle></defs><clipPath id="image-SVGID_2_"><use xlink:href="#image-SVGID_1_" overflow="visible"></use></clipPath><g clip-path="url(#image-SVGID_2_)"><path fill="#AC44CF" d="M26.5-1.1C11.9-1.1-1.1 5.6-1.1 27.6h55.2c-.1-19-13-28.7-27.6-28.7z"></path><path fill="#BF59CF" d="M53 26.5H-1.1c0 14.6 13 27.6 27.6 27.6s27.6-13 27.6-27.6H53z"></path><path fill="#AC44CF" d="M17 24.5h18v9H17z"></path></g><g fill="#F5F5F5"><path id="svg-image" d="M18.318 18.25h16.364c.863 0 1.727.827 1.811 1.696l.007.137v12.834c0 .871-.82 1.741-1.682 1.826l-.136.007H18.318a1.83 1.83 0 0 1-1.812-1.684l-.006-.149V20.083c0-.87.82-1.741 1.682-1.826l.136-.007h16.364zm5.081 8.22l-3.781 5.044c-.269.355-.052.736.39.736h12.955c.442-.011.701-.402.421-.758l-2.682-3.449a.54.54 0 0 0-.841-.011l-2.262 2.727-3.339-4.3a.54.54 0 0 0-.861.011zm8.351-5.22a1.75 1.75 0 1 0 .001 3.501 1.75 1.75 0 0 0-.001-3.501z"></path></g></svg>';

                                                                    

                                                                htmldata+='</a>';

                                                            htmldata+='</li>';

                                                            /* htmldata+='<li class="chat-attachment-item">';

                                                                htmldata+='<input name="videoattachment[]" type="file" id="videoattachment" multiple="multiple" class="phsec" accept=".mp4, .mov, .wmv, .avi,.flv ">';

                                                                htmldata+='<a class="media-selection video-sec" data-mediatype="3" href="javascript:void(0)" data-toggle="tooltip" title="" data-placement="right" data-type="whatsapp" data-ratio="1:1" data-size="900,900" data-field="mediapath" data-original-title="Videos">';

                                                                    htmldata+='<svg width="53" height="53" viewBox="0 0 53 53" fill="none" class=""><g clip-path="url(#clip0_850:74884)"><circle cx="26.5" cy="26.5" r="26.5" fill="#0063CB"></circle><path d="M53 26.5C53 41.136 41.136 53 26.5 53S0 41.136 0 26.5h53Z" fill="#0070E6"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M36.002 22.17v4.32c-.24.321-.624.53-1.056.53H33.14a6.12 6.12 0 0 0-6.12 6.12v1.804c0 .434-.209.818-.532 1.058H22.17a5.17 5.17 0 0 1-5.17-5.17V22.17A5.17 5.17 0 0 1 22.17 17h8.662a5.17 5.17 0 0 1 5.17 5.17Zm-5.48 3.33.937-2.063 2.063-.937-2.063-.938-.937-2.062-.938 2.063-2.062.937 2.062.938.938 2.062Zm-7.022-3 1.406 3.094L28 27l-3.094 1.406L23.5 31.5l-1.406-3.094L19 27l3.094-1.406L23.5 22.5Z" fill="#F7F7F7"></path><path d="M34.946 28.52c.352 0 .69-.065 1-.183a3.87 3.87 0 0 1-1.078 2.088l-4.443 4.443a3.87 3.87 0 0 1-2.087 1.079 2.81 2.81 0 0 0 .184-1.003V33.14a4.62 4.62 0 0 1 4.62-4.62h1.804Z" fill="#F7F7F7"></path></g><defs><clipPath id="clip0_850:74884"><path fill="#fff" d="M0 0h53v53H0z"></path></clipPath></defs></svg>';

                                                                htmldata+='</a>';

                                                            htmldata+='</li>'; */

                                                            htmldata+='<li class="chat-attachment-item">';

                                                                htmldata+='<input name="docattachment[]" type="file" id="docattachment" multiple="multiple" class="phsec" accept="">';

                                                                htmldata+='<a class="media-selection document-sec" data-mediatype="2" href="javascript:void(0)" data-toggle="tooltip" title="" data-placement="right" data-type="whatsapp" data-field="mediapath" data-original-title="Documents">';

                                                                    htmldata+='<svg viewBox="0 0 53 53" width="53" height="53" class=""><defs><circle id="document-SVGID_1_" cx="26.5" cy="26.5" r="25.5"></circle></defs><clipPath id="document-SVGID_2_"><use xlink:href="#document-SVGID_1_" overflow="visible"></use></clipPath><g clip-path="url(#document-SVGID_2_)"><path fill="#5157AE" d="M26.5-1.1C11.9-1.1-1.1 5.6-1.1 27.6h55.2c-.1-19-13-28.7-27.6-28.7z"></path><path fill="#5F66CD" d="M53 26.5H-1.1c0 14.6 13 27.6 27.6 27.6s27.6-13 27.6-27.6H53z"></path></g><g fill="#F5F5F5"><path id="svg-document" d="M29.09 17.09c-.38-.38-.89-.59-1.42-.59H20.5c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H32.5c1.1 0 2-.9 2-2V23.33c0-.53-.21-1.04-.59-1.41l-4.82-4.83zM27.5 22.5V18l5.5 5.5h-4.5c-.55 0-1-.45-1-1z"></path></g></svg>';

                                                                htmldata+='</a>';

                                                            htmldata+='</li>';

                                                        htmldata+='</ul>';

                                                    htmldata+='</div>';

                                                    htmldata+='<a href="javascript:void(0)" class="link-chat-attachment" data-toggle="tooltip" title="" data-original-title="Select Media">';

                                                        htmldata+='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>';

                                                    htmldata+='</a>';

                                                htmldata+='</div>';

                                                <?php 

                                                if($CanMemberToMemberChat==1)

                                                {

                                                ?>

                                                    htmldata+='<div class=" col-chat-footer col-chat-footer-icon ">';

                                                    htmldata+='<a href="javascript:void(0)" class="chat-app-media send-btn" data-toggle="tooltip" title="" onclick="insertchatmessage()" data-original-title="Send Media">';

                                                                htmldata+='<img src="<?php echo $config->getimageurl() ?>images/send-btn.svg" alt="" title="">';

                                                        htmldata+='</a>';

                                                    htmldata+='</div>';

                                                <?php 

                                                } ?>    



                                            

                                        htmldata+='</div>';

                                    htmldata+='</div>';

                                htmldata+='</form>';

                            // htmldata+='</div>';

                            //Send Data FOrm END

                            htmldata+='</div>';

                            $('#listchatmessage').html(htmldata);

                            $(".link-chat-attachment").click(function(){

                                $(".chat-attachment").toggleClass("attachment-open");

                            })

                            setTimeout(() => {

                                $(".user-chats").scrollTop($(".user-chats").height()+4000);

                                

                                // $(".user-chats").animate({scrollTop: $(".user-chats > .chats").height()-100},400);

                            }, 100);





                            /* Files Preview Start */

                            $("#attachment,#docattachment").on("change", handleFileSelect);

                            selDiv = $("#selectedFiles");

                            $("#chatmessageForm").on("submit", handleForm);



                            $("body").on("click", ".selFile", removeFile);

                            var selDiv = "";

                            // var selDivM="";

                            var storedFiles = [];

                            function handleFileSelect(e) {



                                var files = e.target.files;

                                var filesArr = Array.prototype.slice.call(files);

                                var device = $(e.target).data("device");

                                filesArr.forEach(function(f) {



                                    storedFiles.push(f);

                                    var reader = new FileReader();

                                    reader.onload = function(e) {

                                        // console.log(f.name);

                                        var fileext=(f.name).split('.');

                                        // console.log(fileext);

                                        var ext=fileext[fileext.length-1];

                                        // console.log(ext);

                                        var videoarr=['mp4','mov','wmv','avi','flv'];

                                        var audioarr=['mp3','amr','wav'];

                                        var imgarr=['jpg','jpeg','png','gif','tiff','bmp','svg'];

                                        console.log(jQuery.inArray(ext, videoarr));

                                        if(jQuery.inArray(ext, videoarr) !== -1)

                                        {

                                            // class="selFile"

                                            var html = '<div class="setimgch"><img src="<?php echo $config->getImageurl(); ?>/images/video.png" data-file="' + f.name + '"  title="Click to remove"><i class="fas fa-times selFile"></i></div>';

                                        }else if(jQuery.inArray(ext, audioarr) !== -1){

                                            var html = '<div class="setimgch"><img src="<?php echo $config->getImageurl(); ?>/images/audio.png" data-file="' + f.name + '"  title="Click to remove"><i class="fas fa-times selFile"></i></div>';

                                        }else if(jQuery.inArray(ext, imgarr) !== -1){

                                            var html = '<div class="setimgch"><img src="' + e.target.result + '" data-file="' + f.name + '"  title="Click to remove"><i class="fas fa-times selFile"></i></div>';

                                        }else{

                                            var html = '<div class="setimgch"><img src="<?php echo $config->getImageurl(); ?>/images/docimg.png" data-file="' + f.name + '"  title="Click to remove"><i class="fas fa-times selFile"></i></div>';

                                        }

                                        // html+='<div>';

                                        // html+='</div>';

                                        $("#selectedFiles").append(html);

                                        $('.link-chat-attachment').trigger('click');

                                    }

                                    reader.readAsDataURL(f);

                                });



                            }

                            function handleForm(e) {

                                e.preventDefault();

                                var data = new FormData();



                                for (var i = 0, len = storedFiles.length; i < len; i++) {

                                    data.append('files', storedFiles[i]);

                                }



                                var xhr = new XMLHttpRequest();

                                xhr.open('POST', 'handler.cfm', true);



                                xhr.onload = function(e) {

                                    if (this.status == 200) {

                                    console.log(e.currentTarget.responseText);

                                    alert(e.currentTarget.responseText + ' items uploaded.');

                                    }

                                }



                                xhr.send(data);

                            }

                            function removeFile(e) {

                                var file = $(this).data("file");

                                for (var i = 0; i < storedFiles.length; i++) {

                                    if (storedFiles[i].name === file) {

                                    storedFiles.splice(i, 1);

                                    break;

                                    }

                                }

                                $(this).parent().remove();

                            }



                            /* Files Preview End */

                            

                            listchatmessage(type,personid,personname,profileimg,groupid,lastseen,1,diamondid,buyrequestid,jewelleryid);

                            

                            

                        })



                        $('body').on('keypress','.msgtextarea',function(e){

                            // alert();

                            var key = e.which;

                            if(key == 13)  // the enter key code

                            {

                                insertchatmessage();

                                return false;  

                            }

                        })



                        function insertchatmessage()

                        {

                            var pagename = getpagename();

                            var useraction = 'addright';

                            formdata = new FormData($("#chatmessageForm")[0]);

                            formdata.append("action", "insertchatmessage");

                            // showloader();

                            var headersdata = {

                                'Accept': 'application/json',

                                platform: 4,

                                userpagename: pagename,

                                useraction: useraction,

                                masterlisting: false

                            };

                            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + 'chat', formdata, headersdata, OnsuccesscontactusDataSubmit, OnErrorcontactus)



                            function OnsuccesscontactusDataSubmit(data) {

                                var JsonData = JSON.stringify(data);

                                var resultdata = jQuery.parseJSON(JsonData);

                                // $('.preloader').hide();

                                // hideloader();

                                if (resultdata.IsPackageExpire == 1) {

                                    Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});

                                }

                                else{

                                    if (resultdata.status == 0) {

                                        // alertify(resultdata.message,0);

                                    } else if (resultdata.status == 1) {

                                        $("#chatmessageForm").validate().resetForm();

                                        $('#chatmessageForm').trigger("reset");

                                        $('.mainreplymsgtextDiv').html('');

                                        $('#rplymsgid').val('');

                                        // Notiflix.Notify.Success(resultdata.message);

                                        listchatmessage(resultdata.type,resultdata.personid,resultdata.personname,resultdata.profileimg,resultdata.groupid,resultdata.lastseen,1,resultdata.diamondid,resultdata.buyrequestid,resultdata.jewelleryid)


                                    }else if(resultdata.status == -1)

                                    {

                                        $('#btnlogout').trigger('click');

                                    }

                                }    



                            }



                            function OnErrorcontactus(content) {

                                ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);

                            }

                                

                        }

                        // Filter

                        $("body").on("input","#chat-msg-search", function() {

                            var type=$('#chat-search').data('type');

                            var personid=$('#chatlist li.active').data('personid');

                            var lastseen=$('#chatlist li.active').data('lastseen');

                            var personname=$('#chatlist li.active').data('personname');

                            var profileimg=$('#chatlist li.active').data('profileimg');

                            var groupid=$('#chatlist li.active').data('groupid');

                            var diamondid=$('#chatlist li.active').data('diamondid');

                            var buyrequestid=$('#chatlist li.active').data('buyrequestid');

                            // var buyrequestid=$(this).data('buyrequestid');

                            listchatmessage(type,personid,personname,profileimg,groupid,lastseen,1,diamondid,buyrequestid);

                        });



                        // $('body').on('click','#userchatlist .redirecttochatmsg',function(){

                        //     var rplmsgid = $(this).attr('data-rplmsgid');

                        //     $(document).scrollTop(100);

                            





                        // });



                        function listchatmessage(type,personid,personname,profileimg,groupid,lastseen,page,diamondid,buyrequestid,jewelleryid)

                        {

                            if (typeof jewelleryid !== 'undefined') 

                            {

                               var jewelleryid = jewelleryid;

                            } else

                            {

                                var jewelleryid = '';

                            }

                            

                            var filter = $('#chat-msg-search').val();

                            var per_page = 20;

                            var nextpage=parseInt(page)+1; 

                            var pagename=getpagename();

                            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:true,responsetype: 'JSON'};

                            // showloader();

                            formdata = new FormData();

                            formdata.append("action", "listchatmessage");

                            formdata.append("groupid", groupid);

                            formdata.append("personid", personid);



                            formdata.append("nextpage", nextpage);

                            formdata.append("per_page", per_page);

                            formdata.append("page", page);

                            formdata.append("diamondid", diamondid);

                            formdata.append("buyrequestid", buyrequestid);

                            

                            formdata.append("jewelleryid", jewelleryid);



                            formdata.append("filter", filter);

                            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>chat',formdata,headersdata,Onsuccesslistchatmessage,OnErrorlistchatmessage);

                            function Onsuccesslistchatmessage(content)

                            {

                                var JsonData = JSON.stringify(content);

                                var resultdata = jQuery.parseJSON(JsonData);

                                hideloader();

                                var htmldata='';
                                var chatMessageCount = resultdata.chatmsg ? resultdata.chatmsg.length : 0;

                                if (resultdata.IsPackageExpire == 1) {

                                    Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});

                                }

                                else{

                                    if(resultdata.status==0)

                                    {

                                        $('#listchatmessage').html('');

                                    }

                                    else if(resultdata.status==1)

                                    {   

                                        var lastmsg='';

                                        if(resultdata.chatmsg)

                                        {

                                            var chatdata=(resultdata.chatmsg).reverse();

                                            for(var i in chatdata)

                                            {   

                                                var lastchatdatetime=chatdata[i].entrydate+' '+chatdata[i].entrytime;

                                                // console.log(chatdata[i].ismainmsg);

                                                if(chatdata[i].ismainmsg==1)

                                                {

                                                    htmldata+='<div class="chat-body-date">';

                                                    htmldata+='    <span class="new-chat-title">'+chatdata[i].diamondname+'</span>';

                                                  

                                                    htmldata+='</div>';

                                                }

                                                // var lastmsg='';

                                                // console.log(chatdata[i].mymessage);



                                                // console.log(resultdata.chatmsg[i].mymessage +'test')

                                                if(resultdata.chatmsg[i].mymessage==1)

                                                {

                                                    

                                                    //Sender chat data start

                                                    htmldata+='<div class="chating-right">';

                                                        htmldata+='<div class="chating-right-content chat-content chat-content-data">';

                                                        

                                                            if(resultdata.chatmsg[i].isdelete==0 && resultdata.chatmsg[i].rplymsgid !='')

                                                            {

                                                                //<a class="redirecttochatmsg" href="#chatmsgdetail'+resultdata.chatmsg[i].rplymsgid+'">

                                                                htmldata+='<div class="alert alert-mystyle alert-dismissible redirecttochatmsg" data-rplmsgid="'+resultdata.chatmsg[i].rplymsgid+'">';

                                                                

                                                                    htmldata+='<ul class="d-flex">';

                                                                

                                                                        htmldata+='<li><div class="chat-meta-title"><p>'+resultdata.chatmsg[i].rplyperson+'</p></div></li>';

                                                                    htmldata+='</ul>';

                                                                    htmldata+='<p>';

                                                                        if(resultdata.chatmsg[i].rplyfiletype==1)

                                                                        {

                                                                            for(var j in resultdata.chatmsg[i].rplyattachmentdoc)

                                                                            {

                                                                                htmldata+='<img src="'+resultdata.chatmsg[i].rplyattachmentdoc[j].image+'" width="100" height="100" />';

                                                                            }

                                                                            // htmldata+='<p>'+resultdata.chatmsg[i].personmessage+'</p>';

                                                                            

                                                                        }

                                                                        else if(resultdata.chatmsg[i].rplyfiletype==4){

                                                                            for(var j in resultdata.chatmsg[i].rplyattachmentdoc)

                                                                            {

                                                                                htmldata+='<img src="<?php echo $config->getImageurl(); ?>images/video.png" width="100" height="100" />';

                                                                            }

                                                                            // htmldata+='<p>'+resultdata.chatmsg[i].personmessage+'</p>';

                                                                            

                                                                        }

                                                                        else if(resultdata.chatmsg[i].rplyfiletype==2){

                                                                            for(var j in resultdata.chatmsg[i].rplyattachmentdoc)

                                                                            {

                                                                                htmldata+='<img src="<?php echo $config->getImageurl(); ?>images/docimg.png" width="100" height="100" />';

                                                                            }

                                                                        }

                                                                        else if(resultdata.chatmsg[i].rplyfiletype==3){

                                                                            for(var j in resultdata.chatmsg[i].rplyattachmentdoc)

                                                                            {

                                                                                htmldata+='<img src="<?php echo $config->getImageurl(); ?>images/audio.png" width="100" height="100" />';

                                                                            }

                                                                        }

                                                                        lastmsg+=resultdata.chatmsg[i].personmessage;

                                                                        // alert(lastmsg)

                                                                        htmldata+='</p>';

                                                                    htmldata+='<p>'+resultdata.chatmsg[i].rplymessage+'</p>';

                                                                htmldata+='</div>';

                                                                //</a>

                                                                

                                                            }

                                                            if(resultdata.chatmsg[i].isdelete==0)

                                                            {

                                                                if(resultdata.chatmsg[i].filetype==1){

                                                                    for(var j in resultdata.chatmsg[i].attachmentdoc)

                                                                    {

                                                                        htmldata+='<a href="'+resultdata.chatmsg[i].attachmentdoc[j].image+'" id="filechatmsgdetail'+resultdata.chatmsg[i].id+'" target="_blank" class="m-1"><img src="'+resultdata.chatmsg[i].attachmentdoc[j].image+'" width="100" height="100" /></a>';

                                                                    }

                                                                    // htmldata+='<p>'+resultdata.chatmsg[i].personmessage+'</p>';

                                                                    lastmsg+='<img src="<?php echo $config->getImageurl(); ?>images/image.png" width="15" height="15" />';

                                                                }

                                                                else if(resultdata.chatmsg[i].filetype==4){

                                                                    for(var j in resultdata.chatmsg[i].attachmentdoc)

                                                                    {

                                                                        htmldata+='<a href="'+resultdata.chatmsg[i].attachmentdoc[j].image+'" id="filechatmsgdetail'+resultdata.chatmsg[i].id+'" target="_blank" class="m-1"><img src="<?php echo $config->getImageurl(); ?>images/video.png" width="100" height="100" /></a>';

                                                                    }

                                                                    // htmldata+='<p>'+resultdata.chatmsg[i].personmessage+'</p>';

                                                                    lastmsg+='<img src="<?php echo $config->getImageurl(); ?>images/video.png" width="15" height="15" />';

                                                                }

                                                                else if(resultdata.chatmsg[i].filetype==2){

                                                                    for(var j in resultdata.chatmsg[i].attachmentdoc)

                                                                    {

                                                                        htmldata+='<a href="'+resultdata.chatmsg[i].attachmentdoc[j].image+'"  id="filechatmsgdetail'+resultdata.chatmsg[i].id+'" target="_blank" class="m-1"><img src="<?php echo $config->getImageurl(); ?>images/docimg.png" width="100" height="100" /></a>';

                                                                    }

                                                                    lastmsg+='<img src="<?php echo $config->getImageurl(); ?>images/docimg.png" width="15" height="15" />';

                                                                }

                                                                else if(resultdata.chatmsg[i].filetype==3){

                                                                    for(var j in resultdata.chatmsg[i].attachmentdoc)

                                                                    {

                                                                        htmldata+='<a href="'+resultdata.chatmsg[i].attachmentdoc[j].image+'" id="filechatmsgdetail'+resultdata.chatmsg[i].id+'" target="_blank" class="m-1"><img src="<?php echo $config->getImageurl(); ?>images/audio.png" width="100" height="100" /></a>';

                                                                    }

                                                                    lastmsg+='<img src="<?php echo $config->getImageurl(); ?>images/audio.png" width="15" height="15" />';

                                                                }

                                                                lastmsg+=resultdata.chatmsg[i].personmessage;

                                                                htmldata+='<p id="chatmsgdetail'+resultdata.chatmsg[i].id+'">'+resultdata.chatmsg[i].personmessage+'</p>';

                                                                htmldata+='<div class="dropdown text-right">';

                                                                htmldata+='<button class="dropdown-toggle" type="button" data-toggle="dropdown" style="background: none;border: none;float: right;">';

                                                                htmldata+='<i class="fas fa-ellipsis-v" style="font-size: 17px; font-weight: 500;"></i>';

                                                                htmldata+='</button>';

                                                                htmldata+='<ul class="dropdown-menu dropdown-menu-right">';

                                                                htmldata+='    <li><a href="javascript:void(0)" id="rply'+resultdata.chatmsg[i].id+'" data-username="You" class="replysinglechat" data-id="'+resultdata.chatmsg[i].id+'" data-username="Me" data-personid="'+personid+'" data-type="'+type+'" data-personname="'+personname+'" data-profileimg="'+profileimg+'" data-groupid="'+groupid+'">Reply</a></li>';

                                                                // htmldata+='    <li><a href="javascript:void(0)" class="deletesinglechat" data-id="'+resultdata.chatmsg[i].id+'" data-personid="'+personid+'" data-type="'+type+'" data-personname="'+personname+'" data-profileimg="'+profileimg+'" data-groupid="'+groupid+'">Delete</a></li>';

                                                                htmldata+='</ul>';

                                                                htmldata+='</div>';

                                                            }else{

                                                                htmldata+='<p>This message was deleted.</p>';

                                                                lastmsg+='This message was deleted.';

                                                            }

                                                        htmldata+='</div>';

                                                    

                                                        htmldata+='<div class="chat-info-list">';

                                                            htmldata+='<ul class="d-flex chat-meta-right-list">';

                                                            htmldata+='<li><div class="chat-meta-data text-light-gray"><p>'+resultdata.chatmsg[i].entrydate+'</p> </div></li>';

                                                                htmldata+='<li><div class="chat-meta-time text-light-gray"><p>'+resultdata.chatmsg[i].entrytime+' </p></div></li>';

                                                                // htmldata+='<li><div class="chat-meta-title"><p>'+resultdata.chatmsg[i].personname+'</p></div></li>';

                                                                // htmldata+='<li><div class="chat-meta-title"><p>You</p></div></li>';

                                                                // htmldata+='<li><div class="chat-img-img"><img src="'+resultdata.chatmsg[i].profilepic+'"></div></li>';

                                                            htmldata+='</ul>';

                                                        htmldata+='</div>';

                                                    htmldata+='</div>';

                                                    //Sender chat data End

                                                }else{

                                                    //Opposite person chat start

                                                    htmldata+='<div class="chating-left">';

                                                        htmldata+='<div class="chating-left-content chat-content chat-content-data">';



                                                            if(resultdata.chatmsg[i].isdelete==0 && resultdata.chatmsg[i].rplymsgid !='')

                                                            {

                                                                var pname=resultdata.chatmsg[i].rplyperson;

                                                                if(resultdata.chatmsg[i].rplypersonid=='<?php echo $LoginInfo->getUid(); ?>')

                                                                {

                                                                    pname="You";

                                                                }

                                                                htmldata+='<div class="alert alert-mystyle alert-dismissible">';

                                                                

                                                                    htmldata+='<ul class="d-flex">';

                                                                

                                                                        htmldata+='<li><div class="chat-meta-title"><p>'+pname+'</p></div></li>';

                                                                    htmldata+='</ul>';

                                                                    htmldata+='<p>';

                                                                        if(resultdata.chatmsg[i].rplyfiletype==1){

                                                                            for(var j in resultdata.chatmsg[i].rplyattachmentdoc)

                                                                            {

                                                                                htmldata+='<img src="'+resultdata.chatmsg[i].rplyattachmentdoc[j].image+'" width="100" height="100" />';

                                                                            }

                                                                            // htmldata+='<p>'+resultdata.chatmsg[i].personmessage+'</p>';

                                                                            

                                                                        }

                                                                        else if(resultdata.chatmsg[i].rplyfiletype==4){

                                                                            for(var j in resultdata.chatmsg[i].rplyattachmentdoc)

                                                                            {

                                                                                htmldata+='<img src="<?php echo $config->getImageurl(); ?>images/video.png" width="100" height="100" />';

                                                                            }

                                                                            // htmldata+='<p>'+resultdata.chatmsg[i].personmessage+'</p>';

                                                                            

                                                                        }

                                                                        else if(resultdata.chatmsg[i].rplyfiletype==2){

                                                                            for(var j in resultdata.chatmsg[i].rplyattachmentdoc)

                                                                            {

                                                                                htmldata+='<img src="<?php echo $config->getImageurl(); ?>images/docimg.png" width="100" height="100" />';

                                                                            }

                                                                        }

                                                                        else if(resultdata.chatmsg[i].rplyfiletype==3){

                                                                            for(var j in resultdata.chatmsg[i].rplyattachmentdoc)

                                                                            {

                                                                                htmldata+='<img src="<?php echo $config->getImageurl(); ?>images/audio.png" width="100" height="100" />';

                                                                            }

                                                                        }

                                                                        htmldata+='</p>';

                                                                    htmldata+='<p>'+resultdata.chatmsg[i].rplymessage+'</p>';

                                                                htmldata+='</div>';

                                                                

                                                            }

                                                            if(resultdata.chatmsg[i].isdelete==0)

                                                            {

                                                                if(resultdata.chatmsg[i].filetype==1){

                                                                    for(var j in resultdata.chatmsg[i].attachmentdoc)

                                                                    {

                                                                        htmldata+='<a href="'+resultdata.chatmsg[i].attachmentdoc[j].image+'" id="filechatmsgdetail'+resultdata.chatmsg[i].id+'"  target="_blank" class="m-1"><img src="'+resultdata.chatmsg[i].attachmentdoc[j].image+'" width="100" height="100" /></a>';

                                                                        

                                                                    }

                                                                    lastmsg+='<img src="<?php echo $config->getImageurl(); ?>images/image.png" width="15" height="15" />';

                                                                    // htmldata+='<p>'+resultdata.chatmsg[i].personmessage+'</p>';

                                                                    

                                                                }

                                                                else if(resultdata.chatmsg[i].filetype==4){

                                                                    for(var j in resultdata.chatmsg[i].attachmentdoc)

                                                                    {

                                                                        htmldata+='<a href="'+resultdata.chatmsg[i].attachmentdoc[j].image+'" id="filechatmsgdetail'+resultdata.chatmsg[i].id+'"  target="_blank" class="m-1"><img src="<?php echo $config->getImageurl(); ?>images/video.png" width="100" height="100" /></a>';

                                                                    }

                                                                    lastmsg+='<img src="<?php echo $config->getImageurl(); ?>images/video.png" width="15" height="15" />';

                                                                    // htmldata+='<p>'+resultdata.chatmsg[i].personmessage+'</p>';

                                                                    

                                                                }

                                                                else if(resultdata.chatmsg[i].filetype==2){

                                                                    for(var j in resultdata.chatmsg[i].attachmentdoc)

                                                                    {

                                                                        htmldata+='<a href="'+resultdata.chatmsg[i].attachmentdoc[j].image+'" id="filechatmsgdetail'+resultdata.chatmsg[i].id+'"  target="_blank" class="m-1"><img src="<?php echo $config->getImageurl(); ?>images/docimg.png" width="100" height="100" /></a>';

                                                                    }

                                                                    lastmsg+='<img src="<?php echo $config->getImageurl(); ?>images/docimg.png" width="15" height="15" />';

                                                                }

                                                                else if(resultdata.chatmsg[i].filetype==3){

                                                                    for(var j in resultdata.chatmsg[i].attachmentdoc)

                                                                    {

                                                                        htmldata+='<a href="'+resultdata.chatmsg[i].attachmentdoc[j].image+'" id="filechatmsgdetail'+resultdata.chatmsg[i].id+'"  target="_blank" class="m-1"><img src="<?php echo $config->getImageurl(); ?>images/audio.png" width="100" height="100" /></a>';

                                                                    }

                                                                    lastmsg+='<img src="<?php echo $config->getImageurl(); ?>images/audio.png" width="15" height="15" />';

                                                                }

                                                                lastmsg+=resultdata.chatmsg[i].personmessage;

                                                                htmldata+='<p  id="chatmsgdetail'+resultdata.chatmsg[i].id+'">'+resultdata.chatmsg[i].personmessage+'</p>';

                                                                htmldata+='<div class="dropdown text-right">';

                                                                htmldata+='<button class="dropdown-toggle" type="button" data-toggle="dropdown" style="background: none;border: none;float: right;">';

                                                                htmldata+='<i class="fas fa-ellipsis-v" style="font-size: 16px;"></i>';

                                                                htmldata+='</button>';

                                                                

                                                                

                                                                htmldata+='<ul class="dropdown-menu dropdown-menu-right">';

                                                                htmldata+='    <li><a href="javascript:void(0)" id="rply'+resultdata.chatmsg[i].id+'" data-username="'+personname+'" class="replysinglechat" data-id="'+resultdata.chatmsg[i].id+'" data-username="Me" data-personid="'+personid+'" data-type="'+type+'" data-personname="'+personname+'" data-profileimg="'+profileimg+'" data-groupid="'+groupid+'">Reply</a></li>';

                                                                // htmldata+='    <li><a href="javascript:void(0)" class="deletesinglechat" data-id="'+resultdata.chatmsg[i].id+'" data-personid="'+personid+'" data-type="'+type+'" data-personname="'+personname+'" data-profileimg="'+profileimg+'" data-groupid="'+groupid+'">Delete</a></li>';

                                                                htmldata+='</ul>';

                                                                htmldata+='</div>';

                                                            }else{

                                                                htmldata+='<p>This message was deleted.</p>';

                                                                lastmsg+='This message was deleted.';

                                                            }

                                                        htmldata+='</div>';

                                                        htmldata+='<div class="chat-info-list">';

                                                            htmldata+='<ul class="d-flex">';

                                                                // htmldata+='<li><div class="chat-img-img"><img src="'+resultdata.chatmsg[i].profilepic+'"></div></li>';

                                                                // htmldata+='<li><div class="chat-meta-title"><p>'+resultdata.chatmsg[i].personname+'</p></div></li>';

                                                                htmldata+='<li><div class="chat-meta-data text-light-gray"><p>'+resultdata.chatmsg[i].entrydate+'</p> </div></li>';

                                                                htmldata+='<li><div class="chat-meta-time text-light-gray"><p>'+resultdata.chatmsg[i].entrytime+' </p></div></li>';

                                                            htmldata+='</ul>';

                                                        htmldata+='</div>';

                                                    htmldata+='</div>';

                                                    //Opposite person chat start

                                                }

                                                



                                            }

                                        }

                                                    



                                        if(page==1 && chatMessageCount > 0)

                                        {  

                                            $("#userchatlist").html(htmldata);

                                            setTimeout(() => {

                                                // $(".user-chats").scrollTop($(".user-chats > .chats").height()-100);

                                                $(".user-chats").scrollTop($(".user-chats").height()+4000);

                                                // $(".user-chats").animate({scrollTop: $(".user-chats > .chats").height()-100},400);

                                            }, 100);



                                            

                                        }

                                        else if(chatMessageCount > 0)

                                        {

                                            $("#userchatlist").prepend(htmldata);



                                            // var value = $(this).val();

                                            // var type=$(this).data('type');

                                            

                                        }

                                       

                                        // $('#listchatmessage').html(htmldata);

                                        if(page==1)

                                        {

                                            $('#lastchatmsg'+personid).html(lastmsg);

                                            $('#lastchatdatetime').html(lastchatdatetime);

                                        }

                                        $('#selectedFiles').html('');

                                        //    $('.link-chat-attachment').trigger('click');

                                        $(".user-chats").scroll(function() {

                                            //.box is the class of the div

                                            if ($(this).scrollTop() ==0) {

                                                var type=$('#chat-search').data('type');

                                                var page = $(this).attr('data-page');

                                                var show = $(this).attr('data-show');

                                                var personid=$('#chatlist li.active').data('personid');

                                                var lastseen=$('#chatlist li.active').data('lastseen');

                                                var personname=$('#chatlist li.active').data('personname');

                                                var profileimg=$('#chatlist li.active').data('profileimg');

                                                var groupid=$('#chatlist li.active').data('groupid');

                                                if(show==1)

                                                {

                                                    listchatmessage(type,personid,personname,profileimg,groupid,lastseen,page,diamondid,buyrequestid,'');

                                                }

                                                // console.log('scroll');

                                            }

                                        });

                                    }else if(resultdata.status == -1)

                                    {

                                        $('#btnlogout').trigger('click');

                                    }

                                }   

                                if(resultdata.datasize == per_page)

                                {

                                    $(".user-chats").attr('data-show',1);

                                    $(".user-chats").attr('data-page',nextpage);

                                }

                                else

                                {

                                    $(".user-chats").attr('data-show',0);

                                    $(".user-chats").attr('data-page',nextpage);

                                }

                                

                            }



                            function OnErrorlistchatmessage(content)

                            { 

                                ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);

                            }

                        }

                        

                        /*********** Start Delete Chat Message ***************/

                        //Click Event Of Delete Chat Message

                        $('body').on('click','.deletesinglechat',function(){

                            var chatid = $(this).attr('data-id');

                            var personid = $(this).attr('data-personid');

                            var type = $(this).attr('data-type');

                            var personname = $(this).attr('data-personname');

                            var profileimg = $(this).attr('data-profileimg');

                            var groupid = $(this).attr('data-groupid');



                            Notiflix.Confirm.Show(false,'Are you want to delete this data?', false, false, function() {

                                var pagename = getpagename();

                                var useraction = '';

                                formdata = new FormData();

                                formdata.append("action", "deletesinglechat");

                                formdata.append("chatid", chatid);

                                showloader();

                                var headersdata = {

                                    'Accept': 'application/json',

                                    platform: 4,

                                    userpagename: pagename,

                                    useraction: useraction,

                                    masterlisting: false

                                };

                                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + 'chat', formdata, headersdata, OnsuccessdeleteMsgData, OnErrordeletemessage)



                                function OnsuccessdeleteMsgData(data) {

                                    var JsonData = JSON.stringify(data);

                                    var resultdata = jQuery.parseJSON(JsonData);

                                    // $('.preloader').hide();

                                    hideloader();

                                    if (resultdata.IsPackageExpire == 1) {

                                        Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});

                                    }

                                    else{

                                        if (resultdata.status == 0) {

                                            // alertify(resultdata.message,0);

                                        } else if (resultdata.status == 1) {

                                            $("#chatmessageForm").validate().resetForm();

                                            $('#chatmessageForm').trigger("reset");

                                            Notiflix.Notify.Success(resultdata.message);

                                            // listchatmessage(resultdata.type,resultdata.personid,resultdata.personname,resultdata.profileimg,resultdata.groupid)

                                            listchatmessage(type,personid,personname,profileimg,groupid,1);



                                        }else if(resultdata.status == -1)

                                        {

                                            $('#btnlogout').trigger('click');

                                        }

                                    }    



                                }



                                function OnErrordeletemessage(content) {

                                    ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);

                                }





                            }, function() {

           

                            });

                            	

                            

                        });

                        /*********** End Delete Chat Message ***************/

                        

                        /*********** Start Reply Chat Message ***************/

                        //Click Event Of Reply Chat Message

                        $('body').on('click','.replysinglechat',function(){

                            $('.mainreplymsgtextDiv').removeClass('hidden');

                            var chatid = $(this).attr('data-id');

                            var username = $(this).attr('data-username');

                            

                            var simpletext = $('#chatmsgdetail'+chatid).html();

                            var filetext = $('#filechatmsgdetail'+chatid).html();

                            

                            var replymsgdata='';

                            

                            replymsgdata+='<div class="replymsgtextDiv">';

                            replymsgdata+='<div class="alert alert-mystyle alert-dismissible">';

                            replymsgdata+='<a href="javascript:void(0)" class="close btnreplydivclose" data-dismiss="alert" aria-label="close">&times;</a>';

                            replymsgdata+='<p class="userreplymsgname">'+username+'</p>';

                            

                            if(simpletext)

                            {

                                replymsgdata+='<p>'+simpletext+'</p>';	

                            }

                            

                            if(filetext)

                            {

                                replymsgdata+='<p>'+filetext+'</p>';	

                            }

                            

                            replymsgdata+='</div>';

                            replymsgdata+='</div>';

                            

                            $('#chatmessageForm .mainreplymsgtextDiv').html(replymsgdata);

                            $('#chatmessageForm #rplymsgid').val(chatid);

                            

                            

                            

                            /*

                            $('.loading').show();

                            jqXHR = $.ajax({

                                url : "chatgetdata.php",

                                type : "POST",

                                dataType: "json",

                                data:{action:'deletesinglechat',chatid:chatid},

                                success : function(data) 

                                {

                                    var JsonData = JSON.stringify(data);

                                    var resultdata = jQuery.parseJSON(JsonData);

                        

                                    if (resultdata.status == 0) 

                                    {

                                        $('.loading').hide();

                                        alertify(resultdata.message, 'error');

                                    }

                                    else if(resultdata.status == 1)

                                    {

                                        alertify(resultdata.message, 'success');	

                                        

                                        //Get Chat Message Data

                                        getchatmsgdata();

                                    }

                                }

                            });

                            */

                        });

                        /*********** End Reply Chat Message ***************/





                        $('body').on('click','.btnreplydivclose',function(){

                            $('.mainreplymsgtextDiv').addClass('hidden');

                            $('#rplymsgid').val('');

                        })



                        var mmc = '<?php echo $_REQUEST['mmc']; ?>';
                        var openGroupId   = <?php echo json_encode((string)$IISMethods->sanitize($_REQUEST['groupid'])); ?>;
                        var openPersonId  = <?php echo json_encode((string)$IISMethods->sanitize($_REQUEST['personid'])); ?>;
                        var openProductId = <?php echo json_encode((string)$IISMethods->sanitize($_REQUEST['productid'])); ?>;
                        var openProductType = <?php echo isset($_REQUEST['producttype']) ? (int)$_REQUEST['producttype'] : 2; ?>;
                        var openChatType  = <?php echo (int)$_REQUEST['chattype']; ?> || 1;

                        if (openGroupId && openPersonId) {
                            window.__pendingOpenChat = { groupid: openGroupId, personid: openPersonId, productid: openProductId, producttype: openProductType, chattype: openChatType };
                            setTimeout(function () {
                                // chattype 1 = "Sell" label (#BuyChatTab → listchatperson(1,1))
                                // chattype 2 = "Buy"  label (#SellChatTab → listchatperson(2,1))   — labels swapped છે (line 146-153)
                                if (openChatType == 1) { $('#Chat-Tab #BuyChatTab').click(); }
                                else { $('#Chat-Tab #SellChatTab').click(); }
                                removefilterurl();
                            }, 500);
                        }

                        // alert(mmd);

                        if(mmc==1)

                        {

                            setTimeout(() => {

                                $('#Chat-Tab  #BuyChatTab').click();

                                removefilterurl();

                            }, 500);

                            

                        }



                    </script> 

            </div>

        </div>

    </div>

</body>

</html>
