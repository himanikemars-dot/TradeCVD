<?php
// require_once dirname(__DIR__, 1).'/config/config.php';
// $config = new config();

require_once dirname(__DIR__, 1) . '/config/init.php';
if ($LoginInfo->getIsguestuser() == 1) {
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

<body class="bg-white home-page">
    <div class="page-wrapper">
        <div class="has-sidebar-left">
            <header class="bg-white accent-3 relative nav-sticky tab-box-shadow ">
                <div class="container-fluid text-white">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-6 m-auto">
                            <h4 class="mb-0 sec-desc header-desc text-blue">
                                   Jwelery
                            </h4>
                        </div>
                        <div class="col-12 col-md-6 m-auto pt-3">
                            <ul class="nav responsive-tab nav-material nav-material-white pt-2" id="buy-Jwelery-tab">
                                <li>
                                    <a class="nav-link text-center  active" id="Jwelery-1-tab" data-toggle="pill" href="#Jwelery-1">Search</a>
                                </li>
                                <li>
                                    <a class="nav-link text-center" id="buyJwelery-tab" data-toggle="pill" href="#buyJwelery">Upload Jwelery</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <div class="main" id="web-content">
            <?php include('sidebar.php'); ?>
            <div class="has-sidebar-left">
                <div class="container-fluid relative animatedParent animateOnce">
                    <div class="tab-content bg-white" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="Jwelery-1" role="tabpanel" aria-labelledby="Jwelery-1-tab">
                            <div class="row setpagejw">
                                <div class="col-xl-2 col-lg-3 col-md-4 setfiljw">
                                    <div id="mySidenav" class="sidenav mySidenav">
                                        <div class="setnavfilter">
                                            <h4>Filte</h4>
                                        </div>
                                        <div class="searchje">
                                            <input type="text" class="search-bar" placeholder="Type Keyword">
                                            <a href="#" class="search-icon"> <i class="fa fa-search"></i></a>
                                        </div>
                                        <div class="allfilterse">
                                            <ul>
                                                <li  class="setshowje">
                                                    <div class="col-12 cut-group">
                                                        <div class="form-check">
                                                            <h5 class="d-inline">country</h5>
                                                                <select aria-labelledby="ssc" name="ssc" class="form-control">
                                                                    <option value="1">select country</option>
                                                                    <option value="2">India</option>
                                                                    <option value="3">Afghanistan</option>
                                                                    <option value="4">Albania</option>
                                                                    <option value="5">China</option>
                                                                    <option value="6">Japan</option>
                                                                    <option value="7">USA</option>
                                                                </select>       
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>See Only</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Available (32352)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                New (2215)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Not treated (21900)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Memo (6161)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Estate (188)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Grading Reports/ Appraisalse (604)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Set (659)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Treated (2080)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli setimgje">
                                                        <div class="form-check">
                                                            <h5>Jewelry type</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <div class="jetype">
                                                                                <img src="<?php echo $config->getImageurl(); ?>images/searchpage/ring.svg" alt="diamonds" title="diamonds">
                                                                            </div>
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Ring (32352)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <div class="jetype">
                                                                                <img src="<?php echo $config->getImageurl(); ?>images/searchpage/Earrings.svg" alt="diamonds" title="diamonds">
                                                                            </div>
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Earrings (2215)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <div class="jetype">
                                                                                <img src="<?php echo $config->getImageurl(); ?>images/searchpage/bracelets.svg" alt="diamonds" title="diamonds">
                                                                            </div>
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                bracelets (21900)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <div class="jetype">
                                                                                <img src="<?php echo $config->getImageurl(); ?>images/searchpage/pendants.svg" alt="diamonds" title="diamonds">
                                                                            </div>
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                pendants & Charms (6161)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <div class="jetype">
                                                                                <img src="<?php echo $config->getImageurl(); ?>images/searchpage/Necklaces.svg" alt="diamonds" title="diamonds">
                                                                            </div>
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Necklaces (188)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <div class="jetype">
                                                                                <img src="<?php echo $config->getImageurl(); ?>images/searchpage/watch.svg" alt="diamonds" title="diamonds">
                                                                            </div>
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Watches (604)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <div class="jetype">
                                                                                <img src="<?php echo $config->getImageurl(); ?>images/searchpage/other.svg" alt="diamonds" title="diamonds">
                                                                            </div>
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                other (659)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>Category</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                new (32352)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                other (2215)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                engagement (21900)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Desinger Jewelry (6161)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Woman's (188)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group setmorepanel">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                5 more
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>Condition</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                new (32352)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                slightly used (2215)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Refurbished (21900)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Repair required (6161)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>Price</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Under $500 (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                $500 - $1000 (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                $2000 - $3000 (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                $3000 - $5000 (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                $5000 - $10000 (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                $10000 - $50000 (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                specific
                                                                            </label>
                                                                            <div class="row fliterset setcutgrje">
                                                                                <div class="col-md-6 cut-group">
                                                                                    <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                                    <label class="inputset" type="number">$</label>
                                                                                </div>
                                                                                <div class="col-md-6 mt-auto cut-group">
                                                                                    <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="From">
                                                                                    <label class="inputset" type="number">$</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli setimgje">
                                                        <div class="form-check">
                                                            <h5>Metal type</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <div class="jetype">
                                                                               <span></span>
                                                                            </div>
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                White Gold (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <div class="jetype">
                                                                               <span style="background-color:#ecde1b"></span>
                                                                            </div>
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Yellow Gold (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <div class="jetype">
                                                                               <span style="background-color:#f3d2d2"></span>
                                                                            </div>
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Rose Gold (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <div class="jetype">
                                                                                <span style="background-color:#efc005"></span>
                                                                            </div>
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Gold (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <div class="jetype">
                                                                                <span style="background-color:#efefef"></span>
                                                                            </div>
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Platinum (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <div class="jetype">
                                                                               <span style="background-color:#d9d9d9"></span>
                                                                            </div>
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Steel (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group setmorepanel">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                5 more
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>Metal Kt</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                14k (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                               18k (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                               8-10k (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                22k (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                24k (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>Jewelry Quality</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Fine (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                               Luxury (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                               Investment (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Commercial (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Promotional (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>Gemstone Type</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Diamond (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Diamond - fancy Color (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Sapphire (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Ruby (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Emerald (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Moissanite (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group setmorepanel">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                5 more
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>Gemstone Shape</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Round (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Oval (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Emerald (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Princess (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Pear (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Cushion (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group setmorepanel">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                5 more
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setsizejw">
                                                        <h5 class="d-inline">Gemstone Size</h5>
                                                        <div class="row fliterset">
                                                            <div class="col-md-6 cut-group">
                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                <label class="inputset" type="number">ct</label>
                                                            </div>
                                                            <div class="col-md-6 mt-auto cut-group">
                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                <label class="inputset" type="number">ct</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>Gemstone Treatment</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                None (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Color enhanced (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                HPHT (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                clarity Enhanced (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Heat treated (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Irradiated (2511)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group setmorepanel">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                5 more
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>Document Type</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Grading report (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Other (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>Lab Report</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                AGL (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                AGS (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                CGL (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                EDGL (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                GCAL (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Geubilan (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group setmorepanel">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                5 more
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>Brand</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Other (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Tiffany (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Rolex (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Cartier (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Breitling (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Geubilan (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>Availability status</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                yes (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                no (2201)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>Availability Comment</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Out of stock (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>Shipping From</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                USA (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                India (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Uk (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Hong kong (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Switzerland (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Turkey (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group setmorepanel">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                5 more
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5>Shipping From</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Cash Advance (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Memo (3252)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="setresfilterbar">
                                    <button class="setfilter d-md-none d-xl-none d-lg-none">
                                        <img src="<?php echo $config->getImageurl(); ?>images/searchpage/fliter.svg" alt="diamonds" title="diamonds">
                                    </button>
                                </div>
                               <!-- right bar -->
                               <div class="col-xl-10 col-lg-9 col-md-8 rightbarjew">
                                   <div class="row">
                                        <div class="filter-box setfilterbox">
                                            <div class="form-group shape-group dash-shape setresjw">
                                                <!-- <div class="name-filter">Shape</div> -->
                                                <div class="row dash-row">
                                                    <div class="filter-container-set">
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j0" class="dashboard-control custom-control-input" value="Round">
                                                            <label for="j0" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_round.svg" alt="Round" class="img-responsive"></span>
                                                                <span class="text-label">Round</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j1" class="dashboard-control custom-control-input" value="Pear">
                                                            <label for="j1" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_pear.svg" alt="Pear" class="img-responsive"></span>
                                                                <span class="text-label">Pear</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j2" class="dashboard-control custom-control-input" value="Princess">
                                                            <label for="j2" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_princess.svg" alt="Princess" class="img-responsive"></span>
                                                                <span class="text-label">Princess</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j3" class="dashboard-control custom-control-input" value="Marquise">
                                                            <label for="j3" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_marquise.svg" alt="Marquise" class="img-responsive"></span>
                                                                <span class="text-label">Marquise</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j4" class="dashboard-control custom-control-input" value="Emerald">
                                                            <label for="j4" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_emerald_l.svg" alt="Emerald" class="img-responsive"></span>
                                                                <span class="text-label">Emerald</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j5" class="dashboard-control custom-control-input" value="Cushion Brilliant">
                                                            <label for="j5" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_cushion_brilliant_l.svg" alt="Cushion Brilliant" class="img-responsive"></span>
                                                                <span class="text-label">Cushion Brilliant</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j6" class="dashboard-control custom-control-input" value="Cushion Modified">
                                                            <label for="j6" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_cushion_mod_l.svg" alt="Cushion Modified" class="img-responsive"></span>
                                                                <span class="text-label">Cushion Modified</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j7" class="dashboard-control custom-control-input" value="Asscher">
                                                            <label for="j7" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_asscher_l.svg" alt="Asscher" class="img-responsive"></span>
                                                                <span class="text-label">Asscher</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j8" class="dashboard-control custom-control-input" value="Sq. Emerald">
                                                            <label for="j8" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_sq_emerald.svg" alt="Sq. Emerald" class="img-responsive"></span>
                                                                <span class="text-label">Sq. Emerald</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j9" class="dashboard-control custom-control-input" value="Oval">
                                                            <label for="j9" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_oval.svg" alt="Oval" class="img-responsive"></span>
                                                                <span class="text-label">Oval</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j10" class="dashboard-control custom-control-input" value="Radiant">
                                                            <label for="j10" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_radiant.svg" alt="Radiant" class="img-responsive"></span>
                                                                <span class="text-label">Radiant</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j11" class="dashboard-control custom-control-input" value="Heart">
                                                            <label for="j11" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_heart.svg" alt="Heart" class="img-responsive"></span>
                                                                <span class="text-label">Heart</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j12" class="dashboard-control custom-control-input" value="European Cut">
                                                            <label for="j12" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_euro_cut.svg" alt="European Cut" class="img-responsive"></span>
                                                                <span class="text-label">European Cut</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j13" class="dashboard-control custom-control-input" value="Old Miner">
                                                            <label for="j13" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_old_miner.svg" alt="Old Miner" class="img-responsive"></span>
                                                                <span class="text-label">Old Miner</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j14" class="dashboard-control custom-control-input" value="Baguette">
                                                            <label for="j14" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_baguette_l.svg" alt="Baguette" class="img-responsive"></span>
                                                                <span class="text-label">Baguette</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j15" class="dashboard-control custom-control-input" value="Briolette">
                                                            <label for="j15" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_briolette_l.svg" alt="Briolette" class="img-responsive"></span>
                                                                <span class="text-label">Briolette</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j16" class="dashboard-control custom-control-input" value="Bullets">
                                                            <label for="j16" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_bullet_l.svg" alt="Bullets" class="img-responsive"></span>
                                                                <span class="text-label">Bullets</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j17" class="dashboard-control custom-control-input" value="Calf">
                                                            <label for="j17" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_calf_l.svg" alt="Calf" class="img-responsive"></span>
                                                                <span class="text-label">Calf</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j18" class="dashboard-control custom-control-input" value="Half Moon">
                                                            <label for="j18" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_half_moon.svg" alt="Half Moon" class="img-responsive"></span>
                                                                <span class="text-label">Half Moon</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j19" class="dashboard-control custom-control-input" value="Hexagonal">
                                                            <label for="j19" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_hexagonal.svg" alt="Hexagonal" class="img-responsive"></span>
                                                                <span class="text-label">Hexagonal</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j20" class="dashboard-control custom-control-input" value="Kite">
                                                            <label for="j20" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_kite.svg" alt="Kite" class="img-responsive"></span>
                                                                <span class="text-label">Kite</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j21" class="dashboard-control custom-control-input" value="Lozenge">
                                                            <label for="j21" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_lozenge.svg" alt="Lozenge" class="img-responsive"></span>
                                                                <span class="text-label">Lozenge</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j22" class="dashboard-control custom-control-input" value="Octagonal">
                                                            <label for="j22" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_octagonal.svg" alt="Octagonal" class="img-responsive"></span>
                                                                <span class="text-label">Octagonal</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j23" class="dashboard-control custom-control-input" value="Pentagonal">
                                                            <label for="j23" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_pentagonal.svg" alt="Pentagonal" class="img-responsive"></span>
                                                                <span class="text-label">Pentagonal</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j24" class="dashboard-control custom-control-input" value="Rose">
                                                            <label for="j24" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>images/homepage/rap_rose.svg" alt="Rose" class="img-responsive"></span>
                                                                <span class="text-label">Rose</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j25" class="dashboard-control custom-control-input" value="Shield">
                                                            <label for="j25" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="#" alt="Shield" class="img-responsive"></span>
                                                                <span class="text-label">Shield</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j26" class="dashboard-control custom-control-input" value="Square">
                                                            <label for="j26" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="#" alt="Square" class="img-responsive"></span>
                                                                <span class="text-label">Square</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j27" class="dashboard-control custom-control-input" value="Square Radiant">
                                                            <label for="j27" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="#" alt="Square Radiant" class="img-responsive"></span>
                                                                <span class="text-label">Square Radiant</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j28" class="dashboard-control custom-control-input" value="Star">
                                                            <label for="j28" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="#" alt="Star" class="img-responsive"></span>
                                                                <span class="text-label">Star</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j29" class="dashboard-control custom-control-input" value="Tapered Baguette">
                                                            <label for="j29" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="#" alt="Tapered Baguette" class="img-responsive"></span>
                                                                <span class="text-label">Tapered Baguette</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j30" class="dashboard-control custom-control-input" value="Tapered Bullet">
                                                            <label for="j30" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="#" alt="Tapered Bullet" class="img-responsive"></span>
                                                                <span class="text-label">Tapered Bullet</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j31" class="dashboard-control custom-control-input" value="Trapezoid">
                                                            <label for="j31" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="#" alt="Trapezoid" class="img-responsive"></span>
                                                                <span class="text-label">Trapezoid</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j32" class="dashboard-control custom-control-input" value="Triangular">
                                                            <label for="j32" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="#" alt="Triangular" class="img-responsive"></span>
                                                                <span class="text-label">Triangular</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j33" class="dashboard-control custom-control-input" value="Trilliant">
                                                            <label for="j33" class="custom-control-label with-img">
                                                                <span class="img-wrap"><img src="#" alt="Trilliant" class="img-responsive"></span>
                                                                <span class="text-label">Trilliant</span>
                                                            </label>
                                                        </div>
                                                        <div class="filter custom-checkbox">
                                                            <input type="checkbox" id="j34" class="dashboard-control custom-control-input" value="Other">
                                                            <label for="j34" class="custom-control-label with-img">
                                                                <span class="text-label">Other</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                   <div class="productJwelery">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row jewset">
                                                    <div class="col-md-9 col-lg-7 col-xs-12 col-sm-8 moredetail">
                                                        <ul>
                                                            <li><b> 300000 Items  </b></li>
                                                            <li class="checjew">
                                                                <div class="col-12">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="" id="canadamark">
                                                                        <label class="form-check-label ml-4" for="canadamark"> Select All
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="col-12 ">
                                                                    <div class="form-check">
                                                                        <span class="fa fa-star"></span>
                                                                        <!-- <input class="form-check-input" type="checkbox" value="" id="canadamark"> -->
                                                                        <label class="form-check-label" for="canadamark"> Show my favorite
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3 col-lg-5 col-xs-12 col-sm-4 btsesearch  ">
                                                        <div class="text-right searchhead">
                                                            <div class="searchgreade searchcom">
                                                                <button type="button" class="btn searchbtnset"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/3.svg" alt="diamonds" title="diamonds"></button>
                                                            </div>
                                                            <div class="searchgreade searchcom">
                                                                <button type="button" class="btn searchbtnset jwesetbtn"><i class="fa fa-angle-down" aria-hidden="true"></i> More</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                   <div class="grid-products grid--view-items prd-grid productsetje">
                                        <div class="all-product-item">
                                            <div class="item">
                                                <div class="product-image">
                                                    <div class="starje">
                                                        <a href="javascript:void(0);" data-jewellerytitle="TEST1" data-jewelleryid="F6B549CA-F604-40E9-88DF-06A4A441D70E" data-ismyfavoriteitem="0" class="pull-left addtomyfavorite myfavoriteitemF6B549CA-F604-40E9-88DF-06A4A441D70E"><i class="far fa-heart setheart"></i></a>                                                        
                                                    </div>
                                                    <a href="#" class="product-img" data-toggle="modal" data-target="#jwelerymod">
                                                        <!-- image -->
                                                            <img class="primary blur-up lazyloaded" src="<?php echo $config->getImageurl(); ?>images/searchpage/4.jpg" alt="image" title="">
                                                        <!-- End image -->
                                                    </a>    
                                                </div>
                                                <div class="product-details">
                                                <!--Product Name-->
                                                    <div class="row prodesje">
                                                        <div class="text-left">
                                                            <div class="serjew">
                                                                su-266568
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-name text-uppercase">
                                                        <a href="#">Diamond ring 14 kt Yellow Gold jewellery - whirl Diamond Ring </a>
                                                    </div>
                                                    <!--End Product Name-->
                                                    <!--Product Price-->
                                                    <div class="product-price">
                                                        <span class="price">₹500</span>
                                                        <div class="text-right prosetm">
                                                            <button class="ringbtnset">
                                                                ring
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!--End Product Price-->
                                                   <div class="nameofholder">
                                                        <h4>Varun Diamond & jwellers</h4>
                                                        <span>London, United Kingdom</span>
                                                   </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="product-image">
                                                    <div class="starje">
                                                        <a href="javascript:void(0);" data-jewellerytitle="TEST1" data-jewelleryid="F6B549CA-F604-40E9-88DF-06A4A441D70E" data-ismyfavoriteitem="0" class="pull-left addtomyfavorite myfavoriteitemF6B549CA-F604-40E9-88DF-06A4A441D70E"><i class="far fa-heart setheart"></i></a>                                                        
                                                    </div>
                                                    <a href="#" class="product-img" data-toggle="modal" data-target="#jwelerymod">
                                                        <!-- image -->
                                                            <img class="primary blur-up lazyloaded" src="<?php echo $config->getImageurl(); ?>images/searchpage/4.jpg" alt="image" title="">
                                                        <!-- End image -->
                                                    </a>    
                                                </div>
                                                <div class="product-details">
                                                <!--Product Name-->
                                                    <div class="row prodesje">
                                                        <div class="text-left">
                                                            <div class="serjew">
                                                                su-266568
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-name text-uppercase">
                                                        <a href="#">Diamond ring 14 kt Yellow Gold jewellery - whirl Diamond Ring </a>
                                                    </div>
                                                    <!--End Product Name-->
                                                    <!--Product Price-->
                                                    <div class="product-price">
                                                        <span class="price">₹500</span>
                                                        <div class="text-right prosetm">
                                                            <button class="ringbtnset">
                                                                ring
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!--End Product Price-->
                                                   <div class="nameofholder">
                                                        <h4>Varun Diamond & jwellers</h4>
                                                        <span>London, United Kingdom</span>
                                                   </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="product-image">
                                                    <div class="starje">
                                                        <a href="javascript:void(0);" data-jewellerytitle="TEST1" data-jewelleryid="F6B549CA-F604-40E9-88DF-06A4A441D70E" data-ismyfavoriteitem="0" class="pull-left addtomyfavorite myfavoriteitemF6B549CA-F604-40E9-88DF-06A4A441D70E"><i class="far fa-heart setheart"></i></a>                                                        
                                                    </div>
                                                    <a href="#" class="product-img" data-toggle="modal" data-target="#jwelerymod">
                                                        <!-- image -->
                                                            <img class="primary blur-up lazyloaded" src="<?php echo $config->getImageurl(); ?>images/searchpage/4.jpg" alt="image" title="">
                                                        <!-- End image -->
                                                    </a>    
                                                </div>
                                                <div class="product-details">
                                                <!--Product Name-->
                                                    <div class="row prodesje">
                                                        <div class="text-left">
                                                            <div class="serjew">
                                                                su-266568
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-name text-uppercase">
                                                        <a href="#">Diamond ring 14 kt Yellow Gold jewellery - whirl Diamond Ring </a>
                                                    </div>
                                                    <!--End Product Name-->
                                                    <!--Product Price-->
                                                    <div class="product-price">
                                                        <span class="price">₹500</span>
                                                        <div class="text-right prosetm">
                                                            <button class="ringbtnset">
                                                                ring
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!--End Product Price-->
                                                   <div class="nameofholder">
                                                        <h4>Varun Diamond & jwellers</h4>
                                                        <span>London, United Kingdom</span>
                                                   </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="product-image">
                                                    <div class="chebojew">
                                                        <input type="checkbox">
                                                    </div>
                                                    <a href="#" class="product-img">
                                                        <!-- image -->
                                                            <img class="primary blur-up lazyloaded" src="<?php echo $config->getImageurl(); ?>images/searchpage/7.jpg" alt="image" title="">
                                                        <!-- End image -->
                                                    </a>
                                                    <div class="starje">
                                                        <span class="fa fa-star">
                                                            Add To favorite
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="product-details">
                                                <!--Product Name-->
                                                    <div class="row prodesje">
                                                        <div class="text-left">
                                                            <div class="serjew">
                                                                su-266568
                                                            </div>
                                                        </div>
                                                        <div class="text-right prosetm">
                                                            <button class="ringbtnset">
                                                                ring
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="product-name text-uppercase">
                                                        <a href="#">Diamond ring 14 kt Yellow Gold jewellery - whirl Diamond Ring </a>
                                                    </div>
                                                    <!--End Product Name-->
                                                    <!--Product Price-->
                                                    <div class="product-price">
                                                        <span class="price">₹500</span>
                                                    </div>
                                                    <!--End Product Price-->
                                                   <div class="nameofholder">
                                                        <h4>Varun Diamond & jwellers</h4>
                                                        <span>London, United Kingdom</span>
                                                   </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="product-image">
                                                    <div class="chebojew">
                                                        <input type="checkbox">
                                                    </div>
                                                    <a href="#" class="product-img">
                                                        <!-- image -->
                                                            <img class="primary blur-up lazyloaded" src="<?php echo $config->getImageurl(); ?>images/searchpage/6.jpg" alt="image" title="">
                                                        <!-- End image -->
                                                    </a>
                                                    <div class="starje">
                                                        <span class="fa fa-star">
                                                            Add To favorite
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="product-details">
                                                <!--Product Name-->
                                                    <div class="row prodesje">
                                                        <div class="text-left">
                                                            <div class="serjew">
                                                                su-266568
                                                            </div>
                                                        </div>
                                                        <div class="text-right prosetm">
                                                            <button class="ringbtnset">
                                                                ring
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="product-name text-uppercase">
                                                        <a href="#">Diamond ring 14 kt Yellow Gold jewellery - whirl Diamond Ring </a>
                                                    </div>
                                                    <!--End Product Name-->
                                                    <!--Product Price-->
                                                    <div class="product-price">
                                                        <span class="price">₹500</span>
                                                    </div>
                                                    <!--End Product Price-->
                                                   <div class="nameofholder">
                                                        <h4>Varun Diamond & jwellers</h4>
                                                        <span>London, United Kingdom</span>
                                                   </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="product-image">
                                                    <div class="chebojew">
                                                        <input type="checkbox">
                                                    </div>
                                                    <a href="#" class="product-img">
                                                        <!-- image -->
                                                            <img class="primary blur-up lazyloaded" src="<?php echo $config->getImageurl(); ?>images/searchpage/9.jpg" alt="image" title="">
                                                        <!-- End image -->
                                                    </a>
                                                    <div class="starje">
                                                        <span class="fa fa-star">
                                                            Add To favorite
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="product-details">
                                                <!--Product Name-->
                                                    <div class="row prodesje">
                                                        <div class="text-left">
                                                            <div class="serjew">
                                                                su-266568
                                                            </div>
                                                        </div>
                                                        <div class="text-right prosetm">
                                                            <button class="ringbtnset">
                                                                ring
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="product-name text-uppercase">
                                                        <a href="#">Diamond ring 14 kt Yellow Gold jewellery - whirl Diamond Ring </a>
                                                    </div>
                                                    <!--End Product Name-->
                                                    <!--Product Price-->
                                                    <div class="product-price">
                                                        <span class="price">₹500</span>
                                                    </div>
                                                    <!--End Product Price-->
                                                   <div class="nameofholder">
                                                        <h4>Varun Diamond & jwellers</h4>
                                                        <span>London, United Kingdom</span>
                                                   </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="product-image">
                                                    <div class="chebojew">
                                                        <input type="checkbox">
                                                    </div>
                                                    <a href="#" class="product-img">
                                                        <!-- image -->
                                                            <img class="primary blur-up lazyloaded" src="<?php echo $config->getImageurl(); ?>images/searchpage/10.jpg" alt="image" title="">
                                                        <!-- End image -->
                                                    </a>
                                                    <div class="starje">
                                                        <span class="fa fa-star">
                                                            Add To favorite
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="product-details">
                                                <!--Product Name-->
                                                    <div class="row prodesje">
                                                        <div class="text-left">
                                                            <div class="serjew">
                                                                su-266568
                                                            </div>
                                                        </div>
                                                        <div class="text-right prosetm">
                                                            <button class="ringbtnset">
                                                                ring
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="product-name text-uppercase">
                                                        <a href="#">Diamond ring 14 kt Yellow Gold jewellery - whirl Diamond Ring </a>
                                                    </div>
                                                    <!--End Product Name-->
                                                    <!--Product Price-->
                                                    <div class="product-price">
                                                        <span class="price">₹500</span>
                                                    </div>
                                                    <!--End Product Price-->
                                                   <div class="nameofholder">
                                                        <h4>Varun Diamond & jwellers</h4>
                                                        <span>London, United Kingdom</span>
                                                   </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="product-image">
                                                    <div class="chebojew">
                                                        <input type="checkbox">
                                                    </div>
                                                    <a href="#" class="product-img">
                                                        <!-- image -->
                                                            <img class="primary blur-up lazyloaded" src="<?php echo $config->getImageurl(); ?>images/searchpage/4.jpg" alt="image" title="">
                                                        <!-- End image -->
                                                    </a>
                                                    <div class="starje">
                                                        <span class="fa fa-star">
                                                            Add To favorite
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="product-details">
                                                <!--Product Name-->
                                                    <div class="row prodesje">
                                                        <div class="text-left">
                                                            <div class="serjew">
                                                                su-266568
                                                            </div>
                                                        </div>
                                                        <div class="text-right prosetm">
                                                            <button class="ringbtnset">
                                                                ring
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="product-name text-uppercase">
                                                        <a href="#">Diamond ring 14 kt Yellow Gold jewellery - whirl Diamond Ring </a>
                                                    </div>
                                                    <!--End Product Name-->
                                                    <!--Product Price-->
                                                    <div class="product-price">
                                                        <span class="price">₹500</span>
                                                    </div>
                                                    <!--End Product Price-->
                                                   <div class="nameofholder">
                                                        <h4>Varun Diamond & jwellers</h4>
                                                        <span>London, United Kingdom</span>
                                                   </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="product-image">
                                                    <div class="chebojew">
                                                        <input type="checkbox">
                                                    </div>
                                                    <a href="#" class="product-img">
                                                        <!-- image -->
                                                            <img class="primary blur-up lazyloaded" src="<?php echo $config->getImageurl(); ?>images/searchpage/7.jpg" alt="image" title="">
                                                        <!-- End image -->
                                                    </a>
                                                    <div class="starje">
                                                        <span class="fa fa-star">
                                                            Add To favorite
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="product-details">
                                                <!--Product Name-->
                                                    <div class="row prodesje">
                                                        <div class="text-left">
                                                            <div class="serjew">
                                                                su-266568
                                                            </div>
                                                        </div>
                                                        <div class="text-right prosetm">
                                                            <button class="ringbtnset">
                                                                ring
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="product-name text-uppercase">
                                                        <a href="#">Diamond ring 14 kt Yellow Gold jewellery - whirl Diamond Ring </a>
                                                    </div>
                                                    <!--End Product Name-->
                                                    <!--Product Price-->
                                                    <div class="product-price">
                                                        <span class="price">₹500</span>
                                                    </div>
                                                    <!--End Product Price-->
                                                   <div class="nameofholder">
                                                        <h4>Varun Diamond & jwellers</h4>
                                                        <span>London, United Kingdom</span>
                                                   </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="product-image">
                                                    <div class="chebojew">
                                                        <input type="checkbox">
                                                    </div>
                                                    <a href="#" class="product-img">
                                                        <!-- image -->
                                                            <img class="primary blur-up lazyloaded" src="<?php echo $config->getImageurl(); ?>images/searchpage/9.jpg" alt="image" title="">
                                                        <!-- End image -->
                                                    </a>
                                                    <div class="starje">
                                                        <span class="fa fa-star">
                                                            Add To favorite
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="product-details">
                                                <!--Product Name-->
                                                    <div class="row prodesje">
                                                        <div class="text-left">
                                                            <div class="serjew">
                                                                su-266568
                                                            </div>
                                                        </div>
                                                        <div class="text-right prosetm">
                                                            <button class="ringbtnset">
                                                                ring
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="product-name text-uppercase">
                                                        <a href="#">Diamond ring 14 kt Yellow Gold jewellery - whirl Diamond Ring </a>
                                                    </div>
                                                    <!--End Product Name-->
                                                    <!--Product Price-->
                                                    <div class="product-price">
                                                        <span class="price">₹500</span>
                                                    </div>
                                                    <!--End Product Price-->
                                                   <div class="nameofholder">
                                                        <h4>Varun Diamond & jwellers</h4>
                                                        <span>London, United Kingdom</span>
                                                   </div>
                                                </div>
                                            </div>
                                       </div> 
                                   </div>
                                   <!-- right bar end -->
                               </div>
                        </div>
                        
                    </div>
                    <div class="tab-pane fade" id="buyJwelery" role="tabpanel" aria-labelledby="buyJwelery-tab">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="jew1-tab" data-toggle="tab" href="#jew1" role="tab" aria-controls="jew1" aria-selected="true">Single</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ml-2" id="mulje-tab" data-toggle="tab" href="#mulje" role="tab" aria-controls="mulje" aria-selected="false">Multiple</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="jew1" role="tabpanel" aria-labelledby="jew1-tab">
                                <div class="setalljw">
                                    <div class="breadcrumbset">
                                        <h5>Upload Single item :</h5>
                                        <div class="container">
                                            <ul class="uploaddiamondtabs  nav" role="tablist">
                                                <li class="tab-link ligeneralinfoDiv active" data-tab="1"><a class="nav-item active" data-typename="generalinfoDiv" id="nav-generalinfo-tab" data-toggle="tab" href="#generalinfoDiv" role="tab" aria-controls="generalinfoDiv" aria-selected="true"><b>1</b>General Information</a></li>
                                                <li class="tab-link lireportinfoDiv disabled" disabled="" data-tab="2"><a class="nav-item disabled" disabled="" data-typename="reportinfoDiv" id="nav-reportinfo-tab" data-toggle="tab" href="#reportinfoDiv" role="tab" aria-controls="reportinfoDiv" aria-selected="false"><b>2</b>upload single</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row setupjw">
                                        <div class="col-12 col-lg-6 col-md-12 uploadset upjweset setpaddtop">
                                            <h4>Product Description</h4>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="sharewithemail" class="col-form-label">Stock</label>
                                                                <input type="text" class="form-control" autocomplete="off" placeholder="Enter" id="sharewithtext" name="sharewithtext">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-xl-8 col-lg-7 col-md-8 col-sm-9 ctupsearch">
                                                                    <div class="form-group">
                                                                        <label for="sharewithemail" class="col-form-label">Asking Price</label>
                                                                        <input type="text" class="form-control" autocomplete="off" placeholder="Enter" id="pricrtext" name="pricrtext">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 col-xl-4 col-md-4 col-sm-3 checkrdioupload setfjwct">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="laserdrilled1">
                                                                        <label class="form-check-label" for="laserdrilled">
                                                                            CT
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="  form-check-input" type="checkbox" name="flexRadioDefault" id="laserdrilled1">
                                                                        <label class="form-check-label" for="laserdrilled">
                                                                            Savani %
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>        
                                                        </div>
                                                    </div>
                                                    <div class="writeboxjw">
                                                        <label for="sharewithemail" class="col-form-label">Description</label>
                                                        <div class="writset">
                                                            <textarea class="form-control" rows="7" placeholder=" Enter" id="comment"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 col-md-12 uploadset upjweset setpaddtop">
                                            <h4>Product Information</h4>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="manisecupload">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-lg-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <label for="sharewithemail" class="col-form-label">Jewelry Type</label>
                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                </div>        
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-lg-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <label for="sharewithemail" class="col-form-label">Type style</label>
                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <div class="row setptopjw">
                                                            <div class="col-lg-4 col-md-4">
                                                                <div class="row">
                                                                    <div class="col-lg-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <label for="sharewithemail" class="col-form-label">Jewelry Category</label>
                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                </div>        
                                                            </div>
                                                            <div class="col-lg-4 col-md-4">
                                                                <div class="row">
                                                                    <div class="col-lg-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <label for="sharewithemail" class="col-form-label">Condition</label>
                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                </div>        
                                                            </div>
                                                            <div class="col-lg-4 col-md-4">
                                                                <div class="row">
                                                                    <div class="col-lg-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <label for="sharewithemail" class="col-form-label">Brand</label>
                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                </div>        
                                                            </div>
                                                        </div>
                                                        <div class="row setptopjw">
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-lg-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <label for="sharewithemail" class="col-form-label">Jewelry Quality</label>
                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                </div>        
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-lg-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <label for="sharewithemail" class="col-form-label">Designer Maker</label>
                                                                            <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                        </div>
                                                                    </div>
                                                                </div>        
                                                            </div>
                                                        </div>
                                                        <div class="row setptopjw">
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-lg-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <label for="sharewithemail" class="col-form-label">Jewelry Quality</label>
                                                                            <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
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
                                    <div class="row setupjw">
                                        <div class="col-12 col-lg-6 col-md-12 uploadset upjweset">
                                            <h4>Price & Location</h4>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="manisecupload">
                                                        <div class="setcolorjw">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 ctupsearch">
                                                                            <div class="form-group">
                                                                                <label for="sharewithemail" class="col-form-label">Shipping From</label>
                                                                                <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                    </div>        
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 ctupsearch">
                                                                            <div class="form-group">
                                                                                <label for="sharewithemail" class="col-form-label">Price/Piece</label>
                                                                                <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="$ Enter">
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 ctupsearch">
                                                                            <div class="form-group">
                                                                                <label for="sharewithemail" class="col-form-label">Currency</label>
                                                                                <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                            <div class="row setptopjw">
                                                                <div class="col-lg-4 col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 ctupsearch">
                                                                            <div class="form-group">
                                                                                <label for="sharewithemail" class="col-form-label">Tems</label>
                                                                                <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                    </div>        
                                                                </div>
                                                                <div class="col-lg-4 col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 ctupsearch">
                                                                            <div class="form-group">
                                                                                <label for="sharewithemail" class="col-form-label">Msrp</label>
                                                                                <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="$ Enter">
                                                                            </div>
                                                                        </div>
                                                                    </div>        
                                                                </div>
                                                                <div class="col-lg-4 col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 ctupsearch">
                                                                            <div class="form-group">
                                                                                <label for="sharewithemail" class="col-form-label">Delivery Time</label>
                                                                                <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                                <h6 class="setdayjw">Days</h6>
                                                                            </div>
                                                                        </div>
                                                                    </div>        
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row setptopjw setad">
                                                            <div class="addsetjw">
                                                                <details>
                                                                <summary>+ Add</summary>
                                                                    <div class="setcolorjw">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 ctupsearch">
                                                                                        <div class="form-group">
                                                                                            <label for="sharewithemail" class="col-form-label">Shipping From</label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                                </div>        
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 ctupsearch">
                                                                                        <div class="form-group">
                                                                                            <label for="sharewithemail" class="col-form-label">Price/Piece</label>
                                                                                            <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="$ Enter">
                                                                                        </div>
                                                                                    </div>
                                                                                </div> 
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 ctupsearch">
                                                                                        <div class="form-group">
                                                                                            <label for="sharewithemail" class="col-form-label">Currency</label>
                                                                                            <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                                        </div>
                                                                                    </div>
                                                                                </div> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="row setptopjw">
                                                                            <div class="col-lg-4">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 ctupsearch">
                                                                                        <div class="form-group">
                                                                                            <label for="sharewithemail" class="col-form-label">Tems</label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                                </div>        
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 ctupsearch">
                                                                                        <div class="form-group">
                                                                                            <label for="sharewithemail" class="col-form-label">Msrp</label>
                                                                                            <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="$ Enter">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>        
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 ctupsearch">
                                                                                        <div class="form-group">
                                                                                            <label for="sharewithemail" class="col-form-label">Delivery Time</label>
                                                                                            <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                                            <h6 class="setdayjw">Days</h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>        
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </details>
                                                            </div>
                                                        </div>
                                                        <div class="row setptopjw">
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-lg-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <label for="sharewithemail" class="col-form-label">Item In Stock</label>
                                                                            <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                        </div>
                                                                    </div>
                                                                </div>        
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-lg-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <label for="sharewithemail" class="col-form-label">Minimum Order</label>
                                                                            <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                        </div>
                                                                    </div>
                                                                </div>        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 col-md-12 uploadset upjweset setpaddtop">
                                            <h4>Metal & Gemstone</h4>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="manisecupload">
                                                        <div class="row setptopjw setbtmmarjw">
                                                            <div class="col-lg-4 col-md-4">
                                                                <div class="row">
                                                                    <div class="col-lg-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <label for="sharewithemail" class="col-form-label">Metal Type</label>
                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                </div>        
                                                            </div>
                                                            <div class="col-lg-4 col-md-4">
                                                                <div class="row">
                                                                    <div class="col-lg-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <label for="sharewithemail" class="col-form-label">Metal Karat</label>
                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                </div>        
                                                            </div>
                                                            <div class="col-lg-4 col-md-4">
                                                                <div class="row">
                                                                    <div class="col-lg-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <label for="sharewithemail" class="col-form-label">Jewelry Total Weight</label>
                                                                            <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                            <h6 class="setdayjw setdayres">gr</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>        
                                                            </div>
                                                        </div>
                                                        <div class="setcolorjwset">
                                                            <div class="row setptopjw">
                                                                <div class="col-lg-4 col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 ctupsearch">
                                                                            <div class="form-group">
                                                                                <label for="sharewithemail" class="col-form-label">Gemstone Type</label>
                                                                                <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                    </div>        
                                                                </div>
                                                                <div class="col-lg-4 col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 ctupsearch">
                                                                            <div class="form-group">
                                                                                <label for="sharewithemail" class="col-form-label">Shape</label>
                                                                                <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                    </div>        
                                                                </div>
                                                                <div class="col-lg-4 col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 ctupsearch">
                                                                            <div class="form-group">
                                                                                <label for="sharewithemail" class="col-form-label">Carat Weight</label>
                                                                                <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                            </div>
                                                                        </div>
                                                                    </div>        
                                                                </div>
                                                            </div>
                                                            <div class="row setptopjw">
                                                                <div class="col-lg-9 col-md-9">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-4">
                                                                            <div class="row">
                                                                                <div class="col-lg-12 ctupsearch">
                                                                                    <div class="form-group">
                                                                                        <label for="sharewithemail" class="col-form-label">Lab</label>
                                                                                        <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                            </div>        
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4">
                                                                            <div class="row">
                                                                                <div class="col-lg-12 ctupsearch">
                                                                                    <div class="form-group">
                                                                                        <label for="sharewithemail" class="col-form-label">Lab#</label>
                                                                                        <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                                    </div>
                                                                                </div>
                                                                            </div>        
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4">
                                                                            <div class="row">
                                                                                <div class="col-lg-12 ctupsearch">
                                                                                    <div class="form-group">
                                                                                        <label for="sharewithemail" class="col-form-label">Tretment</label>
                                                                                        <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                            </div>        
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-3">
                                                                    <div class="setynjw ">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault158">
                                                                            <label class="form-check-label" for="flexRadioDefault158">
                                                                                yes
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault158" checked="">
                                                                            <label class="form-check-label" for="flexRadioDefault158">
                                                                                No
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row setptopjw">
                                                                <div class="col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-4 ctupsearch">
                                                                            <div class="form-group">
                                                                                <label for="sharewithemail" class="col-form-label"># Stone</label>
                                                                                <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 col-md-4 ctupsearch">
                                                                            <div class="form-group">
                                                                                <label for="sharewithemail" class="col-form-label">Savani Lot#</label>
                                                                                <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                            </div>
                                                                        </div>
                                                                    </div>        
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row setptopjw setad">
                                                            <div class="addsetjw">
                                                                <details>
                                                                    <summary>+ Add</summary>
                                                                    <div class="setcolorjwset">
                                                                        <div class="row setptopjw">
                                                                            <div class="col-lg-4">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 ctupsearch">
                                                                                        <div class="form-group">
                                                                                            <label for="sharewithemail" class="col-form-label">Gemstone Type</label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                                </div>        
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 ctupsearch">
                                                                                        <div class="form-group">
                                                                                            <label for="sharewithemail" class="col-form-label">Shape</label>
                                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                                </div>        
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 ctupsearch">
                                                                                        <div class="form-group">
                                                                                            <label for="sharewithemail" class="col-form-label">Carat Weight</label>
                                                                                            <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>        
                                                                            </div>
                                                                        </div>
                                                                        <div class="row setptopjw">
                                                                            <div class="col-lg-9">
                                                                                <div class="row">
                                                                                    <div class="col-lg-4">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12 ctupsearch">
                                                                                                <div class="form-group">
                                                                                                    <label for="sharewithemail" class="col-form-label">Lab</label>
                                                                                                    <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                                        </div>        
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12 ctupsearch">
                                                                                                <div class="form-group">
                                                                                                    <label for="sharewithemail" class="col-form-label">Lab#</label>
                                                                                                    <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>        
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12 ctupsearch">
                                                                                                <div class="form-group">
                                                                                                    <label for="sharewithemail" class="col-form-label">Tretment</label>
                                                                                                    <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                                        </div>        
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="setynjw ">
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault158">
                                                                                        <label class="form-check-label" for="flexRadioDefault158">
                                                                                            yes
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault158" checked="">
                                                                                        <label class="form-check-label" for="flexRadioDefault158">
                                                                                            No
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row setptopjw">
                                                                            <div class="col-lg-12">
                                                                                <div class="row">
                                                                                    <div class="col-lg-3 ctupsearch">
                                                                                        <div class="form-group">
                                                                                            <label for="sharewithemail" class="col-form-label"># Stone</label>
                                                                                            <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3 ctupsearch">
                                                                                        <div class="form-group">
                                                                                            <label for="sharewithemail" class="col-form-label">Savani Lot#</label>
                                                                                            <input type="text" id="from_usd" class="fromusd setjwinp" name="fusd" placeholder="Enter">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>        
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </details>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row setupjw">
                                        <div class="col-12 col-lg-4 uploadset upjweset">
                                            <h4>Suppliers Comment</h4>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="writeboxjw writesetne setpejw">
                                                        <label for="sharewithemail" class="col-form-label">Comment</label>
                                                        <div class="writset">
                                                            <textarea class="form-control" rows="1" placeholder=" Enter" id="comment" style="height: 49;"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4 uploadset upjweset setparsjw setpaddtop">
                                            <h4>Metal & Gemstone</h4>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="manisecupload">
                                                        <div class="row setptopjw setbtmmarjw setpjw">
                                                            <div class="col-xl-9 col-lg-7 col-md-7">
                                                                <div class="row">
                                                                    <div class="col-lg-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <label for="sharewithemail" class="col-form-label">Metal Type</label>
                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                </div>        
                                                            </div>
                                                            <div class="col-xl-3 col-lg-5 col-md-5">
                                                                <div class="row">
                                                                    <div class="col-lg-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <label for="sharewithemail" class="col-form-label">Metal Karat</label>
                                                                            <select aria-labelledby="ssc" name="ssc" class="form-control">
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
                                                                </div>        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4 uploadset upjweset setresjw setpaddtop">
                                            <h4>Metal & Gemstone</h4>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="manisecupload">
                                                        <div class="row setptopjw">
                                                            <div class="col-12 col-lg-4 col-md-4 mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="dtcontain">
                                                                    <label class="form-check-label ml-4" for="dtcontain">
                                                                        Contain
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-4 col-md-4 mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="dtcontain">
                                                                    <label class="form-check-label ml-4" for="dtcontain">
                                                                        Contain
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-4 col-md-4 mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="dtcontain">
                                                                    <label class="form-check-label ml-4" for="dtcontain">
                                                                        Contain
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br><br><br><br><br>
                                    <div class="row text-center nextuplo">
                                        <button type="submit" class="btn upnext setalljwne ">Next</button>
                                        <button type="reset" class="btn npback ">cancel</button>
                                    </div>
                                </div>
                                <div class="setalljw2">
                                    <div class="breadcrumbset">
                                        <h5>Upload Single item :</h5>
                                        <div class="container">
                                            <ul class="uploaddiamondtabs  nav" role="tablist">
                                                <li class="tab-link ligeneralinfoDiv active" data-tab="1"><a class="nav-item active" data-typename="generalinfoDiv" id="nav-generalinfo-tab" data-toggle="tab" href="#generalinfoDiv" role="tab" aria-controls="generalinfoDiv" aria-selected="true"><b>1</b>General Information</a></li>
                                                <li class="tab-link lireportinfoDiv disabled" disabled="" data-tab="2"><a class="nav-item disabled" disabled="" data-typename="reportinfoDiv" id="nav-reportinfo-tab" data-toggle="tab" href="#reportinfoDiv" role="tab" aria-controls="reportinfoDiv" aria-selected="false"><b>2</b>upload single</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-12 uploadset repose pset">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="stockuplod">
                                                    <h4>Diamond Image</h4>
                                                    <hr>    
                                                </div>
                                                <div class="manisecupload">
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 setpadbto">
                                                            <div class="row">
                                                                <div class="col-12 ctupsearch uploadmaset">
                                                                    <div class="form-group">
                                                                        <button type="text" id="upload" class="uploadbtnset" onclick="importData()" name="upload">Browse</button>
                                                                        <h5 class="orsetsearch">Or</h5>
                                                                    </div>
                                                                </div>
                                                            </div>        
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row"> 
                                                                <div class="col-12 ctupsearch uploadmaset">
                                                                    <div class="form-group">
                                                                        <button type="text" id="upload" class="uploadbtnset" name="upload">Upload Link</button>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br><br><br><br><br>
                                    <div class="row text-center nextuplo">
                                        <button type="submit" class="btn upnext ">save</button>
                                        <button type="reset" class="btn npback ">cancel</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="mulje" role="tabpanel" aria-labelledby="mulje-tab">
                                <div class="multiupload">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="multinote">
                                                        <p>
                                                            <b>INPORTANT :</b> All types of treatments MUST be specified in the Treatment field. <b>Download</b> CSV template or click <b>here</b> for detailed instructions
                                                            and allowed values. After uploading your stock, click on <b>Images </b> to upload images.
                                                        </p>
                                                        <p>
                                                            <b>NOTE :</b> Please note that Trade CVD listings are only active for 7 days. Refresh the listings periodically to ensure your stock is displayed on Trade CVD.
                                                        </p>
                                                        <p>
                                                            <b>NOTE :</b> Trade CVD strictly prohibits the listing of a) lab-grown diamonds, b) white diamonds with a green tinge/hue/shade and c) any diamonds originating from Zimbabwe. Please also note: Any/all treatments on diamonds must be clearly disclosed in the treatment fields and
                                                            misrepresentation is not allowed (laser drilled, color treated, HPHT etc.).
                                                        </p>
                                                    </div>
                                                    <br><br>
                                                    <div class="fileseset text-center">
                                                        <div class="fileico">
                                                            <button class="fisesearchup" onclick="importData()">Import</button>
                                                            <i class="fal fa-file"></i>
                                                        </div>
                                                        <p>Drop File Here Or <b>Browse</b></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- Footer Start -->
                    <?php include('footer.php'); ?>
                    <!-- Footer End -->

                    <!-- JS Start -->
                    <?php include('js.php'); ?>
                    <!-- JS End -->
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // // fliter btn code
    // /* Set the width of the side navigation to 250px */
    // function openNav() {
    //     document.getElementById("mySidenav").style.width = "370px";
    // }

    // /* Set the width of the side navigation to 0 */
    // function closeNav() {
    //     document.getElementById("mySidenav").style.width = "0";
    // }


    // product filter
    $(".mini img").click(function(){  
    $(".maxi").attr("src",$(this).attr("src").replace("100x100","400x400"));
    });

    // togal add btn upload page
    const detailsElement = document.querySelector('details');

    detailsElement.addEventListener('click', logEvent);
    detailsElement.addEventListener('toggle', logEvent);

    function logEvent(event) {
        console.log(`🔥 ${event.type}`);
    }

    const buttonElement = document.querySelector('button');

    buttonElement.addEventListener('click', event => {
        detailsElement.open = !detailsElement.open;
    });

    // upload file data
    function importData() {
        let input = document.createElement('input');
        input.type = 'file';
        input.onchange = _ => {
            // you can use this method to get file and perform respective operations
                    let files =   Array.from(input.files);
                    console.log(files);
                };
        input.click();
        }
    // upload page js show
    $(document).ready(function(){
          $(".setalljwne").click(function(){
            $(".setalljw").hide();
          });
          $(".setalljwne").click(function(){
            $(".setalljw2").show();
          });
    });

    // browse image code 
    function importData() {
    let input = document.createElement('input');
    input.type = 'file';
    input.onchange = _ => {
        // you can use this method to get file and perform respective operations
                let files =   Array.from(input.files);
                console.log(files);
            };
    input.click();
    
    }

    $('.setfilter').click(function() {
        $('.setfiljw').show(500);
        $('.setfilter').hide(0);
        $('.setfiljw').show(0);
    });
</script>
</html>