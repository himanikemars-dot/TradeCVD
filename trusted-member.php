<?php require_once 'config/init.php'; 
 require_once 'config/apiconfig.php'; 
 $res=$DB->getpagemetadata(6);
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

<body class="trusted-member">
    <div class="page-wrapper">
        <!-- Header Start -->
        <?php include('header.php'); ?>
        <!-- Header End -->
        <div class="main page-title" id="web-content">
            <section class="why-savani-sec section-space trustbannerimg" style="background-image: url(<?php echo $config->getimageurl() ?>images/about/about-bg-3.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="savani-info">
                                <div class="savani-title">
                                    <h1 class="sec-title text-white trustbannertitle"><!-- Trade CVD Member --></h1>
                                </div>
                                <div class="savani-desc trustbannerdesc">
                                    <!-- <p class="sec-desc-pra">Trade CVD is the industry’s largest and most <br /> trusted marketplace for diamonds and <br /> jewelry</p>
                                    <p class="sec-desc-pra">Trade CVD is the industry’s largest and most <br /> trusted marketplace for diamonds and <br /> jewelry</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="trusted-member-sec section-space listbuysaleprocessdetailtitle">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="trusted-member-sec">
                                <h1 class="sec-title">What It Means to Be a Trade CVD Member</h1>
                            </div>
                        </div>
                    </div>
                </div>
           </section> 
           <div class="listbuysaleprocessdetail">
           <!-- <section class="trusted-content section-space pt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="trusted-img">
                                <img src="" alt="" title="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="trusted-info">
                                <div class="trusted-info-title"><h2 class="sec-title">Trade CVD, owned and operated by the Trade CVD Group</h2></div>
                                <p>Trade CVD is a virtual community that connects every member directly with reputable customers and suppliers around the world in a transparent environment.</p>
                                <p>Members enjoy commission-free trading on more than 1.8 million diamonds and thousands of jewelry pieces at competitive prices with market intelligence for buyers, dealers, and diamond and jewelry manufacturers to make informed transactions.</p>
                            </div>
                        </div>
                    </div>
                </div>
           </section> 
           <section class="trusted-content section-space">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 order-lg-2">
                            <div class="trusted-img">
                                <img src="" alt="" title="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="trusted-info">
                                <div class="trusted-info-title"><h2 class="sec-title">Trade CVD, owned and operated by the Trade CVD Group</h2></div>
                                <p>Trade CVD is a virtual community that connects every member directly with reputable customers and suppliers around the world in a transparent environment.</p>
                                <p>Members enjoy commission-free trading on more than 1.8 million diamonds and thousands of jewelry pieces at competitive prices with market intelligence for buyers, dealers, and diamond and jewelry manufacturers to make informed transactions.</p>
                            </div>
                        </div>
                    </div>
                </div>
           </section> 
           <section class="trusted-content section-space pt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="trusted-img">
                                <img src="" alt="" title="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="trusted-info">
                                <div class="trusted-info-title"><h2 class="sec-title">Trade CVD, owned and operated by the Trade CVD Group</h2></div>
                                <p>Trade CVD is a virtual community that connects every member directly with reputable customers and suppliers around the world in a transparent environment.</p>
                                <p>Members enjoy commission-free trading on more than 1.8 million diamonds and thousands of jewelry pieces at competitive prices with market intelligence for buyers, dealers, and diamond and jewelry manufacturers to make informed transactions.</p>
                            </div>
                        </div>
                    </div>
                </div>
           </section>
           <section class="trusted-content section-space">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 order-lg-2">
                            <div class="trusted-img">
                                <img src="" alt="" title="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="trusted-info">
                                <div class="trusted-info-title"><h2 class="sec-title">Trade CVD, owned and operated by the Trade CVD Group</h2></div>
                                <p>Trade CVD is a virtual community that connects every member directly with reputable customers and suppliers around the world in a transparent environment.</p>
                                <p>Members enjoy commission-free trading on more than 1.8 million diamonds and thousands of jewelry pieces at competitive prices with market intelligence for buyers, dealers, and diamond and jewelry manufacturers to make informed transactions.</p>
                            </div>
                        </div>
                    </div>
                </div>
           </section>  -->
            </div>
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
            listtrustedmember();
        });
        function listtrustedmember()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false};

            formdata = new FormData();
            formdata.append("action", "listbuysaleprocess");
            formdata.append("typeid", 5);
            formdata.append("bannertypeid", 16);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'buysaleprocess',formdata,headersdata,Onsuccesslisttrustedmember,OnErrorlisttrustedmember);
            function Onsuccesslisttrustedmember(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata='';
                if(resultdata.status==0)
                {
                    $('.listbuysaleprocessdetailtitle').addClass('d-none');
                    $('.listbuysaleprocessdetail').html(htmldata);
                }
                else if(resultdata.status==1)
                {
                    $('.trustbannerimg').css('background-image','url('+resultdata.banner[0].image+')');
                    if(resultdata.banner[0].title)
                    {
                        $('.trustbannertitle').html(resultdata.banner[0].title);
                    }
                    if(resultdata.banner[0].description)
                    {
                        $('.trustbannerdesc').html(resultdata.banner[0].description);
                    }
                    $('.listbuysaleprocessdetailtitle').removeClass('d-none');
                    for(var i in resultdata.result)
                    {
                        if(i % 2==0)
                        {
                            htmldata+='<section class="trusted-content section-space pt-0">';
                                htmldata+='<div class="container">';
                                    htmldata+='<div class="row">';
                                        htmldata+='<div class="col-12 col-md-12 col-lg-6 col-xl-6">';
                                            htmldata+='<div class="trusted-img buy-jewelry-img">';
                                                htmldata+='<img src="'+resultdata.result[i].image+'" alt="'+resultdata.result[i].title+'" title="'+resultdata.result[i].title+'">';
                                            htmldata+='</div>';
                                        htmldata+='</div>';
                                        htmldata+='<div class="col-12 col-md-12 col-lg-6 col-xl-6">';
                                            htmldata+='<div class="trusted-info">';
                                                htmldata+='<div class="trusted-info-title"><h2 class="sec-title">'+resultdata.result[i].title+'</h2></div>';
                                                htmldata+=resultdata.result[i].description;
                                            htmldata+='</div>';
                                        htmldata+='</div>';
                                    htmldata+='</div>';
                                htmldata+='</div>';
                            htmldata+='</section> ';
                        }else{

                            htmldata+='<section class="trusted-content section-space">';
                                htmldata+='<div class="container">';
                                    htmldata+='<div class="row">';
                                        htmldata+='<div class="col-12 col-md-12 col-lg-6 col-xl-6 order-lg-2">';
                                            htmldata+='<div class="trusted-img buy-jewelry-img">';
                                                htmldata+='<img src="'+resultdata.result[i].image+'" alt="'+resultdata.result[i].title+'" title="'+resultdata.result[i].title+'">';
                                            htmldata+='</div>';
                                        htmldata+='</div>';
                                        htmldata+='<div class="col-12 col-md-12 col-lg-6 col-xl-6">';
                                            htmldata+='<div class="trusted-info">';
                                                htmldata+='<div class="trusted-info-title"><h2 class="sec-title">'+resultdata.result[i].title+'</h2></div>';
                                                htmldata+=resultdata.result[i].description;
                                            htmldata+='</div>';
                                        htmldata+='</div>';
                                    htmldata+='</div>';
                                htmldata+='</div>';
                            htmldata+='</section> ';
                        }
                    }
                    $('.listbuysaleprocessdetail').html(htmldata);
                }

            }

            function OnErrorlisttrustedmember(content)
            { 
                ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
            }
            fillcontentsetting();
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




