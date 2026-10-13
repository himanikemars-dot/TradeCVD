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

    <style>
        
    .otp-container {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .otp-box {
        width: 45px;
        height: 50px;
        text-align: center;
        font-size: 22px;
        font-weight: 600;
        border: 1px solid #ced4da;
        border-radius: 6px;
        outline: none;
    }

    .otp-box:focus {
        border-color: #007bff;
        box-shadow: 0 0 4px rgba(0, 123, 255, 0.3);
    }

    .otp-box.error {
        border-color: red;
    }

    </style>

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
                                                                <h3 class="login-desc titl">Verify OTP</h3>
                                                            </div>

                                                        </div>
                                                        <div class="signup-input">
                                                            <form action="javascript:void(0);" name="fpverifyotp-form" id="fpverifyotp-form">
                                                                <input type="hidden" name="fppersonid" id="fppersonid" />
                                                                <div class="emailtxt mb-2">
                                                                    <p class="fpverifyotp-msg text-success"></p>
                                                                    <p class="fpverifyotp-error text-danger"></p>
                                                                </div>
                                                                <div class="codeip">
                                                                    <p class="sec-desc pin-desc">Please enter 6 digit OTP *</p>
                                                                    <!-- <div class="form-group validate-input">
                                                                        <input class="form-control form-control-lg" inputmode="numeric" autocomplete="one-time-code" placeholder="Enter Verification Code" id="fpotp" maxlength="6" minlength="6" name="otp" type="text">
                                                                    </div> -->
                                                                    
                                                                    <div class="form-group validate-input">
                                                                        <div class="otp-container">
                                                                            <input type="text" class="otp-box" maxlength="1" inputmode="numeric" autocomplete="one-time-code">
                                                                            <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
                                                                            <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
                                                                            <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
                                                                            <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
                                                                            <input type="text" class="otp-box" maxlength="1" inputmode="numeric">
                                                                        </div>

                                                                        <!-- Original input used for form submission and validation -->
                                                                        <input type="hidden" id="fpotp" name="otp" value="">
                                                                    </div>

                                                                    <p class="text-right" id="fpresendregotp"><a onclick="fpresendotp(2);" href="javascript:void(0);">Resend OTP?</a></p>
                                                                    <p class="text-right" id="fpregsleeptimer"></p>
                                                                </div>
                                                                <div class="verifybtn">

                                                                    <button class="head-btn btn btn-primary forgot-pass-link login-verify-btn" type="submit">Verify OTP</button>
                                                                </div>
                                                            </form>
                                                            <a class="back-to-login" href="<?php echo $config->getWeburl(); ?>login">Back to Login</a>
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

            var flow = {};
            try {
                flow = JSON.parse(sessionStorage.getItem('tcForgotFlow') || '{}') || {};
            } catch (e) {}
            if (!flow.personid || flow.stage !== 'otp') {
                window.location.replace(authUrl(flow.stage === 'password' ? 'new-password' : 'forgot-password'));
            } else {
                $('#fppersonid').val(flow.personid);
                $('.fpverifyotp-msg').html(flow.message || '');
                fpstartTimer();
            }
            $('#fpotp').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);
            });
            window.fpresendotp = function(type) {
                if (Date.now() < (flow.resendAt || 0)) return;
                var personid = $('#fpverifyotp-form #fppersonid').val();
                $('.preloader-activate').addClass('preloader-active');
                var pagename = getpagename();
                var useraction = $('#formevent').val();
                var formdata = new FormData();
                formdata.append("action", "resendotp");
                formdata.append("personid", personid);
                formdata.append("type", type);
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 4,
                    userpagename: pagename,
                    useraction: useraction,
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>register', formdata, headersdata, Onsuccessresendotp, OnErrorresendotp)

                function Onsuccessresendotp(data) {
                    $('.preloader-activate').removeClass('preloader-active');
                    var JsonData = JSON.stringify(data);
                    var resultdata = jQuery.parseJSON(JsonData);

                    if (resultdata.status == 0) {
                        Notiflix.Notify.Failure(resultdata.message);
                    } else if (resultdata.status == 1) {

                        flow.resendAt = Date.now() + 59000;
                        sessionStorage.setItem('tcForgotFlow', JSON.stringify(flow));
                        fpstartTimer();
                        Notiflix.Notify.Success(resultdata.message);
                        $('.fpverifyotp-msg').html(resultdata.message);
                    }

                }

                function OnErrorresendotp(content) {
                    $('.preloader-activate').removeClass('preloader-active');
                    $('.fpverifyotp-error').text('Unable to complete the request. Please try again.');
                }
            }


            var fpTimer = null;

            function fpstartTimer() {
                clearInterval(fpTimer);

                function tick() {
                    var seconds = Math.max(0, Math.ceil(((flow.resendAt || 0) - Date.now()) / 1000));
                    $('#fpresendregotp').toggle(seconds === 0);
                    $('#fpregsleeptimer').toggle(seconds > 0).text('00:' + String(seconds).padStart(2, '0'));
                    if (!seconds) clearInterval(fpTimer);
                }
                fpTimer = setInterval(tick, 1000);
                tick();
            }
            if ($('#fpverifyotp-form').length) {
                $('#fpverifyotp-form').validate({
                    rules: {
                        otp: {
                            required: true,
                            minlength: 6,
                            maxlength: 6,
                            digits: true,
                        },
                    },
                    messages: {
                        otp: {
                            required: "Verification code is required",
                        },
                    },
                    submitHandler: function(form) {

                        $('.preloader-activate').addClass('preloader-active');
                        var pagename = getpagename();
                        var useraction = $('#formevent').val();
                        var formdata = new FormData(form);
                        var personid = $('#fpverifyotp-form #fppersonid').val();
                        formdata.append("action", "verifyforgotpwdotp");
                        formdata.append("personid", personid);
                        var headersdata = {
                            'Accept': 'application/json',
                            platform: 4,
                            userpagename: pagename,
                            useraction: useraction,
                            masterlisting: false
                        };
                        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>register', formdata, headersdata, Onsuccessverifyforgotpwdotp, OnErrorverifyforgotpwdotp)

                        function Onsuccessverifyforgotpwdotp(data) {
                            $('.preloader-activate').removeClass('preloader-active');
                            var JsonData = JSON.stringify(data);
                            var resultdata = jQuery.parseJSON(JsonData);

                            if (resultdata.status == 0) {
                                $('.fpverifyotp-error').html(resultdata.message);
                            } else if (resultdata.status == 1) {
                                $('.fpverifyotp-error').html('');
                                sessionStorage.setItem('tcForgotFlow', JSON.stringify({
                                    personid: resultdata.personid,
                                    stage: 'password'
                                }));
                                window.location = authUrl('new-password');

                            }

                        }

                        function OnErrorverifyforgotpwdotp(content) {
                            $('.preloader-activate').removeClass('preloader-active');
                            $('.fpverifyotp-error').text('Unable to complete the request. Please try again.');
                        }


                    },
                });
            }


        });
    </script>
