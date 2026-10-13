<?php require_once 'config/init.php';
require_once 'config/apiconfig.php';
$res = $DB->getpagemetadata(27);

if ($LoginInfo) {
    if ($LoginInfo->getAdlogin() != '' && $LoginInfo->getIsguestuser() == 0) {
    } else {
?>
        <script>
            window.location = '<?php echo $config->getWeburl(); ?>home';
        </script>
    <?php
    }
} else {
    ?>
    <script>
        window.location = '<?php echo $config->getWeburl(); ?>home';
    </script>
<?php
}
$tid = $_REQUEST['tid'];
$continue = $_REQUEST['continue'];

$transactiontext='Failed';
$transactionstatus=0;
if($continue==md5('success')){
    $transactiontext='Success';
    $transactionstatus=1;
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
    <meta name="author" content="Trade CVD" />
    <meta name="robots" content="Trade CVD" />
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
    <?php include('css.php'); ?>

    <!-- CSS End -->
    <script src="assets/js/vendor/jquery.min.js"></script>
</head>

<body class="checkout-page">
    <div class="page-wrapper">
        <!-- Header Start -->
        <?php include('header.php'); ?>
        <!-- Header End -->
        <div class="main page-title mainbg-img" id="web-content">
            <section class="checkout-main contactus-section letsconnect-section section-space">
                <div class="checkout-container">
                    <div class="card-letsconnect" id="listtransactiondetail">
                        
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
            listtransactiondetail();
        });

        function listtransactiondetail() {
            var tid = '<?php echo $tid; ?>';
            var continuetext = '<?php echo $continue; ?>';
            var pagename = getpagename();
            var headersdata = {
                Accept: 'application/json',
                platform: 4,
                userpagename: pagename,
                useraction: '',
                masterlisting: false
            };
            formdata = new FormData();
            formdata.append("action", "listtransactiondetail");
            formdata.append("tid", tid);
            formdata.append("continuetext", continuetext);
            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + 'package', formdata, headersdata,Onsuccesslisttransactiondetail, OnErrorlisttransactiondetail);

            function Onsuccesslisttransactiondetail(content) {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                $('#listtransactiondetail').html(resultdata.data);



            }

            function OnErrorlisttransactiondetail(content) {
                // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
            }

        }

    </script>
</body>

</html>