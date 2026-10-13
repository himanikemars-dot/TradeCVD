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

<body class="selling-jewelry">
    <div class="page-wrapper">
        <!-- Header Start -->
        <?php include('header.php'); ?>
        <!-- Header End -->
        <div class="main page-title" id="web-content">
            <section class="why-savani-sec section-space" style="background-image: url(<?php echo $config->getimageurl() ?>images/about/about-bg-3.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="savani-info">
                                <div class="savani-title">
                                    <h1 class="sec-title text-white">Jewelry</h1>
                                </div>
                                <div class="savani-desc">
                                    <p class="sec-desc-pra">Source and sell fine jewelry on the industry’s largest and most trusted trading network. Buy earrings, necklaces, watches and more at competitive prices,  directly from verified suppliers.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="buying-jewelry-sec section-space">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="buy-jewelry-img">
                                <img src="<?php echo $config->getimageurl() ?>images/buying-jewellary/buy-1.jpg" alt="Buying Jewellary" title="Buying Jewellary">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 m-auto">
                            <div class="buy-jewelry-title">
                                <h2 class="sec-title text-black">Find the Jewelry Piece Your Customer Wants</h2>
                            </div>
                            <div class="buy-jewelry-desc">
                                <p>Search from over 35,000 rings, necklaces, watches and more on our fast and intuitive jewelry search engine with filters to save you time. Plus you can save your favorite searches to load for a later date and store your favorite items for future reference.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="buying-jewelry-sec section-space bg-gray">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 order-lg-2">
                            <div class="buy-jewelry-img">
                                <img src="<?php echo $config->getimageurl() ?>images/buying-jewellary/buy-1.jpg" alt="Buying Jewellary" title="Buying Jewellary">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 m-auto">
                            <div class="buy-jewelry-title">
                                <h2 class="sec-title text-black">Buy Jewelry at Competitive Prices</h2>
                            </div>
                            <div class="buy-jewelry-desc">
                                <p>Source jewelry at the best prices and get real-time discounts.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="buying-jewelry-sec section-space">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="buy-jewelry-img">
                                <img src="<?php echo $config->getimageurl() ?>images/buying-jewellary/buy-1.jpg" alt="Buying Jewellary" title="Buying Jewellary">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 m-auto">
                            <div class="buy-jewelry-title">
                                <h2 class="sec-title text-black">Buy with Confidence from Verified Suppliers</h2>
                            </div>
                            <div class="buy-jewelry-desc">
                                <p>Connect with an elite community of Rapaport verified jewelry professionals and suppliers around the world and shop expertly authenticated estate jewelry.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="buying-jewelry-sec section-space bg-gray">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 order-lg-2">
                            <div class="buy-jewelry-img">
                                <img src="<?php echo $config->getimageurl() ?>images/buying-jewellary/buy-1.jpg" alt="Buying Jewellary" title="Buying Jewellary">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 m-auto">
                            <div class="buy-jewelry-title">
                                <h2 class="sec-title text-black">Save Money by Dealing Direct</h2>
                            </div>
                            <div class="buy-jewelry-desc">
                                <p>Negotiate and trade directly with diamond and jewelry suppliers, with no commission or transaction fees.</p>
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
</body>

</html>




