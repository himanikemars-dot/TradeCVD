<?php

// require_once dirname(__DIR__, 1).'/config/config.php';

// $config = new config();



require_once dirname(__DIR__, 1) . '/config/init.php';

$res=$DB->getpagemetadata(23);

// echo '<pre>';

// print_r($LoginInfo);

// echo '</pre>';

// exit;



if($LoginInfo) 

{

    if($LoginInfo->getAdlogin()!='' && $LoginInfo->getIsguestuser()==0)

    {



        

    }

    else

    {

        ?>

        <script>

            window.location='<?php echo $config->getWeburl(); ?>home';

        </script>

        <?php

    }

}

else

{

    ?>

    <script>

        window.location='<?php echo $config->getWeburl(); ?>home';

    </script>

    <?php

}

/* if ($LoginInfo->getAdlogin() != 'savanigemsW$20220901@instance%' && $LoginInfo->getIsguestuser()==1) {

?>

    <script>

       window.location = '<?php echo $config->getWeburl(); ?>home';

    </script>

<?php

} */



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

    <meta property="og:description" content="<?php echo $res[0]['metadescription']; ?>"/>

    <meta property="og:image" content="<?php echo $config->getImageurl(); ?>images/ogiseo.png"/>

    <link rel="icon" type="image/x-icon" href="<?php echo $config->getImageurl(); ?>images/gems.png"/>

    <!-- Meta Tag End -->

    <!--title-->

    <title><?php echo $res[0]['title']; ?></title>

    <!-- CSS Start -->

    <?php include('css.php'); ?>

    <!-- CSS End -->

    <!-- <script src="assets/js/vendor/jquery.min.js"></script> -->

</head>




<body class="bg-white home-page all-page-sidebarset max-w-2560px">

<style>
    ul#buy-request-tab {
    display: flex;
    justify-content: center;
}
    .product-request-pane .setmtopallbu {
        margin-top: 24px !important;
        padding-top: 0 !important;
    }
    #pills-tabContent > .product-request-pane:not(.active) {
        display: none !important;
    }
    #pills-tabContent > .product-request-pane.active {
        display: block !important;
    }
    .tab-pane {
    display: none !important;
    }

    .tab-pane.active.show {
        display: block !important;
    }
