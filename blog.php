<?php require_once 'config/init.php'; 
 require_once 'config/apiconfig.php'; 
 $res=$DB->getpagemetadata(18);
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

<body class="blog-page">
    <div class="page-wrapper">
        <!-- Header Start -->
        <?php include('header.php'); ?>
        <!-- Header End -->
        <div class="main page-title mainbg-img" id="web-content">
            <section class="why-savani-sec section-space commonbannerimg" style="">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="savani-info">
                                <div class="savani-title">
                                    <h1 class="sec-title text-white commonbannertitle"><!-- Blog --></h1>
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
            <section class="blog-sec section-space">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="row" id="listblog">
                                <!-- <div class="col-12 col-md-4">
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
                                <div class="col-12 col-md-4">
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
                                <div class="col-12 col-md-4">
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
                                <div class="col-12 col-md-4">
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
                                <div class="col-12 col-md-4">
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
                                <div class="col-12 col-md-4">
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
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
                                            <li class="limembershipplan my-auto"><a class="head-btn btn transparent-btn clspageparentmenu blog-choose-btn" pagename="membershipplan" href="<?php echo $config->getWeburl(); ?>membershipplan">Choose Plan</a></li>
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
            fillbannerdetail(25);
            listblog();
        });
        function listblog()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false,responsetype: 'JSON'};

            formdata = new FormData();
            formdata.append("action", "listblog");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>blog',formdata,headersdata,Onsuccesslistblog,OnErrorlistblog);
            function Onsuccesslistblog(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);

                var htmldata="";
                if(resultdata.status==0)
                {
                    htmldata+='<div class="col-exs-12 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3 text-center" >';
                    htmldata+='<h3>No Data Found!</h3>';
                    htmldata+='</div>';
                    $('#listblog').html(htmldata);
                }
                else if(resultdata.status==1)
                {
                    for(var i in resultdata.result)
                    {

                        htmldata+='<div class="col col-12">';
                            htmldata+='<article class="blog-info blogs-style-change">';
                                htmldata+='<div class="blog__thumb">';
                                    htmldata+='<a href="<?php echo $config->getWeburl(); ?>blog/'+resultdata.result[i].shortlink+'" class="clspageparentmenu" pagename="blog-details">';
                                        htmldata+='<div class="blog-img"><img src="'+resultdata.result[i].img+'" alt="'+resultdata.result[i].title+'" title="'+resultdata.result[i].title+'"></div></a>';
                                htmldata+='</div>';
                                htmldata+='<div class="blog__content">';
                                    htmldata+='<div class="blog-meta">';
                                        if(resultdata.result[i].authorname)
                                        {
                                            htmldata+='<span>';
                                                htmldata+='<a href="javascript:void(0)">'+resultdata.result[i].authorname+'</a>';
                                            htmldata+='</span>';
                                        }
                                        htmldata+='<span>';
                                            htmldata+='<a href="javascript:void(0)">'+resultdata.result[i].bdate+'</a>';
                                        htmldata+='</span>';
                                    htmldata+='</div>';
                                    htmldata+='<div class="blog-text">';
                                        htmldata+='<h3 class="blog__content__title"><a href="<?php echo $config->getWeburl(); ?>blog/'+resultdata.result[i].shortlink+'">'+resultdata.result[i].title+'</a></h3>';
                                        htmldata+='<p>'+resultdata.result[i].shortdescription+'</p>';                                        
                                    htmldata+='</div>';
                                    htmldata+='<div class="read-more"><a href="<?php echo $config->getWeburl(); ?>blog/'+resultdata.result[i].shortlink+'">Read More </a></div>';
                                htmldata+='</div>';
                            htmldata+='</article>';
                        htmldata+='</div>';
                    
                    }
                    $('#listblog').html(htmldata);
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




