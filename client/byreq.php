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
                        <div class="col-12 col-md-5 m-auto">
                            <h4 class="mb-0 sec-desc header-desc text-blue">
                                My Buy Request
                            </h4>
                        </div>
                        <div class="col-12 col-md-7 m-auto pt-3">
                            <ul class="nav responsive-tab nav-material nav-material-white pt-2" id="buy-request-tab">
                                <li>
                                    <a class="nav-link text-center  active" id="request-1-tab" data-toggle="pill" href="#request-1">All <br /> Request</a>
                                </li>
                                <li>
                                    <a class="nav-link text-center" id="buyrequest-tab" data-toggle="pill" href="#buyrequest">My Buy <br />Request</a>
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
                        <div class="tab-pane fade show active" id="request-1" role="tabpanel" aria-labelledby="request-1-tab">
                            <div class="col-12 col-md-12 setcoloall">
                                <div class="row searchheaddet setmtopallbu">
                                    <div class="col-sm-12 col-xs-12 col-md-6 moredetail">
                                    <div class="shapesearch">
                                            <button type="button" class="btn searchbtnset"><b> Shape : </b><Span>Round</Span></button>
                                            <button type="button" class="btn searchbtnset"><b> Size : </b><Span>0.30-0.39</Span></button>
                                            <!-- <div class="closeseacrh">
                                                <img src="<?php echo $config->getImageurl(); ?>images/searchpage/close.svg" alt="diamonds" title="diamonds">
                                            </div> -->
                                            <button type="button" class="btn searchbtnset"><b> Shape : </b><Span>Round</Span></button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="text-right searchhead">
                                            <div class="searchgreade searchcom">
                                                <button type="button" class="btn searchbtnset"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/3.svg" alt="diamonds" title="diamonds"></button>
                                            </div>
                                            <div class="searchgreade searchcom"> 
                                                <button type="button" class="btn searchbtnset navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle"><img src="http://192.168.1.2/savanigems/assets/images/searchpage/fliter.svg" alt="diamonds" title="diamonds"></button>
                                            </div>
                                            <!-- <div class="searchgreade searchcom">
                                                <button type="button" href="#sidebarnew" data-toggle="collapse" class="btn searchbtnset open-filter-sidebar"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/fliter.svg" alt="diamonds" title="diamonds"></button>
                                            </div> -->
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
                                <div id="wrapper" class="wrappernew setapfilby">
                                    <div id="sidebar-wrapper" class="filternew sidebar-wrapper">
                                        <div class="fixbuyp">
                                            <h4>Filter (3)</h4><button type="button" class="btn-close-sidebar" aria-label="Close">x</button>
                                            <div class="searchgreade searchcom">
                                                <button type="submit" class="btn searchbtnset" id="btnapplydiamondfilter">Apply</button>
                                            </div>
                                        </div>
                                        <ul class="sidebarnew-nav nav-pills nav-stacked setfilese" id="menu">
                                            <li class="setshowje">
                                                <div class="col-12 cut-group setmedfli">
                                                    <div class="form-check">
                                                        <h5 class="setfinbuyre">See Only</h5>
                                                        <div class="col-12 col-md-12">
                                                            <div class="row">
                                                                <div class="col-12 col-md-12 cut-group">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                        <label class="form-check-label ml-4" for="laserdrilled">
                                                                            Active Buy Requests
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-12 cut-group">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                        <label class="form-check-label ml-4" for="laserdrilled">
                                                                            Expired Buy Requests
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-12 cut-group">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                        <label class="form-check-label ml-4" for="laserdrilled">
                                                                            With seller responses
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-12 cut-group">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                        <label class="form-check-label ml-4" for="laserdrilled">
                                                                            Without seller responses
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <hr>
                                            <li class="setshowje setbyre">
                                                <h4 class="setbyrena">price</h4>
                                                <div class="col-12 cut-group">
                                                    <h5 class="d-inline">$Total</h5>
                                                    <div class="row fliterset">
                                                        <div class="col-md-6 col-sm-6 cut-group">
                                                            <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 mt-auto cut-group">
                                                            <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 cut-group">                                                            
                                                    <h5 class="d-inline">$/Ct</h5>
                                                    <div class="row fliterset">
                                                        <div class="col-md-6 col-sm-6 cut-group">
                                                            <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 mt-auto cut-group">
                                                            <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 cut-group">                                                            
                                                    <h5 class="d-inline">Savani%</h5>
                                                    <div class="row fliterset">
                                                        <div class="col-md-6 col-sm-6 cut-group">
                                                            <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                            <label class="inputset" type="number">%</label>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 mt-auto cut-group">
                                                            <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                            <label class="inputset" type="number">%</label>
                                                        </div>
                                                    </div>
                                                </div>  

                                            </li>
                                            <hr>
                                            <li class="setshowje">
                                                <h4 class="d-inline setbyrena">Shape</h4>
                                                <div class="col-12 cut-group setselctorbuy">
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
                                            </li>
                                            <hr>
                                            <li class="setshowje">
                                                <h4 class="setbyrena">Size</h4>
                                                <div class="col-12 cut-group">
                                                    <!-- <h5 class="d-inline setsizebyu">Size</h5> -->
                                                    <div class="row fliterset">
                                                        <div class="col-md-6 col-sm-6 cut-group">
                                                            <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                            <label class="inputset" type="number">ct</label>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 mt-auto cut-group">
                                                            <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                            <label class="inputset" type="number">ct</label>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </li>
                                            <hr>
                                            <li class="setshowje">
                                                <h4 class="setbyrena">Color</h4>
                                                <div class="col-12 cut-group">
                                                    <!-- <h5 class="d-inline setsizebyu">Size</h5> -->
                                                    <div class="row fliterset">
                                                        <div class="col-md-6 col-sm-6 cut-group">
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
                                                        <div class="col-md-6 col-sm-6 mt-auto cut-group">
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
                                            </li>
                                            <hr>
                                            <li class="setshowje">
                                                <h4 class="setbyrena">CLARITY</h4>
                                                <div class="col-12 cut-group">
                                                    <!-- <h5 class="d-inline setsizebyu">Size</h5> -->
                                                    <div class="row fliterset">
                                                        <div class="col-md-6 col-sm-6 cut-group">
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
                                                        <div class="col-md-6 col-sm-6 mt-auto cut-group">
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
                                            </li>
                                            <hr>
                                            <li class="setshowje">
                                                <div class="col-12 cut-group">
                                                    <h5 class="d-inline setfinbuyre">Finish</h5>
                                                    <div class="row flis setrowbuy">
                                                        <div class="col-12 setcobu">
                                                            <label for="name"><b class="setcutbuy">Cut</b></label>
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
                                                    <div class="row flis setrowbuy">
                                                        <div class="col-12 setcobu">
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
                                                    </div>
                                                    <div class="row flis setrowbuy">
                                                        <div class="col-12 setcobu">
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
                                                </div>
                                            </li>
                                            <hr>
                                            <li class="setshowje setlabpo">
                                                <div class="col-12 cut-group">
                                                    <div class="form-check">
                                                        <h5 class="d-inline setfinbuyre">Grading Report</h5>
                                                        <div class="col-12 col-md-12 setmbuy">
                                                            <div class="row">
                                                                <div class="col-12 col-md-4 col-sm-6 col-xs-6 cut-group">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                        <label class="form-check-label ml-4" for="laserdrilled">
                                                                            GIA
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-4 col-sm-6 col-xs-6  cut-group">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                        <label class="form-check-label ml-4" for="laserdrilled">
                                                                            DOR
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-4 col-sm-6 col-xs-6  cut-group">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                        <label class="form-check-label ml-4" for="laserdrilled">
                                                                            RAP
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-4 col-sm-6 col-xs-6  cut-group">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                        <label class="form-check-label ml-4" for="laserdrilled">
                                                                            AGS
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-4 col-sm-6 col-xs-6  cut-group">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                        <label class="form-check-label ml-4" for="laserdrilled">
                                                                            HRD
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-4 col-sm-6 col-xs-6  cut-group ">
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
                                            <hr>
                                            <li class="setshowje">
                                                <h4 class="d-inline setbyrena">Fluorescence</h4>
                                                <div class="col-12 cut-group setselctorbuy">
                                                    <h5 class="d-inline setsizebyu">intensities</h5>
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
                                            </li>
                                            <hr>
                                            <li class="setshowje">
                                                <h4 class="d-inline setbyrena">location</h4>
                                                <div class="col-12 cut-group setselctorbuy">
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
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="col-12 cut-group">
                                                    <h4 class="setbyrena">Inclusion</h4>
                                                    <!-- <h5 class="d-inline">Inclusion</h5> -->
                                                    <div class="row flis setrowbuy">
                                                        <div class="col-12 setcobu">
                                                        <label for="name" class="eyeclenfil"><b class="seteyebuy">Eye clean</b></label>
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
                                                    <div class="row flis setrowbuy">
                                                        <div class="col-12 setcobu">
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
                                                    </div>
                                                    <div class="row flis setrowbuy">
                                                        <div class="col-12 setcobu">
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
                                                    </div>
                                                    <div class="row flis setrowbuy">
                                                        <div class="col-12 setcobu">
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
                                                    </div>
                                                    <div class="row flis setrowbuy">
                                                        <div class="col-12 setcobu">
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
                                                </div>
                                            </li>
                                            <hr>
                                            <li>
                                                <h4 class="setbyrena">Shade</h4>
                                                <div class="cut-group msetbuy">
                                                    <div class="col-12">
                                                        <input class="form-check-input" type="checkbox" value="" id="laserdrilled8">
                                                        <label class="form-check-label ml-4" for="laserdrilled8">
                                                            Include tested dimond
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <hr>
                                            <li class="setshowje">
                                                <h4 class="d-inline setbyrena">Rapspec</h4>
                                                <div class="col-12 cut-group setselctorbuy">
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
                                            </li>
                                            <hr>
                                            <li class="setshowje">
                                                <h4 class="setbyrena">Date Created</h4>
                                                <div class="col-12 cut-group">
                                                    <div class="row fliterset">
                                                        <div class="col-md-6 col-sm-6 cut-group">
                                                            <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 mt-auto cut-group">
                                                            <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                        </div>
                                                    </div>
                                                </div> 
                                            </li>
                                            <hr>
                                            <li class="setshowje">
                                                <h4 class="setbyrena">Date expire</h4>
                                                <div class="col-12 cut-group">
                                                    <div class="row fliterset">
                                                        <div class="col-md-6 col-sm-6 cut-group">
                                                            <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 mt-auto cut-group">
                                                            <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                        </div>
                                                    </div>
                                                </div> 
                                            </li>
                                            <hr>
                                        </ul>
                                    </div>
                                </div>
                                <!-- left bar end -->
                                <div class="accordion" id="accordionExample">
                                    <div class="table-responsive searchpagedetail">
                                        <table class="table table-tb">
                                            <thead>
                                                <tr>
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
                                                <tr  data-toggle="modal" data-target="#Byreq" class="setcurbuy">
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
                        </div>
                        <div class="tab-pane fade" id="buyrequest" role="tabpanel" aria-labelledby="buyrequest-tab">
                            <div class="col-12 col-md-12 setcoloall">
                                <div class="row searchheaddet setmtopallbu">
                                    <div class="col-sm-4 col-md-6 col-xs-12 moredetail byreqset">
                                        <ul>
                                            <li>My Buy Request</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-8 col-md-6 col-xs-12 setbyreqset">
                                        <div class="text-right searchhead">
                                            <div class="searchgreade searchcom">
                                                <button type="button" class="btn searchbtnset"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/3.svg" alt="diamonds" title="diamonds"></button>
                                            </div>
                                            <div class="searchgreade searchcom">
                                                <button type="button" class="btn searchbtnset navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle-mydiamond"><img src="http://192.168.1.2/savanigems/assets/images/searchpage/fliter.svg" alt="diamonds filter" title="diamonds filter"></button>
                                            </div>
                                            <div class="searchgreade searchcom">
                                                <button type="button" class="btn searchbtnset" data-toggle="modal" data-target="#searchbuy"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/search.svg" alt="diamonds" title="diamonds"> New search</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 setreqp">
                                        <ul>
                                            <li>
                                                0 Request
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="wrapper-mydiamond" class="wrappernew setwrbyreq">
                                    <div id="sidebar-wrapper" class="filternew sidebar-wrapper">
                                        <form action="" >
                                            <div class="fixbuyp">
                                                <h4>Filter</h4><button type="button" class="btn-close-sidebar btn-mydiamond-close-sidebar" aria-label="Close">x</button>
                                                <div class="searchgreade searchcom">
                                                    <button type="submit" class="btn searchbtnset" id="btnapplymydiamonddiamondfilter" disabled>Apply</button>
                                                </div>
                                            </div>
                                            <ul class="sidebarnew-nav nav-pills nav-stacked setfilese" id="menu">
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group setmedfli">
                                                        <div class="form-check">
                                                            <h5 class="setfinbuyre">See Only</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Active Buy Requests
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Expired Buy Requests
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                With seller responses
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-12 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                Without seller responses
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <hr>
                                                <li class="setshowje setbyre">
                                                    <h4 class="setbyrena">price</h4>
                                                    <div class="col-12 cut-group">
                                                        <h5 class="d-inline">$Total</h5>
                                                        <div class="row fliterset">
                                                            <div class="col-md-6 col-sm-6 cut-group">
                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 mt-auto cut-group">
                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 cut-group">                                                            
                                                        <h5 class="d-inline">$/Ct</h5>
                                                        <div class="row fliterset">
                                                            <div class="col-md-6 col-sm-6 cut-group">
                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 mt-auto cut-group">
                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 cut-group">                                                            
                                                        <h5 class="d-inline">Savani%</h5>
                                                        <div class="row fliterset">
                                                            <div class="col-md-6 col-sm-6 cut-group">
                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                <label class="inputset" type="number">%</label>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 mt-auto cut-group">
                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                <label class="inputset" type="number">%</label>
                                                            </div>
                                                        </div>
                                                    </div>  

                                                </li>
                                                <hr>
                                                <li class="setshowje">
                                                    <h4 class="d-inline setbyrena">Shape</h4>
                                                    <div class="col-12 cut-group setselctorbuy">
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
                                                </li>
                                                <hr>
                                                <li class="setshowje">
                                                    <h4 class="setbyrena">Size</h4>
                                                    <div class="col-12 cut-group">
                                                        <!-- <h5 class="d-inline setsizebyu">Size</h5> -->
                                                        <div class="row fliterset">
                                                            <div class="col-md-6 col-sm-6 cut-group">
                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                                <label class="inputset" type="number">ct</label>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 mt-auto cut-group">
                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                                <label class="inputset" type="number">ct</label>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </li>
                                                <hr>
                                                <li class="setshowje">
                                                    <h4 class="setbyrena">Color</h4>
                                                    <div class="col-12 cut-group">
                                                        <!-- <h5 class="d-inline setsizebyu">Size</h5> -->
                                                        <div class="row fliterset">
                                                            <div class="col-md-6 col-sm-6 cut-group">
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
                                                            <div class="col-md-6 col-sm-6 mt-auto cut-group">
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
                                                </li>
                                                <hr>
                                                <li class="setshowje">
                                                    <h4 class="setbyrena">CLARITY</h4>
                                                    <div class="col-12 cut-group">
                                                        <!-- <h5 class="d-inline setsizebyu">Size</h5> -->
                                                        <div class="row fliterset">
                                                            <div class="col-md-6 col-sm-6 cut-group">
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
                                                            <div class="col-md-6 col-sm-6 mt-auto cut-group">
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
                                                </li>
                                                <hr>
                                                <li class="setshowje">
                                                    <div class="col-12 cut-group">
                                                        <h5 class="d-inline setfinbuyre">Finish</h5>
                                                        <div class="row flis setrowbuy">
                                                            <div class="col-12 setcobu">
                                                                <label for="name"><b class="setcutbuy">Cut</b></label>
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
                                                        <div class="row flis setrowbuy">
                                                            <div class="col-12 setcobu">
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
                                                        </div>
                                                        <div class="row flis setrowbuy">
                                                            <div class="col-12 setcobu">
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
                                                    </div>
                                                </li>
                                                <hr>
                                                <li class="setshowje setlabpo">
                                                    <div class="col-12 cut-group">
                                                        <div class="form-check">
                                                            <h5 class="d-inline setfinbuyre">Grading Report</h5>
                                                            <div class="col-12 col-md-12 setmbuy">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-4 col-sm-6 col-xs-6 cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                GIA
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-4 col-sm-6 col-xs-6  cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                DOR
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-4 col-sm-6 col-xs-6  cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                RAP
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-4 col-sm-6 col-xs-6  cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                AGS
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-4 col-sm-6 col-xs-6  cut-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                            <label class="form-check-label ml-4" for="laserdrilled">
                                                                                HRD
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-4 col-sm-6 col-xs-6  cut-group ">
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
                                                <hr>
                                                <li class="setshowje">
                                                    <h4 class="d-inline setbyrena">Fluorescence</h4>
                                                    <div class="col-12 cut-group setselctorbuy">
                                                        <h5 class="d-inline setsizebyu">intensities</h5>
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
                                                </li>
                                                <hr>
                                                <li class="setshowje">
                                                    <h4 class="d-inline setbyrena">location</h4>
                                                    <div class="col-12 cut-group setselctorbuy">
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
                                                </li>
                                                <hr>
                                                <li>
                                                    <div class="col-12 cut-group">
                                                        <h4 class="setbyrena">Inclusion</h4>
                                                        <!-- <h5 class="d-inline">Inclusion</h5> -->
                                                        <div class="row flis setrowbuy">
                                                            <div class="col-12 setcobu">
                                                            <label for="name" class="eyeclenfil"><b class="seteyebuy">Eye clean</b></label>
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
                                                        <div class="row flis setrowbuy">
                                                            <div class="col-12 setcobu">
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
                                                        </div>
                                                        <div class="row flis setrowbuy">
                                                            <div class="col-12 setcobu">
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
                                                        </div>
                                                        <div class="row flis setrowbuy">
                                                            <div class="col-12 setcobu">
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
                                                        </div>
                                                        <div class="row flis setrowbuy">
                                                            <div class="col-12 setcobu">
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
                                                    </div>
                                                </li>
                                                <hr>
                                                <li>
                                                    <h4 class="setbyrena">Shade</h4>
                                                    <div class="cut-group msetbuy">
                                                        <div class="col-12">
                                                            <input class="form-check-input" type="checkbox" value="" id="laserdrilled8">
                                                            <label class="form-check-label ml-4" for="laserdrilled8">
                                                                Include tested dimond
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <hr>
                                                <li class="setshowje">
                                                    <h4 class="d-inline setbyrena">Rapspec</h4>
                                                    <div class="col-12 cut-group setselctorbuy">
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
                                                </li>
                                                <hr>
                                                <li class="setshowje">
                                                    <h4 class="setbyrena">Date Created</h4>
                                                    <div class="col-12 cut-group">
                                                        <div class="row fliterset">
                                                            <div class="col-md-6 col-sm-6 cut-group">
                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 mt-auto cut-group">
                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </li>
                                                <hr>
                                                <li class="setshowje">
                                                    <h4 class="setbyrena">Date expire</h4>
                                                    <div class="col-12 cut-group">
                                                        <div class="row fliterset">
                                                            <div class="col-md-6 col-sm-6 cut-group">
                                                                <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="From">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 mt-auto cut-group">
                                                                <input type="text" id="from_usd" class="fromusd" name="fTo" placeholder="To">
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </li>
                                                <hr>
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                                <div class=" accordion" id="accordionExample">
                                    <div class="table-responsive searchpagedetail setbuyreq">
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
      if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
        return false;
        }
      if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
        $('#menu ul:visible').slideUp('normal');
        checkElement.slideDown('normal');
        return false;
        }
      }
    );
  }
$(document).ready(function() {initMenu();});

$(".btn-close-sidebar").click(function(){
  $(".wrappernew.toggled").toggleClass("intro");
});







$("#menu-toggle-mydiamond").click(function(e) {
        e.preventDefault();
        $("#wrapper-mydiamond").addClass("toggled");
        $("#wrapper-mydiamond").removeClass("intro");
    });

    $(".btn-mydiamond-close-sidebar").click(function() {
        //   $("#wrapper").removeClass("toggled");
        $("#wrapper-mydiamond").addClass("intro");
    });
</script>
</html>