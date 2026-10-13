<?php require_once 'config/init.php';
require_once 'config/apiconfig.php';

if ($LoginInfo->getIsguestuser() == 0) {
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
                <div class="row m-0">
                    <div class="col-12 col-md-4 pl-0 my-0">
                        <div class="body-bg bg-blue">
                            <div class="register-account-sticky">
                                <div class="login-left-side">
                                    <div class="body-content">
                                        <span><img class="quotes-img" src="<?php echo $config->getimageurl() ?>images/quotes.svg" alt="quotes" title="quotes"></span>
                                        <h1 class="sec-title text-dark-blue">Ideal Choice</h1>
                                        <div class="main-desc register-desc">
                                            <p class="sec-desc">We only take on client when we're sure we can earn <br /> them more than they've invested. if we can't help you. <br /> we can't help you, we won't try</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="register-bgimg">
                                    <img src="<?php echo $config->getimageurl() ?>images/diamonds.svg" alt="diamonds" title="diamonds">
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 section-space ">
                        <div class="row">
                            <div class="col-12">
                                <div class="login-wrpper register-wrpper">
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
                                                                <h3 class="login-desc">Register Your Account</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <ul class="register-tab nav nav-pills" role="tablist">
                                                                <li class="nav-item nav-tab-link">
                                                                    <a class="nav-link active mb-2" data-toggle="pill" id="personalinfoclick" href="#personal">
                                                                        <img src="<?php echo $config->getimageurl() ?>images/person-c.svg" alt="" title="">
                                                                    </a>
                                                                    <p>Personal</p>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link mb-2 disabled" data-toggle="pill" id="verifycodeclick" href="#confirmation">
                                                                        <img src="<?php echo $config->getimageurl() ?>images/confirmation-c.svg" alt="" title="">
                                                                    </a>
                                                                    <p>Confirmation</p>
                                                                </li>
                                                            </ul>
                                                            <?php
                                                            if ($_REQUEST['type'] && $_REQUEST['package'] && $_REQUEST['packagename'] && $_REQUEST['price']) {
                                                            ?>
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 m-auto">
                                                                        <div class="row">
                                                                            <div class="col-12 my-3">
                                                                                <p class="sec-desc text-success">Package Details : <?php echo $_REQUEST['packagename'] . ' - $' . $_REQUEST['price']; ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                            } ?>
                                                            <!-- Tab panes -->
                                                            <div class="tab-content">
                                                                <div id="personal" class="container tab-pane active">
                                                                    <form action="javascript:void(0);" name="register-form" id="register-form" autocomplete="off">
                                                                        <div class="signup-input mb-5">
                                                                            <div class="row">
                                                                                <div class="col-12 col-md-12 m-auto">
                                                                                    <div class="row">
                                                                                        <div class="col-12 my-3">
                                                                                            <div class="register-info">
                                                                                                <p class="sec-desc">Personal Information</p>
                                                                                            </div>
                                                                                            <p class="text-danger register-error"></p>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6">
                                                                                            <div class="form-group validate-input">
                                                                                                <label class="label-form-control label-form-control-lg">Full Name *</label>
                                                                                                <input class="form-control form-control-lg noSpace" placeholder="Enter Full Name" id="form-fullname" autocomplete="off" name="fullname" type="text">
                                                                                                <label class="input-group-text-lg" for="fullname"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6">
                                                                                            <div class="form-group validate-input">
                                                                                                <label class="label-form-control label-form-control-lg">Email Address * </label>
                                                                                                <input class="form-control form-control-lg noSpace" placeholder="Enter Email Address" autocomplete="off" id="form-emailaddress" name="email" type="text">
                                                                                                <label class="input-group-text-lg" for="emailaddress"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6">
                                                                                            <div class="form-group validate-input">
                                                                                                <label class="label-form-control label-form-control-lg">Password *</label>
                                                                                                <input class="form-control form-control-lg noSpace" autocomplete="new-password" name="password" placeholder="Enter Password" id="form-password" type="password">
                                                                                                <label class="input-group-text-lg" for="password"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6">
                                                                                            <div class="form-group validate-input">
                                                                                                <label class="label-form-control label-form-control-lg">Confirm Password *</label>
                                                                                                <input class="form-control form-control-lg noSpace" placeholder="Enter Confirm Password" autocomplete="new-password" id="form-cpassword" name="cpassword" type="password">
                                                                                                <label class="input-group-text-lg" for="cpassword"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-12 my-3">
                                                                                            <div class="register-info">
                                                                                                <p class="sec-desc">Company Information</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6">
                                                                                            <div class="form-group validate-input">
                                                                                                <label class="label-form-control label-form-control-lg">Company Name *</label>
                                                                                                <input class="form-control form-control-lg noSpace" placeholder="Enter Company Name" autocomplete="off" id="form-companyname" name="companyname" type="text">
                                                                                                <label class="input-group-text-lg" for="companyname"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6">
                                                                                            <div class="form-group validate-input has-val">
                                                                                                <label class="label-form-control label-form-control-lg">Type Of Business *</label>
                                                                                                <select class="form-control register-selectpicker selectpicker has-val select2" data-live-search="true" id="businesstypeid" name="businesstypeid" data-size="10" data-dropup-auto="false">
                                                                                                    <option value="">Select Type Of Business</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6 col-lg-2">
                                                                                            <div class="form-group validate-input">
                                                                                                <label class="label-form-control label-form-control-lg">Phone Code *</label>
                                                                                                <select class="form-control register-selectpicker selectpicker has-val select2" data-live-search="true" id="phonecodeid" name="phonecodeid" data-size="10" data-dropup-auto="false">
                                                                                                    <option value="">Select Phone Code</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6 col-lg-4">
                                                                                            <div class="form-group validate-input">
                                                                                                <label class="label-form-control label-form-control-lg">Business Phone *</label>
                                                                                                <input class="form-control form-control-lg noSpace" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Business Phone" autocomplete="off" id="form-businessphone" name="businessphone" type="text">
                                                                                                <label class="input-group-text-lg" for="businessphone"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6">
                                                                                            <div class="form-group validate-input">
                                                                                                <label class="label-form-control label-form-control-lg">Website</label>
                                                                                                <input class="form-control form-control-lg noSpace" placeholder="Enter Website" autocomplete="off" id="form-website" name="website" type="text">
                                                                                                <label class="input-group-text-lg" for="website"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6">
                                                                                            <div class="form-group validate-input">
                                                                                                <label class="label-form-control label-form-control-lg">Company No.</label>
                                                                                                <input class="form-control form-control-lg noSpace" placeholder="Enter Company No" autocomplete="off" id="form-companyno" name="companyno" type="text">
                                                                                                <label class="input-group-text-lg" for="companyno"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-12 my-3">
                                                                                            <div class="register-info">
                                                                                                <p class="sec-desc">Mailing Address</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6">
                                                                                            <div class="form-group validate-input">
                                                                                                <label class="label-form-control label-form-control-lg"> Address *</label>
                                                                                                <input class="form-control form-control-lg noSpace" placeholder="Enter Address" autocomplete="off" id="form-address" name="address" type="text">
                                                                                                <label class="input-group-text-lg" for="address"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6">
                                                                                            <div class="form-group validate-input">
                                                                                                <label class="label-form-control label-form-control-lg">Additional Address</label>
                                                                                                <input class="form-control form-control-lg noSpace" placeholder="Enter Additional Address" autocomplete="off" id="form-additionaladdress" name="additionaladdress" type="text">
                                                                                                <label class="input-group-text-lg" for="additionaladdress"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3">
                                                                                            <div class="form-group validate-input has-val">
                                                                                                <label class="label-form-control label-form-control-lg">Country *</label>
                                                                                                <select class="form-control register-selectpicker selectpicker has-val select2" data-live-search="true" id="countryid" name="countryid" data-size="10" data-dropup-auto="false">
                                                                                                    <option value="">Select Country</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3">
                                                                                            <div class="form-group validate-input has-val">
                                                                                                <label class="label-form-control label-form-control-lg">State *</label>
                                                                                                <select class="form-control register-selectpicker selectpicker has-val select2" data-live-search="true" id="stateid" name="stateid" data-size="10" data-dropup-auto="false">
                                                                                                    <option value="">Select State</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3">
                                                                                            <div class="form-group validate-input">
                                                                                                <label class="label-form-control label-form-control-lg">City *</label>
                                                                                                <input class="form-control form-control-lg noSpace" placeholder="Enter City" autocomplete="off" id="form-city" name="city" type="text">
                                                                                                <label class="input-group-text-lg" for="city"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3">
                                                                                            <div class="form-group validate-input">
                                                                                                <label class="label-form-control label-form-control-lg">Zip Code *</label>
                                                                                                <input class="form-control form-control-lg noSpace" placeholder="Enter Zip Code" onkeypress="numbonly(event);" onpaste="numbonly(event);" autocomplete="off" id="form-zipcode" name="zipcode" type="text">
                                                                                                <label class="input-group-text-lg" for="zipcode"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6">
                                                                                            <div class="form-group validate-input">
                                                                                                <label class="label-form-control label-form-control-lg">Reference Person 1</label>
                                                                                                <input class="form-control form-control-lg noSpace" placeholder="Enter Reference Person Name" autocomplete="off" id="form-refname1" name="refname1" type="text">
                                                                                                <label class="input-group-text-lg" for="refname1"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6">
                                                                                            <div class="form-group validate-input">
                                                                                                    <label class="label-form-control label-form-control-lg"> Reference Person 2</label>
                                                                                                <input class="form-control form-control-lg noSpace" placeholder="Enter Reference Person Name" autocomplete="off" id="form-refname2" name="refname2" type="text">
                                                                                                <label class="input-group-text-lg" for="refname2"></label> 
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-2 m-auto">
                                                                            <!--  <a class="head-btn btn btn-primary clspageparentmenu" pagename="login" href="<?php echo $config->getWeburl(); ?>login">Next</a> -->
                                                                            <button class="head-btn btn btn-primary" type="submit">Next</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div id="confirmation" class="container tab-pane fade">
                                                                    <form action="javascript:void(0);" name="verifyotp-form" id="verifyotp-form">
                                                                        <input type="hidden" name="personid" id="personid" />
                                                                        <input type="hidden" name="typeid" id="typeid" value="<?php echo $_REQUEST['type'] ?>" />
                                                                        <input type="hidden" name="packageid" id="packageid" value="<?php echo $_REQUEST['package'] ?>" />
                                                                        <input type="hidden" name="btntype" id="btntype" value="<?php echo $_REQUEST['btntype'] ?>" />
                                                                        <div class="signup-input mb-5">
                                                                            <div class="row">
                                                                                <div class="col-12 col-md-6 m-auto">
                                                                                    <div class="row">
                                                                                        <div class="col-12 my-3">
                                                                                            <div class="register-info mb-3">
                                                                                                <p class="sec-desc">Email Verification </p>
                                                                                            </div>
                                                                                            <div class="verification-link">
                                                                                                <p class="regverifycode-text text-success"></p>
                                                                                            </div>
                                                                                            <div class="verification-link">
                                                                                                <p class="regverifycode-error text-danger"></p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 mt-3">
                                                                                            <div class="row">
                                                                                                <div class="col-12 text-left mb-2">
                                                                                                    <p class="sec-desc pin-desc">Please enter 6 digit OTP</p>
                                                                                                </div>
                                                                                                <div class="col-12">
                                                                                                    <div class="form-group validate-input">
                                                                                                        <input class="form-control form-control-lg" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Verification Code" id="otp" maxlength="6" minlength="6" name="otp" type="text">
                                                                                                    </div>
                                                                                                    <p class="text-right" id="resendregotp"><a onclick="resendotp(1);" href="javascript:void(0);">Resend OTP?</a></p>
                                                                                                    <p class="text-right" id="regsleeptimer"></p>
                                                                                                </div>
                                                                                                <!-- <div class="col-2">

                                                                                                    <div class="form-group validate-input">

                                                                                                        <input class="form-control form-control-lg pin1" placeholder="" id="pin1" name="pin1" type="text"></input>

                                                                                                    </div>

                                                                                                </div>

                                                                                                <div class="col-2">

                                                                                                    <div class="form-group validate-input">

                                                                                                        <input class="form-control form-control-lg pin1"  placeholder="" id="pin1" name="pin1" type="text"></input>

                                                                                                    </div>

                                                                                                </div>

                                                                                                <div class="col-2">

                                                                                                    <div class="form-group validate-input">

                                                                                                        <input class="form-control form-control-lg pin1" placeholder="" id="pin1" name="pin1" type="text"></input>

                                                                                                    </div>

                                                                                                </div>

                                                                                                <div class="col-2">

                                                                                                    <div class="form-group validate-input">

                                                                                                        <input class="form-control form-control-lg pin1"  placeholder="" id="pin1" name="pin1" type="text"></input>

                                                                                                    </div>

                                                                                                </div>

                                                                                                <div class="col-2">

                                                                                                    <div class="form-group validate-input">

                                                                                                        <input class="form-control form-control-lg pin1" placeholder="" id="pin1" name="pin1" type="text"></input>

                                                                                                    </div>

                                                                                                </div> -->
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 m-auto">
                                                                            <div class="row justify-content-center">
                                                                                <div class="col-md-3">
                                                                                    <a class="head-btn btn signup-btn btn-transparent" id="registerbackbtn" href="javascript:void(0);">Back</a>
                                                                                </div>
                                                                                <div class="col-auto">
                                                                                    <button class="head-btn btn signup-btn btn-primary" type="submit">Submit</button>
                                                                                    <!-- <a class="head-btn btn btn-primary clspageparentmenu" pagename="login" href="<?php echo $config->getWeburl(); ?>login">Send OTP</a> -->
                                                                                </div>
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
    </div>
    <?php include('js.php'); ?>
</body>
</html>
<script>
    //     const $inp = $(".pin1");
    // $inp.on({
    //   paste(ev) { // Handle Pasting
    //     const clip =    ev.originalEvent.clipboardData.getData('text').trim();
    //     // Allow numbers only
    //     if (!/\d{6}/.test(clip)) return ev.preventDefault(); // Invalid. Exit here
    //     // Split string to Array or characters
    //     const s = [...clip];
    //     // Populate inputs. Focus last input.
    //     $inp.val(i => s[i]).eq(5).focus(); 
    //   },
    //   input(ev) { // Handle typing
    //     const i = $inp.index(this);
    //     if (this.value) $inp.eq(i + 1).focus();
    //   },
    //   keydown(ev) { // Handle Deleting
    //     const i = $inp.index(this);
    //     if (!this.value && ev.key === "Backspace" && i) $inp.eq(i - 1).focus();
    //   }
    // });

    $(document).ready(function() {
        $('#register-form #form-emailaddress').val('');
        var registerForm = document.getElementById('register-form');
        if (registerForm) {
            $(registerForm)
                .find('input:not([type="hidden"]):not([type="submit"]):not([type="button"]), textarea')
                .val('');
            $(registerForm)
                .find('input[type="checkbox"], input[type="radio"]')
                .prop('checked', false);
            $(registerForm)
                .find('select')
                .val('')
                .trigger('change.select2');
        }
        listphonecode();
        listcountry();
        listbusinesstype();
    });

    function listphonecode() {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false,
            responsetype: 'HTML'
        };

        formdata = new FormData();
        formdata.append("action", "listphonecode");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistphonecode, OnErrorlistphonecode);
        function Onsuccesslistphonecode(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '<option value="">Select Phone Code</option>';
            if (resultdata.data) {
                $('#phonecodeid').html(resultdata.data);
            } else {
                $('#phonecodeid').html(htmldata);
            }
            $('#phonecodeid').select2();
        }

        function OnErrorlistphonecode(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listcountry() {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false,
            responsetype: 'HTML'
        };

        formdata = new FormData();
        formdata.append("action", "listcountry");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistcountry, OnErrorlistcountry);
        function Onsuccesslistcountry(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '<option value="">Select Country</option>';
            if (resultdata.data) {
                $('#countryid').html(resultdata.data);
            } else {
                $('#countryid').html(htmldata);
            }
            $('#countryid').select2();
            // liststate();
        }

        function OnErrorlistcountry(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    $('#countryid').change(function() {
        liststate();
    });

    function liststate() {
        var pagename = getpagename();
        var countryid = $('#countryid').val();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false,
            responsetype: 'HTML'
        };

        formdata = new FormData();
        formdata.append("action", "liststate");
        formdata.append("countryid", countryid);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessliststate, OnErrorliststate);

        function Onsuccessliststate(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '<option value="">Select State</option>';
            if (resultdata.data) {
                $('#stateid').html(resultdata.data);
            } else {
                $('#stateid').html(htmldata);
            }
            $('#stateid').select2();
        }

        function OnErrorliststate(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listbusinesstype() {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false,
            responsetype: 'HTML'
        };

        formdata = new FormData();
        formdata.append("action", "listbusinesstype");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistbusinesstype, OnErrorlistbusinesstype);

        function Onsuccesslistbusinesstype(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '<option value="">Select Type Of Business</option>';
            if (resultdata.data) {
                $('#businesstypeid').html(resultdata.data);
            } else {
                $('#businesstypeid').html(htmldata);
            }
            $('#businesstypeid').select2();
        }

        function OnErrorlistbusinesstype(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    $('.noSpace').on('keyup', function () {
        let value = $(this).val();
        $(this).val(value.replace(/^\s+|\s+$/g, ''));
    });

    
    $.validator.addMethod("lettersOnly", function (value, element) {
        return this.optional(element) || /^[A-Za-z ]+$/.test(value);
    }, "Only letters and spaces are allowed.");

    $.validator.addMethod("strongPassword", function (value, element) {
        return this.optional(element) ||
            /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9\s])\S{8,}$/.test(value);
    }, "Password must contain at least 8 characters, uppercase, lowercase, number, and special character.");

    $.validator.addMethod("exactlyTenDigits", function (value, element) {
        return this.optional(element) || /^\d{10}$/.test(value);
    }, "Business Phone must be exactly 10 digits.");

    $('#form-businessphone').on('input', function () {
        this.value = this.value.replace(/\D/g, '').slice(0, 10);
    });

    if ($('#register-form').length) {
        $('#register-form').validate({
            rules: {
                fullname: {
                    required: true,
                    lettersOnly: true
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: '<?php echo $config->getEndpointurl(); ?>register.php',
                        type: 'POST',
                        dataType: 'json',
                        headers: {
                            'Accept': 'application/json',
                            platform: 4,
                            userpagename: getpagename(),
                            useraction: $('#formevent').val(),
                            masterlisting: false
                        },
                        data: {
                            action: 'checkemail',
                            email: function() {
                                return $('#form-emailaddress').val();
                            }
                        },
                        dataFilter: function(response) {
                            var result = JSON.parse(response);
                            if (result.status !== 1) {
                                return JSON.stringify(result.message || 'Unable to check this email address.');
                            }
                            return result.exists ? JSON.stringify(result.message) : 'true';
                        }
                    }
                },
                password: {
                    required: true,
                    strongPassword: true
                },
                cpassword: {
                    required: true,
                    equalTo: "#form-password"
                },
                companyname: {
                    required: true,
                    lettersOnly: true
                },
                website: {
                    url: true
                },
                businesstypeid: {
                    required: true
                },
                businessphone: {
                    required: true,
                    number: true
                },
                phonecodeid: {
                    required: true
                },                
                businessphone: {
                    required: true,
                    exactlyTenDigits: true
                },
                address: {
                    required: true
                },
                countryid: {
                    required: true
                },
                stateid: {
                    required: true
                },
                city: {
                    required: true,
                    lettersOnly: true
                },
                zipcode: {
                    required: true,
                    number: true
                },
                refname1: {
                    lettersOnly: true
                },
                refname2: {
                    lettersOnly: true
                }
            },
            messages: {
                fullname: {
                    required: "Full Name is required",
                    lettersOnly: "Full Name must contain only letters and spaces"
                },
                email: {
                    required: "Email Address is required",
                    email: "Please enter a valid email address.",
                    remote: "Email address already registered.",
                },
                password: {
                    required: "Password is required",
                    strongPassword: "Password must be at least 8 characters with uppercase, lowercase, number and special character"
                },
                cpassword: {
                    required: "Confirm Password is required",
                    equalTo: "Confirm Password is same as Password"
                },
                companyname: {
                    required: "Company Name is required",
                    lettersOnly: "Company Name must contain only letters and spaces"
                },
                website: {
                    url: "Please enter a valid website URL"
                },
                businesstypeid: {
                    required: "Type Of Business is required",
                },
                phonecodeid: {
                    required: "Phone Code is required",
                },                
                businessphone: {
                    required: "Business Phone is required",
                    exactlyTenDigits: "Business Phone must be exactly 10 digits"
                },
                address: {
                    required: "Address is required",
                },
                countryid: {
                    required: "Country is required",
                },
                stateid: {
                    required: "State is required",
                },
                city: {
                    required: "City is required",
                    lettersOnly: "City must contain only letters and spaces"
                },
                zipcode: {
                    required: "Zip Code is required",
                    number: "Zip Code must be a valid number"
                },
                refname1: {
                    lettersOnly: "Reference Person 1 must contain only letters and spaces"
                },
                refname2: {
                    lettersOnly: "Reference Person 2 must contain only letters and spaces"
                }

            },
            
            errorPlacement: function (error, element) {
                if (element.hasClass('select2')) {
                    // Show validation below the visible Select2 dropdown
                    error.insertAfter(element.next('.select2'));
                } else {
                    // Normal input validation
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                $('.preloader-activate').addClass('preloader-active');
                var pagename = getpagename();
                var useraction = $('#formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "insertregister");
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 4,
                    userpagename: pagename,
                    useraction: useraction,
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>register', formdata, headersdata, Onsuccessinsertregister, OnErrorinsertregister)
                function Onsuccessinsertregister(data) {
                    $('.preloader-activate').removeClass('preloader-active');
                    var JsonData = JSON.stringify(data);
                    var resultdata = jQuery.parseJSON(JsonData);

                    if (resultdata.status == 0) {
                        // alertify(resultdata.message,0);
                        $('.register-error').html(resultdata.message);
                    } else if (resultdata.status == 1) {
                        $('#verifyotp-form #personid').val(resultdata.personid);
                        $('.register-error').html('');
                        $('.regverifycode-text').html(resultdata.message);
                        $('#verifycodeclick').removeClass('disabled');
                        $('#verifycodeclick').click();
                        regstartTimer();
                    }
                }

                function OnErrorinsertregister(content) {

                }
            },

            invalidHandler: function() {
                $('.register-error').html('Please fill in all required fields correctly.');
            },
        });
    }

    $('#registerbackbtn').click(function() {
        $('#personalinfoclick').click();
    });

    if ($('#verifyotp-form').length) {
        $('#verifyotp-form').validate({
            rules: {
                otp: {
                    required: true,
                    number: true,
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
                formdata = new FormData(form);
                formdata.append("action", "verifyotp");
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 4,
                    userpagename: pagename,
                    useraction: useraction,
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>register', formdata, headersdata, Onsuccessverifyotp, OnErrorverifyotp)

                function Onsuccessverifyotp(data) {
                    $('.preloader-activate').removeClass('preloader-active');
                    var JsonData = JSON.stringify(data);
                    var resultdata = jQuery.parseJSON(JsonData);
                    if (resultdata.status == 0) {
                        $('.regverifycode-error').html(resultdata.message);
                    } else if (resultdata.status == 1) {
                        /* if(resultdata.typeid && resultdata.packageid)
                        {
                            packageassign(resultdata.typeid,resultdata.packageid);
                        }
                        else
                        {   
                        } */
                        window.location = resultdata.targeturl;
                    }
                }
                function OnErrorverifyotp(content) {
                }
            },
        });
    }

    function resendotp(type) {
        regstartTimer();
        var personid = $('#verifyotp-form #personid').val();
        $('.preloader-activate').addClass('preloader-active');
        var pagename = getpagename();
        var useraction = $('#formevent').val();
        formdata = new FormData();
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
                Notiflix.Notify.Success(resultdata.message);
            }
        }
        function OnErrorresendotp(content) {
        }
    }

    function regstartTimer() {
        $('#resendregotp').hide();
        var duration = 59;
        var timer = duration,
            minutes, seconds;
        var display = $('#regsleeptimer');
        $('#regsleeptimer').show();
        setInterval(function() {
            if (timer == 0) {
                for (var i = 1; i < 99999; i++)
                    window.clearInterval(i);
                //$('#sleeptimer').hide();
                $('#regsleeptimer').html('');
                $('#resendregotp').show();
                $('#regsleeptimer').hide();
            } else {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                display.text(minutes + ":" + seconds);
                if (--timer < 0) {
                    timer = duration;
                }
            }
        }, 1000);
    }
</script>