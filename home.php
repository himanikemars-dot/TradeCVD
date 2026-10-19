<?php require_once 'config/init.php';
require_once 'config/apiconfig.php';

//  echo '<pre>';
//  print_r($LoginInfo);
//  echo '<pre>';
?>

<style id="trade-home-redesign">
    /* Trade CVD homepage presentation. Scoped to this page's existing classes. */
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap');

    :root {
        --home-forest: #123a2d;
        --home-deep: #0a2a20;
        --home-accent: #669934;
        --home-muted: #65786b;
        --home-line: #dce8dd;
        --home-paper: #f5f8f4;
    }





    /* .hr-line {
        display: none;
    }

    .jewelrysuits-section.jewelrysuitsdetail {
        background: #f5f8f4 !important;
        padding: 75px 0 !important;
    }

    .jewelrysuits-section .sec-title,
    .gems-quality-sec .sec-title,
    .our-customers-sec .sec-title,
    .testimonials .sec-title,
    .frequently-askque-sec .sec-title {
        font: 800 clamp(27px, 3vw, 39px)/1.2 Manrope, Arial, sans-serif !important;
        color: var(--home-forest) !important;
        letter-spacing: -1px;
    }

    .jewelrysuits-section .sec-desc,
    .gems-quality-sec .sec-desc,
    .our-customers-sec .sec-desc,
    .testimonials .sec-desc,
    .frequently-askque-sec .sec-desc {
        color: var(--home-muted) !important;
        font-size: 15px !important;
    }

    .jewelrysuits-section .jewelrysuits-info {
        margin-top: 32px;
    }

    .jewelrysuits-section .jewelrysuits-cards .card {
        border: 1px solid #e4ebe4 !important;
        border-radius: 14px !important;
        overflow: hidden;
        box-shadow: 0 10px 30px #133a2510 !important;
        margin: 5px 10px 18px;
    }

    .jewelrysuits-section .jewelrysuits-images img {
        width: 100%;
        height: 270px;
        object-fit: cover;
    }

    .jewelrysuits-section .jewelry-content {
        padding: 13px 17px !important;
    }

    .jewelrysuits-section .jewelry-content-meta p {
        color: var(--home-forest) !important;
        font-weight: 700;
    }

    .jewelrysuits-section .jewelry-content-meta a {
        color: var(--home-forest) !important;
        font-weight: 800;
    }

    .gems-quality-sec.listsavanigemsquality {
        padding: 78px 0 !important;
        background: #fff;
    }

    .gems-quality-sec .gems-quality-card .card {
        border: 1px solid #e3eae3 !important;
        border-radius: 12px !important;
        box-shadow: none !important;
        min-height: 160px;
        margin: 9px;
    }

    .gems-quality-sec .gems-quality-card .card-body {
        padding: 24px 15px !important;
    }

    .gems-quality-sec .gems-quality-img {
        width: 52px;
        height: 52px;
        margin: auto auto 13px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        background: #e8f2e8 !important;
    }

    .gems-quality-sec .gems-quality-img img {
        max-width: 29px;
        max-height: 29px;
        object-fit: contain;
    }

    .gems-quality-sec .wrapper-title p {
        color: var(--home-forest) !important;
        font-size: 14px !important;
        font-weight: 700;
    }

    .our-customers-sec.customerdetail {
        background: #f5f8f4 !important;
        padding: 70px 0 !important;
        border-radius: 0 !important;
    }

    .our-customers-sec #customerdetail {
        margin-top: 25px;
    }

    .our-customers-sec .our-customers-img {
        padding: 20px;
    }

    .our-customers-sec .our-customers-img img {
        max-height: 75px;
        max-width: 170px;
        object-fit: contain;
        filter: grayscale(1);
    }

    .testimonials.listtestimonial {
        padding: 75px 0 !important;
    }

    .testimonials .customers-testimonials .card {
        border: 1px solid #e2eae2 !important;
        border-radius: 13px !important;
        box-shadow: 0 8px 25px #173e2910 !important;
        height: 100%;
        margin: 10px;
    }

    .testimonials .customers-img img {
        width: 70px !important;
        height: 70px !important;
        object-fit: cover;
        border-radius: 50%;
    }

    .testimonials .viewmore-link a {
        color: var(--home-forest) !important;
        font-weight: 800;
    }

    .frequently-askque-sec.listhomefaq {
        background: #f5f8f4 !important;
        padding: 75px 0 !important;
        border-radius: 0 !important;
    }

    .frequently-askque-sec .listfaqgroup {
        justify-content: center;
        gap: 9px;
        margin: 26px 0 !important;
    }

    .frequently-askque-sec .listfaqgroup .nav-link {
        border: 1px solid var(--home-line) !important;
        border-radius: 9px !important;
        background: #fff !important;
        color: var(--home-forest) !important;
        min-width: 100px;
        padding: 13px !important;
        box-shadow: none !important;
    }

    .frequently-askque-sec .listfaqgroup .nav-link.active {
        background: var(--home-forest) !important;
        color: #fff !important;
    }

    .frequently-askque-sec .frequently-askque-list .card {
        border: 1px solid var(--home-line) !important;
        border-radius: 9px !important;
        margin: 9px 0 !important;
        overflow: hidden;
        box-shadow: none !important;
    }

    .frequently-askque-sec .frequently-askque-list .card-header {
        background: #fff !important;
        padding: 15px 18px !important;
    }

    .frequently-askque-sec .frequently-askque-list .card-header h5 {
        font-size: 14px !important;
        font-weight: 700;
        color: var(--home-forest) !important;
    }

    .frequently-askque-sec .frequently-askque-list .card-body {
        color: var(--home-muted);
        font-size: 14px;
    }

    @media(max-width:991px) {
        .diamondsearch-sec .free-search-widget {
            grid-template-columns: 175px minmax(0, 1fr)
        }


        .banner-section.sliderdetail .item-banner:before {
            background: linear-gradient(90deg, rgba(7, 34, 25, .95), rgba(7, 34, 25, .55))
        }
    } */

    @media(max-width:767px) {
        /* 
        .banner-section.sliderdetail .banner-slider,
        .banner-section.sliderdetail .slider-banner,
        .banner-section.sliderdetail .item-banner {
            min-height: 570px
        }

        .banner-section.sliderdetail .banner-title {
            font-size: 38px !important;
            letter-spacing: -1.5px
        }

        .banner-section.sliderdetail .banner-container {
            padding: 60px 8px !important
        }

        .banner-section.sliderdetail .banner-bottom-content {
            gap: 12px
        } */

        .diamondsearch-sec .free-search-widget {
            display: block
        }



        .diamondsearch-sec .home-filter-nav {
            display: flex;
            overflow-x: auto;
            margin: 0;
            gap: 6px;
            padding-bottom: 2px
        }

        .diamondsearch-sec .home-filter-nav a {
            white-space: nowrap;
            flex: none
        }

        .diamondsearch-sec .QuickSearchDiv {
            padding: 15px 17px !important
        }

        .diamondsearch-sec #form-diamond-search>.form-group,
        .diamondsearch-sec #form-diamond-search>#free-search>.form-group {
            grid-template-columns: 1fr;
            gap: 8px
        }

        .diamondsearch-sec #form-diamond-search .name-filter {
            padding: 0
        }

        .diamondsearch-sec #form-diamond-search .show-more-filters {
            grid-column: 1
        }

        .diamondsearch-sec #form-diamond-search .form-inline {
            margin: 0 8px 10px 0
        }

        /* .jewelrysuits-section .jewelrysuits-images img {
            height: 240px
        } */
    }

    @media(max-width:480px) {
        /* .banner-section.sliderdetail .banner-title {
            font-size: 34px !important
        }

        .banner-section.sliderdetail .bottom-section {
            min-width: 95px
        } */


        .diamondsearch-sec #form-diamond-search .form-inline {
            display: flex;
            width: 100%
        }

        .diamondsearch-sec #form-diamond-search .form-inline input {
            max-width: 170px
        }

        .frequently-askque-sec .listfaqgroup .nav-link {
            min-width: 85px
        }

        .diamondsearch-sec #form-diamond-search .filter-container .custom-control-label {
            min-width: 37px
        }
    }

    /* Show only the filter selected in the left navigation. */


    /* Keep every filter visible and the navigation under the 79px header. */
    .diamondsearch-sec .free-search-widget,
    .diamondsearch-sec .container-search,
    .diamondsearch-sec .filter-box {
        overflow: visible !important;
    }


    .diamondsearch-sec #form-diamond-search .home-filter-hidden {
        display: grid !important;
    }
</style>

<section class="banner-section sliderdetail">
    <!-- /.container -->
    <!-- <div class="banner-slider owl-carousel owl-theme">
        <div class="item">
            <div class="slider-banner m-0">
                <div class="item-banner" style="background-image: url(<?php echo $config->getimageurl() ?>images/banner.jpg);">
                    <div class="container my-auto">
                        <div class="row m-0">
                            <div class="col-12 p-0 banner-container">
                                <div class="banner-content">
                                    <div class="banner-info">
                                    <h1 class="banner-title">Lets Shine Togather</h1>
                                    </div>
                                    <div class="banner-desc">
                                        <p>Helping you get the <b>most value</b> on your <br />Diamond & Jewellery Purchase and Selling.</p>
                                    </div>ec
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="slider-banner m-0">
                <div class="item-banner" style="background-image: url(<?php echo $config->getimageurl() ?>images/banner.jpg);">
                    <div class="container my-auto">
                        <div class="row m-0">
                            <div class="col-12 p-0 banner-container">
                                <div class="banner-content">
                                    <div class="banner-info">
                                    <h1 class="banner-title">Lets Shine Toghter</h1>
                                    </div>
                                    <div class="banner-desc">
                                        <p>Helping you get the <b>most value</b> on your <br />Diamond & Jewellery Purchase and Selling.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="slider-banner m-0">
                <div class="item-banner" style="background-image: url(<?php echo $config->getimageurl() ?>images/banner.jpg);">
                    <div class="container my-auto">
                        <div class="row m-0">
                            <div class="col-12 p-0 banner-container">
                                <div class="banner-content">
                                    <div class="banner-info">
                                    <h1 class="banner-title">Lets Shine Toghter</h1>
                                    </div>
                                    <div class="banner-desc">
                                        <p>Helping you get the <b>most value</b> on your <br />Diamond & Jewellery Purchase and Selling.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="slider-banner m-0">
                <div class="item-banner" style="background-image: url(<?php echo $config->getimageurl() ?>images/banner.jpg);">
                    <div class="container my-auto">
                        <div class="row m-0">
                            <div class="col-12 p-0 banner-container">
                                <div class="banner-content">
                                    <div class="banner-info">
                                    <h1 class="banner-title">Lets Shine Toghter</h1>
                                    </div>
                                    <div class="banner-desc">
                                        <p>Helping you get the <b>most value</b> on your <br />Diamond & Jewellery Purchase and Selling.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</section>
<!-- /section -->

