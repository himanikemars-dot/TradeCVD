<?php require_once 'config/init.php'; 
 require_once 'config/apiconfig.php'; 
 $res=$DB->getpagemetadata(16);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
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
    <link rel="icon" type="image/x-icon" href="<?php echo $config->getImageurl(); ?>images/gems.png"/>
    <!-- Meta Tag End -->

    <!--title-->
    <title><?php echo $res[0]['title']; ?></title>
    
    <!-- CSS Start -->
    <?php include('css.php'); ?>
    
    <!-- CSS End -->
    <script src="assets/js/vendor/jquery.min.js"></script>
</head>

<body class="buying-diamonds max-w-2560px">
    <div class="page-wrapper">
        <!-- Header Start -->
        <?php include('header.php'); ?>
        <!-- Header End -->
        <div class="main page-title listbuysaleprocessdetail" id="web-content">
            <!-- <section class="why-savani-sec section-space" style="background-image: url(<?php echo $config->getimageurl() ?>images/about/about-bg-3.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="savani-info">
                                <div class="savani-title">
                                    <h1 class="sec-title text-white">Diamonds</h1>
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
            </section> -->
        </div>

		
	<section class="diamond-cta-section">
    <div class="container">
        <div class="diamond-cta-wrapper">

            <div class="diamond-cta-content">
                <span class="diamond-cta-label">
                    READY TO GET STARTED?
                </span>

                <h2>Find your next diamond</h2>

                <p>
                    Join a global marketplace for lab-grown (CVD) and natural diamonds.
                </p>
            </div>

            <div class="diamond-cta-buttons">
                <a href="<?php echo $config->getWeburl(); ?>buyers"
                   class="diamond-cta-btn explore-btn">
                    Explore Diamonds
                    <i class="fas fa-arrow-right fa"></i>
                </a>

                <a href="<?php echo $config->getWeburl(); ?>seller"
                   class="diamond-cta-btn selling-btn">
                    Start Selling
                    <i class="fas fa-arrow-right fa"></i>
                </a>
            </div>

        </div>
    </div>
