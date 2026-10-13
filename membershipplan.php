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
    <link rel="icon" type="image/x-icon" href="<?php echo $config->getImageurl(); ?>images/gems.png"/>
    <!-- Meta Tag End -->
panel-set-multi
    <!--title-->
    <title><?php echo $res[0]['title']; ?></title>

    <!-- CSS Start -->
    <?php include('css.php'); ?>

    <!-- CSS End -->
    <script src="assets/js/vendor/jquery.min.js"></script>
</head>Package List

<body class="membershipplan max-w-2560px">
    <div class="page-wrapper">
        <!-- Header Start -->
        <?php include('header.php'); ?>
        <!-- Header End -->
        <div class="main page-title mainbg-img" id="web-content" style="background-image: url(<?php echo $config->getimageurl() ?>images/payment-mode-bg.jpg);">
 <!-- Membership Growth Banner Start -->
            <section class="membership-growth-banner" aria-label="Trade CVD membership benefits">
                <div class="container">
                    <div class="membership-growth-content">
                        <div class="membership-growth-eyebrow">A stronger diamond industry together</div>

                        <h1 class="membership-growth-title">
                            Membership That
                            <span>Grows With Your Business</span>
                        </h1>

                        <p class="membership-growth-description">
                            Join a trusted global network of diamond and jewellery professionals.<br>
                            Get the tools, visibility and support you need to buy, sell and grow — with confidence.
                        </p>

                        <div class="membership-benefits">
                            <div class="membership-benefit">
                                <span class="membership-benefit-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3ZM8 11c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3Zm8 2c-2 0-6 1-6 3v3h12v-3c0-2-4-3-6-3ZM8 13c-2.33 0-7 1.17-7 3.5V19h7v-3c0-.85.33-1.59.9-2.21C8.61 13.74 8.3 13 8 13Z"/></svg>
                                </span>
                                <span>Verified Members</span>
                            </div>

                            <div class="membership-benefit">
                                <span class="membership-benefit-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><path d="M12 2 4 5v6c0 5.05 3.41 9.76 8 11 4.59-1.24 8-5.95 8-11V5l-8-3Zm-1.1 14.2-3.5-3.5 1.4-1.4 2.1 2.09 4.7-4.69 1.4 1.4-6.1 6.1Z"/></svg>
                                </span>
                                <span>Secure Payments</span>
                            </div>

                            <div class="membership-benefit">
                                <span class="membership-benefit-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><path d="M12 1a9 9 0 0 0-9 9v7a3 3 0 0 0 3 3h3v-8H5v-2a7 7 0 0 1 14 0v2h-4v8h4v1h-7v2h7a2 2 0 0 0 2-2V10a9 9 0 0 0-9-9Z"/></svg>
                                </span>
                                <span>Dedicated Support</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Membership Growth Banner End -->
            <section class="package-list-sec section-space">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mb-5 text-center">
                            <div class="package-list-title">
                                <h1 class="sec-title text-black title-shaddow">Package List</h1>
                            </div>
                            <div class="package-list-desc" id="PackageListDescr">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-12">
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
                                <div class="plans-box" id="PackageDataList">

                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="set-plan-data">
                        <div class="plans-for-registration">
                            <div class="plans-block appear visible-element">
                                <header class="plans-headline text-center">
                                    <nav class="tabset animated animated-slide-bottom delay-05">
                                        <ul class="nav nav-pills toggle-btns-js cost-button">
                                            <li id="years-price">
                                                <a href="javascript:void(0);" data-category="Membership" data-type="1" class="show-icon-save typechange active" data-label="Billed annually selector"> Annually </a>
                                            </li>
                                            <li id="month-price"><a href="javascript:void(0);" data-type="2" class="hide-icon-save typechange" data-category="Membership" data-label="Billed monthly selector"> Monthly</a></li>
                                            <img class="save20-ico annually" src="#" alt="" style="display: block;">
                                            <img class="save20-ico month" src="#" alt="" style="display: none;">
                                        </ul>
                                    </nav>
                                </header>
                                <section class="savani-hr hr-sec section-space plan-section pt-0 pb-0" id="PackageDataList">
                                    
                                </section>
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

	    <section class="membership-trust-strip" aria-label="Membership highlights">
                <div class="membership-trust-strip-inner">
                    <div class="membership-trust-item">
                        <span class="membership-trust-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24">
                                <path d="M3 9h18v12H3zM12 9v12M2 5h20v4H2zM12 5c0-2-1.2-3-2.7-3C7.8 2 7 3 7 4.1 7 5.8 9 6 12 6M12 5c0-2 1.2-3 2.7-3C16.2 2 17 3 17 4.1 17 5.8 15 6 12 6" />
                            </svg>
                        </span>
                        <div class="membership-trust-copy">
                            <h4>6 Months Free Access</h4>
                            <p>Get started with confidence</p>
                        </div>
                    </div>

                    <div class="membership-trust-item">
                        <span class="membership-trust-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="7" r="3" />
                                <circle cx="5" cy="9" r="2.2" />
                                <circle cx="19" cy="9" r="2.2" />
                                <path d="M7 20v-2.5c0-2.8 2.2-5 5-5s5 2.2 5 5V20M1.5 20v-2c0-2.2 1.6-4 3.7-4M22.5 20v-2c0-2.2-1.6-4-3.7-4" />
                            </svg>
                        </span>
                        <div class="membership-trust-copy">
                            <h4>Verified Global Network</h4>
                            <p>Trade with trusted professionals</p>
                        </div>
                    </div>

                    <div class="membership-trust-item">
                        <span class="membership-trust-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24">
                                <path d="M3 8l4-5h10l4 5-9 13L3 8zM3 8h18M7 3l5 18M17 3l-5 18" />
                            </svg>
                        </span>
                        <div class="membership-trust-copy">
                            <h4>Transparent Pricing</h4>
                            <p>No hidden fees</p>
                        </div>
                    </div>

                    <div class="membership-trust-item">
                        <span class="membership-trust-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24">
                                <path d="M20 7V3l-2 2a9 9 0 1 0 2.1 9M20 3h-4" />
                            </svg>
                        </span>
                        <div class="membership-trust-copy">
                            <h4>Cancel Anytime</h4>
                            <p>Stay in control</p>
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
            fillcontentsetting();
            
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
                    // $('#PackageDataList .palnpenal-multi').owlCarousel({
                    //     loop:false,
                    //     margin:10,
                    //     nav:true,
                    //     dots:false,
                    //     responsive:{
                    //         0:{
                    //             items:1
                    //         },
                    //         600:{
                    //             items:1
                    //         },
                    //         992:{
                    //             items:2
                    //         },
                    //         1000:{
                    //             items:3
                    //         }
                    //     }
                    // });
                    $('#PackageDataList .palnpenal').owlCarousel({
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
                    $('#PackageDataList .btnapplychooseplan').click(function() {
                        var packageid = $(this).attr('data-package');
                        var type = $(this).attr('data-type');
                        checkuserlogin(type,packageid);
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

        function fillcontentsetting()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false};

            formdata = new FormData();
            formdata.append("action", "listcontentsetting");
            formdata.append("typeid", 20);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'contentsetting',formdata,headersdata,Onsuccessfillcontentsetting,OnErrorfillcontentsetting);
        }

        function Onsuccessfillcontentsetting(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata='';
            if(resultdata.status==0)
            {
            
                $('#PackageListDescr').html(htmldata);
            }
            else if(resultdata.status==1)
            {
                $('#PackageListDescr').html(resultdata.result[0].description);
                $(resultdata.result[0].image!='')
                {
                    $('#PackagePricingImgurl').attr('src',resultdata.result[0].image);
                }
                viewpackagedetails();
            }

        }

        function OnErrorfillcontentsetting(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }


        $('body').on('click','#PackageDataList .view-package-details-tag',function(){

            var id = $(this).attr('data-packageid');
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false,responsetype: 'JSON'};

            formdata = new FormData();
            formdata.append("action", "listpackagedetail");
            formdata.append("id",id);
            formdata.append("typeid", 1);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'package',formdata,headersdata,Onsuccessviewpackagedetails,OnErrorviewpackagedetails);
          
            function Onsuccessviewpackagedetails(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata='';
                if(resultdata.status==0)
                {
                    Notiflix.Notify.Failure(resultdata.message);
                }
                else if(resultdata.status==1)
                {
                    // console.log('short descr : '+resultdata.package[0].shortdescr);
                    // console.log('terms condition : '+resultdata.package[0].termscondition);
                    // console.log('descr : '+resultdata.package[0].descr);

                    htmldata+='<div class="row mt-5">';
                    htmldata+='    <div class="col-12 col-exs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">';
                    htmldata+='        <h4 class="text-center packagedetails-modal-title"> -: Short Description :- </h4>';
                    htmldata+='        <p class="packagedetails-modal-text">'+resultdata.package[0].shortdescr+'</p>';
                    htmldata+='    </div>';
                    htmldata+='    <div class="col-12 col-exs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">';
                    htmldata+='        <h4 class="text-center packagedetails-modal-title">-: Description :- </h4>';
                    htmldata+='        <p class="packagedetails-modal-text">'+resultdata.package[0].descr+'</p>';
                    htmldata+='    </div>';
                    htmldata+='    <div class="col-12 col-exs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">';
                    htmldata+='        <h4 class="text-center packagedetails-modal-title">-: Terms & Conditions :-</h4>';
                    htmldata+='        <p class="packagedetails-modal-text">'+resultdata.package[0].termscondition+'</p>';
                    htmldata+='    </div>';
                    htmldata+='</div>';
                    $('#modalpackagedetails #packagedetailsData').html(htmldata);
                    $('#modalpackagedetails').modal('show');
                }

            }

            function OnErrorviewpackagedetails(content)
            { 
                ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
            }
        });

    </script>
</body>

</html>