</style>

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

     // 5 - Buy Requests

 

     $CanBuyRequest = $DB->getpackagewiseuserright($LoginInfo->getUid(),5)['attributeval'];

     $CanMemberToMemberChat = $DB->getpackagewiseuserright($LoginInfo->getUid(),4)['attributeval'];

     // 7 - List Jewelry for Sale. Trade Pro can sell even before listing a product.
     $CanListJewelleryForList = $DB->getpackagewiseuserright($LoginInfo->getUid(),7)['attributeval'];

     $ActivePackageName = '';
     if(isset($CheckUserRights['packageid']) && $CheckUserRights['packageid'])
     {
         $resActivePackage = $DB->getmenual("SELECT packagename FROM tblpackagemaster WHERE id=:id LIMIT 1", array(':id'=>$CheckUserRights['packageid']));
         if(sizeof($resActivePackage)>0)
         {
             $ActivePackageName = strtolower(trim($resActivePackage[0]['packagename']));
         }
     }

     $IsProductRequestSeller = 0;
     if($CanMemberToMemberChat==1 && in_array($ActivePackageName, array('seller','trade pro','free plan')))
     {
         $IsProductRequestSeller = 1;
     }
     else if($CanMemberToMemberChat==1 && $CanListJewelleryForList==1)
     {
         $IsProductRequestSeller = 1;
     }
     else if($CanMemberToMemberChat==1)
     {
         $resSellerProducts = $DB->getmenual("SELECT id FROM jewellerylist WHERE personid=:uid AND isactive=1 LIMIT 1", array(':uid'=>$LoginInfo->getUid()));
         if(sizeof($resSellerProducts)>0)
         {
             $IsProductRequestSeller = 1;
         }
     }

     $IsTradeProPackage = ($ActivePackageName == 'trade pro') ? 1 : 0;
     $ShowBuyerProductRequestTabs = ($CanBuyRequest==1 && ($IsTradeProPackage==1 || $IsProductRequestSeller!=1)) ? 1 : 0;
     $ShowSellerProductRequestTabs = ($CanMemberToMemberChat==1 && $IsProductRequestSeller==1) ? 1 : 0;

     if($ShowBuyerProductRequestTabs!=1 && $ShowSellerProductRequestTabs!=1)
     {
         if($CanBuyRequest==1)
         {
             $ShowBuyerProductRequestTabs = 1;
         }
         else if($CanMemberToMemberChat==1)
         {
             $ShowSellerProductRequestTabs = 1;
         }
     }

     if($CanBuyRequest!=1 && $CanMemberToMemberChat!=1)

     {

         ?>

         <script>

             window.location='<?php echo $config->getportalbaseurl(); ?>home';

         </script>

         <?php

     }

    ?>

    <div class="page-wrapper">

        <div class="has-sidebar-left">

            <header class="bg-white accent-3 relative nav-sticky tab-box-shadow ">

                <div class="container-fluid text-white">

                    <!-- <div class="loder-div">

                        <div class="chart-loading">

                            <img alt="loading-img" src="assets/img/loading.gif">

                        </div>

                    </div> -->

                    <div class="row justify-content-center">

                        <div class="col-12 col-md-5 m-auto">

                            <h4 class="mb-0 sec-desc header-desc text-darkgreen">

                                Buy Request

                            </h4>

                        </div>

                        <?php 

                        if($CanBuyRequest==1 || $CanMemberToMemberChat==1)

                        {

                        ?>

                            <div class="col-12 col-md-9 m-auto pt-3">

                           

                                <ul class="nav responsive-tab nav-material nav-material-white pt-2" id="buy-request-tab">

                                    <?php if($IsTradeProPackage==1 && $ShowSellerProductRequestTabs==1) { ?>

                                    <li>

                                        <a class="nav-link text-center active" id="seller-productrequest-tab" data-toggle="pill" href="#seller-productrequest">Buyer Request</a>

                                    </li>

                                    <li>

                                        <a class="nav-link text-center" id="buyer-myrequest-tab" data-toggle="pill" href="#buyer-myrequest">My Buy Request</a>

                                    </li>

                                    <li>

                                        <a class="nav-link text-center" id="trade-status-tab" data-toggle="pill" href="#trade-status">Status</a>

                                    </li>

                                    <li>

                                        <a class="nav-link text-center" id="trade-allrequest-tab" data-toggle="pill" href="#trade-allrequest">All Request</a>

                                    </li>

                                    <?php } else { ?>

                                    <?php if($ShowBuyerProductRequestTabs==1) { ?>

                                    <li>

                                        <a class="nav-link text-center active" id="buyer-myrequest-tab" data-toggle="pill" href="#buyer-myrequest">My Request</a>

                                    </li>

                                    <li>

                                        <a class="nav-link text-center" id="buyer-status-tab" data-toggle="pill" href="#buyer-status">Status</a>

                                    </li>

                                    <?php } ?>

                                    <?php if($ShowSellerProductRequestTabs==1) { ?>

                                    <li>

                                        <a class="nav-link text-center <?php if($ShowBuyerProductRequestTabs!=1){ echo 'active'; } ?>" id="seller-productrequest-tab" data-toggle="pill" href="#seller-productrequest">Buyer Request</a>

                                    </li>

                                    <li>

                                        <a class="nav-link text-center" id="seller-status-tab" data-toggle="pill" href="#seller-status">Status</a>

                                    </li>

                                    <?php } ?>

                                    <?php } ?>

                                </ul>

                            </div>

                        <?php 

                        } ?>    

                    </div>

                </div>

            </header>

        </div>

        <div class="main" id="web-content">

            <?php include('sidebar.php'); ?>

            <div class="has-sidebar-left">

                <div class="container-fluid relative animatedParent animateOnce">

                        <?php 

                        if($CanBuyRequest==1 || $CanMemberToMemberChat==1)

                        {

                        ?>

                            <div class="tab-content bg-white" id="pills-tabContent">

                                <?php if($ShowBuyerProductRequestTabs==1) { ?>

                                <div class="tab-pane fade" id="request-1" role="tabpanel" aria-labelledby="request-1-tab">

                                    <div class="col-12 col-md-12 setcoloall">

                                        <div class="row searchheaddet setmtopallbu">

                                            <div class="col-sm-12 col-xs-12 col-md-6 moredetail">

                                                <ul>

                                                    <li>Buy Request | </li>

                                                    <li>&nbsp;<b class="totalbuyrequest">0 Request</b></li>

                                                </ul>

                                            </div>

                                            <div class="col-md-6 col-sm-12 col-xs-12">

                                                <div class="text-right searchhead">

                                                    <div class="searchgreade searchcom setsho">

                                                        <select class="form-control w-auto shortbydianmondse ml-auto" id="buyrequestsortbyid" name="buyrequestsortbyid">



                                                        </select>

                                                    </div>

                                                    <div class="searchgreade searchcom">

                                                        <button type="button" class="btn searchbtnset"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/3.svg" alt="Sorting Buy Request" title="Sorting Buy Request"></button>

                                                    </div>

                                                    <div class="searchgreade searchcom">

                                                        <button type="button" class="btn searchbtnset navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle-buyrequest"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/fliter.svg" alt="Filter Buy Request" title="Filter Buy Request"></button>

                                                    </div>

                                                    <!-- <div class="searchgreade searchcom">

                                                        <button type="button" href="#sidebarnew" data-toggle="collapse" class="btn searchbtnset open-filter-sidebar"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/fliter.svg" alt="diamonds" title="diamonds"></button>

                                                    </div> -->

                                                </div>

                                            </div>

                                            <div class="col-12">

                                                <div class="shapesearch listbuyrequestsearch">



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

                                        <div id="wrapper-buyrequest" class="wrappernew setwrbyreq">

                                            <div id="sidebar-wrapper" class="filternew sidebar-wrapper">

                                                <form action="javascript:void(0);" name="form-buyrequest-filter" enctype="multipart/form-data" id="form-buyrequest-filter" novalidate="novalidate">

                                                    <div class="fixbuyp">

                                                        <h4>Filter</h4><button type="button" class="btn-close-sidebar btn-buyrequest-close-sidebar" aria-label="Close">x</button>

                                                        <div class="searchgreade searchcom">

                                                            <button type="submit" class="btn searchbtnset" id="btnapplybuyrequestfilter" disabled>Apply</button>

                                                        </div>

                                                    </div>

                                                    <ul class="sidebarnew-nav nav-pills nav-stacked setfilese" id="menu">

                                                        <li class="setshowje">

                                                            <div class="col-12 cut-group setmedfli">

                                                                <div class="form-check">

                                                                    <h5 class="setfinbuyre">See Only</h5>

                                                                    <div class="col-12 col-md-12">

                                                                        <div class="row" id="allseeonlyDivData">

                                                                            <div class="col-12 col-md-12 cut-group">

                                                                                <div class="form-check">

                                                                                    <input class="form-check-input" type="checkbox" data-name="Active Buy Requests" value="1" name="fltseeonly[]" id="activebuyrequest">

                                                                                    <label class="form-check-label ml-4" for="activebuyrequest">

                                                                                        Active Buy Requests

                                                                                    </label>

                                                                                </div>

                                                                            </div>

                                                                            <div class="col-12 col-md-12 cut-group">

                                                                                <div class="form-check">

                                                                                    <input class="form-check-input" type="checkbox" value="2" data-name="Expired Buy Requests" name="fltseeonly[]" id="expiredbuyrequest">

                                                                                    <label class="form-check-label ml-4" for="expiredbuyrequest">

                                                                                        Expired Buy Requests

                                                                                    </label>

                                                                                </div>

                                                                            </div>

                                                                            <div class="col-12 col-md-12 cut-group">

                                                                                <div class="form-check">

                                                                                    <input class="form-check-input" type="checkbox" value="3" data-name="With seller responses" name="fltseeonly[]" id="withsellerresponse">

                                                                                    <label class="form-check-label ml-4" for="withsellerresponse">

                                                                                        With seller responses

                                                                                    </label>

                                                                                </div>

                                                                            </div>

                                                                            <div class="col-12 col-md-12 cut-group">

                                                                                <div class="form-check">

                                                                                    <input class="form-check-input" type="checkbox" value="4" data-name="Without seller responses" name="fltseeonly[]" id="withoutsellerresponse">

                                                                                    <label class="form-check-label ml-4" for="withoutsellerresponse">

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

                                                            <h4 class="setbyrena">Price</h4>

                                                            <div class="col-12 cut-group">

                                                                <!-- <h5 class="d-inline">$Total</h5> -->

                                                                <div class="row fliterset">

                                                                    <div class="col-6 col-md-6 col-sm-6 cut-group">

                                                                        <input type="text" id="s_fltfromprice" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromprice" placeholder="From">

                                                                    </div>

                                                                    <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">

                                                                        <input type="text" id="s_flttoprice" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttoprice" placeholder="To">

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <h4 class="d-inline setbyrena">Shape</h4>

                                                            <div class="col-12 cut-group setselctorbuy">

                                                                <select class="form-control select2" name="fltshapeid[]" id="s_fltshapeid" multiple="" tabindex="-1" aria-hidden="true">



                                                                </select>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <h4 class="setbyrena">Size</h4>

                                                            <div class="col-12 cut-group">

                                                                <!-- <h5 class="d-inline setsizebyu">Size</h5> -->

                                                                <div class="row fliterset">

                                                                    <div class="col-6 col-md-6 col-sm-6 cut-group">

                                                                        <input type="text" id="s_fltfromsize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="fltfromsize" placeholder="From">

                                                                        <label class="inputset" type="number">ct</label>

                                                                    </div>

                                                                    <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">

                                                                        <input type="text" id="s_flttosize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="flttosize" placeholder="To">

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

                                                                    <div class="col-6 col-md-6 col-sm-6 cut-group">

                                                                        <select class="form-control select2" name="fltfromcolorid" id="s_fltfromcolorid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                    <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">

                                                                        <select class="form-control select2" name="flttocolorid" id="s_flttocolorid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <h4 class="setbyrena">Clarity</h4>

                                                            <div class="col-12 cut-group">

                                                                <!-- <h5 class="d-inline setsizebyu">Size</h5> -->

                                                                <div class="row fliterset">

                                                                    <div class="col-6 col-md-6 col-sm-6 cut-group">

                                                                        <select class="form-control select2" name="fltfromclarityid" id="s_fltfromclarityid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                    <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">

                                                                        <select class="form-control select2" name="flttoclarityid" id="s_flttoclarityid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <div class="col-12 cut-group setresfi">

                                                                <h5 class="d-inline setfinbuyre">Finish</h5>

                                                                <div class="row flis setrowbuy">

                                                                    <div class="col-12 setcobu">

                                                                        <label for="name"><b class="setcutbuy">Cut</b></label>

                                                                        <select class="form-control select2" name="fltfromcutid" id="s_fltfromcutid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                        <select class="form-control select2" name="flttocutid" id="s_flttocutid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                                <div class="row flis setrowbuy">

                                                                    <div class="col-12 setcobu">

                                                                        <label for="name"><b>Polish</b></label>

                                                                        <select class="form-control select2" name="fltfrompolishid" id="s_fltfrompolishid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                        <select class="form-control select2" name="flttopolishid" id="s_flttopolishid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                                <div class="row flis setrowbuy setsymmp">

                                                                    <div class="col-12 setcobu">

                                                                        <label for="name"><b>Symm.</b></label>

                                                                        <select class="form-control select2" name="fltfromsymmetryid" id="s_fltfromsymmetryid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                        <select class="form-control select2" name="flttosymmetryid" id="s_flttosymmetryid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje setlabpo s_labDataDiv">

                                                            <div class="col-12 cut-group">

                                                                <div class="form-check">

                                                                    <h5 class="d-inline setfinbuyre">Grading Report</h5>

                                                                    <div class="col-12 col-md-12 setmbuy">

                                                                        <div class="row" id="s_labData">







                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <h4 class="d-inline setbyrena">Fluorescence</h4>

                                                            <div class="col-12 cut-group setselctorbuy">

                                                                <h5 class="d-inline setsizebyu">Intensities</h5>

                                                                <select class="form-control select2" name="fltintensityid[]" id="s_fltintensityid" multiple="" tabindex="-1" aria-hidden="true">



                                                                </select>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <h4 class="d-inline setbyrena">Location</h4>

                                                            <div class="col-12 cut-group setselctorbuy">

                                                                <select class="form-control select2" name="fltcountryid[]" id="s_fltcountryid" multiple="" tabindex="-1" aria-hidden="true">



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

                                                                        <select class="form-control select2" name="flteyecleanid[]" id="s_flteyecleanid" multiple="" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                                <div class="row flis setrowbuy">

                                                                    <div class="col-12 setcobu setmilk">

                                                                        <label for="name"><b>Milky</b></label>

                                                                        <select class="form-control select2" name="fltfrommilkyid" id="s_fltfrommilkyid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                        <select class="form-control select2" name="flttomilkyid" id="s_flttomilkyid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                                <div class="row flis setrowbuy">

                                                                    <div class="col-12 setcobu">

                                                                        <label for="name"><b>Open</b></label>

                                                                        <select class="form-control select2" name="fltopeninclusionid[]" id="s_fltopeninclusionid" multiple="" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                                <div class="row flis setrowbuy">

                                                                    <div class="col-12 setcobu">

                                                                        <label for="name"><b>White</b></label>

                                                                        <select class="form-control select2" name="fltwhiteinclusionid[]" id="s_fltwhiteinclusionid" multiple="" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                                <div class="row flis setrowbuy">

                                                                    <div class="col-12 setcobu">

                                                                        <label for="name"><b>Black</b></label>

                                                                        <select class="form-control select2" name="fltblackinclusionid[]" id="s_fltblackinclusionid" multiple="" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>





                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <h4 class="setbyrena">Create Date</h4>

                                                            <div class="col-12 cut-group">

                                                                <div class="row fliterset">

                                                                    <div class="col-6 col-md-6 col-sm-6 cut-group">

                                                                        <input type="text" id="s_fltfromdate" readonly class="fromusd" name="fltfromdate" placeholder="From Date">

                                                                    </div>

                                                                    <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">

                                                                        <input type="text" id="s_flttodate" class="fromusd" readonly name="flttodate" placeholder="To Date">

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <h4 class="setbyrena">Expiration Date</h4>

                                                            <div class="col-12 cut-group">

                                                                <div class="row fliterset">

                                                                    <div class="col-6 col-md-6 col-sm-6 cut-group">

                                                                        <input type="text" id="s_fltfromexpirydate" readonly class="fromusd" name="fltfromexpirydate" placeholder="From Date">

                                                                    </div>

                                                                    <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">

                                                                        <input type="text" id="s_flttoexpirydate" class="fromusd" readonly name="flttoexpirydate" placeholder="To Date">

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <div class="searchgreade searchcom setp">

                                                            <button type="submit" class="btn searchbtnset" id="btnapplybuyrequestfilter" disabled>Apply</button>

                                                        </div>

                                                    </ul>

                                                </form>

                                            </div>

                                        </div>

                                        <!-- left bar end -->

                                        <div class="accordion listbuyrequestDataDiv" id="accordionExample">

                                            <div class="loder-div">

                                                

                                            <div class="table-responsive searchpagedetail setbuyreq" id="listbuyrequestDatatbl" data-show="0" data-nextpage="0">

                                                <div class="chart-loading">

                                                        <img alt="loading-img" src="assets/img/loading.gif">

                                                    </div>

                                                </div>

                                                <table class="table table-tb">

                                                    <thead>

                                                        <tr>

                                                            <th class="text-center">Buy Request#</th>

                                                            <th class="text-left">Request Person</th>

                                                            <th class="text-left">Type</th>

                                                            <th class="text-center">Create Date</th>

                                                            <th class="text-center">Expiration Date</th>

                                                            <th class="text-left">Shape</th>

                                                            <th class="text-left">Size</th>

                                                            <th class="text-left">Color</th>

                                                            <th class="text-left">Location</th>

                                                        </tr>

                                                    </thead>

                                                    <tbody id="listbuyrequestData">





                                                    </tbody>

                                                </table>

                                                <div class="row sticky-sec text-set">

                                                    <div class="text-left col-md-6"><b>Showing <span id="showbuyrequestentries"></span> Entries</b></div>

                                                    <div class="text-right col-md-6 col-lg-6 offset-4 setofmar">

                                                        <b class="w-auto setallpageentry">Entry

                                                            <select class="form-control w-auto  ml-auto" id="buyrequest_per_page" name="buyrequest_per_page">

                                                                <!-- <option value="20">20</option> -->

                                                                <option value="50">50</option>

                                                                <option value="100">100</option>

                                                                <option value="500">500</option>

                                                                <option value="1000">1000</option>

                                                            </select> Per page</b>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="tab-pane fade" id="buyrequest" role="tabpanel" aria-labelledby="buyrequest-tab">

                                    <div class="col-12 col-md-12 setcoloall">

                                        <div class="row searchheaddet setmtopallbu">

                                            <div class="col-sm-12 col-md-6 col-xs-12 moredetail">

                                                <ul>

                                                    <li>My Buy Request | </li>

                                                    <li>&nbsp;<b class="totalmybuyrequest">0 Request</b></li>

                                                </ul>

                                            </div>





                                            <div class="col-sm-12 col-md-6 col-xs-12 setbyreqset">

                                                <div class="text-right searchhead">

                                                    <div class="searchgreade searchcom setsho">

                                                        <select class="form-control w-auto shortbydianmondse ml-auto" id="mybuyrequestsortbyid" name="mybuyrequestsortbyid">



                                                        </select>

                                                    </div>

                                                    <div class="searchgreade searchcom">

                                                        <button type="button" class="btn searchbtnset"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/3.svg" alt="My Buy Request" title="My Buy Request"></button>

                                                    </div>

                                                    <div class="searchgreade searchcom">

                                                        <button type="button" class="btn searchbtnset navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle-mybuyrequest"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/fliter.svg" alt="My Buy Request filter" title="My Buy Request filter"></button>

                                                    </div>

                                                    <div class="searchgreade searchcom">

                                                        <button type="button" class="btn searchbtnset setresbtn" data-toggle="modal" data-target="#buyrequestModal"><i class="fas fa-plus"></i> New Buy Request</button>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-12">

                                                <div class="shapesearch listmybuyrequestsearch">



                                                </div>

                                            </div>

                                        </div>

                                        <div id="wrapper-mybuyrequest" class="wrappernew setwrbyreq">

                                            <div id="sidebar-wrapper" class="filternew sidebar-wrapper">

                                                <form action="javascript:void(0);" name="form-mybuyrequest-filter" enctype="multipart/form-data" id="form-mybuyrequest-filter" novalidate="novalidate">

                                                    <div class="fixbuyp">

                                                        <h4>Filter</h4><button type="button" class="btn-close-sidebar btn-mybuyrequest-close-sidebar" aria-label="Close">x</button>

                                                        <div class="searchgreade searchcom">

                                                            <button type="submit" class="btn searchbtnset" id="btnapplymybuyrequestfilter" disabled>Apply</button>

                                                        </div>

                                                    </div>

                                                    <ul class="sidebarnew-nav nav-pills nav-stacked setfilese" id="menu">

                                                        <li class="setshowje">

                                                            <div class="col-12 cut-group setmedfli">

                                                                <div class="form-check">

                                                                    <h5 class="setfinbuyre">See Only</h5>

                                                                    <div class="col-12 col-md-12">

                                                                        <div class="row" id="seeonlyDivData">

                                                                            <div class="col-12 col-md-12 cut-group">

                                                                                <div class="form-check">

                                                                                    <input class="form-check-input" type="checkbox" data-name="Active Buy Requests" value="1" name="fltseeonly[]" id="myactivebuyrequest">

                                                                                    <label class="form-check-label ml-4" for="myactivebuyrequest">

                                                                                        Active Buy Requests

                                                                                    </label>

                                                                                </div>

                                                                            </div>

                                                                            <div class="col-12 col-md-12 cut-group">

                                                                                <div class="form-check">

                                                                                    <input class="form-check-input" type="checkbox" value="2" data-name="Expired Buy Requests" name="fltseeonly[]" id="myexpiredbuyrequest">

                                                                                    <label class="form-check-label ml-4" for="myexpiredbuyrequest">

                                                                                        Expired Buy Requests

                                                                                    </label>

                                                                                </div>

                                                                            </div>

                                                                            <div class="col-12 col-md-12 cut-group">

                                                                                <div class="form-check">

                                                                                    <input class="form-check-input" type="checkbox" value="3" data-name="With seller responses" name="fltseeonly[]" id="mywithsellerresponse">

                                                                                    <label class="form-check-label ml-4" for="mywithsellerresponse">

                                                                                        With seller responses

                                                                                    </label>

                                                                                </div>

                                                                            </div>

                                                                            <div class="col-12 col-md-12 cut-group">

                                                                                <div class="form-check">

                                                                                    <input class="form-check-input" type="checkbox" value="4" data-name="Without seller responses" name="fltseeonly[]" id="mywithoutsellerresponse">

                                                                                    <label class="form-check-label ml-4" for="mywithoutsellerresponse">

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

                                                            <h4 class="setbyrena">Price</h4>

                                                            <div class="col-12 cut-group">

                                                                <!-- <h5 class="d-inline">$Total</h5> -->

                                                                <div class="row fliterset">

                                                                    <div class="col-6 col-md-6 col-sm-6 cut-group">

                                                                        <input type="text" id="s_fltmyfromprice" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromprice" placeholder="From">

                                                                    </div>

                                                                    <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">

                                                                        <input type="text" id="s_fltmytoprice" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttoprice" placeholder="To">

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <h4 class="d-inline setbyrena">Shape</h4>

                                                            <div class="col-12 cut-group setselctorbuy">

                                                                <select class="form-control select2" name="fltshapeid[]" id="s_fltmyshapeid" multiple="" tabindex="-1" aria-hidden="true">



                                                                </select>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <h4 class="setbyrena">Size</h4>

                                                            <div class="col-12 cut-group">

                                                                <!-- <h5 class="d-inline setsizebyu">Size</h5> -->

                                                                <div class="row fliterset">

                                                                    <div class="col-6 col-md-6 col-sm-6 cut-group">

                                                                        <input type="text" id="s_fltmyfromsize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="fltfromsize" placeholder="From">

                                                                        <label class="inputset" type="number">ct</label>

                                                                    </div>

                                                                    <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">

                                                                        <input type="text" id="s_fltmytosize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="flttosize" placeholder="To">

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

                                                                    <div class="col-6 col-md-6 col-sm-6 cut-group">

                                                                        <select class="form-control select2" name="fltfromcolorid" id="s_fltmyfromcolorid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                    <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">

                                                                        <select class="form-control select2" name="flttocolorid" id="s_fltmytocolorid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <h4 class="setbyrena">Clarity</h4>

                                                            <div class="col-12 cut-group">

                                                                <!-- <h5 class="d-inline setsizebyu">Size</h5> -->

                                                                <div class="row fliterset">

                                                                    <div class="col-6 col-md-6 col-sm-6 cut-group">

                                                                        <select class="form-control select2" name="fltfromclarityid" id="s_fltmyfromclarityid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                    <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">

                                                                        <select class="form-control select2" name="flttoclarityid" id="s_fltmytoclarityid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <div class="col-12 cut-group setresfi">

                                                                <h5 class="d-inline setfinbuyre">Finish</h5>

                                                                <div class="row flis setrowbuy">

                                                                    <div class="col-12 setcobu">

                                                                        <label for="name"><b class="setcutbuy">Cut</b></label>

                                                                        <select class="form-control select2" name="fltfromcutid" id="s_fltmyfromcutid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                        <select class="form-control select2" name="flttocutid" id="s_fltmytocutid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                                <div class="row flis setrowbuy">

                                                                    <div class="col-12 setcobu">

                                                                        <label for="name"><b>Polish</b></label>

                                                                        <select class="form-control select2" name="fltfrompolishid" id="s_fltmyfrompolishid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                        <select class="form-control select2" name="flttopolishid" id="s_fltmytopolishid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                                <div class="row flis setrowbuy setsymmp">

                                                                    <div class="col-12 setcobu">

                                                                        <label for="name"><b>Symm.</b></label>

                                                                        <select class="form-control select2" name="fltfromsymmetryid" id="s_fltmyfromsymmetryid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                        <select class="form-control select2" name="flttosymmetryid" id="s_fltmytosymmetryid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje setlabpo s_mylabDataDiv">

                                                            <div class="col-12 cut-group">

                                                                <div class="form-check">

                                                                    <h5 class="d-inline setfinbuyre">Grading Report</h5>

                                                                    <div class="col-12 col-md-12 setmbuy">

                                                                        <div class="row" id="s_mylabData">







                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <h4 class="d-inline setbyrena">Fluorescence</h4>

                                                            <div class="col-12 cut-group setselctorbuy">

                                                                <h5 class="d-inline setsizebyu">Intensities</h5>

                                                                <select class="form-control select2" name="fltintensityid[]" id="s_fltmyintensityid" multiple="" tabindex="-1" aria-hidden="true">



                                                                </select>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <h4 class="d-inline setbyrena">Location</h4>

                                                            <div class="col-12 cut-group setselctorbuy">

                                                                <select class="form-control select2" name="fltcountryid[]" id="s_fltmycountryid" multiple="" tabindex="-1" aria-hidden="true">



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

                                                                        <select class="form-control select2" name="flteyecleanid[]" id="s_fltmyeyecleanid" multiple="" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                                <div class="row flis setrowbuy">

                                                                    <div class="col-12 setcobu setmilk">

                                                                        <label for="name"><b>Milky</b></label>

                                                                        <select class="form-control select2" name="fltfrommilkyid" id="s_fltmyfrommilkyid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                        <select class="form-control select2" name="flttomilkyid" id="s_fltmytomilkyid" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                                <div class="row flis setrowbuy">

                                                                    <div class="col-12 setcobu">

                                                                        <label for="name"><b>Open</b></label>

                                                                        <select class="form-control select2" name="fltopeninclusionid[]" id="s_fltmyopeninclusionid" multiple="" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                                <div class="row flis setrowbuy">

                                                                    <div class="col-12 setcobu">

                                                                        <label for="name"><b>White</b></label>

                                                                        <select class="form-control select2" name="fltwhiteinclusionid[]" id="s_fltmywhiteinclusionid" multiple="" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>

                                                                <div class="row flis setrowbuy">

                                                                    <div class="col-12 setcobu">

                                                                        <label for="name"><b>Black</b></label>

                                                                        <select class="form-control select2" name="fltblackinclusionid[]" id="s_fltmyblackinclusionid" multiple="" tabindex="-1" aria-hidden="true">



                                                                        </select>

                                                                    </div>

                                                                </div>





                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <h4 class="setbyrena">Create Date</h4>

                                                            <div class="col-12 cut-group">

                                                                <div class="row fliterset">

                                                                    <div class="col-6 col-md-6 col-sm-6 cut-group">

                                                                        <input type="text" id="s_fltmyfromdate" readonly class="fromusd" name="fltfromdate" placeholder="From Date">

                                                                    </div>

                                                                    <div class="col-6  col-md-6 col-sm-6 mt-auto cut-group">

                                                                        <input type="text" id="s_fltmytodate" class="fromusd" readonly name="flttodate" placeholder="To Date">

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <li class="setshowje">

                                                            <h4 class="setbyrena">Expiration Date</h4>

                                                            <div class="col-12 cut-group">

                                                                <div class="row fliterset">

                                                                    <div class="col-6 col-md-6 col-sm-6 cut-group">

                                                                        <input type="text" id="s_fltmyfromexpirydate" readonly class="fromusd" name="fltfromexpirydate" placeholder="From Date">

                                                                    </div>

                                                                    <div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">

                                                                        <input type="text" id="s_fltmytoexpirydate" class="fromusd" readonly name="flttoexpirydate" placeholder="To Date">

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </li>

                                                        <hr>

                                                        <div class="searchgreade searchcom setp">

                                                            <button type="submit" class="btn searchbtnset" id="btnapplymybuyrequestfilter" disabled>Apply</button>

                                                        </div>

                                                    </ul>

                                                </form>

                                            </div>

                                        </div>

                                        <div class="accordion listmybuyrequestDataDiv" id="accordionExample">

                                            <div class="table-responsive searchpagedetail setbuyreq" id="listmybuyrequestDatatbl" data-show="0" data-nextpage="0">

                                                <div class="chart-loading">

                                                        <img alt="loading-img" src="assets/img/loading.gif">

                                                    </div>

                                                </div>

                                                <table class="table table-tb">

                                                    <thead>

                                                        <tr>

                                                            <th class="text-center">Buy Request#</th>

                                                            <th class="text-left">Type</th>

                                                            <th class="text-center">Create Date</th>

                                                            <th class="text-center">Expiration Date</th>

                                                            <th class="text-left">Shape</th>

                                                            <th class="text-left">Size</th>

                                                            <th class="text-left">Color</th>

                                                            <th class="text-left">Location</th>

                                                            <th class="text-right">Action</th>

                                                        </tr>

                                                    </thead>

                                                    <tbody id="listmybuyrequestData">





                                                    </tbody>

                                                </table>

                                                <div class="row sticky-sec text-set">

                                                    <div class="text-left col-md-6"><b>Showing <span id="showmybuyrequestentries"></span> Entries</b></div>

                                                    <div class="text-right col-md-6 col-lg-6 offset-4 setofmar">

                                                        <b class="w-auto setallpageentry">Entry

                                                            <select class="form-control w-auto  ml-auto" id="mybuyrequest_per_page" name="mybuyrequest_per_page">

                                                                <!-- <option value="20">20</option> -->

                                                                <option value="50">50</option>

                                                                <option value="100">100</option>

                                                                <option value="500">500</option>

                                                                <option value="1000">1000</option>

                                                            </select> Per page</b>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <?php } // $CanBuyRequest na be pane ahi pura thay che ?>



                                <?php if($CanBuyRequest==1) { ?>

                                <div class="tab-pane fade product-request-pane <?php if($ShowBuyerProductRequestTabs==1 && $ShowSellerProductRequestTabs!=1){ echo 'show active'; } ?>" id="buyer-myrequest" role="tabpanel" aria-labelledby="buyer-myrequest-tab">
                                    <div class="col-12 col-md-12 setcoloall">
                                        <div class="row searchheaddet setmtopallbu">
                                            <div class="col-sm-12 col-xs-12 col-md-6 moredetail">
                                                <ul><li><?php echo ($IsTradeProPackage==1) ? 'My Buy Request' : 'My Request'; ?> | </li><li>&nbsp;<b class="totalBuyerMyRequest">0 Request</b></li></ul>
                                            </div>
                                        </div>
                                        <div class="table-responsive searchpagedetail setbuyreq">
                                            <table class="table">
                                                <thead><tr><th>Product Image</th><th>Request#</th><th>Seller</th><th>Product</th><th>Message</th><th>Offer Price</th><th>Create Date</th></tr></thead>
                                                <tbody id="listBuyerMyRequest"><tr><td colspan="7" class="text-center"><h3>Loading...</h3></td></tr></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade product-request-pane" id="buyer-status" role="tabpanel" aria-labelledby="buyer-status-tab">
                                    <div class="col-12 col-md-12 setcoloall">
                                        <div class="row searchheaddet setmtopallbu">
                                            <div class="col-sm-12 col-xs-12 col-md-6 moredetail">
                                                <ul><li>Status | </li><li>&nbsp;<b class="totalBuyerStatus">0 Request</b></li></ul>
                                            </div>
                                        </div>
                                        <div class="table-responsive searchpagedetail setbuyreq">
                                            <table class="table">
                                                <thead><tr><th>Product Image</th><th>Request#</th><th>Seller</th><th>Product</th><th>Message</th><th>Offer Price</th><th>Create Date</th><th>Status</th><th>Action</th></tr></thead>
                                                <tbody id="listBuyerStatus"><tr><td colspan="9" class="text-center"><h3>Loading...</h3></td></tr></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>

                                <?php if($ShowSellerProductRequestTabs==1) { ?>

                                <div class="tab-pane fade product-request-pane <?php if($ShowSellerProductRequestTabs==1 && ($IsTradeProPackage==1 || $ShowBuyerProductRequestTabs!=1)){ echo 'show active'; } ?>" id="seller-productrequest" role="tabpanel" aria-labelledby="seller-productrequest-tab">
                                    <div class="col-12 col-md-12 setcoloall">
                                        <div class="row searchheaddet setmtopallbu">
                                            <div class="col-sm-12 col-xs-12 col-md-6 moredetail">
                                                <ul><li>Buyer Request | </li><li>&nbsp;<b class="totalSellerProductRequest">0 Request</b></li></ul>
                                            </div>
                                        </div>
                                        <div class="table-responsive searchpagedetail setbuyreq">
                                            <table class="table">
                                                <thead><tr><th>Product Image</th><th>Request#</th><th>Buyer</th><th>Product</th><th>Message</th><th>Offer Price</th><th>Create Date</th><th>Status</th><th>Action</th></tr></thead>
                                                <tbody id="listSellerProductRequest"><tr><td colspan="9" class="text-center"><h3>Loading...</h3></td></tr></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <?php if($IsTradeProPackage==1 && $ShowBuyerProductRequestTabs==1) { ?>

                                <div class="tab-pane fade product-request-pane" id="trade-status" role="tabpanel" aria-labelledby="trade-status-tab">
                                    <div class="col-12 col-md-12 setcoloall">
                                        <div class="row searchheaddet setmtopallbu">
                                            <div class="col-sm-12 col-xs-12 col-md-6 moredetail">
                                                <ul><li>Status | </li><li>&nbsp;<b class="totalTradeStatus">0 Request</b></li></ul>
                                            </div>
                                        </div>
                                        <div class="table-responsive searchpagedetail setbuyreq">
                                            <table class="table">
                                                <thead><tr><th>Product Image</th><th>Request#</th><th>Type</th><th>Person</th><th>Product</th><th>Message</th><th>Offer Price</th><th>Create Date</th><th>Status</th><th>Action</th></tr></thead>
                                                <tbody id="listTradeStatus"><tr><td colspan="10" class="text-center"><h3>Loading...</h3></td></tr></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade product-request-pane" id="trade-allrequest" role="tabpanel" aria-labelledby="trade-allrequest-tab">
                                    <div class="col-12 col-md-12 setcoloall">
                                        <div class="row searchheaddet setmtopallbu">
                                            <div class="col-sm-12 col-xs-12 col-md-6 moredetail">
                                                <ul><li>All Request | </li><li>&nbsp;<b class="totalTradeAllRequest">0 Request</b></li></ul>
                                            </div>
                                        </div>
                                        <div class="table-responsive searchpagedetail setbuyreq">
                                            <table class="table">
                                                <thead><tr><th>Product Image</th><th>Request#</th><th>Type</th><th>Person</th><th>Product</th><th>Message</th><th>Offer Price</th><th>Create Date</th><th>Status</th><th>Action</th></tr></thead>
                                                <tbody id="listTradeAllRequest"><tr><td colspan="10" class="text-center"><h3>Loading...</h3></td></tr></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>

                                <div class="tab-pane fade product-request-pane" id="seller-status" role="tabpanel" aria-labelledby="seller-status-tab">
                                    <div class="col-12 col-md-12 setcoloall">
                                        <div class="row searchheaddet setmtopallbu">
                                            <div class="col-sm-12 col-xs-12 col-md-6 moredetail">
                                                <ul><li>Status | </li><li>&nbsp;<b class="totalSellerStatus">0 Request</b></li></ul>
                                            </div>
                                        </div>
                                        <div class="table-responsive searchpagedetail setbuyreq">
                                            <table class="table">
                                                <thead><tr><th>Product Image</th><th>Request#</th><th>Buyer</th><th>Product</th><th>Message</th><th>Offer Price</th><th>Create Date</th><th>Status</th><th>Action</th></tr></thead>
                                                <tbody id="listSellerStatus"><tr><td colspan="9" class="text-center"><h3>Loading...</h3></td></tr></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>

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

    // multiple selector

    $('#fltroughsourceid').select2();



    $('#expirydate').datepicker({

        dateFormat: 'dd/mm/yy',

        minDate: 0,

        maxDate: "+2w"

    });









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

        listshape('');

        listcolor();

        listclarity();

        listfancyintensity();

        listovertone();

        listfluorescencecolor();

        listfluorescenceintensity();

        listlab();

        listeyeclean();

        listmilky();

        listopeninclusion();

        listwhiteinclusion();

        listblackinclusion();

        listlocation();

        listcut();

        listpolish();

        listsymmetry();

        listsortby();

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1);

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1);

    });



    $(".btn-close-sidebar").click(function() {

        $(".wrappernew.toggled").toggleClass("intro");

    });















    $("#menu-toggle-mybuyrequest").click(function(e) {

        e.preventDefault();

        $("#wrapper-mybuyrequest").addClass("toggled");

        $("#wrapper-mybuyrequest").removeClass("intro");

    });



    $(".btn-mybuyrequest-close-sidebar").click(function() {

        //   $("#wrapper").removeClass("toggled");

        $("#wrapper-mybuyrequest").addClass("intro");

    });





    $("#menu-toggle-buyrequest").click(function(e) {

        e.preventDefault();

        $("#wrapper-buyrequest").addClass("toggled");

        $("#wrapper-buyrequest").removeClass("intro");

    });



    $(".btn-buyrequest-close-sidebar").click(function() {

        //   $("#wrapper").removeClass("toggled");

        $("#wrapper-buyrequest").addClass("intro");

    });







    /* FANCY COLOR */



    function fancycolordiv() {

        if ($('#isfancy').prop('checked') == true) {



            $('.nonfancyDiv').addClass('d-none');

            $('.fancyDiv').removeClass('d-none');

        } else {

            $('.nonfancyDiv').removeClass('d-none');

            $('.fancyDiv').addClass('d-none');

        }

    }

    $('#isfancy').on('change', function() {

        fancycolordiv();

    });



    /* FILL MASTER LIST */





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

            var mysidehtmldata = '';

            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {



                if (resultdata.data) {

                    if (resultdata.data.length > 0) {

                        for (var i in resultdata.data) {

                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidehtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';



                        }

                    }

                }

            }



            $('#shapeid').html(htmldata);

            $('#s_fltmyshapeid').html(mysidehtmldata);

            $('#s_fltshapeid').html(mysidehtmldata);

            if (shapeid) {

                $("#shapeid").val(shapeid.split(',')).trigger('change');

            }

            $('#shapeid').select2();

            $('#s_fltmyshapeid').select2();

            $('#s_fltshapeid').select2();



        }



        function OnErrorlistshape(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    }





    /* ******SORT BY******* */

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

        formdata.append("action", "listbuyrequestsortby");

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistbuyrequestsortby, OnErrorlistbuyrequestsortby);



        function Onsuccesslistbuyrequestsortby(data) {

            var JsonData = JSON.stringify(data);

            var resultdata = jQuery.parseJSON(JsonData);

            var htmldata = '';

            var shtmldata = '';

            htmldata += '<option value="">Select Sort By</option>';

            shtmldata += '<option value="">Select Sort By</option>';

            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {



                if (resultdata.data) {

                    if (resultdata.data.length > 0) {

                        for (var i in resultdata.data) {

                            if(resultdata.data[i].id!=5)

                            {

                                htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            }

                            shtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';



                        }

                    }

                }

            }



            $('#mybuyrequestsortbyid').html(htmldata);

            $('#buyrequestsortbyid').html(shtmldata);





        }



        function OnErrorlistbuyrequestsortby(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    }





    /* ******COLOR******* */

    function listcolor(fromcolorid = '', tocolorid = '') {

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

            var mysidefromhtmldata = '';

            var mysidetohtmldata = '';



            htmldata += '<option value="">Select From Color</option>';

            s_htmldata += '<option value="">Select To Color</option>';

            mysidefromhtmldata += '<option value="">From Color</option>';

            mysidetohtmldata += '<option value="">To Color</option>';

            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {



                if (resultdata.data) {

                    if (resultdata.data.length > 0) {

                        for (var i in resultdata.data) {

                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            s_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidefromhtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidetohtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                        }

                    }





                }



            }

            $('#fromcolorid').html(htmldata);

            $('#tocolorid').html(s_htmldata);

            $('#s_fltmyfromcolorid').html(mysidefromhtmldata);

            $('#s_fltmytocolorid').html(mysidetohtmldata);

            $('#s_fltfromcolorid').html(mysidefromhtmldata);

            $('#s_flttocolorid').html(mysidetohtmldata);



            if (fromcolorid) {

                $('#fromcolorid').val(fromcolorid);

            }

            if (tocolorid) {

                $('#tocolorid').val(tocolorid);

            }

            $('#fromcolorid').select2();

            $('#tocolorid').select2();

            $('#s_fltmyfromcolorid').select2();

            $('#s_fltmytocolorid').select2();

            $('#s_fltfromcolorid').select2();

            $('#s_flttocolorid').select2();



        }



        function OnErrorlistcolor(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    }





    /* ******CLARITY******* */

    function listclarity(fromclarityid = '', toclarityid = '') {

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

            var htmldata1 = '';

            var s_htmldata = '';

            var mysidefromhtmldata = '';

            var mysidetohtmldata = '';



            htmldata1 += '<option value="">Select From Clarity</option>';

            s_htmldata += '<option value="">Select To Clarity</option>';



            mysidefromhtmldata += '<option value="">From Clarity</option>';

            mysidetohtmldata += '<option value="">To Clarity</option>';



            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {



                if (resultdata.data) {

                    if (resultdata.data.length > 0) {

                        htmldata += '<div class="filter-container">';

                        for (var i in resultdata.data) {

                            htmldata1 += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            s_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidefromhtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidetohtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                        }

                    }

                }



            }

            $('#fromclarityid').html(htmldata1);

            $('#toclarityid').html(s_htmldata);

            $('#s_fltmyfromclarityid').html(mysidefromhtmldata);

            $('#s_fltmytoclarityid').html(mysidetohtmldata);

            $('#s_fltfromclarityid').html(mysidefromhtmldata);

            $('#s_flttoclarityid').html(mysidetohtmldata);

            if (fromclarityid) {

                $('#fromclarityid').val(fromclarityid);

            }

            if (toclarityid) {

                $('#toclarityid').val(toclarityid);

            }

            $('#fromclarityid').select2();

            $('#toclarityid').select2();

            $('#s_fltmyfromclarityid').select2();

            $('#s_fltmytoclarityid').select2();

            $('#s_fltfromclarityid').select2();

            $('#s_flttoclarityid').select2();

        }



        function OnErrorlistclarity(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    }



    /* FANCY INTENSITY */



    function listfancyintensity(fromintensityid = '', tointensityid = '') {

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

            var mysidehtmldata = '';

            htmldata += '<option value="">Select From Intensity</option>';

            s_htmldata += '<option value="">Select To Intensity</option>';

            mysidehtmldata += '';

            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {



                if (resultdata.data) {

                    if (resultdata.data.length > 0) {

                        for (var i in resultdata.data) {

                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            s_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidehtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                        }



                    }

                }



            }

            $('#fromintensityid').html(htmldata);

            $('#tointensityid').html(s_htmldata);

            $('#s_fltmyintensityid').html(mysidehtmldata);

            $('#s_fltintensityid').html(mysidehtmldata);

            if (fromintensityid) {

                $('#fromintensityid').val(fromintensityid);

            }

            if (tointensityid) {

                $('#tointensityid').val(tointensityid);

            }

            $('#fromintensityid').select2();

            $('#tointensityid').select2();

            $('#s_fltmyintensityid').select2();

            $('#s_fltintensityid').select2();



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



    function listfluorescencecolor(fluorescenecolorid = '', colorid = '') {

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

            var s_htmldata = '';

            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {

                if (resultdata.data) {

                    if (resultdata.data.length > 0) {

                        for (var i in resultdata.data) {

                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            s_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                        }

                    }

                }



            }

            $('#fluorescenecolorid').html(htmldata);

            $('#colorid').html(s_htmldata);

            if (fluorescenecolorid) {

                $("#fluorescenecolorid").val(fluorescenecolorid.split(',')).trigger('change');

            }

            if (colorid) {

                $("#colorid").val(colorid.split(',')).trigger('change');

            }

            $('#colorid').select2();

            $('#fluorescenecolorid').select2();

        }



        function OnErrorlistfluorescencecolor(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    }





    /* GRADING REPORT  */



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

            var mysidehtmldata = '';

            var sidehtmldata = '';

            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {



                if (resultdata.data) {

                    if (resultdata.data.length > 0) {

                        for (var i in resultdata.data) {

                            htmldata += '<div class="col-12 col-md-6 col-sm-4 cut-group">';

                            htmldata += '<div class="form-check">';

                            htmldata += '<input class="form-check-input" type="checkbox" name="labid[]" value="' + resultdata.data[i].id + '" id="labid' + resultdata.data[i].id + '">';

                            htmldata += '<label class="form-check-label ml-4" for="labid' + resultdata.data[i].id + '">';

                            htmldata += '' + resultdata.data[i].name + '';

                            htmldata += '</label>';

                            htmldata += '</div>';

                            htmldata += '</div>';



                            mysidehtmldata += '<div class="col-12 col-md-4 col-sm-6 col-xs-6 cut-group">';

                            mysidehtmldata += '    <div class="form-check">';

                            mysidehtmldata += '        <input class="form-check-input" type="checkbox" data-name="' + resultdata.data[i].name + '" value="' + resultdata.data[i].id + '" name="fltlabid[]" id="s_fltmylabid' + resultdata.data[i].id + '">';

                            mysidehtmldata += '        <label class="form-check-label ml-4" for="s_fltmylabid' + resultdata.data[i].id + '">';

                            mysidehtmldata += '            ' + resultdata.data[i].name + '';

                            mysidehtmldata += '        </label>';

                            mysidehtmldata += '    </div>';

                            mysidehtmldata += '</div>';



                            sidehtmldata += '<div class="col-12 col-md-4 col-sm-6 col-xs-6 cut-group">';

                            sidehtmldata += '    <div class="form-check">';

                            sidehtmldata += '        <input class="form-check-input" type="checkbox" data-name="' + resultdata.data[i].name + '" value="' + resultdata.data[i].id + '" name="fltlabid[]" id="s_fltlabid' + resultdata.data[i].id + '">';

                            sidehtmldata += '        <label class="form-check-label ml-4" for="s_fltlabid' + resultdata.data[i].id + '">';

                            sidehtmldata += '            ' + resultdata.data[i].name + '';

                            sidehtmldata += '        </label>';

                            sidehtmldata += '    </div>';

                            sidehtmldata += '</div>';

                        }



                    }

                }



            }

            $('#GradingReportDiv').html(htmldata);

            $('#s_mylabData').html(mysidehtmldata);

            $('#s_labData').html(sidehtmldata);

        }



        function OnErrorlistlab(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    }





    /*Flourance INTENSITY*/



    function listfluorescenceintensity() {

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

            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {



                if (resultdata.data) {

                    if (resultdata.data.length > 0) {

                        for (var i in resultdata.data) {

                            htmldata += '<div class="col-12 col-md-6 col-sm-4 cut-group">';

                            htmldata += '<div class="form-check">';

                            htmldata += '<input class="form-check-input" type="checkbox" name="intensityid[]" value="' + resultdata.data[i].id + '" id="intensityid' + resultdata.data[i].id + '">';

                            htmldata += '<label class="form-check-label ml-4" for="intensityid' + resultdata.data[i].id + '">';

                            htmldata += '' + resultdata.data[i].name + '';

                            htmldata += '</label>';

                            htmldata += '</div>';

                            htmldata += '</div>';

                        }



                    }

                }



            }

            $('#FluorescenceIntensityDiv').html(htmldata);

        }



        function OnErrorlistfancyintensity(content) {

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

            var mysidehtmldata = '';



            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {

                if (resultdata.data) {

                    if (resultdata.data.length > 0) {

                        for (var i in resultdata.data) {

                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidehtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                        }

                    }

                }



            }

            $('#eyecleanid').html(htmldata);

            $('#s_fltmyeyecleanid').html(mysidehtmldata);

            $('#s_flteyecleanid').html(mysidehtmldata);

            if (eyecleanid) {

                $("#eyecleanid").val(eyecleanid.split(',')).trigger('change');

            }

            $('#eyecleanid').select2();

            $('#s_fltmyeyecleanid').select2();

            $('#s_flteyecleanid').select2();











        }



        function OnErrorlisteyeclean(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    }





    function listmilky(frommilkyid = '', tomilkyid = '') {

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

            var mysidefromhtmldata = '';

            var mysidetohtmldata = '';

            htmldata += '<option value="">Select From Milky</option>';

            form_htmldata += '<option value="">Select To Milky</option>';

            mysidefromhtmldata += '<option value="">From Milky</option>';

            mysidetohtmldata += '<option value="">To Milky</option>';

            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {

                if (resultdata.data) {

                    if (resultdata.data.length > 0) {

                        for (var i in resultdata.data) {

                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidefromhtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidetohtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                        }

                    }

                }



            }

            $('#frommilkyid').html(htmldata);



            $('#s_fltmyfrommilkyid').html(mysidefromhtmldata);

            $('#s_fltmytomilkyid').html(mysidetohtmldata);

            $('#s_fltfrommilkyid').html(mysidefromhtmldata);

            $('#s_flttomilkyid').html(mysidetohtmldata);

            if (frommilkyid) {

                $('#frommilkyid').val(frommilkyid);

            }

            $('#frommilkyid').select2();

            $('#tomilkyid').html(form_htmldata);

            if (tomilkyid) {

                $('#tomilkyid').val(tomilkyid);

            }

            $('#tomilkyid').select2();

            $('#s_fltmyfrommilkyid').select2();

            $('#s_fltmytomilkyid').select2();

            $('#s_fltfrommilkyid').select2();

            $('#s_flttomilkyid').select2();

        }



        function OnErrorlistmilky(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    }





    /* ******OpenInclusion*******  */



    function listopeninclusion(openinclusionid = '') {

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

            var mysidehtmldata = '';

            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {

                if (resultdata.data) {

                    if (resultdata.data.length > 0) {

                        for (var i in resultdata.data) {

                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidehtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                        }

                    }

                }



            }



            $('#openinclusionid').html(htmldata);

            $('#s_fltmyopeninclusionid').html(mysidehtmldata);

            $('#s_fltopeninclusionid').html(mysidehtmldata);

            if (openinclusionid) {

                $("#openinclusionid").val(openinclusionid.split(',')).trigger('change');

            }

            $('#openinclusionid').select2();

            $('#s_fltmyopeninclusionid').select2();

            $('#s_fltopeninclusionid').select2();

        }



        function OnErrorlistopeninclusion(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    }



    /* ******WhiteInclusion*******  */



    function listwhiteinclusion(whiteinclusionid = '') {

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

            var mysidehtmldata = '';

            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {

                if (resultdata.data.length > 0) {

                    for (var i in resultdata.data) {

                        htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                        mysidehtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                    }

                }



            }

            $('#whiteinclusionid').html(htmldata);

            $('#s_fltmywhiteinclusionid').html(mysidehtmldata);

            $('#s_fltwhiteinclusionid').html(mysidehtmldata);

            if (whiteinclusionid) {

                $("#whiteinclusionid").val(whiteinclusionid.split(',')).trigger('change');

            }

            $('#whiteinclusionid').select2();

            $('#s_fltmywhiteinclusionid').select2();

            $('#s_fltwhiteinclusionid').select2();



        }



        function OnErrorlistwhiteinclusion(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    }





    /* ******BlackInclusion*******  */



    function listblackinclusion(blackinclusionid = '') {

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

            var mysidehtmldata = '';

            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {

                if (resultdata.data) {

                    if (resultdata.data.length > 0) {

                        for (var i in resultdata.data) {

                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidehtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                        }

                    }

                }

            }

            $('#blackinclusionid').html(htmldata);

            $('#s_fltmyblackinclusionid').html(mysidehtmldata);

            $('#s_fltblackinclusionid').html(mysidehtmldata);

            if (blackinclusionid) {

                $("#blackinclusionid").val(blackinclusionid.split(',')).trigger('change');

            }

            $('#blackinclusionid').select2();

            $('#s_fltmyblackinclusionid').select2();

            $('#s_fltblackinclusionid').select2();

        }



        function OnErrorlistblackinclusion(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    }





    /* ******Location*******  */

    function listlocation(locationid = '') {



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

            var mysidehtmldata = '';

            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {

                if (resultdata.data.length > 0) {

                    for (var i in resultdata.data) {

                        htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                        mysidehtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                    }

                }



            }

            $('#countryid').html(htmldata);

            $('#s_fltmycountryid').html(mysidehtmldata);

            $('#s_fltcountryid').html(mysidehtmldata);

            if (locationid) {

                $("#countryid").val(locationid.split(',')).trigger('change');

            }

            $('#countryid').select2();

            $('#s_fltmycountryid').select2();

            $('#s_fltcountryid').select2();

        }



        function OnErrorlistlocation(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    }



    /* ******Cut*******  */



    function listcut(fromcutid = '', tocutid = '') {

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

            var mysidefromhtmldata = '';

            var mysidetohtmldata = '';



            htmldata += '<option value="">Select From Cut</option>';

            form_htmldata += '<option value="">Select To Cut</option>';

            mysidefromhtmldata += '<option value="">From Cut</option>';

            mysidetohtmldata += '<option value="">To Cut</option>';



            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {

                if (resultdata.data) {

                    if (resultdata.data.length > 0) {

                        for (var i in resultdata.data) {

                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';



                            mysidefromhtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidetohtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';



                        }

                    }

                }



            }

            $('#fromcutid').html(htmldata);



            $('#s_fltmyfromcutid').html(mysidefromhtmldata);

            $('#s_fltmytocutid').html(mysidetohtmldata);

            $('#s_fltfromcutid').html(mysidefromhtmldata);

            $('#s_flttocutid').html(mysidetohtmldata);

            if (fromcutid) {

                $('#fromcutid').val(fromcutid);

            }

            $('#fromcutid').select2();

            $('#tocutid').html(form_htmldata);

            if (tocutid) {

                $('#tocutid').val(tocutid);

            }

            $('#tocutid').select2();

            $('#s_fltmyfromcutid').select2();

            $('#s_fltmytocutid').select2();

            $('#s_fltfromcutid').select2();

            $('#s_flttocutid').select2();

        }



        function OnErrorlistcut(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    }





    /* ******Polish*******  */



    function listpolish(frompolishid = '', topolishid = '') {

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

            var mysidefromhtmldata = '';

            var mysidetohtmldata = '';

            htmldata += '<option value="">Select From Polish</option>';

            form_htmldata += '<option value="">Select To Polish</option>';

            mysidefromhtmldata += '<option value="">From Polish</option>';

            mysidetohtmldata += '<option value="">To Polish</option>';

            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {

                if (resultdata.data) {

                    if (resultdata.data.length > 0) {

                        for (var i in resultdata.data) {

                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidefromhtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidetohtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                        }

                    }

                }





            }

            $('#frompolishid').html(htmldata);

            $('#s_fltmyfrompolishid').html(mysidefromhtmldata);

            $('#s_fltmytopolishid').html(mysidetohtmldata);

            $('#s_fltfrompolishid').html(mysidefromhtmldata);

            $('#s_flttopolishid').html(mysidetohtmldata);

            if (frompolishid) {

                $('#frompolishid').val(frompolishid);

            }

            $('#frompolishid').select2();



            $('#topolishid').html(form_htmldata);

            if (topolishid) {

                $('#topolishid').val(topolishid);

            }

            $('#topolishid').select2();



            $('#s_fltmyfrompolishid').select2();

            $('#s_fltmytopolishid').select2();

            $('#s_fltfrompolishid').select2();

            $('#s_flttopolishid').select2();

        }



        function OnErrorlistpolish(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    }





    /* ******Symmetry*******  */



    function listsymmetry(fromsymmetryid = '', tosymmetryid = '') {

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

            var mysidefromhtmldata = '';

            var mysidetohtmldata = '';

            htmldata += '<option value="">Select From Symmetry</option>';

            form_htmldata += '<option value="">Select To Symmetry</option>';

            mysidefromhtmldata += '<option value="">From Symmetry</option>';

            mysidetohtmldata += '<option value="">To Symmetry</option>';

            if (resultdata.status == 0) {

                // Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {

                if (resultdata.data) {

                    if (resultdata.data.length > 0) {

                        for (var i in resultdata.data) {

                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            form_htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidefromhtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                            mysidetohtmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';

                        }

                    }

                }





            }

            $('#fromsymmetryid').html(htmldata);

            $('#s_fltmyfromsymmetryid').html(mysidefromhtmldata);

            $('#s_fltmytosymmetryid').html(mysidetohtmldata);

            $('#s_fltfromsymmetryid').html(mysidefromhtmldata);

            $('#s_flttosymmetryid').html(mysidetohtmldata);

            if (fromsymmetryid) {

                $('#fromsymmetryid').val(fromsymmetryid);

            }

            $('#fromsymmetryid').select2();



            $('#tosymmetryid').html(form_htmldata);

            if (tosymmetryid) {

                $('#tosymmetryid').val(tosymmetryid);

            }

            $('#tosymmetryid').select2();

            $('#s_fltmyfromsymmetryid').select2();

            $('#s_fltmytosymmetryid').select2();

            $('#s_fltfromsymmetryid').select2();

            $('#s_flttosymmetryid').select2();

        }



        function OnErrorlistsymmetry(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    }







    $('#buyrequestModal').on('shown.bs.modal', function() {



        if ($('#form-buy-request').length) {

            $('#form-buy-request').validate({

                rules: {

                    expirydate: {

                        required: true,

                    },

                    'shapeid[]': {

                        required: true,

                    },

                    'countryid[]': {

                        required: true,

                    },

                    fromsize: {

                        required: true,

                        number: true,

                    },

                    tosize: {

                        required: true,

                        number: true,

                        greaterThan: '#fromsize',

                    },

                    fromcolorid: {

                        required: true,

                    },

                    tocolorid: {

                        required: true,

                    },

                    fromlength: {

                        number: true,

                    },

                    tolength: {

                        number: true,

                        greaterThan: '#fromlength',

                    },

                    fromwidth: {

                        number: true,

                    },

                    towidth: {

                        number: true,

                        greaterThan: '#fromwidth',

                    },

                    fromdepth: {

                        number: true,

                    },

                    todepth: {

                        number: true,

                        greaterThan: '#fromdepth',

                    },

                    fromtable: {

                        number: true,

                    },

                    totable: {

                        number: true,

                        greaterThan: '#fromtable',

                    },

                    fromdepthper: {

                        number: true,

                    },

                    todepthper: {

                        number: true,

                        greaterThan: '#fromdepthper',

                    },

                    fromratio: {

                        number: true,

                    },

                    toratio: {

                        number: true,

                        greaterThan: '#fromratio',

                    },

                    price: {

                        number: true,

                    }

                },

                messages: {

                    expirydate: {

                        required: "Expiration Date is required",

                    },

                    'shapeid[]': {

                        required: "Shape is required",

                    },

                    'countryid[]': {

                        required: "Location is required",

                    },

                    fromsize: {

                        required: "From Size is required",

                    },

                    tosize: {

                        required: "To Size is required",

                        greaterThan: "To Size greater than or equal From Size",

                    },

                    fromcolorid: {

                        required: "From Color is required",

                    },

                    tocolorid: {

                        required: "To Color is required",

                    },

                    tolength: {

                        greaterThan: "To Length greater than or equal From Length",

                    },

                    towidth: {

                        greaterThan: "To Width greater than or equal From Width",

                    },

                    todepth: {

                        greaterThan: "To Depth greater than or equal From Depth",

                    },

                    totable: {

                        greaterThan: "To Table greater than or equal From Table",

                    },

                    todepthper: {

                        greaterThan: "To Depth(%) greater than or equal From Depth(%)",

                    },

                    toratio: {

                        greaterThan: "To Ratio greater than or equal From Ratio",

                    },

                },

                submitHandler: function(form) {



                    showloader();

                    $('#btnbuyrequestsubmit').attr('disabled',true);

                    var pagename = getpagename();

                    var useraction = $('#formevent').val();

                    formdata = new FormData(form);

                    formdata.append("action", "addbuyrequest");

                    var headersdata = {

                        'Accept': 'application/json',

                        platform: 4,

                        userpagename: pagename,

                        useraction: useraction,

                        masterlisting: false

                    };

                    ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>buyrequest', formdata, headersdata, Onsuccessaddbuyrequest, OnErroraddbuyrequest)



                    function Onsuccessaddbuyrequest(data) {

                        // hideloader();

                        hideloader();

                        var JsonData = JSON.stringify(data);

                        var resultdata = jQuery.parseJSON(JsonData);

                        $('#btnbuyrequestsubmit').attr('disabled',false);

                        if (resultdata.IsPackageExpire == 1) {

                            Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});

                        }

                        else{

                            if (resultdata.status == 0) {

                                Notiflix.Notify.Failure(resultdata.message);

                            } else if (resultdata.status == 1) {

                                Notiflix.Notify.Success(resultdata.message);

                                $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

                                listmybuyrequestdata(1);

                                $('#buyrequestModal').modal('hide');

                                $('.chart-loading').show();

                                resetbuyresquestform();

                            }else if(resultdata.status == -1)

                            {

                                $('#btnlogout').trigger('click');

                            }

                        }   



                    }



                    function OnErroraddbuyrequest(content) {



                    }

                },

            });

        }

    });







    $('body').on('input', '.inputper', function() {

        var per = parseFloat($(this).val());

        if (per > 100) {

            $(this).val(100);

        }

    });



    $('body').on('input', '.inputval', function() {

        var inputval = parseFloat($(this).val());

        if (!inputval) {

            $(this).val(0);

        }

    });





    function resetbuyresquestform() {

        $("#form-buy-request").validate().resetForm();

        $('#form-buy-request').trigger("reset");

        $('#form-buy-request .select2').select2();

        $('#form-buy-request #formevent').val('submit');

        $('#form-buy-request #id').val('');

        $('#form-buy-request #btnbuyrequestsubmit').html('Save');

        $('.buyrequestformtext').html('Add New');

        $('#isfancy').prop('checked', false);

        $('#form-buy-request .nonfancyDiv').removeClass('d-none');

        $('#form-buy-request .fancyDiv').addClass('d-none');

    }











    /* ************************************** MANAGE MY BUY REQUEST******************************************** */



    $('body').on('change', '#mybuyrequest_per_page', function() {

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        $("#listmybuyrequestData").animate({

            scrollTop: 0

        }, "slow");

        listmybuyrequestdata(1);

    });



    $('body').on('change', '#mybuyrequestsortbyid', function() {

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        $("#listmybuyrequestData").animate({

            scrollTop: 0

        }, "slow");

        listmybuyrequestdata(1);

    });



    $('#listmybuyrequestDatatbl tbody').scroll(function() {

        if ($(this).scrollTop() +

            $(this).innerHeight() >=

            $(this)[0].scrollHeight) {

            // //console.log('Here');

            var dataact = getpagename();

            var show = $('#listmybuyrequestDatatbl').attr('data-show');

            if (dataact && show == 1) {

                listmybuyrequestdata(1);

            }

        }

    });



    function listmybuyrequestdata(page, form = '') {



        // showloader();

        // showloader();



        $('.chart-loading').show();

        var pagename = getpagename();

        var useraction = $('#formevent').val();

        var sortbyid = $('#mybuyrequestsortbyid').val();





        var buyrequest_per_page = $('#mybuyrequest_per_page').val();

        var nextpage = 0;

        if ($('#listmybuyrequestDatatbl').attr('data-nextpage') > 0) {

            nextpage = $('#listmybuyrequestDatatbl').attr('data-nextpage');

        }



        var formdata = new FormData();

        if (form != '') {

            formdata = new FormData(document.getElementById(form));

        }



        formdata.append("action", "listbuyrequest");

        formdata.append("nextpage", parseInt(nextpage) + 1);

        formdata.append("fltmanagemybuyrequest", 1);

        formdata.append("perpage", buyrequest_per_page);

        formdata.append("sortbyid", sortbyid);



        var headersdata = {

            'Accept': 'application/json',

            platform: 4,

            userpagename: pagename,

            useraction: useraction,

            masterlisting: false

        };

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>buyrequest', formdata, headersdata, Onsuccesslistmybuyrequestdata, OnErrorlistmybuyrequestdata)



        function Onsuccesslistmybuyrequestdata(data) {

            //  hideloader();

            $('.chart-loading').hide();

            var JsonData = JSON.stringify(data);

            var resultdata = jQuery.parseJSON(JsonData);



            var htmldata = '';

            if (resultdata.IsPackageExpire == 1) {

                Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});

            }

            else{

                if (resultdata.status == 0) {



                    htmldata += '<tr>';

                    htmldata += '<td colspan="16">';

                    htmldata += '<h3>' + resultdata.message + '</h3>';

                    htmldata += '</td>';

                    htmldata += '</tr>';



                    $('#listmybuyrequestData').html(htmldata);

                    $('#showmybuyrequestentries').html(0);



                    $('.totalmybuyrequest').html('0 Requests');







                } else if (resultdata.status == 1) {

                    if (resultdata.totalbuyrequest >= 0 && resultdata.totalbuyrequest != null) {

                        // //console.log('totaldiamond'+resultdata.totaldiamond);

                        // //console.log('totalprice'+resultdata.totalprice);

                        $('.totalmybuyrequest').html(resultdata.totalbuyrequest + ' Requests');

                    }



                    for (var i in resultdata.data) {

                        var buyrequestdata = resultdata.data[i];





                        htmldata += '<tr class="" data-buyrequestid="' + buyrequestdata.id + '">';

                        htmldata += '<td class="showmybuyrequestdetails text-center" data-buyrequestid="' + buyrequestdata.id + '">' + buyrequestdata.buyrequestno + '</td>';

                        htmldata += '<td class="showmybuyrequestdetails text-left" data-buyrequestid="' + buyrequestdata.id + '">' + buyrequestdata.typetext + '</td>';

                        htmldata += '<td class="showmybuyrequestdetails text-center" data-buyrequestid="' + buyrequestdata.id + '">' + buyrequestdata.createdate + '</td>';

                        htmldata += '<td class="showmybuyrequestdetails text-center" data-buyrequestid="' + buyrequestdata.id + '">' + buyrequestdata.expirydate + '</td>';

                        htmldata += '<td class="showmybuyrequestdetails text-left" data-buyrequestid="' + buyrequestdata.id + '">' + buyrequestdata.shape + '</td>';

                        htmldata += '<td class="showmybuyrequestdetails text-left" data-buyrequestid="' + buyrequestdata.id + '">' + buyrequestdata.fromsize + '-' + buyrequestdata.tosize + '</td>';

                        htmldata += '<td class="showmybuyrequestdetails text-left" data-buyrequestid="' + buyrequestdata.id + '">' + buyrequestdata.fromcolor + '-' + buyrequestdata.tocolor + '</td>';

                        htmldata += '<td class="showmybuyrequestdetails text-left" data-buyrequestid="' + buyrequestdata.id + '">' + buyrequestdata.country + '</td>';

                        htmldata += '<td class="text-right">';

                        htmldata += '<a href="javascript:void(0);" class="btn editmybuyrequest" title="Edit ' + buyrequestdata.buyrequestno + '" data-name="' + buyrequestdata.buyrequestno + '" data-buyrequestid="' + buyrequestdata.id + '"><i class="fas fa-edit"></i></a>';

                        htmldata += '<a href="javascript:void(0);" class="btn deletemybuyrequest" title="Delete ' + buyrequestdata.buyrequestno + '" data-name="' + buyrequestdata.buyrequestno + '" data-buyrequestid="' + buyrequestdata.id + '"><i class="fas fa-trash-alt"></i></a>';



                        htmldata += '</td>';

                        htmldata += '</tr>';

                    }



                    if (resultdata.nextpage == 1) {

                        $('#listmybuyrequestData').html(htmldata);

                    } else {

                        $('#listmybuyrequestData').append(htmldata);

                    }

                    $('#showmybuyrequestentries').html(resultdata.showentries);



                    $('#listmybuyrequestDatatbl').attr('data-nextpage', resultdata.nextpage);

                    if (resultdata.loadmore == 1) {

                        $('#listmybuyrequestDatatbl').attr('data-show', 1);

                    } else {

                        $('#listmybuyrequestDatatbl').attr('data-show', 0);

                    }



                    $('.deletemybuyrequest').on('click', function() {

                        var id = $(this).attr('data-buyrequestid');

                        var name = $(this).attr('data-name');

                        Notiflix.Confirm.Show(false, 'Are you want to delete "' + name + '"?', false, false, function() {

                            showloader();

                            var pagename = getpagename();

                            var useraction = $('#formevent').val();

                            deleteformdata = new FormData();

                            deleteformdata.append("action", "deletebuyrequest");

                            deleteformdata.append("id", id);

                            var headersdata = {

                                'Accept': 'application/json',

                                platform: 4,

                                userpagename: pagename,

                                useraction: useraction,

                                masterlisting: false

                            };

                            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>buyrequest', deleteformdata, headersdata, Onsuccessdeletebuyrequest, OnErrordeletebuyrequest)



                            function Onsuccessdeletebuyrequest(data) {

                                hideloader();

                                var JsonData = JSON.stringify(data);

                                var resultdeletedata = jQuery.parseJSON(JsonData);



                                if (resultdeletedata.status == 0) {

                                    Notiflix.Notify.Failure(resultdeletedata.message);

                                } else if (resultdeletedata.status == 1) {

                                    Notiflix.Notify.Success(resultdeletedata.message);

                                    $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

                                    listmybuyrequestdata(1);

                                }else if(resultdeletedata.status == -1)

                                {

                                    $('#btnlogout').trigger('click');

                                }



                            }



                            function OnErrordeletebuyrequest(content) {



                            }



                        }, function() {



                        });

                    });



                    $('.editmybuyrequest').on('click', function() {

                        var id = $(this).attr('data-buyrequestid');



                        showloader();

                        var pagename = getpagename();

                        var useraction = $('#formevent').val();

                        editformdata = new FormData();

                        editformdata.append("action", "listbuyrequest");

                        editformdata.append("id", id);

                        editformdata.append("nextpage", 1);

                        editformdata.append("perpage", 1);

                        var headersdata = {

                            'Accept': 'application/json',

                            platform: 4,

                            userpagename: pagename,

                            useraction: useraction,

                            masterlisting: false

                        };

                        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>buyrequest', editformdata, headersdata, Onsuccesseditbuyrequest, OnErroreditbuyrequest)



                        function Onsuccesseditbuyrequest(data) {

                            hideloader();

                            var JsonData = JSON.stringify(data);

                            var resulteditdata = jQuery.parseJSON(JsonData);



                            if (resulteditdata.status == 0) {

                                Notiflix.Notify.Failure(resulteditdata.message);

                            } else if (resulteditdata.status == 1) {



                                $('#form-buy-request #id').val(id);

                                $('#form-buy-request #formevent').val('update');

                                $('#form-buy-request #btnbuyrequestsubmit').html('Update');

                                $('.buyrequestformtext').html('Update');



                                for (var i in resulteditdata.data) {

                                    var editdata = resulteditdata.data[i];



                                    if (editdata.type == 1) {

                                        $('#form-buy-request #ispublic').prop('checked', true);

                                    } else if (editdata.type == 2) {

                                        $('#form-buy-request #isanonymous').prop('checked', true);

                                    } else if (editdata.type == 2) {

                                        $('#form-buy-request #isprivate').prop('checked', true);

                                    }

                                    $('#form-buy-request #isgetnotification').prop('checked', false);

                                    if (editdata.isgetnotification == 1) {

                                        $('#form-buy-request #isgetnotification').prop('checked', true);

                                    }

                                    $('#form-buy-request #comment').val(editdata.comment);

                                    listshape(editdata.shapeid);

                                    $('#form-buy-request #fromsize').val(editdata.fromsize);

                                    $('#form-buy-request #tosize').val(editdata.tosize);



                                    $('#form-buy-request #isfancy').prop('checked', false);

                                    if (editdata.isfancy == 1) {

                                        $('#form-buy-request #isfancy').prop('checked', true);

                                        listfancyintensity(editdata.fromintensityid, editdata.tointensityid);

                                        listovertone(editdata.overtoneid);

                                        listfluorescencecolor(editdata.fluorescenecolorid);

                                        $('.nonfancyDiv').addClass('d-none');

                                        $('.fancyDiv').removeClass('d-none');

                                    } else {

                                        $('.nonfancyDiv').removeClass('d-none');

                                        $('.fancyDiv').addClass('d-none');

                                        listcolor(editdata.fromcolorid, editdata.tocolorid);

                                    }

                                    listclarity(editdata.fromclarityid, editdata.toclarityid);

                                    if(editdata.intensityid)

                                    {

                                        if(editdata.intensityid.length>0)

                                        {

                                            var intensityid = editdata.intensityid.split(',');

                                            if (intensityid.length > 0) {

                                                for (var ii in intensityid) {

                                                    $('#intensityid' + intensityid[ii] + '').prop('checked', true);

                                                }

                                            }

                                        }

                                    }    

                                        

                                    listfluorescencecolor(editdata.fluorescenecolorid, editdata.colorid);

                                    if(editdata.labid)

                                    {

                                        if(editdata.labid.length>0)

                                        {

                                            var labid = editdata.labid.split(',');

                                            if (labid.length > 0) {

                                                for (var ii in labid) {

                                                    $('#labid' + labid[ii] + '').prop('checked', true);

                                                }

                                            }

                                        }    

                                    }    

                                    $('#form-buy-request #fromlength').val(editdata.fromlength);

                                    $('#form-buy-request #tolength').val(editdata.tolength);



                                    $('#form-buy-request #fromwidth').val(editdata.fromwidth);

                                    $('#form-buy-request #towidth').val(editdata.towidth);



                                    $('#form-buy-request #fromdepth').val(editdata.fromdepth);

                                    $('#form-buy-request #todepth').val(editdata.todepth);



                                    $('#form-buy-request #fromtable').val(editdata.fromtable);

                                    $('#form-buy-request #totable').val(editdata.totable);



                                    $('#form-buy-request #fromdepthper').val(editdata.fromdepthper);

                                    $('#form-buy-request #todepthper').val(editdata.todepthper);



                                    $('#form-buy-request #fromratio').val(editdata.fromratio);

                                    $('#form-buy-request #toratio').val(editdata.toratio);



                                    listeyeclean(editdata.eyecleanid);

                                    listmilky(editdata.frommilkyid, editdata.tomilkyid);

                                    listopeninclusion(editdata.openinclusionid);

                                    listwhiteinclusion(editdata.whiteinclusionid);

                                    listblackinclusion(editdata.blackinclusionid);



                                    $('#form-buy-request #price').val(editdata.price);



                                    listlocation(editdata.countryid);

                                    listcut(editdata.fromcutid, editdata.tocutid);

                                    listpolish(editdata.frompolishid, editdata.topolishid);

                                    listsymmetry(editdata.fromsymmetryid, editdata.tosymmetryid);







                                }

                                $('#buyrequestModal').modal('show');



                            }

                            else if(resulteditdata.status == -1)

                            {

                                $('#btnlogout').trigger('click');

                            }

                        }



                        function OnErroreditbuyrequest(content) {



                        }



                    });





                }else if(resultdata.status == -1)

                {

                    $('#btnlogout').trigger('click');

                }

            }    



        }



        function OnErrorlistmybuyrequestdata(content) {



        }



    }







    $('body').on('click', '.showmybuyrequestdetails', function() {



        $('.chart-loading').show();

        var id = $(this).attr('data-buyrequestid');



        // showloader();

       

        var pagename = getpagename();

        var useraction = $('#formevent').val();

        viewformdata = new FormData();

        viewformdata.append("action", "listbuyrequest");

        viewformdata.append("id", id);

        viewformdata.append("nextpage", 1);

        viewformdata.append("perpage", 1);

        var headersdata = {

            'Accept': 'application/json',

            platform: 4,

            userpagename: pagename,

            useraction: useraction,

            masterlisting: false

        };

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>buyrequest', viewformdata, headersdata, Onsuccessviewbuyrequest, OnErrorviewbuyrequest)



        function Onsuccessviewbuyrequest(data) {

            // hideloader();

            $('.chart-loading').hide();

            var JsonData = JSON.stringify(data);

            var resultviewdata = jQuery.parseJSON(JsonData);

            var htmldata = '';

            if (resultviewdata.IsPackageExpire == 1) {

                Notiflix.Report.Warning(resultviewdata.ExpiryTitle,resultviewdata.message, false, function(){window.location=resultviewdata.ExpiryURL;});

            }

            else{

                if (resultviewdata.status == 0) {

                    Notiflix.Notify.Failure(resultviewdata.message);

                } else if (resultviewdata.status == 1) {



                    for (var i in resultviewdata.data) {

                        var viewdata = resultviewdata.data[i];



                        $('#BuyRequestDetailsModal #BuyRequestDetailsText').html(viewdata.cmpname + ' | ' + viewdata.buyrequestno);



                        htmldata += '<div class="req-new">';

                            htmldata += '<div class="setnamealby">' + viewdata.shape + ', ' + viewdata.fromsize + ' - ' + viewdata.tosize + '</div>';

                            htmldata += '<div class="row">';

                                htmldata += '<div class="col-md-6">';

                                    htmldata += '<div class="resallby text-left">' + viewdata.country + '</div>';

                                    htmldata += '<div class="set-data-req">';

                                        htmldata += '<div class="se-type">';

                                            htmldata += '<p>Type :<span> ' + viewdata.typetext + '</span> </p>';

                                        htmldata += '</div>';

                                    htmldata += '</div>';

                                htmldata += '</div>';



                                var getnotitext = 'No';

                                if (viewdata.isgetnotification == 1) {

                                    getnotitext = 'Yes';

                                }





                                htmldata += '<div class="col-md-6">';

                                    htmldata += '<div class="se-type">';

                                            htmldata += '<p> Get Notification :<span> '+getnotitext+'</span> </p>';

                                        htmldata += '</div>';

                                        htmldata += '<div class="se-type">';

                                            htmldata += '<p>Request Person :<span>  ' + viewdata.personname + '</span> </p>';

                                        htmldata += '</div>';

                                    // htmldata += '<div class="noteallby text-right">';

                                    //     <?php 

                                    //     if($CanMemberToMemberChat==1)

                                    //     {

                                    //     ?>

                                    //         if(viewdata.canresponse==1)

                                    //         {

                                    //             htmldata += '<div class="setresalbu"><a href="javascript:void(0);" class="btnsendbuyrequestrespond" data-buyrequestname="' + viewdata.buyrequestno + ' | ' + viewdata.shape + ', ' + viewdata.fromsize + ' - ' + viewdata.tosize + '" data-buyrequestid="' + viewdata.id + '">';

                                    //                 htmldata += '<div class="imgallreqse">                             ';

                                    //                     htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/back.svg" alt="Respond to buy request" title="Respond to buy request">                         ';

                                    //                 htmldata += '</div>                         ';

                                    //                 htmldata += '<h5>Respond</h5></a>                     ';

                                    //             htmldata += '</div>                 ';

                                    //         }    

                                    //     <?php 

                                    //     } ?>     

                                    // htmldata += '</div>';

                                htmldata += '</div>';

                            htmldata += '</div>';

                        htmldata += '</div>';







                        htmldata += '         <div class="req-info">';

                        htmldata += '             Request Info ';

                        htmldata += '         </div>';





                        htmldata+='<div class="col-12 buy-id">';

                            htmldata+='<div class="row">';

                                htmldata+='<div class="col-md-6">';

                                    htmldata+='<div class="card">';

                                        htmldata+='<div class="card-body">';

                                            htmldata+='<div class="row">';

                                                htmldata+='<div class="col-md-6 col-sm-6 col-6 set-sh-buy">';

                                                    htmldata+='<p>Buy Request#</p>';

                                                    htmldata+='<p>Shape</p>';

                                                    htmldata+='<p>Size</p>';

                                                    if (viewdata.isfancy == 1) {

                                                        htmldata+='<p>Intensity</p>';  

                                                        htmldata+='<p>Overtone</p>';

                                                        htmldata+='<p>Color</p>';

                                                    }

                                                    else

                                                    {

                                                        htmldata+='<p>Color</p>';

                                                    }    

                                                    htmldata+='<p>Clarity</p>';

                                                    htmldata+='<p>Cut</p>';

                                                    htmldata+='<p>Polish</p>';

                                                    htmldata+='<p>Symmetry</p>';

                                                    htmldata+='<p>Fluorescence Intensity</p>';

                                                    htmldata+='<p>Fluorescence Color</p>';

                                                    htmldata+='<p>Lab</p>';

                                                    htmldata+='<p>Price($)</p>';

                                                    htmldata+='<p>Eye Clean</p>';

                                                    htmldata+='<p>Milky</p>';

                                                htmldata+='</div>';

                                                htmldata+='<div class="col-md-6 col-sm-6 col-6 setna">';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.buyrequestno + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.shape + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromsize + '-' + viewdata.tosize + '</p>';

                                                    if (viewdata.isfancy == 1) {

                                                        htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromintensity + '-' + viewdata.tointensity + '</p>';

                                                        htmldata+='<p>: &nbsp;&nbsp;' + viewdata.overtone + '</p>';

                                                        htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fluorescenecolor + '</p>';

                                                    }

                                                    else

                                                    {

                                                        htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromcolor + '-' + viewdata.tocolor + '</p>';

                                                    }

                                                        



                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromclarity + '-' + viewdata.toclarity + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromcut + '-' + viewdata.tocut + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.frompolish + '-' + viewdata.topolish + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromsymmetry + '-' + viewdata.tosymmetry + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.intensity + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.color + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.lab + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;$' + viewdata.price + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.eyeclean + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.frommilky + '-' + viewdata.tomilky + '</p>';

                                                htmldata+='</div>';

                                            htmldata+='</div>';

                                        htmldata+='</div>';

                                    htmldata+='</div>';

                                htmldata+='</div>';

                                htmldata+='<div class="col-md-6 setrespr">';

                                    htmldata+='<div class="card">';

                                        htmldata+='<div class="card-body">';

                                            htmldata+='<div class="row">';

                                                htmldata+='<div class="col-md-6 col-sm-6 col-6 set-sh-buy ">';

                                                

                                                    htmldata+='<p>Black Inclusion</p>';

                                                    htmldata+='<p>White Inclusion</p>';

                                                    htmldata+='<p>Open Inclusion</p>';

                                                    htmldata+='<p>Length</p>';

                                                    htmldata+='<p>Width</p>';

                                                    htmldata+='<p>Depth</p>';

                                                    htmldata+='<p>Table</p>';

                                                    htmldata+='<p>Depth(%)</p>';

                                                    htmldata+='<p>Ratio</p>';

                                                    htmldata+='<p>Create Date</p>';

                                                    htmldata+='<p>Expiration Date</p>';

                                                htmldata+='</div>';

                                                htmldata+='<div class="col-md-6 col-sm-6 col-6 setna">';

                                                

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.blackinclusion + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.whiteinclusion + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.openinclusion + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromlength + '-' + viewdata.tolength + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromwidth + '-' + viewdata.towidth + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromdepth + '-' + viewdata.todepth + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromtable + '-' + viewdata.totable + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromdepthper + '-' + viewdata.todepthper + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromratio + '-' + viewdata.toratio + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.createdate + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.expirydate + '</p>';

                                                htmldata+='</div>';

                                            htmldata+='</div>';

                                        htmldata+='</div>';

                                    htmldata+='</div>';

                                htmldata+='</div>';

                            htmldata+='</div>';

                        htmldata+='</div>';

                                        

                        htmldata += '         <div class="commentallby">';

                        htmldata += '             <div class="writeboxjw">';

                        htmldata += '                 <label for="description" class="col-form-label">Comment : ' + viewdata.comment + '</label>';

                        htmldata += '             </div>';

                        htmldata += '         </div>';

                        htmldata += '     </div>';

                        htmldata += ' </div>';





                    }

                    $('#BuyRequestDetailsModal #BuyRequestDetailsData').html(htmldata);

                    $('#BuyRequestDetailsModal').modal('show');



                }else if(resultviewdata.status == -1)

                {

                    $('#btnlogout').trigger('click');

                }

            }        

        }



        function OnErrorviewbuyrequest(content) {



        }





    });



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





    $('#s_fltmyfromdate').datepicker({

        dateFormat: 'dd/mm/yy',

        onClose: function(selectedDate) {

            $("#s_fltmytodate").datepicker("option", "minDate", selectedDate);

            checksidemybuyrequestformelementvalue();

            getmybuyrequestfiltersvalue();

        }

    });



    $('#s_fltmytodate').datepicker({

        dateFormat: 'dd/mm/yy',

        onClose: function(selectedDate) {

            checksidemybuyrequestformelementvalue();

            getmybuyrequestfiltersvalue();

        }

    });





    $('#s_fltmyfromexpirydate').datepicker({

        dateFormat: 'dd/mm/yy',

        minDate: 0,

        onClose: function(selectedDate) {

            $("#s_fltmytoexpirydate").datepicker("option", "minDate", selectedDate);

            checksidemybuyrequestformelementvalue();

            getmybuyrequestfiltersvalue();

        }

    });



    $('#s_fltmytoexpirydate').datepicker({

        dateFormat: 'dd/mm/yy',

        minDate: 0,

        onClose: function(selectedDate) {

            checksidemybuyrequestformelementvalue();

            getmybuyrequestfiltersvalue();

        }

    });



    if ($('#form-mybuyrequest-filter').length) {

        $('#form-mybuyrequest-filter').validate({

            rules: {

                fltfromprice: {

                    number: true,

                },

                flttoprice: {

                    number: true,

                    greaterThan: '#s_fltmyfromprice',

                },

                fltfromsize: {

                    number: true,

                },

                flttosize: {

                    number: true,

                    greaterThan: '#s_fltmytosize',

                },



            },

            messages: {

                flttoprice: {

                    greaterThan: "To Price greater than or equal From Price",

                },

                flttosize: {

                    greaterThan: "To Size greater than or equal From Size",

                },



            },

            submitHandler: function(form) {



                var isvalid = checksidemybuyrequestformelementvalue();

                if (isvalid > 0) {

                    fillsearchmybuyrequestlist();

                    $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

                    $("#wrapper-mybuyrequest.toggled").toggleClass("intro");

                    listmybuyrequestdata(1, 'form-mybuyrequest-filter');

                } else {

                    Notiflix.Notify.Failure('Please select at least one filter');

                }





            },

        });

    }





    $('body').on('change', '#form-mybuyrequest-filter input[type=checkbox]', function() {

        checksidemybuyrequestformelementvalue();

        getmybuyrequestfiltersvalue();

    });



    $('body').on('change', '#form-mybuyrequest-filter  .select2', function() {

        checksidemybuyrequestformelementvalue();

        getmybuyrequestfiltersvalue();

    });



    $('body').on('input', '#form-mybuyrequest-filter #s_fltmyfromsize,#s_fltmytosize,#s_fltmyfromprice,#s_fltmytoprice', function() {

        checksidemybuyrequestformelementvalue();

        getmybuyrequestfiltersvalue();

    });



    function checksidemybuyrequestformelementvalue() {



        var issearchbtn = 0;

        $('#form-mybuyrequest-filter input[type=checkbox]').each(function() {

            if (this.checked) {

                issearchbtn++;

                return false;

            }

        });



        var s_fltmyfromprice = $('#form-mybuyrequest-filter #s_fltmyfromprice').val();

        var s_fltmytoprice = $('#form-mybuyrequest-filter #s_fltmytoprice').val();

        if (s_fltmyfromprice && s_fltmytoprice > 0) {

            issearchbtn++;

        }



        var s_fltmyfromsize = $('#form-mybuyrequest-filter #s_fltmyfromsize').val();

        var s_fltmytosize = $('#form-mybuyrequest-filter #s_fltmytosize').val();

        if (s_fltmyfromsize && s_fltmytosize > 0) {

            issearchbtn++;

        }



        var s_fltmyshapeid = $('#form-mybuyrequest-filter #s_fltmyshapeid').val();

        if (s_fltmyshapeid.length > 0) {

            issearchbtn++;

        }



        var s_fltmyfromcolorid = $('#form-mybuyrequest-filter #s_fltmyfromcolorid').val();

        var s_fltmytocolorid = $('#form-mybuyrequest-filter #s_fltmytocolorid').val();

        if (s_fltmyfromcolorid && s_fltmytocolorid) {

            issearchbtn++;

        }



        var s_fltmyfromclarityid = $('#form-mybuyrequest-filter #s_fltmyfromclarityid').val();

        var s_fltmytoclarityid = $('#form-mybuyrequest-filter #s_fltmytoclarityid').val();

        if (s_fltmyfromclarityid && s_fltmytoclarityid) {

            issearchbtn++;

        }



        var s_fltmyfromcutid = $('#form-mybuyrequest-filter #s_fltmyfromcutid').val();

        var s_fltmytocutid = $('#form-mybuyrequest-filter #s_fltmytocutid').val();

        if (s_fltmyfromcutid && s_fltmytocutid) {

            issearchbtn++;

        }



        var s_fltmyfrompolishid = $('#form-mybuyrequest-filter #s_fltmyfrompolishid').val();

        var s_fltmytopolishid = $('#form-mybuyrequest-filter #s_fltmytopolishid').val();

        if (s_fltmyfrompolishid && s_fltmytopolishid) {

            issearchbtn++;

        }



        var s_fltmyfromsymmetryid = $('#form-mybuyrequest-filter #s_fltmyfromsymmetryid').val();

        var s_fltmytosymmetryid = $('#form-mybuyrequest-filter #s_fltmytosymmetryid').val();

        if (s_fltmyfromsymmetryid && s_fltmytosymmetryid) {

            issearchbtn++;

        }





        var s_fltmyintensityid = $('#form-mybuyrequest-filter #s_fltmyintensityid').val();

        if (s_fltmyintensityid.length > 0) {

            issearchbtn++;

        }



        var s_fltmycountryid = $('#form-mybuyrequest-filter #s_fltmycountryid').val();

        if (s_fltmycountryid.length > 0) {

            issearchbtn++;

        }



        var s_fltmyeyecleanid = $('#form-mybuyrequest-filter #s_fltmyeyecleanid').val();

        if (s_fltmyeyecleanid.length > 0) {

            issearchbtn++;

        }



        var s_fltmyfrommilkyid = $('#form-mybuyrequest-filter #s_fltmyfrommilkyid').val();

        var s_fltmytomilkyid = $('#form-mybuyrequest-filter #s_fltmytomilkyid').val();

        if (s_fltmyfrommilkyid && s_fltmytomilkyid) {

            issearchbtn++;

        }



        var s_fltmyopeninclusionid = $('#form-mybuyrequest-filter #s_fltmyopeninclusionid').val();

        if (s_fltmyopeninclusionid.length > 0) {

            issearchbtn++;

        }



        var s_fltmywhiteinclusionid = $('#form-mybuyrequest-filter #s_fltmywhiteinclusionid').val();

        if (s_fltmywhiteinclusionid.length > 0) {

            issearchbtn++;

        }



        var s_fltmyblackinclusionid = $('#form-mybuyrequest-filter #s_fltmyblackinclusionid').val();

        if (s_fltmyblackinclusionid.length > 0) {

            issearchbtn++;

        }





        var s_fltmyfromdate = $('#form-mybuyrequest-filter #s_fltmyfromdate').val();

        var s_fltmytodate = $('#form-mybuyrequest-filter #s_fltmytodate').val();

        if (s_fltmyfromdate && s_fltmytodate) {

            issearchbtn++;

        }



        var s_fltmyfromexpirydate = $('#form-mybuyrequest-filter #s_fltmyfromexpirydate').val();

        var s_fltmytoexpirydate = $('#form-mybuyrequest-filter #s_fltmytoexpirydate').val();

        if (s_fltmyfromexpirydate && s_fltmytoexpirydate) {

            issearchbtn++;

        }



        $('#form-mybuyrequest-filter #btnapplymybuyrequestfilter').attr('disabled', true);

        if (issearchbtn > 0) {

            $('#form-mybuyrequest-filter #btnapplymybuyrequestfilter').attr('disabled', false);

        }



        return issearchbtn;

    }



    var s_fltmyseeonly = [];

    var s_fltmyfromprice = 0;

    var s_fltmytoprice = 0;

    var s_fltmyshape = [];

    var s_fltmyfromsize = 0;

    var s_fltmytosize = 0;



    var s_fltmyfromcolorid = '';

    var s_fltmyfromcolor = '';

    var s_fltmytocolorid = '';

    var s_fltmytocolor = '';



    var s_fltmyfromclarityid = '';

    var s_fltmyfromclarity = '';

    var s_fltmytoclarityid = '';

    var s_fltmytoclarity = '';





    var s_fltmyfromcutid = '';

    var s_fltmyfromcut = '';

    var s_fltmytocutid = '';

    var s_fltmytocut = '';



    var s_fltmyfrompolishid = '';

    var s_fltmyfrompolish = '';

    var s_fltmytopolishid = '';

    var s_fltmytopolish = '';





    var s_fltmyfromsymmetryid = '';

    var s_fltmyfromsymmetry = '';

    var s_fltmytosymmetryid = '';

    var s_fltmytosymmetry = '';





    var s_fltmylab = [];

    var s_fltmyintensity = [];

    var s_fltmycountry = [];

    var s_fltmyeyeclean = [];



    var s_fltmyfrommilkyid = '';

    var s_fltmyfrommilky = '';

    var s_fltmytomilkyid = '';

    var s_fltmytomilky = '';



    var s_fltmyopeninclusion = [];

    var s_fltmywhiteinclusion = [];

    var s_fltmyblackinclusion = [];



    var s_fltmyfromdate = '';

    var s_fltmytodate = '';



    var s_fltmyfromexpirydate = '';

    var s_fltmytoexpirydate = '';





    function getmybuyrequestfiltersvalue() {



        s_fltmyseeonly = [];

        $('#seeonlyDivData input[type=checkbox]').each(function() {

            if (this.checked) {

                s_fltmyseeonly.push({

                    'id': $(this).val(),

                    'name': $(this).attr('data-name')

                });

            }

        });

        s_fltmyfromprice = $('#form-mybuyrequest-filter #s_fltmyfromprice').val();

        s_fltmytoprice = $('#form-mybuyrequest-filter #s_fltmytoprice').val();





        s_fltmyshape = [];



        var s_fltmyshapeid = $('#s_fltmyshapeid').val();

        if (s_fltmyshapeid.length > 0) {

            for (var i = 0; i < s_fltmyshapeid.length; i++) {

                var id = $('#s_fltmyshapeid option[value=' + s_fltmyshapeid[i] + ']').val();

                var name = $('#s_fltmyshapeid option[value=' + s_fltmyshapeid[i] + ']').text();

                s_fltmyshape.push({

                    'id': id,

                    'name': name

                });

            }

        }



        s_fltmyfromsize = $('#form-mybuyrequest-filter #s_fltmyfromsize').val();

        s_fltmytosize = $('#form-mybuyrequest-filter #s_fltmytosize').val();



        s_fltmyfromcolorid = $('#form-mybuyrequest-filter #s_fltmyfromcolorid').val();

        s_fltmyfromcolor = $('#form-mybuyrequest-filter #s_fltmyfromcolorid option:selected').text();

        s_fltmytocolorid = $('#form-mybuyrequest-filter #s_fltmytocolorid').val();

        s_fltmytocolor = $('#form-mybuyrequest-filter #s_fltmytocolorid option:selected').text();



        s_fltmyfromclarityid = $('#form-mybuyrequest-filter #s_fltmyfromclarityid').val();

        s_fltmyfromclarity = $('#form-mybuyrequest-filter #s_fltmyfromclarityid option:selected').text();

        s_fltmytoclarityid = $('#form-mybuyrequest-filter #s_fltmytoclarityid').val();

        s_fltmytoclarity = $('#form-mybuyrequest-filter #s_fltmytoclarityid option:selected').text();





        s_fltmyfromcutid = $('#form-mybuyrequest-filter #s_fltmyfromcutid').val();

        s_fltmyfromcut = $('#form-mybuyrequest-filter #s_fltmyfromcutid option:selected').text();

        s_fltmytocutid = $('#form-mybuyrequest-filter #s_fltmytocutid').val();

        s_fltmytocut = $('#form-mybuyrequest-filter #s_fltmytocutid option:selected').text();





        s_fltmyfrompolishid = $('#form-mybuyrequest-filter #s_fltmyfrompolishid').val();

        s_fltmyfrompolish = $('#form-mybuyrequest-filter #s_fltmyfrompolishid option:selected').text();

        s_fltmytopolishid = $('#form-mybuyrequest-filter #s_fltmytopolishid').val();

        s_fltmytopolish = $('#form-mybuyrequest-filter #s_fltmytopolishid option:selected').text();



        s_fltmyfromsymmetryid = $('#form-mybuyrequest-filter #s_fltmyfromsymmetryid').val();

        s_fltmyfromsymmetry = $('#form-mybuyrequest-filter #s_fltmyfromsymmetryid option:selected').text();

        s_fltmytosymmetryid = $('#form-mybuyrequest-filter #s_fltmytosymmetryid').val();

        s_fltmytosymmetry = $('#form-mybuyrequest-filter #s_fltmytosymmetryid option:selected').text();



        s_fltmyfrommilkyid = $('#form-mybuyrequest-filter #s_fltmyfrommilkyid').val();

        s_fltmyfrommilky = $('#form-mybuyrequest-filter #s_fltmyfrommilkyid option:selected').text();

        s_fltmytomilkyid = $('#form-mybuyrequest-filter #s_fltmytomilkyid').val();

        s_fltmytomilky = $('#form-mybuyrequest-filter #s_fltmytomilkyid option:selected').text();





        s_fltmylab = [];

        $('#s_mylabData input[type=checkbox]').each(function() {

            if (this.checked) {

                s_fltmylab.push({

                    'id': $(this).val(),

                    'name': $(this).attr('data-name')

                });

            }

        });



        s_fltmyintensity = [];

        var s_fltmyintensityid = $('#s_fltmyintensityid').val();

        if (s_fltmyintensityid.length > 0) {

            for (var i = 0; i < s_fltmyintensityid.length; i++) {

                var id = $('#s_fltmyintensityid option[value=' + s_fltmyintensityid[i] + ']').val();

                var name = $('#s_fltmyintensityid option[value=' + s_fltmyintensityid[i] + ']').text();

                s_fltmyintensity.push({

                    'id': id,

                    'name': name

                });

            }

        }



        s_fltmycountry = [];

        var s_fltmycountryid = $('#s_fltmycountryid').val();

        if (s_fltmycountryid.length > 0) {

            for (var i = 0; i < s_fltmycountryid.length; i++) {

                var id = $('#s_fltmycountryid option[value=' + s_fltmycountryid[i] + ']').val();

                var name = $('#s_fltmycountryid option[value=' + s_fltmycountryid[i] + ']').text();

                s_fltmycountry.push({

                    'id': id,

                    'name': name

                });

            }

        }



        s_fltmyeyeclean = [];

        var s_fltmyeyecleanid = $('#s_fltmyeyecleanid').val();

        if (s_fltmyeyecleanid.length > 0) {

            for (var i = 0; i < s_fltmyeyecleanid.length; i++) {

                var id = $('#s_fltmyeyecleanid option[value=' + s_fltmyeyecleanid[i] + ']').val();

                var name = $('#s_fltmyeyecleanid option[value=' + s_fltmyeyecleanid[i] + ']').text();

                s_fltmyeyeclean.push({

                    'id': id,

                    'name': name

                });

            }

        }



        s_fltmyopeninclusion = [];

        var s_fltmyopeninclusionid = $('#s_fltmyopeninclusionid').val();

        if (s_fltmyopeninclusionid.length > 0) {

            for (var i = 0; i < s_fltmyopeninclusionid.length; i++) {

                var id = $('#s_fltmyopeninclusionid option[value=' + s_fltmyopeninclusionid[i] + ']').val();

                var name = $('#s_fltmyopeninclusionid option[value=' + s_fltmyopeninclusionid[i] + ']').text();

                s_fltmyopeninclusion.push({

                    'id': id,

                    'name': name

                });

            }

        }



        s_fltmywhiteinclusion = [];

        var s_fltmywhiteinclusionid = $('#s_fltmywhiteinclusionid').val();

        if (s_fltmywhiteinclusionid.length > 0) {

            for (var i = 0; i < s_fltmywhiteinclusionid.length; i++) {

                var id = $('#s_fltmywhiteinclusionid option[value=' + s_fltmywhiteinclusionid[i] + ']').val();

                var name = $('#s_fltmywhiteinclusionid option[value=' + s_fltmywhiteinclusionid[i] + ']').text();

                s_fltmywhiteinclusion.push({

                    'id': id,

                    'name': name

                });

            }

        }



        s_fltmyblackinclusion = [];



        var s_fltmyblackinclusionid = $('#s_fltmyblackinclusionid').val();

        if (s_fltmyblackinclusionid.length > 0) {

            for (var i = 0; i < s_fltmyblackinclusionid.length; i++) {

                var id = $('#s_fltmyblackinclusionid option[value=' + s_fltmyblackinclusionid[i] + ']').val();

                var name = $('#s_fltmyblackinclusionid option[value=' + s_fltmyblackinclusionid[i] + ']').text();

                s_fltmyblackinclusion.push({

                    'id': id,

                    'name': name

                });

            }

        }



        s_fltmyfromdate = $('#form-mybuyrequest-filter #s_fltmyfromdate').val();

        s_fltmytodate = $('#form-mybuyrequest-filter #s_fltmytodate').val();



        s_fltmyfromexpirydate = $('#form-mybuyrequest-filter #s_fltmyfromexpirydate').val();

        s_fltmytoexpirydate = $('#form-mybuyrequest-filter #s_fltmytoexpirydate').val();





    }





    function fillsearchmybuyrequestlist() {

        var htmllistdata = '';



        if (s_fltmyseeonly.length > 0) {

            for (var i = 0; i < s_fltmyseeonly.length; i++) {

                var id = s_fltmyseeonly[i].id;

                var name = s_fltmyseeonly[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemyseeonlyflt  fltmyseeonly' + id + ' searchbtnset"><b> See Only : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltmyfromprice && s_fltmytoprice > 0) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removemyfromtoprice searchbtnset"><b> Price : </b><span>$' + s_fltmyfromprice + '-$' + s_fltmytoprice + '</span> X</a>';

        }



        if (s_fltmyshape.length > 0) {

            for (var i = 0; i < s_fltmyshape.length; i++) {

                var id = s_fltmyshape[i].id;

                var name = s_fltmyshape[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemyshapeflt  fltmyshape' + id + ' searchbtnset"><b> Shape : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltmyfromsize && s_fltmyfromsize > 0) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removemyfromtosize searchbtnset"><b> Size : </b><span>' + s_fltmyfromsize + '-' + s_fltmytosize + '</span> X</a>';

        }



        if (s_fltmyfromcolorid && s_fltmytocolorid) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removemyfromtocolor searchbtnset"><b> Color : </b><span>' + s_fltmyfromcolor + '-' + s_fltmytocolor + '</span> X</a>';

        }



        if (s_fltmyfromclarityid && s_fltmytoclarityid) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removemyfromtoclarity searchbtnset"><b> Clarity : </b><span>' + s_fltmyfromclarity + '-' + s_fltmytoclarity + '</span> X</a>';

        }



        if (s_fltmyfromcutid && s_fltmytocutid) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removemyfromtocut searchbtnset"><b> Cut : </b><span>' + s_fltmyfromcut + '-' + s_fltmytocut + '</span> X</a>';

        }



        if (s_fltmyfrompolishid && s_fltmytopolishid) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removemyfromtopolish searchbtnset"><b> Polish : </b><span>' + s_fltmyfrompolish + '-' + s_fltmytopolish + '</span> X</a>';

        }



        if (s_fltmyfromsymmetryid && s_fltmytosymmetryid) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removemyfromtosymmetry searchbtnset"><b> Symmetry : </b><span>' + s_fltmyfromsymmetry + '-' + s_fltmytosymmetry + '</span> X</a>';

        }



        if (s_fltmyfrommilkyid && s_fltmytomilkyid) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removemyfromtomilky searchbtnset"><b> Milky : </b><span>' + s_fltmyfrommilky + '-' + s_fltmytomilky + '</span> X</a>';

        }



        if (s_fltmylab.length > 0) {

            for (var i = 0; i < s_fltmylab.length; i++) {

                var id = s_fltmylab[i].id;

                var name = s_fltmylab[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemylabflt  fltmylab' + id + ' searchbtnset"><b> Grading Report : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltmyintensity.length > 0) {

            for (var i = 0; i < s_fltmyintensity.length; i++) {

                var id = s_fltmyintensity[i].id;

                var name = s_fltmyintensity[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemyintensityflt  fltmyintensity' + id + ' searchbtnset"><b> Intensity : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltmycountry.length > 0) {

            for (var i = 0; i < s_fltmycountry.length; i++) {

                var id = s_fltmycountry[i].id;

                var name = s_fltmycountry[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemycountryflt  fltmycountry' + id + ' searchbtnset"><b> Location : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltmyeyeclean.length > 0) {

            for (var i = 0; i < s_fltmyeyeclean.length; i++) {

                var id = s_fltmyeyeclean[i].id;

                var name = s_fltmyeyeclean[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemyeyecleanflt  fltmyeyeclean' + id + ' searchbtnset"><b> Eye Clean : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltmyopeninclusion.length > 0) {

            for (var i = 0; i < s_fltmyopeninclusion.length; i++) {

                var id = s_fltmyopeninclusion[i].id;

                var name = s_fltmyopeninclusion[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemyopeninclusionflt  fltmyopeninclusion' + id + ' searchbtnset"><b> Open Inclusion : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltmywhiteinclusion.length > 0) {

            for (var i = 0; i < s_fltmywhiteinclusion.length; i++) {

                var id = s_fltmywhiteinclusion[i].id;

                var name = s_fltmywhiteinclusion[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemywhiteinclusionflt  fltmywhiteinclusion' + id + ' searchbtnset"><b> White Inclusion : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltmyblackinclusion.length > 0) {

            for (var i = 0; i < s_fltmyblackinclusion.length; i++) {

                var id = s_fltmyblackinclusion[i].id;

                var name = s_fltmyblackinclusion[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemyblackinclusionflt  fltmyblackinclusion' + id + ' searchbtnset"><b> Black Inclusion : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltmyfromdate && s_fltmytodate) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removemyfromtocrdate searchbtnset"><b> Create Date : </b><span>' + s_fltmyfromdate + '-' + s_fltmytodate + '</span> X</a>';

        }



        if (s_fltmyfromexpirydate && s_fltmytoexpirydate) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removemyfromtoexpdate searchbtnset"><b> Expiration Date : </b><span>' + s_fltmyfromexpirydate + '-' + s_fltmytoexpirydate + '</span> X</a>';

        }



        $('.listmybuyrequestsearch').html(htmllistdata);

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



    $('body').on('click', '.removemyseeonlyflt', function() {

        var id = $(this).attr('data-id');

        $('.fltmyseeonly' + id + '').remove();

        if (id == 1) {

            $('#myactivebuyrequest').prop('checked', false);

        } else if (id == 2) {

            $('#myexpiredbuyrequest').prop('checked', false);

        } else if (id == 3) {

            $('#mywithsellerresponse').prop('checked', false);

        } else if (id == 4) {

            $('#mywithoutsellerresponse').prop('checked', false);

        }

        var arrid = removeindexfromarr(s_fltmyseeonly, id);

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });





    $('body').on('click', '.removemyfromtoprice', function() {

        $(this).remove();

        s_fltmyfromprice = 0;

        s_fltmytoprice = 0;

        $('#form-mybuyrequest-filter #s_fltmyfromprice').val(s_fltmyfromprice);

        $('#form-mybuyrequest-filter #s_fltmytoprice').val(s_fltmyfromprice);

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });





    $('body').on('click', '.removemyshapeflt', function() {

        var id = $(this).attr('data-id');

        $('.fltmyshape' + id + '').remove();

        var arrid = removeindexfromarr(s_fltmyshape, id);

        $("#s_fltmyshapeid").val(arrid).trigger('change');

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });





    $('body').on('click', '.removemyfromtosize', function() {

        $(this).remove();

        s_fltmyfromsize = 0;

        s_fltmytosize = 0;

        $('#form-mybuyrequest-filter #s_fltmyfromsize').val(s_fltmyfromsize);

        $('#form-mybuyrequest-filter #s_fltmytosize').val(s_fltmytosize);

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });



    $('body').on('click', '.removemyfromtocolor', function() {

        $(this).remove();

        s_fltmyfromcolorid = '';

        s_fltmyfromcolor = '';

        s_fltmytocolorid = '';

        s_fltmytocolor = '';

        $('#form-mybuyrequest-filter #s_fltmyfromcolorid').val(s_fltmyfromcolorid);

        $('#form-mybuyrequest-filter #s_fltmyfromcolorid').select2();

        $('#form-mybuyrequest-filter #s_fltmytocolorid').val(s_fltmytocolorid);

        $('#form-mybuyrequest-filter #s_fltmytocolorid').select2();

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });





    $('body').on('click', '.removemyfromtoclarity', function() {

        $(this).remove();

        s_fltmyfromclarityid = '';

        s_fltmyfromclarity = '';

        s_fltmytoclarityid = '';

        s_fltmytoclarity = '';

        $('#form-mybuyrequest-filter #s_fltmyfromclarityid').val(s_fltmyfromclarityid);

        $('#form-mybuyrequest-filter #s_fltmyfromclarityid').select2();

        $('#form-mybuyrequest-filter #s_fltmytoclarityid').val(s_fltmytoclarityid);

        $('#form-mybuyrequest-filter #s_fltmytoclarityid').select2();

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });





    $('body').on('click', '.removemyfromtocut', function() {

        $(this).remove();

        s_fltmyfromcutid = '';

        s_fltmyfromcut = '';

        s_fltmytocutid = '';

        s_fltmytocut = '';

        $('#form-mybuyrequest-filter #s_fltmyfromcutid').val(s_fltmyfromcutid);

        $('#form-mybuyrequest-filter #s_fltmyfromcutid').select2();

        $('#form-mybuyrequest-filter #s_fltmytocutid').val(s_fltmytocutid);

        $('#form-mybuyrequest-filter #s_fltmytocutid').select2();

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });





    $('body').on('click', '.removemyfromtosymmetry', function() {

        $(this).remove();

        s_fltmyfromsymmetryid = '';

        s_fltmyfromsymmetry = '';

        s_fltmytosymmetryid = '';

        s_fltmytosymmetry = '';

        $('#form-mybuyrequest-filter #s_fltmyfromsymmetryid').val(s_fltmyfromsymmetryid);

        $('#form-mybuyrequest-filter #s_fltmyfromsymmetryid').select2();

        $('#form-mybuyrequest-filter #s_fltmytosymmetryid').val(s_fltmytosymmetryid);

        $('#form-mybuyrequest-filter #s_fltmytosymmetryid').select2();

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });



    $('body').on('click', '.removemyfromtopolish', function() {

        $(this).remove();

        s_fltmyfrompolishid = '';

        s_fltmyfrompolish = '';

        s_fltmytopolishid = '';

        s_fltmytopolish = '';

        $('#form-mybuyrequest-filter #s_fltmyfrompolishid').val(s_fltmyfrompolishid);

        $('#form-mybuyrequest-filter #s_fltmyfrompolishid').select2();

        $('#form-mybuyrequest-filter #s_fltmytopolishid').val(s_fltmytopolishid);

        $('#form-mybuyrequest-filter #s_fltmytopolishid').select2();

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });





    $('body').on('click', '.removemyfromtomilky', function() {

        $(this).remove();

        s_fltmyfrommilkyid = '';

        s_fltmyfrommilky = '';

        s_fltmytomilkyid = '';

        s_fltmytomilky = '';

        $('#form-mybuyrequest-filter #s_fltmyfrommilkyid').val(s_fltmyfrommilkyid);

        $('#form-mybuyrequest-filter #s_fltmyfrommilkyid').select2();

        $('#form-mybuyrequest-filter #s_fltmytomilkyid').val(s_fltmytomilkyid);

        $('#form-mybuyrequest-filter #s_fltmytomilkyid').select2();

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });





    $('body').on('click', '.removemylabflt', function() {

        var id = $(this).attr('data-id');

        $('.fltmylab' + id + '').remove();

        var arrid = removeindexfromarr(s_fltmylab, id);

        $('#s_fltmylabid' + id + '').prop('checked', false);

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });





    $('body').on('click', '.removemyintensityflt', function() {

        var id = $(this).attr('data-id');

        $('.fltmyintensity' + id + '').remove();

        var arrid = removeindexfromarr(s_fltmyintensity, id);

        $("#s_fltmyintensityid").val(arrid).trigger('change');

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });





    $('body').on('click', '.removemycountryflt', function() {

        var id = $(this).attr('data-id');

        $('.fltmycountry' + id + '').remove();

        var arrid = removeindexfromarr(s_fltmycountry, id);

        $("#s_fltmycountryid").val(arrid).trigger('change');

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });



    $('body').on('click', '.removemyeyecleanflt', function() {

        var id = $(this).attr('data-id');

        $('.fltmyeyeclean' + id + '').remove();

        var arrid = removeindexfromarr(s_fltmyeyeclean, id);

        $("#s_fltmyeyecleanid").val(arrid).trigger('change');

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });



    $('body').on('click', '.removemyopeninclusionflt', function() {

        var id = $(this).attr('data-id');

        $('.fltmyopeninclusion' + id + '').remove();

        var arrid = removeindexfromarr(s_fltmyopeninclusion, id);

        $("#s_fltmyopeninclusionid").val(arrid).trigger('change');

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });



    $('body').on('click', '.removemywhiteinclusionflt', function() {

        var id = $(this).attr('data-id');

        $('.fltmywhiteinclusion' + id + '').remove();

        var arrid = removeindexfromarr(s_fltmywhiteinclusion, id);

        $("#s_fltmywhiteinclusionid").val(arrid).trigger('change');

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });



    $('body').on('click', '.removemyblackinclusionflt', function() {

        var id = $(this).attr('data-id');

        $('.fltmyblackinclusion' + id + '').remove();

        var arrid = removeindexfromarr(s_fltmyblackinclusion, id);

        $("#s_fltmyblackinclusionid").val(arrid).trigger('change');

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });



    $('body').on('click', '.removemyfromtocrdate', function() {

        $(this).remove();

        s_fltmyfromdate = '';

        s_fltmytodate = '';

        $('#form-mybuyrequest-filter #s_fltmyfromdate').val(s_fltmyfromdate);

        $('#form-mybuyrequest-filter #s_fltmytodate').val(s_fltmytodate);

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });



    $('body').on('click', '.removemyfromtoexpdate', function() {

        $(this).remove();

        s_fltmyfromexpirydate = '';

        s_fltmytoexpirydate = '';

        $('#form-mybuyrequest-filter #s_fltmyfromexpirydate').val(s_fltmyfromexpirydate);

        $('#form-mybuyrequest-filter #s_fltmytoexpirydate').val(s_fltmytoexpirydate);

        $('#listmybuyrequestDatatbl').attr('data-nextpage', 0);

        listmybuyrequestdata(1, 'form-mybuyrequest-filter');

    });











    /* ************************************** MANAGE BUY REQUEST******************************************** */



    $('body').on('change', '#buyrequest_per_page', function() {

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        $("#listbuyrequestData").animate({

            scrollTop: 0

        }, "slow");

        listbuyrequestdata(1);

    });



    $('body').on('change', '#buyrequestsortbyid', function() {

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        $("#listbuyrequestData").animate({

            scrollTop: 0

        }, "slow");

        listbuyrequestdata(1);

    });



    $('#listbuyrequestDatatbl tbody').scroll(function() {

        if ($(this).scrollTop() +

            $(this).innerHeight() >=

            $(this)[0].scrollHeight) {

            // //console.log('Here');

            var dataact = getpagename();

            var show = $('#listbuyrequestDatatbl').attr('data-show');

            if (dataact && show == 1) {

                listbuyrequestdata(1);

            }

        }

    });





    $('#s_fltfromdate').datepicker({

        dateFormat: 'dd/mm/yy',

        onClose: function(selectedDate) {

            $("#s_flttodate").datepicker("option", "minDate", selectedDate);

            checksidebuyrequestformelementvalue();

            getbuyrequestfiltersvalue();

        }

    });



    $('#s_flttodate').datepicker({

        dateFormat: 'dd/mm/yy',

        onClose: function(selectedDate) {

            checksidebuyrequestformelementvalue();

            getbuyrequestfiltersvalue();

        }

    });





    $('#s_fltfromexpirydate').datepicker({

        dateFormat: 'dd/mm/yy',

        minDate: 0,

        onClose: function(selectedDate) {

            $("#s_flttoexpirydate").datepicker("option", "minDate", selectedDate);

            checksidebuyrequestformelementvalue();

            getbuyrequestfiltersvalue();

        }

    });



    $('#s_flttoexpirydate').datepicker({

        dateFormat: 'dd/mm/yy',

        minDate: 0,

        onClose: function(selectedDate) {

            checksidebuyrequestformelementvalue();

            getbuyrequestfiltersvalue();

        }

    });



    function listbuyrequestdata(page, form = '') {



        $('.chart-loading').show();



        // showloader();



        // showloader();

        var pagename = getpagename();

        var useraction = $('#formevent').val();

        var sortbyid = $('#buyrequestsortbyid').val();





        var buyrequest_per_page = $('#buyrequest_per_page').val();

        var nextpage = 0;

        if ($('#listbuyrequestDatatbl').attr('data-nextpage') > 0) {

            nextpage = $('#listbuyrequestDatatbl').attr('data-nextpage');

        }



        var formdata = new FormData();

        if (form != '') {

            formdata = new FormData(document.getElementById(form));

        }



        formdata.append("action", "listbuyrequest");

        formdata.append("nextpage", parseInt(nextpage) + 1);

        formdata.append("fltmanagebuyrequest", 0);

        formdata.append("perpage", buyrequest_per_page);

        formdata.append("sortbyid", sortbyid);



        var headersdata = {

            'Accept': 'application/json',

            platform: 4,

            userpagename: pagename,

            useraction: useraction,

            masterlisting: false

        };

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>buyrequest', formdata, headersdata, Onsuccesslistbuyrequestdata, OnErrorlistbuyrequestdata)



        function Onsuccesslistbuyrequestdata(data) {

            // hideloader();

            // hideloader();

            $('.chart-loading').hide();

            var JsonData = JSON.stringify(data);

            var resultdata = jQuery.parseJSON(JsonData);



            var htmldata = '';

            if (resultdata.IsPackageExpire == 1) {

                Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});

            }

            else{

                if (resultdata.status == 0) {



                    htmldata += '<tr>';

                    htmldata += '<td colspan="16">';

                    htmldata += '<h3>' + resultdata.message + '</h3>';

                    htmldata += '</td>';

                    htmldata += '</tr>';



                    $('#listbuyrequestData').html(htmldata);

                    $('#showbuyrequestentries').html(0);



                    $('.totalbuyrequest').html('0 Requests');







                } else if (resultdata.status == 1) {

                    if (resultdata.totalbuyrequest >= 0 && resultdata.totalbuyrequest != null) {

                        // //console.log('totaldiamond'+resultdata.totaldiamond);

                        // //console.log('totalprice'+resultdata.totalprice);

                        $('.totalbuyrequest').html(resultdata.totalbuyrequest + ' Requests');

                    }



                    for (var i in resultdata.data) {

                        var buyrequestdata = resultdata.data[i];





                        htmldata += '<tr class="showbuyrequestdetails" data-buyrequestid="' + buyrequestdata.id + '">';

                        htmldata += '<td class="text-center">' + buyrequestdata.buyrequestno + '</td>';

                        htmldata += '<td class="text-left">' + buyrequestdata.personname + '</td>';

                        htmldata += '<td class="text-left">' + buyrequestdata.typetext + '</td>';

                        htmldata += '<td class="text-center">' + buyrequestdata.createdate + '</td>';

                        htmldata += '<td class="text-center">' + buyrequestdata.expirydate + '</td>';

                        htmldata += '<td class="text-left">' + buyrequestdata.shape + '</td>';

                        htmldata += '<td class="text-left">' + buyrequestdata.fromsize + '-' + buyrequestdata.tosize + '</td>';

                        htmldata += '<td class="text-left">' + buyrequestdata.fromcolor + '-' + buyrequestdata.tocolor + '</td>';

                        htmldata += '<td class="text-left">' + buyrequestdata.country + '</td>';

                        htmldata += '</tr>';

                    }



                    if (resultdata.nextpage == 1) {

                        $('#listbuyrequestData').html(htmldata);

                    } else {

                        $('#listbuyrequestData').append(htmldata);

                    }

                    $('#showbuyrequestentries').html(resultdata.showentries);



                    $('#listbuyrequestDatatbl').attr('data-nextpage', resultdata.nextpage);

                    if (resultdata.loadmore == 1) {

                        $('#listbuyrequestDatatbl').attr('data-show', 1);

                    } else {

                        $('#listbuyrequestDatatbl').attr('data-show', 0);

                    }















                }else if(resultdata.status == -1)

                {

                    $('#btnlogout').trigger('click');

                }

            }



        }



        function OnErrorlistbuyrequestdata(content) {



        }



    }





    $('body').on('click', '.showbuyrequestdetails', function() {

        

        $('.chart-loading').show();

        var id = $(this).attr('data-buyrequestid');

        

        // showloader();

        // showloader();

        var pagename = getpagename();

        var useraction = $('#formevent').val();

        viewformdata = new FormData();

        viewformdata.append("action", "listbuyrequest");

        viewformdata.append("id", id);

        viewformdata.append("nextpage", 1);

        viewformdata.append("perpage", 1);

        var headersdata = {

            'Accept': 'application/json',

            platform: 4,

            userpagename: pagename,

            useraction: useraction,

            masterlisting: false

        };

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>buyrequest', viewformdata, headersdata, Onsuccessviewbuyrequestdetail, OnErrorviewbuyrequestdetail)



        function Onsuccessviewbuyrequestdetail(data) {

            $('.chart-loading').hide();

            var JsonData = JSON.stringify(data);

            var resultviewdata = jQuery.parseJSON(JsonData);

            // hideloader();

            var htmldata = '';

            if (resultviewdata.IsPackageExpire == 1) {

                Notiflix.Report.Warning(resultviewdata.ExpiryTitle,resultviewdata.message, false, function(){window.location=resultviewdata.ExpiryURL;});

            }

            else{

                if (resultviewdata.status == 0) {

                    Notiflix.Notify.Failure(resultviewdata.message);

                } else if (resultviewdata.status == 1) {



                    for (var i in resultviewdata.data) {

                        var viewdata = resultviewdata.data[i];



                        $('#BuyRequestDetailsModal #BuyRequestDetailsText').html(viewdata.cmpname + ' | ' + viewdata.buyrequestno);



                        htmldata += '<div class="req-new">';

                            htmldata += '<div class="setnamealby">' + viewdata.shape + ', ' + viewdata.fromsize + ' - ' + viewdata.tosize + '</div>';

                            htmldata += '<div class="row">';

                                htmldata += '<div class="col-md-6">';

                                    htmldata += '<div class="resallby text-left">' + viewdata.country + '</div>';

                                    htmldata += '<div class="set-data-req">';

                                        htmldata += '<div class="se-type">';

                                            htmldata += '<p>Type :<span> ' + viewdata.typetext + '</span> </p>';

                                        htmldata += '</div>';

                                    htmldata += '</div>';

                                htmldata += '</div>';



                                var getnotitext = 'No';

                                if (viewdata.isgetnotification == 1) {

                                    getnotitext = 'Yes';

                                }





                                htmldata += '<div class="col-md-6">';

                                    htmldata += '<div class="se-type">';

                                            htmldata += '<p> Get Notification :<span> '+getnotitext+'</span> </p>';

                                        htmldata += '</div>';

                                        htmldata += '<div class="se-type">';

                                            htmldata += '<p>Request Person :<span>  ' + viewdata.personname + '</span> </p>';

                                        htmldata += '</div>';

                                    htmldata += '<div class="noteallby text-right">';

                                        <?php 

                                        if($CanMemberToMemberChat==1)

                                        {

                                        ?>

                                            if(viewdata.canresponse==1)

                                            {

                                                htmldata += '<div class="setresalbu"><a href="javascript:void(0);" class="btnsendbuyrequestrespond" data-buyrequestname="' + viewdata.buyrequestno + ' | ' + viewdata.shape + ' , ' + viewdata.fromsize + ' - ' + viewdata.tosize + ', ' + viewdata.fromcolor + ' - ' + viewdata.tocolor + ', ' + viewdata.fromclarity + '-' + viewdata.toclarity + ' " data-buyrequestid="' + viewdata.id + '">';

                                                    htmldata += '<div class="imgallreqse">                             ';

                                                        htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/back.svg" alt="Respond to buy request" title="Respond to buy request">                         ';

                                                    htmldata += '</div>                         ';

                                                    htmldata += '<h5>Message</h5></a>                     ';

                                                htmldata += '</div>                 ';

                                            }    

                                        <?php 

                                        } ?>     

                                    htmldata += '</div>';

                                htmldata += '</div>';

                            htmldata += '</div>';

                        htmldata += '</div>';







                        htmldata += '         <div class="req-info">';

                        htmldata += '             Request Info ';

                        htmldata += '         </div>';





                        htmldata+='<div class="col-12 buy-id">';

                            htmldata+='<div class="row">';

                                htmldata+='<div class="col-md-6">';

                                    htmldata+='<div class="card">';

                                        htmldata+='<div class="card-body">';

                                            htmldata+='<div class="row">';

                                                htmldata+='<div class="col-md-6 col-sm-6 col-6 set-sh-buy">';

                                                    htmldata+='<p>Buy Request#</p>';

                                                    htmldata+='<p>Shape</p>';

                                                    htmldata+='<p>Size</p>';

                                                    if (viewdata.isfancy == 1) {

                                                        htmldata+='<p>Intensity</p>';  

                                                        htmldata+='<p>Overtone</p>';

                                                        htmldata+='<p>Color</p>';

                                                    }

                                                    else

                                                    {

                                                        htmldata+='<p>Color</p>';

                                                    }    

                                                    htmldata+='<p>Clarity</p>';

                                                    htmldata+='<p>Cut</p>';

                                                    htmldata+='<p>Polish</p>';

                                                    htmldata+='<p>Symmetry</p>';

                                                    htmldata+='<p>Fluorescence Intensity</p>';

                                                    htmldata+='<p>Fluorescence Color</p>';

                                                    htmldata+='<p>Lab</p>';

                                                    htmldata+='<p>Price($)</p>';

                                                    htmldata+='<p>Eye Clean</p>';

                                                    htmldata+='<p>Milky</p>';

                                                htmldata+='</div>';

                                                htmldata+='<div class="col-md-6 col-sm-6 col-6 setna">';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.buyrequestno + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.shape + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromsize + '-' + viewdata.tosize + '</p>';

                                                    if (viewdata.isfancy == 1) {

                                                        htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromintensity + '-' + viewdata.tointensity + '</p>';

                                                        htmldata+='<p>: &nbsp;&nbsp;' + viewdata.overtone + '</p>';

                                                        htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fluorescenecolor + '</p>';

                                                    }

                                                    else

                                                    {

                                                        htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromcolor + '-' + viewdata.tocolor + '</p>';

                                                    }

                                                        



                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromclarity + '-' + viewdata.toclarity + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromcut + '-' + viewdata.tocut + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.frompolish + '-' + viewdata.topolish + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromsymmetry + '-' + viewdata.tosymmetry + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.intensity + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.color + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.lab + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;$' + viewdata.price + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.eyeclean + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.frommilky + '-' + viewdata.tomilky + '</p>';

                                                htmldata+='</div>';

                                            htmldata+='</div>';

                                        htmldata+='</div>';

                                    htmldata+='</div>';

                                htmldata+='</div>';

                                htmldata+='<div class="col-md-6 setrespr">';

                                    htmldata+='<div class="card">';

                                        htmldata+='<div class="card-body">';

                                            htmldata+='<div class="row">';

                                                htmldata+='<div class="col-md-6 col-sm-6 col-6 set-sh-buy ">';

                                                

                                                    htmldata+='<p>Black Inclusion</p>';

                                                    htmldata+='<p>White Inclusion</p>';

                                                    htmldata+='<p>Open Inclusion</p>';

                                                    htmldata+='<p>Length</p>';

                                                    htmldata+='<p>Width</p>';

                                                    htmldata+='<p>Depth</p>';

                                                    htmldata+='<p>Table</p>';

                                                    htmldata+='<p>Depth(%)</p>';

                                                    htmldata+='<p>Ratio</p>';

                                                    htmldata+='<p>Create Date</p>';

                                                    htmldata+='<p>Expiration Date</p>';

                                                htmldata+='</div>';

                                                htmldata+='<div class="col-md-6 col-sm-6 col-6 setna">';

                                                

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.blackinclusion + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.whiteinclusion + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.openinclusion + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromlength + '-' + viewdata.tolength + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromwidth + '-' + viewdata.towidth + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromdepth + '-' + viewdata.todepth + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromtable + '-' + viewdata.totable + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromdepthper + '-' + viewdata.todepthper + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.fromratio + '-' + viewdata.toratio + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.createdate + '</p>';

                                                    htmldata+='<p>: &nbsp;&nbsp;' + viewdata.expirydate + '</p>';

                                                htmldata+='</div>';

                                            htmldata+='</div>';

                                        htmldata+='</div>';

                                    htmldata+='</div>';

                                htmldata+='</div>';

                            htmldata+='</div>';

                        htmldata+='</div>';

                                        

                        htmldata += '         <div class="commentallby">';

                        htmldata += '             <div class="writeboxjw">';

                        htmldata += '                 <label for="description" class="col-form-label">Comment : ' + viewdata.comment + '</label>';

                        htmldata += '             </div>';

                        htmldata += '         </div>';

                        htmldata += '     </div>';

                        htmldata += ' </div>';





                    }

                    $('#BuyRequestDetailsModal #BuyRequestDetailsData').html(htmldata);

                    $('#BuyRequestDetailsModal').modal('show');



                



                }else if(resultviewdata.status == -1)

                {

                    $('#btnlogout').trigger('click');

                }

            }    



        }



        function OnErrorviewbuyrequestdetail(content) {



        }





    });





    $('body').on('click', '.btnsendbuyrequestrespond', function() {

        var id = $(this).attr('data-buyrequestid');

        var name = $(this).attr('data-buyrequestname');

        // $("#buyrequestrespondModal #form-buyrequestrespond").validate().resetForm();

        // $('#buyrequestrespondModal #form-buyrequestrespond').trigger("reset");

        $('#buyrequestrespondModal #form-buyrequestrespond #buyrequestrespondid').val(id);

        $('#buyrequestrespondModal #form-buyrequestrespond #buyrequestrespondname').val(name);

        $('#buyrequestrespondModal #form-buyrequestrespond .buyrequestrespondtext').html(name);

        $('#BuyRequestDetailsModal').modal('hide');

        $('#buyrequestrespondModal').modal('show');

    });



    $('#buyrequestrespondModal').on('shown.bs.modal', function() {



        if ($('#form-buyrequestrespond').length) {

            $('#form-buyrequestrespond').validate({

                rules: {

                    respondtext: {

                        required: true

                    },

                },

                messages: {

                    respondtext: {

                        required: 'Message is required',

                    },

                },

                submitHandler: function(buyrequestform) {



                    // showloader();

                    $('.chart-loading').show();

                    var pagename = getpagename();

                    var useraction = $('#formevent').val();

                    buyrespondformdata = new FormData(buyrequestform);

                    buyrespondformdata.append("action", "buyrequestrespond");

                    var headersdata = {

                        'Accept': 'application/json',

                        platform: 4,

                        userpagename: pagename,

                        useraction: useraction,

                        masterlisting: false

                    };

                    ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>buyrequest', buyrespondformdata, headersdata, Onsuccessbuyrequestrespond, OnErrorbuyrequestrespond)



                    function Onsuccessbuyrequestrespond(data) {

                        // hideloader();

                        $('.chart-loading').hide();

                        var JsonData = JSON.stringify(data);

                        var resultdata = jQuery.parseJSON(JsonData);

                        if (resultdata.IsPackageExpire == 1) {

                            Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});

                        }

                        else{

                            if (resultdata.status == 0) {

                                Notiflix.Notify.Failure(resultdata.message);

                            } else if (resultdata.status == 1) {

                                Notiflix.Notify.Success(resultdata.message);

                                $("#buyrequestrespondModal #form-buyrequestrespond").validate().resetForm();

                                $('#buyrequestrespondModal #form-buyrequestrespond').trigger("reset");

                                $('#buyrequestrespondModal').modal('hide');

                            }else if(resultdata.status == -1)

                            {

                                $('#btnlogout').trigger('click');

                            }

                        }    



                    }



                    function OnErrorbuyrequestrespond(content) {



                    }





                },

            });

        }



    });







    /* MANAGE BUY REQUEST FILTERS */

    if ($('#form-buyrequest-filter').length) {

        $('#form-buyrequest-filter').validate({

            rules: {

                fltfromprice: {

                    number: true,

                },

                flttoprice: {

                    number: true,

                    greaterThan: '#s_fltfromprice',

                },

                fltfromsize: {

                    number: true,

                },

                flttosize: {

                    number: true,

                    greaterThan: '#s_flttosize',

                },



            },

            messages: {

                flttoprice: {

                    greaterThan: "To Price greater than or equal From Price",

                },

                flttosize: {

                    greaterThan: "To Size greater than or equal From Size",

                },



            },

            submitHandler: function(form) {



                var isvalid = checksidebuyrequestformelementvalue();

                if (isvalid > 0) {

                    fillsearchbuyrequestlist();

                    $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

                    $("#wrapper-buyrequest.toggled").toggleClass("intro");

                    listbuyrequestdata(1, 'form-buyrequest-filter');

                } else {

                    Notiflix.Notify.Failure('Please select at least one filter');

                }





            },

        });

    }





    $('body').on('change', '#form-buyrequest-filter input[type=checkbox]', function() {

        checksidebuyrequestformelementvalue();

        getbuyrequestfiltersvalue();

    });



    $('body').on('change', '#form-buyrequest-filter  .select2', function() {

        checksidebuyrequestformelementvalue();

        getbuyrequestfiltersvalue();

    });



    $('body').on('input', '#form-buyrequest-filter #s_fltfromsize,#s_flttosize,#s_fltfromprice,#s_flttoprice', function() {

        checksidebuyrequestformelementvalue();

        getbuyrequestfiltersvalue();

    });



    function checksidebuyrequestformelementvalue() {



        var issearchbtn = 0;

        $('#form-buyrequest-filter input[type=checkbox]').each(function() {

            if (this.checked) {

                issearchbtn++;

                return false;

            }

        });



        var s_fltfromprice = $('#form-buyrequest-filter #s_fltfromprice').val();

        var s_flttoprice = $('#form-buyrequest-filter #s_flttoprice').val();

        if (s_fltfromprice && s_flttoprice > 0) {

            issearchbtn++;

        }



        var s_fltfromsize = $('#form-buyrequest-filter #s_fltfromsize').val();

        var s_flttosize = $('#form-buyrequest-filter #s_flttosize').val();

        if (s_fltfromsize && s_flttosize > 0) {

            issearchbtn++;

        }



        var s_fltshapeid = $('#form-buyrequest-filter #s_fltshapeid').val();

        if (s_fltshapeid.length > 0) {

            issearchbtn++;

        }



        var s_fltfromcolorid = $('#form-buyrequest-filter #s_fltfromcolorid').val();

        var s_flttocolorid = $('#form-buyrequest-filter #s_flttocolorid').val();

        if (s_fltfromcolorid && s_flttocolorid) {

            issearchbtn++;

        }



        var s_fltfromclarityid = $('#form-buyrequest-filter #s_fltfromclarityid').val();

        var s_flttoclarityid = $('#form-buyrequest-filter #s_flttoclarityid').val();

        if (s_fltfromclarityid && s_flttoclarityid) {

            issearchbtn++;

        }



        var s_fltfromcutid = $('#form-buyrequest-filter #s_fltfromcutid').val();

        var s_flttocutid = $('#form-buyrequest-filter #s_flttocutid').val();

        if (s_fltfromcutid && s_flttocutid) {

            issearchbtn++;

        }



        var s_fltfrompolishid = $('#form-buyrequest-filter #s_fltfrompolishid').val();

        var s_flttopolishid = $('#form-buyrequest-filter #s_flttopolishid').val();

        if (s_fltfrompolishid && s_flttopolishid) {

            issearchbtn++;

        }



        var s_fltfromsymmetryid = $('#form-buyrequest-filter #s_fltfromsymmetryid').val();

        var s_flttosymmetryid = $('#form-buyrequest-filter #s_flttosymmetryid').val();

        if (s_fltfromsymmetryid && s_flttosymmetryid) {

            issearchbtn++;

        }





        var s_fltintensityid = $('#form-buyrequest-filter #s_fltintensityid').val();

        if (s_fltintensityid.length > 0) {

            issearchbtn++;

        }



        var s_fltcountryid = $('#form-buyrequest-filter #s_fltcountryid').val();

        if (s_fltcountryid.length > 0) {

            issearchbtn++;

        }



        var s_flteyecleanid = $('#form-buyrequest-filter #s_flteyecleanid').val();

        if (s_flteyecleanid.length > 0) {

            issearchbtn++;

        }



        var s_fltfrommilkyid = $('#form-buyrequest-filter #s_fltfrommilkyid').val();

        var s_flttomilkyid = $('#form-buyrequest-filter #s_flttomilkyid').val();

        if (s_fltfrommilkyid && s_flttomilkyid) {

            issearchbtn++;

        }



        var s_fltopeninclusionid = $('#form-buyrequest-filter #s_fltopeninclusionid').val();

        if (s_fltopeninclusionid.length > 0) {

            issearchbtn++;

        }



        var s_fltwhiteinclusionid = $('#form-buyrequest-filter #s_fltwhiteinclusionid').val();

        if (s_fltwhiteinclusionid.length > 0) {

            issearchbtn++;

        }



        var s_fltblackinclusionid = $('#form-buyrequest-filter #s_fltblackinclusionid').val();

        if (s_fltblackinclusionid.length > 0) {

            issearchbtn++;

        }





        var s_fltfromdate = $('#form-buyrequest-filter #s_fltfromdate').val();

        var s_flttodate = $('#form-buyrequest-filter #s_flttodate').val();

        if (s_fltfromdate && s_flttodate) {

            issearchbtn++;

        }



        var s_fltfromexpirydate = $('#form-buyrequest-filter #s_fltfromexpirydate').val();

        var s_flttoexpirydate = $('#form-buyrequest-filter #s_flttoexpirydate').val();

        if (s_fltfromexpirydate && s_flttoexpirydate) {

            issearchbtn++;

        }



        $('#form-buyrequest-filter #btnapplybuyrequestfilter').attr('disabled', true);

        if (issearchbtn > 0) {

            $('#form-buyrequest-filter #btnapplybuyrequestfilter').attr('disabled', false);

        }



        return issearchbtn;

    }



    var s_fltseeonly = [];

    var s_fltfromprice = 0;

    var s_flttoprice = 0;

    var s_fltshape = [];

    var s_fltfromsize = 0;

    var s_flttosize = 0;



    var s_fltfromcolorid = '';

    var s_fltfromcolor = '';

    var s_flttocolorid = '';

    var s_flttocolor = '';



    var s_fltfromclarityid = '';

    var s_fltfromclarity = '';

    var s_flttoclarityid = '';

    var s_flttoclarity = '';





    var s_fltfromcutid = '';

    var s_fltfromcut = '';

    var s_flttocutid = '';

    var s_flttocut = '';



    var s_fltfrompolishid = '';

    var s_fltfrompolish = '';

    var s_flttopolishid = '';

    var s_flttopolish = '';





    var s_fltfromsymmetryid = '';

    var s_fltfromsymmetry = '';

    var s_flttosymmetryid = '';

    var s_flttosymmetry = '';





    var s_fltlab = [];

    var s_fltintensity = [];

    var s_fltcountry = [];

    var s_flteyeclean = [];



    var s_fltfrommilkyid = '';

    var s_fltfrommilky = '';

    var s_flttomilkyid = '';

    var s_flttomilky = '';



    var s_fltopeninclusion = [];

    var s_fltwhiteinclusion = [];

    var s_fltblackinclusion = [];



    var s_fltfromdate = '';

    var s_flttodate = '';



    var s_fltfromexpirydate = '';

    var s_flttoexpirydate = '';





    function getbuyrequestfiltersvalue() {



        s_fltseeonly = [];

        $('#allseeonlyDivData input[type=checkbox]').each(function() {

            if (this.checked) {

                s_fltseeonly.push({

                    'id': $(this).val(),

                    'name': $(this).attr('data-name')

                });

            }

        });

        s_fltfromprice = $('#form-buyrequest-filter #s_fltfromprice').val();

        s_flttoprice = $('#form-buyrequest-filter #s_flttoprice').val();





        s_fltshape = [];



        var s_fltshapeid = $('#s_fltshapeid').val();

        if (s_fltshapeid.length > 0) {

            for (var i = 0; i < s_fltshapeid.length; i++) {

                var id = $('#s_fltshapeid option[value=' + s_fltshapeid[i] + ']').val();

                var name = $('#s_fltshapeid option[value=' + s_fltshapeid[i] + ']').text();

                s_fltshape.push({

                    'id': id,

                    'name': name

                });

            }

        }



        s_fltfromsize = $('#form-buyrequest-filter #s_fltfromsize').val();

        s_flttosize = $('#form-buyrequest-filter #s_flttosize').val();



        s_fltfromcolorid = $('#form-buyrequest-filter #s_fltfromcolorid').val();

        s_fltfromcolor = $('#form-buyrequest-filter #s_fltfromcolorid option:selected').text();

        s_flttocolorid = $('#form-buyrequest-filter #s_flttocolorid').val();

        s_flttocolor = $('#form-buyrequest-filter #s_flttocolorid option:selected').text();



        s_fltfromclarityid = $('#form-buyrequest-filter #s_fltfromclarityid').val();

        s_fltfromclarity = $('#form-buyrequest-filter #s_fltfromclarityid option:selected').text();

        s_flttoclarityid = $('#form-buyrequest-filter #s_flttoclarityid').val();

        s_flttoclarity = $('#form-buyrequest-filter #s_flttoclarityid option:selected').text();





        s_fltfromcutid = $('#form-buyrequest-filter #s_fltfromcutid').val();

        s_fltfromcut = $('#form-buyrequest-filter #s_fltfromcutid option:selected').text();

        s_flttocutid = $('#form-buyrequest-filter #s_flttocutid').val();

        s_flttocut = $('#form-buyrequest-filter #s_flttocutid option:selected').text();





        s_fltfrompolishid = $('#form-buyrequest-filter #s_fltfrompolishid').val();

        s_fltfrompolish = $('#form-buyrequest-filter #s_fltfrompolishid option:selected').text();

        s_flttopolishid = $('#form-buyrequest-filter #s_flttopolishid').val();

        s_flttopolish = $('#form-buyrequest-filter #s_flttopolishid option:selected').text();



        s_fltfromsymmetryid = $('#form-buyrequest-filter #s_fltfromsymmetryid').val();

        s_fltfromsymmetry = $('#form-buyrequest-filter #s_fltfromsymmetryid option:selected').text();

        s_flttosymmetryid = $('#form-buyrequest-filter #s_flttosymmetryid').val();

        s_flttosymmetry = $('#form-buyrequest-filter #s_flttosymmetryid option:selected').text();



        s_fltfrommilkyid = $('#form-buyrequest-filter #s_fltfrommilkyid').val();

        s_fltfrommilky = $('#form-buyrequest-filter #s_fltfrommilkyid option:selected').text();

        s_flttomilkyid = $('#form-buyrequest-filter #s_flttomilkyid').val();

        s_flttomilky = $('#form-buyrequest-filter #s_flttomilkyid option:selected').text();





        s_fltlab = [];

        $('#s_labData input[type=checkbox]').each(function() {

            if (this.checked) {

                s_fltlab.push({

                    'id': $(this).val(),

                    'name': $(this).attr('data-name')

                });

            }

        });



        s_fltintensity = [];

        var s_fltintensityid = $('#s_fltintensityid').val();

        if (s_fltintensityid.length > 0) {

            for (var i = 0; i < s_fltintensityid.length; i++) {

                var id = $('#s_fltintensityid option[value=' + s_fltintensityid[i] + ']').val();

                var name = $('#s_fltintensityid option[value=' + s_fltintensityid[i] + ']').text();

                s_fltintensity.push({

                    'id': id,

                    'name': name

                });

            }

        }



        s_fltcountry = [];

        var s_fltcountryid = $('#s_fltcountryid').val();

        if (s_fltcountryid.length > 0) {

            for (var i = 0; i < s_fltcountryid.length; i++) {

                var id = $('#s_fltcountryid option[value=' + s_fltcountryid[i] + ']').val();

                var name = $('#s_fltcountryid option[value=' + s_fltcountryid[i] + ']').text();

                s_fltcountry.push({

                    'id': id,

                    'name': name

                });

            }

        }



        s_flteyeclean = [];

        var s_flteyecleanid = $('#s_flteyecleanid').val();

        if (s_flteyecleanid.length > 0) {

            for (var i = 0; i < s_flteyecleanid.length; i++) {

                var id = $('#s_flteyecleanid option[value=' + s_flteyecleanid[i] + ']').val();

                var name = $('#s_flteyecleanid option[value=' + s_flteyecleanid[i] + ']').text();

                s_flteyeclean.push({

                    'id': id,

                    'name': name

                });

            }

        }



        s_fltopeninclusion = [];

        var s_fltopeninclusionid = $('#s_fltopeninclusionid').val();

        if (s_fltopeninclusionid.length > 0) {

            for (var i = 0; i < s_fltopeninclusionid.length; i++) {

                var id = $('#s_fltopeninclusionid option[value=' + s_fltopeninclusionid[i] + ']').val();

                var name = $('#s_fltopeninclusionid option[value=' + s_fltopeninclusionid[i] + ']').text();

                s_fltopeninclusion.push({

                    'id': id,

                    'name': name

                });

            }

        }



        s_fltwhiteinclusion = [];

        var s_fltwhiteinclusionid = $('#s_fltwhiteinclusionid').val();

        if (s_fltwhiteinclusionid.length > 0) {

            for (var i = 0; i < s_fltwhiteinclusionid.length; i++) {

                var id = $('#s_fltwhiteinclusionid option[value=' + s_fltwhiteinclusionid[i] + ']').val();

                var name = $('#s_fltwhiteinclusionid option[value=' + s_fltwhiteinclusionid[i] + ']').text();

                s_fltwhiteinclusion.push({

                    'id': id,

                    'name': name

                });

            }

        }



        s_fltblackinclusion = [];



        var s_fltblackinclusionid = $('#s_fltblackinclusionid').val();

        if (s_fltblackinclusionid.length > 0) {

            for (var i = 0; i < s_fltblackinclusionid.length; i++) {

                var id = $('#s_fltblackinclusionid option[value=' + s_fltblackinclusionid[i] + ']').val();

                var name = $('#s_fltblackinclusionid option[value=' + s_fltblackinclusionid[i] + ']').text();

                s_fltblackinclusion.push({

                    'id': id,

                    'name': name

                });

            }

        }



        s_fltfromdate = $('#form-buyrequest-filter #s_fltfromdate').val();

        s_flttodate = $('#form-buyrequest-filter #s_flttodate').val();



        s_fltfromexpirydate = $('#form-buyrequest-filter #s_fltfromexpirydate').val();

        s_flttoexpirydate = $('#form-buyrequest-filter #s_flttoexpirydate').val();





    }





    function fillsearchbuyrequestlist() {

        var htmllistdata = '';



        if (s_fltseeonly.length > 0) {

            for (var i = 0; i < s_fltseeonly.length; i++) {

                var id = s_fltseeonly[i].id;

                var name = s_fltseeonly[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeseeonlyflt  fltseeonly' + id + ' searchbtnset"><b> See Only : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltfromprice && s_flttoprice > 0) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removefromtoprice searchbtnset"><b> Price : </b><span>$' + s_fltfromprice + '-$' + s_flttoprice + '</span> X</a>';

        }



        if (s_fltshape.length > 0) {

            for (var i = 0; i < s_fltshape.length; i++) {

                var id = s_fltshape[i].id;

                var name = s_fltshape[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeshapeflt  fltshape' + id + ' searchbtnset"><b> Shape : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltfromsize && s_fltfromsize > 0) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removefromtosize searchbtnset"><b> Size : </b><span>' + s_fltfromsize + '-' + s_flttosize + '</span> X</a>';

        }



        if (s_fltfromcolorid && s_flttocolorid) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removefromtocolor searchbtnset"><b> Color : </b><span>' + s_fltfromcolor + '-' + s_flttocolor + '</span> X</a>';

        }



        if (s_fltfromclarityid && s_flttoclarityid) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removefromtoclarity searchbtnset"><b> Clarity : </b><span>' + s_fltfromclarity + '-' + s_flttoclarity + '</span> X</a>';

        }



        if (s_fltfromcutid && s_flttocutid) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removefromtocut searchbtnset"><b> Cut : </b><span>' + s_fltfromcut + '-' + s_flttocut + '</span> X</a>';

        }



        if (s_fltfrompolishid && s_flttopolishid) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removefromtopolish searchbtnset"><b> Polish : </b><span>' + s_fltfrompolish + '-' + s_flttopolish + '</span> X</a>';

        }



        if (s_fltfromsymmetryid && s_flttosymmetryid) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removefromtosymmetry searchbtnset"><b> Symmetry : </b><span>' + s_fltfromsymmetry + '-' + s_flttosymmetry + '</span> X</a>';

        }



        if (s_fltfrommilkyid && s_flttomilkyid) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removefromtomilky searchbtnset"><b> Milky : </b><span>' + s_fltfrommilky + '-' + s_flttomilky + '</span> X</a>';

        }



        if (s_fltlab.length > 0) {

            for (var i = 0; i < s_fltlab.length; i++) {

                var id = s_fltlab[i].id;

                var name = s_fltlab[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removelabflt  fltlab' + id + ' searchbtnset"><b> Grading Report : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltintensity.length > 0) {

            for (var i = 0; i < s_fltintensity.length; i++) {

                var id = s_fltintensity[i].id;

                var name = s_fltintensity[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeintensityflt  fltintensity' + id + ' searchbtnset"><b> Intensity : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltcountry.length > 0) {

            for (var i = 0; i < s_fltcountry.length; i++) {

                var id = s_fltcountry[i].id;

                var name = s_fltcountry[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removecountryflt  fltcountry' + id + ' searchbtnset"><b> Location : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_flteyeclean.length > 0) {

            for (var i = 0; i < s_flteyeclean.length; i++) {

                var id = s_flteyeclean[i].id;

                var name = s_flteyeclean[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeeyecleanflt  flteyeclean' + id + ' searchbtnset"><b> Eye Clean : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltopeninclusion.length > 0) {

            for (var i = 0; i < s_fltopeninclusion.length; i++) {

                var id = s_fltopeninclusion[i].id;

                var name = s_fltopeninclusion[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeopeninclusionflt  fltopeninclusion' + id + ' searchbtnset"><b> Open Inclusion : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltwhiteinclusion.length > 0) {

            for (var i = 0; i < s_fltwhiteinclusion.length; i++) {

                var id = s_fltwhiteinclusion[i].id;

                var name = s_fltwhiteinclusion[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removewhiteinclusionflt  fltwhiteinclusion' + id + ' searchbtnset"><b> White Inclusion : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltblackinclusion.length > 0) {

            for (var i = 0; i < s_fltblackinclusion.length; i++) {

                var id = s_fltblackinclusion[i].id;

                var name = s_fltblackinclusion[i].name;

                htmllistdata += '<a href="javascript:void(0);" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeblackinclusionflt  fltblackinclusion' + id + ' searchbtnset"><b> Black Inclusion : </b><span>' + name + '</span> X</a>';

            }

        }



        if (s_fltfromdate && s_flttodate) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removefromtocrdate searchbtnset"><b> Create Date : </b><span>' + s_fltfromdate + '-' + s_flttodate + '</span> X</a>';

        }



        if (s_fltfromexpirydate && s_flttoexpirydate) {

            htmllistdata += '<a href="javascript:void(0);" class="btn removefromtoexpdate searchbtnset"><b> Expiration Date : </b><span>' + s_fltfromexpirydate + '-' + s_flttoexpirydate + '</span> X</a>';

        }



        $('.listbuyrequestsearch').html(htmllistdata);

    }







    $('body').on('click', '.removeseeonlyflt', function() {

        var id = $(this).attr('data-id');

        $('.fltseeonly' + id + '').remove();

        if (id == 1) {

            $('#activebuyrequest').prop('checked', false);

        } else if (id == 2) {

            $('#expiredbuyrequest').prop('checked', false);

        } else if (id == 3) {

            $('#withsellerresponse').prop('checked', false);

        } else if (id == 4) {

            $('#withoutsellerresponse').prop('checked', false);

        }

        var arrid = removeindexfromarr(s_fltseeonly, id);

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });





    $('body').on('click', '.removefromtoprice', function() {

        $(this).remove();

        s_fltfromprice = 0;

        s_flttoprice = 0;

        $('#form-buyrequest-filter #s_fltfromprice').val(s_fltfromprice);

        $('#form-buyrequest-filter #s_flttoprice').val(s_fltfromprice);

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });





    $('body').on('click', '.removeshapeflt', function() {

        var id = $(this).attr('data-id');

        $('.fltshape' + id + '').remove();

        var arrid = removeindexfromarr(s_fltshape, id);

        $("#s_fltshapeid").val(arrid).trigger('change');

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });





    $('body').on('click', '.removefromtosize', function() {

        $(this).remove();

        s_fltfromsize = 0;

        s_flttosize = 0;

        $('#form-buyrequest-filter #s_fltfromsize').val(s_fltfromsize);

        $('#form-buyrequest-filter #s_flttosize').val(s_flttosize);

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });



    $('body').on('click', '.removefromtocolor', function() {

        $(this).remove();

        s_fltfromcolorid = '';

        s_fltfromcolor = '';

        s_flttocolorid = '';

        s_flttocolor = '';

        $('#form-buyrequest-filter #s_fltfromcolorid').val(s_fltfromcolorid);

        $('#form-buyrequest-filter #s_fltfromcolorid').select2();

        $('#form-buyrequest-filter #s_flttocolorid').val(s_flttocolorid);

        $('#form-buyrequest-filter #s_flttocolorid').select2();

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });





    $('body').on('click', '.removefromtoclarity', function() {

        $(this).remove();

        s_fltfromclarityid = '';

        s_fltfromclarity = '';

        s_flttoclarityid = '';

        s_flttoclarity = '';

        $('#form-buyrequest-filter #s_fltfromclarityid').val(s_fltfromclarityid);

        $('#form-buyrequest-filter #s_fltfromclarityid').select2();

        $('#form-buyrequest-filter #s_flttoclarityid').val(s_flttoclarityid);

        $('#form-buyrequest-filter #s_flttoclarityid').select2();

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });





    $('body').on('click', '.removefromtocut', function() {

        $(this).remove();

        s_fltfromcutid = '';

        s_fltfromcut = '';

        s_flttocutid = '';

        s_flttocut = '';

        $('#form-buyrequest-filter #s_fltfromcutid').val(s_fltfromcutid);

        $('#form-buyrequest-filter #s_fltfromcutid').select2();

        $('#form-buyrequest-filter #s_flttocutid').val(s_flttocutid);

        $('#form-buyrequest-filter #s_flttocutid').select2();

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });





    $('body').on('click', '.removefromtosymmetry', function() {

        $(this).remove();

        s_fltfromsymmetryid = '';

        s_fltfromsymmetry = '';

        s_flttosymmetryid = '';

        s_flttosymmetry = '';

        $('#form-buyrequest-filter #s_fltfromsymmetryid').val(s_fltfromsymmetryid);

        $('#form-buyrequest-filter #s_fltfromsymmetryid').select2();

        $('#form-buyrequest-filter #s_flttosymmetryid').val(s_flttosymmetryid);

        $('#form-buyrequest-filter #s_flttosymmetryid').select2();

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });



    $('body').on('click', '.removefromtopolish', function() {

        $(this).remove();

        s_fltfrompolishid = '';

        s_fltfrompolish = '';

        s_flttopolishid = '';

        s_flttopolish = '';

        $('#form-buyrequest-filter #s_fltfrompolishid').val(s_fltfrompolishid);

        $('#form-buyrequest-filter #s_fltfrompolishid').select2();

        $('#form-buyrequest-filter #s_flttopolishid').val(s_flttopolishid);

        $('#form-buyrequest-filter #s_flttopolishid').select2();

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });





    $('body').on('click', '.removefromtomilky', function() {

        $(this).remove();

        s_fltfrommilkyid = '';

        s_fltfrommilky = '';

        s_flttomilkyid = '';

        s_flttomilky = '';

        $('#form-buyrequest-filter #s_fltfrommilkyid').val(s_fltfrommilkyid);

        $('#form-buyrequest-filter #s_fltfrommilkyid').select2();

        $('#form-buyrequest-filter #s_flttomilkyid').val(s_flttomilkyid);

        $('#form-buyrequest-filter #s_flttomilkyid').select2();

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });





    $('body').on('click', '.removelabflt', function() {

        var id = $(this).attr('data-id');

        $('.fltlab' + id + '').remove();

        var arrid = removeindexfromarr(s_fltlab, id);

        $('#s_fltlabid' + id + '').prop('checked', false);

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });





    $('body').on('click', '.removeintensityflt', function() {

        var id = $(this).attr('data-id');

        $('.fltintensity' + id + '').remove();

        var arrid = removeindexfromarr(s_fltintensity, id);

        $("#s_fltintensityid").val(arrid).trigger('change');

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });





    $('body').on('click', '.removecountryflt', function() {

        var id = $(this).attr('data-id');

        $('.fltcountry' + id + '').remove();

        var arrid = removeindexfromarr(s_fltcountry, id);

        $("#s_fltcountryid").val(arrid).trigger('change');

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });



    $('body').on('click', '.removeeyecleanflt', function() {

        var id = $(this).attr('data-id');

        $('.flteyeclean' + id + '').remove();

        var arrid = removeindexfromarr(s_flteyeclean, id);

        $("#s_flteyecleanid").val(arrid).trigger('change');

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });



    $('body').on('click', '.removeopeninclusionflt', function() {

        var id = $(this).attr('data-id');

        $('.fltopeninclusion' + id + '').remove();

        var arrid = removeindexfromarr(s_fltopeninclusion, id);

        $("#s_fltopeninclusionid").val(arrid).trigger('change');

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });



    $('body').on('click', '.removewhiteinclusionflt', function() {

        var id = $(this).attr('data-id');

        $('.fltwhiteinclusion' + id + '').remove();

        var arrid = removeindexfromarr(s_fltwhiteinclusion, id);

        $("#s_fltwhiteinclusionid").val(arrid).trigger('change');

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });



    $('body').on('click', '.removeblackinclusionflt', function() {

        var id = $(this).attr('data-id');

        $('.fltblackinclusion' + id + '').remove();

        var arrid = removeindexfromarr(s_fltblackinclusion, id);

        $("#s_fltblackinclusionid").val(arrid).trigger('change');

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });



    $('body').on('click', '.removefromtocrdate', function() {

        $(this).remove();

        s_fltfromdate = '';

        s_flttodate = '';

        $('#form-buyrequest-filter #s_fltfromdate').val(s_fltfromdate);

        $('#form-buyrequest-filter #s_flttodate').val(s_flttodate);

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });



    $('body').on('click', '.removefromtoexpdate', function() {

        $(this).remove();

        s_fltfromexpirydate = '';

        s_flttoexpirydate = '';

        $('#form-buyrequest-filter #s_fltfromexpirydate').val(s_fltfromexpirydate);

        $('#form-buyrequest-filter #s_flttoexpirydate').val(s_flttoexpirydate);

        $('#listbuyrequestDatatbl').attr('data-nextpage', 0);

        listbuyrequestdata(1, 'form-buyrequest-filter');

    });



    var mmb = '<?php echo $_REQUEST['mmb']; ?>';

    // alert(mmd);

    if(mmb==1)

    {

        setTimeout(() => {

            $('#buy-request-tab  #buyrequest-tab').click();

            removefilterurl();

        }, 1000);

    }

    /* ================================================================== */
    /* PRODUCT REQUEST  (Buyer -> Seller Approve -> Chat) */
    /* API : api/v1.0/productrequest.php */
    /* ================================================================== */
    var prEndpoint = '<?php echo $config->getEndpointurl(); ?>productrequest';
    var prPortal   = '<?php echo $config->getportalbaseurl(); ?>';
    var prCanChat  = <?php echo ($ShowBuyerProductRequestTabs==1 || $ShowSellerProductRequestTabs==1) ? 1 : 0; ?>;
    var prHasBuyRight = <?php echo ($ShowBuyerProductRequestTabs==1) ? 1 : 0; ?>;
    var prHasSellerRight = <?php echo ($ShowSellerProductRequestTabs==1) ? 1 : 0; ?>;
    var prIsTradePro = <?php echo ($IsTradeProPackage==1) ? 1 : 0; ?>;

    function prHeaders() {
        return {
            'Accept': 'application/json',
            platform: 4,
            userpagename: getpagename(),
            useraction: ($('#formevent').val() || ''),
            masterlisting: false
        };
    }

    function prEsc(s) {
        return $('<div>').text(s == null ? '' : s).html();
    }

    var prBadge = { 1: 'badge-warning', 2: 'badge-success', 3: 'badge-danger', 4: 'badge-secondary', 5: 'badge-dark' };
    var prCurrentView = '';
    var prAutoRefreshTimer = null;
    var prActionInProgress = false;
    var prViews = {
        buyer_myrequest: { target: '#listBuyerMyRequest', counter: '.totalBuyerMyRequest', person: 'seller', showStatus: false, showAction: false, colspan: 7 },
        buyer_status: { target: '#listBuyerStatus', counter: '.totalBuyerStatus', person: 'seller', showStatus: true, showAction: true, buyerOnly: true, colspan: 9 },
        seller_productrequest: { target: '#listSellerProductRequest', counter: '.totalSellerProductRequest', person: 'buyer', showStatus: true, showAction: true, sellerAction: true, colspan: 9 },
        seller_status: { target: '#listSellerStatus', counter: '.totalSellerStatus', person: 'buyer', showStatus: true, showAction: true, readOnly: true, colspan: 9 },
        trade_status: { target: '#listTradeStatus', counter: '.totalTradeStatus', person: 'smart', showType: true, showStatus: true, showAction: true, colspan: 10 },
        trade_allrequest: { target: '#listTradeAllRequest', counter: '.totalTradeAllRequest', person: 'smart', showType: true, showStatus: true, showAction: true, sellerAction: true, colspan: 10 }
    };

    function listProductRequestView(view, silent) {
        if (!prCanChat || !prViews[view]) { return; }
        prCurrentView = view;
        var cfg = prViews[view];
        var formdata = new FormData();
        formdata.append('action', 'listproductrequest');
        formdata.append('view', view);
        formdata.append('nextpage', 1);
        formdata.append('perpage', 100);

        if (!silent) {
            $('.chart-loading').show();
        }
        ajaxrequest('POST', prEndpoint, formdata, prHeaders(), function (data) {
            if (!silent) {
                $('.chart-loading').hide();
            }
            var resultdata = jQuery.parseJSON(JSON.stringify(data));

            if (resultdata.IsPackageExpire == 1) {
                Notiflix.Report.Warning(resultdata.ExpiryTitle, resultdata.message, false, function () { window.location = resultdata.ExpiryURL; });
                return;
            }
            if (resultdata.status == -1) { $('#btnlogout').trigger('click'); return; }

            var htmldata = '';
            var cnt = 0;
            if (resultdata.status == 1 && resultdata.result && resultdata.result.length > 0) {
                cnt = resultdata.result.length;
                for (var i in resultdata.result) {
                    var d = resultdata.result[i];
                    var isSentRequest = (d.requesttype == 'my_buy_request');
                    var personName = (cfg.person == 'seller') ? d.sellername : d.buyername;
                    if (cfg.person == 'smart') {
                        personName = isSentRequest ? d.sellername : d.buyername;
                    }
                    htmldata += '<tr>';
                    htmldata += '<td><img src="' + prEsc(d.productimage) + '" alt="' + prEsc(d.productname) + '" style="width:60px;height:60px;object-fit:cover;border-radius:4px;"></td>';
                    htmldata += '<td>' + prEsc(d.requestno) + '</td>';
                    if (cfg.showType) {
                        htmldata += '<td>' + prEsc(isSentRequest ? 'My Buy Request' : 'Buyer Request') + '</td>';
                    }
                    htmldata += '<td>' + prEsc(personName) + '</td>';
                    htmldata += '<td>' + prEsc(d.productname) + '</td>';
                    htmldata += '<td>' + prEsc(d.message) + '</td>';
                    htmldata += '<td>$' + prEsc(d.offerprice) + '</td>';
                    htmldata += '<td>' + prEsc(d.createdate) + '</td>';

                    if (cfg.showStatus) {
                        htmldata += '<td><span class="badge ' + (prBadge[d.status] || '') + '">' + prEsc(d.statustext) + '</span></td>';
                    }
                    if (cfg.showAction) {
                        htmldata += '<td>';
                        if ((cfg.sellerAction || d.requesttype == 'buyer_request') && d.canapprove == 1) {
                            htmldata += '<button type="button" class="btn btn-sm btn-success btn-pr-approve" data-id="' + prEsc(d.id) + '">Approve</button> ';
                        }
                        if ((cfg.sellerAction || d.requesttype == 'buyer_request') && d.cancancel == 1) {
                            htmldata += '<button type="button" class="btn btn-sm btn-danger btn-pr-cancel" data-id="' + prEsc(d.id) + '">Cancel</button> ';
                        }
                        if (d.canopenchat == 1 && d.chatlink) {
                            htmldata += '<a class="btn btn-sm btn-primary" href="' + prPortal + d.chatlink + '">Open Chat</a>';
                        }
                        htmldata += '</td>';
                    }
                    htmldata += '</tr>';
                }
            } else {
                htmldata = '<tr><td colspan="' + cfg.colspan + '" class="text-center"><h3>' + prEsc(resultdata.message || 'No Product Request Found.') + '</h3></td></tr>';
            }

            $(cfg.target).html(htmldata);
            $(cfg.counter).html(cnt + ' Request');
        }, function (content) {
            if (!silent) {
                $('.chart-loading').hide();
                $(cfg.target).html('<tr><td colspan="' + cfg.colspan + '" class="text-center"><h3>Unable to load product requests.</h3></td></tr>');
                $(cfg.counter).html('0 Request');
            }
        });
    }

    function shouldAutoRefreshProductRequests() {
        return !document.hidden
            && !prActionInProgress
            && (prCurrentView == 'seller_productrequest' || prCurrentView == 'trade_allrequest');
    }

    function startProductRequestAutoRefresh() {
        if (prAutoRefreshTimer) {
            clearInterval(prAutoRefreshTimer);
        }

        prAutoRefreshTimer = setInterval(function () {
            if (shouldAutoRefreshProductRequests()) {
                listProductRequestView(prCurrentView, true);
            }
        }, 25000);
    }

    function listproductrequest(box) {
        listProductRequestView(box == 'sent' ? 'buyer_status' : 'seller_productrequest');
    }

    $('body').on('shown.bs.tab', '#buyer-myrequest-tab', function () { listProductRequestView('buyer_myrequest'); });
    $('body').on('shown.bs.tab', '#buyer-status-tab', function () { listProductRequestView('buyer_status'); });
    $('body').on('shown.bs.tab', '#seller-productrequest-tab', function () { listProductRequestView('seller_productrequest'); });
    $('body').on('shown.bs.tab', '#seller-status-tab', function () { listProductRequestView('seller_status'); });
    $('body').on('shown.bs.tab', '#trade-status-tab', function () { listProductRequestView('trade_status'); });
    $('body').on('shown.bs.tab', '#trade-allrequest-tab', function () { listProductRequestView('trade_allrequest'); });

    $('body').on('click', '.btn-pr-approve', function () {
        var requestid = $(this).attr('data-id');
        Notiflix.Confirm.Show(false, 'Approve this request and open chat?', false, false, function () {
            var formdata = new FormData();
            formdata.append('action', 'approveproductrequest');
            formdata.append('requestid', requestid);
            prActionInProgress = true;
            $('.chart-loading').show();
            ajaxrequest('POST', prEndpoint, formdata, prHeaders(), function (data) {
                $('.chart-loading').hide();
                var resultdata = jQuery.parseJSON(JSON.stringify(data));
                if (resultdata.status == 1) {
                    Notiflix.Notify.Success(resultdata.message);
                    window.location = prPortal + resultdata.result.chatlink;
                } else if (resultdata.status == -1) {
                    prActionInProgress = false;
                    $('#btnlogout').trigger('click');
                } else {
                    prActionInProgress = false;
                    Notiflix.Notify.Failure(resultdata.message);
                    listProductRequestView(prCurrentView || 'seller_productrequest');
                }
            }, function (content) {
                $('.chart-loading').hide();
                prActionInProgress = false;
                listProductRequestView(prCurrentView || 'seller_productrequest');
            });
        });
    });

    $('body').on('click', '.btn-pr-cancel', function () {
        var requestid = $(this).attr('data-id');
        Notiflix.Confirm.Show(false, 'Are you sure you want to cancel this request?', false, false, function () {
            var formdata = new FormData();
            formdata.append('action', 'cancelproductrequest');
            formdata.append('requestid', requestid);
            formdata.append('cancelreason', '');
            prActionInProgress = true;
            $('.chart-loading').show();
            ajaxrequest('POST', prEndpoint, formdata, prHeaders(), function (data) {
                $('.chart-loading').hide();
                var resultdata = jQuery.parseJSON(JSON.stringify(data));
                prActionInProgress = false;
                if (resultdata.status == -1) { $('#btnlogout').trigger('click'); return; }
                if (resultdata.status == 1) { Notiflix.Notify.Success(resultdata.message); }
                else { Notiflix.Notify.Failure(resultdata.message); }
                listProductRequestView(prCurrentView || 'seller_productrequest');
            }, function (content) {
                $('.chart-loading').hide();
                prActionInProgress = false;
                listProductRequestView(prCurrentView || 'seller_productrequest');
            });
        });
    });

    var prtab = '<?php echo (isset($_REQUEST["tab"])) ? $_REQUEST["tab"] : ""; ?>';
    if (prCanChat) {
        setTimeout(function () {
            if (prtab == 'buyer_myrequest' && $('#buyer-myrequest-tab').length) {
                $('#buy-request-tab #buyer-myrequest-tab').click();
            } else if (prtab == 'buyer_status' && $('#buyer-status-tab').length) {
                $('#buy-request-tab #buyer-status-tab').click();
            } else if (prtab == 'seller_productrequest' && $('#seller-productrequest-tab').length) {
                $('#buy-request-tab #seller-productrequest-tab').click();
            } else if (prtab == 'seller_status' && $('#seller-status-tab').length) {
                $('#buy-request-tab #seller-status-tab').click();
            } else if (prtab == 'trade_status' && $('#trade-status-tab').length) {
                $('#buy-request-tab #trade-status-tab').click();
            } else if (prtab == 'trade_allrequest' && $('#trade-allrequest-tab').length) {
                $('#buy-request-tab #trade-allrequest-tab').click();
            } else if (prIsTradePro == 1 && $('#seller-productrequest-tab').length) {
                listProductRequestView('seller_productrequest');
            } else if (prHasBuyRight == 1 && $('#buyer-myrequest-tab').length) {
                listProductRequestView('buyer_myrequest');
            } else if (prHasSellerRight == 1 && $('#seller-productrequest-tab').length) {
                listProductRequestView('seller_productrequest');
            }
        }, 600);
        startProductRequestAutoRefresh();
    }
    /* ================= PRODUCT REQUEST END ================= */



</script>



</html>
