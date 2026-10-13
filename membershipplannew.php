<?php require_once 'config/init.php';
require_once 'config/apiconfig.php';
$res=$DB->getpagemetadata(19);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tag Start -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="<?php echo $res[0]['metakeywords']; ?>" />
    <meta name="author" content="Trade CVD" />
    <meta name="robots" content="Trade CVD" />
    <meta name="description" content="<?php echo $res[0]['metadescription']; ?>" />
    <meta property="og:title" content="<?php echo $res[0]['title']; ?>" />
    <meta property="og:url" content="<?php echo $config->getWeburl(); ?>" />
    <meta property="og:description" content="<?php echo $res[0]['metadescription']; ?>"/>
    <meta property="og:image" content="<?php echo $config->getImageurl(); ?>images/ogiseo.png"/>
    <link rel="icon" type="image/x-icon" href="<?php echo $config->getImageurl(); ?>images/favicon.ico"/>
    <!-- Meta Tag End -->

    <!--title-->
    <title><?php echo $res[0]['title']; ?></title>

    <!-- CSS Start -->
    <?php include('css.php'); ?>

    <!-- CSS End -->
    <script src="assets/js/vendor/jquery.min.js"></script>
</head>

<body class="membershipplan">
    <div class="page-wrapper">
        <!-- Header Start -->
        <?php include('header.php'); ?>
        <!-- Header End -->
        <div class="main page-title mainbg-img" id="web-content" style="background-image: url(<?php echo $config->getimageurl() ?>images/payment-mode-bg.jpg);">
            <section class="package-list-sec section-space">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mb-5 text-center">
                            <div class="package-list-title">
                                <h1 class="sec-title text-black title-shaddow">Package List</h1>
                            </div>
                            <div class="package-list-desc">
                                <p class="sec-desc text-gray">Whether you're a jeweler, dealer or manufacturer, Trade CVD has a membership plan to suit your needs.<br /> Choose the plan that's right for you.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 set-plan-data">
                        <div class="plans-for-registration">
                            <div class="plans-block appear visible-element">
                                <header class="plans-headline text-center">
                                    <nav class="tabset animated animated-slide-bottom delay-05">
                                        <ul class="nav nav-pills toggle-btns-js cost-button">
                                            <li id="years-price">
                                                <a href="javascript:void(0);" data-category="Membership" data-type="1" class="show-icon-save typechange active" data-label="Billed annually selector">Billed Annually </a>

                                            </li>
                                            <li id="month-price"><a href="javascript:void(0);" data-type="2" class="hide-icon-save typechange" data-category="Membership" data-label="Billed monthly selector">Billed Monthly</a></li>
                                            <img class="save20-ico annually" src="#" alt="" style="display: block;">
                                            <img class="save20-ico month" src="#" alt="" style="display: none;">
                                        </ul>
                                    </nav>
                                </header>
                                <section class="savani-hr hr-sec section-space pt-0">
                                    <div class="#">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4 col-xl-3 col-sm-6 col-6 d-sm-block d-none p-set-all">
                                                <div class="panel-set">
                                                    <div class="owl-carousel palnpenal owl-theme">
                                                        <div class="item">
                                                            <div class="image-set-plan">
                                                                <img src="" alt="plan image not found">
                                                            </div>
                                                            <div class="des-plan">
                                                                <p>Diamond Search</p>
                                                                <p>Jewelry Search</p>
                                                                <p>Share Diamonds and Jewelry</p>
                                                                <p>Member to Member Chat</p>
                                                                <p>Buy Requests</p>
                                                                <p>List Diamonds for Sale</p>
                                                                <p>SavaniGems XL for Excel</p>
                                                                <p>Additional Users Add-on</p>
                                                                <p>Priority Customer Support</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-8 col-xl-9 col-sm-6 col-12">
                                                <div class="panel-set-multi">
                                                    <div class="owl-carousel palnpenal-multi owl-theme">
                                                        <div class="item">
                                                            <header class="plan-heading"><h2 class="">Trade CVD Buyer</h2></header>
                                                            <div class="middle-part">
                                                                <div class="price-middle-part">
                                                                    <p class="price years" data-price="annually">$8000</p>
                                                                    <span class="button-save">
                                                                        <p class="label-save">
                                                                            <span>Save $400</span>
                                                                        </p>
                                                                    </span>
                                                                </div>
                                                                <div class="plans-text">
                                                                    <div class="wrapper-title">
                                                                        <p>Trade CVD Buyer</p>
                                                                    </div>
                                                                    <div class="sec-desc plan-desc">
                                                                        <p>For members of the trade looking to buy diamonds and jewelry, and access diamond pricing information and tools.</p>
                                                                    </div>
                                                                </div>
                                                                <h4 class="text-center">
                                                                    <b class="text-success">Currently Active Package</b>
                                                                </h4>
                                                                <p class="text-center">
                                                                    <b class="text-danger">Expire on 01/11/2023</b>
                                                                </p>
                                                            </div>
                                                            <div class="des-plan-multi">
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Diamond Search</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Jewelry Search</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Share Diamonds and Jewelry</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Member to Member Chat</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Buy Requests</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>List Diamonds for Sale</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>SavaniGems XL for Excel</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Additional Users Add-on</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Priority Customer Support</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <header class="plan-heading"><h2 class="">Trade CVD Buyer</h2></header>
                                                            <div class="middle-part">
                                                                <div class="price-middle-part">
                                                                    <p class="price years" data-price="annually">$8000</p>
                                                                    <span class="button-save">
                                                                        <p class="label-save">
                                                                            <span>Save $400</span>
                                                                        </p>
                                                                    </span>
                                                                </div>
                                                                <div class="plans-text">
                                                                    <div class="wrapper-title">
                                                                        <p>Trade CVD Buyer</p>
                                                                    </div>
                                                                    <div class="sec-desc plan-desc">
                                                                        <p>For members of the trade looking to buy diamonds and jewelry, and access diamond pricing information and tools.</p>
                                                                    </div>
                                                                </div>
                                                                <h4 class="text-center">
                                                                    <b class="text-success">Currently Active Package</b>
                                                                </h4>
                                                                <p class="text-center">
                                                                    <b class="text-danger">Expire on 01/11/2023</b>
                                                                </p>
                                                            </div>
                                                            <div class="des-plan-multi">
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Diamond Search</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Jewelry Search</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Share Diamonds and Jewelry</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Member to Member Chat</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Buy Requests</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>List Diamonds for Sale</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>SavaniGems XL for Excel</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Additional Users Add-on</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Priority Customer Support</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <header class="plan-heading"><h2 class="">Trade CVD Buyer</h2></header>
                                                            <div class="middle-part">
                                                                <div class="price-middle-part">
                                                                    <p class="price years" data-price="annually">$8000</p>
                                                                    <span class="button-save">
                                                                        <p class="label-save">
                                                                            <span>Save $400</span>
                                                                        </p>
                                                                    </span>
                                                                </div>
                                                                <div class="plans-text">
                                                                    <div class="wrapper-title">
                                                                        <p>Trade CVD Buyer</p>
                                                                    </div>
                                                                    <div class="sec-desc plan-desc">
                                                                        <p>For members of the trade looking to buy diamonds and jewelry, and access diamond pricing information and tools.</p>
                                                                    </div>
                                                                </div>
                                                                <h4 class="text-center">
                                                                    <b class="text-success">Currently Active Package</b>
                                                                </h4>
                                                                <p class="text-center">
                                                                    <b class="text-danger">Expire on 01/11/2023</b>
                                                                </p>
                                                            </div>
                                                            <div class="des-plan-multi">
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Diamond Search</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Jewelry Search</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Share Diamonds and Jewelry</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Member to Member Chat</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Buy Requests</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>List Diamonds for Sale</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>SavaniGems XL for Excel</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Additional Users Add-on</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Priority Customer Support</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <header class="plan-heading"><h2 class="">Trade CVD Buyer</h2></header>
                                                            <div class="middle-part">
                                                                <div class="price-middle-part">
                                                                    <p class="price years" data-price="annually">$8000</p>
                                                                    <span class="button-save">
                                                                        <p class="label-save">
                                                                            <span>Save $400</span>
                                                                        </p>
                                                                    </span>
                                                                </div>
                                                                <div class="plans-text">
                                                                    <div class="wrapper-title">
                                                                        <p>Trade CVD Buyer</p>
                                                                    </div>
                                                                    <div class="sec-desc plan-desc">
                                                                        <p>For members of the trade looking to buy diamonds and jewelry, and access diamond pricing information and tools.</p>
                                                                    </div>
                                                                </div>
                                                                <h4 class="text-center">
                                                                    <b class="text-success">Currently Active Package</b>
                                                                </h4>
                                                                <p class="text-center">
                                                                    <b class="text-danger">Expire on 01/11/2023</b>
                                                                </p>
                                                            </div>
                                                            <div class="des-plan-multi">
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Diamond Search</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Jewelry Search</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Share Diamonds and Jewelry</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Member to Member Chat</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Buy Requests</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>List Diamonds for Sale</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>SavaniGems XL for Excel</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Additional Users Add-on</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Priority Customer Support</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <header class="plan-heading"><h2 class="">Trade CVD Buyer</h2></header>
                                                            <div class="middle-part">
                                                                <div class="price-middle-part">
                                                                    <p class="price years" data-price="annually">$8000</p>
                                                                    <span class="button-save">
                                                                        <p class="label-save">
                                                                            <span>Save $400</span>
                                                                        </p>
                                                                    </span>
                                                                </div>
                                                                <div class="plans-text">
                                                                    <div class="wrapper-title">
                                                                        <p>Trade CVD Buyer</p>
                                                                    </div>
                                                                    <div class="sec-desc plan-desc">
                                                                        <p>For members of the trade looking to buy diamonds and jewelry, and access diamond pricing information and tools.</p>
                                                                    </div>
                                                                </div>
                                                                <h4 class="text-center">
                                                                    <b class="text-success">Currently Active Package</b>
                                                                </h4>
                                                                <p class="text-center">
                                                                    <b class="text-danger">Expire on 01/11/2023</b>
                                                                </p>
                                                            </div>
                                                            <div class="des-plan-multi">
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Diamond Search</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Jewelry Search</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Share Diamonds and Jewelry</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Member to Member Chat</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Buy Requests</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>List Diamonds for Sale</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>SavaniGems XL for Excel</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Additional Users Add-on</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Priority Customer Support</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <header class="plan-heading"><h2 class="">Trade CVD Buyer</h2></header>
                                                            <div class="middle-part">
                                                                <div class="price-middle-part">
                                                                    <p class="price years" data-price="annually">$8000</p>
                                                                    <span class="button-save">
                                                                        <p class="label-save">
                                                                            <span>Save $400</span>
                                                                        </p>
                                                                    </span>
                                                                </div>
                                                                <div class="plans-text">
                                                                    <div class="wrapper-title">
                                                                        <p>Trade CVD Buyer</p>
                                                                    </div>
                                                                    <div class="sec-desc plan-desc">
                                                                        <p>For members of the trade looking to buy diamonds and jewelry, and access diamond pricing information and tools.</p>
                                                                    </div>
                                                                </div>
                                                                <h4 class="text-center">
                                                                    <b class="text-success">Currently Active Package</b>
                                                                </h4>
                                                                <p class="text-center">
                                                                    <b class="text-danger">Expire on 01/11/2023</b>
                                                                </p>
                                                            </div>
                                                            <div class="des-plan-multi">
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Diamond Search</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Jewelry Search</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Share Diamonds and Jewelry</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Member to Member Chat</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Buy Requests</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>List Diamonds for Sale</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>SavaniGems XL for Excel</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Additional Users Add-on</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                                                </div>
                                                                <div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >
                                                                    <p>Priority Customer Support</p>
                                                                </div>
                                                                <div class="p-img">
                                                                    <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- <section class="savani-hr hr-sec section-space pt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 p-set-all">
                            <div class="panel-set">
                                <div class="owl-carousel palnpenal owl-theme">
                                    <div class="item">
                                        <div class="image-set-plan">
                                            <img src="http://192.168.1.2/savanigems/assets/images/pricing-bg.png" alt="plan image not found">
                                        </div>
                                        <div class="des-plan">
                                            <p>Diamond Search</p>
                                            <p>Jewelry Search</p>
                                            <p>Share Diamonds and Jewelry</p>
                                            <p>Member to Member Chat</p>
                                            <p>Buy Requests</p>
                                            <p>List Diamonds for Sale</p>
                                            <p>SavaniGems XL for Excel</p>
                                            <p>Additional Users Add-on</p>
                                            <p>Priority Customer Support</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="panel-set-multi">
                                <div class="owl-carousel palnpenal-multi owl-theme">
                                    <div class="item">
                                        <header class="plan-heading"><h2 class="">Trade CVD Buyer</h2></header>
                                        <div class="middle-part">
                                            <div class="price-middle-part">
                                                <p class="price years" data-price="annually">$8000</p>
                                                <span class="button-save">
                                                    <p class="label-save">
                                                        <span>Save $400</span>
                                                    </p>
                                                </span>
                                            </div>
                                            <div class="plans-text">
                                                <div class="wrapper-title">
                                                    <p>Trade CVD Buyer</p>
                                                </div>
                                                <div class="sec-desc plan-desc">
                                                    <p>For members of the trade looking to buy diamonds and jewelry, and access diamond pricing information and tools.</p>
                                                </div>
                                            </div>
                                            <h4 class="text-center">
                                                <b class="text-success">Currently Active Package</b>
                                            </h4>
                                            <p class="text-center">
                                                <b class="text-danger">Expire on 01/11/2023</b>
                                            </p>
                                        </div>
                                        <div class="des-plan-multi">
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <header class="plan-heading"><h2 class="">Trade CVD Dealer</h2></header>
                                        <div class="middle-part">
                                            <div class="price-middle-part">
                                                <p class="price years" data-price="annually">$4000</p>
                                                <span class="button-save">
                                                    <p class="label-save">
                                                        <span>Save $400</span>
                                                    </p>
                                                </span>
                                            </div>
                                            <div class="plans-text">
                                                <div class="wrapper-title">
                                                    <p>Trade CVD Buyer</p>
                                                </div>
                                                <div class="sec-desc plan-desc">
                                                    <p>For members of the trade looking to buy diamonds and jewelry, and access diamond pricing information and tools.</p>
                                                </div>
                                            </div>
                                            <div class="apply-set text-center">
                                                <a class="btn btn-black btn-plans btnapplychooseplan" data-package="BA563644-D29E-333E-BE81-1D90C698D69C" data-type="1" href="javascript:void(0);">Apply Now</a>
                                            </div>
                                        </div>
                                        <div class="des-plan-multi">
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <header class="plan-heading"><h2 class="">Trade CVD Buyer</h2></header>
                                        <div class="middle-part">
                                            <div class="price-middle-part">
                                                <p class="price years" data-price="annually">$8000</p>
                                                <span class="button-save">
                                                    <p class="label-save">
                                                        <span>Save $400</span>
                                                    </p>
                                                </span>
                                            </div>
                                            <div class="plans-text">
                                                <div class="wrapper-title">
                                                    <p>Trade CVD Buyer</p>
                                                </div>
                                                <div class="sec-desc plan-desc">
                                                    <p>For members of the trade looking to buy diamonds and jewelry, and access diamond pricing information and tools.</p>
                                                </div>
                                            </div>
                                            <h4 class="text-center">
                                                <b class="text-success">Currently Active Package</b>
                                            </h4>
                                            <p class="text-center">
                                                <b class="text-danger">Expire on 01/11/2023</b>
                                            </p>
                                        </div>
                                        <div class="des-plan-multi">
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <header class="plan-heading"><h2 class="">Trade CVD Buyer</h2></header>
                                        <div class="middle-part">
                                            <div class="price-middle-part">
                                                <p class="price years" data-price="annually">$8000</p>
                                                <span class="button-save">
                                                    <p class="label-save">
                                                        <span>Save $400</span>
                                                    </p>
                                                </span>
                                            </div>
                                            <div class="plans-text">
                                                <div class="wrapper-title">
                                                    <p>Trade CVD Buyer</p>
                                                </div>
                                                <div class="sec-desc plan-desc">
                                                    <p>For members of the trade looking to buy diamonds and jewelry, and access diamond pricing information and tools.</p>
                                                </div>
                                            </div>
                                            <h4 class="text-center">
                                                <b class="text-success">Currently Active Package</b>
                                            </h4>
                                            <p class="text-center">
                                                <b class="text-danger">Expire on 01/11/2023</b>
                                            </p>
                                        </div>
                                        <div class="des-plan-multi">
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <header class="plan-heading"><h2 class="">Trade CVD Buyer</h2></header>
                                        <div class="middle-part">
                                            <div class="price-middle-part">
                                                <p class="price years" data-price="annually">$8000</p>
                                                <span class="button-save">
                                                    <p class="label-save">
                                                        <span>Save $400</span>
                                                    </p>
                                                </span>
                                            </div>
                                            <div class="plans-text">
                                                <div class="wrapper-title">
                                                    <p>Trade CVD Buyer</p>
                                                </div>
                                                <div class="sec-desc plan-desc">
                                                    <p>For members of the trade looking to buy diamonds and jewelry, and access diamond pricing information and tools.</p>
                                                </div>
                                            </div>
                                            <h4 class="text-center">
                                                <b class="text-success">Currently Active Package</b>
                                            </h4>
                                            <p class="text-center">
                                                <b class="text-danger">Expire on 01/11/2023</b>
                                            </p>
                                        </div>
                                        <div class="des-plan-multi">
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <header class="plan-heading"><h2 class="">Trade CVD Buyer</h2></header>
                                        <div class="middle-part">
                                            <div class="price-middle-part">
                                                <p class="price years" data-price="annually">$8000</p>
                                                <span class="button-save">
                                                    <p class="label-save">
                                                        <span>Save $400</span>
                                                    </p>
                                                </span>
                                            </div>
                                            <div class="plans-text">
                                                <div class="wrapper-title">
                                                    <p>Trade CVD Buyer</p>
                                                </div>
                                                <div class="sec-desc plan-desc">
                                                    <p>For members of the trade looking to buy diamonds and jewelry, and access diamond pricing information and tools.</p>
                                                </div>
                                            </div>
                                            <h4 class="text-center">
                                                <b class="text-success">Currently Active Package</b>
                                            </h4>
                                            <p class="text-center">
                                                <b class="text-danger">Expire on 01/11/2023</b>
                                            </p>
                                        </div>
                                        <div class="des-plan-multi">
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-x.svg" alt="error">
                                            </div>
                                            <div class="p-img">
                                                <img src="http://192.168.1.2/savanigems/assets/images/icon-v.svg" alt="error">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            <section class="savani-hr hr-sec section-space ">
                <div class="container-xl">
                    <div class="row">
                        <div class="col-12">
                            <div class="row justify-content-center">
                                <div class="col-5">
                                    <hr />
                                </div>
                                <div class="col-1 col-hr">
                                    <div class="hr-img">
                                        <img src="<?php echo $config->getimageurl() ?>images/homepage/diamonds.svg" alt="diamonds" title="diamonds">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="paymentmode-sec section-space pt-0 listpaymentmodedetail">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-10 text-center mb-5">
                            <div class="paymentmode-title">
                                <h3 class="sec-title text-black">Payment Mode</h3>
                            </div>
                            <div class="paymentmode-desc text-blue paydescr">
                                <!-- <p class="sec-desc text-blue">All prices are in USD. Plans can be canceled at any time in accordance with our terms and conditions. <br /> Accepting Visa, Master Card, American Express, and Discover</p> -->
                            </div>
                        </div>
                        <div class="col-10 m-auto text-center" id="listpaymentmodedetail">
                            <!-- <div class="paymentmode-slider owl-carousel owl-theme">
                                <div class="item">
                                    <figure class="paymentmode-imgs">
                                        <img src="<?php echo $config->getimageurl() ?>images/chooseplan/visa.svg" alt="Visa" title="Visa">
                                    </figure>
                                </div>
                                <div class="item">
                                    <figure class="paymentmode-imgs">
                                        <img src="<?php echo $config->getimageurl() ?>images/chooseplan/discover-logo.svg" alt="Discover" title="Discover">
                                    </figure>
                                </div>
                                <div class="item">
                                    <figure class="paymentmode-imgs">
                                        <img src="<?php echo $config->getimageurl() ?>images/chooseplan/mastercard.svg" alt="Mastercard" title="Mastercard">
                                    </figure>
                                </div>
                                <div class="item">
                                    <figure class="paymentmode-imgs">
                                        <img src="<?php echo $config->getimageurl() ?>images/chooseplan/american-express.svg" alt="American Express" title="American Express">
                                    </figure>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Footer Start -->
        <?php include('footer.php'); ?>
        <!-- Footer End -->

        <!-- JS Start -->
        <?php include('js.php'); ?>
        <!-- JS End -->
    </div>
    <script>
        $(document).ready(function() {
            listpaymentmodedetail();
            listpackagedetail(1);
            $(".box-plan .plan-heading").matchHeight();
            $(".box-plan .plans-text").matchHeight();
            $('.plans-headline .nav-pills li a, .second-solutions .nav-pills li a').click(function() {
                if ($(this).parent().attr('id') == 'years-price') {
                    $('.price.years').removeClass('hidden');
                    $('.price.month').addClass('hidden');
                    $('.button-save').removeClass('hidden');
                    $('.label-year').addClass('hidden');
                    $('.solution-second .plan-box').removeClass('month');
                    $(".plans-list .plan-box").matchHeight();
                    $('.plans-for-registration .box-plan').addClass('month');
                    $(".plans-list .box-plan .middle-part").matchHeight();
                } else {
                    $('.price.month').removeClass('hidden');
                    $('.price.years').addClass('hidden');
                    $('.button-save').addClass('hidden');
                    $('.label-year').removeClass('hidden');
                    $('.solution-second .plan-box').addClass('month');
                    $(".plans-list .plan-box").matchHeight();
                    $('.plans-for-registration .box-plan').addClass('month');
                    $(".plans-list .box-plan .middle-part").matchHeight();
                }
            });
            $(window).on("scroll touchmove", function() {
                var bannerHeight = 0;
                if ($('.banner-block').length > 0) {
                    if (!$(".banner-block").hasClass("hidden")) {
                        bannerHeight = $('.banner-block').height();
                    }
                }
                $('#header').toggleClass('scrolled', $(document).scrollTop() > bannerHeight);
            });
            if ($('.image-section').length == 0 && $('.benefits-section').length > 0) {
                $('.benefits-section .container').css("padding-top", "0");
            }
            $('[data-scroll]').click(function() {
                var next = $(this).closest('section').next().attr("id");
                $(this).attr("href", "#" + next);
                $('html, body').animate({
                    scrollTop: ($($.attr(this, 'href')).offset().top - 82)
                }, 500);
                return false;
            });
            if ($('#SnapABug_Button').length > 0) {
                $('#SnapABug_Button').attr("data-category", "Homepage");
                $('#SnapABug_Button').attr("data-label", "Chat");
            }
            $('[data-category]').each(function() {
                var price = "";
                $(this).on("click", function() {
                    var label = $(this).data("label");
                    if ($(this).hasClass("apply-button")) {
                        price = $(this).closest(".plan-box").find(".price").not('.hidden').data("price");
                        label = $(this).data("label") + ", " + price;
                    }
                    dataLayer.push({
                        'event': 'GAEvent',
                        'eventCategory': $(this).data("category"),
                        'eventAction': 'Click',
                        'eventLabel': label,
                        'eventValue': undefined
                    });
                });
            });
            var period = getUrlVars()["period"];
            if (period == "Monthly" && $("#month-price").length > 0) {
                $("#month-price a").each(function() {
                    $(this).trigger("click");
                });
            } else if ($("#years-price").length > 0) {
                $("#years-price a").each(function() {
                    $(this).trigger("click");
                });
            }
        });

        function getUrlVars() {
            var vars = [],
                hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for (var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        }

        $('.typechange').on('click', function() {
            if ($(this).attr('data-type') == 1) {
                $('.plans-box .years').removeClass('hidden');
                $('.plans-box .month').addClass('hidden');
                $('.show-icon-save').addClass('active');
                $('.hide-icon-save').removeClass('active');
            } else if ($(this).attr('data-type') == 2) {
                $('.plans-box .years').addClass('hidden');
                $('.plans-box .month').removeClass('hidden');
                $('.show-icon-save').removeClass('active');
                $('.hide-icon-save').addClass('active');

            }
            listpackagedetail($(this).attr('data-type'));
            // changetypewisedata();
        });


        function listpackagedetail(typeid) {
            var pagename = getpagename();
            var headersdata = {
                Accept: 'application/json',
                platform: 4,
                userpagename: pagename,
                useraction: 'editright',
                masterlisting: false,
                responsetype: 'HTML'
            };
            formdata = new FormData();
            formdata.append("action", "listpackagedetail");
            formdata.append("typeid", typeid);
            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>package', formdata, headersdata, Onsuccesslistpackagedetail, OnErrorlistpackagedetail);

            function Onsuccesslistpackagedetail(data) {
                var JsonData = JSON.stringify(data);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata = '';
                if (resultdata.status == 0) {
                    Notiflix.Notify.Failure(resultdata.message);
                } else if (resultdata.status == 1) {

                    $('#PackageDataList').html(resultdata.data);
                    $('#PackageDataList .btnapplychooseplan').click(function() {
                        var packageid = $(this).attr('data-package');
                        var type = $(this).attr('data-type');
                        packageassign(type,packageid);
                    });
                }
            }

            function OnErrorlistpackagedetail(content) {
                // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
            }
        }

        function listpaymentmodedetail()
        {
            
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false,responsetype: 'JSON'};

            formdata = new FormData();
            formdata.append("action", "listpaymentmodedetail");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>home',formdata,headersdata,Onsuccesslistpaymentmodedetail,OnErrorlistpaymentmodedetail);
            function Onsuccesslistpaymentmodedetail(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata='';
                if(resultdata.status==0)
                {
                    $('#listpaymentmodedetail').html('');
                    $('.listpaymentmodedetail').addClass('d-none');
                }
                else if(resultdata.status==1)
                {   
                    $('.listpaymentmodedetail').removeClass('d-none');
                    $('.paydescr').html(resultdata.descr);
                    htmldata+='<div class="paymentmode-slider owl-carousel owl-theme">';
                    for(var i in resultdata.result)
                    {
                        htmldata+='<div class="item">';
                            htmldata+='<figure class="paymentmode-imgs">';
                                htmldata+='<img src="'+resultdata.result[i].image+'" alt="'+resultdata.result[i].title+'" title="'+resultdata.result[i].title+'">';
                            htmldata+='</figure>';
                        htmldata+='</div>';
                    }
                    htmldata+='</div>';
                    $('#listpaymentmodedetail').html(htmldata);
                    $('.paymentmode-slider').owlCarousel({
                        loop: true,
                        margin: 0,
                        nav: true,
                        responsive: {
                            0: {
                                items: 1
                            },
                            600: {
                                items: 3
                            },
                            1000: {
                                items: 4
                            }
                        }
                    });
                }
            
            }

            function OnErrorlistpaymentmodedetail(content)
            { 
                ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
            }
            
        }
        $('.palnpenal').owlCarousel({
            loop:false,
            margin:10,
            nav:false,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                768:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })
        $('.palnpenal-multi').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                992:{
                    items:2
                },
                1000:{
                    items:3
                }
            }
        })
    </script>
</body>

</html>