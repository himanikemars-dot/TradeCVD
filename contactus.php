<?php require_once 'config/init.php';
require_once 'config/apiconfig.php';
$res = $DB->getpagemetadata(2); ?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Meta Tag Start -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
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

    <body class="contactus max-w-2560px">
        <div class="page-wrapper">
            <!-- Header Start -->
            <?php include('header.php'); ?>
            <!-- Header End -->
            <main class="main contact-page page-title mainbg-img mb-5" id="web-content">
                <section class="why-savani-sec section-space contact-hero commonbannerimg" style="">
                    <div class="container contact-container">
                        <nav class="contact-breadcrumb" aria-label="Breadcrumb">
                            <a href="/">Home</a><span>/</span><span>Contact Us</span>
                        </nav>
                        <h1>Let’s Start a Conversation</h1>
                        <p>Questions, partnerships or platform support—our team is ready to help.</p>
                        <span class="contact-hero-note">A BRIGHTER<br />TOMORROW<br />TOGETHER</span>
                    </div>
                </section>
                <section class="contact-content contact-container container">
                    <div class="contact-grid">
                        <aside class="contact-help">
                            <h2 class="text-white">We’re Here to Help</h2>
                            <p class="contact-help-intro">
                                Whether you have a question about our platform, need assistance with a listing, or just
                                want to learn more — our team is ready to support you.
                            </p>                          
                            <div class="contact-detail">
                                <span class="contact-round">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>                                                        					<g id="SVGRepo_iconCarrier"> <path d="M12 7V12L14.5 13.5M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#ffffff" stroke-					width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
				</span>
                                <div><strong>Support Hours</strong><span>Monday – Friday, 9:00 AM – 6:00 PM</span></div>
                            </div>
                            <div class="contact-detail">
                                <span class="contact-round">
					<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">					</g><g id="SVGRepo_iconCarrier"> <path d="M21.0039 12C21.0039 16.9706 16.9745 21 12.0039 21C9.9675 21 3.00463 21 3.00463 21C3.00463 21 4.56382 17.2561 3.93982 16.0008C3.34076 14.7956 3.00391 						13.4372 3.00391 12C3.00391 7.02944 7.03334 3 12.0039 3C16.9745 3 21.0039 7.02944 21.0039 12Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
				</span>
                                <div><strong>Response Time</strong><span>Usually within one business day</span></div>
                            </div>
                            <div class="contact-social">
                                <strong>Connect With Us</strong>
                                <div class="contact-social-links">
                                    <a
                                        href="mailto:<?php echo htmlspecialchars($CompanyInfo->getMainEmail() ?: 'info@tradecvd.com', ENT_QUOTES, 'UTF-8'); ?>"
                                        aria-label="Email Trade CVD"
                                        ><i class="far fa-envelope fa"></i
                                    ></a>
                                </div>
                            </div>
                            <div class="contact-signoff">DIAMONDS CONNECT PEOPLE</div>
                        </aside>
                        <div class="contact-form-card">
                            <h2>Send Us a Message</h2>
                            <p>Tell us how we can help and our team will get back to you shortly.</p>
                            <form class="contact-form needs-validation" method="post" id="contactusForm">
                                <div class="contact-fields">
                                    <div class="contact-field">
                                        <label for="cffname">First Name <span>*</span></label
                                        ><input
                                            id="cffname"
                                            name="cffname"
                                            type="text"
                                            placeholder="Enter your first name"
                                            autocomplete="given-name"
                                            required
                                        />
                                    </div>
                                    <div class="contact-field">
                                        <label for="cflname">Last Name <span>*</span></label
                                        ><input
                                            id="cflname"
                                            name="cflname"
                                            type="text"
                                            placeholder="Enter your last name"
                                            autocomplete="family-name"
                                            required
                                        />
                                    </div>
                                    <div class="contact-field">
                                        <label for="cfcemail">Company Email <span>*</span></label
                                        ><input
                                            id="cfcemail"
                                            name="cfcemail"
                                            type="email"
                                            placeholder="you@company.com"
                                            autocomplete="email"
                                            required
                                        />
                                    </div>
                                    <div class="contact-field">
                                        <label for="cfphone">Phone Number <span>*</span></label>
                                        <div class="contact-phone">
                                            <select
                                                id="phonecodeid"
                                                name="phonecodeid"
                                                aria-label="Country calling code"
                                                required
                                            >
                                                <option value="">Code</option></select
                                            ><input
                                                id="cfphone"
                                                name="cfphone"
                                                type="tel"
                                                placeholder="Enter your phone number"
                                                autocomplete="tel-national"
                                                maxlength="15"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="contact-field">
                                        <label for="cfcompanyname">Company Name</label
                                        ><input
                                            id="cfcompanyname"
                                            name="cfcompanyname"
                                            type="text"
                                            placeholder="Enter your company name"
                                            autocomplete="organization"
                                        />
                                    </div>
                                    <div class="contact-field">
                                        <label for="primarycmptypeid">Primary Company Type</label
                                        ><select id="primarycmptypeid" name="primarycmptypeid">
                                            <option value="">Select Primary Company Type</option>
                                        </select>
                                    </div>
                                    <div class="contact-field contact-wide">
                                        <label for="cfcmpwebsite">Company Website</label
                                        ><input
                                            id="cfcmpwebsite"
                                            name="cfcmpwebsite"
                                            type="url"
                                            placeholder="https://www.yourcompany.com"
                                            autocomplete="url"
                                        />
                                    </div>
                                    <div class="contact-field contact-wide">
                                        <label for="countryid">Country</label
                                        ><select id="countryid" name="countryid">
                                            <option value="">Select Country</option>
                                        </select>
                                    </div>
                                    <div class="contact-field contact-wide">
                                        <label for="message">Message <span>*</span></label
                                        ><textarea
                                            id="message"
                                            name="message"
                                            placeholder="Tell us how we can help..."
                                            rows="3"
                                            required
                                        ></textarea>
                                    </div>
                                </div>
                                <div class="contact-form-bottom">
                                    <div class="contact-consent">
                                        <label
                                            ><input type="checkbox" name="privacyconsent" required />
                                            <span
                                                >I agree to the
                                                <a href="/privacypolicy" target="_blank" rel="noopener"
                                                    >Privacy Policy</a
                                                >.</span
                                            ></label
                                        ><small
                                            ><i class="fas fa-lock fa"></i> Your information is secure and never
                                            shared.</small
                                        >
                                    </div>
                                    <button class="contact-submit" type="submit">
                                        Send Message <i class="fas fa-arrow-right fa"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="contact-benefits">
                        <div>
                            <i class="fa-solid fa-headphones fa"></i
                            ><span><strong>Dedicated Support</strong><small>Real people, real help</small></span>
                        </div>
                        <div>
                            <i class="far fa-shield-alt"></i
                            ><span><strong>Secure &amp; Private</strong><small>Your information is safe</small></span>
                        </div>
                        <div>
                            <i class="fas fa-globe"></i
                            ><span><strong>Global Assistance</strong><small>Support wherever you are</small></span>
                        </div>
                    </div>
                    <section class="contact-faq" aria-labelledby="contact-faq-title">
                       <div class="mb-4">
                         <h2 id="contact-faq-title">Frequently Asked Questions</h2>
                         <p>Quick answers to common questions. Can’t find what you’re looking for? Contact our team.</p>
                       </div>                      
                        <div class="contact-faq-grid">
                            <details>
                                <summary>How quickly will you respond to my inquiry?</summary>
                                <p>We usually respond within one business day, Monday through Friday.</p>
                            </details>
                            <details>
                                <summary>Can I partner with Trade CVD?</summary>
                                <p>
                                    Yes. Send us a message with details about your business and the partnership you have
                                    in mind.
                                </p>
                            </details>
                            <details>
                                <summary>What kind of support do you offer?</summary>
                                <p>
                                    We can help with platform questions, account access, listings, and partnership
                                    inquiries.
                                </p>
                            </details>
                            <details>
                                <summary>Is my information kept private?</summary>
                                <p>
                                    We use your contact details to respond to your inquiry. Please review our Privacy
                                    Policy for details.
                                </p>
                            </details>
                        </div>
                    </section>
                </section>
            </main>
            <!-- Footer Start -->
            <?php include('footer.php'); ?>
            <!-- Footer End -->

            <!-- JS Start -->
            <?php include('js.php'); ?>
            <!-- JS End -->
        </div>
        <script>
            $(document).ready(function () {
                // The reference layout uses its own compact hero; retain the existing content API below.
                fillcontentsetting();
            });
            function fillcontentsetting() {
                var pagename = getpagename();
                var headersdata = {
                    Accept: "application/json",
                    platform: 4,
                    userpagename: pagename,
                    useraction: "",
                    masterlisting: false,
                };

                formdata = new FormData();
                formdata.append("action", "listcontentsetting");
                formdata.append("typeid", 24);

                ajaxrequest(
                    "POST",
                    "<?php echo $config->getEndpointurl(); ?>" + "contentsetting",
                    formdata,
                    headersdata,
                    Onsuccessfillcontentsetting,
                    OnErrorfillcontentsetting
                );
                function Onsuccessfillcontentsetting(content) {
                    var JsonData = JSON.stringify(content);
                    var resultdata = jQuery.parseJSON(JsonData);

                    if (resultdata.status == 0) {
                        /*  htmldata+='<div class="col-exs-12 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3 text-center" >';
                     htmldata+='<h3>No Data Found!</h3>';
                     htmldata+='</div>'; */
                    } else if (resultdata.status == 1) {
                    }
                }

                function OnErrorfillcontentsetting(content) {
                    ajaxrequest(
                        "POST",
                        "'<?php echo $config->getPage404url(); ?>'",
                        "",
                        "",
                        OnsuccessRender,
                        OnErrorRender
                    );
                }

                fillphonecode();
            }
            //Fill phone Code
            function fillphonecode() {
                var pagename = getpagename();
                var headersdata = {
                    Accept: "application/json",
                    platform: 4,
                    userpagename: pagename,
                    useraction: "",
                    masterlisting: true,
                    responsetype: "HTML",
                };

                formdata = new FormData();
                formdata.append("action", "listcountrycode");

                ajaxrequest(
                    "POST",
                    "<?php echo $config->getEndpointurl(); ?>" + "master",
                    formdata,
                    headersdata,
                    Onsuccessfillfillphonecode,
                    OnErrorfillfillphonecode
                );
                function Onsuccessfillfillphonecode(content) {
                    var JsonData = JSON.stringify(content);
                    var resultdata = jQuery.parseJSON(JsonData);
                    $("#phonecodeid").html(resultdata.data);
                    // $('#phonecodeid').selectpicker('refresh');
                }

                function OnErrorfillfillphonecode(content) {
                    ajaxrequest(
                        "POST",
                        "'<?php echo $config->getPage404url(); ?>'",
                        "",
                        "",
                        OnsuccessRender,
                        OnErrorRender
                    );
                }

                listcountry();
            }
            //Fill Country
            function listcountry() {
                var pagename = getpagename();
                var headersdata = {
                    Accept: "application/json",
                    platform: 4,
                    userpagename: pagename,
                    useraction: "",
                    masterlisting: true,
                    responsetype: "HTML",
                };

                formdata = new FormData();
                formdata.append("action", "listcountry");

                ajaxrequest(
                    "POST",
                    "<?php echo $config->getEndpointurl(); ?>" + "master",
                    formdata,
                    headersdata,
                    Onsuccesslistcountry,
                    OnErrorlistcountry
                );
                function Onsuccesslistcountry(content) {
                    var JsonData = JSON.stringify(content);
                    var resultdata = jQuery.parseJSON(JsonData);
                    $("#countryid").html(resultdata.data);
                    // $('#countryid').selectpicker('refresh');
                }

                function OnErrorlistcountry(content) {
                    ajaxrequest(
                        "POST",
                        "'<?php echo $config->getPage404url(); ?>'",
                        "",
                        "",
                        OnsuccessRender,
                        OnErrorRender
                    );
                }

                fillprimarycompanytype();
            }
            //Fill Primary Company Type
            function fillprimarycompanytype() {
                var pagename = getpagename();
                var headersdata = {
                    Accept: "application/json",
                    platform: 4,
                    userpagename: pagename,
                    useraction: "",
                    masterlisting: true,
                    responsetype: "HTML",
                };

                formdata = new FormData();
                formdata.append("action", "listprimarycompanytype");

                ajaxrequest(
                    "POST",
                    "<?php echo $config->getEndpointurl(); ?>" + "master",
                    formdata,
                    headersdata,
                    Onsuccesslistprimarycompanytype,
                    OnErrorlistprimarycompanytype
                );
                function Onsuccesslistprimarycompanytype(content) {
                    var JsonData = JSON.stringify(content);
                    var resultdata = jQuery.parseJSON(JsonData);
                    $("#primarycmptypeid").html(resultdata.data);
                    // $('#primarycmptypeid').selectpicker('refresh');
                }

                function OnErrorlistprimarycompanytype(content) {
                    ajaxrequest(
                        "POST",
                        "'<?php echo $config->getPage404url(); ?>'",
                        "",
                        "",
                        OnsuccessRender,
                        OnErrorRender
                    );
                }
            }
            if ($("#contactusForm").length) {
                $("#contactusForm").validate({
                    rules: {
                        cffname: {
                            required: true,
                        },
                        cflname: {
                            required: true,
                        },
                        cfcemail: {
                            required: true,
                            email: true,
                        },
                        cfphone: {
                            required: true,
                            maxlength: 15,
                        },
                        message: {
                            required: true,
                        },
                        privacyconsent: { required: true },
                    },
                    messages: {
                        cffname: {
                            required: "First Name is required",
                        },
                        cflname: {
                            required: "Last Name is required",
                        },
                        cfcemail: {
                            required: "Company Email is required",
                        },
                        cfphone: {
                            required: "Phone No is required",
                        },
                        message: {
                            required: "Message is required",
                        },
                        privacyconsent: { required: "Please agree to the Privacy Policy" },
                    },
                    submitHandler: function (form) {
                        var phonecode = $("#phonecodeid :selected").text();
                        var primarycmptype = "";
                        var country = "";
                        if ($("#primarycmptypeid :selected").val() != "") {
                            var primarycmptype = $("#primarycmptypeid :selected").text();
                        }
                        if ($("#countryid :selected").val() != "") {
                            var country = $("#countryid :selected").text();
                        }
                        var pagename = getpagename();
                        var useraction = "addright";
                        formdata = new FormData(form);
                        formdata.append("action", "insertcontactdata");
                        formdata.append("phonecode", phonecode);
                        formdata.append("primarycmptype", primarycmptype);
                        formdata.append("country", country);
                        var headersdata = {
                            Accept: "application/json",
                            platform: 4,
                            userpagename: pagename,
                            useraction: useraction,
                            masterlisting: false,
                        };
                        ajaxrequest(
                            "POST",
                            "<?php echo $config->getEndpointurl(); ?>" + "contactus",
                            formdata,
                            headersdata,
                            OnsuccesscontactusDataSubmit,
                            OnErrorcontactus
                        );

                        function OnsuccesscontactusDataSubmit(data) {
                            var JsonData = JSON.stringify(data);
                            var resultdata = jQuery.parseJSON(JsonData);
                            // $('.preloader').hide();

                            if (resultdata.status == 0) {
                                // alertify(resultdata.message,0);
                            } else if (resultdata.status == 1) {
                                $("#contactusForm").validate().resetForm();
                                $("#contactusForm").trigger("reset");
                                Notiflix.Notify.Success(resultdata.message);
                            }
                        }

                        function OnErrorcontactus(content) {
                            ajaxrequest(
                                "POST",
                                "'<?php echo $config->getPage404url(); ?>'",
                                "",
                                "",
                                OnsuccessRender,
                                OnErrorRender
                            );
                        }
                    },
                });
            }
        </script>
    </body>
</html>