<!-- Quick diamond Search Start-->
<section class="diamondsearch-sec section-space diamond-home-page overflow-visible">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="diamondsearch-data text-center sec-info">
                    <div class="diamondsearch-title">
                        <!-- <h2 class="sec-title"><img class="diamond-serchimg"
                                src="<?php echo $config->getimageurl() ?>images/homepage/diamond-serch.svg" alt=""
                                title="">Quick Diamond Search</h2> -->
                        <h3 class="QuickSearchDiv">
                            Search Over <span>1,000,000</span> Labgrown Diamonds from Thousands of Verified Suppliers Worldwide!
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12">
            <div class="free-search-widget" id="free-search-widget">
                <!-- Visual navigation for the existing live search form. The original inputs and IDs remain below. -->
                <aside class="home-search-sidebar" aria-label="Diamond search sections">
                    <h2 class="home-sidebar-title text-white">quick Search</h2>
                    <span class="home-sidebar-eyebrow">Find the right diamond.</span>
                    <!-- <nav class="home-filter-nav" aria-label="Jump to search filters">
                        <a href="#home-shape" class="active">01 <span>Shape</span></a>
                        <a href="#home-size">02 <span>Size</span></a>
                        <a href="#home-color">03 <span>Color</span></a>
                        <a href="#home-clarity">04 <span>Clarity</span></a>
                        <a href="#free-search">05 <span>Finish & lab</span></a>
                    </nav> -->
                    <p>Search by shape, carat, color and clarity.</p>
                    <p>fine-tune as you go.</p>
                </aside>
                <div class="container-search" id="free-search-container" data-show-items="20" data-page-number="1">
                    <div class="filter-box">
                        <form action="" id="form-diamond-search">
                            <div id="home-shape" class="form-group shape-group fillshapdetail">
                                <div class="name-filter">Shape <span class="red">*</span></div>
                                <div class="d-flex align-items-start w-100 justify-content-between">
                                    <div class="row-filter">
                                        <div class="filter-container" id="fillshapdetail">
                                            <!-- <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f0" class="custom-control-input" value="Round">
                                                    <label for="f0" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_round.svg" alt="Round" class="img-responsive"></span>
                                                        <span class="text-label">Round</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f1" class="custom-control-input" value="Pear">
                                                    <label for="f1" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_pear.svg" alt="Pear" class="img-responsive"></span>
                                                        <span class="text-label">Pear</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f2" class="custom-control-input" value="Princess">
                                                    <label for="f2" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_princess.svg" alt="Princess" class="img-responsive"></span>
                                                        <span class="text-label">Princess</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f3" class="custom-control-input" value="Marquise">
                                                    <label for="f3" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_marquise.svg" alt="Marquise" class="img-responsive"></span>
                                                        <span class="text-label">Marquise</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f4" class="custom-control-input" value="Emerald">
                                                    <label for="f4" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_emerald_l.svg" alt="Emerald" class="img-responsive"></span>
                                                        <span class="text-label">Emerald</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f5" class="custom-control-input" value="Cushion Brilliant">
                                                    <label for="f5" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_cushion_brilliant_l.svg" alt="Cushion Brilliant" class="img-responsive"></span>
                                                        <span class="text-label">Cushion Brilliant</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f6" class="custom-control-input" value="Cushion Modified">
                                                    <label for="f6" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_cushion_mod_l.svg" alt="Cushion Modified" class="img-responsive"></span>
                                                        <span class="text-label">Cushion Modified</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f7" class="custom-control-input" value="Asscher">
                                                    <label for="f7" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_asscher_l.svg" alt="Asscher" class="img-responsive"></span>
                                                        <span class="text-label">Asscher</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f8" class="custom-control-input" value="Sq. Emerald">
                                                    <label for="f8" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_sq_emerald.svg" alt="Sq. Emerald" class="img-responsive"></span>
                                                        <span class="text-label">Sq. Emerald</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f9" class="custom-control-input" value="Oval">
                                                    <label for="f9" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_oval.svg" alt="Oval" class="img-responsive"></span>
                                                        <span class="text-label">Oval</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f10" class="custom-control-input" value="Radiant">
                                                    <label for="f10" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_radiant.svg" alt="Radiant" class="img-responsive"></span>
                                                        <span class="text-label">Radiant</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f11" class="custom-control-input" value="Heart">
                                                    <label for="f11" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_heart.svg" alt="Heart" class="img-responsive"></span>
                                                        <span class="text-label">Heart</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f12" class="custom-control-input" value="European Cut">
                                                    <label for="f12" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_euro_cut.svg" alt="European Cut" class="img-responsive"></span>
                                                        <span class="text-label">European Cut</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f13" class="custom-control-input" value="Old Miner">
                                                    <label for="f13" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_old_miner.svg" alt="Old Miner" class="img-responsive"></span>
                                                        <span class="text-label">Old Miner</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f14" class="custom-control-input" value="Baguette">
                                                    <label for="f14" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_baguette_l.svg" alt="Baguette" class="img-responsive"></span>
                                                        <span class="text-label">Baguette</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f15" class="custom-control-input" value="Briolette">
                                                    <label for="f15" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_briolette_l.svg" alt="Briolette" class="img-responsive"></span>
                                                        <span class="text-label">Briolette</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f16" class="custom-control-input" value="Bullets">
                                                    <label for="f16" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_bullet_l.svg" alt="Bullets" class="img-responsive"></span>
                                                        <span class="text-label">Bullets</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f17" class="custom-control-input" value="Calf">
                                                    <label for="f17" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_calf_l.svg" alt="Calf" class="img-responsive"></span>
                                                        <span class="text-label">Calf</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f18" class="custom-control-input" value="Half Moon">
                                                    <label for="f18" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_half_moon.svg" alt="Half Moon" class="img-responsive"></span>
                                                        <span class="text-label">Half Moon</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f19" class="custom-control-input" value="Hexagonal">
                                                    <label for="f19" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_hexagonal.svg" alt="Hexagonal" class="img-responsive"></span>
                                                        <span class="text-label">Hexagonal</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f20" class="custom-control-input" value="Kite">
                                                    <label for="f20" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_kite.svg" alt="Kite" class="img-responsive"></span>
                                                        <span class="text-label">Kite</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f21" class="custom-control-input" value="Lozenge">
                                                    <label for="f21" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_lozenge.svg" alt="Lozenge" class="img-responsive"></span>
                                                        <span class="text-label">Lozenge</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f22" class="custom-control-input" value="Octagonal">
                                                    <label for="f22" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_octagonal.svg" alt="Octagonal" class="img-responsive"></span>
                                                        <span class="text-label">Octagonal</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f23" class="custom-control-input" value="Pentagonal">
                                                    <label for="f23" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_pentagonal.svg" alt="Pentagonal" class="img-responsive"></span>
                                                        <span class="text-label">Pentagonal</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f24" class="custom-control-input" value="Rose">
                                                    <label for="f24" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_rose.svg" alt="Rose" class="img-responsive"></span>
                                                        <span class="text-label">Rose</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f25" class="custom-control-input" value="Shield">
                                                    <label for="f25" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="#" alt="Shield" class="img-responsive"></span>
                                                        <span class="text-label">Shield</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f26" class="custom-control-input" value="Square">
                                                    <label for="f26" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="#" alt="Square" class="img-responsive"></span>
                                                        <span class="text-label">Square</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f27" class="custom-control-input" value="Square Radiant">
                                                    <label for="f27" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="#" alt="Square Radiant" class="img-responsive"></span>
                                                        <span class="text-label">Square Radiant</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f28" class="custom-control-input" value="Star">
                                                    <label for="f28" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="#" alt="Star" class="img-responsive"></span>
                                                        <span class="text-label">Star</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f29" class="custom-control-input" value="Tapered Baguette">
                                                    <label for="f29" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="#" alt="Tapered Baguette" class="img-responsive"></span>
                                                        <span class="text-label">Tapered Baguette</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f30" class="custom-control-input" value="Tapered Bullet">
                                                    <label for="f30" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="#" alt="Tapered Bullet" class="img-responsive"></span>
                                                        <span class="text-label">Tapered Bullet</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f31" class="custom-control-input" value="Trapezoid">
                                                    <label for="f31" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="#" alt="Trapezoid" class="img-responsive"></span>
                                                        <span class="text-label">Trapezoid</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f32" class="custom-control-input" value="Triangular">
                                                    <label for="f32" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="#" alt="Triangular" class="img-responsive"></span>
                                                        <span class="text-label">Triangular</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f33" class="custom-control-input" value="Trilliant">
                                                    <label for="f33" class="custom-control-label with-img">
                                                            <span class="img-wrap"><img src="#" alt="Trilliant" class="img-responsive"></span>
                                                        <span class="text-label">Trilliant</span>
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="f34" class="custom-control-input" value="Other">
                                                    <label for="f34" class="custom-control-label with-img">
                                                        <span class="text-label">Other</span>
                                                    </label>
                                                </div> -->
                                        </div>
                                    </div>
                                    <button type="button" id="btnshapdownarrow" class="btn show-more-filters ml-2">
                                        <span class="text">+ 30 More</span>
                                        <span class="text opened">- 30 Less</span>
                                        <span class="arrow-btn">
                                            <img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg"
                                                alt="" class="img-responsive">
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div id="home-size" class="form-group size-group">
                                <div class="name-filter">Size <span class="red">*</span></div>
                                <div class="row-filter">
                                    <div class="form-inline">
                                        <label for="sizeFrom">From</label>
                                        <input type="number" min="0" onkeypress="numbonly(event);"
                                            class="form-control fromusd " id="fltfromsize" name="fltfromsize"
                                            placeholder="Enter Size">
                                    </div>

                                    <div class="form-inline">
                                        <label for="sizeTo">To</label>
                                        <input type="number" min="0" class="form-control fromusd" name="flttosize"
                                            id="flttosize" onkeypress="numbonly(event);" placeholder="Enter Size">
                                    </div>
                                </div>
                            </div>
                            <div id="home-color" class="form-group color-group fillcolordetail">
                                <div class="name-filter">Color <span class="red">*</span></div>
                                <div class="d-flex align-items-start w-100 justify-content-end">
                                    <div class="row-filter">
                                        <div class="filter-container" id="fillcolordetail">
                                            <!-- <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c0" class="custom-control-input">
                                                     <label for="c0" class="custom-control-label">
                                                         D
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c1" class="custom-control-input">
                                                     <label for="c1" class="custom-control-label">
                                                         E
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c2" class="custom-control-input">
                                                     <label for="c2" class="custom-control-label">
                                                         F
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c3" class="custom-control-input">
                                                     <label for="c3" class="custom-control-label">
                                                         G
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c4" class="custom-control-input">
                                                     <label for="c4" class="custom-control-label">
                                                         H
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c5" class="custom-control-input">
                                                     <label for="c5" class="custom-control-label">
                                                         I
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c6" class="custom-control-input">
                                                     <label for="c6" class="custom-control-label">
                                                         J
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c7" class="custom-control-input">
                                                     <label for="c7" class="custom-control-label">
                                                         K
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c8" class="custom-control-input">
                                                     <label for="c8" class="custom-control-label">
                                                         L
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c9" class="custom-control-input">
                                                     <label for="c9" class="custom-control-label">
                                                         M
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c10" class="custom-control-input">
                                                     <label for="c10" class="custom-control-label">
                                                         N
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c11" class="custom-control-input">
                                                     <label for="c11" class="custom-control-label">
                                                         O
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c12" class="custom-control-input">
                                                     <label for="c12" class="custom-control-label">
                                                         P
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c13" class="custom-control-input">
                                                     <label for="c13" class="custom-control-label">
                                                         Q
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c14" class="custom-control-input">
                                                     <label for="c14" class="custom-control-label">
                                                         R
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c15" class="custom-control-input">
                                                     <label for="c15" class="custom-control-label">
                                                         S
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c16" class="custom-control-input">
                                                     <label for="c16" class="custom-control-label">
                                                         T
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c17" class="custom-control-input">
                                                     <label for="c17" class="custom-control-label">
                                                         U
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c18" class="custom-control-input">
                                                     <label for="c18" class="custom-control-label">
                                                         V
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c19" class="custom-control-input">
                                                     <label for="c19" class="custom-control-label">
                                                         W
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c20" class="custom-control-input">
                                                     <label for="c20" class="custom-control-label">
                                                         X
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c21" class="custom-control-input">
                                                     <label for="c21" class="custom-control-label">
                                                         Y
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="c22" class="custom-control-input">
                                                     <label for="c22" class="custom-control-label">
                                                         Z
                                                     </label>
                                                 </div> -->
                                        </div>
                                    </div>
                                    <button type="button" id="btncolordownarrow" class="btn show-more-filters ml-2">
                                        <span class="text">+ 18 More</span>
                                        <span class="text opened">- 18 Less</span>
                                        <span class="arrow-btn">
                                            <img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg"
                                                alt="" class="img-responsive">
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div id="home-clarity" class="form-group clarity-group fillclaritydetail">
                                <div class="name-filter">Clarity </div>
                                <div class="d-flex align-items-start w-100 justify-content-between">
                                    <div class="row-filter">
                                        <div class="filter-container" id="fillclaritydetail">
                                            <!-- <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="cl0" class="custom-control-input">
                                                     <label for="cl0" class="custom-control-label">
                                                         FL
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="cl1" class="custom-control-input">
                                                     <label for="cl1" class="custom-control-label">
                                                         IF
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="cl2" class="custom-control-input">
                                                     <label for="cl2" class="custom-control-label">
                                                         VVS1
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="cl3" class="custom-control-input">
                                                     <label for="cl3" class="custom-control-label">
                                                         VVS2
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="cl4" class="custom-control-input">
                                                     <label for="cl4" class="custom-control-label">
                                                         VS1
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="cl5" class="custom-control-input">
                                                     <label for="cl5" class="custom-control-label">
                                                         VS2
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="cl6" class="custom-control-input">
                                                     <label for="cl6" class="custom-control-label">
                                                         VS3
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="cl7" class="custom-control-input">
                                                     <label for="cl7" class="custom-control-label">
                                                         SI1
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="cl8" class="custom-control-input">
                                                     <label for="cl8" class="custom-control-label">
                                                         SI2
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="cl9" class="custom-control-input">
                                                     <label for="cl9" class="custom-control-label">
                                                         SI3
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="cl10" class="custom-control-input">
                                                     <label for="cl10" class="custom-control-label">
                                                         I1
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="cl11" class="custom-control-input">
                                                     <label for="cl11" class="custom-control-label">
                                                         I2
                                                     </label>
                                                 </div>
                                                 <div class="filter custom-checkbox">
                                                     <input type="checkbox" id="cl12" class="custom-control-input">
                                                     <label for="cl12" class="custom-control-label">
                                                         I3
                                                     </label>
                                                 </div> -->
                                        </div>
                                    </div>
                                    <button type="button" id="btncolordownarrow" class="btn show-more-filters ml-2">
                                        <span class="text">+ 18 More</span>
                                        <span class="text opened">- 18 Less</span>
                                        <span class="arrow-btn">
                                            <img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg"
                                                alt="" class="img-responsive">
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="collapse" id="free-search">
                                <!-- <div class="form-group multiply-group-filter">
                                        <div class="name-filter">Finish</div>
                                        <div class="row-filter">
                                            <div class="col-group set-cut-home cut-group ssescrhom cut-dimond">
                                                <label id="cut" class="cutsethome">Cut</label>
                                                <select class="form-control select2 set-select-dimonhome" aria-labelledby="cut" name="fltcutid[]" id="fltcutid" multiple="" tabindex="-1" aria-hidden="true">

                                                </select>
                                            </div>
                                            <div class="col-group set-cut-home polish-group cut-dimond">
                                                <label id="polish" class="cutsethome">Polish</label>
                                                <select class="form-control select2 set-select-dimonhome" aria-labelledby="polish" name="fltpolishid[]" id="fltpolishid" multiple="" tabindex="-1" aria-hidden="true">

                                                </select>
                                            </div>
                                            <div class="col-group set-cut-home symmetry-group cut-dimond">
                                                <label id="symmetry" class="cutsethome">Symmetry</label>
                                                <select class="form-control select2 set-select-dimonhome" aria-labelledby="symmetry" name="fltsymmetryid[]" id="fltsymmetryid" multiple="" tabindex="-1" aria-hidden="true">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="row-filter set-finesdh-data">
                                            <div class="col-group set-cut-home cut-group setpolish-data">
                                                <label id="cut" class="cutsethome cut-title">Cut</label>
                                                <div class="row set-width-cut">
                                                    <div class="col-md-12 col-lg-12 col-xl-6">
                                                        <label for="from">From</label>
                                                        <select class="js-example-basic-single" name="state">
                                                            <option value="AL">Alabama</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12 col-xl-6">
                                                        <label for="from">To</label>
                                                        <select class="js-example-basic-single" name="statesnew">
                                                            <option value="AL">Alabama</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-group set-cut-home cut-group setpolish-data">
                                                <label id="cut" class="cutsethome cut-title">Polish</label>
                                                <div class="row set-width-cut">
                                                    <div class="col-md-12 col-lg-12 col-xl-6">
                                                        <label for="from">From</label>
                                                        <select class="js-example-basic-single" name="fltpolishid">
                                                            <option value="AL">Alabama</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12 col-xl-6">
                                                        <label for="from">To</label>
                                                        <select class="js-example-basic-single" name="states">
                                                            <option value="AL">Alabama</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-group set-cut-home cut-group setpolish-data">
                                                <label id="cut" class="cutsethome cut-title">Symmetry</label>
                                                <div class="row set-width-cut">
                                                    <div class="col-md-12 col-lg-12 col-xl-6">
                                                        <label for="from">From</label>
                                                        <select class="js-example-basic-single" name="fltsymmetryid">
                                                            <option value="AL">Alabama</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12 col-xl-6">
                                                        <label for="from">To</label>
                                                        <select class="js-example-basic-single" name="abc">
                                                            <option value="AL">Alabama</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                <div class="form-group size-group dash-size-group">
                                    <div class="name-filter">Finish</div>
                                    <div class="row-filter dash-row w-100">
                                        <div class="col-12 col-md-12">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="row set-border">
                                                        <div
                                                            class="col-6 col-md-6 col-lg-6 col-xl-6  sizesetall  cut-group">
                                                            <label id="openinclusion">Cut </label>
                                                            <select class="form-control select2" name="fltfromcutid"
                                                                id="fltfromcutid" tabindex="-1" aria-hidden="true">
                                                                <option value="" data-displayorder="0">From</option>
                                                            </select>
                                                        </div>
                                                        <div
                                                            class="col-6 col-md-6 col-lg-6 col-xl-6  sizesetall  cut-group">
                                                            <label class="finish-emply-label"
                                                                id="openinclusion">&nbsp;</label>
                                                            <select class="form-control select2" name="flttocutid"
                                                                id="flttocutid" tabindex="-1" aria-hidden="true">
                                                                <option value="">To</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mt-3 mt-md-0">
                                                    <div class="row set-border">
                                                        <div
                                                            class="col-6 col-md-6 col-lg-6 col-xl-6  sizesetall  cut-group">
                                                            <label id="openinclusion">Polish</label>
                                                            <select class="form-control select2" name="fltfrompolishid"
                                                                id="fltfrompolishid" tabindex="-1" aria-hidden="true">
                                                                <option value="">From</option>
                                                            </select>
                                                        </div>
                                                        <div
                                                            class="col-6 col-md-6 col-lg-6 col-xl-6  sizesetall  cut-group">
                                                            <label class="finish-emply-label"
                                                                id="openinclusion">&nbsp;</label>
                                                            <select class="form-control select2" name="flttopolishid"
                                                                id="flttopolishid" tabindex="-1" aria-hidden="true">
                                                                <option value="">To</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mt-3">
                                                    <div class="row">
                                                        <div
                                                            class="col-6 col-md-6 col-lg-6 col-xl-6  sizesetall  cut-group">
                                                            <label id="openinclusion">Symmetry</label>
                                                            <select class="form-control select2"
                                                                name="fltfromsymmetryid" id="fltfromsymmetryid"
                                                                tabindex="-1" aria-hidden="true">
                                                                <option value="">From</option>
                                                            </select>
                                                        </div>
                                                        <div
                                                            class="col-6 col-md-6 col-lg-6 col-xl-6  sizesetall  cut-group">
                                                            <label class="finish-emply-label"
                                                                id="openinclusion">&nbsp;</label>
                                                            <select class="form-control select2" name="flttosymmetryid"
                                                                id="flttosymmetryid" tabindex="-1" aria-hidden="true">
                                                                <option value="">To</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group flu-group fillFluorescenceDetail custom-min-deatil">
                                    <div class="name-filter">Fluorescence</div>
                                    <div class="row-filter">
                                        <div class="filter-container" id="fillFluorescenceDetail">
                                            <!-- <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="fl0" class="custom-control-input" value="None">
                                                    <label for="fl0" class="custom-control-label">
                                                        None
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="fl1" class="custom-control-input" value="Very Slight">
                                                    <label for="fl1" class="custom-control-label">
                                                        Very Slight
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="fl2" class="custom-control-input" value="Slight">
                                                    <label for="fl2" class="custom-control-label">
                                                        Slight
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="fl3" class="custom-control-input" value="Faint">
                                                    <label for="fl3" class="custom-control-label">
                                                        Faint
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="fl4" class="custom-control-input" value="Medium">
                                                    <label for="fl4" class="custom-control-label">
                                                        Medium
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="fl5" class="custom-control-input" value="Strong">
                                                    <label for="fl5" class="custom-control-label">
                                                        Strong
                                                    </label>
                                                </div>
                                                <div class="filter custom-checkbox">
                                                    <input type="checkbox" id="fl6" class="custom-control-input" value="Very Strong">
                                                    <label for="fl6" class="custom-control-label">
                                                        Very Strong
                                                    </label>
                                                </div> -->
                                        </div>
                                        <!--  <button type="button" class="btn show-more-filters">
                                                <span class="text">+ 2 More</span>
                                                <span class="text opened">- 2 Less</span>
                                                <span class="arrow-btn">
                                                    <img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">
                                                </span>
                                            </button> -->
                                    </div>
                                </div>
                                <div class="form-group lab-group labdetail custom-min-deatil">
                                    <div class="name-filter">Lab</div>
                                    <div class="row-filter">
                                        <div class="filter-container" id="labdetail">
                                            <!-- <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l0" class="custom-control-input">
                                                        <label for="l0" class="custom-control-label">
                                                            GIA
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l1" class="custom-control-input">
                                                        <label for="l1" class="custom-control-label">
                                                            RAP
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l2" class="custom-control-input">
                                                        <label for="l2" class="custom-control-label">
                                                            AGS
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l3" class="custom-control-input">
                                                        <label for="l3" class="custom-control-label">
                                                            HRD
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l4" class="custom-control-input">
                                                        <label for="l4" class="custom-control-label">
                                                            IGI
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l5" class="custom-control-input">
                                                        <label for="l5" class="custom-control-label">
                                                            RDC
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l6" class="custom-control-input">
                                                        <label for="l6" class="custom-control-label">
                                                            CGL
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l7" class="custom-control-input">
                                                        <label for="l7" class="custom-control-label">
                                                            DCLA
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l8" class="custom-control-input">
                                                        <label for="l8" class="custom-control-label">
                                                            GCAL
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l9" class="custom-control-input">
                                                        <label for="l9" class="custom-control-label">
                                                            GHI
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l10" class="custom-control-input">
                                                        <label for="l10" class="custom-control-label">
                                                            DBGIS
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l11" class="custom-control-input">
                                                        <label for="l11" class="custom-control-label">
                                                            GSI
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l12" class="custom-control-input">
                                                        <label for="l12" class="custom-control-label">
                                                            GWLAB
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l13" class="custom-control-input">
                                                        <label for="l13" class="custom-control-label">
                                                            NGTC
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l14" class="custom-control-input">
                                                        <label for="l14" class="custom-control-label">
                                                            PGS
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="l15" class="custom-control-input">
                                                        <label for="l15" class="custom-control-label">
                                                            NONE
                                                        </label>
                                                    </div> -->
                                        </div>
                                    </div>
                                    <button type="button" id="btnlabdownarrow" class="btn show-more-filters">
                                        <span class="text">+ 11 More</span>
                                        <span class="text opened">- 11 Less</span>
                                        <span class="arrow-btn">
                                            <img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg"
                                                alt="" class="img-responsive">
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="show-more">
                                <a class="show-more-link" data-toggle="collapse" href="#free-search" role="button"
                                    aria-expanded="false" aria-controls="free-search">
                                    <span class="init">Show More </span>
                                    <span class="open">Show Less </span>
                                    <span class="arrow-btn">
                                        <img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg"
                                            alt="" class="img-responsive">
                                    </span>
                                </a>
                            </div>
                            <div class="form-btns text-center">
                                <button type="submit" class="btn btn-primary send-btn" disabled="" id="btnsearchdiamond"
                                    data-category="free search" data-label="Diamond search"
                                    data-hs-event-50099495="1"><!-- <img src="#">  -->Search</button>
                                <input type="reset" value="Reset" class="btn btn-link reset-btn" id="serchformreset">
                            </div>
                            <div class="loader">
                                <div class="lds-ring">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="container container-result-search d-none listdiamondDataDiv" id="free-search-result">
                    <a href="javascript:void(0)" class="back-link mt-10"><i class="fa fa-arrow-left 2x"
                            aria-hidden="true"></i>&nbsp;&nbsp;Search parameters</a>
                    <div class="results-heading">0 Diamonds available</div>
                    <div class="table-responsive">
                        <table class="table table-tb text-left" id="listdiamondDatatbl" data-show="0" data-nextpage="0">
                            <thead>
                                <!-- <tr>
                                            <th>Supplier</th>
                                            <th>Shape</th>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>Clarity</th>
                                            <th>Cut</th>
                                            <th>Polish</th>
                                            <th>Symm</th>
                                            <th>Fluor.</th>
                                            <th>Lab</th>
                                            <th>Price</th>
                                            <th>Depth</th>
                                            <th>Table</th>
                                            <th class="longer-cell">Meas.</th>
                                            <th>Country</th>
                                        </tr> -->
                                <tr>
                                    <th class="text-left">Supplier</th>
                                    <th class="text-left">location</th>
                                    <th class="text-left">Shape</th>
                                    <th class="text-left">Size</th>
                                    <th class="text-left">Color</th>
                                    <th class="text-left">Clarity</th>
                                    <th class="text-left">Cut</th>
                                    <th class="text-left">Polish</th>
                                    <th class="text-left">Symm</th>
                                    <th class="text-left">Fluor.</th>
                                    <th class="text-left">Lab</th>
                                    <th class="text-left">Price</th>
                                    <th class="text-left">Depth</th>
                                    <th class="text-left">Table</th>
                                    <th class="longer-cell text-left">Measurement</th>
                                    <th class="text-left">Vendor Stock No.</th>
                                </tr>
                            </thead>
                            <tbody id="listdiamondData">
                                <!-- <tr>
                                             <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VVS2</td>
                                            <td>Excellent</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.29 x 2.32 x 1.45</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VVS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.25 x 2.28 x 1.37</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VVS2</td>
                                            <td>Good</td>
                                            <td>Good</td>
                                            <td>Fair</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.30 x 2.31 x 1.40</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.24 x 2.26 x 1.37</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Good</td>
                                            <td>Good</td>
                                            <td>Fair</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.28 x 2.30 x 1.39</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Good</td>
                                            <td>Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.35 x 2.36 x 1.41</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.28 x 2.31 x 1.40</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.32 x 2.34 x 1.39</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.30 x 2.32 x 1.42</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Slight</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.33 x 2.35 x 1.41</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS2</td>
                                            <td>Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Slight</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.23 x 2.25 x 1.35</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.36 x 2.38 x 1.40</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS2</td>
                                            <td>Excellent</td>
                                            <td>Excellent</td>
                                            <td>Excellent</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr><tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>VS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>SI1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>SI1</td>
                                            <td>Very Good</td>
                                            <td>Excellent</td>
                                            <td>Excellent</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>SI1</td>
                                            <td>Very Good</td>
                                            <td>Excellent</td>
                                            <td>Excellent</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>SI1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>SI1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>SI1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.04</td>
                                            <td>D</td>
                                            <td>SI2</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.24 x 2.25 x 1.34</td>
                                            <td>USA</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VVS1</td>
                                            <td>Good</td>
                                            <td>Good</td>
                                            <td>Fair</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.33 x 2.35 x 1.43</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VVS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.38 x 2.44 x 1.49</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VVS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell"></td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VVS2</td>
                                            <td>Good</td>
                                            <td>Good</td>
                                            <td>Fair</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.44 x 2.46 x 1.48</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VVS2</td>
                                            <td>Excellent</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Slight</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.48 x 2.49 x 1.51</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VVS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.36 x 2.37 x 1.42</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VVS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.54 x 2.56 x 1.54</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VVS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.45 x 2.47 x 1.48</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VVS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.43 x 2.45 x 1.48</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VVS2</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Slight</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.29 x 2.33 x 1.43</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr class="elements-count sr-only" data-number="40"></tr><tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VVS2</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.34 x 2.37 x 1.46</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VVS2</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.36 x 2.38 x 1.44</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VVS2</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.43 x 2.45 x 1.48</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VVS2</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.32 x 2.35 x 1.42</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VVS2</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.39 x 2.42 x 1.51</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VVS2</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.48 x 2.51 x 1.54</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VVS2</td>
                                                <td>Excellent</td>
                                                <td>Excellent</td>
                                                <td>Very Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.46 x 2.47 x 1.50</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VVS2</td>
                                                <td>Excellent</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.43 x 2.44 x 1.48</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VVS2</td>
                                                <td>Excellent</td>
                                                <td>Excellent</td>
                                                <td>Excellent</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.42 x 2.44 x 1.51</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VVS2</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.36 x 2.37 x 1.40</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VVS2</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.41 x 2.43 x 1.51</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VVS2</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.44 x 2.46 x 1.49</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VS1</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.31 x 2.33 x 1.46</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VS1</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.37 x 2.38 x 1.44</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VS1</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.43 x 2.44 x 1.48</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VS1</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Slight</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.40 x 2.42 x 1.44</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VS1</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.37 x 2.38 x 1.46</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VS1</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.38 x 2.39 x 1.50</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VS1</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Good</td>
                                                <td>None</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.43 x 2.46 x 1.51</td>
                                                <td>Italy</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                                </td>
                                                <td>Round</td>
                                                <td>0.05</td>
                                                <td>D</td>
                                                <td>VS1</td>
                                                <td>Very Good</td>
                                                <td>Very Good</td>
                                                <td>Good</td>
                                                <td>Very Slight</td>
                                                <td>IGI</td>
                                                <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                    <td></td>
                                                                <td></td>
                                                <td class="longer-cell">2.49 x 2.52 x 1.51</td>
                                                <td>Italy</td>
                                            </tr>
                                        <tr class="elements-count sr-only" data-number="60"></tr><tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.36 x 2.39 x 1.44</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.37 x 2.39 x 1.45</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.36 x 2.38 x 1.45</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Slight</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.32 x 2.36 x 1.40</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.51 x 2.53 x 1.50</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.41 x 2.42 x 1.47</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.32 x 2.37 x 1.44</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.34 x 2.36 x 1.46</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.34 x 2.36 x 1.44</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>Very Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.43 x 2.43 x 1.49</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Excellent</td>
                                            <td>Excellent</td>
                                            <td>Very Good</td>
                                            <td>Very Slight</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.46 x 2.47 x 1.51</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Slight</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.42 x 2.44 x 1.52</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.49 x 2.51 x 1.51</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.29 x 2.32 x 1.42</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.39 x 2.40 x 1.46</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>Very Slight</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.47 x 2.49 x 1.50</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.42 x 2.46 x 1.46</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.46 x 2.47 x 1.50</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.45 x 2.46 x 1.45</td>
                                            <td>Italy</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>
                                            </td>
                                            <td>Round</td>
                                            <td>0.05</td>
                                            <td>D</td>
                                            <td>VS1</td>
                                            <td>Very Good</td>
                                            <td>Very Good</td>
                                            <td>Good</td>
                                            <td>None</td>
                                            <td>IGI</td>
                                            <td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>
                                                <td></td>
                                                            <td></td>
                                            <td class="longer-cell">2.40 x 2.43 x 1.48</td>
                                            <td>Italy</td>
                                        </tr> -->
                                <tr class="elements-count sr-only" data-number="80"></tr>

                            </tbody>
                        </table>
                        <div class="loader" style="display: none;">
                            <div class="lds-ring">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="number-result"><span class="current-count">12</span> out of <span class="bold-text">100,00</span></div> -->
                    <div class="row">
                        <div class="text-left col-md-6"><b>Showing <span id="showdiamondentries"></span> entries</b>
                        </div>
                        <div class="text-right col-md-2 offset-4 setresscre"><b class="w-auto">Show <select
                                    class="form-control w-auto  ml-auto" id="diamond_per_page" name="diamond_per_page">
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="500">500</option>
                                    <option value="1000">1000</option>
                                </select> entries</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="diamond-card">
                        <div class="diamond-card__image-wrap">
                            <img class="diamond-card__image"
                                src="assets/uploads/2022/09/diamondimg/diamondimgBB7EA170-0CD7-400E-8BCC-120698B5C6DD1663070107.jpg"
                                alt="Loose round-cut diamond">
                            <div class="diamond-card__dots" aria-hidden="true">
                                <span class="diamond-card__dot is-active"></span>
                                <span class="diamond-card__dot"></span>
                            </div>
                        </div>

                        <h3 class="diamond-card__title">Lozenge, 0.7 ct, K, SI1</h3>
                        <p class="diamond-card__quality">Very Good, Very Good, Very Good</p>

                        <div class="diamond-card__meta">
                            <span class="diamond-card__country"><img class="diamond-card__flag"
                                    src="assets/images/india-flag.svg" alt="" aria-hidden="true">
                                India</span>
                            <div class="diamond-card__measurements"> <span>Measurement :</span> 10.49×5.92×2.00</div>
                        </div>
                        <div class="diamond-card__specs" aria-label="Diamond details">
                            <div class="diamond-card__spec">
                                <span class="diamond-card__icon" aria-hidden="true">◇</span>
                                <div><span class="diamond-card__label">Shape</span><strong
                                        class="diamond-card__value">Lozenge</strong></div>
                            </div>
                            <div class="diamond-card__spec">
                                <span class="diamond-card__icon" aria-hidden="true">♙</span>
                                <div><span class="diamond-card__label">Carat</span><strong
                                        class="diamond-card__value">0.7
                                        ct</strong></div>
                            </div>
                            <div class="diamond-card__spec">
                                <span class="diamond-card__icon" aria-hidden="true">♢</span>
                                <div><span class="diamond-card__label">Color</span><strong
                                        class="diamond-card__value">K</strong></div>
                            </div>
                            <div class="diamond-card__spec">
                                <span class="diamond-card__icon" aria-hidden="true">◎</span>
                                <div><span class="diamond-card__label">Clarity</span><strong
                                        class="diamond-card__value">SI1</strong></div>
                            </div>
                            <div class="diamond-card__spec">
                                <span class="diamond-card__icon" aria-hidden="true">♢</span>
                                <div><span class="diamond-card__label">Certification</span><strong
                                        class="diamond-card__value">GIA</strong></div>
                            </div>
                            <div class="diamond-card__spec">
                                <span class="diamond-card__icon" aria-hidden="true">⌖</span>
                                <div><span class="diamond-card__label">Country</span><strong
                                        class="diamond-card__value">IN
                                        India</strong></div>
                            </div>
                        </div>

                        <div class="diamond-card__prices">
                            <table aria-label="Diamond pricing">
                                <thead>
                                    <tr>
                                        <th>RAP%</th>
                                        <th>$/Ct</th>
                                        <th>$Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="price-value">-63.1</td>
                                        <td class="price-value">3,063</td>
                                        <td class="price-value">5,543</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <button class="diamond-card__button btn-gradient-green" type="button">
                            Access Prices <span class="diamond-card__button-arrow" aria-hidden="true">›</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>

