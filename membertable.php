<?php require_once 'config/init.php'; 
 require_once 'config/apiconfig.php'; 
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
    <meta property="og:url" content="" />
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

<body class="membershipplan">
    <div class="page-wrapper">
        <!-- Header Start -->
        <?php include('header.php'); ?>
        <!-- Header End -->
        <div class="main page-title mainbg-img" id="web-content"  style="background-image: url(<?php echo $config->getimageurl() ?>images/payment-mode-bg.jpg);">
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
                        <div class="col-12">
                            <div class="plans-for-registration">
                                <div class="plans-block appear visible-element">
                                    <header class="plans-headline text-center">
                                        <nav class="tabset animated animated-slide-bottom delay-05">
                                            <ul class="nav nav-pills toggle-btns-js cost-button">
                                                <li id="years-price">
                                                    <a href="#" data-category="Membership" data-type="1" class="show-icon-save typechange active" data-label="Billed annually selector">Billed Annually </a>
                                                    
                                                </li>
                                                <li id="month-price"><a href="#" data-type="2" class="hide-icon-save typechange" data-category="Membership" data-label="Billed monthly selector">Billed Monthly</a></li>
                                                    <img class="save20-ico annually" src="#" alt="" style="display: block;">
                                                                            <img class="save20-ico month" src="#" alt="" style="display: none;">
                                            </ul>
                                        </nav>
                                    </header>
                                    <div class="plans-box">
                                        <ul class="plans-list row">
                                            <li class="box-plan sm-size-box plan-img col-sm-3 col-md-3 col-12" style="background-image: url(<?php echo $config->getimageurl() ?>images/pricing-bg.png)";>
                                            </li>
                                            <li class="box-plan sm-size-box color-green popular col-sm-3 col-md-3 col-12 p-0">
                                                <header class="plan-heading ">
                                                    <h2>BUYER</h2>
                                                </header>
                                                <div class="middle-part">
                                                    <div class="price-middle-part">
                                                        <p class="price years" data-price="annually">
                                                            $ 350
                                                        </p>
                                                        <p class="price month hidden" data-price="monthly">
                                                            $150</sub>
                                                        </p>
                                                        <span class="button-save">
                                                            <p class="label-save"><span>Save $15</span></p>
                                                        </span>
                                                        <p class="label-year hidden"><span>$1,500 /year</span></p>
                                                    </div>
                                                    <div class="plans-text">
                                                        <div class="wrapper-title">
                                                            <p>Buy diamond & Jewelry</p>
                                                        </div>
                                                        <div class="sec-desc">
                                                            <p>For members of the trade looking to buy diamonds and jewelry, and access diamondpricing information and tools.</p>
                                                        </div>
                                                    </div>
                                                    <div class="mobile-link d-lg-none" data-toggle="collapse" data-target="#footerCollapse" aria-label="collapse" aria-expanded="false">
                                                        <a>Core Features</a>
                                                    </div>
                                                    <!-- <div class="box-plan table-box-plan inform-plan desktop-downblock collapse" id="footerCollapse">
                                                        <div class="table-information">
                                                            <table class="table table-striped">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            Diamond Search
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">
                                                                            
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Jewelry Search
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">
                                                                            
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Share Diamonds and Jewelry
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Member to Member Chat
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        Buy Requests
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        List Diamonds for sale
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                        </td>
                                                                        <td >limited

                                                                        </td>
                                                                        <td>
                                                                        Unlimited
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        List jewelry for sale
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        Trade CVD XL for Excel
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        Additional Users Add-on
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td>
                                                                        2 Included
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Priority Customer Support
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div> -->
                                                    <a class="btn btn-black btn-plans clspageparentmenu" pagename="register-account" href="<?php echo $config->getWeburl(); ?>register-account">Apply Now</a>
                                                </div>
                                            </li>
                                            <li class="box-plan sm-size-box color-green popular col-sm-3 col-md-3 col-12 p-0">
                                                <header class="plan-heading">
                                                    <h2>Dealer</h2>
                                                </header> 
                                                <div class="middle-part">
                                                    <div class="price-middle-part">
                                                        <p class="price years" data-price="annually">
                                                            $ 400
                                                        </p>
                                                        <p class="price month hidden" data-price="monthly">
                                                            $175</sub>
                                                        </p>
                                                        <span class="button-save">
                                                            <p class="label-save"><span>Save $50</span></p>
                                                        </span>
                                                        <p class="label-year hidden"><span>$1,500 /year</span></p>
                                                    </div>
                                                
                                                    <div class="plans-text">
                                                        <div class="wrapper-title">
                                                            <p>Buy & Sell diamond & Jewelry</p>
                                                        </div>
                                                        <div class="sec-desc">
                                                            <p>For diamond dealers who are looking to buy and sell diamonds and jewelry.</p>
                                                        </div>
                                                    </div>
                                                    <div class="mobile-link d-lg-none" data-toggle="collapse" data-target="#footerCollapse" aria-label="collapse" aria-expanded="false">
                                                        <a>Core Features</a>
                                                    </div>
                                                    <!-- <div class="box-plan table-box-plan inform-plan desktop-downblock collapse" id="footerCollapse">
                                                        <div class="table-information">
                                                            <table class="table table-striped">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            Diamond Search
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">
                                                                            
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Jewelry Search
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">
                                                                            
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Share Diamonds and Jewelry
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Member to Member Chat
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        Buy Requests
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        List Diamonds for sale
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                        </td>
                                                                        <td >limited

                                                                        </td>
                                                                        <td>
                                                                        Unlimited
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        List jewelry for sale
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        Trade CVD XL for Excel
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        Additional Users Add-on
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td>
                                                                        2 Included
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Priority Customer Support
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div> -->
                                                    <a class="btn btn-black btn-plans clspageparentmenu" pagename="register-account" href="<?php echo $config->getWeburl(); ?>register-account">Apply Now</a>
                                                </div>
                                            </li>
                                            <li class="box-plan sm-size-box color-green col-md-3 col-sm-3 col-12 p-0">
                                                <header class="plan-heading">
                                                    <h2>Primary<br /> Supplier</h2>
                                                </header>
                                                <div class="middle-part">
                                                    <div class="price-middle-part">
                                                        <p class="price years" data-price="annually">
                                                            $ 600
                                                        </p>
                                                        <p class="price month hidden" data-price="monthly">
                                                            $125</sub>
                                                        </p>
                                                        <span class="button-save">
                                                            <p class="label-save"><span>Save $50</span></p>
                                                        </span>
                                                        <p class="label-year hidden"><span>$1,500 /year</span></p>
                                                    </div>
                                                
                                                    <div class="plans-text">
                                                        <div class="wrapper-title">
                                                            <p>Sell diamond Unlimited</p>
                                                        </div>
                                                        <div class="sec-desc">
                                                            <p>For major diamond manufacturers or dealers.All the features of Trade CVD Dealer plus sell an unlimited number of diamonds and display the Primary Supplier badge.</p>
                                                        </div>
                                                    </div>
                                                    <div class="mobile-link d-lg-none" data-toggle="collapse" data-target="#footerCollapse3" aria-label="collapse" aria-expanded="false">
                                                        <a>Core Features</a>
                                                    </div>
                                                    <!-- <div class="box-plan table-box-plan inform-plan desktop-downblock collapse" id="footerCollapse3">
                                                        <div class="table-information">
                                                            <table class="table table-striped">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            Diamond Search
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">
                                                                            
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Jewelry Search
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">
                                                                            
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Share Diamonds and Jewelry
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Member to Member Chat
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        Buy Requests
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        List Diamonds for sale
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                        </td>
                                                                        <td >limited

                                                                        </td>
                                                                        <td>
                                                                        Unlimited
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        List jewelry for sale
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        Trade CVD XL for Excel
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        Additional Users Add-on
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                        <td>
                                                                        2 Included
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Priority Customer Support
                                                                        </td>

                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                        </td>
                                                                        <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div> -->
                                                    <a class="btn btn-black btn-plans clspageparentmenu" pagename="register-account" href="<?php echo $config->getWeburl(); ?>register-account">Apply Now</a>
                                                </div>
                                            </li>
                                            <li class="box-plan inform-plan desktop-downblock col-12  d-md-block d-none">
                                                <div class="table-information">
                                                    <table class="table table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    Diamond Search
                                                                </td>

                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">
                                                                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Jewelry Search
                                                                </td>

                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">
                                                                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Share Diamonds and Jewelry
                                                                </td>

                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Member to Member Chat
                                                                </td>

                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                Buy Requests
                                                                </td>

                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                List Diamonds for sale
                                                                </td>

                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                </td>
                                                                <td >limited

                                                                </td>
                                                                <td>
                                                                Unlimited
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                List jewelry for sale
                                                                </td>

                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                Trade CVD XL for Excel
                                                                </td>

                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                Additional Users Add-on
                                                                </td>

                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                                <td>
                                                                2 Included
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Priority Customer Support
                                                                </td>

                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-x.svg);">

                                                                </td>
                                                                <td class="checked-v" style="background-image: url(<?php echo $config->getimageurl() ?>images/icon-v.svg);">

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           
            </section>
            <section class="savani-hr hr-sec section-space pt-0">
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
            <section class="paymentmode-sec section-space pt-0">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-10 text-center mb-5">
                            <div class="paymentmode-title">
                                <h3 class="sec-title text-black">Payment Mode</h3>
                            </div>
                            <div class="paymentmode-desc">
                                <p class="sec-desc text-blue">All prices are in USD. Plans can be canceled at any time in accordance with our terms and conditions. <br /> Accepting Visa, Master Card, American Express, and Discover</p>
                            </div>
                        </div>
                        <div class="col-10 m-auto text-center">
                            <div class="paymentmode-slider owl-carousel owl-theme">
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
                            </div>
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
            $(".box-plan .plan-heading").matchHeight();$(".box-plan .plans-text").matchHeight();$('.plans-headline .nav-pills li a, .second-solutions .nav-pills li a').click(function(){if($(this).parent().attr('id')=='years-price'){$('.price.years').removeClass('hidden');$('.price.month').addClass('hidden');$('.button-save').removeClass('hidden');$('.label-year').addClass('hidden');$('.solution-second .plan-box').removeClass('month');$(".plans-list .plan-box").matchHeight();$('.plans-for-registration .box-plan').addClass('month');$(".plans-list .box-plan .middle-part").matchHeight();}
                else{$('.price.month').removeClass('hidden');$('.price.years').addClass('hidden');$('.button-save').addClass('hidden');$('.label-year').removeClass('hidden');$('.solution-second .plan-box').addClass('month');$(".plans-list .plan-box").matchHeight();$('.plans-for-registration .box-plan').addClass('month');$(".plans-list .box-plan .middle-part").matchHeight();}});$(window).on("scroll touchmove",function(){var bannerHeight=0;if($('.banner-block').length>0){if(!$(".banner-block").hasClass("hidden")){bannerHeight=$('.banner-block').height();}}
                $('#header').toggleClass('scrolled',$(document).scrollTop()>bannerHeight);});if($('.image-section').length==0&&$('.benefits-section').length>0){$('.benefits-section .container').css("padding-top","0");}
                $('[data-scroll]').click(function(){var next=$(this).closest('section').next().attr("id");$(this).attr("href","#"+next);$('html, body').animate({scrollTop:($($.attr(this,'href')).offset().top-82)},500);return false;});if($('#SnapABug_Button').length>0){$('#SnapABug_Button').attr("data-category","Homepage");$('#SnapABug_Button').attr("data-label","Chat");}
                $('[data-category]').each(function(){var price="";$(this).on("click",function(){var label=$(this).data("label");if($(this).hasClass("apply-button")){price=$(this).closest(".plan-box").find(".price").not('.hidden').data("price");label=$(this).data("label")+", "+price;}
                dataLayer.push({'event':'GAEvent','eventCategory':$(this).data("category"),'eventAction':'Click','eventLabel':label,'eventValue':undefined});});});var period=getUrlVars()["period"];if(period=="Monthly"&&$("#month-price").length>0){$("#month-price a").each(function(){$(this).trigger("click");});}else if($("#years-price").length>0){$("#years-price a").each(function(){$(this).trigger("click");});}});function getUrlVars(){var vars=[],hash;var hashes=window.location.href.slice(window.location.href.indexOf('?')+1).split('&');for(var i=0;i<hashes.length;i++){hash=hashes[i].split('=');vars.push(hash[0]);vars[hash[0]]=hash[1];}
                return vars;}

        $('.typechange').on('click',function()
        {
            if($(this).attr('data-type')==1)
            {
                $('.plans-box .years').removeClass('hidden');
                $('.plans-box .month').addClass('hidden');
                $('.show-icon-save').addClass('active');
                $('.hide-icon-save').removeClass('active');
            }
            else if($(this).attr('data-type')==2)
            {
                $('.plans-box .years').addClass('hidden');
                $('.plans-box .month').removeClass('hidden');
                $('.show-icon-save').removeClass('active');
                $('.hide-icon-save').addClass('active');
            }

            changetypewisedata();
        });
    </script>
</body>

</html>




