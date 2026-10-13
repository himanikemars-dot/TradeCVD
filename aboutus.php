<?php require_once 'config/init.php'; 
 require_once 'config/apiconfig.php'; 
 $res=$DB->getpagemetadata(3);
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

<body class="aboutus max-w-2560px">
    <div class="page-wrapper">
        <!-- Header Start -->
        <?php include('header.php'); ?>
        <!-- Header End -->
        <div class="main page-title" id="web-content">
            <!-- <section class="why-savani-sec section-space commonbannerimg" style="">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="savani-info">
                                <div class="savani-title">
                                    <h1 class="sec-title text-white commonbannertitle">Let's connect in Trade CVD</h1>
                                </div>
                                <div class="savani-desc commonbannerdescr">
                                    <p class="sec-desc-pra">Trade CVD is the industry’s largest and most <br /> trusted marketplace for diamonds and <br /> jewelry</p>
                                    <p class="sec-desc-pra">Trade CVD is the industry’s largest and most <br /> trusted marketplace for diamonds and <br /> jewelry</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            
            		
	<section class="why-savani-sec section-space commonbannerimg about-trade-banner">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-7">
                            <div class="about-banner-content">
                                <div class="about-banner-label">About Trade CVD</div>
                                <h1 class="about-banner-title">
                                    Built on Trust.
                                    <span>Driven by Innovation.</span>
                                </h1>
                                <p class="about-banner-description">
                                    Connecting verified diamond and jewellery professionals worldwide through a trusted, transparent and technology-driven marketplace.
                                </p>
                                <div class="about-banner-actions">
                                    <a class="about-banner-btn primary" href="<?php echo $config->getWeburl(); ?>diamond-search">
                                        Explore the Marketplace <i class="far fa-arrow-right fa"></i>
                                    </a>
                                    <a class="about-banner-btn" href="<?php echo $config->getWeburl(); ?>our-advantage">
                                        Our Advantage
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

<section class="about-trust-strip" aria-label="Trade CVD marketplace benefits">
                <div class="container">
                    <div class="trust-strip-inner">
                        <div class="trust-strip-item">
                            <div class="trust-strip-icon" aria-hidden="true">
                                <i class="fas fa-globe fa"></i>
                            </div>
                            <div class="trust-strip-content">
                                <h2 class="trust-strip-title">Global Network</h2>
                                <p class="trust-strip-text">A truly international community<br>of diamond and jewellery professionals.</p>
                            </div>
                        </div>

                        <div class="trust-strip-item">
                            <div class="trust-strip-icon" aria-hidden="true">
                                <i class="fas fa-users fa"></i>
                            </div>
                            <div class="trust-strip-content">
                                <h2 class="trust-strip-title">Verified Members</h2>
                                <p class="trust-strip-text">Trade with confidence through<br>our verification process.</p>
                            </div>
                        </div>

                        <div class="trust-strip-item">
                            <div class="trust-strip-icon" aria-hidden="true">
                                <i class="fas fa-shield fa"></i>
                            </div>
                            <div class="trust-strip-content">
                                <h2 class="trust-strip-title">Secure Marketplace</h2>
                                <p class="trust-strip-text">A safe and reliable platform<br>for your business.</p>
                            </div>
                        </div>

                        <div class="trust-strip-item">
                            <div class="trust-strip-icon" aria-hidden="true">
                                <i class="fa-solid fa-headphones fa"></i>
                            </div>
                            <div class="trust-strip-content">
                                <h2 class="trust-strip-title">Dedicated Support</h2>
                                <p class="trust-strip-text">Our team is here to help,<br>wherever you are in the world.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

<section class="smarter-trade-section" aria-labelledby="smarter-trade-title">
                <div class="smarter-trade-grid">
                    <div class="smarter-trade-image" role="img" aria-label="Diamond being inspected by a jewellery professional">
                        <div class="image-caption">
                            Details<br>
                            Create<br>
                            Opportunities
                        </div>
                    </div>

                    <div class="smarter-trade-content">
                        <div class="smarter-trade-inner">
                            <h2 class="smarter-trade-title" id="smarter-trade-title">A Smarter Way to Trade</h2>
                            <div class="smarter-trade-copy">
                                <p>
                                    Trade CVD was built to modernise the way diamonds and jewellery professionals connect.
                                    We bring together a global community of verified buyers and sellers, making it easier,
                                    faster and safer to trade with confidence.
                                </p>
                                <p>
                                    By combining industry expertise with innovative technology, we remove unnecessary
                                    barriers and create a more transparent, efficient and trusted trading experience
                                    for businesses everywhere.
                                </p>
                                <div class="smarter-trade-signature">Connecting trade. Creating opportunity.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

  <section class="stand-for-section" aria-labelledby="stand-for-heading">
                <div class="container">
                    <h2 class="stand-for-heading" id="stand-for-heading">What We Stand For</h2>
                    <div class="stand-for-grid">
                        <article class="stand-for-card">
                            <div class="stand-for-icon" aria-hidden="true"><img src="assets\images\diamond-img.svg"></div>
                            <div class="stand-for-card-content">
                                <h3 class="stand-for-card-title">Transparency</h3>
                                <p class="stand-for-card-text">Clear information and open communication build stronger, lasting partnerships.</p>
                            </div>
                        </article>
                        <article class="stand-for-card">
                            <div class="stand-for-icon" aria-hidden="true"><i class="fas fa-cog fa"></i></div>
                            <div class="stand-for-card-content">
                                <h3 class="stand-for-card-title">Simplicity</h3>
                                <p class="stand-for-card-text">An intuitive and efficient trading experience, designed to save you time.</p>
                            </div>
                        </article>
                        <article class="stand-for-card">
                            <div class="stand-for-icon" aria-hidden="true"><i class="fas fa-shield fa"></i></div>
                            <div class="stand-for-card-content">
                                <h3 class="stand-for-card-title">Security</h3>
                                <p class="stand-for-card-text">Your data is protected and every interaction is secure, so you can trade with confidence.</p>
                            </div>
                        </article>
                        <article class="stand-for-card">
                            <div class="stand-for-icon" aria-hidden="true"><img src="assets\images\chart.svg"></div>
                            <div class="stand-for-card-content">
                                <h3 class="stand-for-card-title">Empowering Growth</h3>
                                <p class="stand-for-card-text">The tools and connections you need to scale your business and seize new opportunities.</p>
                            </div>
                        </article>
                    </div>
                </div>
            </section>