<!-- book demo section start -->
  <section class="demo-section">

    <!-- Left Form Panel -->
     <div class="image-panel" aria-label="Diamond and jewelry showcase">
      <img
        src="<?php echo $config->getimageurl() ?>images/homepage/book-demo-image.png"
        alt="Premium loose diamonds and fine jewelry">
      <div class="image-overlay"></div>
    </div>
   

    <!-- Right Image Panel -->
     <div class="form-panel">
      <div class="form-content">

        <div class="welcome-tag">
          <i class="fa-regular fa-gem"></i>
          Welcome to TradeCVD
        </div>

        <h1>Book a <span>Demo</span></h1>

        <p class="subtitle">
          Connect with buyers, sellers, manufacturers, wholesalers
          and retailers in the lab-grown diamond and jewelry industry.
        </p>

        <form action="#" method="post">

          <div class="name-row">
            <label class="input-box">
              <i class="fa-regular fa-user fa"></i>
              <input type="text" name="first_name"
                placeholder="First Name*" required>
            </label>

            <label class="input-box">
              <i class="fa-regular fa-user fa"></i>
              <input type="text" name="last_name"
                placeholder="Last Name*" required>
            </label>
          </div>

          <label class="input-box">
            <i class="fa-regular fa-envelope fa"></i>
            <input type="email" name="email"
              placeholder="Business Email*" required>
          </label>

          <div class="phone-row">
            <span class="phone-icon">
              <i class="fa-solid fa-phone fa"></i>
            </span>

            <select name="country_code" aria-label="Country calling code">
              <option value="+91">🇮🇳</option>
              <option value="+1">🇺🇸</option>
              <option value="+44">🇬🇧</option>
              <option value="+971">🇦🇪</option>
              <option value="+852">🇭🇰</option>
            </select>

            <span class="dial-code">+91</span>

            <input type="tel" name="phone"
              placeholder="Phone Number*" required>
          </div>

          <label class="input-box">
            <i class="fa-regular fa-building fa"></i>
            <input type="text" name="company"
              placeholder="Company Name*" required>
          </label>

          <label class="input-box">
            <i class="fa-regular fa-briefcase fa"></i>
            <select name="business_type" required>
              <option value="" selected disabled>Business Type*</option>
              <option>Buyer</option>
              <option>Seller</option>
              <option>Manufacturer</option>
              <option>Wholesaler</option>
              <option>Retailer</option>
              <option>Jewelry Designer</option>
              <option>Other</option>
            </select>
            <i class="fa-solid fa-chevron-down select-arrow"></i>
          </label>

          <label class="input-box">
            <i class="fa-solid fa-globe fa"></i>
            <select name="country" required>
              <option value="" selected disabled>Country*</option>
              <option>India</option>
              <option>United States</option>
              <option>United Kingdom</option>
              <option>United Arab Emirates</option>
              <option>Hong Kong</option>
              <option>Belgium</option>
              <option>Other</option>
            </select>
            <i class="fa-solid fa-chevron-down select-arrow"></i>
          </label>

          <p class="privacy-text">
            By submitting your contact information, you authorize us
            to contact and promote our services to you across different
            services, websites and apps in accordance with our
            <a href="#">privacy policy</a>.
          </p>

          <button type="submit" class="submit-btn">
            <i class="fa-regular fa-paper-plane fa"></i>
            <span>Book a Demo</span>
            <i class="fa-solid fa-chevron-right arrow-right fa"></i>
          </button>

        </form>
      </div>
    </div>

  </section> 



