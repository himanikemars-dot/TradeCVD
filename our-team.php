<?php require_once 'config/init.php'; 
 require_once 'config/apiconfig.php'; 
 $res=$DB->getpagemetadata(5);
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

<body class="our-team">
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
                                    <h1 class="sec-title text-white commonbannertitle"><!-- Trade CVD --></h1>
                                </div>
                                <div class="savani-desc commonbannerdescr">
                                    <!-- <p class="sec-desc-pra">The largest and most trusted online marketplace for diamonds & jewelry.</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="our-team-sec section-space">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="our-team-title text-center mb-5"><h1>Our Team</h1></div>
                        </div>
                        <div class="col-12">
                            <div class="row justify-content-center" id="listourteamdetail">
                                <!-- <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="team-card">
                                        <div class="member-img mb-4 rounded-circle">
                                            <img src="<?php echo $config->getimageurl() ?>images/user.png" alt="user 1" title="user 1">
                                        </div>
                                        <div class="member-text">
                                            <div class="text-desc">
                                                <h3 class="desc-sec">Trade CVD</h3>
                                                <p class="sub-desc desc-sec">Chairman</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="team-card">
                                        <div class="member-img mb-4 rounded-circle">
                                        <img src="<?php echo $config->getimageurl() ?>images/user.png" alt="user 1" title="user 1">
                                        </div>
                                        <div class="member-text">
                                            <div class="text-desc">
                                                <h3 class="desc-sec">Trade CVD</h3>
                                                <p class="sub-desc desc-sec">Chairman</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="team-card">
                                        <div class="member-img mb-4 rounded-circle">
                                            <img src="<?php echo $config->getimageurl() ?>images/user.png" alt="user 1" title="user 1">
                                        </div>
                                        <div class="member-text">
                                            <div class="text-desc">
                                                <h3 class="desc-sec">Trade CVD</h3>
                                                <p class="sub-desc desc-sec">Chairman</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="team-card">
                                        <div class="member-img mb-4 rounded-circle">
                                            <img src="<?php echo $config->getimageurl() ?>images/user.png" alt="user 1" title="user 1">
                                        </div>
                                        <div class="member-text">
                                            <div class="text-desc">
                                                <h3 class="desc-sec">Trade CVD</h3>
                                                <p class="sub-desc desc-sec">Chairman</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="team-card">
                                        <div class="member-img mb-4 rounded-circle">
                                            <img src="<?php echo $config->getimageurl() ?>images/user.png" alt="user 1" title="user 1">
                                        </div>
                                        <div class="member-text">
                                            <div class="text-desc">
                                                <h3 class="desc-sec">Trade CVD</h3>
                                                <p class="sub-desc desc-sec">Chairman</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="team-card">
                                        <div class="member-img mb-4 rounded-circle">
                                            <img src="<?php echo $config->getimageurl() ?>images/user.png" alt="user 1" title="user 1">
                                        </div>
                                        <div class="member-text">
                                            <div class="text-desc">
                                                <h3 class="desc-sec">Trade CVD</h3>
                                                <p class="sub-desc desc-sec">Chairman</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="team-card">
                                        <div class="member-img mb-4 rounded-circle">
                                            <img src="<?php echo $config->getimageurl() ?>images/user.png" alt="user 1" title="user 1">
                                        </div>
                                        <div class="member-text">
                                            <div class="text-desc">
                                                <h3 class="desc-sec">Trade CVD</h3>
                                                <p class="sub-desc desc-sec">Chairman</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="team-card">
                                        <div class="member-img mb-4 rounded-circle">
                                            <img src="<?php echo $config->getimageurl() ?>images/user.png" alt="user 1" title="user 1">
                                        </div>
                                        <div class="member-text">
                                            <div class="text-desc">
                                                <h3 class="desc-sec">Trade CVD</h3>
                                                <p class="sub-desc desc-sec">Chairman</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="team-card">
                                        <div class="member-img mb-4 rounded-circle">
                                            <img src="<?php echo $config->getimageurl() ?>images/user.png" alt="user 1" title="user 1">
                                        </div>
                                        <div class="member-text">
                                            <div class="text-desc">
                                                <h3 class="desc-sec">Trade CVD</h3>
                                                <p class="sub-desc desc-sec">Chairman</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="team-card">
                                        <div class="member-img mb-4 rounded-circle">
                                            <img src="<?php echo $config->getimageurl() ?>images/user.png" alt="user 1" title="user 1">
                                        </div>
                                        <div class="member-text">
                                            <div class="text-desc">
                                                <h3 class="desc-sec">Trade CVD</h3>
                                                <p class="sub-desc desc-sec">Chairman</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
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
            fillbannerdetail(17);
            listourteamdetail();
        });
        function listourteamdetail()
        {
            
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false,responsetype: 'JSON'};

            formdata = new FormData();
            formdata.append("action", "listourteamdetail");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>ourteam',formdata,headersdata,Onsuccesslistourteamdetail,OnErrorlistourteamdetail);
            function Onsuccesslistourteamdetail(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata='';
                if(resultdata.status==0)
                {
                    htmldata+='<div class="col-12 col-sm-12 col-lg-12 text-center">';
                    htmldata+='<h3>No Data Found</h3>';
                    htmldata+='</div>';
                    $('#listourteamdetail').html(htmldata);
                }
                else if(resultdata.status==1)
                {   
                    for(var i in resultdata.result)
                    {
                        htmldata+='<div class="col-12 col-sm-6 col-lg-3">';
                        htmldata+='    <div class="team-card">';
                        htmldata+='        <div class="member-img mb-4 rounded-circle">';
                        htmldata+='            <img src="'+resultdata.result[i].image+'" alt="'+resultdata.result[i].name+'" title="'+resultdata.result[i].name+'">';
                        htmldata+='        </div>';
                        htmldata+='        <div class="member-text">';
                        htmldata+='            <div class="text-desc">';
                        htmldata+='                <h3 class="desc-sec">'+resultdata.result[i].name+'</h3>';
                        htmldata+='                <p class="sub-desc desc-sec">'+resultdata.result[i].designation+'</p>';
                        htmldata+='            </div>';
                        htmldata+='        </div>';
                        htmldata+='    </div>';
                        htmldata+='</div>';
                    }
                    $('#listourteamdetail').html(htmldata);
                
                
                }

            
            }

            function OnErrorlistourteamdetail(content)
            { 
                ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
            }
        }
    </script>
</body>

</html>




