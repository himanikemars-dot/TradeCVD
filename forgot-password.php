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
<div class="sec-desc"><h3 class="login-desc titl">Forgot Password</h3></div>

</div><div class="signup-input">
<form action="javascript:void(0);" name="fpsendotp-form" id="fpsendotp-form">                                                            
                                                
                                                <div class="emailip">
                                                    <p>Please enter your email address and we'll send you instructions on how to reset your password.</p>
                                                    <p class="fpsendotp-error text-danger"></p>
                                                    <div class="form-group validate-input">
                                                        <label class="label-form-control label-form-control-lg">
                                                            Email Address *
                                                        </label>
                                                        <input class="form-control form-control-lg" autocomplete="off"  placeholder="Enter Email Address" id="fpemail" name="fpemail" type="email">
                                                        <label class="input-group-text-lg" for="fpemail"></label>
                                                    </div>
                                                </div>  
                                                <div class="otpbtn">

                                                    <button class="head-btn btn btn-primary forgot-pass-link login-verify-btn"  type="submit">Send OTP</button>
                                                </div> 
                                                <a href="<?php echo $config->getWeburl(); ?>login" class="back-to-login">  <i class="fas fa-arrow-left fa"></i> Back to Login</a>                                                          
                                            </form>

</div></div></div></div></div></div>
</div></div></div></div></div>
</div></div></div>
<?php include('js.php'); ?>
<script>
$(function () {
function authUrl(page) {
    return <?php echo json_encode(rtrim($config->getWeburl(), '/') . '/'); ?> + page;
}

sessionStorage.removeItem('tcForgotFlow');
if($('#fpsendotp-form').length){		
    $('#fpsendotp-form').validate({
        rules:{
            fpemail:{
                required: true,	
                email:true		
            },
        },messages:{
            fpemail:{
                required:"Email Address is required",
            },
        },
        submitHandler: function(form){

            $('.preloader-activate').addClass('preloader-active');
            var pagename=getpagename();
            var useraction=$('#formevent').val();
            var formdata = new FormData(form);
            var email = $('#fpsendotp-form #fpemail').val();
            formdata.append("action", "sendotptoemail");
            formdata.append("email", email);
            var headersdata= {'Accept': 'application/json',platform:4,userpagename:pagename,useraction:useraction,masterlisting:false};
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>register',formdata,headersdata,Onsuccesssendotptoemail,OnErrorsendotptoemail)

            function Onsuccesssendotptoemail(data) 
            {
                $('.preloader-activate').removeClass('preloader-active');
                var JsonData = JSON.stringify(data);
                var resultdata = jQuery.parseJSON(JsonData);

                if(resultdata.status==0)
                {
                    $('.fpsendotp-error').html(resultdata.message);
                }
                else if(resultdata.status==1)
                {
                    $('.fpsendotp-error').html('');
                    sessionStorage.setItem('tcForgotFlow', JSON.stringify({
                        personid: resultdata.personid, message: resultdata.message,
                        resendAt: Date.now() + 59000, stage: 'otp'
                    }));
                    window.location = authUrl('verify-otp');
                }
    
            }

            function OnErrorsendotptoemail(content) {
 $('.preloader-activate').removeClass('preloader-active');
 $('.fpsendotp-error').text('Unable to complete the request. Please try again.');
}


        },
    });
}



});
</script>
</body>
</html>