<!-- Quick diamond Search End-->
<div class="hr-line">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-5">
                <hr />
            </div>
            <div class="col-1 col-hr">
                <div class="hr-img">
                    <img src="<?php echo $config->getimageurl() ?>images/homepage/diamonds.svg" alt="diamonds"
                        title="diamonds">
                </div>
            </div>
            <div class="col-5">
                <hr />
            </div>
        </div>
    </div>
</div>
<!-- jewelrysuits-section start -->
<section class="jewelrysuits-section section-space jewelrysuitsdetail"
    style="background-image: url(<?php echo $config->getImageurl(); ?>images/homepage/jewellery-bg.jpg);">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="jewelrysuits-data text-center sec-info">
                    <div class="jewelrysuits-title">
                        <h2 class="sec-title">Jewelry Suits You</h2>
                    </div>
                    <div class="jewelrysuits-desc">
                        <p class="sec-desc">Our trending and new arrivals</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="jewelrysuits-info" id="jewelrysuitsdetail">
                        <!-- <div class="owl-carousel owl-theme jewelrysuits-info-slider">
                            <div class="item jewelry-item">
                                <div class="jewelrysuits-cards">
                                    <div class="card border-rounded">
                                        <div class="jewelrysuits-images">
                                            <img class="border-rounded" src="assets/images/homepage/jewellery1.png" alt="jewellery1" title="jewellery1" />
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="jewelry-content">
                                                <div class="jewelry-content-text">
                                                    <h3>Heritage Link Necklace Adjustable <br > With Round Statement Hoops</h3>
                                                    <p class="text-gary">50cm/20</p>
                                                    <div class="col-12 p-0">
                                                        <div class="row">
                                                            <div class="col m-auto">
                                                                <div class="jewelry-content-meta text-yellow">
                                                                    <p>18ct gold plated</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="jewelry-content-meta">
                                                                    <a class="btn ht-btn ht-btn--transparent btn-white clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getWeburl(); ?>membershipplan">Get Subscription</a>
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
                            <div class="item jewelry-item">
                                <div class="jewelrysuits-cards">
                                    <div class="card">
                                        <div class="jewelrysuits-images">
                                            <img class="border-rounded" src="assets/images/homepage/jewellery2.png" alt="jewellery2" title="jewellery2" />
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="jewelry-content">
                                                <div class="jewelry-content-text">
                                                    <h3>Heritage Link Necklace Adjustable <br > With Round Statement Hoops</h3>
                                                    <p>50cm/20</p>
                                                    <div class="col-12 p-0">
                                                        <div class="row">
                                                            <div class="col m-auto">
                                                                <div class="jewelry-content-meta text-yellow">
                                                                    <p>18ct gold plated</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="jewelry-content-meta">
                                                                    <a class="btn ht-btn ht-btn--transparent btn-white clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getWeburl(); ?>membershipplan">Get Subscription</a>
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
                            <div class="item jewelry-item">
                                <div class="jewelrysuits-cards">
                                    <div class="card">
                                        <div class="jewelrysuits-images">
                                            <img class="border-rounded" src="assets/images/homepage/jewellery3.png" alt="jewellery3" title="jewellery3" />
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="jewelry-content">
                                                <div class="jewelry-content-text">
                                                    <h3>Heritage Link Necklace Adjustable <br > With Round Statement Hoops</h3>
                                                    <p>50cm/20</p>
                                                    <div class="col-12 p-0">
                                                        <div class="row">
                                                            <div class="col m-auto">
                                                                <div class="jewelry-content-meta text-yellow">
                                                                    <p>18ct gold plated</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="jewelry-content-meta">
                                                                    <a class="btn ht-btn ht-btn--transparent btn-white clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getWeburl(); ?>membershipplan">Get Subscription</a>
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
                            <div class="item jewelry-item">
                                <div class="jewelrysuits-cards">
                                    <div class="card">
                                        <div class="jewelrysuits-images">
                                            <img class="border-rounded" src="assets/images/homepage/jewellery1.png" alt="jewellery1" title="jewellery1" />
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="jewelry-content">
                                                <div class="jewelry-content-text">
                                                    <h3>Heritage Link Necklace Adjustable <br > With Round Statement Hoops</h3>
                                                    <p>50cm/20</p>
                                                    <div class="col-12 p-0">
                                                        <div class="row">
                                                            <div class="col m-auto">
                                                                <div class="jewelry-content-meta text-yellow">
                                                                    <p>18ct gold plated</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="jewelry-content-meta">
                                                                    <a class="btn ht-btn ht-btn--transparent btn-white clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getWeburl(); ?>membershipplan">Get Subscription</a>
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
                            <div class="item jewelry-item">
                                <div class="jewelrysuits-cards">
                                    <div class="card">
                                        <div class="jewelrysuits-images">
                                            <img class="border-rounded" src="assets/images/homepage/jewellery4.png" alt="jewellery4" title="jewellery4" />
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="jewelry-content">
                                                <div class="jewelry-content-text">
                                                    <h3>Heritage Link Necklace Adjustable <br > With Round Statement Hoops</h3>
                                                    <p>50cm/20</p>
                                                    <div class="col-12 p-0">
                                                        <div class="row">
                                                            <div class="col m-auto">
                                                                <div class="jewelry-content-meta text-yellow">
                                                                    <p>18ct gold plated</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="jewelry-content-meta">
                                                                    <a class="btn ht-btn ht-btn--transparent btn-white clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getWeburl(); ?>membershipplan">Get Subscription</a>
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
                        </div> -->
                    </div>
                </div>
                <!-- <div class="col-12">
                    <div class="viewmore-link text-right">
                        <a class="see-more-link" href="#">View More</a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>
<!-- jewelrysuits-section end  -->

<!-- Trade CVD's Quality start -->
<section class="gems-quality-sec section-space listsavanigemsquality">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sec-info text-center">
                    <h3 class="sec-title">Trade CVD's Quality</h3>
                    <div class="gems-q-desc">
                        <p class="sec-desc">Why Do So many Jewelers or Traders Prefer Trade CVD?</p>
                    </div>
                </div>
            </div>
            <div class="col-12 m-auto">
                <div class="justify-content-center quality-grid" id="listsavanigemsquality">
                    <!-- <div class="col-12 col-exs-6 col-sm-6 col-md-3 col-lg-4 col-xl-3 col-xxl-2 mb-4 mb-xxl-0">
                        <div class="gems-quality-card">
                            <div class="card border-rounded effect-border">
                                <div class="card-body">
                                    <div class="gems-quality-info">
                                        <div class="gems-quality-img text-center bg-soft-green">
                                            <img src="<?php echo $config->getimageurl() ?>images/homepage/mosttrusted.png" alt="Most Trusted" title="Most Trusted">
                                        </div>
                                        <div class="gems-quality-desc text-center">
                                            <div class="wrapper-title">
                                                <p>Most Trusted</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-exs-6 col-sm-6 col-md-3 col-lg-4 col-xl-3 col-xxl-2 mb-4 mb-xxl-0">
                        <div class="gems-quality-card">
                            <div class="card border-rounded effect-border">
                                <div class="card-body">
                                    <div class="gems-quality-info">
                                        <div class="gems-quality-img text-center bg-soft-purple">
                                            <img src="<?php echo $config->getimageurl() ?>images/homepage/certifieddiamond.svg" alt="Most Trusted" title="Most Trusted">
                                        </div>
                                        <div class="gems-quality-desc text-center">
                                            <div class="wrapper-title">
                                                <p>Tested Certified <br /> diamond</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-exs-6 col-sm-6 col-md-3 col-lg-4 col-xl-3 col-xxl-2 mb-4 mb-xxl-0">
                        <div class="gems-quality-card">
                            <div class="card border-rounded effect-border">
                                <div class="card-body">
                                    <div class="gems-quality-info">
                                        <div class="gems-quality-img text-center bg-soft-blue">
                                            <img src="<?php echo $config->getimageurl() ?>images/homepage/jewelryinsured.png" alt="Your Jewelry Insured" title="Your Jewelry Insured">
                                        </div>
                                        <div class="gems-quality-desc text-center">
                                            <div class="wrapper-title">
                                                <p>Your Jewelry <br />Insured</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-exs-6 col-sm-6 col-md-3 col-lg-4 col-xl-3 col-xxl-2 mb-4 mb-xxl-0">
                        <div class="gems-quality-card">
                            <div class="card border-rounded effect-border">
                                <div class="card-body">
                                    <div class="gems-quality-info">
                                        <div class="gems-quality-img text-center bg-soft-red">
                                            <img src="<?php echo $config->getimageurl() ?>images/homepage/complete-transparency.png" alt="Complete Transparency" title="Complete Transparency">
                                        </div>
                                        <div class="gems-quality-desc text-center">
                                            <div class="wrapper-title">
                                                <p>Complete <br />Transparency</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-exs-6 col-sm-6 col-md-3 col-lg-4 col-xl-3 col-xxl-2 mb-4 mb-xxl-0">
                        <div class="gems-quality-card effect-border">
                            <div class="card border-rounded effect-border">
                                <div class="card-body">
                                    <div class="gems-quality-info">
                                        <div class="gems-quality-img text-center bg-soft-orange">
                                            <img src="<?php echo $config->getimageurl() ?>images/homepage/competitive.png" alt="competitive" title="competitive">
                                        </div>
                                        <div class="gems-quality-desc text-center">
                                            <div class="wrapper-title">
                                                <p>Competitive</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Trade CVD's Quality end -->

