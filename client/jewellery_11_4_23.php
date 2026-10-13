<?php
// require_once dirname(__DIR__, 1).'/config/config.php';
// $config = new config();
require_once dirname(__DIR__, 1) . '/config/init.php';
$res = $DB->getpagemetadata(22);
if ($LoginInfo) {
    if ($LoginInfo->getAdlogin() != '' && $LoginInfo->getIsguestuser() == 0) {
    } else {
?>
        <script>
            window.location = '<?php echo $config->getWeburl(); ?>home';
        </script>
    <?php
    }
} else {
    ?>
    <script>
        window.location = '<?php echo $config->getWeburl(); ?>home';
    </script>
<?php
}
$id = $_REQUEST['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tag Start -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="<?php echo $res[0]['metakeywords']; ?>" />
    <meta name="author" content="<?php echo $res[0]['title']; ?>" />
    <meta name="robots" content="<?php echo $res[0]['title']; ?>" />
    <meta name="description" content="<?php echo $res[0]['metadescription']; ?>" />
    <meta property="og:title" content="<?php echo $res[0]['title']; ?>" />
    <meta property="og:url" content="<?php echo $config->getWeburl(); ?>" />
    <meta property="og:description" content="<?php echo $res[0]['metadescription']; ?>" />
    <meta property="og:image" content="<?php echo $config->getImageurl(); ?>images/ogiseo.png" />
    <link rel="icon" type="image/x-icon" href="<?php echo $config->getImageurl(); ?>images/favicon.ico" />
    <!-- Meta Tag End -->

    <!--title-->
    <title><?php echo $res[0]['title']; ?></title>

    <!-- CSS Start -->
    <?php include('css.php'); ?>

    <!-- CSS End -->
    <!-- <script src="assets/js/vendor/jquery.min.js"></script> -->
</head>

<body class="bg-white home-page all-page-sidebarset">
    <?php

    $CheckUserRights = $DB->checkpackagewiseuserright($LoginInfo->getUid());
    // echo $CheckUserRights['IsPackageExpire']; exit;
    if ($CheckUserRights['IsPackageExpire'] == 1) {
    ?>
        <script>
            Notiflix.Report.Warning('<?php echo $config->getPackageExpiredTitle(); ?>', '<?php echo $config->getPackageExpiredMessage(); ?>', false, function() {
                window.location = '<?php echo $config->getPackageExpiredURL(); ?>';
            });
            $('#preloader').addClass('d-none');
            $('#ctn-preloader').addClass('loaded');
        </script>
    <?php
        exit;
    }




    // 2 - Jewelry Search , 7 - List Jewelry for Sale, 3 - Share Diamonds and Jewelry, 8 - SavaniGems XL for Excel

    $CanJewellerySearch = $DB->getpackagewiseuserright($LoginInfo->getUid(), 2)['attributeval'];
    $CanListJewelleryForList = $DB->getpackagewiseuserright($LoginInfo->getUid(), 7)['attributeval'];
    $CanShareJewellery = $DB->getpackagewiseuserright($LoginInfo->getUid(), 3)['attributeval'];
    $CanListJewelleryXL = $DB->getpackagewiseuserright($LoginInfo->getUid(), 8)['attributeval'];

    // || $DB->getpackagewiseuserright($LoginInfo->getUid(),3)['attributeval']!=1 || $DB->getpackagewiseuserright($LoginInfo->getUid(),8)['attributeval']!=1
    if ($CanJewellerySearch != 1 && $CanListJewelleryForList != 1) {
    ?>
        <script>
            window.location = '<?php echo $config->getportalbaseurl(); ?>home';
        </script>
    <?php
    }
    ?>
    <div class="page-wrapper">
        <div class="has-sidebar-left">
            <header class="bg-white accent-3 relative nav-sticky tab-box-shadow ">
                <div class="container-fluid text-white">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-3 col-lg-3 col-xl-5 m-auto">
                            <h4 class="mb-0 sec-desc header-desc text-darkgreen">
                                Jewellery
                            </h4>
                        </div>
                        <div class="col-12 col-md-9 col-lg-9 col-xl-7 m-auto pt-3 setressc">
                            <ul class="nav responsive-tab nav-material nav-material-white pt-2" id="buy-Jwelery-tab">
                                <?php
                                if ($CanJewellerySearch == 1) {
                                ?>
                                    <li>
                                        <a class="nav-link text-center  active" onclick="listjewellerydata(1);" id="Jwelery-1-tab" data-toggle="pill" href="#Jwelery-1">Search</a>
                                    </li>
                                <?php
                                }
                                if ($CanListJewelleryForList == 1) {
                                ?>
                                    <li>
                                        <a class="nav-link text-center" id="buyJwelery-tab" onclick="resetjewelleryuploadform();" data-toggle="pill" href="#buyJwelery">Upload Jewellery</a>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" onclick="listmyjewellerydata(1);" id="managemyJwelery-tab" data-toggle="pill" href="#managemyJwelery">Manage My Jewellery</a>
                                    </li>
                                <?php
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <div class="main" id="web-content">
            <?php include('sidebar.php'); ?>
            <div class="has-sidebar-left">
                <div class="container-fluid relative mt-15 bx-5 animatedParent animateOnce">
                    <div class="tab-content bg-white" id="pills-tabContent">
                        <?php
                        if ($CanJewellerySearch == 1) {
                        ?>
                            <div class="tab-pane fade show active" id="Jwelery-1" role="tabpanel" aria-labelledby="Jwelery-1-tab">
                                <div class="row setpagejw">
                                    <div class="col-xl-2 col-lg-3 col-md-4 setfiljw">
                                        <div id="mySidenav" class="sidenav mySidenav">
                                            <div class="setnavfilter">
                                                <h4>Filters</h4>
                                            </div>
                                            <div class="searchje">
                                                <input type="text" class="search-bar" name="fltsearch" id="fltsearch" placeholder="Enter Keyword">
                                                <a href="javascript:void(0);" id="btnfltsearch" name="btnfltsearch" class="search-icon"> <i class="fa fa-search"></i></a>
                                            </div>
                                            <div class="allfilterse">
                                                <ul>
                                                    <li class="setshowje jewellerytypefilterDiv">
                                                        <div class="col-12 cut-group setmedfli setimgje">
                                                            <div class="form-check">
                                                                <h5>Jewellery Type</h5>
                                                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                                                    <div class="row  " id="jewellerytypefilterData">




                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="setshowje jewellerymetaltypefilterDiv">
                                                        <div class="col-12 cut-group setmedfli">
                                                            <div class="form-check">
                                                                <h5>Metal Type</h5>
                                                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                                                    <div class="row  " id="jewellerymetaltypefilterData">



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="setshowje jewellerygemstonetypefilterDiv">
                                                        <div class="col-12 cut-group setmedfli">
                                                            <div class="form-check">
                                                                <h5>Gemstone Type</h5>
                                                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                                                    <div class="row  " id="jewellerygemstonetypefilterData">



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
                                                                            <div class="widget_content jewellerypriceDiv" id="widgetcollapse1">
                                                                                <form action="" class="widget_block">
                                                                                    <div id="slider-range"></div>
                                                                                    <!-- <button type="button" id="btnfilter">Filter</button> -->
                                                                                    <input type="text" name="text" id="amount" readonly />
                                                                                    <input type="hidden" name="minprice" id="minprice" />
                                                                                    <input type="hidden" name="maxprice" id="maxprice" />
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="setshowje jewelleryconditionfilterDiv">
                                                        <div class="col-12 cut-group setmedfli">
                                                            <div class="form-check">
                                                                <h5>Condition</h5>
                                                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                                                    <div class="row  " id="jewelleryconditionfilterData">



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="setshowje jewellerymetalktfilterDiv">
                                                        <div class="col-12 cut-group setmedfli">
                                                            <div class="form-check">
                                                                <h5>Metal KT</h5>
                                                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                                                    <div class="row  " id="jewellerymetalktfilterData">



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="setshowje jewelleryqualityfilterDiv">
                                                        <div class="col-12 cut-group setmedfli">
                                                            <div class="form-check">
                                                                <h5>Jewellery Quality</h5>
                                                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                                                    <div class="row  " id="jewelleryqualityfilterData">



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="setshowje jewellerycategoryfilterDiv">
                                                        <div class="col-12 cut-group setmedfli">
                                                            <div class="form-check">
                                                                <h5>Category</h5>
                                                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                                                    <div class="row  " id="jewellerycategoryfilterData">



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <!-- <li class="setshowje jewellerygemstoneshapefilterDiv">
                                                        <div class="col-12 cut-group setmedfli setimgje">
                                                            <div class="form-check">
                                                                <h5>Gemstone Shape</h5>
                                                                <div class="col-12 col-md-12">
                                                                    <div class="row" id="jewellerygemstoneshapefilterData">

                                                                        
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li> -->
                                                    <!-- <li class="setshowje">
                                                        <div class="col-12 cut-group setmedfli">
                                                            <div class="form-check">
                                                                <h5>Gemstone Size</h5>
                                                                <div class="col-12 col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-12 col-md-12 cut-group">
                                                                            <div class="form-check">
                                                                                <div class="row fliterset setcutgrje">
                                                                                    <div class="col-md-6 cut-group">
                                                                                        <input type="text" id="fromsize" class="fromusd" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fromsize" placeholder="From">
                                                                                        <label class="inputset" type="number">$</label>
                                                                                    </div>
                                                                                    <div class="col-md-6 mt-auto cut-group">
                                                                                        <input type="text" id="tosize" class="fromusd" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="tosize" placeholder="To">
                                                                                        <label class="inputset" type="number">$</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li> -->
                                                    <li class="setshowje jewellerygemstonetreatmentfilterDiv">
                                                        <div class="col-12 cut-group setmedfli">
                                                            <div class="form-check">
                                                                <h5>Gemstone Treatment</h5>
                                                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                                                    <div class="row  " id="jewellerygemstonetreatmentfilterData">



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="setshowje jewellerylabreportfilterDiv">
                                                        <div class="col-12 cut-group setmedfli">
                                                            <div class="form-check">
                                                                <h5>Lab Report</h5>
                                                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                                                    <div class="row" id="jewellerylabreportfilterData">



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="setshowje jewellerybrandfilterDiv">
                                                        <div class="col-12 cut-group setmedfli">
                                                            <div class="form-check">
                                                                <h5>Brand</h5>
                                                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                                                    <div class="row  " id="jewellerybrandfilterData">



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="setshowje">
                                                        <div class="col-12 cut-group setmedfli">
                                                            <div class="form-check">
                                                                <h5>Avalibility</h5>
                                                                <div class="col-12 col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-12 col-md-12 cut-group">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" value="1" name="fltavailable" id="fltavailable">
                                                                                <label class="form-check-label ml-4" for="fltavailable">
                                                                                    Available
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-md-12 cut-group">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" value="1" name="fltavailableformemo" id="fltavailableformemo">
                                                                                <label class="form-check-label ml-4" for="fltavailableformemo">
                                                                                    Available For Memo
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="setshowje jewelleryshippingfromfilterDiv">
                                                        <div class="col-12 cut-group setmedfli">
                                                            <div class="form-check">
                                                                <h5>Shipping From</h5>
                                                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                                                    <div class="row  " id="jewelleryshippingfromfilterData">



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- right bar -->
                                    <div class="col-xl-10 col-lg-9 col-md-8 rightbarjew">
                                        <div class="loder-div">
                                            <div class="chart-loading" style="">
                                                <img alt="loading-img" src="assets/img/loading.gif">
                                            </div>
                                        </div>
                                        <div class="row shapefilterDiv">
                                            <div class="filter-box setfilterbox">
                                                <div class="form-group shape-group dash-shape setresjw">
                                                    <!-- <div class="name-filter">Shape</div> -->
                                                    <div class="row dash-row">
                                                        <div class="filter-container-set" id="shapefilterData">


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
                                                                <li><b class="totaljewellerys"> 0 Items</b></li>
                                                                <!-- <li class="checjew">
                                                                    <div class="col-12">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="1" id="canselectall">
                                                                            <label class="form-check-label ml-4" for="canselectall"> Select All
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="checjew addtomyfavoriteDiv d-none">
                                                                    <div class="col-12">
                                                                    <button type="button" id="btnaddtomyfavorite" class="btn btn-primary">Add to My Favorite</button>
                                                                    </div>
                                                                </li> -->

                                                                <li>
                                                                    <div class="col-12 ">
                                                                        <div class="form-check">
                                                                            <!-- <span class="fa fa-star"></span> -->
                                                                            <input class="form-check-input " type="checkbox" value="1" name="showmyfavorite" id="canshowmyfavorite">
                                                                            <label class="form-check-label" for="canshowmyfavorite">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Show My Favorite</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="setresfilterbar">
                                                            <button class="setfilter d-md-none d-xl-none d-lg-none">
                                                                <img src="<?php echo $config->getImageurl(); ?>images/searchpage/fliter.svg" alt="diamonds" title="diamonds">
                                                            </button>
                                                        </div>

                                                        <div class="col-md-3 col-lg-5 col-xs-12 col-sm-2 btsesearch  ">
                                                            <div class="text-right searchhead">
                                                                <div class="searchgreade searchcom setsho">
                                                                    <select class="form-control w-auto shortbydianmondse ml-auto" id="sortbyid" name="sortbyid">

                                                                    </select>
                                                                </div>
                                                                <div class="searchgreade searchcom">
                                                                    <button type="button" class="btn searchbtnset"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/3.svg" alt="diamonds" title="diamonds"></button>
                                                                </div>
                                                                <!-- <div class="searchgreade searchcom">
                                                                    <button type="button" class="btn searchbtnset jwesetbtn"><i class="fa fa-angle-down" aria-hidden="true"></i> More</button>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="shapesearch searchjewellerylistDiv">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid-products grid--view-items prd-grid productsetje listjewelleryDataDiv" id="listjewelleryData" data-show="0" data-nextpage="0">


                                        </div>
                                        <div class="row sticky-sec ">
                                            <div class="text-left col-md-5"><b>Showing <span id="showjewelleryentries"></span> entries</b></div>
                                            <div class="text-right col-md-3 col-lg-3 col-xl-3 offset-4"><b class="w-auto setallpageentry">entry <select class="form-control w-auto  ml-auto" id="jewellery_per_page" name="jewellery_per_page">
                                                        <!-- <option value="15">15</option> -->
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                        <option value="500">500</option>
                                                        <option value="1000">1000</option>
                                                    </select> per page</b></div>
                                        </div>
                                        <!-- right bar end -->
                                    </div>
                                </div>

                            </div>
                        <?php
                        }
                        if ($CanListJewelleryForList == 1) {
                        ?>
                            <div class="tab-pane fade" id="buyJwelery" role="tabpanel" aria-labelledby="buyJwelery-tab">
                                <?php
                                if ($CanListJewelleryForList == 1) {
                                ?>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="jew1-tab" data-toggle="tab" href="#jew1" onclick="filldocumnetupload(3);" role="tab" aria-controls="jew1" aria-selected="true">Single</a>
                                        </li>
                                        <?php
                                        if ($CanListJewelleryXL == 1) {
                                        ?>
                                            <li class="nav-item">
                                                <a class="nav-link ml-2" id="mulje-tab" data-toggle="tab" href="#mulje" onclick="filldocumnetupload(4);" role="tab" aria-controls="mulje" aria-selected="false">Multiple</a>
                                            </li>
                                        <?php
                                        } ?>
                                    </ul>
                                <?php
                                } ?>
                                <div class="tab-content main-JewelleryUploadFormDiv" id="myTabContent">

                                    <div class="tab-pane fade show active" id="jew1" role="tabpanel" aria-labelledby="jew1-tab">
                                        <div class="showsinglehowcanihelp mt-2 d-none mr-1">

                                        </div>
                                        <div class="breadcrumbset">
                                            <h5><span class="jewelleryuploadesirmodetext">Upload</span> Single item :</h5>
                                            <div class="container">
                                                <ul class="uploadjewellerytabs  nav" role="tablist">
                                                    <li class="tab-link ligeneralinfoDiv active" data-tab="1"><a class="nav-item active" data-typename="generalinfoDiv" id="nav-generalinfo-tab" data-toggle="tab" href="#generalinfoDiv" role="tab" aria-controls="generalinfoDiv" aria-selected="true"><b>1</b>General Information</a></li>
                                                    <li class="tab-link liuploadimgDiv disabled" disabled="" data-tab="2"><a class="nav-item disabled" disabled="" data-typename="uploadimgDiv" id="nav-uploadimg-tab" data-toggle="tab" href="#uploadimgDiv" role="tab" aria-controls="uploadimgDiv" aria-selected="false"><b>2</b>Upload Media</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <form action="javascript:void(0);" name="form-jewellery-upload" enctype="multipart/form-data" id="form-jewellery-upload" novalidate="novalidate">
                                            <input type="hidden" name="id" id="id" value="">
                                            <input type="hidden" name="formevent" id="formevent" value="submit">
                                            <div class="tab-content" id="nav-tabContent-JewelleryUploadFormDiv">
                                                <div class="tab-pane fade show active" id="generalinfoDiv" role="tabpanel" aria-labelledby="nav-generalinfo-tab">
                                                    <div class="loder-div">
                                                        <div class="chart-loading">
                                                            <img alt="loading-img" src="assets/img/loading.gif">
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <div class="row setupjw">
                                                            <div class="col-12 col-lg-6 col-md-12 uploadset upjweset setpaddtop">
                                                                <h4>Product Description</h4>
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="itemtitle" class="col-form-label">Item Title <span class="text-danger">*</span></label>
                                                                                    <input type="text" class="form-control" autocomplete="off" placeholder="Enter" id="itemtitle" name="itemtitle">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="row">
                                                                                    <div class="col-xl-8 col-lg-7 col-md-8 col-sm-9 ctupsearch">
                                                                                        <div class="form-group">
                                                                                            <label for="stock" class="col-form-label">Stock #<span class="text-danger">*</span></label>
                                                                                            <input type="text" class="form-control" autocomplete="off" placeholder="Enter" id="stock" name="stock">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-5 col-xl-4 col-md-4 col-sm-3 checkrdioupload setfjwct">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" value="1" name="isavailable" id="isavailable">
                                                                                            <label class="form-check-label" for="isavailable">
                                                                                                Available
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="form-check">
                                                                                            <input class="  form-check-input" type="checkbox" value="1" name="isavailableformemo" id="isavailableformemo">
                                                                                            <label class="form-check-label" for="isavailableformemo">
                                                                                                Available For Memo
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="writeboxjw">
                                                                            <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
                                                                            <div class="writset">
                                                                                <textarea class="form-control" rows="9" name="description" placeholder="Enter" id="description"></textarea>
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
                                                                                                <label for="jewellerytypeid" class="col-form-label">Jewellery Type <span class="text-danger">*</span></label>
                                                                                                <select id="jewellerytypeid" name="jewellerytypeid" class="form-control select2">

                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 ctupsearch">
                                                                                            <div class="form-group">
                                                                                                <label for="typestyleid" class="col-form-label">Type Style</label>
                                                                                                <select id="typestyleid" name="typestyleid[]" multiple class="form-control select2">

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
                                                                                                <label for="jewellerycategoryid" class="col-form-label">Jewellery Category</label>
                                                                                                <select id="jewellerycategoryid" name="jewellerycategoryid[]" multiple class="form-control select2">

                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-4">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 ctupsearch">
                                                                                            <div class="form-group">
                                                                                                <label for="conditionid" class="col-form-label">Condition</label>
                                                                                                <select id="conditionid" name="conditionid" class="form-control select2">

                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-4">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 ctupsearch">
                                                                                            <div class="form-group">
                                                                                                <label for="brandid" class="col-form-label">Brand</label>
                                                                                                <select id="brandid" name="brandid" class="form-control select2">

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
                                                                                                <label for="jewelleryqualityid" class="col-form-label">Jewellery Quality</label>
                                                                                                <select id="jewelleryqualityid" name="jewelleryqualityid[]" multiple class="form-control select2">

                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 ctupsearch">
                                                                                            <div class="form-group">
                                                                                                <label for="designername" class="col-form-label">Designer Maker</label>
                                                                                                <input type="text" class="form-control" autocomplete="off" placeholder="Enter" id="designername" name="designername">
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
                                                                                                <label for="keyworddescription" class="col-form-label">Keyword Description</label>
                                                                                                <textarea class="form-control" rows="1" name="keyworddescription" placeholder="Enter" id="keyworddescription"></textarea>
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

                                                                        <div class="manisecupload priceandlocationDiv">


                                                                        </div>
                                                                        <div class="row mt-3">
                                                                            <div class="col-12 col-lg-6 col-md-12">
                                                                                <a href="javascript:void(0);" class="btnaddpricelocationDiv btn btn-primary adminbtndark">+ Add Additional Location</a>
                                                                            </div>
                                                                            <div class="col-12 col-lg-6 col-md-12 text-right">
                                                                                <a href="javascript:void(0);" class="btnremovepricelocationDiv  btn btn-danger d-none">- Remove</a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="manisecupload">
                                                                            <div class="row setptopjw">
                                                                                <div class="col-lg-6 col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 ctupsearch">
                                                                                            <div class="form-group">
                                                                                                <label for="sharewithemail" class="col-form-label">Item In Stock</label>
                                                                                                <input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter" id="iteminstock" name="iteminstock">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 ctupsearch">
                                                                                            <div class="form-group">
                                                                                                <label for="sharewithemail" class="col-form-label">Minimum Order</label>
                                                                                                <input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter" id="minimumorder" name="minimumorder">
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
                                                                                                <label for="metaltypeid" class="col-form-label">Metal Type</label>
                                                                                                <select id="metaltypeid" name="metaltypeid[]" multiple class="form-control select2">

                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-4">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 ctupsearch">
                                                                                            <div class="form-group">
                                                                                                <label for="metalkaratid" class="col-form-label">Metal Karat</label>
                                                                                                <select id="metalkaratid" name="metalkaratid[]" multiple class="form-control select2">

                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-4">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 ctupsearch">
                                                                                            <div class="form-group">
                                                                                                <label for="jewellerytotalweight" class="col-form-label">Jewellery Total Weight</label>
                                                                                                <input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter" id="jewellerytotalweight" name="jewellerytotalweight">
                                                                                                <h6 class="setdayjw setdayres">gr</h6>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="manisecupload gemstoneDiv">




                                                                            </div>
                                                                            <div class="row mt-3">
                                                                                <div class="col-12 col-lg-6 col-md-12">
                                                                                    <a href="javascript:void(0);" class="btnaddgemstoneDiv btn adminbtndark btn-primary">+ Add Additional gemstone</a>
                                                                                </div>
                                                                                <div class="col-12 col-lg-6 col-md-12 text-right">
                                                                                    <a href="javascript:void(0);" class="btnremovegemstoneDiv  btn btn-danger d-none">- Remove</a>
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
                                                                                <textarea class="form-control" rows="2" placeholder="Enter" name="suppliercomment" id="suppliercomment"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-4 uploadset upjweset setparsjw setpaddtop">
                                                                <h4>Measurements</h4>
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="manisecupload">
                                                                            <div class="row setptopjw setbtmmarjw setpjw">
                                                                                <div class="col-xl-9 col-lg-7 col-md-7">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 ctupsearch">
                                                                                            <div class="form-group">
                                                                                                <label for="size" class="col-form-label">Size</label>
                                                                                                <input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter" id="size" name="size">
                                                                                                <h6 class="setdayjw">mm</h6>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-xl-3 col-lg-5 col-md-5 ringsizeDiv">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 ctupsearch">
                                                                                            <div class="form-group">
                                                                                                <label for="size" class="col-form-label">Ring Size</label>
                                                                                                <input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter" id="ringsize" name="ringsize">
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
                                                                <h4>Visibility</h4>
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="manisecupload set-upjw">
                                                                            <div class="row setptopjw">
                                                                                <div class="col-12 col-lg-4 col-md-4 mb-2">
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="checkbox" value="1" name="unpublished" id="unpublished">
                                                                                        <label class="form-check-label ml-4" for="unpublished">
                                                                                            Published
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- <div class="col-12 col-lg-4 col-md-4 mb-2">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" value="1" name="shareable" id="shareable">
                                                                                    <label class="form-check-label ml-4" for="shareable">
                                                                                        Sharable
                                                                                    </label>
                                                                                </div>
                                                                            </div> -->
                                                                                <!-- <div class="col-12 col-lg-4 col-md-4 mb-2">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" value="1" name="ownstockinventory" id="ownstockinventory">
                                                                                    <label class="form-check-label ml-4" for="ownstockinventory">
                                                                                        Own Stock Inventory
                                                                                    </label>
                                                                                </div>
                                                                            </div> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br><br><br><br><br><br>
                                                        <div class="row text-center nextuplo">
                                                            <button type="button" id="btngeneralinfo" class="btn upnext setalljwne adminbtndark">Next</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show" id="uploadimgDiv" role="tabpanel" aria-labelledby="nav-uploadimg-tab">
                                                    <div class="loder-div">
                                                        <div class="chart-loading">
                                                            <img alt="loading-img" src="assets/img/loading.gif">
                                                        </div>
                                                    </div>
                                                    <div class="mt-5">
                                                        <div class="col-12 offset-2 col-lg-8 col-md-12 uploadset repose pset">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="stockuplod">
                                                                        <h4>Jewellery Image</h4>
                                                                        <hr>
                                                                    </div>
                                                                    <div class="manisecupload">
                                                                        <div class="row">
                                                                            <div class="col-md-4 col-sm-4 setpadbto">
                                                                                <div class="row">
                                                                                    <div class="col-12 ctupsearch uploadmaset">
                                                                                        <div class="form-group filepreview">
                                                                                            <input type="file" id="jewelleryimg" multiple="multiple" accept="image/png, image/jpg, image/jpeg" class="uploadbtnset form-control" name="jewelleryimg[]" />
                                                                                            <h5 class="orsetsearch">Or</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-4">
                                                                                <div class="row">
                                                                                    <div class="col-12 ctupsearch uploadmaset">
                                                                                        <div class="form-group">
                                                                                            <input type="text" class="form-control" autocomplete="off" placeholder="Enter Image Link" id="jewelleryimglink" name="jewelleryimglink">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-4">
                                                                                <div class="row">
                                                                                    <div class="col-12 ctupsearch uploadmaset">
                                                                                        <div class="form-group">
                                                                                            <input type="text" class="form-control" autocomplete="off" placeholder="Enter Video Link" id="jewelleryvideolink" name="jewelleryvideolink">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2 myjewellerymediafileDiv">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <br><br><br><br><br><br>
                                                        <?php
                                                        if ($CanListJewelleryForList == 1) {
                                                        ?>
                                                            <div class="row text-center nextuplo">
                                                                <button type="submit" class="btn upnext " id="btnsavejewellery">Save</button>
                                                                <button type="reset" data-next-tab="generalinfoDiv" id="btnresetjewelleryupload" class="btn npback ">Reset</button>&nbsp;&nbsp;
                                                                <button type="button" data-prev-tab="generalinfoDiv" class="btn btnprevjewelleryuploadform npback ">Back</button>
                                                            </div>
                                                        <?php
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                    <div class="tab-pane fade" id="mulje" role="tabpanel" aria-labelledby="mulje-tab">
                                        <div class="multiupload">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="loder-div">
                                                                <div class="chart-loading">
                                                                    <img alt="loading-img" src="assets/img/loading.gif">
                                                                </div>
                                                            </div>
                                                            <div class="multinote" id="jewellerycsvuploaddetail">

                                                            </div>
                                                            <br><br>
                                                            <form action="javascript:void(0);" name="form-jewellery-csv-upload" enctype="multipart/form-data" id="form-jewellery-csv-upload" novalidate="novalidate">
                                                                <div class="row">
                                                                    <div class="col-md-4 offset-4 setresuo">
                                                                        <p>Download Excel Format : <a href="<?php echo $config->getImageurl(); ?>files/uploadjewellerydata.xlsx"><b>Click Here</b></a></p>
                                                                    </div>
                                                                </div>
                                                                <div class="showmultiplehowcanihelp mt-2 d-none mr-1">

                                                                </div>
                                                                <div class="fileseset text-center">
                                                                    <div class="fileico">
                                                                        <input class="fisesearchup" type="file" name="csvfile" id="jewellerycsvfile" accept=".xls,.xlsx">
                                                                        <i class="fal fa-file"></i>
                                                                    </div>
                                                                    <p>Drop File Here Or <b>Browse</b></p>
                                                                    <p class="selectedfilenameText">No File Selected.</p>
                                                                </div>
                                                                <?php
                                                                if ($CanListJewelleryForList == 1 && $CanListJewelleryXL == 1) {
                                                                ?>
                                                                    <div class="text-center p-5">
                                                                        <button type="submit" id="btnjewellerycsvupload" disabled class="btn send-btn dash-serchbtn adminbtndark">Upload</button>
                                                                        <input type="reset" value="Reset" id="btnresetjewellerycsvupload" class="btn reset-btn dash-reset-btn">
                                                                    </div>
                                                                <?php
                                                                } ?>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php
                        }
                        if ($CanListJewelleryForList == 1) {
                        ?>
                            <div class="tab-pane fade" id="managemyJwelery" role="tabpanel" aria-labelledby="managemyJwelery-tab">
                                <div class="loder-div">
                                    <div class="chart-loading" style="">
                                        <img alt="loading-img" src="assets/img/loading.gif">
                                    </div>
                                </div>
                                <div class="table-responsive listmyjewelleryDataDiv searchpagedetail">
                                    <div class="row searchheaddet">
                                        <div class="col-md-6 moredetail">
                                            <ul>
                                                <li><b class="totalmyjewellery"> 0 Items </b></li>
                                                <!-- <li>&nbsp;<b class="totalmyjewelleryprice"> Total Price : $0 </b></li> -->
                                                <!-- <li>&nbsp; Total Carats 98,176,8 |</li>
                                                <li>&nbsp; Average $/ct 1,299 |</li>
                                                <li>&nbsp; Average Discount - 36.32%</li> -->
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-right searchhead">
                                                <div class="delete-selected tbl-check d-none searchgreade searchcom setsho">

                                                    <a href="javascript:void(0);" class="btn btn-primary m-0 btnmultitrash trust-dataset" data-toggle="modal"><i class="fas fa-trash"></i></a>
                                                </div>
                                                <div class="dropdown table-setting button-deletedeta searchgreade searchcom setsho">
                                                    <!-- <a href="javascript:void(0);" class="btn btn-primary m-0 hidden" data-toggle="modal" ><i class="fas fa-trash"></i></a> -->
                                                    <button class="dropdown-toggle btn btn-primary" type="button" id="tableSetting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Bulk Delete"><i class="fas fa-check-circle"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="tableSetting">
                                                        <a class="dropdown-item select-bulk-delete bluk-buttonset" href="javascript:void(0);"><i class="fas fa-trash"></i> Bulk Delete</a>
                                                    </div>
                                                </div>
                                                <div class="searchgreade searchcom setsho">
                                                    <select class="form-control w-auto shortbydianmondse ml-auto" id="myjewellerysortbyid" name="myjewellerysortbyid">

                                                    </select>
                                                </div>
                                                <div class="searchgreade searchcom">
                                                    <button type="button" class="btn searchbtnset"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/3.svg" alt="jewellery sort by" title="jewellery sort by"></button>
                                                </div>
                                                <div class="searchgreade searchcom">
                                                    <button type="button" class="btn searchbtnset navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle-myjewellery"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/fliter.svg" alt="diamonds filter" title="diamonds filter"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="shapesearch searchmyjewellerylistDiv">
                                                <!-- <a href="javascript:void(0);" class="btn searchbtnset"><b> Shape : </b><Span>Round</Span></a> -->
                                                <!-- <button type="button" class="btn searchbtnset"><b> Size : </b><Span>0.30-0.39</Span></button>
                                                <button type="button" class="btn searchbtnset"><b> Shape : </b><Span>Round</Span></button> -->
                                            </div>
                                        </div>
                                    </div>
                                    <nav class="fliterset no-margin">
                                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                            <ul class="nav navbar-nav">
                                                <li class="active">
                                                    <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-3"> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span></button>
                                                </li>
                                            </ul>
                                        </div>
                                    </nav>
                                    <div id="wrapper-myjewellery" class="wrappernew">
                                        <div id="sidebar-wrapper" class="filternew sidebar-wrapper">
                                            <!-- <form action="javascript:void(0);" name="form-myjewellery-search" enctype="multipart/form-data" id="form-myjewellery-side-search" novalidate="novalidate"> -->
                                            <h4>Filter</h4><button type="button" class="btn-close-sidebar btn-myjewellery-close-sidebar" aria-label="Close">x</button>
                                            <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
                                                <li>
                                                    <div class="col-12 cut-group">
                                                        <h5 class="d-inline">Price</h5>
                                                        <div class="row">
                                                            <div class="col-12 col-md-12 cut-group">
                                                                <div class="widget_content jewellerypriceDiv" id="widgetcollapse1">
                                                                    <form action="" class="widget_block">
                                                                        <div id="side-slider-range"></div>
                                                                        <!-- <button type="button" id="btnfilter">Filter</button> -->
                                                                        <input type="text" name="text" id="sideamount" readonly />
                                                                        <input type="hidden" name="sideminprice" id="sideminprice" />
                                                                        <input type="hidden" name="sidemaxprice" id="sidemaxprice" />
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="s_jewellerytypeDiv">
                                                    <div class="col-12 cut-group secndsearch">
                                                        <div class="form-check">
                                                            <h5 class="d-inline">Jewellery Type</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row" id="s_jewellerytypeDivData">


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="s_brandDiv">
                                                    <div class="col-12 cut-group secndsearch">
                                                        <div class="form-check">
                                                            <h5 class="d-inline">Brand</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row" id="s_brandDivData">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="s_categoryDiv">
                                                    <div class="col-12 cut-group secndsearch">
                                                        <div class="form-check">
                                                            <h5 class="d-inline">Jewellery Category</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row" id="s_categoryDivData">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="s_qualityDiv">
                                                    <div class="col-12 cut-group secndsearch">
                                                        <div class="form-check">
                                                            <h5 class="d-inline">Jewellery Quality</h5>
                                                            <div class="col-12 col-md-12">
                                                                <div class="row" id="s_qualityDivData">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                            </ul>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                    <table class="table mt-0 mb-5 table-tb" id="listmyjewelleryDatatbl" data-show="0" data-nextpage="0">
                                        <thead>
                                            <tr class="settabledi">
                                                <th class="tbl-check d-none">
                                                    <div class="text-center">
                                                        <div class="custom-control custom-checkbox m-0 w-auto">
                                                            <input type="checkbox" class="custom-control-input" id="tblCheckAll" name="tblCheckAll">
                                                            <label class="custom-control-label mb-n1 diamond-data-delete" for="tblCheckAll">All</label>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th>Stock</th>
                                                <th>Item Title</th>
                                                <th>Jewellery Type</th>
                                                <th>Brand</th>
                                                <th>Price</th>
                                                <th>Item In Stock</th>
                                                <th>Minimum Order</th>
                                                <th>Condition</th>
                                                <th>Design Maker</th>
                                                <th>Is Active</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="listmyjewelleryData">

                                        </tbody>
                                    </table>
                                    <div class="row sticky-sec">
                                        <div class="text-left col-md-5"><b>Showing <span id="showmyjewelleryentries"></span> entries</b></div>
                                        <div class="text-right col-md-3 col-lg-3 col-xl-3 offset-4"><b class="w-auto setallpageentry">entry <select class="form-control w-auto  ml-auto" id="myjewellery_per_page" name="myjewellery_per_page">
                                                    <option value="20">20</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                    <option value="500">500</option>
                                                    <option value="1000">1000</option>
                                                </select> per page</b></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } ?>
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


    // // togal add btn upload page
    // const detailsElement = document.querySelector('details');

    // detailsElement.addEventListener('click', logEvent);
    // detailsElement.addEventListener('toggle', logEvent);

    // function logEvent(event) {
    //     //console.log(`🔥 ${event.type}`);
    // }

    // const buttonElement = document.querySelector('button');

    // buttonElement.addEventListener('click', event => {
    //     detailsElement.open = !detailsElement.open;
    // });


    $("#menu-toggle-myjewellery").click(function(e) {
        e.preventDefault();
        $("#wrapper-myjewellery").addClass("toggled");
        $("#wrapper-myjewellery").removeClass("intro");
    });

    $(".btn-myjewellery-close-sidebar").click(function() {
        //   $("#wrapper").removeClass("toggled");
        $("#wrapper-myjewellery").addClass("intro");
    });

    // upload file data
    function importData() {
        let input = document.createElement('input');
        input.type = 'file';
        input.onchange = _ => {
            // you can use this method to get file and perform respective operations
            let files = Array.from(input.files);
            //console.log(files);
        };
        input.click();
    }


    // upload page js show
    $(document).ready(function() {
        $("#buy-Jwelery-tab li:first-child a").click();

        var id = '<?php echo $id ?>';
        if (id) {
            listjewellerydata(1);
        }
        fillcontentsetting();
        fillpriceloactionhtml();
        fillgemstonehtml();
        listjewelrytype('');
        listjewelrycategory('');
        listcondition('');
        listbrand('');
        listjewelryquality('');
        listmetaltype('');
        listmetalcarat('');
        $('.select2').select2();
        listsortby();
        listmysortby();
        getitenminmaxprice();
        filldocumnetupload(3);
    });

    // browse image code 
    function importData() {
        let input = document.createElement('input');
        input.type = 'file';
        input.onchange = _ => {
            // you can use this method to get file and perform respective operations
            let files = Array.from(input.files);
            //console.log(files);
        };
        input.click();

    }

    $('.setfilter').click(function() {
        $('.setfiljw').show(500);
        $('.setfilter').hide(0);
        $('.setfiljw').show(0);
    });


    function filldocumnetupload(typeid) {
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
        formdata.append("action", "listdocumnetupload");
        formdata.append("typeid", typeid);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilldocumnetupload, OnErrorfilldocumnetupload);

        function Onsuccessfilldocumnetupload(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('.showsinglehowcanihelp').addClass('d-none');
            $('.showmultiplehowcanihelp').addClass('d-none');
            var htmldata = '';
            if (resultdata.status == 1) {
                if (typeid == 3) {
                    if (resultdata.data[0].fileurl != '') {
                        $('.showsinglehowcanihelp').removeClass('d-none');
                        htmldata += '<p class="text-right"><a href="' + resultdata.data[0].fileurlpath + '" target="_blank"><i class="fas fa-book"></i>&nbsp;How To Upload?</a></p>';
                    }
                    $('.showsinglehowcanihelp').html(htmldata);
                } else if (typeid == 4) {
                    if (resultdata.data[0].fileurl != '') {
                        $('.showmultiplehowcanihelp').removeClass('d-none');
                        htmldata += '<p class="text-right"><a href="' + resultdata.data[0].fileurlpath + '" target="_blank"><i class="fas fa-book"></i>&nbsp;How To Upload?</a></p>';
                    }
                    $('.showmultiplehowcanihelp').html(htmldata);
                }

            }



        }

        function OnErrorfilldocumnetupload(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }


    /************** UPLOAD JEWELLERY CSV *********************/

    function fillcontentsetting() {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: '',
            masterlisting: false
        };

        formdata = new FormData();
        formdata.append("action", "listcontentsetting");
        formdata.append("typeid", 27);

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + 'contentsetting', formdata, headersdata, Onsuccessfillcontentsetting, OnErrorfillcontentsetting);
    }

    function Onsuccessfillcontentsetting(content) {
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        var htmldata = '';
        if (resultdata.status == 0) {
            htmldata += '<div class="col-exs-12 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3 text-center" >';
            htmldata += '<h3>No Data Found!</h3>';
            htmldata += '</div>';
            $('#jewellerycsvuploaddetail').html(htmldata);
        } else if (resultdata.status == 1) {
            $('#jewellerycsvuploaddetail').html(resultdata.result[0].description);
        }

    }

    function OnErrorfillcontentsetting(content) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }

    function getselectedfilename() {
        var isfileselected = 0;
        $('#btnjewellerycsvupload').attr('disabled', true);
        $('#form-jewellery-csv-upload .selectedfilenameText').html('No File Selected.');
        var filename = $('#jewellerycsvfile').val().replace(/C:\\fakepath\\/i, '');
        if (filename != '' && filename != null) {
            $('#form-jewellery-csv-upload .selectedfilenameText').html(filename);
            $('#btnjewellerycsvupload').attr('disabled', false);
            isfileselected = 1;
        }
        return isfileselected;
    }
    $("#jewellerycsvfile").change(function() {
        getselectedfilename();
    });

    if ($('#form-jewellery-csv-upload').length) {
        $('#form-jewellery-csv-upload').validate({
            rules: {

            },
            messages: {

            },
            submitHandler: function(form) {

                var isfileselected = getselectedfilename();
                if (isfileselected > 0) {

                    // showloader();
                    $('.chart-loading').show();
                    $('#btnjewellerycsvupload').attr('disabled', true);
                    var pagename = getpagename();
                    var useraction = $('#formevent').val();
                    formdata = new FormData(form);
                    formdata.append("action", "uploadjewellerycsv");
                    var headersdata = {
                        'Accept': 'application/json',
                        platform: 4,
                        userpagename: pagename,
                        useraction: useraction,
                        masterlisting: false
                    };
                    ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>jewellery', formdata, headersdata, Onsuccessuploadjewellerycsv, OnErroruploadjewellerycsv)

                    function Onsuccessuploadjewellerycsv(data) {
                        // hideloader();
                        $('.chart-loading').hide();
                        var JsonData = JSON.stringify(data);
                        var resultdata = jQuery.parseJSON(JsonData);
                        if (resultdata.status == 0) {
                            Notiflix.Notify.Failure(resultdata.message);

                        } else if (resultdata.status == 1) {
                            Notiflix.Notify.Success(resultdata.message);
                            resetjewellerycsvupload();

                        } else if (resultdata.status == -1) {
                            $('#btnlogout').trigger('click');
                        }

                    }

                    function OnErroruploadjewellerycsv(content) {

                    }

                } else {
                    Notiflix.Notify.Failure('Please select csv file');
                }


            },
        });
    }

    function resetjewellerycsvupload() {
        $("#form-jewellery-csv-upload").validate().resetForm();
        $('#form-jewellery-csv-upload').trigger("reset");
        getselectedfilename();
    }
    $('#btnresetjewellerycsvupload').click(function() {
        resetjewellerycsvupload();
    });


    function fillpriceloactionhtml() {

        var trtmp = $('#form-jewellery-upload .priceandlocationDiv .priceandlocationDataDiv:last').attr('data-index') | 0;
        trtmp = parseInt(trtmp + 1);
        var trtmp_row = parseInt(trtmp - 1);

        var html = '';
        html += '<div class="setcolorjw priceandlocationDataDiv mt-3" data-index="' + trtmp + '">';
        html += '<div class="row">';
        html += '<div class="col-md-4">';
        html += '<div class="row">';
        html += '<div class="col-lg-12 ctupsearch">';
        html += '<div class="form-group">';
        html += '<label for="shippingfromid' + trtmp + '" class="col-form-label">Shipping From <span class="text-danger">*</span></label>';
        html += '<select id="shippingfromid' + trtmp + '" name="shippingfromid[]" class="form-control select2 shippingfromid">';

        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4">';
        html += '<div class="row">';
        html += '<div class="col-lg-12 ctupsearch">';
        html += '<div class="form-group">';
        html += '<label for="price' + trtmp + '" class="col-form-label">Price Per Piece</label>';
        html += '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter" id="price' + trtmp + '" name="price[]">';
        html += '</div>';
        html += '</div>';
        html += '</div> ';
        html += '</div>';
        html += '<div class="col-md-4">';
        html += '<div class="row">';
        html += '<div class="col-lg-12 ctupsearch">';
        html += '<div class="form-group">';
        html += '<label for="termsid' + trtmp + '" class="col-form-label">Terms</label>';
        html += '<select id="termsid' + trtmp + '" name="termsid' + trtmp_row + '[]" multiple class="form-control select2">';

        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '</div> ';
        html += '</div>';
        html += '</div>';
        html += '<div class="row setptopjw">';
        html += '<div class="col-lg-4 col-md-4">';
        html += '<div class="row">';
        html += '<div class="col-lg-12 ctupsearch">';
        html += '<div class="form-group">';
        html += '<label for="msrp' + trtmp + '" class="col-form-label">Msrp</label>&nbsp;&nbsp;&nbsp;<i data-toggle="tooltip" title="If you do sell your work to a store your MSRP (manufacturer\'s suggested retail price) should ideally be the same in all stores and your online shop. COMPARING YOURSELF TO OTHERS. Research what other jewelers with similar work are selling their work for in retail stores and online." class="fa fa-info gridbtn"></i>';
        html += '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter" id="msrp' + trtmp + '" name="msrp[]">';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-lg-4 col-md-4">';
        html += '<div class="row">';
        html += '<div class="col-lg-12 ctupsearch">';
        html += '<div class="form-group">';
        html += '<label for="deliverytimeindays' + trtmp + '" class="col-form-label">Delivery Time</label>';
        html += '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter" id="deliverytimeindays' + trtmp + '" name="deliverytimeindays[]">';
        html += '<h6 class="setdayjw">Days</h6>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('#form-jewellery-upload .priceandlocationDiv').append(html);

        $('.select2').select2();
        checklastpriceloactionhtml();
        listshippingfrom(trtmp, '');
        listterms(trtmp, '');
    }
    $('.btnaddpricelocationDiv').on('click', function() {
        fillpriceloactionhtml();
    });

    $('.btnremovepricelocationDiv').on('click', function() {
        var trtmp = $('#form-jewellery-upload .priceandlocationDiv .priceandlocationDataDiv:last').attr('data-index') | 0;
        if (trtmp > 1) {
            $('#form-jewellery-upload .priceandlocationDiv > div').last().remove();

        }
        checklastpriceloactionhtml();
    });

    function checklastpriceloactionhtml() {
        var trtmp = $('#form-jewellery-upload .priceandlocationDiv .priceandlocationDataDiv:last').attr('data-index') | 0;
        if (trtmp > 1) {
            $('.btnremovepricelocationDiv').removeClass('d-none');
        } else {
            $('.btnremovepricelocationDiv').addClass('d-none');
        }
    }

    $('.btnaddgemstoneDiv').on('click', function() {
        fillgemstonehtml();
    });




    /* ******Location*******  */
    function listshippingfrom(trtmp, shippingfromid = null) {

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
        formdata.append("action", "listcountry");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistshippingfrom, OnErrorlistshippingfrom);

        function Onsuccesslistshippingfrom(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var filterhtmldata = '';
            htmldata += '<option value="">Select Shipping From</option>';
            $('.jewelleryshippingfromfilterDiv').addClass('d-none');
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.jewelleryshippingfromfilterDiv').removeClass('d-none');
                        for (var i in resultdata.data) {
                            htmldata += '<option  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            filterhtmldata += '<div class="col-12 col-md-12 cut-group">';
                            filterhtmldata += '    <div class="form-check">';
                            filterhtmldata += '        <input class="form-check-input fltjewelleryshippingfromid" type="checkbox" data-name="' + resultdata.data[i].name + '" value="' + resultdata.data[i].id + '" id="fltjewelleryshippingfromid' + resultdata.data[i].id + '">';
                            filterhtmldata += '        <label class="form-check-label ml-4" for="fltjewelleryshippingfromid' + resultdata.data[i].id + '">';
                            filterhtmldata += '            ' + resultdata.data[i].name + '';
                            filterhtmldata += '        </label>';
                            filterhtmldata += '    </div>';
                            filterhtmldata += '</div>';
                        }
                    }
                }

            }
            $('#shippingfromid' + trtmp + '').html(htmldata);
            $('#jewelleryshippingfromfilterData').html(filterhtmldata);
            if (shippingfromid) {
                $('#shippingfromid' + trtmp + '').val(shippingfromid);
            }
            $('#shippingfromid' + trtmp + '').select2();
        }

        function OnErrorlistshippingfrom(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******Terms*******  */

    function listterms(trtmp, termsid = null) {

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
        formdata.append("action", "listterms");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistterms, OnErrorlistterms);

        function Onsuccesslistterms(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            // htmldata += '<option value="">Select Shipping From</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#termsid' + trtmp + '').html(htmldata);
            if (termsid) {
                $('#termsid' + trtmp + '').val(termsid.split(',')).trigger('change');
            }
            $('#termsid' + trtmp + '').select2();
        }

        function OnErrorlistterms(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }



    function listjewelrytype(jewelrytypeid = '', typestyleid = '') {

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
        formdata.append("action", "listjewelrytype");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistjewelrytype, OnErrorlistjewelrytype);

        function Onsuccesslistjewelrytype(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var filterhtmldata = '';
            var sidefilterhtmldata = '';
            htmldata += '<option value="">Select Jewellery Type</option>';
            $('.jewellerytypefilterDiv').addClass('d-none');
            $('.s_jewellerytypeDiv').addClass('d-none');
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.jewellerytypefilterDiv').removeClass('d-none');
                        $('.s_jewellerytypeDiv').removeClass('d-none');
                        for (var i in resultdata.data) {
                            htmldata += '<option class="jewlringsize' + resultdata.data[i].id + '" data-ringsize="' + resultdata.data[i].isringsize + '"  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            filterhtmldata += ' <div class="col-12 col-md-12 cut-group">';
                            filterhtmldata += '     <div class="form-check">';
                            filterhtmldata += '         <input class="form-check-input fltjewellerytypeid" type="checkbox" data-name="' + resultdata.data[i].name + '" value="' + resultdata.data[i].id + '" id="fltjewellerytypeid' + resultdata.data[i].id + '">';
                            filterhtmldata += '         <div class="jetype">';
                            filterhtmldata += '             <img src="' + resultdata.data[i].img + '" alt="' + resultdata.data[i].name + '" title="' + resultdata.data[i].name + '">';
                            filterhtmldata += '         </div>';
                            filterhtmldata += '         <label class="form-check-label ml-4" for="fltjewellerytypeid' + resultdata.data[i].id + '">';
                            filterhtmldata += '             ' + resultdata.data[i].name + '';
                            filterhtmldata += '         </label>';
                            filterhtmldata += '     </div>';
                            filterhtmldata += ' </div>';

                            sidefilterhtmldata += ' <div class="col-12 col-md-12 cut-group">';
                            sidefilterhtmldata += '     <div class="form-check">';
                            sidefilterhtmldata += '         <input class="form-check-input sidefltjewellerytypeid" type="checkbox" data-name="' + resultdata.data[i].name + '" value="' + resultdata.data[i].id + '" id="sidefltjewellerytypeid' + resultdata.data[i].id + '">';
                            sidefilterhtmldata += '         <label class="form-check-label ml-4" for="sidefltjewellerytypeid' + resultdata.data[i].id + '">';
                            sidefilterhtmldata += '             ' + resultdata.data[i].name + '';
                            sidefilterhtmldata += '         </label>';
                            sidefilterhtmldata += '     </div>';
                            sidefilterhtmldata += ' </div>';


                        }
                    }
                }

            }
            $('#jewellerytypeid').html(htmldata);
            $('#s_jewellerytypeDivData').html(sidefilterhtmldata);
            $('#jewellerytypefilterData').html(filterhtmldata);
            if (jewelrytypeid) {
                $('#jewellerytypeid').val(jewelrytypeid);
            }
            $('#jewellerytypeid').select2();
            listtypestyle(typestyleid, jewelrytypeid);
        }

        function OnErrorlistjewelrytype(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    $('#jewellerytypeid').on('change', function() {

        $('#ringsize').val("");
        var val = (this.value);

        var ringsize = $('.jewlringsize' + val + '').attr('data-ringsize');
        // alert(ringsize);
        if (ringsize == 1) {

            $('.ringsizeDiv').removeClass('d-none');
        } else {
            $('.ringsizeDiv').addClass('d-none');
        }


        listtypestyle('');
    });



    function listtypestyle(typestyleid = '', editjewelrytypeid = '') {

        var jewellerytypeid = $('#jewellerytypeid').val();
        if (editjewelrytypeid) {
            jewellerytypeid = editjewelrytypeid;
        }
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
        formdata.append("action", "listtypestyle");
        formdata.append("jewelrytypeid", jewellerytypeid);

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslisttypestyle, OnErrorlisttypestyle);

        function Onsuccesslisttypestyle(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            // htmldata += '<option value="">Select Type Style</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#typestyleid').html(htmldata);
            if (typestyleid) {
                $('#typestyleid').val(typestyleid.split(',')).trigger('change');
            }
            $('#typestyleid').select2();
        }

        function OnErrorlisttypestyle(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }


    function listjewelrycategory(jewelrycategoryid = null) {

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
        formdata.append("action", "listjewelrycategory");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistjewelrycategory, OnErrorlistjewelrycategory);

        function Onsuccesslistjewelrycategory(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var filterhtmldata = '';
            var sidefilterhtmldata = '';
            // htmldata += '<option value="">Select Jewellery Category</option>';
            $('.jewellerycategoryfilterDiv').addClass('d-none');
            $('.s_categoryDiv').addClass('d-none');
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.jewellerycategoryfilterDiv').removeClass('d-none');
                        $('.s_categoryDiv').removeClass('d-none');
                        for (var i in resultdata.data) {
                            htmldata += '<option  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            filterhtmldata += '<div class="col-12 col-md-12 cut-group">';
                            filterhtmldata += '    <div class="form-check">';
                            filterhtmldata += '        <input class="form-check-input fltjewellerycategoryid" data-name="' + resultdata.data[i].name + '" type="checkbox" value="' + resultdata.data[i].id + '" id="fltjewellerycategoryid' + resultdata.data[i].id + '">';
                            filterhtmldata += '        <label class="form-check-label ml-4" for="fltjewellerycategoryid' + resultdata.data[i].id + '">';
                            filterhtmldata += '            ' + resultdata.data[i].name + '';
                            filterhtmldata += '        </label>';
                            filterhtmldata += '    </div>';
                            filterhtmldata += '</div>';

                            sidefilterhtmldata += '<div class="col-12 col-md-12 cut-group">';
                            sidefilterhtmldata += '    <div class="form-check">';
                            sidefilterhtmldata += '        <input class="form-check-input sidefltjewellerycategoryid" data-name="' + resultdata.data[i].name + '" type="checkbox" value="' + resultdata.data[i].id + '" id="sidefltjewellerycategoryid' + resultdata.data[i].id + '">';
                            sidefilterhtmldata += '        <label class="form-check-label ml-4" for="sidefltjewellerycategoryid' + resultdata.data[i].id + '">';
                            sidefilterhtmldata += '            ' + resultdata.data[i].name + '';
                            sidefilterhtmldata += '        </label>';
                            sidefilterhtmldata += '    </div>';
                            sidefilterhtmldata += '</div>';

                        }
                    }
                }

            }
            $('#jewellerycategoryid').html(htmldata);
            $('#s_categoryDivData').html(sidefilterhtmldata);
            $('#jewellerycategoryfilterData').html(filterhtmldata);
            if (jewelrycategoryid) {
                $('#jewellerycategoryid').val(jewelrycategoryid.split(',')).trigger('change');
            }
            $('#jewellerycategoryid').select2();
        }

        function OnErrorlistjewelrycategory(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }


    function listcondition(conditionid = null) {

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
        formdata.append("action", "listcondition");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistcondition, OnErrorlistcondition);

        function Onsuccesslistcondition(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var filterhtmldata = '';
            htmldata += '<option value="">Select Condition</option>';
            $('.jewelleryconditionfilterDiv').addClass('d-none');
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.jewelleryconditionfilterDiv').removeClass('d-none');
                        for (var i in resultdata.data) {
                            htmldata += '<option  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            filterhtmldata += '<div class="col-12 col-md-12 cut-group">';
                            filterhtmldata += '    <div class="form-check">';
                            filterhtmldata += '        <input class="form-check-input fltjewelleryconditionid" data-name="' + resultdata.data[i].name + '" type="checkbox" value="' + resultdata.data[i].id + '" id="fltjewelleryconditionid' + resultdata.data[i].id + '">';
                            filterhtmldata += '        <label class="form-check-label ml-4" for="fltjewelleryconditionid' + resultdata.data[i].id + '">';
                            filterhtmldata += '            ' + resultdata.data[i].name + '';
                            filterhtmldata += '        </label>';
                            filterhtmldata += '    </div>';
                            filterhtmldata += '</div>';

                        }
                    }
                }

            }
            $('#conditionid').html(htmldata);
            $('#jewelleryconditionfilterData').html(filterhtmldata);
            if (conditionid) {
                $('#conditionid').val(conditionid);
            }
            $('#conditionid').select2();
        }

        function OnErrorlistcondition(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }


    function listbrand(brandid = null) {

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
        formdata.append("action", "listbrand");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistbrand, OnErrorlistbrand);

        function Onsuccesslistbrand(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var filterhtmldata = '';
            var sidefilterhtmldata = '';
            htmldata += '<option value="">Select Brand</option>';
            $('.jewellerybrandfilterDiv').addClass('d-none');
            $('.s_brandDiv').addClass('d-none');
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.jewellerybrandfilterDiv').removeClass('d-none');
                        $('.s_brandDiv').removeClass('d-none');
                        for (var i in resultdata.data) {
                            htmldata += '<option  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            filterhtmldata += '<div class="col-12 col-md-12 cut-group">';
                            filterhtmldata += '    <div class="form-check">';
                            filterhtmldata += '        <input class="form-check-input fltjewellerybrandid" data-name="' + resultdata.data[i].name + '" type="checkbox" value="' + resultdata.data[i].id + '" id="fltjewellerybrandid' + resultdata.data[i].id + '">';
                            filterhtmldata += '        <label class="form-check-label ml-4" for="fltjewellerybrandid' + resultdata.data[i].id + '">';
                            filterhtmldata += '            ' + resultdata.data[i].name + '';
                            filterhtmldata += '        </label>';
                            filterhtmldata += '    </div>';
                            filterhtmldata += '</div>';

                            sidefilterhtmldata += '<div class="col-12 col-md-12 cut-group">';
                            sidefilterhtmldata += '    <div class="form-check">';
                            sidefilterhtmldata += '        <input class="form-check-input sidefltjewellerybrandid" data-name="' + resultdata.data[i].name + '" type="checkbox" value="' + resultdata.data[i].id + '" id="sidefltjewellerybrandid' + resultdata.data[i].id + '">';
                            sidefilterhtmldata += '        <label class="form-check-label ml-4" for="sidefltjewellerybrandid' + resultdata.data[i].id + '">';
                            sidefilterhtmldata += '            ' + resultdata.data[i].name + '';
                            sidefilterhtmldata += '        </label>';
                            sidefilterhtmldata += '    </div>';
                            sidefilterhtmldata += '</div>';
                        }
                    }
                }

            }
            $('#brandid').html(htmldata);
            $('#jewellerybrandfilterData').html(filterhtmldata);
            $('#s_brandDivData').html(sidefilterhtmldata);
            if (brandid) {
                $('#brandid').val(brandid);
            }
            $('#brandid').select2();
        }

        function OnErrorlistbrand(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listjewelryquality(jewelryqualityid = null) {

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
        formdata.append("action", "listjewelryquality");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistjewelryquality, OnErrorlistjewelryquality);

        function Onsuccesslistjewelryquality(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var filterhtmldata = '';
            var sidefilterhtmldata = '';
            // htmldata += '<option value="">Select Jewellery Category</option>';
            $('.jewelleryqualityfilterDiv').addClass('d-none');
            $('.s_qualityDiv').addClass('d-none');
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.jewelleryqualityfilterDiv').removeClass('d-none');
                        $('.s_qualityDiv').removeClass('d-none');
                        for (var i in resultdata.data) {
                            htmldata += '<option  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            filterhtmldata += '<div class="col-12 col-md-12 cut-group">';
                            filterhtmldata += '    <div class="form-check">';
                            filterhtmldata += '        <input class="form-check-input fltjewelleryqualityid" data-name="' + resultdata.data[i].name + '" type="checkbox" value="' + resultdata.data[i].id + '" id="fltjewelleryqualityid' + resultdata.data[i].id + '">';
                            filterhtmldata += '        <label class="form-check-label ml-4" for="fltjewelleryqualityid' + resultdata.data[i].id + '">';
                            filterhtmldata += '            ' + resultdata.data[i].name + '';
                            filterhtmldata += '        </label>';
                            filterhtmldata += '    </div>';
                            filterhtmldata += '</div>';

                            sidefilterhtmldata += '<div class="col-12 col-md-12 cut-group">';
                            sidefilterhtmldata += '    <div class="form-check">';
                            sidefilterhtmldata += '        <input class="form-check-input sidefltjewelleryqualityid" data-name="' + resultdata.data[i].name + '" type="checkbox" value="' + resultdata.data[i].id + '" id="sidefltjewelleryqualityid' + resultdata.data[i].id + '">';
                            sidefilterhtmldata += '        <label class="form-check-label ml-4" for="sidefltjewelleryqualityid' + resultdata.data[i].id + '">';
                            sidefilterhtmldata += '            ' + resultdata.data[i].name + '';
                            sidefilterhtmldata += '        </label>';
                            sidefilterhtmldata += '    </div>';
                            sidefilterhtmldata += '</div>';

                        }
                    }
                }

            }
            $('#jewelleryqualityfilterData').html(filterhtmldata);
            $('#s_qualityDivData').html(sidefilterhtmldata);
            $('#jewelleryqualityid').html(htmldata);
            if (jewelryqualityid) {
                $('#jewelleryqualityid').val(jewelryqualityid.split(',')).trigger('change');
            }
            $('#jewelleryqualityid').select2();
        }

        function OnErrorlistjewelryquality(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function fillgemstonehtml() {
        var trtmp = $('#form-jewellery-upload .gemstoneDiv .gemstoneDataDiv:last').attr('data-index') | 0;
        trtmp = parseInt(trtmp + 1);

        var trtmp_row = parseInt(trtmp - 1);

        var html = '';
        html += '<div class="setcolorjwset gemstoneDataDiv mt-3" data-index="' + trtmp + '">';
        html += '<div class="row setptopjw">';

        html += '<div class="col-lg-4 col-md-4">';
        html += '<div class="row">';
        html += '<div class="col-lg-12 ctupsearch">';
        html += '<div class="form-group">';
        html += '<label for="gemstonetypeid' + trtmp + '" class="col-form-label">Gemstone Type</label>';
        html += '<select id="gemstonetypeid' + trtmp + '" name="gemstonetypeid[]" class="form-control select2">';

        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-lg-4 col-md-4">';
        html += '<div class="row">';
        html += '<div class="col-lg-12 ctupsearch">';
        html += '<div class="form-group">';
        html += '<label for="shapeid' + trtmp + '" class="col-form-label">Shape</label>';
        html += '<select id="shapeid' + trtmp + '" name="shapeid[]" class="form-control select2">';

        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-lg-4 col-md-4">';
        html += '<div class="row">';
        html += '<div class="col-lg-12 ctupsearch">';
        html += '<div class="form-group">';
        html += '<label for="caratweight' + trtmp + '" class="col-form-label">Carat Weight</label>';
        html += '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter" id="caratweight' + trtmp + '" name="caratweight[]">';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        html += '</div>';
        html += '<div class="row setptopjw">';
        html += '<div class="col-lg-4 col-md-4">';
        html += '<div class="row">';
        html += '<div class="col-lg-12 ctupsearch">';
        html += '<div class="form-group">';
        html += '<label for="labid' + trtmp + '" class="col-form-label">Lab</label>';
        html += '<select id="labid' + trtmp + '" name="labid[]" class="form-control select2">';

        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-lg-4 col-md-4">';
        html += '<div class="row">';
        html += '<div class="col-lg-12 ctupsearch">';
        html += '<div class="form-group">';
        html += '<label for="labtext' + trtmp + '" class="col-form-label">Lab#</label>';
        html += '<input type="text" class="form-control" autocomplete="off" placeholder="Enter" id="labtext' + trtmp + '" name="labtext[]">';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        // html+='<div class="col-lg-4 col-md-4">';
        // html+='<div class="row">';
        // html+='<div class="col-lg-12 ctupsearch">';

        // html+='<div class="form-check">';
        // html+='<input class="form-check-input" type="radio" value="1" name="hastreatment[]" id="yestreatment'+trtmp+'"  checked="">';
        // html+='<label class="form-check-label" for="yestreatment'+trtmp+'">';
        // html+='Yes';
        // html+='</label>';
        // html+='</div>';

        // html+='<div class="form-check">';
        // html+='<input class="form-check-input" type="radio" value="0" name="hastreatment[]" id="notreatment'+trtmp+'">';
        // html+='<label class="form-check-label" for="notreatment'+trtmp+'">';
        // html+='No';
        // html+='</label>';
        // html+='</div>';

        // html+='</div>';
        // html+='</div>';
        // html+='</div>';
        html += '<div class="col-lg-4 col-md-4">';
        html += '<div class="row">';

        html += '<div class="col-lg-12 ctupsearch">';
        html += '<div class="form-group">';
        html += '<label for="treatmentid' + trtmp + '" class="col-form-label">Tretment</label>';
        html += '<select id="treatmentid' + trtmp + '" multiple name="treatmentid' + trtmp_row + '[]" class="form-control select2">';

        html += '</select>';
        html += '</div>';
        html += '</div>';

        html += '</div>';
        html += '</div>';

        html += '</div>';
        html += '<div class="row setptopjw">';

        html += '<div class="col-lg-4 col-md-4">';
        html += '<div class="row">';
        html += '<div class="col-lg-12 ctupsearch">';
        html += '<div class="form-group">';
        html += '<label for="stone' + trtmp + '" class="col-form-label"># Stone</label>';
        html += '<input type="text" class="form-control" autocomplete="off" placeholder="Enter" id="stone' + trtmp + '" name="stone[]">';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        // html += '<div class="col-lg-4 col-md-4">';
        // html += '<div class="row">';
        // html += '<div class="col-lg-12 ctupsearch">';
        // html += '<div class="form-group">';
        // html += '<label for="savanilot' + trtmp + '" class="col-form-label">Lot No#</label>';
        // html += '<input type="text" class="form-control" autocomplete="off" placeholder="Enter" id="savanilot' + trtmp + '" name="savanilot[]">';
        // html += '</div>';
        // html += '</div>';
        // html += '</div>';
        // html += '</div>';
        html += '</div>';
        html += '</div>';
        $('#form-jewellery-upload .gemstoneDiv').append(html);
        $('.select2').select2();
        listgemstonetype(trtmp, '');
        listshape(trtmp, '');
        listlab(trtmp, '');
        listtreatment(trtmp, '');
        checklastgemstonehtml();
    }
    $('body').on('click', '.btnremovegemstoneDiv', function() {
        var trtmp = $('#form-jewellery-upload .gemstoneDiv .gemstoneDataDiv:last').attr('data-index') | 0;
        if (trtmp > 1) {
            $('#form-jewellery-upload .gemstoneDiv > div').last().remove();

        }
        checklastgemstonehtml();
    });

    function checklastgemstonehtml() {
        var trtmp = $('#form-jewellery-upload .gemstoneDiv .gemstoneDataDiv:last').attr('data-index') | 0;
        if (trtmp > 1) {
            $('.btnremovegemstoneDiv').removeClass('d-none');
        } else {
            $('.btnremovegemstoneDiv').addClass('d-none');
        }
    }


    function listmetaltype(metaltypeid = null) {

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
        formdata.append("action", "listmetaltype");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistmetaltype, OnErrorlistmetaltype);

        function Onsuccesslistmetaltype(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var filterhtmldata = '';
            // htmldata += '<option value="">Select Jewellery Category</option>';
            $('.jewellerymetaltypefilterDiv').addClass('d-none');
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.jewellerymetaltypefilterDiv').removeClass('d-none');
                        for (var i in resultdata.data) {
                            htmldata += '<option  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            filterhtmldata += '<div class="col-12 col-md-12 cut-group">';
                            filterhtmldata += '    <div class="form-check">';
                            filterhtmldata += '        <input class="form-check-input fltjewellerymetaltypeid" data-name="' + resultdata.data[i].name + '" type="checkbox" value="' + resultdata.data[i].id + '" id="fltjewellerymetaltypeid' + resultdata.data[i].id + '">';
                            filterhtmldata += '        <label class="form-check-label ml-4" for="fltjewellerymetaltypeid' + resultdata.data[i].id + '">';
                            filterhtmldata += '            ' + resultdata.data[i].name + '';
                            filterhtmldata += '        </label>';
                            filterhtmldata += '    </div>';
                            filterhtmldata += '</div>';

                        }
                    }
                }

            }
            $('#metaltypeid').html(htmldata);
            $('#jewellerymetaltypefilterData').html(filterhtmldata);
            if (metaltypeid) {
                $('#metaltypeid').val(metaltypeid.split(',')).trigger('change');
            }
            $('#metaltypeid').select2();
        }

        function OnErrorlistmetaltype(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listmetalcarat(metalkaratid = null) {

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
        formdata.append("action", "listmetalcarat");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistmetalcarat, OnErrorlistmetalcarat);

        function Onsuccesslistmetalcarat(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var filterhtmldata = '';
            $('.jewellerymetalktfilterDiv').addClass('d-none');
            // htmldata += '<option value="">Select Jewellery Category</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.jewellerymetalktfilterDiv').removeClass('d-none');
                        for (var i in resultdata.data) {
                            htmldata += '<option  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            filterhtmldata += '<div class="col-12 col-md-12 cut-group">';
                            filterhtmldata += '    <div class="form-check">';
                            filterhtmldata += '        <input class="form-check-input fltjewellerymetalktid" data-name="' + resultdata.data[i].name + '" type="checkbox" value="' + resultdata.data[i].id + '" id="fltjewellerymetalktid' + resultdata.data[i].id + '">';
                            filterhtmldata += '        <label class="form-check-label ml-4" for="fltjewellerymetalktid' + resultdata.data[i].id + '">';
                            filterhtmldata += '            ' + resultdata.data[i].name + '';
                            filterhtmldata += '        </label>';
                            filterhtmldata += '    </div>';
                            filterhtmldata += '</div>';
                        }
                    }
                }

            }
            $('#metalkaratid').html(htmldata);
            $('#jewellerymetalktfilterData').html(filterhtmldata);
            if (metalkaratid) {
                $('#metalkaratid').val(metalkaratid.split(',')).trigger('change');
            }
            $('#metalkaratid').select2();
        }

        function OnErrorlistmetalcarat(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }


    /* ******Gems Stone Type*******  */
    function listgemstonetype(trtmp, gemstonetypeid = null) {

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
        formdata.append("action", "listgemstonetype");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistgemstonetype, OnErrorlistgemstonetype);

        function Onsuccesslistgemstonetype(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var filterhtmldata = '';
            htmldata += '<option value="">Select Gemstone Type</option>';
            $('.jewellerygemstonetypefilterDiv').addClass('d-none');
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.jewellerygemstonetypefilterDiv').removeClass('d-none');
                        for (var i in resultdata.data) {
                            htmldata += '<option  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            filterhtmldata += '<div class="col-12 col-md-12 cut-group">';
                            filterhtmldata += '    <div class="form-check">';
                            filterhtmldata += '        <input class="form-check-input fltjewellerygemstonetypeid" data-name="' + resultdata.data[i].name + '" type="checkbox" value="' + resultdata.data[i].id + '" id="fltjewellerygemstonetypeid' + resultdata.data[i].id + '">';
                            filterhtmldata += '        <label class="form-check-label ml-4" for="fltjewellerygemstonetypeid' + resultdata.data[i].id + '">';
                            filterhtmldata += '            ' + resultdata.data[i].name + '';
                            filterhtmldata += '        </label>';
                            filterhtmldata += '    </div>';
                            filterhtmldata += '</div>';
                        }
                    }
                }

            }
            $('#gemstonetypeid' + trtmp + '').html(htmldata);
            $('#jewellerygemstonetypefilterData').html(filterhtmldata);
            if (gemstonetypeid) {
                $('#gemstonetypeid' + trtmp + '').val(gemstonetypeid);
            }
            $('#gemstonetypeid' + trtmp + '').select2();
        }

        function OnErrorlistgemstonetype(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    /* ******Shape*******  */
    function listshape(trtmp, shapeid = null) {

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
        formdata.append("action", "listshape");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistshape, OnErrorlistshape);

        function Onsuccesslistshape(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var filterhtmldata = '';
            var sidefilterhtmldata = '';
            htmldata += '<option value="">Select Shape</option>';
            $('.shapefilterDiv').addClass('d-none');
            $('.jewellerygemstoneshapefilterDiv').addClass('d-none');
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.shapefilterDiv').removeClass('d-none');
                        $('.jewellerygemstoneshapefilterDiv').removeClass('d-none');
                        for (var i in resultdata.data) {
                            htmldata += '<option  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            filterhtmldata += '   <div class="filter custom-checkbox">';
                            filterhtmldata += '       <input type="checkbox" id="fltshapeid' + resultdata.data[i].id + '" data-name="' + resultdata.data[i].name + '" class="dashboard-control custom-control-input fltshapeid" name="fltshapeid[]" value="' + resultdata.data[i].id + '">';
                            filterhtmldata += '       <label for="fltshapeid' + resultdata.data[i].id + '" class="custom-control-label with-img">';
                            filterhtmldata += '           <span class="img-wrap"><img src="<?php echo $config->getImageurl(); ?>' + resultdata.data[i].img + '" alt="' + resultdata.data[i].name + '" class="img-responsive"></span>';
                            filterhtmldata += '           <span class="text-label">' + resultdata.data[i].name + '</span>';
                            filterhtmldata += '       </label>';
                            filterhtmldata += '   </div>';

                            sidefilterhtmldata += '<div class="col-12 col-md-12 cut-group">';
                            sidefilterhtmldata += '    <div class="form-check">';
                            sidefilterhtmldata += '        <input class="form-check-input fltjewellerygemstoneshapeid" data-name="' + resultdata.data[i].name + '" type="checkbox" value="' + resultdata.data[i].id + '" id="fltjewellerygemstoneshapeid' + resultdata.data[i].id + '">';
                            sidefilterhtmldata += '         <div class="jetype">';
                            sidefilterhtmldata += '             <img src="<?php echo $config->getImageurl(); ?>' + resultdata.data[i].img + '" alt="' + resultdata.data[i].name + '" title="' + resultdata.data[i].name + '">';
                            sidefilterhtmldata += '         </div>';
                            sidefilterhtmldata += '        <label class="form-check-label ml-4" for="fltjewellerygemstoneshapeid' + resultdata.data[i].id + '">';
                            sidefilterhtmldata += '            ' + resultdata.data[i].name + '';
                            sidefilterhtmldata += '        </label>';
                            sidefilterhtmldata += '    </div>';
                            sidefilterhtmldata += '</div>';



                        }
                    }
                }

            }
            $('.shapefilterDiv #shapefilterData').html(filterhtmldata);
            $('#jewellerygemstoneshapefilterData').html(sidefilterhtmldata);
            $('#shapeid' + trtmp + '').html(htmldata);
            if (shapeid) {
                $('#shapeid' + trtmp + '').val(shapeid);
            }
            $('#shapeid' + trtmp + '').select2();
        }

        function OnErrorlistshape(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    /* ******Lab*******  */
    function listlab(trtmp, labid = null) {

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
            var filterhtmldata = '';
            htmldata += '<option value="">Select Lab</option>';
            $('.jewellerylabreportfilterDiv').addClass('d-none');
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.jewellerylabreportfilterDiv').removeClass('d-none');
                        for (var i in resultdata.data) {
                            htmldata += '<option  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            filterhtmldata += '<div class="col-12 col-md-12 cut-group">';
                            filterhtmldata += '    <div class="form-check">';
                            filterhtmldata += '        <input class="form-check-input fltjewellerygemstonelabid" data-name="' + resultdata.data[i].name + '" type="checkbox" value="' + resultdata.data[i].id + '" id="fltjewellerygemstonelabid' + resultdata.data[i].id + '">';
                            filterhtmldata += '        <label class="form-check-label ml-4" for="fltjewellerygemstonelabid' + resultdata.data[i].id + '">';
                            filterhtmldata += '            ' + resultdata.data[i].name + '';
                            filterhtmldata += '        </label>';
                            filterhtmldata += '    </div>';
                            filterhtmldata += '</div>';

                        }
                    }
                }

            }
            $('#labid' + trtmp + '').html(htmldata);
            $('#jewellerylabreportfilterData').html(filterhtmldata);
            if (labid) {
                $('#labid' + trtmp + '').val(labid);
            }
            $('#labid' + trtmp + '').select2();
        }

        function OnErrorlistlab(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listtreatment(trtmp, treatmentid = null) {

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
        formdata.append("action", "listtreatment");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslisttreatment, OnErrorlisttreatment);

        function Onsuccesslisttreatment(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var filterhtmldata = '';
            // htmldata += '<option value="">Select Jewellery Category</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            filterhtmldata += '<div class="col-12 col-md-12 cut-group">';
                            filterhtmldata += '    <div class="form-check">';
                            filterhtmldata += '        <input class="form-check-input fltjewellerygemstonetreatmentid" data-name="' + resultdata.data[i].name + '" type="checkbox" value="' + resultdata.data[i].id + '" id="fltjewellerygemstonetreatmentid' + resultdata.data[i].id + '">';
                            filterhtmldata += '        <label class="form-check-label ml-4" for="fltjewellerygemstonetreatmentid' + resultdata.data[i].id + '">';
                            filterhtmldata += '            ' + resultdata.data[i].name + '';
                            filterhtmldata += '        </label>';
                            filterhtmldata += '    </div>';
                            filterhtmldata += '</div>';

                        }
                    }
                }

            }
            $('#treatmentid' + trtmp + '').html(htmldata);
            $('#jewellerygemstonetreatmentfilterData').html(filterhtmldata);
            if (treatmentid) {
                $('#treatmentid' + trtmp + '').val(treatmentid.split(',')).trigger('change');
            }
            $('#treatmentid' + trtmp + '').select2();
        }

        function OnErrorlisttreatment(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }


    function resetjewelleryuploadform() {
        $("#form-jewellery-upload").validate().resetForm();
        $('#form-jewellery-upload').trigger("reset");
        $('#form-jewellery-upload .select2').select2();
        $('#form-jewellery-upload #formevent').val('submit');
        $('.jewelleryuploadesirmodetext').html('Upload');
        $('#form-jewellery-upload #id').val('');
        $('#form-jewellery-upload #btnsavejewellery').html('Save');
        $('.uploadjewellerytabs li').attr('disabled', true);
        $('.uploadjewellerytabs li').addClass('disabled');
        $('.uploadjewellerytabs li a').addClass('disabled');
        $('.uploadjewellerytabs li a').attr('disabled', true);
        openprvioustab('generalinfoDiv');
        $('#form-jewellery-upload .priceandlocationDiv').html('');
        $('#form-jewellery-upload .gemstoneDiv').html('');
        fillgemstonehtml();
        fillpriceloactionhtml();
    }
    $('#btnresetjewelleryupload').on('click', function() {
        resetjewelleryuploadform();
    });




    function openprvioustab(prevtab) {
        // //console.log(prevtab);
        $('.uploadjewellerytabs .li' + prevtab).addClass('active');
        $('.uploadjewellerytabs .li' + prevtab + ' a').click();
        var type = $('.uploadjewellerytabs .li' + prevtab).attr('data-tab');

        $('.uploadjewellerytabs .li' + prevtab).attr('disabled', false);
        $('.uploadjewellerytabs .li' + prevtab).removeClass('disabled');
        $('.uploadjewellerytabs .li' + prevtab + ' a').removeClass('disabled');
        $('.uploadjewellerytabs .li' + prevtab + ' a').attr('disabled', false);
        if (type == 1) {
            $('.uploadjewellerytabs .liuploadimgDiv').removeClass('active');
            $('.uploadjewellerytabs .liuploadimgDiv a').removeClass('active');

        } else if (type == 2) {

        }
    }

    $('.btnprevjewelleryuploadform').click(function() {
        var prevtab = $(this).attr('data-prev-tab');
        openprvioustab(prevtab);
    });

    function checkgeneralinfofields() {
        var itemtitle = $('#itemtitle').val();
        var stock = $('#stock').val();
        var jewellerytypeid = $('#jewellerytypeid').val();
        var isvalid = 0;
        if (itemtitle && stock && jewellerytypeid) {
            isvalid = 1;
        }
        return isvalid;
    }

    $('#btngeneralinfo').click(function() {
        var isvalid = checkgeneralinfofields();
        //console.log(isvalid);
        if (isvalid == 1) {
            opennexttab('uploadimgDiv');
        } else {

            opennexttab('generalinfoDiv');
            Notiflix.Notify.Failure('Please fill all required fields');
        }
    });

    function opennexttab(nexttab) {


        var type = $('.uploadjewellerytabs .li' + nexttab).attr('data-tab');
        $("#nav-tabContent-JewelleryUploadFormDiv .tab-pane").each(function() {
            $(this).removeClass('active');
        });

        $('.uploadjewellerytabs .li' + nexttab).attr('disabled', false);
        $('.uploadjewellerytabs .li' + nexttab).removeClass('disabled');
        $('.uploadjewellerytabs .li' + nexttab + ' a').removeClass('disabled');
        $('.uploadjewellerytabs .li' + nexttab + ' a').attr('disabled', false);

        if (type == 1) {
            $('.uploadjewellerytabs .ligeneralinfoDiv').addClass('active');
            $('.uploadjewellerytabs .ligeneralinfoDiv a').addClass('active');
            $('#nav-tabContent-JewelleryUploadFormDiv #generalinfoDiv').addClass('active');

        } else if (type == 2) {
            $('.uploadjewellerytabs .ligeneralinfoDiv').addClass('active');
            $('.uploadjewellerytabs .ligeneralinfoDiv a').addClass('active');

            $('.uploadjewellerytabs .liuploadimgDiv').addClass('active');
            $('.uploadjewellerytabs .liuploadimgDiv a').addClass('active');

            $('#nav-tabContent-JewelleryUploadFormDiv #uploadimgDiv').addClass('active');
        }

    }


    $('.uploadjewellerytabs li a').click(function() {
        $('.uploadjewellerytabs li').removeClass('active');
        $('.uploadjewellerytabs li a').removeClass('active');
        var nexttab = $(this).attr('data-typename');
        opennexttab(nexttab);
    });



    /* UPLOAD JEWELLERY DATA */

    if ($('#form-jewellery-upload').length) {
        $('#form-jewellery-upload').validate({
            rules: {
                itemtitle: {
                    required: true
                },
                stock: {
                    required: true,
                },
                jewellerytypeid: {
                    required: true,
                },
                description: {
                    required: true,
                }
            },
            messages: {
                itemtitle: {
                    required: 'Item Title is required',
                },
                stock: {
                    required: 'Stock is required',
                },
                jewellerytypeid: {
                    required: 'Jewellery Type is required',
                },
                description: {
                    required: 'Description is required',
                },
            },
            submitHandler: function(form) {

                // showloader();
                var pagename = getpagename();
                var useraction = $('#formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "uploadjewellery");
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 4,
                    userpagename: pagename,
                    useraction: useraction,
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>jewellery', formdata, headersdata, Onsuccessuploadjewellery, OnErroruploadjewellery)

                function Onsuccessuploadjewellery(data) {
                    // hideloader();
                    $('.chart-loading').hide();
                    var JsonData = JSON.stringify(data);
                    var resultdata = jQuery.parseJSON(JsonData);
                    if (resultdata.IsPackageExpire == 1) {
                        Notiflix.Report.Warning(resultdata.ExpiryTitle, resultdata.message, false, function() {
                            window.location = resultdata.ExpiryURL;
                        });
                    } else {
                        if (resultdata.status == 0) {
                            Notiflix.Notify.Failure(resultdata.message);
                        } else if (resultdata.status == 1) {
                            Notiflix.Notify.Success(resultdata.message);
                            // $('.searchmydiamondlistDiv').html('');
                            // checkmydiamondformelementvalue();
                            // $('#listmydiamondDatatbl').attr('data-nextpage', 0);
                            // $('#v-pills-3-tab').click();
                            $('.searchmyjewellerylistDiv').html('');
                            $('#listmyjewelleryDatatbl').attr('data-nextpage', 0);
                            $('#managemyJwelery-tab').click();
                            resetjewelleryuploadform();

                        } else if (resultdata.status == -1) {
                            $('#btnlogout').trigger('click');
                        }
                    }

                }

                function OnErroruploadjewellery(content) {

                }


            },
        });
    }


    $('body').on('change', '#sortbyid', function() {
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });

    $('body').on('change', '#jewellery_per_page', function() {
        $('#listjewelleryData').attr('data-nextpage', 0);
        $("#listjewelleryData").animate({
            scrollTop: 0
        }, "slow");
        listjewellerydata(1);
    });

    function listjewellerydata(page) {

        // showloader();
        $('.chart-loading').show();
        // $('.acr-preloader').show();

        var pagename = getpagename();
        var useraction = $('#formevent').val();
        var sortbyid = $('#sortbyid').val();
        var fltsearch = $('#fltsearch').val();


        var minprice = $('#minprice').val();
        var maxprice = $('#maxprice').val();

        var showmyfavorite = 0;
        if ($('#canshowmyfavorite').prop('checked') === true) {
            showmyfavorite = 1;
        }

        var jewellery_per_page = $('#jewellery_per_page').val();
        var nextpage = 0;
        if ($('#listjewelleryData').attr('data-nextpage') > 0) {
            nextpage = $('#listjewelleryData').attr('data-nextpage');
        }
        var formdata = new FormData();
        var id = '<?php echo $id; ?>';
        if (id) {
            formdata.append("id", id);
            nextpage = 0;
        }
        listfilterdata();
        formdata.append("action", "listjewellery");
        formdata.append("nextpage", parseInt(nextpage) + 1);
        formdata.append("fltmanagemyjewellery", 0);
        formdata.append("perpage", jewellery_per_page);
        formdata.append("sortbyid", sortbyid);
        formdata.append("showmyfavorite", showmyfavorite);
        formdata.append("fltjewllerytypeid", fltjewllerytypeid);
        formdata.append("fltmetaltypeid", fltmetaltypeid);
        formdata.append("fltgemstonetypeid", fltgemstonetypeid);
        formdata.append("fltconditionid", fltconditionid);
        formdata.append("fltmetalktid", fltmetalktid);
        formdata.append("fltjewlleryqualityid", fltjewlleryqualityid);
        formdata.append("fltjewllerycategoryid", fltjewllerycategoryid);
        formdata.append("fltjewlleryshapeid", fltjewlleryshapeid);
        formdata.append("fltgemstonetreatmentid", fltgemstonetreatmentid);
        formdata.append("fltlabid", fltlabid);
        formdata.append("fltbrandid", fltbrandid);
        var fltavailable = 0;
        if ($('#fltavailable').prop('checked') == true) {
            fltavailable = 1;
        }

        var fltavailableformemo = 0;
        if ($('#fltavailableformemo').prop('checked') == true) {
            fltavailableformemo = 1;
        }

        formdata.append("fltavailable", fltavailable);
        formdata.append("fltavailableformemo", fltavailableformemo);
        formdata.append("fltshippingfromid", fltshippingfromid);
        formdata.append("fltsearch", fltsearch);

        formdata.append("fromprice", minprice);
        formdata.append("toprice", maxprice);

        var headersdata = {
            'Accept': 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: useraction,
            masterlisting: false
        };
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>jewellery', formdata, headersdata, Onsuccesslistjewellerydata, OnErrorlistjewellerydata)

        function Onsuccesslistjewellerydata(data) {
            // hideloader();

            // $('.acr-preloader').delay(500).fadeOut(500);
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);





            var htmldata = '';
            if (resultdata.IsPackageExpire == 1) {
                Notiflix.Report.Warning(resultdata.ExpiryTitle, resultdata.message, false, function() {
                    window.location = resultdata.ExpiryURL;
                });
            } else {
                if (resultdata.status == 0) {

                    htmldata += '<div class="offset-4 col-lg-4">';
                    htmldata += '<h3 class="text-center">' + resultdata.message + '</h3>';
                    htmldata += '</div>';

                    $('#listjewelleryData').html(htmldata);
                    $('#showjewelleryentries').html(0);

                    $('.totaljewellerys').html('0 Items');



                } else if (resultdata.status == 1) {
                    if (resultdata.totaljewellery >= 0 && resultdata.totaljewellery != null) {
                        // //console.log('totaldiamond'+resultdata.totaldiamond);
                        // //console.log('totalprice'+resultdata.totalprice);
                        $('.totaljewellerys').html(resultdata.totaljewellery + ' Items');
                    }

                    htmldata += '<div class="all-product-item ">';
                    for (var i in resultdata.data) {
                        var jewellerydata = resultdata.data[i];


                        htmldata += '<div class="item">';
                        htmldata += '    <div class="product-image">';
                        htmldata += '        <div class="starje">';

                        if (jewellerydata.ismyfavoriteitem == 1) {
                            htmldata += '<a href="javascript:void(0);" data-jewellerytitle="' + jewellerydata.itemtitle + '" data-jewelleryid="' + jewellerydata.id + '" data-ismyfavoriteitem="' + jewellerydata.ismyfavoriteitem + '" class="pull-right myfavoriteitem' + jewellerydata.id + ' addtomyfavorite"><i class="fas fa-heart clsaddtomyfavorite"></i></a>';
                        } else {
                            htmldata += '<a href="javascript:void(0);" data-jewellerytitle="' + jewellerydata.itemtitle + '" data-jewelleryid="' + jewellerydata.id + '" data-ismyfavoriteitem="' + jewellerydata.ismyfavoriteitem + '" class="pull-right addtomyfavorite myfavoriteitem' + jewellerydata.id + '"><i class="far fa-heart clsaddtomyfavorite"></i></a>';
                        }

                        htmldata += '        </div>';
                        htmldata += '        <a href="javascript:void(0);" data-jewelleryid="' + jewellerydata.id + '" class="product-img showjewellerydetails">';
                        htmldata += '            <img class="primary blur-up lazyloaded" src="' + jewellerydata.imgurl + '" alt="' + jewellerydata.itemtitle + '" title="' + jewellerydata.itemtitle + '">';
                        htmldata += '        </a>';
                        // htmldata += '        <div class="starje">';
                        // htmldata += '            <span class="fa fa-star">';
                        // htmldata += '                <a href="javascript:void(0);">Add To Favorite</a>';
                        // htmldata += '            </span>';
                        // htmldata += '        </div>';
                        htmldata += '    </div>';
                        htmldata += '    <div class="product-details">';
                        htmldata += '        <div class="row prodesje">';
                        htmldata += '            <div class="text-left">';
                        htmldata += '                <div class="serjew">';
                        htmldata += '                    ' + jewellerydata.stock + '';
                        htmldata += '                </div>';
                        htmldata += '            </div>';
                        // htmldata += '            <div class="text-right prosetm">';
                        // htmldata += '                <button class="ringbtnset">';
                        // htmldata += '                    ' + jewellerydata.jewellerytype + '';
                        // htmldata += '                </button>';
                        // htmldata += '            </div>';
                        htmldata += '        </div>';
                        htmldata += '        <div class="product-name text-uppercase">';
                        htmldata += '            <a href="javascript:void(0);" data-jewelleryid="' + jewellerydata.id + '" class="showjewellerydetails">' + jewellerydata.itemtitle + '</a>';
                        htmldata += '        </div>';
                        htmldata += '        <div class="product-price">';
                        htmldata += '            <span class="price">$' + jewellerydata.minprice + '</span>';
                        htmldata += '                <div class="text-right prosetm">';
                        htmldata += '                <button class="ringbtnset">';
                        htmldata += '                    ' + jewellerydata.jewellerytype + '';
                        htmldata += '                </button>';
                        htmldata += '                </div>';

                        // htmldata += '            <input type="checkbox" class="pull-right chkjewellery" name="jewelleryid[]" id="jewelleryid' + jewellerydata.id + '" value="' + jewellerydata.id + '">';
                        htmldata += '        </div>';
                        htmldata += '        <div class="nameofholder">';
                        htmldata += '            <h4>' + jewellerydata.personname + '</h4>';
                        htmldata += '            <span>' + jewellerydata.cityname + ',' + jewellerydata.statename + ',' + jewellerydata.countryname + '</span>';
                        htmldata += '        </div>';
                        htmldata += '    </div>';
                        htmldata += '</div>';





                    }
                    htmldata += '</div>';

                    // $('.listjewelleryDataDiv #listjewelleryData').html(htmldata);
                    if (resultdata.nextpage == 1) {
                        $('#listjewelleryData').html(htmldata);
                    } else {
                        $('#listjewelleryData').append(htmldata);
                    }
                    $('#showjewelleryentries').html(resultdata.showentries);
                    $('#listjewelleryData').attr('data-nextpage', resultdata.nextpage);
                    if (resultdata.loadmore == 1) {
                        $('#listjewelleryData').attr('data-show', 1);
                    } else {
                        $('#listjewelleryData').attr('data-show', 0);
                    }


                } else if (resultdata.status == -1) {
                    $('#btnlogout').trigger('click');
                }
            }
            $('.chart-loading').hide();

        }

        function OnErrorlistjewellerydata(content) {

        }

    }


    function getitenminmaxprice() {
        var pagename = getpagename();
        var useraction = $('#formevent').val();

        var formdata = new FormData();
        formdata.append("action", "getitenminmaxprice");

        var headersdata = {
            'Accept': 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: useraction,
            masterlisting: false
        };
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>jewellery', formdata, headersdata, Onsuccessgetitenminmaxprice, OnErrorgetitenminmaxprice)

        function Onsuccessgetitenminmaxprice(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $("#slider-range").slider({
                range: true,
                min: Math.round(resultdata.minprice),
                max: Math.round(resultdata.maxprice),
                values: [Math.round(resultdata.minprice), Math.round(resultdata.maxprice)],
                slide: function(event, ui) {
                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                },
                change: function(event, ui) {
                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                    $('#minprice').val(ui.values[0]);
                    $('#maxprice').val(ui.values[1]);
                    $('#listjewelleryData').attr('data-nextpage', 0);
                    listjewellerydata(1);
                }
            });
            $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));


            $("#side-slider-range").slider({
                range: true,
                min: Math.round(resultdata.minprice),
                max: Math.round(resultdata.maxprice),
                values: [Math.round(resultdata.minprice), Math.round(resultdata.maxprice)],
                slide: function(event, ui) {
                    $("#sideamount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                },
                change: function(event, ui) {
                    $("#sideamount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                    $('#sideminprice').val(ui.values[0]);
                    $('#sidemaxprice').val(ui.values[1]);
                    $('#listmyjewelleryDatatbl').attr('data-nextpage', 0);
                    listmyjewellerydata(1);
                }
            });
            $("#sideamount").val("$" + $("#side-slider-range").slider("values", 0) + " - $" + $("#side-slider-range").slider("values", 1));

            if (resultdata.status == -1) {
                $('#btnlogout').trigger('click');
            }
        }

        function OnErrorgetitenminmaxprice(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }




    $('#listjewelleryData').scroll(function() {
        //  alert();
        // //console.log('scrollTop:' + $(this).scrollTop());
        // //console.log('innerHeight:' + $(this).innerHeight());
        // //console.log('scrollHeight:' + $(this)[0].scrollHeight);
        // 
        if ($(this).scrollTop() +
            $(this).innerHeight() >=
            $(this)[0].scrollHeight) {
            // //console.log('Here');
            var dataact = getpagename();
            var show = $('#listjewelleryData').attr('data-show');
            // //console.log('dataact:' + dataact);
            // //console.log('show:' + show);
            if (dataact && show == 1) {
                listjewellerydata(1);
            }
        }
    });




    function listsortby() {

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
        formdata.append("action", "listjewellerysortby");
        formdata.append("isweb", 1);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistjewellerysortby, OnErrorlistjewellerysortby);

        function Onsuccesslistjewellerysortby(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            htmldata += '<option value="">Select Sort By</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#sortbyid').html(htmldata);
            $('#myjewellerysortbyid').html(htmldata);
            // $('#sortbyid').select2();

            listjewellerydata(1);
        }

        function OnErrorlistjewellerysortby(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }


    function listmysortby() {

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
        formdata.append("action", "listjewellerysortby");
        formdata.append("isweb", 0);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistmysortby, OnErrorlistmysortby);

        function Onsuccesslistmysortby(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            htmldata += '<option value="">Select Sort By</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option  value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#myjewellerysortbyid').html(htmldata);
            // $('#sortbyid').select2();

            listmyjewellerydata(1);
        }

        function OnErrorlistmysortby(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }


    $('#canshowmyfavorite').change(function() {
        $('#listjewelleryData').attr('data-nextpage', 0);
        $("#listjewelleryData").animate({
            scrollTop: 0
        }, "slow");
        listjewellerydata(1);
    });

    $('#canselectall').change(function() {
        var jewelleryidarr = [];
        if ($(this).prop('checked') === true) {
            $('#listjewelleryData .chkjewellery').prop('checked', true);
            $('.addtomyfavoriteDiv').removeClass('d-none');
        } else {
            $('.addtomyfavoriteDiv').addClass('d-none');
            $('#listjewelleryData .chkjewellery').prop('checked', false);
        }

        $('#listjewelleryData .chkjewellery').each(function() {
            if ($(this).prop('checked') === true) {
                jewelleryidarr.push($(this).val());
            }
        });
        //console.log(jewelleryidarr);
    });





    /* APPLY FILTERS */

    //jewellerytype
    var fltjewllerytypeid = [];
    var fltjewllerytype = [];
    $('body').on('click', '#jewellerytypefilterData .fltjewellerytypeid', function() {
        fltjewllerytypeid = [];
        fltjewllerytype = [];
        $("#jewellerytypefilterData .fltjewellerytypeid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                fltjewllerytype.push({
                    'id': id,
                    'name': name
                });
                fltjewllerytypeid.push(id);
            }
        });
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
        //console.log(fltjewllerytypeid);
        //console.log(fltjewllerytype);

    });

    //metaltype
    var fltmetaltypeid = [];
    var fltmetaltype = [];
    $('body').on('click', '#jewellerymetaltypefilterData .fltjewellerymetaltypeid', function() {
        fltmetaltypeid = [];
        fltmetaltype = [];
        $("#jewellerymetaltypefilterData .fltjewellerymetaltypeid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                fltmetaltype.push({
                    'id': id,
                    'name': name
                });
                fltmetaltypeid.push(id);
            }
        });
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
        //console.log(fltmetaltype);
        //console.log(fltmetaltypeid);

    });

    //metaltype
    var fltgemstonetypeid = [];
    var fltgemstonetype = [];
    $('body').on('click', '#jewellerygemstonetypefilterData .fltjewellerygemstonetypeid', function() {
        fltgemstonetypeid = [];
        fltgemstonetype = [];
        $("#jewellerygemstonetypefilterData .fltjewellerygemstonetypeid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                fltgemstonetype.push({
                    'id': id,
                    'name': name
                });
                fltgemstonetypeid.push(id);
            }
        });
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
        //console.log(fltgemstonetype);
        //console.log(fltgemstonetypeid);

    });

    //condition
    var fltconditionid = [];
    var fltcondition = [];
    $('body').on('click', '#jewelleryconditionfilterData .fltjewelleryconditionid', function() {
        fltconditionid = [];
        fltcondition = [];
        $("#jewelleryconditionfilterData .fltjewelleryconditionid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                fltcondition.push({
                    'id': id,
                    'name': name
                });
                fltconditionid.push(id);
            }
        });
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
        //console.log(fltcondition);
        //console.log(fltconditionid);

    });

    //METAL KT
    var fltmetalktid = [];
    var fltmetalkt = [];
    $('body').on('click', '#jewellerymetalktfilterData .fltjewellerymetalktid', function() {
        fltmetalktid = [];
        fltmetalkt = [];
        $("#jewellerymetalktfilterData .fltjewellerymetalktid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                fltmetalkt.push({
                    'id': id,
                    'name': name
                });
                fltmetalktid.push(id);
            }
        });
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
        //console.log(fltmetalkt);
        //console.log(fltmetalktid);

    });

    //Quality
    var fltjewlleryqualityid = [];
    var fltjewlleryquality = [];
    $('body').on('click', '#jewelleryqualityfilterData .fltjewelleryqualityid', function() {
        fltjewlleryqualityid = [];
        fltjewlleryquality = [];
        $("#jewelleryqualityfilterData .fltjewelleryqualityid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                fltjewlleryquality.push({
                    'id': id,
                    'name': name
                });
                fltjewlleryqualityid.push(id);
            }
        });
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
        //console.log(fltjewlleryquality);
        //console.log(fltjewlleryqualityid);

    });

    //Category
    var fltjewllerycategoryid = [];
    var fltjewllerycategory = [];
    $('body').on('click', '#jewellerycategoryfilterData .fltjewellerycategoryid', function() {
        fltjewllerycategoryid = [];
        fltjewllerycategory = [];
        $("#jewellerycategoryfilterData .fltjewellerycategoryid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                fltjewllerycategory.push({
                    'id': id,
                    'name': name
                });
                fltjewllerycategoryid.push(id);
            }
        });
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
        //console.log(fltjewllerycategory);
        //console.log(fltjewllerycategoryid);

    });

    //Shape
    var fltjewlleryshapeid = [];
    var fltjewlleryshape = [];
    $('body').on('click', '#shapefilterData .fltshapeid', function() {
        fltjewlleryshapeid = [];
        fltjewlleryshape = [];
        $("#shapefilterData .fltshapeid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                fltjewlleryshape.push({
                    'id': id,
                    'name': name
                });
                fltjewlleryshapeid.push(id);
            }
        });
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
        //console.log(fltjewlleryshape);
        //console.log(fltjewlleryshapeid);

    });

    //GEMSTONE TREATMENT
    var fltgemstonetreatmentid = [];
    var fltgemstonetreatment = [];
    $('body').on('click', '#jewellerygemstonetreatmentfilterData .fltjewellerygemstonetreatmentid', function() {
        fltgemstonetreatmentid = [];
        fltgemstonetreatment = [];
        $("#jewellerygemstonetreatmentfilterData .fltjewellerygemstonetreatmentid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                fltgemstonetreatment.push({
                    'id': id,
                    'name': name
                });
                fltgemstonetreatmentid.push(id);
            }
        });
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
        //console.log(fltgemstonetreatment);
        //console.log(fltgemstonetreatmentid);

    });

    //Lab
    var fltlabid = [];
    var fltlab = [];
    $('body').on('click', '#jewellerylabreportfilterData .fltjewellerygemstonelabid', function() {
        fltlabid = [];
        fltlab = [];
        $("#jewellerylabreportfilterData .fltjewellerygemstonelabid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                fltlab.push({
                    'id': id,
                    'name': name
                });
                fltlabid.push(id);
            }
        });
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
        //console.log(fltlab);
        //console.log(fltlabid);

    });

    //Brand
    var fltbrandid = [];
    var fltbrand = [];
    $('body').on('click', '#jewellerybrandfilterData .fltjewellerybrandid', function() {
        fltbrandid = [];
        fltbrand = [];
        $("#jewellerybrandfilterData .fltjewellerybrandid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                fltbrand.push({
                    'id': id,
                    'name': name
                });
                fltbrandid.push(id);
            }
        });
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
        //console.log(fltbrand);
        //console.log(fltbrandid);

    });

    // availability
    var fltavailablearr = [];
    $('body').on('click', '#fltavailable', function() {
        var isavailable = 0;
        if ($(this).prop('checked') == true) {
            isavailable = 1;
        }
        fltavailablearr.push(isavailable);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });
    var fltavailableformemoarr = [];
    $('body').on('click', '#fltavailableformemo', function() {
        var isavailable = 0;
        if ($(this).prop('checked') == true) {
            isavailable = 1;
        }
        fltavailableformemoarr.push(isavailable);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });


    $('body').on('click', '#btnfltsearch', function() {
        var fltsearch = $('#fltsearch').val();
        // if(fltsearch!='' && fltsearch!=null)
        // {

        // }
        // else
        // {
        //     Notiflix.Notify.Failure('Please enter keyword');
        // }
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);

    });



    //Shipping From
    var fltshippingfromid = [];
    var fltshippingfrom = [];
    $('body').on('click', '#jewelleryshippingfromfilterData .fltjewelleryshippingfromid', function() {
        fltshippingfromid = [];
        fltshippingfrom = [];
        $("#jewelleryshippingfromfilterData .fltjewelleryshippingfromid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                fltshippingfrom.push({
                    'id': id,
                    'name': name
                });
                fltshippingfromid.push(id);
            }
        });
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
        //console.log(fltshippingfrom);
        //console.log(fltshippingfromid);

    });


    function listfilterdata() {
        var htmllistdata = '';
        if (fltjewllerytype) {
            if (fltjewllerytype.length > 0) {
                for (var i = 0; i < fltjewllerytype.length; i++) {
                    var id = fltjewllerytype[i].id;
                    var name = fltjewllerytype[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removejewllerytypeflt  fltjewllerytype' + id + ' searchbtnset"><b> Jewellery Type : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
                }
            }
        }

        if (fltmetaltype) {
            if (fltmetaltype.length > 0) {
                for (var i = 0; i < fltmetaltype.length; i++) {
                    var id = fltmetaltype[i].id;
                    var name = fltmetaltype[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemetaltypeflt  fltmetaltype' + id + ' searchbtnset"><b> Metal Type : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
                }
            }
        }
        if (fltgemstonetype) {
            if (fltgemstonetype.length > 0) {
                for (var i = 0; i < fltgemstonetype.length; i++) {
                    var id = fltgemstonetype[i].id;
                    var name = fltgemstonetype[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removegemstonetypeflt  fltgemstonetype' + id + ' searchbtnset"><b> Gemstone Type : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
                }
            }
        }
        if (fltcondition) {
            if (fltcondition.length > 0) {
                for (var i = 0; i < fltcondition.length; i++) {
                    var id = fltcondition[i].id;
                    var name = fltcondition[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeconditionflt  fltcondition' + id + ' searchbtnset"><b> Condition : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
                }
            }
        }
        if (fltmetalkt) {
            if (fltmetalkt.length > 0) {
                for (var i = 0; i < fltmetalkt.length; i++) {
                    var id = fltmetalkt[i].id;
                    var name = fltmetalkt[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemetalktflt  fltmetalkt' + id + ' searchbtnset"><b> Metal KT : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
                }
            }
        }
        if (fltjewlleryquality) {
            if (fltjewlleryquality.length > 0) {
                for (var i = 0; i < fltjewlleryquality.length; i++) {
                    var id = fltjewlleryquality[i].id;
                    var name = fltjewlleryquality[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removejewlleryqualityflt  fltjewlleryquality' + id + ' searchbtnset"><b> Quality : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
                }
            }
        }
        if (fltjewllerycategory) {
            if (fltjewllerycategory.length > 0) {
                for (var i = 0; i < fltjewllerycategory.length; i++) {
                    var id = fltjewllerycategory[i].id;
                    var name = fltjewllerycategory[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removejewllerycategoryflt  fltjewllerycategory' + id + ' searchbtnset"><b> Category : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
                }
            }
        }
        if (fltjewlleryshape) {
            if (fltjewlleryshape.length > 0) {
                for (var i = 0; i < fltjewlleryshape.length; i++) {
                    var id = fltjewlleryshape[i].id;
                    var name = fltjewlleryshape[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removejewlleryshapeflt  fltjewlleryshape' + id + ' searchbtnset"><b> Shape : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
                }
            }
        }
        if (fltgemstonetreatment) {
            if (fltgemstonetreatment.length > 0) {
                for (var i = 0; i < fltgemstonetreatment.length; i++) {
                    var id = fltgemstonetreatment[i].id;
                    var name = fltgemstonetreatment[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removegemstonetreatmentflt  fltgemstonetreatment' + id + ' searchbtnset"><b> Treatment : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
                }
            }
        }
        if (fltlab) {
            if (fltlab.length > 0) {
                for (var i = 0; i < fltlab.length; i++) {
                    var id = fltlab[i].id;
                    var name = fltlab[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removelabflt  fltlab' + id + ' searchbtnset"><b> Lab : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
                }
            }
        }
        if (fltbrand) {
            if (fltbrand.length > 0) {
                for (var i = 0; i < fltbrand.length; i++) {
                    var id = fltbrand[i].id;
                    var name = fltbrand[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removebrandflt  fltbrand' + id + ' searchbtnset"><b> Brand : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
                }
            }
        }


        if ($('#fltavailable').prop('checked') == true) {
            htmllistdata += '<a href="javascript:void(0);" class="btn m-1 removefltavailable  searchbtnset"><b> Availability : </b><span>Available</span> <span class="btn-remove-tag">X</span></a>';
        }
        if ($('#fltavailableformemo').prop('checked') == true) {
            htmllistdata += '<a href="javascript:void(0);" class="btn m-1 removefltavailableformemo  searchbtnset"><b> Availability : </b><span>Available For Memo</span> <span class="btn-remove-tag">X</span></a>';
        }
        if (fltshippingfrom) {
            if (fltshippingfrom.length > 0) {
                for (var i = 0; i < fltshippingfrom.length; i++) {
                    var id = fltshippingfrom[i].id;
                    var name = fltshippingfrom[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeshippingfromflt  fltshippingfrom' + id + ' searchbtnset"><b> Shipping From : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
                }
            }
        }


        if ($('#fltsearch').val() != '' && $('#fltsearch').val() != null) {
            htmllistdata += '<a href="javascript:void(0);" class="btn m-1 removefltsearch  searchbtnset"><b> Keyword : </b><span>' + $('#fltsearch').val() + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        $('.searchjewellerylistDiv').html(htmllistdata);

    }


    function removeindexfromarr(arrname, id) {
        var _index;
        var arrid = [];
        $.each(arrname, function(i, value) {
            if (value.id == id) {
                _index = i;
            } else {
                arrid.push(value.id);
            }
        });
        arrname.splice(_index, 1);

        return arrid;
    }
    $('body').on('click', '.removejewllerytypeflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        console.log(id);
        $('.fltjewllerytype' + id + '').remove();
        $('#fltjewellerytypeid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(fltjewllerytype, id);
        fltjewllerytypeid.splice($.inArray(id, fltjewllerytypeid), 1);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);

    });

    $('body').on('click', '.removemetaltypeflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('.fltmetaltype' + id + '').remove();
        $('#fltjewellerymetaltypeid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(fltmetaltype, id);
        fltmetaltypeid.splice($.inArray(id, fltmetaltypeid), 1);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });


    $('body').on('click', '.removegemstonetypeflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('.fltgemstonetype' + id + '').remove();
        $('#fltjewellerygemstonetypeid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(fltgemstonetype, id);
        fltgemstonetypeid.splice($.inArray(id, fltgemstonetypeid), 1);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });


    $('body').on('click', '.removeconditionflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('.fltcondition' + id + '').remove();
        $('#fltjewelleryconditionid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(fltcondition, id);
        fltconditionid.splice($.inArray(id, fltconditionid), 1);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });

    $('body').on('click', '.removemetalktflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('.fltmetalkt' + id + '').remove();
        $('#fltjewellerymetalktid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(fltmetalkt, id);
        fltmetalktid.splice($.inArray(id, fltmetalktid), 1);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });


    $('body').on('click', '.removejewlleryqualityflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('.fltjewlleryquality' + id + '').remove();
        $('#fltjewelleryqualityid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(fltjewlleryquality, id);
        fltjewlleryqualityid.splice($.inArray(id, fltjewlleryqualityid), 1);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });


    $('body').on('click', '.removejewllerycategoryflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('.fltjewllerycategory' + id + '').remove();
        $('#fltjewellerycategoryid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(fltjewllerycategory, id);
        fltjewllerycategoryid.splice($.inArray(id, fltjewllerycategoryid), 1);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });

    $('body').on('click', '.removejewlleryshapeflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('.fltjewlleryshape' + id + '').remove();
        $('#fltshapeid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(fltjewlleryshape, id);
        fltjewlleryshapeid.splice($.inArray(id, fltjewlleryshapeid), 1);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });

    $('body').on('click', '.removegemstonetreatmentflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('.fltgemstonetreatment' + id + '').remove();
        $('#fltjewellerygemstonetreatmentid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(fltgemstonetreatment, id);
        fltgemstonetreatmentid.splice($.inArray(id, fltgemstonetreatmentid), 1);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });

    $('body').on('click', '.removelabflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('.fltlab' + id + '').remove();
        $('#fltjewellerygemstonelabid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(fltlab, id);
        fltlabid.splice($.inArray(id, fltlabid), 1);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });

    $('body').on('click', '.removebrandflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('.fltbrand' + id + '').remove();
        $('#fltjewellerybrandid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(fltbrand, id);
        fltbrandid.splice($.inArray(id, fltbrandid), 1);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });

    $('body').on('click', '.removefltavailableformemo', function() {
        $(this).remove();
        $('#fltavailableformemo').prop('checked', false);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });

    $('body').on('click', '.removefltavailable', function() {
        $(this).remove();
        $('#fltavailable').prop('checked', false);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });


    $('body').on('click', '.removeshippingfromflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('.fltshippingfrom' + id + '').remove();
        $('#fltjewelleryshippingfromid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(fltshippingfrom, id);
        fltshippingfromid.splice($.inArray(id, fltshippingfromid), 1);
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });

    $('body').on('click', '.removefltsearch', function() {
        $(this).remove();
        $('#fltsearch').val('');
        $('#listjewelleryData').attr('data-nextpage', 0);
        listjewellerydata(1);
    });



    /* ************************************** MANAGE MY JEWELLERY******************************************** */

    function listmyjewellerydata(page) {

        // showloader();
        $('.chart-loading').show();

        listsidefilterdata();
        var pagename = getpagename();
        var useraction = $('#formevent').val();
        var sortbyid = $('#myjewellerysortbyid').val();

        var fromprice = $('#sideminprice').val();
        var toprice = $('#sidemaxprice').val();

        var jewellery_per_page = $('#myjewellery_per_page').val();
        var nextpage = 0;
        if ($('#listmyjewelleryDatatbl').attr('data-nextpage') > 0) {
            nextpage = $('#listmyjewelleryDatatbl').attr('data-nextpage');
        }
        var formdata = new FormData();

        formdata.append("action", "listjewellery");
        formdata.append("nextpage", parseInt(nextpage) + 1);
        formdata.append("fltmanagemyjewellery", 1);
        formdata.append("perpage", jewellery_per_page);
        formdata.append("sortbyid", sortbyid);

        formdata.append("fltjewllerytypeid", sidefltjewllerytypeid);
        formdata.append("fltbrandid", sidefltjewellerybrandid);
        formdata.append("fltjewllerycategoryid", sidefltjewellerycategoryid);
        formdata.append("fltjewlleryqualityid", sidefltjewelleryqualityid);

        formdata.append("fromprice", fromprice);
        formdata.append("toprice", toprice);


        var headersdata = {
            'Accept': 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: useraction,
            masterlisting: false
        };
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>jewellery', formdata, headersdata, Onsuccesslistmyjewellerydata, OnErrorlistmyjewellerydata)

        function Onsuccesslistmyjewellerydata(data) {
            // hideloader();
            $('.chart-loading').hide();
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);

            var htmldata = '';
            if (resultdata.IsPackageExpire == 1) {
                Notiflix.Report.Warning(resultdata.ExpiryTitle, resultdata.message, false, function() {
                    window.location = resultdata.ExpiryURL;
                });
            } else {
                if (resultdata.status == 0) {

                    htmldata += '<tr>';
                    htmldata += '<td colspan="16">';
                    htmldata += '<h3>' + resultdata.message + '</h3>';
                    htmldata += '</td>';
                    htmldata += '</tr>';

                    $('#listmyjewelleryData').html(htmldata);
                    $('#showmyjewelleryentries').html(0);

                    $('.totalmyjewellery').html('0 Items');



                } else if (resultdata.status == 1) {
                    if (resultdata.totaljewellery >= 0 && resultdata.totaljewellery != null) {
                        // //console.log('totaldiamond'+resultdata.totaldiamond);
                        // //console.log('totalprice'+resultdata.totalprice);
                        $('.totalmyjewellery').html(resultdata.totaljewellery + ' Items');
                    }

                    for (var i in resultdata.data) {
                        var jewellerydata = resultdata.data[i];


                        // htmldata += '<a href="javascript:void(0);" class="showmyjewellerydetails" data-jewelleryid="' + jewellerydata.id + '">';
                        htmldata += '<tr data-jewelleryid="' + jewellerydata.id + '">';
                        htmldata += '<td class="tbl-check d-none " data-index="' + jewellerydata.id + '">';
                        htmldata += '<div class="text-center">';
                        htmldata += '<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
                        htmldata += '<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete' + jewellerydata.id + '" value="' + jewellerydata.id + '" name="bulkdelete[]">';
                        htmldata += '<label class="set-lable-datadelete custom-control-label mb-0" for="bulkdelete' + jewellerydata.id + '"></label>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</td>';

                        htmldata += '<td class=" showmyjewellerydetails" data-jewelleryid="' + jewellerydata.id + '">' + jewellerydata.stock + '</td>';
                        // htmldata += '<td class=""><a href="javascript:void(0);" class="showmyjewellerydetails" data-jewelleryid="' + jewellerydata.id + '">' + jewellerydata.itemtitle + '</a></td>';
                        htmldata += '<td class=" showmyjewellerydetails" data-jewelleryid="' + jewellerydata.id + '">' + jewellerydata.itemtitle + '</a></td>';
                        htmldata += '<td class=" showmyjewellerydetails"  data-jewelleryid="' + jewellerydata.id + '">' + jewellerydata.jewellerytype + '</td>';
                        htmldata += '<td class=" showmyjewellerydetails" data-jewelleryid="' + jewellerydata.id + '">' + jewellerydata.brand + '</td>';
                        htmldata += '<td class=" showmyjewellerydetails" data-jewelleryid="' + jewellerydata.id + '">$' + jewellerydata.minprice + '</td>';
                        htmldata += '<td class=" showmyjewellerydetails" data-jewelleryid="' + jewellerydata.id + '">' + jewellerydata.iteminstock + '</td>';
                        htmldata += '<td class=" showmyjewellerydetails" data-jewelleryid="' + jewellerydata.id + '">' + jewellerydata.minimumorder + '</td>';
                        htmldata += '<td class=" showmyjewellerydetails" data-jewelleryid="' + jewellerydata.id + '">' + jewellerydata.conditionname + '</td>';
                        htmldata += '<td class=" showmyjewellerydetails" data-jewelleryid="' + jewellerydata.id + '">' + jewellerydata.designername + '</td>';
                        htmldata += '<td class=" showmyjewellerydetails" data-jewelleryid="' + jewellerydata.id + '">';
                        if (jewellerydata.isactive == 1) {
                            htmldata += ' Active ';
                        } else {
                            htmldata += ' Inactive ';
                        }
                        htmldata += '</td>';
                        htmldata += '<td class="" data-jewelleryid="' + jewellerydata.id + '">';

                        htmldata += '<a href="javascript:void(0);" class="btn editmyjewellery" title="Edit ' + jewellerydata.itemtitle + '" data-name="' + jewellerydata.itemtitle + '" data-jewelleryid="' + jewellerydata.id + '"><i class="fas fa-edit"></i></a>';
                        htmldata += '<a href="javascript:void(0);" class="btn deletemyjewellery" title="Delete ' + jewellerydata.itemtitle + '" data-name="' + jewellerydata.itemtitle + '" data-jewelleryid="' + jewellerydata.id + '"><i class="fas fa-trash-alt"></i></a>';

                        htmldata += '</td>';
                        htmldata += '</tr>';
                        // htmldata +='</a>';
                    }

                    // $('.listjewelleryDataDiv #listjewelleryData').html(htmldata);
                    if (resultdata.nextpage == 1) {
                        $('#listmyjewelleryData').html(htmldata);
                    } else {
                        $('#listmyjewelleryData').append(htmldata);
                    }
                    $('#showmyjewelleryentries').html(resultdata.showentries);

                    $('#listmyjewelleryDatatbl').attr('data-nextpage', resultdata.nextpage);
                    if (resultdata.loadmore == 1) {
                        $('#listmyjewelleryDatatbl').attr('data-show', 1);
                    } else {
                        $('#listmyjewelleryDatatbl').attr('data-show', 0);
                    }

                    $('.deletemyjewellery').on('click', function() {
                        var id = $(this).attr('data-jewelleryid');
                        var name = $(this).attr('data-name');
                        Notiflix.Confirm.Show(false, 'Are you want to delete "' + name + '"?', false, false, function() {
                            // showloader();
                            $('.chart-loading').show();
                            var pagename = getpagename();
                            var useraction = $('#formevent').val();
                            deleteformdata = new FormData();
                            deleteformdata.append("action", "deletejewellery");
                            deleteformdata.append("id", id);
                            var headersdata = {
                                'Accept': 'application/json',
                                platform: 4,
                                userpagename: pagename,
                                useraction: useraction,
                                masterlisting: false
                            };
                            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>jewellery', deleteformdata, headersdata, Onsuccessdeletejewellery, OnErrordeletejewellery)

                            function Onsuccessdeletejewellery(data) {
                                // hideloader();
                                $('.chart-loading').hide();
                                var JsonData = JSON.stringify(data);
                                var resultdeletedata = jQuery.parseJSON(JsonData);

                                if (resultdeletedata.status == 0) {
                                    alertify(resultdeletedata.message, 0);
                                } else if (resultdeletedata.status == 1) {
                                    alertify(resultdeletedata.message, 1);
                                    $('#listmyjewelleryDatatbl').attr('data-nextpage', 0);
                                    listmyjewellerydata(1);
                                } else if (resultdeletedata.status == -1) {
                                    $('#btnlogout').trigger('click');
                                }

                            }

                            function OnErrordeletejewellery(content) {

                            }

                        }, function() {

                        });
                    });

                    $('.editmyjewellery').on('click', function() {
                        var id = $(this).attr('data-jewelleryid');
                        // var ringsize = $('.jewlringsize').attr('data-ringsize');
                        // alert(ringsize);
                        // showloader();
                        $('.chart-loading').show();
                        var pagename = getpagename();
                        var useraction = $('#formevent').val();
                        editformdata = new FormData();
                        editformdata.append("action", "listjewellery");
                        editformdata.append("id", id);
                        editformdata.append("nextpage", 1);
                        var headersdata = {
                            'Accept': 'application/json',
                            platform: 4,
                            userpagename: pagename,
                            useraction: useraction,
                            masterlisting: false
                        };
                        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>jewellery', editformdata, headersdata, Onsuccesseditjewellery, OnErroreditjewellery)

                        function Onsuccesseditjewellery(data) {
                            // hideloader();
                            $('.chart-loading').hide();
                            var JsonData = JSON.stringify(data);
                            var resulteditdata = jQuery.parseJSON(JsonData);

                            if (resulteditdata.status == 0) {
                                alertify(resulteditdata.message, 0);
                            } else if (resulteditdata.status == 1) {
                                $('#buyJwelery-tab').click();
                                $('#jew1-tab').click();
                                $('#form-jewellery-upload #id').val(id);
                                $('#form-jewellery-upload #formevent').val('update');
                                $('#form-jewellery-upload #btnsavejewellery').html('Update');

                                $('.uploadjewellerytabs li').attr('disabled', false);
                                $('.uploadjewellerytabs li').removeClass('disabled');
                                $('.uploadjewellerytabs li a').removeClass('disabled');
                                $('.uploadjewellerytabs li a').attr('disabled', false);
                                $('.jewelleryuploadesirmodetext').html('Edit');

                                for (var i in resulteditdata.data) {
                                    var editdata = resulteditdata.data[i];

                                    $('#form-jewellery-upload #itemtitle').val(editdata.itemtitle);
                                    $('#form-jewellery-upload #stock').val(editdata.stock);
                                    $('#form-jewellery-upload #isavailable').prop('checked', false);
                                    if (editdata.isavailable == 1) {
                                        $('#form-jewellery-upload #isavailable').prop('checked', true);
                                    }
                                    $('#form-jewellery-upload #isavailableformemo').prop('checked', false);
                                    if (editdata.isavailableformemo == 1) {
                                        $('#form-jewellery-upload #isavailableformemo').prop('checked', true);
                                    }
                                    $('#form-jewellery-upload #description').val(editdata.description);
                                    $('#form-jewellery-upload #iteminstock').val(editdata.iteminstock);
                                    $('#form-jewellery-upload #minimumorder').val(editdata.minimumorder);

                                    listjewelrytype(editdata.jewellerytypeid, editdata.typestyleid);
                                    // listtypestyle(editdata.typestyleid);
                                    listjewelrycategory(editdata.jewellerycategoryid);
                                    listcondition(editdata.conditionid);
                                    listbrand(editdata.brandid);
                                    listjewelryquality(editdata.jewelleryqualityid);
                                    $('#form-jewellery-upload #designername').val(editdata.designername);
                                    $('#form-jewellery-upload #keyworddescription').val(editdata.keyworddescription);
                                    listmetaltype(editdata.metaltypeid);
                                    listmetalcarat(editdata.metalkaratid);
                                    $('#form-jewellery-upload #jewellerytotalweight').val(editdata.jewellerytotalweight);

                                    $('#form-jewellery-upload #suppliercomment').val(editdata.suppliercomment);
                                    $('#form-jewellery-upload #size').val(editdata.size);
                                    $('#form-jewellery-upload #ringsize').val(editdata.ringsize);

                                    // var ringsize = $('.jewlringsize'+val+'').attr('data-ringsize');
                                    // alert(ringsize);
                                    if (editdata.isringsize == 1) {

                                        $('.ringsizeDiv').removeClass('d-none');
                                    } else {
                                        $('.ringsizeDiv').addClass('d-none');
                                    }

                                    $('#form-jewellery-upload #unpublished').prop('checked', false);
                                    if (editdata.unpublished == 1) {
                                        $('#form-jewellery-upload #unpublished').prop('checked', true);
                                    }

                                    $('#form-jewellery-upload #shareable').prop('checked', false);
                                    if (editdata.shareable == 1) {
                                        $('#form-jewellery-upload #shareable').prop('checked', true);
                                    }

                                    $('#form-jewellery-upload #ownstockinventory').prop('checked', false);
                                    if (editdata.ownstockinventory == 1) {
                                        $('#form-jewellery-upload #ownstockinventory').prop('checked', true);
                                    }
                                    var mediadata = '';
                                    if ((editdata.jewelleryimagesdetail).length > 0) {
                                        for (var h in editdata.jewelleryimagesdetail) {
                                            mediadata += '<div class="col-md-1 col-sm-1  mt-2">';
                                            mediadata += '<a href="' + editdata.jewelleryimagesdetail[h].image + '" target="_blank">';
                                            mediadata += '<img src="' + editdata.jewelleryimagesdetail[h].image + '" alt="Jewellery Media Image"  title="Jewellery Media Image">';
                                            mediadata += '</a>';
                                            mediadata += '<p><a href="javascript:void(0);" data-jewelleryid="' + editdata.jewelleryimagesdetail[h].jewelleryid + '" data-id="' + editdata.jewelleryimagesdetail[h].id + '" title="Remove Jewellery Media " class="btn btn-danger mt-1 ml-1 removemyjewellerymediaimage"><i class="fas fa-trash-alt"></i></a></p>';
                                            mediadata += '</div>';
                                        }
                                    }
                                    $('.myjewellerymediafileDiv').html(mediadata);
                                    $('#form-jewellery-upload #jewelleryimglink').val(editdata.jewelleryimglink);
                                    $('#form-jewellery-upload #jewelleryvideolink').val(editdata.jewelleryvideolink);



                                    if ((editdata.jewellerypricelocationdetail).length > 0) {

                                        $('#form-jewellery-upload .priceandlocationDiv').html('');
                                        var trtmp = 1;
                                        for (var jp in editdata.jewellerypricelocationdetail) {
                                            var jphtml = '';
                                            var editjewellerypriceloc = editdata.jewellerypricelocationdetail[jp];
                                            var trtmp_row = parseInt(trtmp - 1);

                                            jphtml += '<div class="setcolorjw priceandlocationDataDiv mt-3" data-index="' + trtmp + '">';
                                            jphtml += '<div class="row">';
                                            jphtml += '<div class="col-md-4">';
                                            jphtml += '<div class="row">';
                                            jphtml += '<div class="col-lg-12 ctupsearch">';
                                            jphtml += '<div class="form-group">';
                                            jphtml += '<label for="shippingfromid' + trtmp + '" class="col-form-label">Shipping From <span class="text-danger">*</span></label>';
                                            jphtml += '<select id="shippingfromid' + trtmp + '" name="shippingfromid[]" class="form-control select2 shippingfromid">';

                                            jphtml += '</select>';
                                            jphtml += '</div>';
                                            jphtml += '</div>';
                                            jphtml += '</div>';
                                            jphtml += '</div>';
                                            jphtml += '<div class="col-md-4">';
                                            jphtml += '<div class="row">';
                                            jphtml += '<div class="col-lg-12 ctupsearch">';
                                            jphtml += '<div class="form-group">';
                                            jphtml += '<label for="price' + trtmp + '" class="col-form-label">Price Per Piece</label>';
                                            jphtml += '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter" id="price' + trtmp + '" name="price[]">';
                                            jphtml += '</div>';
                                            jphtml += '</div>';
                                            jphtml += '</div> ';
                                            jphtml += '</div>';
                                            jphtml += '<div class="col-md-4">';
                                            jphtml += '<div class="row">';
                                            jphtml += '<div class="col-lg-12 ctupsearch">';
                                            jphtml += '<div class="form-group">';
                                            jphtml += '<label for="termsid' + trtmp + '" class="col-form-label">Terms</label>';
                                            jphtml += '<select id="termsid' + trtmp + '" name="termsid' + trtmp_row + '[]" multiple class="form-control select2">';

                                            jphtml += '</select>';
                                            jphtml += '</div>';
                                            jphtml += '</div>';
                                            jphtml += '</div> ';
                                            jphtml += '</div>';
                                            jphtml += '</div>';
                                            jphtml += '<div class="row setptopjw">';
                                            jphtml += '<div class="col-lg-4 col-md-4">';
                                            jphtml += '<div class="row">';
                                            jphtml += '<div class="col-lg-12 ctupsearch">';
                                            jphtml += '<div class="form-group">';
                                            jphtml += '<label for="msrp' + trtmp + '" class="col-form-label">Msrp</label>';
                                            jphtml += '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter" id="msrp' + trtmp + '" name="msrp[]">';
                                            jphtml += '</div>';
                                            jphtml += '</div>';
                                            jphtml += '</div>';
                                            jphtml += '</div>';
                                            jphtml += '<div class="col-lg-4 col-md-4">';
                                            jphtml += '<div class="row">';
                                            jphtml += '<div class="col-lg-12 ctupsearch">';
                                            jphtml += '<div class="form-group">';
                                            jphtml += '<label for="deliverytimeindays' + trtmp + '" class="col-form-label">Delivery Time</label>';
                                            jphtml += '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter" id="deliverytimeindays' + trtmp + '" name="deliverytimeindays[]">';
                                            jphtml += '<h6 class="setdayjw">Days</h6>';
                                            jphtml += '</div>';
                                            jphtml += '</div>';
                                            jphtml += '</div>';
                                            jphtml += '</div>';
                                            jphtml += '</div>';
                                            jphtml += '</div>';

                                            $('#form-jewellery-upload .priceandlocationDiv').append(jphtml);
                                            listshippingfrom(trtmp, editjewellerypriceloc.shippingfromid);
                                            listterms(trtmp, editjewellerypriceloc.termsid);
                                            $('#form-jewellery-upload #price' + trtmp + '').val(editjewellerypriceloc.price);
                                            $('#form-jewellery-upload #msrp' + trtmp + '').val(editjewellerypriceloc.msrp);
                                            $('#form-jewellery-upload #deliverytimeindays' + trtmp + '').val(editjewellerypriceloc.deliverytimeindays);
                                            trtmp++;
                                            // //console.log('text-'+trtmp);
                                        }
                                        checklastpriceloactionhtml();
                                    }



                                    if ((editdata.jewellerygemstonesdetail).length > 0) {

                                        $('#form-jewellery-upload .gemstoneDiv').html('');
                                        var trtmp = 1;
                                        for (var js in editdata.jewellerygemstonesdetail) {
                                            var jshtml = '';
                                            var editjewellerygemstone = editdata.jewellerygemstonesdetail[js];
                                            var trtmp_row = parseInt(trtmp - 1);

                                            jshtml += '<div class="setcolorjwset gemstoneDataDiv mt-3" data-index="' + trtmp + '">';
                                            jshtml += '<div class="row setptopjw">';

                                            jshtml += '<div class="col-lg-4 col-md-4">';
                                            jshtml += '<div class="row">';
                                            jshtml += '<div class="col-lg-12 ctupsearch">';
                                            jshtml += '<div class="form-group">';
                                            jshtml += '<label for="gemstonetypeid' + trtmp + '" class="col-form-label">Gemstone Type</label>';
                                            jshtml += '<select id="gemstonetypeid' + trtmp + '" name="gemstonetypeid[]" class="form-control select2">';

                                            jshtml += '</select>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '<div class="col-lg-4 col-md-4">';
                                            jshtml += '<div class="row">';
                                            jshtml += '<div class="col-lg-12 ctupsearch">';
                                            jshtml += '<div class="form-group">';
                                            jshtml += '<label for="shapeid' + trtmp + '" class="col-form-label">Shape</label>';
                                            jshtml += '<select id="shapeid' + trtmp + '" name="shapeid[]" class="form-control select2">';

                                            jshtml += '</select>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '<div class="col-lg-4 col-md-4">';
                                            jshtml += '<div class="row">';
                                            jshtml += '<div class="col-lg-12 ctupsearch">';
                                            jshtml += '<div class="form-group">';
                                            jshtml += '<label for="caratweight' + trtmp + '" class="col-form-label">Carat Weight</label>';
                                            jshtml += '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter" id="caratweight' + trtmp + '" name="caratweight[]">';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';

                                            jshtml += '</div>';
                                            jshtml += '<div class="row setptopjw">';
                                            jshtml += '<div class="col-lg-4 col-md-4">';
                                            jshtml += '<div class="row">';
                                            jshtml += '<div class="col-lg-12 ctupsearch">';
                                            jshtml += '<div class="form-group">';
                                            jshtml += '<label for="labid' + trtmp + '" class="col-form-label">Lab</label>';
                                            jshtml += '<select id="labid' + trtmp + '" name="labid[]" class="form-control select2">';

                                            jshtml += '</select>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '<div class="col-lg-4 col-md-4">';
                                            jshtml += '<div class="row">';
                                            jshtml += '<div class="col-lg-12 ctupsearch">';
                                            jshtml += '<div class="form-group">';
                                            jshtml += '<label for="labtext' + trtmp + '" class="col-form-label">Lab#</label>';
                                            jshtml += '<input type="text" class="form-control" autocomplete="off" placeholder="Enter" id="labtext' + trtmp + '" name="labtext[]">';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';

                                            jshtml += '<div class="col-lg-4 col-md-4">';
                                            jshtml += '<div class="row">';

                                            jshtml += '<div class="col-lg-12 ctupsearch">';
                                            jshtml += '<div class="form-group">';
                                            jshtml += '<label for="treatmentid' + trtmp + '" class="col-form-label">Tretment</label>';
                                            jshtml += '<select id="treatmentid' + trtmp + '" multiple name="treatmentid' + trtmp_row + '[]" class="form-control select2">';

                                            jshtml += '</select>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';

                                            jshtml += '</div>';
                                            jshtml += '</div>';

                                            jshtml += '</div>';
                                            jshtml += '<div class="row setptopjw">';

                                            jshtml += '<div class="col-lg-4 col-md-4">';
                                            jshtml += '<div class="row">';
                                            jshtml += '<div class="col-lg-12 ctupsearch">';
                                            jshtml += '<div class="form-group">';
                                            jshtml += '<label for="stone' + trtmp + '" class="col-form-label"># Stone</label>';
                                            jshtml += '<input type="text" class="form-control" autocomplete="off" placeholder="Enter" id="stone' + trtmp + '" name="stone[]">';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '<div class="col-lg-4 col-md-4">';
                                            jshtml += '<div class="row">';
                                            jshtml += '<div class="col-lg-12 ctupsearch">';
                                            jshtml += '<div class="form-group">';
                                            jshtml += '<label for="savanilot' + trtmp + '" class="col-form-label">Lot No#</label>';
                                            jshtml += '<input type="text" class="form-control" autocomplete="off" placeholder="Enter" id="savanilot' + trtmp + '" name="savanilot[]">';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';
                                            jshtml += '</div>';

                                            $('#form-jewellery-upload .gemstoneDiv').append(jshtml);

                                            listgemstonetype(trtmp, editjewellerygemstone.gemstonetypeid);
                                            listshape(trtmp, editjewellerygemstone.shapeid);
                                            listlab(trtmp, editjewellerygemstone.labid);
                                            listtreatment(trtmp, editjewellerygemstone.treatmentid);
                                            $('#form-jewellery-upload #caratweight' + trtmp + '').val(editjewellerygemstone.caratweight);
                                            $('#form-jewellery-upload #labtext' + trtmp + '').val(editjewellerygemstone.labtext);
                                            $('#form-jewellery-upload #stone' + trtmp + '').val(editjewellerygemstone.stones);
                                            $('#form-jewellery-upload #savanilot' + trtmp + '').val(editjewellerygemstone.savanilot);
                                            trtmp++;
                                            // //console.log('text-'+trtmp);
                                        }
                                        checklastgemstonehtml();
                                    }



                                }

                            } else if (resulteditdata.status == -1) {
                                $('#btnlogout').trigger('click');
                            }
                        }

                        function OnErroreditjewellery(content) {

                        }

                    });


                } else if (resultdata.status == -1) {
                    $('#btnlogout').trigger('click');
                }
            }

        }

        function OnErrorlistmyjewellerydata(content) {

        }

    }


    $('body').on('click', '.removemyjewellerymediaimage', function() {
        var jewelleryid = $(this).attr('data-jewelleryid');
        var id = $(this).attr('data-id');

        Notiflix.Confirm.Show(false, 'Are you want to delete this file?', false, false, function() {
            var pagename = getpagename();
            var useraction = '';
            formdata = new FormData();
            formdata.append("action", "deletejewellerymediaimage");
            formdata.append("jewelleryid", jewelleryid);
            formdata.append("id", id);

            var headersdata = {
                'Accept': 'application/json',
                platform: 4,
                userpagename: pagename,
                useraction: useraction,
                masterlisting: false
            };
            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>jewellery', formdata, headersdata, OnsuccessdeletereportfileData, OnErrordeletereportfile)

            function OnsuccessdeletereportfileData(data) {
                var JsonData = JSON.stringify(data);
                var resultdata = jQuery.parseJSON(JsonData);
                // $('.preloader').hide();
                if (resultdata.IsPackageExpire == 1) {
                    Notiflix.Report.Warning(resultdata.ExpiryTitle, resultdata.message, false, function() {
                        window.location = resultdata.ExpiryURL;
                    });
                } else {
                    if (resultdata.status == 0) {
                        // alertify(resultdata.message,0);
                        Notiflix.Notify.Failure(resultdata.message);
                    } else if (resultdata.status == 1) {
                        Notiflix.Notify.Success(resultdata.message);
                        var mediadata = '';
                        if ((resultdata.result).length > 0) {

                            for (var h in resultdata.result) {
                                mediadata += '<div class="col-md-1  col-sm-1 mt-2">';
                                mediadata += '<a href="<?php echo $config->getImageurl(); ?>' + resultdata.result[h].image + '" target="_blank">';
                                mediadata += '<img src="<?php echo $config->getImageurl(); ?>' + resultdata.result[h].image + '" alt="Jewellery Media Image" title="Jewellery Media Image">';
                                mediadata += '</a>';
                                mediadata += '<p><a href="javascript:void(0);" data-jewelleryid="' + resultdata.result[h].jewelleryid + '" data-id="' + resultdata.result[h].id + '" title="Remove Jewellery Media " class="btn btn-danger mt-1 ml-1 removemyjewellerymediaimage"><i class="fas fa-trash-alt"></i></a></p>';
                                mediadata += '</div>';
                            }
                        }
                        $('.myjewellerymediafileDiv').html(mediadata);

                    } else if (resultdata.status == -1) {
                        $('#btnlogout').trigger('click');
                    }
                }

            }

            function OnErrordeletereportfile(content) {
                ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
            }

        }, function() {

        });

    });


    $('body').on('change', '#myjewellerysortbyid', function() {
        $('#listmyjewelleryDatatbl').attr('data-nextpage', 0);
        listmyjewellerydata(1);
    });

    $('body').on('change', '#myjewellery_per_page', function() {
        $('#listmyjewelleryDatatbl').attr('data-nextpage', 0);
        $("#listmyjewelleryDatatbl").animate({
            scrollTop: 0
        }, "slow");
        listmyjewellerydata(1);
    });

    $('#listmyjewelleryDatatbl tbody').scroll(function() {
        //  alert();
        // //console.log('scrollTop:' + $(this).scrollTop());
        // //console.log('innerHeight:' + $(this).innerHeight());
        // //console.log('scrollHeight:' + $(this)[0].scrollHeight);
        // 
        if ($(this).scrollTop() +
            $(this).innerHeight() >=
            $(this)[0].scrollHeight) {
            // //console.log('Here');
            var dataact = getpagename();
            var show = $('#listmyjewelleryDatatbl').attr('data-show');
            // //console.log('dataact:' + dataact);
            // //console.log('show:' + show);
            if (dataact && show == 1) {
                listmyjewellerydata(1);
            }
        }
    });


    /* SHOW MY JEWELLERY DETIALS */

    $('body').on('click', '.showmyjewellerydetails', function() {
        // alert();
        // showloader();
        $('.chart-loading').show();
        var pagename = getpagename();
        var useraction = $('#formevent').val();

        var formdata = new FormData();
        formdata.append("action", "listjewellery");
        formdata.append("nextpage", 1);
        formdata.append("fltmanagemyjewellery", 1);
        formdata.append("perpage", 20);
        var id = $(this).attr('data-jewelleryid');
        if (id) {
            formdata.append("id", id);
        }
        var headersdata = {
            'Accept': 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: useraction,
            masterlisting: false
        };
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>jewellery', formdata, headersdata, Onsuccessmyjewellerydetails, OnErrormyjewellerydetails)

        function Onsuccessmyjewellerydetails(data) {
            // hideloader();
            $('.chart-loading').hide();
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.IsPackageExpire == 1) {
                Notiflix.Report.Warning(resultdata.ExpiryTitle, resultdata.message, false, function() {
                    window.location = resultdata.ExpiryURL;
                });
            } else {
                if (resultdata.status == 0) {
                    Notiflix.Notify.Failure(resultdata.message);
                } else if (resultdata.status == 1) {
                    for (var i in resultdata.data) {
                        var jewellerydata = resultdata.data[i];


                        // $('#jewellerydetailmodal .jewelllerynametext').html(jewellerydata.itemtitle);
                        $('#jewellerydetailmodal .jewelllerynametext').html(jewellerydata.stock);
                        // $('#jewellerydetailmodal .jewelllerystocktext').html(jewellerydata.stock);

                        htmldata += '<div class="col-12">';
                        htmldata += '    <div class="row">';
                        htmldata += '        <div class="col-md-9">';
                        htmldata += '            <div class="row">';
                        htmldata += '                <div class="col-md-6">';
                        htmldata += '                    <div class="simple-gallery">';
                        if (jewellerydata.hasjewelleryimages == 1) {
                            htmldata += '                        <img class="maxi primary blur-up lazyloaded" src="' + jewellerydata.imgurl + '" alt="' + jewellerydata.itemtitle + '" title="' + jewellerydata.itemtitle + '">';

                            if (jewellerydata.jewelleryimagesdetail.length > 1) {
                                htmldata += '<div class="mini">';
                                for (var ji in jewellerydata.jewelleryimagesdetail) {
                                    var imgclass = '';
                                    if (ji == 0) {
                                        imgclass = 'active';
                                    }
                                    htmldata += '<img class="primary ' + imgclass + ' blur-up lazyloaded" src="' + jewellerydata.jewelleryimagesdetail[ji].image + '" alt="' + jewellerydata.itemtitle + '" title="' + jewellerydata.itemtitle + '">';
                                }
                                htmldata += '</div>';
                                htmldata += '</div>';
                            }
                        } else {
                            if (jewellerydata.jewelleryimglink != '') {
                                htmldata += '                        <img class="primary blur-up  mt-5 lazyloaded" src="' + jewellerydata.jewelleryimglink + '" alt="' + jewellerydata.itemtitle + '" title="' + jewellerydata.itemtitle + '">';

                            } else {
                                htmldata += '                        <img class="maxi primary blur-up lazyloaded" src="' + jewellerydata.imgurl + '" alt="' + jewellerydata.itemtitle + '" title="' + jewellerydata.itemtitle + '">';

                            }
                        }

                        htmldata += '<div class=" searmedia">';
                        htmldata += '<div class="row">';

                        htmldata += '<div class=" mediasearch">';

                        htmldata += '<h5>Media</h5>';

                        htmldata += '<div class="media">';
                        if (jewellerydata.jewelleryimagesdetail.length > 0) {
                            for (var im in jewellerydata.jewelleryimagesdetail) {
                                htmldata += '<div class="mediaurl mr-2">';
                                htmldata += '<a href="' + jewellerydata.jewelleryimagesdetail[im].image + '" target="_blank">';
                                htmldata += '<img src="' + jewellerydata.jewelleryimagesdetail[im].image + '" alt="' + jewellerydata.stock + '" width="10%" title="' + jewellerydata.stock + '">';
                                htmldata += '</a>';
                                htmldata += '</div>';
                            }

                        } else {

                            htmldata += ' <b<span>No Media</span></b>';
                        }

                        htmldata += '</div>';

                        if (jewellerydata.jewelleryimglink != '' && jewellerydata.jewelleryimglink != null) {
                            htmldata += '<h5>Image URL</h5>';
                            htmldata += '<div class="media">';
                            htmldata += '<div class="mediaurl mr-2">';
                            htmldata += '<a href="' + jewellerydata.jewelleryimglink + '" target="_blank">';
                            htmldata += '<i class="fas fa-image"></i>';
                            htmldata += '</a>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                        }
                        if (jewellerydata.jewelleryvideolink != '' && jewellerydata.jewelleryvideolink != null) {
                            htmldata += '<h5>Media URL</h5>';
                            htmldata += '<div class="media">';
                            htmldata += '<div class="mediaurl">';
                            htmldata += '<a href="' + jewellerydata.jewelleryvideolink + '" target="_blank"><i class="fas fa-play"></i>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                        }
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';


                        htmldata += '                    </div>';



                        htmldata += '                </div>';

                        htmldata += '                <div class="col-md-6">';
                        htmldata += '                    <div class="titjw">';
                        htmldata += '                        <h4>' + jewellerydata.itemtitle + '</h4>';
                        htmldata += '                        <div class="btn setbtntit">' + jewellerydata.jewellerytype + '</div>';
                        htmldata += '                        <p>' + jewellerydata.description + '</p>';
                        htmldata += '                        <h5>' + jewellerydata.stock + '</h5>';
                        htmldata += '                        <div class="contectse text-center">';

                     
                        htmldata += '</div>                    </div>';

                        htmldata += '                    <div class="pricejw">';
                        htmldata += '                        <div class="newprice">$' + jewellerydata.minprice + '</div>';
                        if (jewellerydata.hasjewellerypricelocation == 1) {


                            htmldata += '                        <h3>Price & Location</h3>';
                            htmldata += '                        <div class="card">';
                            for (var pl in jewellerydata.jewellerypricelocationdetail) {
                                var pricelocationdata = jewellerydata.jewellerypricelocationdetail[pl];

                                htmldata += '                            <div class="card-body">';
                                htmldata += '                            <ul>';
                                htmldata += '                                <li><b>Shipping From</b>: <span class="metalpurity1">&nbsp; ' + pricelocationdata.shippingfrom + '</span></li>';
                                htmldata += '                                <li><b>Price Per Piece</b>: <span class="metalpurity1">&nbsp; $' + pricelocationdata.price + '</span></li>';
                                htmldata += '                                <li><b>Terms</b>: <span class="metalpurity1" >&nbsp; ' + pricelocationdata.terms + '</span></li>';
                                htmldata += '                                <li><b>Msrp</b>: <span class="metalpurity1">&nbsp; $' + pricelocationdata.msrp + '</span></li>';
                                htmldata += '                                <li><b>Delivery Time</b>: <span class="metalpurity1">&nbsp; ' + pricelocationdata.deliverytimeindays + ' Days</span></li>';
                                htmldata += '                            </ul>';
                                htmldata += '                            </div>';
                            }

                            htmldata += '                        </div>';


                        }

                        htmldata += '                        <h3>Product Information</h3>';
                        htmldata += '                        <div class="card">';

                        htmldata += '                            <div class="card-body">';
                        htmldata += '                            <ul>';
                        htmldata += '                                <li><b>Jewellery Type</b>: <span class="metalpurity1">&nbsp; ' + jewellerydata.jewellerytype + '</span></li>';
                        htmldata += '                                <li><b>Type Style</b>: <span class="metalpurity1">&nbsp; ' + jewellerydata.typestyle + '</span></li>';
                        htmldata += '                                <li><b>Jewellery Category</b>: <span class="metalpurity1">&nbsp; ' + jewellerydata.jewellerycategory + '</span></li>';
                        htmldata += '                                <li><b>Condition</b>: <span class="metalpurity1">&nbsp; ' + jewellerydata.conditionname + '</span></li>';
                        htmldata += '                                <li><b>Brand</b>: <span class="metalpurity1">&nbsp; ' + jewellerydata.brand + '</span></li>';
                        htmldata += '                                <li><b>Jewellery Quality</b>: <span class="metalpurity1">&nbsp; ' + jewellerydata.jewelleryquality + '</span></li>';
                        htmldata += '                                <li><b>Designer Maker</b>: <span class="metalpurity1">&nbsp; ' + jewellerydata.designername + '</span></li>';
                        // htmldata+='                                <li><b>Keyword Description</b>: <span class="metalpurity1">&nbsp; '+jewellerydata.keyworddescription+' Days</span></li>';
                        htmldata += '                            </ul>';
                        htmldata += '                            </div>';

                        htmldata += '                        </div>';

                        htmldata += '                        <h3>Metal</h3>';
                        htmldata += '                        <div class="card">';
                        htmldata += '                            <div class="card-body">';
                        htmldata += '                            <ul>';
                        htmldata += '                                <li><b>Metal Type</b>: <span class="metalpurity1">&nbsp; ' + jewellerydata.metaltype + '</span></li>';
                        htmldata += '                                <li><b>Metal Karat</b>: <span class="metalpurity1">&nbsp; ' + jewellerydata.metalkarat + '</span></li>';
                        htmldata += '                                <li><b>Jewellery Total Weight</b>: <span class="metalpurity1">&nbsp; ' + jewellerydata.jewellerytotalweight + 'gr</span></li>';
                        htmldata += '                            </ul>';
                        htmldata += '                            </div>';

                        htmldata += '                        </div>';


                        htmldata += '                        <h3>Gemstone</h3>';
                        htmldata += '                        <div class="card">';

                        if (jewellerydata.hasjewellerygemstones == 1) {
                            for (var gs in jewellerydata.jewellerygemstonesdetail) {
                                var gemstonedata = jewellerydata.jewellerygemstonesdetail[gs];


                                htmldata += '                            <div class="card-body">';
                                htmldata += '                            <ul>';
                                htmldata += '                                <li><b>Gemstone Type</b>: <span class="metalpurity1">&nbsp; ' + gemstonedata.gemstonetype + '</span></li>';
                                htmldata += '                                <li><b>Shape</b>: <span class="metalpurity1">&nbsp; ' + gemstonedata.shape + '</span></li>';
                                htmldata += '                                <li><b>Carat Weight</b>: <span class="metalpurity1">&nbsp; ' + gemstonedata.caratweight + '</span></li>';
                                htmldata += '                                <li><b>Lab</b>: <span class="metalpurity1">&nbsp; ' + gemstonedata.lab + '</span></li>';
                                htmldata += '                                <li><b>Lab#</b>: <span class="metalpurity1">&nbsp; ' + gemstonedata.labtext + '</span></li>';
                                htmldata += '                                <li><b>Treatment</b>: <span class="metalpurity1">&nbsp; ' + gemstonedata.treatment + '</span></li>';
                                htmldata += '                                <li><b>#Stone</b>: <span class="metalpurity1">&nbsp; ' + gemstonedata.stones + '</span></li>';
                                // htmldata += '                                <li><b>Lot No#</b>: <span class="metalpurity1">&nbsp; ' + gemstonedata.savanilot + '</span></li>';
                                htmldata += '                            </ul>';
                                htmldata += '                            </div>';
                            }
                        }
                        htmldata += '                        </div>';




                        htmldata += '                    </div>';


                        htmldata += '                </div>';
                        htmldata += '            </div>';
                        htmldata += '        </div>';

                        var sellerdetails = jewellerydata.persondetail[0];

                        htmldata += '        <div class="col-md-3 profilediamnd-set">';
                       

                        var isavailabletext = 'No';
                        if (jewellerydata.isavailable == 1) {
                            isavailabletext = 'Yes';
                        }
                        var isavailableformemotext = 'No';
                        if (jewellerydata.isavailableformemo == 1) {
                            isavailableformemotext = 'Yes';
                        }

                        htmldata += '            <div class="availsetjw">';

                        htmldata += '                <div class="card">';
                        htmldata += '                    <div class="card-body">';
                        htmldata += '                        <div class="Notessearchd">';
                        htmldata += '                            <h5 calss="avilabtnsetjw">Availability</h5>';
                        htmldata += '                            <ul>';
                        htmldata += '                                <li><b>Available</b>: <span class="metalpurity1">&nbsp;' + isavailabletext + '</span></li>';
                        htmldata += '                                <li><b>Memo</b>: <span class="metalpurity1">&nbsp;' + isavailableformemotext + '</span></li>';
                        htmldata += '                                <li><b>Stock#</b>: <span class="metalpurity1 phonesearch">&nbsp;' + jewellerydata.stock + '</span></li>';
                        htmldata += '                                <li><b>In Stock</b>: <span class="metalpurity1">&nbsp;' + jewellerydata.iteminstock + '</span></li>';
                        htmldata += '                                <li><b>Min Order</b>: <span class="metalpurity1">&nbsp;' + jewellerydata.minimumorder + '</span></li>';
                        htmldata += '                            </ul>';
                        htmldata += '                        </div>';
                        htmldata += '                    </div>';
                        htmldata += '                </div>';



                        htmldata += '                <div class="card mt-4">';
                        htmldata += '                    <div class="card-body">';
                        htmldata += '                        <div class="Notessearchd">';
                        htmldata += '                            <h5 calss="avilabtnsetjw">Measurements</h5>';
                        htmldata += '                            <ul>';
                        htmldata += '                                <li><b>Size</b>: <span class="metalpurity1">&nbsp;' + jewellerydata.size + '</span></li>';

                        htmldata += '                                <li><b>Ring Size</b>: <span class="metalpurity1">&nbsp;' + jewellerydata.ringsize + '</span></li>';
                        htmldata += '                            </ul>';
                        htmldata += '                        </div>';
                        htmldata += '                    </div>';
                        htmldata += '                </div>';

                        var unpublishedtext = 'No';
                        if (jewellerydata.unpublished == 1) {
                            unpublishedtext = 'Yes';
                        }

                        var sharabletext = 'No';
                        if (jewellerydata.sharable == 1) {
                            sharabletext = 'Yes';
                        }

                        var ownstockinventorytext = 'No';
                        if (jewellerydata.ownstockinventory == 1) {
                            ownstockinventorytext = 'Yes';
                        }

                        htmldata += '                <div class="card mt-4">';
                        htmldata += '                    <div class="card-body">';
                        htmldata += '                        <div class="Notessearchd">';
                        htmldata += '                            <h5 calss="avilabtnsetjw">Visibility</h5>';
                        htmldata += '                            <ul>';
                        htmldata += '                                <li><b>Published</b>: <span class="metalpurity1">&nbsp;' + unpublishedtext + '</span></li>';
                        htmldata += '                            </ul>';
                        htmldata += '                        </div>';
                        htmldata += '                    </div>';
                        htmldata += '                </div>';





                        if (jewellerydata.keyworddescription != '') {
                            htmldata += '                <div class="card mt-4">';
                            htmldata += '                    <div class="card-body">';
                            htmldata += '                            <h5 calss="avilabtnsetjw">Keyword Description</h5>';
                            htmldata += '                        <div class="Notessearchd Notessearchd-space">';

                            htmldata += '                            <ul>';
                            htmldata += '                                <li><p>' + jewellerydata.keyworddescription + '</p></li>';
                            htmldata += '                            </ul>';
                            htmldata += '                        </div>';
                            htmldata += '                    </div>';
                            htmldata += '                </div>';
                        }

                        if (jewellerydata.suppliercomment != '') {
                            htmldata += '                <div class="card mt-4">';
                            htmldata += '                    <div class="card-body">';
                            htmldata += '                            <h5 calss="avilabtnsetjw">Suppliers Comment</h5>';
                            htmldata += '                        <div class="Notessearchd Notessearchd-space">';

                            htmldata += '                            <ul>';
                            htmldata += '                                <li><p>' + jewellerydata.suppliercomment + '</p></li>';
                            htmldata += '                            </ul>';
                            htmldata += '                        </div>';
                            htmldata += '                    </div>';
                            htmldata += '                </div>';
                        }


                        htmldata += '            </div>';
                        
                        htmldata += '        </div>';
                        htmldata += '    </div>';
                        htmldata += '</div>';

                       







                    }
                    $('#jewellerydetailmodal #ListJewelleryDataDetail').html(htmldata);
                    if ($("#jewellerydetailmodal img.active").attr("src")) {
                        $("#jewellerydetailmodal .maxi").attr("src", $("#jewellerydetailmodal img.active").attr("src").replace("100x100", "400x400"));
                    }

                    $("#jewellerydetailmodal .mini img").click(function() {
                        $("#jewellerydetailmodal .maxi").attr("src", $(this).attr("src").replace("100x100", "400x400"));
                    });
                    $('#jewellerydetailmodal').modal('show');






                } else if (resultdata.status == -1) {
                    $('#btnlogout').trigger('click');
                }
            }


        }

        function OnErrormyjewellerydetails(content) {

        }

    });

    /* APPLY MY JEWELLERY SIDEBAR FILTER */

    //jewellerytype
    var sidefltjewllerytypeid = [];
    var sidefltjewllerytype = [];
    $('body').on('click', '#s_jewellerytypeDivData .sidefltjewellerytypeid', function() {
        sidefltjewllerytypeid = [];
        sidefltjewllerytype = [];
        $("#s_jewellerytypeDivData .sidefltjewellerytypeid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                sidefltjewllerytype.push({
                    'id': id,
                    'name': name
                });
                sidefltjewllerytypeid.push(id);
            }
        });
        $('#listmyjewelleryDatatbl').attr('data-nextpage', 0);
        listmyjewellerydata(1);
        //console.log(sidefltjewllerytypeid);
        //console.log(sidefltjewllerytype);

    });


    //brand
    var sidefltjewellerybrandid = [];
    var sidefltjewellerybrand = [];
    $('body').on('click', '#s_brandDivData .sidefltjewellerybrandid', function() {
        sidefltjewellerybrandid = [];
        sidefltjewellerybrand = [];
        $("#s_brandDivData .sidefltjewellerybrandid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                sidefltjewellerybrand.push({
                    'id': id,
                    'name': name
                });
                sidefltjewellerybrandid.push(id);
            }
        });
        $('#listmyjewelleryDatatbl').attr('data-nextpage', 0);
        listmyjewellerydata(1);
        //console.log(sidefltjewellerybrandid);
        //console.log(sidefltjewellerybrand);

    });

    //Jewellery Category
    var sidefltjewellerycategoryid = [];
    var sidefltjewellerycategory = [];
    $('body').on('click', '#s_categoryDivData .sidefltjewellerycategoryid', function() {
        sidefltjewellerycategoryid = [];
        sidefltjewellerycategory = [];
        $("#s_categoryDivData .sidefltjewellerycategoryid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                sidefltjewellerycategory.push({
                    'id': id,
                    'name': name
                });
                sidefltjewellerycategoryid.push(id);
            }
        });
        $('#listmyjewelleryDatatbl').attr('data-nextpage', 0);
        listmyjewellerydata(1);
        //console.log(sidefltjewellerycategoryid);
        //console.log(sidefltjewellerycategory);

    });


    //Jewellery Quality
    var sidefltjewelleryqualityid = [];
    var sidefltjewelleryquality = [];
    $('body').on('click', '#s_qualityDivData .sidefltjewelleryqualityid', function() {
        sidefltjewelleryqualityid = [];
        sidefltjewelleryquality = [];
        $("#s_qualityDivData .sidefltjewelleryqualityid").each(function() {
            if ($(this).prop('checked') == true) {
                var id = $(this).val();
                var name = $(this).attr('data-name');
                sidefltjewelleryquality.push({
                    'id': id,
                    'name': name
                });
                sidefltjewelleryqualityid.push(id);
            }
        });
        $('#listmyjewelleryDatatbl').attr('data-nextpage', 0);
        listmyjewellerydata(1);
        //console.log(sidefltjewelleryqualityid);
        //console.log(sidefltjewelleryquality);

    });


    function listsidefilterdata() {
        var htmllistdata = '';
        if (sidefltjewllerytype) {
            if (sidefltjewllerytype.length > 0) {
                for (var i = 0; i < sidefltjewllerytype.length; i++) {
                    var id = sidefltjewllerytype[i].id;
                    var name = sidefltjewllerytype[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removesidejewllerytypeflt  fltsidejewllerytype' + id + ' searchbtnset"><b> Jewellery Type : </b><span>' + name + '</span> X</a>';
                }
            }
        }

        if (sidefltjewellerybrand) {
            if (sidefltjewellerybrand.length > 0) {
                for (var i = 0; i < sidefltjewellerybrand.length; i++) {
                    var id = sidefltjewellerybrand[i].id;
                    var name = sidefltjewellerybrand[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removesidebrandflt  fltsidebrand' + id + ' searchbtnset"><b> Brand : </b><span>' + name + '</span> X</a>';
                }
            }
        }

        if (sidefltjewelleryquality) {
            if (sidefltjewelleryquality.length > 0) {
                for (var i = 0; i < sidefltjewelleryquality.length; i++) {
                    var id = sidefltjewelleryquality[i].id;
                    var name = sidefltjewelleryquality[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removesidejewlleryqualityflt  fltsidejewlleryquality' + id + ' searchbtnset"><b> Quality : </b><span>' + name + '</span> X</a>';
                }
            }
        }
        if (sidefltjewellerycategory) {
            if (sidefltjewellerycategory.length > 0) {
                for (var i = 0; i < sidefltjewellerycategory.length; i++) {
                    var id = sidefltjewellerycategory[i].id;
                    var name = sidefltjewellerycategory[i].name;
                    htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removesidejewllerycategoryflt  fltsidejewllerycategory' + id + ' searchbtnset"><b> Category : </b><span>' + name + '</span> X</a>';
                }
            }
        }



        $('.searchmyjewellerylistDiv').html(htmllistdata);

    }


    $('body').on('click', '.removesidejewllerytypeflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('#sidefltjewellerytypeid' + id + '').prop('checked', false);
        $('.fltsidejewllerytype' + id + '').remove();
        var arrid = removeindexfromarr(sidefltjewllerytype, id);
        sidefltjewllerytypeid.splice($.inArray(id, sidefltjewllerytypeid), 1);
        $('#listmyjewelleryDatatbl').attr('data-nextpage', 0);
        listmyjewellerydata(1);
    });


    $('body').on('click', '.removesidebrandflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('#sidefltjewellerybrandid' + id + '').prop('checked', false);
        $('.fltsidebrand' + id + '').remove();
        var arrid = removeindexfromarr(sidefltjewellerybrand, id);
        sidefltjewellerybrandid.splice($.inArray(id, sidefltjewellerybrandid), 1);
        $('#listmyjewelleryDatatbl').attr('data-nextpage', 0);
        listmyjewellerydata(1);
    });

    $('body').on('click', '.removesidejewllerycategoryflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('#sidefltjewellerycategoryid' + id + '').prop('checked', false);
        $('.fltsidejewllerycategory' + id + '').remove();
        var arrid = removeindexfromarr(sidefltjewellerycategory, id);
        sidefltjewellerycategoryid.splice($.inArray(id, sidefltjewellerycategoryid), 1);
        $('#listmyjewelleryDatatbl').attr('data-nextpage', 0);
        listmyjewellerydata(1);
    });


    $('body').on('click', '.removesidejewlleryqualityflt', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('#sidefltjewelleryqualityid' + id + '').prop('checked', false);
        $('.fltsidejewlleryquality' + id + '').remove();
        var arrid = removeindexfromarr(sidefltjewelleryquality, id);
        sidefltjewelleryqualityid.splice($.inArray(id, sidefltjewelleryqualityid), 1);
        $('#listmyjewelleryDatatbl').attr('data-nextpage', 0);
        listmyjewellerydata(1);
    });


    // $(".setfilter ").click(function () {
    //     $(".rightbarjew").css("width", "0");
    // });

    var mmj = '<?php echo $_REQUEST['mmj']; ?>';
    // alert(mmd);
    if (mmj == 1) {
        setTimeout(() => {
            $('#buy-Jwelery-tab  #managemyJwelery-tab').click();
            removefilterurl();
        }, 500);

    }


    //bulk delete Start
    $('body').on('click', '.select-bulk-delete', function() {
        $('.tbl-check').removeClass('d-none');
        $(this).addClass('active-bulk-delete');
        /* $(".delete-selected").toggleClass("d-none");
        $('.table tr .tbl-check').attr('hidden', function(index, attr){
            return attr == 'hidden' ? null : 'hidden';
        });*/
    });

    $('body').on('click', '.active-bulk-delete', function() {
        $(this).removeClass('active-bulk-delete');
        $('.tbl-check').addClass('d-none');
    });

    $('body').on('click', '#tblCheckAll', function() {
        if ($(this).prop("checked") == true) {
            $(this).prop('checked', true);
            $(this).closest("table").find('.tbl-check .custom-control-input').prop('checked', true);
        } else {
            $(this).prop('checked', false);
            $(this).closest("table").find('.tbl-check .custom-control-input').prop('checked', false);
        }
    });
    $('#modalConfirmation').on('hide.bs.modal', function() {
        $('#deleteaction').val('')
    })


    $('body').on('click', '.btnmultitrash', function() {
        var onchklength = $('[name="bulkdelete[]"]:checked').length;
        if (onchklength > 0) {
            $('#modalConfirmation').modal('show');
        } else {

            Notiflix.Notify.Failure('Please select atleast one checkbox');
        }

    });
    $('#modalConfirmation').on('shown.bs.modal', function() {
        $('#modalConfirmation #deleteaction').focus();
    });

    $('#deleteaction').keypress(function(e) {
        if (e.which == 13) {
            $('#confirmdelete').click();
        }
    });

    $('body').on('click', '#confirmdelete', function() {

        var deleteaction = $('#deleteaction').val();
        if (deleteaction == 'delete' || deleteaction == 'Delete' || deleteaction == 'DELETE') {
            var id = $('#drid').val();
            var bulkid = '';

            if (id == '') {
                var bulkid = new Array();
                // alert(bulkid);

                $('#listmyjewelleryData tr').each(function() {
                    var trtmp = $(this).attr('data-jewelleryid');
                    if ($('#bulkdelete' + trtmp).is(':checked')) {
                        bulkid.push($('#bulkdelete' + trtmp).val());
                    }

                });
            }
            if (bulkid.length > 0) {

                var pagename = getpagename();
                var headersdata = {
                    Accept: 'application/json',
                    platform: 4,
                    userpagename: pagename,
                    useraction: 'delright',
                    masterlisting: false
                };

                formdata = new FormData();
                formdata.append("action", "deletemyjewellerydata");
                formdata.append("id", id);
                formdata.append("bulkid", bulkid);

                ajaxrequest("POST", endpointurl + pagename, formdata, headersdata, OnsuccessDelete, OnErrorDelete);
                $('#drid').val('');
                $('#deleteaction').val('');

                $('#modalConfirmation').modal('hide');
                // $('#loaderprogress').show();
                $('.chart-loading').show();

            }
        } else {
            Notiflix.Notify.Failure('Type Delete to Confirm');
        }
    });

    function OnsuccessDelete(content) {
        $('#listmyjewelleryDatatbl').attr('data-nextpage', 0);
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        $('#loaderprogress').hide();
        if (resultdata.status == 0) {
            Notiflix.Notify.Failure(resultdata.message);
        } else if (resultdata.status == 1) {
            Notiflix.Notify.Success(resultdata.message);
        }

        listmyjewellerydata(1);
        $('.tbl-check').addClass('d-none');
        $('.select-bulk-delete').removeClass('active-bulk-delete');
    }

    function OnErrorDelete(content) {
        ajaxrequest("POST", page404url, '', '', OnsuccessRender, OnErrorRender);
    }
    //bulk delete End
</script>

</html>