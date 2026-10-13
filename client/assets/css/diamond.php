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
    <link rel="icon" type="image/x-icon" href="<?php echo $config->getImageurl(); ?>images/gems.png" />
    <!-- Meta Tag End -->

    <!--title-->
    <title><?php echo $res[0]['title']; ?></title>

    <!-- CSS Start -->
    <?php include('css.php'); ?>


    <!-- CSS End -->
    <script src="assets/js/vendor/jquery.min.js"></script>
</head>

<body class="light home-page all-page-sidebarset">
    <?php 
    $CheckUserRights=$DB->checkpackagewiseuserright($LoginInfo->getUid());
    // echo $CheckUserRights['IsPackageExpire']; exit;
    if($CheckUserRights['IsPackageExpire']==1){
        ?>
        <script>
            Notiflix.Report.Warning('<?php echo $config->getPackageExpiredTitle(); ?>','<?php echo $config->getPackageExpiredMessage(); ?>', false, function(){window.location='<?php echo $config->getPackageExpiredURL(); ?>';});
            $('#preloader').addClass('d-none');
            $('#ctn-preloader').addClass('loaded');
       </script>
    <?php
    exit;
    }
    // 1 - Diamond Search , 6 - List Diamonds for Sale, 3 - Share Diamonds and Jewelry, 8 - SavaniGems XL for Excel
    
    $CanDiamondSearch = $DB->getpackagewiseuserright($LoginInfo->getUid(), 1)['attributeval'];
    $CanListDiamondForList = $DB->getpackagewiseuserright($LoginInfo->getUid(), 6)['attributeval'];
    $CanShareDiamond = $DB->getpackagewiseuserright($LoginInfo->getUid(), 3)['attributeval'];
    $CanListDiamondXL = $DB->getpackagewiseuserright($LoginInfo->getUid(), 8)['attributeval'];
    $CanMemberToMemberChat = $DB->getpackagewiseuserright($LoginInfo->getUid(), 4)['attributeval'];


    $CanMembernolimitdiamond = $DB->getpackagewiseuserright($LoginInfo->getUid(), 6)['isnolimit'];
    $CanMemberlimitdiamond = $DB->getpackagewiseuserright($LoginInfo->getUid(), 6)['limitvalue'];
    $totaldiamondupload=$DB->getTotalDiamond($LoginInfo->getUid());
    if ($CanDiamondSearch != 1 && $CanListDiamondForList != 1) {
    ?>
        <script>
            window.location = '<?php echo $config->getportalbaseurl(); ?>home';
        </script>
    <?php
    }
    ?>
    <div class="page-wrapper">
        <div class="has-sidebar-left ">
            <header class="bg-white accent-3 relative nav-sticky tab-box-shadow">
                <div class="container-fluid text-white">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-4 col-xl-4 col-md-2 m-auto setnamdi">
                            <h4 class="mb-0 sec-desc header-desc text-darkgreen">
                                Diamond
                            </h4>
                        </div>
                        <div class="col-12 col-xl-7 col-lg-7 col-md-9 m-auto pt-3 setresscrd">
                            <ul class="nav responsive-tab nav-material nav-material-white pt-2" id="Diamond-pills-tab">
                                <?php
                                if ($CanDiamondSearch == 1) {
                                ?>
                                    <li>
                                        <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" >Search</a>
                                    </li>
                                <?php
                                }
                                if ($CanListDiamondForList == 1) {
                                ?>
                                    <li>
                                        <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" onclick="resetdiamonduploadform();" href="#v-pills-2">Upload Diamond</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" id="v-pills-3-tab" data-toggle="pill" onclick="listmydiamonddata(1,null,1);" href="#v-pills-3">Manage My Diamond</a>
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
                <div class="container-fluid relative animatedParent animateOnce">
                    <div class="tab-content pb-3" id="v-pills-tabContent">
                        <?php
                        if ($CanDiamondSearch == 1) {
                        ?>
                            <div class="tab-pane  show active" id="v-pills-1">
                                <div class="row row-eq-height">

                                    <!-- Chat Widget Start -->

                                    <div class="col-lg-3 col-md-4">
                                        <div class="card my-3 border-0 bg-light-gray">
                                            <div class="card-body chat-widget slimScroll p-0 diamond-search-page" data-height="100%">
                                                <nav>
                                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                        <button class="nav-link  active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true" onclick="listdiamondsearchdata()">Search</button>
                                                        <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" onclick="listdiamondparcelsearchdata()">Parcel</button>
                                                    </div>
                                                </nav>

                                                <div class="tab-content" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                        
                                                        <form action="javascript:void(0);" name="form-diamond-search" enctype="multipart/form-data" id="form-diamond-search">
                                                            <div class="loder-div">
                                                                <div class="chart-loading" style="">
                                                                    <img alt="loading-img" src="assets/img/loading.gif">
                                                                </div>
                                                            </div>
                                                            <div class="filter-box filter-diamond-box DiamondSearchDataDiv filter-box-size filterbuttonserchparcel" id="DiamondSearchData">

                                                            </div>
                                                        </form>

                                                        <div class="table-responsive listdiamondDataDiv d-none searchpagedetail">
                                                            <!-- 07-03-2023 (priyank loader code start) -->
                                                            <div class="loder-div">
                                                                <div class="chart-loading" style="">
                                                                    <img alt="loading-img" src="assets/img/loading.gif">
                                                                </div>
                                                            </div>
                                                            <!-- 07-03-2023 (priyank loader code End) -->
                                                            <div class="row searchheaddet searchdiamond-header-page">
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
                                                                            <button type="button" id="btnmodifysearch" class="btn searchbtnset"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/search.svg" alt="diamonds modify search" title="diamonds modify search"> Modify Search</button>
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
                                                                <div  class="filternew sidebar-wrapper">
                                                                    <form action="javascript:void(0);" name="form-diamond-search" enctype="multipart/form-data" id="form-diamond-side-search" novalidate="novalidate">
                                                                        <div class="fixbuyp">
                                                                            <h4>Filter</h4><button type="button" class="btn-close-sidebar" aria-label="Close">x</button>
                                                                            <div class="searchgreade searchcom">
                                                                                <button type="submit" class="btn searchbtnset" id="btnapplydiamondfilter" disabled>Apply</button>
                                                                            </div>
                                                                        </div>
                                                                        <ul class="sidebar-nav nav-pills nav-stacked setfilese" id="DiamondSideSearchData">

                                                                        </ul>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <table class="table mt-0 mb-5 table-tb set-serachbarmesurement" id="listdiamondDatatbl" data-show="0" data-nextpage="0">
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
                                                                        <th>$/ct</th>
                                                                        <th>Discount (%)</th>
                                                                        <th>Total Price</th>
                                                                        <th>Depth (%)</th>
                                                                        <th>Table (%)</th>
                                                                        <th>Measurement</th>
                                                                        <th>Stock No</th>
                                                                        <!-- <th>Status</th> -->
                                                                        <!-- <th>Media</th> -->
                                                                        <!-- <th>Ratio</th> -->
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="listdiamondData" >

                                                                </tbody>
                                                            </table>
                                                            <div class="row">
                                                                <!-- <div class="text-left col-md-5"><b>Showing <span id="showdiamondentries"></span> entries</b></div> -->
                                                                <div class="text-left col-md-5"></div>
                                                                
                                                            </div>
                                                            <div class="row paginationDiv sticky-sec searchdiamond-footer-page">
                                                                <div class="text-center col-md-4 col-lg-6 col-xl-6" id="paginationDiv"></div>
                                                                <div class="text-center col-md-4 col-lg-4 col-xl-3 offset-4 offset-lg-2 offset-xl-2"><b class="w-auto setallpageentry">entry <select class="form-control w-auto  ml-auto" id="diamond_per_page" name="diamond_per_page">
                                                                            <!-- <option value="20">20</option> -->
                                                                            <option value="50">50</option>
                                                                            <option value="100">100</option>
                                                                            <option value="500">500</option>
                                                                            <option value="1000">1000</option>
                                                                        </select> per page</b></div>
                                                            </div>
                                                        </div>

                                                    </div>




                                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                        <div class="loder-div">
                                                            <div class="chart-loading" style="">
                                                                <img alt="loading-img" src="assets/img/loading.gif">
                                                            </div>
                                                        </div>
                                                        <form action="javascript:void(0);" name="form-diamond-parcel-search" enctype="multipart/form-data" id="form-diamond-parcel-search">
                                                            <div class="filter-box filter-diamond-box filter-box-size" id="DiamondParcelSearchData">

                                                            </div>
                                                        </form>
                                                        <div class="table-responsive listdiamondparcelDataDiv d-none searchpagedetail">
                                                            <div class="row searchheaddet parceldiamond-header-page">
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
                                                                            <button type="button" id="btnmodifyparcelsearch" class="btn searchbtnset"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/search.svg" alt="diamonds modify search" title="diamonds modify search"> Modify Search</button>
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
                                                                        <ul class="sidebar-nav nav-pills nav-stacked" id="DiamondParcelSideSearchData">

                                                                        </ul>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <table class="table mt-0 mb-5 table-tb setm-bottom" id="listparceldiamondDatatbl" data-show="0" data-nextpage="0">
                                                                <thead>
                                                                    <tr class="settabledi">
                                                                        <th>Seller</th>
                                                                        <!-- <th>rating</th> -->
                                                                        <th>Lot No.</th>
                                                                        <th>Shape</th>
                                                                        <th>Type</th>
                                                                        <th>Size</th>
                                                                        <th>Avg. Color</th>
                                                                        <th>Avg. Clarity</th>
                                                                        <!-- <th>Amount</th> -->
                                                                        <th>Total Carat</th>
                                                                        <!-- <th>Cut</th>
                                                                        <th>Polish</th>
                                                                        <th>Symm</th>
                                                                        <th>Fluor.</th>
                                                                        <th>Lab</th> -->
                                                                        <!-- <th>$/ct</th>
                                                                        <th>%Savani</th> -->
                                                                        <th>$/Ct</th>
                                                                        <th>$Total</th>
                                                                        <th>PPC</th>
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
                                                            <div class="row sticky-sec parceldiamond-footer-page">
                                                                <!-- <div class="text-left col-md-5"><b>Showing <span id="showparceldiamondentries"></span> Entry</b></div> -->
                                                                <div class="text-center col-md-4 col-lg-6 col-xl-6" id="parcelpaginationDiv"></div>
                                                                <div class="text-center col-md-4 col-lg-4 col-xl-3 offset-4 offset-lg-2 offset-xl-2"><b class="w-auto setallpageentry">Show <select class="form-control w-auto  ml-auto" id="parceldiamond_per_page" name="parceldiamond_per_page">
                                                                            <!-- <option value="20">20</option> -->
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
                                    
                                    <div class="col-md-12 mt-3 text-center">
                                        <?php
                                        if($CanMemberlimitdiamond>0)
                                        {
                                            ?>
                                            <span class="text-danger "><strong>Your Diamond Upload Limit is $<?php echo $CanMemberlimitdiamond; ?></strong></span>
                                           | <span class="text-success "><strong>Total Diamond Upload is $<?php echo $totaldiamondupload; ?></strong></span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card my-3 border-0 bg-light-white">
                                            <div class="card-body chat-widget slimScroll p-0">
                                                <?php
                                                if ($CanListDiamondForList == 1) {
                                                ?>
                                                    <nav>
                                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                            <a class="nav-item nav-link active" id="nav-h-tab" data-toggle="tab" href="#nav-h" role="tab" onclick="filldocumnetupload(1);" aria-controls="nav-h" aria-selected="true">Single</a>
                                                            <?php
                                                            if ($CanListDiamondXL == 1) {
                                                            ?>
                                                                <a class="nav-item nav-link ml-2" id="nav-p-tab" data-toggle="tab" href="#nav-p" role="tab" onclick="filldocumnetupload(2);" aria-controls="nav-p" aria-selected="false">Multiple</a>
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
                                                           
                                                            <div class="showsinglehowcanihelp mt-2 d-none mr-1">
                                                                
                                                            </div>
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
                                                                                    <div class="loder-div">
                                                                                        <div class="chart-loading">
                                                                                            <img alt="loading-img" src="assets/img/loading.gif">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="multinote" id="diamondcsvuploaddetail">

                                                                                    </div>
                                                                                    <br><br>
                                                                                    <form action="javascript:void(0);" name="form-diamond-csv-upload" enctype="multipart/form-data" id="form-diamond-csv-upload" novalidate="novalidate">
                                                                                        <div class="row">
                                                                                            <div class="col-md-4 offset-4 setdowup">
                                                                                                <p>Download Excel Format : <a href="<?php echo $config->getImageurl(); ?>files/uploaddiamond.xlsx"><b>Click Here</b></a></p>
                                                                                            </div>
                                                                                            <!-- <div class="col-md-6">
                                                                                            <p class="selectedfilenameTag">Selected File Name : </a></p>                
                                                                                        </div>                         -->
                                                                                        </div>
                                                                                        <div class="showmultiplehowcanihelp mt-2 d-none mr-1">
                                                                
                                                                                        </div>
                                                                                        <div class="fileseset text-center">
                                                                                            <div class="fileico">
                                                                                                <!-- <button class="fisesearchup" onclick="importData()">Import</button> -->
                                                                                                <input class="fisesearchup" type="file" name="csvfile" id="diamondcsvfile" accept=".xls,.xlsx">
                                                                                                <i class="fal fa-file"></i>
                                                                                            </div>
                                                                                            <p>Drop File Here Or <b>Browse</b></p>
                                                                                            <p class="selectedfilenameText">No File Selected.</p>
                                                                                        </div>
                                                                                        <?php
                                                                                        $CanMembernolimitdiamond = $DB->getpackagewiseuserright($LoginInfo->getUid(), 6)['isnolimit'];
                                                                                        $CanMemberlimitdiamond = $DB->getpackagewiseuserright($LoginInfo->getUid(), 6)['limitvalue'];
                                                                                        $totaldiamondupload=$DB->getTotalDiamond($LoginInfo->getUid());
                                                                                        if($CanMembernolimitdiamond==1 || $totaldiamondupload<$CanMemberlimitdiamond)
                                                                                        {
                                                                                        ?>
                                                                                        <div class="text-center p-5 setresup">
                                                                                            <button type="submit" id="btndiamondcsvupload" disabled class="btn send-btn  adminbtndark">Upload</button>
                                                                                            <input type="reset" value="Reset" id="btnresetdiamondcsvupload" class="btn reset-btn dash-reset-btn">
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                        ?>
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
                                                    <div class="loder-div">
                                                        <div class="chart-loading" style="">
                                                            <img alt="loading-img" src="assets/img/loading.gif">
                                                        </div>
                                                    </div>
                                                    <div class="row searchheaddet mydiamond-header-page">
                                                        <div class="col-md-12 col-lg-12 col-xl-8 moredetail">
                                                            <ul>
                                                                <li><b class="totalmydiamonds"> 0 Dimonds </b>|</li>
                                                                <li>&nbsp;<b class="totalmyprice"> Total Price : $0 </b></li>
                                                                <li>&nbsp;<b class="lastupdateddt">  </b></li>
                                                                
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-12 col-lg-12 col-xl-4">
                                                            <div class="text-right searchhead">
                                                                <?php
                                                                $CanListDiamondUpdatePrice = $DB->getpackagewiseuserright($LoginInfo->getUid(), 8)['attributeval'];
                                                                if($CanListDiamondUpdatePrice==1)
                                                                {
                                                                    ?>
                                                                    <div class="searchgreade searchcom setsho">
                                                                        <button class="btn send-btn dash-serchbtn adminbtndark btndiamondupdateprice">Update Price</button>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <div class="delete-selected tbl-check d-none searchgreade searchcom setsho">
                                                                
                                                                    <a href="javascript:void(0);" class="btn btn-primary m-0 btnmultitrash trust-dataset" data-toggle="modal" ><i class="fas fa-trash"></i></a>
                                                                </div>
                                                                <div class="dropdown table-setting button-deletedeta searchgreade searchcom setsho">
                                                                    <!-- <a href="javascript:void(0);" class="btn btn-primary m-0 hidden" data-toggle="modal" ><i class="fas fa-trash"></i></a> -->
                                                                    <button class="dropdown-toggle btn btn-primary" type="button" id="tableSetting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Bulk Delete"><i class="fas fa-check-circle"></i></button>
                                                                    <div class="dropdown-menu" aria-labelledby="tableSetting">
                                                                        <a class="dropdown-item select-bulk-delete bluk-buttonset" href="javascript:void(0);"><i class="fas fa-trash"></i> Bulk Delete</a>
                                                                    </div>
                                                                </div>
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
                                                                <ul class="sidebar-nav nav-pills nav-stacked" id="MyDiamondSearchData">

                                                                </ul>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <table class="table mt-0 mb-5 table-tb" id="listmydiamondDatatbl" data-show="0" data-nextpage="0">
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
                                                                <th>$/Ct</th>
                                                                <th>Discount (%)</th>
                                                                <th>Total Price</th>
                                                                <th>Depth (%)</th>
                                                                <th>Table (%)</th>
                                                                <th>Measurement</th>
                                                                <th>Stock No</th>
                                                                <th>Is Active</th>
                                                                <!-- <th>Action</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody id="listmydiamondData">

                                                        </tbody>
                                                    </table>
                                                    <div class="row sticky-sec mydiamond-footer-page">
                                                        <!-- <div class="text-left col-md-5"><b>Showing <span id="showmydiamondentries"></span> entry</b></div> -->
                                                        <div class="text-center col-md-4 col-lg-6 col-xl-6" id="mypaginationDiv"></div>
                                                        <div class="text-center col-md-4 col-lg-4 col-xl-3 offset-4 offset-lg-2 offset-xl-2">
                                                            <b class="w-auto setallpageentry">entry
                                                                <select class="form-control w-auto  ml-auto" id="my_diamond_per_page" name="my_diamond_per_page">
                                                                    <!-- <option value="20">20</option> -->
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
            </div>
        </div>
        <?php include('footer.php'); ?>
    </div>
</body>
<?php include('js.php'); ?>
<script>

   
    $(document).ready(function() {
        $("#Diamond-pills-tab li:first-child a").click();


        var id = '<?php echo $id ?>';
        if (id) {
            listdiamonddata(1);
        }

        $('#reportdate').datepicker({
            dateFormat: 'dd/mm/yy',
        });

        listdiamondsearchdata();
        listdiamondparcelsearchdata();
        listmydiamondsearchdata();
        listuploaddiamondformdata();
        fillcontentsetting();
        filldocumnetupload(1);
        listmydiamondsortby();

    });
    $('#v-pills-1-tab').on('click',function(){
        $('#v-pills-1 #nav-tab .nav-link.active').trigger('click');
    })
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

    function listdiamondsearchdata() {
        $('.chart-loading').show();
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
        formdata.append("action", "listdiamondsearchdata");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistdiamondsearchdata, OnErrorlistdiamondsearchdata);

        function Onsuccesslistdiamondsearchdata(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#DiamondSearchData').html(resultdata.data);
            $('#DiamondSearchData .select2').select2();
            
            $('#form-diamond-search').removeClass('d-none');
            $('.listdiamondDataDiv').addClass('d-none');

            var winwidth = $(window).width(); 
            var shapeshow=$('#shapeDivData .filter-containernew .filter input').length;
            var colorshow=$('#colorDivData .filter input').length;
            var clarityshow=$('#clarityDivData .filter input').length;
            var intensityshow=$('#intensityDivData .filter input').length;
            var gradingshow=$('#labDivData .filter input').length;
            var gridleshow=$('#gridleDivData .filter input').length;
            var culetsizeshow=$('#culetsizeDivData .filter input').length;
            var culetconditionshow=$('#culetconditionDivData .filter input').length;
            $('.btnshapshowmore').addClass('d-none');
            $('.btncolorshowmore').addClass('d-none');
            $('.btnclarityshowmore').addClass('d-none');
            $('.btnintensityshowmore').addClass('d-none');
            $('.btngradingshowmore').addClass('d-none');
            $('.btngridleshowmore').addClass('d-none');
            $('.btnculetsizedownarrow').addClass('d-none');
            $('.btnculetconditionshowmore').addClass('d-none');
            $('.btnshapshowmore').removeClass('d-none');
            if(winwidth>991 && winwidth<=1500){
                if(shapeshow>7)
                {
                    $('.btnshapshowmore').removeClass('d-none');
                    // $('.shpesm').text('+MOre L');
                }
                if(colorshow>7)
                {
                    $('.btncolorshowmore').removeClass('d-none');
                }
                if(clarityshow>13)
                {
                    $('.btnclarityshowmore').removeClass('d-none');
                }
                if(intensityshow>6)
                {
                    $('.btnintensityshowmore').removeClass('d-none');
                }
                if(gradingshow>7)
                {
                    $('.btngradingshowmore').removeClass('d-none');
                }
                if(gridleshow>7)
                {
                    $('.btngridleshowmore').removeClass('d-none');
                }
                if(culetsizeshow>7)
                {
                    $('.btnculetsizeshowmore').removeClass('d-none');
                }
                if(culetconditionshow>7)
                {
                    $('.btnculetconditionshowmore').removeClass('d-none');
                }
            }
            else if(winwidth <= 991)  //Mobile View
            {
                if(shapeshow>6)
                {
                    $('.btnshapshowmore').removeClass('d-none');
                    // $('.shpesm').text('+MOre M');
                }
                if(colorshow>6)
                {
                    $('.btncolorshowmore').removeClass('d-none');
                }
                if(clarityshow>6)
                {
                    $('.btnclarityshowmore').removeClass('d-none');
                }
                if(intensityshow>3)
                {
                    $('.btnintensityshowmore').removeClass('d-none');
                }
                if(gradingshow>6)
                {
                    $('.btngradingshowmore').removeClass('d-none');
                }
                if(gridleshow>6)
                {
                    $('.btngridleshowmore').removeClass('d-none');
                }
                if(culetsizeshow>6)
                {
                    $('.btnculetsizeshowmore').removeClass('d-none');
                }
                if(culetconditionshow>6)
                {
                    $('.btnculetconditionshowmore').removeClass('d-none');
                }
            }else{
                if(shapeshow>12)
                {
                    $('.btnshapshowmore').removeClass('d-none');
                    // $('.shpesm').text('+MOre D');
                }
                if(colorshow>12)
                {
                    $('.btncolorshowmore').removeClass('d-none');
                }
                if(clarityshow>13)
                {
                    $('.btnclarityshowmore').removeClass('d-none');
                }
                if(intensityshow>9)
                {
                    $('.btnintensityshowmore').removeClass('d-none');
                }
                if(gradingshow>13)
                {
                    $('.btngradingshowmore').removeClass('d-none');
                }
                if(gridleshow>13)
                {
                    $('.btngridleshowmore').removeClass('d-none');
                }
                if(culetsizeshow>12)
                {
                    $('.btnculetsizeshowmore').removeClass('d-none');
                }
                if(culetconditionshow>12)
                {
                    $('.btnculetconditionshowmore').removeClass('d-none');
                }
            }

            $('#DiamondSearchData .show-more-filters').on('click',function() {
            //   
                $(this).parent().parent().find(".filter-container").toggleClass("show-more-container");
                $(this).toggleClass("show-more-open");
                if($(this).hasClass('show-more-open')==true)
                {
                    $(this).children("span").text("- Less");
                }else{
                    $(this).children("span").text("+ More");
                }
             
            });
            $(".show-more-link").click(function() {
                $(this).toggleClass("show-more-open");
            });

            $('#fltfromintensity').on('change',function(){
                var fltfromintensity=$(this).val();
                $('#s_fltfromintensity').val(fltfromintensity);
                filltointensity();
            })

            $('#fltfrommilkyid').on('change',function(){
                var fltfrommilkyid=$(this).val();
                $('#s_fltfrommilkyid').val(fltfrommilkyid);
                filltomilky();
            })

            $('#fltfromcutid').on('change',function(){
                var fltfromcutid=$(this).val();
                $('#s_fltfromcutid').val(fltfromcutid);
                filltocut();
            })

            $('#fltfrompolishid').on('change',function(){
                var fltfrompolishid=$(this).val();
                $('#s_fltfrompolishid').val(fltfrompolishid);
                filltopolish();
            })

            $('#fltfromsymmetryid').on('change',function(){
                var fltfromsymmetryid=$(this).val();
                $('#s_fltfromsymmetryid').val(fltfromsymmetryid);
                filltosymmetry();
            })

            $('input[name="treatment"]').on('change',function(){
                var treatment=$('input[name="treatment"]:checked').val();
                $('#listtreatmentDiv').html('');
                if(treatment==1)
                {
                    filldiamondtreat();
                }else if(treatment==2)
                {
                    filltretment();
                }
            })

            listdiamondsortby();
            listsidediamondsearchdata();
            $('.chart-loading').hide();
        }

        function OnErrorlistdiamondsearchdata(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

   
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
            var htmldata='';
            if(resultdata.status==1){
                if(typeid==1)
                {
                    if(resultdata.data[0].fileurl!='')
                    {
                        $('.showsinglehowcanihelp').removeClass('d-none');
                        htmldata+='<p class="text-right"><a href="'+resultdata.data[0].fileurlpath+'" target="_blank"><i class="fas fa-book"></i>&nbsp;How To Upload?</a></p>';
                    }
                    $('.showsinglehowcanihelp').html(htmldata);
                }
                else if(typeid==2){
                    if(resultdata.data[0].fileurl!='')
                    {
                        $('.showmultiplehowcanihelp').removeClass('d-none');
                        htmldata+='<p class="text-right"><a href="'+resultdata.data[0].fileurlpath+'" target="_blank"><i class="fas fa-book"></i>&nbsp;How To Upload?</a></p>';
                    } 
                    $('.showmultiplehowcanihelp').html(htmldata);   
                }
                
             }
           

            
        }

        function OnErrorfilldocumnetupload(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    function filltointensity() {
        var displayorder=$('#fltfromintensity :selected').data('displayorder');
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
        formdata.append("action", "listfancytointensity");
        formdata.append("displayorder", displayorder);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilltointensity, OnErrorfilltointensity);

        function Onsuccessfilltointensity(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#DiamondSearchData #flttointensity').html(resultdata.data);
            $('#DiamondSearchData #flttointensity').select2();

            $('#s_flttointensity').html(resultdata.data);
            $('#s_flttointensity').select2();
        }

        function OnErrorfilltointensity(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    $('body').on('change','#s_fltfromintensity',function(){
        sfilltointensity();
    })
    function sfilltointensity() {
        var displayorder=$('#s_fltfromintensity :selected').data('displayorder');
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
        formdata.append("action", "listfancytointensity");
        formdata.append("displayorder", displayorder);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilltointensity, OnErrorfilltointensity);

        function Onsuccessfilltointensity(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#s_flttointensity').html(resultdata.data);
            $('#s_flttointensity').select2();
        }

        function OnErrorfilltointensity(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }



    function filltomilky() {
        var displayorder=$('#fltfrommilkyid :selected').data('displayorder');
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
        formdata.append("action", "listtomilky");
        formdata.append("displayorder", displayorder);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilltomilky, OnErrorfilltomilky);

        function Onsuccessfilltomilky(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#DiamondSearchData #flttomilkyid').html(resultdata.data);
            $('#DiamondSearchData #flttomilkyid').select2();

            $('#s_flttomilkyid').html(resultdata.data);
            $('#s_flttomilkyid').select2();
        }

        function OnErrorfilltomilky(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    $('body').on('change','#s_fltfrommilkyid',function(){
        sfilltomilky();
    })
    function sfilltomilky() {
        var displayorder=$('#s_fltfrommilkyid :selected').data('displayorder');
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
        formdata.append("action", "listtomilky");
        formdata.append("displayorder", displayorder);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilltomilky, OnErrorfilltomilky);

        function Onsuccessfilltomilky(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#s_flttomilkyid').html(resultdata.data);
            $('#s_flttomilkyid').select2();
        }

        function OnErrorfilltomilky(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    $('body').on('change','#fltfromsieveid',function(){
               
                var fltfromsieveid=$(this).val();
              
                $('#s_fltfromsieveid').val(fltfromsieveid);
                filltosieve();
            })

    function filltosieve() {
        var displayorder=$('#fltfromsieveid :selected').data('displayorder');
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
        formdata.append("action", "listtosieve");
        formdata.append("displayorder", displayorder);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilltosieve, OnErrorfilltosieve);

        function Onsuccessfilltosieve(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#DiamondParcelSearchData #flttosieveid').html(resultdata.data);
            $('#DiamondParcelSearchData #flttosieveid').select2();

            $('#s_flttosieveid').html(resultdata.data);
            $('#s_flttosieveid').select2();
        }

        function OnErrorfilltosieve(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    function filltocut() {
        var displayorder=$('#fltfromcutid :selected').data('displayorder');
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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilltocut, OnErrorfilltocut);

        function Onsuccessfilltocut(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#DiamondSearchData #flttocutid').html(resultdata.data);
            $('#DiamondSearchData #flttocutid').select2();

            $('#s_flttocutid').html(resultdata.data);
            $('#s_flttocutid').select2();
        }

        function OnErrorfilltocut(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    
    $('body').on('change','#s_fltfromcutid',function(){
        sfilltocut();
    })
    function sfilltocut() {
        var displayorder=$('#s_fltfromcutid :selected').data('displayorder');
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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilltocut, OnErrorfilltocut);

        function Onsuccessfilltocut(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#s_flttocutid').html(resultdata.data);
            $('#s_flttocutid').select2();
        }

        function OnErrorfilltocut(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function filltopolish() {
        var displayorder=$('#fltfrompolishid :selected').data('displayorder');
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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilltopolish, OnErrorfilltopolish);

        function Onsuccessfilltopolish(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#DiamondSearchData #flttopolishid').html(resultdata.data);
            $('#DiamondSearchData #flttopolishid').select2();

            $('#s_flttopolishid').html(resultdata.data);
            $('#s_flttopolishid').select2();
        }

        function OnErrorfilltopolish(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    $('body').on('change','#s_fltfrompolishid',function(){
        sfilltopolish();
    })
    function sfilltopolish() {
        var displayorder=$('#s_fltfrompolishid :selected').data('displayorder');
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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilltopolish, OnErrorfilltopolish);

        function Onsuccessfilltopolish(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#s_flttopolishid').html(resultdata.data);
            $('#s_flttopolishid').select2();
        }

        function OnErrorfilltopolish(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function filltosymmetry() {
        var displayorder=$('#fltfromsymmetryid :selected').data('displayorder');
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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilltosymmetry, OnErrorfilltosymmetry);

        function Onsuccessfilltosymmetry(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#DiamondSearchData #flttosymmetryid').html(resultdata.data);
            $('#DiamondSearchData #flttosymmetryid').select2();

            $('#s_flttosymmetryid').html(resultdata.data);
            $('#s_flttosymmetryid').select2();
        }

        function OnErrorfilltosymmetry(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }
    $('body').on('change','#s_fltfromsymmetryid',function(){
        sfilltosymmetry();
    })
    function sfilltosymmetry() {
        var displayorder=$('#s_fltfromsymmetryid :selected').data('displayorder');
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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilltosymmetry, OnErrorfilltosymmetry);

        function Onsuccessfilltosymmetry(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#s_flttosymmetryid').html(resultdata.data);
            $('#s_flttosymmetryid').select2();
        }

        function OnErrorfilltosymmetry(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }


    /*Filter Treatment detail fill start */
    function filldiamondtreat() {
        var displayorder=$('#fltfrompolishid :selected').data('displayorder');
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
        formdata.append("action", "listdiamondtreat");
        formdata.append("displayorder", displayorder);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilldiamondtreat, OnErrorfilldiamondtreat);

        function Onsuccessfilldiamondtreat(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata='';
            var selhtmldata='';
            
            for(var i in resultdata.data)
            {
                htmldata += '<div class="col-12 col-md-3 cut-group">';
                htmldata += '<div class="form-check">';
                htmldata += '<input class="form-check-input" type="checkbox" data-name="'+resultdata.data[i].name+'" name="flttreatment[]" value="'+resultdata.data[i].id+'" id="flttreatment'+resultdata.data[i].id+'">';
                htmldata += '<label class="form-check-label ml-4" for="flttreatment'+resultdata.data[i].id+'"> '+resultdata.data[i].name+'</label>';
                htmldata += '</div>';
                htmldata += '</div>';

                selhtmldata+='<option value="'+resultdata.data[i].id+'">'+resultdata.data[i].name+'</option>';
            }
            $('#DiamondSearchData #listtreatmentDiv').html(htmldata);
            $('#s_flttreatment').html(selhtmldata);
            $('#s_flttreatment').select2();
        }

        function OnErrorfilldiamondtreat(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function filltretment() {
        var displayorder=$('#fltfrompolishid :selected').data('displayorder');
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
        formdata.append("displayorder", displayorder);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilltretment, OnErrorfilltretment);

        function Onsuccessfilltretment(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata='';
            var selhtmldata='';
            
            for(var i in resultdata.data)
            {
                htmldata += '<div class="col-12 col-md-3 cut-group">';
                htmldata += '<div class="form-check">';
                htmldata += '<input class="form-check-input" type="checkbox" data-name="'+resultdata.data[i].name+'" name="flttreatment[]" value="'+resultdata.data[i].id+'" id="flttreatment'+resultdata.data[i].id+'">';
                htmldata += '<label class="form-check-label ml-4" for="flttreatment'+resultdata.data[i].id+'"> '+resultdata.data[i].name+'</label>';
                htmldata += '</div>';
                htmldata += '</div>';

                selhtmldata+='<option value="'+resultdata.data[i].id+'">'+resultdata.data[i].name+'</option>';
            }
            $('#DiamondSearchData #listtreatmentDiv').html(htmldata);
            $('#s_flttreatment').html(selhtmldata);
            $('#s_flttreatment').select2();
        }

        function OnErrorfilltretment(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    $('body').on('click','#nobgm',function(){
        $('#fltshadeid').val('');
        $('#fltshadeid').select2();
        if($(this).prop('checked')==true)
        {
            var nobgmarr = [];
            $("#fltshadeid > option").each(function() {
                if($(this).data("isnobgm")==1)
                {
                    nobgmarr.push($(this).val());
                }
            });
            // console.log(nobgmarr);
            $('#fltshadeid').val(nobgmarr).trigger('change');
        }
    })
    /*Filter Treatment detail fill End */
    function listsidediamondsearchdata() {
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
        formdata.append("action", "listsidediamondsearchdata");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistsidediamondsearchdata, OnErrorlistsidediamondsearchdata);

        function Onsuccesslistsidediamondsearchdata(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#DiamondSideSearchData').html(resultdata.data);
            $('#DiamondSideSearchData .select2').select2();

        }

        function OnErrorlistsidediamondsearchdata(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    $('body').on('click','.clscolortag',function(){
        $('.clscolortag').removeClass('active');
        $(this).addClass('active');
        var type=$(this).data('id');
        $('.clsfancycolor').addClass('d-none');
        $('.clswhitecolor').removeClass('d-none');
        $('#fltovertone').val('');
        $('#fltovertone').select2();
        $('#fltintensity').val('');
        $('#fltintensity').select2();
        $('#fltcolor').val('');
        $('#fltcolor').select2();
        $('#flteyecleanid').prop('disabled',false);
        // $('#fltmilkyid').prop('disabled',false);
        $('#fltfrommilkyid').prop('disabled',false);
        $('#flttomilkyid').prop('disabled',false);
        $('#fltopeninclusionid').prop('disabled',false);
        $('#fltwhiteinclusionid').prop('disabled',false);
        $('#fltblackinclusionid').prop('disabled',false);
        $('#fltshadeid').prop('disabled',false);
        if(type==1)
        {
            $('.clsfancycolor').removeClass('d-none');
            $('.clswhitecolor').addClass('d-none');
            $('.clscolordetail').prop('checked',false);
            $('#flteyecleanid').val('');
            $('#flteyecleanid').select2();

            // $('#fltmilkyid').val('');
            // $('#fltmilkyid').select2();

            $('#fltfrommilkyid').val('');
            $('#fltfrommilkyid').select2();
            $('#flttomilkyid').val('');
            $('#flttomilkyid').select2();

            $('#fltopeninclusionid').val('');
            $('#fltopeninclusionid').select2();

            $('#fltwhiteinclusionid').val('');
            $('#fltwhiteinclusionid').select2();
            $('#fltblackinclusionid').val('');
            $('#fltblackinclusionid').select2();
            $('#fltshadeid').val('');
            $('#fltshadeid').select2();

            $('#flteyecleanid').prop('disabled',true);
            // $('#fltmilkyid').prop('disabled',true);
            $('#fltfrommilkyid').prop('disabled',true);
            $('#flttomilkyid').prop('disabled',true);
            $('#fltopeninclusionid').prop('disabled',true);
            $('#fltwhiteinclusionid').prop('disabled',true);
            $('#fltblackinclusionid').prop('disabled',true);
            $('#fltshadeid').prop('disabled',true);
           

        }
        checkdiamondformelementvalue();
    })

    $('body').on('click','.clsadvancemeasuretag',function(){
        if($(this).hasClass('active')==true)
        {
            $('.clsadvancemeasuretag').removeClass('active');
            $('.advancemeasurementDiv').addClass('d-none');
            $('#fltcrownfromheightper').val('');
            $('#fltcrowntoheightper').val('');
            $('#fltcrownfromangel').val('');
            $('#fltcrowntoangel').val('');

            $('#fltpavilionfromangle').val('');
            $('#fltpaviliontoangle').val('');

        }else{
            $('.clsadvancemeasuretag').addClass('active');
            $('.advancemeasurementDiv').removeClass('d-none');
        }
    })

    function listdiamondparcelsearchdata() {
        $('.chart-loading').show();
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
        formdata.append("action", "listdiamondparcelsearchdata");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistdiamondparcelsearchdata, OnErrorlistdiamondparcelsearchdata);

        function Onsuccesslistdiamondparcelsearchdata(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#DiamondParcelSearchData').html(resultdata.data);
            $('#DiamondParcelSearchData .select2').select2();
            $('#form-diamond-parcel-search').removeClass('d-none');
            $('.listdiamondparcelDataDiv').addClass('d-none');
            $('.chart-loading').hide();
            var winwidth = $(window).width(); 
            var shapeshow=$('#shapeparcelDivData  .filter-parcelshape .filter input').length;
            var colorshow=$('#colorparcelDivData .filter input').length;
            var clarityshow=$('#clarityparcelDivData .filter input').length;
            $('#form-diamond-parcel-search .btnparcelshapshowmore').addClass('d-none');
            $('#form-diamond-parcel-search .btnparcelcolorshowmore').addClass('d-none');
            $('#form-diamond-parcel-search .btnparcelclarityshowmore').addClass('d-none');
            if(winwidth>991 && winwidth<=1500){
                if(shapeshow>9)
                {
                    $('.btnparcelshapshowmore').removeClass('d-none');
                }
                if(colorshow>9)
                {
                    $('.btnparcelcolorshowmore').removeClass('d-none');
                }
                if(clarityshow>13)
                {
                    $('.btnparcelclarityshowmore').removeClass('d-none');
                }
            }
            else if(winwidth <= 991)  //Mobile View
            {
                if(shapeshow>6)
                {
                    $('.btnparcelshapshowmore').removeClass('d-none');
                }
                if(colorshow>6)
                {
                    $('.btnparcelcolorshowmore').removeClass('d-none');
                }
                if(clarityshow>6)
                {
                    $('.btnparcelclarityshowmore').removeClass('d-none');
                }
                
            }else{
                if(shapeshow>12)
                {
                    $('.btnparcelshapshowmore').removeClass('d-none');
                }
                if(colorshow>12)
                {
                    $('.btnparcelcolorshowmore').removeClass('d-none');
                }
                if(clarityshow>13)
                {
                    $('.btnparcelclarityshowmore').removeClass('d-none');
                }
            }

            $('#DiamondParcelSearchData .show-more-filters').on('click',function() {
            //   
                $(this).parent().parent().find(".filter-container").toggleClass("show-more-container");
                $(this).toggleClass("show-more-open");
                if($(this).hasClass('show-more-open')==true)
                {
                    $(this).children("span").text("- Less");
                }else{
                    $(this).children("span").text("+ More");
                }
             
            });
            $(".show-more-link").click(function() {
                $(this).toggleClass("show-more-open");
            });

            listdiamondsideparcelsearchdata();
        }

        function OnErrorlistdiamondparcelsearchdata(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listdiamondsideparcelsearchdata() {
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
        formdata.append("action", "listdiamondsideparcelsearchdata");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistdiamondsideparcelsearchdata, OnErrorlistdiamondsideparcelsearchdata);

        function Onsuccesslistdiamondsideparcelsearchdata(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#DiamondParcelSideSearchData').html(resultdata.data);
            $('#DiamondParcelSideSearchData .select2').select2();

        }

        function OnErrorlistdiamondsideparcelsearchdata(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listmydiamondsearchdata() {
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
        formdata.append("action", "listmydiamondsearchdata");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistmydiamondsearchdata, OnErrorlistmydiamondsearchdata);

        function Onsuccesslistmydiamondsearchdata(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#MyDiamondSearchData').html(resultdata.data);
            $('#MyDiamondSearchData .select2').select2();

        }

        function OnErrorlistmydiamondsearchdata(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listuploaddiamondformdata() {
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
        formdata.append("action", "listuploaddiamondformdata");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistuploaddiamondformdata, OnErrorlistuploaddiamondformdata);

        function Onsuccesslistuploaddiamondformdata(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#nav-tabContent-DiamondUploadFormDiv').html(resultdata.data);
            $('#nav-tabContent-DiamondUploadFormDiv .select2').select2();
            var formevent=$('#form-diamond-upload #formevent').val();
            $('#btngeneralinfo').removeClass('d-none');
            $('#btnsavediamond').removeClass('d-none');
            <?php
            if($CanMembernolimitdiamond!=1 && $totaldiamondupload>$CanMemberlimitdiamond)
            {
                ?>
                if(formevent=='submit')
                {
                    $('#btngeneralinfo').addClass('d-none');
                    $('#btnsavediamond').addClass('d-none');
                }
                <?php
            }
            ?>

            fillupdiamondfromtosieve();
            $('.btnnextdiamonduploadform').click(function() {

                var nexttab = $(this).attr('data-next-tab');
                opennexttab(nexttab);
            });

            $('.btnprevdiamonduploadform').click(function() {

                var prevtab = $(this).attr('data-prev-tab');
                openprvioustab(prevtab);
            });

            $('#savanipercentage').on('input',function(){
                var savanipercentage=parseFloat($(this).val())|0;
                if(savanipercentage>100)
                {
                    $('#savanipercentage').val('100');
                }/* else if(savanipercentage <-99)
                {
                    $('#savanipercentage').val('-0');
                }else if(savanipercentage==0){
                    $('#savanipercentage').val('-'+parseFloat(savanipercentage));
                }else{
                    if(savanipercentage!='NaN')
                    {
                        $('#savanipercentage').val(parseFloat(savanipercentage));
                    }
                } */
            })

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

            $('#matchedpair').on('change', function() {
                checkmatchpairflag();
            });
            $('#isparcel').on('change', function() {
                checkisparcelflag();
            });
            $('#countryid').on('change', function() {
                liststate();
            });

        }

        function OnErrorlistuploaddiamondformdata(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function fillupdiamondfromtosieve(flg)
    {
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
        formdata.append("action", "listupdiamondsieve");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilltosieve, OnErrorfilltosieve);

        function Onsuccessfilltosieve(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            if(flg==1)
            {
                $('#form-diamond-upload #sieveid').html(resultdata.data);
                $('#form-diamond-upload #sieveid').select2();
            }else if(flg==2)
            {
                $('#form-diamond-upload #tosieveid').html(resultdata.data);
                $('#form-diamond-upload #tosieveid').select2();
            }else{
                $('#form-diamond-upload #sieveid').html(resultdata.data);
                $('#form-diamond-upload #sieveid').select2();
                $('#form-diamond-upload #tosieveid').html(resultdata.data);
                $('#form-diamond-upload #tosieveid').select2();
            }
            
        }

        function OnErrorfilltosieve(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    } 

    function addsievedata(flg){
        $('#addSieveModal').modal('show');
        $('#addSieveModal #form-add-sieve #name').val('');
        $('#addSieveModal #form-add-sieve #displayorder').val('');
        if($('#form-add-sieve').length){		
            $('#form-add-sieve').validate({
                rules:{
                    name:{
                        required: true,
                    },
                    displayorder:{
                        required: true,
                    },
                },messages:{
                    name:{
                        required:"Name is required",
                    },
                    displayorder:{
                        required:"Display Order is required",
                    },
                },
                submitHandler: function(form){

                    $('#loaderprogress').show();
                    var pagename=getpagename();
                    var useraction=$('#formevent').val();
                    formdata = new FormData(form);
                    formdata.append("action", "insertseievemaster");
                    var headersdata= {'Accept': 'application/json',platform: 4,userpagename:pagename,useraction:useraction,masterlisting:false};
                    ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessfilltosieve, OnErrorfilltosieve);

                    function Onsuccessfilltosieve(data) {
                        var JsonData = JSON.stringify(data);
                        var resultdata = jQuery.parseJSON(JsonData);
                        
                        if(resultdata.status==0)
                        {
                            Notiflix.Notify.Failure(resultdata.message);
                        }else{
                            Notiflix.Notify.Success(resultdata.message);
                            $("#form-add-sieve").validate().resetForm();
                            $('#form-add-sieve').trigger("reset");
                            fillupdiamondfromtosieve(flg);
                            $('#addSieveModal').modal('hide');
                        }
                        
                    }

                    function OnErrorfilltosieve(content) {
                        // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
                    }
			    },
            });
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
</script>
<?php include('diamondsearch.php'); ?>
<?php include('diamondparcelsearch.php'); ?>
<?php include('uploaddiamonddata.php'); ?>

</html>