</section>


        <!-- Footer Start -->
        <?php include('footer.php'); ?>
        <!-- Footer End -->

        <!-- JS Start -->
        <?php include('js.php'); ?>
        <!-- JS End -->
    </div>
    <script>
        $(document).ready(function() {
            listbuyingjewelry();
        });
        function listbuyingjewelry()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false};

            formdata = new FormData();
            formdata.append("action", "listbuysaleprocess");
            formdata.append("typeid", 3);
            formdata.append("bannertypeid", 11);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'buysaleprocess',formdata,headersdata,Onsuccesslistbuyingjewelry,OnErrorlistbuyingjewelry);
        }

        function Onsuccesslistbuyingjewelry(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata='';
            if(resultdata.status==0)
            {
                htmldata+='<section class="why-savani-sec section-space" style="background-image: url('+resultdata.banner[0].image+');">';
                    htmldata+='<div class="container">';
                        htmldata+='<div class="row">';
                            htmldata+='<div class="col-12 col-md-5">';
                                htmldata+='<div class="savani-info">';
                                    htmldata+='<div class="savani-title">';
                                        htmldata+='<h1 class="sec-title text-white">'+resultdata.banner[0].title+'</h1>';
                                    htmldata+='</div>';
                                    if(resultdata.banner[0].description)
                                    {
                                        htmldata+='<div class="savani-desc">';
                                            htmldata+='<p class="sec-desc-pra">'+resultdata.banner[0].description+'</p>';
                                        htmldata+='</div>';
                                    }
                                htmldata+='</div>';
                            htmldata+='</div>';
                        htmldata+='</div>';
                    htmldata+='</div>';
                htmldata+='</section>';

                htmldata+='<section class="title-sec section-spacing pb-0">';
                    htmldata+='<div class="container">';
                        htmldata+='<div class="row">';
                            htmldata+='<div class="col-12 text-center">';
                                htmldata+='<div class="jewelry-sec">';
                                    htmldata+='<h2 class="">No Data Found!</h2>';
                                htmldata+='</div>';
                            htmldata+='</div>';
                        htmldata+='</div>';
                    htmldata+='</div>';
                htmldata+='</section>';
               
                $('.listbuysaleprocessdetail').html(htmldata);
            }
            else if(resultdata.status==1)
            {
                // htmldata+='<section class="why-savani-sec section-space" style="background-image: url('+resultdata.banner[0].image+');">';
                //     htmldata+='<div class="container">';
                //         htmldata+='<div class="row">';
                //             htmldata+='<div class="col-12 col-md-5">';
                //                 htmldata+='<div class="savani-info">';
                //                     htmldata+='<div class="savani-title">';
                //                         htmldata+='<h1 class="sec-title text-white">'+resultdata.banner[0].title+'</h1>';
                //                     htmldata+='</div>';
                //                     if(resultdata.banner[0].description)
                //                     {
                //                         htmldata+='<div class="savani-desc">';
                //                             htmldata+='<p class="sec-desc-pra">'+resultdata.banner[0].description+'</p>';
                //                         htmldata+='</div>';
                //                     }
                //                 htmldata+='</div>';
                //             htmldata+='</div>';
                //         htmldata+='</div>';
                //     htmldata+='</div>';
                // htmldata+='</section>';

                htmldata+='<section class="trade-path-section" style="background-image: url('+resultdata.banner[0].image+');">';

                            /* Center Heading */
                            htmldata+='<div class="trade-path-heading">';
                                htmldata+='<h2>What brings you to <span>Trade CVD?</span></h2>';
                                htmldata+='<p>Choose your path and get started</p>';
                            htmldata+='</div>';

                            htmldata+='<div class="trade-path-wrapper align-items-start align-items-lg-center w-100">';

                                /* ================= BUYER SIDE ================= */
                                htmldata+='<div class="trade-path-panel buyer-panel">';

                                   
                                    htmldata+='<div class="trade-path-content buyer-content">';

                                        htmldata+='<div class="trade-small-title justify-content-center justify-content-sm-start">';
                                            htmldata+='<span>FOR BUYERS</span>';
                                            htmldata+='<i></i>';
                                        htmldata+='</div>';

                                        htmldata+='<h2>';
                                            htmldata+='Find Your<br>';
                                            htmldata+='<span>Perfect Diamond</span>';
                                        htmldata+='</h2>';

                                        htmldata+='<p>';
                                            htmldata+='Explore certified lab grown diamonds<br class="d-none d-md-block">';
                                            htmldata+='and fine jewelry from trusted suppliers<br class="d-none d-md-block">';
                                            htmldata+='worldwide.';
                                        htmldata+='</p>';

                                        htmldata+='<a href="<?php echo $config->getWeburl(); ?>buyers" class="trade-path-btn buyer-btn">';
                                            htmldata+='<span>Explore as a Buyer</span>';
                                            htmldata+='<i class="fas fa-arrow-right fa"></i>';
                                        htmldata+='</a>';

                                    htmldata+='</div>';

                                htmldata+='</div>';


                                /* ================= SELLER SIDE ================= */
                                htmldata+='<div class="trade-path-panel seller-panel mt-5 mt-sm-0">';

                                   
                                    htmldata+='<div class="trade-path-content seller-content">';

                                        htmldata+='<div class="trade-small-title white-title justify-content-center justify-content-sm-start">';
                                            htmldata+='<span>FOR SELLERS</span>';
                                            htmldata+='<i></i>';
                                        htmldata+='</div>';

                                        htmldata+='<h2>';
                                            htmldata+='Grow Your<br>';
                                            htmldata+='<span>Business Globally</span>';
                                        htmldata+='</h2>';

                                        htmldata+='<p>';
                                            htmldata+='List your diamonds & jewelry,<br>';
                                            htmldata+='connect with serious buyers<br>';
                                            htmldata+='and expand your reach.';
                                        htmldata+='</p>';

                                        htmldata+='<a href="<?php echo $config->getWeburl(); ?>seller" class="trade-path-btn seller-btn">';
                                            htmldata+='<span>Start as a Seller</span>';
                                            htmldata+='<i class="fas fa-arrow-right fa"></i>';
                                        htmldata+='</a>';

                                    htmldata+='</div>';

                                htmldata+='</div>';

                            htmldata+='</div>';


                          
                           
                        htmldata+='</section>';

                          htmldata+='<section class="diamond-market-intro" aria-labelledby="market-intro-title">';
                                    htmldata+='<div class="container">';
                                        htmldata+='<span class="market-eyebrow">A global diamond marketplace</span>';
                                        htmldata+='<h2 id="market-intro-title" class="market-title">A better way to trade diamonds</h2>';
                                        htmldata+='<p class="market-lead">Trade CVD is an international marketplace connecting diamond buyers and sellers. We make it simple to explore, compare and connect — bringing more opportunity and transparency to the diamond trade.</p>';
                                        htmldata+='<div class="market-features">';
                                            htmldata+='<div class="market-feature"><span class="market-icon" aria-hidden="true"><i class="far fa-diamond fa"></i></span><h3>A Wide Selection</h3><p>Explore lab-grown (CVD), natural and other diamonds from suppliers around the world.</p></div>';
                                            htmldata+='<div class="market-feature"><span class="market-icon" aria-hidden="true"><i class="fas fa-users fa"></i></span><h3>A Global Network</h3><p>Connect with a diverse range of buyers and sellers across key markets.</p></div>';
                                            htmldata+='<div class="market-feature"><span class="market-icon" aria-hidden="true"><i class="fas fa-leaf fa"></i></span><h3>A More Open Market</h3><p>A straightforward, transparent way to discover opportunities and grow your business.</p></div>';
                                        htmldata+='</div>';
                                    htmldata+='</div>';
                        htmldata+='</section>';

               /*  htmldata+='<section class="title-sec section-spacing pb-0">';
                    htmldata+='<div class="container">';
                        htmldata+='<div class="row">';
                            htmldata+='<div class="col-12 text-center">';
                                htmldata+='<div class="jewelry-sec">';
                                    htmldata+='<h2 class="sec-title">Buying Jewelry</h2>';
                                htmldata+='</div>';
                            htmldata+='</div>';
                        htmldata+='</div>';
                    htmldata+='</div>';
                htmldata+='</section>'; */
                // for(var i in resultdata.result)
                // {
                //     if(i % 2==0)
                //     {
                //         htmldata+='<section class="buying-jewelry-sec section-space">';
                //             htmldata+='<div class="container">';
                //                 htmldata+='<div class="row">';
                //                     htmldata+='<div class="col-12 col-md-12 col-lg-6 col-xl-6 ">';
                //                         htmldata+='<div class="buy-jewelry-img">';
                //                             htmldata+='<img src="'+resultdata.result[i].image+'" alt="'+resultdata.result[i].title+'" title="'+resultdata.result[i].title+'">';
                //                         htmldata+='</div>';
                //                     htmldata+='</div>';
                //                     htmldata+='<div class="col-12 col-md-12 col-lg-6 col-xl-6 m-auto">';
                //                         htmldata+='<div class="buy-jewelry-title">';
                //                             htmldata+='<h2 class="sec-title text-black">'+resultdata.result[i].title+'</h2>';
                //                         htmldata+='</div>';
                //                         htmldata+='<div class="buy-jewelry-desc">';
                //                             htmldata+=resultdata.result[i].description;
                //                         htmldata+='</div>';
                //                     htmldata+='</div>';
                //                 htmldata+='</div>';
                //             htmldata+='</div>';
                //         htmldata+='</section>';
                //     }else{

                //         htmldata+='<section class="buying-jewelry-sec section-space bg-gray">';
                //             htmldata+='<div class="container">';
                //                 htmldata+='<div class="row">';
                //                     htmldata+='<div class="col-12 col-md-12 col-lg-6 col-xl-6 order-lg-2">';
                //                         htmldata+='<div class="buy-jewelry-img">';
                //                             htmldata+='<img src="'+resultdata.result[i].image+'" alt="'+resultdata.result[i].title+'" title="'+resultdata.result[i].title+'">';
                //                         htmldata+='</div>';
                //                     htmldata+='</div>';
                //                     htmldata+='<div class="col-12 col-md-12 col-lg-6 col-xl-6 m-auto">';
                //                         htmldata+='<div class="buy-jewelry-title">';
                //                             htmldata+='<h2 class="sec-title text-black">'+resultdata.result[i].title+'</h2>';
                //                         htmldata+='</div>';
                //                         htmldata+='<div class="buy-jewelry-desc">';
                //                             htmldata+=resultdata.result[i].description;
                //                         htmldata+='</div>';
                //                     htmldata+='</div>';
                //                 htmldata+='</div>';
                //             htmldata+='</div>';
                //         htmldata+='</section>';
                //     }

                 
                // }

                var sectionFeatures = [
    [
        ['fas fa-search fa', 'Explore diamonds', 'Browse lab-grown (CVD) and natural diamonds.'],
        ['fas fa-file fa', 'Compare details', 'Compare diamond information side by side.'],
        ['far fa-comments fa', 'Connect with sellers', 'Discuss your requirements directly.']
    ],
    [
        ['fas fa-filter fa', 'Advanced filters', 'Search by shape, carat, color and clarity.'],
        ['far fa-bookmark fa', 'Save your shortlist', 'Keep track of diamonds you like.'],
        ['far fa-clone fa', 'Compare listings', 'Review multiple diamonds side by side.']
    ],
    [
        ['fas fa-globe fa', 'International listings', 'Explore diamonds from global suppliers.'],
        ['fas fa-file fa', 'Seller details', 'Learn more about sellers and listings.'],
        ['far fa-comments fa', 'Discuss terms', 'Connect directly with sellers.']
    ]
];

                for (var i = 0; i < resultdata.result.length; i++) {
    var item = resultdata.result[i];
    var imageLeft = i % 2 === 1;
    var features = sectionFeatures[i] || [];
    var featureClass = i === 1 ? ' feature-list' : '';

    htmldata += '<section class="diamond-content-section' +
        (imageLeft ? ' diamond-section-gray' : '') + '">';
    htmldata += '<div class="container">';
    htmldata += '<div class="diamond-content-grid">';

    if (imageLeft) {
        htmldata += '<div class="diamond-content-image">';
        htmldata += '<img src="' + item.image + '" alt="' + item.title + '" loading="lazy">';
        htmldata += '</div>';
    }

    htmldata += '<div class="diamond-content-text">';
    htmldata += '<span class="diamond-title-line"></span>';
    htmldata += '<h2>' + item.title + '</h2>';
    htmldata += '<div class="diamond-content-description">' +
        (item.description || '') + '</div>';

    if (features.length) {
        htmldata += '<div class="diamond-feature-grid' + featureClass + '">';

        for (var j = 0; j < features.length; j++) {
            htmldata += '<div class="diamond-feature">';
            htmldata += '<i class="' + features[j][0] + '" aria-hidden="true"></i>';
            htmldata += '<strong>' + features[j][1] + '</strong>';
            htmldata += '<p>' + features[j][2] + '</p>';
            htmldata += '</div>';
        }

        htmldata += '</div>';
    }

    htmldata += '</div>';

    if (!imageLeft) {
        htmldata += '<div class="diamond-content-image">';
        htmldata += '<img src="' + item.image + '" alt="' + item.title + '" loading="lazy">';
        htmldata += '</div>';
    }

    htmldata += '</div>';
    htmldata += '</div>';
    htmldata += '</section>';
}
               
                $('.listbuysaleprocessdetail').html(htmldata);
            }

        }

        function OnErrorlistbuyingjewelry(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    </script>
</body>

</html>




