<?php
require_once 'config/init.php';
require_once 'config/apiconfig.php';
$res = $DB->getpagemetadata(1);
if ($LoginInfo->getIsguestuser() == 0) {
    header('Location: ' . $config->getWeburl() . 'home');
    exit;
}
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

<body class="home-page">
<div class="page-wrapper"><div class="main" id="web-content"><div class="main-content-login">
<div class="login-bg"><img src="assets/images/banner-image-login.jpg" alt="" class="w-100 h-100"></div>
<div class="auth"><div class="auth-main"><div class="login-wrpper"><div class="row justify-content-center"><div class="col-lg-10">
<div class="login-inner-wrapper"><div class="login-card-outer"><div class="login-outer" id="screenchange"><div class="login-card loginone-content" id="loginone"><div class="login-header text-center">
<div class="login-header-inner">
<div class="login-title"><p class="sec-title text-blue"><a class="logo-image" href="<?php echo $config->getWeburl(); ?>home"><img width="100%" src="<?php echo $config->getImageurl(); ?><?php echo $CompanyInfo->getLogoimg(); ?>" alt="Trade CVD"></a></p></div>
<div class="sec-desc"><h3 class="login-desc titl">Set New Password</h3></div>

</div><div class="signup-input">
<form action="javascript:void(0);" name="fpforgotpwd-form" id="fpforgotpwd-form">
                                                <input type="hidden" name="fpwdpersonid" id="fpwdpersonid" />
                                                <div class="row">
                                                    <div class="col-12 mb-2">
                                                        <p class="fpforgotpwd-error text-danger"></p>
                                                    </div>
                                                    <div class="col-12 col-md-12">
                                                        <div class="form-group validate-input">
                                                            <label class="label-form-control label-form-control-lg">
                                                                New Password *
                                                            </label>
                                                            <input class="form-control form-control-lg" autocomplete="off"  placeholder="Enter New Password" id="form-newpassword" name="newpass" type="password">
                                                            <label class="label-input input-group-text m-0" for="newpassword">

                                                            </label>
                                                        </div>   
                                                    </div>   
                                                    <div class="col-12 col-md-12">
                                                        <div class="form-group validate-input">
                                                            <label class="label-form-control label-form-control-lg">
                                                                Confirm Password *
                                                            </label>
                                                            <input class="form-control form-control-lg" autocomplete="off"  placeholder="Enter Confirm Password" id="form-confirmpassword" name="confirmpass" type="password">
                                                            <label class="label-input input-group-text m-0" for="confirmpassword">

                                                            </label>
                                                        </div>   
                                                    </div>   
                                                    <div class="col-12">

                                                        <button class="head-btn btn btn-primary forgot-pass-link login-verify-btn" type="submit">Set Password</button>
                                                    </div> 
                                                </div>
                                            </form>
<a class="back-to-login" href="<?php echo $config->getWeburl(); ?>login">Back to Login</a>
</div></div></div></div></div></div>
</div></div></div></div></div>
</div></div></div>
<?php include('js.php'); ?>
<script>
$(function () {
function authUrl(page) {
    return <?php echo json_encode(rtrim($config->getWeburl(), '/') . '/'); ?> + page;
}

var flow = {};
try { flow = JSON.parse(sessionStorage.getItem('tcForgotFlow') || '{}') || {}; } catch (e) {}
if (!flow.personid || flow.stage !== 'password') {
    window.location.replace(authUrl(flow.stage === 'otp' ? 'verify-otp' : 'forgot-password'));
} else {
    $('#fpwdpersonid').val(flow.personid);
}
    if($('#fpforgotpwd-form').length){		
        $('#fpforgotpwd-form').validate({
            rules:{
                newpass:{
                    required: true,		
                },
                confirmpass:{
                    required: true,	
                    equalTo: "#form-newpassword"	
                },
            },messages:{
                newpass:{
                    required:"New password is required",
                    
                },
                confirmpass:{
                    required:"Confirm password is required",
                    equalTo: "Confirm Password is same as New Password"
                },
            },
            submitHandler: function(form){

                $('.preloader-activate').addClass('preloader-active');
                var pagename=getpagename();
                var useraction=$('#formevent').val();
                var formdata = new FormData(form);
                var personid = $('#fpforgotpwd-form #fpwdpersonid').val();
                formdata.append("action", "forgotpwd");
                formdata.append("personid", personid);
                var headersdata= {'Accept': 'application/json',platform:4,userpagename:pagename,useraction:useraction,masterlisting:false};
                ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>register',formdata,headersdata,Onsuccessverifyforgotpwd,OnErrorverifyforgotpwd)

                function Onsuccessverifyforgotpwd(data) 
                {
                    $('.preloader-activate').removeClass('preloader-active');
                    var JsonData = JSON.stringify(data);
                    var resultdata = jQuery.parseJSON(JsonData);

                    if(resultdata.status==0)
                    {
                        $('.fpforgotpwd-error').html(resultdata.message);
                    }
                    else if(resultdata.status==1)
                    {
                        $('.fpforgotpwd-error').html('');
                        sessionStorage.removeItem('tcForgotFlow');
                        window.location=resultdata.targeturl || authUrl('login');
                    }
        
                }

                function OnErrorverifyforgotpwd(content) {
 $('.preloader-activate').removeClass('preloader-active');
 $('.fpforgotpwd-error').text('Unable to complete the request. Please try again.');
}


            },
        });
    }


    
});
</script>
</body>
</html>
