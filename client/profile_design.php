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
                    <div class="proimbgs">
                        <div class="row">
                            <div class="setimagepf">
                                <li class="text-center">
                                    <div class="user-img-block">
                                        <span class="user-profile-img userprofilebg"><a href="http://192.168.1.2/savanigems/savanigems-portal/assets/img/dummy/proimg.jpg" title="" target="_blank">
                                            <img class="#" id="userprofileimg" src="http://192.168.1.2/savanigems/savanigems-portal/assets/img/dummy/proimg.jpg" alt="user" title=""></a>
                                        </span>
                                        <div class="proch prov">
                                            <label for="userprofileimg" onclick="importData()" class="user-pic"><i class="user-img fal fa-user-edit"></i></label>
                                        </div>
                                        <div class="my-profile profileimgDiv">
                                            <!-- <h4 class="unamesetpn">Demo Demo</h4> -->
                                        </div>
                                    </div>
                                </li>
                            </div>
                            <div class="col-sm-8 col-md-6 setdespf">
                                <div class="saidpf">
                                    <h5>Savani Id : 230222</h5>
                                </div>
                                <div class="sanamep">
                                    <h4>Trade CVD Ltd. </h4>
                                </div>
                                <div class="valisavpf">
                                    <p>Jeweler Account | Membership : Valid Until 08-22-2060</p>
                                </div>
                                <div class="titsavpf">
                                    Diamond Manufacturer/cutter | member For 15 years
                                </div>
                            </div>
                            <!-- <div class="setlogoutbtn">
                                <div class="sidemenu-img"><img src="http://192.168.1.2/savanigems/assets/images/sidemenu/logout.svg" alt="logout" title="logout"></div>
                            </div> -->
                        </div>
                    </div>
                    <div class="row justify-content-center setmpo">
                        <div class="col-12 col-md-12 m-auto pt-3">
                            <ul class="setnavprof nav responsive-tab nav-material nav-material-white pt-2" id="buy-request-tab">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-Profile-tab" data-toggle="tab" href="#nav-Profile" role="tab" aria-controls="nav-Profile" aria-selected="true">Basic Details</a>
                                        <a class="nav-item nav-link" id="nav-Changeinformaton-tab" data-toggle="tab" href="#nav-Changeinformaton" role="tab" aria-controls="nav-Changeinformaton" aria-selected="false">Company informaton</a>
                                        <a class="nav-item nav-link" id="nav-Address-tab" data-toggle="tab" href="#nav-Address" role="tab" aria-controls="nav-Address" aria-selected="false">Address</a>
                                        <a class="nav-item nav-link" id="nav-Wishlist-tab" data-toggle="tab" href="#nav-Wishlist" role="tab" aria-controls="nav-Wishlist" aria-selected="true">Favourite list</a>
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
                                    <form action="" method="">
                                        <div class="row setrpo">
                                            <div class="col-md-10 col-lg-9 col-xl-9 col-12 unamesetp">
                                                <div class="row">
                                                   <div class="col-md-6 setpupi">
                                                        <label for="fname">First Name  </label>
                                                        <input type="text" class="prosetad" placeholder="Enter First Name" name="fname">    
                                                   </div> 
                                                   <div class="col-md-6 setpupi">
                                                        <label for="last">Last Name  </label>
                                                        <input type="text" class="prosetad" placeholder="Enter last Name" name="last">
                                                   </div>
                                                   <div class="col-md-6 setpupi">
                                                        <label for="email">Email </label>
                                                        <input type="text" class="prosetad" placeholder="Demo@gmail.com" name="email">    
                                                   </div> 
                                                   <div class="col-md-6 setpupi">
                                                        <label for="num">Mobile Number </label>
                                                        <input type="text" class="prosetad" placeholder="Enter number" name="num">
                                                   </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="col-md-12 btnsetpr ">
                                                <button type="button" class="btn">Update Your Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-Changepassword" role="tabpanel" aria-labelledby="nav-Changepassword-tab">
                            <div class="col-12 col-md-12 setcoloall passwordpfse unamesetp">
                                <div class="row setrpsf">
                                    <div class="col-md-5 col-lg-5 col-xl-4 setpfo">
                                        <div class="col-md-12 setmpr">
                                            <label for="oldpass">Old password  </label>
                                            <input type="text" class="prosetad" placeholder="Enter your Old password" name="oldpass">    
                                        </div> 
                                        <div class="col-md-12 setmpr">
                                            <label for="pass">New password </label>
                                            <input type="text" class="prosetad" placeholder="Enter Your New password" name="pass">
                                        </div>
                                        <div class="col-md-12 setmpr">
                                            <label for="pass">Confirm  New password </label>
                                            <input type="text" class="prosetad" placeholder="Confirm  your New password" name="pass">    
                                        </div>
                                    </div> 
                                    <div class="col-md-5 col-lg-5 col-xl-4 setpaer">
                                        <div class="card">
                                            <div class="card-body">
                                                <p>
                                                    For your password to be up to the latest
                                                    security standards, please make sure to
                                                    consider the following aspects when
                                                    creating your password
                                                </p>
                                                <p>
                                                    The password should consist of a
                                                    minimum of 8 characters
                                                </p>
                                                <p>
                                                    if should include capital and lower case
                                                    letters, as well as at least one special
                                                    character
                                                </p>
                                                <p>
                                                    Please choose a random combination of
                                                    the before-mentioned characters
                                                </p>
                                                <P>
                                                    Please make sure not to use this
                                                    password with other providers
                                                </P>
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
                                            <button type="button" class="btn">update password</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-Address" role="tabpanel" aria-labelledby="nav-Address-tab">
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
                        </div>
                        <div class="tab-pane fade" id="nav-Wishlist" role="tabpanel" aria-labelledby="nav-Wishlist-tab">
                            <div class="col-12 col-md-12 setcoloall">
                                <div class="row setcompfav">
                                    <div class="col-md-10">
                                        <div class="grid-products grid--view-items prd-grid productsetje">
                                            <div class="all-product-item">
                                                <div class="item">
                                                    <div class="product-image">
                                                        <div class="setclosebtnpo">
                                                            <i class="fa fa-times" aria-hidden="true"></i>  
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
                                                        <div class="setclosebtnpo">
                                                            <i class="fa fa-times" aria-hidden="true"></i>  
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
                                                        <div class="setclosebtnpo">
                                                            <i class="fa fa-times" aria-hidden="true"></i>  
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
                                                        <div class="setclosebtnpo">
                                                            <i class="fa fa-times" aria-hidden="true"></i>  
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
                                                        <div class="setclosebtnpo">
                                                            <i class="fa fa-times" aria-hidden="true"></i>  
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-Changeinformaton" role="tabpanel" aria-labelledby="nav-Changeinformaton-tab">
                            <div class="col-12 col-md-12 setcoloall setcompr">
                                <div class="row setcomp">
                                    <div class="col-12 col-md-10 col-lg-9 col-xl-9">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="cname">Company Name</label>
                                                        <input type="text" class="prosetad" placeholder="Enter Company Name" name="cname">    
                                                    </div> 
                                                    <div class="col-md-6 setmtpr">
                                                        <label for="bname">Type Of Business</label>
                                                        <!-- <input type="text" class="prosetad" placeholder="Enter your Business Name" name="bname">   -->
                                                            <select aria-labelledby="ppcto" name="ppcto" class="form-control">
                                                                <option value="0">Select Business Type</option>
                                                                <option value="1">Poor</option>
                                                                <option value="2">Fair</option>
                                                                <option value="3">Good</option>
                                                                <option value="4">Very Good</option>
                                                                <option value="5">Excellent</option>
                                                                <option value="6">Ideal</option>
                                                            </select>  
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-3 col-lg-3 col-xl-2">
                                                        <label for="num">Phone Code </label>
                                                            <select aria-labelledby="ppcto" name="ppcto" class="form-control">
                                                                <option value="0">+91 (In)</option>
                                                                <option value="1">Poor</option>
                                                                <option value="2">Fair</option>
                                                                <option value="3">Good</option>
                                                                <option value="4">Very Good</option>
                                                                <option value="5">Excellent</option>
                                                                <option value="6">Ideal</option>
                                                            </select>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-xl-4 setmtpr">
                                                        <label for="bnum">Business Phone  </label>
                                                        <input type="text" class="prosetad" placeholder="Business number" name="bnum"> 
                                                    </div>
                                                    <div class="col-md-5 col-lg-5 col-xl-6 setmtpr">
                                                        <label for="Website">Website </label>
                                                        <input type="text" class="prosetad" placeholder="enter Website" name="Website"> 
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="cn">Company No</label>
                                                        <input type="text" class="prosetad" placeholder="Enter Company No" name="cn"> 
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
                                            <button type="button" class="btn">update information</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-plan" role="tabpanel" aria-labelledby="nav-plan-tab">
                            <div class="row setrpal">
                                <div class="col-md-10">
                                    <div class="setplandepf">
                                        <div class="titplpf">
                                            Your plan
                                        </div><br>
                                        <div class="expriredepr">
                                            <p>
                                                maximum 48 weeks are recommended. The More The Better :)
                                            </p>
                                        </div><br><br>
                                        <div class="row">
                                            <div class="col-md-6 text-right">
                                                <div class="byplpf">
                                                    <h3>03-11-2022</h3>
                                                    <p>Join Date</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-left">
                                                <div class="byplpf">
                                                    <h3>25-05-2035  </h3>
                                                    <p>expire Date</p>
                                                </div>
                                            </div>
                                        </div><br><br>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="col-md-12 btnsetpfpl text-center">
                                                    <button type="button" data-toggle="modal" data-target="#curplan" class="btn">current plan</button>
                                                    <button type="button" class="btn">update plan</button>
                                                </div>

                                                    
                                            </div>
                                        </div>
                                    </div>                                    
                                    <br><br><br><br><br><br>
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
</script>
</html>