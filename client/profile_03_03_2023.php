<?php
// require_once dirname(__DIR__, 1).'/config/config.php';
// $config = new config();

require_once dirname(__DIR__, 1) . '/config/init.php';
$res=$DB->getpagemetadata(25);

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
    <link rel="icon" type="image/x-icon" href="<?php echo $config->getImageurl(); ?>images/favicon.ico"/>
    <!-- Meta Tag End -->

    <!--title-->
    <title><?php echo $res[0]['title']; ?></title>

    <!-- CSS Start -->
    <?php include('css.php'); ?>

    <!-- CSS End -->
    <!-- <script src="assets/js/vendor/jquery.min.js"></script> -->
</head>

<body class="bg-white home-page">
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
    // 2 - Jewelry Search
    $CanJewellerySearch = $DB->getpackagewiseuserright($LoginInfo->getUid(),2)['attributeval'];
    ?>
    <div class="page-wrapper">
        <div class="has-sidebar-left">
            <header class="bg-white accent-3 relative nav-sticky tab-box-shadow ">
                <div class="container-fluid text-white">
                    <div class="proimbgs">
                        <div class="row">
                            <div class="setimagepf">
                                <li class="text-center">
                                    <div class="user-img-block">
                                        <p class="imgerr text-danger"></p>
                                        <span class="user-profile-img userprofilebg">
                                            <a href="<?php echo $LoginInfo->getProfilepic(); ?>" title="<?php echo $LoginInfo->getFullname(); ?>" target="_blank">
                                                <img id="userprofileimg" src="<?php echo $LoginInfo->getProfilepic(); ?>" alt="<?php echo $LoginInfo->getFullname(); ?>" title="<?php echo $LoginInfo->getFullname(); ?>">
                                            </a>
                                        </span>
                                        <div class="my-profile profileimgDiv proch prov">
                                            <label for="inp_userprofileimg" class="user-pic"><i class="user-img fal fa-user-edit"></i></label>
                                        </div>
                                        <!-- <div class="proch prov">
                                            <label for="userprofileimg" onclick="importData()" class="user-pic">
                                                <i class="user-img fal fa-user-edit"></i>
                                            </label>
                                        </div>
                                        <div class="my-profile profileimgDiv">
                                            
                                        </div> -->
                                    </div>
                                </li>
                            </div>
                            <div class="col-sm-8 col-md-6 setdespf">
                                <div class="saidpf">
                                    <h5 id="profile_savaniid"></h5>
                                </div>
                                <div class="sanamep">
                                    <h4 id="profile_companyname"></h4>
                                </div>
                                <div class="valisavpf">
                                    <p><label id="profile_personname"></label> | <label id="profile_membershipvalid"></label></p>
                                </div>
                                <div class="titsavpf">
                                    <label id="profile_packagename"></label> | <label id="profile_membershipfor"></label>
                                </div>
                            </div>
                            <!-- <div class="setlogoutbtn">
                                <div class="sidemenu-img"><img src="http://192.168.1.2/savanigems/assets/images/sidemenu/logout.svg" alt="logout" title="logout"></div>
                            </div> -->
                        </div>
                    </div>
                    <div class="row justify-content-center setmpo">
                        <div class="col-12 col-md-12 m-auto pt-3">
                            <ul class="setnavprof nav responsive-tab nav-material nav-material-white pt-2" id="my-profile-tab">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-Profile-tab" data-toggle="tab" href="#nav-Profile" role="tab" aria-controls="nav-Profile" aria-selected="true">Basic Details</a>
                                        <a class="nav-item nav-link" id="nav-Changeinformaton-tab" data-toggle="tab" href="#nav-Changeinformaton" role="tab" aria-controls="nav-Changeinformaton" aria-selected="false">Company informaton</a>
                                        <!-- <a class="nav-item nav-link" id="nav-Address-tab" data-toggle="tab" href="#nav-Address" role="tab" aria-controls="nav-Address" aria-selected="false">Address</a>
                                        -->
                                        <?php 
                                        if($CanJewellerySearch==1)
                                        {
                                        ?>
                                            <a class="nav-item nav-link" id="nav-Wishlist-tab" data-toggle="tab" href="#nav-Wishlist" role="tab" aria-controls="nav-Wishlist" aria-selected="true">Jewellery Favourite list</a>
                                        <?php 
                                        } ?>
                                        <a class="nav-item nav-link" id="nav-Changepassword-tab" data-toggle="tab" href="#nav-Changepassword" role="tab" aria-controls="nav-Changepassword" aria-selected="false">Change password</a>
                                        <a class="nav-item nav-link" id="nav-plan-tab" data-toggle="tab" href="#nav-plan" role="tab" aria-controls="nav-plan" aria-selected="false">plan</a>
                                    </div>
                                </nav>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <div class="main" id="web-content">
            <?php include('sidebar.php'); ?>
            <div class="has-sidebar-left">
                <div class="container-fluid relative animatedParent setpof animateOnce">
                    <div class="tab-content bg-white" id="pills-tabContent">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-Profile" role="tabpanel" aria-labelledby="nav-Profile-tab">
                                <div class="col-12 col-md-12 setcoloall">
                                    <div class="dashboard_content">
                                        <form action="javascript:void(0);" name="form-basic-profile" id="form-basic-profile" method="POST">
                                            <input class="form-control d-none my-profile-form-control" name="profilepic" id="inp_userprofileimg" accept="image/*" onChange="validate(this.value)" type="file" readonly>
                                            <div class="row setrpo">
                                                <div class="col-md-10 col-lg-9 col-xl-9 col-12 unamesetp">
                                                    <div class="row">
                                                        <div class="col-md-12 setpupi">
                                                            <label for="p_fullname">Full Name&nbsp;<span class="text-danger">*</span></label>
                                                            <input type="text" class="prosetad" placeholder="Enter Full Name" autocomplete="off" name="fullname" id="p_fullname" />
                                                        </div>
                                                        <div class="col-md-6 setpupi">
                                                            <label for="p_address">Addres&nbsp;<span class="text-danger">*</span></label>
                                                            <textarea class="prosetad" placeholder="Enter Addres" name="address" id="p_address"></textarea>
                                                        </div>
                                                        <div class="col-md-6 setpupi">
                                                            <label for="p_additionaladdress">Additional Address </label>
                                                            <textarea class="prosetad" placeholder="Enter Additional Addres" name="additionaladdress" id="p_additionaladdress"></textarea>
                                                        </div>
                                                        <div class="col-md-6 setpupi">
                                                            <label for="p_countryid">Country&nbsp;<span class="text-danger">*</span></label>
                                                            <select class="form-control" id="p_countryid" name="countryid">

                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 setpupi">
                                                            <label for="p_stateid">State&nbsp;<span class="text-danger">*</span></label>
                                                            <select class="form-control" id="p_stateid" name="stateid">

                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 setpupi">
                                                            <label for="p_city">City&nbsp;<span class="text-danger">*</span></label>
                                                            <input type="text" class="prosetad" placeholder="Enter City" autocomplete="off" name="city" id="p_city" />
                                                        </div>
                                                        <div class="col-md-6 setpupi">
                                                            <label for="p_zipcode">Zip Code&nbsp;<span class="text-danger">*</span></label>
                                                            <input type="text" class="prosetad" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Zip Code" autocomplete="off" name="zipcode" id="p_zipcode" />
                                                        </div>
                                                        <div class="col-md-6 setpupi">
                                                            <label for="p_refname1">Reference Person 1</label>
                                                            <input type="text" class="prosetad" placeholder="Enter Reference Person 1" autocomplete="off" name="refname1" id="p_refname1" />
                                                        </div>
                                                        <div class="col-md-6 setpupi">
                                                            <label for="p_refname2">Reference Person 2</label>
                                                            <input type="text" class="prosetad" placeholder="Enter Reference Person 2" autocomplete="off" name="refname2" id="p_refname2" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="col-md-12 btnsetpr">
                                                        <button type="submit" class="btn">Update Profile</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-Changepassword" role="tabpanel" aria-labelledby="nav-Changepassword-tab">
                                <div class="col-12 col-md-12 setcoloall passwordpfse unamesetp">
                                    <form action="javascript:void(0);" name="form-change-password" id="form-change-password" method="POST">
                                        <div class="row setrpsf">
                                            <div class="col-md-5 col-lg-5 col-xl-4 setpfo">
                                                <div class="col-md-12 setmpr">
                                                    <label for="oldpass">Old Password&nbsp;<span class="text-danger">*</span></label>
                                                    <input type="password" class="prosetad" autocomplete="off" placeholder="Enter Old Password" id="oldpassword" name="oldpassword" />
                                                </div>
                                                <div class="col-md-12 setmpr">
                                                    <label for="pass">New Password&nbsp;<span class="text-danger">*</span></label>
                                                    <input type="password" class="prosetad" autocomplete="off" placeholder="Enter New Password" id="newpassword" name="newpassword" />
                                                </div>
                                                <div class="col-md-12 setmpr">
                                                    <label for="pass">Confirm Password&nbsp;<span class="text-danger">*</span></label>
                                                    <input type="password" class="prosetad" autocomplete="off" placeholder="Enter Confirm Password" id="cpassword" name="cpassword" />
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-lg-5 col-xl-4 setpaer">
                                                <div class="card">
                                                    <div class="card-body" id="ChangePasswordDetails">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="col-md-12 btnsetpr text-right">
                                                    <button type="submit" class="btn">Update Password</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- <div class="tab-pane fade" id="nav-Address" role="tabpanel" aria-labelledby="nav-Address-tab">
                            <div class="col-12 col-md-12 setcoloall">
                                <div class="row setcoad">
                                    <div class="col-md-10">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="#" id="save">
                                                    <div class="box-head">
                                                        <h3>My Address</h3>
                                                        <button class="btn setadsbtn btn-solid-default btn-sm fw-bold ms-auto" data-toggle="modal" data-target="#addadress"><i class="fas fa-plus"></i>
                                                            Add New Address</button>
                                                    </div>
                                                    <div class="save-details-box">
                                                        <div class="row g-3">
                                                            <div class="col-xl-3 col-md-6 adsetpfre">
                                                                <div class="save-details">
                                                                    <div class="save-name">
                                                                        <h5>Mark Jugal</h5>
                                                                        <div class="save-position">
                                                                            <h6>Home</h6>
                                                                        </div>
                                                                    </div>

                                                                    <div class="save-address">
                                                                        <p>549 Sulphur Springs Road</p>
                                                                        <p>Downers Grove, IL</p>
                                                                        <p>60515</p>
                                                                    </div>

                                                                    <div class="mobile">
                                                                        <p class="font-light mobile">Mobile No. +91 03456 - 07890</p>
                                                                    </div>

                                                                    <div class="button">
                                                                        <a href="#" class="btn btn-sm">Edit</a>
                                                                        <a href="#" class="btn btn-sm">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 adsetpfre">
                                                                <div class="save-details">
                                                                    <div class="save-name">
                                                                        <h5>Method Zaki</h5>
                                                                        <div class="save-position">
                                                                            <h6>Office</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="save-address">
                                                                        <p>549 Sulphur Springs Road</p>
                                                                        <p>Downers Grove, IL</p>
                                                                        <p>60515</p>
                                                                    </div>
                                                                    <div class="mobile">
                                                                        <p class="font-light mobile">Mobile No. +91 03456 - 07890</p>
                                                                    </div>
                                                                    <div class="button">
                                                                        <a href="#" class="btn btn-sm">Edit</a>
                                                                        <a href="#" class="btn btn-sm">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 adsetpfre">
                                                                <div class="save-details">
                                                                    <div class="save-name">
                                                                        <h5>Mark Jugal</h5>
                                                                        <div class="save-position">
                                                                            <h6>Home</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="save-address">
                                                                        <p>549 Sulphur Springs Road</p>
                                                                        <p>Downers Grove, IL</p>
                                                                        <p>60515</p>
                                                                    </div>

                                                                    <div class="mobile">
                                                                        <p class="font-light mobile">Mobile No. +91 03456 - 07890</p>
                                                                    </div>

                                                                    <div class="button">
                                                                        <a href="#" class="btn btn-sm">Edit</a>
                                                                        <a href="#" class="btn btn-sm">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 adsetpfre">
                                                                <div class="save-details">
                                                                    <div class="save-name">
                                                                        <h5>Mark Jugal</h5>
                                                                        <div class="save-position">
                                                                            <h6>Home</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="save-address">
                                                                        <p>549 Sulphur Springs Road</p>
                                                                        <p>Downers Grove, IL</p>
                                                                        <p>60515</p>
                                                                    </div>

                                                                    <div class="mobile">
                                                                        <p class="font-light mobile">Mobile No. +91 03456 - 07890</p>
                                                                    </div>

                                                                    <div class="button">
                                                                        <a href="#" class="btn btn-sm">Edit</a>
                                                                        <a href="#" class="btn btn-sm">Remove</a>
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
                            </div>
                        </div> -->
                            <?php 
                            if($CanJewellerySearch==1)
                            {
                            ?>
                                <div class="tab-pane fade" id="nav-Wishlist" role="tabpanel" aria-labelledby="nav-Wishlist-tab">
                                    <div class="col-12 col-md-12 setcoloall">
                                        <div class="row setcompfav">
                                            <div class="col-md-10">
                                                <div class="grid-products grid--view-items prd-grid productsetje listjewelleryDataDiv" id="listjewelleryData" data-show="0" data-nextpage="0">

                                                </div>
                                                <div class="row">
                                                    <div class="text-left col-md-6"><b>Showing <span id="showjewelleryentries"></span> entries</b></div>
                                                    <div class="text-right col-md-2 offset-4"><b class="w-auto setallpageentry">entry <select class="form-control w-auto  ml-auto" id="jewellery_per_page" name="jewellery_per_page">
                                                                <!-- <option value="15">15</option> -->
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
                            <?php 
                            } ?>    
                            <div class="tab-pane fade" id="nav-Changeinformaton" role="tabpanel" aria-labelledby="nav-Changeinformaton-tab">
                                <div class="col-12 col-md-12 setcoloall setcompr">
                                    <form action="javascript:void(0);" name="form-company-info" id="form-company-info" method="POST">
                                        <div class="row setcomp">
                                            <div class="col-12 col-md-10 col-lg-9 col-xl-9">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="p_companyname">Company Name&nbsp;<span class="text-danger">*</span></label>
                                                                <input type="text" class="prosetad" placeholder="Enter Company Name" id="p_companyname" name="companyname" />
                                                            </div>
                                                            <div class="col-md-6 setmtpr">
                                                                <label for="p_businesstypeid">Type Of Business&nbsp;<span class="text-danger">*</span></label>
                                                                <select class="form-control" id="p_businesstypeid" name="businesstypeid">

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-3 col-lg-3 col-xl-2">
                                                                <label for="p_businesstypeid">Phone Code&nbsp;<span class="text-danger">*</span></label>
                                                                <select class="form-control" id="p_phonecodeid" name="phonecodeid">

                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-4 setmtpr">
                                                                <label for="p_businessphone">Business Phone&nbsp;<span class="text-danger">*</span></label>
                                                                <input type="text" class="prosetad" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Business Phone" autocomplete="off" name="businessphone" id="p_businessphone" />
                                                            </div>
                                                            <div class="col-md-5 col-lg-5 col-xl-6 setmtpr">
                                                                <label for="p_website">Website </label>
                                                                <input type="text" class="prosetad" placeholder="Enter Website" autocomplete="off" name="website" id="p_website" />
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="cn">Company No</label>
                                                                <input type="text" class="prosetad" placeholder="Enter Company No" autocomplete="off" name="companyno" id="p_companyno" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="col-md-12 btnsetpr text-right">
                                                    <button type="submit" class="btn">Update Information</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-plan" role="tabpanel" aria-labelledby="nav-plan-tab">
                                <div class="row setrpal">
                                    <div class="col-md-10 col-sm-10 col-10" id="MyPlanDetails">

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
    // function importData() {
    // let input = document.createElement('input');
    // input.type = 'file';
    // input.onchange = _ => {
    //     // you can use this method to get file and perform respective operations
    //             let files =   Array.from(input.files);
    //             console.log(files);
    //         };
    // input.click();

    // }

    $('#my-profile-tab .nav-link').on('click', function() {
        var id = $(this).attr('id');
        $('.profileimgDiv .user-img').addClass('d-none');
        if (id == 'nav-Profile-tab') {
            $('.profileimgDiv .user-img').removeClass('d-none');
        }
    });
    inp_userprofileimg.onchange = evt => {
        const [file] = inp_userprofileimg.files
        if (file) {
            var selection = document.getElementById('inp_userprofileimg');

            var ext = selection.files[0].name.substr(-3);
            if (ext !== "jpg" && ext !== "jpeg" && ext !== "png") {
                Notiflix.Notify.Failure('Please upload .jpg , .jpeg , .png file');
                return false;
            } else {
                userprofileimg.src = URL.createObjectURL(file);
                var imgurl = $('#userprofileimg').attr('src');
                // alert(imgurl);

                $(".userprofilebg").css("background-image", "url(" + imgurl + ")");
                $(".inp_userprofileimg").val(imgurl);
            }
        }
    }

    $(document).ready(function() {
        fillprofiledetails();
        fillcontentsetting();
        fillpackagedetails();
        <?php 
        if($CanJewellerySearch==1)
        {
        ?>
            listjewellerydata(1);
        <?php 
        } ?>
        $('.profileimgDiv .user-img').removeClass('d-none');
    });


    function fillprofiledetails() {
        showloader();
        var pagename = getpagename();
        var useraction = $('#formevent').val();
        formdata = new FormData();
        formdata.append("action", "listmyprofile");
        var headersdata = {
            'Accept': 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: useraction,
            masterlisting: false
        };
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>myprofile', formdata, headersdata, Onsuccessfillprofiledetails, OnErrorfillprofiledetails)

        function Onsuccessfillprofiledetails(data) {
            hideloader();
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            if (resultdata.IsPackageExpire == 1) {
                Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});
            }
            else{
                if (resultdata.status == 0) {
                    // Notiflix.Notify.Failure(resultdata.message);
                    $('#userprofileimg').attr('src', '<?php echo $LoginInfo->getProfilepic(); ?>');
                    $('#userprofileimg').attr('alt', '<?php echo $LoginInfo->getFullname(); ?>');
                    $('#userprofileimg').attr('title', '<?php echo $LoginInfo->getFullname(); ?>');
                } else if (resultdata.status == 1) {

                    $('.userprofilebg a').attr('href', resultdata.data[0].profileimg);
                    $('.userprofilebg a').attr('title', resultdata.data[0].personname);
                    $('#userprofileimg').attr('src', resultdata.data[0].profileimg);
                    $('#userprofileimg').attr('alt', resultdata.data[0].personname);
                    $('#userprofileimg').attr('title', resultdata.data[0].personname);
                    $('#profile_savaniid').html('ID No : ' + resultdata.data[0].savaniid);
                    $('#profile_companyname').html(resultdata.data[0].companyname);
                    $('#profile_personname').html(resultdata.data[0].personname);

                    $('#form-basic-profile #p_fullname').val(resultdata.data[0].personname);
                    $('#form-basic-profile #p_address').val(resultdata.data[0].address);
                    $('#form-basic-profile #p_additionaladdress').val(resultdata.data[0].additionaladdress);
                    listcountry(resultdata.data[0].countryid, resultdata.data[0].stateid);
                    // liststate(resultdata.data[0].countryid,resultdata.data[0].stateid);

                    $('#form-basic-profile #p_city').val(resultdata.data[0].cityname);
                    $('#form-basic-profile #p_zipcode').val(resultdata.data[0].pincode);
                    $('#form-basic-profile #p_refname1').val(resultdata.data[0].refname1);
                    $('#form-basic-profile #p_refname2').val(resultdata.data[0].refname2);

                    listbusinesstype(resultdata.data[0].businesstypeid);
                    listphonecode(resultdata.data[0].phonecodeid);

                    $('#form-company-info #p_companyname').val(resultdata.data[0].companyname);
                    $('#form-company-info #p_businessphone').val(resultdata.data[0].businessphoneno);
                    $('#form-company-info #p_website').val(resultdata.data[0].businesswebsite);
                    $('#form-company-info #p_companyno').val(resultdata.data[0].businesscompanyno);



                }
            }    

        }

        function OnErrorfillprofiledetails(content) {

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
            responsetype: 'HTML'
        };
        formdata = new FormData();
        formdata.append("action", "listcountry");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistcountry, OnErrorlistcountry);

        function Onsuccesslistcountry(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);

            var htmldata = '<option value="">Select Country</option>';
            if (resultdata.data) {
                $('#p_countryid').html(resultdata.data);
            } else {
                $('#p_countryid').html(htmldata);
            }
            if (countryid) {
                $('#p_countryid').val(countryid);
            }
            $('#p_countryid').select2();
            liststate(countryid, stateid);
        }

        function OnErrorlistcountry(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    $('#p_countryid').change(function() {
        liststate();
    });

    function liststate(editcountryid = '', stateid = '') {
        var pagename = getpagename();
        var countryid = $('#p_countryid').val();
        if (editcountryid != '') {
            countryid = editcountryid;
        }
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false,
            responsetype: 'HTML'
        };
        formdata = new FormData();
        formdata.append("action", "liststate");
        formdata.append("countryid", countryid);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessliststate, OnErrorliststate);

        function Onsuccessliststate(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '<option value="">Select State</option>';
            if (resultdata.data) {
                $('#p_stateid').html(resultdata.data);
            } else {
                $('#p_stateid').html(htmldata);
            }
            if (stateid) {
                $('#p_stateid').val(stateid);
            }
            $('#p_stateid').select2();
        }

        function OnErrorliststate(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    if ($('#form-basic-profile').length) {
        $('#form-basic-profile').validate({
            rules: {
                fullname: {
                    required: true,
                },
                address: {
                    required: true,
                },
                countryid: {
                    required: true,
                },
                stateid: {
                    required: true,
                },
                city: {
                    required: true,
                },
                zipcode: {
                    required: true,
                    number: true
                }
            },
            messages: {
                fullname: {
                    required: "Full Name is required",
                },
                address: {
                    required: "Address is required",
                },
                countryid: {
                    required: "Country is required",
                },
                stateid: {
                    required: "State is required",
                },
                city: {
                    required: "City is required",
                },
                zipcode: {
                    required: "Zip Code is required",
                }
            },
            submitHandler: function(form) {

                showloader();
                var selection = document.getElementById('inp_userprofileimg');
                // console.log(selection.files.length);
                if (selection.files.length) {
                    var issubmit = 1;

                    var ext = selection.files[0].name.substr(-3);
                    if (ext != "jpg" && ext != "jpeg" && ext != "png") {
                        Notiflix.Notify.Failure('Please upload .jpg , .jpeg , .png file');
                        issubmit = 0;

                    }

                } else {
                    var issubmit = 1;
                }
                if (issubmit == 1) {
                    var pagename = getpagename();
                    var useraction = $('#formevent').val();
                    formdata = new FormData(form);
                    formdata.append("action", "updateprofile");
                    formdata.append("formtype", 1);
                    var headersdata = {
                        'Accept': 'application/json',
                        platform: 4,
                        userpagename: pagename,
                        useraction: useraction,
                        masterlisting: false
                    };
                    ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>myprofile', formdata, headersdata, Onsuccessupdateprofile, OnErrorupdateprofile)

                    function Onsuccessupdateprofile(data) {
                        hideloader();
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
                                $('#form-basic-profile').find(".my-profile-form-control").attr('readonly', function(index, attr) {
                                    return attr == 'readonly' ? null : 'readonly';
                                });
                                fillprofiledetails();
                            }
                        }   

                    }

                    function OnErrorupdateprofile(content) {

                    }
                } else {
                    Notiflix.Notify.Failure('Please upload .jpg , .jpeg , .png file');
                }

            },
        });
    }


    if ($('#form-company-info').length) {
        $('#form-company-info').validate({
            rules: {
                companyname: {
                    required: true,
                },
                businesstypeid: {
                    required: true,
                },
                businessphone: {
                    required: true,
                    number: true
                },
                phonecodeid: {
                    required: true,
                },
            },
            messages: {
                companyname: {
                    required: "Company Name is required",
                },
                businesstypeid: {
                    required: "Type Of Business is required",
                },
                phonecodeid: {
                    required: "Phone Code is required",
                },
                businessphone: {
                    required: "Business Phone is required",
                },
            },
            submitHandler: function(form) {

                showloader();
                var pagename = getpagename();
                var useraction = $('#formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "updateprofile");
                formdata.append("formtype", 2);
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 4,
                    userpagename: pagename,
                    useraction: useraction,
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>myprofile', formdata, headersdata, Onsuccesscompanyupdateprofile, OnErrorcompanyupdateprofile)

                function Onsuccesscompanyupdateprofile(data) {
                    hideloader();
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
                            fillprofiledetails();
                        }
                    }   

                }

                function OnErrorcompanyupdateprofile(content) {

                }


            },
        });
    }

    function listbusinesstype(businesstypeid = '') {
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
        formdata.append("action", "listbusinesstype");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistbusinesstype, OnErrorlistbusinesstype);

        function Onsuccesslistbusinesstype(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '<option value="">Select Type Of Business</option>';
            if (resultdata.data) {
                $('#p_businesstypeid').html(resultdata.data);
            } else {
                $('#p_businesstypeid').html(htmldata);
            }
            if (businesstypeid) {
                $('#p_businesstypeid').val(businesstypeid);
            }
            $('#p_businesstypeid').select2();

        }

        function OnErrorlistbusinesstype(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    function listphonecode(phonecodeid = '') {
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
        formdata.append("action", "listphonecode");
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistphonecode, OnErrorlistphonecode);

        function Onsuccesslistphonecode(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '<option value="">Select Phone Code</option>';
            if (resultdata.data) {
                $('#p_phonecodeid').html(resultdata.data);
            } else {
                $('#p_phonecodeid').html(htmldata);
            }
            if (phonecodeid) {
                $('#p_phonecodeid').val(phonecodeid);
            }
            $('#p_phonecodeid').select2();
        }

        function OnErrorlistphonecode(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    if ($('#form-change-password').length) {
        $('#form-change-password').validate({
            rules: {
                oldpassword: {
                    required: true,
                },
                newpassword: {
                    required: true,
                },
                cpassword: {
                    required: true,
                    equalTo: "#newpassword"
                },
            },
            messages: {
                oldpassword: {
                    required: "Old password is required",
                },
                newpassword: {
                    required: "New Password is required",
                },
                cpassword: {
                    required: "Confirm New Password is required",
                    equalTo: "Confirm Password is same as New Password"
                },
            },
            submitHandler: function(form) {

                showloader();
                var pagename = getpagename();
                var useraction = $('#formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "changepassword");
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 4,
                    userpagename: pagename,
                    useraction: useraction,
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>myprofile', formdata, headersdata, Onsuccesschangepassword, OnErrorchangepassword)

                function Onsuccesschangepassword(data) {
                    hideloader();
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
                            $("#form-change-password").validate().resetForm();
                            $('#form-change-password').trigger("reset");
                        }
                    }   

                }

                function OnErrorchangepassword(content) {

                }


            },
        });
    }


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
        formdata.append("typeid", 28);

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
            $('#ChangePasswordDetails').html(htmldata);
        } else if (resultdata.status == 1) {
            $('#ChangePasswordDetails').html(resultdata.result[0].description);
        }

    }

    function OnErrorfillcontentsetting(content) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }




    function fillpackagedetails() {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: '',
            masterlisting: false
        };

        formdata = new FormData();
        formdata.append("action", "mypackages");

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + 'myprofile', formdata, headersdata, Onsuccessfillpackagedetails, OnErrorfillpackagedetails);
    }

    function Onsuccessfillpackagedetails(content) {
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        var htmldata = '';
        if (resultdata.IsPackageExpire == 1) {
            Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});
        }
        else{
            if (resultdata.status == 0) {
                htmldata += '<h3 class="text-center">' + resultdata.message + '</h3>';
                $('#MyPlanDetails').html(htmldata);
            } else if (resultdata.status == 1) {

                var packagedata = resultdata.result[0];

                $('#profile_membershipvalid').html('Membership : Valid Until ' + packagedata.expirydate);
                $('#profile_packagename').html(packagedata.packagename);
                if (packagedata.packagetypeid == 1) {
                    $('#profile_membershipfor').html('Member For ' + packagedata.memberfor + ' Year');
                } else if (packagedata.packagetypeid == 2) {
                    $('#profile_membershipfor').html('Member For ' + packagedata.memberfor + ' Month');
                }


                htmldata += '<div class="setplandepf">';
                htmldata += '<div class="titplpf">';
                htmldata += 'Your plan';
                htmldata += '</div>';
                htmldata += '<div class="expriredepr">';
                htmldata += '<p>';
                htmldata += '' + packagedata.packagename + '';
                htmldata += '</p>';
                htmldata += '</div>';
                htmldata += '<div class="row setrowdat">';
                htmldata += '<div class="col-md-6 col-sm-6 col-6 text-right">';
                htmldata += '<div class="byplpf">';
                htmldata += '<h3>' + packagedata.packactivatedate + '</h3>';
                htmldata += '<p>Join Date</p>';
                htmldata += '</div>';
                htmldata += '</div>';
                htmldata += '<div class="col-md-6 col-sm-6 col-6 text-left">';
                htmldata += '<div class="byplpf">';
                htmldata += '<h3>' + packagedata.expirydate + '</h3>';
                htmldata += '<p>Expiry Date</p>';
                htmldata += '</div>';
                htmldata += '</div>';
                htmldata += '</div>';
                htmldata += '<div class="row">';
                htmldata += '<div class="col-12">';
                htmldata += '<div class="col-md-12 btnsetpfpl text-center">';
                htmldata += '<button type="button"  data-toggle="modal" data-target="#activeplandetailsModal" class="btn">Your Plan</button>';
                htmldata += '<a href="<?php echo $config->getWeburl(); ?>membershipplan" target="_blank" class="btn setbtnup">Update Plan</a>';
                htmldata += '</div>';
                htmldata += '</div>';
                htmldata += '</div>';
                htmldata += '</div>';
                htmldata += '<br><br><br><br><br><br>';
                $('#MyPlanDetails').html(htmldata);

                var htmldatadetails = '';
                htmldatadetails += '<div class="availsetjw">';

                htmldatadetails += '<div class="card">';
                htmldatadetails += '<div class="card-body">';
                htmldatadetails += '<div class="Notessearchd">';
                htmldatadetails += '<ul>';
                for (var i in packagedata.mypackagedetail) {
                    htmldatadetails += '<li><b>' + packagedata.mypackagedetail[i].pfprintname + '</b>:';
                    var attributevaltext = 'No';
                    if (packagedata.mypackagedetail[i].attributeval == 1 && packagedata.mypackagedetail[i].haslimit == 1) {
                        attributevaltext = packagedata.mypackagedetail[i].limittext;
                    } else if (packagedata.mypackagedetail[i].attributeval == 1) {
                        attributevaltext = 'Yes';
                    }
                    htmldatadetails += '<span class="metalpurity1">&nbsp;' + attributevaltext + '</span>';

                    htmldatadetails += '</li>';
                }
                htmldatadetails += '</ul>';
                htmldatadetails += '</div>';
                htmldatadetails += '</div>';
                htmldatadetails += '</div>';
                htmldatadetails += '</div>';
                htmldatadetails += '<div class="availsetjw">';
                htmldatadetails += '<div class="card">';
                htmldatadetails += '<div class="card-body">';
                htmldatadetails += '<div class="Notessearchd"><h5 calss="avilabtnsetjw">Terms & Conditions</h5><br>' + packagedata.termscondition + '';
                htmldatadetails += '</div>';
                htmldatadetails += '</div>';
                htmldatadetails += '</div>';
                htmldatadetails += '</div>';
                htmldatadetails += '<div class="availsetjw">';
                htmldatadetails += '<div class="card">';
                htmldatadetails += '<div class="card-body">';
                htmldatadetails += '<div class="Notessearchd"><h5 calss="avilabtnsetjw">Short Description</h5><br>' + packagedata.shortdescr + '';
                htmldatadetails += '</div>';
                htmldatadetails += '</div>';
                htmldatadetails += '</div>';
                htmldatadetails += '</div>';
                htmldatadetails += '<div class="availsetjw">';
                htmldatadetails += '<div class="card">';
                htmldatadetails += '<div class="card-body">';
                htmldatadetails += '<div class="Notessearchd"><h5 calss="avilabtnsetjw">Description</h5><br>' + packagedata.descr + '';
                htmldatadetails += '</div>';
                htmldatadetails += '</div>';
                htmldatadetails += '</div>';
                htmldatadetails += '</div>';

                $('#activeplandetailsData').html(htmldatadetails);
            }
        }    

    }

    function OnErrorfillpackagedetails(content) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }



    /* MY FAVORITE LIST */

    function listjewellerydata(page) {

        showloader();
        var pagename = getpagename();
        var useraction = $('#formevent').val();
        var showmyfavorite = 1;
        var jewellery_per_page = $('#jewellery_per_page').val();
        var nextpage = 0;
        if ($('#listjewelleryData').attr('data-nextpage') > 0) {
            nextpage = $('#listjewelleryData').attr('data-nextpage');
        }
        var formdata = new FormData();
     
        formdata.append("action", "listjewellery");
        formdata.append("nextpage", parseInt(nextpage) + 1);
        formdata.append("perpage", jewellery_per_page);
        formdata.append("showmyfavorite", showmyfavorite);
        var headersdata = {
            'Accept': 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: useraction,
            masterlisting: false
        };
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>jewellery', formdata, headersdata, Onsuccesslistjewellerydata, OnErrorlistjewellerydata)

        function Onsuccesslistjewellerydata(data) {
            hideloader();
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.IsPackageExpire == 1) {
                Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});
            }
            else{
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


                }
            }   


        }

        function OnErrorlistjewellerydata(content) {

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

    $('body').on('change', '#jewellery_per_page', function() {
        $('#listjewelleryData').attr('data-nextpage', 0);
        $("#listjewelleryData").animate({
            scrollTop: 0
        }, "slow");
        listjewellerydata(1);
    });
</script>

</html>