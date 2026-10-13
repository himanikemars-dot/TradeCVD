<?php require_once 'config/init.php'; 
 require_once 'config/apiconfig.php'; 
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
        <!-- Header Start -->
        <?php include('header.php'); ?>
        <!-- Header End -->

        <div class="main" id="web-content">
            
<!-- Quick diamond Search Start-->
<section class="diamondsearch-sec section-space">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="diamondsearch-data text-center sec-info">
                    <div class="diamondsearch-title">
                        <h2 class="sec-title"><img class="diamond-serchimg" src="assets/images/homepage/diamond-serch.svg" alt="" title="">Quick diamond Search</h2>
                    </div>
                </div> 
            </div>
            <div class="col-12 col-md-12">
                <div class="free-search-widget" id="free-search-widget">
                    <h3>
                        Search Over <span>1,000,000</span> Diamonds from Thousands of Verified Suppliers Worldwide!
                    </h3>
                    <div class="container-search" id="free-search-container" data-show-items="20" data-page-number="1">
                        <div class="filter-box">
                            <form action="">
                                    <div class="form-group shape-group">
                                        <div class="name-filter">Shape <span class="red">*</span></div>
                                        <div class="row-filter">
                                            <div class="filter-container">
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f0" class="custom-control-input" value="Round">
                                                        <label for="f0" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_round.svg" alt="Round" class="img-responsive"></span>
                                                            <span class="text-label">Round</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f1" class="custom-control-input" value="Pear">
                                                        <label for="f1" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_pear.svg" alt="Pear" class="img-responsive"></span>
                                                            <span class="text-label">Pear</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f2" class="custom-control-input" value="Princess">
                                                        <label for="f2" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_princess.svg" alt="Princess" class="img-responsive"></span>
                                                            <span class="text-label">Princess</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f3" class="custom-control-input" value="Marquise">
                                                        <label for="f3" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_marquise.svg" alt="Marquise" class="img-responsive"></span>
                                                            <span class="text-label">Marquise</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f4" class="custom-control-input" value="Emerald">
                                                        <label for="f4" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_emerald_l.svg" alt="Emerald" class="img-responsive"></span>
                                                            <span class="text-label">Emerald</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f5" class="custom-control-input" value="Cushion Brilliant">
                                                        <label for="f5" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_cushion_brilliant_l.svg" alt="Cushion Brilliant" class="img-responsive"></span>
                                                            <span class="text-label">Cushion Brilliant</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f6" class="custom-control-input" value="Cushion Modified">
                                                        <label for="f6" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_cushion_mod_l.svg" alt="Cushion Modified" class="img-responsive"></span>
                                                            <span class="text-label">Cushion Modified</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f7" class="custom-control-input" value="Asscher">
                                                        <label for="f7" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_asscher_l.svg" alt="Asscher" class="img-responsive"></span>
                                                            <span class="text-label">Asscher</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f8" class="custom-control-input" value="Sq. Emerald">
                                                        <label for="f8" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_sq_emerald.svg" alt="Sq. Emerald" class="img-responsive"></span>
                                                            <span class="text-label">Sq. Emerald</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f9" class="custom-control-input" value="Oval">
                                                        <label for="f9" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_oval.svg" alt="Oval" class="img-responsive"></span>
                                                            <span class="text-label">Oval</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f10" class="custom-control-input" value="Radiant">
                                                        <label for="f10" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_radiant.svg" alt="Radiant" class="img-responsive"></span>
                                                            <span class="text-label">Radiant</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f11" class="custom-control-input" value="Heart">
                                                        <label for="f11" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_heart.svg" alt="Heart" class="img-responsive"></span>
                                                            <span class="text-label">Heart</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f12" class="custom-control-input" value="European Cut">
                                                        <label for="f12" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_euro_cut.svg" alt="European Cut" class="img-responsive"></span>
                                                            <span class="text-label">European Cut</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f13" class="custom-control-input" value="Old Miner">
                                                        <label for="f13" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_old_miner.svg" alt="Old Miner" class="img-responsive"></span>
                                                            <span class="text-label">Old Miner</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f14" class="custom-control-input" value="Baguette">
                                                        <label for="f14" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_baguette_l.svg" alt="Baguette" class="img-responsive"></span>
                                                            <span class="text-label">Baguette</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f15" class="custom-control-input" value="Briolette">
                                                        <label for="f15" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_briolette_l.svg" alt="Briolette" class="img-responsive"></span>
                                                            <span class="text-label">Briolette</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f16" class="custom-control-input" value="Bullets">
                                                        <label for="f16" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_bullet_l.svg" alt="Bullets" class="img-responsive"></span>
                                                            <span class="text-label">Bullets</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f17" class="custom-control-input" value="Calf">
                                                        <label for="f17" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_calf_l.svg" alt="Calf" class="img-responsive"></span>
                                                            <span class="text-label">Calf</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f18" class="custom-control-input" value="Half Moon">
                                                        <label for="f18" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_half_moon.svg" alt="Half Moon" class="img-responsive"></span>
                                                            <span class="text-label">Half Moon</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f19" class="custom-control-input" value="Hexagonal">
                                                        <label for="f19" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_hexagonal.svg" alt="Hexagonal" class="img-responsive"></span>
                                                            <span class="text-label">Hexagonal</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f20" class="custom-control-input" value="Kite">
                                                        <label for="f20" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_kite.svg" alt="Kite" class="img-responsive"></span>
                                                            <span class="text-label">Kite</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f21" class="custom-control-input" value="Lozenge">
                                                        <label for="f21" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_lozenge.svg" alt="Lozenge" class="img-responsive"></span>
                                                            <span class="text-label">Lozenge</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f22" class="custom-control-input" value="Octagonal">
                                                        <label for="f22" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_octagonal.svg" alt="Octagonal" class="img-responsive"></span>
                                                            <span class="text-label">Octagonal</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f23" class="custom-control-input" value="Pentagonal">
                                                        <label for="f23" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_pentagonal.svg" alt="Pentagonal" class="img-responsive"></span>
                                                            <span class="text-label">Pentagonal</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f24" class="custom-control-input" value="Rose">
                                                        <label for="f24" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="assets/images/homepage/rap_rose.svg" alt="Rose" class="img-responsive"></span>
                                                            <span class="text-label">Rose</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f25" class="custom-control-input" value="Shield">
                                                        <label for="f25" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="./RapNet _ Diamond &amp; Jewelry Trading For Dealers &amp; Jewelers_files/rap_shield.svg" alt="Shield" class="img-responsive"></span>
                                                            <span class="text-label">Shield</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f26" class="custom-control-input" value="Square">
                                                        <label for="f26" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="./RapNet _ Diamond &amp; Jewelry Trading For Dealers &amp; Jewelers_files/rap_square.svg" alt="Square" class="img-responsive"></span>
                                                            <span class="text-label">Square</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f27" class="custom-control-input" value="Square Radiant">
                                                        <label for="f27" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="./RapNet _ Diamond &amp; Jewelry Trading For Dealers &amp; Jewelers_files/rap_sq_radiant.svg" alt="Square Radiant" class="img-responsive"></span>
                                                            <span class="text-label">Square Radiant</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f28" class="custom-control-input" value="Star">
                                                        <label for="f28" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="./RapNet _ Diamond &amp; Jewelry Trading For Dealers &amp; Jewelers_files/rap_star.svg" alt="Star" class="img-responsive"></span>
                                                            <span class="text-label">Star</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f29" class="custom-control-input" value="Tapered Baguette">
                                                        <label for="f29" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="./RapNet _ Diamond &amp; Jewelry Trading For Dealers &amp; Jewelers_files/rap_tapered_baguette.svg" alt="Tapered Baguette" class="img-responsive"></span>
                                                            <span class="text-label">Tapered Baguette</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f30" class="custom-control-input" value="Tapered Bullet">
                                                        <label for="f30" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="./RapNet _ Diamond &amp; Jewelry Trading For Dealers &amp; Jewelers_files/rap_tapered.svg" alt="Tapered Bullet" class="img-responsive"></span>
                                                            <span class="text-label">Tapered Bullet</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f31" class="custom-control-input" value="Trapezoid">
                                                        <label for="f31" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="./RapNet _ Diamond &amp; Jewelry Trading For Dealers &amp; Jewelers_files/rap_trapezoid.svg" alt="Trapezoid" class="img-responsive"></span>
                                                            <span class="text-label">Trapezoid</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f32" class="custom-control-input" value="Triangular">
                                                        <label for="f32" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="./RapNet _ Diamond &amp; Jewelry Trading For Dealers &amp; Jewelers_files/rap_triangular.svg" alt="Triangular" class="img-responsive"></span>
                                                            <span class="text-label">Triangular</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f33" class="custom-control-input" value="Trilliant">
                                                        <label for="f33" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="./RapNet _ Diamond &amp; Jewelry Trading For Dealers &amp; Jewelers_files/rap_trilliant.svg" alt="Trilliant" class="img-responsive"></span>
                                                            <span class="text-label">Trilliant</span>
                                                        </label>
                                                    </div>
                                                    <div class="filter custom-checkbox">
                                                        <input type="checkbox" id="f34" class="custom-control-input" value="Other">
                                                        <label for="f34" class="custom-control-label with-img">
                                                            <span class="text-label">Other</span>
                                                        </label>
                                                    </div>
                                            </div>
                                            <button type="button" class="btn show-more-filters">
                                                <span class="text">+ 30 More</span>
                                                <span class="text opened">- 30 Less</span>
                                                <span class="arrow-btn">
                                                    <img src="assets/images/homepage/down-arrow.svg" alt="" class="img-responsive">
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                <div class="form-group size-group">
                                    <div class="name-filter">Size  <span class="red">*</span></div>
                                    <div class="row-filter">
                                        <div class="form-inline">
                                            <label for="sizeFrom">From</label>
                                            <input type="number" class="form-control" id="sizeFrom" placeholder="Any">
                                        </div>

                                        <div class="form-inline">
                                            <label for="sizeTo">To</label>
                                            <input type="number" class="form-control" id="sizeTo" placeholder="Any">
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group color-group">
                                        <div class="name-filter">Color <span class="red">*</span></div>
                                        <div class="row-filter">
                                            <div class="filter-container">
                                                    <div class="filter custom-checkbox">
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
                                                    </div>
                                            </div>
                                            <button type="button" class="btn show-more-filters">
                                                <span class="text">+ 18 More</span>
                                                <span class="text opened">- 18 Less</span>
                                                <span class="arrow-btn">
                                                    <img src="assets/images/homepage/down-arrow.svg" alt="" class="img-responsive">
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group clarity-group">
                                        <div class="name-filter">Clarity </div>
                                            <div class="row-filter">
                                                <div class="filter-container">
                                                        <div class="filter custom-checkbox">
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                <div class="collapse" id="free-search">
                                    <div class="form-group multiply-group-filter">
                                        <div class="name-filter">Finish</div>
                                        <div class="row-filter">
                                            <div class="col-group cut-group">
                                                <label id="cut">Cut</label>
                                                <select aria-labelledby="cut" name="cutFrom" class="form-control">
                                                    <option value="0">From</option>
                                                        <option value="1">Poor</option>
                                                        <option value="2">Fair</option>
                                                        <option value="3">Good</option>
                                                        <option value="4">Very Good</option>
                                                        <option value="5">Excellent</option>
                                                        <option value="6">Ideal</option>
                                                </select>
                                                <span>-</span>
                                                <select aria-labelledby="cut" name="cutTo" class="form-control">
                                                    <option value="0">To</option>
                                                        <option value="1">Poor</option>
                                                        <option value="2">Fair</option>
                                                        <option value="3">Good</option>
                                                        <option value="4">Very Good</option>
                                                        <option value="5">Excellent</option>
                                                        <option value="6">Ideal</option>
                                                </select>
                                            </div>
                                            <div class="col-group polish-group">
                                                <label id="polish">Polish</label>
                                                <select aria-labelledby="polish" name="polishFrom" class="form-control">
                                                    <option value="0">From</option>
                                                        <option value="1">Poor</option>
                                                        <option value="2">Fair</option>
                                                        <option value="3">Good</option>
                                                        <option value="4">Very Good</option>
                                                        <option value="5">Excellent</option>
                                                        <option value="6">Ideal</option>
                                                </select>
                                                <span>-</span>
                                                <select aria-labelledby="polish" name="polishTo" class="form-control">
                                                    <option value="0">To</option>
                                                        <option value="1">Poor</option>
                                                        <option value="2">Fair</option>
                                                        <option value="3">Good</option>
                                                        <option value="4">Very Good</option>
                                                        <option value="5">Excellent</option>
                                                        <option value="6">Ideal</option>
                                                </select>
                                            </div>
                                            <div class="col-group symmetry-group">
                                                <label id="symmetry">Symmetry</label>
                                                <select aria-labelledby="symmetry" name="symmetryFrom" class="form-control">
                                                    <option value="0">From</option>
                                                        <option value="1">Poor</option>
                                                        <option value="2">Fair</option>
                                                        <option value="3">Good</option>
                                                        <option value="4">Very Good</option>
                                                        <option value="5">Excellent</option>
                                                        <option value="6">Ideal</option>
                                                </select>
                                                <span>-</span>
                                                <select aria-labelledby="symmetry" name="symmetryTo" class="form-control">
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
                                    <div class="form-group flu-group">
                                        <div class="name-filter">Fluorescence</div>
                                        <div class="row-filter">
                                            <div class="filter-container">
                                                    <div class="filter custom-checkbox">
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
                                                    </div>
                                            </div>
                                            <button type="button" class="btn show-more-filters">
                                                <span class="text">+ 2 More</span>
                                                <span class="text opened">- 2 Less</span>
                                                <span class="arrow-btn">
                                                    <img src="assets/images/homepage/down-arrow.svg" alt="" class="img-responsive">
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group lab-group">
                                        <div class="name-filter">Lab</div>
                                        <div class="row-filter">
                                            <div class="filter-container">
                                                    <div class="filter custom-checkbox">
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
                                                    </div>
                                            </div>
                                            <button type="button" class="btn show-more-filters">
                                                <span class="text">+ 11 More</span>
                                                <span class="text opened">- 11 Less</span>
                                                <span class="arrow-btn">
                                                    <img src="assets/images/homepage/down-arrow.svg" alt="" class="img-responsive">
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="show-more">
                                    <a class="show-more-link" data-toggle="collapse" href="https://www.rapnet.com/#free-search" role="button" aria-expanded="false" aria-controls="free-search">
                                        <span class="init">Show More </span>
                                        <span class="open">Show Less </span>
                                        <span class="arrow-btn">
                                            <img src="assets/images/homepage/down-arrow.svg" alt="" class="img-responsive">
                                        </span>
                                    </a>
                                </div>
                                <div class="form-btns text-center">
                                    <button type="submit" class="btn btn-primary send-btn" disabled="" data-category="free search" data-label="Diamond search" data-hs-event-50099495="1"><img src="./RapNet _ Diamond &amp; Jewelry Trading For Dealers &amp; Jewelers_files/ico-search.svg"> Search</button>
                                    <input type="reset" value="Reset" class="btn btn-link reset-btn">
                                </div>
                                <div class="loader">
                                    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Quick diamond Search End-->
        </div>

        <!-- Footer Start -->
        <?php include('footer.php'); ?>
        <!-- Footer End -->

        <!-- JS Start -->
        <?php include('js.php'); ?>
        <!-- JS End -->
    </div>
    
</body>

</html>




