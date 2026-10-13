<?php require_once 'config/init.php'; 
 require_once 'config/apiconfig.php'; 
 $res=$DB->getpagemetadata(13);
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

    <!--title-->
    <title><?php echo $res[0]['title']; ?></title>
    
    <!-- CSS Start -->
    <?php include('css.php'); ?>
    
    <!-- CSS End -->
    <script src="assets/js/vendor/jquery.min.js"></script>
</head>

<body class="sellers max-w-2560px">
    <div class="page-wrapper">
        <!-- Header Start -->
        <?php include('header.php'); ?>
        <!-- Header End -->
        <div class="main page-title" id="web-content">
            <section class="why-savani-sec section-space commonbannerimg" style="">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="savani-info">
                                <div class="savani-title">
                                    <h1 class="sec-title text-white commonbannertitle"><!-- Why Trade CVD --></h1>
                                </div>
                                <div class="savani-desc commonbannerdescr">
                                    <!-- <p class="sec-desc-pra">Trade CVD is the industry’s largest and most <br /> trusted marketplace for diamonds and <br /> jewelry</p>
                                    <p class="sec-desc-pra">Trade CVD is the industry’s largest and most <br /> trusted marketplace for diamonds and <br /> jewelry</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="member-access section-space sellermemaccessdetail">
                <div class="container">
                    <div class="row" id="sellermemaccessdetail">
                        <!-- <div class="col-12 col-md-6">
                            <div class="member-access-bg">
                                <img src="<?php echo $config->getimageurl() ?>images/about/about-bg-4.jpg" alt="About" title="About">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 m-auto">
                            <div class="member-access-data">
                                <div class="member-access-title"><h2>Trade CVD members have access to:</h2></div>
                            </div>
                            <div class="member-access-info">
                                <ul class="member-access-list">
                                    <li><p>Thousands of verified buyers and sellers worldwide </p> </li>
                                    <li><p>Instant availability of over 1.7 million diamonds and fine jewelry</p></li>
                                    <li><p>Real-time discounts so you get the best prices</p></li>
                                    <li><p>Deal direct so there is no commission or transaction fees</p></li>
                                    <li><p>Online access to the Rapaport Price List</p></li>
                                    <li><p>News and market information</p></li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                </div>
            </section>
            <section class="sellers-benefits section-space sellerbenefitdetail">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 m-auto text-center">
                            <div class="benefits-title">
                                <h3 class="sec-title text-black">Sellers Benefits</h3>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="row" id="sellerbenefitdetail">
                                <!-- <div class="col-12 col-md-4">
                                    <div class="benefits-info text-center">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="benefits-img">
                                                    <img src="<?php echo $config->getimageurl() ?>images/sellers/thousands_buyers.svg" alt="Thousands of Buyers" title="Thousands of Buyers">
                                                </div>
                                                <div class="benefits-title">
                                                    <h3 class="sec-desc">Thousands of Buyers</h3>
                                                </div>
                                                <div class="benefits-desc">
                                                    <p>Access thousands of ready buyers around the world.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="benefits-info text-center">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="benefits-img">
                                                    <img src="<?php echo $config->getimageurl() ?>images/sellers/maximum_exposure.svg" alt="Thousands of Buyers" title="Thousands of Buyers">
                                                </div>
                                                <div class="benefits-title">
                                                    <h3 class="sec-desc">Maximum Exposure</h3>
                                                </div>
                                                <div class="benefits-desc">
                                                    <p>Increase sales with global exposure for your company, diamonds and jewelry among thousands of ready buyers around the world.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="benefits-info text-center">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="benefits-img">
                                                    <img src="<?php echo $config->getimageurl() ?>images/sellers/clipboard.svg" alt="Thousands of Buyers" title="Thousands of Buyers">
                                                </div>
                                                <div class="benefits-title">
                                                    <h3 class="sec-desc">Pricing and Availability Info</h3>
                                                </div>
                                                <div class="benefits-desc">
                                                    <p>Get important pricing and availability info from the Rapaport Price List and RapNet best discounted asking prices.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="benefits-info text-center">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="benefits-img">
                                                    <img src="<?php echo $config->getimageurl() ?>images/sellers/no_comission.svg" alt="Thousands of Buyers" title="Thousands of Buyers">
                                                </div>
                                                <div class="benefits-title">
                                                    <h3 class="sec-desc">No Transaction Fees</h3>
                                                </div>
                                                <div class="benefits-desc">
                                                    <p>Negotiate directly with other members with no commissions or listing and transaction fees.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="benefits-info text-center">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="benefits-img">
                                                    <img src="<?php echo $config->getimageurl() ?>images/sellers/presentation.svg" alt="Thousands of Buyers" title="Thousands of Buyers">
                                                </div>
                                                <div class="benefits-title">
                                                    <h3 class="sec-desc">Market Intelligence</h3>
                                                </div>
                                                <div class="benefits-desc">
                                                    <p>See in-depth market analysis with Diamond Price Indexes and up-to-date jewelry market insights.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="benefits-info text-center">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="benefits-img">
                                                    <img src="<?php echo $config->getimageurl() ?>images/sellers/price-001.svg" alt="Thousands of Buyers" title="Thousands of Buyers">
                                                </div>
                                                <div class="benefits-title">
                                                    <h3 class="sec-desc">Rapaport Price List</h3>
                                                </div>
                                                <div class="benefits-desc">
                                                    <p>Integrate Rapaport Price List data into your inventory.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="inr-testimonial-sec section-space listtestimonial" style="background-image: url(<?php echo $config->getimageurl() ?>images/sellers/seller-bg.jpg);">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12 text-center">
                            <div class="inr-testimonial-title">
                                <h3 class="sec-title text-white">Why Our Members Love Trade CVD</h3>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 text-center" id="listtestimonial">
                            <!-- <div class="inr-testimonial-slider owl-carousel owl-theme">
                                <div class="item">
                                    <div class="card wrapper testimoniols-card">
                                        <div class="card-body p-0">
                                            <div class="customers-info text-center">
                                            <div class="customers-img"><img src="<?php echo $config->getimageurl() ?>images/user.png" alt="Abhinav Khanna" title="Abhinav Khanna"></div>
                                            <div class="customers-name"><h3 class="wrapper-title">Abhinav Khanna<h3></div>
                                            <div class="customers-designation"><p>CEO Of Calibary diamond</p></div>
                                                <div class="customers-rate star-rating">
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <div class="customers-desc">
                                                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi "Loremipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi.</p>
                                            </div>
                                            <div class="viewmore-link text-center">
                                                <a class="see-more-link clspageparentmenu" pagename="testimonials" href="<?php echo $config->getWeburl(); ?>testimonials" data-toggle="modal" data-target="#modaltestimonials">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="card wrapper testimoniols-card">
                                        <div class="card-body p-0">
                                            <div class="customers-info text-center">
                                            <div class="customers-img"><img src="<?php echo $config->getimageurl() ?>images/user.png" alt="Abhinav Khanna" title="Abhinav Khanna"></div>
                                            <div class="customers-name"><h3 class="wrapper-title">Abhinav Khanna<h3></div>
                                            <div class="customers-designation"><p>CEO Of Calibary diamond</p></div>
                                                <div class="customers-rate star-rating">
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <div class="customers-desc">
                                                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi "Loremipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi.</p>
                                            </div>
                                            <div class="viewmore-link text-center">
                                                <a class="see-more-link clspageparentmenu" pagename="testimonials" href="<?php echo $config->getWeburl(); ?>testimonials" data-toggle="modal" data-target="#modaltestimonials">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="card wrapper testimoniols-card">
                                        <div class="card-body p-0">
                                            <div class="customers-info text-center">
                                            <div class="customers-img"><img src="<?php echo $config->getimageurl() ?>images/user.png" alt="Abhinav Khanna" title="Abhinav Khanna"></div>
                                            <div class="customers-name"><h3 class="wrapper-title">Abhinav Khanna<h3></div>
                                            <div class="customers-designation"><p>CEO Of Calibary diamond</p></div>
                                                <div class="customers-rate star-rating">
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <div class="customers-desc">
                                                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi "Loremipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi.</p>
                                            </div>
                                            <div class="viewmore-link text-center">
                                                <a class="see-more-link clspageparentmenu" pagename="testimonials" href="<?php echo $config->getWeburl(); ?>testimonials" data-toggle="modal" data-target="#modaltestimonials">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="card wrapper testimoniols-card">
                                        <div class="card-body p-0">
                                            <div class="customers-info text-center">
                                            <div class="customers-img"><img src="<?php echo $config->getimageurl() ?>images/user.png" alt="Abhinav Khanna" title="Abhinav Khanna"></div>
                                            <div class="customers-name"><h3 class="wrapper-title">Abhinav Khanna<h3></div>
                                            <div class="customers-designation"><p>CEO Of Calibary diamond</p></div>
                                                <div class="customers-rate star-rating">
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                    <i class="fa fa-star rating" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <div class="customers-desc">
                                                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi "Loremipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi.</p>
                                            </div>
                                            <div class="viewmore-link text-center">
                                                <a class="see-more-link clspageparentmenu" pagename="testimonials" href="<?php echo $config->getWeburl(); ?>testimonials" data-toggle="modal" data-target="#modaltestimonials">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-12">
                            <div class="viewmore-link text-center">
                                <a class="see-more-link text-white clspageparentmenu" pagename="testimonials" href="<?php echo $config->getWeburl(); ?>testimonials">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="help-section section-space">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <div class="help-area-info">
                                        <div class="help-title">
                                            <h3 class="sec-title">Become a Member</h3>
                                        </div>
                                        <div class="help-desc">
                                            <p class="sec-desc becomememberdetail"><!-- Join the world’s largest and most trusted marketplace for diamonds and jewelry today! --></p>
                                        </div>
                                    </div>
                                    <div class="help-area">
                                        <ul>
                                            <li class="lilogin my-auto"><a class="head-btn btn btn-primary clspageparentmenu" pagename="login" href="<?php echo $config->getWeburl(); ?>login">Login</a></li>
                                            <li class="limembershipplan my-auto"><a class="head-btn btn transparent-btn clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getWeburl(); ?>membershipplan">Choose Plan</a></li>
                                        </ul>
                                    </div>
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
            fillbannerdetail(14);
            fillsellercontentsetting();
        });
        function fillsellercontentsetting()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false};

            formdata = new FormData();
            formdata.append("action", "listcontentsetting");
            formdata.append("typeid", 14);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'contentsetting',formdata,headersdata,Onsuccessfillsellercontentsetting,OnErrorfillsellercontentsetting);
            function Onsuccessfillsellercontentsetting(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata='';
                if(resultdata.status==0)
                {
                    $('.sellermemaccessdetail').addClass('d-none');
                    $('#sellermemaccessdetail').html(htmldata);
                }
                else if(resultdata.status==1)
                {
                    if(resultdata.result[0].description)
                    {
                        $('.sellermemaccessdetail').removeClass('d-none');
                        htmldata+='<div class="col-12 col-md-12 col-lg-6 col-xl-6">';
                            htmldata+='<div class="member-access-bg">';
                                htmldata+='<img src="'+resultdata.result[0].image+'" alt="seller" title="seller">';
                            htmldata+='</div>';
                        htmldata+='</div>';
                        htmldata+='<div class="col-12 col-md-12 col-lg-6 col-xl-6 m-auto">';
                            htmldata+='<div class="member-access-data">';
                                htmldata+='<div class="member-access-title"><h2>'+resultdata.result[0].title+'</h2></div>';
                            htmldata+='</div>';
                            htmldata+='<div class="member-access-info">';
                                htmldata+=resultdata.result[0].description;
                            htmldata+='</div>';
                        htmldata+='</div>';
                        $('#sellermemaccessdetail').html(htmldata);
                    }else{
                        $('.sellermemaccessdetail').addClass('d-none');
                        $('#sellermemaccessdetail').html(htmldata);
                    }
                }

            }

            function OnErrorfillsellercontentsetting(content)
            { 
                ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
            }
            listsellerbenefit();
        }
        function listsellerbenefit()
        {
            
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false,responsetype: 'JSON'};

            formdata = new FormData();
            formdata.append("action", "listbenefit");
            formdata.append("type", 2);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>benefit',formdata,headersdata,Onsuccesslistsellerbenefit,OnErrorlistsellerbenefit);
            function Onsuccesslistsellerbenefit(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata='';
                if(resultdata.status==0)
                {
                    $('#sellerbenefitdetail').html('');
                    $('.sellerbenefitdetail').addClass('d-none');
                }
                else if(resultdata.status==1)
                {   
                    $('.sellerbenefitdetail').removeClass('d-none');
                    for(var i in resultdata.result)
                    {
                        htmldata+='<div class="col-12 col-md-6 col-lg-4 col-xl-4">';
                            htmldata+='<div class="benefits-info text-center">';
                                htmldata+='<div class="card">';
                                    htmldata+='<div class="card-body">';
                                        htmldata+='<div class="benefits-img">';
                                            htmldata+='<img src="'+resultdata.result[i].image+'" alt="'+resultdata.result[i].title+'" title="'+resultdata.result[i].title+'">';
                                        htmldata+='</div>';
                                        htmldata+='<div class="benefits-title">';
                                            htmldata+='<h3 class="sec-desc">'+resultdata.result[i].title+'</h3>';
                                        htmldata+='</div>';
                                        htmldata+='<div class="benefits-desc">';
                                            htmldata+='<p>'+resultdata.result[i].shortdescr+'</p>';
                                        htmldata+='</div>';
                                    htmldata+='</div>';
                                htmldata+='</div>';
                            htmldata+='</div>';
                        htmldata+='</div>';
                    }
                    $('#sellerbenefitdetail').html(htmldata);
                }
            
            }

            function OnErrorlistsellerbenefit(content)
            { 
                ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
            }
            listtestimonial();
        }
        function listtestimonial()
        {
            
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false,responsetype: 'JSON'};

            formdata = new FormData();
            formdata.append("action", "listtestimonial");
            formdata.append("typeid", 2);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>testimonial',formdata,headersdata,Onsuccesslisttestimonial,OnErrorlisttestimonial);
            function Onsuccesslisttestimonial(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata='';
                if(resultdata.status==0)
                {
                    $('#listtestimonial').html('');
                    $('.listtestimonial').addClass('d-none');
                }
                else if(resultdata.status==1)
                {   
                    $('.listtestimonial').removeClass('d-none');
                    htmldata+='<div class="inr-testimonial-slider owl-carousel owl-theme">';
                    for(var i in resultdata.result)
                    {
                        htmldata+='<div class="item">';
                        htmldata+='    <div class="card wrapper testimoniols-card">';
                        htmldata+='        <div class="card-body p-0">';
                        htmldata+='            <div class="customers-info text-center">';
                        htmldata+='            <div class="customers-img"><img src="'+resultdata.result[i].image+'" alt="'+resultdata.result[i].name+'" title="'+resultdata.result[i].name+'"></div>';
                        htmldata+='            <div class="customers-name"><h3 class="wrapper-title">'+resultdata.result[i].name+'<h3></div>';
                        htmldata+='            <div class="customers-designation"><p>'+resultdata.result[i].designation+' Of '+resultdata.result[i].company+'</p></div>';
                        htmldata+='                <div class="customers-rate star-rating">';
                        htmldata+='                    <i class="fa fa-star rating" aria-hidden="true"></i>';
                        htmldata+='                    <i class="fa fa-star rating" aria-hidden="true"></i>';
                        htmldata+='                    <i class="fa fa-star rating" aria-hidden="true"></i>';
                        htmldata+='                    <i class="fa fa-star rating" aria-hidden="true"></i>';
                        htmldata+='                    <i class="fa fa-star rating" aria-hidden="true"></i>';
                        htmldata+='                </div>';
                        htmldata+='            </div>';
                        htmldata+='            <div class="customers-desc">';
                        htmldata+='                <p>'+resultdata.result[i].description+'</p>';
                        htmldata+='            </div>';
                        htmldata+='            <div class="viewmore-link text-center">';
                        htmldata+='                <a class="see-more-link clspageparentmenu" href="javascript:void(0)" onclick="viewtestimonialdetail(\''+resultdata.result[i].id+'\')" >Read More</a>';
                        htmldata+='            </div>';
                        htmldata+='        </div>';
                        htmldata+='    </div>';
                        htmldata+='</div>';
                    }
                    htmldata+='</div>';
                    $('#listtestimonial').html(htmldata);
                    $('.inr-testimonial-slider').owlCarousel({
                        loop: false,
                        margin: 0,
                        nav: true,
                        responsive: {
                            0: {
                                items: 1
                            },
                            767: {
                                items: 2
                            },
                            992: {
                                items: 3
                            },
                            1000: {
                                items: 3
                            }
                        }
                    });
                
                }
            
            }

            function OnErrorlisttestimonial(content)
            { 
                ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
            }
            fillcontentsetting();
        }
        function viewtestimonialdetail(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false,responsetype: 'JSON'};

            formdata = new FormData();
            formdata.append("action", "viewtestimonial");
            formdata.append("id", id);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>testimonial',formdata,headersdata,Onsuccessviewtestimonial,OnErrorviewtestimonial);
            function Onsuccessviewtestimonial(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata='';
                if(resultdata.status==0)
                {
                    $('#testimonialmodaldetail').html('');
                }
                else if(resultdata.status==1)
                {   
                    var htmldata='';
                    
                    htmldata+='<div class="customers-testi-info text-center">';
                        htmldata+='<div class="customers-modal-img"><img src="'+resultdata.result[0].image+'" alt="'+resultdata.result[0].name+'" title="'+resultdata.result[0].name+'"></div>';
                        htmldata+='<div class="customers-name"><h3 class="wrapper-title">'+resultdata.result[0].name+'<h3></div>';
                        htmldata+='<div class="customers-designation"><p>'+resultdata.result[0].designation+' Of '+resultdata.result[0].company+'</p></div>';
                        htmldata+='<div class="customers-rate star-rating">';
                            htmldata+='<i class="fa fa-star rating" aria-hidden="true"></i>';
                            htmldata+='<i class="fa fa-star rating" aria-hidden="true"></i>';
                            htmldata+='<i class="fa fa-star rating" aria-hidden="true"></i>';
                            htmldata+='<i class="fa fa-star rating" aria-hidden="true"></i>';
                            htmldata+='<i class="fa fa-star rating" aria-hidden="true"></i>';
                        htmldata+='</div>';
                    htmldata+='</div>';
                    htmldata+='<div class="customers-testimonial-desc">';
                        htmldata+='<p>'+resultdata.result[0].description+'</p>';
                    htmldata+='</div>';
                    
                    $('#testimonialmodaldetail').html(htmldata);
                    $('#modaltestimonials').modal('show');
                }
            }

            function OnErrorviewtestimonial(content)
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
            formdata.append("typeid", 21);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'contentsetting',formdata,headersdata,Onsuccessfillcontentsetting,OnErrorfillcontentsetting);
            function Onsuccessfillcontentsetting(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata='';
                if(resultdata.status==0)
                {
                    $('.becomememberdetail').html(htmldata);
                }
                else if(resultdata.status==1)
                {
                    $('.becomememberdetail').html(resultdata.result[0].description);
                }

            }

            function OnErrorfillcontentsetting(content)
            { 
                ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
            }
        }
    </script>
</body>

</html>




