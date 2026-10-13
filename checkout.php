<?php require_once 'config/init.php';
require_once 'config/apiconfig.php';
$res = $DB->getpagemetadata(26);

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
$type=$_REQUEST['type'];
$package=$_REQUEST['package'];
$packagename=$_REQUEST['packagename'];
$price=$_REQUEST['price'];
$btntype=$_REQUEST['btntype'];

// print_r($LoginInfo);
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
            <section class="why-savani-sec section-space commonbannerimg">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="savani-info">
                                <div class="savani-title">
                                    <h1 class="sec-title text-white commonbannertitle"><!-- Let's connect in Trade CVD --></h1>
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
            <section class="checkout-main contactus-section letsconnect-section section-space" id="listcartdetail">
                
            </section>

        </div>
        <!-- Footer Start -->
        <?php include('footer.php'); ?>
        <!-- Footer End -->

        <!-- JS Start -->
        <?php include('js.php'); ?>
        <!-- JS End -->
    </div>
    
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function() {
            var type='<?php echo $type; ?>';
            var totalmonths=12;
            if(type==2){
                totalmonths=1;
            }
            listsummarydetail(totalmonths);
        });
        function listsummarydetail(totalmonths)
        {
            var type='<?php echo $type; ?>';
            var packageid='<?php echo $package; ?>';
            var btntype='<?php echo $btntype; ?>';
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false};
            formdata = new FormData();
            formdata.append("action", "listsummarydetail");
            formdata.append("type",type);
            formdata.append("packageid",packageid);
            formdata.append("totalmonths",totalmonths);
            formdata.append("btntype",btntype);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'package',formdata,headersdata,Onsuccesslistsummarydetail,OnErrorlistsummarydetail);
            function Onsuccesslistsummarydetail(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                $('#listcartdetail').html(resultdata.summarydata);
                var totalmonths = $('#selected_months option:selected').val();
                listsummarydetail_coupon(totalmonths);
                $('#selected_months').on('change',function(){
                    couponremove();
                    var totalmonths = $('#selected_months option:selected').val();
                    listsummarydetail_coupon(totalmonths);
                });

            }

            function OnErrorlistsummarydetail(content)
            { 
                // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
            }

        }
        function listsummarydetail_coupon(totalmonths)
        {
            var type='<?php echo $type; ?>';
            var packageid='<?php echo $package; ?>';
            var btntype='<?php echo $btntype; ?>';
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false};
            formdata = new FormData();
            formdata.append("action", "listsummarydetail_coupon");
            formdata.append("type",type);
            formdata.append("packageid",packageid);
            formdata.append("totalmonths",totalmonths);
            formdata.append("btntype",btntype);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'package',formdata,headersdata,Onsuccesslistsummarydetail_coupon,OnErrorlistsummarydetail_coupon);
            function Onsuccesslistsummarydetail_coupon(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                $('#summarydetail_coupon').html(resultdata.summarydata);
                $('.coupon-text-copy').click(function(){
                    value = $(this).data('clipboard-text');
                    var $temp = $("<input>");
                    $("body").append($temp);
                    $temp.val(value).select();
                    document.execCommand("copy");
                    $temp.remove();
                    Notiflix.Notify.Success('Code copied!!');

                });
                listsummarydetail_cal(totalmonths);
            }

            function OnErrorlistsummarydetail_coupon(content)
            { 
                // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
            }

        }

        function listsummarydetail_cal(totalmonths)
        {
            var type='<?php echo $type; ?>';
            var packageid='<?php echo $package; ?>';
            var btntype='<?php echo $btntype; ?>';
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false};
            formdata = new FormData();
            formdata.append("action", "listsummarydetail_cal");
            formdata.append("type",type);
            formdata.append("packageid",packageid);
            formdata.append("totalmonths",totalmonths);
            formdata.append("btntype",btntype);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'package',formdata,headersdata,Onsuccesslistsummarydetail_cal,OnErrorlistsummarydetail_cal);
            function Onsuccesslistsummarydetail_cal(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                $('#summarydetail_cal').html(resultdata.summarydata);

            }

            function OnErrorlistsummarydetail_cal(content)
            { 
                // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
            }

        }

        // APPLY COUPON 
        $('body').on('click','#btnapplycoupon',function(){
            couponapply();
        });
        function couponapply(){
            var type=$('#listcartdetail #typeid').val();
            var packageid=$('#listcartdetail #packageid').val();
            var couponcode=$('#listcartdetail #couponcode').val();
            var totalmonths = $('#selected_months option:selected').val();
            var btntype='<?php echo $btntype; ?>';
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false};
            formdata = new FormData();
            formdata.append("action", "applycoupon");
            formdata.append("type",type);
            formdata.append("packageid",packageid);
            formdata.append("couponcode",couponcode);
            formdata.append("totalmonths",totalmonths);
            formdata.append("btntype",btntype);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'package',formdata,headersdata,Onsuccessapplycoupon,OnErrorapplycoupon);
            function Onsuccessapplycoupon(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                if(resultdata.status==1)
                {
                
                    Notiflix.Notify.Success(resultdata.message);
                    listsummarydetail_coupon(totalmonths);
                }
                else
                {
                    $('.couponcodeerror').html(resultdata.message);
                }
                
            }

            function OnErrorapplycoupon(content)
            { 
                // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
            }
        }

        $('body').on('click','#couponscode-remove',function(){
            couponremove();
        });

        function couponremove(){
            var totalmonths = $('#selected_months option:selected').val();
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false};
            formdata = new FormData();
            formdata.append("action", "removecoupon");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'package',formdata,headersdata,Onsuccessremovecoupon,OnErrorremovecoupon);
            function Onsuccessremovecoupon(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                if(resultdata.status==1)
                {
                    
                    Notiflix.Notify.Success(resultdata.message);
                    listsummarydetail_coupon(totalmonths);
                }
                else
                {
                    // Notiflix.Notify.Failure(resultdata.message);
                    listsummarydetail_coupon(totalmonths);
                }
                
            }

            function OnErrorremovecoupon(content)
            { 
                // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
            }
        }

        $('body').on('click','#btnpaynow',function(){
            var type=$('#listcartdetail #typeid').val();
            var packageid=$('#listcartdetail #packageid').val();
            var totalmonths=0;
            if(type==2){
                totalmonths=$('#selected_months option:selected').val();
            }
            var btntype='<?php echo $btntype; ?>';
            packageassign(type, packageid,totalmonths,btntype);
        });
    </script>
</body>

</html>