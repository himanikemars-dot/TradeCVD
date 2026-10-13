<?php require_once 'config/init.php'; 
 require_once 'config/apiconfig.php'; 
 $res=$DB->getpagemetadata(4);
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

<body class="testimonials-page">
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
                                    <h1 class="sec-title text-white commonbannertitle"><!-- Testimoniols --></h1>
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
            <section class="testimonials-sec bg-shaddow-c  section-space">
                <div class="container">
                    <div class="row" id="listtestimonial">
                        <!-- <div class="col-12 text-center mb-4">
                            <div class="testimonials-sec-title">
                                <h2 class="sec-title text-black">Testimoniols</h2>
                            </div>
                        </div> -->
                        <!-- <div class="col-12 col-md-4">
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
                        <div class="col-12 col-md-4">
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
                        <div class="col-12 col-md-4">
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
                        <div class="col-12 col-md-4">
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
                        <div class="col-12 col-md-4">
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
                        <div class="col-12 col-md-4">
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
                        </div> -->
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
            fillbannerdetail(15);
            listtestimonial();
        });
        function listtestimonial()
        {
            
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false,responsetype: 'JSON'};

            formdata = new FormData();
            formdata.append("action", "listtestimonial");
            formdata.append("typeid", 3);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>testimonial',formdata,headersdata,Onsuccesslisttestimonial,OnErrorlisttestimonial);
            function Onsuccesslisttestimonial(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata='';
                if(resultdata.status==0)
                {
                    htmldata+='<div class="col-12 text-center">';
                    htmldata+='<h4>No Data Found</h4>';
                    htmldata+='</div>';
                    $('#listtestimonial').html(htmldata);
                }
                else if(resultdata.status==1)
                {   
                    
                    for(var i in resultdata.result)
                    {
                        htmldata+='<div class="col-12 col-md-6 col-lg-4 col-xl-4 testis">';
                            htmldata+='<div class="card wrapper testimoniols-card">';
                                htmldata+='<div class="card-body p-0">';
                                    htmldata+='<div class="customers-info text-center">';
                                    htmldata+='<div class="customers-img"><img src="'+resultdata.result[i].image+'" alt="'+resultdata.result[i].name+'" title="'+resultdata.result[i].name+'"></div>';
                                    htmldata+='<div class="customers-name"><h3 class="wrapper-title">'+resultdata.result[i].name+'<h3></div>';
                                    htmldata+='<div class="customers-designation"><p>'+resultdata.result[i].designation+' Of '+resultdata.result[i].company+'</p></div>';
                                        htmldata+='<div class="customers-rate star-rating">';
                                            htmldata+='<i class="fa fa-star rating" aria-hidden="true"></i>';
                                            htmldata+='<i class="fa fa-star rating" aria-hidden="true"></i>';
                                            htmldata+='<i class="fa fa-star rating" aria-hidden="true"></i>';
                                            htmldata+='<i class="fa fa-star rating" aria-hidden="true"></i>';
                                            htmldata+='<i class="fa fa-star rating" aria-hidden="true"></i>';
                                        htmldata+='</div>';
                                    htmldata+='</div>';
                                    htmldata+='<div class="customers-desc">';
                                        htmldata+='<p>'+resultdata.result[i].description+'</p>';
                                    htmldata+='</div>';
                                    htmldata+='<div class="viewmore-link text-center">';
                                        htmldata+='<a class="see-more-link " href="javascript:void(0)" onclick="viewtestimonialdetail(\''+resultdata.result[i].id+'\')" >Read More</a>';
                                    htmldata+='</div>';
                                htmldata+='</div>';
                            htmldata+='</div>';
                        htmldata+='</div>';
                    }
                    $('#listtestimonial').html(htmldata);
                  
                
                }
            }

            function OnErrorlisttestimonial(content)
            { 
                ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
            }
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
    </script>
</body>

</html>




