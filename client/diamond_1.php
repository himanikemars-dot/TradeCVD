    <?php
    // require_once dirname(__DIR__, 1).'/config/config.php';
    // $config = new config();

    require_once dirname(__DIR__, 1) . '/config/init.php';


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
        <meta property="og:url" content="Trade CVD" />
        <meta property="og:description" content="Trade CVD" />
        <meta property="og:image" content="" />
        <link rel="icon" type="image/x-icon" href="" />
        <!-- Meta Tag End -->

        <!--title-->
        <title>Trade CVD</title>

        <!-- CSS Start -->
        <?php include('css.php'); ?>

        <!-- CSS End -->
        <!-- <script src="assets/js/vendor/jquery.min.js"></script> -->
    </head>

    <body class="light home-page">
        <div class="page-wrapper">
            <!-- Header Start -->
            <?php include('header.php'); ?>
            <!-- Header End -->
            <div class="main" id="web-content">
                <?php include('sidebar.php'); ?>
                <div class="has-sidebar-left">
                    <div class="container-fluid relative animatedParent animateOnce">
                        <div class="tab-content pb-3" id="v-pills-tabContent">
                            <!--Today Tab Start-->
                            <div class="tab-pane  show active" id="v-pills-1">
                                <div class="row row-eq-height">
                                    <!-- Chat Widget Start -->
                                    <div class="col-md-12">
                                        <div class="card my-3 border-0 bg-light-gray">
                                            <div class="card-body chat-widget slimScroll p-0" data-height="100%">
                                                <nav>
                                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                        <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Search</button>
                                                        <button class="nav-link ml-2" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Parcel</button>
                                                    </div>
                                                </nav>
                                                <div class="tab-content" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                        <div class="filter-box filter-diamond-box">
                                                            <form action="">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-btns text-right p-2">
                                                                                <button type="submit" class="btn send-btn dash-serchbtn" disabled="" data-category="free search" data-label="Diamond search" data-hs-event-50099495="1">Search</button>
                                                                                <input type="reset" value="Reset" class="btn reset-btn dash-reset-btn">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="accordion">
                                                                    <div class="card collapse-card">
                                                                        <div class="card-header">
                                                                            <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                                                                Basic
                                                                            </a>
                                                                        </div>
                                                                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                                            <div class="form-group shape-group dash-shape">
                                                                                <div class="name-filter">Shape</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="filter-container">
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f0" class="dashboard-control custom-control-input" value="Round">
                                                                                            <label for="f0" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_round.svg" alt="Round" class="img-responsive"></span>
                                                                                                <span class="text-label">Round</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f1" class="dashboard-control custom-control-input" value="Pear">
                                                                                            <label for="f1" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_pear.svg" alt="Pear" class="img-responsive"></span>
                                                                                                <span class="text-label">Pear</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f2" class="dashboard-control custom-control-input" value="Princess">
                                                                                            <label for="f2" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_princess.svg" alt="Princess" class="img-responsive"></span>
                                                                                                <span class="text-label">Princess</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f3" class="dashboard-control custom-control-input" value="Marquise">
                                                                                            <label for="f3" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_marquise.svg" alt="Marquise" class="img-responsive"></span>
                                                                                                <span class="text-label">Marquise</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f4" class="dashboard-control custom-control-input" value="Emerald">
                                                                                            <label for="f4" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_emerald_l.svg" alt="Emerald" class="img-responsive"></span>
                                                                                                <span class="text-label">Emerald</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f5" class="dashboard-control custom-control-input" value="Cushion Brilliant">
                                                                                            <label for="f5" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_cushion_brilliant_l.svg" alt="Cushion Brilliant" class="img-responsive"></span>
                                                                                                <span class="text-label">Cushion Brilliant</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f6" class="dashboard-control custom-control-input" value="Cushion Modified">
                                                                                            <label for="f6" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_cushion_mod_l.svg" alt="Cushion Modified" class="img-responsive"></span>
                                                                                                <span class="text-label">Cushion Modified</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f7" class="dashboard-control custom-control-input" value="Asscher">
                                                                                            <label for="f7" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_asscher_l.svg" alt="Asscher" class="img-responsive"></span>
                                                                                                <span class="text-label">Asscher</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f8" class="dashboard-control custom-control-input" value="Sq. Emerald">
                                                                                            <label for="f8" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_sq_emerald.svg" alt="Sq. Emerald" class="img-responsive"></span>
                                                                                                <span class="text-label">Sq. Emerald</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f9" class="dashboard-control custom-control-input" value="Oval">
                                                                                            <label for="f9" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_oval.svg" alt="Oval" class="img-responsive"></span>
                                                                                                <span class="text-label">Oval</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f10" class="dashboard-control custom-control-input" value="Radiant">
                                                                                            <label for="f10" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_radiant.svg" alt="Radiant" class="img-responsive"></span>
                                                                                                <span class="text-label">Radiant</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f11" class="dashboard-control custom-control-input" value="Heart">
                                                                                            <label for="f11" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_heart.svg" alt="Heart" class="img-responsive"></span>
                                                                                                <span class="text-label">Heart</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f12" class="dashboard-control custom-control-input" value="European Cut">
                                                                                            <label for="f12" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_euro_cut.svg" alt="European Cut" class="img-responsive"></span>
                                                                                                <span class="text-label">European Cut</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f13" class="dashboard-control custom-control-input" value="Old Miner">
                                                                                            <label for="f13" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_old_miner.svg" alt="Old Miner" class="img-responsive"></span>
                                                                                                <span class="text-label">Old Miner</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f14" class="dashboard-control custom-control-input" value="Baguette">
                                                                                            <label for="f14" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_baguette_l.svg" alt="Baguette" class="img-responsive"></span>
                                                                                                <span class="text-label">Baguette</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f15" class="dashboard-control custom-control-input" value="Briolette">
                                                                                            <label for="f15" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_briolette_l.svg" alt="Briolette" class="img-responsive"></span>
                                                                                                <span class="text-label">Briolette</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f16" class="dashboard-control custom-control-input" value="Bullets">
                                                                                            <label for="f16" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_bullet_l.svg" alt="Bullets" class="img-responsive"></span>
                                                                                                <span class="text-label">Bullets</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f17" class="dashboard-control custom-control-input" value="Calf">
                                                                                            <label for="f17" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_calf_l.svg" alt="Calf" class="img-responsive"></span>
                                                                                                <span class="text-label">Calf</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f18" class="dashboard-control custom-control-input" value="Half Moon">
                                                                                            <label for="f18" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_half_moon.svg" alt="Half Moon" class="img-responsive"></span>
                                                                                                <span class="text-label">Half Moon</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f19" class="dashboard-control custom-control-input" value="Hexagonal">
                                                                                            <label for="f19" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_hexagonal.svg" alt="Hexagonal" class="img-responsive"></span>
                                                                                                <span class="text-label">Hexagonal</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f20" class="dashboard-control custom-control-input" value="Kite">
                                                                                            <label for="f20" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_kite.svg" alt="Kite" class="img-responsive"></span>
                                                                                                <span class="text-label">Kite</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f21" class="dashboard-control custom-control-input" value="Lozenge">
                                                                                            <label for="f21" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_lozenge.svg" alt="Lozenge" class="img-responsive"></span>
                                                                                                <span class="text-label">Lozenge</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f22" class="dashboard-control custom-control-input" value="Octagonal">
                                                                                            <label for="f22" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_octagonal.svg" alt="Octagonal" class="img-responsive"></span>
                                                                                                <span class="text-label">Octagonal</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f23" class="dashboard-control custom-control-input" value="Pentagonal">
                                                                                            <label for="f23" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_pentagonal.svg" alt="Pentagonal" class="img-responsive"></span>
                                                                                                <span class="text-label">Pentagonal</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f24" class="dashboard-control custom-control-input" value="Rose">
                                                                                            <label for="f24" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_rose.svg" alt="Rose" class="img-responsive"></span>
                                                                                                <span class="text-label">Rose</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f25" class="dashboard-control custom-control-input" value="Shield">
                                                                                            <label for="f25" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="#" alt="Shield" class="img-responsive"></span>
                                                                                                <span class="text-label">Shield</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f26" class="dashboard-control custom-control-input" value="Square">
                                                                                            <label for="f26" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="#" alt="Square" class="img-responsive"></span>
                                                                                                <span class="text-label">Square</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f27" class="dashboard-control custom-control-input" value="Square Radiant">
                                                                                            <label for="f27" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="#" alt="Square Radiant" class="img-responsive"></span>
                                                                                                <span class="text-label">Square Radiant</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f28" class="dashboard-control custom-control-input" value="Star">
                                                                                            <label for="f28" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="#" alt="Star" class="img-responsive"></span>
                                                                                                <span class="text-label">Star</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f29" class="dashboard-control custom-control-input" value="Tapered Baguette">
                                                                                            <label for="f29" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="#" alt="Tapered Baguette" class="img-responsive"></span>
                                                                                                <span class="text-label">Tapered Baguette</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f30" class="dashboard-control custom-control-input" value="Tapered Bullet">
                                                                                            <label for="f30" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="#" alt="Tapered Bullet" class="img-responsive"></span>
                                                                                                <span class="text-label">Tapered Bullet</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f31" class="dashboard-control custom-control-input" value="Trapezoid">
                                                                                            <label for="f31" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="#" alt="Trapezoid" class="img-responsive"></span>
                                                                                                <span class="text-label">Trapezoid</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f32" class="dashboard-control custom-control-input" value="Triangular">
                                                                                            <label for="f32" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="#" alt="Triangular" class="img-responsive"></span>
                                                                                                <span class="text-label">Triangular</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f33" class="dashboard-control custom-control-input" value="Trilliant">
                                                                                            <label for="f33" class="custom-control-label with-img">
                                                                                                <span class="img-wrap"><img src="#" alt="Trilliant" class="img-responsive"></span>
                                                                                                <span class="text-label">Trilliant</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="f34" class="dashboard-control custom-control-input" value="Other">
                                                                                            <label for="f34" class="custom-control-label with-img">
                                                                                                <span class="text-label">Other</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <button type="button" class="btn show-more-filters">
                                                                                        <span class="text">+ 30 More</span>
                                                                                        <span class="text opened">- 30 Less</span>
                                                                                        <span class="arrow-btn">
                                                                                            <img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">
                                                                                        </span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Size</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 col-md-2 col-sm-4 sizesetall">
                                                                                        <div class="cut-group">
                                                                                            <label id="sizfrom">From</label>
                                                                                            <select aria-labelledby="sizfrom" name="sizfrom" class="form-control">
                                                                                                <option value="0">From</option>
                                                                                                <option value="1">Poor</option>
                                                                                                <option value="2">Fair</option>
                                                                                                <option value="3">Good</option>
                                                                                                <option value="4">Very Good</option>
                                                                                                <option value="5">Excellent</option>
                                                                                                <option value="6">Ideal</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-2 col-sm-4">
                                                                                        <div class="cut-group">
                                                                                            <label id="sizto">To</label>
                                                                                            <select aria-labelledby="sizto" name="sizto" class="form-control">
                                                                                                <option value="0">To</option>
                                                                                                <option value="1">Poor</option>
                                                                                                <option value="2">Fair</option>
                                                                                                <option value="3">Good</option>
                                                                                                <option value="4">Very Good</option>
                                                                                                <option value="5">Excellent</option>
                                                                                                <option value="6">Ideal</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row-filter dash-row">
                                                                                        <div class="filter-container">
                                                                                            <div class="filter width_lable custom-checkbox ">
                                                                                                <input type="checkbox" id="c0" class="dashboard-control custom-control-input">
                                                                                                <label for="c0" class="custom-control-label ">
                                                                                                    0.30-0.39
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="filter width_lable custom-checkbox">
                                                                                                <input type="checkbox" id="c1" class="dashboard-control custom-control-input">
                                                                                                <label for="c1" class="custom-control-label">
                                                                                                    0.40-0.49
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="filter width_lable custom-checkbox">
                                                                                                <input type="checkbox" id="c2" class="dashboard-control custom-control-input">
                                                                                                <label for="c2" class="custom-control-label">
                                                                                                    0.50-0.59
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="filter width_lable custom-checkbox">
                                                                                                <input type="checkbox" id="c3" class="dashboard-control custom-control-input">
                                                                                                <label for="c3" class="custom-control-label">
                                                                                                    0.60-0.69
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="filter width_lable custom-checkbox">
                                                                                                <input type="checkbox" id="c4" class="dashboard-control custom-control-input">
                                                                                                <label for="c4" class="custom-control-label">
                                                                                                    0.70-0.79
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="filter width_lable custom-checkbox">
                                                                                                <input type="checkbox" id="c5" class="dashboard-control custom-control-input">
                                                                                                <label for="c5" class="custom-control-label">
                                                                                                    0.80-0.89
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="filter width_lable custom-checkbox">
                                                                                                <input type="checkbox" id="c6" class="dashboard-control custom-control-input">
                                                                                                <label for="c6" class="custom-control-label">
                                                                                                    0.90-0.99
                                                                                                </label>
                                                                                            </div>

                                                                                        </div>
                                                                                        <button type="button" class="btn show-more-filters">
                                                                                            <span class="text">+ 18 More</span>
                                                                                            <span class="text opened">- 18 Less</span>
                                                                                            <span class="arrow-btn">
                                                                                                <img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">
                                                                                            </span>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group color-group dash-shape">
                                                                                <div class="name-filter">Color</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="filter-container">
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="dcolor" class="dashboard-control custom-control-input">
                                                                                            <label for="dcolor" class="custom-control-label">
                                                                                                D
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="ecolor" class="dashboard-control custom-control-input">
                                                                                            <label for="ecolor" class="custom-control-label">
                                                                                                E
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="fcolor" class="dashboard-control custom-control-input">
                                                                                            <label for="fcolor" class="custom-control-label">
                                                                                                F
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="gcolor" class="dashboard-control custom-control-input">
                                                                                            <label for="gcolor" class="custom-control-label">
                                                                                                G
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="hcolor" class="dashboard-control custom-control-input">
                                                                                            <label for="hcolor" class="custom-control-label">
                                                                                                H
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="icolor" class="dashboard-control custom-control-input">
                                                                                            <label for="icolor" class="custom-control-label">
                                                                                                I
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="jcolor" class="dashboard-control custom-control-input">
                                                                                            <label for="jcolor" class="custom-control-label">
                                                                                                J
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c7" class="dashboard-control custom-control-input">
                                                                                            <label for="c7" class="custom-control-label">
                                                                                                K
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c8" class="dashboard-control custom-control-input">
                                                                                            <label for="c8" class="custom-control-label">
                                                                                                L
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c9" class="dashboard-control custom-control-input">
                                                                                            <label for="c9" class="custom-control-label">
                                                                                                M
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c10" class="dashboard-control custom-control-input">
                                                                                            <label for="c10" class="custom-control-label">
                                                                                                N
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c11" class="dashboard-control custom-control-input">
                                                                                            <label for="c11" class="custom-control-label">
                                                                                                O
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c12" class="dashboard-control custom-control-input">
                                                                                            <label for="c12" class="custom-control-label">
                                                                                                P
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c13" class="dashboard-control custom-control-input">
                                                                                            <label for="c13" class="custom-control-label">
                                                                                                Q
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c14" class="dashboard-control custom-control-input">
                                                                                            <label for="c14" class="custom-control-label">
                                                                                                R
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c15" class="dashboard-control custom-control-input">
                                                                                            <label for="c15" class="custom-control-label">
                                                                                                S
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c16" class="dashboard-control custom-control-input">
                                                                                            <label for="c16" class="custom-control-label">
                                                                                                T
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c17" class="dashboard-control custom-control-input">
                                                                                            <label for="c17" class="custom-control-label">
                                                                                                U
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c18" class="dashboard-control custom-control-input">
                                                                                            <label for="c18" class="custom-control-label">
                                                                                                V
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c19" class="dashboard-control custom-control-input">
                                                                                            <label for="c19" class="custom-control-label">
                                                                                                W
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c20" class="dashboard-control custom-control-input">
                                                                                            <label for="c20" class="custom-control-label">
                                                                                                X
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c21" class="dashboard-control custom-control-input">
                                                                                            <label for="c21" class="custom-control-label">
                                                                                                Y
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="c22" class="dashboard-control custom-control-input">
                                                                                            <label for="c22" class="custom-control-label">
                                                                                                Z
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <button type="button" class="btn show-more-filters">
                                                                                        <span class="text">+ 18 More</span>
                                                                                        <span class="text opened">- 18 Less</span>
                                                                                        <span class="arrow-btn">
                                                                                            <img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">
                                                                                        </span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clarity-group dash-shape">
                                                                                <div class="name-filter">Clarity </div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="filter-container">
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl0" class="dashboard-control custom-control-input">
                                                                                            <label for="cl0" class="custom-control-label">
                                                                                                FL
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl1" class="dashboard-control custom-control-input">
                                                                                            <label for="cl1" class="custom-control-label">
                                                                                                IF
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl2" class="dashboard-control custom-control-input">
                                                                                            <label for="cl2" class="custom-control-label">
                                                                                                VVS1
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl3" class="dashboard-control custom-control-input">
                                                                                            <label for="cl3" class="custom-control-label">
                                                                                                VVS2
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl4" class="dashboard-control custom-control-input">
                                                                                            <label for="cl4" class="custom-control-label">
                                                                                                VS1
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl5" class="dashboard-control custom-control-input">
                                                                                            <label for="cl5" class="custom-control-label">
                                                                                                VS2
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl6" class="dashboard-control custom-control-input">
                                                                                            <label for="cl6" class="custom-control-label">
                                                                                                VS3
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl7" class="dashboard-control custom-control-input">
                                                                                            <label for="cl7" class="custom-control-label">
                                                                                                SI1
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl8" class="dashboard-control custom-control-input">
                                                                                            <label for="cl8" class="custom-control-label">
                                                                                                SI2
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl9" class="dashboard-control custom-control-input">
                                                                                            <label for="cl9" class="custom-control-label">
                                                                                                SI3
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl10" class="dashboard-control custom-control-input">
                                                                                            <label for="cl10" class="custom-control-label">
                                                                                                I1
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl11" class="dashboard-control custom-control-input">
                                                                                            <label for="cl11" class="custom-control-label">
                                                                                                I2
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl12" class="dashboard-control custom-control-input">
                                                                                            <label for="cl12" class="custom-control-label">
                                                                                                I3
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group multiply-group-filter">
                                                                                <div class="name-filter">Inclusions</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 col-md-12">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-4 mb-3 sizesetall cut-group">
                                                                                                <label id="eyeclean">Eye Clean <img class="savani-que" src="<?php echo $config->getimageurl() ?>images/adminimg/qusetion.svg" alt="savani" title="savani"></label>
                                                                                                <!-- <select class="form-control select2 selectmulitiple" name="eyeclean[]" id="eyeclean" multiple="" tabindex="-1" aria-hidden="true"> -->
                                                                                                <select class="form-control select2" name="fltroughsourceid[]" id="fltroughsourceid" multiple="" tabindex="-1" aria-hidden="true">
                                                                                                    <option value="1">Fair</option>
                                                                                                    <option value="2">Poor</option>
                                                                                                    <option value="3">Fair</option>
                                                                                                    <option value="4">Good</option>
                                                                                                    <option value="5">Excellent</option>
                                                                                                    <option value="6">Ideal</option>
                                                                                                    <option value="6">verygood</option>
                                                                                                    <option value="6">not good</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-4 mb-3  cut-group">
                                                                                                <label id="ppcto">Milky from</label>
                                                                                                <select aria-labelledby="ppcto" name="ppcto" class="form-control">
                                                                                                    <option value="0">from</option>
                                                                                                    <option value="1">Poor</option>
                                                                                                    <option value="2">Fair</option>
                                                                                                    <option value="3">Good</option>
                                                                                                    <option value="4">Very Good</option>
                                                                                                    <option value="5">Excellent</option>
                                                                                                    <option value="6">Ideal</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-4 mb-3  cut-group">
                                                                                                <label id="ppcto">Milky To</label>
                                                                                                <select aria-labelledby="ppcto" name="ppcto" class="form-control">
                                                                                                    <option value="0">To</option>
                                                                                                    <option value="1">Poor</option>
                                                                                                    <option value="2">Fair</option>
                                                                                                    <option value="3">Good</option>
                                                                                                    <option value="4">Very Good</option>
                                                                                                    <option value="5">Excellent</option>
                                                                                                    <option value="6">Ideal</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-4 mb-3 sizesetall cut-group">
                                                                                                <label id="ppcto">Open Inclusion</label>
                                                                                                <select aria-labelledby="ppcto" name="ppcto" class="form-control">
                                                                                                    <option value="0">Select</option>
                                                                                                    <option value="1">Poor</option>
                                                                                                    <option value="2">Fair</option>
                                                                                                    <option value="3">Good</option>
                                                                                                    <option value="4">Very Good</option>
                                                                                                    <option value="5">Excellent</option>
                                                                                                    <option value="6">Ideal</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-4  mb-3 cut-group">
                                                                                                <label id="ppcto">White Inclusions</label>
                                                                                                <select aria-labelledby="ppcto" name="ppcto" class="form-control">
                                                                                                    <option value="0">From</option>
                                                                                                    <option value="1">Poor</option>
                                                                                                    <option value="2">Fair</option>
                                                                                                    <option value="3">Good</option>
                                                                                                    <option value="4">Very Good</option>
                                                                                                    <option value="5">Excellent</option>
                                                                                                    <option value="6">Ideal</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-4 mb-3 cut-group">
                                                                                                <label id="ppcto">Black Inclusions</label>
                                                                                                <select aria-labelledby="ppcto" name="ppcto" class="form-control">
                                                                                                    <option value="0">To</option>
                                                                                                    <option value="1">Poor</option>
                                                                                                    <option value="2">Fair</option>
                                                                                                    <option value="3">Good</option>
                                                                                                    <option value="4">Very Good</option>
                                                                                                    <option value="5">Excellent</option>
                                                                                                    <option value="6">Ideal</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group multiply-group-filter">
                                                                                <div class="name-filter">Shade</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 col-md-12">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-4 mb-3  sizesetall  cut-group">
                                                                                                <label id="openinclusion"> Shade</label>
                                                                                                <select aria-labelledby="openinclusion" name="openinclusion" class="form-control">
                                                                                                    <option value="0">select</option>
                                                                                                    <option value="1">Poor</option>
                                                                                                    <option value="2">Fair</option>
                                                                                                    <option value="3">Good</option>
                                                                                                    <option value="4">Very Good</option>
                                                                                                    <option value="5">Excellent</option>
                                                                                                    <option value="6">Ideal</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="d-block mt-auto">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                                                                    <label class="form-check-label ml-4" for="flexRadioDefault1">
                                                                                                        Contains
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                                                                    <label class="form-check-label ml-4" for="flexRadioDefault2">
                                                                                                        Does Not Contain
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-check mt-auto textset">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                                                                                <label class="form-check-label ml-4" for="flexCheckChecked">
                                                                                                    <b class="text-black"> No BGM </b>
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Finish</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 col-md-4 col-sm-6">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-6 sizesetall  cut-group">
                                                                                                <label id="finishfrom">Cut</label>
                                                                                                <select aria-labelledby="finishfrom" name="finishfrom" class="form-control">
                                                                                                    <option value="0">From</option>
                                                                                                    <option value="1">Poor</option>
                                                                                                    <option value="2">Fair</option>
                                                                                                    <option value="3">Good</option>
                                                                                                    <option value="4">Very Good</option>
                                                                                                    <option value="5">Excellent</option>
                                                                                                    <option value="6">Ideal</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6  mt-auto  cut-group">
                                                                                                <select aria-labelledby="cutto" name="cutto" class="form-control">
                                                                                                    <option value="0">To</option>
                                                                                                    <option value="1">Poor</option>
                                                                                                    <option value="2">Fair</option>
                                                                                                    <option value="3">Good</option>
                                                                                                    <option value="4">Very Good</option>
                                                                                                    <option value="5">Excellent</option>
                                                                                                    <option value="6">Ideal</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-4 col-sm-6">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-6 cut-group">
                                                                                                <label id="polishfrom">Polish</label>
                                                                                                <select aria-labelledby="polishfrom" name="polishfrom" class="form-control">
                                                                                                    <option value="0">From</option>
                                                                                                    <option value="1">Poor</option>
                                                                                                    <option value="2">Fair</option>
                                                                                                    <option value="3">Good</option>
                                                                                                    <option value="4">Very Good</option>
                                                                                                    <option value="5">Excellent</option>
                                                                                                    <option value="6">Ideal</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6 mt-auto  cut-group">
                                                                                                <select aria-labelledby="polishto" name="polishto" class="form-control">
                                                                                                    <option value="0">To</option>
                                                                                                    <option value="1">Poor</option>
                                                                                                    <option value="2">Fair</option>
                                                                                                    <option value="3">Good</option>
                                                                                                    <option value="4">Very Good</option>
                                                                                                    <option value="5">Excellent</option>
                                                                                                    <option value="6">Ideal</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-4 col-sm-6">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-6 cut-group">
                                                                                                <label id="symmetryfrom">Symmetry</label>
                                                                                                <select aria-labelledby="symmetryfrom" name="symmetryfrom" class="form-control">
                                                                                                    <option value="0">From</option>
                                                                                                    <option value="1">Poor</option>
                                                                                                    <option value="2">Fair</option>
                                                                                                    <option value="3">Good</option>
                                                                                                    <option value="4">Very Good</option>
                                                                                                    <option value="5">Excellent</option>
                                                                                                    <option value="6">Ideal</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6 mt-auto  cut-group">
                                                                                                <select aria-labelledby="symmetryto" name="symmetryto" class="form-control">
                                                                                                    <option value="0">To</option>
                                                                                                    <option value="1">Poor</option>
                                                                                                    <option value="2">Fair</option>
                                                                                                    <option value="3">Good</option>
                                                                                                    <option value="4">Very Good</option>
                                                                                                    <option value="5">Excellent</option>
                                                                                                    <option value="6">Ideal</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group flu-group dash-flu-group dash-shape">
                                                                                <div class="name-filter">Fluorescence Intensity</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="filter-container">
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="fi23" class="dashboard-control custom-control-input" value="None">
                                                                                            <label for="fi23" class="custom-control-label">
                                                                                                None
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="filter-container">
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="fi24" class="dashboard-control custom-control-input" value="None">
                                                                                            <label for="fi24" class="custom-control-label">
                                                                                                Very Slight
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="filter-container">
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="fi25" class="dashboard-control custom-control-input" value="None">
                                                                                            <label for="fi25" class="custom-control-label">
                                                                                                Faint / Slight
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="filter-container">
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="fi26" class="dashboard-control custom-control-input" value="None">
                                                                                            <label for="fi26" class="custom-control-label">
                                                                                                Medium
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="filter-container">
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="fi27" class="dashboard-control custom-control-input" value="None">
                                                                                            <label for="fi27" class="custom-control-label">
                                                                                                Strong
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="filter-container">
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="fi28" class="dashboard-control custom-control-input" value="None">
                                                                                            <label for="fi28" class="custom-control-label">
                                                                                                Very Strong
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6 cut-group">
                                                                                        <label id="ficolor">Color</label>
                                                                                        <select aria-labelledby="ficolor" name="ficolor" class="form-control">
                                                                                            <option value="0">Color</option>
                                                                                            <option value="1">Poor</option>
                                                                                            <option value="2">Fair</option>
                                                                                            <option value="3">Good</option>
                                                                                            <option value="4">Very Good</option>
                                                                                            <option value="5">Excellent</option>
                                                                                            <option value="6">Ideal</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group color-group dash-shape">
                                                                                <div class="name-filter">Grading Report</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="filter-container">
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="gr0" class="dashboard-control custom-control-input">
                                                                                            <label for="gr0" class="custom-control-label">
                                                                                                GIA
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="gr1" class="dashboard-control custom-control-input">
                                                                                            <label for="gr1" class="custom-control-label">
                                                                                                GIA DOR
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="gr2" class="dashboard-control custom-control-input">
                                                                                            <label for="gr2" class="custom-control-label">
                                                                                                RAP
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="gr3" class="dashboard-control custom-control-input">
                                                                                            <label for="gr3" class="custom-control-label">
                                                                                                AGS
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="gr4" class="dashboard-control custom-control-input">
                                                                                            <label for="gr4" class="custom-control-label">
                                                                                                HRD
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="gr5" class="dashboard-control custom-control-input">
                                                                                            <label for="gr5" class="custom-control-label">
                                                                                                IGI
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="gr6" class="dashboard-control custom-control-input">
                                                                                            <label for="gr6" class="custom-control-label">
                                                                                                RDC
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="gr7" class="dashboard-control custom-control-input">
                                                                                            <label for="gr7" class="custom-control-label">
                                                                                                CGL
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <button type="button" class="btn show-more-filters">
                                                                                        <span class="text">+ 18 More</span>
                                                                                        <span class="text opened">- 18 Less</span>
                                                                                        <span class="arrow-btn">
                                                                                            <img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">
                                                                                        </span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Location</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 col-md-8 sizesetall cut-group">
                                                                                        <label id="llocation">location</label>
                                                                                        <select aria-labelledby="llocation" name="llocation" class="form-control">
                                                                                            <option value="0">Enter Location Name</option>
                                                                                            <option value="1">Poor</option>
                                                                                            <option value="2">Fair</option>
                                                                                            <option value="3">Good</option>
                                                                                            <option value="4">Very Good</option>
                                                                                            <option value="5">Excellent</option>
                                                                                            <option value="6">Ideal</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-auto mt-auto">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" value="" id="lfl">
                                                                                            <label class="form-check-label ml-4" for="lfl">
                                                                                                <b class="text-black"> Flexible Delivery</b>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Sellers</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 sizesetall col-md-3 cut-group">
                                                                                        <label id="ssc">Savani ID/ Company Code</label>
                                                                                        <select aria-labelledby="ssc" name="ssc" class="form-control">
                                                                                            <option value="0">Select</option>
                                                                                            <option value="1">Poor</option>
                                                                                            <option value="2">Fair</option>
                                                                                            <option value="3">Good</option>
                                                                                            <option value="4">Very Good</option>
                                                                                            <option value="5">Excellent</option>
                                                                                            <option value="6">Ideal</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-3 cut-group">
                                                                                        <label id="srating">Rating</label>
                                                                                        <select aria-labelledby="srating" name="srating" class="form-control">
                                                                                            <option value="0">Select</option>
                                                                                            <option value="1">Poor</option>
                                                                                            <option value="2">Fair</option>
                                                                                            <option value="3">Good</option>
                                                                                            <option value="4">Very Good</option>
                                                                                            <option value="5">Excellent</option>
                                                                                            <option value="6">Ideal</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-3 cut-group">
                                                                                        <label id="ssnumber">Stock Numbers</label>
                                                                                        <select aria-labelledby="ssnumber" name="ssnumber" class="form-control">
                                                                                            <option value="0">Enter Stock Numbers</option>
                                                                                            <option value="1">Poor</option>
                                                                                            <option value="2">Fair</option>
                                                                                            <option value="3">Good</option>
                                                                                            <option value="4">Very Good</option>
                                                                                            <option value="5">Excellent</option>
                                                                                            <option value="6">Ideal</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-3 cut-group">
                                                                                        <label id="llocation">Enter Lot Numbers</label>
                                                                                        <select aria-labelledby="llocation" name="llocation" class="form-control">
                                                                                            <option value="0">Enter Lot Numbers</option>
                                                                                            <option value="1">Poor</option>
                                                                                            <option value="2">Fair</option>
                                                                                            <option value="3">Good</option>
                                                                                            <option value="4">Very Good</option>
                                                                                            <option value="5">Excellent</option>
                                                                                            <option value="6">Ideal</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Rough source</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 col-md-12 sizesetall cut-group">
                                                                                        <select aria-labelledby="roughsource" name="roughsource" class="form-control">
                                                                                            <option value="0">Start Typing Rough Source Name</option>
                                                                                            <option value="1">Poor</option>
                                                                                            <option value="2">Fair</option>
                                                                                            <option value="3">Good</option>
                                                                                            <option value="4">Very Good</option>
                                                                                            <option value="5">Excellent</option>
                                                                                            <option value="6">Ideal</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clarity-group dash-shape">
                                                                                <div class="name-filter">Savani <img class="savani-que" src="<?php echo $config->getimageurl() ?>images/adminimg/qusetion.svg" alt="savani" title="savani"> </div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="filter-container">
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl0" class="dashboard-control custom-control-input">
                                                                                            <label for="cl0" class="custom-control-label">
                                                                                                A1
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl1" class="dashboard-control custom-control-input">
                                                                                            <label for="cl1" class="custom-control-label">
                                                                                                A2
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl2" class="dashboard-control custom-control-input">
                                                                                            <label for="cl2" class="custom-control-label">
                                                                                                A3
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl3" class="dashboard-control custom-control-input">
                                                                                            <label for="cl3" class="custom-control-label">
                                                                                                A4
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl4" class="dashboard-control custom-control-input">
                                                                                            <label for="cl4" class="custom-control-label">
                                                                                                A5
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl5" class="dashboard-control custom-control-input">
                                                                                            <label for="cl5" class="custom-control-label">
                                                                                                B1
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl6" class="dashboard-control custom-control-input">
                                                                                            <label for="cl6" class="custom-control-label">
                                                                                                B2
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl7" class="dashboard-control custom-control-input">
                                                                                            <label for="cl7" class="custom-control-label">
                                                                                                B3
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl8" class="dashboard-control custom-control-input">
                                                                                            <label for="cl8" class="custom-control-label">
                                                                                                B4
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl9" class="dashboard-control custom-control-input">
                                                                                            <label for="cl9" class="custom-control-label">
                                                                                                B5
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl10" class="dashboard-control custom-control-input">
                                                                                            <label for="cl10" class="custom-control-label">
                                                                                                C1
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl11" class="dashboard-control custom-control-input">
                                                                                            <label for="cl11" class="custom-control-label">
                                                                                                C2
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl12" class="dashboard-control custom-control-input">
                                                                                            <label for="cl12" class="custom-control-label">
                                                                                                C3
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl12" class="dashboard-control custom-control-input">
                                                                                            <label for="cl12" class="custom-control-label">
                                                                                                C4
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="filter custom-checkbox">
                                                                                            <input type="checkbox" id="cl12" class="dashboard-control custom-control-input">
                                                                                            <label for="cl12" class="custom-control-label">
                                                                                                C5
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card collapse-card">
                                                                        <div class="card-header">
                                                                            <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                                                                Preferences
                                                                            </a>
                                                                        </div>
                                                                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Price
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input treatmentset" type="checkbox" name="flexRadioDefault" id="dtnotreatment">
                                                                                        <label class="form-check-box ml-4" for="dtnotreatment">
                                                                                            No Treatment
                                                                                        </label>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 col-md-4">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-6 cut-group">
                                                                                                <label id="pricefrom">S/CT</label>
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                                                <label class="inputset" type="number">usd</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6 mt-auto cut-group">
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                                                <label class="inputset" type="number">usd</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-4">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-6 cut-group">
                                                                                                <label id="totalfrom">Total</label>
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                                                <label class="inputset" type="number">usd</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6 mt-auto cut-group">
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                                                <label class="inputset" type="number">usd</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-4">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-6 cut-group">
                                                                                                <label id="savanifrom">Savani%</label>
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                                                <label class="inputset" type="number">%</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6 mt-auto cut-group">
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                                                <label class="inputset" type="number">%</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group flu-group dash-flu-group dash-shape">
                                                                                <div class="name-filter">Shows Only</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="filter-container">
                                                                                        <div class="col-12 col-md-2 sizesetall">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="sosavaniv" class="dashboard-control custom-control-input" value="None">
                                                                                                <label for="sosavaniv" class="custom-control-label">
                                                                                                    <img class="primary-img" src="<?php echo $config->getimageurl() ?>images/adminimg/savaniverified.svg" alt="Savani Verified" title="Savani Verified"> Savani Verified
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-2">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="sopsuppliers" class="dashboard-control custom-control-input" value="None">
                                                                                                <label for="sopsuppliers" class="custom-control-label">
                                                                                                    <img class="primary-img" src="<?php echo $config->getimageurl() ?>images/primary-icon.svg" alt="Primary Suppliers" title="Primary Suppliers"> Primary Suppliers
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-2">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="solatestlistings" class="dashboard-control custom-control-input" value="None">
                                                                                                <label for="solatestlistings" class="custom-control-label">
                                                                                                    <img class="primary-img" src="<?php echo $config->getimageurl() ?>images/adminimg/latestlistings.svg" alt="Latest Listings" title="Latest Listings"> Latest Listings
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-2">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="somatched-pairs" class="dashboard-control custom-control-input" value="None">
                                                                                                <label for="somatched-pairs" class="custom-control-label">
                                                                                                    <img class="primary-img" src="<?php echo $config->getimageurl() ?>images/adminimg/matchedpairs.svg" alt="Matched Pairs" title="Matched Pairs"> Matched Pairs
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-2">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="sogarnetedava" class="dashboard-control custom-control-input" value="None">
                                                                                                <label for="sogarnetedava" class="custom-control-label">
                                                                                                    <img class="primary-img" src="<?php echo $config->getimageurl() ?>images/adminimg/garneted-available.svg" alt="Garneted Available" title="Garneted Available"> Garneted Available
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group flu-group dash-flu-group flu-shows dash-shape">
                                                                                <div class="name-filter">My Notes
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input treatmentset" type="checkbox" name="flexRadioDefault" id="allnotes">
                                                                                        <label class="form-check-box ml-4" for="allnotes">
                                                                                            All Notes
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="filter-container">
                                                                                        <div class="col-12 col-md-2 sizesetall">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="mnyellow" class="dashboard-control custom-control-input" value="None">
                                                                                                <label for="mnyellow" class="custom-control-label">
                                                                                                    <div class="color-icon bg-yellow"></div>Yellow
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-2">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="mnred" class="dashboard-control custom-control-input" value="None">
                                                                                                <label for="mnred" class="custom-control-label">
                                                                                                    <div class="color-icon bg-red"></div>Red
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-2">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="mngreen" class="dashboard-control custom-control-input" value="None">
                                                                                                <label for="mngreen" class="custom-control-label">
                                                                                                    <div class="color-icon bg-green"></div> Green
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-2">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="mnorange" class="dashboard-control custom-control-input" value="None">
                                                                                                <label for="mnorange" class="custom-control-label">
                                                                                                    <div class="color-icon bg-orange"></div> Orange
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-2">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="mnpurple" class="dashboard-control custom-control-input" value="None">
                                                                                                <label for="mnpurple" class="custom-control-label">
                                                                                                    <div class="color-icon bg-purple"></div> Purple
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-2">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="mnblue" class="dashboard-control custom-control-input" value="None">
                                                                                                <label for="mnblue" class="custom-control-label">
                                                                                                    <div class="color-icon bg-dark-blue"></div> Blue
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group flu-group dash-flu-group dash-shape">
                                                                                <div class="name-filter">Media</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="filter-container">
                                                                                        <div class="col-12 col-md-4 sizesetall">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="Mediaphoto" class="dashboard-control custom-control-input" value="None">
                                                                                                <label for="Mediaphoto" class="custom-control-label">
                                                                                                    With Photo
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-4">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="Mediavideo" class="dashboard-control custom-control-input" value="None">
                                                                                                <label for="Mediavideo" class="custom-control-label">
                                                                                                    With Video
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-4">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="mediareport" class="dashboard-control custom-control-input" value="None">
                                                                                                <label for="mediareport" class="custom-control-label">
                                                                                                    With Lab Report
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card collapse-card">
                                                                        <div class="card-header">
                                                                            <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                                                                                Measurements
                                                                            </a>
                                                                        </div>
                                                                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Percentage</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 col-md-6">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-6 col-sm-4 cut-group">
                                                                                                <label id="depthfrom">Depth%</label>
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                                                <label class="inputset" type="number">%</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6 col-sm-4 mt-auto cut-group">
                                                                                                <input type="number" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                                                <label class="inputset" type="number">%</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-6 col-sm-4 cut-group">
                                                                                                <label id="tablefrom">Table%</label>
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                                                <label class="inputset" type="number">%</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6 col-sm-4 mt-auto cut-group">
                                                                                                <input type="number" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                                                <label class="inputset" type="number">%</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Matric</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 col-md-4 matricset">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-6 cut-group">
                                                                                                <label id="depthfrom">Length </label>
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                                                <label class="inputset" type="number">mm</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6 mt-auto cut-group">
                                                                                                <input type="number" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                                                <label class="inputset" type="number">mm</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-4">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-6 cut-group">
                                                                                                <label id="tablefrom">Width</label>
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                                                <label class="inputset" type="number">mm</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6 mt-auto cut-group">
                                                                                                <input type="number" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                                                <label class="inputset" type="number">%</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-4">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-6 cut-group">
                                                                                                <label id="tablefrom">Depth</label>
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                                                <label class="inputset" type="number">mm</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6 mt-auto cut-group">
                                                                                                <input type="number" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                                                <label class="inputset" type="number">%</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Ratio</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 col-md-4 cut-group">
                                                                                        <label id="rrs">Ratio</label>
                                                                                        <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="Enter">
                                                                                        <label class="inputset" type="number">: 1.00</label>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-4 cut-group">
                                                                                        <label id="rs">Ratio</label>
                                                                                        <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="Enter">
                                                                                        <label class="inputset" type="number">: 1.00</label>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-4 cut-group">
                                                                                        <label id="ssnumber">Preset</label>
                                                                                        <select aria-labelledby="ssnumber" name="ssnumber" class="form-control">
                                                                                            <option value="0">Select Preset Ratio</option>
                                                                                            <option value="1">Poor</option>
                                                                                            <option value="2">Fair</option>
                                                                                            <option value="3">Good</option>
                                                                                            <option value="4">Very Good</option>
                                                                                            <option value="5">Excellent</option>
                                                                                            <option value="6">Ideal</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card collapse-card">
                                                                    <div class="card-header">
                                                                        <a class="card-link" data-toggle="collapse" href="#collapsefour">
                                                                            Treatment
                                                                        </a>
                                                                    </div>
                                                                    <div id="collapsefour" class="collapse show" data-parent="#accordion">
                                                                        <div class="form-group multiply-group-filter">
                                                                            <div class="name-filter">Display Type</div>
                                                                            <div class="row-filter dash-row">
                                                                                <div class="col-12 col-md-12">
                                                                                    <div class="row">
                                                                                        <div class="col-12 col-md-3 mb-3">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="dtnotreatment">
                                                                                                <label class="form-check-label ml-4" for="dtnotreatment">
                                                                                                    No Treatment
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 mb-3">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="dtshowstreated">
                                                                                                <label class="form-check-label ml-4" for="dtshowstreated">
                                                                                                    Show Only Treated
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-4 mb-3  cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="dtincludetreated">
                                                                                                <label class="form-check-label ml-4" for="dtincludetreated">
                                                                                                    Include Treated Diamonds In Result
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                                <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                    Laser Drilled
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="clarity-enhanced">
                                                                                                <label class="form-check-label ml-4" for="clarity-enhanced">
                                                                                                    Clarity enhanced
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="colorenhanced">
                                                                                                <label class="form-check-label ml-4" for="colorenhanced">
                                                                                                    Color Enhanced
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <!-- <input class="form-check-input" type="checkbox" value="" id="colorenhanced">
                                                                                                    <label class="form-check-label ml-4" for="colorenhanced">
                                                                                                        Color Enhanced
                                                                                                    </label> -->
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="irradiated">
                                                                                                <label class="form-check-label ml-4" for="irradiated">
                                                                                                    Irradiated
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="hpht">
                                                                                                <label class="form-check-label ml-4" for="hpht">
                                                                                                    HPHT
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="other-treatment">
                                                                                                <label class="form-check-label ml-4" for="other-treatment">
                                                                                                    Other Treatment
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card collapse-card">
                                                                    <div class="card-header">
                                                                        <a class="card-link" data-toggle="collapse" href="#collapsefive">
                                                                            Key to Symbols
                                                                        </a>
                                                                    </div>
                                                                    <div id="collapsefive" class="collapse show" data-parent="#accordion">
                                                                        <div class="form-group multiply-group-filter">
                                                                            <div class="name-filter">Display Type</div>
                                                                            <div class="row-filter dash-row">
                                                                                <div class="col-12 col-md-12">
                                                                                    <div class="row">
                                                                                        <div class="col-12 col-md-3 mb-3">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="dtcontain">
                                                                                                <label class="form-check-label ml-4" for="dtcontain">
                                                                                                    Contain
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 mb-3">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="dtnotcontain">
                                                                                                <label class="form-check-label ml-4" for="dtnotcontain">
                                                                                                    Does Not Contain
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-4 mb-3  cut-group">
                                                                                            <div class="form-check">
                                                                                                <!-- <input class="form-check-input" type="radio" name="flexRadioDefault" id="dtnotcontain"> -->
                                                                                                <!-- <label class="form-check-label ml-4" for="dtnotcontain">=
                                                                                                    </label> -->
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="bearding">
                                                                                                <label class="form-check-label ml-4" for="bearding">
                                                                                                    Bearding
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="brown-patch-color">
                                                                                                <label class="form-check-label ml-4" for="brown-patch-color">
                                                                                                    Brown Patch Of Color
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="bruise">
                                                                                                <label class="form-check-label ml-4" for="bruise">
                                                                                                    Bruise
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="cavity">
                                                                                                <label class="form-check-label ml-4" for="cavity">
                                                                                                    Cavity
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="chip">
                                                                                                <label class="form-check-label ml-4" for="chip">
                                                                                                    Chip
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="cleavage">
                                                                                                <label class="form-check-label ml-4" for="cleavage">
                                                                                                    Cleavage
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="Cloud">
                                                                                                <label class="form-check-label ml-4" for="Cloud">
                                                                                                    Cloud
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="crystal">
                                                                                                <label class="form-check-label ml-4" for="crystal">
                                                                                                    Crystal
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="pinpoint" checked>
                                                                                                <label class="form-check-label ml-4" for="pinpoint">
                                                                                                    Pin Point
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="etch-channel">
                                                                                                <label class="form-check-label ml-4" for="etch-channel">
                                                                                                    Etch Channel
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="extrafacet">
                                                                                                <label class="form-check-label ml-4" for="extrafacet">
                                                                                                    Extra Facet
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="feather">
                                                                                                <label class="form-check-label ml-4" for="feather">
                                                                                                    Feather
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="crystalsurface">
                                                                                                <label class="form-check-label ml-4" for="crystalsurface">
                                                                                                    Crystal Surface
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="indentednatural">
                                                                                                <label class="form-check-label ml-4" for="indentednatural">
                                                                                                    Indented Natural
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="internal-grinning">
                                                                                                <label class="form-check-label ml-4" for="internal-grinning">
                                                                                                    Internal Grinning
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="internal-inscription">
                                                                                                <label class="form-check-label ml-4" for="internal-inscription">
                                                                                                    Internal Inscription
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="fluxremant">
                                                                                                <label class="form-check-label ml-4" for="fluxremant">
                                                                                                    Flux Remant
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="knot">
                                                                                                <label class="form-check-label ml-4" for="knot">
                                                                                                    Knot
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="laserdrillhole">
                                                                                                <label class="form-check-label ml-4" for="laserdrillhole">
                                                                                                    Laser Drill Hole
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="ccol-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="manufacturingemnant">
                                                                                                <label class="form-check-label ml-4" for="manufacturingemnant">
                                                                                                    Manufacturing Remnant
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="intlaserdrilling">
                                                                                                <label class="form-check-label ml-4" for="intlaserdrilling">
                                                                                                    Internal Laser Drilling
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="natural">
                                                                                                <label class="form-check-label ml-4" for="natural">
                                                                                                    Natural
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="Needle">
                                                                                                <label class="form-check-label ml-4" for="needle">
                                                                                                    Needle
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="noinclusion">
                                                                                                <label class="form-check-label ml-4" for="noinclusion">
                                                                                                    No Inclusion
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="minordetailspolish">
                                                                                                <label class="form-check-label ml-4" for="minordetailspolish">
                                                                                                    Minor Details Of Polish
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="reflectingsurface">
                                                                                                <label class="form-check-label ml-4" for="reflectingsurface">
                                                                                                    Reflecting Surface Grilling
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="surfacegrinning">
                                                                                                <label class="form-check-label ml-4" for="surfacegrinning">
                                                                                                    Surface Grinning
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 cut-group">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="twinningwisp">
                                                                                                <label class="form-check-label ml-4" for="twinningwisp">
                                                                                                    Twinning Wisp
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card collapse-card">
                                                                    <div class="card-header">
                                                                        <a class="card-link" data-toggle="collapse" href="#collapsesix">
                                                                            Advanced
                                                                        </a>
                                                                    </div>
                                                                    <div id="collapsesix" class="collapse show" data-parent="#accordion">
                                                                        <div class="form-group size-group dash-size-group">
                                                                            <div class="name-filter">Brand</div>
                                                                            <div class="row-filter dash-row">
                                                                                <div class="col-12 col-md-12">
                                                                                    <div class="row">
                                                                                        <div class="col-12 col-md-3">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="bheartsarrows">
                                                                                                <label class="form-check-label ml-4" for="bheartsarrows">Hearts And Arrows
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="brand88cut">
                                                                                                <label class="form-check-label ml-4" for="brand88cut">88-Cut
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="brandarcticfox">
                                                                                                <label class="form-check-label ml-4" for="brandarcticfox">Arctic Fox
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="brandargyle">
                                                                                                <label class="form-check-label ml-4" for="brandargyle"> Argyle
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="canadamark">
                                                                                                <label class="form-check-label ml-4" for="canadamark"> Canada Mark
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="canadianice">
                                                                                                <label class="form-check-label ml-4" for="canadianice"> Canadian Ice
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="heartfire">
                                                                                                <label class="form-check-label ml-4" for="heartfire"> Heart On Firele
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="polarbear">
                                                                                                <label class="form-check-label ml-4" for="polarbear"> Polar Bear
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value="" id="polarice">
                                                                                                <label class="form-check-label ml-4" for="polarice"> Polar Ice
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group size-group dash-size-group">
                                                                            <div class="name-filter">More Option</div>
                                                                            <div class="row-filter dash-row">
                                                                                <div class="col-12 col-md-4 cut-group">
                                                                                    <label id="rrs">Savani Category Code</label>
                                                                                    <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="Enter">
                                                                                </div>
                                                                                <div class="col-12 col-md-4 cut-group">
                                                                                    <label id="rs">Lab Report Number</label>
                                                                                    <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="Enter">
                                                                                </div>
                                                                                <div class="col-12 col-md-4 cut-group">
                                                                                    <label id="ssnumber">Access Code</label>
                                                                                    <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="Enter">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-btns text-center p-5">
                                                                    <button type="submit" class="btn send-btn dash-serchbtn" disabled="" data-category="free search" data-label="Diamond search" data-hs-event-50099495="1">Search</button>
                                                                    <input type="reset" value="Reset" class="btn reset-btn dash-reset-btn">
                                                                </div>

                                                                <div class="col-12 col-md-12">
                                                                    <div class="row searchheaddet">
                                                                        <div class="col-md-6 moredetail">
                                                                            <ul>
                                                                                <li><b> 300000 Dimonds </b>|</li>
                                                                                <li>&nbsp; Total Carats 98,176,8 |</li>
                                                                                <li>&nbsp; Average $/ct 1,299 |</li>
                                                                                <li>&nbsp; Average Discount - 36.32%</li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="text-right searchhead">
                                                                                <div class="searchgreade searchcom">
                                                                                    <button type="button" class="btn searchbtnset"><img src="http://192.168.1.2/savanigems/assets/images/searchpage/3.svg" alt="diamonds" title="diamonds"></button>
                                                                                </div>
                                                                                <div class="searchgreade searchcom">
                                                                                    <button type="button" class="btn searchbtnset navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle"><img src="http://192.168.1.2/savanigems/assets/images/searchpage/fliter.svg" alt="diamonds" title="diamonds"></button>
                                                                                </div>
                                                                                <div class="searchgreade searchcom">
                                                                                    <button type="button" class="btn searchbtnset"><img src="http://192.168.1.2/savanigems/assets/images/searchpage/search.svg" alt="diamonds" title="diamonds"> New search</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="shapesearch">
                                                                                <button type="button" class="btn searchbtnset"><b> Shape : </b><Span>Round</Span></button>
                                                                                <button type="button" class="btn searchbtnset"><b> Size : </b><Span>0.30-0.39</Span></button>
                                                                                <!-- <div class="closeseacrh">
                                                                                    <img src="http://192.168.1.2/savanigems/assets/images/searchpage/close.svg" alt="diamonds" title="diamonds">
                                                                                </div> -->
                                                                                <button type="button" class="btn searchbtnset"><b> Shape : </b><Span>Round</Span></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <nav class="fliterset no-margin">
                                                                        <!-- left bar end -->
                                                                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                                                            <ul class="nav navbar-nav">
                                                                                <li class="active">
                                                                                    <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span></button>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </nav>
                                                                    <div id="wrapper" class="wrappernew">
                                                                        <div id="sidebar-wrapper" class="filternew sidebar-wrapper">
                                                                            <h4>Filter (3)</h4><button type="button" class="btn-close-sidebar" aria-label="Close">x</button>
                                                                            <div class="searchgreade searchcom">
                                                                                <button type="button" class="btn searchbtnset">Apply</button>
                                                                            </div>
                                                                            <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
                                                                                <li>
                                                                                    <div class="col-12 cut-group">
                                                                                        <div class="form-check">
                                                                                            <h5 class="d-inline">Shape</h5>
                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                Advance
                                                                                            </label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control fliterman">
                                                                                                <option value="1"></option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="col-12 cut-group">
                                                                                        <h5 class="d-inline">Size</h5>
                                                                                        <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                        <label class="form-check-label ml-4" for="laserdrilled">
                                                                                            specific
                                                                                        </label>
                                                                                        <div class="row fliterset">
                                                                                            <div class="col-md-6 cut-group">
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                                                <label class="inputset" type="number">ct</label>
                                                                                            </div>
                                                                                            <h5>-</h5>
                                                                                            <div class="col-md-6 mt-auto cut-group">
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                                                <label class="inputset" type="number">ct</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="col-12 cut-group">
                                                                                        <h5 class="d-inline">Color</h5>
                                                                                        <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                        <label class="form-check-label ml-4" for="laserdrilled">
                                                                                            Fancy
                                                                                        </label>
                                                                                        <div class="row fliterset">
                                                                                            <div class="col-md-6 cut-group">
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                                                <label class="inputset" type="number">ct</label>
                                                                                            </div>
                                                                                            <h5>-</h5>
                                                                                            <div class="col-md-6 mt-auto cut-group">
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                                                <label class="inputset" type="number">ct</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="col-12 cut-group">
                                                                                        <h5 class="d-inline">Clarity</h5>
                                                                                        <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                        <label class="form-check-label ml-4" for="laserdrilled">
                                                                                            Fancy
                                                                                        </label>
                                                                                        <div class="row fliterset">
                                                                                            <div class="col-md-6 cut-group">
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                                                <label class="inputset" type="number">ct</label>
                                                                                            </div>
                                                                                            <h5>-</h5>
                                                                                            <div class="col-md-6 mt-auto cut-group">
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                                                <label class="inputset" type="number">ct</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="col-12 cut-group">
                                                                                        <h5 class="d-inline">Inclusion</h5>
                                                                                        <div class="row flis">
                                                                                            <label for="name" class="eyeclenfil"><b>Eye clean</b></label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilter">
                                                                                                <option value="1">Select</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="row flis">
                                                                                            <label for="name"><b>milky</b></label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilternew">
                                                                                                <option value="1">Select</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilternew">
                                                                                                <option value="1">Select</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="row flis">
                                                                                            <label for="name"><b>Black</b></label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilter">
                                                                                                <option value="1">Select</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="row flis">
                                                                                            <label for="name"><b>white</b></label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilter">
                                                                                                <option value="1">Select</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="row flis">
                                                                                            <label for="name"><b>Open</b></label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilter">
                                                                                                <option value="1">Select</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <h5 class="d-inline shadeset">Shade</h5>
                                                                                    <div class="row">
                                                                                        <div class="col-md-5 fliterradio">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="dtcontain1">
                                                                                                <label class="form-check-label ml-4" for="dtcontain1">
                                                                                                    contains
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-5 fliterradio">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="dtcontain1">
                                                                                                <label class="form-check-label ml-4" for="dtcontain1">
                                                                                                    Does not contain
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <select aria-labelledby="ssc" name="ssc" class="form-control selserch">
                                                                                            <option value="1"></option>
                                                                                            <option value="2">Poor</option>
                                                                                            <option value="3">Fair</option>
                                                                                            <option value="4">Good</option>
                                                                                            <option value="5">Very Good</option>
                                                                                            <option value="6">Excellent</option>
                                                                                            <option value="7">Ideal</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="row cut-group secndsearch">
                                                                                        <input class="form-check-input" type="checkbox" value="" id="laserdrilled8">
                                                                                        <label class="form-check-label ml-4" for="laserdrilled8">
                                                                                            No BGM
                                                                                        </label>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="col-12 cut-group">
                                                                                        <h5 class="d-inline">Finish</h5>
                                                                                        <h5> <span>3x&emsp;</span><span>Ex&emsp;</span><span>Vg+&emsp;</span><span>Vg-</span> </h5>
                                                                                        <div class="row flis">
                                                                                            <label for="name"><b>Cut</b></label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilterne">
                                                                                                <option value="1">From</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilterne">
                                                                                                <option value="1">To</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="row flis">
                                                                                            <label for="name"><b>Polish</b></label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilterne">
                                                                                                <option value="1">From</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilterne">
                                                                                                <option value="1">To</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="row flis">
                                                                                            <label for="name"><b>Symm.</b></label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilterne">
                                                                                                <option value="1">From</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilterne">
                                                                                                <option value="1">To</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="col-12 cut-group">
                                                                                        <div class="form-check">
                                                                                            <h5 class="d-inline">Shape</h5>
                                                                                            <div class="flis">
                                                                                                <h5 for="shapes">intensities</h5>
                                                                                                <select aria-labelledby="ssc" name="ssc" class="form-control intfilter">
                                                                                                    <option value="1"></option>
                                                                                                    <option value="2">Poor</option>
                                                                                                    <option value="3">Fair</option>
                                                                                                    <option value="4">Good</option>
                                                                                                    <option value="5">Very Good</option>
                                                                                                    <option value="6">Excellent</option>
                                                                                                    <option value="7">Ideal</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="flis">
                                                                                                <h5 for="shapes">color</h5>
                                                                                                <select aria-labelledby="ssc" name="ssc" class="form-control intfilter">
                                                                                                    <option value="1"></option>
                                                                                                    <option value="2">Poor</option>
                                                                                                    <option value="3">Fair</option>
                                                                                                    <option value="4">Good</option>
                                                                                                    <option value="5">Very Good</option>
                                                                                                    <option value="6">Excellent</option>
                                                                                                    <option value="7">Ideal</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="col-12 cut-group">
                                                                                        <div class="form-check">
                                                                                            <h5 class="d-inline">Grading Report</h5>
                                                                                            <div class="col-12 col-md-12">
                                                                                                <div class="row">
                                                                                                    <div class="col-12 col-md-4 cut-group">
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                                GIA
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-12 col-md-4 cut-group">
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                                DOR
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-12 col-md-4 cut-group">
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                                RAP
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-12 col-md-4 cut-group">
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                                AGS
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-12 col-md-4 cut-group">
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                                HRD
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-12 col-md-4 cut-group ">
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                                IGL
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="col-12 cut-group">
                                                                                        <div class="form-check">
                                                                                            <h5 class="d-inline">Location</h5>
                                                                                            <div class="flis">
                                                                                                <select aria-labelledby="ssc" name="ssc" class="form-control intfilter">
                                                                                                    <option value="1">Type/select</option>
                                                                                                    <option value="2">India</option>
                                                                                                    <option value="3">Afghanistan</option>
                                                                                                    <option value="4">Albania</option>
                                                                                                    <option value="5">China</option>
                                                                                                    <option value="6">Japan</option>
                                                                                                    <option value="7">USA</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="col-12 cut-group">
                                                                                        <h5 class="d-inline">Price</h5>
                                                                                        <div class="row setinputfli">
                                                                                            <h5 class="totalfil">$total</h5>
                                                                                            <div class="col-12 col-md-5 cut-group">
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                                                <label class="inputset" type="number">usd</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-5 mt-auto cut-group">
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                                                <label class="inputset" type="number">usd</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row setinputfli">
                                                                                            <h5 class="ctfil">$ct</h5>
                                                                                            <div class="col-12 col-md-5 cut-group">
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                                                <label class="inputset" type="number">usd</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-5 mt-auto cut-group">
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                                                <label class="inputset" type="number">usd</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row setinputfli">
                                                                                            <h5>Savani</h5>
                                                                                            <div class="col-12 col-md-5 cut-group">
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                                                <label class="inputset" type="number">%</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-5 mt-auto cut-group">
                                                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                                                <label class="inputset" type="number">%</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row cut-group secndsearch">
                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled8">
                                                                                            <label class="form-check-label ml-4" for="laserdrilled8">
                                                                                                Include cash Price
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="col-12 cut-group setmedfli">
                                                                                        <div class="form-check">
                                                                                            <h5 class="d-inline">Show Only</h5>
                                                                                            <div class="col-12 col-md-12">
                                                                                                <div class="row">
                                                                                                    <div class="col-12 col-md-12 cut-group">
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                                Primary Suppliers
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-12 col-md-12 cut-group">
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                                Last Listings
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-12 col-md-12 cut-group">
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                                matched Pairs
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-12 col-md-12 cut-group">
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                                Guaranteed Available
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-12 col-md-12 cut-group">
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                                Savani Verified
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="col-12 cut-group setmedfli">
                                                                                        <div class="form-check">
                                                                                            <h5 class="d-inline">Media</h5>
                                                                                            <div class="col-12 col-md-12">
                                                                                                <div class="row">
                                                                                                    <div class="col-12 col-md-12 cut-group">
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                                Primary Suppliers
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-12 col-md-12 cut-group">
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                                Last Listings
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-12 col-md-12 cut-group">
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                                                matched Pairs
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="col-12 cut-group">
                                                                                        <h5 class="d-inline">Percentage</h5>
                                                                                        <h5></h5>
                                                                                        <div class="row flis">
                                                                                            <label for="name"><b>Depth %</b></label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilterne">
                                                                                                <option value="1">From %</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilterne">
                                                                                                <option value="1">To %</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="row flis">
                                                                                            <label for="name"><b>Table %</b></label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilterne">
                                                                                                <option value="1">From %</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilterne">
                                                                                                <option value="1">To %</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="col-12 cut-group">
                                                                                        <h5 class="d-inline">Measurements</h5>
                                                                                        <h5></h5>
                                                                                        <div class="row flis">
                                                                                            <label for="name"><b>Depth %</b></label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilterne">
                                                                                                <option value="1">From %</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilterne">
                                                                                                <option value="1">To %</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="row flis">
                                                                                            <label for="name"><b>Table %</b></label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilterne">
                                                                                                <option value="1">From %</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control setfilterne">
                                                                                                <option value="1">To %</option>
                                                                                                <option value="2">Poor</option>
                                                                                                <option value="3">Fair</option>
                                                                                                <option value="4">Good</option>
                                                                                                <option value="5">Very Good</option>
                                                                                                <option value="6">Excellent</option>
                                                                                                <option value="7">Ideal</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <!-- left bar end -->
                                                                    <div class="accordion" id="accordionExample">
                                                                        <div class="table-responsive searchpagedetail">
                                                                            <table class="table table-tb">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor">
                                                                                                    seller
                                                                                                </label>
                                                                                            </div>

                                                                                        </th>
                                                                                        <th>rating</th>
                                                                                        <th>location</th>
                                                                                        <th>Shape</th>
                                                                                        <th>Size</th>
                                                                                        <th>Color</th>
                                                                                        <th>Clarity</th>
                                                                                        <th>Cut</th>
                                                                                        <th>Polish</th>
                                                                                        <th>Symm</th>
                                                                                        <th>Fluor.</th>
                                                                                        <th>Lab</th>
                                                                                        <th>$/ct</th>
                                                                                        <th>%Savani</th>
                                                                                        <th>Total</th>
                                                                                        <th>Depth</th>
                                                                                        <th>Table</th>
                                                                                        <th>Measurement</th>
                                                                                        <th>Vendor Stock No.</th>
                                                                                        <th>Status</th>
                                                                                        <th>Media</th>
                                                                                        <th>Ratio</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">
                                                                                                    nidhi
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <div class="searchPadding">
                                                                                        <div class="collapse out" id="searchdown">
                                                                                            <div class="col-12 col-md-12 searchddetail">
                                                                                                <div class="text-left searchleft">
                                                                                                    <div class="searchgreade">
                                                                                                        <button type="button" class="btn searchbtnset"><b>No Graded</b></button>
                                                                                                    </div>
                                                                                                    <div class="searchgreade">
                                                                                                        <button type="button" class="btn searchbtnset">$/ct<br><b>$ 380</b></button>
                                                                                                    </div>
                                                                                                    <div class="searchgreade">
                                                                                                        <button type="button" class="btn searchbtnset">Savani%<br><b>-83.23%</b></button>
                                                                                                    </div>
                                                                                                    <div class="searchgreade">
                                                                                                        <button type="button" class="btn searchbtnset">Total<br><b>$123</b></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="text-right searchright">
                                                                                                    <div class="searchgreade searchcom">
                                                                                                        <button type="button" class="btn searchbtnset" data-toggle="modal" data-target="#contactdiamondseller">contect seller</button>
                                                                                                    </div>
                                                                                                    <div class="searchgreade searchcom">
                                                                                                        <button type="button" class="btn searchbtnset">compare</button>
                                                                                                    </div>
                                                                                                    <div class="searchgreade searchcom">
                                                                                                        <button type="button" class="btn searchbtnset" data-toggle="modal" data-target="#ListDiamondDataDetailModalLong">Diamond Page</button>
                                                                                                    </div>
                                                                                                    <div class="searchgreade searchcom">
                                                                                                        <button type="button" class="btn searchbtnset">More</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-12 searchddetail">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6 searchddetail1">
                                                                                                        <div class="card">
                                                                                                            <div class="card-body">
                                                                                                                <div class="headset">
                                                                                                                    <h5 class="text-left">
                                                                                                                        diamond details
                                                                                                                    </h5>
                                                                                                                    <h4>Last Update: 02-02-2021</h4>
                                                                                                                </div>
                                                                                                                <div class="searchmoredetail">
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-md-6">
                                                                                                                            <ul>
                                                                                                                                <li><b>Shape</b>: <span class="metalpurity1">&nbsp; Round</span></li>
                                                                                                                                <li><b>Size</b>: <span class="metalpurity1">&nbsp; 0.04</span></li>
                                                                                                                                <li><b>Color</b>: <span class="metalpurity1">&nbsp; D</span></li>
                                                                                                                                <li><b>Clarity</b>: <span class="metalpurity1">&nbsp; VVS2</span></li>
                                                                                                                                <li><b>Cut</b>: <span class="metalpurity1">&nbsp; Excellent</span></li>
                                                                                                                                <li><b>Polish</b>: <span class="metalpurity1">&nbsp; Very Good</span></li>
                                                                                                                                <li><b>Symm</b>: <span class="metalpurity1">&nbsp; Very Good</span></li>
                                                                                                                                <li><b>Fluor.</b>: <span class="metalpurity1">&nbsp; None</span></li>
                                                                                                                                <li><b>Lab</b>: <span class="metalpurity1">&nbsp; IGI</span></li>
                                                                                                                            </ul>
                                                                                                                        </div>
                                                                                                                        <div class="col-md-6">
                                                                                                                            <ul>
                                                                                                                                <li><b>$/ct</b>: <span class="metalpurity1">&nbsp; $354</span></li>
                                                                                                                                <li><b>%Savani</b>: <span class="metalpurity1">&nbsp; -83.9%</span></li>
                                                                                                                                <li><b>Total</b>: <span class="metalpurity1">&nbsp; $321</span></li>
                                                                                                                                <li><b>Depth</b>: <span class="metalpurity1">&nbsp; -</span></li>
                                                                                                                                <li><b>Table</b>: <span class="metalpurity1">&nbsp; 58% </span></li>
                                                                                                                                <li><b>Measurement</b>: <span class="metalpurity1">&nbsp; 4.20-4.30-3.20</span></li>
                                                                                                                                <li><b>Vendor Stock No. </b>: <span class="metalpurity1">&nbsp; 1111230 </span></li>
                                                                                                                                <li><b>Status</b>: <span class="metalpurity1">&nbsp; G</span></li>
                                                                                                                                <li><b>Media</b>: <span class="metalpurity1">&nbsp; -</span></li>
                                                                                                                                <li><b>Ratio</b>: <span class="metalpurity1">&nbsp; 1.132</span></li>
                                                                                                                            </ul>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 searchddetail2">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12 detail1search">
                                                                                                                <div class="headset">
                                                                                                                    <h5 class="text-left">
                                                                                                                        Price
                                                                                                                    </h5>
                                                                                                                    <div class="pricecalimg">
                                                                                                                        <img src="http://192.168.1.2/savanigems/assets/images/searchpage/pricecal.svg" alt="diamonds" title="diamonds">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="searchmoredetail3">
                                                                                                                    <ul>
                                                                                                                        <li><b>Lot Diamond #</b>: <span class="metalpurity1">&nbsp; 51954</span></li>
                                                                                                                        <li><b>Availability</b>: <span class="metalpurity1">&nbsp; Guaranteed Availability</span></li>
                                                                                                                        <li><b>Diamond Loaction</b>: <span class="metalpurity1">&nbsp; united kingdom london</span></li>
                                                                                                                        <li><b>Stock No #</b>: <span class="metalpurity1">&nbsp; 1 132</span></li>
                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                                <div class="headset">
                                                                                                                    <h5 class="text-left">
                                                                                                                        <li>$/ct</li>
                                                                                                                        <li>$/ct</li>
                                                                                                                        <li>$/ct</li>
                                                                                                                    </h5>
                                                                                                                    <div class="cashname">
                                                                                                                        <ul>
                                                                                                                            <li> <b>cash</b></li>
                                                                                                                            <li>$350</li>
                                                                                                                            <li>-56%</li>
                                                                                                                            <li>$230</li>
                                                                                                                        </ul>
                                                                                                                        <ul>
                                                                                                                            <li> <b>Price</b></li>
                                                                                                                            <li>$410</li>
                                                                                                                            <li>-56.20%</li>
                                                                                                                            <li>$850</li>
                                                                                                                        </ul>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>

                                                                                                            <div class="col-md-12 mediaset">
                                                                                                                <h4>media</h4>
                                                                                                                <button type="button" class="btn reseacbtn">
                                                                                                                    <div class="pricecalimg">
                                                                                                                        <img src="http://192.168.1.2/savanigems/assets/images/searchpage/report.svg" alt="diamonds" title="diamonds">
                                                                                                                    </div>
                                                                                                                    Report
                                                                                                                </button>
                                                                                                                <button type="button" class="btn reseacbtn">
                                                                                                                    <div class="pricecalimg">
                                                                                                                        <img src="http://192.168.1.2/savanigems/assets/images/searchpage/diogram.svg" alt="diamonds" title="diamonds">
                                                                                                                    </div>
                                                                                                                    Diogram
                                                                                                                </button>
                                                                                                                <button type="button" class="btn reseacbtn">
                                                                                                                    <div class="pricecalimg">
                                                                                                                        <img src="http://192.168.1.2/savanigems/assets/images/searchpage/video.svg" alt="diamonds" title="diamonds">
                                                                                                                    </div>
                                                                                                                    Video
                                                                                                                </button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 searchddetail2">
                                                                                                        <div class="row sedetil">
                                                                                                            <div class="col-md-12 detail1search">
                                                                                                                <div class="headset">
                                                                                                                    <h5 class="text-left">
                                                                                                                        Seller Details
                                                                                                                    </h5>
                                                                                                                </div>
                                                                                                                <div class="row setpro">
                                                                                                                    <div class="col-md-7 ">
                                                                                                                        <ul class="d-flex justify-content-between align-items-center">
                                                                                                                            <li>
                                                                                                                                <div class="profileimg">
                                                                                                                                    <img src="http://192.168.1.2/savanigems/assets/images/searchpage/dummy.png" alt="diamonds" title="diamonds">
                                                                                                                                </div>
                                                                                                                            </li>
                                                                                                                            <li>
                                                                                                                                <div class="desc ">
                                                                                                                                    <h4>varun Dimonds</h4>
                                                                                                                                    <h5><b>savani id</b>: <span class="metalpurity1">&nbsp; 235689</span></h5>
                                                                                                                                </div>
                                                                                                                            </li>
                                                                                                                        </ul>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-5 afprofile">
                                                                                                                        <ul class="d-flex justify-content-between align-items-center">
                                                                                                                            <li>
                                                                                                                                <div class="sideimg">
                                                                                                                                    <img src="http://192.168.1.2/savanigems/assets/images/searchpage/review.svg" alt="diamonds" title="diamonds">
                                                                                                                                </div>
                                                                                                                            </li>
                                                                                                                            <li>
                                                                                                                                <div class="desc">
                                                                                                                                    <h6>no reating yet</h6>
                                                                                                                                </div>
                                                                                                                            </li>
                                                                                                                        </ul>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="searchmoredetail3">
                                                                                                                    <ul>
                                                                                                                        <li><b>Location</b>: <span class="metalpurity1">&nbsp; India</span></li>
                                                                                                                        <li><b>Contect Person</b>: <span class="metalpurity1">&nbsp; Varun dhavan</span></li>
                                                                                                                        <li><b>Phone</b>: <span class="metalpurity1">&nbsp; 9092565695</span></li>
                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-12 noteset">
                                                                                                                <div class="writset">
                                                                                                                    <textarea class="form-control" rows="4" placeholder=" Write a personal note...." id="comment"></textarea>
                                                                                                                </div>
                                                                                                                <div class="colsave">
                                                                                                                    <ul>
                                                                                                                        <li>
                                                                                                                            <div class="colorset">
                                                                                                                                <input type="color" class="scolor" id="colorpicker" value="#0000ff">
                                                                                                                            </div>
                                                                                                                            <p>if you want to change color top here</p>
                                                                                                                        </li>
                                                                                                                        <li>
                                                                                                                            <button type="button" class="btn searchbtnset">save</button>
                                                                                                                        </li>
                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor2">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor2">
                                                                                                    priya
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating1">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor3">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor3">
                                                                                                    hari
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating2">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor4">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor4">
                                                                                                    rohan
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating3">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor5">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor5">
                                                                                                    jeel
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor6">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor6">
                                                                                                    nilesh
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating1">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor7">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor7">
                                                                                                    jenil
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating2">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselcto8">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor8">
                                                                                                    raj
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating3">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor">
                                                                                                    deep
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor">
                                                                                                    seller
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating1">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor">
                                                                                                    seller
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating2">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor">
                                                                                                    seller
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating3">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor">
                                                                                                    seller
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor">
                                                                                                    seller
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating1">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor">
                                                                                                    seller
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating2">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor">
                                                                                                    seller
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating3">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor">
                                                                                                    seller
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="searchreating">100%</div>
                                                                                        </td>
                                                                                        <td>uk</td>
                                                                                        <td>Round</td>
                                                                                        <td>0.04</td>
                                                                                        <td>D</td>
                                                                                        <td>VVS2</td>
                                                                                        <td>Excellent</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>Very Good</td>
                                                                                        <td>None</td>
                                                                                        <td>IGI</td>
                                                                                        <td>$354</td>
                                                                                        <td>-83.9%</td>
                                                                                        <td>$321</td>
                                                                                        <td>-</td>
                                                                                        <td>58%</td>
                                                                                        <td>4.20-4.30-3.20</td>
                                                                                        <td>1111230</td>
                                                                                        <td>G</td>
                                                                                        <td>-</td>
                                                                                        <td>1.132</td>
                                                                                    </tr>
                                                                                    <tr class="elements-count sr-only" data-number="80"></tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                        <div class="filter-box filter-diamond-box">
                                                            <form action="">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-btns text-right p-2">
                                                                                <button type="submit" class="btn send-btn dash-serchbtn" disabled="" data-category="free search" data-label="Diamond search" data-hs-event-50099495="1">Search</button>
                                                                                <input type="reset" value="Reset" class="btn reset-btn dash-reset-btn">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group shape-group dash-shape">
                                                                    <div class="name-filter">Shape
                                                                    </div>
                                                                    <div class="row-filter dash-row">
                                                                        <div class="filter-container">
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f01" class="dashboard-control custom-control-input" value="Round">
                                                                                <label for="f01" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_round.svg" alt="Round" class="img-responsive"></span>
                                                                                    <span class="text-label">Round</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f181" class="dashboard-control custom-control-input" value="Pear">
                                                                                <label for="f181" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_pear.svg" alt="Pear" class="img-responsive"></span>
                                                                                    <span class="text-label">Pear</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f231" class="dashboard-control custom-control-input" value="Princess">
                                                                                <label for="f231" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_princess.svg" alt="Princess" class="img-responsive"></span>
                                                                                    <span class="text-label">Princess</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f342" class="dashboard-control custom-control-input" value="Marquise">
                                                                                <label for="f342" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_marquise.svg" alt="Marquise" class="img-responsive"></span>
                                                                                    <span class="text-label">Marquise</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f452" class="dashboard-control custom-control-input" value="Emerald">
                                                                                <label for="f452" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_emerald_l.svg" alt="Emerald" class="img-responsive"></span>
                                                                                    <span class="text-label">Emerald</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f56" class="dashboard-control custom-control-input" value="Cushion Brilliant">
                                                                                <label for="f56" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_cushion_brilliant_l.svg" alt="Cushion Brilliant" class="img-responsive"></span>
                                                                                    <span class="text-label">Cushion Brilliant</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f67" class="dashboard-control custom-control-input" value="Cushion Modified">
                                                                                <label for="f67" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_cushion_mod_l.svg" alt="Cushion Modified" class="img-responsive"></span>
                                                                                    <span class="text-label">Cushion Modified</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f78" class="dashboard-control custom-control-input" value="Asscher">
                                                                                <label for="f78" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_asscher_l.svg" alt="Asscher" class="img-responsive"></span>
                                                                                    <span class="text-label">Asscher</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f89" class="dashboard-control custom-control-input" value="Sq. Emerald">
                                                                                <label for="f89" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_sq_emerald.svg" alt="Sq. Emerald" class="img-responsive"></span>
                                                                                    <span class="text-label">Sq. Emerald</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f910" class="dashboard-control custom-control-input" value="Oval">
                                                                                <label for="f910" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_oval.svg" alt="Oval" class="img-responsive"></span>
                                                                                    <span class="text-label">Oval</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f111" class="dashboard-control custom-control-input" value="Radiant">
                                                                                <label for="f111" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_radiant.svg" alt="Radiant" class="img-responsive"></span>
                                                                                    <span class="text-label">Radiant</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f112" class="dashboard-control custom-control-input" value="Heart">
                                                                                <label for="f112" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_heart.svg" alt="Heart" class="img-responsive"></span>
                                                                                    <span class="text-label">Heart</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f113" class="dashboard-control custom-control-input" value="European Cut">
                                                                                <label for="f113" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_euro_cut.svg" alt="European Cut" class="img-responsive"></span>
                                                                                    <span class="text-label">European Cut</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f114" class="dashboard-control custom-control-input" value="Old Miner">
                                                                                <label for="f114" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_old_miner.svg" alt="Old Miner" class="img-responsive"></span>
                                                                                    <span class="text-label">Old Miner</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f145" class="dashboard-control custom-control-input" value="Baguette">
                                                                                <label for="f145" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_baguette_l.svg" alt="Baguette" class="img-responsive"></span>
                                                                                    <span class="text-label">Baguette</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f156" class="dashboard-control custom-control-input" value="Briolette">
                                                                                <label for="f156" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_briolette_l.svg" alt="Briolette" class="img-responsive"></span>
                                                                                    <span class="text-label">Briolette</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f167" class="dashboard-control custom-control-input" value="Bullets">
                                                                                <label for="f167" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_bullet_l.svg" alt="Bullets" class="img-responsive"></span>
                                                                                    <span class="text-label">Bullets</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f178" class="dashboard-control custom-control-input" value="Calf">
                                                                                <label for="f178" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_calf_l.svg" alt="Calf" class="img-responsive"></span>
                                                                                    <span class="text-label">Calf</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f189" class="dashboard-control custom-control-input" value="Half Moon">
                                                                                <label for="f189" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_half_moon.svg" alt="Half Moon" class="img-responsive"></span>
                                                                                    <span class="text-label">Half Moon</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f120" class="dashboard-control custom-control-input" value="Hexagonal">
                                                                                <label for="f120" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_hexagonal.svg" alt="Hexagonal" class="img-responsive"></span>
                                                                                    <span class="text-label">Hexagonal</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f121" class="dashboard-control custom-control-input" value="Kite">
                                                                                <label for="f121" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_kite.svg" alt="Kite" class="img-responsive"></span>
                                                                                    <span class="text-label">Kite</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f122" class="dashboard-control custom-control-input" value="Lozenge">
                                                                                <label for="f122" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_lozenge.svg" alt="Lozenge" class="img-responsive"></span>
                                                                                    <span class="text-label">Lozenge</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f123" class="dashboard-control custom-control-input" value="Octagonal">
                                                                                <label for="f123" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_octagonal.svg" alt="Octagonal" class="img-responsive"></span>
                                                                                    <span class="text-label">Octagonal</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f124" class="dashboard-control custom-control-input" value="Pentagonal">
                                                                                <label for="f124" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_pentagonal.svg" alt="Pentagonal" class="img-responsive"></span>
                                                                                    <span class="text-label">Pentagonal</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f125" class="dashboard-control custom-control-input" value="Rose">
                                                                                <label for="f125" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="<?php echo $config->getimageurl() ?>images/homepage/rap_rose.svg" alt="Rose" class="img-responsive"></span>
                                                                                    <span class="text-label">Rose</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f126" class="dashboard-control custom-control-input" value="Shield">
                                                                                <label for="f126" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="#" alt="Shield" class="img-responsive"></span>
                                                                                    <span class="text-label">Shield</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f127" class="dashboard-control custom-control-input" value="Square">
                                                                                <label for="f127" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="#" alt="Square" class="img-responsive"></span>
                                                                                    <span class="text-label">Square</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f128" class="dashboard-control custom-control-input" value="Square Radiant">
                                                                                <label for="f128" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="#" alt="Square Radiant" class="img-responsive"></span>
                                                                                    <span class="text-label">Square Radiant</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f280" class="dashboard-control custom-control-input" value="Star">
                                                                                <label for="f280" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="#" alt="Star" class="img-responsive"></span>
                                                                                    <span class="text-label">Star</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f291" class="dashboard-control custom-control-input" value="Tapered Baguette">
                                                                                <label for="f291" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="#" alt="Tapered Baguette" class="img-responsive"></span>
                                                                                    <span class="text-label">Tapered Baguette</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f302" class="dashboard-control custom-control-input" value="Tapered Bullet">
                                                                                <label for="f302" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="#" alt="Tapered Bullet" class="img-responsive"></span>
                                                                                    <span class="text-label">Tapered Bullet</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f311" class="dashboard-control custom-control-input" value="Trapezoid">
                                                                                <label for="f311" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="#" alt="Trapezoid" class="img-responsive"></span>
                                                                                    <span class="text-label">Trapezoid</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f321" class="dashboard-control custom-control-input" value="Triangular">
                                                                                <label for="f321" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="#" alt="Triangular" class="img-responsive"></span>
                                                                                    <span class="text-label">Triangular</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f331" class="dashboard-control custom-control-input" value="Trilliant">
                                                                                <label for="f331" class="custom-control-label with-img">
                                                                                    <span class="img-wrap"><img src="#" alt="Trilliant" class="img-responsive"></span>
                                                                                    <span class="text-label">Trilliant</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="f341" class="dashboard-control custom-control-input" value="Other">
                                                                                <label for="f341" class="custom-control-label with-img">
                                                                                    <span class="text-label">Other</span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <button type="button" class="btn show-more-filters">
                                                                            <span class="text">+ 30 More</span>
                                                                            <span class="text opened">- 30 Less</span>
                                                                            <span class="arrow-btn">
                                                                                <img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group size-group dash-size-group">
                                                                    <div class="name-filter">Size</div>
                                                                    <div class="row-filter dash-row">
                                                                        <div class="col-12 col-md-6 sizesetall cut-group">
                                                                            <label id="sizefrom">From</label>
                                                                            <select aria-labelledby="sizefrom" name="sizefrom" class="form-control">
                                                                                <option value="0">From</option>
                                                                                <option value="1">Poor</option>
                                                                                <option value="2">Fair</option>
                                                                                <option value="3">Good</option>
                                                                                <option value="4">Very Good</option>
                                                                                <option value="5">Excellent</option>
                                                                                <option value="6">Ideal</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12 col-md-6 cut-group">
                                                                            <label id="sizeto">To</label>
                                                                            <select aria-labelledby="sizeto" name="sizeto" class="form-control">
                                                                                <option value="0">To</option>
                                                                                <option value="1">Poor</option>
                                                                                <option value="2">Fair</option>
                                                                                <option value="3">Good</option>
                                                                                <option value="4">Very Good</option>
                                                                                <option value="5">Excellent</option>
                                                                                <option value="6">Ideal</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group size-group dash-size-group">
                                                                    <div class="name-filter">Total Size</div>
                                                                    <div class="row-filter dash-row">
                                                                        <div class="col-12 col-md-6 sizesetall cut-group">
                                                                            <label id="totalsizefrom">From</label>
                                                                            <select aria-labelledby="totalsizefrom" name="totalsizefrom" class="form-control">
                                                                                <option value="0">From</option>
                                                                                <option value="1">Poor</option>
                                                                                <option value="2">Fair</option>
                                                                                <option value="3">Good</option>
                                                                                <option value="4">Very Good</option>
                                                                                <option value="5">Excellent</option>
                                                                                <option value="6">Ideal</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12 col-md-6 cut-group">
                                                                            <label id="totalsizeto">To</label>
                                                                            <select aria-labelledby="totalsizeto" name="totalsizeto" class="form-control">
                                                                                <option value="0">To</option>
                                                                                <option value="1">Poor</option>
                                                                                <option value="2">Fair</option>
                                                                                <option value="3">Good</option>
                                                                                <option value="4">Very Good</option>
                                                                                <option value="5">Excellent</option>
                                                                                <option value="6">Ideal</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group color-group dash-shape">
                                                                    <div class="name-filter">Color</div>
                                                                    <div class="row-filter dash-row">
                                                                        <div class="filter-container">
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c08" class="dashboard-control custom-control-input">
                                                                                <label for="c08" class="custom-control-label">
                                                                                    D
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c189" class="dashboard-control custom-control-input">
                                                                                <label for="c189" class="custom-control-label">
                                                                                    E
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c28" class="dashboard-control custom-control-input">
                                                                                <label for="c28" class="custom-control-label">
                                                                                    F
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c38" class="dashboard-control custom-control-input">
                                                                                <label for="c38" class="custom-control-label">
                                                                                    G
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c48" class="dashboard-control custom-control-input">
                                                                                <label for="c48" class="custom-control-label">
                                                                                    H
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c58" class="dashboard-control custom-control-input">
                                                                                <label for="c58" class="custom-control-label">
                                                                                    I
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c68" class="dashboard-control custom-control-input">
                                                                                <label for="c68" class="custom-control-label">
                                                                                    J
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c78" class="dashboard-control custom-control-input">
                                                                                <label for="c78" class="custom-control-label">
                                                                                    K
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c88" class="dashboard-control custom-control-input">
                                                                                <label for="c88" class="custom-control-label">
                                                                                    L
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c98" class="dashboard-control custom-control-input">
                                                                                <label for="c98" class="custom-control-label">
                                                                                    M
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c108" class="dashboard-control custom-control-input">
                                                                                <label for="c108" class="custom-control-label">
                                                                                    N
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c118" class="dashboard-control custom-control-input">
                                                                                <label for="c118" class="custom-control-label">
                                                                                    O
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c128" class="dashboard-control custom-control-input">
                                                                                <label for="c128" class="custom-control-label">
                                                                                    P
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c138" class="dashboard-control custom-control-input">
                                                                                <label for="c138" class="custom-control-label">
                                                                                    Q
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c148" class="dashboard-control custom-control-input">
                                                                                <label for="c148" class="custom-control-label">
                                                                                    R
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c158" class="dashboard-control custom-control-input">
                                                                                <label for="c158" class="custom-control-label">
                                                                                    S
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c168" class="dashboard-control custom-control-input">
                                                                                <label for="c168" class="custom-control-label">
                                                                                    T
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c178" class="dashboard-control custom-control-input">
                                                                                <label for="c178" class="custom-control-label">
                                                                                    U
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c188" class="dashboard-control custom-control-input">
                                                                                <label for="c188" class="custom-control-label">
                                                                                    V
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c198" class="dashboard-control custom-control-input">
                                                                                <label for="c198" class="custom-control-label">
                                                                                    W
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c208" class="dashboard-control custom-control-input">
                                                                                <label for="c208" class="custom-control-label">
                                                                                    X
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c218" class="dashboard-control custom-control-input">
                                                                                <label for="c218" class="custom-control-label">
                                                                                    Y
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="c228" class="dashboard-control custom-control-input">
                                                                                <label for="c228" class="custom-control-label">
                                                                                    Z
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <button type="button" class="btn show-more-filters">
                                                                            <span class="text">+ 18 More</span>
                                                                            <span class="text opened">- 18 Less</span>
                                                                            <span class="arrow-btn">
                                                                                <img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group clarity-group dash-shape">
                                                                    <div class="name-filter">Clarity</div>
                                                                    <div class="row-filter dash-row">
                                                                        <div class="filter-container">
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="cl09" class="dashboard-control custom-control-input">
                                                                                <label for="cl09" class="custom-control-label">
                                                                                    FL
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="cl19" class="dashboard-control custom-control-input">
                                                                                <label for="cl19" class="custom-control-label">
                                                                                    IF
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="cl29" class="dashboard-control custom-control-input">
                                                                                <label for="cl29" class="custom-control-label">
                                                                                    VVS1
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="cl39" class="dashboard-control custom-control-input">
                                                                                <label for="cl39" class="custom-control-label">
                                                                                    VVS2
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="cl49" class="dashboard-control custom-control-input">
                                                                                <label for="cl49" class="custom-control-label">
                                                                                    VS1
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="cl59" class="dashboard-control custom-control-input">
                                                                                <label for="cl59" class="custom-control-label">
                                                                                    VS2
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="cl69" class="dashboard-control custom-control-input">
                                                                                <label for="cl69" class="custom-control-label">
                                                                                    VS3
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="cl79" class="dashboard-control custom-control-input">
                                                                                <label for="cl79" class="custom-control-label">
                                                                                    SI1
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="cl89" class="dashboard-control custom-control-input">
                                                                                <label for="cl89" class="custom-control-label">
                                                                                    SI2
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="cl99" class="dashboard-control custom-control-input">
                                                                                <label for="cl99" class="custom-control-label">
                                                                                    SI3
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="cl109" class="dashboard-control custom-control-input">
                                                                                <label for="cl109" class="custom-control-label">
                                                                                    I1
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="cl119" class="dashboard-control custom-control-input">
                                                                                <label for="cl119" class="custom-control-label">
                                                                                    I2
                                                                                </label>
                                                                            </div>
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="cl129" class="dashboard-control custom-control-input">
                                                                                <label for="cl129" class="custom-control-label">
                                                                                    I3
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group flu-group dash-flu-group dash-shape">
                                                                    <div class="name-filter">Shows Only</div>
                                                                    <div class="row-filter dash-row">
                                                                        <div class="filter-container">
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="fl113" class="dashboard-control custom-control-input" value="None">
                                                                                <label for="fl113" class="custom-control-label">
                                                                                    <img class="primary-img" src="<?php echo $config->getimageurl() ?>images/primary-icon.svg" alt="Primary Suppliers" title="Primary Suppliers"> Primary Suppliers
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group multiply-group-filter">
                                                                    <div class="name-filter">Piece Per Carat</div>
                                                                    <div class="row-filter dash-row">
                                                                        <div class="col-12 col-md-12">
                                                                            <div class="row">
                                                                                <div class="col-12 col-md-6 sizesetall   cut-group">
                                                                                    <label id="ppcfrom">From</label>
                                                                                    <select aria-labelledby="ppcfrom" name="ppcfrom" class="form-control">
                                                                                        <option value="0">From</option>
                                                                                        <option value="1">Poor</option>
                                                                                        <option value="2">Fair</option>
                                                                                        <option value="3">Good</option>
                                                                                        <option value="4">Very Good</option>
                                                                                        <option value="5">Excellent</option>
                                                                                        <option value="6">Ideal</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-12 col-md-6 cut-group">
                                                                                    <label id="ppcto">To</label>
                                                                                    <select aria-labelledby="ppcto" name="ppcto" class="form-control">
                                                                                        <option value="0">To</option>
                                                                                        <option value="1">Poor</option>
                                                                                        <option value="2">Fair</option>
                                                                                        <option value="3">Good</option>
                                                                                        <option value="4">Very Good</option>
                                                                                        <option value="5">Excellent</option>
                                                                                        <option value="6">Ideal</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group size-group dash-size-group">
                                                                    <div class="name-filter">Price

                                                                    </div>

                                                                    <div class="row-filter dash-row">
                                                                        <div class="col-12 col-md-4">
                                                                            <label id="pricesctfrom">S/CT</label>
                                                                            <div class="row">
                                                                                <div class="col-12 col-md-6 sizesetall cut-group">
                                                                                    <select aria-labelledby="pricesctfrom" name="pricesctfrom" class="form-control">
                                                                                        <option value="0">From</option>
                                                                                        <option value="1">Poor</option>
                                                                                        <option value="2">Fair</option>
                                                                                        <option value="3">Good</option>
                                                                                        <option value="4">Very Good</option>
                                                                                        <option value="5">Excellent</option>
                                                                                        <option value="6">Ideal</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-12 col-md-6 cut-group">
                                                                                    <select aria-labelledby="pricesctto" name="pricesctto" class="form-control">
                                                                                        <option value="0">To</option>
                                                                                        <option value="1">Poor</option>
                                                                                        <option value="2">Fair</option>
                                                                                        <option value="3">Good</option>
                                                                                        <option value="4">Very Good</option>
                                                                                        <option value="5">Excellent</option>
                                                                                        <option value="6">Ideal</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-md-4">
                                                                            <div class="row totalset">
                                                                                <div class="col-12 col-md-6 cut-group">
                                                                                    <label id="pricetotalfrom">Total</label>
                                                                                    <select aria-labelledby="pricetotalfrom" name="pricetotalfrom" class="form-control">
                                                                                        <option value="0">From</option>
                                                                                        <option value="1">Poor</option>
                                                                                        <option value="2">Fair</option>
                                                                                        <option value="3">Good</option>
                                                                                        <option value="4">Very Good</option>
                                                                                        <option value="5">Excellent</option>
                                                                                        <option value="6">Ideal</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-12 col-md-6 cut-group">
                                                                                    <select aria-labelledby="pricetotalto" name="pricetotalto" class="form-control">
                                                                                        <option value="0">To</option>
                                                                                        <option value="1">Poor</option>
                                                                                        <option value="2">Fair</option>
                                                                                        <option value="3">Good</option>
                                                                                        <option value="4">Very Good</option>
                                                                                        <option value="5">Excellent</option>
                                                                                        <option value="6">Ideal</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-md-4">
                                                                            <label id="savani%from">Savani%</label>
                                                                            <div class="row">
                                                                                <div class="col-12 col-md-6 cut-group">
                                                                                    <select aria-labelledby="savani%from" name="savani%from" class="form-control">
                                                                                        <option value="0">From</option>
                                                                                        <option value="1">Poor</option>
                                                                                        <option value="2">Fair</option>
                                                                                        <option value="3">Good</option>
                                                                                        <option value="4">Very Good</option>
                                                                                        <option value="5">Excellent</option>
                                                                                        <option value="6">Ideal</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-12 col-md-6 cut-group">
                                                                                    <select aria-labelledby="savani%to" name="savani%to" class="form-control">
                                                                                        <option value="0">To</option>
                                                                                        <option value="1">Poor</option>
                                                                                        <option value="2">Fair</option>
                                                                                        <option value="3">Good</option>
                                                                                        <option value="4">Very Good</option>
                                                                                        <option value="5">Excellent</option>
                                                                                        <option value="6">Ideal</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group flu-group dash-flu-group dash-shape">
                                                                    <div class="name-filter">Shows Only</div>
                                                                    <div class="row-filter dash-row">
                                                                        <div class="filter-container">
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="fl23" class="dashboard-control custom-control-input" value="None">
                                                                                <label for="fl23" class="custom-control-label">
                                                                                    Any
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="filter-container">
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="fl24" class="dashboard-control custom-control-input" value="None">
                                                                                <label for="fl24" class="custom-control-label">
                                                                                    Star
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="filter-container">
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="fl25" class="dashboard-control custom-control-input" value="None">
                                                                                <label for="fl25" class="custom-control-label">
                                                                                    Melee
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="filter-container">
                                                                            <div class="filter custom-checkbox">
                                                                                <input type="checkbox" id="fl26" class="dashboard-control custom-control-input" value="None">
                                                                                <label for="fl26" class="custom-control-label">
                                                                                    Parcel
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group size-group dash-size-group">
                                                                    <div class="name-filter">Sleve</div>
                                                                    <div class="row-filter dash-row">
                                                                        <div class="col-12 col-md-6 cut-group">
                                                                            <label id="slevefrom">From</label>
                                                                            <select aria-labelledby="slevefrom" name="slevefrom" class="form-control">
                                                                                <option value="0">From</option>
                                                                                <option value="1">Poor</option>
                                                                                <option value="2">Fair</option>
                                                                                <option value="3">Good</option>
                                                                                <option value="4">Very Good</option>
                                                                                <option value="5">Excellent</option>
                                                                                <option value="6">Ideal</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12 col-md-6 cut-group">
                                                                            <label id="sleveto">To</label>
                                                                            <select aria-labelledby="sleveto" name="sleveto" class="form-control">
                                                                                <option value="0">To</option>
                                                                                <option value="1">Poor</option>
                                                                                <option value="2">Fair</option>
                                                                                <option value="3">Good</option>
                                                                                <option value="4">Very Good</option>
                                                                                <option value="5">Excellent</option>
                                                                                <option value="6">Ideal</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-btns text-center p-5">
                                                                    <button type="submit" class="btn send-btn dash-serchbtn" disabled="" data-category="free search" data-label="Diamond search" data-hs-event-50099495="1">Search</button>
                                                                    <input type="reset" value="Reset" class="btn reset-btn dash-reset-btn">
                                                                </div>
                                                                <div class="col-12 col-md-12">
                                                                    <div class="row searchheaddet">
                                                                        <div class="col-md-6 moredetail">
                                                                            <ul>
                                                                                <li><b>Total Carats 123,176,86 </b>|</li>
                                                                                <li>&nbsp; Total Value $98,176,86 |</li>
                                                                                <li>&nbsp; Average $/ct 1,299 |</li>
                                                                                <li>&nbsp; Average Discount - 36.32%</li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="text-right searchhead">
                                                                                <div class="searchgreade searchcom">
                                                                                    <button type="button" class="btn searchbtnset"><img src="http://192.168.1.2/savanigems/assets/images/searchpage/3.svg" alt="diamonds" title="diamonds"></button>
                                                                                </div>
                                                                                <div class="searchgreade searchcom">
                                                                                    <button type="button" class="btn searchbtnset"><img src="http://192.168.1.2/savanigems/assets/images/searchpage/fliter.svg" alt="diamonds" title="diamonds"></button>
                                                                                </div>
                                                                                <div class="searchgreade searchcom">
                                                                                    <button type="button" class="btn searchbtnset"><img src="http://192.168.1.2/savanigems/assets/images/searchpage/search.svg" alt="diamonds" title="diamonds"> New search</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="shapesearch">
                                                                                <button type="button" class="btn searchbtnset"><b> Shape : </b><Span>Round</Span></button>
                                                                                <button type="button" class="btn searchbtnset"><b> Size : </b><Span>0.30-0.39</Span></button>
                                                                                <button type="button" class="btn searchbtnset"><b> Shape : </b><Span>Round</Span></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion" id="accordionExample">
                                                                        <div class="table-responsive searchpagedetail">
                                                                            <table class="table table-tb">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor">
                                                                                                    Status
                                                                                                </label>
                                                                                            </div>

                                                                                        </th>
                                                                                        <th>Seller</th>
                                                                                        <th>Lot#</th>
                                                                                        <th>Shape</th>
                                                                                        <th>Type</th>
                                                                                        <th>Avg.Size</th>
                                                                                        <th>Avg.Color</th>
                                                                                        <th>Avg.Clarit</th>
                                                                                        <th>Amount</th>
                                                                                        <th>Total Size</th>
                                                                                        <th>$/ct</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <div class="searchPadding">
                                                                                        <div class="collapse out" id="searchdown">
                                                                                            <div class="col-12 col-md-12 searchddetail">
                                                                                                <div class="text-left searchleft">
                                                                                                    <div class="searchgreade parcel">
                                                                                                        <button type="button" class="btn searchbtnset">$/ct<br><b>$ 380</b></button>
                                                                                                    </div>
                                                                                                    <div class="searchgreade">
                                                                                                        <button type="button" class="btn searchbtnset">Savani%<br><b>-83.23%</b></button>
                                                                                                    </div>
                                                                                                    <div class="searchgreade">
                                                                                                        <button type="button" class="btn searchbtnset">Total<br><b>$123</b></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="text-right searchright">
                                                                                                    <div class="searchgreade searchcom">
                                                                                                        <button type="button" class="btn searchbtnset" data-toggle="modal" data-target="#contect">contect seller</button>
                                                                                                    </div>
                                                                                                    <div class="searchgreade searchcom">
                                                                                                        <button type="button" class="btn searchbtnset">More</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-12 searchddetail">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6 searchddetail1">
                                                                                                        <div class="card">
                                                                                                            <div class="card-body">
                                                                                                                <div class="headset">
                                                                                                                    <h5 class="text-left">
                                                                                                                        diamond details
                                                                                                                    </h5>
                                                                                                                    <h4>Last Update: 02-02-2021</h4>
                                                                                                                </div>
                                                                                                                <div class="searchmoredetail">
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-md-6">
                                                                                                                            <ul>
                                                                                                                                <li><b>Shape</b>: <span class="metalpurity1">&nbsp; Round</span></li>
                                                                                                                                <li><b>Size</b>: <span class="metalpurity1">&nbsp; 0.04</span></li>
                                                                                                                                <li><b>Color</b>: <span class="metalpurity1">&nbsp; D</span></li>
                                                                                                                                <li><b>Clarity</b>: <span class="metalpurity1">&nbsp; VVS2</span></li>
                                                                                                                                <li><b>Cut</b>: <span class="metalpurity1">&nbsp; Excellent</span></li>
                                                                                                                            </ul>
                                                                                                                        </div>
                                                                                                                        <div class="col-md-6">
                                                                                                                            <ul>
                                                                                                                                <li><b>$/ct</b>: <span class="metalpurity1">&nbsp; $354</span></li>
                                                                                                                                <li><b>%Savani</b>: <span class="metalpurity1">&nbsp; -83.9%</span></li>
                                                                                                                                <li><b>Total</b>: <span class="metalpurity1">&nbsp; $321</span></li>
                                                                                                                                <li><b>Depth</b>: <span class="metalpurity1">&nbsp; -</span></li>
                                                                                                                                <li><b>Table</b>: <span class="metalpurity1">&nbsp; 58% </span></li>
                                                                                                                                <li><b>Measurement</b>: <span class="metalpurity1">&nbsp; 4.20-4.30-3.20</span></li>
                                                                                                                            </ul>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 searchddetail2">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12 detail1search">
                                                                                                                <div class="headset">
                                                                                                                    <h5 class="text-left">
                                                                                                                        Price
                                                                                                                    </h5>
                                                                                                                    <div class="pricecalimg">
                                                                                                                        <img src="http://192.168.1.2/savanigems/assets/images/searchpage/pricecal.svg" alt="diamonds" title="diamonds">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="searchmoredetail3">
                                                                                                                    <ul>
                                                                                                                        <li><b>Lot Diamond #</b>: <span class="metalpurity1">&nbsp; 51954</span></li>
                                                                                                                        <li><b>Availability</b>: <span class="metalpurity1">&nbsp; Guaranteed Availability</span></li>
                                                                                                                        <li><b>Diamond Loaction</b>: <span class="metalpurity1">&nbsp; united kingdom london</span></li>
                                                                                                                        <li><b>Stock No #</b>: <span class="metalpurity1">&nbsp; 1 132</span></li>
                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                                <div class="headset">
                                                                                                                    <h5 class="text-left">
                                                                                                                        <li>$/ct</li>
                                                                                                                        <li>$/ct</li>
                                                                                                                        <li>$/ct</li>
                                                                                                                    </h5>
                                                                                                                    <div class="cashname">
                                                                                                                        <ul>
                                                                                                                            <li> <b>cash</b></li>
                                                                                                                            <li>$350</li>
                                                                                                                            <li>-56%</li>
                                                                                                                            <li>$230</li>
                                                                                                                        </ul>
                                                                                                                        <ul>
                                                                                                                            <li> <b>Price</b></li>
                                                                                                                            <li>$410</li>
                                                                                                                            <li>-56.20%</li>
                                                                                                                            <li>$850</li>
                                                                                                                        </ul>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>

                                                                                                            <div class="col-md-12 mediaset">
                                                                                                                <h4>media</h4>
                                                                                                                <button type="button" class="btn reseacbtn">
                                                                                                                    <div class="pricecalimg">
                                                                                                                        <img src="http://192.168.1.2/savanigems/assets/images/searchpage/report.svg" alt="diamonds" title="diamonds">
                                                                                                                    </div>
                                                                                                                    Report
                                                                                                                </button>
                                                                                                                <button type="button" class="btn reseacbtn">
                                                                                                                    <div class="pricecalimg">
                                                                                                                        <img src="http://192.168.1.2/savanigems/assets/images/searchpage/diogram.svg" alt="diamonds" title="diamonds">
                                                                                                                    </div>
                                                                                                                    Diogram
                                                                                                                </button>
                                                                                                                <button type="button" class="btn reseacbtn">
                                                                                                                    <div class="pricecalimg">
                                                                                                                        <img src="http://192.168.1.2/savanigems/assets/images/searchpage/video.svg" alt="diamonds" title="diamonds">
                                                                                                                    </div>
                                                                                                                    Video
                                                                                                                </button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 searchddetail2">
                                                                                                        <div class="row sedetil">
                                                                                                            <div class="col-md-12 detail1search">
                                                                                                                <div class="headset">
                                                                                                                    <h5 class="text-left">
                                                                                                                        Seller Details
                                                                                                                    </h5>
                                                                                                                </div>
                                                                                                                <div class="row setpro">
                                                                                                                    <div class="col-md-7 ">
                                                                                                                        <ul class="d-flex justify-content-between align-items-center">
                                                                                                                            <li>
                                                                                                                                <div class="profileimg">
                                                                                                                                    <img src="http://192.168.1.2/savanigems/assets/images/searchpage/dummy.png" alt="diamonds" title="diamonds">
                                                                                                                                </div>
                                                                                                                            </li>
                                                                                                                            <li>
                                                                                                                                <div class="desc ">
                                                                                                                                    <h4>varun Dimonds</h4>
                                                                                                                                    <h5><b>savani id</b>: <span class="metalpurity1">&nbsp; 235689</span></h5>
                                                                                                                                </div>
                                                                                                                            </li>
                                                                                                                        </ul>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-5 afprofile">
                                                                                                                        <ul class="d-flex justify-content-between align-items-center">
                                                                                                                            <li>
                                                                                                                                <div class="sideimg">
                                                                                                                                    <img src="http://192.168.1.2/savanigems/assets/images/searchpage/review.svg" alt="diamonds" title="diamonds">
                                                                                                                                </div>
                                                                                                                            </li>
                                                                                                                            <li>
                                                                                                                                <div class="desc">
                                                                                                                                    <h6>no reating yet</h6>
                                                                                                                                </div>
                                                                                                                            </li>
                                                                                                                        </ul>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="searchmoredetail3">
                                                                                                                    <ul>
                                                                                                                        <li><b>Location</b>: <span class="metalpurity1">&nbsp; India</span></li>
                                                                                                                        <li><b>Contect Person</b>: <span class="metalpurity1">&nbsp; Varun dhavan</span></li>
                                                                                                                        <li><b>Phone</b>: <span class="metalpurity1">&nbsp; 9092565695</span></li>
                                                                                                                    </ul>
                                                                                                                </div>

                                                                                                            </div>

                                                                                                            <div class="col-md-12 noteset">
                                                                                                                <div class="writset">
                                                                                                                    <textarea class="form-control" rows="4" placeholder=" Write a personal note...." id="comment"></textarea>
                                                                                                                </div>
                                                                                                                <div class="colsave">
                                                                                                                    <ul>
                                                                                                                        <li>
                                                                                                                            <div class="colorset">
                                                                                                                                <input type="color" class="scolor" id="colorpicker" value="#0000ff">
                                                                                                                            </div>
                                                                                                                            <p>if you want to change color top here</p>
                                                                                                                        </li>
                                                                                                                        <li>
                                                                                                                            <button type="button" class="btn searchbtnset">save</button>
                                                                                                                        </li>
                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr data-toggle="collapse" data-target="#searchdown" calss="sdown">
                                                                                        <td>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor1">
                                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor1">

                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td> nidhi </td>
                                                                                        <td>11320</td>
                                                                                        <td>Round</td>
                                                                                        <td>Melee</td>
                                                                                        <td>0.30</td>
                                                                                        <td>G</td>
                                                                                        <td>Vs1</td>
                                                                                        <td>536</td>
                                                                                        <td>23.65</td>
                                                                                        <td>#3235.0</td>
                                                                                    </tr>
                                                                                    <tr class="elements-count sr-only" data-number="80"></tr>
                                                                                </tbody>
                                                                            </table>
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
                                <!--  -->

                                <!--  -->
                                <!--Yesterday Tab Start-->
                                <!-- <div class="tab-pane" id="v-pills-3">
                                    <div class="row">
                                        <div class="col-md-4 mx-md-auto m-5">
                                            <div class="card no-b shadow">
                                                <div class="card-body p-4">
                                                    <div>
                                                        <i class="icon-calendar-check-o s-48 text-primary"></i>
                                                        <p class="p-t-b-20">Hey Soldier welcome back signin now there is lot of new stuff
                                                            waiting
                                                            for you</p>
                                                    </div>
                                                    <form action="http://xvelopers.com/demos/html/paper-panel/dashboard2.html">
                                                        <div class="form-group has-icon"><i class="icon-calendar"></i>
                                                            <input class="form-control form-control-lg datePicker" placeholder="Date From"
                                                                type="text">
                                                        </div>
                                                        <div class="form-group has-icon"><i class="icon-calendar"></i>
                                                            <input class="form-control form-control-lg datePicker" placeholder="Date TO"
                                                                type="text">
                                                        </div>
                                                        <input class="btn btn-success btn-lg btn-block" value="Get Data" type="submit">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!--Yesterday Tab Start-->
                                <!-- Footer Start -->
                                <?php include('footer.php'); ?>
                                <!-- Footer End -->

                                <!-- JS Start -->
                                <?php include('js.php'); ?>
                                <!-- JS End -->
                            </div>
                            <!-- upload diamond page start -->
                            <div class="tab-pane" id="v-pills-2">
                                <div class="row row-eq-height">
                                    <div class="col-md-12">
                                        <div class="card my-3 border-0 bg-light-gray">
                                            <div class="card-body chat-widget slimScroll p-0">
                                                <nav>
                                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                        <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Single</button>
                                                        <button class="nav-link ml-2" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Multiple</button>
                                                    </div>
                                                </nav>
                                                <div class="breadcrumbset">
                                                    <h5>Upload Single item</h5>
                                                    <div class="breadcrumb flat">
                                                        <a href="#" class="active">Browse</a>
                                                        <a href="#">Compare</a>
                                                        <a href="#">Order Confirmation</a>
                                                        <a href="#">Checkout</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- upload diamond page end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        // multiple selector
        $('#fltroughsourceid').select2();


        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        $("#menu-toggle-2").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled-2");
            $('#menu ul').hide();
        });

        function initMenu() {
            $('#menu ul').hide();
            $('#menu ul').children('.current').parent().show();
            //$('#menu ul:first').show();
            $('#menu li a').click(
                function() {
                    var checkElement = $(this).next();
                    if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                        return false;
                    }
                    if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                        $('#menu ul:visible').slideUp('normal');
                        checkElement.slideDown('normal');
                        return false;
                    }
                }
            );
        }
        $(document).ready(function() {
            initMenu();
        });

        $(".btn-close-sidebar").click(function() {
            $(".wrappernew.toggled").toggleClass("intro");
        });
    </script>

    </html>