<!-- Our Customers start  -->
<section class="our-customers-sec section-space bg-gray border-rounded customerdetail">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="our-customers-data text-center sec-info">
                    <div class="our-customers-title">
                        <h2 class="sec-title">Our Customers</h2>
                    </div>
                    <div class="our-customers-desc">
                        <p class="sec-desc">Many Buyers And Sellers have trust on us</p>
                    </div>
                </div>
            </div>
            <div class="col-12 " id="customerdetail">
                <!-- <div class="owl-carousel owl-theme our-customers-slider mb-3">
                    <div class="item">
                        <div class="our-customers-img"><img src="<?php echo $config->getimageurl() ?>images/homepage/customer1.png" alt="client" title="client"></div>
                    </div>
                    <div class="item">
                        <div class="our-customers-img"><img src="<?php echo $config->getimageurl() ?>images/homepage/customer2.png" alt="client" title="client"></div>
                    </div>
                    <div class="item">
                        <div class="our-customers-img"><img src="<?php echo $config->getimageurl() ?>images/homepage/customer3.png" alt="client" title="client"></div>
                    </div>
                    <div class="item">
                        <div class="our-customers-img"><img src="<?php echo $config->getimageurl() ?>images/homepage/customer4.png" alt="client" title="client"></div>
                    </div>
                    <div class="item">
                        <div class="our-customers-img"><img src="<?php echo $config->getimageurl() ?>images/homepage/customer5.png" alt="client" title="client"></div>
                    </div>
                    <div class="item">
                        <div class="our-customers-img"><img src="<?php echo $config->getimageurl() ?>images/homepage/customer5.png" alt="client" title="client"></div>
                    </div>
                    <div class="item">
                        <div class="our-customers-img"><img src="<?php echo $config->getimageurl() ?>images/homepage/customer5.png" alt="client" title="client"></div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>
<!-- Our Customers end  -->
<!-- Testimonial strat -->
<section class="testimonials section-space listtestimonial">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="testimonial-data text-center sec-info">
                    <div class="testimonial-title">
                        <h2 class="sec-title">Testimonial</h2>
                    </div>
                    <div class="testimonial-desc">
                        <p class="sec-desc">What Customers Says About us</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12" id="listtestimonial">
                <!-- <div class="customers-testimonials owl-carousel">   
                    <div class="item">
                        <div class="card wrapper">
                            <div class="card-body">
                                <div class="customers-info text-center">
                                <div class="customers-img"><img src="<?php echo $config->getimageurl() ?>images/user.png" alt="Abhinav Khanna" title="Abhinav Khanna"></div>
                                <div class="customers-name"><h3 class="wrapper-title">Abhinav Khanna<h3></div>
                                <div class="customers-designation"><p>CEO Of Calibary diamond</p></div>
                                    <div class="customers-rate star-rating">
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="customers-desc mt-4">
                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi Loremipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card wrapper">
                            <div class="card-body">
                                <div class="customers-info text-center">
                                <div class="customers-img"><img src="<?php echo $config->getimageurl() ?>images/user.png" alt="Harshad Varma" title="Harshad Varma"></div>
                                <div class="customers-name"><h3 class="wrapper-title">Harshad Varma<h3></div>
                                <div class="customers-designation"><p>Dealer</p></div>
                                    <div class="customers-rate star-rating">
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="customers-desc mt-4">
                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi Loremipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card wrapper">
                            <div class="card-body">
                                <div class="customers-info text-center">
                                <div class="customers-img"><img src="<?php echo $config->getimageurl() ?>images/user.png" alt="Richa Dave" title="Richa Dave"></div>
                                <div class="customers-name"><h3 class="wrapper-title">Richa Dave<h3></div>
                                <div class="customers-designation"><p>Customer</p></div>
                                    <div class="customers-rate star-rating">
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="customers-desc mt-4">
                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi Loremipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card wrapper">
                            <div class="card-body">
                                <div class="customers-info text-center">
                                <div class="customers-img"><img src="<?php echo $config->getimageurl() ?>images/user.png" alt="Abhinav Khanna" title="Abhinav Khanna"></div>
                                <div class="customers-name"><h3 class="wrapper-title">Abhinav Khanna<h3></div>
                                <div class="customers-designation"><p>CEO Of Calibary diamond</p></div>
                                    <div class="customers-rate star-rating">
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="customers-desc mt-4">
                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi Loremipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card wrapper">
                            <div class="card-body">
                                <div class="customers-info text-center">
                                <div class="customers-img"><img src="<?php echo $config->getimageurl() ?>images/user.png" alt="Abhinav Khanna" title="Abhinav Khanna"></div>
                                <div class="customers-name"><h3 class="wrapper-title">Abhinav Khanna<h3></div>
                                <div class="customers-designation"><p>CEO Of Calibary diamond</p></div>
                                    <div class="customers-rate star-rating">
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                        <i class="fa fa-star rating" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="customers-desc mt-4">
                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi Loremipsum dolor sit amet consectetur adipiscing elit. Donec ac molestie eros, ut hendrerit ex. Interdum et maada fames ac ante ipsum primi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="col-12 text-center">
                <div class="viewmore-link">
                    <a class="see-more-link clspageparentmenu" pagename="testimonials"
                        href="<?php echo $config->getWeburl(); ?>testimonials">View More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial end -->

