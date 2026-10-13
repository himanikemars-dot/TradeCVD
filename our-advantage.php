<?php require_once 'config/init.php'; 
 require_once 'config/apiconfig.php'; 
 $res=$DB->getpagemetadata(9);
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

<body class="our-advantage max-w-2560px">
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
                                    <h1 class="sec-title text-white commonbannertitle"><!-- Our Advantage --></h1>
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
            <section class="our-advantage-sec section-space advantagedetail">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-10 m-auto">
                            <div class="card our-advantage-card shadow-1">
                                <div class="card-body">
                                    <div class="our-advantage-content">
                                        <div class="our-advantage-title">
                                            <h2 class="sec-title text-center advantagemaintitle"><!-- Why Do Most Diamond & Jewelry Trade Professionals Choose Trade CVD? --></h2>
                                        </div>
                                        <div class="our-advantage-desc text-center advantagemaindescr">
                                            <!-- <p class="sec-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium optio magni assumenda vitae laborum quasi. Molestiae facilis, ut nostrum totam explicabo eius possimus dolore amet sit earum aspernatur expedita nam veritatis rem eaque ratione necessitatibus sunt ipsa excepturi recusandae saepe, similique dicta non optio! Laborum doloremque in placeat recusandae enim.</p>
                                            <p class="sec-desc">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tempore nobis reiciendis, at veniam pariatur ipsa sapiente molestiae et, illum perspiciatis est, ducimus ab quasi beatae. Eum voluptatibus iste non culpa?</p>
                                            <p class="sec-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, reprehenderit? Molestiae, itaque voluptate quae et explicabo reprehenderit, numquam ullam dolores dolor placeat maxime, facilis nisi ea eligendi inventore iure ducimus vitae. Ad accusantium facere quae beatae in ipsa ut corporis laboriosam earum voluptatibus inventore reprehenderit expedita reiciendis, rerum at aliquam.</p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row justify-content-center section-space">
                                <div class="col-md-12">
                                    <div class="customer-satisfaction-data">
                                        <div class="card shadow-1 border-rounded">
                                            <div class="card-body py-0" id="advantagedetail">
                                                <!-- <div class="row table-row border-0">
                                                    <div class="col-12 col-md-4 p-0">
                                                        <div class="our-advantage-info tbl-padding  text-center"></div>
                                                    </div>
                                                    <div class="col-12 col-md-4 p-0 table-coloum-border">
                                                        <div class="our-advantage-info tbl-padding  text-center">
                                                            <h2 class="sec-title mb-0">Trade CVD</h2>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4 p-0 table-coloum-border">
                                                        <div class="our-advantage-info tbl-padding text-center"><h3 class="sec-desc fw-600">Other Online <br /> Trading Networks</h3></div>
                                                    </div>
                                                </div>
                                                <div class="row table-row">
                                                        <div class="col-12 col-md-4 p-0 m-auto text-center">
                                                        <div class="our-advantage-data tbl-padding">
                                                            <p>Largest inventory of diamond and Jewelry</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4 p-0 table-coloum-border">
                                                        <div class="company-advantage tbl-padding">With daily diamond listings of more than 1.8 million diamonds and close to 40,000 fine jewelry items, RapNet gives you access to thousands of international buyers and sellers in vibrant markets like India, Hong Kong, China and Europe, so you can source globally at the best prices</div>
                                                    </div>
                                                    <div class="col-12 col-md-4 p-0 bg-soft-blue table-coloum-border">
                                                        <div class="other-info tbl-padding">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis et sequi facilis, vitae, expedita voluptate magnam neque asperiores, illum architecto harum itaque laboriosam ratione provident sint autem ex aut ipsum.</div>
                                                    </div>
                                                </div>
                                                <div class="row table-row">
                                                    <div class="col-12 col-md-4 p-0 m-auto text-center">
                                                        <div class="our-advantage-data tbl-padding">
                                                            <p>Largest inventory of diamond and Jewelry</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4 p-0 table-coloum-border">
                                                        <div class="company-advantage tbl-padding">With daily diamond listings of more than 1.8 million diamonds and close to 40,000 fine jewelry items, RapNet gives you access to thousands of international buyers and sellers in vibrant markets like India, Hong Kong, China and Europe, so you can source globally at the best prices</div>
                                                    </div>
                                                    <div class="col-12 col-md-4 p-0 bg-soft-blue table-coloum-border">
                                                        <div class="other-info tbl-padding">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis et sequi facilis, vitae, expedita voluptate magnam neque asperiores, illum architecto harum itaque laboriosam ratione provident sint autem ex aut ipsum.</div>
                                                    </div>
                                                </div>
                                                <div class="row table-row">
                                                    <div class="col-12 col-md-4 p-0 m-auto text-center">
                                                        <div class="our-advantage-data tbl-padding">
                                                            <p>Largest inventory of diamond and Jewelry</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4 p-0 table-coloum-border">
                                                        <div class="company-advantage tbl-padding">With daily diamond listings of more than 1.8 million diamonds and close to 40,000 fine jewelry items, RapNet gives you access to thousands of international buyers and sellers in vibrant markets like India, Hong Kong, China and Europe, so you can source globally at the best prices</div>
                                                    </div>
                                                    <div class="col-12 col-md-4 p-0 bg-soft-blue table-coloum-border">
                                                        <div class="other-info tbl-padding">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis et sequi facilis, vitae, expedita voluptate magnam neque asperiores, illum architecto harum itaque laboriosam ratione provident sint autem ex aut ipsum.</div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
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
            fillbannerdetail(18);
            listadvantagedetail();
        });
        function listadvantagedetail()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false};

            formdata = new FormData();
            formdata.append("action", "listadvantagedetail");

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'advantage',formdata,headersdata,Onsuccesslistadvantagedetail,OnErrorlistadvantagedetail);
        }

        function Onsuccesslistadvantagedetail(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata='';
            if(resultdata.status==0)
            {
                htmldata+='<div class="col-exs-12 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3 text-center" >';
                htmldata+='<h3>No Data Found!</h3>';
                htmldata+='</div>';
                $('.advantagedetail').html(htmldata);
            }
            else if(resultdata.status==1)
            {
                $('.advantagemaintitle').html(resultdata.result[0].title);
                $('.advantagemaindescr').html(resultdata.result[0].description);
                var htmldata='';
                htmldata+='<div class="row table-row border-0">';
                    htmldata+='<div class="col-12 col-md-4 p-0">';
                        htmldata+='<div class="our-advantage-info tbl-padding  text-center"></div>';
                    htmldata+='</div>';
                    htmldata+='<div class="col-12 col-md-4 p-0 table-coloum-border">';
                        htmldata+='<div class="our-advantage-info tbl-padding  text-center">';
                            htmldata+='<h2 class="sec-title mb-0">'+resultdata.result[0].heading1+'</h2>';
                        htmldata+='</div>';
                    htmldata+='</div>';
                    htmldata+='<div class="col-12 col-md-4 p-0 table-coloum-border">';
                        htmldata+='<div class="our-advantage-info tbl-padding text-center"><h3 class="sec-desc fw-600">'+resultdata.result[0].heading2+'</h3></div>';
                    htmldata+='</div>';
                htmldata+='</div>';

                for(var i in resultdata.subresult)
                {
                    htmldata+='<div class="row table-row">';
                            htmldata+='<div class="col-12 col-md-4 p-0 m-auto text-center">';
                            htmldata+='<div class="our-advantage-data tbl-padding">';
                                htmldata+='<p>'+resultdata.subresult[i].title+'</p>';
                            htmldata+='</div>';
                        htmldata+='</div>';
                        htmldata+='<div class="col-12 col-md-4 p-0 table-coloum-border">';
                            htmldata+='<div class="company-advantage tbl-padding">'+resultdata.subresult[i].description1+'</div>';
                        htmldata+='</div>';
                        htmldata+='<div class="col-12 col-md-4 p-0 bg-soft-blue table-coloum-border">';
                            htmldata+='<div class="other-info tbl-padding">'+resultdata.subresult[i].description2+'</div>';
                        htmldata+='</div>';
                    htmldata+='</div>';
                }
                $('#advantagedetail').html(htmldata);
            }

        }

        function OnErrorlistadvantagedetail(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    </script>
</body>

</html>




