<?php require_once 'config/init.php'; 
 require_once 'config/apiconfig.php'; 
 $res=$DB->getpagemetadata(8);
$termsLastUpdated = 'October 7, 2026';
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

<body class="terms-conditions">
    <div class="page-wrapper">
        <!-- Header Start -->
        <?php include('header.php'); ?>
        <!-- Header End -->
        <div class="main page-title" id="web-content">
        <section class="why-savani-sec section-space terms-condition-main-section commonbannerimg" style="">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="savani-info">
                                <div class="savani-title">
			             <p>TRUSTED MARKETPLACE FOR A BRIGHTER TOMOOROW</p>
                                    <h1 class="sec-title commonbannertitle"><!-- Terms And Conditions --></h1>
                                </div>
                                <div class="commonbannerdescr">
                                    <!-- <p class="sec-desc-pra">Trade CVD is the industry’s largest and most <br /> trusted marketplace for diamonds and <br /> jewelry</p>
                                    <p class="sec-desc-pra">Trade CVD is the industry’s largest and most <br /> trusted marketplace for diamonds and <br /> jewelry</p> -->
                                </div>
                               <div class="terms-last-updated mt-3 d-flex align-items-center">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 11h18M8 15h3M8 18h5"/></svg>
                                    <span class="ml-2"><strong>Last updated :</strong> <?php echo htmlspecialchars($termsLastUpdated, ENT_QUOTES, 'UTF-8'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
             <section class="informative-data section-space pb-0">
                <div class="container">
                    <div class="terms-content-card">
                       <!-- <div class="informative-section" id="termsandcondition"> -->
             <div class="informative-section termsandcondition">
                        <h2 class="terms-section-title">Introduction</h2><p>These Terms &amp; Conditions (“Terms”) govern your use of the Trade CVD website, marketplace and member portal (collectively, the “Platform”). By accessing or using our Platform, you agree to be bound by these Terms.</p>
                        <div class="terms-notice"><span class="terms-notice-icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#669934" stroke-width="1.7" aria-hidden="true"><path d="m4 10 13-5v14L4 14v-4Z"/><path d="M4 10H2v4h2M7 15l2 6h3l-2-5M21 9v6"/></svg></span><div class="terms-notice-body"><h3>Marketplace Notice</h3><p>Trade CVD acts as a technology platform that connects verified buyers and sellers of diamonds, gemstones and jewellery. We do not own, manufacture or take physical possession of the products listed on the Platform.</p></div></div>
                        <h2 class="terms-section-title">Eligibility</h2><p>You must be at least 18 years old and capable of entering into a legally binding agreement to use this Platform. By using Trade CVD, you represent and warrant that you meet these eligibility requirements.</p>
                        <h2 class="terms-section-title">Account Registration</h2><p>To access certain features, you must create an account and provide accurate, complete and up-to-date information. You are responsible for maintaining the confidentiality of your account credentials and for all activities under your account.</p>
                        <h2 class="terms-section-title">Listings &amp; Product Accuracy</h2><p>Sellers are responsible for ensuring that all product information, including descriptions, images, specifications, certifications and pricing, is accurate and not misleading. Trade CVD does not guarantee the accuracy of listings.</p>
                        <h2 class="terms-section-title">Buyer Responsibilities</h2><p>Buyers are responsible for conducting their own due diligence before making a purchase. This includes verifying product details, certifications and seller credibility. All transactions are entered into at the buyer’s own risk.</p>
                        <h2 class="terms-section-title">Seller Responsibilities</h2><p>Sellers must comply with all applicable laws and regulations, including those related to the trade of diamonds, gemstones and jewellery. You must only list genuine products and provide valid certificates where applicable.</p>
                        <h2 class="terms-section-title">Membership Plans</h2><p>Trade CVD offers different membership plans with varying features and benefits. Fees, features and eligibility criteria for each plan are described on the Membership page and may be updated from time to time.</p>
                        <h2 class="terms-section-title">Payments &amp; Billing</h2><p>Membership fees and any applicable service charges are billed as specified at the time of purchase. All payments are processed securely through our authorised payment partners. Fees are non-refundable, except as required by law.</p>
                        <h2 class="terms-section-title">Shipping &amp; Delivery</h2><p>Shipping and delivery terms are agreed between the buyer and seller. Trade CVD is not responsible for delays, loss or damage during transit. We encourage the use of insured and trackable shipping methods for high-value items.</p>
                        <h2 class="terms-section-title">Prohibited Conduct</h2><p>You agree not to use the Platform for any unlawful purpose, to list counterfeit or misrepresented products, or to engage in fraudulent, abusive or harmful conduct. Trade CVD reserves the right to suspend or terminate accounts that violate these Terms.</p>
                        <h2 class="terms-section-title">Intellectual Property</h2><p>All content on the Trade CVD Platform, including text, graphics, logos and software, is the property of Trade CVD or its licensors and is protected by intellectual property laws. You may not use our content without prior written permission.</p>
                        <h2 class="terms-section-title">Liability</h2><p>To the maximum extent permitted by law, Trade CVD shall not be liable for any indirect, incidental or consequential damages arising from your use of the Platform, including any disputes between buyers and sellers.</p>
                        <div class="terms-notice terms-notice--warning"><span class="terms-notice-icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path d="M12 3 20 6v6c0 5-8 9-8 9s-8-4-8-9V6l8-3Z"/><path d="m8 12 3 3 5-6"/></svg></span><div class="terms-notice-body"><h3>Important Disclosure</h3><p>Users must independently verify whether a diamond is natural or laboratory-grown and confirm the authenticity of all certificates (e.g., GIA, IGI) before making a purchase. Trade CVD does not guarantee or certify the origin, authenticity or grading of any diamond or gemstone listed on the Platform.</p></div></div>
                        <h2 class="terms-section-title">Privacy</h2><p>Your use of the Platform is also governed by our Privacy Policy, which explains how we collect, use and protect your personal information.</p>
                        <h2 class="terms-section-title">Governing Law</h2><p>These Terms shall be governed by and construed in accordance with the laws of the jurisdiction in which Trade CVD operates, without regard to its conflict of law principles.</p>
                        <h2 class="terms-section-title">Contact Us</h2><p>If you have any questions about these Terms, please contact our team at <a href="mailto:support@tradecvd.com">support@tradecvd.com</a>.</p>
                      </div> 
                    </div>
                </div>
            </section>
 <section class="terms-support-bottom" aria-labelledby="terms-support-title">
<div class="container">
<div class="terms-support">
                        <span class="terms-support-icon">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 13v-2a8 8 0 0 1 16 0v2"/><rect x="2" y="11" width="4" height="7" rx="2"/><rect x="18" y="11" width="4" height="7" rx="2"/><path d="M20 18v1a2 2 0 0 1-2 2h-4"/><rect x="10" y="19" width="4" height="3" rx="1"/></svg>
                        </span>
                        <div class="terms-support-copy">
                            <h2 id="terms-support-title">Need help understanding our terms?</h2>
                            <p>Our support team is here to assist you with any questions.</p>
                        </div>
                        <a class="terms-support-button" href="mailto:support@tradecvd.com">Contact Support <span aria-hidden="true">&rarr;</span></a>
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
            fillbannerdetail(1);
            fillcontentsetting();
        });
        function fillcontentsetting()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false};

            formdata = new FormData();
            formdata.append("action", "listcontentsetting");
            formdata.append("typeid", 1);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'contentsetting',formdata,headersdata,Onsuccessfillcontentsetting,OnErrorfillcontentsetting);
        }

        function Onsuccessfillcontentsetting(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata='';
            if(resultdata.status==0)
            {
                htmldata+='<div class="col-exs-12 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3 text-center" >';
                htmldata+='<h3>No Data Found!</h3>';
                htmldata+='</div>';
                $('#termsandcondition').html(htmldata);
            }
            else if(resultdata.status==1)
            {
                $('#termsandcondition').html(resultdata.result[0].description);
            }

        }

        function OnErrorfillcontentsetting(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    </script>
</body>

</html>




