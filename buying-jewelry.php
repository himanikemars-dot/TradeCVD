<?php require_once 'config/init.php';
require_once 'config/apiconfig.php';
$res = $DB->getpagemetadata(14); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tag Start -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="<?php echo $res[0]['metakeywords']; ?>" />
    <meta name="author" content="Trade CVD" />
    <meta name="robots" content="Trade CVD" />
    <meta name="description" content="<?php echo $res[0]['metadescription']; ?>" />
    <meta property="og:title" content="<?php echo $res[0]['title']; ?>" />
    <meta property="og:url" content="<?php echo $config->getWeburl(); ?>" />
    <meta property="og:description" content="<?php echo $res[0]['metadescription']; ?>" />
    <meta property="og:image" content="<?php echo $config->getImageurl(); ?>images/ogiseo.png" />
    <link rel="icon" type="image/x-icon" href="<?php echo $config->getImageurl(); ?>images/gems.png" />
    <!-- Meta Tag End -->

    <!--title-->
    <title><?php echo $res[0]['title']; ?></title>

    <!-- CSS Start -->
    <?php include('css.php'); ?>

    <!-- CSS End -->
    <script src="assets/js/vendor/jquery.min.js"></script>

    <style>
        /* Reference-style dynamic buying sections */
       
    </style>
</head>

