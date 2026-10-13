<?php
// require_once dirname(__DIR__, 1).'/config/config.php';
// $config = new config();

require_once dirname(__DIR__, 1) . '/config/init.php';
$res = $DB->getpagemetadata(21);
$id = $_REQUEST['id'];


// $Packagerights = $DB->getpackagewiseuserright($LoginInfo->getUid(),1)['attributeval'];


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

// 1 - Diamond Search , 6 - List Diamonds for Sale, 3 - Share Diamonds and Jewelry, 8 - SavaniGems XL for Excel

$CanDiamondSearch = $DB->getpackagewiseuserright($LoginInfo->getUid(), 1)['attributeval'];
$CanListDiamondForList = $DB->getpackagewiseuserright($LoginInfo->getUid(), 6)['attributeval'];
$CanShareDiamond = $DB->getpackagewiseuserright($LoginInfo->getUid(), 3)['attributeval'];
$CanListDiamondXL = $DB->getpackagewiseuserright($LoginInfo->getUid(), 8)['attributeval'];
$CanMemberToMemberChat = $DB->getpackagewiseuserright($LoginInfo->getUid(), 4)['attributeval'];

if ($CanDiamondSearch != 1 || $CanListDiamondForList != 1) {
?>
    <script>
        window.location = '<?php echo $config->getportalbaseurl(); ?>home';
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
    <script src="assets/js/vendor/jquery.min.js"></script>
</head>

<body class="light home-page">
    <div class="page-wrapper">
        <!-- Header Start -->
        <div class="has-sidebar-left">
            <header class="bg-white accent-3 relative nav-sticky tab-box-shadow">
                <div class="container-fluid text-white">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-4 col-xl-4 col-md-2 m-auto setnamdi">
                            <h4 class="mb-0 sec-desc header-desc text-blue">
                                Diamond
                            </h4>
                        </div>
                        <div class="col-12 col-xl-7 col-lg-7 col-md-9 m-auto pt-3 setresscrd">
                            <ul class="nav responsive-tab nav-material nav-material-white pt-2" id="Diamond-pills-tab">
                                <?php
                                if ($CanDiamondSearch == 1) {
                                ?>
                                    <li>
                                        <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1">Search</a>
                                    </li>
                                <?php
                                }
                                if ($CanListDiamondForList == 1) {
                                ?>
                                    <li>
                                        <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" onclick="resetdiamonduploadform();" href="#v-pills-2">Upload Diamond</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" id="v-pills-3-tab" data-toggle="pill" onclick="listmydiamonddata(1);" href="#v-pills-3">Manage My Diamond</a>
                                    </li>
                                <?php
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <!-- Header End -->
        <div class="main" id="web-content">
            <?php include('sidebar.php'); ?>
            <div class="has-sidebar-left">
                <div class="container-fluid relative animatedParent animateOnce">
                    <div class="tab-content pb-3" id="v-pills-tabContent">
                        <!--Today Tab Start-->
                        <?php
                        if ($CanDiamondSearch == 1) {
                        ?>
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
                                                        <form action="javascript:void(0);" name="form-diamond-search" enctype="multipart/form-data" id="form-diamond-search">
                                                            <div class="filter-box filter-diamond-box">
                                                                <div id="accordion">
                                                                    <div class="card collapse-card">
                                                                        <div class="card-header">
                                                                            <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                                                                Basic
                                                                            </a>
                                                                        </div>
                                                                        <div id="collapseOne" class="collapse show">
                                                                            <div class="form-group shape-group dash-shape shapeDiv serssh">
                                                                                <div class="name-filter">Shape</div>
                                                                                <div class="row-filter dash-row" id="shapeDivData">



                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group size-group dash-size-group sizeDiv">
                                                                                <div class="name-filter">Size</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-6 col-md-6 col-sm-6 sizesetall">
                                                                                        <div class="cut-group">
                                                                                            <label id="sizfrom">From</label>
                                                                                            <input type="number" min="0" value="0" class="fromusd inputval" onkeypress="numbonly(event);" onpaste="numbonly(event);" id="fltfromsize" name="fltfromsize" placeholder="Enter Size">
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6 col-md-6 col-sm-6">
                                                                                        <div class="cut-group">
                                                                                            <label id="sizto">To</label>
                                                                                            <input type="number" min="0" value="0" class="fromusd inputval" name="flttosize" id="flttosize" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="Enter Size">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="row-filter dash-row" id="sizeDivData">

                                                                                    </div> -->
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group color-group dash-shape colorDiv">
                                                                                <div class="name-filter">Color</div>
                                                                                <div class="row-filter dash-row" id="colorDivData">

                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clarity-group dash-shape clarityDiv">
                                                                                <div class="name-filter">Clarity </div>
                                                                                <div class="row-filter dash-row" id="clarityDivData">

                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group multiply-group-filter">
                                                                                <div class="name-filter">Inclusions</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 col-md-12">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-4 mb-3 sizesetall cut-group">
                                                                                                <label id="eyeclean">Eye Clean
                                                                                                    <!-- <img class="savani-que" src="<?php echo $config->getimageurl() ?>images/adminimg/qusetion.svg" alt="savani" title="savani"> -->
                                                                                                </label>
                                                                                                <select class="form-control select2" name="flteyecleanid[]" id="flteyecleanid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-4 mb-3  cut-group">
                                                                                                <label id="ppcto">Milky</label>
                                                                                                <select class="form-control select2" name="fltmilkyid[]" id="fltmilkyid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-4 mb-3 sizesetall cut-group">
                                                                                                <label id="ppcto">Open Inclusions</label>
                                                                                                <select class="form-control select2" name="fltopeninclusionid[]" id="fltopeninclusionid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-4  mb-3 sizesetall cut-group">
                                                                                                <label id="ppcto">White Inclusions</label>
                                                                                                <select class="form-control select2" name="fltwhiteinclusionid[]" id="fltwhiteinclusionid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-4 mb-3 cut-group">
                                                                                                <label id="ppcto">Black Inclusions</label>
                                                                                                <select class="form-control select2" name="fltblackinclusionid[]" id="fltblackinclusionid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group multiply-group-filter">
                                                                                <div class="name-filter">Shade</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 col-md-12 setresdi">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-4 mb-3  sizesetall  cut-group">
                                                                                                <label id="openinclusion"> Shade</label>
                                                                                                <select class="form-control select2" name="fltshadeid[]" id="fltshadeid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                                </select>
                                                                                            </div>
                                                                                            <!-- <div class="d-block mt-auto setpredi">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="hascontains" value="1" id="shadecontain" checked>
                                                                                                    <label class="form-check-label ml-4" for="shadecontain">
                                                                                                        Contains
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="hascontains" value="0" id="dtshadecontain">
                                                                                                    <label class="form-check-label ml-4" for="dtshadecontain">
                                                                                                        Does Not Contain
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-check mt-auto textset">
                                                                                                <input class="form-check-input" type="checkbox" value="1" id="nobgm">
                                                                                                <label class="form-check-label ml-4" for="nobgm">
                                                                                                    <b class="text-black"> No BGM </b>
                                                                                                </label>
                                                                                            </div> -->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Finish</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 col-md-12">
                                                                                        <div class="row">
                                                                                            <div class="col-12 col-md-4 mb-3  sizesetall  cut-group">
                                                                                                <label id="openinclusion">Cut</label>
                                                                                                <select class="form-control select2" name="fltcutid[]" id="fltcutid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-4 mb-3  sizesetall  cut-group">
                                                                                                <label id="openinclusion">Polish</label>
                                                                                                <select class="form-control select2" name="fltpolishid[]" id="fltpolishid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-4 mb-3  sizesetall  cut-group">
                                                                                                <label id="openinclusion">Symmetry</label>
                                                                                                <select class="form-control select2" name="fltsymmetryid[]" id="fltsymmetryid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                                </select>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group flu-group dash-flu-group dash-shape intensityDiv setfilterres">
                                                                                <div class="name-filter">Fluorescence Intensity</div>
                                                                                <div class="row-filter dash-row" id="intensityDivData">


                                                                                </div>
                                                                                <div class="col-12 col-md-6 cut-group">
                                                                                    <label id="ficolor">Color</label>
                                                                                    <select class="form-control select2" name="fltfluorescencecolorid[]" id="fltfluorescencecolorid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group color-group dash-shape labDiv">
                                                                                <div class="name-filter">Grading Report</div>
                                                                                <div class="row-filter dash-row" id="labDivData">

                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Location</div>
                                                                                <div class="row-filter dash-row setrowwi">
                                                                                    <div class="setwid sizesetall cut-group">
                                                                                        <label id="llocation">location</label>
                                                                                        <select class="form-control select2" name="fltlocationid[]" id="fltlocationid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                        </select>
                                                                                    </div>
                                                                                    <!-- <div class="setwid mt-auto setmt">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" value="1" id="isflexibledelivery">
                                                                                            <label class="form-check-label ml-4" for="isflexibledelivery">
                                                                                                <b class="text-black"> Flexible Delivery</b>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div> -->
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Sellers</div>
                                                                                <div class="row-filter dash-row setrowwi">
                                                                                    <div class="sizesetall cut-group setwid">
                                                                                        <label id="ssc">Savani ID/ Company Code</label>
                                                                                        <select class="form-control" name="fltcompanycode" id="fltcompanycode" tabindex="-1" aria-hidden="true">

                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="cut-group setwid">
                                                                                        <label id="ssnumber">Stock Numbers</label>
                                                                                        <select class="form-control" name="fltstocknumbers" id="fltstocknumbers" tabindex="-1" aria-hidden="true">

                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="cut-group setwid">
                                                                                        <label id="llocation">Lot Numbers</label>
                                                                                        <select class="form-control" name="fltsavanilotnumber" id="fltlotnumbers" tabindex="-1" aria-hidden="true">

                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Rough source</div>
                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 col-md-12 sizesetall cut-group">
                                                                                        <select class="form-control select2" name="fltroughsourceid[]" id="fltroughsourceid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                        </select>
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
                                                                        <div id="collapseTwo" class="collapse">
                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Price

                                                                                </div>

                                                                                <div class="row-filter dash-row">
                                                                                    <div class="col-12 col-md-6 col-lg-5 col-xl-5">
                                                                                        <div class="row">
                                                                                            <div class="col-6 col-md-6 col-sm-6 cut-group">
                                                                                                <label id="totalfrom">From</label>
                                                                                                <input type="text" id="fltfromprice" value="0" onpaste="numbonly(event);" onkeypress="numbonly(event);" class="fromusd inputval" name="fltfromprice" placeholder="From">
                                                                                                <label class="inputset set-price-di" type="number">usd</label>
                                                                                            </div>
                                                                                            <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">
                                                                                                <label id="totalfrom">To</label>
                                                                                                <input type="text" id="flttoprice" value="0" onpaste="numbonly(event);" onkeypress="numbonly(event);" class="fromusd inputval" name="flttoprice" placeholder="To">
                                                                                                <label class="inputset set-price-di" type="number">usd</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group flu-group dash-flu-group dash-shape">
                                                                                <div class="name-filter">Media</div>
                                                                                <div class="row-filter dash-row" id="mediaDivData">
                                                                                    <div class="filter-container">
                                                                                        <div class="col-4 col-md-4 col-sm-4 sizesetall">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="Mediaphoto" name="fltmedia[]" data-name="With Photo" class="dashboard-control custom-control-input" value="1">
                                                                                                <label for="Mediaphoto" class="custom-control-label">
                                                                                                    With Photo
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-4 col-sm-4">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="Mediavideo" name="fltmedia[]" data-name="With Video" class="dashboard-control custom-control-input" value="1">
                                                                                                <label for="Mediavideo" class="custom-control-label">
                                                                                                    With Video
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-4 col-sm-4">
                                                                                            <div class="filter custom-checkbox">
                                                                                                <input type="checkbox" id="MediaReport" name="fltmedia[]" data-name="With Lab Report" class="dashboard-control custom-control-input" value="1">
                                                                                                <label for="MediaReport" class="custom-control-label">
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
                                                                        <div id="collapseThree" class="collapse">
                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Percentage</div>
                                                                                <div class="row-filter dash-row setrowwi">
                                                                                    <div class="setwid">
                                                                                        <div class="row">
                                                                                            <div class="col-6 col-md-6 col-sm-4 cut-group">
                                                                                                <label id="depthfrom">From Depth(%)</label>
                                                                                                <input type="text" id="fltfromdepthper" autocomplete="off" value="0" name="fltfromdepthper" class="fromusd inputper inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">
                                                                                                <label class="inputset set-price-di" type="number">%</label>
                                                                                            </div>
                                                                                            <div class="col-6 col-md-6 col-sm-4 mt-auto cut-group">
                                                                                                <label id="depthfrom">To Depth(%)</label>
                                                                                                <input type="text" id="flttodepthper" autocomplete="off" value="0" name="flttodepthper" class="fromusd inputper inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">
                                                                                                <label class="inputset set-price-di" type="number">%</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="setwid">
                                                                                        <div class="row">
                                                                                            <div class="col-6 col-md-6 col-sm-4 cut-group">
                                                                                                <label id="tablefrom">From Table(%)</label>
                                                                                                <input type="text" id="fltfromtableper" autocomplete="off" value="0" name="fltfromtableper" class="fromusd inputper inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">
                                                                                                <label class="inputset set-price-di" type="number">%</label>
                                                                                            </div>
                                                                                            <div class="col-6 col-md-6 col-sm-4 mt-auto cut-group">
                                                                                                <label id="tablefrom">To Table(%)</label>
                                                                                                <input type="text" id="flttotableper" autocomplete="off" value="0" name="flttotableper" class="fromusd inputper inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">
                                                                                                <label class="inputset set-price-di" type="number">%</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group size-group dash-size-group">
                                                                                <div class="name-filter">Matric</div>
                                                                                <div class="row-filter dash-row setrowwi">
                                                                                    <div class="setwid matricset">
                                                                                        <div class="row">
                                                                                            <div class="col-6 col-md-6 col-sm-6 cut-group">
                                                                                                <label id="depthfrom">From Length </label>
                                                                                                <input type="text" id="fltfromlength" autocomplete="off" value="0" name="fltfromlength" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">
                                                                                                <label class="inputset set-price-di" type="number">MM</label>
                                                                                            </div>
                                                                                            <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">
                                                                                                <label id="depthfrom">To Length </label>
                                                                                                <input type="text" id="flttolength" autocomplete="off" value="0" name="flttolength" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">
                                                                                                <label class="inputset set-price-di" type="number">MM</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="setwid">
                                                                                        <div class="row">
                                                                                            <div class="col-6 col-md-6 col-sm-6 cut-group">
                                                                                                <label id="tablefrom">From Width</label>
                                                                                                <input type="text" id="fltfromwidth" autocomplete="off" value="0" name="fltfromwidth" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">
                                                                                                <label class="inputset set-price-di" type="number">MM</label>
                                                                                            </div>
                                                                                            <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">
                                                                                                <label id="tablefrom">To Width</label>
                                                                                                <input type="text" id="flttowidth" autocomplete="off" value="0" name="flttowidth" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">
                                                                                                <label class="inputset set-price-di" type="number">MM</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="setwid">
                                                                                        <div class="row">
                                                                                            <div class="col-6 col-md-6 col-sm-6 cut-group">
                                                                                                <label id="tablefrom">From Depth</label>
                                                                                                <input type="text" id="fltfromdepth" autocomplete="off" value="0" name="fltfromdepth" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">
                                                                                                <label class="inputset set-price-di" type="number">MM</label>
                                                                                            </div>
                                                                                            <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">
                                                                                                <label id="tablefrom">To Depth</label>
                                                                                                <input type="text" id="flttodepth" autocomplete="off" value="0" name="flttodepth" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">
                                                                                                <label class="inputset set-price-di" type="number">MM</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card collapse-card treatmentDiv">
                                                                    <div class="card-header">
                                                                        <a class="card-link" data-toggle="collapse" href="#collapsefour">
                                                                            Treatment
                                                                        </a>
                                                                    </div>
                                                                    <div id="collapsefour" class="collapse">
                                                                        <div class="form-group multiply-group-filter">
                                                                            <div class="name-filter">Display Type</div>
                                                                            <div class="row-filter dash-row" id="treatmentDivData">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card collapse-card keytosymbolDiv">
                                                                    <div class="card-header">
                                                                        <a class="card-link" data-toggle="collapse" href="#collapsefive">
                                                                            Key to Symbols
                                                                        </a>
                                                                    </div>
                                                                    <div id="collapsefive" class="collapse">
                                                                        <div class="form-group multiply-group-filter">
                                                                            <div class="name-filter">Display Type</div>
                                                                            <div class="row-filter dash-row" id="keytosymbolDivData">


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
                                                                    <div id="collapsesix" class="collapse">
                                                                        <div class="form-group size-group dash-size-group">
                                                                            <div class="name-filter">Brand</div>
                                                                            <div class="row-filter dash-row" id="brandDivData">

                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group size-group dash-size-group">
                                                                            <div class="name-filter">More Option</div>
                                                                            <div class="row-filter dash-row">
                                                                                <!-- <div class="col-12 col-md-4 cut-group">
                                                                                            <label id="rrs">Savani Category Code</label>
                                                                                            <input type="text" id="from_usd" name="fusd" placeholder="Enter">
                                                                                        </div> -->
                                                                                <div class="col-12 col-md-6 col-lg-4 col-md-4 cut-group">
                                                                                    <label id="rs">Lab Report Number</label>
                                                                                    <input type="text" id="fltlabreportnumber" class="fromusd" name="fltlabreportnumber" placeholder="Enter Lab Report Number">
                                                                                </div>
                                                                                <!--  <div class="col-12 col-md-4 cut-group">
                                                                                            <label id="ssnumber">Access Code</label>
                                                                                            <input type="text" id="from_usd" name="fusd" placeholder="Enter">
                                                                                        </div> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="text-center p-5 setbtnsub">
                                                                    <button type="submit" id="btnsearchdiamond" disabled class="btn send-btn dash-serchbtn">Search</button>
                                                                    <input type="reset" value="Reset" id="btnresetsearch" class="btn reset-btn dash-reset-btn">
                                                                </div>
                                                            </div>
                                                        </form>

                                                        <div class="table-responsive listdiamondDataDiv d-none searchpagedetail">
                                                            <div class="row searchheaddet">
                                                                <div class="col-md-6 moredetail">
                                                                    <ul>
                                                                        <li><b class="totaldiamonds"> 0 Dimonds </b>|</li>
                                                                        <li>&nbsp;<b class="totalprice"> Total Price : $0 </b></li>
                                                                        <!-- <li>&nbsp; Total Carats 98,176,8 |</li>
                                                                        <li>&nbsp; Average $/ct 1,299 |</li>
                                                                        <li>&nbsp; Average Discount - 36.32%</li> -->
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="text-right searchhead">
                                                                        <div class="searchgreade searchcom setsho">
                                                                            <select class="form-control w-auto shortbydianmondse ml-auto" id="sortbyid" name="sortbyid">

                                                                            </select>
                                                                        </div>
                                                                        <div class="searchgreade searchcom">
                                                                            <button type="button" class="btn searchbtnset"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/3.svg" alt="diamonds sort by" title="diamonds sort by"></button>
                                                                        </div>
                                                                        <div class="searchgreade searchcom">
                                                                            <button type="button" class="btn searchbtnset navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/fliter.svg" alt="diamonds filter" title="diamonds filter"></button>
                                                                        </div>
                                                                        <div class="searchgreade searchcom">
                                                                            <button type="button" id="btnnewsearch" class="btn searchbtnset"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/search.svg" alt="diamonds new search" title="diamonds new search"> New Search</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="shapesearch searchdiamondlistDiv">
                                                                        <!-- <a href="javascript:void(0);" class="btn searchbtnset"><b> Shape : </b><Span>Round</Span></a> -->
                                                                        <!-- <button type="button" class="btn searchbtnset"><b> Size : </b><Span>0.30-0.39</Span></button>
                                                                        <button type="button" class="btn searchbtnset"><b> Shape : </b><Span>Round</Span></button> -->
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
                                                                    <form action="javascript:void(0);" name="form-diamond-search" enctype="multipart/form-data" id="form-diamond-side-search" novalidate="novalidate">
                                                                        <div class="fixbuyp">
                                                                            <h4>Filter</h4><button type="button" class="btn-close-sidebar" aria-label="Close">x</button>
                                                                            <div class="searchgreade searchcom">
                                                                                <button type="submit" class="btn searchbtnset" id="btnapplydiamondfilter" disabled>Apply</button>
                                                                            </div>
                                                                        </div>
                                                                        <ul class="sidebar-nav nav-pills nav-stacked setfilese" id="menu">
                                                                            <li class="s_shapeDiv">
                                                                                <div class="col-12 cut-group">
                                                                                    <div class="form-check">
                                                                                        <h5 class="d-inline">Shape</h5>

                                                                                        <select class="form-control select2" name="fltshapeid[]" id="s_fltshapeid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li class="s_sizeDiv">
                                                                                <div class="col-12 cut-group">
                                                                                    <h5 class="d-inline">Size</h5>
                                                                                    <!-- <input class="form-check-input" type="checkbox" value="" id="laserdrilled">
                                                                                <label class="form-check-label ml-4" for="laserdrilled">
                                                                                    specific
                                                                                </label> -->
                                                                                    <div class="row fliterset">
                                                                                        <div class="col-md-6 cut-group">
                                                                                            <input type="text" id="s_fltfromsize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="fltfromsize" placeholder="From">
                                                                                        </div>
                                                                                        <h5>-</h5>
                                                                                        <div class="col-md-6 mt-auto cut-group">
                                                                                            <input type="text" id="s_flttosize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="flttosize" placeholder="To">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="form-check">
                                                                                        <div class="col-12 col-md-12">
                                                                                            <div class="row" id="s_sizeDivData">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div> -->
                                                                                </div>
                                                                            </li>
                                                                            <li class="s_colorDiv">
                                                                                <div class="col-12 cut-group">
                                                                                    <h5 class="d-inline">Color</h5>
                                                                                    <select class="form-control select2" name="fltcolorid[]" id="s_fltcolorid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                    </select>
                                                                                </div>
                                                                            </li>
                                                                            <li class="s_clarityDiv">
                                                                                <div class="col-12 cut-group">
                                                                                    <h5 class="d-inline">Clarity</h5>
                                                                                    <select class="form-control select2" name="fltclarityid[]" id="s_fltclarityid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                    </select>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="col-12 cut-group setinsmag">
                                                                                    <h5 class="d-inline">Inclusion</h5>
                                                                                    <div class="row flis">
                                                                                        <label for="name" class="eyeclenfil"><b>Eye clean</b></label>
                                                                                        <select class="form-control select2" name="flteyecleanid[]" id="s_flteyecleanid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="row flis">
                                                                                        <label for="name"><b>Milky</b></label>
                                                                                        <select class="form-control select2" name="fltmilkyid[]" id="s_fltmilkyid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="row flis">
                                                                                        <label for="name"><b>Black</b></label>
                                                                                        <select class="form-control select2" name="fltblackinclusionid[]" id="s_fltblackinclusionid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="row flis">
                                                                                        <label for="name"><b>White</b></label>
                                                                                        <select class="form-control select2" name="fltwhiteinclusionid[]" id="s_fltwhiteinclusionid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="row flis">
                                                                                        <label for="name"><b>Open</b></label>
                                                                                        <select class="form-control select2" name="fltopeninclusionid[]" id="s_fltopeninclusionid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <h5 class="d-inline shadeset">Shade</h5>
                                                                                <div class="row col-12 setcolrowsear">
                                                                                    <!-- <div class="col-md-4 fliterradio">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="radio" value="1" name="hascontains" id="containshade">
                                                                                            <label class="form-check-label ml-4" for="containshade">
                                                                                                Contains
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 fliterradio">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="radio" value="0" name="hascontains" id="dtcontainshade">
                                                                                            <label class="form-check-label ml-4" for="dtcontainshade">
                                                                                                Does not contain
                                                                                            </label>
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <select class="form-control select2" name="fltshadeid[]" id="s_fltshadeid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                    </select>
                                                                                </div>
                                                                                <!-- <div class="row cut-group secndsearch">
                                                                                    <input class="form-check-input s_nobgm" type="checkbox" value="1" id="s_nobgm">
                                                                                    <label class="form-check-label ml-4" for="s_nobgm">
                                                                                        No BGM
                                                                                    </label>
                                                                                </div> -->
                                                                            </li>
                                                                            <li>
                                                                                <div class="col-12 cut-group setinsmag">
                                                                                    <h5 class="d-inline">Finish</h5>
                                                                                    <!-- <h5> <span>3x&emsp;</span><span>Ex&emsp;</span><span>Vg+&emsp;</span><span>Vg-</span> </h5> -->
                                                                                    <div class="row flis">
                                                                                        <label for="name"><b>Cut</b></label>
                                                                                        <select class="form-control select2" name="fltcutid[]" id="s_fltcutid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                        </select>

                                                                                    </div>
                                                                                    <div class="row flis">
                                                                                        <label for="name"><b>Polish</b></label>
                                                                                        <select class="form-control select2" name="fltpolishid[]" id="s_fltpolishid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                        </select>

                                                                                    </div>
                                                                                    <div class="row flis">
                                                                                        <label for="name"><b>Symmetry</b></label>
                                                                                        <select class="form-control select2" name="fltsymmetryid[]" id="s_fltsymmetryid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="col-12 cut-group">
                                                                                    <div class="form-check">
                                                                                        <h5 class="d-inline">Fluorescence</h5>
                                                                                        <div class="flis">
                                                                                            <h5 for="shapes">Intensity</h5>
                                                                                            <select class="form-control select2" name="fltintensityid[]" id="s_fltintensityid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="flis">
                                                                                            <h5 for="shapes">Color</h5>
                                                                                            <select class="form-control select2" name="fltfluorescencecolorid[]" id="s_fltfluorescencecolorid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="col-12 cut-group secndsearch">
                                                                                    <div class="form-check">
                                                                                        <h5 class="d-inline">Grading Report</h5>
                                                                                        <div class="col-12 col-md-12">
                                                                                            <div class="row" id="s_labDivData">

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
                                                                                            <select class="form-control select2" name="fltlocationid[]" id="s_fltlocationid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="col-12 cut-group">
                                                                                    <div class="form-check">
                                                                                        <h5 class="d-inline">Rough source</h5>
                                                                                        <div class="flis">
                                                                                            <select class="form-control select2" name="fltroughsourceid[]" id="s_fltroughsourceid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="col-12 cut-group">
                                                                                    <div class="form-check">
                                                                                        <h5 class="d-inline">Sellers</h5>
                                                                                        <div class="flis">
                                                                                            <h5 for="shapes">Savani ID/ Company Code</h5>
                                                                                            <select class="form-control" name="fltcompanycode" id="s_fltcompanycode" tabindex="-1" aria-hidden="true">

                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="flis">
                                                                                            <h5 for="shapes">Stock Numbers</h5>
                                                                                            <select class="form-control" name="fltstocknumbers" id="s_fltstocknumbers" tabindex="-1" aria-hidden="true">

                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="flis">
                                                                                            <h5 for="shapes">Lot Numbers</h5>
                                                                                            <select class="form-control" name="fltsavanilotnumber" id="s_fltlotnumbers" tabindex="-1" aria-hidden="true">

                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="col-12 cut-group">
                                                                                    <h5 class="d-inline">Price</h5>
                                                                                    <div class="row setinputfli">
                                                                                        <!-- <h5 class="totalfil">$total</h5> -->
                                                                                        <div class="col-12 col-md-6 cut-group">
                                                                                            <input type="text" id="s_fltfromprice" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromprice" placeholder="From">
                                                                                            <label class="inputset" type="number">Usd</label>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6 mt-auto cut-group">
                                                                                            <input type="text" id="s_flttoprice" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttoprice" placeholder="To">
                                                                                            <label class="inputset" type="number">Usd</label>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </li>

                                                                            <li>
                                                                                <div class="col-12 cut-group setmedfli">
                                                                                    <div class="form-check">
                                                                                        <h5 class="d-inline">Media</h5>
                                                                                        <div class="col-12 col-md-12">
                                                                                            <div class="row" id="s_mediaDivData">
                                                                                                <div class="col-12 col-md-12 cut-group">
                                                                                                    <div class="form-check">
                                                                                                        <input class="form-check-input" type="checkbox" name="fltmedia[]" value="1" id="s_Mediaphoto">
                                                                                                        <label class="form-check-label ml-4" for="s_Mediaphoto">
                                                                                                            With Photo
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12 col-md-12 cut-group">
                                                                                                    <div class="form-check">
                                                                                                        <input class="form-check-input" type="checkbox" name="fltmedia[]" value="1" id="s_Mediavideo">
                                                                                                        <label class="form-check-label ml-4" for="s_Mediavideo">
                                                                                                            With Video
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12 col-md-12 cut-group">
                                                                                                    <div class="form-check">
                                                                                                        <input class="form-check-input" type="checkbox" name="fltmedia[]" value="1" id="s_MediaReport">
                                                                                                        <label class="form-check-label ml-4" for="s_MediaReport">
                                                                                                            With Lab Report
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="col-12 cut-group setinsmag">
                                                                                    <h5 class="d-inline">Percentage</h5>
                                                                                    <h5></h5>
                                                                                    <div class="row flis">
                                                                                        <label for="name"><b>Depth(%)</b></label>
                                                                                        <div class="row setinputfli">
                                                                                            <div class="col-12 col-md-6 cut-group">
                                                                                                <input type="text" id="s_fltfromdepthper" class="fromusd inputval inputper" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromdepthper" placeholder="From">
                                                                                                <label class="inputset" type="number">%</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6 mt-auto cut-group">
                                                                                                <input type="text" id="s_flttodepthper" class="fromusd  inputval inputper" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttodepthper" placeholder="To">
                                                                                                <label class="inputset" type="number">%</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row flis">
                                                                                        <label for="name"><b>Table(%)</b></label>
                                                                                        <div class="row setinputfli">
                                                                                            <div class="col-12 col-md-6 cut-group">
                                                                                                <input type="text" id="s_fltfromtableper" class="fromusd inputval inputper" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromtableper" placeholder="From">
                                                                                                <label class="inputset" type="number">%</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6 mt-auto cut-group">
                                                                                                <input type="text" id="s_flttotableper" class="fromusd inputval inputper" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttotableper" placeholder="To">
                                                                                                <label class="inputset" type="number">%</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="col-12 cut-group setinsmag">
                                                                                    <h5 class="d-inline">Measurements</h5>
                                                                                    <h5></h5>
                                                                                    <div class="row flis">
                                                                                        <label for="name"><b>Length</b></label>
                                                                                        <div class="row setinputfli">
                                                                                            <div class="col-12 col-md-6 cut-group">
                                                                                                <input type="text" id="s_fltfromlength" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromlength" placeholder="From">
                                                                                                <label class="inputset" type="number">MM</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6 mt-auto cut-group">
                                                                                                <input type="text" id="s_flttolength" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttolength" placeholder="To">
                                                                                                <label class="inputset" type="number">MM</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row flis">
                                                                                        <label for="name"><b>Width</b></label>
                                                                                        <div class="row setinputfli">
                                                                                            <div class="col-12 col-md-6 cut-group">
                                                                                                <input type="text" id="s_fltfromwidth" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromwidth" placeholder="From">
                                                                                                <label class="inputset" type="number">MM</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6 mt-auto cut-group">
                                                                                                <input type="text" id="s_flttowidth" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttowidth" placeholder="To">
                                                                                                <label class="inputset" type="number">MM</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row flis">
                                                                                        <label for="name"><b>Depth</b></label>
                                                                                        <div class="row setinputfli">
                                                                                            <div class="col-12 col-md-6 cut-group">
                                                                                                <input type="text" id="s_fltfromdepth" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromdepth" placeholder="From">
                                                                                                <label class="inputset" type="number">MM</label>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-6 mt-auto cut-group">
                                                                                                <input type="text" id="s_flttodepth" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttodepth" placeholder="To">
                                                                                                <label class="inputset" type="number">MM</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li class="s_treatmentDiv">
                                                                                <div class="col-12 cut-group">
                                                                                    <!-- <div class="col-md-5 fliterradio">
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" value="1" name="flthastreatment" id="s_dtnotreatment">
                                                                                        <label class="form-check-label ml-4" for="s_dtnotreatment">
                                                                                            Contains
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-5 fliterradio">
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" value="0" name="flthastreatment" id="dtcontainshade">
                                                                                        <label class="form-check-label ml-4" for="dtcontainshade">
                                                                                            Does not contain
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-5 fliterradio">
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" value="0" name="flthastreatment" id="dtcontainshade">
                                                                                        <label class="form-check-label ml-4" for="dtcontainshade">
                                                                                            Does not contain
                                                                                        </label>
                                                                                    </div>
                                                                                </div> -->
                                                                                    <div class="form-check">
                                                                                        <h5 class="d-inline">Treatment</h5>
                                                                                        <div class="flis">
                                                                                            <select class="form-control select2" name="flttreatment[]" id="s_flttreatment" multiple="" tabindex="-1" aria-hidden="true">

                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li class="s_keytosymbolDiv">
                                                                                <div class="col-12 cut-group">
                                                                                    <div class="form-check">
                                                                                        <h5 class="d-inline">Key to Symbols</h5>
                                                                                        <div class="flis">
                                                                                            <select class="form-control select2" name="fltkeytosymbols[]" id="s_fltkeytosymbols" multiple="" tabindex="-1" aria-hidden="true">

                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li class="s_brandDiv">
                                                                                <div class="col-12 cut-group">
                                                                                    <div class="form-check">
                                                                                        <h5 class="d-inline">Brand</h5>
                                                                                        <div class="flis">
                                                                                            <select class="form-control select2" name="fltbrand[]" id="s_fltbrand" multiple="" tabindex="-1" aria-hidden="true">

                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="col-12 cut-group">
                                                                                    <div class="form-check">
                                                                                        <h5 class="d-inline">Lab Report Number</h5>
                                                                                        <div class="flis">
                                                                                            <input type="text" id="s_fltlabreportnumber" class="fromusd" name="fltlabreportnumber" placeholder="Enter Lab Report Number">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <!--  <div class="searchgreade searchcom setp">
                                                                                <button type="submit" class="btn searchbtnset" id="btnapplydiamondfilter" disabled>Apply</button>
                                                                            </div> -->
                                                                        </ul>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <table class="table mt-5 mb-5 table-tb" id="listdiamondDatatbl" data-show="0" data-nextpage="0">
                                                                <thead>
                                                                    <tr class="settabledi">
                                                                        <th>
                                                                            <!-- <div class="form-check">
                                                                                <input class="form-check-input sbox" type="checkbox" value="" id="searchboxselctor">
                                                                                <label class="form-check-label searchcheckbox" for="searchboxselctor">
                                                                                    Seller
                                                                                </label>
                                                                            </div> -->
                                                                            Seller
                                                                        </th>
                                                                        <!-- <th>rating</th> -->
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
                                                                        <!-- <th>$/ct</th>
                                                                        <th>%Savani</th> -->
                                                                        <th>Price</th>
                                                                        <th>Depth</th>
                                                                        <th>Table</th>
                                                                        <th>Measurement</th>
                                                                        <th>Vendor Stock No.</th>
                                                                        <!-- <th>Status</th> -->
                                                                        <!-- <th>Media</th> -->
                                                                        <!-- <th>Ratio</th> -->
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="listdiamondData">

                                                                </tbody>
                                                            </table>
                                                            <div class="row">
                                                                <div class="text-left col-md-6"><b>Showing <span id="showdiamondentries"></span> entries</b></div>
                                                                <div class="text-right col-md-2 offset-4"><b class="w-auto setallpageentry">entry <select class="form-control w-auto  ml-auto" id="diamond_per_page" name="diamond_per_page">
                                                                            <option value="20">20</option>
                                                                            <option value="50">50</option>
                                                                            <option value="100">100</option>
                                                                            <option value="500">500</option>
                                                                            <option value="1000">1000</option>
                                                                        </select> per page</b></div>
                                                            </div>
                                                        </div>

                                                    </div>




                                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                        <form action="javascript:void(0);" name="form-diamond-parcel-search" enctype="multipart/form-data" id="form-diamond-parcel-search">
                                                            <div class="filter-box filter-diamond-box">
                                                                <div class="form-group shape-group dash-shape shapeparcelDiv">
                                                                    <div class="name-filter">Shape
                                                                    </div>
                                                                    <div class="row-filter dash-row" id="shapeparcelDivData">

                                                                    </div>
                                                                </div>
                                                                <div class="form-group size-group dash-size-group">
                                                                    <div class="name-filter">Size</div>
                                                                    <div class="row-filter dash-row">
                                                                        <div class="col-6 col-md-6 col-sm-6 sizesetall cut-group">
                                                                            <label id="sizefrom">From</label>
                                                                            <input type="number" id="fltfromparcelsize" class="fromusd inputval" value="0" min="0" onpaste="numbonly(event);" onkeypress="numbonly(event);" name="fltfromparcelsize" placeholder="From">
                                                                        </div>
                                                                        <div class="col-6 col-md-6 col-sm-6 cut-group">
                                                                            <label id="sizeto">To</label>
                                                                            <input type="number" id="flttoparcelsize" class="fromusd inputval" value="0" min="0" name="flttoparcelsize" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group color-group dash-shape colorparcelDiv">
                                                                    <div class="name-filter">Color</div>
                                                                    <div class="row-filter dash-row" id="colorparcelDivData">

                                                                    </div>
                                                                </div>
                                                                <div class="form-group clarity-group dash-shape clarityparcelDiv">
                                                                    <div class="name-filter">Clarity</div>
                                                                    <div class="row-filter dash-row" id="clarityparcelDivData">

                                                                    </div>
                                                                </div>
                                                                <div class="form-group multiply-group-filter">
                                                                    <div class="name-filter">Piece Per Carat</div>
                                                                    <div class="row-filter dash-row">
                                                                        <div class="col-12 col-md-12">
                                                                            <div class="row">
                                                                                <div class="col-6 col-md-6 col-sm-6 sizesetall  cut-group">
                                                                                    <label id="ppcfrom">From</label>
                                                                                    <input type="number" id="fltfrompiecepercarat" class="fromusd inputval" value="0" min="0" onpaste="numbonly(event);" onkeypress="numbonly(event);" name="fltfrompiecepercarat" placeholder="From">
                                                                                </div>
                                                                                <div class="col-6 col-md-6 col-sm-6 cut-group">
                                                                                    <label id="ppcto">To</label>
                                                                                    <input type="number" id="flttopiecepercarat" class="fromusd inputval" value="0" min="0" name="flttopiecepercarat" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group size-group dash-size-group">
                                                                    <div class="name-filter">Price</div>
                                                                    <div class="row-filter dash-row">
                                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                                                                            <div class="row">
                                                                                <div class="col-6 col-md-6 col-sm-6 cut-group">
                                                                                    <label id="totalfrom">From</label>
                                                                                    <input type="text" id="fltfrompriceparcel" value="0" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" name="fltfrompriceparcel" placeholder="From">
                                                                                    <label class="inputset" type="number">usd</label>
                                                                                </div>
                                                                                <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">
                                                                                    <label id="totalfrom">To</label>
                                                                                    <input type="text" id="flttopriceparcel" value="0" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" name="flttopriceparcel" placeholder="To">
                                                                                    <label class="inputset" type="number">usd</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group size-group dash-size-group sleeveDiv">
                                                                    <div class="name-filter">Sleeve</div>
                                                                    <div class="row-filter dash-row" id="sleeveDivData">
                                                                        <div class="col-12 col-md-12 cut-group">
                                                                            <select class="form-control select2" name="fltsieveid[]" id="fltsieveid" multiple="" tabindex="-1" aria-hidden="true">

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="text-center p-5 setresup">
                                                                    <button type="submit" class="btn send-btn dash-serchbtn" id="btnparceldiamondsearch" disabled="">Search</button>
                                                                    <input type="reset" id="btnresetparcelsearch" value="Reset" class="btn reset-btn dash-reset-btn">
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <div class="table-responsive listdiamondparcelDataDiv d-none searchpagedetail">
                                                            <div class="row searchheaddet">
                                                                <div class="col-md-6 moredetail">
                                                                    <ul>
                                                                        <li><b class="totalparceldiamonds"> 0 Dimonds </b>|</li>
                                                                        <li>&nbsp;<b class="totalparcelprice"> Total Price : $0 </b></li>
                                                                        <!-- <li>&nbsp; Total Carats 98,176,8 |</li>
                                                                        <li>&nbsp; Average $/ct 1,299 |</li>
                                                                        <li>&nbsp; Average Discount - 36.32%</li> -->
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="text-right searchhead">
                                                                        <div class="searchgreade searchcom setsho">
                                                                            <select class="form-control w-auto shortbydianmondse ml-auto" id="parcelsortbyid" name="parcelsortbyid">

                                                                            </select>
                                                                        </div>
                                                                        <div class="searchgreade searchcom">
                                                                            <button type="button" class="btn searchbtnset"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/3.svg" alt="diamonds sort by" title="diamonds sort by"></button>
                                                                        </div>
                                                                        <div class="searchgreade searchcom">
                                                                            <button type="button" class="btn searchbtnset navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle-parcel"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/fliter.svg" alt="diamonds filter" title="diamonds filter"></button>
                                                                        </div>
                                                                        <div class="searchgreade searchcom">
                                                                            <button type="button" id="btnnewparcelsearch" class="btn searchbtnset"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/search.svg" alt="diamonds new search" title="diamonds new search"> New Search</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="shapesearch searchparceldiamondlistDiv">
                                                                        <!-- <a href="javascript:void(0);" class="btn searchbtnset"><b> Shape : </b><Span>Round</Span></a> -->
                                                                        <!-- <button type="button" class="btn searchbtnset"><b> Size : </b><Span>0.30-0.39</Span></button>
                                                                        <button type="button" class="btn searchbtnset"><b> Shape : </b><Span>Round</Span></button> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <nav class="fliterset no-margin">
                                                                <!-- left bar end -->
                                                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                                                    <ul class="nav navbar-nav">
                                                                        <li class="active">
                                                                            <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-3"> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span></button>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </nav>
                                                            <div id="wrapper-parcel" class="wrappernew">
                                                                <div id="sidebar-wrapper" class="filternew sidebar-wrapper">
                                                                    <form action="javascript:void(0);" name="form-diamond-parcel-search" enctype="multipart/form-data" id="form-diamond-parcel-side-search" novalidate="novalidate">
                                                                        <h4>Filter</h4><button type="button" class="btn-close-sidebar btn-parcel-close-sidebar" aria-label="Close">x</button>
                                                                        <div class="searchgreade searchcom">
                                                                            <button type="submit" class="btn searchbtnset" id="btnapplyparceldiamondfilter" disabled>Apply</button>
                                                                        </div>
                                                                        <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
                                                                            <li class="s_shapeDiv">
                                                                                <div class="col-12 cut-group">
                                                                                    <div class="form-check">
                                                                                        <h5 class="d-inline">Shape</h5>

                                                                                        <select class="form-control select2" name="fltshapeparcelid[]" id="s_fltshapeparcelid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li class="s_sizeDiv">
                                                                                <div class="col-12 cut-group">
                                                                                    <h5 class="d-inline">Size</h5>
                                                                                    <div class="row fliterset">
                                                                                        <div class="col-md-6 cut-group">
                                                                                            <input type="text" id="s_fltfromparcelsize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="fltfromparcelsize" placeholder="From">
                                                                                        </div>
                                                                                        <h5>-</h5>
                                                                                        <div class="col-md-6 mt-auto cut-group">
                                                                                            <input type="text" id="s_flttoparcelsize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="flttoparcelsize" placeholder="To">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li class="s_colorDiv">
                                                                                <div class="col-12 cut-group">
                                                                                    <h5 class="d-inline">Color</h5>
                                                                                    <select class="form-control select2" name="fltcolorparcelid[]" id="s_fltcolorparcelid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                    </select>
                                                                                </div>
                                                                            </li>
                                                                            <li class="s_clarityDiv">
                                                                                <div class="col-12 cut-group">
                                                                                    <h5 class="d-inline">Clarity</h5>
                                                                                    <select class="form-control select2" name="fltclarityparcelid[]" id="s_fltclarityparcelid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                    </select>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="col-12 cut-group">
                                                                                    <h5 class="d-inline">Price</h5>
                                                                                    <div class="row setinputfli">
                                                                                        <!-- <h5 class="totalfil">$total</h5> -->
                                                                                        <div class="col-12 col-md-6 cut-group">
                                                                                            <input type="text" id="s_fltfrompriceparcel" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfrompriceparcel" placeholder="From">
                                                                                            <label class="inputset" type="number">Usd</label>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6 mt-auto cut-group">
                                                                                            <input type="text" id="s_flttopriceparcel" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttopriceparcel" placeholder="To">
                                                                                            <label class="inputset" type="number">Usd</label>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="col-12 cut-group">
                                                                                    <h5 class="d-inline">Piece Per Carat</h5>
                                                                                    <div class="row setinputfli">
                                                                                        <!-- <h5 class="totalfil">$total</h5> -->
                                                                                        <div class="col-12 col-md-6 cut-group">
                                                                                            <input type="text" id="s_fltfrompiecepercarat" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfrompiecepercarat" placeholder="From">
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6 mt-auto cut-group">
                                                                                            <input type="text" id="s_flttopiecepercarat" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttopiecepercarat" placeholder="To">
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </li>
                                                                            <li class="s_clarityDiv">
                                                                                <div class="col-12 cut-group">
                                                                                    <h5 class="d-inline">Sleeve</h5>
                                                                                    <select class="form-control select2" name="fltsieveid[]" id="s_fltsieveid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                    </select>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <table class="table mt-5 mb-5 table-tb setm-bottom" id="listparceldiamondDatatbl" data-show="0" data-nextpage="0">
                                                                <thead>
                                                                    <tr class="settabledi">
                                                                        <th>Seller</th>
                                                                        <!-- <th>rating</th> -->
                                                                        <th>Lot No.</th>
                                                                        <th>Shape</th>
                                                                        <th>Avg. Size</th>
                                                                        <th>Avg. Color</th>
                                                                        <th>Avg. Clarity</th>
                                                                        <!-- <th>Cut</th>
                                                                        <th>Polish</th>
                                                                        <th>Symm</th>
                                                                        <th>Fluor.</th>
                                                                        <th>Lab</th> -->
                                                                        <!-- <th>$/ct</th>
                                                                        <th>%Savani</th> -->
                                                                        <th>Price</th>
                                                                        <!-- <th>Depth</th>
                                                                        <th>Table</th>
                                                                        <th>Measurement</th>
                                                                        <th>Vendor Stock No.</th> -->
                                                                        <!-- <th>Status</th> -->
                                                                        <!-- <th>Media</th> -->
                                                                        <!-- <th>Ratio</th> -->
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="listparceldiamondData">

                                                                </tbody>
                                                            </table>
                                                            <div class="row">
                                                                <div class="text-left col-md-6"><b>Showing <span id="showparceldiamondentries"></span> Entry</b></div>
                                                                <div class="text-right col-md-2 offset-4"><b class="w-auto setallpageentry">Show <select class="form-control w-auto  ml-auto" id="parceldiamond_per_page" name="parceldiamond_per_page">
                                                                            <option value="20">20</option>
                                                                            <option value="50">50</option>
                                                                            <option value="100">100</option>
                                                                            <option value="500">500</option>
                                                                            <option value="1000">1000</option>
                                                                        </select> per page</b></div>
                                                            </div>
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
                        if ($CanListDiamondForList == 1) {
                        ?>
                            <div class="tab-pane" id="v-pills-2">
                                <div class="row row-eq-height">
                                    <div class="col-md-12">
                                        <div class="card my-3 border-0 bg-light-white">
                                            <div class="card-body chat-widget slimScroll p-0">
                                                <?php
                                                if ($CanListDiamondForList == 1) {
                                                ?>
                                                    <nav>
                                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                            <a class="nav-item nav-link active" id="nav-h-tab" data-toggle="tab" href="#nav-h" role="tab" aria-controls="nav-h" aria-selected="true">Single</a>
                                                            <?php
                                                            if ($CanListDiamondXL == 1) {
                                                            ?>
                                                                <a class="nav-item nav-link ml-2" id="nav-p-tab" data-toggle="tab" href="#nav-p" role="tab" aria-controls="nav-p" aria-selected="false">Multiple</a>
                                                            <?php
                                                            } ?>
                                                        </div>
                                                    </nav>
                                                <?php
                                                }
                                                if ($CanListDiamondForList == 1) {
                                                ?>
                                                    <div class="tab-content main-DiamondUploadFormDiv" id="nav-tabContent">
                                                        <div class="tab-pane fade show active" id="nav-h" role="tabpanel" aria-labelledby="nav-h-tab">
                                                            <div class="breadcrumbset">
                                                                <h5><span class="diamonduploadesirmodetext">Upload</span> Single item :</h5>
                                                                <div class="container">
                                                                    <!-- <div class="breadcrumb">
                                                                    <a href="javascript:void(0);"><b>1</b>General Information </a>
                                                                    <a href="javascript:void(0);"><b>2</b>Report Information </a>
                                                                    <a href="javascript:void(0);"><b>3</b>Other Information </a>
                                                                    <a href="javascript:void(0);"><b>4</b>Image &amp; report Scan </a>
                                                                    <a href="javascript:void(0);"><b>5</b>Additional Information </a>
                                                                </div> -->
                                                                    <ul class="uploaddiamondtabs  nav" role="tablist">
                                                                        <li class="tab-link ligeneralinfoDiv active" data-tab="1"><a class="nav-item active" data-typename="generalinfoDiv" id="nav-generalinfo-tab" data-toggle="tab" href="#generalinfoDiv" role="tab" aria-controls="generalinfoDiv" aria-selected="true"><b>1</b>General Information</a></li>
                                                                        <li class="tab-link lireportinfoDiv disabled" disabled data-tab="2"><a class="nav-item disabled" disabled data-typename="reportinfoDiv" id="nav-reportinfo-tab" data-toggle="tab" href="#reportinfoDiv" role="tab" aria-controls="reportinfoDiv" aria-selected="false"><b>2</b>Report Information</a></li>
                                                                        <li class="tab-link liotherinfoDiv disabled" disabled data-tab="3"><a class="nav-item disabled" disabled data-typename="otherinfoDiv" id="nav-otherinfo-tab" data-toggle="tab" href="#otherinfoDiv" role="tab" aria-controls="otherinfoDiv" aria-selected="false"><b>3</b>Other Information</a></li>
                                                                        <li class="tab-link liimgreportinfoDiv disabled" disabled data-tab="4"><a class="nav-item disabled" disabled data-typename="imgreportinfoDiv" id="nav-imgreportinfo-tab" data-toggle="tab" href="#imgreportinfoDiv" role="tab" aria-controls="imgreportinfoDiv" aria-selected="false"><b>4</b>Image &amp; Report Scan</a></li>
                                                                        <li class="tab-link liadditionalinfoDiv disabled" disabled data-tab="5"><a class="nav-item disabled" disabled data-typename="additionalinfoDiv" id="nav-additionalinfo-tab" data-toggle="tab" href="#additionalinfoDiv" role="tab" aria-controls="additionalinfoDiv" aria-selected="false"><b>5</b>Additional Information</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <form action="javascript:void(0);" name="form-diamond-upload" enctype="multipart/form-data" id="form-diamond-upload" novalidate="novalidate">
                                                                <input type="hidden" name="id" id="id" value="" />
                                                                <input type="hidden" name="formevent" id="formevent" value="submit" />
                                                                <div class="tab-content" id="nav-tabContent-DiamondUploadFormDiv">
                                                                    <div class="tab-pane fade show active" id="generalinfoDiv" role="tabpanel" aria-labelledby="nav-generalinfo-tab">
                                                                        <!-- one page start upload diamond -->
                                                                        <div class="">
                                                                            <div class="headingupload">
                                                                                <h2>General Information</h2>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-12 col-md-4 uploadset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Stock#</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch">
                                                                                                <div class="form-group">
                                                                                                    <label for="stock" class="col-form-label">Stock <span class="text-danger">*</span></label>
                                                                                                    <input type="text" class="form-control" autocomplete="off" placeholder="Enter" id="stock" name="stock">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-md-8 uploadset settresd">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Price & Availability</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12 col-lg-8 col-xl-8 col-sm-9 ctupsearch">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="price" class="col-form-label">Price <span class="text-danger">*</span></label>
                                                                                                                    <input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Price" id="price" name="price">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-6">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12 col-lg-8 col-xl-8 col-sm-9 ctupsearch">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="availabilityid" class="col-form-label">Availability</label>
                                                                                                                    <select id="availabilityid" name="availabilityid" class="form-control select2">

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
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-md-12 uploadset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Location</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-4 col-sm-4 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="countryid" class="col-form-label">Country</label>
                                                                                                            <select id="countryid" name="countryid" class="form-control select2">

                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4 col-sm-4 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="stateid" class="col-form-label">State</label>
                                                                                                            <select id="stateid" name="stateid" class="form-control select2">

                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4 col-sm-4 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="sharewithemail" class="col-form-label">City </label>
                                                                                                            <input type="text" class="form-control" autocomplete="off" placeholder="Enter" id="city" name="city">
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
                                                                                <!--  data-next-tab="reportinfoDiv" btnnextdiamonduploadform  -->
                                                                                <button type="button" id="btngeneralinfo" class="btn  uploadonenext">Next</button>
                                                                            </div>
                                                                        </div>
                                                                        <!-- one page end upload diamond -->
                                                                    </div>

                                                                    <div class="tab-pane fade show" id="reportinfoDiv" role="tabpanel" aria-labelledby="nav-reportinfo-tab">
                                                                        <!-- two page start upload diamond -->
                                                                        <div class="">
                                                                            <div class="headingupload">
                                                                                <h2>Report Information</h2>
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-lg-3 col-md-6 uploadset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Shape</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch">
                                                                                                <div class="form-group">
                                                                                                    <label for="shapeid" class="col-form-label">Shape <span class="text-danger">*</span></label>
                                                                                                    <select id="shapeid" name="shapeid" class="form-control select2">

                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-lg-3 col-md-6 uploadset showae showne">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Size</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch">
                                                                                                <div class="form-group">
                                                                                                    <label for="size" class="col-form-label">Size <span class="text-danger">*</span></label>
                                                                                                    <input type="text" class="form-control" onkeypress="numbonly(event);" onpaste="numbonly(event);" autocomplete="off" placeholder="Enter Size" id="size" name="size">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-lg-3 col-md-6 uploadset repose pset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Color</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch">
                                                                                                <div class="form-group">
                                                                                                    <label for="colorid" class="col-form-label">Color <span class="text-danger">*</span></label>
                                                                                                    <select id="colorid" name="colorid" class="form-control select2">

                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-lg-3 col-md-6 uploadset pset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Clarity</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch">
                                                                                                <div class="form-group">
                                                                                                    <label for="sharewithemail" class="col-form-label">Clarity <span class="text-danger">*</span></label>
                                                                                                    <select id="clarityid" name="clarityid" class="form-control select2">

                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-md-6 uploadset setpadbto">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Shape</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-4 col-sm-4 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="cutid" class="col-form-label">Cut</label>
                                                                                                            <select id="cutid" name="cutid" class="form-control select2">

                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4 col-sm-4 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="polishid" class="col-form-label">Polish</label>
                                                                                                            <select id="polishid" name="polishid" class="form-control select2">

                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4 col-sm-4 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="symmetryid" class="col-form-label">Symmetry </label>
                                                                                                            <select id="symmetryid" name="symmetryid" class="form-control select2">

                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-md-6 uploadset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Fluorescence</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6 col-sm-6">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12 ctupsearch">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="intensityid" class="col-form-label">Intensity</label>
                                                                                                                    <select id="intensityid" name="intensityid" class="form-control select2">

                                                                                                                    </select>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-6 col-sm-6">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12 ctupsearch">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="fluorescenecolorid" class="col-form-label">Color</label>
                                                                                                                    <select id="fluorescenecolorid" name="fluorescenecolorid" class="form-control select2">

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
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-md-6 uploadset setpadbto">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Measurement</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-4 col-sm-4 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="length" class="col-form-label">Length</label>
                                                                                                            <input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Length" id="length" name="length">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4 col-sm-4 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="width" class="col-form-label">Width</label>
                                                                                                            <input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Width" id="width" name="width">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4 col-sm-4 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="depth" class="col-form-label">Depth </label>
                                                                                                            <input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Depth" id="depth" name="depth">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-md-6 uploadset ">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 col-sm-6 setpadbto">
                                                                                            <div class="card-body">
                                                                                                <div class="stockuplod">
                                                                                                    <h4>Depth(%)</h4>
                                                                                                    <hr>
                                                                                                </div>
                                                                                                <div class="manisecupload ctupsearch">
                                                                                                    <div class="form-group">
                                                                                                        <label for="sharewithemail" class="col-form-label">Depth(%)</label>
                                                                                                        <input type="text" class="form-control inputper" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Depth(%)" id="depthper" name="depthper">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-6">
                                                                                            <div class="card-body">
                                                                                                <div class="stockuplod">
                                                                                                    <h4>Table(%)</h4>
                                                                                                    <hr>
                                                                                                </div>
                                                                                                <div class="manisecupload ctupsearch">
                                                                                                    <div class="form-group">
                                                                                                        <label for="sharewithemail" class="col-form-label">Table(%)</label>
                                                                                                        <input type="text" class="form-control inputper" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Table(%)" id="tableper" name="tableper">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-md-6 uploadset setpadbto">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Crown</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6 col-sm-6">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12 ctupsearch">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="crownangle" class="col-form-label">Angle</label>
                                                                                                                    <input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Crown Angle" id="crownangle" name="crownangle">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-6 col-sm-6">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12 ctupsearch">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="crownheight" class="col-form-label">Height</label>
                                                                                                                    <input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Crown Height" id="crownheight" name="crownheight">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-md-6 uploadset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Pavilion</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6 col-sm-6">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12 ctupsearch">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="pavilionangle" class="col-form-label">Angle</label>
                                                                                                                    <input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Pavilion Angle" id="pavilionangle" name="pavilionangle">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-6 col-sm-6">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12 ctupsearch">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="pavilionheight" class="col-form-label">Height</label>
                                                                                                                    <input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Pavilion Height" id="pavilionheight" name="pavilionheight">
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
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-md-8 uploadset setpadbto">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Gridle</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-3 col-sm-6 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="gridleconditionid" class="col-form-label">Condition</label>
                                                                                                            <select id="gridleconditionid" name="gridleconditionid" class="form-control select2">

                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 col-sm-6 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="gridleminid" class="col-form-label">Min.</label>
                                                                                                            <select id="gridleminid" name="gridleminid" class="form-control select2">

                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 col-sm-6 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="gridlemaxid" class="col-form-label">Max. </label>
                                                                                                            <select id="gridlemaxid" name="gridlemaxid" class="form-control select2">

                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 col-sm-6 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="gridleper" class="col-form-label">Gridle(%)</label>
                                                                                                            <input type="text" class="form-control inputper" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Gridle(%)" id="gridleper" name="gridleper">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-md-4 uploadset">
                                                                                    <div class="card-body">
                                                                                        <div class="stockuplod">
                                                                                            <h4>Culet</h4>
                                                                                            <hr>
                                                                                        </div>
                                                                                        <div class="manisecupload ctupsearch">
                                                                                            <div class="row">
                                                                                                <div class="col-md-6 col-sm-6 ctupsearch">
                                                                                                    <div class="form-group">
                                                                                                        <label for="culetconditionid" class="col-form-label">Condition </label>
                                                                                                        <select id="culetconditionid" name="culetconditionid" class="form-control select2">

                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6 ctupsearch">
                                                                                                    <div class="form-group">
                                                                                                        <label for="culetsizeid" class="col-form-label">Size </label>
                                                                                                        <select id="culetsizeid" name="culetsizeid" class="form-control select2">

                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-lg-6 col-md-12 uploadset showae setpeddind">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Treatment</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="treatmentid" class="col-form-label">Treatment</label>
                                                                                                            <select id="treatmentid" name="treatmentid[]" multiple class="form-control select2">

                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-lg-6 col-md-12 uploadset repose pset ">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 col-sm-6 setpadbto">
                                                                                            <div class="card-body">
                                                                                                <div class="stockuplod">
                                                                                                    <h4>Laser Inscription </h4>
                                                                                                    <hr>
                                                                                                </div>
                                                                                                <div class="manisecupload ctupsearch">
                                                                                                    <div class="form-group">
                                                                                                        <label for="sharewithemail" class="col-form-label">Laser Inscription</label>
                                                                                                        <textarea class="form-control" autocomplete="off" placeholder="Enter Laser Inscription" id="laserinscription" name="laserinscription"></textarea>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-6">
                                                                                            <div class="card-body">
                                                                                                <div class="stockuplod">
                                                                                                    <h4>Star length</h4>
                                                                                                    <hr>
                                                                                                </div>
                                                                                                <div class="manisecupload ctupsearch">
                                                                                                    <div class="form-group">
                                                                                                        <label for="sharewithemail" class="col-form-label">Star Length</label>
                                                                                                        <input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Star Length" id="starlength" name="starlength">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-lg-2 col-md-4 uploadset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Lab</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch">
                                                                                                <div class="form-group">
                                                                                                    <label for="labid" class="col-form-label">Lab</label>
                                                                                                    <select id="labid" name="labid" class="form-control select2">

                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-lg-6 col-md-8 uploadset showae showne">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod stfancy setflex">
                                                                                                <h4>Report No.</h4>
                                                                                                <p>Show on Trade CVD </p>
                                                                                                <div class="text-right float-right setswitch setswondi">
                                                                                                    <label class="switch">
                                                                                                        <input type="checkbox" name="showonsavanigems" value="1" id="showonsavanigems" />
                                                                                                        <span class="slider round"></span>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <hr>

                                                                                            <div class="manisecupload ctupsearch">
                                                                                                <div class="form-group">
                                                                                                    <label for="reportnumber" class="col-form-label">Report No.</label>
                                                                                                    <input type="text" class="form-control" autocomplete="off" placeholder="Enter Report No." id="reportnumber" name="reportnumber">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-lg-2 col-md-6 uploadset repose pset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Report Date</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch">
                                                                                                <div class="form-group">
                                                                                                    <label for="reportdate" class="col-form-label">Report Date</label>
                                                                                                    <input type="text" readonly="" class="form-control" value="<?php echo $IISMethods->getcurrdate(); ?>" placeholder="Enter Report Date" id="reportdate" name="reportdate">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-lg-2 col-md-6 uploadset pset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Lab Location</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch">
                                                                                                <div class="form-group">
                                                                                                    <label for="lablocation" class="col-form-label">Lab Location</label>
                                                                                                    <input type="text" class="form-control" autocomplete="off" placeholder="Enter Lab Location" id="lablocation" name="lablocation">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-md-12 uploadset reset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Report Comment</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch">
                                                                                                <div class="form-group">
                                                                                                    <label for="reportcomment" class="col-form-label">Report Comment</label>
                                                                                                    <textarea class="form-control" autocomplete="off" placeholder="Enter Report Comment" id="reportcomment" name="reportcomment"></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-md-12 uploadset reset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Key to Symbols</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch">
                                                                                                <div class="form-group">
                                                                                                    <label for="keytosymbolsid" class="col-form-label">Key To Symbols</label>
                                                                                                    <select id="keytosymbolsid" name="keytosymbolsid[]" multiple class="form-control select2">

                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-md-12 uploadset reset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod stfancy reset">
                                                                                                <h4>Fancy Color</h4>
                                                                                                <label class="switch">
                                                                                                    <input type="checkbox" name="withfancycolor" value="1" id="withfancycolor">
                                                                                                    <span class="slider round"></span>
                                                                                                </label>
                                                                                            </div>
                                                                                            <hr>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-3 col-sm-6 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="fancyintensityid" class="col-form-label">Intensity</label>
                                                                                                            <select id="fancyintensityid" disabled name="fancyintensityid" class="form-control withfancycolorData disabled select2">

                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 col-sm-6 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="overtoneid" class="col-form-label">Overtone</label>
                                                                                                            <select id="overtoneid" disabled name="overtoneid[]" multiple class="form-control withfancycolorData disabled select2">

                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 col-sm-6 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="fancycolorid1" class="col-form-label">Color 1</label>
                                                                                                            <select id="fancycolorid1" disabled name="fancycolorid1" class="form-control withfancycolorData disabled select2">

                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 col-sm-6 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="fancycolorid2" class="col-form-label">Color 2</label>
                                                                                                            <select id="fancycolorid2" disabled name="fancycolorid2" class="form-control withfancycolorData disabled select2">

                                                                                                            </select>
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
                                                                                <button type="button" id="btnreportinfo" class="btn upnext uploadtw">Next</button>
                                                                                <button type="button" data-prev-tab="generalinfoDiv" class="btn npback btnprevdiamonduploadform uploadbacktw">Back</button>
                                                                            </div>
                                                                        </div>
                                                                        <!-- two page end upload diamond -->
                                                                    </div>

                                                                    <div class="tab-pane fade show" id="otherinfoDiv" role="tabpanel" aria-labelledby="nav-otherinfo-tab">
                                                                        <!-- three page start upload diamond -->
                                                                        <div class="">
                                                                            <div class="headingupload">
                                                                                <h2>Other Information</h2>
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-lg-3 col-md-6 uploadset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod stfancy">
                                                                                                <h4>Matched Pair</h4>
                                                                                                <label class="switch">
                                                                                                    <input type="checkbox" name="matchedpair" value="1" id="matchedpair">
                                                                                                    <span class="slider round"></span>
                                                                                                </label>
                                                                                            </div>
                                                                                            <hr>
                                                                                            <div class="row">
                                                                                                <div class="col-md-8 col-sm-9 ctupsearch stfancy1">
                                                                                                    <div class="form-group">
                                                                                                        <input type="text" class="form-control matchedpairData disabled" disabled autocomplete="off" placeholder="Enter Stock Number" id="stocknumber" name="stocknumber">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-4 col-sm-3 checkrdioupload setcheckrdioupload stfancy1">
                                                                                                    <p>Is Pair Separable</p>
                                                                                                    <label class="switch">
                                                                                                        <input type="checkbox" class="matchedpairData disabled" disabled name="ispairseparable" value="1" id="ispairseparable">
                                                                                                        <span class="slider round"></span>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-lg-3 col-md-6 uploadset showae showne">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod stfancy">
                                                                                                <h4>Downlod</h4>
                                                                                                <label class="switch">
                                                                                                    <input type="checkbox" name="isdownload" value="1" id="isdownload">
                                                                                                    <span class="slider round"></span>
                                                                                                </label>
                                                                                            </div>
                                                                                            <hr>
                                                                                            <div class="manisecupload ctupsearch uploadmaset">
                                                                                                <div class="form-group">
                                                                                                    <p class="textup">Allow approved member to download this diamond via savani link diamond link service or instant inventory.</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-lg-3 col-md-6 uploadset repose pset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Trade show</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch uploadmaset">
                                                                                                <div class="form-group">
                                                                                                    <select id="tradeshowid" name="tradeshowid" class="form-control select2">

                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-lg-3 col-md-6 uploadset pset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Brand</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch uploadmaset">
                                                                                                <div class="form-group">
                                                                                                    <select id="brandid" name="brandid" class="form-control select2">

                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-md-8 uploadset setpadbto">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Supplier Comment</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="suppliercomment" class="col-form-label">Comment </label>
                                                                                                            <textarea class="form-control" autocomplete="off" placeholder="Enter Comment" id="suppliercomment" name="suppliercomment"></textarea>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-md-4 uploadset">
                                                                                    <div class="card-body">
                                                                                        <div class="stockuplod stfancy">
                                                                                            <h4>Parcel</h4>
                                                                                            <label class="switch">
                                                                                                <input type="checkbox" name="isparcel" value="1" id="isparcel">
                                                                                                <span class="slider round"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <hr>
                                                                                        <div class="manisecupload ctupsearch">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 ctupsearch">
                                                                                                    <div class="form-group">
                                                                                                        <label for="numofdiamond" class="col-form-label">Number of Diamond </label>
                                                                                                        <input type="text" class="form-control disabled" disabled onkeypress="numbonly(event);" onpaste="numbonly(event);" autocomplete="off" placeholder="Enter Number of Diamond" id="numofdiamond" name="numofdiamond">
                                                                                                        <h6>Specify Total Size in " Size " Filed</h6>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <br><br><br><br><br><br>
                                                                            <div class="row text-center nextuplo">
                                                                                <button type="button" data-next-tab="imgreportinfoDiv" class="btn upnext btnnextdiamonduploadform uploadthr">Next</button>
                                                                                <button type="button" data-prev-tab="reportinfoDiv" class="btn btnprevdiamonduploadform npback">Back</button>
                                                                            </div>
                                                                        </div>
                                                                        <!-- three page end upload diamond -->
                                                                    </div>
                                                                    <div class="tab-pane fade show" id="imgreportinfoDiv" role="tabpanel" aria-labelledby="nav-imgreportinfo-tab">
                                                                        <!-- four page start upload diamond -->
                                                                        <div class="">
                                                                            <div class="headingupload">
                                                                                <h2>Image &amp; Report Scan</h2>
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-lg-6 col-md-12 uploadset showae">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Report File</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6 col-sm-6 setpadbto">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12 ctupsearch uploadmaset">
                                                                                                                <div class="form-group filepreview">
                                                                                                                    <input type="file" id="reportfile" class="uploadbtnset form-control" name="reportfile" />
                                                                                                                    <h5 class="orsetsearch">Or</h5>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-6 col-sm-6">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12 ctupsearch uploadmaset">
                                                                                                                <div class="form-group">
                                                                                                                    <input type="text" class="form-control" autocomplete="off" placeholder="Enter File Link" id="reportfilelink" name="reportfilelink">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row mt-2">
                                                                                                    <div class="col-md-12 col-sm-12 mydiamondreportfileDiv">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-lg-6 col-md-12 uploadset repose pset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Diamond Media</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-4 col-sm-4 setpadbto">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12 ctupsearch uploadmaset">
                                                                                                                <div class="form-group filepreview">
                                                                                                                    <input type="file" id="diamondimg" multiple="multiple" class="uploadbtnset form-control" accept="image/png, image/jpg, image/jpeg" name="diamondimg[]" />
                                                                                                                    <h5 class="orsetsearch">Or</h5>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4 col-sm-4">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12 ctupsearch uploadmaset">
                                                                                                                <div class="form-group">
                                                                                                                    <input type="text" class="form-control" autocomplete="off" placeholder="Enter Image Link" id="diamondimglink" name="diamondimglink">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4 col-sm-4">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12 ctupsearch uploadmaset">
                                                                                                                <div class="form-group">
                                                                                                                    <input type="text" class="form-control" autocomplete="off" placeholder="Enter Video Link" id="videolink" name="videolink">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row mt-2 mydiamondmediafileDiv">
                                                                                                        <!-- <div class="">
                                                                                                        
                                                                                                    </div> -->
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-lg-6 col-md-12 uploadset showae">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Sarine Loupe</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12 ctupsearch">
                                                                                                        <div class="form-group">
                                                                                                            <label for="sarineloupe" class="col-form-label">Sarine Loupe</label>
                                                                                                            <textarea class="form-control" autocomplete="off" placeholder="Enter Sarine Loupe" id="sarineloupe" name="sarineloupe"></textarea>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-md-6 uploadset">

                                                                                </div>
                                                                            </div>
                                                                            <br><br><br><br><br><br>
                                                                            <div class="row text-center nextuplo">
                                                                                <button type="button" data-next-tab="additionalinfoDiv" class="btn upnext btnnextdiamonduploadform uploadfo">Next</button>
                                                                                <button type="button" data-prev-tab="otherinfoDiv" class="btn btnprevdiamonduploadform npback">Back</button>
                                                                            </div>
                                                                        </div>
                                                                        <!-- four page end upload diamond -->
                                                                    </div>
                                                                    <div class="tab-pane fade show" id="additionalinfoDiv" role="tabpanel" aria-labelledby="nav-additionalinfo-tab">
                                                                        <!-- five page start upload diamond -->
                                                                        <div class="">
                                                                            <div class="headingupload">
                                                                                <h2>Additional Information</h2>
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-lg-3 col-md-6 uploadset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Seller Spec.</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch uploadmaset">
                                                                                                <div class="form-group">
                                                                                                    <textarea class="form-control" autocomplete="off" placeholder="Enter Seller Specification" id="sellerspecification" name="sellerspecification"></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-lg-2 col-md-6 uploadset showae showne">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Shade</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch uploadmaset">
                                                                                                <div class="form-group">
                                                                                                    <select id="shadeid" name="shadeid" class="form-control select2">

                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-lg-2 col-md-4 uploadset repose pset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Milky</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch uploadmaset">
                                                                                                <div class="form-group">
                                                                                                    <select id="milkyid" name="milkyid" class="form-control select2">

                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-lg-2 col-md-4 uploadset pset showne setseno">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Eye Clean</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch uploadmaset">
                                                                                                <div class="form-group">
                                                                                                    <select id="eyecleanid" name="eyecleanid" class="form-control select2">

                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-lg-3 col-md-4 uploadset pset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Open Inclusions</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch uploadmaset">
                                                                                                <div class="form-group">
                                                                                                    <select id="openinclusionsid" name="openinclusionsid[]" multiple class="form-control select2">

                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-md-6 uploadset setpadbto">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Black inclusions</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12 ctupsearch uploadmaset">
                                                                                                                <div class="form-group">
                                                                                                                    <select id="blackinclusionsid" name="blackinclusionsid[]" multiple class="form-control select2">

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
                                                                                <div class="col-12 col-md-6 uploadset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>White inclusions</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12 ctupsearch uploadmaset">
                                                                                                                <div class="form-group">
                                                                                                                    <select id="whiteinclusionsid" name="whiteinclusionsid[]" multiple class="form-control select2">

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
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-md-12 uploadset reset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Rough Diamond Source</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch uploadmaset">
                                                                                                <div class="form-group">
                                                                                                    <select id="roughdiamondsourceid" name="roughdiamondsourceid" class="form-control select2">

                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row upset">
                                                                                <div class="col-12 col-md-6 uploadset reset">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Piece Per Carat</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch uploadmaset">
                                                                                                <div class="form-group">
                                                                                                    <input type="text" class="form-control" autocomplete="off" placeholder="Enter Piece Per Carat" id="piecepercarat" name="piecepercarat">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-md-6 uploadset reset settresd">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="stockuplod">
                                                                                                <h4>Sleeve</h4>
                                                                                                <hr>
                                                                                            </div>
                                                                                            <div class="manisecupload ctupsearch uploadmaset">
                                                                                                <div class="form-group">
                                                                                                    <select id="sieveid" name="sieveid" class="form-control select2">

                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <br><br><br><br><br><br>
                                                                            <div class="row text-center nextuplo">
                                                                                <button type="submit" id="btnsavediamond" class="btn upnext">Save</button>
                                                                                <button type="button" data-prev-tab="imgreportinfoDiv" class="btn btnprevdiamonduploadform npback">Back</button>&nbsp;&nbsp;
                                                                                <button type="reset" data-next-tab="generalinfoDiv" id="btnresetdiamondupload" class="btn npback">Reset</button>
                                                                            </div>
                                                                        </div>
                                                                        <!-- five page end upload diamond -->
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <?php
                                                        if ($CanListDiamondXL == 1) {
                                                        ?>
                                                            <!-- multiple tab start -->
                                                            <div class="tab-pane fade" id="nav-p" role="tabpanel" aria-labelledby="nav-p-tab">
                                                                <div class="multiupload">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <div class="multinote" id="diamondcsvuploaddetail">

                                                                                    </div>
                                                                                    <br><br>
                                                                                    <form action="javascript:void(0);" name="form-diamond-csv-upload" enctype="multipart/form-data" id="form-diamond-csv-upload" novalidate="novalidate">
                                                                                        <div class="row">
                                                                                            <div class="col-md-4 offset-4 setdowup">
                                                                                                <p>Download CSV Format : <a href="<?php echo $config->getImageurl(); ?>files/uploaddiamond.csv"><b>Click Here</b></a></p>
                                                                                            </div>
                                                                                            <!-- <div class="col-md-6">
                                                                                        <p class="selectedfilenameTag">Selected File Name : </a></p>                
                                                                                    </div>                         -->
                                                                                        </div>
                                                                                        <div class="fileseset text-center">
                                                                                            <div class="fileico">
                                                                                                <!-- <button class="fisesearchup" onclick="importData()">Import</button> -->
                                                                                                <input class="fisesearchup" type="file" name="csvfile" id="diamondcsvfile" accept=".csv">
                                                                                                <i class="fal fa-file"></i>
                                                                                            </div>
                                                                                            <p>Drop File Here Or <b>Browse</b></p>
                                                                                            <p class="selectedfilenameText">No File Selected.</p>
                                                                                        </div>
                                                                                        <div class="text-center p-5 setresup">
                                                                                            <button type="submit" id="btndiamondcsvupload" disabled class="btn send-btn dash-serchbtn">Upload</button>
                                                                                            <input type="reset" value="Reset" id="btnresetdiamondcsvupload" class="btn reset-btn dash-reset-btn">
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- multiple tab end -->
                                                        <?php
                                                        } ?>
                                                    </div>
                                                <?php
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane  show" id="v-pills-3">
                                <div class="row row-eq-height">
                                    <!-- Chat Widget Start -->
                                    <div class="col-md-12">
                                        <div class="card my-3 border-0 bg-light-gray">
                                            <div class="card-body chat-widget slimScroll p-0" data-height="100%">
                                                <div class="table-responsive listmydiamondDataDiv">
                                                    <div class="row searchheaddet">
                                                        <div class="col-md-6 moredetail">
                                                            <ul>
                                                                <li><b class="totalmydiamonds"> 0 Dimonds </b>|</li>
                                                                <li>&nbsp;<b class="totalmyprice"> Total Price : $0 </b></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="text-right searchhead">
                                                                <div class="searchgreade searchcom setsho">
                                                                    <select class="form-control w-auto shortbydianmondse ml-auto" id="mydiamondsortbyid" name="mydiamondsortbyid">

                                                                    </select>
                                                                </div>
                                                                <div class="searchgreade searchcom">
                                                                    <button type="button" class="btn searchbtnset"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/3.svg" alt="diamonds sort by" title="diamonds sort by"></button>
                                                                </div>
                                                                <div class="searchgreade searchcom">
                                                                    <button type="button" class="btn searchbtnset navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle-mydiamond"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/fliter.svg" alt="diamonds filter" title="diamonds filter"></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="shapesearch searchmydiamondlistDiv">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="wrapper-mydiamond" class="wrappernew">
                                                        <div id="sidebar-wrapper" class="filternew sidebar-wrapper">
                                                            <form action="javascript:void(0);" name="form-mydiamond-search" enctype="multipart/form-data" id="form-mydiamond-side-search" novalidate="novalidate">
                                                                <h4>Filter</h4><button type="button" class="btn-close-sidebar btn-mydiamond-close-sidebar" aria-label="Close">x</button>
                                                                <div class="searchgreade searchcom">
                                                                    <button type="submit" class="btn searchbtnset" id="btnapplymydiamonddiamondfilter" disabled>Apply</button>
                                                                </div>
                                                                <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
                                                                    <li class="s_mdshapeDiv">
                                                                        <div class="col-12 cut-group">
                                                                            <div class="form-check">
                                                                                <h5 class="d-inline">Shape</h5>
                                                                                <select class="form-control select2" name="fltshapeid[]" id="s_mdfltshapemdid" multiple="" tabindex="-1" aria-hidden="true">

                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="s_mdsizeDiv">
                                                                        <div class="col-12 cut-group">
                                                                            <h5 class="d-inline">Size</h5>
                                                                            <div class="row fliterset">
                                                                                <div class="col-md-6 cut-group">
                                                                                    <input type="text" id="s_mdfltfrommdsize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="fltfromsize" placeholder="From">
                                                                                </div>
                                                                                <h5>-</h5>
                                                                                <div class="col-md-6 mt-auto cut-group">
                                                                                    <input type="text" id="s_mdflttomdsize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="flttosize" placeholder="To">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="s_mdcolorDiv">
                                                                        <div class="col-12 cut-group">
                                                                            <h5 class="d-inline">Color</h5>
                                                                            <select class="form-control select2" name="fltcolorid[]" id="s_mdfltcolormdid" multiple="" tabindex="-1" aria-hidden="true">

                                                                            </select>
                                                                        </div>
                                                                    </li>
                                                                    <li class="s_mdclarityDiv">
                                                                        <div class="col-12 cut-group">
                                                                            <h5 class="d-inline">Clarity</h5>
                                                                            <select class="form-control select2" name="fltclarityid[]" id="s_mdfltclaritymdid" multiple="" tabindex="-1" aria-hidden="true">

                                                                            </select>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="col-12 cut-group">
                                                                            <h5 class="d-inline">Price</h5>
                                                                            <div class="row setinputfli">
                                                                                <!-- <h5 class="totalfil">$total</h5> -->
                                                                                <div class="col-12 col-md-6 cut-group">
                                                                                    <input type="text" id="s_mdfltfrompricemd" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromprice" placeholder="From">
                                                                                    <label class="inputset" type="number">Usd</label>
                                                                                </div>
                                                                                <div class="col-12 col-md-6 mt-auto cut-group">
                                                                                    <input type="text" id="s_mdflttopricemd" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttoprice" placeholder="To">
                                                                                    <label class="inputset" type="number">Usd</label>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <table class="table mt-5 mb-5 table-tb" id="listmydiamondDatatbl" data-show="0" data-nextpage="0">
                                                        <thead>
                                                            <tr class="settabledi">
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
                                                                <th>Price</th>
                                                                <th>Depth</th>
                                                                <th>Table</th>
                                                                <th>Measurement</th>
                                                                <th>Vendor Stock No.</th>
                                                                <!-- <th>Action</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody id="listmydiamondData">

                                                        </tbody>
                                                    </table>
                                                    <div class="row">
                                                        <div class="text-left col-md-6"><b>Showing <span id="showmydiamondentries"></span> entry</b></div>
                                                        <div class="text-right col-md-2 offset-4">
                                                            <b class="w-auto setallpageentry">entry
                                                                <select class="form-control w-auto  ml-auto" id="my_diamond_per_page" name="my_diamond_per_page">
                                                                    <option value="20">20</option>
                                                                    <option value="50">50</option>
                                                                    <option value="100">100</option>
                                                                    <option value="500">500</option>
                                                                    <option value="1000">1000</option>
                                                                </select> per page</b>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>
                <!-- Footer Start -->
                <?php include('footer.php'); ?>
                <!-- Footer End -->

                <!-- JS Start -->

                <!-- JS End -->
            </div>
</body>
<?php include('js.php'); ?>

<script>
    $(document).ready(function() {

        $("#Diamond-pills-tab li:first-child a").click();

        fillcontentsetting();
        var id = '<?php echo $id ?>';
        if (id) {
            listdiamonddata(1);
        }

        $('#reportdate').datepicker({
            dateFormat: 'dd/mm/yy',
        });

        listshape();
        listcolor();
        listclarity();
        listeyeclean();
        listmilky();
        listopeninclusion();
        listwhiteinclusion();
        listblackinclusion();
        listshade();
        listcut();
        listpolish();
        listsymmetry();
        listintensity();
        listfluorescencecolor();
        listlab();
        listlocation();
        listcompanycode();
        liststocknumbers();
        listlotnumbers();
        listroughsource();
        listtreatment();
        listkeytosymbol();
        listbrand();
        listshapeparcel();
        listcolorparcel();
        listclarityparcel();
        listsieve();
        listsize();
        listdiamondsortby();
        // checkdiamondformelementvalue();
        listavailability();
        listcountry();
        listgridlecondition();
        listgridlemin();
        listgridlemax();
        listculetcondition();
        listculetsize();
        listfancyintensity();
        listovertone();
        listcolor1();
        listcolor2();
        listtreadeshow();
        listmydiamondsortby();
    });

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").addClass("toggled");
        $("#wrapper").removeClass("intro");
    });

    $(".btn-close-sidebar").click(function() {
        //   $("#wrapper").removeClass("toggled");
        $("#wrapper").addClass("intro");
    });

    $("#menu-toggle-2").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled-2");
        $('#menu ul').hide();
    });



    $("#menu-toggle-parcel").click(function(e) {
        e.preventDefault();
        $("#wrapper-parcel").addClass("toggled");
        $("#wrapper-parcel").removeClass("intro");
    });

    $(".btn-parcel-close-sidebar").click(function() {
        //   $("#wrapper").removeClass("toggled");
        $("#wrapper-parcel").addClass("intro");
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

    /* ******SHAPE******* */
    function listshape(shapeid = '') {
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
            var s_htmldata = '';
            var form_htmldata = '';
            var fltform_htmldata = '';
            form_htmldata += '<option value="">Select Shape</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                $('.shapeDiv').addClass('d-none');
                $('.s_shapeDiv').addClass('d-none');
                $('.s_mdshapeDiv').addClass('d-none');
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.shapeDiv').removeClass('d-none');
                        $('.s_shapeDiv').removeClass('d-none');
                        $('.s_mdshapeDiv').removeClass('d-none');
                        htmldata += '<div class="filter-container">';
                        for (var i in resultdata.data) {
                            htmldata += '<div class="filter custom-checkbox">';
                            htmldata += '<input type="checkbox" id="f' + resultdata.data[i].id + '" data-name="' + resultdata.data[i].name + '" name="fltshapeid[]" class="dashboard-control custom-control-input fltshapeid" value="' + resultdata.data[i].id + '">';
                            htmldata += '<label for="f' + resultdata.data[i].id + '" class="custom-control-label with-img">';

                            htmldata += '<span class="img-wrap">';
                            if (resultdata.data[i].img != '') {
                                htmldata += '<img src="<?php echo $config->getimageurl() ?>' + resultdata.data[i].img + '" alt="' + resultdata.data[i].name + '" class="img-responsive">';
                            }
                            htmldata += ' </span>';

                            htmldata += '<span class="text-label">' + resultdata.data[i].name + '</span>';
                            htmldata += '</label>';
                            htmldata += '</div>';

                            s_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            fltform_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                        htmldata += '</div>';
                    }

                    if (resultdata.data.length > 14) {
                        htmldata += '<button type="button" class="btn show-more-filters">';
                        htmldata += '<span class="text">+ 30 More</span>';
                        htmldata += '<span class="text opened">- 30 Less</span>';
                        htmldata += '<span class="arrow-btn">';
                        htmldata += '<img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">';
                        htmldata += '</span>';
                        htmldata += '</button>';
                    }
                }



            }
            $('#shapeDivData').html(htmldata);
            $('#s_fltshapeid').html(s_htmldata);
            $('#s_fltshapeid').select2();
            $('#shapeid').html(form_htmldata);
            if (shapeid) {
                $('#shapeid').val(shapeid);
            }
            $('#shapeid').select2();
            $('#s_mdfltshapemdid').html(fltform_htmldata);
            $('#s_mdfltshapemdid').select2();
        }

        function OnErrorlistshape(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }


    /* ******SIZE******* */
    function listsize() {
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
        formdata.append("action", "listsize");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistsize, OnErrorlistsize);

        function Onsuccesslistsize(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var s_htmldata = '';

            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                $('.sizeDiv').addClass('d-none');
                $('.s_sizeDiv').addClass('d-none');
                if (resultdata.data.length > 0) {
                    $('.sizeDiv').removeClass('d-none');
                    $('.s_sizeDiv').removeClass('d-none');
                    htmldata += '<div class="filter-container">';
                    for (var i in resultdata.data) {
                        htmldata += '<div class="filter custom-checkbox">';
                        htmldata += '<input type="checkbox" id="f' + resultdata.data[i].id + '" data-name="' + resultdata.data[i].name + '" name="fltsizeid[]" class="dashboard-control custom-control-input" value="' + resultdata.data[i].id + '">';
                        htmldata += '<label for="f' + resultdata.data[i].id + '" class="custom-control-label">';
                        htmldata += '<span class="text-label">' + resultdata.data[i].name + '</span>';
                        htmldata += '</label>';
                        htmldata += '</div>';

                        s_htmldata += '<div class="col-12 col-md-12 cut-group">';
                        s_htmldata += '<div class="form-check">';
                        s_htmldata += '<input class="form-check-input" type="checkbox" data-name="' + resultdata.data[i].name + '" name="fltsizeid[]" value="' + resultdata.data[i].id + '" id="s_fltsizeid' + resultdata.data[i].id + '">';
                        s_htmldata += '<label class="form-check-label ml-4" for="s_fltsizeid' + resultdata.data[i].id + '">';
                        s_htmldata += '' + resultdata.data[i].name + '';
                        s_htmldata += '</label>';
                        s_htmldata += '</div>';
                        s_htmldata += '</div>';
                    }
                    htmldata += '</div>';




                }

                if (resultdata.data.length > 14) {
                    htmldata += '<button type="button" class="btn show-more-filters">';
                    htmldata += '<span class="text">+ 30 More</span>';
                    htmldata += '<span class="text opened">- 30 Less</span>';
                    htmldata += '<span class="arrow-btn">';
                    htmldata += '<img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">';
                    htmldata += '</span>';
                    htmldata += '</button>';
                }

            }
            $('#sizeDivData').html(htmldata);
            $('#s_sizeDivData').html(s_htmldata);
        }

        function OnErrorlistsize(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    /* ******COLOR******* */
    function listcolor(colorid = '') {
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
        formdata.append("action", "listdiamondcolor");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistcolor, OnErrorlistcolor);

        function Onsuccesslistcolor(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var s_htmldata = '';
            var form_htmldata = '';
            var fltform_htmldata = '';
            form_htmldata += '<option value="">Select Color</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                $('.colorDiv').addClass('d-none');
                $('.s_colorDiv').addClass('d-none');
                $('.s_mdcolorDiv').addClass('d-none');
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.colorDiv').removeClass('d-none');
                        $('.s_colorDiv').removeClass('d-none');
                        $('.s_mdcolorDiv').removeClass('d-none');
                        htmldata += '<div class="filter-container">';
                        for (var i in resultdata.data) {
                            htmldata += '<div class="filter custom-checkbox">';
                            htmldata += '<input type="checkbox" id="c' + resultdata.data[i].id + '" data-name="' + resultdata.data[i].name + '" name="fltcolorid[]" class="dashboard-control custom-control-input" value="' + resultdata.data[i].id + '">';
                            htmldata += '<label for="c' + resultdata.data[i].id + '" class="custom-control-label">' + resultdata.data[i].name + '</label>';
                            htmldata += '</div>';

                            s_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            fltform_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                        }
                        htmldata += '</div>';
                    }

                    if (resultdata.data.length > 14) {
                        htmldata += '<button type="button" class="btn show-more-filters">';
                        htmldata += '<span class="text">+ 30 More</span>';
                        htmldata += '<span class="text opened">- 30 Less</span>';
                        htmldata += '<span class="arrow-btn">';
                        htmldata += '<img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">';
                        htmldata += '</span>';
                        htmldata += '</button>';
                    }
                }

            }
            $('#colorDivData').html(htmldata);
            $('#s_fltcolorid').html(s_htmldata);
            $('#s_fltcolorid').select2();
            $('#colorid').html(form_htmldata);
            if (colorid) {
                $('#colorid').val(colorid);
            }

            $('#colorid').select2();
            $('#s_mdfltcolormdid').html(fltform_htmldata);
            $('#s_mdfltcolormdid').select2();
        }

        function OnErrorlistcolor(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******CLARITY******* */
    function listclarity(clarityid = '') {
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
        formdata.append("action", "listclarity");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistclarity, OnErrorlistclarity);

        function Onsuccesslistclarity(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var s_htmldata = '';
            var form_htmldata = '';
            var fltform_htmldata = '';
            form_htmldata += '<option value="">Select Clarity</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                $('.clarityDiv').addClass('d-none');
                $('.s_clarityDiv').addClass('d-none');
                $('.s_mdclarityDiv').addClass('d-none');
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.clarityDiv').removeClass('d-none');
                        $('.s_clarityDiv').removeClass('d-none');
                        $('.s_mdclarityDiv').removeClass('d-none');
                        htmldata += '<div class="filter-container">';
                        for (var i in resultdata.data) {
                            htmldata += '<div class="filter custom-checkbox">';
                            htmldata += '<input type="checkbox" id="c' + resultdata.data[i].id + '" data-name="' + resultdata.data[i].name + '" name="fltclarityid[]" class="dashboard-control custom-control-input" value="' + resultdata.data[i].id + '">';
                            htmldata += '<label for="c' + resultdata.data[i].id + '" class="custom-control-label">' + resultdata.data[i].name + '</label>';
                            htmldata += '</div>';

                            s_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            fltform_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                        htmldata += '</div>';
                    }

                    if (resultdata.data.length > 14) {
                        htmldata += '<button type="button" class="btn show-more-filters">';
                        htmldata += '<span class="text">+ 30 More</span>';
                        htmldata += '<span class="text opened">- 30 Less</span>';
                        htmldata += '<span class="arrow-btn">';
                        htmldata += '<img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">';
                        htmldata += '</span>';
                        htmldata += '</button>';
                    }
                }

            }
            $('#clarityDivData').html(htmldata);
            $('#s_fltclarityid').html(s_htmldata);
            $('#s_fltclarityid').select2();
            $('#s_mdfltclaritymdid').html(fltform_htmldata);
            $('#s_mdfltclaritymdid').select2();
            $('#clarityid').html(form_htmldata);
            if (clarityid) {
                $('#clarityid').val(clarityid);
            }
            $('#clarityid').select2();
        }

        function OnErrorlistclarity(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******EYE CLEAN******* */

    function listeyeclean(eyecleanid = '') {
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
        formdata.append("action", "listeyeclean");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslisteyeclean, OnErrorlisteyeclean);

        function Onsuccesslisteyeclean(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var form_htmldata = '';
            form_htmldata += '<option value="">Select Eye Clean</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#flteyecleanid').html(htmldata);
            $('#flteyecleanid').select2();
            $('#s_flteyecleanid').html(htmldata);
            $('#s_flteyecleanid').select2();

            $('#eyecleanid').html(form_htmldata);
            if (eyecleanid) {
                $('#eyecleanid').val(eyecleanid);
            }
            $('#eyecleanid').select2();





        }

        function OnErrorlisteyeclean(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listmilky(milkyid = '') {
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
        formdata.append("action", "listmilky");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistmilky, OnErrorlistmilky);

        function Onsuccesslistmilky(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var form_htmldata = '';
            form_htmldata += '<option value="">Select Milky</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#fltmilkyid').html(htmldata);
            $('#fltmilkyid').select2();
            $('#s_fltmilkyid').html(htmldata);
            $('#s_fltmilkyid').select2();
            $('#milkyid').html(form_htmldata);
            if (milkyid) {
                $('#milkyid').val(milkyid);
            }
            $('#milkyid').select2();
        }

        function OnErrorlistmilky(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }


    /* ******OpenInclusion*******  */

    function listopeninclusion(openinclusionsid = '') {
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
        formdata.append("action", "listopeninclusion");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistopeninclusion, OnErrorlistopeninclusion);

        function Onsuccesslistopeninclusion(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var form_htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#fltopeninclusionid').html(htmldata);
            $('#fltopeninclusionid').select2();
            $('#s_fltopeninclusionid').html(htmldata);
            $('#s_fltopeninclusionid').select2();
            $('#openinclusionsid').html(form_htmldata);
            if (openinclusionsid) {
                $("#openinclusionsid").val(openinclusionsid.split(',')).trigger('change');
            }
            $('#openinclusionsid').select2();
        }

        function OnErrorlistopeninclusion(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******WhiteInclusion*******  */

    function listwhiteinclusion(whiteinclusionsid = '') {
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
        formdata.append("action", "listwhiteinclusion");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistwhiteinclusion, OnErrorlistwhiteinclusion);

        function Onsuccesslistwhiteinclusion(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var form_htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data.length > 0) {
                    for (var i in resultdata.data) {
                        htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                    }
                }

            }
            $('#fltwhiteinclusionid').html(htmldata);
            $('#fltwhiteinclusionid').select2();
            $('#s_fltwhiteinclusionid').html(htmldata);
            $('#s_fltwhiteinclusionid').select2();
            $('#whiteinclusionsid').html(form_htmldata);
            if (whiteinclusionsid) {
                $("#whiteinclusionsid").val(whiteinclusionsid.split(',')).trigger('change');
            }
            $('#whiteinclusionsid').select2();

        }

        function OnErrorlistwhiteinclusion(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******BlackInclusion*******  */

    function listblackinclusion(blackinclusionsid = '') {
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
        formdata.append("action", "listblackinclusion");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistblackinclusion, OnErrorlistblackinclusion);

        function Onsuccesslistblackinclusion(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var form_htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }


            }
            $('#fltblackinclusionid').html(htmldata);
            $('#fltblackinclusionid').select2();
            $('#s_fltblackinclusionid').html(htmldata);
            $('#s_fltblackinclusionid').select2();
            $('#blackinclusionsid').html(form_htmldata);
            if (blackinclusionsid) {
                $("#blackinclusionsid").val(blackinclusionsid.split(',')).trigger('change');
            }
            $('#blackinclusionsid').select2();
        }

        function OnErrorlistblackinclusion(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******Shade*******  */

    function listshade(shadeid = '') {

        $("#fltshadeid").empty().trigger("change");
        $("#s_fltshadeid").empty().trigger("change");
        var isselected = '';
        if ($('#nobgm').is(":checked") == true) {
            isselected = 'selected';
        }
        if ($('#s_nobgm').is(":checked") == true) {
            isselected = 'selected';
        }
        console.log($('#s_nobgm').is(":checked"));
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
        formdata.append("action", "listshade");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistshade, OnErrorlistshade);

        function Onsuccesslistshade(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var form_htmldata = '';
            form_htmldata += '<option value="">Select Shade</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option ' + isselected + ' value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            form_htmldata += '<option ' + isselected + ' value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#fltshadeid').html(htmldata);
            $('#fltshadeid').select2();
            $('#s_fltshadeid').html(htmldata);
            $('#s_fltshadeid').select2();

            $('#shadeid').html(form_htmldata);
            if (shadeid) {
                $('#shadeid').val(shadeid);
            }
            $('#shadeid').select2();


        }

        function OnErrorlistshade(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    /* ******Cut*******  */

    function listcut(cutid = '') {
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
            var form_htmldata = '';
            form_htmldata += '<option value="">Select Cut</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#fltcutid').html(htmldata);
            $('#fltcutid').select2();
            $('#s_fltcutid').html(htmldata);
            $('#s_fltcutid').select2();
            $('#cutid').html(form_htmldata);
            if (cutid) {
                $('#cutid').val(cutid);
            }
            $('#cutid').select2();
        }

        function OnErrorlistcut(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******Polish*******  */

    function listpolish(polishid = '') {
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
            var form_htmldata = '';
            form_htmldata += '<option value="">Select Polish</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }


            }
            $('#fltpolishid').html(htmldata);
            $('#fltpolishid').select2();
            $('#s_fltpolishid').html(htmldata);
            $('#s_fltpolishid').select2();
            $('#polishid').html(form_htmldata);
            if (polishid) {
                $('#polishid').val(polishid);
            }
            $('#polishid').select2();
        }

        function OnErrorlistpolish(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******Symmetry*******  */

    function listsymmetry(symmetryid = '') {
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
            var form_htmldata = '';
            form_htmldata += '<option value="">Select Symmetry</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }


            }
            $('#fltsymmetryid').html(htmldata);
            $('#fltsymmetryid').select2();
            $('#s_fltsymmetryid').html(htmldata);
            $('#s_fltsymmetryid').select2();
            $('#symmetryid').html(form_htmldata);
            if (symmetryid) {
                $('#symmetryid').val(symmetryid);
            }
            $('#symmetryid').select2();
        }

        function OnErrorlistsymmetry(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******INTENSITY******* */
    function listintensity(intensityid = '') {
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
            var form_htmldata = '';
            form_htmldata += '<option value="">Select Intensity</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                $('.intensityDiv').addClass('d-none');
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.intensityDiv').removeClass('d-none');

                        for (var i in resultdata.data) {
                            htmldata += '<div class="filter-container">';
                            htmldata += '<div class="filter custom-checkbox">';
                            htmldata += '<input type="checkbox" id="c' + resultdata.data[i].id + '" name="fltintensityid[]" class="dashboard-control custom-control-input" value="' + resultdata.data[i].id + '">';
                            htmldata += '<label for="c' + resultdata.data[i].id + '" class="custom-control-label">' + resultdata.data[i].name + '</label>';
                            htmldata += '</div>';
                            htmldata += '</div>';

                            s_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }

                    }

                    if (resultdata.data.length > 14) {
                        htmldata += '<button type="button" class="btn show-more-filters">';
                        htmldata += '<span class="text">+ 30 More</span>';
                        htmldata += '<span class="text opened">- 30 Less</span>';
                        htmldata += '<span class="arrow-btn">';
                        htmldata += '<img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">';
                        htmldata += '</span>';
                        htmldata += '</button>';
                    }
                }

            }
            $('#intensityDivData').html(htmldata);
            $('#s_fltintensityid').html(s_htmldata);
            $('#s_fltintensityid').select2();
            $('#intensityid').html(form_htmldata);
            if (intensityid) {
                $('#intensityid').val(intensityid);
            }
            $('#intensityid').select2();

        }

        function OnErrorlistintensity(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listfancyintensity(fancyintensityid = '') {
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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistfancyintensity, OnErrorlistfancyintensity);

        function Onsuccesslistfancyintensity(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var s_htmldata = '';
            var form_htmldata = '';
            form_htmldata += '<option value="">Select Fancy Intensity</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }

                    }
                }

            }
            $('#fancyintensityid').html(form_htmldata);
            if (fancyintensityid) {
                $('#fancyintensityid').val(fancyintensityid);
            }
            $('#fancyintensityid').select2();

        }

        function OnErrorlistfancyintensity(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* OVERTONE */
    function listovertone(overtoneid = '') {
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
        formdata.append("action", "listovertone");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistovertone, OnErrorlistovertone);

        function Onsuccesslistovertone(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var s_htmldata = '';
            var form_htmldata = '';
            // form_htmldata += '<option value="">Select Fancy Intensity</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }

                    }
                }

            }
            $('#overtoneid').html(form_htmldata);
            if (overtoneid) {
                $("#overtoneid").val(overtoneid.split(',')).trigger('change');
            }
            $('#overtoneid').select2();

        }

        function OnErrorlistovertone(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******fluorescence color*******  */

    function listfluorescencecolor(fluorescenecolorid = '') {
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
        formdata.append("action", "listcolor");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistfluorescencecolor, OnErrorlistfluorescencecolor);

        function Onsuccesslistfluorescencecolor(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var form_htmldata = '';
            form_htmldata += '<option value="">Select Color</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#fltfluorescencecolorid').html(htmldata);
            $('#fltfluorescencecolorid').select2();
            $('#s_fltfluorescencecolorid').html(htmldata);
            $('#s_fltfluorescencecolorid').select2();
            $('#fluorescenecolorid').html(form_htmldata);
            if (fluorescenecolorid) {
                $('#fluorescenecolorid').val(fluorescenecolorid);
            }
            $('#fluorescenecolorid').select2();
        }

        function OnErrorlistfluorescencecolor(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listcolor1(fancycolorid1 = '') {
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
        formdata.append("action", "listcolor");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistcolor1, OnErrorlistcolor1);

        function Onsuccesslistcolor1(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var form_htmldata = '';
            form_htmldata += '<option value="">Select Color</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#fancycolorid1').html(form_htmldata);
            if (fancycolorid1) {
                $('#fancycolorid1').val(fancycolorid1);
            }
            $('#fancycolorid1').select2();
        }

        function OnErrorlistcolor1(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listcolor2(fancycolorid2 = '') {
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
        formdata.append("action", "listcolor");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistcolor2, OnErrorlistcolor2);

        function Onsuccesslistcolor2(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var form_htmldata = '';
            form_htmldata += '<option value="">Select Color</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#fancycolorid2').html(form_htmldata);
            if (fancycolorid2) {
                $('#fancycolorid2').val(fancycolorid2);
            }
            $('#fancycolorid2').select2();
        }

        function OnErrorlistcolor2(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* Treade Show */

    function listtreadeshow(treadeshowid = '') {
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
        formdata.append("action", "listtradeshow");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslisttreadeshow, OnErrorlisttreadeshow);

        function Onsuccesslisttreadeshow(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var form_htmldata = '';
            form_htmldata += '<option value="">Select Treade Show</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#tradeshowid').html(form_htmldata);
            if (treadeshowid) {
                $('#tradeshowid').val(treadeshowid);
            }
            $('#tradeshowid').select2();
        }

        function OnErrorlisttreadeshow(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }





    /* ******Grading Report - Lab*******  */

    function listlab(labid = '') {
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
            var form_htmldata = '';
            form_htmldata += '<option value="">Select Lab</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                $('.labDiv').addClass('d-none');
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.labDiv').removeClass('d-none');
                        htmldata += '<div class="filter-container">';
                        for (var i in resultdata.data) {
                            htmldata += '<div class="filter custom-checkbox">';
                            htmldata += '<input type="checkbox" id="c' + resultdata.data[i].id + '" name="fltlabid[]" data-name="' + resultdata.data[i].name + '" class="dashboard-control custom-control-input" value="' + resultdata.data[i].id + '">';
                            htmldata += '<label for="c' + resultdata.data[i].id + '" class="custom-control-label">' + resultdata.data[i].name + '</label>';
                            htmldata += '</div>';

                            s_htmldata += '<div class="col-12 col-md-6 cut-group ">';
                            s_htmldata += '<div class="form-check">';
                            s_htmldata += '<input class="form-check-input" type="checkbox" name="fltlabid[]" data-name="' + resultdata.data[i].name + '" value="' + resultdata.data[i].id + '" id="s_fltlabid' + resultdata.data[i].id + '">';
                            s_htmldata += '<label class="form-check-label ml-4" for="s_fltlabid' + resultdata.data[i].id + '">';
                            s_htmldata += '' + resultdata.data[i].name + '';
                            s_htmldata += '</label>';
                            s_htmldata += '</div>';
                            s_htmldata += '</div>';

                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                        htmldata += '</div>';
                    }

                    if (resultdata.data.length > 14) {
                        htmldata += '<button type="button" class="btn show-more-filters">';
                        htmldata += '<span class="text">+ 30 More</span>';
                        htmldata += '<span class="text opened">- 30 Less</span>';
                        htmldata += '<span class="arrow-btn">';
                        htmldata += '<img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">';
                        htmldata += '</span>';
                        htmldata += '</button>';
                    }
                }

            }
            $('#labDivData').html(htmldata);
            $('#s_labDivData').html(s_htmldata);

            $('#labid').html(form_htmldata);
            if (labid) {
                $('#labid').val(labid);
            }
            $('#labid').select2();

        }

        function OnErrorlistlab(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    /* ******Location*******  */
    function listlocation() {

        $("#fltlocationid").empty().trigger("change");
        var isselected = '';
        if ($('#isflexibledelivery').is(":checked") == true) {
            isselected = 'selected';
        }
        console.log(isselected);
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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistlocation, OnErrorlistlocation);

        function Onsuccesslistlocation(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data.length > 0) {
                    for (var i in resultdata.data) {
                        htmldata += '<option  ' + isselected + ' value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                    }
                }

            }
            $('#fltlocationid').html(htmldata);
            $('#fltlocationid').select2();
            $('#s_fltlocationid').html(htmldata);
            $('#s_fltlocationid').select2();
            // getfiltersvalue();
        }

        function OnErrorlistlocation(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******Company Code*******  */
    function listcompanycode() {
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
        formdata.append("action", "listcompanycode");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistcompanycode, OnErrorlistcompanycode);

        function Onsuccesslistcompanycode(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data.length > 0) {
                    htmldata += '<option value="">Select Savani ID/ Company Code</option>';
                    for (var i in resultdata.data) {
                        htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                    }
                }

            }
            $('#fltcompanycode').html(htmldata);
            $('#s_fltcompanycode').html(htmldata);

        }

        function OnErrorlistcompanycode(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    /* ******Stock Numbers*******  */
    function liststocknumbers() {
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
        formdata.append("action", "liststocknumbers");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessliststocknumbers, OnErrorliststocknumbers);

        function Onsuccessliststocknumbers(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data.length > 0) {
                    htmldata += '<option value="">Select Stock Numbers</option>';
                    for (var i in resultdata.data) {
                        htmldata += '<option value="' + resultdata.data[i].name + '">' + resultdata.data[i].name + '</option>';
                    }
                }

            }
            $('#fltstocknumbers').html(htmldata);
            $('#s_fltstocknumbers').html(htmldata);

        }

        function OnErrorliststocknumbers(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    /* ******Lot Numbers*******  */
    function listlotnumbers() {
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
        formdata.append("action", "listlotnumbers");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistlotnumbers, OnErrorlistlotnumbers);

        function Onsuccesslistlotnumbers(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data.length > 0) {
                    htmldata += '<option value="">Select Lot Numbers</option>';
                    for (var i in resultdata.data) {
                        htmldata += '<option value="' + resultdata.data[i].name + '">' + resultdata.data[i].name + '</option>';
                    }
                }

            }
            $('#fltlotnumbers').html(htmldata);
            $('#s_fltlotnumbers').html(htmldata);

        }

        function OnErrorlistlotnumbers(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******Rough source*******  */
    function listroughsource(roughdiamondsourceid = '') {
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
        formdata.append("action", "listroughdiamondsource");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistroughsource, OnErrorlistroughsource);

        function Onsuccesslistroughsource(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var form_htmldata = '';
            form_htmldata = '<option value="">Select Rough Diamond Source</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data.length > 0) {
                    // htmldata += '<option value="">Select Rough Source</option>';
                    for (var i in resultdata.data) {
                        htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                    }
                }

            }
            $('#fltroughsourceid').html(htmldata);
            $('#fltroughsourceid').select2();

            $('#s_fltroughsourceid').html(htmldata);
            $('#s_fltroughsourceid').select2();

            $('#roughdiamondsourceid').html(form_htmldata);
            if (roughdiamondsourceid) {
                $("#roughdiamondsourceid").val(roughdiamondsourceid);
            }
            $('#roughdiamondsourceid').select2();
        }

        function OnErrorlistroughsource(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******Treatment*******  */
    function listtreatment(treatmentid = '') {
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
            var s_htmldata = '';
            var form_htmldata = '';
            // form_htmldata += '<option value="">Select Treatment</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                $('.treatmentDiv').addClass('d-none');
                $('.s_treatmentDiv').addClass('d-none');
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        $('.treatmentDiv').removeClass('d-none');
                        $('.s_treatmentDiv').removeClass('d-none');

                        htmldata += '<div class="col-12 col-md-12">';
                        htmldata += '<div class="row">';
                        // htmldata += '<div class="col-12 col-md-3 mb-3">';
                        // htmldata += '<div class="form-check">';
                        // htmldata += '<input class="form-check-input" type="radio" name="flthastreatment" value="1" id="dtnotreatment">';
                        // htmldata += '<label class="form-check-label ml-4" for="dtnotreatment">';
                        // htmldata += 'No Treatment';
                        // htmldata += '</label>';
                        // htmldata += '</div>';
                        // htmldata += '</div>';
                        // htmldata += '<div class="col-12 col-md-3 mb-3">';
                        // htmldata += '<div class="form-check">';
                        // htmldata += '<input class="form-check-input" type="radio" name="flthastreatment" value="2" id="dtshowstreated">';
                        // htmldata += '<label class="form-check-label ml-4" for="dtshowstreated">';
                        // htmldata += 'Show Only Treated';
                        // htmldata += '</label>';
                        // htmldata += '</div>';
                        // htmldata += '</div>';
                        // htmldata += '<div class="col-12 col-md-4 mb-3 cut-group">';
                        // htmldata += '<div class="form-check">';
                        // htmldata += '<input class="form-check-input" type="radio" name="flthastreatment" value="3" id="dtincludetreated">';
                        // htmldata += '<label class="form-check-label ml-4" for="dtincludetreated">';
                        // htmldata += 'Include Treated Diamonds In Result';
                        // htmldata += '</label>';
                        // htmldata += '</div>';
                        // htmldata += '</div>';
                        for (var i in resultdata.data) {
                            htmldata += '<div class="col-12 col-md-3 cut-group">';
                            htmldata += '<div class="form-check">';
                            htmldata += '<input class="form-check-input" type="checkbox" data-name="' + resultdata.data[i].name + '" name="flttreatment[]" value="' + resultdata.data[i].id + '" value="" id="flttreatment' + resultdata.data[i].id + '">';
                            htmldata += '<label class="form-check-label ml-4" for="flttreatment' + resultdata.data[i].id + '">';
                            htmldata += '' + resultdata.data[i].name + '';
                            htmldata += '</label>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            s_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                        }
                        htmldata += '</div>';
                        htmldata += '</div>';


                    }
                }

            }
            $('#treatmentDivData').html(htmldata);
            $('#s_flttreatment').html(s_htmldata);
            $('#s_flttreatment').select2();
            $('#treatmentid').html(form_htmldata);
            if (treatmentid) {
                $("#treatmentid").val(treatmentid.split(',')).trigger('change');
            }
            $('#treatmentid').select2();
        }

        function OnErrorlisttreatment(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******Key to Symbols*******  */
    function listkeytosymbol(keytosymbolid = '') {
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
        formdata.append("action", "listkeytosymbol");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistkeytosymbol, OnErrorlistkeytosymbol);

        function Onsuccesslistkeytosymbol(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var s_htmldata = '';
            var form_htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                $('.keytosymbolDiv').addClass('d-none');
                if (resultdata.data.length > 0) {
                    $('.keytosymbolDiv').removeClass('d-none');

                    htmldata += '<div class="col-12 col-md-12">';
                    htmldata += '<div class="row">';

                    // htmldata += '<div class="col-12 col-md-3 mb-3">';
                    // htmldata += '<div class="form-check">';
                    // htmldata += '<input class="form-check-input" type="radio" name="flthaskeytosymbols" value="1" id="containkeytosymbols">';
                    // htmldata += '<label class="form-check-label ml-4" for="containkeytosymbols">';
                    // htmldata += 'Contain';
                    // htmldata += '</label>';
                    // htmldata += '</div>';
                    // htmldata += '</div>';
                    // htmldata += '<div class="col-12 col-md-3 mb-3">';
                    // htmldata += '<div class="form-check">';
                    // htmldata += '<input class="form-check-input" type="radio" name="flthaskeytosymbols" value="2" id="dntcontainkeytosymbols">';
                    // htmldata += '<label class="form-check-label ml-4" for="dntcontainkeytosymbols">';
                    // htmldata += 'Does Not Contain';
                    // htmldata += '</label>';
                    // htmldata += '</div>';
                    // htmldata += '</div>';
                    // htmldata += '<div class="col-12 col-md-4 mb-3  cut-group">';
                    // htmldata += '<div class="form-check">';
                    // // htmldata += '<input class="form-check-input" type="radio" name="flthaskeytosymbols" id="dntcontainkeytosymbols">';
                    // // htmldata += '<label class="form-check-label ml-4" for="dntcontainkeytosymbols">';
                    // // htmldata += 'Does Not Contain';
                    // // htmldata += '</label>';
                    // htmldata += '</div>';
                    // htmldata += '</div>';

                    for (var i in resultdata.data) {
                        htmldata += '<div class="col-12 col-md-3 cut-group">';
                        htmldata += '<div class="form-check">';
                        htmldata += '<input class="form-check-input" type="checkbox" name="fltkeytosymbols[]" value="' + resultdata.data[i].id + '" value="" id="fltkeytosymbols' + resultdata.data[i].id + '">';
                        htmldata += '<label class="form-check-label ml-4" for="fltkeytosymbols' + resultdata.data[i].id + '">';
                        htmldata += '' + resultdata.data[i].name + '';
                        htmldata += '</label>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        s_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                    }
                    htmldata += '</div>';
                    htmldata += '</div>';


                }

            }
            $('#keytosymbolDivData').html(htmldata);
            $('#s_fltkeytosymbols').html(s_htmldata);
            $('#s_fltkeytosymbols').select2();
            $('#keytosymbolsid').html(form_htmldata);
            if (keytosymbolid) {
                $("#keytosymbolsid").val(keytosymbolid.split(',')).trigger('change');
            }
            $('#keytosymbolsid').select2();
        }

        function OnErrorlistkeytosymbol(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******Brand*******  */
    function listbrand(brandid = '') {
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
            var s_htmldata = '';
            var form_htmldata = '';
            form_htmldata += '<option value="">Select Brand</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                $('.brandDiv').addClass('d-none');
                $('.s_brandDiv').addClass('d-none');
                if (resultdata.data.length > 0) {
                    $('.brandDiv').removeClass('d-none');
                    $('.s_brandDiv').removeClass('d-none');

                    htmldata += '<div class="col-12 col-md-12">';
                    htmldata += '<div class="row">';
                    for (var i in resultdata.data) {
                        htmldata += '<div class="col-12 col-md-3 cut-group">';
                        htmldata += '<div class="form-check">';
                        htmldata += '<input class="form-check-input" type="checkbox" name="fltbrand[]" value="' + resultdata.data[i].id + '" value="" id="fltbrand' + resultdata.data[i].id + '">';
                        htmldata += '<label class="form-check-label ml-4" for="fltbrand' + resultdata.data[i].id + '">';
                        htmldata += '' + resultdata.data[i].name + '';
                        htmldata += '</label>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        s_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                    }
                    htmldata += '</div>';
                    htmldata += '</div>';


                }

            }
            $('#brandDivData').html(htmldata);
            $('#s_fltbrand').html(s_htmldata);
            $('#s_fltbrand').select2();
            $('#brandid').html(form_htmldata);
            if (brandid) {
                $("#brandid").val(brandid);
            }
            $('#brandid').select2();
        }

        function OnErrorlistbrand(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******PARCEL SHAPE******* */
    function listshapeparcel() {
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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistshapeparcel, OnErrorlistshapeparcel);

        function Onsuccesslistshapeparcel(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var s_htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                $('.shapeparcelDiv').addClass('d-none');
                if (resultdata.data.length > 0) {
                    $('.shapeparcelDiv').removeClass('d-none');
                    htmldata += '<div class="filter-container">';
                    for (var i in resultdata.data) {
                        htmldata += '<div class="filter custom-checkbox">';
                        htmldata += '<input type="checkbox" id="fltshapeparcelid' + resultdata.data[i].id + '" data-id="' + resultdata.data[i].id + '" data-name="' + resultdata.data[i].name + '" name="fltshapeparcelid[]" class="dashboard-control custom-control-input" value="' + resultdata.data[i].id + '">';
                        htmldata += '<label for="fltshapeparcelid' + resultdata.data[i].id + '" class="custom-control-label with-img">';

                        htmldata += '<span class="img-wrap">';
                        if (resultdata.data[i].img != '') {
                            htmldata += '<img src="<?php echo $config->getimageurl() ?>' + resultdata.data[i].img + '" alt="' + resultdata.data[i].name + '" class="img-responsive">';
                        }
                        htmldata += ' </span>';

                        htmldata += '<span class="text-label">' + resultdata.data[i].name + '</span>';
                        htmldata += '</label>';
                        htmldata += '</div>';

                        s_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                    }
                    htmldata += '</div>';
                }

                if (resultdata.data.length > 14) {
                    htmldata += '<button type="button" class="btn show-more-filters">';
                    htmldata += '<span class="text">+ 30 More</span>';
                    htmldata += '<span class="text opened">- 30 Less</span>';
                    htmldata += '<span class="arrow-btn">';
                    htmldata += '<img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">';
                    htmldata += '</span>';
                    htmldata += '</button>';
                }

            }
            $('#shapeparcelDivData').html(htmldata);
            $('#s_fltshapeparcelid').html(s_htmldata);
            $('#s_fltshapeparcelid').select2();
        }

        function OnErrorlistshapeparcel(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    /* ******PARCEL COLOR******* */
    function listcolorparcel() {
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
        formdata.append("action", "listdiamondcolor");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistcolorparcel, OnErrorlistcolorparcel);

        function Onsuccesslistcolorparcel(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var s_htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                $('.colorparcelDiv').addClass('d-none');
                if (resultdata.data.length > 0) {
                    $('.colorparcelDiv').removeClass('d-none');
                    htmldata += '<div class="filter-container">';
                    for (var i in resultdata.data) {
                        htmldata += '<div class="filter custom-checkbox">';
                        htmldata += '<input type="checkbox" id="fltcolorparcelid' + resultdata.data[i].id + '" data-id="' + resultdata.data[i].id + '" data-name="' + resultdata.data[i].name + '" name="fltcolorparcelid[]" class="dashboard-control custom-control-input" value="' + resultdata.data[i].id + '">';
                        htmldata += '<label for="fltcolorparcelid' + resultdata.data[i].id + '" class="custom-control-label">' + resultdata.data[i].name + '</label>';
                        htmldata += '</div>';

                        s_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                    }
                    htmldata += '</div>';
                }

                if (resultdata.data.length > 14) {
                    htmldata += '<button type="button" class="btn show-more-filters">';
                    htmldata += '<span class="text">+ 30 More</span>';
                    htmldata += '<span class="text opened">- 30 Less</span>';
                    htmldata += '<span class="arrow-btn">';
                    htmldata += '<img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">';
                    htmldata += '</span>';
                    htmldata += '</button>';
                }

            }
            $('#colorparcelDivData').html(htmldata);
            $('#s_fltcolorparcelid').html(s_htmldata);
            $('#s_fltcolorparcelid').select2();
        }

        function OnErrorlistcolorparcel(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******PARCEL CLARITY******* */
    function listclarityparcel() {
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
        formdata.append("action", "listclarity");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistclarityparcel, OnErrorlistclarityparcel);

        function Onsuccesslistclarityparcel(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var s_htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                $('.clarityparcelDiv').addClass('d-none');
                if (resultdata.data.length > 0) {
                    $('.clarityparcelDiv').removeClass('d-none');
                    htmldata += '<div class="filter-container">';
                    for (var i in resultdata.data) {
                        htmldata += '<div class="filter custom-checkbox">';
                        htmldata += '<input type="checkbox" id="fltclarityparcelid' + resultdata.data[i].id + '" data-id="' + resultdata.data[i].id + '" data-name="' + resultdata.data[i].name + '" name="fltclarityparcelid[]" class="dashboard-control custom-control-input" value="' + resultdata.data[i].id + '">';
                        htmldata += '<label for="fltclarityparcelid' + resultdata.data[i].id + '" class="custom-control-label">' + resultdata.data[i].name + '</label>';
                        htmldata += '</div>';

                        s_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                    }
                    htmldata += '</div>';
                }

                if (resultdata.data.length > 14) {
                    htmldata += '<button type="button" class="btn show-more-filters">';
                    htmldata += '<span class="text">+ 30 More</span>';
                    htmldata += '<span class="text opened">- 30 Less</span>';
                    htmldata += '<span class="arrow-btn">';
                    htmldata += '<img src="<?php echo $config->getimageurl() ?>images/homepage/down-arrow.svg" alt="" class="img-responsive">';
                    htmldata += '</span>';
                    htmldata += '</button>';
                }

            }
            $('#clarityparcelDivData').html(htmldata);
            $('#s_fltclarityparcelid').html(s_htmldata);
            $('#s_fltclarityparcelid').select2();
        }

        function OnErrorlistclarityparcel(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* ******Sleeve*******  */
    function listsieve(sieveid = '') {
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
        formdata.append("action", "listsieve");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistsieve, OnErrorlistsieve);

        function Onsuccesslistsieve(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            var form_htmldata = '';
            form_htmldata += '<option value="">Select Sleeve</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        // htmldata += '<option value="">Select Rough Source</option>';
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#fltsieveid').html(htmldata);
            $('#fltsieveid').select2();
            $('#s_fltsieveid').html(htmldata);
            $('#s_fltsieveid').select2();
            $('#sieveid').html(form_htmldata);
            if (sieveid) {
                $("#sieveid").val(sieveid);
            }
            $('#sieveid').select2();

        }

        function OnErrorlistsieve(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }


    /* ******Sort By*******  */

    function listdiamondsortby() {
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
        formdata.append("action", "listdiamondsortby");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistdiamondsortby, OnErrorlistdiamondsortby);

        function Onsuccesslistdiamondsortby(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                var htmldata = '<option value="">Select Sort By</option>';
                if (resultdata.data.length > 0) {
                    for (var i in resultdata.data) {
                        htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                    }
                }

            }
            $('#sortbyid').html(htmldata);
            $('#parcelsortbyid').html(htmldata);
        }

        function OnErrorlistdiamondsortby(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }



    /* *************************PARCEL DIAMOND******************************* */

    function checkparceldiamondformelementvalue() {
        var issearchbtn = 0;
        $('#form-diamond-parcel-search input[type=checkbox]').each(function() {
            if (this.checked) {
                issearchbtn++;
                return false;
            }
        });
        var fltfromsize = $('#form-diamond-parcel-search #fltfromparcelsize').val();
        var flttosize = $('#form-diamond-parcel-search #flttoparcelsize').val();
        if (fltfromsize && flttosize > 0) {
            issearchbtn++;
        }

        var fltfrompiecepercarat = $('#form-diamond-parcel-search #fltfrompiecepercarat').val();
        var flttopiecepercarat = $('#form-diamond-parcel-search #flttopiecepercarat').val();
        if (fltfrompiecepercarat && flttopiecepercarat > 0) {
            issearchbtn++;
        }

        var fltfrompriceparcel = $('#form-diamond-parcel-search #fltfrompriceparcel').val();
        var flttopriceparcel = $('#form-diamond-parcel-search #flttopriceparcel').val();
        if (fltfrompriceparcel && flttopriceparcel > 0) {
            issearchbtn++;
        }

        var fltsieveid = $('#form-diamond-parcel-search #fltsieveid').val();
        if (fltsieveid.length > 0) {
            issearchbtn++;
        }

        $('#form-diamond-parcel-search #btnparceldiamondsearch').attr('disabled', true);
        if (issearchbtn > 0) {
            $('#form-diamond-parcel-search #btnparceldiamondsearch').attr('disabled', false);
        }
        // //console.log(issearchbtn);
        return issearchbtn;

    }

    $('body').on('change', '#form-diamond-parcel-search input[type=checkbox]', function() {
        checkparceldiamondformelementvalue();
        getparcelfiltersvalue();
    });
    $('body').on('change', '#form-diamond-parcel-search  .select2', function() {
        checkparceldiamondformelementvalue();
        getparcelfiltersvalue();
    });

    $('body').on('input', '#form-diamond-parcel-search #fltfromparcelsize,#flttoparcelsize,#fltfrompiecepercarat,#flttopiecepercarat,#fltfrompriceparcel,#flttopriceparcel', function() {
        checkparceldiamondformelementvalue();
        getparcelfiltersvalue();
    });

    /* MANAGE FILTERS */
    var shapeparcelarr = [];
    var shapeparcelidarr = [];

    var colorparcelarr = [];
    var colorparcelidarr = [];

    var clarityparcelarr = [];
    var clarityparcelidarr = [];

    var sieveparcelarr = [];
    var sieveparcelidarr = [];

    var fltfromparcelsize = 0;
    var flttoparcelsize = 0;
    var fltfrompiecepercarat = 0;
    var flttopiecepercarat = 0;
    var fltfrompriceparcel = 0;
    var flttopriceparcel = 0;

    function getparcelfiltersvalue() {
        shapeparcelarr = [];
        shapeparcelidarr = [];

        $('#shapeparcelDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                shapeparcelarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                shapeparcelidarr.push($(this).val());
            }
        });

        if (shapeparcelidarr.length > 0) {
            $("#s_fltshapeparcelid").val(shapeparcelidarr).trigger('change');
            $('#s_fltshapeparcelid').select2();
        } else {
            $("#s_fltshapeparcelid").val(null).trigger('change');
            $('#s_fltshapeparcelid').select2();
        }

        colorparcelarr = [];
        colorparcelidarr = [];
        $('#colorparcelDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                colorparcelarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                colorparcelidarr.push($(this).val());
            }
        });

        if (colorparcelidarr.length > 0) {
            $("#s_fltcolorparcelid").val(colorparcelidarr).trigger('change');
            $('#s_fltcolorparcelid').select2();
        } else {
            $("#s_fltcolorparcelid").val(null).trigger('change');
            $('#s_fltcolorparcelid').select2();
        }

        clarityparcelarr = [];
        clarityparcelidarr = [];
        $('#clarityparcelDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                clarityparcelarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                clarityparcelidarr.push($(this).val());
            }
        });

        if (clarityparcelidarr.length > 0) {
            $("#s_fltclarityparcelid").val(clarityparcelidarr).trigger('change');
            $('#s_fltclarityparcelid').select2();
        } else {
            $("#s_fltclarityparcelid").val(null).trigger('change');
            $('#s_fltclarityparcelid').select2();
        }



        sieveparcelarr = [];
        sieveparcelidarr = [];
        var fltsieveid = $('#fltsieveid').val();
        if (fltsieveid.length > 0) {
            for (var i = 0; i < fltsieveid.length; i++) {
                var sieveid = $('#fltsieveid option[value=' + fltsieveid[i] + ']').val();
                var sieve = $('#fltsieveid option[value=' + fltsieveid[i] + ']').text();
                sieveparcelarr.push({
                    'id': sieveid,
                    'name': sieve
                });
                sieveparcelidarr.push(sieveid);
            }
        }

        if (sieveparcelidarr.length > 0) {
            $("#s_fltsieveid").val(sieveparcelidarr).trigger('change');
            $('#s_fltsieveid').select2();
        } else {
            $("#s_fltsieveid").val(null).trigger('change');
            $('#s_fltsieveid').select2();
        }

        fltfromparcelsize = $('#fltfromparcelsize').val();
        $('#s_fltfromparcelsize').val(fltfromparcelsize);
        flttoparcelsize = $('#flttoparcelsize').val();
        $('#s_flttoparcelsize').val(flttoparcelsize);
        fltfrompiecepercarat = $('#fltfrompiecepercarat').val();
        $('#s_fltfrompiecepercarat').val(fltfrompiecepercarat);
        flttopiecepercarat = $('#flttopiecepercarat').val();
        $('#s_flttopiecepercarat').val(flttopiecepercarat);
        fltfrompriceparcel = $('#fltfrompriceparcel').val();
        $('#s_fltfrompriceparcel').val(fltfrompriceparcel);
        flttopriceparcel = $('#flttopriceparcel').val();
        $('#s_flttopriceparcel').val(flttopriceparcel);
        checksideparceldiamondformelementvalue();
        getparcelsidebarelementvalue();
    }


    $('body').on('change', '#form-diamond-parcel-side-search  .select2', function() {
        checksideparceldiamondformelementvalue();
        getparcelsidebarelementvalue();
    });

    $('body').on('input', '#form-diamond-parcel-side-search #s_fltfromparcelsize,#s_flttoparcelsize,#s_fltfrompiecepercarat,#s_flttopiecepercarat,#s_fltfrompriceparcel,#s_flttopriceparcel', function() {
        checksideparceldiamondformelementvalue();
        getparcelsidebarelementvalue();
    });

    function checksideparceldiamondformelementvalue() {
        var issearchbtn = 0;
        var fltshapeparcelid = $('#form-diamond-parcel-side-search #s_fltshapeparcelid').val();
        if (fltshapeparcelid.length > 0) {
            issearchbtn++;
        }

        var fltcolorparcelid = $('#form-diamond-parcel-side-search #s_fltcolorparcelid').val();
        if (fltcolorparcelid.length > 0) {
            issearchbtn++;
        }

        var fltclarityparcelid = $('#form-diamond-parcel-side-search #s_fltclarityparcelid').val();
        if (fltclarityparcelid.length > 0) {
            issearchbtn++;
        }

        var fltfromparcelsize = $('#form-diamond-parcel-side-search #s_fltfromparcelsize').val();
        var flttoparcelsize = $('#form-diamond-parcel-side-search #s_flttoparcelsize').val();
        if (fltfromparcelsize && flttoparcelsize > 0) {
            issearchbtn++;
        }

        var fltfrompriceparcel = $('#form-diamond-parcel-side-search #s_fltfrompriceparcel').val();
        var flttopriceparcel = $('#form-diamond-parcel-side-search #s_flttopriceparcel').val();
        if (fltfrompriceparcel && flttopriceparcel > 0) {
            issearchbtn++;
        }

        var fltfrompriceparcel = $('#form-diamond-parcel-side-search #s_fltfrompriceparcel').val();
        var flttopriceparcel = $('#form-diamond-parcel-side-search #s_flttopriceparcel').val();
        if (fltfrompriceparcel && flttopriceparcel > 0) {
            issearchbtn++;
        }

        var fltfrompiecepercarat = $('#form-diamond-parcel-side-search #s_fltfrompiecepercarat').val();
        var flttopiecepercarat = $('#form-diamond-parcel-side-search #s_flttopiecepercarat').val();
        if (fltfrompiecepercarat && flttopiecepercarat > 0) {
            issearchbtn++;
        }

        var fltsieveid = $('#form-diamond-parcel-side-search #s_fltsieveid').val();
        if (fltsieveid.length > 0) {
            issearchbtn++;
        }

        $('#form-diamond-parcel-side-search #btnapplyparceldiamondfilter').attr('disabled', true);
        if (issearchbtn > 0) {
            $('#form-diamond-parcel-side-search #btnapplyparceldiamondfilter').attr('disabled', false);
        }



        return issearchbtn;
    }

    function getparcelsidebarelementvalue() {
        shapeparcelarr = [];
        shapeparcelidarr = [];

        var fltshapeparcelid = $('#s_fltshapeparcelid').val();
        if (fltshapeparcelid.length > 0) {
            for (var i = 0; i < fltshapeparcelid.length; i++) {
                var shapeid = $('#s_fltshapeparcelid option[value=' + fltshapeparcelid[i] + ']').val();
                var shape = $('#s_fltshapeparcelid option[value=' + fltshapeparcelid[i] + ']').text();
                shapeparcelarr.push({
                    'id': shapeid,
                    'name': shape
                });
                shapeparcelidarr.push(shapeid);
            }
        }

        colorparcelarr = [];
        colorparcelidarr = [];

        var fltcolorparcelid = $('#s_fltcolorparcelid').val();
        if (fltcolorparcelid.length > 0) {
            for (var i = 0; i < fltcolorparcelid.length; i++) {
                var colorid = $('#s_fltcolorparcelid option[value=' + fltcolorparcelid[i] + ']').val();
                var color = $('#s_fltcolorparcelid option[value=' + fltcolorparcelid[i] + ']').text();
                colorparcelarr.push({
                    'id': colorid,
                    'name': color
                });
                colorparcelidarr.push(colorid);
            }
        }

        clarityparcelarr = [];
        clarityparcelidarr = [];

        var fltclarityparcelid = $('#s_fltclarityparcelid').val();
        if (fltclarityparcelid.length > 0) {
            for (var i = 0; i < fltclarityparcelid.length; i++) {
                var clarityid = $('#s_fltclarityparcelid option[value=' + fltclarityparcelid[i] + ']').val();
                var clarity = $('#s_fltclarityparcelid option[value=' + fltclarityparcelid[i] + ']').text();
                clarityparcelarr.push({
                    'id': clarityid,
                    'name': clarity
                });
                clarityparcelidarr.push(clarityid);
            }
        }

        sieveparcelarr = [];
        sieveparcelidarr = [];

        var fltsieveid = $('#s_fltsieveid').val();
        if (fltsieveid.length > 0) {
            for (var i = 0; i < fltsieveid.length; i++) {
                var sieveid = $('#s_fltsieveid option[value=' + fltsieveid[i] + ']').val();
                var sieve = $('#s_fltsieveid option[value=' + fltsieveid[i] + ']').text();
                sieveparcelarr.push({
                    'id': sieveid,
                    'name': sieve
                });
                sieveparcelidarr.push(sieveid);
            }
        }

        fltfromparcelsize = $('#s_fltfromparcelsize').val();
        flttoparcelsize = $('#s_flttoparcelsize').val();
        fltfrompiecepercarat = $('#s_fltfrompiecepercarat').val();
        flttopiecepercarat = $('#s_flttopiecepercarat').val();
        fltfrompriceparcel = $('#s_fltfrompriceparcel').val();
        flttopriceparcel = $('#s_flttopriceparcel').val();


    }

    if ($('#form-diamond-parcel-search').length) {
        $('#form-diamond-parcel-search').validate({
            rules: {
                fltfromparcelsize: {
                    number: true
                },
                flttoparcelsize: {
                    greaterThan: '#fltfromparcelsize',
                    number: true
                },
                fltfrompiecepercarat: {
                    number: true
                },
                flttopiecepercarat: {
                    greaterThan: '#fltfrompiecepercarat',
                    number: true
                },
                fltfrompriceparcel: {
                    number: true
                },
                flttopriceparcel: {
                    greaterThan: '#fltfrompriceparcel',
                    number: true
                },
            },
            messages: {
                flttoparcelsize: {
                    greaterThan: 'To size greater than or equal From size',
                },
                flttopiecepercarat: {
                    greaterThan: 'To piece per carat greater than or equal From piece per carat',
                },
                flttopriceparcel: {
                    greaterThan: 'To price greater than or equal From price',
                },
            },
            submitHandler: function(form) {

                var issearchbtn = checkparceldiamondformelementvalue();
                if (issearchbtn > 0) {
                    fillsearchparceldiamondlist(1);
                    $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
                    listparceldiamonddata(1, 'form-diamond-parcel-search');
                } else {
                    alertify('Please select at least one filter', 0);
                }


            },
        });
    }

    if ($('#form-diamond-parcel-side-search').length) {
        $('#form-diamond-parcel-side-search').validate({
            rules: {
                fltfromparcelsize: {
                    number: true
                },
                flttoparcelsize: {
                    greaterThan: '#s_fltfromparcelsize',
                    number: true
                },
                fltfrompiecepercarat: {
                    number: true
                },
                flttopiecepercarat: {
                    greaterThan: '#s_fltfrompiecepercarat',
                    number: true
                },
                fltfrompriceparcel: {
                    number: true
                },
                flttopriceparcel: {
                    greaterThan: '#s_fltfrompriceparcel',
                    number: true
                },
            },
            messages: {
                flttoparcelsize: {
                    greaterThan: 'To size greater than or equal From size',
                },
                flttopiecepercarat: {
                    greaterThan: 'To piece per carat greater than or equal From piece per carat',
                },
                flttopriceparcel: {
                    greaterThan: 'To price greater than or equal From price',
                },
            },
            submitHandler: function(form) {

                var issearchbtn = checksideparceldiamondformelementvalue();
                if (issearchbtn > 0) {
                    fillsearchparceldiamondlist(2);
                    $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
                    listparceldiamonddata(1, 'form-diamond-parcel-side-search');
                    $(".wrappernew.toggled").toggleClass("intro");
                } else {
                    alertify('Please select at least one filter', 0);
                }


            },
        });
    }


    function listparceldiamonddata(page, form = null) {


        var id = '<?php echo $id; ?>';
        // var form = $('#form-diamond-search').serialize();
        showloader();
        var pagename = getpagename();
        var useraction = $('#formevent').val();
        var diamond_per_page = $('#parceldiamond_per_page').val();
        var sortbyid = $('#parcelsortbyid').val();

        var nextpage = 0;
        if ($('#listparceldiamondDatatbl').attr('data-nextpage') > 0) {
            nextpage = $('#listparceldiamondDatatbl').attr('data-nextpage');
        }

        formdata = new FormData(document.getElementById('form-diamond-parcel-search'));
        if (form != null) {
            formdata = new FormData(document.getElementById(form));
            checksideparceldiamondformelementvalue();
        }



        formdata.append("action", "listdiamond");
        formdata.append("nextpage", parseInt(nextpage) + 1);
        formdata.append("fltparcel", 1);
        formdata.append("fltmanagemydiamond", 0);
        formdata.append("perpage", diamond_per_page);
        formdata.append("sortbyid", sortbyid);

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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccesslistparceldiamond, OnErrorlistparceldiamond)

        function Onsuccesslistparceldiamond(data) {
            hideloader();
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
                $('#form-diamond-parcel-search').addClass('d-none');
                $('.listdiamondparcelDataDiv').removeClass('d-none');

                htmldata += '<tr>';
                htmldata += '<td colspan="16">';
                htmldata += '<h3>' + resultdata.message + '</h3>';
                htmldata += '</td>';
                htmldata += '</tr>';

                $('.listdiamondparcelDataDiv #listparceldiamondData').html(htmldata);
                $('#showparceldiamondentries').html(0);

                $('.listdiamondparcelDataDiv .totalparceldiamonds').html('0 Diamonds ');
                $('.listdiamondparcelDataDiv .totalparcelprice').html('Total Price : $0');


            } else if (resultdata.status == 1) {
                $('#form-diamond-parcel-search').addClass('d-none');
                $('.listdiamondparcelDataDiv').removeClass('d-none');
                if (resultdata.totaldiamond >= 0 && resultdata.totalprice >= 0 && resultdata.totaldiamond != null && resultdata.totalprice != null) {
                    // //console.log('totaldiamond'+resultdata.totaldiamond);
                    // //console.log('totalprice'+resultdata.totalprice);
                    $('.listdiamondparcelDataDiv .totalparceldiamonds').html(resultdata.totaldiamond + ' Diamonds ');
                    $('.listdiamondparcelDataDiv .totalparcelprice').html('Total Price : $' + resultdata.totalprice);
                }


                for (var i in resultdata.data) {
                    var diamonddata = resultdata.data[i];

                    htmldata += '<tr data-toggle="collapse" data-target="#searchdown' + diamonddata.id + '" class="sdown' + diamonddata.id + '">';
                    htmldata += '<td>';
                    // htmldata += '<div class="form-check">';
                    // htmldata += '<input class="form-check-input sbox" type="checkbox" value="' + diamonddata.id + '" id="selectdiamondid' + diamonddata.id + '">';
                    // htmldata += '<label class="form-check-label searchcheckbox" for="selectdiamondid' + diamonddata.id + '">';

                    // htmldata += '</label>';
                    // htmldata += '</div>';
                    htmldata += '' + diamonddata.personname + '';
                    htmldata += '</td>';
                    // htmldata+='<td>';
                    // htmldata+='<div class="searchreating">100%</div>';
                    // htmldata+='</td>';
                    htmldata += '<td>' + diamonddata.savanilotnumber + '</td>';
                    htmldata += '<td>' + diamonddata.shape + '</td>';
                    htmldata += '<td>' + diamonddata.size + '</td>';
                    htmldata += '<td>' + diamonddata.color + '</td>';
                    htmldata += '<td>' + diamonddata.clarity + '</td>';
                    // htmldata += '<td>' + diamonddata.cut + '</td>';
                    // htmldata += '<td>' + diamonddata.polish + '</td>';
                    // htmldata += '<td>' + diamonddata.symmetry + '</td>';
                    // htmldata += '<td>' + diamonddata.fluorescenecolor + '</td>';
                    // htmldata += '<td>' + diamonddata.lab + '</td>';
                    // htmldata+='<td>$354</td>';
                    // htmldata+='<td>-83.9%</td>';
                    htmldata += '<td>$' + diamonddata.price + '</td>';
                    // htmldata += '<td>' + diamonddata.depthper + '%</td>';
                    // htmldata += '<td>' + diamonddata.tableper + '%</td>';
                    // htmldata += '<td>' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</td>';
                    // htmldata += '<td>' + diamonddata.stocknumber + '</td>';
                    // htmldata+='<td>G</td>';
                    // htmldata+='<td>-</td>';
                    // htmldata+='<td>1.132</td>';
                    htmldata += '</tr>';

                    htmldata += '<td class="searchPadding">';
                    htmldata += '<div class="collapse" id="searchdown' + diamonddata.id + '">';
                    htmldata += '<div class="col-12 col-md-12 searchddetail">';
                    htmldata += '<div class="text-left searchleft">';
                    htmldata += '<div class="diamondsearch">';
                    htmldata += '<ul>';
                    htmldata += '<li>';
                    // htmldata += '<div class="starimg">';
                    // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/star.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '">';
                    // htmldata += '</div>';
                    htmldata += '<h4>' + diamonddata.shape + ',' + diamonddata.size + ',' + diamonddata.color + ',' + diamonddata.clarity + '</h4>';
                    htmldata += '</li>';
                    // htmldata += '<li><b>Price &nbsp</b>$' + diamonddata.price + '</li>';
                    // htmldata += '<li>' + diamonddata.availability + '</li>';
                    // htmldata += '<li>' + diamonddata.lab + ', ' + diamonddata.reportnumber + '</li>';
                    if (diamonddata.reportfilelink != '') {
                        htmldata += '<li><a href="' + diamonddata.reportfilelink + '" target="_blank">Report Link</a></li>';
                    }
                    htmldata += '</ul>';
                    // htmldata += '<h3>'+diamonddata.lab+', '+diamonddata.reportnumber+'</h3>';
                    // // if(diamonddata.reportfilelink!='')
                    // // {
                    //     htmldata += '<a href="'+diamonddata.reportfilelink+'" target="_blank">Report Link</a>';
                    // // }


                    htmldata += '</div>';
                    // htmldata+='<div class="searchgreade">';
                    // htmldata+='<button type="button" class="btn searchbtnset">$/ct<br><b>$ 380</b></button>';
                    // htmldata+='</div>';
                    // htmldata+='<div class="searchgreade">';
                    // htmldata+='<button type="button" class="btn searchbtnset">Savani%<br><b>-83.23%</b></button>';
                    // htmldata+='</div>';
                    // htmldata += '<div class="searchgreade">';
                    // htmldata += '<button type="button" class="btn searchbtnset">Total<br><b>$' + diamonddata.price + '</b></button>';
                    // htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="text-right searchright">';
                    htmldata += '<div class="searchgreade searchcom">';
                    htmldata += '<button type="button" class="btn searchbtnset contactdiamondseller" data-diamondid="' + diamonddata.id + '" data-diamondname="' + diamonddata.shape + ',' + diamonddata.size + ',' + diamonddata.color + ',' + diamonddata.clarity + '">Contact Seller</button>';
                    htmldata += '</div>';
                    // htmldata+='<div class="searchgreade searchcom">';
                    // htmldata+='<button type="button" class="btn searchbtnset">Compare</button>';
                    // htmldata+='</div>';
                    // htmldata += '<div class="searchgreade searchcom">';
                    // htmldata += '<button type="button" class="btn searchbtnset btnshowdiamonddetail" data-diamondid="' + diamonddata.id + '" >Diamond Page</button>';
                    // htmldata += '</div>';
                    // htmldata+='<div class="searchgreade searchcom">';
                    // htmldata+='<button type="button" class="btn searchbtnset">More</button>';
                    // htmldata+='</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="col-12 searchddetail">';
                    htmldata += '<div class="row">';
                    htmldata += '<div class="col-md-6 searchddetail1">';
                    htmldata += '<div class="card">';
                    htmldata += '<div class="card-body">';
                    htmldata += '<div class="headset">';
                    htmldata += '<h5 class="text-left">';
                    htmldata += '   Diamond Details';
                    htmldata += '</h5>';
                    htmldata += '<h4>Last Update: ' + diamonddata.timestamp + '</h4>';
                    htmldata += '</div>';
                    htmldata += '<div class="searchmoredetail">';
                    htmldata += '<div class="row">';
                    htmldata += '<div class="col-md-6">';
                    htmldata += '<ul>';
                    htmldata += '<li><b>Shape</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.shape + '</span></li>';
                    htmldata += '<li><b>Avg. Size</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.size + '</span></li>';
                    htmldata += '<li><b>Avg. Color</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.color + '</span></li>';
                    htmldata += '<li><b>Avg. Clarity</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.clarity + '</span></li>';
                    // htmldata += '<li><b>Cut</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.cut + '</span></li>';
                    // htmldata += '<li><b>Polish</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.polish + '</span></li>';
                    // htmldata += '<li><b>Symm</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.symmetry + '</span></li>';
                    // htmldata += '<li><b>Fluor.</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fluorescenecolor + '</span></li>';
                    // htmldata += '<li><b>Lab</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.lab + '</span></li>';
                    htmldata += '</ul>';
                    htmldata += '</div>';
                    htmldata += '<div class="col-md-6">';
                    htmldata += '<ul>';
                    // htmldata+='<li><b>$/ct</b>: <span class="metalpurity1">&nbsp; $354</span></li>';
                    // htmldata+='<li><b>%Savani</b>: <span class="metalpurity1">&nbsp; -83.9%</span></li>';
                    htmldata += '<li><b>Total</b>: <span class="metalpurity1">&nbsp; $' + diamonddata.price + '</span></li>';
                    // htmldata += '<li><b>Depth</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.depthper + '%</span></li>';
                    // htmldata += '<li><b>Table</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tableper + '% </span></li>';
                    // htmldata += '<li><b>Measurement</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</span></li>';
                    // htmldata += '<li><b>Vendor Stock No. </b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stocknumber + '</span></li>';
                    // htmldata+='<li><b>Status</b>: <span class="metalpurity1">&nbsp; G</span></li>';
                    // htmldata+='<li><b>Media</b>: <span class="metalpurity1">&nbsp; -</span></li>';
                    // htmldata+='<li><b>Ratio</b>: <span class="metalpurity1">&nbsp; 1.132</span></li>';
                    htmldata += '</ul>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="col-md-3 searchddetail2">';
                    htmldata += '<div class="row">';
                    htmldata += '<div class="col-md-12 detail1search">';
                    htmldata += '<div class="headset">';
                    htmldata += '<h5 class="text-left">';
                    htmldata += 'Price';
                    htmldata += '</h5>';
                    htmldata += '<div class="pricecalimg">';
                    // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/pricecal.svg" alt="' + diamonddata.savanilotnumber + '" title="' + diamonddata.savanilotnumber + '">';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="searchmoredetail3">';
                    htmldata += '<ul>';
                    htmldata += '<li><b>Lot Diamond #</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.savanilotnumber + '</span></li>';
                    htmldata += '<li><b>Availability</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.availability + '</span></li>';
                    htmldata += '<li><b>Diamond Location</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.country + '</span></li>';
                    htmldata += '<li><b>Stock No #</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stock + '</span></li>';
                    htmldata += '<li><b>Price</b>: <span class="metalpurity1">&nbsp; $' + diamonddata.price + '</span></li>';
                    htmldata += '</ul>';
                    htmldata += '</div>';

                    // htmldata+='<div class="headset">';
                    // // htmldata+='<h5 class="text-left">';
                    // // htmldata+='<li>$/ct</li>';
                    // // htmldata+='<li>$/ct</li>';
                    // // htmldata+='<li>$/ct</li>';
                    // // htmldata+='</h5>';
                    // // htmldata+='<div class="cashname">';
                    // // // htmldata+='<ul>';
                    // // // htmldata+='<li> <b>cash</b></li>';
                    // // // htmldata+='<li>$350</li>';
                    // // // htmldata+='<li>-56%</li>';
                    // // // htmldata+='<li>$230</li>';
                    // // // htmldata+='</ul>';
                    // // // htmldata+='<ul>';
                    // // // htmldata+='<li> <b>Price</b></li>';
                    // // // htmldata+='<li>$410</li>';
                    // // // htmldata+='<li>-56.20%</li>';
                    // // // htmldata+='<li>$850</li>';
                    // // // htmldata+='</ul>';
                    // // htmldata+='</div>';
                    // htmldata+='</div>';
                    htmldata += '</div>';



                    // htmldata += '<div class="col-md-12 mediaset">';
                    // htmldata += '<h4>Media</h4>';

                    // var disabledreport = 'disabled';
                    // var linkreport = 'javascript:void(0);';
                    // var targetreport = '';
                    // if (diamonddata.reportfilelink != '') {
                    //     disabledreport = '';
                    //     linkreport = diamonddata.reportfilelink;
                    //     targetreport = '_blank';
                    // }

                    // htmldata += '<a class="btn reseacbtn ' + disabledreport + '" ' + disabledreport + ' href="' + linkreport + '" target="' + targetreport + '" data-diamondid="' + diamonddata.id + '">';
                    // htmldata += '<div class="pricecalimg">';
                    // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/report.svg" alt="diamonds" title="diamonds">';
                    // htmldata += '</div>';
                    // htmldata += 'Report';
                    // htmldata += '</a>';

                    // htmldata += '<button type="button" class="btn reseacbtn btnshowdiamonddetail" data-diamondid="' + diamonddata.id + '">';
                    // htmldata += '<div class="pricecalimg">';
                    // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/diogram.svg" alt="diamonds" title="diamonds">';
                    // htmldata += '</div>';
                    // htmldata += 'Diagram';
                    // htmldata += '</button>';
                    // htmldata += '<button type="button" class="btn reseacbtn btnshowdiamonddetail" data-diamondid="' + diamonddata.id + '">';
                    // htmldata += '<div class="pricecalimg">';
                    // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/video.svg" alt="diamonds" title="diamonds">';
                    // htmldata += '</div>';
                    // htmldata += 'Video';
                    // htmldata += '</button>';
                    // htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';

                    var sellerdetails = diamonddata.persondetail[0];

                    htmldata += '<div class="col-md-3 searchddetail2">';
                    htmldata += '<div class="row sedetil">';
                    htmldata += '<div class="col-md-12 detail1search">';
                    htmldata += '<div class="headset">';
                    htmldata += '<h5 class="text-left">';
                    htmldata += 'Seller Details';
                    htmldata += '</h5>';
                    htmldata += '</div>';
                    htmldata += '<div class="row setpro">';
                    htmldata += '<div class="col-md-8 ">';
                    htmldata += ' <ul class="d-flex justify-content-between align-items-center">';
                    htmldata += '<li>';
                    htmldata += '<div class="profileimg">';
                    htmldata += '<img src="' + sellerdetails.profileimg + '" alt="' + sellerdetails.personname + '" title="' + sellerdetails.personname + '">';
                    htmldata += '</div>';
                    htmldata += '</li>';
                    htmldata += '<li>';
                    htmldata += '<div class="desc ">';
                    htmldata += '<h4>' + sellerdetails.companyname + '</h4>';
                    htmldata += '<h5><b>Savani ID</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.savaniid + '</span></h5>';
                    htmldata += '</div>';
                    htmldata += '</li>';
                    htmldata += '</ul>';
                    htmldata += '</div>';
                    // htmldata+='<div class="col-md-5 afprofile">';
                    // htmldata+='<ul class="d-flex justify-content-between align-items-center">';
                    // htmldata+='<li>';
                    // htmldata+='<div class="sideimg">';
                    // htmldata+='<img src="<?php echo $config->getImageurl(); ?>images/searchpage/review.svg" alt="diamonds" title="diamonds">';
                    // htmldata+='</div>';
                    // htmldata+='</li>';
                    // htmldata+='<li>';
                    // htmldata+='<div class="desc">';
                    // htmldata+='<h6>no reating yet</h6>';
                    // htmldata+='</div>';
                    // htmldata+='</li>';
                    // htmldata+='</ul>';
                    // htmldata+='</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="searchmoredetail3">';
                    htmldata += '<ul>';
                    htmldata += '<li><b>Location</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.countryname + '</span></li>';
                    htmldata += '<li><b>Contact Person</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.personname + '</span></li>';
                    htmldata += '<li><b>Phone</b>: <span class="metalpurity1">&nbsp; <a href="tel:' + sellerdetails.phonecode + '' + sellerdetails.businessphoneno + '" >' + sellerdetails.phonecode + ' ' + sellerdetails.businessphoneno + '</a></span></li>';
                    htmldata += '</ul>';
                    htmldata += '</div>';

                    htmldata += '</div>';

                    // htmldata += '<div class="col-md-12 noteset">';
                    // // htmldata += '<div class="writset">';
                    // // htmldata += '<textarea class="form-control" rows="4" placeholder=" Write a personal note...." id="comment"></textarea>';
                    // // htmldata += '</div>';

                    // htmldata += '<div class="colsave">';
                    // htmldata += '<ul>';

                    // htmldata += '<li>';
                    // htmldata += '<div class="colorset">';
                    // htmldata += '<input type="color" class="scolor" id="colorpicker" value="#0000ff">';
                    // htmldata += '</div>';
                    // htmldata += '<p>if you want to change color top here</p>';
                    // htmldata += '</li>';

                    // htmldata += '<li>';
                    // htmldata += '<button type="button" class="btn searchbtnset">save</button>';
                    // htmldata += '</li>';
                    // htmldata += '</ul>';
                    // htmldata += '</div>';
                    // htmldata += '</div>';

                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</td>';





                }
                // $('.listdiamondparcelDataDiv #listparceldiamondData').html(htmldata);
                if (resultdata.nextpage == 1) {
                    $('.listdiamondparcelDataDiv #listparceldiamondData').html(htmldata);
                } else {
                    $('.listdiamondparcelDataDiv #listparceldiamondData').append(htmldata);
                }
                $('#showparceldiamondentries').html(resultdata.showentries);
                $('#listparceldiamondDatatbl').attr('data-nextpage', resultdata.nextpage);
                if (resultdata.loadmore == 1) {
                    $('#listparceldiamondDatatbl').attr('data-show', 1);
                } else {
                    $('#listparceldiamondDatatbl').attr('data-show', 0);
                }



            }


        }

        function OnErrorlistparceldiamond(content) {

        }
    }

    $('body').on('change', '#parcelsortbyid', function() {
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        $("#listparceldiamondData").animate({
            scrollTop: 0
        }, "slow");
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });

    $('body').on('change', '#parceldiamond_per_page', function() {
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        $("#listparceldiamondData").animate({
            scrollTop: 0
        }, "slow");
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });

    $('#listparceldiamondDatatbl tbody').scroll(function() {
        if ($(this).scrollTop() +
            $(this).innerHeight() >=
            $(this)[0].scrollHeight) {
            var dataact = getpagename();
            var show = $('#listparceldiamondDatatbl').attr('data-show');
            if (dataact && show == 1) {
                listparceldiamonddata(1, 'form-diamond-parcel-side-search');
            }
        }
    });


    // function list
    function fillsearchparceldiamondlist(type) {
        var htmllistdata = '';

        if (shapeparcelarr.length > 0) {
            for (var i = 0; i < shapeparcelarr.length; i++) {
                var id = shapeparcelarr[i].id;
                var name = shapeparcelarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeparcelshapeflt  fltparcelshape' + id + ' searchbtnset"><b> Shape : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (colorparcelarr.length > 0) {
            for (var i = 0; i < colorparcelarr.length; i++) {
                var id = colorparcelarr[i].id;
                var name = colorparcelarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeparcelcolorflt  fltparcelcolor' + id + ' searchbtnset"><b> Color : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (clarityparcelarr.length > 0) {
            for (var i = 0; i < clarityparcelarr.length; i++) {
                var id = clarityparcelarr[i].id;
                var name = clarityparcelarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeparcelclarityflt  fltparcelclarity' + id + ' searchbtnset"><b> Clarity : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (sieveparcelarr.length > 0) {
            for (var i = 0; i < sieveparcelarr.length; i++) {
                var id = sieveparcelarr[i].id;
                var name = sieveparcelarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeparcelsieveflt  fltparcelsieve' + id + ' searchbtnset"><b> Sieve : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltfromparcelsize && flttoparcelsize > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removeparcelfromtosize searchbtnset"><b> Size : </b><span>' + fltfromparcelsize + '-' + flttoparcelsize + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfrompiecepercarat && flttopiecepercarat > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removeparcelfromtopiecepercarat searchbtnset"><b> Piece Per Carat : </b><span>' + fltfrompiecepercarat + '-' + flttopiecepercarat + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfrompriceparcel && fltfrompriceparcel > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removeparcelfromtoprice searchbtnset"><b> Price : </b><span>$' + fltfrompriceparcel + '-$' + flttopriceparcel + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        $('.searchparceldiamondlistDiv').html(htmllistdata);
        getparcelsidebarelementvalue();
        // fillparceldiamondsearchelementvalue();
    }

    $('body').on('click', '.removeparcelshapeflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltparcelshape' + id + '').remove();
        $('#fltshapeparcelid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(shapeparcelarr, id);
        $("#s_fltshapeparcelid").val(arrid).trigger('change');
        // if(type==2)
        // {

        //     fillparceldiamondsearchelementvalue();
        // }
        // else
        // {
        //     getparcelfiltersvalue();
        // }
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });

    $('body').on('click', '.removeparcelcolorflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltparcelcolor' + id + '').remove();
        $('#fltcolorparcelid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(colorparcelarr, id);
        $("#s_fltcolorparcelid").val(arrid).trigger('change');
        // if(type==2)
        // {

        //     fillparceldiamondsearchelementvalue();
        // }
        // else
        // {
        //     getparcelfiltersvalue();
        // }
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });

    $('body').on('click', '.removeparcelclarityflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltparcelclarity' + id + '').remove();
        $('#fltclarityparcelid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(clarityparcelarr, id);
        $("#s_fltclarityparcelid").val(arrid).trigger('change');
        // if(type==2)
        // {

        //     fillparceldiamondsearchelementvalue();
        // }
        // else
        // {
        //     getparcelfiltersvalue();
        // }
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });



    $('body').on('click', '.removeparcelsieveflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltparcelsieve' + id + '').remove();
        var arrid = removeindexfromarr(sieveparcelarr, id);
        $("#fltsieveid").val(arrid).trigger('change');
        // if(type==2)
        // {

        //     fillparceldiamondsearchelementvalue();
        // }
        // else
        // {
        //     getparcelfiltersvalue();
        // }
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });


    $('body').on('click', '.removeparcelfromtosize', function() {
        var type = $(this).attr('data-type');
        $('#fltfromparcelsize').val(0);
        $('#flttoparcelsize').val(0);
        $('#s_fltfromparcelsize').val(0);
        $('#s_flttoparcelsize').val(0);
        $(this).remove();
        // if(type==2)
        // {
        //     fillparceldiamondsearchelementvalue();
        // }
        // else
        // {
        //     getparcelfiltersvalue();
        // }

        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });

    $('body').on('click', '.removeparcelfromtopiecepercarat', function() {
        var type = $(this).attr('data-type');
        $('#fltfrompiecepercarat').val(0);
        $('#flttopiecepercarat').val(0);
        $('#s_fltfrompiecepercarat').val(0);
        $('#s_flttopiecepercarat').val(0);
        $(this).remove();
        // if(type==2)
        // {
        //     fillparceldiamondsearchelementvalue();
        // }
        // else
        // {
        //     getparcelfiltersvalue();
        // }
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });

    $('body').on('click', '.removeparcelfromtoprice', function() {
        var type = $(this).attr('data-type');
        $('#fltfrompriceparcel').val(0);
        $('#flttopriceparcel').val(0);
        $('#s_fltfrompriceparcel').val(0);
        $('#s_flttopriceparcel').val(0);
        $(this).remove();
        // if(type==2)
        // {
        //     fillparceldiamondsearchelementvalue();
        // }
        // else
        // {
        //     getparcelfiltersvalue();
        // }
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });


    $('#btnnewparcelsearch').on('click', function() {
        $("#form-diamond-parcel-search").validate().resetForm();
        $('#form-diamond-parcel-search').trigger("reset");
        // $("#form-diamond-side-search").validate().resetForm();
        // $('#form-diamond-side-search').trigger("reset");
        $('#form-diamond-parcel-search').removeClass('d-none');
        $('.listdiamondparcelDataDiv').addClass('d-none');
        $('.select2').select2();
        $('#btnparceldiamondsearch').attr('disabled', true);

    });

    $('#btnresetparcelsearch').on('click', function() {
        $("#form-diamond-parcel-search").validate().resetForm();
        $('#form-diamond-parcel-search').trigger("reset");
        $('.select2').select2();
        $('#btnparceldiamondsearch').attr('disabled', true);
    });


    // function fillparceldiamondsearchelementvalue()
    // {

    //     var fltshapeparcelid = $('#s_fltshapeparcelid').val();
    //     if (fltshapeparcelid.length > 0) {
    //         for (var i = 0; i < fltshapeparcelid.length; i++) {
    //             var shapeid = $('#s_fltshapeparcelid option[value=' + fltshapeparcelid[i] + ']').val();
    //             $('#fltshapeparcelid' + shapeid + '').prop('checked', true);
    //         }
    //     }

    //    var fltcolorparcelid = $('#s_fltcolorparcelid').val();
    //     if (fltcolorparcelid.length > 0) {
    //         for (var i = 0; i < fltcolorparcelid.length; i++) {
    //             var colorid = $('#s_fltcolorparcelid option[value=' + fltcolorparcelid[i] + ']').val();
    //             $('#fltcolorparcelid' + colorid + '').prop('checked', true);
    //         }
    //     }

    //     var fltclarityparcelid = $('#s_fltclarityparcelid').val();
    //     if (fltclarityparcelid.length > 0) {
    //         for (var i = 0; i < fltclarityparcelid.length; i++) {
    //             var clarityid = $('#s_fltclarityparcelid option[value=' + fltclarityparcelid[i] + ']').val();
    //             $('#fltclarityparcelid' + clarityid + '').prop('checked', true);
    //         }
    //     }

    //     var fltsieveid = $('#s_fltsieveid').val();
    //     if (fltsieveid.length > 0) {
    //         for (var i = 0; i < fltsieveid.length; i++) {
    //             var sieveid = $('#s_fltsieveid option[value=' + fltsieveid[i] + ']').val();
    //             sieveparcelidarr.push(sieveid);
    //         }
    //     }
    //     if (sieveparcelidarr.length > 0) {
    //         $("#fltsieveid").val(sieveparcelidarr).trigger('change');
    //         $('#fltsieveid').select2();
    //     } else {
    //         $("#fltsieveid").val(null).trigger('change');
    //         $('#fltsieveid').select2();
    //     }
    //     //console.log(fltfromparcelsize);
    //     //console.log(flttoparcelsize);
    //     fltfromparcelsize = $('#s_fltfromparcelsize').val();
    //     $('#fltfromparcelsize').val(fltfromparcelsize);
    //     flttoparcelsize = $('#s_flttoparcelsize').val();
    //     $('#flttoparcelsize').val(flttoparcelsize);
    //     return false;
    //     fltfrompiecepercarat = $('#s_fltfrompiecepercarat').val();
    //     $('#fltfrompiecepercarat').val(fltfrompiecepercarat);
    //     flttopiecepercarat = $('#s_flttopiecepercarat').val();
    //     $('#flttopiecepercarat').val(flttopiecepercarat);
    //     fltfrompriceparcel = $('#s_fltfrompriceparcel').val();
    //     $('#fltfrompriceparcel').val(fltfrompriceparcel);
    //     flttopriceparcel = $('#s_flttopriceparcel').val();
    //     $('#flttopriceparcel').val(flttopriceparcel);

    // }


    /************** UPLOAD DIAMOND CSV *********************/

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
        formdata.append("typeid", 26);

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
            $('#diamondcsvuploaddetail').html(htmldata);
        } else if (resultdata.status == 1) {
            $('#diamondcsvuploaddetail').html(resultdata.result[0].description);
        }

    }

    function OnErrorfillcontentsetting(content) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }

    function getselectedfilename() {
        var isfileselected = 0;
        $('#btndiamondcsvupload').attr('disabled', true);
        $('#form-diamond-csv-upload .selectedfilenameText').html('No File Selected.');
        var filename = $('#diamondcsvfile').val().replace(/C:\\fakepath\\/i, '');
        if (filename != '' && filename != null) {
            $('#form-diamond-csv-upload .selectedfilenameText').html(filename);
            $('#btndiamondcsvupload').attr('disabled', false);
            isfileselected = 1;
        }
        return isfileselected;
    }
    $("#diamondcsvfile").change(function() {
        getselectedfilename();
    });

    if ($('#form-diamond-csv-upload').length) {
        $('#form-diamond-csv-upload').validate({
            rules: {

            },
            messages: {

            },
            submitHandler: function(form) {

                var isfileselected = getselectedfilename();
                if (isfileselected > 0) {

                    showloader();
                    $('#btndiamondcsvupload').attr('disabled', true);
                    var pagename = getpagename();
                    var useraction = $('#formevent').val();
                    formdata = new FormData(form);
                    formdata.append("action", "uploaddiamondcsv");
                    var headersdata = {
                        'Accept': 'application/json',
                        platform: 4,
                        userpagename: pagename,
                        useraction: useraction,
                        masterlisting: false
                    };
                    ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccessuploaddiamondcsv, OnErroruploaddiamondcsv)

                    function Onsuccessuploaddiamondcsv(data) {
                        hideloader();
                        var JsonData = JSON.stringify(data);
                        var resultdata = jQuery.parseJSON(JsonData);
                        if (resultdata.status == 0) {
                            Notiflix.Notify.Failure(resultdata.message);

                        } else if (resultdata.status == 1) {
                            Notiflix.Notify.Success(resultdata.message);
                            resetdiamondcsvupload();

                        }

                    }

                    function OnErroruploaddiamondcsv(content) {

                    }

                } else {
                    alertify('Please select csv file', 0);
                }


            },
        });
    }

    function resetdiamondcsvupload() {
        $("#form-diamond-csv-upload").validate().resetForm();
        $('#form-diamond-csv-upload').trigger("reset");
        getselectedfilename();
    }
    $('#btnresetdiamondcsvupload').click(function() {
        resetdiamondcsvupload();
    });

    // $(".uploadonenext").click(function() {
    //     $(".uploadfir").hide();
    // });
    // $(".uploadonenext").click(function() {
    //     $(".uploadtwo").show();
    // });


    // $(".uploadtw").click(function() {
    //     $(".uploadtwo").hide();
    // });
    // $(".uploadtw").click(function() {
    //     $(".uploadth").show();
    // });

    // $(".uploadthr").click(function() {
    //     $(".uploadth").hide();
    // });
    // $(".uploadthr").click(function() {
    //     $(".uploadfour").show();
    // });

    // $(".uploadfo").click(function() {
    //     $(".uploadfour").hide();
    // });
    // $(".uploadfo").click(function() {
    //     $(".uploadfi").show();
    // });


    /* FILL DIAMOND UPLOAD FORM */
    function listavailability(availabilityid = '') {
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
        formdata.append("action", "listavailability");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistavailability, OnErrorlistavailability);

        function Onsuccesslistavailability(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data.length > 0) {
                    htmldata += '<option value="">Select Availability</option>';
                    for (var i in resultdata.data) {
                        htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                    }
                }

            }
            $('#availabilityid').html(htmldata);
            if (availabilityid) {
                $('#availabilityid').val(availabilityid);
            }
            $('#availabilityid').select2();

        }

        function OnErrorlistavailability(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listcountry(countryid = '', stateid = '') {
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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistcountry, OnErrorlistcountry);

        function Onsuccesslistcountry(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data.length > 0) {
                    htmldata += '<option value="">Select Country</option>';
                    for (var i in resultdata.data) {
                        htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                    }
                }

            }
            $('#countryid').html(htmldata);
            if (countryid) {
                $('#countryid').val(countryid);
            }
            $('#countryid').select2();
            liststate(stateid, countryid);

        }

        function OnErrorlistcountry(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    $('#countryid').on('change', function() {
        liststate();
    });

    function liststate(stateid = '', editcountryid = '') {

        var countryid = $('#countryid').val();
        if (editcountryid) {
            countryid = editcountryid;
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
        formdata.append("action", "liststate");

        formdata.append("countryid", countryid);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessliststate, OnErrorliststate);

        function Onsuccessliststate(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            htmldata += '<option value="">Select State</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#stateid').html(htmldata);
            if (stateid) {
                $('#stateid').val(stateid);
            }
            //console.log(htmldata);
            $('#stateid').select2();

        }

        function OnErrorliststate(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listgridlecondition(gridleconditionid = '') {

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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistgridlecondition, OnErrorlistgridlecondition);

        function Onsuccesslistgridlecondition(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            htmldata += '<option value="">Select Gridle Condition</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#gridleconditionid').html(htmldata);
            if (gridleconditionid) {
                $('#gridleconditionid').val(gridleconditionid);
            }
            //console.log(htmldata);
            $('#gridleconditionid').select2();

        }

        function OnErrorlistgridlecondition(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listgridlemin(gridleminid = '') {

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
        formdata.append("action", "listgirdle");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistgridlemin, OnErrorlistgridlemin);

        function Onsuccesslistgridlemin(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            htmldata += '<option value="">Select Gridle Min.</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#gridleminid').html(htmldata);
            if (gridleminid) {
                $('#gridleminid').val(gridleminid);
            }
            //console.log(htmldata);
            $('#gridleminid').select2();

        }

        function OnErrorlistgridlemin(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }


    function listgridlemax(gridlemaxid = '') {

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
        formdata.append("action", "listgirdle");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistgridlemax, OnErrorlistgridlemax);

        function Onsuccesslistgridlemax(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            htmldata += '<option value="">Select Gridle Max.</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#gridlemaxid').html(htmldata);
            if (gridlemaxid) {
                $('#gridlemaxid').val(gridlemaxid);
            }
            //console.log(htmldata);
            $('#gridlemaxid').select2();

        }

        function OnErrorlistgridlemax(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listculetcondition(culetconditionid = '') {

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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistculetcondition, OnErrorlistculetcondition);

        function Onsuccesslistculetcondition(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            htmldata += '<option value="">Select Culet Condition</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#culetconditionid').html(htmldata);
            if (culetconditionid) {
                $('#culetconditionid').val(culetconditionid);
            }
            //console.log(htmldata);
            $('#culetconditionid').select2();

        }

        function OnErrorlistculetcondition(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listculetsize(culetsizeid = '') {

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
        formdata.append("action", "listsize");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistculetsize, OnErrorlistculetsize);

        function Onsuccesslistculetsize(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            htmldata += '<option value="">Select Culet Size</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#culetsizeid').html(htmldata);
            if (culetsizeid) {
                $('#culetsizeid').val(culetsizeid);
            }
            //console.log(htmldata);
            $('#culetsizeid').select2();

        }

        function OnErrorlistculetsize(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }




    /* UPLOAD DIAMOND DATA */

    if ($('#form-diamond-upload').length) {
        $('#form-diamond-upload').validate({
            rules: {
                stock: {
                    required: true
                },
                price: {
                    required: true,
                    number: true
                },
                shapeid: {
                    required: true,
                },
                size: {
                    required: true,
                    number: true
                },
                colorid: {
                    required: true,
                },
                clarityid: {
                    required: true,
                },
            },
            messages: {
                stock: {
                    required: 'Stock is required',
                },
                price: {
                    required: 'Price is required',
                },
                shapeid: {
                    required: 'Shape is required',
                },
                size: {
                    required: 'Size is required',
                },
                colorid: {
                    required: 'Color is required',
                },
                clarityid: {
                    required: 'Clarity is required',
                },
            },
            submitHandler: function(form) {

                showloader();
                var pagename = getpagename();
                var useraction = $('#formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "uploaddiamond");
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 4,
                    userpagename: pagename,
                    useraction: useraction,
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccessuploaddiamond, OnErroruploaddiamond)

                function Onsuccessuploaddiamond(data) {
                    hideloader();
                    var JsonData = JSON.stringify(data);
                    var resultdata = jQuery.parseJSON(JsonData);

                    if (resultdata.status == 0) {
                        Notiflix.Notify.Failure(resultdata.message);
                    } else if (resultdata.status == 1) {
                        Notiflix.Notify.Success(resultdata.message);
                        $('.searchmydiamondlistDiv').html('');
                        checkmydiamondformelementvalue();
                        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
                        $('#v-pills-3-tab').click();
                        resetdiamonduploadform();

                    }

                }

                function OnErroruploaddiamond(content) {

                }


            },
        });
    }

    function resetdiamonduploadform() {
        $("#form-diamond-upload").validate().resetForm();
        $('#form-diamond-upload').trigger("reset");
        $('#form-diamond-upload .select2').select2();
        $('#form-diamond-upload #formevent').val('submit');
        $('.diamonduploadesirmodetext').html('Upload');
        $('#form-diamond-upload #id').val('');
        $('#form-diamond-upload #btnsavediamond').html('Save');
        $('.uploaddiamondtabs li').attr('disabled', true);
        $('.uploaddiamondtabs li').addClass('disabled');
        $('.uploaddiamondtabs li a').addClass('disabled');
        $('.uploaddiamondtabs li a').attr('disabled', true);
        openprvioustab('generalinfoDiv');
        checkfancycolorflag();
        checkmatchpairflag();
        checkisparcelflag();
    }
    $('#btnresetdiamondupload').on('click', function() {
        resetdiamonduploadform();
    });

    $('.btnnextdiamonduploadform').click(function() {

        var nexttab = $(this).attr('data-next-tab');
        opennexttab(nexttab);
    });


    function openprvioustab(prevtab) {
        $('.uploaddiamondtabs .li' + prevtab).addClass('active');
        $('.uploaddiamondtabs .li' + prevtab + ' a').click();
        var type = $('.uploaddiamondtabs .li' + prevtab).attr('data-tab');

        $('.uploaddiamondtabs .li' + prevtab).attr('disabled', false);
        $('.uploaddiamondtabs .li' + prevtab).removeClass('disabled');
        $('.uploaddiamondtabs .li' + prevtab + ' a').removeClass('disabled');
        $('.uploaddiamondtabs .li' + prevtab + ' a').attr('disabled', false);
        if (type == 1) {
            $('.uploaddiamondtabs .lireportinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .lireportinfoDiv a').removeClass('active');

            $('.uploaddiamondtabs .liotherinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liotherinfoDiv a').removeClass('active');

            $('.uploaddiamondtabs .liimgreportinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liimgreportinfoDiv a').removeClass('active');

            $('.uploaddiamondtabs .liadditionalinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liadditionalinfoDiv a').removeClass('active');
        } else if (type == 2) {
            $('.uploaddiamondtabs .liotherinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liotherinfoDiv a').removeClass('active');

            $('.uploaddiamondtabs .liimgreportinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liimgreportinfoDiv a').removeClass('active');

            $('.uploaddiamondtabs .liadditionalinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liadditionalinfoDiv a').removeClass('active');
        } else if (type == 3) {
            $('.uploaddiamondtabs .liimgreportinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liimgreportinfoDiv a').removeClass('active');

            $('.uploaddiamondtabs .liadditionalinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liadditionalinfoDiv a').removeClass('active');
        } else if (type == 4) {
            $('.uploaddiamondtabs .liadditionalinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liadditionalinfoDiv a').removeClass('active');
        }
    }

    $('.btnprevdiamonduploadform').click(function() {

        var prevtab = $(this).attr('data-prev-tab');
        openprvioustab(prevtab);
    });

    function opennexttab(nexttab) {


        // $('.uploaddiamondtabs .li'+nexttab).addClass('active');
        // $('.uploaddiamondtabs .li'+nexttab+' a').click();

        var type = $('.uploaddiamondtabs .li' + nexttab).attr('data-tab');
        // //console.log(type);
        $("#nav-tabContent-DiamondUploadFormDiv .tab-pane").each(function() {
            $(this).removeClass('active');
        });

        $('.uploaddiamondtabs .li' + nexttab).attr('disabled', false);
        $('.uploaddiamondtabs .li' + nexttab).removeClass('disabled');
        $('.uploaddiamondtabs .li' + nexttab + ' a').removeClass('disabled');
        $('.uploaddiamondtabs .li' + nexttab + ' a').attr('disabled', false);

        if (type == 1) {
            $('.uploaddiamondtabs .ligeneralinfoDiv').addClass('active');
            $('.uploaddiamondtabs .ligeneralinfoDiv a').addClass('active');
            $('#nav-tabContent-DiamondUploadFormDiv #generalinfoDiv').addClass('active');

        } else if (type == 2) {
            $('.uploaddiamondtabs .ligeneralinfoDiv').addClass('active');
            $('.uploaddiamondtabs .ligeneralinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .lireportinfoDiv').addClass('active');
            $('.uploaddiamondtabs .lireportinfoDiv a').addClass('active');


            $('#nav-tabContent-DiamondUploadFormDiv #reportinfoDiv').addClass('active');
        } else if (type == 3) {
            $('.uploaddiamondtabs .ligeneralinfoDiv').addClass('active');
            $('.uploaddiamondtabs .ligeneralinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .lireportinfoDiv').addClass('active');
            $('.uploaddiamondtabs .lireportinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .liotherinfoDiv').addClass('active');
            $('.uploaddiamondtabs .liotherinfoDiv a').addClass('active');

            $('#nav-tabContent-DiamondUploadFormDiv #otherinfoDiv').addClass('active');
        } else if (type == 4) {
            $('.uploaddiamondtabs .ligeneralinfoDiv').addClass('active');
            $('.uploaddiamondtabs .ligeneralinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .lireportinfoDiv').addClass('active');
            $('.uploaddiamondtabs .lireportinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .liotherinfoDiv').addClass('active');
            $('.uploaddiamondtabs .liotherinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .liimgreportinfoDiv').addClass('active');
            $('.uploaddiamondtabs .liimgreportinfoDiv a').addClass('active');

            $('#nav-tabContent-DiamondUploadFormDiv #imgreportinfoDiv').addClass('active');
        } else if (type == 5) {
            $('.uploaddiamondtabs .ligeneralinfoDiv').addClass('active');
            $('.uploaddiamondtabs .ligeneralinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .lireportinfoDiv').addClass('active');
            $('.uploaddiamondtabs .lireportinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .liotherinfoDiv').addClass('active');
            $('.uploaddiamondtabs .liotherinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .liimgreportinfoDiv').addClass('active');
            $('.uploaddiamondtabs .liimgreportinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .liadditionalinfoDiv').addClass('active');
            $('.uploaddiamondtabs .liadditionalinfoDiv a').addClass('active');

            $('#nav-tabContent-DiamondUploadFormDiv #additionalinfoDiv').addClass('active');
        }

    }

    function checkgeneralinfofields() {
        var stock = $('#stock').val();
        var price = $('#price').val();
        var isvalid = 0;
        if (stock && price) {
            isvalid = 1;
        }
        return isvalid;
    }

    $('#btngeneralinfo').click(function() {
        var isvalid = checkgeneralinfofields();
        console.log(isvalid);
        if (isvalid == 1) {
            opennexttab('reportinfoDiv');
        } else {

            opennexttab('generalinfoDiv');
            Notiflix.Notify.Failure('Please fill all required fields');
        }
    });

    function checkreportinfofields() {
        var shapeid = $('#shapeid').val();
        var size = $('#size').val();
        var colorid = $('#colorid').val();
        var clarityid = $('#clarityid').val();
        var isvalid = 0;
        if (shapeid && size && colorid && clarityid) {
            isvalid = 1;
        }
        return isvalid;
    }

    $('#btnreportinfo').click(function() {
        var isvalidreport = checkreportinfofields();
        //console.log(isvalidreport);
        if (isvalidreport == 1) {
            opennexttab('otherinfoDiv');
        } else {

            opennexttab('reportinfoDiv');
            Notiflix.Notify.Failure('Please fill all required fields');
        }
    });


    $('.uploaddiamondtabs li a').click(function() {
        $('.uploaddiamondtabs li').removeClass('active');
        $('.uploaddiamondtabs li a').removeClass('active');
        var nexttab = $(this).attr('data-typename');
        opennexttab(nexttab);
    });

    $('#withfancycolor').on('change', function() {
        checkfancycolorflag();
    });

    function checkfancycolorflag() {
        if ($('#withfancycolor').prop('checked') == true) {
            $('.withfancycolorData').attr('disabled', false);
            $('.withfancycolorData').removeClass('disabled');
            $('.withfancycolorData').val(null).trigger('change');
        } else {
            $('.withfancycolorData').attr('disabled', true);
            $('.withfancycolorData').addClass('disabled');
            $('.withfancycolorData').val(null).trigger('change');
        }
    }

    $('#matchedpair').on('change', function() {
        checkmatchpairflag();
    });

    function checkmatchpairflag() {
        if ($('#matchedpair').prop('checked') == true) {
            $('.matchedpairData').attr('disabled', false);
            $('.matchedpairData').removeClass('disabled');
            $('#ispairseparable').prop('checked', false);
            $('#stocknumber').val('');
        } else {
            $('.matchedpairData').attr('disabled', true);
            $('.matchedpairData').addClass('disabled');
            $('#ispairseparable').prop('checked', false);
            $('#stocknumber').val('');
        }
    }

    $('#isparcel').on('change', function() {
        checkisparcelflag();
    });

    function checkisparcelflag() {
        if ($('#isparcel').prop('checked') == true) {
            $('#numofdiamond').attr('disabled', false);
            $('#numofdiamond').removeClass('disabled');
            $('#numofdiamond').val('');
        } else {
            $('#numofdiamond').attr('disabled', true);
            $('#numofdiamond').addClass('disabled');
            $('#numofdiamond').val('');
        }
    }



    /* LIST MY DIAMONDS */
    function listmydiamonddata(page, form = null) {


        var id = '<?php echo $id; ?>';
        // var form = $('#form-diamond-search').serialize();
        showloader();
        var pagename = getpagename();
        var useraction = $('#formevent').val();
        var diamond_per_page = $('#my_diamond_per_page').val();
        var sortbyid = $('#mydiamondsortbyid').val();

        var nextpage = 0;
        if ($('#listmydiamondDatatbl').attr('data-nextpage') > 0) {
            nextpage = $('#listmydiamondDatatbl').attr('data-nextpage');
        }
        if (form != null) {
            var formdata = new FormData(document.getElementById(form));
        } else {
            var formdata = new FormData();
        }
        formdata.append("action", "listdiamond");
        formdata.append("nextpage", parseInt(nextpage) + 1);
        formdata.append("fltparcel", 0);
        formdata.append("fltmanagemydiamond", 1);
        formdata.append("perpage", diamond_per_page);
        formdata.append("sortbyid", sortbyid);

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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccesslistmydiamond, OnErrorlistmydiamond)

        function Onsuccesslistmydiamond(data) {
            hideloader();
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {

                htmldata += '<tr>';
                htmldata += '<td colspan="16">';
                htmldata += '<h3>' + resultdata.message + '</h3>';
                htmldata += '</td>';
                htmldata += '</tr>';

                $('.listmydiamondDataDiv #listmydiamondData').html(htmldata);
                $('#showdiamondentries').html(0);

                $('.listmydiamondDataDiv .totaldiamonds').html('0 Diamonds ');
                $('.listmydiamondDataDiv .totalprice').html('Total Price : $0');


            } else if (resultdata.status == 1) {
                $('.listmydiamondDataDiv .totalmydiamonds').html('0 Diamonds ');
                $('.listmydiamondDataDiv .totalmyprice').html('Total Price : $0');
                if (resultdata.totaldiamond >= 0 && resultdata.totalprice >= 0 && resultdata.totaldiamond != null && resultdata.totalprice != null) {
                    // //console.log('totaldiamond'+resultdata.totaldiamond);
                    // //console.log('totalprice'+resultdata.totalprice);
                    $('.listmydiamondDataDiv .totalmydiamonds').html(resultdata.totaldiamond + ' Diamonds ');
                    $('.listmydiamondDataDiv .totalmyprice').html('Total Price : $' + resultdata.totalprice);
                }


                for (var i in resultdata.data) {
                    var diamonddata = resultdata.data[i];

                    htmldata += '<tr data-toggle="collapse" data-target="#searchdown' + diamonddata.id + '" class="sdown' + diamonddata.id + '">';
                    // htmldata += '<td>';
                    // // htmldata += '<div class="form-check">';
                    // // htmldata += '<input class="form-check-input sbox" type="checkbox" value="' + diamonddata.id + '" id="selectdiamondid' + diamonddata.id + '">';
                    // // htmldata += '<label class="form-check-label searchcheckbox" for="selectdiamondid' + diamonddata.id + '">';

                    // // htmldata += '</label>';
                    // // htmldata += '</div>';
                    // htmldata += '' + diamonddata.personname + '';
                    // htmldata += '</td>';
                    // htmldata+='<td>';
                    // htmldata+='<div class="searchreating">100%</div>';
                    // htmldata+='</td>';
                    htmldata += '<td>' + diamonddata.country + '</td>';
                    htmldata += '<td>' + diamonddata.shape + '</td>';
                    htmldata += '<td>' + diamonddata.size + '</td>';
                    htmldata += '<td>' + diamonddata.color + '</td>';
                    htmldata += '<td>' + diamonddata.clarity + '</td>';
                    htmldata += '<td>' + diamonddata.cut + '</td>';
                    htmldata += '<td>' + diamonddata.polish + '</td>';
                    htmldata += '<td>' + diamonddata.symmetry + '</td>';
                    htmldata += '<td>' + diamonddata.fluorescenecolor + '</td>';
                    htmldata += '<td>' + diamonddata.lab + '</td>';
                    // htmldata+='<td>$354</td>';
                    // htmldata+='<td>-83.9%</td>';
                    htmldata += '<td>$' + diamonddata.price + '</td>';
                    htmldata += '<td>' + diamonddata.depthper + '%</td>';
                    htmldata += '<td>' + diamonddata.tableper + '%</td>';
                    htmldata += '<td>' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</td>';
                    htmldata += '<td>' + diamonddata.stocknumber + '</td>';
                    // htmldata += '<td>';
                    // htmldata += '<a class="btn" href="javascript:void(0);" class="editmydiamond" data-diamondid="' + diamonddata.id + '"><i class="fas fa-edit"></i></a>';
                    // htmldata += '<a class="btn" href="javascript:void(0);" class="deletemydiamond" data-diamondid="' + diamonddata.id + '"><i class="fas fa-trash-alt"></i></a>';
                    // htmldata += '</td>';
                    // htmldata+='<td>G</td>';
                    // htmldata+='<td>-</td>';
                    // htmldata+='<td>1.132</td>';
                    htmldata += '</tr>';

                    htmldata += '<td class="searchPadding">';
                    htmldata += '<div class="collapse" id="searchdown' + diamonddata.id + '">';
                    htmldata += '<div class="col-12 col-md-12 searchddetail">';
                    htmldata += '<div class="text-left searchleft">';
                    htmldata += '<div class="diamondsearch">';
                    htmldata += '<ul>';
                    htmldata += '<li>';
                    // htmldata += '<div class="starimg">';
                    // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/star.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '">';
                    // htmldata += '</div>';
                    htmldata += '<h4>' + diamonddata.lab + ',' + diamonddata.shape + ',' + diamonddata.size + ',' + diamonddata.color + ',' + diamonddata.clarity + ',' + diamonddata.cut + ',' + diamonddata.polish + ',' + diamonddata.symmetry + '</h4>';
                    htmldata += '</li>';
                    // htmldata += '<li><b>Price &nbsp</b>$' + diamonddata.price + '</li>';
                    // htmldata += '<li>' + diamonddata.availability + '</li>';
                    // htmldata += '<li>' + diamonddata.lab + ', ' + diamonddata.reportnumber + '</li>';
                    if (diamonddata.reportfilelink != '') {
                        htmldata += '<li><a href="' + diamonddata.reportfilelink + '" target="_blank">Report Link</a></li>';
                    }
                    htmldata += '</ul>';
                    // htmldata += '<h3>'+diamonddata.lab+', '+diamonddata.reportnumber+'</h3>';
                    // // if(diamonddata.reportfilelink!='')
                    // // {
                    //     htmldata += '<a href="'+diamonddata.reportfilelink+'" target="_blank">Report Link</a>';
                    // // }


                    htmldata += '</div>';
                    // htmldata+='<div class="searchgreade">';
                    // htmldata+='<button type="button" class="btn searchbtnset">$/ct<br><b>$ 380</b></button>';
                    // htmldata+='</div>';
                    // htmldata+='<div class="searchgreade">';
                    // htmldata+='<button type="button" class="btn searchbtnset">Savani%<br><b>-83.23%</b></button>';
                    // htmldata+='</div>';
                    // htmldata += '<div class="searchgreade">';
                    // htmldata += '<button type="button" class="btn searchbtnset">Total<br><b>$' + diamonddata.price + '</b></button>';
                    // htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="text-right searchright">';
                    // htmldata += '<div class="searchgreade searchcom">';
                    // htmldata += '<button type="button" class="btn searchbtnset contactdiamondseller" data-diamondid="' + diamonddata.id + '" data-diamondname="' + diamonddata.shape + ',' + diamonddata.size + ',' + diamonddata.color + ',' + diamonddata.clarity + '">Contact Seller</button>';
                    // htmldata += '</div>';
                    htmldata += '<div class="searchgreade mr-1 searchcom">';
                    htmldata += '<a href="javascript:void(0);" class="btn editmydiamond searchbtnset" data-diamondid="' + diamonddata.id + '"><i class="fas fa-edit"></i>&nbsp;Edit</a>';
                    htmldata += '</div>';
                    htmldata += '<div class="searchgreade mr-1 searchcom">';
                    htmldata += '<a href="javascript:void(0);" class="btn deletemydiamond searchbtnset" data-diamondid="' + diamonddata.id + '"><i class="fas fa-trash-alt"></i>&nbsp;Delete</a>';
                    htmldata += '</div>';
                    htmldata += '<div class="searchgreade searchcom">';
                    htmldata += '<button type="button" class="btn searchbtnset btnshowmydiamonddetail" data-diamondid="' + diamonddata.id + '" >Diamond Page</button>';
                    htmldata += '</div>';
                    // htmldata+='<div class="searchgreade searchcom">';
                    // htmldata+='<button type="button" class="btn searchbtnset">More</button>';
                    // htmldata+='</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="col-12 searchddetail setdi">';
                    htmldata += '<div class="row">';
                    htmldata += '<div class="col-md-6 searchddetail1">';
                    htmldata += '<div class="card">';
                    htmldata += '<div class="card-body">';
                    htmldata += '<div class="headset">';
                    htmldata += '<h5 class="text-left">';
                    htmldata += '   Diamond Details';
                    htmldata += '</h5>';
                    htmldata += '<h4>Last Update: ' + diamonddata.timestamp + '</h4>';
                    htmldata += '</div>';
                    htmldata += '<div class="searchmoredetail">';
                    htmldata += '<div class="row">';
                    htmldata += '<div class="col-md-6">';
                    htmldata += '<ul>';
                    htmldata += '<li><b>Shape</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.shape + '</span></li>';
                    htmldata += '<li><b>Size</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.size + '</span></li>';
                    htmldata += '<li><b>Color</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.color + '</span></li>';
                    htmldata += '<li><b>Clarity</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.clarity + '</span></li>';
                    htmldata += '<li><b>Cut</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.cut + '</span></li>';
                    htmldata += '<li><b>Polish</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.polish + '</span></li>';
                    htmldata += '<li><b>Symm</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.symmetry + '</span></li>';

                    htmldata += '</ul>';
                    htmldata += '</div>';
                    htmldata += '<div class="col-md-6">';
                    htmldata += '<ul>';
                    // htmldata+='<li><b>$/ct</b>: <span class="metalpurity1">&nbsp; $354</span></li>';
                    // htmldata+='<li><b>%Savani</b>: <span class="metalpurity1">&nbsp; -83.9%</span></li>';
                    htmldata += '<li><b>Fluor.</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fluorescenecolor + '</span></li>';
                    htmldata += '<li><b>Lab</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.lab + '</span></li>';
                    htmldata += '<li><b>Total</b>: <span class="metalpurity1">&nbsp; $' + diamonddata.price + '</span></li>';
                    htmldata += '<li><b>Depth</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.depthper + '%</span></li>';
                    htmldata += '<li><b>Table</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tableper + '% </span></li>';
                    htmldata += '<li><b>Measurement</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</span></li>';
                    htmldata += '<li><b>Vendor Stock No. </b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stocknumber + '</span></li>';

                    // htmldata+='<li><b>Status</b>: <span class="metalpurity1">&nbsp; G</span></li>';
                    // htmldata+='<li><b>Media</b>: <span class="metalpurity1">&nbsp; -</span></li>';
                    // htmldata+='<li><b>Ratio</b>: <span class="metalpurity1">&nbsp; 1.132</span></li>';
                    htmldata += '</ul>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="col-md-5 searchddetail2">';
                    htmldata += '<div class="row">';
                    htmldata += '<div class="col-md-12 detail1search">';
                    htmldata += '<div class="headset">';
                    htmldata += '<h5 class="text-left">';
                    htmldata += 'Price';
                    htmldata += '</h5>';
                    htmldata += '<div class="pricecalimg">';
                    // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/pricecal.svg" alt="' + diamonddata.savanilotnumber + '" title="' + diamonddata.savanilotnumber + '">';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="searchmoredetail3">';
                    htmldata += '<ul>';
                    htmldata += '<li><b>Lot Diamond #</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.savanilotnumber + '</span></li>';
                    htmldata += '<li><b>Availability</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.availability + '</span></li>';
                    htmldata += '<li><b>Diamond Location</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.country + '</span></li>';
                    htmldata += '<li><b>Stock No #</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stock + '</span></li>';
                    htmldata += '<li><b>Price</b>: <span class="metalpurity1">&nbsp; $' + diamonddata.price + '</span></li>';
                    htmldata += '</ul>';
                    htmldata += '</div>';

                    // htmldata+='<div class="headset">';
                    // // htmldata+='<h5 class="text-left">';
                    // // htmldata+='<li>$/ct</li>';
                    // // htmldata+='<li>$/ct</li>';
                    // // htmldata+='<li>$/ct</li>';
                    // // htmldata+='</h5>';
                    // // htmldata+='<div class="cashname">';
                    // // // htmldata+='<ul>';
                    // // // htmldata+='<li> <b>cash</b></li>';
                    // // // htmldata+='<li>$350</li>';
                    // // // htmldata+='<li>-56%</li>';
                    // // // htmldata+='<li>$230</li>';
                    // // // htmldata+='</ul>';
                    // // // htmldata+='<ul>';
                    // // // htmldata+='<li> <b>Price</b></li>';
                    // // // htmldata+='<li>$410</li>';
                    // // // htmldata+='<li>-56.20%</li>';
                    // // // htmldata+='<li>$850</li>';
                    // // // htmldata+='</ul>';
                    // // htmldata+='</div>';
                    // htmldata+='</div>';
                    htmldata += '</div>';



                    htmldata += '<div class="col-md-12 mediaset">';
                    htmldata += '<h4>Media</h4>';

                    var disabledreport = 'disabled';
                    var linkreport = 'javascript:void(0);';
                    var targetreport = '';
                    if (diamonddata.reportfilelink != '') {
                        disabledreport = '';
                        linkreport = diamonddata.reportfilelink;
                        targetreport = '_blank';
                    }

                    htmldata += '<a class="btn reseacbtn ' + disabledreport + '" ' + disabledreport + ' href="' + linkreport + '" target="' + targetreport + '" data-diamondid="' + diamonddata.id + '">';
                    htmldata += '<div class="pricecalimg">';
                    htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/report.svg" alt="diamonds" title="diamonds">';
                    htmldata += '</div>';
                    htmldata += 'Report';
                    htmldata += '</a>';

                    htmldata += '<button type="button" class="btn reseacbtn btnshowmydiamonddetail" data-diamondid="' + diamonddata.id + '">';
                    htmldata += '<div class="pricecalimg">';
                    htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/diogram.svg" alt="diamonds" title="diamonds">';
                    htmldata += '</div>';
                    htmldata += 'Diagram';
                    htmldata += '</button>';
                    htmldata += '<button type="button" class="btn reseacbtn btnshowmydiamonddetail" data-diamondid="' + diamonddata.id + '">';
                    htmldata += '<div class="pricecalimg">';
                    htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/video.svg" alt="diamonds" title="diamonds">';
                    htmldata += '</div>';
                    htmldata += 'Video';
                    htmldata += '</button>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';

                    var sellerdetails = diamonddata.persondetail[0];

                    // htmldata += '<div class="col-md-3 searchddetail2">';
                    // htmldata += '<div class="row sedetil">';
                    // htmldata += '<div class="col-md-12 detail1search">';
                    // htmldata += '<div class="headset">';
                    // htmldata += '<h5 class="text-left">';
                    // htmldata += 'Seller Details';
                    // htmldata += '</h5>';
                    // htmldata += '</div>';
                    // htmldata += '<div class="row setpro">';
                    // htmldata += '<div class="col-md-7 ">';
                    // htmldata += ' <ul class="d-flex justify-content-between align-items-center">';
                    // htmldata += '<li>';
                    // htmldata += '<div class="profileimg">';
                    // htmldata += '<img src="' + sellerdetails.profileimg + '" alt="' + sellerdetails.personname + '" title="' + sellerdetails.personname + '">';
                    // htmldata += '</div>';
                    // htmldata += '</li>';
                    // htmldata += '<li>';
                    // htmldata += '<div class="desc ">';
                    // htmldata += '<h4>' + sellerdetails.companyname + '</h4>';
                    // htmldata += '<h5><b>Savani ID</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.savaniid + '</span></h5>';
                    // htmldata += '</div>';
                    // htmldata += '</li>';
                    // htmldata += '</ul>';
                    // htmldata += '</div>';
                    // htmldata+='<div class="col-md-5 afprofile">';
                    // htmldata+='<ul class="d-flex justify-content-between align-items-center">';
                    // htmldata+='<li>';
                    // htmldata+='<div class="sideimg">';
                    // htmldata+='<img src="<?php echo $config->getImageurl(); ?>images/searchpage/review.svg" alt="diamonds" title="diamonds">';
                    // htmldata+='</div>';
                    // htmldata+='</li>';
                    // htmldata+='<li>';
                    // htmldata+='<div class="desc">';
                    // htmldata+='<h6>no reating yet</h6>';
                    // htmldata+='</div>';
                    // htmldata+='</li>';
                    // htmldata+='</ul>';
                    // htmldata+='</div>';
                    // htmldata += '</div>';
                    // htmldata += '<div class="searchmoredetail3">';
                    // htmldata += '<ul>';
                    // htmldata += '<li><b>Location</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.countryname + '</span></li>';
                    // htmldata += '<li><b>Contact Person</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.personname + '</span></li>';
                    // htmldata += '<li><b>Phone</b>: <span class="metalpurity1">&nbsp; <a href="tel:' + sellerdetails.phonecode + '' + sellerdetails.businessphoneno + '" >' + sellerdetails.phonecode + ' ' + sellerdetails.businessphoneno + '</a></span></li>';
                    // htmldata += '</ul>';
                    // htmldata += '</div>';

                    // htmldata += '</div>';

                    // htmldata += '<div class="col-md-12 noteset">';
                    // // htmldata += '<div class="writset">';
                    // // htmldata += '<textarea class="form-control" rows="4" placeholder=" Write a personal note...." id="comment"></textarea>';
                    // // htmldata += '</div>';

                    // htmldata += '<div class="colsave">';
                    // htmldata += '<ul>';

                    // htmldata += '<li>';
                    // htmldata += '<div class="colorset">';
                    // htmldata += '<input type="color" class="scolor" id="colorpicker" value="#0000ff">';
                    // htmldata += '</div>';
                    // htmldata += '<p>if you want to change color top here</p>';
                    // htmldata += '</li>';

                    // htmldata += '<li>';
                    // htmldata += '<button type="button" class="btn searchbtnset">save</button>';
                    // htmldata += '</li>';
                    // htmldata += '</ul>';
                    // htmldata += '</div>';
                    // htmldata += '</div>';

                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</td>';





                }
                // $('.listmydiamondDataDiv #listmydiamondData').html(htmldata);
                if (resultdata.nextpage == 1) {
                    $('.listmydiamondDataDiv #listmydiamondData').html(htmldata);
                } else {
                    $('.listmydiamondDataDiv #listmydiamondData').append(htmldata);
                }
                $('#showmydiamondentries').html(resultdata.showentries);
                $('#listmydiamondDatatbl').attr('data-nextpage', resultdata.nextpage);
                if (resultdata.loadmore == 1) {
                    $('#listmydiamondDatatbl').attr('data-show', 1);
                } else {
                    $('#listmydiamondDatatbl').attr('data-show', 0);
                }

                $('.deletemydiamond').on('click', function() {
                    var id = $(this).attr('data-diamondid');
                    Notiflix.Confirm.Show(false, 'Are you want to delete this data?', false, false, function() {
                        showloader();
                        var pagename = getpagename();
                        var useraction = $('#formevent').val();
                        deleteformdata = new FormData();
                        deleteformdata.append("action", "deletediamond");
                        deleteformdata.append("id", id);
                        var headersdata = {
                            'Accept': 'application/json',
                            platform: 4,
                            userpagename: pagename,
                            useraction: useraction,
                            masterlisting: false
                        };
                        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', deleteformdata, headersdata, Onsuccessdeletediamond, OnErrordeletediamond)

                        function Onsuccessdeletediamond(data) {
                            hideloader();
                            var JsonData = JSON.stringify(data);
                            var resultdeletedata = jQuery.parseJSON(JsonData);

                            if (resultdeletedata.status == 0) {
                                Notiflix.Notify.Failure(resultdeletedata.message);
                            } else if (resultdeletedata.status == 1) {
                                Notiflix.Notify.Success(resultdeletedata.message);
                                $('#listmydiamondDatatbl').attr('data-nextpage', 0);
                                listmydiamonddata(1);
                            }

                        }

                        function OnErrordeletediamond(content) {

                        }

                    }, function() {

                    });
                });

                $('.editmydiamond').on('click', function() {
                    var id = $(this).attr('data-diamondid');

                    showloader();
                    var pagename = getpagename();
                    var useraction = $('#formevent').val();
                    editformdata = new FormData();
                    editformdata.append("action", "listdiamond");
                    editformdata.append("id", id);
                    editformdata.append("nextpage", 1);
                    var headersdata = {
                        'Accept': 'application/json',
                        platform: 4,
                        userpagename: pagename,
                        useraction: useraction,
                        masterlisting: false
                    };
                    ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', editformdata, headersdata, Onsuccesseditdiamond, OnErroreditdiamond)

                    function Onsuccesseditdiamond(data) {
                        hideloader();
                        var JsonData = JSON.stringify(data);
                        var resulteditdata = jQuery.parseJSON(JsonData);

                        if (resulteditdata.status == 0) {
                            Notiflix.Notify.Failure(resulteditdata.message);
                        } else if (resulteditdata.status == 1) {
                            $('#v-pills-2-tab').click();
                            $('#nav-h-tab').click();
                            $('#form-diamond-upload #id').val(id);
                            $('#form-diamond-upload #formevent').val('update');
                            $('#form-diamond-upload #btnsavediamond').html('Update');

                            $('.uploaddiamondtabs li').attr('disabled', false);
                            $('.uploaddiamondtabs li').removeClass('disabled');
                            $('.uploaddiamondtabs li a').removeClass('disabled');
                            $('.uploaddiamondtabs li a').attr('disabled', false);
                            $('.diamonduploadesirmodetext').html('Edit');

                            for (var i in resulteditdata.data) {
                                var editdata = resulteditdata.data[i];
                                $('#form-diamond-upload #stock').val(editdata.stock);
                                $('#form-diamond-upload #price').val(editdata.price);
                                listavailability(editdata.availabilityid);
                                listcountry(editdata.countryid, editdata.stateid);
                                $('#form-diamond-upload #city').val(editdata.city);
                                listshape(editdata.shapeid);
                                $('#form-diamond-upload #size').val(editdata.size);
                                listcolor(editdata.colorid);
                                listclarity(editdata.clarityid);
                                listcut(editdata.cutid);
                                listpolish(editdata.polishid);
                                listsymmetry(editdata.symmetryid);
                                listintensity(editdata.intensityid);
                                listfluorescencecolor(editdata.fluorescenecolorid);
                                $('#form-diamond-upload #length').val(editdata.length);
                                $('#form-diamond-upload #width').val(editdata.width);
                                $('#form-diamond-upload #depth').val(editdata.depth);

                                $('#form-diamond-upload #depthper').val(editdata.depthper);
                                $('#form-diamond-upload #tableper').val(editdata.tableper);

                                $('#form-diamond-upload #crownangle').val(editdata.crownangle);
                                $('#form-diamond-upload #crownheight').val(editdata.crownheight);

                                $('#form-diamond-upload #pavilionangle').val(editdata.pavilionangle);
                                $('#form-diamond-upload #pavilionheight').val(editdata.pavilionheight);
                                listgridlecondition(editdata.gridleconditionid);
                                listgridlemin(editdata.gridleminid);
                                listgridlemax(editdata.gridlemaxid);
                                $('#form-diamond-upload #gridleper').val(editdata.gridleper);
                                listculetcondition(editdata.culetconditionid);
                                listculetsize(editdata.culetsizeid);
                                if (editdata.treatmentid) {
                                    listtreatment(editdata.treatmentid);
                                }
                                $('#form-diamond-upload #laserinscription').val(editdata.laserinscription);
                                $('#form-diamond-upload #starlength').val(editdata.starlength);
                                listlab(editdata.labid);
                                if (editdata.showonsavanigems == 1) {
                                    $('#showonsavanigems').prop('checked', true);
                                } else {
                                    $('#showonsavanigems').prop('checked', false);
                                }
                                $('#form-diamond-upload #reportnumber').val(editdata.reportnumber);
                                $('#form-diamond-upload #reportdate').val(editdata.reportdate);
                                $('#form-diamond-upload #lablocation').val(editdata.lablocation);
                                $('#form-diamond-upload #reportcomment').val(editdata.reportcomment);
                                if (editdata.keytosymbolsid) {
                                    listkeytosymbol(editdata.keytosymbolsid);
                                }

                                if (editdata.withfancycolor == 1) {
                                    $('#withfancycolor').prop('checked', true);
                                    checkfancycolorflag();
                                    listfancyintensity(editdata.fancyintensityid);
                                    listovertone(editdata.overtoneid);
                                    listcolor1(editdata.fancycolorid1);
                                    listcolor2(editdata.fancycolorid2);
                                } else {
                                    $('#withfancycolor').prop('checked', false);
                                    checkfancycolorflag();
                                }

                                if (editdata.matchedpair == 1) {
                                    $('#matchedpair').prop('checked', true);
                                    checkmatchpairflag();
                                    $('#form-diamond-upload #stocknumber').val(editdata.stocknumber);
                                    if (editdata.ispairseparable == 1) {
                                        $('#ispairseparable').prop('checked', true);
                                    } else {
                                        $('#ispairseparable').prop('checked', false);
                                    }
                                } else {
                                    $('#matchedpair').prop('checked', false);
                                    checkmatchpairflag();
                                }

                                if (editdata.isdownload == 1) {
                                    $('#isdownload').prop('checked', true);
                                } else {
                                    $('#isdownload').prop('checked', false);
                                }
                                listtreadeshow(editdata.tradeshowid);
                                listbrand(editdata.brandid);
                                $('#form-diamond-upload #suppliercomment').val(editdata.suppliercomment);

                                if (editdata.isparcel == 1) {
                                    $('#isparcel').prop('checked', true);
                                    checkisparcelflag();
                                    $('#form-diamond-upload #numofdiamond').val(editdata.numofdiamond);
                                } else {
                                    $('#isparcel').prop('checked', false);
                                }
                                $('#form-diamond-upload #reportfilelink').val(editdata.reportfilelink);
                                $('#form-diamond-upload #diamondimglink').val(editdata.diamondimglink);
                                $('#form-diamond-upload #videolink').val(editdata.videolink);
                                $('#form-diamond-upload #sarineloupe').val(editdata.sarineloupe);
                                $('#form-diamond-upload #sellerspecification').val(editdata.sellerspecification);
                                listshade(editdata.shadeid);
                                listmilky(editdata.milkyid);
                                listeyeclean(editdata.eyecleanid);
                                if (editdata.openinclusionsid) {
                                    listopeninclusion(editdata.openinclusionsid);
                                }
                                if (editdata.blackinclusionsid) {
                                    listblackinclusion(editdata.blackinclusionsid);
                                }
                                if (editdata.whiteinclusionsid) {
                                    listwhiteinclusion(editdata.whiteinclusionsid);
                                }
                                listroughsource(editdata.roughdiamondsourceid);
                                $('#form-diamond-upload #piecepercarat').val(editdata.piecepercarat);
                                listsieve(editdata.sieveid);

                                var htmlreportfile = '';
                                if (editdata.reportfile != '' && editdata.reportfile != null) {
                                    htmlreportfile += '<a href="' + editdata.reportfileurl + '" target="_blank">';
                                    htmlreportfile += '<img src="<?php echo $config->getImageurl(); ?>images/files.png" alt="Report File" height="80" width="80" title="Report File">';
                                    htmlreportfile += '</a>';
                                    htmlreportfile += '<p><a href="javascript:void(0);" data-diamondid="' + editdata.id + '" title="Remove Report File" class="btn btn-danger mt-1 ml-1 removemydiamondreportfile"><i class="fas fa-trash-alt"></i></a></p>';
                                }
                                $('.mydiamondreportfileDiv').html(htmlreportfile);

                                if ((editdata.diamondimagedetail).length > 0) {
                                    var mediadata = '';
                                    for (var h in editdata.diamondimagedetail) {
                                        mediadata += '<div class="col-md-3 col-sm-3  mt-2">';
                                        mediadata += '<a href="<?php echo $config->getImageurl(); ?>' + editdata.diamondimagedetail[h].image + '" target="_blank">';
                                        mediadata += '<img src="<?php echo $config->getImageurl(); ?>' + editdata.diamondimagedetail[h].image + '" alt="Diamond Media Image" title="Diamond Media Image">';
                                        mediadata += '</a>';
                                        mediadata += '<p><a href="javascript:void(0);" data-diamondid="' + editdata.diamondimagedetail[h].diamondid + '" data-id="' + editdata.diamondimagedetail[h].id + '" title="Remove Diamond Media " class="btn btn-danger mt-1 ml-1 removemydiamondmediaimage"><i class="fas fa-trash-alt"></i></a></p>';
                                        mediadata += '</div>';
                                    }
                                    $('.mydiamondmediafileDiv').html(mediadata);
                                }


                            }

                        }

                    }

                    function OnErroreditdiamond(content) {

                    }

                });


            }


        }

        function OnErrorlistmydiamond(content) {

        }
    }

    $('body').on('click', '.removemydiamondreportfile', function() {
        var diamondid = $(this).attr('data-diamondid');

        Notiflix.Confirm.Show(false, 'Are you want to delete this file?', false, false, function() {
            var pagename = getpagename();
            var useraction = '';
            formdata = new FormData();
            formdata.append("action", "deletereportfile");
            formdata.append("diamondid", diamondid);

            var headersdata = {
                'Accept': 'application/json',
                platform: 4,
                userpagename: pagename,
                useraction: useraction,
                masterlisting: false
            };
            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, OnsuccessdeletereportfileData, OnErrordeletereportfile)

            function OnsuccessdeletereportfileData(data) {
                var JsonData = JSON.stringify(data);
                var resultdata = jQuery.parseJSON(JsonData);
                // $('.preloader').hide();

                if (resultdata.status == 0) {
                    // alertify(resultdata.message,0);
                    Notiflix.Notify.Failure(resultdata.message);
                } else if (resultdata.status == 1) {
                    Notiflix.Notify.Success(resultdata.message);
                    $('.mydiamondreportfileDiv').html('');

                }

            }

            function OnErrordeletereportfile(content) {
                ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
            }
        }, function() {

        });
    });

    $('body').on('click', '.removemydiamondmediaimage', function() {
        var diamondid = $(this).attr('data-diamondid');
        var id = $(this).attr('data-id');

        Notiflix.Confirm.Show(false, 'Are you want to delete this file?', false, false, function() {
            var pagename = getpagename();
            var useraction = '';
            formdata = new FormData();
            formdata.append("action", "deletediamondmediaimage");
            formdata.append("diamondid", diamondid);
            formdata.append("id", id);

            var headersdata = {
                'Accept': 'application/json',
                platform: 4,
                userpagename: pagename,
                useraction: useraction,
                masterlisting: false
            };
            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, OnsuccessdeletereportfileData, OnErrordeletereportfile)

            function OnsuccessdeletereportfileData(data) {
                var JsonData = JSON.stringify(data);
                var resultdata = jQuery.parseJSON(JsonData);
                // $('.preloader').hide();

                if (resultdata.status == 0) {
                    // alertify(resultdata.message,0);
                    Notiflix.Notify.Failure(resultdata.message);
                } else if (resultdata.status == 1) {
                    Notiflix.Notify.Success(resultdata.message);
                    var mediadata = '';
                    if ((resultdata.result).length > 0) {

                        for (var h in resultdata.result) {
                            mediadata += '<div class="col-md-3  col-sm-3 mt-2">';
                            mediadata += '<a href="<?php echo $config->getImageurl(); ?>' + resultdata.result[h].image + '" target="_blank">';
                            mediadata += '<img src="<?php echo $config->getImageurl(); ?>' + resultdata.result[h].image + '" alt="Diamond Media Image" title="Diamond Media Image">';
                            mediadata += '</a>';
                            mediadata += '<p><a href="javascript:void(0);" data-diamondid="' + resultdata.result[h].diamondid + '" data-id="' + resultdata.result[h].id + '" title="Remove Diamond Media " class="btn btn-danger mt-1 ml-1 removemydiamondmediaimage"><i class="fas fa-trash-alt"></i></a></p>';
                            mediadata += '</div>';
                        }
                    }
                    $('.mydiamondmediafileDiv').html(mediadata);

                }

            }

            function OnErrordeletereportfile(content) {
                ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
            }

        }, function() {

        });

    });

    $('body').on('change', '#my_diamond_per_page', function() {
        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
        $("#listmydiamondData").animate({
            scrollTop: 0
        }, "slow");
        listmydiamonddata(1);
    });

    $('body').on('change', '#mydiamondsortbyid', function() {
        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
        $("#listmydiamondData").animate({
            scrollTop: 0
        }, "slow");
        listmydiamonddata(1);
    });

    $('#listmydiamondDatatbl tbody').scroll(function() {
        // alert();
        // //console.log('scrollTop:' + $(this).scrollTop());
        // //console.log('innerHeight:' + $(this).innerHeight());
        // //console.log('scrollHeight:' + $(this)[0].scrollHeight);
        // 
        if ($(this).scrollTop() +
            $(this).innerHeight() >=
            $(this)[0].scrollHeight) {
            // //console.log('Here');
            var dataact = getpagename();
            var show = $('#listmydiamondDatatbl').attr('data-show');
            // //console.log('dataact:' + dataact);
            // //console.log('show:' + show);
            if (dataact && show == 1) {
                listmydiamonddata(1);
            }
        }
    });

    /* ******Sort By*******  */

    function listmydiamondsortby() {
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
        formdata.append("action", "listdiamondsortby");
        formdata.append("ismydiamond", 1);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistmydiamondsortby, OnErrorlistmydiamondsortby);

        function Onsuccesslistmydiamondsortby(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                var htmldata = '<option value="">Select Sort By</option>';
                if (resultdata.data.length > 0) {
                    for (var i in resultdata.data) {
                        htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                    }
                }

            }
            $('#mydiamondsortbyid').html(htmldata);
        }

        function OnErrorlistmydiamondsortby(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* APPLY MY DIAMOND FILTERS */
    var mdshapearr = [];
    var mdfltfromsize = 0;
    var mdflttosize = 0;
    var mdcolorarr = [];
    var mdclarityarr = [];
    var mdfltfromprice = 0;
    var mdflttoprice = 0;

    function getmydiamondfiltersvalue() {

        mdshapearr = [];
        var s_mdfltshapemdid = $('#s_mdfltshapemdid').val();
        if (s_mdfltshapemdid.length > 0) {
            for (var i = 0; i < s_mdfltshapemdid.length; i++) {
                var shapeid = $('#s_mdfltshapemdid option[value=' + s_mdfltshapemdid[i] + ']').val();
                var shape = $('#s_mdfltshapemdid option[value=' + s_mdfltshapemdid[i] + ']').text();
                mdshapearr.push({
                    'id': shapeid,
                    'name': shape
                });

            }
        }
        mdfltfromsize = $('#s_mdfltfrommdsize').val();
        mdflttosize = $('#s_mdflttomdsize').val();

        mdcolorarr = [];
        var s_mdfltcolormdid = $('#s_mdfltcolormdid').val();
        if (s_mdfltcolormdid.length > 0) {
            for (var i = 0; i < s_mdfltcolormdid.length; i++) {
                var colorid = $('#s_mdfltcolormdid option[value=' + s_mdfltcolormdid[i] + ']').val();
                var color = $('#s_mdfltcolormdid option[value=' + s_mdfltcolormdid[i] + ']').text();
                mdcolorarr.push({
                    'id': colorid,
                    'name': color
                });

            }
        }

        mdclarityarr = [];
        var s_mdfltclaritymdid = $('#s_mdfltclaritymdid').val();
        if (s_mdfltclaritymdid.length > 0) {
            for (var i = 0; i < s_mdfltclaritymdid.length; i++) {
                var clarityid = $('#s_mdfltclaritymdid option[value=' + s_mdfltclaritymdid[i] + ']').val();
                var clarity = $('#s_mdfltclaritymdid option[value=' + s_mdfltclaritymdid[i] + ']').text();
                mdclarityarr.push({
                    'id': clarityid,
                    'name': clarity
                });

            }
        }
        mdfltfromprice = $('#s_mdfltfrompricemd').val();
        mdflttoprice = $('#s_mdflttopricemd').val();
    }

    $('body').on('change', '#form-mydiamond-side-search .select2', function() {
        getmydiamondfiltersvalue();
        checkmydiamondformelementvalue();
    });

    $('body').on('input', '#form-mydiamond-side-search #s_mdfltfrommdsize,#s_mdflttomdsize,#s_mdfltfrompricemd,#s_mdflttopricemd', function() {
        getmydiamondfiltersvalue();
        checkmydiamondformelementvalue();
    });

    function checkmydiamondformelementvalue() {
        var issearchbtn = 0;
        var s_mdfltshapemdid = $('#form-mydiamond-side-search #s_mdfltshapemdid').val();
        if (s_mdfltshapemdid.length > 0) {
            issearchbtn++;
        }
        s_mdfltfrommdsize = $('#s_mdfltfrommdsize').val();
        s_mdflttomdsize = $('#s_mdflttomdsize').val();
        if (s_mdfltfrommdsize && s_mdflttomdsize > 0) {
            issearchbtn++;
        }

        var s_mdfltcolormdid = $('#form-mydiamond-side-search #s_mdfltcolormdid').val();
        if (s_mdfltcolormdid.length > 0) {
            issearchbtn++;
        }

        var s_mdfltclaritymdid = $('#form-mydiamond-side-search #s_mdfltclaritymdid').val();
        if (s_mdfltclaritymdid.length > 0) {
            issearchbtn++;
        }

        s_mdfltfrompricemd = $('#s_mdfltfrompricemd').val();
        s_mdflttopricemd = $('#s_mdflttopricemd').val();
        if (s_mdfltfrompricemd && s_mdflttopricemd > 0) {
            issearchbtn++;
        }

        $('#form-mydiamond-side-search #btnapplymydiamonddiamondfilter').attr('disabled', true);
        if (issearchbtn > 0) {
            $('#form-mydiamond-side-search #btnapplymydiamonddiamondfilter').attr('disabled', false);
        }
        // //console.log(issearchbtn);
        return issearchbtn;
    }

    if ($('#form-mydiamond-side-search').length) {
        $('#form-mydiamond-side-search').validate({
            rules: {
                fltfromsize: {
                    number: true
                },
                flttosize: {
                    greaterThan: '#s_mdfltfrommdsize',
                    number: true
                },
                fltfromprice: {
                    number: true
                },
                flttoprice: {
                    greaterThan: '#s_mdflttopricemd',
                    number: true
                },

            },
            messages: {
                flttosize: {
                    greaterThan: 'To size greater than or equal From size',
                },
                flttoprice: {
                    greaterThan: 'To price greater than or equal From price',
                },
            },
            submitHandler: function(form) {

                var issearchbtn = checkmydiamondformelementvalue();
                if (issearchbtn > 0) {
                    fillsearchmydiamondlist(2);
                    $('#listmydiamondDatatbl').attr('data-nextpage', 0);
                    listmydiamonddata(1, 'form-mydiamond-side-search');
                    $(".listmydiamondDataDiv .wrappernew.toggled").toggleClass("intro");
                } else {
                    alertify('Please select at least one filter', 0);
                }


            },
        });
    }

    function fillsearchmydiamondlist(type) {
        var htmllistdata = '';

        if (mdshapearr.length > 0) {
            for (var i = 0; i < mdshapearr.length; i++) {
                var id = mdshapearr[i].id;
                var name = mdshapearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemdshapeflt  mdfltshape' + id + ' searchbtnset"><b> Shape : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (mdfltfromsize && mdflttosize > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removemdfromtosize searchbtnset"><b> Size : </b><span>' + mdfltfromsize + '-' + mdflttosize + '</span> <span class="btn-remove-tag">X</span></a>';
        }



        if (mdcolorarr.length > 0) {
            for (var i = 0; i < mdcolorarr.length; i++) {
                var id = mdcolorarr[i].id;
                var name = mdcolorarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemdcolorflt  mdfltcolor' + id + ' searchbtnset"><b> Color : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (mdclarityarr.length > 0) {
            for (var i = 0; i < mdclarityarr.length; i++) {
                var id = mdclarityarr[i].id;
                var name = mdclarityarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemdclarityflt  mdfltclarity' + id + ' searchbtnset"><b> Clarity : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }
        if (mdfltfromprice && mdflttoprice > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removemdfromtoprice m-1 searchbtnset"><b> Price : </b><span>$' + mdfltfromprice + '-$' + mdflttoprice + '</span> <span class="btn-remove-tag">X</span></a>';
        }
        $('.searchmydiamondlistDiv').html(htmllistdata);
    }

    $('body').on('click', '.removemdshapeflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.mdfltshape' + id + '').remove();
        var arrid = removeindexfromarr(mdshapearr, id);
        $("#s_mdfltshapemdid").val(arrid).trigger('change');
        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
        listmydiamonddata(1, 'form-mydiamond-side-search');
    });

    $('body').on('click', '.removemdfromtosize', function() {
        var type = $(this).attr('data-type');
        $('#s_mdfltfrommdsize').val(0);
        $('#s_mdflttomdsize').val(0);
        $(this).remove();
        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
        listmydiamonddata(1, 'form-mydiamond-side-search');
    });

    $('body').on('click', '.removemdcolorflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.mdfltcolor' + id + '').remove();
        var arrid = removeindexfromarr(mdcolorarr, id);
        $("#s_mdfltcolormdid").val(arrid).trigger('change');
        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
        listmydiamonddata(1, 'form-mydiamond-side-search');
    });

    $('body').on('click', '.removemdclarityflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.mdfltclarity' + id + '').remove();
        var arrid = removeindexfromarr(mdclarityarr, id);
        $("#s_mdfltclaritymdid").val(arrid).trigger('change');
        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
        listmydiamonddata(1, 'form-mydiamond-side-search');
    });

    $('body').on('click', '.removemdfromtoprice', function() {
        var type = $(this).attr('data-type');
        $('#s_mdfltfrompricemd').val(0);
        $('#s_mdflttopricemd').val(0);
        $(this).remove();
        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
        listmydiamonddata(1, 'form-mydiamond-side-search');
    });


    $('body').on('click', '.btnshowmydiamonddetail', function() {

        var diamondid = $(this).attr('data-diamondid');
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
        formdata.append("action", "listdiamond");
        formdata.append("id", diamondid);
        formdata.append("nextpage", 1);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccessshowmydiamonddetail, OnErrorshowmydiamonddetail);

        function Onsuccessshowmydiamonddetail(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data.length > 0) {
                    for (var i in resultdata.data) {

                        var diamonddata = resultdata.data[i];

                        var title = diamonddata.cmpname + ' | Lot # ' + diamonddata.savanilotnumber;
                        $('#ListDiamondDataDetailModalLongTitle').html(title);

                        htmldata += '<div class="col-12">';
                        htmldata += '<div class="row">';
                        htmldata += '<div class="col-md-8">';
                        htmldata += '<div class="row">';
                        htmldata += '<div class="col-md-8">';
                        htmldata += '<div class="diamondsearch">';
                        htmldata += '<ul>';
                        htmldata += '<li>';
                        // htmldata += '<div class="starimg">';
                        // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/star.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '">';
                        // htmldata += '</div>';
                        htmldata += '<h4>' + diamonddata.lab + ',' + diamonddata.shape + ',' + diamonddata.size + ',' + diamonddata.color + ',' + diamonddata.clarity + ',' + diamonddata.cut + ',' + diamonddata.polish + ',' + diamonddata.symmetry + '</h4>';
                        htmldata += '</li>';
                        htmldata += '<li><b>Price &nbsp</b>$' + diamonddata.price + '</li>';
                        htmldata += '<li>' + diamonddata.availability + '</li>';
                        htmldata += '<li>' + diamonddata.lab + ', ' + diamonddata.reportnumber + '</li>';
                        // if (diamonddata.reportfilelink != '' && diamonddata.reportfilelink != null) {
                        //     htmldata += '<li><a href="' + diamonddata.reportfilelink + '" target="_blank">Report Link</a></li>';
                        // }
                        // if (diamonddata.reportfileurl != '' && diamonddata.reportfileurl != null) {
                        //     htmldata += '<li><a href="' + diamonddata.reportfileurl + '" target="_blank"><img src="<?php echo $config->getImageurl(); ?>images/files.png" alt="Report File" height="50" width="50" title="Report File"></a></li>';
                        // }
                        htmldata += '</ul>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        // htmldata += '<div class="col-md-4 contectse text-center">';
                        // htmldata += '</div>';
                        htmldata += '<div class="col-12 searmedia">';
                        htmldata += '<div class="row">';
                        htmldata += '<div class="col-md-4 mediasearch">';

                        htmldata += '<h5>Media</h5>';
                        htmldata += '<div class="media">';
                        if (diamonddata.diamondimagedetail.length > 0) {
                            for (var im in diamonddata.diamondimagedetail) {
                                htmldata += '<div class="mediaurl mr-2">';
                                htmldata += '<a href="<?php echo $config->getImageurl(); ?>' + diamonddata.diamondimagedetail[im].image + '" target="_blank">';
                                htmldata += '<img src="<?php echo $config->getImageurl(); ?>' + diamonddata.diamondimagedetail[im].image + '" alt="' + diamonddata.stock + '" width="100%" title="' + diamonddata.stock + '">';
                                htmldata += '</a>';
                                htmldata += '</div>';
                            }

                        } else {

                            htmldata += ' <b<span>No Media</span></b>';
                        }

                        htmldata += '</div>';

                        if (diamonddata.diamondimglink != '' && diamonddata.diamondimglink != null) {
                            htmldata += '<h5>Image URL</h5>';
                            htmldata += '<div class="media">';
                            htmldata += '<div class="mediaurl mr-2">';
                            htmldata += '<a href="' + diamonddata.diamondimglink + '" target="_blank">';
                            htmldata += '<img src="' + diamonddata.diamondimglink + '" alt="' + diamonddata.stock + '" width="100%" height="80px" title="' + diamonddata.stock + '">';
                            htmldata += '</a>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                        }
                        if (diamonddata.videolink != '' && diamonddata.videolink != null) {
                            htmldata += '<h5>Media URL</h5>';
                            htmldata += '<div class="media">';
                            htmldata += '<div class="mediaurl">';
                            htmldata += '<a href="' + diamonddata.videolink + '" target="_blank"><i class="fas fa-play"></i></a>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                        }
                        if (diamonddata.reportfileurl != '' && diamonddata.reportfileurl != null) {
                            htmldata += '<h5>Report File</h5>';
                            htmldata += '<div class="media">';
                            htmldata += '<div class="mediaurl">';
                            htmldata += '<a href="' + diamonddata.reportfileurl + '" target="_blank"><img src="<?php echo $config->getImageurl(); ?>images/files.png" alt="Report File" height="50" width="50" title="Report File"></a>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                        }
                        if (diamonddata.reportfilelink != '' && diamonddata.reportfilelink != null) {
                            htmldata += '<h5>Report File URL</h5>';
                            htmldata += '<div class="media">';
                            htmldata += '<div class="mediaurl">';
                            htmldata += '<a href="' + diamonddata.reportfilelink + '" target="_blank"><i class="fas fa-link"></i></a>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                        }
                        if (diamonddata.keytosymbols != '' && diamonddata.keytosymbols != null) {
                            htmldata += '<ul>';
                            // htmldata += '<li><b>plot<br><span>No lot</span></b></li>';
                            htmldata += '<li><b>Key To symbols<br><span>' + diamonddata.keytosymbols + '</span></b></li>';
                            htmldata += '</ul>';
                        }

                        htmldata += '</div>';


                        htmldata += '<div class="col-md-8 addsearchdetail">';
                        htmldata += '<div class="card">';
                        htmldata += '<h4>Diamond Details</h4>';
                        htmldata += '<div class="card-body">';
                        htmldata += '<ul>';
                        htmldata += '<li><b>Stock</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stock + '</span></li>';
                        htmldata += '<li><b>Intensity</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.intensity + '</span></li>';
                        htmldata += '<li><b>Fluorescene Color</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fluorescenecolor + '</span></li>';
                        htmldata += '<li><b>Total Depth%</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.depth + '%</span></li>';
                        htmldata += '<li><b>Table%</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tableper + '%</span></li>';
                        htmldata += '<li><b>Measurement </b>: <span class="metalpurity1">&nbsp; ' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</span></li>';
                        // htmldata += '<li><b>Ratio</b>: <span class="metalpurity1">&nbsp; New</span></li>';
                        htmldata += '<li><b>Gridle Condition</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.gridlecondition + '</span></li>';
                        htmldata += '<li><b>Gridle Min</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.gridlemin + '</span></li>';
                        htmldata += '<li><b>Gridle Max</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.gridlemax + '</span></li>';
                        htmldata += '<li><b>Gridle%</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.gridleper + '%</span></li>';
                        htmldata += '<li><b>Culet Condition</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.culetcondition + '</span></li>';
                        htmldata += '<li><b>Culet Size</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.culetsize + '</span></li>';
                        htmldata += '<li><b>Treatment</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.treatment + '</span></li>';
                        htmldata += '<li><b>Crown</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.crownangle + ',' + diamonddata.crownheight + '</span></li>';
                        htmldata += '<li><b>Pavilion.</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.pavilionangle + ',' + diamonddata.pavilionheight + '</span></li>';
                        htmldata += '<li><b>Star length</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.starlength + '</span></li>';
                        // htmldata += '</ul>';
                        // htmldata += '<ul>';
                        // htmldata += '<h5>Diamond details</h5>';
                        // // htmldata += '<li><b>BGM</b>: <span class="metalpurity1">&nbsp; No BGM</span></li>';
                        htmldata += '<li><b>Shade</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.shade + '</span></li>';
                        htmldata += '<li><b>Eye Clean</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.eyeclean + '</span></li>';
                        htmldata += '<li><b>Open Inclusions</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.openinclusions + '</span></li>';
                        htmldata += '<li><b>Black Inclusions</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.blackinclusions + '</span></li>';
                        htmldata += '<li><b>White Inclusions</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.whiteinclusions + '</span></li>';

                        htmldata += '</ul>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';

                        htmldata += '<div class="col-md-4 addsearchdetail">';
                        htmldata += '<div class="card">';
                        htmldata += '<h4>Diamond Details</h4>';
                        htmldata += '<div class="card-body">';
                        htmldata += '<ul>';

                        htmldata += '<li><b>Milky</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.milky + '</span></li>';
                        htmldata += '<li><b>Clarity(Eye Clean)</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.clarity + '(' + diamonddata.eyeclean + ')</span></li>';
                        htmldata += '<li><b>Brand</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.brand + '</span></li>';
                        htmldata += '<li><b>Supplier Comment</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.suppliercomment + '</span></li>';

                        htmldata += '<li><b>Report Date</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.reportdate + '</span></li>';
                        htmldata += '<li><b>Lab Location</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.lablocation + '</span></li>';
                        htmldata += '<li><b>Report Comment</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.reportcomment + '</span></li>';
                        htmldata += '<li><b>Fancy Intensity</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fancyintensity + '</span></li>';
                        htmldata += '<li><b>Overtone</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.overtone + '</span></li>';
                        htmldata += '<li><b>Fancy Color 1</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fancycolor1 + '</span></li>';
                        htmldata += '<li><b>Fancy Color 2</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fancycolor2 + '</span></li>';
                        htmldata += '<li><b>Stock Number</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stocknumber + '</span></li>';
                        htmldata += '<li><b>Trade Show</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tradeshow + '</span></li>';
                        htmldata += '<li><b>Brand</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.brand + '</span></li>';
                        htmldata += '<li><b>Rough Diamond Source</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.roughdiamondsource + '</span></li>';
                        htmldata += '<li><b>Sleeve Name</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.sievename + '</span></li>';
                        htmldata += '</ul>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        // htmldata += '<div class="col-md-4 profilediamnd">';
                        // htmldata += '<div class="card">';
                        // htmldata += '<div class="card-body">';

                        // htmldata += '<div class="sellersearchd">';
                        // htmldata += '<h5>Seller Details</h5>';

                        // htmldata += '<div class="profileimgset">';
                        // htmldata += '<img src="' + sellerdetails.profileimg + '" alt="' + sellerdetails.personname + '" title="' + sellerdetails.personname + '">';
                        // htmldata += '</div>';

                        // htmldata += '<h2>' + sellerdetails.companyname + '</h2>';
                        // htmldata += '<p><b>Savani ID #</b>' + sellerdetails.savaniid + '</p>';
                        // htmldata += '<ul>';
                        // htmldata += '<li><b>Location</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.cityname + ',' + sellerdetails.statename + ', ' + sellerdetails.countryname + '</span></li>';
                        // htmldata += '<li><b>Contact Person</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.personname + '</span></li>';
                        // htmldata += '<li><b>Phone</b>: <span class="metalpurity1 phonesearch">&nbsp;<a href="tel:' + sellerdetails.phonecode + '' + sellerdetails.businessphoneno + '" >' + sellerdetails.phonecode + ' ' + sellerdetails.businessphoneno + '</a></span></li>';
                        // htmldata += '</ul>';
                        // htmldata += '</div>';
                        // htmldata += '</div>';
                        // htmldata += '</div>';
                        // htmldata += '<div class="card">';
                        // htmldata += '<div class="card-body">';
                        // htmldata += '<div class="Notessearchd">';
                        // htmldata += '<ul>';
                        // htmldata += '<li><b>Laser Inscription</b>: <span class="metalpurity1 phonesearch">&nbsp;' + diamonddata.laserinscription + '</span></li>';
                        // // htmldata += '<li><b>Laser Inscription</b>: <span class="metalpurity1 phonesearch">&nbsp;' + diamonddata.laserinscription + '</span></li>';
                        // htmldata += '</ul>';
                        // htmldata += '</div>';

                        // htmldata += '</div>';

                        // htmldata += '</div>';
                        // htmldata += '</div>';
                        // htmldata += '</div>';

                        htmldata += '</div>';



                    }
                }

            }
            $('#ListDiamondDataDetailModalLong #ListDiamondDataDetail').html(htmldata);
            $('#ListDiamondDataDetailModalLong').modal('show');

        }

        function OnErrorshowmydiamonddetail(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    });




    /* START LIST ALL DIAMOND DATA */

    function listdiamonddata(page, form = null) {

        var id = '<?php echo $id; ?>';
        // var form = $('#form-diamond-search').serialize();
        showloader();
        var pagename = getpagename();
        var useraction = $('#formevent').val();
        var diamond_per_page = $('#diamond_per_page').val();
        var sortbyid = $('#sortbyid').val();

        var nextpage = 0;
        if ($('#listdiamondDatatbl').attr('data-nextpage') > 0) {
            nextpage = $('#listdiamondDatatbl').attr('data-nextpage');
        }

        formdata = new FormData(document.getElementById('form-diamond-search'));
        if (form != null) {
            // checksidediamondformelementvalue();
            formdata = new FormData(document.getElementById(form));
        }



        formdata.append("action", "listdiamond");
        formdata.append("nextpage", parseInt(nextpage) + 1);
        formdata.append("fltparcel", 0);
        formdata.append("fltmanagemydiamond", 0);
        formdata.append("perpage", diamond_per_page);
        formdata.append("sortbyid", sortbyid);

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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccesslistdiamond, OnErrorlistdiamond)

        function Onsuccesslistdiamond(data) {
            hideloader();
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
                $('#form-diamond-search').addClass('d-none');
                $('.listdiamondDataDiv').removeClass('d-none');

                htmldata += '<tr>';
                htmldata += '<td colspan="16">';
                htmldata += '<h3>' + resultdata.message + '</h3>';
                htmldata += '</td>';
                htmldata += '</tr>';

                $('.listdiamondDataDiv #listdiamondData').html(htmldata);
                $('#showdiamondentries').html(0);

                $('.listdiamondDataDiv .totaldiamonds').html('0 Diamonds ');
                $('.listdiamondDataDiv .totalprice').html('Total Price : $0');


            } else if (resultdata.status == 1) {
                $('#form-diamond-search').addClass('d-none');
                $('.listdiamondDataDiv').removeClass('d-none');
                if (resultdata.totaldiamond >= 0 && resultdata.totalprice >= 0 && resultdata.totaldiamond != null && resultdata.totalprice != null) {
                    // //console.log('totaldiamond'+resultdata.totaldiamond);
                    // //console.log('totalprice'+resultdata.totalprice);
                    $('.listdiamondDataDiv .totaldiamonds').html(resultdata.totaldiamond + ' Diamonds ');
                    $('.listdiamondDataDiv .totalprice').html('Total Price : $' + resultdata.totalprice);
                }


                for (var i in resultdata.data) {
                    var diamonddata = resultdata.data[i];

                    htmldata += '<tr data-toggle="collapse" data-target="#searchdown' + diamonddata.id + '" class="sdown' + diamonddata.id + '">';
                    htmldata += '<td>';
                    // htmldata += '<div class="form-check">';
                    // htmldata += '<input class="form-check-input sbox" type="checkbox" value="' + diamonddata.id + '" id="selectdiamondid' + diamonddata.id + '">';
                    // htmldata += '<label class="form-check-label searchcheckbox" for="selectdiamondid' + diamonddata.id + '">';

                    // htmldata += '</label>';
                    // htmldata += '</div>';
                    htmldata += '' + diamonddata.personname + '';
                    htmldata += '</td>';
                    // htmldata+='<td>';
                    // htmldata+='<div class="searchreating">100%</div>';
                    // htmldata+='</td>';
                    htmldata += '<td>' + diamonddata.country + '</td>';
                    htmldata += '<td>' + diamonddata.shape + '</td>';
                    htmldata += '<td>' + diamonddata.size + '</td>';
                    htmldata += '<td>' + diamonddata.color + '</td>';
                    htmldata += '<td>' + diamonddata.clarity + '</td>';
                    htmldata += '<td>' + diamonddata.cut + '</td>';
                    htmldata += '<td>' + diamonddata.polish + '</td>';
                    htmldata += '<td>' + diamonddata.symmetry + '</td>';
                    htmldata += '<td>' + diamonddata.fluorescenecolor + '</td>';
                    htmldata += '<td>' + diamonddata.lab + '</td>';
                    // htmldata+='<td>$354</td>';
                    // htmldata+='<td>-83.9%</td>';
                    htmldata += '<td>$' + diamonddata.price + '</td>';
                    htmldata += '<td>' + diamonddata.depthper + '%</td>';
                    htmldata += '<td>' + diamonddata.tableper + '%</td>';
                    htmldata += '<td>' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</td>';
                    htmldata += '<td>' + diamonddata.stocknumber + '</td>';

                    // htmldata+='<td>G</td>';
                    // htmldata+='<td>-</td>';
                    // htmldata+='<td>1.132</td>';
                    htmldata += '</tr>';

                    htmldata += '<td class="searchPadding">';
                    htmldata += '<div class="collapse" id="searchdown' + diamonddata.id + '">';
                    htmldata += '<div class="col-12 col-md-12 searchddetail">';
                    htmldata += '<div class="text-left searchleft">';
                    htmldata += '<div class="diamondsearch">';
                    htmldata += '<ul>';
                    htmldata += '<li>';
                    // htmldata += '<div class="starimg">';
                    // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/star.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '">';
                    // htmldata += '</div>';
                    htmldata += '<h4>' + diamonddata.lab + ',' + diamonddata.shape + ',' + diamonddata.size + ',' + diamonddata.color + ',' + diamonddata.clarity + ',' + diamonddata.cut + ',' + diamonddata.polish + ',' + diamonddata.symmetry + '</h4>';
                    htmldata += '</li>';
                    // htmldata += '<li class="setdiamonpgcl"><b>Price &nbsp</b>$' + diamonddata.price + '</li>';
                    // htmldata += '<li>' + diamonddata.availability + '</li>';
                    // htmldata += '<li>' + diamonddata.lab + ', ' + diamonddata.reportnumber + '</li>';
                    if (diamonddata.reportfilelink != '') {
                        htmldata += '<li><a href="' + diamonddata.reportfilelink + '" target="_blank">Report Link</a></li>';
                    }
                    htmldata += '</ul>';
                    // htmldata += '<h3>'+diamonddata.lab+', '+diamonddata.reportnumber+'</h3>';
                    // // if(diamonddata.reportfilelink!='')
                    // // {
                    //     htmldata += '<a href="'+diamonddata.reportfilelink+'" target="_blank">Report Link</a>';
                    // // }


                    htmldata += '</div>';
                    // htmldata+='<div class="searchgreade">';
                    // htmldata+='<button type="button" class="btn searchbtnset">$/ct<br><b>$ 380</b></button>';
                    // htmldata+='</div>';
                    // htmldata+='<div class="searchgreade">';
                    // htmldata+='<button type="button" class="btn searchbtnset">Savani%<br><b>-83.23%</b></button>';
                    // htmldata+='</div>';
                    // htmldata += '<div class="searchgreade">';
                    // htmldata += '<button type="button" class="btn searchbtnset">Total<br><b>$' + diamonddata.price + '</b></button>';
                    // htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="text-right searchright">';
                    <?php
                    if ($CanMemberToMemberChat == 1) {
                    ?>
                        htmldata += '<div class="searchgreade searchcom">';
                        htmldata += '<button type="button" class="btn searchbtnset contactdiamondseller" data-diamondid="' + diamonddata.id + '" data-diamondname="' + diamonddata.shape + ',' + diamonddata.size + ',' + diamonddata.color + ',' + diamonddata.clarity + '">Contact Seller</button>';
                        htmldata += '</div>';
                    <?php
                    } ?>
                    // htmldata+='<div class="searchgreade searchcom">';
                    // htmldata+='<button type="button" class="btn searchbtnset">Compare</button>';
                    // htmldata+='</div>';
                    htmldata += '<div class="searchgreade searchcom">';
                    htmldata += '<button type="button" class="btn searchbtnset btnshowdiamonddetail" data-diamondid="' + diamonddata.id + '" >Diamond Page</button>';
                    htmldata += '</div>';
                    // htmldata+='<div class="searchgreade searchcom">';
                    // htmldata+='<button type="button" class="btn searchbtnset">More</button>';
                    // htmldata+='</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="col-12 searchddetail">';
                    htmldata += '<div class="row">';
                    htmldata += '<div class="col-md-6 searchddetail1">';
                    htmldata += '<div class="card">';
                    htmldata += '<div class="card-body">';
                    htmldata += '<div class="headset">';
                    htmldata += '<h5 class="text-left">';
                    htmldata += '   Diamond Details';
                    htmldata += '</h5>';
                    htmldata += '<h4>Last Update: ' + diamonddata.timestamp + '</h4>';
                    htmldata += '</div>';
                    htmldata += '<div class="searchmoredetail">';
                    htmldata += '<div class="row">';
                    htmldata += '<div class="col-md-6">';
                    htmldata += '<ul>';
                    htmldata += '<li><b>Shape</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.shape + '</span></li>';
                    htmldata += '<li><b>Size</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.size + '</span></li>';
                    htmldata += '<li><b>Color</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.color + '</span></li>';
                    htmldata += '<li><b>Clarity</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.clarity + '</span></li>';
                    htmldata += '<li><b>Cut</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.cut + '</span></li>';
                    htmldata += '<li><b>Polish</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.polish + '</span></li>';
                    htmldata += '<li><b>Symm</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.symmetry + '</span></li>';
                    htmldata += '<li><b>Fluor.</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fluorescenecolor + '</span></li>';
                    htmldata += '<li><b>Lab</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.lab + '</span></li>';
                    htmldata += '</ul>';
                    htmldata += '</div>';
                    htmldata += '<div class="col-md-6">';
                    htmldata += '<ul>';
                    // htmldata+='<li><b>$/ct</b>: <span class="metalpurity1">&nbsp; $354</span></li>';
                    // htmldata+='<li><b>%Savani</b>: <span class="metalpurity1">&nbsp; -83.9%</span></li>';
                    htmldata += '<li><b>Total</b>: <span class="metalpurity1">&nbsp; $' + diamonddata.price + '</span></li>';
                    htmldata += '<li><b>Depth</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.depthper + '%</span></li>';
                    htmldata += '<li><b>Table</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tableper + '% </span></li>';
                    htmldata += '<li><b>Measurement</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</span></li>';
                    htmldata += '<li><b>Vendor Stock No. </b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stocknumber + '</span></li>';
                    // htmldata+='<li><b>Status</b>: <span class="metalpurity1">&nbsp; G</span></li>';
                    // htmldata+='<li><b>Media</b>: <span class="metalpurity1">&nbsp; -</span></li>';
                    // htmldata+='<li><b>Ratio</b>: <span class="metalpurity1">&nbsp; 1.132</span></li>';
                    htmldata += '</ul>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="col-md-3 searchddetail2">';
                    htmldata += '<div class="row">';
                    htmldata += '<div class="col-md-12 detail1search">';
                    htmldata += '<div class="headset">';
                    htmldata += '<h5 class="text-left">';
                    htmldata += 'Price';
                    htmldata += '</h5>';
                    htmldata += '<div class="pricecalimg">';
                    // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/pricecal.svg" alt="' + diamonddata.savanilotnumber + '" title="' + diamonddata.savanilotnumber + '">';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="searchmoredetail3">';
                    htmldata += '<ul>';
                    htmldata += '<li><b>Lot Diamond #</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.savanilotnumber + '</span></li>';
                    htmldata += '<li><b>Availability</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.availability + '</span></li>';
                    htmldata += '<li><b>Diamond Location</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.country + '</span></li>';
                    htmldata += '<li><b>Stock No #</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stock + '</span></li>';
                    htmldata += '<li><b>Price</b>: <span class="metalpurity1">&nbsp; $' + diamonddata.price + '</span></li>';
                    htmldata += '</ul>';
                    htmldata += '</div>';

                    // htmldata+='<div class="headset">';
                    // // htmldata+='<h5 class="text-left">';
                    // // htmldata+='<li>$/ct</li>';
                    // // htmldata+='<li>$/ct</li>';
                    // // htmldata+='<li>$/ct</li>';
                    // // htmldata+='</h5>';
                    // // htmldata+='<div class="cashname">';
                    // // // htmldata+='<ul>';
                    // // // htmldata+='<li> <b>cash</b></li>';
                    // // // htmldata+='<li>$350</li>';
                    // // // htmldata+='<li>-56%</li>';
                    // // // htmldata+='<li>$230</li>';
                    // // // htmldata+='</ul>';
                    // // // htmldata+='<ul>';
                    // // // htmldata+='<li> <b>Price</b></li>';
                    // // // htmldata+='<li>$410</li>';
                    // // // htmldata+='<li>-56.20%</li>';
                    // // // htmldata+='<li>$850</li>';
                    // // // htmldata+='</ul>';
                    // // htmldata+='</div>';
                    // htmldata+='</div>';
                    htmldata += '</div>';



                    htmldata += '<div class="col-md-12 mediaset">';
                    htmldata += '<h4>Media</h4>';

                    var disabledreport = 'disabled';
                    var linkreport = 'javascript:void(0);';
                    var targetreport = '';
                    if (diamonddata.reportfilelink != '') {
                        disabledreport = '';
                        linkreport = diamonddata.reportfilelink;
                        targetreport = '_blank';
                    }

                    htmldata += '<a class="btn reseacbtn ' + disabledreport + '" ' + disabledreport + ' href="' + linkreport + '" target="' + targetreport + '" data-diamondid="' + diamonddata.id + '">';
                    htmldata += '<div class="pricecalimg">';
                    htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/report.svg" alt="diamonds" title="diamonds">';
                    htmldata += '</div>';
                    htmldata += 'Report';
                    htmldata += '</a>';

                    htmldata += '<button type="button" class="btn reseacbtn btnshowdiamonddetail" data-diamondid="' + diamonddata.id + '">';
                    htmldata += '<div class="pricecalimg">';
                    htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/diogram.svg" alt="diamonds" title="diamonds">';
                    htmldata += '</div>';
                    htmldata += 'Diagram';
                    htmldata += '</button>';
                    htmldata += '<button type="button" class="btn reseacbtn btnshowdiamonddetail" data-diamondid="' + diamonddata.id + '">';
                    htmldata += '<div class="pricecalimg">';
                    htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/video.svg" alt="diamonds" title="diamonds">';
                    htmldata += '</div>';
                    htmldata += 'Video';
                    htmldata += '</button>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';

                    var sellerdetails = diamonddata.persondetail[0];

                    htmldata += '<div class="col-md-3 searchddetail2">';
                    htmldata += '<div class="row sedetil">';
                    htmldata += '<div class="col-md-12 detail1search">';
                    htmldata += '<div class="headset">';
                    htmldata += '<h5 class="text-left">';
                    htmldata += 'Seller Details';
                    htmldata += '</h5>';
                    htmldata += '</div>';
                    htmldata += '<div class="row setpro">';
                    htmldata += '<div class="col-md-8 ">';
                    htmldata += ' <ul class="d-flex justify-content-between align-items-center">';
                    htmldata += '<li>';
                    htmldata += '<div class="profileimg">';
                    htmldata += '<img src="' + sellerdetails.profileimg + '" alt="' + sellerdetails.personname + '" title="' + sellerdetails.personname + '">';
                    htmldata += '</div>';
                    htmldata += '</li>';
                    htmldata += '<li>';
                    htmldata += '<div class="desc ">';
                    htmldata += '<h4>' + sellerdetails.companyname + '</h4>';
                    htmldata += '<h5><b>Savani ID</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.savaniid + '</span></h5>';
                    htmldata += '</div>';
                    htmldata += '</li>';
                    htmldata += '</ul>';
                    htmldata += '</div>';
                    // htmldata+='<div class="col-md-5 afprofile">';
                    // htmldata+='<ul class="d-flex justify-content-between align-items-center">';
                    // htmldata+='<li>';
                    // htmldata+='<div class="sideimg">';
                    // htmldata+='<img src="<?php echo $config->getImageurl(); ?>images/searchpage/review.svg" alt="diamonds" title="diamonds">';
                    // htmldata+='</div>';
                    // htmldata+='</li>';
                    // htmldata+='<li>';
                    // htmldata+='<div class="desc">';
                    // htmldata+='<h6>no reating yet</h6>';
                    // htmldata+='</div>';
                    // htmldata+='</li>';
                    // htmldata+='</ul>';
                    // htmldata+='</div>';
                    htmldata += '</div>';
                    htmldata += '<div class="searchmoredetail3">';
                    htmldata += '<ul>';
                    htmldata += '<li><b>Location</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.countryname + '</span></li>';
                    htmldata += '<li><b>Contact Person</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.personname + '</span></li>';
                    htmldata += '<li><b>Phone</b>: <span class="metalpurity1">&nbsp; <a href="tel:' + sellerdetails.phonecode + '' + sellerdetails.businessphoneno + '" >' + sellerdetails.phonecode + ' ' + sellerdetails.businessphoneno + '</a></span></li>';
                    htmldata += '</ul>';
                    htmldata += '</div>';

                    htmldata += '</div>';

                    // htmldata += '<div class="col-md-12 noteset">';
                    // // htmldata += '<div class="writset">';
                    // // htmldata += '<textarea class="form-control" rows="4" placeholder=" Write a personal note...." id="comment"></textarea>';
                    // // htmldata += '</div>';

                    // htmldata += '<div class="colsave">';
                    // htmldata += '<ul>';

                    // htmldata += '<li>';
                    // htmldata += '<div class="colorset">';
                    // htmldata += '<input type="color" class="scolor" id="colorpicker" value="#0000ff">';
                    // htmldata += '</div>';
                    // htmldata += '<p>if you want to change color top here</p>';
                    // htmldata += '</li>';

                    // htmldata += '<li>';
                    // htmldata += '<button type="button" class="btn searchbtnset">save</button>';
                    // htmldata += '</li>';
                    // htmldata += '</ul>';
                    // htmldata += '</div>';
                    // htmldata += '</div>';

                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</div>';
                    htmldata += '</td>';





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


        }

        function OnErrorlistdiamond(content) {

        }
    }

    $('body').on('change', '#diamond_per_page', function() {
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        $("#listdiamondData").animate({
            scrollTop: 0
        }, "slow");
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('#listdiamondDatatbl tbody').scroll(function() {
        if ($(this).scrollTop() +
            $(this).innerHeight() >=
            $(this)[0].scrollHeight) {
            // //console.log('Here');
            var dataact = getpagename();
            var show = $('#listdiamondDatatbl').attr('data-show');
            if (dataact && show == 1) {
                listdiamonddata(1, 'form-diamond-side-search');
            }
        }
    });

    $('body').on('click', '.btnshowdiamonddetail', function() {

        var diamondid = $(this).attr('data-diamondid');
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
        formdata.append("action", "listdiamond");
        formdata.append("id", diamondid);
        formdata.append("nextpage", 1);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccessshowdiamonddetail, OnErrorshowdiamonddetail);

        function Onsuccessshowdiamonddetail(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data.length > 0) {
                    for (var i in resultdata.data) {

                        var diamonddata = resultdata.data[i];

                        var title = diamonddata.cmpname + ' | Lot # ' + diamonddata.savanilotnumber;
                        $('#ListDiamondDataDetailModalLongTitle').html(title);

                        htmldata += '<div class="col-12">';
                        htmldata += '<div class="row">';
                        htmldata += '<div class="col-md-8">';
                        htmldata += '<div class="row">';
                        htmldata += '<div class="col-md-8">';
                        htmldata += '<div class="diamondsearch">';
                        htmldata += '<ul>';
                        htmldata += '<li>';
                        // htmldata += '<div class="starimg">';
                        // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/star.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '">';
                        // htmldata += '</div>';
                        htmldata += '<h4>' + diamonddata.lab + ',' + diamonddata.shape + ',' + diamonddata.size + ',' + diamonddata.color + ',' + diamonddata.clarity + ',' + diamonddata.cut + ',' + diamonddata.polish + ',' + diamonddata.symmetry + '</h4>';
                        htmldata += '</li>';
                        htmldata += '<li><b>Price &nbsp</b>$' + diamonddata.price + '</li>';
                        htmldata += '<li>' + diamonddata.availability + '</li>';
                        htmldata += '<li>' + diamonddata.lab + ', ' + diamonddata.reportnumber + '</li>';
                        // if (diamonddata.reportfilelink != '' && diamonddata.reportfilelink != null) {
                        //     htmldata += '<li><a href="' + diamonddata.reportfilelink + '" target="_blank">Report Link</a></li>';
                        // }
                        // if (diamonddata.reportfileurl != '' && diamonddata.reportfileurl != null) {
                        //     htmldata += '<li><a href="' + diamonddata.reportfileurl + '" target="_blank"><img src="<?php echo $config->getImageurl(); ?>images/files.png" alt="Report File" height="50" width="50" title="Report File"></a></li>';
                        // }
                        htmldata += '</ul>';
                        // htmldata += '<h3>'+diamonddata.lab+', '+diamonddata.reportnumber+'</h3>';
                        // // if(diamonddata.reportfilelink!='')
                        // // {
                        //     htmldata += '<a href="'+diamonddata.reportfilelink+'" target="_blank">Report Link</a>';
                        // // }


                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '<div class="col-md-4 contectse text-center">';
                        <?php
                        if ($CanMemberToMemberChat == 1) {
                        ?>
                            htmldata += '<button type="button" class="btn contactdiamondseller" data-diamondid="' + diamonddata.id + '" data-diamondname="' + diamonddata.lab + ',' + diamonddata.shape + ',' + diamonddata.size + ',' + diamonddata.color + ',' + diamonddata.clarity + ',' + diamonddata.cut + ',' + diamonddata.polish + ',' + diamonddata.symmetry + '">Contact Seller</button><br>';
                        <?php
                        }
                        if ($CanShareDiamond == 1) {
                        ?>
                            htmldata += '<button type="button" class="btn sharediamond" data-diamondid="' + diamonddata.id + '"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/share.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '"></button>';
                        <?php } ?>
                        // htmldata += '<button type="button" class="btn" data-toggle="modal" data-target="#linksearch"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/pin.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '"></button>';
                        // htmldata += '<button type="button" class="btn"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/facebook.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '"></button><br>';
                        // htmldata += '<a href="#" class="text-center">Learn More</a>';
                        htmldata += '</div>';
                        htmldata += '<div class="col-12 searmedia">';
                        htmldata += '<div class="row">';
                        htmldata += '<div class="col-md-4 mediasearch">';
                        // htmldata += '<ul>';
                        // htmldata += '<li><b>media<br><span>No media</span></b></li>';
                        // htmldata += '</ul>';

                        htmldata += '<h5>Media</h5>';
                        htmldata += '<div class="media">';
                        if (diamonddata.diamondimagedetail.length > 0) {
                            for (var im in diamonddata.diamondimagedetail) {
                                htmldata += '<div class="mediaurl mr-2">';
                                htmldata += '<a href="<?php echo $config->getImageurl(); ?>' + diamonddata.diamondimagedetail[im].image + '" target="_blank">';
                                htmldata += '<img src="<?php echo $config->getImageurl(); ?>' + diamonddata.diamondimagedetail[im].image + '" alt="' + diamonddata.stock + '" width="100%" title="' + diamonddata.stock + '">';
                                htmldata += '</a>';
                                htmldata += '</div>';
                            }

                        } else {

                            htmldata += ' <b<span>No Media</span></b>';
                        }

                        htmldata += '</div>';

                        if (diamonddata.diamondimglink != '' && diamonddata.diamondimglink != null) {
                            htmldata += '<h5>Image URL</h5>';
                            htmldata += '<div class="media">';
                            htmldata += '<div class="mediaurl mr-2">';
                            htmldata += '<a href="' + diamonddata.diamondimglink + '" target="_blank">';
                            htmldata += '<img src="' + diamonddata.diamondimglink + '" alt="' + diamonddata.stock + '" width="100%" height="80px" title="' + diamonddata.stock + '">';
                            htmldata += '</a>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                        }
                        if (diamonddata.videolink != '' && diamonddata.videolink != null) {
                            htmldata += '<h5>Media URL</h5>';
                            htmldata += '<div class="media">';
                            htmldata += '<div class="mediaurl">';
                            htmldata += '<a href="' + diamonddata.videolink + '" target="_blank"><i class="fas fa-play"></i></a>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                        }
                        if (diamonddata.reportfileurl != '' && diamonddata.reportfileurl != null) {
                            htmldata += '<h5>Report File</h5>';
                            htmldata += '<div class="media">';
                            htmldata += '<div class="mediaurl">';
                            htmldata += '<a href="' + diamonddata.reportfileurl + '" target="_blank"><img src="<?php echo $config->getImageurl(); ?>images/files.png" alt="Report File" height="50" width="50" title="Report File"></a>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                        }
                        if (diamonddata.reportfilelink != '' && diamonddata.reportfilelink != null) {
                            htmldata += '<h5>Report URL</h5>';
                            htmldata += '<div class="media">';
                            htmldata += '<div class="mediaurl">';
                            htmldata += '<a href="' + diamonddata.reportfilelink + '" target="_blank"><i class="fas fa-link"></i></a>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                        }
                        if (diamonddata.keytosymbols != '' && diamonddata.keytosymbols != null) {
                            htmldata += '<ul>';
                            // htmldata += '<li><b>plot<br><span>No lot</span></b></li>';
                            htmldata += '<li><b>Key To symbols<br><span>' + diamonddata.keytosymbols + '</span></b></li>';
                            htmldata += '</ul>';
                        }
                        // htmldata += '<h5>Diagram</h5>';
                        // htmldata += '<div class="media">';
                        // htmldata += '<div class="mediaurl">';
                        // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/diagram.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '">';
                        // htmldata += '</div>';
                        // htmldata += '</div>';
                        htmldata += '</div>';



                        htmldata += '<div class="col-md-8 addsearchdetail">';
                        htmldata += '<div class="card">';
                        htmldata += '<h4>Diamond Details</h4>';
                        htmldata += '<div class="card-body">';
                        htmldata += '<ul>';
                        htmldata += '<li><b>Stock</b>: <span class="metalpurity1" data-tooltip="Tool tip">&nbsp; ' + diamonddata.stock + '</span></li>';
                        htmldata += '<li><b>Intensity</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.intensity + '</span></li>';
                        htmldata += '<li><b>Fluorescene Color</b>: <span class="metalpurity1" >&nbsp; ' + diamonddata.fluorescenecolor + '</span></li>';
                        htmldata += '<li><b>Depth%</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.depth + '%</span></li>';
                        htmldata += '<li><b>Table%</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tableper + '%</span></li>';
                        htmldata += '<li><b>Length</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.length + '</span></li>';
                        htmldata += '<li><b>Width</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.width + '</span></li>';
                        htmldata += '<li><b>Depth</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.depth + '</span></li>';
                        // htmldata += '<li><b>Table%</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tableper + '%</span></li>';



                        htmldata += '<li><b>Measurement </b>: <span class="metalpurity1">&nbsp; ' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</span></li>';
                        // htmldata += '<li><b>Ratio</b>: <span class="metalpurity1">&nbsp; New</span></li>';
                        htmldata += '<li><b>Gridle Condition</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="Small to Extremely Large">&nbsp; ' + diamonddata.gridlecondition + '</span></li>';
                        htmldata += '<li><b>Gridle Min</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="Extremely Thick">&nbsp; ' + diamonddata.gridlemin + '</span></li>';
                        htmldata += '<li><b>Gridle Max</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.gridlemax + '</span></li>';
                        htmldata += '<li><b>Gridle%</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.gridleper + '%</span></li>';
                        htmldata += '<li><b>Culet Condition</b>: <span class="metalpurity1"tabindex="0" data-toggle="tooltip" title="Refurbished">&nbsp; ' + diamonddata.culetcondition + '</span></li>';
                        htmldata += '<li><b>Culet Size</b>: <span class="metalpurity1"tabindex="0" data-toggle="tooltip" title="2.25">&nbsp; ' + diamonddata.culetsize + '</span></li>';
                        htmldata += '<li><b>Treatment</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="Irradiation and Annealing, Untreated,High Pressure High Temperature">&nbsp; ' + diamonddata.treatment + '</span></li>';
                        htmldata += '<li><b>Crown</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.crownangle + ',' + diamonddata.crownheight + '</span></li>';
                        htmldata += '<li><b>Pavilion.</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.pavilionangle + ',' + diamonddata.pavilionheight + '</span></li>';
                        htmldata += '<li><b>Star length</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.starlength + '</span></li>';
                        // htmldata += '</ul>';
                        // htmldata += '<ul>';
                        // htmldata += '<h5>Diamond details</h5>';
                        // // htmldata += '<li><b>BGM</b>: <span class="metalpurity1">&nbsp; No BGM</span></li>';
                        htmldata += '<li><b>Shade</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.shade + '</span></li>';
                        htmldata += '<li><b>Eye Clean</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.eyeclean + '</span></li>';
                        htmldata += '<li><b>Open Inclusions</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.openinclusions + '</span></li>';
                        htmldata += '<li><b>Black Inclusions</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.blackinclusions + '</span></li>';
                        htmldata += '<li><b>White Inclusions</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.whiteinclusions + '</span></li>';
                        htmldata += '<li><b>Milky</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.milky + '</span></li>';



                        htmldata += '<li><b>Clarity(Eye Clean)</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.clarity + '(' + diamonddata.eyeclean + ')</span></li>';
                        htmldata += '<li><b>Brand</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.brand + '</span></li>';
                        htmldata += '<li><b>Supplier Comment</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.suppliercomment + '</span></li>';

                        htmldata += '<li><b>Report Number</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.reportnumber + '</span></li>';
                        htmldata += '<li><b>Report Date</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.reportdate + '</span></li>';
                        htmldata += '<li><b>Lab Location</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.lablocation + '</span></li>';
                        htmldata += '<li><b>Report Comment</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.reportcomment + '</span></li>';
                        htmldata += '<li><b>Fancy Intensity</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fancyintensity + '</span></li>';
                        htmldata += '<li><b>Overtone</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.overtone + '</span></li>';
                        htmldata += '<li><b>Fancy Color 1</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fancycolor1 + '</span></li>';
                        htmldata += '<li><b>Fancy Color 2</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fancycolor2 + '</span></li>';
                        htmldata += '<li><b>Stock Number</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stocknumber + '</span></li>';
                        htmldata += '<li><b>Trade Show</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tradeshow + '</span></li>';
                        htmldata += '<li><b>Brand</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.brand + '</span></li>';
                        htmldata += '<li><b>Rough Diamond Source</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.roughdiamondsource + '</span></li>';
                        htmldata += '<li><b>Sleeve Name</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.sievename + '</span></li>';

                        htmldata += '</ul>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';

                        var sellerdetails = diamonddata.persondetail[0];

                        htmldata += '<div class="col-md-4 profilediamnd">';
                        htmldata += '<div class="card">';
                        htmldata += '<div class="card-body">';
                        htmldata += '<div class="sellersearchd">';
                        htmldata += '<h5>Seller Details</h5>';
                        htmldata += '<div class="profileimgset">';
                        // htmldata += '<h3>20%</h3>';
                        htmldata += '<img src="' + sellerdetails.profileimg + '" alt="' + sellerdetails.personname + '" title="' + sellerdetails.personname + '">';
                        htmldata += '</div>';
                        htmldata += '<h2>' + sellerdetails.companyname + '</h2>';
                        htmldata += '<p><b>Savani ID #</b>' + sellerdetails.savaniid + '</p>';
                        htmldata += '<ul>';
                        htmldata += '<li><b>Location</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.cityname + ',' + sellerdetails.statename + ', ' + sellerdetails.countryname + '</span></li>';
                        htmldata += '<li><b>Contact Person</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.personname + '</span></li>';
                        htmldata += '<li><b>Phone</b>: <span class="metalpurity1 phonesearch">&nbsp;<a href="tel:' + sellerdetails.phonecode + '' + sellerdetails.businessphoneno + '" >' + sellerdetails.phonecode + ' ' + sellerdetails.businessphoneno + '</a></span></li>';
                        htmldata += '</ul>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '<div class="card">';
                        htmldata += '<div class="card-body">';
                        htmldata += '<div class="Notessearchd">';
                        htmldata += '<ul>';
                        htmldata += '<li><b>Laser Inscription</b>: <span class="metalpurity1 phonesearch">&nbsp;' + diamonddata.laserinscription + '</span></li>';
                        // htmldata += '<li><b>Laser Inscription</b>: <span class="metalpurity1 phonesearch">&nbsp;' + diamonddata.laserinscription + '</span></li>';
                        htmldata += '</ul>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';



                    }
                }

            }
            $('#ListDiamondDataDetailModalLong #ListDiamondDataDetail').html(htmldata);
            $('#ListDiamondDataDetailModalLong').modal('show');

            $('.sharediamond').on('click', function() {
                var id = $(this).attr('data-diamondid');
                $("#form-diamond-share").validate().resetForm();
                $('#form-diamond-share').trigger("reset");
                $('#form-diamond-share #sharediamondid').val(id);
                $('#ListDiamondDataDetailModalLong').modal('hide');
                $('#sharediamondsearch').modal('show');
            });



            if ($('#form-diamond-share').length) {
                $('#form-diamond-share').validate({
                    rules: {
                        sharewithemail: {
                            required: true,
                            email: true
                        },
                    },
                    messages: {
                        sharewithemail: {
                            required: "E-mail Address is required",
                        },
                    },
                    submitHandler: function(form) {

                        showloader();
                        var pagename = getpagename();
                        var useraction = $('#formevent').val();
                        formdata = new FormData(form);
                        formdata.append("action", "sharediamond");
                        var headersdata = {
                            'Accept': 'application/json',
                            platform: 4,
                            userpagename: pagename,
                            useraction: useraction,
                            masterlisting: false
                        };
                        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccesssharediamond, OnErrorsharediamond)

                        function Onsuccesssharediamond(data) {
                            hideloader();
                            var JsonData = JSON.stringify(data);
                            var resultdata = jQuery.parseJSON(JsonData);

                            if (resultdata.status == 0) {
                                Notiflix.Notify.Failure(resultdata.message);
                            } else if (resultdata.status == 1) {
                                Notiflix.Notify.Success(resultdata.message);
                                $('#sharediamondsearch').modal('hide');
                            }

                        }

                        function OnErrorsharediamond(content) {

                        }
                    },
                });
            }

        }

        function OnErrorshowdiamonddetail(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    });


    $('body').on('change', '#sortbyid', function() {
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    /* CONTACT DIAMOND SELLER */
    $('body').on('click', '.contactdiamondseller', function() {
        var id = $(this).attr('data-diamondid');
        var diamondname = $(this).attr('data-diamondname');

        $("#form-diamond-contact-seller").validate().resetForm();
        $('#form-diamond-contact-seller').trigger("reset");
        $('#form-diamond-contact-seller #contactsellerdiamondid').val(id);
        $('#form-diamond-contact-seller #contactsellerdiamondname').val(diamondname);
        $('#form-diamond-contact-seller .diamondnametext').html(diamondname);
        $('#contactdiamondseller').modal('show');
    });

    if ($('#form-diamond-contact-seller').length) {
        $('#form-diamond-contact-seller').validate({
            rules: {
                messagetext: {
                    required: true,
                },
                offerprice: {
                    required: true,
                    number: true
                }
            },
            messages: {
                messagetext: {
                    required: "Message is required",
                },
                offerprice: {
                    required: "Offer Price is required",
                },
            },
            submitHandler: function(form) {

                showloader();
                var pagename = getpagename();
                var useraction = $('#formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "contactdiamondseller");
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 4,
                    userpagename: pagename,
                    useraction: useraction,
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccesscontactdiamondseller, OnErrorcontactdiamondseller)

                function Onsuccesscontactdiamondseller(data) {
                    hideloader();
                    var JsonData = JSON.stringify(data);
                    var resultdata = jQuery.parseJSON(JsonData);

                    if (resultdata.status == 0) {
                        Notiflix.Notify.Failure(resultdata.message);
                    } else if (resultdata.status == 1) {
                        Notiflix.Notify.Success(resultdata.message);
                        $('#contactdiamondseller').modal('hide');
                    }

                }

                function OnErrorcontactdiamondseller(content) {

                }
            },
        });
    }

    /* APPLY FILTER */
    $('#btnnewsearch').on('click', function() {
        $("#form-diamond-search").validate().resetForm();
        $('#form-diamond-search').trigger("reset");
        $("#form-diamond-side-search").validate().resetForm();
        $('#form-diamond-side-search').trigger("reset");
        $('#form-diamond-search').removeClass('d-none');
        $('.listdiamondDataDiv').addClass('d-none');
        $('.select2').select2();
        $('#btnsearchdiamond').attr('disabled', true);
    });

    $('#btnresetsearch').on('click', function() {
        $("#form-diamond-search").validate().resetForm();
        $('#form-diamond-search').trigger("reset");
        $('.select2').select2();
        $('#btnsearchdiamond').attr('disabled', true);
    });


    /* SUBMIT FIRST FILTER */

    if ($('#form-diamond-search').length) {
        $('#form-diamond-search').validate({
            rules: {
                fltfromsize: {
                    number: true
                },
                flttosize: {
                    greaterThan: '#fltfromsize',
                    number: true
                },
                fltfromprice: {
                    number: true
                },
                flttoprice: {
                    greaterThan: '#fltfromprice',
                    number: true
                },
                fltfromdepthper: {
                    number: true
                },
                flttodepthper: {
                    greaterThan: '#fltfromdepthper',
                    number: true
                },
                fltfromtableper: {
                    number: true
                },
                flttotableper: {
                    greaterThan: '#fltfromtableper',
                    number: true
                },
                fltfromlength: {
                    number: true
                },
                flttolength: {
                    greaterThan: '#fltfromlength',
                    number: true
                },
                fltfromwidth: {
                    number: true
                },
                flttowidth: {
                    greaterThan: '#fltfromwidth',
                    number: true
                },
                fltfromdepth: {
                    number: true
                },
                flttodepth: {
                    greaterThan: '#fltfromdepth',
                    number: true
                },
            },
            messages: {
                flttosize: {
                    greaterThan: 'To size greater than or equal From size',
                },
                flttoprice: {
                    greaterThan: 'To price greater than or equal From price',
                },
                flttodepthper: {
                    greaterThan: 'To depth(%) greater than or equal From depth(%)',
                },
                flttotableper: {
                    greaterThan: 'To table(%) greater than or equal From table(%)',
                },
                flttolength: {
                    greaterThan: 'To length greater than or equal From length',
                },
                flttowidth: {
                    greaterThan: 'To width greater than or equal From width',
                },
                flttodepth: {
                    greaterThan: 'To depth greater than or equal From depth',
                },
            },
            submitHandler: function(form) {

                var issearchbtn = checkdiamondformelementvalue();
                if (issearchbtn > 0) {
                    fillsearchdiamondlist(1);
                    $('#listdiamondDatatbl').attr('data-nextpage', 0);
                    listdiamonddata(1, 'form-diamond-search');
                } else {
                    alertify('Please select at least one filter', 0);
                }


            },
        });
    }


    
    $('body').on('input', '.inputper', function() {
        var per = parseFloat($(this).val());
        if (per > 100) {
            $(this).val(100);
        }
    });

    $('body').on('input', '.inputval', function() {
        var inputval = parseFloat($(this).val());
        if (inputval > 0) {
            $(this).val(inputval);
        } else {
            $(this).val(0);
        }
    });


    /* CHECK ALL FIRST FILTERS */

    $('body').on('change', '#form-diamond-search input[type=checkbox]', function() {
        checkdiamondformelementvalue();
        getfiltersvalue();
    });

    $('body').on('input', '#form-diamond-search #fltfromsize,#flttosize,#fltfromprice,#flttoprice,#fltfromdepthper,#flttodepthper,#fltfromdepth,#flttodepth,#fltfromtableper,#flttotableper,#fltfromlength,#flttolength,#fltfromwidth,#flttowidth,#fltlabreportnumber', function() {
        checkdiamondformelementvalue();
        getfiltersvalue();
    });



    $('body').on('change', '#form-diamond-search .select2', function() {
        checkdiamondformelementvalue();
        getfiltersvalue();
    });


    $('body').on('change', '#form-diamond-search #fltcompanycode,#fltstocknumbers,#fltlotnumbers', function() {
        checkdiamondformelementvalue();
        getfiltersvalue();
    });

    function checkdiamondformelementvalue() {
        var issearchbtn = 0;
        $('#form-diamond-search input[type=checkbox]').each(function() {
            if (this.checked) {
                issearchbtn++;
                return false;
            }
        });
        var fltfromsize = $('#form-diamond-search #fltfromsize').val();
        var flttosize = $('#form-diamond-search #flttosize').val();
        if (fltfromsize && flttosize > 0) {
            issearchbtn++;
        }
        var flteyecleanid = $('#form-diamond-search #flteyecleanid').val();
        if (flteyecleanid.length > 0) {
            issearchbtn++;
        }

        var fltmilkyid = $('#form-diamond-search #fltmilkyid').val();
        if (fltmilkyid.length > 0) {
            issearchbtn++;
        }

        var fltopeninclusionid = $('#form-diamond-search #fltopeninclusionid').val();
        if (fltopeninclusionid.length > 0) {
            issearchbtn++;
        }

        var fltwhiteinclusionid = $('#form-diamond-search #fltwhiteinclusionid').val();
        if (fltwhiteinclusionid.length > 0) {
            issearchbtn++;
        }
        var fltblackinclusionid = $('#form-diamond-search #fltblackinclusionid').val();
        if (fltblackinclusionid.length > 0) {
            issearchbtn++;
        }

        var fltshadeid = $('#form-diamond-search #fltshadeid').val();
        if (fltshadeid.length > 0) {
            issearchbtn++;
        }
        var fltcutid = $('#form-diamond-search #fltcutid').val();
        if (fltcutid.length > 0) {
            issearchbtn++;
        }
        var fltpolishid = $('#form-diamond-search #fltpolishid').val();
        if (fltpolishid.length > 0) {
            issearchbtn++;
        }
        var fltsymmetryid = $('#form-diamond-search #fltsymmetryid').val();
        if (fltsymmetryid.length > 0) {
            issearchbtn++;
        }
        var fltfluorescencecolorid = $('#form-diamond-search #fltfluorescencecolorid').val();
        if (fltfluorescencecolorid.length > 0) {
            issearchbtn++;
        }
        var fltlocationid = $('#form-diamond-search #fltlocationid').val();
        if (fltlocationid.length > 0) {
            issearchbtn++;
        }
        var fltroughsourceid = $('#form-diamond-search #fltroughsourceid').val();
        if (fltroughsourceid.length > 0) {
            issearchbtn++;
        }

        var fltcompanycode = $('#form-diamond-search #fltcompanycode').val();
        if (fltcompanycode) {
            issearchbtn++;
        }
        var fltstocknumbers = $('#form-diamond-search #fltstocknumbers').val();
        if (fltstocknumbers) {
            issearchbtn++;
        }
        var fltsavanilotnumber = $('#form-diamond-search #fltlotnumbers').val();
        if (fltsavanilotnumber) {
            issearchbtn++;
        }
        

        var fltfromprice = $('#form-diamond-search #fltfromprice').val();
        var flttoprice = $('#form-diamond-search #flttoprice').val();
        if (fltfromprice && flttoprice > 0) {
            issearchbtn++;
        }
        var fltfromdepthper = $('#form-diamond-search #fltfromdepthper').val();
        var flttodepthper = $('#form-diamond-search #flttodepthper').val();
        if (fltfromdepthper && flttodepthper > 0) {
            issearchbtn++;
        }

        var fltfromtableper = $('#form-diamond-search #fltfromtableper').val();
        var flttotableper = $('#form-diamond-search #flttotableper').val();
        if (fltfromtableper && flttotableper > 0) {
            issearchbtn++;
        }

        var fltfromlength = $('#form-diamond-search #fltfromlength').val();
        var flttolength = $('#form-diamond-search #flttolength').val();
        if (fltfromlength && flttolength > 0) {
            issearchbtn++;
        }

        var fltfromwidth = $('#form-diamond-search #fltfromwidth').val();
        var flttowidth = $('#form-diamond-search #flttowidth').val();
        if (fltfromwidth && flttowidth > 0) {
            issearchbtn++;
        }

        var fltfromdepth = $('#form-diamond-search #fltfromdepth').val();
        var flttodepth = $('#form-diamond-search #flttodepth').val();
        if (fltfromdepth && flttodepth > 0) {
            issearchbtn++;
        }
        var fltlabreportnumber = $('#form-diamond-search #fltlabreportnumber').val();
        if (fltlabreportnumber) {
            issearchbtn++;
        }

        $('#form-diamond-search #btnsearchdiamond').attr('disabled', true);
        if (issearchbtn > 0) {
            $('#form-diamond-search #btnsearchdiamond').attr('disabled', false);
        }
        // //console.log(issearchbtn);
        return issearchbtn;

    }
    /* GET ALL FILTERS DATA */
    var shapearr = [];
    var shapeidarr = [];
    var fltfromsize = 0;
    var flttosize = 0;
    var sizearr = [];
    var colorarr = [];
    var coloridarr = [];
    var clarityarr = [];
    var clarityidarr = [];
    var flteyecleanarr = [];
    var flteyecleanidarr = [];
    var fltmilkyarr = [];
    var fltmilkyidarr = [];
    var fltblackinclusionarr = [];
    var fltblackinclusionidarr = [];

    var fltwhiteinclusionarr = [];
    var fltwhiteinclusionidarr = [];

    var fltopeninclusionarr = [];
    var fltopeninclusionidarr = [];

    var fltshadearr = [];
    var fltshadeidarr = [];

    var fltcutarr = [];
    var fltcutidarr = [];

    var fltpolisharr = [];
    var fltpolishidarr = [];

    var fltsymmetryarr = [];
    var fltsymmetryidarr = [];

    var intensityarr = [];
    var intensityidarr = [];

    var fltfluorescencecolorarr = [];
    var fltfluorescencecoloridarr = [];

    var labarr = [];

    var fltlocationarr = [];
    var fltlocationidarr = [];

    var fltroughsourcearr = [];
    var fltroughsourceidarr = [];

    var mediaarr = [];

    var treatmentarr = [];
    var treatmentidarr = [];

    var keytosymbolarr = [];
    var keytosymbolidarr = [];

    var brandarr = [];
    var brandidarr = [];

    var fltcompanycodearr = [];
    var fltstocknumbersarr = [];
    var fltsavanilotnumberarr = [];

    var fltfromprice = 0;
    var flttoprice = 0;
    var fltfromdepthper = 0;
    var flttodepthper = 0;
    var fltfromtableper = 0;
    var flttotableper = 0;
    var fltfromlength = 0;
    var flttolength = 0;
    var fltfromwidth = 0;
    var flttowidth = 0;
    var fltfromdepth = 0;
    var flttodepth = 0;
    var fltlabreportnumber = '';

    function getfiltersvalue() {
        shapearr = [];
        shapeidarr = [];
        $('#shapeDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                shapearr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                shapeidarr.push($(this).val());
            }
        });
        // //console.log(shapearr);
        // //console.log(shapeidarr);
        if (shapeidarr.length > 0) {
            $("#s_fltshapeid").val(shapeidarr).trigger('change');
            $('#s_fltshapeid').select2();
        } else {
            $("#s_fltshapeid").val(null).trigger('change');
            $('#s_fltshapeid').select2();
        }
        fltfromsize = $('#fltfromsize').val();
        flttosize = $('#flttosize').val();
        $('#s_fltfromsize').val(fltfromsize);
        $('#s_flttosize').val(flttosize);

        sizearr = [];
        $('#sizeDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                sizearr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                $('#s_fltsizeid' + $(this).val() + '').prop('checked', true);
            } else {
                $('#s_fltsizeid' + $(this).val() + '').prop('checked', false);
            }
        });

        colorarr = [];
        coloridarr = [];
        $('#colorDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                colorarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                coloridarr.push($(this).val());
            }
        });
        // //console.log(colorarr);
        // //console.log(coloridarr);
        if (coloridarr.length > 0) {
            $("#s_fltcolorid").val(coloridarr).trigger('change');
            $('#s_fltcolorid').select2();
        } else {
            $("#s_fltcolorid").val(null).trigger('change');
            $('#s_fltcolorid').select2();
        }

        clarityarr = [];
        clarityidarr = [];
        $('#clarityDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                clarityarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                clarityidarr.push($(this).val());
            }
        });
        // //console.log(clarityarr);
        // //console.log(clarityidarr);
        if (clarityidarr.length > 0) {
            $("#s_fltclarityid").val(clarityidarr).trigger('change');
            $('#s_fltclarityid').select2();
        } else {
            $("#s_fltclarityid").val(null).trigger('change');
            $('#s_fltclarityid').select2();
        }

        flteyecleanarr = [];
        flteyecleanidarr = [];
        var flteyecleanid = $('#flteyecleanid').val();
        if (flteyecleanid.length > 0) {
            for (var i = 0; i < flteyecleanid.length; i++) {
                var eyecleanid = $('#flteyecleanid option[value=' + flteyecleanid[i] + ']').val();
                var eyeclean = $('#flteyecleanid option[value=' + flteyecleanid[i] + ']').text();
                flteyecleanarr.push({
                    'id': eyecleanid,
                    'name': eyeclean
                });
                flteyecleanidarr.push(eyecleanid);
            }
        }
        // //console.log(flteyecleanarr);
        // //console.log(flteyecleanidarr);
        if (flteyecleanidarr.length > 0) {
            $("#s_flteyecleanid").val(flteyecleanidarr).trigger('change');
            $('#s_flteyecleanid').select2();
        } else {
            $("#s_flteyecleanid").val(null).trigger('change');
            $('#s_flteyecleanid').select2();
        }

        fltmilkyarr = [];
        fltmilkyidarr = [];
        var fltmilkyid = $('#fltmilkyid').val();
        if (fltmilkyid.length > 0) {
            for (var i = 0; i < fltmilkyid.length; i++) {
                var milkyid = $('#fltmilkyid option[value=' + fltmilkyid[i] + ']').val();
                var milky = $('#fltmilkyid option[value=' + fltmilkyid[i] + ']').text();
                fltmilkyarr.push({
                    'id': milkyid,
                    'name': milky
                });
                fltmilkyidarr.push(milkyid);
            }
        }
        // //console.log(fltmilkyarr);
        // //console.log(fltmilkyidarr);
        if (fltmilkyidarr.length > 0) {
            $("#s_fltmilkyid").val(fltmilkyidarr).trigger('change');
            $('#s_fltmilkyid').select2();
        } else {
            $("#s_fltmilkyid").val(null).trigger('change');
            $('#s_fltmilkyid').select2();
        }

        fltwhiteinclusionarr = [];
        fltwhiteinclusionidarr = [];
        var fltwhiteinclusionid = $('#fltwhiteinclusionid').val();
        if (fltwhiteinclusionid.length > 0) {
            for (var i = 0; i < fltwhiteinclusionid.length; i++) {
                var whiteinclusionid = $('#fltwhiteinclusionid option[value=' + fltwhiteinclusionid[i] + ']').val();
                var whiteinclusion = $('#fltwhiteinclusionid option[value=' + fltwhiteinclusionid[i] + ']').text();
                fltwhiteinclusionarr.push({
                    'id': whiteinclusionid,
                    'name': whiteinclusion
                });
                fltwhiteinclusionidarr.push(whiteinclusionid);
            }
        }
        // //console.log(fltwhiteinclusionarr);
        // //console.log(fltwhiteinclusionidarr);
        if (fltwhiteinclusionidarr.length > 0) {
            $("#s_fltwhiteinclusionid").val(fltwhiteinclusionidarr).trigger('change');
            $('#s_fltwhiteinclusionid').select2();
        } else {
            $("#s_fltwhiteinclusionid").val(null).trigger('change');
            $('#s_fltwhiteinclusionid').select2();
        }

        fltblackinclusionarr = [];
        fltblackinclusionidarr = [];
        var fltblackinclusionid = $('#fltblackinclusionid').val();
        if (fltblackinclusionid.length > 0) {
            for (var i = 0; i < fltblackinclusionid.length; i++) {
                var blackinclusionid = $('#fltblackinclusionid option[value=' + fltblackinclusionid[i] + ']').val();
                var blackinclusion = $('#fltblackinclusionid option[value=' + fltblackinclusionid[i] + ']').text();
                fltblackinclusionarr.push({
                    'id': blackinclusionid,
                    'name': blackinclusion
                });
                fltblackinclusionidarr.push(blackinclusionid);
            }
        }
        // //console.log(fltblackinclusionarr);
        // //console.log(fltblackinclusionidarr);
        if (fltblackinclusionidarr.length > 0) {
            $("#s_fltblackinclusionid").val(fltblackinclusionidarr).trigger('change');
            $('#s_fltblackinclusionid').select2();
        } else {
            $("#s_fltblackinclusionid").val(null).trigger('change');
            $('#s_fltblackinclusionid').select2();
        }

        fltopeninclusionarr = [];
        fltopeninclusionidarr = [];
        var fltopeninclusionid = $('#fltopeninclusionid').val();
        if (fltopeninclusionid.length > 0) {
            for (var i = 0; i < fltopeninclusionid.length; i++) {
                var openinclusionid = $('#fltopeninclusionid option[value=' + fltopeninclusionid[i] + ']').val();
                var openinclusion = $('#fltopeninclusionid option[value=' + fltopeninclusionid[i] + ']').text();
                fltopeninclusionarr.push({
                    'id': openinclusionid,
                    'name': openinclusion
                });
                fltopeninclusionidarr.push(openinclusionid);
            }
        }
        // //console.log(fltopeninclusionarr);
        // //console.log(fltopeninclusionidarr);
        if (fltopeninclusionidarr.length > 0) {
            $("#s_fltopeninclusionid").val(fltopeninclusionidarr).trigger('change');
            $('#s_fltopeninclusionid').select2();
        } else {
            $("#s_fltopeninclusionid").val(null).trigger('change');
            $('#s_fltopeninclusionid').select2();
        }

        fltshadearr = [];
        fltshadeidarr = [];

        
        var fltshadeid = $('#fltshadeid').val();
        if (fltshadeid.length > 0) {
            for (var i = 0; i < fltshadeid.length; i++) {
                var shadeid = $('#fltshadeid option[value=' + fltshadeid[i] + ']').val();
                var shade = $('#fltshadeid option[value=' + fltshadeid[i] + ']').text();
                fltshadearr.push({
                    'id': shadeid,
                    'name': shade
                });
                fltshadeidarr.push(shadeid);
            }
        }
        // //console.log(fltshadearr);
        // //console.log(fltshadeidarr);
        if (fltshadeidarr.length > 0) {
            $("#s_fltshadeid").val(fltshadeidarr).trigger('change');
            $('#s_fltshadeid').select2();
        } else {
            $("#s_fltshadeid").val(null).trigger('change');
            $('#s_fltshadeid').select2();
        }


        fltcutarr = [];
        fltcutidarr = [];
        var fltcutid = $('#fltcutid').val();
        if (fltcutid.length > 0) {
            for (var i = 0; i < fltcutid.length; i++) {
                var cutid = $('#fltcutid option[value=' + fltcutid[i] + ']').val();
                var cut = $('#fltcutid option[value=' + fltcutid[i] + ']').text();
                fltcutarr.push({
                    'id': cutid,
                    'name': cut
                });
                fltcutidarr.push(cutid);
            }
        }
        // //console.log(fltcutarr);
        // //console.log(fltcutidarr);
        if (fltcutidarr.length > 0) {
            $("#s_fltcutid").val(fltcutidarr).trigger('change');
            $('#s_fltcutid').select2();
        } else {
            $("#s_fltcutid").val(null).trigger('change');
            $('#s_fltcutid').select2();
        }


        fltpolisharr = [];
        fltpolishidarr = [];
        var fltpolishid = $('#fltpolishid').val();
        if (fltpolishid.length > 0) {
            for (var i = 0; i < fltpolishid.length; i++) {
                var polishid = $('#fltpolishid option[value=' + fltpolishid[i] + ']').val();
                var polish = $('#fltpolishid option[value=' + fltpolishid[i] + ']').text();
                fltpolisharr.push({
                    'id': polishid,
                    'name': polish
                });
                fltpolishidarr.push(polishid);
            }
        }
        // //console.log(fltpolisharr);
        // //console.log(fltpolishidarr);
        if (fltpolishidarr.length > 0) {
            $("#s_fltpolishid").val(fltpolishidarr).trigger('change');
            $('#s_fltpolishid').select2();
        } else {
            $("#s_fltpolishid").val(null).trigger('change');
            $('#s_fltpolishid').select2();
        }

        fltsymmetryarr = [];
        fltsymmetryidarr = [];
        var fltsymmetryid = $('#fltsymmetryid').val();
        if (fltsymmetryid.length > 0) {
            for (var i = 0; i < fltsymmetryid.length; i++) {
                var symmetryid = $('#fltsymmetryid option[value=' + fltsymmetryid[i] + ']').val();
                var symmetry = $('#fltsymmetryid option[value=' + fltsymmetryid[i] + ']').text();
                fltsymmetryarr.push({
                    'id': symmetryid,
                    'name': symmetry
                });
                fltsymmetryidarr.push(symmetryid);
            }
        }
        // //console.log(fltsymmetryarr);
        // //console.log(fltsymmetryidarr);
        if (fltsymmetryidarr.length > 0) {
            $("#s_fltsymmetryid").val(fltsymmetryidarr).trigger('change');
            $('#s_fltsymmetryid').select2();
        } else {
            $("#s_fltsymmetryid").val(null).trigger('change');
            $('#s_fltsymmetryid').select2();
        }


        intensityarr = [];
        intensityidarr = [];
        $('#intensityDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                intensityarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                intensityidarr.push($(this).val());
            }
        });
        // //console.log(intensityarr);
        // //console.log(intensityidarr);
        if (intensityidarr.length > 0) {
            $("#s_fltintensityid").val(intensityidarr).trigger('change');
            $('#s_fltintensityid').select2();
        } else {
            $("#s_fltintensityid").val(null).trigger('change');
            $('#s_fltintensityid').select2();
        }

        fltfluorescencecolorarr = [];
        fltfluorescencecoloridarr = [];
        var fltfluorescencecolorid = $('#fltfluorescencecolorid').val();
        if (fltfluorescencecolorid.length > 0) {
            for (var i = 0; i < fltfluorescencecolorid.length; i++) {
                var fluorescencecolorid = $('#fltfluorescencecolorid option[value=' + fltfluorescencecolorid[i] + ']').val();
                var fluorescencecolor = $('#fltfluorescencecolorid option[value=' + fltfluorescencecolorid[i] + ']').text();
                fltfluorescencecolorarr.push({
                    'id': fluorescencecolorid,
                    'name': fluorescencecolor
                });
                fltfluorescencecoloridarr.push(fluorescencecolorid);
            }
        }
        // //console.log(fltfluorescencecolorarr);
        // //console.log(fltfluorescencecoloridarr);
        if (fltfluorescencecoloridarr.length > 0) {
            $("#s_fltfluorescencecolorid").val(fltfluorescencecoloridarr).trigger('change');
            $('#s_fltfluorescencecolorid').select2();
        } else {
            $("#s_fltfluorescencecolorid").val(null).trigger('change');
            $('#s_fltfluorescencecolorid').select2();
        }

        labarr = [];
        $('#labDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                labarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                $('#s_fltlabid' + $(this).val() + '').prop('checked', true);
            } else {
                $('#s_fltlabid' + $(this).val() + '').prop('checked', false);
            }
        });
        // //console.log(labarr);
        fltlocationarr = [];
        fltlocationidarr = [];
        var fltlocationid = $('#fltlocationid').val();
        if (fltlocationid.length > 0) {
            for (var i = 0; i < fltlocationid.length; i++) {
                var locationid = $('#fltlocationid option[value=' + fltlocationid[i] + ']').val();
                var location = $('#fltlocationid option[value=' + fltlocationid[i] + ']').text();
                fltlocationarr.push({
                    'id': locationid,
                    'name': location
                });
                fltlocationidarr.push(locationid);
            }
        }
        // console.log('Location :  '+fltlocationarr);
        // console.log('Location ID :  '+fltlocationidarr);

        if (fltlocationidarr.length > 0) {
            $("#s_fltlocationid").val(fltlocationidarr).trigger('change');
            $('#s_fltlocationid').select2();
        } else {
            $("#s_fltlocationid").val(null).trigger('change');
            $('#s_fltlocationid').select2();
        }

        fltroughsourcearr = [];
        fltroughsourceidarr = [];
        var fltroughsourceid = $('#fltroughsourceid').val();
        if (fltroughsourceid.length > 0) {
            for (var i = 0; i < fltroughsourceid.length; i++) {
                var roughsourceid = $('#fltroughsourceid option[value=' + fltroughsourceid[i] + ']').val();
                var roughsource = $('#fltroughsourceid option[value=' + fltroughsourceid[i] + ']').text();
                fltroughsourcearr.push({
                    'id': roughsourceid,
                    'name': roughsource
                });
                fltroughsourceidarr.push(roughsourceid);
            }
        }
        // //console.log(fltroughsourcearr);
        // //console.log(fltroughsourceidarr);
        if (fltroughsourceidarr.length > 0) {
            $("#s_fltroughsourceid").val(fltroughsourceidarr).trigger('change');
            $('#s_fltroughsourceid').select2();
        } else {
            $("#s_fltroughsourceid").val(null).trigger('change');
            $('#s_fltroughsourceid').select2();
        }


        mediaarr = [];
        $('#mediaDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                mediaarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
            }
        });

        $('#s_Mediaphoto').prop('checked', false);
        $('#s_Mediavideo').prop('checked', false);
        $('#s_MediaReport').prop('checked', false);
        if ($('#Mediaphoto').prop('checked') == true) {
            $('#s_Mediaphoto').prop('checked', true);
        }
        if ($('#Mediavideo').prop('checked') == true) {
            $('#s_Mediavideo').prop('checked', true);
        }
        if ($('#MediaReport').prop('checked') == true) {
            $('#s_MediaReport').prop('checked', true);
        }

        // //console.log(mediaarr);

        treatmentarr = [];
        treatmentidarr = [];
        $('#treatmentDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                treatmentarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                treatmentidarr.push($(this).val());
            }
        });
        // //console.log(treatmentarr);
        // //console.log(treatmentidarr);
        if (treatmentidarr.length > 0) {
            $("#s_flttreatment").val(treatmentidarr).trigger('change');
            $('#s_flttreatment').select2();
        } else {
            $("#s_flttreatment").val(null).trigger('change');
            $('#s_flttreatment').select2();
        }

        keytosymbolarr = [];
        keytosymbolidarr = [];
        $('#keytosymbolDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                keytosymbolarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                keytosymbolidarr.push($(this).val());
            }
        });
        // //console.log(keytosymbolarr);
        // //console.log(keytosymbolidarr);
        if (keytosymbolidarr.length > 0) {
            $("#s_fltkeytosymbols").val(keytosymbolidarr).trigger('change');
            $('#s_fltkeytosymbols').select2();
        } else {
            $("#s_fltkeytosymbols").val(null).trigger('change');
            $('#s_fltkeytosymbols').select2();
        }

        brandarr = [];
        brandidarr = [];
        $('#brandDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                brandarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                brandidarr.push($(this).val());
            }
        });
        // //console.log(brandarr);
        // //console.log(brandidarr);
        if (brandidarr.length > 0) {
            $("#s_fltbrand").val(brandidarr).trigger('change');
            $('#s_fltbrand').select2();
        } else {
            $("#s_fltbrand").val(null).trigger('change');
            $('#s_fltbrand').select2();
        }


        fltcompanycodearr = [];
        var fltcompanycode = $('#fltcompanycode').val();
        var fltcompanycodename = $('#fltcompanycode option:selected').text();
        if (fltcompanycode) {
            fltcompanycodearr.push({
                'id': fltcompanycode,
                'name': fltcompanycodename
            });
            $('#s_fltcompanycode').val(fltcompanycode);
        }
        // //console.log(fltcompanycodearr);

        fltstocknumbersarr = [];
        var fltstocknumbers = $('#fltstocknumbers').val();
        var fltstocknumbersname = $('#fltstocknumbers option:selected').text();
        if (fltstocknumbers) {
            fltstocknumbersarr.push({
                'id': fltstocknumbers,
                'name': fltstocknumbersname
            });
            $('#s_fltstocknumbers').val(fltstocknumbers);
        }
        // //console.log(fltstocknumbersarr);

        fltsavanilotnumberarr = [];
        var fltsavanilotnumber = $('#fltlotnumbers').val();
        var fltsavanilotnumbername = $('#fltlotnumbers option:selected').text();
        if (fltsavanilotnumber) {
            fltsavanilotnumberarr.push({
                'id': fltsavanilotnumber,
                'name': fltsavanilotnumbername
            });
            $('#s_fltlotnumbers').val(fltsavanilotnumber);
        }
        // //console.log(fltsavanilotnumberarr);

        fltfromprice = $('#fltfromprice').val();
        $('#s_fltfromprice').val(fltfromprice);
        flttoprice = $('#flttoprice').val();
        $('#s_flttoprice').val(flttoprice);

        fltfromdepthper = $('#fltfromdepthper').val();
        $('#s_fltfromdepthper').val(fltfromdepthper);

        flttodepthper = $('#flttodepthper').val();
        $('#s_flttodepthper').val(flttodepthper);

        fltfromtableper = $('#fltfromtableper').val();
        $('#s_fltfromtableper').val(fltfromtableper);

        flttotableper = $('#flttotableper').val();
        $('#s_flttotableper').val(flttotableper);

        fltfromlength = $('#fltfromlength').val();
        $('#s_fltfromlength').val(fltfromlength);

        flttolength = $('#flttolength').val();
        $('#s_flttolength').val(flttolength);

        fltfromwidth = $('#fltfromwidth').val();
        $('#s_fltfromwidth').val(fltfromwidth);

        flttowidth = $('#flttowidth').val();
        $('#s_flttowidth').val(flttowidth);

        fltfromdepth = $('#fltfromdepth').val();
        $('#s_fltfromdepth').val(fltfromdepth);

        flttodepth = $('#flttodepth').val();
        $('#s_flttodepth').val(flttodepth);

        fltlabreportnumber = $('#fltlabreportnumber').val();
        $('#s_fltlabreportnumber').val(fltlabreportnumber);

        $('#s_nobgm').prop('checked', false);
        if ($('#nobgm').prop('checked') == true) {
            $('#s_nobgm').prop('checked', true);
        }

        $('#containshade').prop('checked', false);
        if ($('#shadecontain').prop('checked') == true) {
            $('#containshade').prop('checked', true);
        }
        $('#dtcontainshade').prop('checked', false);
        if ($('#dtshadecontain').prop('checked') == true) {
            $('#dtcontainshade').prop('checked', true);
        }

        checksidediamondformelementvalue();
        getsidebarelementvalue();

    }

    /* LIST SEARCH FILTERS */
    function fillsearchdiamondlist(type) {
        var htmllistdata = '';

        if (shapearr.length > 0) {
            for (var i = 0; i < shapearr.length; i++) {
                var id = shapearr[i].id;
                var name = shapearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeshapeflt  fltshape' + id + ' searchbtnset"><b> Shape : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltfromsize && flttosize > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removefromtosize searchbtnset"><b> Size : </b><span>' + fltfromsize + '-' + flttosize + '</span> X</a>';
        }

        if (sizearr.length > 0) {
            for (var i = 0; i < sizearr.length; i++) {
                var id = sizearr[i].id;
                var name = sizearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removesizeflt  fltsize' + id + ' searchbtnset"><b> Size : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (colorarr.length > 0) {
            for (var i = 0; i < colorarr.length; i++) {
                var id = colorarr[i].id;
                var name = colorarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removecolorflt  fltcolor' + id + ' searchbtnset"><b> Color : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (clarityarr.length > 0) {
            for (var i = 0; i < clarityarr.length; i++) {
                var id = clarityarr[i].id;
                var name = clarityarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeclarityflt  fltclarity' + id + ' searchbtnset"><b> Clarity : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (flteyecleanarr.length > 0) {
            for (var i = 0; i < flteyecleanarr.length; i++) {
                var id = flteyecleanarr[i].id;
                var name = flteyecleanarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeeyecleanflt  flteyeclean' + id + ' searchbtnset"><b> Eye Clean : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltmilkyarr.length > 0) {
            for (var i = 0; i < fltmilkyarr.length; i++) {
                var id = fltmilkyarr[i].id;
                var name = fltmilkyarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemilkyflt  fltmilky' + id + ' searchbtnset"><b> Milky : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltblackinclusionarr.length > 0) {
            for (var i = 0; i < fltblackinclusionarr.length; i++) {
                var id = fltblackinclusionarr[i].id;
                var name = fltblackinclusionarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeblackinclusionflt  fltblackinclusion' + id + ' searchbtnset"><b> Black Inclusion : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltwhiteinclusionarr.length > 0) {
            for (var i = 0; i < fltwhiteinclusionarr.length; i++) {
                var id = fltwhiteinclusionarr[i].id;
                var name = fltwhiteinclusionarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removewhiteinclusionflt  fltwhiteinclusion' + id + ' searchbtnset"><b> White Inclusion : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltopeninclusionarr.length > 0) {
            for (var i = 0; i < fltopeninclusionarr.length; i++) {
                var id = fltopeninclusionarr[i].id;
                var name = fltopeninclusionarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeopeninclusionflt  fltopeninclusion' + id + ' searchbtnset"><b> Open Inclusion : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltshadearr.length > 0) {
            for (var i = 0; i < fltshadearr.length; i++) {
                var id = fltshadearr[i].id;
                var name = fltshadearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeshadeflt  fltshade' + id + ' searchbtnset"><b> Shade : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltcutarr.length > 0) {
            for (var i = 0; i < fltcutarr.length; i++) {
                var id = fltcutarr[i].id;
                var name = fltcutarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removecutflt  fltcut' + id + ' searchbtnset"><b> Cut : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltpolisharr.length > 0) {
            for (var i = 0; i < fltpolisharr.length; i++) {
                var id = fltpolisharr[i].id;
                var name = fltpolisharr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removepolishflt  fltpolish' + id + ' searchbtnset"><b> Polish : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltsymmetryarr.length > 0) {
            for (var i = 0; i < fltsymmetryarr.length; i++) {
                var id = fltsymmetryarr[i].id;
                var name = fltsymmetryarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removesymmetryflt  fltsymmetry' + id + ' searchbtnset"><b> Symmetry : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (intensityarr.length > 0) {
            for (var i = 0; i < intensityarr.length; i++) {
                var id = intensityarr[i].id;
                var name = intensityarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeintensityflt  fltintensity' + id + ' searchbtnset"><b> Intensity : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltfluorescencecolorarr.length > 0) {
            for (var i = 0; i < fltfluorescencecolorarr.length; i++) {
                var id = fltfluorescencecolorarr[i].id;
                var name = fltfluorescencecolorarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removefluorescencecolorflt  fltfluorescencecolor' + id + ' searchbtnset"><b> Color : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (labarr.length > 0) {
            for (var i = 0; i < labarr.length; i++) {
                var id = labarr[i].id;
                var name = labarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removelabflt  fltlab' + id + ' searchbtnset"><b> Grading Report : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltlocationarr.length > 0) {
            for (var i = 0; i < fltlocationarr.length; i++) {
                var id = fltlocationarr[i].id;
                var name = fltlocationarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removelocationflt  fltlocation' + id + ' searchbtnset"><b> Location : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltroughsourcearr.length > 0) {
            for (var i = 0; i < fltroughsourcearr.length; i++) {
                var id = fltroughsourcearr[i].id;
                var name = fltroughsourcearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeroughsourceflt  fltroughsource' + id + ' searchbtnset"><b> Rough Source : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }
        if ($('#s_Mediaphoto').prop('checked') == true) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '"  class="btn removMediaphotoflt  fltMediaphoto m-1 searchbtnset"><span>With Photo</span> <span class="btn-remove-tag">X</span></a>';
        }
        if ($('#s_MediaReport').prop('checked') == true) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '"  class="btn removeMediaReportflt  fltMediaReport m-1 searchbtnset"><span>With Report</span> <span class="btn-remove-tag">X</span></a>';
        }
        if ($('#s_Mediavideo').prop('checked') == true) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '"  class="btn removeMediavideoflt  fltMediavideo m-1 searchbtnset"><span>With Video</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (treatmentarr.length > 0) {
            for (var i = 0; i < treatmentarr.length; i++) {
                var id = treatmentarr[i].id;
                var name = treatmentarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removetreatmentflt  flttreatment' + id + ' searchbtnset"><b> Treatment : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }
        if (keytosymbolarr.length > 0) {
            for (var i = 0; i < keytosymbolarr.length; i++) {
                var id = keytosymbolarr[i].id;
                var name = keytosymbolarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removekeytosymbolflt  fltkeytosymbol' + id + ' searchbtnset"><b> Key to Symbol : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (brandarr.length > 0) {
            for (var i = 0; i < brandarr.length; i++) {
                var id = brandarr[i].id;
                var name = brandarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removebrandflt  fltbrand' + id + ' searchbtnset"><b> Brand : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltcompanycodearr.length > 0) {
            for (var i = 0; i < fltcompanycodearr.length; i++) {
                var id = fltcompanycodearr[i].id;
                var name = fltcompanycodearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removecompanycodeflt  fltcompanycode' + id + ' searchbtnset"><b> Company Code : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltstocknumbersarr.length > 0) {
            for (var i = 0; i < fltstocknumbersarr.length; i++) {
                var id = fltstocknumbersarr[i].id;
                var name = fltstocknumbersarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1  removestocknumbersflt  fltstocknumbers' + id + ' searchbtnset"><b> Stock Numbers : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltsavanilotnumberarr.length > 0) {
            for (var i = 0; i < fltsavanilotnumberarr.length; i++) {
                var id = fltsavanilotnumberarr[i].id;
                var name = fltsavanilotnumberarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removesavanilotnumberflt  fltsavanilotnumber' + id + ' searchbtnset"><b> Savani Lot Number : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltfromprice && flttoprice > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removefromtoprice m-1 searchbtnset"><b> Price : </b><span>$' + fltfromprice + '-$' + flttoprice + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfromdepthper && flttodepthper > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removefromtodepthper m-1 searchbtnset"><b> Depth(%) : </b><span>' + fltfromdepthper + '%-' + flttodepthper + '%</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfromtableper && flttotableper > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removefromtotableper m-1 searchbtnset"><b> Table(%) : </b><span>' + fltfromtableper + '%-' + flttotableper + '%</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfromlength && flttolength > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removefromtolength m-1 searchbtnset"><b> Length : </b><span>' + fltfromlength + '-' + flttolength + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfromwidth && flttowidth > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removewidth m-1  searchbtnset"><b> Width : </b><span>' + fltfromwidth + '-' + flttowidth + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfromdepth && flttodepth > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removedepth m-1 searchbtnset"><b> Depth : </b><span>' + fltfromdepth + '-' + flttodepth + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltlabreportnumber) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removelabreportnumber  m-1 searchbtnset"><b> Lab Report Number : </b><span>' + fltlabreportnumber + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        $('.searchdiamondlistDiv').html(htmllistdata);
    }

    /* REMOVE SEARCH FILTERS */
    $('body').on('click', '.removeshapeflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltshape' + id + '').remove();
        $('#f' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(shapearr, id);
        $("#s_fltshapeid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefromtosize', function() {
        var type = $(this).attr('data-type');
        $('#fltfromsize').val(0);
        $('#flttosize').val(0);
        $('#s_fltfromsize').val(0);
        $('#s_flttosize').val(0);
        $(this).remove();
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removesizeflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltsize' + id + '').remove();
        $('#f' + id + '').prop('checked', false);
        $('#s_fltsizeid' + id + '').prop('checked', false);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removecolorflt', function() {

        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltcolor' + id + '').remove();
        $('#c' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(colorarr, id);
        $("#s_fltcolorid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removeclarityflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltclarity' + id + '').remove();
        $('#c' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(clarityarr, id);
        $("#s_fltclarityid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

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

    $('body').on('click', '.removeeyecleanflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(flteyecleanarr, id);
        $('.flteyeclean' + id + '').remove();
        $("#flteyecleanid").val(arrid).trigger('change');
        $("#s_flteyecleanid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removemilkyflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltmilkyarr, id);
        $('.fltmilky' + id + '').remove();
        $("#fltmilkyid").val(arrid).trigger('change');
        $("#s_fltmilkyid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removeblackinclusionflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltblackinclusionarr, id);
        $('.fltblackinclusion' + id + '').remove();
        $("#fltblackinclusionid").val(arrid).trigger('change');
        $("#s_fltblackinclusionid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });
    $('body').on('click', '.removewhiteinclusionflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltwhiteinclusionarr, id);
        $('.fltwhiteinclusion' + id + '').remove();
        $("#fltwhiteinclusionid").val(arrid).trigger('change');
        $("#s_fltwhiteinclusionid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });
    $('body').on('click', '.removeopeninclusionflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltopeninclusionarr, id);
        $('.fltopeninclusion' + id + '').remove();
        $("#fltopeninclusionid").val(arrid).trigger('change');
        $("#s_fltopeninclusionid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removeshadeflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltshadearr, id);
        $('.fltshade' + id + '').remove();
        $("#fltshadeid").val(arrid).trigger('change');
        $("#s_fltshadeid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removecutflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltcutarr, id);
        $('.fltcut' + id + '').remove();
        $("#fltcutid").val(arrid).trigger('change');
        $("#s_fltcutid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removepolishflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltpolisharr, id);
        $('.fltpolish' + id + '').remove();
        $("#fltpolishid").val(arrid).trigger('change');
        $("#s_fltpolishid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removesymmetryflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltsymmetryarr, id);
        $('.fltsymmetry' + id + '').remove();
        $("#fltsymmetryid").val(arrid).trigger('change');
        $("#s_fltsymmetryid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removeintensityflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltintensity' + id + '').remove();
        $('#c' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(intensityarr, id);
        $("#s_fltintensityid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefluorescencecolorflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltfluorescencecolorarr, id);
        $('.fltfluorescencecolor' + id + '').remove();
        $("#fltfluorescencecolorid").val(arrid).trigger('change');
        $("#s_fltfluorescencecolorid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removelabflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        //console.log(type);
        removeindexfromarr(labarr,id);
        $('.fltlab' + id + '').remove();
        $('#c' + id + '').prop('checked', false);
        $('#s_fltlabid' + id + '').prop('checked', false);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });
    $('body').on('click', '.removelocationflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltlocationarr, id);
        $('.fltlocation' + id + '').remove();
        $("#form-diamond-search #fltlocationid").val(arrid).trigger('change');
        $("#s_fltlocationid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removeroughsourceflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltroughsourcearr, id);
        $('.fltroughsource' + id + '').remove();
        $("#fltroughsourceid").val(arrid).trigger('change');
        $("#s_fltroughsourceid").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removMediaphotoflt', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#Mediaphoto').prop('checked', false);
        $('#s_Mediaphoto').prop('checked', false);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removeMediaReportflt', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#MediaReport').prop('checked', false);
        $('#s_MediaReport').prop('checked', false);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removeMediavideoflt', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#Mediavideo').prop('checked', false);
        $('#s_Mediavideo').prop('checked', false);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });



    $('body').on('click', '.removetreatmentflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.flttreatment' + id + '').remove();
        $('#flttreatment' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(treatmentarr, id);
        $("#s_flttreatment").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removekeytosymbolflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltkeytosymbol' + id + '').remove();
        $('#fltkeytosymbols' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(keytosymbolarr, id);
        $("#s_fltkeytosymbols").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removebrandflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltbrand' + id + '').remove();
        $('#fltbrand' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(brandarr, id);
        $("#s_fltbrand").val(arrid).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removecompanycodeflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltcompanycode' + id + '').remove();
        $('#fltcompanycode').val('');
        $('#s_fltcompanycode').val('');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removestocknumbersflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltstocknumbers' + id + '').remove();
        $('#fltstocknumbers').val('');
        $('#s_fltstocknumbers').val('');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removesavanilotnumberflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltsavanilotnumber' + id + '').remove();
        $('#fltlotnumbers').val('');
        $('#s_fltlotnumbers').val('');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefromtoprice', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltfromprice').val(0);
        $('#flttoprice').val(0);
        $('#s_fltfromprice').val(0);
        $('#s_flttoprice').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefromtodepthper', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltfromdepthper').val(0);
        $('#flttodepthper').val(0);
        $('#s_fltfromdepthper').val(0);
        $('#s_flttodepthper').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefromtotableper', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltfromtableper').val(0);
        $('#flttotableper').val(0);
        $('#s_fltfromtableper').val(0);
        $('#s_flttotableper').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefromtolength', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltfromlength').val(0);
        $('#flttolength').val(0);
        $('#s_fltfromlength').val(0);
        $('#s_flttolength').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removewidth', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltfromwidth').val(0);
        $('#flttowidth').val(0);
        $('#s_fltfromwidth').val(0);
        $('#s_flttowidth').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removedepth', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltfromdepth').val(0);
        $('#flttodepth').val(0);
        $('#s_fltfromdepth').val(0);
        $('#s_flttodepth').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removelabreportnumber', function() {
        $(this).remove();
        $('#fltlabreportnumber').val('');
        $('#s_fltlabreportnumber').val('');
        // getfiltersvalue();
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });



    /* CHECK SIDE BAR FILTERS */

    function checksidediamondformelementvalue() {
        var issearchbtn = 0;
        $('#form-diamond-side-search input[type=checkbox]').each(function() {
            if (this.checked) {
                issearchbtn++;
                return false;
            }
        });
        var fltfromsize = $('#form-diamond-side-search #s_fltfromsize').val();
        var flttosize = $('#form-diamond-side-search #s_flttosize').val();
        if (fltfromsize>0 && flttosize>0) {
            issearchbtn++;
        }
        // console.log('size'+issearchbtn);

        var flteyecleanid = $('#form-diamond-side-search #s_flteyecleanid').val();
        if (flteyecleanid.length > 0) {
            issearchbtn++;
        }
        var s_fltshapeid = $('#form-diamond-side-search #s_fltshapeid').val();
        if (s_fltshapeid.length > 0) {
            issearchbtn++;
        }
        var s_fltcolorid = $('#form-diamond-side-search #s_fltcolorid').val();
        if (s_fltcolorid.length > 0) {
            issearchbtn++;
        }
        var s_fltclarityid = $('#form-diamond-side-search #s_fltclarityid').val();
        if (s_fltclarityid.length > 0) {
            issearchbtn++;
        }

        var s_flttreatment = $('#form-diamond-side-search #s_flttreatment').val();
        if (s_flttreatment.length > 0) {
            issearchbtn++;
        }
        var s_fltbrand = $('#form-diamond-side-search #s_fltbrand').val();
        if (s_fltbrand.length > 0) {
            issearchbtn++;
        }
        var s_fltbrand = $('#form-diamond-side-search #s_fltbrand').val();
        if (s_fltbrand.length > 0) {
            issearchbtn++;
        }

        var fltmilkyid = $('#form-diamond-side-search #s_fltmilkyid').val();
        if (fltmilkyid.length > 0) {
            issearchbtn++;
        }

        var fltopeninclusionid = $('#form-diamond-side-search #s_fltopeninclusionid').val();
        if (fltopeninclusionid.length > 0) {
            issearchbtn++;
        }

        var fltwhiteinclusionid = $('#form-diamond-side-search #s_fltwhiteinclusionid').val();
        if (fltwhiteinclusionid.length > 0) {
            issearchbtn++;
        }
        var fltblackinclusionid = $('#form-diamond-side-search #s_fltblackinclusionid').val();
        if (fltblackinclusionid.length > 0) {
            issearchbtn++;
        }

        var fltshadeid = $('#form-diamond-side-search #s_fltshadeid').val();
        if (fltshadeid.length > 0) {
            issearchbtn++;
        }
        var fltcutid = $('#form-diamond-side-search #s_fltcutid').val();
        if (fltcutid.length > 0) {
            issearchbtn++;
        }
        var fltpolishid = $('#form-diamond-side-search #s_fltpolishid').val();
        if (fltpolishid.length > 0) {
            issearchbtn++;
        }
        var fltsymmetryid = $('#form-diamond-side-search #s_fltsymmetryid').val();
        if (fltsymmetryid.length > 0) {
            issearchbtn++;
        }
        var fltintensityid = $('#form-diamond-side-search #s_fltintensityid').val();
        if (fltintensityid.length > 0) {
            issearchbtn++;
        }
        var fltfluorescencecolorid = $('#form-diamond-side-search #s_fltfluorescencecolorid').val();
        if (fltfluorescencecolorid.length > 0) {
            issearchbtn++;
        }
        var fltkeytosymbolsid = $('#form-diamond-side-search #s_fltkeytosymbols').val();
        if (fltkeytosymbolsid.length > 0) {
            issearchbtn++;
        }


        var fltlocationid = $('#form-diamond-side-search #s_fltlocationid').val();
        if (fltlocationid.length > 0) {
            issearchbtn++;
        }
        var fltroughsourceid = $('#form-diamond-side-search #s_fltroughsourceid').val();
        if (fltroughsourceid.length > 0) {
            issearchbtn++;
        }

        var fltcompanycode = $('#form-diamond-side-search #s_fltcompanycode').val();
        if (fltcompanycode) {
            issearchbtn++;
        }
        var fltstocknumbers = $('#form-diamond-side-search #s_fltstocknumbers').val();
        if (fltstocknumbers) {
            issearchbtn++;
        }
        var fltsavanilotnumber = $('#form-diamond-side-search #s_fltlotnumbers').val();
        if (fltsavanilotnumber) {
            issearchbtn++;
        }
        // var fltlotnumbers = $('#form-diamond-side-search #s_fltlotnumbers').val();
        // if (fltlotnumbers) {
        //     issearchbtn++;
        // }

        var fltfromprice = $('#form-diamond-side-search #s_fltfromprice').val();
        var flttoprice = $('#form-diamond-side-search #s_flttoprice').val();
        if (fltfromprice > 0 && flttoprice > 0) {
            issearchbtn++;
        }
        var fltfromdepthper = $('#form-diamond-side-search #s_fltfromdepthper').val();
        var flttodepthper = $('#form-diamond-side-search #s_flttodepthper').val();
        if (fltfromdepthper > 0 && flttodepthper > 0) {
            issearchbtn++;
        }

        var fltfromtableper = $('#form-diamond-side-search #s_fltfromtableper').val();
        var flttotableper = $('#form-diamond-side-search #s_flttotableper').val();
        if (fltfromtableper > 0 && flttotableper > 0) {
            issearchbtn++;
        }

        var fltfromlength = $('#form-diamond-side-search #s_fltfromlength').val();
        var flttolength = $('#form-diamond-side-search #s_flttolength').val();
        if (fltfromlength > 0 && flttolength > 0) {
            issearchbtn++;
        }

        var fltfromwidth = $('#form-diamond-side-search #s_fltfromwidth').val();
        var flttowidth = $('#form-diamond-side-search #s_flttowidth').val();
        if (fltfromwidth > 0 && flttowidth > 0) {
            issearchbtn++;
        }

        var fltfromdepth = $('#form-diamond-side-search #s_fltfromdepth').val();
        var flttodepth = $('#form-diamond-side-search #s_flttodepth').val();
        if (fltfromdepth > 0 && flttodepth > 0) {
            issearchbtn++;
        }
        var fltlabreportnumber = $('#form-diamond-side-search #s_fltlabreportnumber').val();
        if (fltlabreportnumber) {
            issearchbtn++;
        }

        $('#form-diamond-side-search #btnapplydiamondfilter').attr('disabled', true);
        if (issearchbtn > 0) {
            $('#form-diamond-side-search #btnapplydiamondfilter').attr('disabled', false);
        }
        // console.log(issearchbtn);
        return issearchbtn;

    }

    /* GET SIDEBAR FILTERS */
    function getsidebarelementvalue() {
        shapearr = [];
        shapeidarr = [];
        var fltshapeid = $('#s_fltshapeid').val();
        if (fltshapeid.length > 0) {
            for (var i = 0; i < fltshapeid.length; i++) {
                var shapeid = $('#s_fltshapeid option[value=' + fltshapeid[i] + ']').val();
                var shape = $('#s_fltshapeid option[value=' + fltshapeid[i] + ']').text();
                shapearr.push({
                    'id': shapeid,
                    'name': shape
                });
                shapeidarr.push(shapeid);
            }
        }

        fltfromsize = $('#s_fltfromsize').val();
        flttosize = $('#s_flttosize').val();

        sizearr = [];
        $('#s_sizeDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                sizearr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
            }
        });

        colorarr = [];
        coloridarr = [];
        var fltcolorid = $('#s_fltcolorid').val();
        if (fltcolorid.length > 0) {
            for (var i = 0; i < fltcolorid.length; i++) {
                var colorid = $('#s_fltcolorid option[value=' + fltcolorid[i] + ']').val();
                var color = $('#s_fltcolorid option[value=' + fltcolorid[i] + ']').text();
                colorarr.push({
                    'id': colorid,
                    'name': color
                });
                coloridarr.push(colorid);
            }
        }

        clarityarr = [];
        clarityidarr = [];
        var fltclarityid = $('#s_fltclarityid').val();
        if (fltclarityid.length > 0) {
            for (var i = 0; i < fltclarityid.length; i++) {
                var clarityid = $('#s_fltclarityid option[value=' + fltclarityid[i] + ']').val();
                var clarity = $('#s_fltclarityid option[value=' + fltclarityid[i] + ']').text();
                clarityarr.push({
                    'id': clarityid,
                    'name': clarity
                });
                clarityidarr.push(clarityid);
            }
        }

        flteyecleanarr = [];
        flteyecleanidarr = [];
        var flteyecleanid = $('#s_flteyecleanid').val();
        if (flteyecleanid.length > 0) {
            for (var i = 0; i < flteyecleanid.length; i++) {
                var eyecleanid = $('#s_flteyecleanid option[value=' + flteyecleanid[i] + ']').val();
                var eyeclean = $('#s_flteyecleanid option[value=' + flteyecleanid[i] + ']').text();
                flteyecleanarr.push({
                    'id': eyecleanid,
                    'name': eyeclean
                });
                flteyecleanidarr.push(eyecleanid);
            }
        }

        fltmilkyarr = [];
        fltmilkyidarr = [];
        var fltmilkyid = $('#s_fltmilkyid').val();
        if (fltmilkyid.length > 0) {
            for (var i = 0; i < fltmilkyid.length; i++) {
                var milkyid = $('#s_fltmilkyid option[value=' + fltmilkyid[i] + ']').val();
                var milky = $('#s_fltmilkyid option[value=' + fltmilkyid[i] + ']').text();
                fltmilkyarr.push({
                    'id': milkyid,
                    'name': milky
                });
                fltmilkyidarr.push(milkyid);
            }
        }

        fltblackinclusionarr = [];
        fltblackinclusionidarr = [];
        var fltblackinclusionid = $('#s_fltblackinclusionid').val();
        if (fltblackinclusionid.length > 0) {
            for (var i = 0; i < fltblackinclusionid.length; i++) {
                var blackinclusionid = $('#s_fltblackinclusionid option[value=' + fltblackinclusionid[i] + ']').val();
                var blackinclusion = $('#s_fltblackinclusionid option[value=' + fltblackinclusionid[i] + ']').text();
                fltblackinclusionarr.push({
                    'id': blackinclusionid,
                    'name': blackinclusion
                });
                fltblackinclusionidarr.push(blackinclusionid);
            }
        }

        fltwhiteinclusionarr = [];
        fltwhiteinclusionidarr = [];
        var fltwhiteinclusionid = $('#s_fltwhiteinclusionid').val();
        if (fltwhiteinclusionid.length > 0) {
            for (var i = 0; i < fltwhiteinclusionid.length; i++) {
                var whiteinclusionid = $('#s_fltwhiteinclusionid option[value=' + fltwhiteinclusionid[i] + ']').val();
                var whiteinclusion = $('#s_fltwhiteinclusionid option[value=' + fltwhiteinclusionid[i] + ']').text();
                fltwhiteinclusionarr.push({
                    'id': whiteinclusionid,
                    'name': whiteinclusion
                });
                fltwhiteinclusionidarr.push(whiteinclusionid);
            }
        }

        fltopeninclusionarr = [];
        fltopeninclusionidarr = [];

        var fltopeninclusionid = $('#s_fltopeninclusionid').val();
        if (fltopeninclusionid.length > 0) {
            for (var i = 0; i < fltopeninclusionid.length; i++) {
                var openinclusionid = $('#s_fltopeninclusionid option[value=' + fltopeninclusionid[i] + ']').val();
                var openinclusion = $('#s_fltopeninclusionid option[value=' + fltopeninclusionid[i] + ']').text();
                fltopeninclusionarr.push({
                    'id': openinclusionid,
                    'name': openinclusion
                });
                fltopeninclusionidarr.push(openinclusionid);
            }
        }

        fltshadearr = [];
        fltshadeidarr = [];

        var fltshadeid = $('#s_fltshadeid').val();
        if (fltshadeid.length > 0) {
            for (var i = 0; i < fltshadeid.length; i++) {
                var shadeid = $('#s_fltshadeid option[value=' + fltshadeid[i] + ']').val();
                var shade = $('#s_fltshadeid option[value=' + fltshadeid[i] + ']').text();
                fltshadearr.push({
                    'id': shadeid,
                    'name': shade
                });
                fltshadeidarr.push(shadeid);
            }
        }

        fltcutarr = [];
        fltcutidarr = [];

        var fltcutid = $('#s_fltcutid').val();
        if (fltcutid.length > 0) {
            for (var i = 0; i < fltcutid.length; i++) {
                var cutid = $('#s_fltcutid option[value=' + fltcutid[i] + ']').val();
                var cut = $('#s_fltcutid option[value=' + fltcutid[i] + ']').text();
                fltcutarr.push({
                    'id': cutid,
                    'name': cut
                });
                fltcutidarr.push(cutid);
            }
        }

        fltpolisharr = [];
        fltpolishidarr = [];

        var fltpolishid = $('#s_fltpolishid').val();
        if (fltpolishid.length > 0) {
            for (var i = 0; i < fltpolishid.length; i++) {
                var polishid = $('#s_fltpolishid option[value=' + fltpolishid[i] + ']').val();
                var polish = $('#s_fltpolishid option[value=' + fltpolishid[i] + ']').text();
                fltpolisharr.push({
                    'id': polishid,
                    'name': polish
                });
                fltpolishidarr.push(polishid);
            }
        }

        fltsymmetryarr = [];
        fltsymmetryidarr = [];

        var fltsymmetryid = $('#s_fltsymmetryid').val();
        if (fltsymmetryid.length > 0) {
            for (var i = 0; i < fltsymmetryid.length; i++) {
                var symmetryid = $('#s_fltsymmetryid option[value=' + fltsymmetryid[i] + ']').val();
                var symmetry = $('#s_fltsymmetryid option[value=' + fltsymmetryid[i] + ']').text();
                fltsymmetryarr.push({
                    'id': symmetryid,
                    'name': symmetry
                });
                fltsymmetryidarr.push(symmetryid);
            }
        }

        intensityarr = [];
        intensityidarr = [];

        var fltintensityid = $('#s_fltintensityid').val();
        if (fltintensityid.length > 0) {
            for (var i = 0; i < fltintensityid.length; i++) {
                var intensityid = $('#s_fltintensityid option[value=' + fltintensityid[i] + ']').val();
                var intensity = $('#s_fltintensityid option[value=' + fltintensityid[i] + ']').text();
                intensityarr.push({
                    'id': intensityid,
                    'name': intensity
                });
                intensityidarr.push(intensityid);
            }
        }

        fltfluorescencecolorarr = [];
        fltfluorescencecoloridarr = [];

        var fltfluorescencecolorid = $('#s_fltfluorescencecolorid').val();
        if (fltfluorescencecolorid.length > 0) {
            for (var i = 0; i < fltfluorescencecolorid.length; i++) {
                var fluorescencecolorid = $('#s_fltfluorescencecolorid option[value=' + fltfluorescencecolorid[i] + ']').val();
                var fluorescencecolor = $('#s_fltfluorescencecolorid option[value=' + fltfluorescencecolorid[i] + ']').text();
                fltfluorescencecolorarr.push({
                    'id': fluorescencecolorid,
                    'name': fluorescencecolor
                });
                fltfluorescencecoloridarr.push(fluorescencecolorid);
            }
        }

        labarr = [];
        $('#s_labDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                labarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
            }
        });

        console.log(labarr);
        fltlocationarr = [];
        fltlocationidarr = [];

        var fltlocationid = $('#s_fltlocationid').val();
        if (fltlocationid.length > 0) {
            for (var i = 0; i < fltlocationid.length; i++) {
                var locationid = $('#s_fltlocationid option[value=' + fltlocationid[i] + ']').val();
                var location = $('#s_fltlocationid option[value=' + fltlocationid[i] + ']').text();
                fltlocationarr.push({
                    'id': locationid,
                    'name': location
                });
                fltlocationidarr.push(locationid);
            }
        }

        fltroughsourcearr = [];
        fltroughsourceidarr = [];

        var fltroughsourceid = $('#s_fltroughsourceid').val();
        if (fltroughsourceid.length > 0) {
            for (var i = 0; i < fltroughsourceid.length; i++) {
                var roughsourceid = $('#s_fltroughsourceid option[value=' + fltroughsourceid[i] + ']').val();
                var roughsource = $('#s_fltroughsourceid option[value=' + fltroughsourceid[i] + ']').text();
                fltroughsourcearr.push({
                    'id': roughsourceid,
                    'name': roughsource
                });
                fltroughsourceidarr.push(roughsourceid);
            }
        }


        mediaarr = [];
        $('#s_mediaDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                mediaarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
            }
        });

        treatmentarr = [];
        treatmentidarr = [];

        var flttreatmentid = $('#s_flttreatment').val();
        if (flttreatmentid.length > 0) {
            for (var i = 0; i < flttreatmentid.length; i++) {
                var treatmentid = $('#s_flttreatment option[value=' + flttreatmentid[i] + ']').val();
                var treatment = $('#s_flttreatment option[value=' + flttreatmentid[i] + ']').text();
                treatmentarr.push({
                    'id': treatmentid,
                    'name': treatment
                });
                treatmentidarr.push(treatmentid);
            }
        }

        keytosymbolarr = [];
        keytosymbolidarr = [];

        var fltkeytosymbolsid = $('#s_fltkeytosymbols').val();
        if (fltkeytosymbolsid.length > 0) {
            for (var i = 0; i < fltkeytosymbolsid.length; i++) {
                var keytosymbolsid = $('#s_fltkeytosymbols option[value=' + fltkeytosymbolsid[i] + ']').val();
                var keytosymbols = $('#s_fltkeytosymbols option[value=' + fltkeytosymbolsid[i] + ']').text();
                keytosymbolarr.push({
                    'id': keytosymbolsid,
                    'name': keytosymbols
                });
                keytosymbolidarr.push(keytosymbolsid);
            }
        }

        brandarr = [];
        brandidarr = [];

        var fltbrandid = $('#s_fltbrand').val();
        if (fltbrandid.length > 0) {
            for (var i = 0; i < fltbrandid.length; i++) {
                var brandid = $('#s_fltbrand option[value=' + fltbrandid[i] + ']').val();
                var brand = $('#s_fltbrand option[value=' + fltbrandid[i] + ']').text();
                brandarr.push({
                    'id': brandid,
                    'name': brand
                });
                brandidarr.push(brandid);
            }
        }

        fltcompanycodearr = [];
        var fltcompanycode = $('#s_fltcompanycode').val();
        var fltcompanycodename = $('#s_fltcompanycode option:selected').text();
        if (fltcompanycode) {
            fltcompanycodearr.push({
                'id': fltcompanycode,
                'name': fltcompanycodename
            });
        }
        // //console.log(fltcompanycodearr);

        fltstocknumbersarr = [];
        var fltstocknumbers = $('#s_fltstocknumbers').val();
        var fltstocknumbersname = $('#s_fltstocknumbers option:selected').text();
        if (fltstocknumbers) {
            fltstocknumbersarr.push({
                'id': fltstocknumbers,
                'name': fltstocknumbersname
            });
        }
        // //console.log(fltstocknumbersarr);

        fltsavanilotnumberarr = [];
        var fltsavanilotnumber = $('#s_fltlotnumbers').val();
        var fltsavanilotnumbername = $('#s_fltlotnumbers option:selected').text();
        if (fltsavanilotnumber) {
            fltsavanilotnumberarr.push({
                'id': fltsavanilotnumber,
                'name': fltsavanilotnumbername
            });
        }
        // //console.log(fltsavanilotnumberarr);

        fltfromprice = $('#s_fltfromprice').val();
        flttoprice = $('#s_flttoprice').val();
        fltfromdepthper = $('#s_fltfromdepthper').val();
        flttodepthper = $('#s_flttodepthper').val();
        fltfromtableper = $('#s_fltfromtableper').val();
        flttotableper = $('#s_flttotableper').val();
        fltfromlength = $('#s_fltfromlength').val();
        flttolength = $('#s_flttolength').val();
        fltfromwidth = $('#s_fltfromwidth').val();
        flttowidth = $('#s_flttowidth').val();
        fltfromdepth = $('#s_fltfromdepth').val();
        flttodepth = $('#s_flttodepth').val();
        fltlabreportnumber = $('#s_fltlabreportnumber').val();
    }

    /* APPLY SIDE BAR FILTERS */
    $('body').on('change', '#form-diamond-side-search input[type=checkbox]', function() {
        // if ($('#s_nobgm').is(":checked")) {
        //     listshade();
        // }
        getsidebarelementvalue();
        checksidediamondformelementvalue();
       
    });

    $('body').on('input', '#form-diamond-side-search #s_fltfromsize,#s_flttosize,#s_fltfromprice,#s_flttoprice,#s_fltfromdepthper,#s_flttodepthper,#s_fltfromtableper,#s_flttotableper,#s_fltfromlength,#s_flttolength,#s_fltfromwidth,#s_flttowidth,#s_fltfromdepth,#s_flttodepth,#s_fltlabreportnumber', function() {
        getsidebarelementvalue();
        checksidediamondformelementvalue();
    });



    $('body').on('change', '#form-diamond-side-search .select2', function() {
        getsidebarelementvalue();
        checksidediamondformelementvalue();
    });


    $('body').on('change', '#form-diamond-side-search #s_fltcompanycode,#s_fltstocknumbers,#s_fltlotnumbers', function() {
        getsidebarelementvalue();
        checksidediamondformelementvalue();
    });

    if ($('#form-diamond-side-search').length) {
        $('#form-diamond-side-search').validate({
            rules: {
                fltfromsize: {
                    number: true
                },
                flttosize: {
                    greaterThan: '#s_fltfromsize',
                    number: true
                },
                fltfromprice: {
                    number: true
                },
                flttoprice: {
                    greaterThan: '#s_fltfromprice',
                    number: true
                },
                fltfromdepthper: {
                    number: true
                },
                flttodepthper: {
                    greaterThan: '#s_fltfromdepthper',
                    number: true
                },
                fltfromtableper: {
                    number: true
                },
                flttotableper: {
                    greaterThan: '#s_fltfromtableper',
                    number: true
                },
                fltfromlength: {
                    number: true
                },
                flttolength: {
                    greaterThan: '#s_fltfromlength',
                    number: true
                },
                fltfromwidth: {
                    number: true
                },
                flttowidth: {
                    greaterThan: '#s_fltfromwidth',
                    number: true
                },
                fltfromdepth: {
                    number: true
                },
                flttodepth: {
                    greaterThan: '#s_fltfromdepth',
                    number: true
                },
            },
            messages: {
                flttosize: {
                    greaterThan: 'To size greater than or equal From size',
                },
                flttoprice: {
                    greaterThan: 'To price greater than or equal From price',
                },
                flttodepthper: {
                    greaterThan: 'To depth(%) greater than or equal From depth(%)',
                },
                flttotableper: {
                    greaterThan: 'To table(%) greater than or equal From table(%)',
                },
                flttolength: {
                    greaterThan: 'To length greater than or equal From length',
                },
                flttowidth: {
                    greaterThan: 'To width greater than or equal From width',
                },
                flttodepth: {
                    greaterThan: 'To depth greater than or equal From depth',
                },
            },
            submitHandler: function(form) {

                var issearchbtn = checksidediamondformelementvalue();
                if (issearchbtn > 0) {
                    fillsearchdiamondlist(2);
                    $('#listdiamondDatatbl').attr('data-nextpage', 0);
                    listdiamonddata(1, 'form-diamond-side-search');
                    $(".wrappernew.toggled").toggleClass("intro");
                } else {
                    alertify('Please select at least one filter', 0);
                }


            },
        });
    }

    /* 
    $('#nobgm').on('change', function() {
        listshade();
        getfiltersvalue();
    });
    $('#isflexibledelivery').on('change', function() {
        listlocation();
        
    });
     */

</script>


</html>