<section class="technology-works-section" aria-labelledby="technology-works-title">
                <div class="technology-works-grid">
		<div class="container">
                    <div class="technology-works-content">
                        <div class="technology-works-inner">
                            <div class="technology-works-copy">
                                <h2 class="technology-works-title" id="technology-works-title">Technology That Works for You</h2>
                                <p class="technology-works-description">
                                    We combine industry knowledge with smart technology to give you a seamless trading
                                    experience. From powerful search tools to direct member connections, Trade CVD
                                    makes it easier to find the right opportunities, faster.
                                </p>
                            </div>

                            <ul class="technology-works-list">
                                <li><span class="technology-check"><i class="fas fa-check"></i></span>Powerful search</li>
                                <li><span class="technology-check"><i class="fas fa-check"></i></span>Direct member connections</li>
                                <li><span class="technology-check"><i class="fas fa-check"></i></span>Streamlined listings</li>
                                <li><span class="technology-check"><i class="fas fa-check"></i></span>Global accessibility</li>
                            </ul>
                        </div>
                    </div>

                    <div class="technology-works-image" role="img" aria-label="Loose diamonds and professional jewellery inspection tools">
                        <div class="technology-image-caption">
                            People<br>
                            Products<br>
                            Possibilities
                        </div>
                    </div>
		</div>
                </div>
            </section>

            <!-- <section class="about-sec section-space aboutdetailDiv">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12  text-center">
                            <div class="content-box">
                                <div class="content-box-inner align-center">
                                    <div class="content-svg-box md-logo  black-fill">
                                        <div class="content-svg">
                                            <svg id="09f3a4cf-20a1-4aed-848e-dbc14dfd6470" data-name="860b528d-b7c9-4a94-aec8-3a94175328dd" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 342.58 272.62"><defs><style>//.\33 89600a9-b8cb-4f1f-ab5f-0b45cb9fa03c{fill:#1c191a;}</style></defs><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M170.65,272.67l-.86-1L0,83l.13-8.16.26-.31L62.18.05H276.95l65.12,73.92.51,8.18-.33.36ZM2.32,82.17,170.66,269.22l169.56-188-.4-6.42L275.88,2.3,63.23,2.36,2.42,75.72Z" transform="translate(0 -0.05)"></path><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M78.55,66.69H75.26V78h3.29a5.67,5.67,0,0,0,0-11.34h0m0,14H72.33V64h6.22c5.24,0,8.86,3.59,8.86,8.31s-3.62,8.36-8.86,8.36" transform="translate(0 -0.05)"></path><rect class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" x="103.9" y="63.97" width="2.93" height="16.67"></rect><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M131.29,67.4l-2.86,6.67h5.74Zm8.74,13.29h-3.1l-1.69-4h-7.89l-1.71,4h-3l7.34-16.79h2.72Z" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="163.86 76.55 163.76 76.55 158.54 68.74 158.54 80.65 155.66 80.65 155.66 63.97 158.79 63.97 163.86 71.86 168.93 63.97 172.06 63.97 172.06 80.65 169.12 80.65 169.12 68.69 163.86 76.55"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M197.07,66.43a5.65,5.65,0,0,0-5.63,5.65v.26a5.72,5.72,0,0,0,5.4258,6l.0042,0h.24a5.65,5.65,0,0,0,5.63-5.65v-.26a5.72,5.72,0,0,0-5.4258-6l-.0042,0h-.24m0,14.56a8.62,8.62,0,1,1,8.74-8.65,8.47,8.47,0,0,1-8.28,8.65h-.46" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="233.78 63.97 236.67 63.97 236.67 80.65 234.21 80.65 225.02 68.78 225.02 80.65 222.14 80.65 222.14 63.97 224.85 63.97 233.78 75.5 233.78 63.97"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M259.95,66.69h-3.29V78h3.29a5.67,5.67,0,0,0,0-11.34h0m0,14h-6.22V64h6.22c5.24,0,8.86,3.59,8.86,8.31s-3.62,8.36-8.86,8.36" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="102.1 35.95 103.16 35.95 104.92 41.27 106.63 35.97 107.95 35.97 105.45 43.17 104.37 43.17 102.61 38.03 100.85 43.17 99.77 43.17 97.27 35.97 98.63 35.97 100.34 41.27 102.1 35.95"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M115.45,37a2.41,2.41,0,0,0-2.41,2.41v.12a2.46,2.46,0,0,0,2.3559,2.56l.0041,0h.07a2.42,2.42,0,0,0,2.41-2.43h0a2.47,2.47,0,0,0-2.2676-2.657L115.57,37h-.12m0,6.25a3.7,3.7,0,1,1,3.76-3.71,3.64,3.64,0,0,1-3.5686,3.71H115.45" transform="translate(0 -0.05)"></path><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M127.01,37.16h-1.83v2.4h1.84a1.27,1.27,0,0,0,1.45-1,.9939.9939,0,0,0,0-.16,1.24,1.24,0,0,0-1.23-1.23.996.996,0,0,0-.25,0m1.5,6-1.76-2.49h-1.55v2.49h-1.3V36h3.19c1.64,0,2.66.87,2.66,2.27a2.14,2.14,0,0,1-1.71,2.18l1.93,2.71h-1.44Z" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="134.52 35.97 135.77 35.97 135.77 41.98 139.54 41.98 139.54 43.12 134.52 43.12 134.52 35.97"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M146.71,37.16H145.3V42h1.41a2.44,2.44,0,0,0,0-4.87m0,6h-2.67V36h2.67a3.59,3.59,0,0,1,.54,7.16,4.8638,4.8638,0,0,1-.54,0" transform="translate(0 -0.05)"></path><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M164.88,43.3a3.7,3.7,0,1,1,2.8-6.3l-.81.93a2.85,2.85,0,0,0-2-.89,2.55,2.55,0,0,0,0,5.09,2.81,2.81,0,0,0,2-.93l.82.79a3.69,3.69,0,0,1-2.81,1.31" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="173.52 40.11 173.52 43.12 172.26 43.12 172.26 35.97 173.52 35.97 173.52 38.94 176.93 38.94 176.93 35.97 178.19 35.97 178.19 43.12 176.93 43.12 176.93 40.11 173.52 40.11"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M186.33,37.47l-1.23,2.86h2.46Zm3.75,5.71h-1.33l-.73-1.73h-3.39l-.75,1.72h-1.29L185.76,36h1.12Z" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="199.5 35.97 200.74 35.97 200.74 43.12 199.69 43.12 195.74 38.03 195.74 43.12 194.5 43.12 194.5 35.97 195.67 35.97 199.5 40.92 199.5 35.97"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M209.17,43.3a3.55,3.55,0,0,1-3.71-3.38v-.31a3.65,3.65,0,0,1,3.589-3.71h.101a3.87,3.87,0,0,1,2.75,1l-.8,1a2.81,2.81,0,0,0-2-.77,2.56,2.56,0,0,0,.11,5.1,2.89,2.89,0,0,0,1.73-.54V40.27h-1.83v-1.1h3v3a4.58,4.58,0,0,1-3,1.11" transform="translate(0 -0.05)"></path><rect class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" x="217.06" y="35.97" width="1.26" height="7.16"></rect><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="228.44 35.97 229.68 35.97 229.68 43.12 228.63 43.12 224.68 38.03 224.68 43.12 223.44 43.12 223.44 35.97 224.61 35.97 228.44 40.92 228.44 35.97"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M238.11,43.3a3.55,3.55,0,0,1-3.71-3.38v-.31a3.65,3.65,0,0,1,3.589-3.71h.101a3.87,3.87,0,0,1,2.75,1l-.8,1a2.81,2.81,0,0,0-2-.77,2.56,2.56,0,0,0,.11,5.1,2.9092,2.9092,0,0,0,1.73-.54V40.27h-1.83v-1.1h3v3a4.58,4.58,0,0,1-3,1.11" transform="translate(0 -0.05)"></path><rect class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" x="151.37" y="152.23" width="1.25" height="1.29"></rect><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="162.6 151.39 158.89 151.39 158.89 153.09 162.18 153.09 162.18 154.12 158.89 154.12 158.89 155.88 162.65 155.88 162.65 156.91 157.74 156.91 157.74 150.36 162.6 150.36 162.6 151.39"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M170.18,153.16c1.39.34,2.11.83,2.11,1.93a2.16,2.16,0,0,1-2.3067,2.0026l-.0333-.0026a4,4,0,0,1-2.73-1.05l.69-.82a3,3,0,0,0,2.07.85,1,1,0,0,0,1.16-.8092V155.26h0c0-.48-.26-.73-1.48-1-1.4-.34-2.18-.75-2.18-2a2,2,0,0,1,2.07-1.92h.17a3.61,3.61,0,0,1,2.38.82l-.62.87a3,3,0,0,0-1.78-.68.91.91,0,0,0-1.06.73v.06c0,.52.3.74,1.56,1" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="179.91 156.91 178.75 156.91 178.75 151.42 176.67 151.42 176.67 150.36 182 150.36 182 151.42 179.91 151.42 179.91 156.91"></polygon><rect class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" x="186.08" y="152.23" width="1.25" height="1.29"></rect><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="163.2 195.99 163.17 195.99 161.69 193.76 161.69 197.16 160.86 197.16 160.86 192.4 161.76 192.4 163.2 194.66 164.65 192.4 165.54 192.4 165.54 197.16 164.7 197.16 164.7 193.75 163.2 195.99"></polygon><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="172.38 197.16 171.37 197.16 169.75 195.02 169.01 195.78 169.01 197.16 168.17 197.16 168.17 192.4 169.01 192.4 169.01 194.8 171.27 192.4 172.3 192.4 170.32 194.45 172.38 197.16"></polygon><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="178.03 193.15 175.34 193.15 175.34 194.39 177.72 194.39 177.72 195.14 175.34 195.14 175.34 196.41 178.06 196.41 178.06 197.16 174.51 197.16 174.51 192.4 178.03 192.4 178.03 193.15"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M146.43,169.55l-1.29-1a3.48,3.48,0,0,1,3.11-1.72,2.55,2.55,0,0,1,2.84,2.22,2.1637,2.1637,0,0,1,0,.36c0,1.39-.71,2.09-2.19,3.23l-1.35,1h3.62v1.58h-6.16v-1.45l2.77-2.27c1-.86,1.44-1.31,1.44-2a1,1,0,0,0-.91-1.08h-.21a2.18,2.18,0,0,0-1.7,1.12" transform="translate(0 -0.05)"></path><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M162.6,168.42c-1.11,0-1.81,1.11-1.81,2.64s.73,2.66,1.83,2.66,1.81-1.12,1.81-2.64-.73-2.66-1.83-2.66m0,7c-2.22,0-3.69-1.86-3.69-4.29s1.49-4.31,3.71-4.31,3.68,1.86,3.68,4.29-1.49,4.31-3.71,4.31" transform="translate(0 -0.05)"></path><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M177.68,168.42c-1.11,0-1.81,1.11-1.81,2.64s.73,2.66,1.83,2.66,1.81-1.12,1.81-2.64-.73-2.66-1.83-2.66m0,7c-2.22,0-3.69-1.86-3.69-4.29s1.49-4.31,3.71-4.31,3.68,1.86,3.68,4.29-1.49,4.31-3.71,4.31" transform="translate(0 -0.05)"></path><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M189.74,166.91h5.14v1.6h-3.54l-.12,1.49a4,4,0,0,1,1.09-.14c1.64,0,2.91.78,2.91,2.67a2.84,2.84,0,0,1-2.7683,2.91H192.06a4.3,4.3,0,0,1-3.11-1.25l1.11-1.32a2.91,2.91,0,0,0,2,.9,1.17,1.17,0,0,0,1.3668-.9325l.0032-.0175a1.6481,1.6481,0,0,0,0-.22,1.24,1.24,0,0,0-1.3148-1.16l-.0052,0h-.15a3.5187,3.5187,0,0,0-1.39.31l-1.06-.7Z" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="132 95.98 133.31 95.98 133.31 107.89 132.23 107.89 124.54 98.12 124.54 107.89 123.23 107.89 123.23 95.98 124.49 95.98 132 105.53 132 95.98"></polygon><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="154.41 97.2 147.14 97.2 147.14 101.27 153.64 101.27 153.64 102.5 147.14 102.5 147.14 106.67 154.5 106.67 154.5 107.89 145.8 107.89 145.8 95.98 154.41 95.98 154.41 97.2"></polygon><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="174.59 107.89 170.78 102.77 166.97 107.89 165.42 107.89 170 101.81 165.59 95.98 167.17 95.98 170.83 100.85 174.46 95.98 176.02 95.98 171.61 101.8 176.19 107.89 174.59 107.89"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M197.35,102.85c0,3.47-2,5.28-5,5.28s-5-1.8-5-5.17v-7h1.35v6.84c0,2.57,1.36,4,3.64,4s3.59-1.33,3.59-3.93V96h1.35v6.83Z" transform="translate(0 -0.05)"></path><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M213.88,101.34c2.65.58,3.88,1.55,3.88,3.39,0,2.06-1.7,3.39-4.07,3.39a7,7,0,0,1-4.81-1.92l.83-1a5.7,5.7,0,0,0,4.09,1.69c1.6,0,2.65-.83,2.65-2s-.59-1.75-3.1-2.28c-2.74-.6-4-1.48-4-3.46s1.65-3.27,3.92-3.27a6.27,6.27,0,0,1,4.19,1.46l-.78,1a5.24,5.24,0,0,0-3.44-1.29c-1.55,0-2.53.85-2.53,1.94s.61,1.77,3.23,2.33" transform="translate(0 -0.05)"></path><rect class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" x="115.51" y="127.38" width="111.65" height="2.31"></rect></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-7 m-auto">
                            <div class="welcome-to-info text-center">
                                <div class="sec-title">
                                    <h2>Welcome to Diamond Trade CVD. Ready to <br />discover something special?</h2>
                                </div>
                                <div class="welcome-desc"><p class="sec-desc">We are inspired by fine jewelry. It is given as a symbol of love, worn to inspire confidence, passed from one generation to the next.</p></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 m-auto text-center">
                            <div class="sec-title">
                                <div class="things-sec">
                                    <h3 class="sec-title text-black">We believe in three things:</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </section> -->
            <!-- <div id="believethigsdetail">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 m-auto text-center">
                            <div class="sec-title">
                                <div class="things-sec">
                                    <h3 class="sec-title text-black">We believe in three things:</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="feature-background__area bg-bg-pink">
                    <div class="row no-gutters">
                        <div class="col-md-6 wow fadeInLeft order-lg-1" data-wow-delay="200ms">
                            <div class="feature-background__image bg-img" data-bg="<?php echo $config->getimageurl() ?>images/about/about-bg.jpg"></div>
                        </div>
                        <div class="col-md-6 wow fadeInRight m-auto" data-wow-delay="200ms">
                            <div class="feature-background__content feature-background__content--style2">
                                <div class="section-title-area">
                                    <div class="number-icon-box">
                                        <div class="number-icon-text">1</div>
                                    </div>
                                    <div class="sec-title mb-4">
                                        <h2 class="text-black">No Mined Stones. Ever.</h2>
                                    </div>
                                    <div class="sec-data-desc">
                                        <p class="sec-desc">Diamonds are beautiful, but destructive—so we simulate their beauty with our patented Nexus Diamond™ alternative. It is a lab created diamond simulant that is conflict-free and environmentally superior because it’s not mined.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="feature-background__area bg-light-green">
                    <div class="row no-gutters">
                        <div class="col-md-6 wow fadeInLeft" data-wow-delay="200ms">
                            <div class="feature-background__image bg-img" data-bg="<?php echo $config->getimageurl() ?>images/about/about-bg-2.jpg"></div>
                        </div>
                        <div class="col-md-6 wow fadeInRight m-auto" data-wow-delay="200ms">
                            <div class="feature-background__content feature-background__content--style2">
                                <div class="section-title-area">
                                    <div class="number-icon-box">
                                        <div class="number-icon-text">2</div>
                                    </div>
                                    <div class="sec-title mb-4">
                                        <h2 class="text-black">Affordability</h2>
                                    </div>
                                    <div class="sec-data-desc">
                                        <p class="sec-desc">We reject the cultural pressure to spend $6,000 or more on an engagement ring. Instead, we believe in spending your hard earned money on life and experiences that create memories.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="feature-background__area bg-light-blue">
                    <div class="row no-gutters">
                        <div class="col-md-6 wow fadeInLeft order-lg-1" data-wow-delay="200ms">
                            <div class="feature-background__image bg-img" data-bg="<?php echo $config->getimageurl() ?>images/about/about-bg.jpg"></div>
                        </div>
                        <div class="col-md-6 wow fadeInRight m-auto" data-wow-delay="200ms">
                            <div class="feature-background__content feature-background__content--style2">
                                <div class="section-title-area">
                                    <div class="number-icon-box">
                                        <div class="number-icon-text">3</div>
                                    </div>
                                    <div class="sec-title mb-4">
                                        <h2 class="text-black">Quality Above All</h2>
                                    </div>
                                    <div class="sec-data-desc">
                                        <p class="sec-desc">Engagement rings and fine jewelry are passed down through generations. We use master craftsmen to create our pieces, and our stones are guaranteed forever.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>  -->
            <!-- <section class="miss-viss-sec section-space missionvisiondetail">
                <div class="container">
                    <div class="row  justify-content-center">
                        <div class="col-12 col-md-12">
                            <div class="row">
                                <div class="col-12 col-md-4 border-box-right missiondetail">
                                    <div class="miss-viss-info">
                                        <div class="miss-viss-img">
                                            <img src="" alt="" src="">
                                        </div>
                                        <div class="miss-viss-title">
                                            <h2 class="sec-desc">Mission</h2>
                                        </div>
                                        <div class="miss-viss-desc" id="missiondetail">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi excepturi natus dolore tempore expedita quae.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 border-box-right visiondetail">
                                    <div class="miss-viss-info">
                                        <div class="miss-viss-img">
                                            <img src="" alt="" src="">
                                        </div>
                                        <div class="miss-viss-title">
                                            <h2 class="sec-desc">Vision</h2>
                                        </div>
                                        <div class="miss-viss-desc" id="visiondetail">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi excepturi natus dolore tempore expedita quae.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 valuesdetail">
                                    <div class="miss-viss-info">
                                        <div class="miss-viss-img">
                                            <img src="" alt="" src="">
                                        </div>
                                        <div class="miss-viss-title">
                                            <h2 class="sec-desc">Values</h2>
                                        </div>
                                        <div class="miss-viss-desc" id="valuesdetail">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi excepturi natus dolore tempore expedita quae.</p>ZZZZZZZZZZ
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->

             <section class="miss-viss-sec section-space missionvisiondetail">
                <div class="container">
                    <div class="row missionvision-row">
                        <div class="col-12 col-lg-4 missiondetail">
                            <div class="miss-viss-info">
                                <div class="miss-viss-img"><i class="far fa-bullseye fa" aria-hidden="true"></i></div>
                                <div class="miss-viss-content">
                                    <h2 class="miss-viss-heading">Our Mission</h2>
                                    <div class="miss-viss-desc" id="missiondetail"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 visiondetail mt-4 mt-lg-0">
                            <div class="miss-viss-info">
                                <div class="miss-viss-img"><i class="far fa-binoculars fa" aria-hidden="true"></i></div>
                                <div class="miss-viss-content">
                                    <h2 class="miss-viss-heading">Our Vision</h2>
                                    <div class="miss-viss-desc" id="visiondetail"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 valuesdetail mt-4 mt-lg-0">
                            <div class="miss-viss-info">
                                <div class="miss-viss-img"><i class="far fa-users fa" aria-hidden="true"></i></div>
                                <div class="miss-viss-content">
                                    <h2 class="miss-viss-heading">Our Values</h2>
                                    <div class="miss-viss-desc" id="valuesdetail"></div>
                                </div>
                            </div>
                        </div>
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
        fillbannerdetail(5);
        fillcontentsetting();
    });
    function fillcontentsetting()
    {
        var pagename=getpagename();
        var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false};

        formdata = new FormData();
        formdata.append("action", "listcontentsetting");
        formdata.append("typeid", 5);

        ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'contentsetting',formdata,headersdata,Onsuccessfillcontentsetting,OnErrorfillcontentsetting);
        function Onsuccessfillcontentsetting(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata='';
            if(resultdata.status==0)
            {
                $('.aboutdetailDiv').addClass('d-none');
                $('.aboutdetailDiv').html(htmldata);
            }
            else if(resultdata.status==1)
            {
                $('.aboutdetailDiv').removeClass('d-none');
                htmldata+='<div class="container">';
                    htmldata+='<div class="row">';
                        // htmldata+='<div class="col-12 col-md-12  text-center">';
                        //     htmldata+='<div class="content-box">';
                        //         htmldata+='<div class="content-box-inner align-center">';
                        //             htmldata+='<div class="content-svg-box md-logo  black-fill">';
                        //                 htmldata+='<div class="content-svg">';
                        //                     // htmldata+='<svg id="09f3a4cf-20a1-4aed-848e-dbc14dfd6470" data-name="860b528d-b7c9-4a94-aec8-3a94175328dd" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 342.58 272.62"><defs><style>//.\33 89600a9-b8cb-4f1f-ab5f-0b45cb9fa03c{fill:#1c191a;}</style></defs><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M170.65,272.67l-.86-1L0,83l.13-8.16.26-.31L62.18.05H276.95l65.12,73.92.51,8.18-.33.36ZM2.32,82.17,170.66,269.22l169.56-188-.4-6.42L275.88,2.3,63.23,2.36,2.42,75.72Z" transform="translate(0 -0.05)"></path><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M78.55,66.69H75.26V78h3.29a5.67,5.67,0,0,0,0-11.34h0m0,14H72.33V64h6.22c5.24,0,8.86,3.59,8.86,8.31s-3.62,8.36-8.86,8.36" transform="translate(0 -0.05)"></path><rect class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" x="103.9" y="63.97" width="2.93" height="16.67"></rect><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M131.29,67.4l-2.86,6.67h5.74Zm8.74,13.29h-3.1l-1.69-4h-7.89l-1.71,4h-3l7.34-16.79h2.72Z" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="163.86 76.55 163.76 76.55 158.54 68.74 158.54 80.65 155.66 80.65 155.66 63.97 158.79 63.97 163.86 71.86 168.93 63.97 172.06 63.97 172.06 80.65 169.12 80.65 169.12 68.69 163.86 76.55"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M197.07,66.43a5.65,5.65,0,0,0-5.63,5.65v.26a5.72,5.72,0,0,0,5.4258,6l.0042,0h.24a5.65,5.65,0,0,0,5.63-5.65v-.26a5.72,5.72,0,0,0-5.4258-6l-.0042,0h-.24m0,14.56a8.62,8.62,0,1,1,8.74-8.65,8.47,8.47,0,0,1-8.28,8.65h-.46" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="233.78 63.97 236.67 63.97 236.67 80.65 234.21 80.65 225.02 68.78 225.02 80.65 222.14 80.65 222.14 63.97 224.85 63.97 233.78 75.5 233.78 63.97"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M259.95,66.69h-3.29V78h3.29a5.67,5.67,0,0,0,0-11.34h0m0,14h-6.22V64h6.22c5.24,0,8.86,3.59,8.86,8.31s-3.62,8.36-8.86,8.36" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="102.1 35.95 103.16 35.95 104.92 41.27 106.63 35.97 107.95 35.97 105.45 43.17 104.37 43.17 102.61 38.03 100.85 43.17 99.77 43.17 97.27 35.97 98.63 35.97 100.34 41.27 102.1 35.95"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M115.45,37a2.41,2.41,0,0,0-2.41,2.41v.12a2.46,2.46,0,0,0,2.3559,2.56l.0041,0h.07a2.42,2.42,0,0,0,2.41-2.43h0a2.47,2.47,0,0,0-2.2676-2.657L115.57,37h-.12m0,6.25a3.7,3.7,0,1,1,3.76-3.71,3.64,3.64,0,0,1-3.5686,3.71H115.45" transform="translate(0 -0.05)"></path><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M127.01,37.16h-1.83v2.4h1.84a1.27,1.27,0,0,0,1.45-1,.9939.9939,0,0,0,0-.16,1.24,1.24,0,0,0-1.23-1.23.996.996,0,0,0-.25,0m1.5,6-1.76-2.49h-1.55v2.49h-1.3V36h3.19c1.64,0,2.66.87,2.66,2.27a2.14,2.14,0,0,1-1.71,2.18l1.93,2.71h-1.44Z" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="134.52 35.97 135.77 35.97 135.77 41.98 139.54 41.98 139.54 43.12 134.52 43.12 134.52 35.97"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M146.71,37.16H145.3V42h1.41a2.44,2.44,0,0,0,0-4.87m0,6h-2.67V36h2.67a3.59,3.59,0,0,1,.54,7.16,4.8638,4.8638,0,0,1-.54,0" transform="translate(0 -0.05)"></path><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M164.88,43.3a3.7,3.7,0,1,1,2.8-6.3l-.81.93a2.85,2.85,0,0,0-2-.89,2.55,2.55,0,0,0,0,5.09,2.81,2.81,0,0,0,2-.93l.82.79a3.69,3.69,0,0,1-2.81,1.31" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="173.52 40.11 173.52 43.12 172.26 43.12 172.26 35.97 173.52 35.97 173.52 38.94 176.93 38.94 176.93 35.97 178.19 35.97 178.19 43.12 176.93 43.12 176.93 40.11 173.52 40.11"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M186.33,37.47l-1.23,2.86h2.46Zm3.75,5.71h-1.33l-.73-1.73h-3.39l-.75,1.72h-1.29L185.76,36h1.12Z" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="199.5 35.97 200.74 35.97 200.74 43.12 199.69 43.12 195.74 38.03 195.74 43.12 194.5 43.12 194.5 35.97 195.67 35.97 199.5 40.92 199.5 35.97"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M209.17,43.3a3.55,3.55,0,0,1-3.71-3.38v-.31a3.65,3.65,0,0,1,3.589-3.71h.101a3.87,3.87,0,0,1,2.75,1l-.8,1a2.81,2.81,0,0,0-2-.77,2.56,2.56,0,0,0,.11,5.1,2.89,2.89,0,0,0,1.73-.54V40.27h-1.83v-1.1h3v3a4.58,4.58,0,0,1-3,1.11" transform="translate(0 -0.05)"></path><rect class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" x="217.06" y="35.97" width="1.26" height="7.16"></rect><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="228.44 35.97 229.68 35.97 229.68 43.12 228.63 43.12 224.68 38.03 224.68 43.12 223.44 43.12 223.44 35.97 224.61 35.97 228.44 40.92 228.44 35.97"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M238.11,43.3a3.55,3.55,0,0,1-3.71-3.38v-.31a3.65,3.65,0,0,1,3.589-3.71h.101a3.87,3.87,0,0,1,2.75,1l-.8,1a2.81,2.81,0,0,0-2-.77,2.56,2.56,0,0,0,.11,5.1,2.9092,2.9092,0,0,0,1.73-.54V40.27h-1.83v-1.1h3v3a4.58,4.58,0,0,1-3,1.11" transform="translate(0 -0.05)"></path><rect class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" x="151.37" y="152.23" width="1.25" height="1.29"></rect><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="162.6 151.39 158.89 151.39 158.89 153.09 162.18 153.09 162.18 154.12 158.89 154.12 158.89 155.88 162.65 155.88 162.65 156.91 157.74 156.91 157.74 150.36 162.6 150.36 162.6 151.39"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M170.18,153.16c1.39.34,2.11.83,2.11,1.93a2.16,2.16,0,0,1-2.3067,2.0026l-.0333-.0026a4,4,0,0,1-2.73-1.05l.69-.82a3,3,0,0,0,2.07.85,1,1,0,0,0,1.16-.8092V155.26h0c0-.48-.26-.73-1.48-1-1.4-.34-2.18-.75-2.18-2a2,2,0,0,1,2.07-1.92h.17a3.61,3.61,0,0,1,2.38.82l-.62.87a3,3,0,0,0-1.78-.68.91.91,0,0,0-1.06.73v.06c0,.52.3.74,1.56,1" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="179.91 156.91 178.75 156.91 178.75 151.42 176.67 151.42 176.67 150.36 182 150.36 182 151.42 179.91 151.42 179.91 156.91"></polygon><rect class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" x="186.08" y="152.23" width="1.25" height="1.29"></rect><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="163.2 195.99 163.17 195.99 161.69 193.76 161.69 197.16 160.86 197.16 160.86 192.4 161.76 192.4 163.2 194.66 164.65 192.4 165.54 192.4 165.54 197.16 164.7 197.16 164.7 193.75 163.2 195.99"></polygon><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="172.38 197.16 171.37 197.16 169.75 195.02 169.01 195.78 169.01 197.16 168.17 197.16 168.17 192.4 169.01 192.4 169.01 194.8 171.27 192.4 172.3 192.4 170.32 194.45 172.38 197.16"></polygon><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="178.03 193.15 175.34 193.15 175.34 194.39 177.72 194.39 177.72 195.14 175.34 195.14 175.34 196.41 178.06 196.41 178.06 197.16 174.51 197.16 174.51 192.4 178.03 192.4 178.03 193.15"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M146.43,169.55l-1.29-1a3.48,3.48,0,0,1,3.11-1.72,2.55,2.55,0,0,1,2.84,2.22,2.1637,2.1637,0,0,1,0,.36c0,1.39-.71,2.09-2.19,3.23l-1.35,1h3.62v1.58h-6.16v-1.45l2.77-2.27c1-.86,1.44-1.31,1.44-2a1,1,0,0,0-.91-1.08h-.21a2.18,2.18,0,0,0-1.7,1.12" transform="translate(0 -0.05)"></path><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M162.6,168.42c-1.11,0-1.81,1.11-1.81,2.64s.73,2.66,1.83,2.66,1.81-1.12,1.81-2.64-.73-2.66-1.83-2.66m0,7c-2.22,0-3.69-1.86-3.69-4.29s1.49-4.31,3.71-4.31,3.68,1.86,3.68,4.29-1.49,4.31-3.71,4.31" transform="translate(0 -0.05)"></path><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M177.68,168.42c-1.11,0-1.81,1.11-1.81,2.64s.73,2.66,1.83,2.66,1.81-1.12,1.81-2.64-.73-2.66-1.83-2.66m0,7c-2.22,0-3.69-1.86-3.69-4.29s1.49-4.31,3.71-4.31,3.68,1.86,3.68,4.29-1.49,4.31-3.71,4.31" transform="translate(0 -0.05)"></path><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M189.74,166.91h5.14v1.6h-3.54l-.12,1.49a4,4,0,0,1,1.09-.14c1.64,0,2.91.78,2.91,2.67a2.84,2.84,0,0,1-2.7683,2.91H192.06a4.3,4.3,0,0,1-3.11-1.25l1.11-1.32a2.91,2.91,0,0,0,2,.9,1.17,1.17,0,0,0,1.3668-.9325l.0032-.0175a1.6481,1.6481,0,0,0,0-.22,1.24,1.24,0,0,0-1.3148-1.16l-.0052,0h-.15a3.5187,3.5187,0,0,0-1.39.31l-1.06-.7Z" transform="translate(0 -0.05)"></path><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="132 95.98 133.31 95.98 133.31 107.89 132.23 107.89 124.54 98.12 124.54 107.89 123.23 107.89 123.23 95.98 124.49 95.98 132 105.53 132 95.98"></polygon><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="154.41 97.2 147.14 97.2 147.14 101.27 153.64 101.27 153.64 102.5 147.14 102.5 147.14 106.67 154.5 106.67 154.5 107.89 145.8 107.89 145.8 95.98 154.41 95.98 154.41 97.2"></polygon><polygon class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" points="174.59 107.89 170.78 102.77 166.97 107.89 165.42 107.89 170 101.81 165.59 95.98 167.17 95.98 170.83 100.85 174.46 95.98 176.02 95.98 171.61 101.8 176.19 107.89 174.59 107.89"></polygon><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M197.35,102.85c0,3.47-2,5.28-5,5.28s-5-1.8-5-5.17v-7h1.35v6.84c0,2.57,1.36,4,3.64,4s3.59-1.33,3.59-3.93V96h1.35v6.83Z" transform="translate(0 -0.05)"></path><path class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" d="M213.88,101.34c2.65.58,3.88,1.55,3.88,3.39,0,2.06-1.7,3.39-4.07,3.39a7,7,0,0,1-4.81-1.92l.83-1a5.7,5.7,0,0,0,4.09,1.69c1.6,0,2.65-.83,2.65-2s-.59-1.75-3.1-2.28c-2.74-.6-4-1.48-4-3.46s1.65-3.27,3.92-3.27a6.27,6.27,0,0,1,4.19,1.46l-.78,1a5.24,5.24,0,0,0-3.44-1.29c-1.55,0-2.53.85-2.53,1.94s.61,1.77,3.23,2.33" transform="translate(0 -0.05)"></path><rect class="389600a9-b8cb-4f1f-ab5f-0b45cb9fa03c" x="115.51" y="127.38" width="111.65" height="2.31"></rect></svg>';
                        //                     htmldata+='<image src="'+resultdata.result[0].image+'" height="100" width="100" />';
                        //                 htmldata+='</div>';
                        //             htmldata+='</div>';
                        //         htmldata+='</div>';
                        //     htmldata+='</div>';
                        // htmldata+='</div>';
                        htmldata+='<div class="col-12 col-md-12 m-">';
                            htmldata+='<div class="welcome-to-info text-center">';
                                htmldata+='<div class="sec-title">';
                                    htmldata+='<h2>'+resultdata.result[0].title+'</h2>';
                                htmldata+='</div>';
                                htmldata+='<div class="welcome-desc">'+resultdata.result[0].description+'</div>';
                            htmldata+='</div>';
                        htmldata+='</div>';
                        // htmldata+='<div class="col-12 col-md-12 m-auto text-center">';
                        //     htmldata+='<div class="sec-title">';
                        //         htmldata+='<div class="things-sec">';
                        //             htmldata+='<h3 class="sec-title text-black">We believe in three things:</h3>';
                        //         htmldata+='</div>';
                        //     htmldata+='</div>';
                        // htmldata+='</div>';
                    htmldata+='</div>';
                htmldata+='</div>';
                $('.aboutdetailDiv').html(htmldata);
            }

        }

        function OnErrorfillcontentsetting(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

        listbelievething();
    }

    function listbelievething()
    {
        var pagename=getpagename();
        var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false};

        formdata = new FormData();
        formdata.append("action", "listbelievething");

        ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'aboutus',formdata,headersdata,Onsuccesslistbelievething,OnErrorlistbelievething);
        function Onsuccesslistbelievething(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata='';
            if(resultdata.status==0)
            {
                $('#believethigsdetail').addClass('d-none');
                $('#believethigsdetail').html(htmldata);
            }
            else if(resultdata.status==1)
            {
                $('#believethigsdetail').removeClass('d-none');

                htmldata+='<div class="container">';
                    htmldata+='<div class="row">';
                        htmldata+='<div class="col-12 col-md-12 m-auto text-center">';
                            htmldata+='<div class="sec-title">';
                                htmldata+='<div class="things-sec">';
                                    htmldata+='<h3 class="sec-title text-black">We believe in '+resultdata.numrows+' things:</h3>';
                                htmldata+='</div>';
                            htmldata+='</div>';
                        htmldata+='</div>';
                    htmldata+='</div>';
                htmldata+='</div>';

                for(var i in resultdata.result)
                {
                    var k=parseInt(i)+1;
                    if(i % 2==0)
                    {
                        htmldata+='<section class="feature-background__area bg-bg-pink">';
                            htmldata+='<div class="row no-gutters">';
                                htmldata+='<div class="col-md-6 wow fadeInLeft order-lg-1 order-md-1" data-wow-delay="200ms">';
                                    htmldata+='<div class="feature-background__image bg-img" data-bg="'+resultdata.result[i].image+'"></div>';
                                htmldata+='</div>';
                                htmldata+='<div class="col-md-6 wow fadeInRight m-auto" data-wow-delay="200ms">';
                                    htmldata+='<div class="feature-background__content feature-background__content--style2">';
                                        htmldata+='<div class="section-title-area">';
                                            htmldata+='<div class="number-icon-box">';
                                                htmldata+='<div class="number-icon-text">'+k+'</div>';
                                            htmldata+='</div>';
                                            htmldata+='<div class="sec-title mb-4">';
                                                htmldata+='<h2 class="text-black">'+resultdata.result[i].title+'</h2>';
                                            htmldata+='</div>';
                                            htmldata+='<div class="sec-data-desc">';
                                                htmldata+='<p class="sec-desc">'+resultdata.result[i].shortdescr+'</p>';
                                            htmldata+='</div>';
                                        htmldata+='</div>';
                                    htmldata+='</div>';
                                htmldata+='</div>';
                            htmldata+='</div>';
                        htmldata+='</section>';
                    }else{
                    
                        htmldata+='<section class="feature-background__area bg-light-green">';
                            htmldata+='<div class="row no-gutters">';
                                htmldata+='<div class="col-md-6 wow fadeInLeft" data-wow-delay="200ms">';
                                    htmldata+='<div class="feature-background__image bg-img" data-bg="'+resultdata.result[i].image+'"></div>';
                                htmldata+='</div>';
                                htmldata+='<div class="col-md-6 wow fadeInRight m-auto" data-wow-delay="200ms">';
                                    htmldata+='<div class="feature-background__content feature-background__content--style2">';
                                        htmldata+='<div class="section-title-area">';
                                            htmldata+='<div class="number-icon-box">';
                                                htmldata+='<div class="number-icon-text">'+k+'</div>';
                                            htmldata+='</div>';
                                            htmldata+='<div class="sec-title mb-4">';
                                                htmldata+='<h2 class="text-black">'+resultdata.result[i].title+'</h2>';
                                            htmldata+='</div>';
                                            htmldata+='<div class="sec-data-desc">';
                                                htmldata+='<p class="sec-desc">'+resultdata.result[i].shortdescr+'</p>';
                                            htmldata+='</div>';
                                        htmldata+='</div>';
                                    htmldata+='</div>';
                                htmldata+='</div>';
                            htmldata+='</div>';
                        htmldata+='</section>';
                    }
                }
                
                $('#believethigsdetail').html(htmldata);
                var bgSelector = $(".bg-img");
                bgSelector.each(function(index, elem) {
                    var element = $(elem),
                        bgSource = element.data("bg");
                    element.css("background-image", "url(" + bgSource + ")");
                });
                new WOW().init();
            }

        }

        function OnErrorlistbelievething(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

        listmissionvisiondetail();
    }
    function listmissionvisiondetail()
    {
        var pagename=getpagename();
        var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false};

        formdata = new FormData();
        formdata.append("action", "listmissionvisiondetail");
        ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'aboutus',formdata,headersdata,Onsuccesslistmissionvisiondetail,OnErrorlistmissionvisiondetail);
        function Onsuccesslistmissionvisiondetail(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata='';
            if(resultdata.status==1)
            {
                if(resultdata.missiondata[0].description !='' || resultdata.visiondata[0].description !='' || resultdata.valuesdata[0].description !='')
                {
                    $('.missionvisiondetail').removeClass('d-none');
                    $('.missiondetail').addClass('d-none');
                    $('.visiondetail').addClass('d-none');
                    $('.valuesdetail').addClass('d-none');
                    if(resultdata.missiondata[0].description)
                    {
                        $('.missiondetail').removeClass('d-none');
                        $('#missiondetail').html(resultdata.missiondata[0].description);
                    }
                    if(resultdata.visiondata[0].description)
                    {
                        $('.visiondetail').removeClass('d-none');
                        $('#visiondetail').html(resultdata.visiondata[0].description);
                    }
                    if(resultdata.valuesdata[0].description)
                    {
                        $('.valuesdetail').removeClass('d-none');
                        $('#valuesdetail').html(resultdata.valuesdata[0].description);
                    }

                }else{
                    $('.missionvisiondetail').addClass('d-none');
                }
            }

        }

        function OnErrorlistmissionvisiondetail(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

    }

   
</script>

</body>

</html>