<body class="buying-jewelry max-w-2560px">
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
            <section class="title-sec section-spacing pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="jewelry-sec">
                                <h2 class="sec-title">Buying Jewelry</h2>
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
        <!-- Footer Start -->
        <?php include('footer.php'); ?>
        <!-- Footer End -->

        <!-- JS Start -->
        <?php include('js.php'); ?>
        <!-- JS End -->
    </div>

    <script>
        $(document).ready(function () {
            listbuyingjewelry();
        });
        function listbuyingjewelry() {
            var pagename = getpagename();
            var headersdata = {
                Accept: "application/json",
                platform: 4,
                userpagename: pagename,
                useraction: "",
                masterlisting: false,
            };

            formdata = new FormData();
            formdata.append("action", "listbuysaleprocess");
            formdata.append("typeid", 1);
            formdata.append("bannertypeid", 9);

            ajaxrequest(
                "POST",
                "<?php echo $config->getEndpointurl(); ?>" + "buysaleprocess",
                formdata,
                headersdata,
                Onsuccesslistbuyingjewelry,
                OnErrorlistbuyingjewelry,
            );
        }

        function Onsuccesslistbuyingjewelry(content) {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = "";
            if (resultdata.status == 0) {
                htmldata +=
                    '<section class="why-savani-sec section-space" style="background-image: url(' +
                    resultdata.banner[0].image +
                    ');">';
                htmldata += '<div class="container">';
                htmldata += '<div class="row">';
                htmldata += '<div class="col-12 col-md-5">';
                htmldata += '<div class="savani-info">';
                htmldata += '<div class="savani-title">';
                htmldata +=
                    '<h1 class="sec-title text-white">' +
                    resultdata.banner[0].title +
                    "</h1>";
                htmldata += "</div>";
                if (resultdata.banner[0].description) {
                    htmldata += '<div class="savani-desc">';
                    htmldata +=
                        '<p class="sec-desc-pra">' +
                        resultdata.banner[0].description +
                        "</p>";
                    htmldata += "</div>";
                }
                htmldata += "</div>";
                htmldata += "</div>";
                htmldata += "</div>";
                htmldata += "</div>";
                htmldata += "</section>";

                /* htmldata+='<section class="title-sec section-spacing pb-0">';
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
                htmldata += '<section class="title-sec section-spacing pb-0">';
                htmldata += '<div class="container">';
                htmldata += '<div class="row">';
                htmldata += '<div class="col-12 text-center">';
                htmldata += '<div class="jewelry-sec">';
                htmldata += '<h2 class="">No Data Found!</h2>';
                htmldata += "</div>";
                htmldata += "</div>";
                htmldata += "</div>";
                htmldata += "</div>";
                htmldata += "</section>";

                $(".listbuysaleprocessdetail").html(htmldata);
            } else if (resultdata.status == 1) {
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

                htmldata +=
                    '<section class="why-savani-sec section-space" style="background-image:url(' +
                    resultdata.banner[0].image +
                    ');">';



                /* Main banner heading */
                // htmldata += '<div class="savani-title jewellry-title">';
                // htmldata +=
                //     '<h1 class="sec-title">What brings you to <span>Trade CVD?</span></h1>';
                // htmldata += "<p>Choose your jewellery journey and get started</p>";
                // htmldata += "</div>";
                 htmldata+='<div class="trade-path-heading">';
                                htmldata+='<h2>What brings you to <span>Trade CVD?</span></h2>';
                                htmldata+='<p>Choose your jewellery journey and get started</p>';
                            htmldata+='</div>';

                /* Buyer and seller columns */
                // htmldata += '<div class="jewelry-info-wrapper flex-column flex-sm-row justify-content-center justify-content-sm-start">';
                // /* Buy jewellery */

                // htmldata += '<div class="savani-info buy-jewels">';
                // htmldata += '<div>';
                // htmldata += '<div class="savani-title">';
                // htmldata += "<small>FOR JEWELLERY BUYERS</small>";
                // htmldata += '<h2 class="sec-title">';
                // htmldata += "Find Jewellery";
                // htmldata += '<br />';
                // htmldata += "<span>Your Customers Love</span>";
                // htmldata += "</h2>";
                // htmldata += "</div>";

                // htmldata += '<div class="savani-desc">';
                // htmldata += '<p class="sec-desc-pra">';
                // htmldata +=
                //     "Explore rings, earrings, necklaces, bracelets <br/> and fine jewellery from verified global suppliers.";
                // htmldata += "</p>";

                // htmldata += '<a href="jewellery" class="buy-jewel-btn buyer-btns">';
                // htmldata += "Explore as a Buyer ";
                // htmldata += '<i class="fas fa-arrow-right fa"></i>';
                // htmldata += "</a>";
                // htmldata += "</div>";
                // htmldata += '</div>';
                // htmldata += "</div>";

                // /* Sell jewellery */

                // htmldata += '<div class="savani-info sell-jewels">';
                // htmldata += "<div>";
                // htmldata += '<div class="savani-title">';
                // htmldata += '<small class="text-white">FOR JEWELLERY SELLERS</small>';
                // htmldata += '<h2 class="sec-title">';
                // htmldata += "Showcase Your Jewellery";
                // htmldata += '<br />';
                // htmldata += "<span>Grow Your Business Globally</span>";
                // htmldata += "</h2>";
                // htmldata += "</div>";

                // htmldata += '<div class="savani-desc">';
                // htmldata += '<p class="sec-desc-pra text-white">';
                // htmldata +=
                //     "List your jewellery collection, connect with serious <br/> buyers and expand your business worldwide.";
                // htmldata += "</p>";

                // htmldata += '<a href="seller" class="buy-jewel-btn seller-btns">';
                // htmldata += "Start as a Seller ";
                // htmldata += '<i class="fas fa-arrow-right fa"></i>';
                // htmldata += "</a>";
                // htmldata += "</div>";
                // htmldata += "</div>";
                // htmldata += "</div>";
                // htmldata += "</div>";


                // htmldata += "</div>";
                htmldata+='<div class="trade-path-wrapper align-items-start align-items-lg-center w-100">';

                                /* ================= BUYER SIDE ================= */
                                htmldata+='<div class="trade-path-panel buyer-panel">';

                                   
                                    htmldata+='<div class="trade-path-content buyer-content">';

                                        htmldata+='<div class="trade-small-title justify-content-center justify-content-sm-start">';
                                            htmldata+='<span>FOR JEWELLERY BUYERS</span>';
                                            htmldata+='<i></i>';
                                        htmldata+='</div>';

                                        htmldata+='<h2>';
                                            htmldata+='Find Jewellery<br>';
                                            htmldata+='<span>Your Customer Love</span>';
                                        htmldata+='</h2>';

                                        htmldata+='<p>';
                                            htmldata+='Explore rings, earrings, necklaces, bracelets <br class="d-none d-md-block">';
                                            htmldata+='and fine jewellery from verified global suppliers';                                            
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
                                            htmldata+='<span>FOR JEWELLERY SELLERS</span>';
                                            htmldata+='<i></i>';
                                        htmldata+='</div>';

                                        htmldata+='<h2>';
                                            htmldata+='Showcase Your Jewellery <br class="d-none d-md-block">';
                                            htmldata+='<span>Grow Your Business Globally</span>';
                                        htmldata+='</h2>';

                                        htmldata+='<p>';
                                            htmldata+='List your jewellery collection, connect with serious<br>';
                                            htmldata+='buyers and expand your business worldwide.<br>';
                                        htmldata+='</p>';

                                        htmldata+='<a href="<?php echo $config->getWeburl(); ?>seller" class="trade-path-btn seller-btn">';
                                            htmldata+='<span>Start as a Seller</span>';
                                            htmldata+='<i class="fas fa-arrow-right fa"></i>';
                                        htmldata+='</a>';

                                    htmldata+='</div>';

                                htmldata+='</div>';

                            htmldata+='</div>';

                htmldata += "</section>";

                htmldata +=
                    '<section class="diamond-market-intro" aria-labelledby="market-intro-title">';
                htmldata += '<div class="container">';
                htmldata +=
                    '<span class="market-eyebrow">A GLOBAL JEWELLERY MARKETPLACE</span>';
                htmldata +=
                    '<h2 id="market-intro-title" class="market-title">A better way to buy and sell jewellery</h2>';
                htmldata +=
                    '<p class="market-lead">Trade CVD connects jewellery buyers with verified sellers worldwide. Explore distinctive collections, compare products and build direct business relationships through one trusted marketplace.</p>';
                htmldata += '<div class="market-features">';
                htmldata +=
                    '<div class="market-feature"><span class="market-icon" aria-hidden="true"><i class="far fa-diamond fa"></i></span><h3>Discover Fine Jewellery</h3><p>Explore rings, earrings, necklaces, bracelets and more from verified jewellery suppliers.</p></div>';
                htmldata +=
                    '<div class="market-feature"><span class="market-icon" aria-hidden="true"><i class="fas fa-users fa"></i></span><h3>Connect Directly</h3><p>Buyers and sellers can discuss requirements, collections and opportunities without barriers.</p></div>';
                htmldata +=
                    '<div class="market-feature"><span class="market-icon" aria-hidden="true"><i class="fas fa-globe fa"></i></span><h3>Grow Your Business</h3><p>Showcase your jewellery to serious buyers and expand your reach across global markets.</p></div>';
                htmldata += "</div>";
                htmldata += "</div>";
                htmldata += "</section>";

                htmldata += '<section class="title-sec section-spacing pb-0">';
                htmldata += '<div class="container">';
                htmldata += '<div class="row">';
                htmldata += '<div class="col-12 text-center">';
                htmldata += '<div class="jewelry-sec">';
                htmldata += '<h2 class="sec-title">Buying Jewelry</h2>';
                htmldata += "</div>";
                htmldata += "</div>";
                htmldata += "</div>";
                htmldata += "</div>";
                htmldata += "</section>";
                /* OLD BUYING JEWELLERY SECTION CODE - KEPT AS REQUESTED
                      for(var i in resultdata.result)
                      {
                          if(i % 2==0)
                          {
                              htmldata+='<section class="buying-jewelry-sec section-space">';
                                  htmldata+='<div class="container">';
                                      htmldata+='<div class="row">';
                                          htmldata+='<div class="col-12 col-md-12 col-lg-6 col-xl-6">';
                                              htmldata+='<div class="buy-jewelry-img">';
                                                  htmldata+='<img src="'+resultdata.result[i].image+'" alt="'+resultdata.result[i].title+'" title="'+resultdata.result[i].title+'">';
                                              htmldata+='</div>';
                                          htmldata+='</div>';
                                          htmldata+='<div class="col-12 col-md-12 col-lg-6 col-xl-6 m-auto">';
                                              htmldata+='<div class="buy-jewelry-title">';
                                                  htmldata+='<h2 class="sec-title text-black">'+resultdata.result[i].title+'</h2>';
                                              htmldata+='</div>';
                                              htmldata+='<div class="buy-jewelry-desc">';
                                                  htmldata+=resultdata.result[i].description;
                                              htmldata+='</div>';
                                          htmldata+='</div>';
                                      htmldata+='</div>';
                                  htmldata+='</div>';
                              htmldata+='</section>';
                          }else{
      
                              htmldata+='<section class="buying-jewelry-sec section-space bg-gray">';
                                  htmldata+='<div class="container">';
                                      htmldata+='<div class="row">';
                                          htmldata+='<div class="col-12 col-md-12 col-lg-6 col-xl-6 order-lg-2">';
                                              htmldata+='<div class="buy-jewelry-img">';
                                                  htmldata+='<img src="'+resultdata.result[i].image+'" alt="'+resultdata.result[i].title+'" title="'+resultdata.result[i].title+'">';
                                              htmldata+='</div>';
                                          htmldata+='</div>';
                                          htmldata+='<div class="col-12 col-md-12 col-lg-6 col-xl-6 m-auto">';
                                              htmldata+='<div class="buy-jewelry-title">';
                                                  htmldata+='<h2 class="sec-title text-black">'+resultdata.result[i].title+'</h2>';
                                              htmldata+='</div>';
                                              htmldata+='<div class="buy-jewelry-desc">';
                                                  htmldata+=resultdata.result[i].description;
                                              htmldata+='</div>';
                                          htmldata+='</div>';
                                      htmldata+='</div>';
                                  htmldata+='</div>';
                              htmldata+='</section>';
                          }
                      }
                      END OLD BUYING JEWELLERY SECTION CODE */

                /* NEW REFERENCE-STYLE BUYING JEWELLERY SECTIONS */
                htmldata += '<div class="trade-buying-list">';
                for (var i = 0; i < resultdata.result.length; i++) {
                    var item = resultdata.result[i];
                    var isEven = i % 2 === 0;
                    var imageOrder = isEven ? "" : " order-lg-2";
                    var copyOrder = isEven ? "" : " order-lg-1";

                    htmldata += '<section class="trade-buying-block">';
                    htmldata += '<div class="container">';
                    htmldata += '<div class="row">';
                    htmldata +=
                        '<div class="col-12 col-lg-6 trade-image-col' + imageOrder + '">';
                    htmldata += '<div class="trade-buying-image">';
                    htmldata +=
                        '<img src="' +
                        item.image +
                        '" alt="' +
                        item.title +
                        '" title="' +
                        item.title +
                        '" loading="lazy">';
                    htmldata += "</div>";
                    htmldata += "</div>";

                    htmldata +=
                        '<div class="col-12 col-lg-6 trade-copy-col' + copyOrder + '">';
                    htmldata += '<div class="trade-buying-copy">';
                    htmldata +=
                        '<span class="trade-buying-eyebrow">Trade CVD Buying Advantage</span>';
                    htmldata +=
                        '<h2 class="trade-buying-title">' + item.title + "</h2>";
                    htmldata +=
                        '<div class="trade-buying-desc">' + item.description + "</div>";
                    htmldata += '<div class="trade-buying-points">';
                    htmldata +=
                        '<div class="trade-buying-point"><svg viewBox="0 0 24 24" fill="none" width="20px" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14 19.2857L15.8 21L20 17M4 21C4 17.134 7.13401 14 11 14C12.4872 14 13.8662 14.4638 15 15.2547M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z" stroke="#669934" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg><strong>Verified Suppliers</strong></div>';
                    htmldata +=
                        '<div class="trade-buying-point"><i class="far fa-diamond fa"></i><strong>Quality Jewellery</strong></div>';
                    htmldata +=
                        '<div class="trade-buying-point"><i class="fas fa-globe fa"></i><strong>Global Marketplace</strong></div>';
                    htmldata += "</div>";
                    htmldata += "</div>";
                    htmldata += "</div>";
                    htmldata += "</div>";
                    htmldata += "</div>";
                    htmldata += "</section>";
                }
                htmldata += "</div>";
                $(".listbuysaleprocessdetail").html(htmldata);
            }
        }

        function OnErrorlistbuyingjewelry(content) {
            ajaxrequest(
                "POST",
                "'<?php echo $config->getPage404url(); ?>'",
                "",
                "",
                OnsuccessRender,
                OnErrorRender,
            );
        }
    </script>
</body>

</html>