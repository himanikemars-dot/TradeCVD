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

<body class="blog-details-page">
    <div class="page-wrapper">
        <!-- Header Start -->
        <?php include('header.php'); ?>
        <!-- Header End -->
        <div class="main page-title mainbg-img" id="web-content">
            <section class="why-savani-sec section-space" style="background-image: url(<?php echo $config->getimageurl() ?>images/about/about-bg-3.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="savani-info">
                                <div class="savani-title">
                                    <h1 class="sec-title text-white">Blog Details</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="blod-details-sec section-space pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="blog__details-wrapper">
                                        <article class="blog-info blog-details-description" id="listblog">
                                            <!-- <div class="blog__thumb">
                                                <a href="<?php echo $config->getWeburl(); ?>blog-details" class="clspageparentmenu" pagename="blog-details">
                                                    <div class="blog-details-img"><img src="<?php echo $config->getimageurl() ?>images/blog/blog-bg1.jpg" alt="" title=""></div></a>
                                            </div>
                                            <div class="blog__content">
                                                <div class="blog-meta">
                                                    <span>
                                                        <a href="#">24/09/2022</a>
                                                    </span>
                                                    <span>
                                                        <a href="#">24/09/2022</a>
                                                    </span>
                                                </div>
                                                <div class="blog-text">
                                                    <h3 class="blog__content__title"><a href="">Lorem ipsum dolor sit amet consectetur.</a></h3>
                                                    <p class="sec-desc">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                                                    <div class="blog-details-desc">
                                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore rem blanditiis dolores aut! Sint facere quam quas libero ipsum, quidem voluptatem quis neque excepturi debitis ex esse repudiandae dolorum nisi reprehenderit quo quae odit. Velit rem magnam soluta asperiores atque repellat alias, sapiente pariatur nostrum doloribus. Nihil omnis excepturi magni.</p>
                                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem ea illum et voluptates laudantium culpa fugiat, fuga similique perferendis doloremque a est odit earum? Odit corporis optio sed blanditiis atque.</p>
                                                    </div>
                                                    <p class="sec-desc">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magni, eos?</p>
                                                    <div class="blog-details-desc">
                                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore rem blanditiis dolores aut! Sint facere quam quas libero ipsum, quidem voluptatem quis neque excepturi debitis ex esse repudiandae dolorum nisi reprehenderit quo quae odit. Velit rem magnam soluta asperiores atque repellat alias, sapiente pariatur nostrum doloribus. Nihil omnis excepturi magni.</p>
                                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem ea illum et voluptates laudantium culpa fugiat, fuga similique perferendis doloremque a est odit earum? Odit corporis optio sed blanditiis atque.</p>
                                                    </div>
                                                    <p class="sec-desc">Lorem ipsum dolor sit, amet consectetur.</p>
                                                    <div class="blog-details-desc">
                                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore rem blanditiis dolores aut! Sint facere quam quas libero ipsum, quidem voluptatem quis neque excepturi debitis ex esse repudiandae dolorum nisi reprehenderit quo quae odit. Velit rem magnam soluta asperiores atque repellat alias, sapiente pariatur nostrum doloribus. Nihil omnis excepturi magni.</p>
                                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem ea illum et voluptates laudantium culpa fugiat, fuga similique perferendis doloremque a est odit earum? Odit corporis optio sed blanditiis atque.</p>
                                                    </div>
                                                    <div class="post-footer d-md-flex flex-md-row justify-content-md-between align-items-center">
                                                        <div>
                                                            <ul class="list-unstyled tag-list mb-0">
                                                                <li><a class="link-blue" href="#">
                                                                <i class="fa fa-long-arrow-left" aria-hidden="true"></i> Preview </a>
                                                                </li>
                                                                <li><a class="link-blue" href="#"> Next <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </article>
                                        <article class="blog-info blog-details-description" id="listblogdetail">
                                            
                                        </article>
                                    </div>
                                </div>
                                <!-- <div class="col-12 col-md-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="recent-news">
                                                <div class="recent-title">
                                                    <h3 class="sec-title">Recent News</h3>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <div class="recent-news-img"><img src="<?php echo $config->getimageurl() ?>images/blog/blog-bg1.jpg" alt="" title=""></div>
                                                </div>
                                                <div class="col-md-9 m-auto">
                                                    <div class="recent-desc">
                                                        <a class="sec-desc" href="#">Lorem ipsum dolor sit, amet.</a>
                                                    </div>
                                                    <p>January 15, 2021</p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <div class="recent-news-img"><img src="<?php echo $config->getimageurl() ?>images/blog/blog-bg1.jpg" alt="" title=""></div>
                                                </div>
                                                <div class="col-md-9 m-auto">
                                                    <div class="recent-desc">
                                                        <a class="sec-desc" href="#">Lorem ipsum dolor sit, amet.</a>
                                                    </div>
                                                    <p>January 15, 2021</p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <div class="recent-news-img"><img src="<?php echo $config->getimageurl() ?>images/blog/blog-bg1.jpg" alt="" title=""></div>
                                                </div>
                                                <div class="col-md-9 m-auto">
                                                    <div class="recent-desc">
                                                        <a class="sec-desc" href="#">Lorem ipsum dolor sit, amet.</a>
                                                    </div>
                                                    <p>January 15, 2021</p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <div class="recent-news-img"><img src="<?php echo $config->getimageurl() ?>images/blog/blog-bg1.jpg" alt="" title=""></div>
                                                </div>
                                                <div class="col-md-9 m-auto">
                                                    <div class="recent-desc">
                                                        <a class="sec-desc" href="#">Lorem ipsum dolor sit, amet.</a>
                                                    </div>
                                                    <p>January 15, 2021</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="categories-sec">
                                                <div class="categories-title">
                                                    <h3 class="sec-title">Categories</h3>
                                                </div>
                                                <ul>
                                                    <li class="categories-list"><a href="#">lorem12</a></li>
                                                    <li class="categories-list"><a href="#">lorem13</a></li>
                                                    <li class="categories-list"><a href="#">lorem14</a></li>
                                                    <li class="categories-list"><a href="#">lorem15</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="tags-sec">
                                                <div class="tags-title">
                                                    <h3 class="sec-title">Tags</div>
                                                </div>
                                                <ul class="tags-list">
                                                    <li>
                                                        <a>lorem</a>
                                                    </li>
                                                    <li>
                                                        <a>lorem</a>
                                                    </li>
                                                    <li>
                                                        <a>lorem</a>
                                                    </li>
                                                    <li>
                                                        <a>lorem</a>
                                                    </li>
                                                    <li>
                                                        <a>lorem</a>
                                                    </li>
                                                    <li>
                                                        <a>lorem</a>
                                                    </li>
                                                    <li>
                                                        <a>lorem</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
           <!--  <section class="related-blog-sec section-space">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="related-blog-title">
                                <h2 class="sec-title text-center">Related Blog</h2>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="related-blog-slider owl-carousel owl-theme">
                                <div class="item">
                                    <article class="blog-info">
                                        <div class="blog__thumb">
                                            <a href="<?php echo $config->getWeburl(); ?>blog-details" class="clspageparentmenu" pagename="blog-details">
                                                <div class="blog-img"><img src="<?php echo $config->getimageurl() ?>images/blog/blog-bg1.jpg" alt="" title=""></div></a>
                                        </div>
                                        <div class="blog__content">
                                            <div class="blog-meta">
                                                <span>
                                                    <a href="#">24/09/2022</a>
                                                </span>
                                                <span>
                                                    <a href="#">24/09/2022</a>
                                                </span>
                                            </div>
                                            <div class="blog-text">
                                                <h3 class="blog__content__title"><a href="#">Lorem ipsum dolor sit amet consectetur.</a></h3>
                                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum, modi! Iste laborum error quos dolores, quaerat</p>
                                                <div class="read-more"><a href="#">Read More </a></div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="item">
                                    <article class="blog-info">
                                        <div class="blog__thumb">
                                            <a href="<?php echo $config->getWeburl(); ?>blog-details" class="clspageparentmenu" pagename="blog-details">
                                                <div class="blog-img"><img src="<?php echo $config->getimageurl() ?>images/blog/blog-bg1.jpg" alt="" title=""></div></a>
                                        </div>
                                        <div class="blog__content">
                                            <div class="blog-meta">
                                                <span>
                                                    <a href="#">24/09/2022</a>
                                                </span>
                                                <span>
                                                    <a href="#">24/09/2022</a>
                                                </span>
                                            </div>
                                            <div class="blog-text">
                                                <h3 class="blog__content__title"><a href="">Lorem ipsum dolor sit amet consectetur.</a></h3>
                                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum, modi! Iste laborum error quos dolores, quaerat</p>
                                                <div class="read-more"><a href="#">Read More </a></div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="item">
                                    <article class="blog-info">
                                        <div class="blog__thumb">
                                            <a href="<?php echo $config->getWeburl(); ?>blog-details" class="clspageparentmenu" pagename="blog-details">
                                                <div class="blog-img"><img src="<?php echo $config->getimageurl() ?>images/blog/blog-bg1.jpg" alt="" title=""></div></a>
                                        </div>
                                        <div class="blog__content">
                                            <div class="blog-meta">
                                                <span>
                                                    <a href="#">24/09/2022</a>
                                                </span>
                                                <span>
                                                    <a href="#">24/09/2022</a>
                                                </span>
                                            </div>
                                            <div class="blog-text">
                                                <h3 class="blog__content__title"><a href="">Lorem ipsum dolor sit amet consectetur.</a></h3>
                                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum, modi! Iste laborum error quos dolores, quaerat</p>
                                                <div class="read-more"><a href="#">Read More </a></div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="item">
                                    <article class="blog-info">
                                        <div class="blog__thumb">
                                            <a href="<?php echo $config->getWeburl(); ?>blog-details" class="clspageparentmenu" pagename="blog-details">
                                                <div class="blog-img"><img src="<?php echo $config->getimageurl() ?>images/blog/blog-bg1.jpg" alt="" title=""></div></a>
                                        </div>
                                        <div class="blog__content">
                                            <div class="blog-meta">
                                                <span>
                                                    <a href="#">24/09/2022</a>
                                                </span>
                                                <span>
                                                    <a href="#">24/09/2022</a>
                                                </span>
                                            </div>
                                            <div class="blog-text">
                                                <h3 class="blog__content__title"><a href="">Lorem ipsum dolor sit amet consectetur.</a></h3>
                                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum, modi! Iste laborum error quos dolores, quaerat</p>
                                                <div class="read-more"><a href="#">Read More </a></div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            <section class="help-section section-space pt-4">
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
            listblog();
        });
        function listblog()
        {
            var urlpath=window.location.pathname;
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false,responsetype: 'JSON'};
            pagenamearry = urlpath.split("/");
            var id1 = (pagenamearry.length)-1;
            var id=pagenamearry[id1]; 
            formdata = new FormData();
            formdata.append("action", "listblog");
            formdata.append("blogid", id);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>blog',formdata,headersdata,Onsuccesslistblog,OnErrorlistblog);
            function Onsuccesslistblog(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);

                var htmldata="";
                if(resultdata.status==0)
                {
                    window.location='<?php echo $config->getWeburl(); ?>'+"blogs";
                }
                else if(resultdata.status==1)
                {
                    htmldata+='<div class="blog-slider owl-carousel nav-carousel">';
                    if((resultdata.blogimg))
                    {
                        for(var i in resultdata.blogimg)
                        {
                            htmldata+='<div class="blog__thumb">';
                                htmldata+='<a href="'+resultdata.blogimg[i].image+'" target="_blank" class="clspageparentmenu" pagename="blog-details">';
                                    htmldata+='<div class="blog-details-img blog-slider-img"><img src="'+resultdata.blogimg[i].image+'" alt="'+resultdata.result[0].title+'" title="'+resultdata.result[0].title+'"></div></a>';
                            htmldata+='</div>';
                        }
                    }else{
                        htmldata+='<div class="blog__thumb">';
                            htmldata+='<a href="'+resultdata.result[0].img+'" target="_blank" class="clspageparentmenu" pagename="blog-details">';
                                htmldata+='<div class="blog-details-img blog-slider-img"><img src="'+resultdata.result[0].img+'" alt="'+resultdata.result[0].title+'" title="'+resultdata.result[0].title+'"></div></a>';
                        htmldata+='</div>';
                    }
                    htmldata+='</div>';
                    $('#listblog').html(htmldata);
                    $('.blog-slider').owlCarousel({
                        loop: true,
                        margin: 0,
                        items: 1,
                        nav: false,
                        center: true,
                        autoplay: true,
                        smartSpeed: 450,
                        autoplayTimeout: 4000,
                        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                        responsive: {
                            0: {
                                items: 1
                            }
                        }
                    });
                    var htmldata1='';
                    htmldata1+='<div class="blog__content">';
                        htmldata1+='<div class="blog-meta">';
                                        if(resultdata.result[0].authorname)
                                        {
                                            htmldata1+='<span>';
                                                htmldata1+='<a href="javascript:void(0)">'+resultdata.result[0].authorname+'</a>';
                                            htmldata1+='</span>';
                                        }
                                        htmldata1+='<span>';
                                            htmldata1+='<a href="javascript:void(0)">'+resultdata.result[0].bdate+'</a>';
                                        htmldata1+='</span>';
                        htmldata1+='</div>';
                        htmldata1+='<div class="blog-text">';
                        htmldata1+=resultdata.result[0].description;
                        htmldata1+='</div>';
                        if(resultdata.result[0].tags){
                            var tags=(resultdata.result[0].tags).split(',');
                            htmldata1+='<div class="col-12">';
                                htmldata1+='<div class="tags-sec">';
                                    htmldata1+='<ul class="tags-list">';
                                        for(var j in tags)
                                        {
                                            htmldata1+='<li>';
                                                htmldata1+='<a href="javascript:void(0)">'+tags[j]+'</a>';
                                            htmldata1+='</li>';
                                        }
                                    htmldata1+='</ul>';
                                htmldata1+='</div>';
                            htmldata1+='</div>';
                        }
                    htmldata1+='</div>';
                    $('#listblogdetail').html(htmldata1);
                }
            }

            function OnErrorlistblog(content)
            { 
                ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
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