<!-- Frequently Asked Questions start -->
<section class="frequently-askque-sec section-space bg-gray border-rounded listhomefaq"
    style="background-image: url(<?php echo $config->getImageurl(); ?>assets/images/frequentlyaskque-bg.png);">
    <div class="container">
        <div class="row">
            <div class="col-11 m-auto">
                <div class="testimonial-data text-center sec-info mb-0">
                    <div class="testimonial-title">
                        <h2 class="sec-title text-green">Frequently Asked Questions</h2>
                    </div>
                </div>
            </div>
            <div class="col-11 m-auto text-center">
                <div class="sec-info mt-0">
                    <div class="frequently-askque-title">
                        <p class="sec-desc">Select Category for quick Suggestion</p>
                    </div>
                </div>
            </div>
            <div class="col-11 m-auto">
                <div class="frequently-askque-list">
                    <ul class="nav nav-pills listfaqgroup" id="pills-tab" role="tablist">
                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link active orange-card" id="pills-membership-tab" data-toggle="pill" data-target="#pills-membership" type="button" role="tab" aria-controls="pills-membership" aria-selected="true">
                                <div class="frequently-data-info">
                                    <div class="frequently-data-img">
                                        <img src="<?php echo $config->getimageurl() ?>images/homepage/membership.svg" alt="Membership" title="Membership">
                                    </div>
                                    <div class="wrapper-title">
                                        <p>Membership</p>
                                    </div>
                                </div>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link purple-card" id="pills-sale-tab" data-toggle="pill" data-target="#pills-sale" type="button" role="tab" aria-controls="pills-sale" aria-selected="false">
                                <div class="frequently-data-info">
                                    <div class="frequently-data-img">
                                        <img src="<?php echo $config->getimageurl() ?>images/homepage/sale.svg" alt="Sale" title="Sale">
                                    </div>
                                    <div class="wrapper-title">
                                        <p>Sale</p>
                                    </div>
                                </div>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link green-card" id="pills-purchase-tab" data-toggle="pill" data-target="#pills-purchase" type="button" role="tab" aria-controls="pills-purchase" aria-selected="false">
                                <div class="frequently-data-info">
                                    <div class="frequently-data-img">
                                        <img src="<?php echo $config->getimageurl() ?>images/homepage/purchase.svg" alt="Purchase" title="Purchase">
                                    </div>
                                    <div class="wrapper-title">
                                        <p>Purchase</p>
                                    </div>
                                </div>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link blue-card" id="pills-payment-tab" data-toggle="pill" data-target="#pills-payment" type="button" role="tab" aria-controls="pills-payment" aria-selected="false">
                                <div class="frequently-data-info">
                                    <div class="frequently-data-img">
                                        <img src="<?php echo $config->getimageurl() ?>images/homepage/payment.svg" alt="Payment" title="Payment">
                                    </div>
                                    <div class="wrapper-title">
                                        <p>Payment</p>
                                    </div>
                                </div>
                            </button>
                        </li> -->
                    </ul>
                    <div class="frequently-askque-tab tab-content listfaqs" id="pills-tabContent">
                        <!-- <div class="tab-pane fade show active" id="pills-membership" role="tabpanel" aria-labelledby="pills-membership-tab">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0 btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Who can become a Trade CVD member? <i class="fa fa-chevron-down rotate-icon" aria-hidden="true"></i>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                               <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0 btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            How do I become a member of Trade CVD <i class="fa fa-chevron-down rotate-icon" aria-hidden="true"></i>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-sale" role="tabpanel" aria-labelledby="pills-sale-tab"> 
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0 btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Lorem ipsum dolor sit amet. <i class="fa fa-chevron-down rotate-icon" aria-hidden="true"></i>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0 btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                           Lorem ipsum dolor sit amet consectetur adipisicing. <i class="fa fa-chevron-down rotate-icon" aria-hidden="true"></i>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-purchase" role="tabpanel" aria-labelledby="pills-purchase-tab">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0 btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Lorem ipsum dolor sit amet consectetur. <i class="fa fa-chevron-down rotate-icon" aria-hidden="true"></i>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0 btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. <i class="fa fa-chevron-down rotate-icon" aria-hidden="true"></i>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0 btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Lorem ipsum dolor sit amet. <i class="fa fa-chevron-down rotate-icon" aria-hidden="true"></i>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0 btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur. <i class="fa fa-chevron-down rotate-icon" aria-hidden="true"></i>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include('js.php'); ?>
<script>

    /* $(".send-btn").click(function() {
       $('#free-search-result').removeClass('d-none');
    }) */
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
        fillsliderdetail();
    });

    function fillsliderdetail() {

        var pagename = getpagename();
        var headersdata = { Accept: 'application/json', platform: 4, userpagename: pagename, useraction: '', masterlisting: false, responsetype: 'JSON' };

        formdata = new FormData();
        formdata.append("action", "fillsliderdetail");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessfillsliderdetail, OnErrorfillsliderdetail);
        function Onsuccessfillsliderdetail(content) {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                $('.sliderdetail').html('');
                $('.sliderdetail').addClass('d-none');
            }
            else if (resultdata.status == 1) {
                $('.sliderdetail').removeClass('d-none');
                // htmldata += '<div class="banner-slider owl-carousel owl-theme">';
                htmldata += '<div class="banner-slider">';
                for (var i in resultdata.data) {
                    // htmldata += '<div class="item">';
                    htmldata += '<div class="items">';
                    htmldata += '<div class="slider-banner m-0">';
                    htmldata += '<div class="item-banner" style="background-image: url(' + resultdata.data[i].image + ');">';
                    var banner = resultdata.data[i];

                    htmldata += '<div class="w-100">';
                    htmldata += '<div class="d-flex flex-column">';

                    htmldata += '<div class="row m-0 align-items-center banner-left-content">';
                    htmldata += '<div class="col-12 col-md-6 col-lg-5 px-lg-0 banner-container container-xl">';
                    htmldata += '<h1 class="banner-title animate__animated animate__fadeInLeft">' + resultdata.data[i].title + '</h1>';
                    htmldata += '<span class="title-text">' + 'Discover diamonds and jewellery, connect with buyers and sellers, and explore new trade opportunities on Trade CVD. A dedicated marketplace to source, showcase, and trade                		diamonds and jewellery with confidence.' + '</span>'

                    htmldata += '<div>';
                    htmldata += '<button class="buy-btn btn d-flex align-items-center">';
                    htmldata += '<span class="text-start leading-18 text-uppercase fw-semibold">'
                        + resultdata.data[i].btntext
                        + '</span>';
                    htmldata += '</button>';
                    htmldata += '</div>';
                    // htmldata += '<div class="banner-content">';
                    // htmldata += '<div class="banner-info">';
                    // htmldata += '<div class="banner-desc">';
                    // htmldata += '<p>' + resultdata.data[i].subtitle + '</p>';
                    // htmldata += '</div>';
                    // htmldata += '<h1 class="banner-title animate__animated animate__fadeInLeft">' + resultdata.data[i].title + '</h1>';
                    // htmldata += '</div>';
                    // htmldata += '<hr>'
                    // htmldata += '<span class="title-text">' + 'The Worlds Trusted Marketplace for <br/> lab grown diamonds & fine jewelry.' + '</span>'

                    // htmldata += '<div class="explore-btn d-flex">';
                    // htmldata += '<button class="buy-btn btn d-flex align-items-center">' +
                    //     '<img src="' + resultdata.data[i].btnimg + '" />' +
                    //     '<span class="text-start leading-18 text-uppercase fw-semibold">' + resultdata.data[i].btntext + '<br/>' + '<span class="fs-12 text-capitalize fw-normal">' + 'Explore certified  diamonds' + '</span>' + '</span>' +
                    //     '</button>';

                    // htmldata += '<button class="buy-btn btn d-flex align-items-center">' +
                    //     '<img src="' + resultdata.data[i].sellimg + '" />' +
                    //     '<span class="text-start leading-18 text-uppercase fw-semibold">' + resultdata.data[i].sellbtn + '<br/>' + '<span class="fs-12 text-capitalize fw-normal">' + 'list yours  diamonds' + '</span>' + '</span>' +
                    //     '</button>';

                    // htmldata += '</div>';

                    // htmldata += '<div class="banner-bottom-content">';
                    // htmldata += '<div class="bottom-section">';
                    // htmldata += '<img src="' + resultdata.data[i].certifiedimge + '" />';
                    // htmldata += '<p>' + '100% Certified' + '</p>';
                    // htmldata += '<span>' + 'IGI / GCAL / GIA' + '</span>';
                    // htmldata += '</div>';



                    // htmldata += '<div class="bottom-section">';
                    // htmldata += '<img src="' + resultdata.data[i].networkimage + '" />';
                    // htmldata += '<p>' + 'Global network' + '</p>';
                    // htmldata += '<span>' + 'trusted suppliers' + '</span>';
                    // htmldata += '</div>';

                    // htmldata += '<div class="bottom-section">';
                    // htmldata += '<img src="' + resultdata.data[i].priceimage + '" />';
                    // htmldata += '<p>' + 'best prices' + '</p>';
                    // htmldata += '<span>' + 'trusted suppliers' + '</span>';
                    // htmldata += '</div>';

                    // htmldata += '<div class="bottom-section">';
                    // htmldata += '<img src="' + resultdata.data[i].secureimage + '" />';
                    // htmldata += '<p>' + 'secure & safe' + '</p>';
                    // htmldata += '<span>' + 'insured transaction' + '</span>';
                    // htmldata += '</div>';
                    // htmldata += '</div>';


                    // htmldata += '</div>';
                    // htmldata += '</div>';

                    htmldata += '</div>';
                    htmldata += '<div class="col-md-6 px-0">';
                    htmldata += '<div class="top-right-images-banner">';
                    htmldata += '<picture>';
                    htmldata += '<source media="(max-width: 991px)" srcset="' + (banner.tabletimage || banner.toprightimg) + '">';
                    htmldata += '<img src="' + banner.toprightimg + '" alt="Trade CVD diamonds and jewellery">';
                    htmldata += '</picture>';
                    htmldata += '</div>';
                    htmldata += '<div class="d-flex justify-content-center align-items-center find-explore-connect">';

                    // Find Diamonds
                    htmldata += '<div class="d-flex align-items-center">';
                    htmldata += '<div class="mr-2 mr-xl-3">';
                    htmldata += '<svg width="30px" height="30px" viewBox="100 117 312 312" xmlns="http://www.w3.org/2000/svg">';
                    htmldata += '<polygon fill="#7CAB81" points="408.566,224.453 103.434,224.453 164.461,132.913 347.539,132.913"></polygon>';
                    htmldata += '<polygon fill="#65986D" points="347.539,132.913 256,132.913 256,224.453 408.566,224.453"></polygon>';
                    htmldata += '<polygon fill="#97BF9A" points="347.539,132.913 317.026,224.453 256,132.913"></polygon>';
                    htmldata += '<polygon fill="#97BF9A" points="256,132.913 194.974,224.453 164.461,132.913"></polygon>';
                    htmldata += '<polygon fill="#97BF9A" points="408.566,224.453 256,407.531 103.434,224.453"></polygon>';
                    htmldata += '<polygon fill="#7CAB81" points="317.026,224.453 256,407.531 194.974,224.453"></polygon>';
                    htmldata += '<polygon fill="#65986D" points="256,224.453 256,407.531 317.026,224.453"></polygon>';
                    htmldata += '</svg>';
                    htmldata += '</div>';
                    htmldata += '<h2 class="mb-0">Find Diamonds</h2>';
                    htmldata += '</div>';

                    // Explore Jewellery
                    htmldata += '<div class="d-flex align-items-center">';
                    htmldata += '<div class="mr-2 mr-xl-3">';
                    htmldata += '<svg width="30px" height="30px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">';
                    htmldata += '<path fill="#093823" d="M191.02 25.346l-22.9 34.35h30.714l22.9-34.35H191.02zm52.347 0l-22.898 34.35h71.06l-22.897-34.35h-25.266zm46.9 0l22.9 34.35h30.714l-22.9-34.35h-30.714zm-117.234 52.35l50.115 50.115-25.058-50.115h-25.057zm45.182 0L256 153.265l37.785-75.57h-75.57zm95.695 0l-25.058 50.115 50.115-50.115H313.91zm-134.435 31.898C109.163 139.5 59.693 209.29 59.693 290.348c0 108.185 88.122 196.306 196.307 196.306 108.185 0 196.307-88.12 196.307-196.306 0-81.057-49.47-150.848-119.782-180.754l-30.517 30.517c64.397 19.592 111.037 79.292 111.037 150.238 0 86.966-70.08 157.045-157.045 157.045-86.966 0-157.045-70.08-157.045-157.045 0-70.946 46.64-130.646 111.037-150.237l-30.517-30.516z"/>';
                    htmldata += '</svg>';
                    htmldata += '</div>';
                    htmldata += '<h2 class="mb-0">Explore jewellery</h2>';
                    htmldata += '</div>';

                    // Connect & Trade
                    htmldata += '<div class="d-flex align-items-center">';
                    htmldata += '<div class="mr-2 mr-xl-3">';
                    htmldata += '<svg fill="#669934" stroke="#669934" width="30px" height="30px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">';
                    htmldata += '<path d="M73.237,341.312l-50.539-0.021c3.797-14.379,15.125-25.92,30.101-29.675l42.069-10.517c3.819-0.939,6.805-3.925,7.765-7.744l4.352-17.408c0.725-2.923,0.192-6.037-1.515-8.555c-1.685-2.496-4.373-4.16-7.381-4.587c-12.992-1.813-22.933-4.565-29.803-6.955c6.763-11.648,14.251-32.405,14.251-67.115c0-49.941,36.437-60.757,45.461-60.757c10.389,0,12.181,1.685,16.064,5.312c4.288,4.032,11.029,3.84,15.083-0.448c4.053-4.288,3.84-11.051-0.448-15.083c-8.853-8.32-16.597-11.136-30.699-11.136c-20.928,0-66.795,20.672-66.795,82.091c0,48.576-16.149,62.891-16.128,62.891c-2.859,2.133-4.437,5.525-4.245,9.088c0.171,3.541,2.091,6.763,5.141,8.597c0.619,0.363,13.205,7.808,37.525,12.651l-35.861,8.981C19.584,297.941,0,323.051,0,351.979c0,5.888,4.779,10.667,10.667,10.667h62.571c5.888,0,10.667-4.779,10.667-10.667S79.125,341.312,73.237,341.312z"/>';
                    htmldata += '<path d="M464.363,290.923l-35.861-8.96v-0.043c24.149-4.843,36.864-12.224,37.461-12.587c2.944-1.749,4.757-4.928,5.056-8.384c0.277-3.435-1.237-6.912-3.861-9.131c-0.171-0.128-16.384-14.421-16.384-63.083c0-47.701-12.16-71.872-36.181-71.872h-0.811c-7.872-7.168-14.827-10.219-29.781-10.219c-6.293,0-14.656,2.219-22.955,6.123c-5.333,2.496-7.637,8.853-5.141,14.187c2.517,5.333,8.896,7.595,14.187,5.12c6.933-3.243,12.117-4.096,13.909-4.096c10.88,0,12.245,1.344,17.941,7.083c2.005,1.984,4.715,3.115,7.552,3.115h5.099c9.152,0,14.848,19.371,14.848,50.539c0,34.688,7.467,55.424,14.229,67.072c-6.891,2.411-16.875,5.163-29.803,6.976c-3.008,0.405-5.675,2.091-7.36,4.587c-1.707,2.517-2.24,5.611-1.515,8.555l4.352,17.429c0.96,3.819,3.925,6.827,7.765,7.765l42.069,10.517c14.976,3.755,26.304,15.296,30.101,29.696h-50.496v21.333l62.549-0.021c5.888,0,10.667-4.779,10.667-10.667C512,323.029,492.416,297.941,464.363,290.923z"/>';
                    htmldata += '<path d="M364.608,336.512l-51.136-12.779l-1.557-6.293c34.859-6.421,53.035-16.981,53.845-17.472c2.987-1.771,4.864-4.971,5.12-8.448c0.256-3.477-1.28-6.933-3.989-9.131c-0.213-0.192-23.723-20.203-23.723-88.981c0-62.464-15.296-94.144-45.461-94.144h-2.603c-10.027-9.451-18.475-13.909-39.125-13.909c-27.307,0-87.189,27.2-87.189,108.053c0,68.779-23.488,88.789-23.552,88.853c-2.837,2.112-4.437,5.525-4.245,9.067c0.171,3.541,2.091,6.763,5.141,8.597c0.832,0.491,18.816,11.115,53.909,17.536l-1.536,6.251l-51.136,12.779c-36.523,9.131-62.037,41.813-62.037,79.488c0,2.837,1.109,5.568,3.115,7.552s4.715,3.115,7.552,3.115h319.979c5.888,0,10.667-4.779,10.667-10.667C426.645,378.304,401.131,345.643,364.608,336.512z M107.605,405.291c4.117-23.189,21.44-42.24,44.949-48.107l57.344-14.336c3.819-0.96,6.805-3.947,7.765-7.765l5.909-23.744c0.725-2.944,0.192-6.059-1.515-8.555c-1.685-2.496-4.373-4.16-7.381-4.587c-20.992-2.923-36.309-7.659-45.824-11.307c9.365-14.229,21.291-42.389,21.291-93.525c0-71.275,52.8-86.72,65.856-86.72c15.808,0,18.688,2.24,27.264,10.795c2.005,1.984,4.715,3.115,7.552,3.115h6.933c15.339,0,24.128,26.539,24.128,72.811c0,51.093,11.883,79.232,21.248,93.483c-9.579,3.669-24.939,8.405-45.824,11.328c-3.008,0.405-5.675,2.091-7.36,4.587c-1.707,2.517-2.24,5.632-1.515,8.555l5.931,23.765c0.96,3.819,3.925,6.827,7.765,7.765l57.344,14.336c23.488,5.867,40.832,24.939,44.928,48.128L107.605,405.291z"/>';
                    htmldata += '</svg>';
                    htmldata += '</div>';
                    htmldata += '<h2 class="mb-0">Connect &amp; Trade</h2>';
                    htmldata += '</div>';


                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';




                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                }
                htmldata += '</div>';
                $('.sliderdetail').html(htmldata);
                // $('.banner-slider').owlCarousel({
                //     loop: true,
                //     margin: 0,
                //     nav: true,
                //     responsive: {
                //         0: {
                //             items: 1
                //         },
                //         600: {
                //             items: 1
                //         },
                //         1000: {
                //             items: 1
                //         }
                //     }
                // });

            }

        }

        function OnErrorfillsliderdetail(content) {
            ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
        }
        fillcustomerdetail();
    }

    function fillcustomerdetail() {

        var pagename = getpagename();
        var headersdata = { Accept: 'application/json', platform: 4, userpagename: pagename, useraction: '', masterlisting: false, responsetype: 'JSON' };

        formdata = new FormData();
        formdata.append("action", "fillcustomerdetail");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessfillcustomerdetail, OnErrorfillcustomerdetail);
        function Onsuccessfillcustomerdetail(content) {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                $('#customerdetail').html('');
                $('.customerdetail').addClass('d-none');
            }
            else if (resultdata.status == 1) {
                $('.customerdetail').removeClass('d-none');
                htmldata += '<div class="owl-carousel owl-theme our-customers-slider mb-3">';
                for (var i in resultdata.data) {
                    htmldata += '<div class="item">';
                    htmldata += '    <div class="our-customers-img"><img src="' + resultdata.data[i].image + '" class="image-dark" alt="' + resultdata.data[i].title + '" title="' + resultdata.data[i].title + '"></div>';
                    htmldata += '</div>';
                }
                htmldata += '</div>';
                $('#customerdetail').html(htmldata);
                $('.our-customers-slider').owlCarousel({
                    loop: false,
                    nav: true,
                    dots: true,
                    margin: 30,
                    responsiveClass: true,
                    autoplay: false,
                    autoplayHoverPause: true,
                    lazyLoad: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        375: {
                            items: 3
                        }
                    }
                });

            }


        }

        function OnErrorfillcustomerdetail(content) {
            ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
        }
        listtestimonial();
    }
    function listtestimonial() {

        var pagename = getpagename();
        var headersdata = { Accept: 'application/json', platform: 4, userpagename: pagename, useraction: '', masterlisting: false, responsetype: 'JSON' };

        formdata = new FormData();
        formdata.append("action", "listtestimonial");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>testimonial', formdata, headersdata, Onsuccesslisttestimonial, OnErrorlisttestimonial);
        function Onsuccesslisttestimonial(content) {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                $('#listtestimonial').html('');
                $('.listtestimonial').addClass('d-none');
            }
            else if (resultdata.status == 1) {
                $('.listtestimonial').removeClass('d-none');
                htmldata += '<div class="customers-testimonials owl-carousel">';
                for (var i in resultdata.result) {
                    htmldata += '<div class="item">';
                    htmldata += '<div class="card wrapper">';
                    htmldata += '<div class="card-body">';
                    htmldata += '<div class="customers-info text-center">';
                    htmldata += '<div class="customers-img"><img src="' + resultdata.result[i].image + '" alt="' + resultdata.result[i].name + '" title="' + resultdata.result[i].name + '"></div>';
                    htmldata += '<div class="customers-name"><h3 class="wrapper-title">' + resultdata.result[i].name + '<h3></div>';
                    htmldata += '<div class="customers-designation"><p>' + resultdata.result[i].designation + ' Of ' + resultdata.result[i].company + '</p></div>';
                    htmldata += '<div class="customers-rate star-rating">';
                    htmldata += '<i class="fa fa-star rating" aria-hidden="true"></i>';
                    htmldata += '<i class="fa fa-star rating" aria-hidden="true"></i>';
                    htmldata += '<i class="fa fa-star rating" aria-hidden="true"></i>';
                    htmldata += '<i class="fa fa-star rating" aria-hidden="true"></i>';
                    htmldata += '<i class="fa fa-star rating" aria-hidden="true"></i>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="customers-desc mt-4">';
                    htmldata += '<p>' + resultdata.result[i].description + '</p>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                }
                htmldata += '</div>';
                $('#listtestimonial').html(htmldata);
                $('.customers-testimonials').owlCarousel({
                    loop: true,
                    center: true,
                    items: 3,
                    nav: true,
                    margin: 0,
                    autoplay: false,
                    dots: false,
                    autoplayTimeout: 8500,
                    smartSpeed: 450,
                    responsive: {
                        0: {
                            items: 1
                        },
                        768: {
                            items: 2
                        },
                        1170: {
                            items: 3
                        }
                    }
                });

            }

        }

        function OnErrorlisttestimonial(content) {
            ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
        }
        listfaqgroup();
    }

    function listfaqgroup() {

        var pagename = getpagename();
        var headersdata = { Accept: 'application/json', platform: 4, userpagename: pagename, useraction: '', masterlisting: false, responsetype: 'JSON' };

        formdata = new FormData();
        formdata.append("action", "listfaqgroup");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>faqs', formdata, headersdata, Onsuccesslistfaqgroup, OnErrorlistfaqgroup);
        function Onsuccesslistfaqgroup(content) {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                $('.listhomefaq').addClass('d-none');
            }
            else if (resultdata.status == 1) {
                $('.listhomefaq').removeClass('d-none');
                for (var i in resultdata.result) {
                    var btnactive = '';
                    var selexpand = 'false';
                    if (i == 0) {
                        btnactive = 'active';
                        selexpand = 'true';
                    }
                    htmldata += '<li class="nav-item " role="presentation">';
                    htmldata += '<button class="nav-link green-card ' + btnactive + '" id="pills-faq-tab' + resultdata.result[i].id + '" data-toggle="pill" data-target="#pills-faq' + resultdata.result[i].id + '" type="button" role="tab" aria-controls="pills-faq' + resultdata.result[i].id + '" aria-selected="' + selexpand + '">';
                    htmldata += '<div class="frequently-data-info">';
                    htmldata += '<div class="frequently-data-img">';
                    htmldata += '<img src="' + resultdata.result[i].image + '" alt="' + resultdata.result[i].name + '" title="' + resultdata.result[i].name + '">';
                    htmldata += '</div>';
                    htmldata += '<div class="wrapper-title">';
                    htmldata += '<p>' + resultdata.result[i].name + '</p>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</button>';
                    htmldata += '</li>';
                }
                $('.listfaqgroup').html(htmldata);

            }
        }

        function OnErrorlistfaqgroup(content) {
            ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
        }

        listfaqs();
    }

    function listfaqs() {

        var pagename = getpagename();
        var headersdata = { Accept: 'application/json', platform: 4, userpagename: pagename, useraction: '', masterlisting: false, responsetype: 'JSON' };

        formdata = new FormData();
        formdata.append("action", "listfaqs");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>faqs', formdata, headersdata, Onsuccesslistfaqs, OnErrorlistfaqs);
        function Onsuccesslistfaqs(content) {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                $('.listhomefaq').addClass('d-none');
            }
            else if (resultdata.status == 1) {
                $('.listhomefaq').removeClass('d-none');
                for (var i in resultdata.result) {
                    var clsactive = '';
                    if (i == 0) {
                        clsactive = 'show active';
                    }
                    htmldata += '<div class="tab-pane fade ' + clsactive + '" id="pills-faq' + resultdata.result[i].id + '" role="tabpanel" aria-labelledby="pills-faq-tab' + resultdata.result[i].id + '">';
                    htmldata += '<div id="accordion">';

                    for (var j in resultdata.result[i].faqs) {
                        htmldata += '<div class="card">';

                        var clsshow = '';
                        var clscollapsed = 'collapsed';
                        var clsexpand = "true";
                        if (j == 0) {
                            // clsshow='show';
                            // clscollapsed='';
                            // clsexpand='false';
                        }
                        htmldata += '<div class="card-header" id="heading' + resultdata.result[i].faqs[j].id + '">';
                        htmldata += '<h5 class="mb-0 btn-link ' + clscollapsed + '" data-toggle="collapse" data-target="#collapse' + resultdata.result[i].faqs[j].id + '" aria-expanded="' + clsexpand + '" aria-controls="collapse' + resultdata.result[i].faqs[j].id + '">';
                        htmldata += '' + resultdata.result[i].faqs[j].question + ' <i class="fa fa-chevron-down rotate-icon" aria-hidden="true"></i>';
                        htmldata += '</h5>';
                        htmldata += '</div>';
                        htmldata += '<div id="collapse' + resultdata.result[i].faqs[j].id + '" class="collapse ' + clsshow + '" aria-labelledby="heading' + resultdata.result[i].faqs[j].id + '" data-parent="#accordion">';
                        htmldata += '<div class="card-body">';
                        htmldata += resultdata.result[i].faqs[j].answer;
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                    }



                    htmldata += '</div>';
                    htmldata += '</div>';
                }
                $('.listfaqs').html(htmldata);

            }
        }

        function OnErrorlistfaqs(content) {
            ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
        }
        listsavanigemsquality();

    }

    function listsavanigemsquality() {

        var pagename = getpagename();
        var headersdata = { Accept: 'application/json', platform: 4, userpagename: pagename, useraction: '', masterlisting: false, responsetype: 'JSON' };

        formdata = new FormData();
        formdata.append("action", "listsavanigemsquality");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccesslistsavanigemsquality, OnErrorlistsavanigemsquality);
        function Onsuccesslistsavanigemsquality(content) {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                $('#listsavanigemsquality').html('');
                $('.listsavanigemsquality').addClass('d-none');
            }
            else if (resultdata.status == 1) {
                $('.listsavanigemsquality').removeClass('d-none');
                for (var i in resultdata.result) {
                    // htmldata += '<div class="setresmos">';
                    htmldata += '<div class="gems-quality-card quality-card">';
                    // htmldata += '<div class="card border-rounded effect-border">';
                    // htmldata += '<div class="card-body">';
                    htmldata += '<div class="gems-quality-info">';
                    htmldata += '<div class="gems-quality-img text-center">';
                    htmldata += '<img src="' + resultdata.result[i].image + '" alt="' + resultdata.result[i].title + '" title="' + resultdata.result[i].title + '">';
                    // htmldata += '<div class="icon">' + resultdata.result[i].icon + '</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="gems-quality-desc text-center">';
                    htmldata += '<div class="wrapper-title">';
                    htmldata += '<h3>' + resultdata.result[i].title + '</h3>';
                    htmldata += '<p>' + resultdata.result[i].description + '</p>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    // htmldata += '</div>';
                    // htmldata += '</div>';
                    htmldata += '</div>';
                    // htmldata += '</div>';
                }
                $('#listsavanigemsquality').html(htmldata);
            }

        }

        function OnErrorlistsavanigemsquality(content) {
            ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
        }
        listjewelrysuitsdetail();
    }
    function listjewelrysuitsdetail() {

        var pagename = getpagename();
        var headersdata = { Accept: 'application/json', platform: 4, userpagename: pagename, useraction: '', masterlisting: false, responsetype: 'JSON' };

        formdata = new FormData();
        formdata.append("action", "listjewelrysuitsdetail");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccesslistjewelrysuitsdetail, OnErrorlistjewelrysuitsdetail);
        function Onsuccesslistjewelrysuitsdetail(content) {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                $('#jewelrysuitsdetail').html('');
                $('.jewelrysuitsdetail').addClass('d-none');
            }
            else if (resultdata.status == 1) {
                $('.jewelrysuitsdetail').removeClass('d-none');
                htmldata += '<div class="owl-carousel owl-theme jewelrysuits-info-slider">';

                for (var i in resultdata.result) {
                    htmldata += '<div class="item jewelry-item">';
                    htmldata += '<div class="jewelrysuits-cards">';
                    htmldata += '<div class="card border-rounded">';
                    htmldata += '<div class="jewelrysuits-images">';
                    htmldata += '<img class="border-rounded" src="' + resultdata.result[i].image + '" alt="' + resultdata.result[i].title + '" title="' + resultdata.result[i].title + '" />';
                    htmldata += '</div>';
                    htmldata += '<div class="card-body p-0">';
                    htmldata += '<div class="jewelry-content">';
                    htmldata += '<div class="jewelry-content-text">';
                    // htmldata+='<h3>'+resultdata.result[i].title+'</h3>';
                    // htmldata+='<p class="text-gary">50cm/20</p>';
                    htmldata += '<div class="col-12 p-0">';
                    htmldata += '<div class="row">';
                    htmldata += '<div class="col m-auto">';
                    htmldata += '<div class="jewelry-content-meta text-yellow">';
                    htmldata += '<p>' + resultdata.result[i].title + '</p>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="col-auto">';
                    htmldata += '<div class="jewelry-content-meta">';
                    htmldata += '<a class="btn ht-btn ht-btn--transparent btn-white clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getWeburl(); ?>membershipplan">Get Subscription</a>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';


                }
                htmldata += '</div>';
                $('#jewelrysuitsdetail').html(htmldata);
                $('.jewelrysuits-info-slider').owlCarousel({
                    loop: true,
                    center: false,
                    items: 3,
                    nav: true,
                    margin: 0,
                    autoplay: false,
                    dots: false,
                    autoplayTimeout: 8500,
                    smartSpeed: 450,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        768: {
                            items: 3
                        },
                        1170: {
                            items: 4
                        }
                    }
                });
            }

        }

        function OnErrorlistjewelrysuitsdetail(content) {
            ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
        }

        listshapedetail();
    }

    function listshapedetail() {

        var pagename = getpagename();
        var headersdata = { Accept: 'application/json', platform: 4, userpagename: pagename, useraction: '', masterlisting: true, responsetype: 'JSON' };

        formdata = new FormData();
        formdata.append("action", "listshape");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistshapedetail, OnErrorlistshapedetail);
        function Onsuccesslistshapedetail(content) {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // $('#fillshapdetail').html('');
                // $('.fillshapdetail').addClass('d-none');
            }
            else if (resultdata.status == 1) {
                $('.fillshapdetail').addClass('d-none');
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {

                        $('.fillshapdetail').removeClass('d-none');
                        for (var i in resultdata.data) {
                            htmldata += '<div class="filter custom-checkbox home-filterbottom">';
                            htmldata += '    <input type="checkbox" id="f' + resultdata.data[i].id + '" name="fltshapeid[]" class="custom-control-input fltshapeid" data-name="' + resultdata.data[i].name + '" value="' + resultdata.data[i].id + '">';
                            htmldata += '    <label for="f' + resultdata.data[i].id + '" class="custom-control-label with-img">';
                            htmldata += '            <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>' + resultdata.data[i].img + '" alt="' + resultdata.data[i].name + '" class="img-responsive"></span>';
                            htmldata += '        <span class="text-label">' + resultdata.data[i].name + '</span>';
                            htmldata += '    </label>';
                            htmldata += '</div>';
                        }
                        $('#btnshapdownarrow').addClass('d-none');
                        if (resultdata.data.length > 10) {
                            $('#btnshapdownarrow').removeClass('d-none');
                        }

                    }
                }
                $('#fillshapdetail').html(htmldata);

            }

        }

        function OnErrorlistshapedetail(content) {
            ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
        }

        listcolordetail();
    }
    function listcolordetail() {

        var pagename = getpagename();
        var headersdata = { Accept: 'application/json', platform: 4, userpagename: pagename, useraction: '', masterlisting: true, responsetype: 'JSON' };

        formdata = new FormData();
        formdata.append("action", "listdiamondcolor");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistcolordetail, OnErrorlistcolordetail);
        function Onsuccesslistcolordetail(content) {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // $('#fillcolordetail').html('');
                // $('.fillcolordetail').addClass('d-none');
            }
            else if (resultdata.status == 1) {
                $('.fillcolordetail').addClass('d-none');
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.fillcolordetail').removeClass('d-none');
                        for (var i in resultdata.data) {
                            htmldata += '<div class="filter custom-checkbox home-filterbottom">';
                            htmldata += '    <input type="checkbox" id="c' + resultdata.data[i].id + '" name="fltcolorid[]" data-name="' + resultdata.data[i].name + '" class="custom-control-input" value="' + resultdata.data[i].id + '">';
                            htmldata += '    <label for="c' + resultdata.data[i].id + '" class="custom-control-label">' + resultdata.data[i].name + '</label>';
                            htmldata += '</div>';
                        }
                        $('#btncolordownarrow').addClass('d-none');
                        if (resultdata.data.length > 10) {
                            $('#btncolordownarrow').removeClass('d-none');
                        }
                    }
                }
                $('#fillcolordetail').html(htmldata);

            }

        }

        function OnErrorlistcolordetail(content) {
            ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
        }

        listclaritydetail();
    }
    function listclaritydetail() {

        var pagename = getpagename();
        var headersdata = { Accept: 'application/json', platform: 4, userpagename: pagename, useraction: '', masterlisting: true, responsetype: 'JSON' };

        formdata = new FormData();
        formdata.append("action", "listclarity");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistclaritydetail, OnErrorlistclaritydetail);
        function Onsuccesslistclaritydetail(content) {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // $('#fillcolordetail').html('');
                // $('.fillcolordetail').addClass('d-none');
            }
            else if (resultdata.status == 1) {
                $('.fillclaritydetail').addClass('d-none');
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.fillclaritydetail').removeClass('d-none');
                        for (var i in resultdata.data) {

                            htmldata += '<div class="filter custom-checkbox">';
                            htmldata += '    <input type="checkbox" id="c' + resultdata.data[i].id + '" data-name="' + resultdata.data[i].name + '" name="fltclarityid[]" class="custom-control-input" value="' + resultdata.data[i].id + '">';
                            htmldata += '    <label for="c' + resultdata.data[i].id + '" class="custom-control-label">' + resultdata.data[i].name + '</label>';
                            htmldata += '</div>';
                        }
                    }
                }
                $('#fillclaritydetail').html(htmldata);

            }

        }

        function OnErrorlistclaritydetail(content) {
            ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
        }

        listcut();
    }
    /* ******Cut*******  */

    function listcut() {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false,
            responsetype: 'JSON'
        };
        formdata = new FormData();
        formdata.append("action", "listcut");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistcut, OnErrorlistcut);

        function Onsuccesslistcut(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                htmldata += '<option value="" data-displayorder="0">From</option>';
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option  data-displayorder="' + resultdata.data[i].displayorder + '" value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }


            }
            $('#fltfromcutid').html(htmldata);
            $('#fltfromcutid').select2();

        }

        function OnErrorlistcut(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

        listpolish();

    }

    $('#fltfromcutid').on('change', function () {
        // var fltfromcutid=$(this).val();
        // $('#s_fltfromcutid').val(fltfromcutid);
        listtocut();
    })

    function listtocut() {
        var displayorder = $('#fltfromcutid :selected').data('displayorder');

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
        formdata.append("action", "listtocut");
        formdata.append("displayorder", displayorder);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslisttocut, OnErrorlisttocut);

        function Onsuccesslisttocut(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#flttocutid').html(resultdata.data);
            $('#flttocutid').select2();
        }

        function OnErrorlisttocut(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******Polish*******  */

    function listpolish() {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false,
            responsetype: 'JSON'
        };
        formdata = new FormData();
        formdata.append("action", "listpolish");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistpolish, OnErrorlistpolish);

        function Onsuccesslistpolish(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                htmldata += '<option value="" data-displayorder="0">From</option>';
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option data-displayorder="' + resultdata.data[i].displayorder + '" value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#fltfrompolishid').html(htmldata);
            $('#fltfrompolishid').select2();
        }

        function OnErrorlistpolish(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

        listsymmetry();
    }

    $('#fltfrompolishid').on('change', function () {

        listtopolish();
    })

    function listtopolish() {
        var displayorder = $('#fltfrompolishid :selected').data('displayorder');
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
        formdata.append("action", "listtopolish");
        formdata.append("displayorder", displayorder);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslisttopolish, OnErrorlisttopolish);

        function Onsuccesslisttopolish(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#flttopolishid').html(resultdata.data);
            $('#flttopolishid').select2();


        }

        function OnErrorlisttopolish(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******Symmetry*******  */

    function listsymmetry() {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false,
            responsetype: 'JSON'
        };
        formdata = new FormData();
        formdata.append("action", "listsymmetry");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistsymmetry, OnErrorlistsymmetry);

        function Onsuccesslistsymmetry(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                htmldata += '<option value="" data-displayorder="0">From</option>';
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option data-displayorder="' + resultdata.data[i].displayorder + '" value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#fltfromsymmetryid').html(htmldata);
            $('#fltfromsymmetryid').select2();
        }

        function OnErrorlistsymmetry(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

        listintensity();
    }

    $('#fltfromsymmetryid').on('change', function () {

        listtosymmetry();
    })

    function listtosymmetry() {
        var displayorder = $('#fltfromsymmetryid :selected').data('displayorder');
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
        formdata.append("action", "listtosymmetry");
        formdata.append("displayorder", displayorder);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslisttosymmetry, OnErrorlisttosymmetry);

        function Onsuccesslisttosymmetry(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#flttosymmetryid').html(resultdata.data);
            $('#flttosymmetryid').select2();

            // $('#s_flttosymmetryid').html(resultdata.data);
            // $('#s_flttosymmetryid').select2();
        }

        function OnErrorlisttosymmetry(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******INTENSITY******* */
    function listintensity() {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false,
            responsetype: 'JSON'
        };
        formdata = new FormData();
        formdata.append("action", "listintensity");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistintensity, OnErrorlistintensity);

        function Onsuccesslistintensity(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var s_htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                $('.fillFluorescenceDetail').addClass('d-none');
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.fillFluorescenceDetail').removeClass('d-none');

                        for (var i in resultdata.data) {

                            htmldata += '<div class="filter custom-checkbox">';
                            htmldata += '<input type="checkbox" id="c' + resultdata.data[i].id + '" name="fltintensityid[]" class="custom-control-input" value="' + resultdata.data[i].id + '">';
                            htmldata += '<label for="c' + resultdata.data[i].id + '" class="custom-control-label">' + resultdata.data[i].name + '</label>';
                            htmldata += '</div>';



                        }

                    }

                    if (resultdata.data.length > 7) {
                        htmldata += '<button type="button" class="btn show-more-filters">';
                        htmldata += '    <span class="text">+ 2 More</span>';
                        htmldata += '    <span class="text opened">- 2 Less</span>';
                        htmldata += '    <span class="arrow-btn">';
                        htmldata += '        <img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">';
                        htmldata += '    </span>';
                        htmldata += '</button> ';
                    }
                }

            }
            $('#fillFluorescenceDetail').html(htmldata);


        }

        function OnErrorlistintensity(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
        listlab();
    }
    function listlab() {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false,
            responsetype: 'JSON'
        };
        formdata = new FormData();
        formdata.append("action", "listlab");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistlab, OnErrorlistlab);

        function Onsuccesslistlab(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var s_htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                $('.labdetail').addClass('d-none');
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.labdetail').removeClass('d-none');
                        for (var i in resultdata.data) {
                            htmldata += '<div class="filter custom-checkbox home-filterbottom">';
                            htmldata += '    <input type="checkbox" id="c' + resultdata.data[i].id + '" name="fltlabid[]" data-name="' + resultdata.data[i].name + '"  class="custom-control-input" value="' + resultdata.data[i].id + '">';
                            htmldata += '    <label for="c' + resultdata.data[i].id + '" class="custom-control-label">' + resultdata.data[i].name + '</label>';
                            htmldata += '</div>';
                        }
                    }
                }
                $('#btnlabdownarrow').addClass('d-none');
                if (resultdata.data.length > 10) {
                    $('#btnlabdownarrow').removeClass('d-none');
                }

            }
            $('#labdetail').html(htmldata);

        }

        function OnErrorlistlab(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    $('body').on('change', '#form-diamond-search input[type=checkbox]', function () {
        checkdiamondformelementvalue();
        getfiltersvalue();
    });
    $('body').on('input', '#form-diamond-search #fltfromsize,#flttosize', function () {
        checkdiamondformelementvalue();
        getfiltersvalue();
    });



    $('body').on('change', '#form-diamond-search .select2', function () {
        checkdiamondformelementvalue();
        getfiltersvalue();
    });

    function checkdiamondformelementvalue() {
        var issearchbtn = 0;
        $('#form-diamond-search input[type=checkbox]').each(function () {
            if (this.checked) {
                issearchbtn++;
                return false;
            }
        });
        var fltfromsize = $('#form-diamond-search #fltfromsize').val();
        var flttosize = $('#form-diamond-search #flttosize').val();
        if (fltfromsize && flttosize) {
            issearchbtn++;
        }

        var fltcutid = $('#form-diamond-search #fltfromcutid').val();
        if (fltcutid.length > 0) {
            issearchbtn++;
        }
        var fltpolishid = $('#form-diamond-search #fltfrompolishid').val();
        if (fltpolishid.length > 0) {
            issearchbtn++;
        }
        var fltsymmetryid = $('#form-diamond-search #fltfromsymmetryid').val();
        if (fltsymmetryid.length > 0) {
            issearchbtn++;
        }

        $('#form-diamond-search #btnsearchdiamond').attr('disabled', true);
        if (issearchbtn > 0) {
            $('#form-diamond-search #btnsearchdiamond').attr('disabled', false);
        }
        console.log(issearchbtn);
        return issearchbtn;

    }
    /* MANAGE FILTERS */
    var shapearr = [];
    var shapeidarr = [];
    var fltfromsize = '';
    var flttosize = '';
    var sizearr = [];
    var colorarr = [];
    var coloridarr = [];
    var clarityarr = [];
    var clarityidarr = [];

    var fltcutarr = [];
    var fltcutidarr = [];

    var fltpolisharr = [];
    var fltpolishidarr = [];

    var fltsymmetryarr = [];
    var fltsymmetryidarr = [];

    var intensityarr = [];
    var intensityidarr = [];


    var labarr = [];

    function getfiltersvalue() {
        shapearr = [];
        shapeidarr = [];
        $('#fillshapdetail input[type=checkbox]').each(function () {
            if (this.checked) {
                shapearr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                shapeidarr.push($(this).val());
            }
        });
        // console.log(shapearr);
        // console.log(shapeidarr);


        fltfromsize = $('#fltfromsize').val();
        flttosize = $('#flttosize').val();

        colorarr = [];
        coloridarr = [];
        $('#fillcolordetail input[type=checkbox]').each(function () {
            if (this.checked) {
                colorarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                coloridarr.push($(this).val());
            }
        });
        // console.log(colorarr);
        // console.log(coloridarr);



        clarityarr = [];
        clarityidarr = [];
        $('#fillclaritydetail input[type=checkbox]').each(function () {
            if (this.checked) {
                clarityarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                clarityidarr.push($(this).val());
            }
        });
        // console.log(clarityarr);
        // console.log(clarityidarr);


        fltcutarr = [];
        fltcutidarr = [];
        var fltcutid = $('#fltfromcutid').val();
        if (fltcutid.length > 0) {
            for (var i = 0; i < fltcutid.length; i++) {
                var cutid = $('#fltfromcutid option[value=' + fltcutid[i] + ']').val();
                var cut = $('#fltfromcutid option[value=' + fltcutid[i] + ']').text();
                fltcutarr.push({
                    'id': cutid,
                    'name': cut
                });
                fltcutidarr.push(cutid);
            }
        }
        // console.log(fltcutarr);
        // console.log(fltcutidarr);

        fltpolisharr = [];
        fltpolishidarr = [];
        var fltpolishid = $('#fltfrompolishid').val();
        if (fltpolishid.length > 0) {
            for (var i = 0; i < fltpolishid.length; i++) {
                var polishid = $('#fltfrompolishid option[value=' + fltpolishid[i] + ']').val();
                var polish = $('#fltfrompolishid option[value=' + fltpolishid[i] + ']').text();
                fltpolisharr.push({
                    'id': polishid,
                    'name': polish
                });
                fltpolishidarr.push(polishid);
            }
        }
        // console.log(fltpolisharr);
        // console.log(fltpolishidarr);


        fltsymmetryarr = [];
        fltsymmetryidarr = [];
        var fltsymmetryid = $('#fltfromsymmetryid').val();
        if (fltsymmetryid.length > 0) {
            for (var i = 0; i < fltsymmetryid.length; i++) {
                var symmetryid = $('#fltfromsymmetryid option[value=' + fltsymmetryid[i] + ']').val();
                var symmetry = $('#fltfromsymmetryid option[value=' + fltsymmetryid[i] + ']').text();
                fltsymmetryarr.push({
                    'id': symmetryid,
                    'name': symmetry
                });
                fltsymmetryidarr.push(symmetryid);
            }
        }
        // console.log(fltsymmetryarr);
        // console.log(fltsymmetryidarr);

        intensityarr = [];
        intensityidarr = [];
        $('#fillFluorescenceDetail input[type=checkbox]').each(function () {
            if (this.checked) {
                intensityarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                intensityidarr.push($(this).val());
            }
        });
        // console.log(intensityarr);
        // console.log(intensityidarr);

        labarr = [];
        $('#labdetail input[type=checkbox]').each(function () {
            if (this.checked) {
                labarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
            }
        });
        // console.log(labarr);

    }
    /* $(".send-btn").click(function() {
       $('#free-search-result').removeClass('d-none');
    }) */

    if ($('#form-diamond-search').length) {
        $('#form-diamond-search').validate({
            rules: {

            },
            messages: {

            },
            submitHandler: function (form) {
                // alert('formsubmit');
                var issearchbtn = checkdiamondformelementvalue();
                if (issearchbtn > 0) {
                    $('#listdiamondDatatbl').attr('data-nextpage', 0);
                    listdiamonddata(1, 'form-diamond-search');
                } else {
                    alertify('Please select at least one filter', 0);
                }


            },
        });
    }

    function listdiamonddata(page, form = null) {


        $('.preloader-activate').addClass('preloader-active');
        var pagename = getpagename();
        var useraction = $('#formevent').val();
        var diamond_per_page = $('#diamond_per_page').val();

        var nextpage = 0;
        if ($('#listdiamondDatatbl').attr('data-nextpage') > 0) {
            nextpage = $('#listdiamondDatatbl').attr('data-nextpage');
        }

        formdata = new FormData(document.getElementById('form-diamond-search'));
        if (form != null) {
            formdata = new FormData(document.getElementById(form));
        }



        formdata.append("action", "listdiamond");
        formdata.append("nextpage", parseInt(nextpage) + 1);
        // formdata.append("fltparcel", 0);
        // formdata.append("fltmanagemydiamond", 0);
        formdata.append("perpage", diamond_per_page);
        formdata.append("isfromwebsite", 1);
        formdata.append("isdiamondsearch", 1);
        var headersdata = {
            'Accept': 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: useraction,
            masterlisting: false
        };
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccesslistdiamond, OnErrorlistdiamond)

        function Onsuccesslistdiamond(data) {

            // $('#free-search-container').addClass('d-none');
            $('.QuickSearchDiv').addClass('d-none');
            $('#free-search-result').removeClass('d-none');
            $('.preloader-activate').removeClass('preloader-active');
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
                $('#form-diamond-search').addClass('d-none');
                $('#form-diamond-search').addClass('d-none');
                $('.listdiamondDataDiv').removeClass('d-none');

                htmldata += '<tr>';
                htmldata += '<td colspan="16">';
                htmldata += '<h4>' + resultdata.message + '</h4>';
                htmldata += '</td>';
                htmldata += '</tr>';

                $('.listdiamondDataDiv #listdiamondData').html(htmldata);
                $('#showdiamondentries').html(0);

            } else if (resultdata.status == 1) {
                $('#form-diamond-search').addClass('d-none');
                $('.listdiamondDataDiv').removeClass('d-none');
                if (resultdata.nextpage == 1) {
                    $('.results-heading').html(resultdata.totaldiamond + ' Diamonds available');
                }
                for (var i in resultdata.data) {
                    var diamonddata = resultdata.data[i];
                    htmldata += '<tr>';
                    htmldata += '<td class="text-left">';
                    htmldata += '<a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Contact Seller</a>';
                    htmldata += '</td>';
                    // htmldata+='<td>';
                    // htmldata+='<div class="searchreating">100%</div>';
                    // htmldata+='</td>';
                    htmldata += '<td class="text-left">' + diamonddata.country + '</td>';
                    htmldata += '<td class="text-left">' + diamonddata.shape + '</td>';
                    htmldata += '<td class="text-left">' + diamonddata.size + '</td>';
                    htmldata += '<td class="text-left">' + diamonddata.color + '</td>';
                    htmldata += '<td class="text-left">' + diamonddata.clarity + '</td>';
                    htmldata += '<td class="text-left">' + diamonddata.cut + '</td>';
                    htmldata += '<td class="text-left">' + diamonddata.polish + '</td>';
                    htmldata += '<td class="text-left">' + diamonddata.symmetry + '</td>';
                    htmldata += '<td class="text-left">' + diamonddata.fluorescenecolor + '</td>';
                    htmldata += '<td class="text-left">' + diamonddata.lab + '</td>';
                    // htmldata+='<td>$354</td>';
                    // htmldata+='<td>-83.9%</td>';
                    htmldata += '<td><a class="clspageparentmenu" pagename="membershipplan" href="<?php echo $config->getweburl(); ?>membershipplan">Get Price</a></td>';
                    htmldata += '<td class="text-left">' + diamonddata.depthper + '%</td>';
                    htmldata += '<td class="text-left">' + diamonddata.tableper + '%</td>';
                    htmldata += '<td class="text-left">' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</td>';
                    htmldata += '<td class="text-left">' + diamonddata.stocknumber + '</td>';

                    htmldata += '</tr>';

                }
                // $('.listdiamondDataDiv #listdiamondData').html(htmldata);
                if (resultdata.nextpage == 1) {
                    $('.listdiamondDataDiv #listdiamondData').html(htmldata);
                } else {
                    $('.listdiamondDataDiv #listdiamondData').append(htmldata);
                }
                $('#showdiamondentries').html(resultdata.showentries);
                $('#listdiamondDatatbl').attr('data-nextpage', resultdata.nextpage);
                if (resultdata.loadmore == 1) {
                    $('#listdiamondDatatbl').attr('data-show', 1);
                } else {
                    $('#listdiamondDatatbl').attr('data-show', 0);
                }



            }
            else if (resultdata.status == -1) {
                $('#btnlogout').trigger('click');
            }

        }

        function OnErrorlistdiamond(content) {

        }
    }
    $('body').on('change', '#diamond_per_page', function () {
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        $("#listdiamondData").animate({
            scrollTop: 0
        }, "slow");
        listdiamonddata(1);
    });

    $('#listdiamondDatatbl tbody').scroll(function () {
        // alert();
        // console.log('scrollTop:' + $(this).scrollTop());
        // console.log('innerHeight:' + $(this).innerHeight());
        // console.log('scrollHeight:' + $(this)[0].scrollHeight);
        // 
        if ($(this).scrollTop() +
            $(this).innerHeight() >=
            $(this)[0].scrollHeight) {
            // console.log('Here');
            var dataact = getpagename();
            var show = $('#listdiamondDatatbl').attr('data-show');
            // console.log('dataact:' + dataact);
            // console.log('show:' + show);
            if (dataact && show == 1) {
                listdiamonddata(1);
            }
        }
    });

    $('#serchformreset').on('click', function () {
        $('#form-diamond-search #btnsearchdiamond').attr('disabled', true);
        $('.select2').val(null).trigger('change');

    })
    $(".back-link").click(function () {

        $('#free-search-result').addClass('d-none');
        $('#form-diamond-search').removeClass('d-none');
        $('.QuickSearchDiv').removeClass('d-none');
        $('.listdiamondDataDiv').addClass('d-none');

    });

