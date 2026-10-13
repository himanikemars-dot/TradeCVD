<?php require_once 'config/init.php'; 
 require_once 'config/apiconfig.php'; 

if($LoginInfo->getIsguestuser()==0)
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
    <div class="page-wrapper">
        <div class="main" id="web-content">
            <div class="main-content-login">
                <div class="row m-0">
                    <div class="col-7 pl-0 my-0">
                        <div class="body-bg main-body-bg" style="background-image: url(assets/images/login-bg.jpg)">
                            <div class="login-left-side">
                                <div class="body-content">
                                    <div class="main-line">
                                        <h1 class="title-shaddow">We Display With Pride</h1>
                                    </div>
                                    <div class="main-desc"><p class="sec-desc">We Only take on client when we're sure we can earn them more than they've invested. if we can't help you. we can't help you. we won't try</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mx-auto">
                        <div class="auth">
                            <div class="auth-container  forgot-password" id="forgot-password">
                                <div class="login-wrpper">
                                    <div class="signup-input">
                                        <div class="row">
                                            <div class="col-12 m-auto">
                                                <form action="javascript:void(0);" name="login-form" id="login-form">
                                                    <div class="row">
                                                        <div class="emailip col-12">
                                                            <p>Please enter your email address and we'll send you instructions on how to reset your password.</p>
                                                            <div class="form-group validate-input">
                                                                <label class="label-form-control label-form-control-lg">
                                                                    Email Address *
                                                                </label>
                                                                <input class="form-control form-control-lg" autocomplete="off"  placeholder="Enter Email Address" id="form-emailaddress" name="email" type="email">
                                                                <label class="input-group-text-lg" for="emailaddress"></label>
                                                            </div>
                                                        </div>
                                                        <div class="emailtxt col-12 d-none mb-2">
                                                            <p>Email@gmail.com</p>
                                                        </div>
                                                        <div class="codeip col-12 d-none">
                                                            <p class="sec-desc pin-desc">Please enter 6 digit OTP</p>
                                                            <div class="form-group validate-input">
                                                                <input class="form-control form-control-lg" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Verification Code" id="otp" maxlength="6" minlength="6" name="otp" type="text">
                                                            </div>
                                                            <p class="text-right" id="resendregotp"><a onclick="resendotp(1);" href="javascript:void(0);">Resend OTP?</a></p>
                                                            <p class="text-right" id="regsleeptimer"></p>
                                                        </div>
                                                        <div class="otpbtn col-12">
                                                                <a class="head-btn btn btn-primary forgot-pass-link" id="otpbtn" href="javascript:void(0);">Send OTP</a>
                                                        </div>
                                                        <div class="verifybtn col-12 d-none">
                                                                <a class="head-btn btn btn-primary forgot-pass-link " id="verify" href="javascript:void(0);">Verify OTP</a>
                                                        </div>
                                                        <div class="setpassword col-12 d-none">
                                                            <div class="row">
                                                                <div class="col-12 col-md-12">
                                                                    <div class="form-group validate-input">
                                                                        <label class="label-form-control label-form-control-lg">
                                                                            New Password
                                                                        </label>
                                                                        <input class="form-control form-control-lg" autocomplete="off"  placeholder="Enter New Password" id="form-newpassword" name="newpassword" type="newpassword">
                                                                        <label class="label-input input-group-text m-0" for="newpassword">
                                                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                                        </label>
                                                                    </div>   
                                                                </div>   
                                                                <div class="col-12 col-md-12">
                                                                    <div class="form-group validate-input">
                                                                        <label class="label-form-control label-form-control-lg">
                                                                            Confirm Password
                                                                        </label>
                                                                        <input class="form-control form-control-lg" autocomplete="off"  placeholder="Enter Confirm Password" id="form-confirmpassword" name="confirmpassword" type="confirmpassword">
                                                                        <label class="label-input input-group-text m-0" for="confirmpassword">
                                                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                                        </label>
                                                                    </div>   
                                                                </div>   
                                                                <div class="col-12"><a class="head-btn btn btn-primary forgot-pass-link " id="newpassword" href="javascript:void(0);">Set Password</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="auth-main">
                                <div class="login-wrpper">
                                    <div class="login-inner-wrapper">
                                        <div class="login-card-outer">
                                            <div class="login-outer" id="screenchange">
                                                <div class="login-card loginone-content" id="loginone">
                                                    <div class="login-header">
                                                        <div class="col-10 m-auto text-center">
                                                            <div class="login-title">
                                                                <p class="sec-title text-blue">Trade CVD</p>
                                                            </div>
                                                            <div class="sec-desc">
                                                                <h3 class="login-desc titl">Login to your account</h3>
                                                            </div>
                                                            <p>Welcome back</p>
                                                        </div>
                                                        <div class="signup-input">
                                                            <div class="row">
                                                                <div class="col-10 m-auto">
                                                                    <p class="text-danger login-error"></p>
                                                                    <form action="javascript:void(0);" name="login-form" id="login-form">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group validate-input">
                                                                                    <label class="label-form-control label-form-control-lg">
                                                                                        Email Address *
                                                                                    </label>
                                                                                    <input class="form-control form-control-lg" autocomplete="off"  placeholder="Enter Email Address" id="form-emailaddress" name="email" type="email">
                                                                                    <label class="input-group-text-lg" for="emailaddress"></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group validate-input mb-0">
                                                                                    <label class="label-form-control label-form-control-lg">
                                                                                    Password *
                                                                                    </label>
                                                                                    <input class="form-control form-control-lg" autocomplete="off" placeholder="Enter Password" id="form-password" name="password" type="password">
                                                                                    <label class="input-group-text-lg" for="password"></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="form-group validate-input">
                                                                                    <!-- <label class="checkbox checkbox-outline-primary mb-0">
                                                                                        <input type="checkbox" id="form-rememberme" name="rememberme"></input>
                                                                                        <span class="text-gray-600">Remember me</span>
                                                                                        <span class="checkmark"></span>
                                                                                    </label> -->
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6 text-right">
                                                                                <a class="forgot-pass-link forgot auth-label" id="forgot" href="javascript:void(0);">Forgot Password?</a>
                                                                            </div>
                                                                            <div class="col-12 my-4">
                                                                                <button class="head-btn btn btn-primary" type="submit">Login</button>
                                                                            </div>
                                                                            <div class="col-12 text-center">
                                                                                <a class="clspageparentmenu"  pagename="membershipplan" href="<?php echo $config->getWeburl(); ?>membershipplan">Get Subscription</a>
                                                                            </div>
                                                                        </div>
                                                                    </form>   
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php include('js.php'); ?>
</body>

</html>

<script>
if($('#login-form').length){		
    $('#login-form').validate({
        rules:{
            email:{
                required: true,	
                email:true		
            },
            password:{
                required: true,	
            },
        },messages:{
            email:{
                required:"Email Address is required",
            },
            password:{
                required:"Password is required",
            },
        },
        submitHandler: function(form){

            $('.preloader-activate').addClass('preloader-active');
            var pagename=getpagename();
            var useraction=$('#formevent').val();
            formdata = new FormData(form);
            formdata.append("action", "login");
            var headersdata= {'Accept': 'application/json',platform:4,userpagename:pagename,useraction:useraction,masterlisting:false};
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>register',formdata,headersdata,Onsuccesslogin,OnErrorlogin)

            function Onsuccesslogin(data) 
            {
                $('.preloader-activate').removeClass('preloader-active');
                var JsonData = JSON.stringify(data);
                var resultdata = jQuery.parseJSON(JsonData);

                if(resultdata.status==0)
                {
                    // alertify(resultdata.message,0);
                    $('.login-error').html(resultdata.message);
                }
                else if(resultdata.status==1)
                {
                     window.location=resultdata.targeturl;
                    
                }
    
            }

            function OnErrorlogin(content) {
               
            }


        },
    });
}
 </script>   


