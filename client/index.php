<?php 
// require_once dirname(__DIR__, 1).'/config/config.php';
// $config = new config();

require_once dirname(__DIR__, 1).'/config/init.php';
$res=$DB->getpagemetadata(20);

if($LoginInfo) 
{
    if($LoginInfo->getAdlogin()!='' && $LoginInfo->getIsguestuser()==0)
    {

        
    }
    else
    {
        ?>
        <script>
            window.location='<?php echo $config->getWeburl(); ?>home';
        </script>
        <?php
    }
}
else
{
    ?>
    <script>
        window.location='<?php echo $config->getWeburl(); ?>home';
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

<body class="light home-page max-w-2560px">
    <div class="page-wrapper">
        <!-- Header Start -->
        <?php include('header.php'); ?>
        <!-- Header End -->

        <div class="main all-page-sidebarset" id="web-content">
            <?php include('sidebar.php'); ?>
            <?php include('home.php'); ?>
        </div>
        <!-- Footer Start -->
        <?php include('footer.php'); ?>
        <!-- Footer End -->

        <!-- JS Start -->
        <?php include('js.php'); ?>
        <!-- JS End -->
    </div>
    
</body>

</html>