</script>

<script>
    (function () {
        var widget = document.getElementById('free-search-widget');
        if (!widget) return;
        var links = widget.querySelectorAll('.home-filter-nav a');
        var panels = ['home-shape', 'home-size', 'home-color', 'home-clarity', 'free-search'];
        var activeAnimation = null;

        function scrollToPanel(panel) {
            // Read the target's actual position each time; all preceding filters stay visible.
            var top = window.pageYOffset + panel.getBoundingClientRect().top - 79 - 16;
            if (activeAnimation) cancelAnimationFrame(activeAnimation);
            var from = window.pageYOffset;
            var distance = Math.max(0, top) - from;
            var start = performance.now();
            var duration = window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 0 : 420;
            function frame(now) {
                var progress = duration ? Math.min((now - start) / duration, 1) : 1;
                var eased = 1 - Math.pow(1 - progress, 3);
                window.scrollTo(0, from + distance * eased);
                if (progress < 1) activeAnimation = requestAnimationFrame(frame);
                else activeAnimation = null;
            }
            activeAnimation = requestAnimationFrame(frame);
        }

        links.forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                var id = link.getAttribute('href').slice(1);
                if (panels.indexOf(id) === -1) return;
                var panel = document.getElementById(id);
                if (!panel) return;
                links.forEach(function (item) {
                    var selected = item === link;
                    item.classList.toggle('active', selected);
                    if (selected) item.setAttribute('aria-current', 'true');
                    else item.removeAttribute('aria-current');
                });
                if (id === 'free-search' && window.jQuery) {
                    window.jQuery(panel).collapse('show');
                    requestAnimationFrame(function () { scrollToPanel(panel); });
                } else {
                    scrollToPanel(panel);
                }
            });
        });
    }());
</script>
<!-- Frequently Asked Questions end -->