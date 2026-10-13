<?php
require_once dirname(__DIR__, 1) . '/config/init.php';
$res = $DB->getpagemetadata(28);



if ($LoginInfo) 
{
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

$PackageData=$DB->checkpackagewiseuserright($LoginInfo->getUid());

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
    <?php include('css.php');  ?>

    <!-- CSS End -->
    <!-- <script src="assets/js/vendor/jquery.min.js"></script> -->
</head>

<body class="light support-page">
    <div class="page-wrapper">
        <div class="has-sidebar-left">
            <header class="bg-white accent-3 relative nav-sticky tab-box-shadow">
                <div class="container-fluid text-white">
                    <div class="row">
                        <div class="col-12 col-md-8 col-sm-8 col-lg-9 col-xl-10">
                            <h4 class="mb-0 sec-desc header-desc text-darkgreen set-headdes">Upgrade Plan</h4>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <div class="main" id="web-content">
            <?php include('sidebar.php'); ?>
            <section class="package-list-sec section-space">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mb-5 text-center">
                            <div class="package-list-title">
                                <h1 class="sec-title text-black title-shaddow">Package List</h1>
                            </div>
                            <div class="package-list-desc" id="PackageListDescr">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 set-plan-data">
                        <div class="plans-for-registration">
                            <div class="plans-block appear visible-element">
                                <header class="plans-headline text-center">
                                    <nav class="tabset animated animated-slide-bottom delay-05">
                                        <ul class="nav nav-pills toggle-btns-js cost-button">
                                            <?php 
                                            if($PackageData['packagetypeid']==2)
                                            {
                                                ?>
                                                    <li id="years-price">
                                                        <a href="javascript:void(0);" data-category="Membership" data-type="1" class="show-icon-save typechange active" data-label="Billed annually selector"> Annually </a>
                                                    </li>
                                                    <li id="month-price"><a href="javascript:void(0);" data-type="2" class="hide-icon-save typechange" data-category="Membership" data-label="Billed monthly selector"> Monthly</a></li>
                                                
                                                <?php
                                            }
                                            else{
                                                ?>
                                                    <li id="years-price">
                                                        <a href="javascript:void(0);" data-category="Membership" data-type="1" class="show-icon-save typechange active" data-label="Billed annually selector"> Annually </a>
                                                    </li>
                                                <?php
                                            }
                                            ?>
                                            <img class="save20-ico annually" src="#" alt="" style="display: block;">
                                            <img class="save20-ico month" src="#" alt="" style="display: none;">
                                        </ul>
                                    </nav>
                                </header>
                                <section class="savani-hr hr-sec section-space pt-0" id="PackageDataList">
                                    
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- <section class="package-list-sec section-space">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mb-5 text-center">
                            <div class="package-list-title">
                                <h1 class="sec-title text-black title-shaddow">Package List</h1>
                            </div>
                            <div class="package-list-desc" id="PackageListDescr">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 set-plan-data">
                        <div class="plans-for-registration">
                            <div class="plans-block appear visible-element">
                                <header class="plans-headline text-center">
                                    <nav class="tabset animated animated-slide-bottom delay-05">
                                        <ul class="nav nav-pills toggle-btns-js cost-button">
                                            <?php 
                                            if($PackageData['packagetypeid']==2)
                                            {
                                                ?>
                                                    <li id="years-price">
                                                        <a href="javascript:void(0);" data-category="Membership" data-type="1" class="show-icon-save typechange active" data-label="Billed annually selector"> Annually </a>
                                                    </li>
                                                    <li id="month-price"><a href="javascript:void(0);" data-type="2" class="hide-icon-save typechange" data-category="Membership" data-label="Billed monthly selector"> Monthly</a></li>
                                                
                                                <?php
                                            }
                                            else{
                                                ?>
                                                    <li id="years-price">
                                                        <a href="javascript:void(0);" data-category="Membership" data-type="1" class="show-icon-save typechange active" data-label="Billed annually selector"> Annually </a>
                                                    </li>
                                                <?php
                                            }
                                            ?>
                                            
                                           
                                            <img class="save20-ico annually" src="#" alt="" style="display: block;">
                                            <img class="save20-ico month" src="#" alt="" style="display: none;">
                                        </ul>
                                    </nav>
                                </header>
                                <section class="savani-hr hr-sec section-space pt-0" id="PackageDataList">

                                </section>
                            </div>
                        </div>
                    </div>
                </div>

            </section> -->
        </div>
        <?php include('footer.php'); ?>
    </div>

</body>
<?php include('js.php'); ?>
<script>
    hideloader();

    $(document).ready(function() {
        listpackagedetail(1);

    });

    $('.typechange').on('click', function() {
        if ($(this).attr('data-type') == 1) {
            $('.plans-box .years').removeClass('hidden');
            $('.plans-box .month').addClass('hidden');
            $('.show-icon-save').addClass('active');
            $('.hide-icon-save').removeClass('active');
        } else if ($(this).attr('data-type') == 2) {
            $('.plans-box .years').addClass('hidden');
            $('.plans-box .month').removeClass('hidden');
            $('.show-icon-save').removeClass('active');
            $('.hide-icon-save').addClass('active');

        }
        listpackagedetail($(this).attr('data-type'));
        // changetypewisedata();
    });

    function listpackagedetail(typeid) {
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
        formdata.append("action", "listupgradepackagedetail");
        formdata.append("typeid", typeid);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>package', formdata, headersdata, Onsuccesslistpackagedetail, OnErrorlistpackagedetail);

        function Onsuccesslistpackagedetail(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {

                $('#PackageDataList').html(resultdata.data);

                
                // $('#PackageDataList .palnpenal-multi').owlCarousel({
                //     loop: false,
                //     margin: 10,
                //     nav: true,
                //     dots: false,
                //     responsive: {
                //         0: {
                //             items: 1
                //         },
                //         600: {
                //             items: 1
                //         },
                //         992: {
                //             items: 2
                //         },
                //         1000: {
                //             items: 3
                //         }
                //     }
                // });
                $('#PackageDataList .palnpenal').owlCarousel({
                    loop: false,
                    margin: 10,
                    nav: false,
                    dots: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 1
                        },
                        768: {
                            items: 1
                        },
                        1000: {
                            items: 1
                        }
                    }
                });
                $('#PackageDataList .btnapplychooseplan').click(function() {
                    var packageid = $(this).attr('data-package');
                    var type = $(this).attr('data-type');
                    checkuserlogin(type, packageid);
                });
            }
        }

        function OnErrorlistpackagedetail(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }


    $('body').on('click', '#PackageDataList .view-package-details-tag', function() {

        var id = $(this).attr('data-packageid');
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: '',
            masterlisting: false,
            responsetype: 'JSON'
        };

        formdata = new FormData();
        formdata.append("action", "listupgradepackagedetail");
        formdata.append("id", id);
        formdata.append("typeid", 1);

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + 'package', formdata, headersdata, Onsuccessviewpackagedetails, OnErrorviewpackagedetails);

        function Onsuccessviewpackagedetails(content) {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                // console.log('short descr : '+resultdata.package[0].shortdescr);
                // console.log('terms condition : '+resultdata.package[0].termscondition);
                // console.log('descr : '+resultdata.package[0].descr);

                htmldata += '<div class="row mt-5">';
                htmldata += '    <div class="col-12 col-exs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">';
                htmldata += '        <h4 class="text-center packagedetails-modal-title"> -: Short Description :- </h4>';
                htmldata += '        <p class="packagedetails-modal-text">' + resultdata.package[0].shortdescr + '</p>';
                htmldata += '    </div>';
                htmldata += '    <div class="col-12 col-exs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">';
                htmldata += '        <h4 class="text-center packagedetails-modal-title">-: Description :- </h4>';
                htmldata += '        <p class="packagedetails-modal-text">' + resultdata.package[0].descr + '</p>';
                htmldata += '    </div>';
                htmldata += '    <div class="col-12 col-exs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">';
                htmldata += '        <h4 class="text-center packagedetails-modal-title">-: Terms & Conditions :-</h4>';
                htmldata += '        <p class="packagedetails-modal-text">' + resultdata.package[0].termscondition + '</p>';
                htmldata += '    </div>';
                htmldata += '</div>';
                $('#modalpackagedetails #packagedetailsData').html(htmldata);
                $('#modalpackagedetails').modal('show');
            }

        }

        function OnErrorviewpackagedetails(content) {
            ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
        }
    });

    $('body').on('click','.btnapplyupgradeplan',function(){
        var packageid = $(this).attr('data-package');
        var type = $(this).attr('data-type');
        var btntype = $(this).attr('data-btntype');
        checkuserlogin(type,packageid,btntype);
    });

    
</script>

</html>