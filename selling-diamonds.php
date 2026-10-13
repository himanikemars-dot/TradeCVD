<?php require_once 'config/init.php';
require_once 'config/apiconfig.php';
$res=$DB->getpagemetadata(17);
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

    <body class="selling-diamonds">
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
                                        <p class="sec-desc-pra">Source and sell fine jewelry on the industry’s largest and most trusted trading network. Buy earrings, necklaces, watches and more at competitive prices, directly from verified suppliers.</p>
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
                formdata.append("typeid", 4);
                formdata.append("bannertypeid", 12);

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