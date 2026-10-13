<?php
require_once dirname(__DIR__, 1) . '/config/init.php';
$res=$DB->getpagemetadata(25);



if($LoginInfo) 
{
    if($LoginInfo->getAdlogin()!='' && $LoginInfo->getIsguestuser()==0)
    {

        
    }
    else
    {
        ?>
<script>
    window.location = '<?php echo $config->getWeburl(); ?>home';
</script>
<?php
    }
}
else
{
    ?>
<script>
    window.location = '<?php echo $config->getWeburl(); ?>home';
</script>
<?php
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tag Start -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="<?php echo $res[0]['metakeywords']; ?>" />
    <meta name="author" content="<?php echo $res[0]['title']; ?>" />
    <meta name="robots" content="<?php echo $res[0]['title']; ?>" />
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
    <?php include('css.php');  ?>

    <!-- CSS End -->
    <!-- <script src="assets/js/vendor/jquery.min.js"></script> -->
</head>

<body class="light support-page max-w-2560px">
    <?php 
    $CheckUserRights=$DB->checkpackagewiseuserright($LoginInfo->getUid());
    // echo $CheckUserRights['IsPackageExpire']; exit;
    if($CheckUserRights['IsPackageExpire']==1){
        ?>
        <script>
            Notiflix.Report.Warning('<?php echo $config->getPackageExpiredTitle(); ?>','<?php echo $config->getPackageExpiredMessage(); ?>', false, function(){window.location='<?php echo $config->getPackageExpiredURL(); ?>';});
            $('#preloader').addClass('d-none');
            $('#ctn-preloader').addClass('loaded');
       </script>
    <?php
    exit;
    }
    // 2 - Jewelry Search
    $CanJewellerySearch = $DB->getpackagewiseuserright($LoginInfo->getUid(),2)['attributeval'];

    if($CompanyInfo->getSupport_contact() || $CompanyInfo->getSupport_whatsappno() || $CompanyInfo->getSupport_email())
    {
    ?>
    <div class="page-wrapper">
        <div class="has-sidebar-left">
            <header class="bg-white accent-3 relative nav-sticky tab-box-shadow">
                <div class="container-fluid text-white">
                    <div class="row">
                        <div class="col-12 col-md-8 col-sm-8 col-lg-9 col-xl-10">
                            <h4 class="mb-0 sec-desc header-desc text-darkgreen set-headdes">Help and Support</h4>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <div class="main" id="web-content">
            <?php include('sidebar.php'); ?>
            <div class="has-sidebar-left support-page-data">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <h1 class="support-page-title">How can we help?</h1>
                        </div>
                        <div class="col-lg-10 col-xl-7 support-pageinfo m-auto">
                            <div class="row">
                                <?php
                                if($CompanyInfo->getSupport_email())
                                {
                                ?>
                                <div class="col-md-4 support-page-box">
                                    <a href="mailto:<?php echo $CompanyInfo->getSupport_email(); ?>">
                                        <div class="helpsupport-img">
                                            <img src="<?php echo $config->getimageurl() ?>images/mail.png" alt="Mail" title="Mail">
                                        </div>
                                        <div class="helpsupport-text">
                                            <p><?php echo $CompanyInfo->getSupport_email(); ?></p>
                                        </div>
                                    </a>
                                </div>
                                <?php
                                }
                                if($CompanyInfo->getSupport_whatsappno())
                                {
                                ?>
                                <div class="col-md-4 support-page-box">
                                    <a href="https://api.whatsapp.com/send?phone=<?php echo $CompanyInfo->getSupport_whatsappno(); ?>&text=&source=&data=" target="_blank">
                                        <div class="helpsupport-img">
                                            <img src="<?php echo $config->getimageurl() ?>images/whatsapp.png" alt="Whatsapp" title="Whatsapp">
                                        </div>
                                        <div class="helpsupport-text">
                                            <p><?php echo $CompanyInfo->getSupport_whatsappno(); ?></p>
                                        </div>
                                    </a>
                                </div>
                                <?php
                                }
                                if($CompanyInfo->getSupport_contact())
                                {
                                ?>
                                <div class="col-md-4 support-page-box">
                                    <a href="tel:<?php echo $CompanyInfo->getSupport_contact(); ?>">
                                        <div class="helpsupport-img">
                                            <img src="<?php echo $config->getimageurl() ?>images/call.png" alt="Call" title="Call">
                                        </div>
                                        <div class="helpsupport-text">
                                            <p><?php echo $CompanyInfo->getSupport_contact(); ?></p>
                                        </div>
                                    </a>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php'); ?>
    </div>
    <?php
    }
    ?>
</body>
<?php include('js.php'); ?>
<script>
    hideloader();
</script>

</html>