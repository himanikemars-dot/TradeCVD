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
    <meta property="og:description" content="Trade CVD" />
    <meta property="og:image" content="" />
    <link rel="icon" type="image/x-icon" href="" />
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
                <div class="login-bg"><img src="assets/images/banner-image-login.jpg" alt="" class="w-100 h-100"></div>
                <div class="auth">
                    <div class="auth-main">
                        <div class="login-wrpper">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class="login-inner-wrapper">
                                        <div class="login-card-outer">
                                            <div class="login-outer" id="screenchange">
                                                <div class="login-card loginone-content" id="loginone">
                                                    <div class="login-header text-center">
                                                        <div class="login-header-inner">
                                                            <div class="login-title">
                                                                <p class="sec-title text-blue"><a class="logo-image" href="<?php echo $config->getWeburl(); ?>home"><img width="100%" src="<?php echo $config->getImageurl(); ?><?php echo $CompanyInfo->getLogoimg(); ?>" alt="Trade CVD"></a></p>
                                                            </div>
                                                            <div class="sec-desc">
                                                                <h3 class="login-desc titl">Welcome back</h3>
                                                            </div>
                                                            <p>Sign In to access the global diamond marketplace.</p>
                                                        </div>
                                                        <div class="signup-input">
                                                            <p class="text-danger login-error"></p>
                                                            <form action="javascript:void(0);" name="login-form" id="login-form">

                                                                <div class="form-group validate-input">
                                                                    <label class="label-form-control label-form-control-lg">
                                                                        Email Address *
                                                                    </label>
                                                                    <input class="form-control form-control-lg noSpace" autocomplete="off" name="email" placeholder="Enter Email Address" id="form-emailaddress" type="email">
                                                                    <label class="input-group-text-lg" for="emailaddress"></label>
                                                                </div>

                                                                <div class="form-group validate-input mb-0">
                                                                    <label class="label-form-control label-form-control-lg">
                                                                        Password *
                                                                    </label>
                                                                    <input class="form-control form-control-lg noSpace" autocomplete="off" name="password" placeholder="Enter Password" id="form-password" type="password">
                                                                    <label class="input-group-text-lg" for="password"></label>
                                                                </div>

                                                                <div class="setresche d-flex align-items-center justify-content-between py-3">
                                                                    <div class="form-group validate-input mb-0">
                                                                        <label class="checkbox checkbox-outline-primary mb-0 d-flex align-items-center">
                                                                            <input type="checkbox" id="form-rememberme" name="rememberme" class="mt-0 mr-2" />
                                                                            <span class="text-gray-600">Remember me</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <a class="forgot-pass-link auth-label" href="<?php echo $config->getWeburl(); ?>forgot-password">Forgot Password?</a>

                                                                </div>



                                                                <button class="head-btn btn btn-primary" type="submit">Sign In</button>
                                                                <div class="new-to-trade d-flex align-items-center justify-content-center">
                                                                    <span></span>
                                                                    <p>New to Trade CVD?</p>
                                                                    <span></span>
                                                                </div>
                                                                <a class="create-account" href="<?php echo $config->getWeburl(); ?>register-account">Create an account</a>

                                                                <div class="verified-market">
                                                                    <img src="assets/images/security.svg" alt="Trade CVD">
                                                                    <p>Secure marketplace <span class="dot"></span> Verified members</p>
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
    <?php include('js.php'); ?>
    <script>
        $(function() {
            function authUrl(page) {
                return <?php echo json_encode(rtrim($config->getWeburl(), '/') . '/'); ?> + page;
            }

            $('.noSpace').on('keyup', function () {
                let value = $(this).val();
                $(this).val(value.replace(/^\s+|\s+$/g, ''));
            });

            if ($('#login-form').length) {
                $('#login-form').validate({
                    rules: {
                        email: {
                            required: true,
                            email: true,
                        },
                        password: {
                            required: true

                        }
                    },
                    messages: {
                        email: {
                            required: "Email Address is required",
                            email: "Please enter a valid email address.",
                        },
                        password: {
                            required: "Password is required"
                        }
                    },

                    errorPlacement: function(error, element) {
                        error.insertAfter(element);
                    },
                    submitHandler: function(form) {

                        $('.preloader-activate').addClass('preloader-active');
                        var pagename = getpagename();
                        var useraction = $('#formevent').val();
                        var formdata = new FormData(form);
                        formdata.append("action", "login");
                        var headersdata = {
                            'Accept': 'application/json',
                            platform: 4,
                            userpagename: pagename,
                            useraction: useraction,
                            masterlisting: false
                        };
                        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>register', formdata, headersdata, Onsuccesslogin, OnErrorlogin)

                        function Onsuccesslogin(data) {
                            $('.preloader-activate').removeClass('preloader-active');
                            var JsonData = JSON.stringify(data);
                            var resultdata = jQuery.parseJSON(JsonData);

                            if (resultdata.status == 0) {
                                // alertify(resultdata.message,0);

                                if (resultdata.canlogin == 0) {
                                    Notiflix.Report.Failure('Please Logout From Other Device To Login', 'You have reached maximum device login limit', false, '');

                                } else {
                                    $('.login-error').html(resultdata.message);
                                }
                            } else if (resultdata.status == 1) {
                                if (resultdata.canlogin == 1) {
                                    window.location = resultdata.targeturl;
                                } else {
                                    Notiflix.Report.Failure('Please Logout From Other Device To Login', 'You have reached maximum device login limit', false, '');
                                }
                            }

                        }



                        function OnErrorlogin(content) {
                            $('.preloader-activate').removeClass('preloader-active');
                            $('.login-error').text('Unable to complete the request. Please try again.');
                        }


                    },
                });
            }
        });
    </script>
</body>

</html>