</body>

</html>

<script>
    
$(document).ready(function () {

    $('.otp-box').on('input', function () {
        // Allow only one numeric digit
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1);

        if (this.value !== '') {
            $(this).next('.otp-box').focus();
        }

        updateOTP();
    });

    $('.otp-box').on('keydown', function (e) {
        if (e.key === 'Backspace' && this.value === '') {
            $(this).prev('.otp-box').focus();
        }

        if (e.key === 'ArrowLeft') {
            $(this).prev('.otp-box').focus();
        }

        if (e.key === 'ArrowRight') {
            $(this).next('.otp-box').focus();
        }
    });

    // Paste all 6 OTP digits
    $('.otp-box').on('paste', function (e) {
        e.preventDefault();

        let pastedData = (e.originalEvent.clipboardData || window.clipboardData)
            .getData('text')
            .replace(/\D/g, '')
            .slice(0, 6);

        $('.otp-box').val('');

        $('.otp-box').each(function (index) {
            this.value = pastedData[index] || '';
        });

        updateOTP();

        $('.otp-box').eq(Math.min(pastedData.length, 5)).focus();
    });

    function updateOTP() {
        let otp = '';

        $('.otp-box').each(function () {
            otp += this.value;
        });

        $('#fpotp').val(otp);
    }

});

</script>