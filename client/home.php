<?php
require_once dirname(__DIR__, 1) . '/config/init.php';

/* -----------------------------
   Existing login / package logic
------------------------------ */
if ($LoginInfo) {
    if ($LoginInfo->getAdlogin() != '' && $LoginInfo->getIsguestuser() == 0) {
        // Allowed
    } else {
?>
        <script>
            window.location = '<?php echo $config->getWeburl(); ?>home';
        </script>
    <?php
        exit;
    }
} else {
    ?>
    <script>
        window.location = '<?php echo $config->getWeburl(); ?>home';
    </script>
<?php
    exit;
}

$CheckUserRights = $DB->checkpackagewiseuserright($LoginInfo->getUid());

if ($CheckUserRights['IsPackageExpire'] == 1) {
?>
    <script>
        Notiflix.Report.Warning(
            '<?php echo $config->getPackageExpiredTitle(); ?>',
            '<?php echo $config->getPackageExpiredMessage(); ?>',
            false,
            function() {
                window.location = '<?php echo $config->getPackageExpiredURL(); ?>';
            }
        );

        $('#preloader').addClass('d-none');
        $('#ctn-preloader').addClass('loaded');
    </script>
<?php
    exit;
}

/* -----------------------------
   Package permissions
------------------------------ */
$canDiamond =
    $DB->getpackagewiseuserright($LoginInfo->getUid(), 1)['attributeval'] == 1 ||
    $DB->getpackagewiseuserright($LoginInfo->getUid(), 6)['attributeval'] == 1;

$canJewellery =
    $DB->getpackagewiseuserright($LoginInfo->getUid(), 2)['attributeval'] == 1 ||
    $DB->getpackagewiseuserright($LoginInfo->getUid(), 7)['attributeval'] == 1;

$canRequest =
    $DB->getpackagewiseuserright($LoginInfo->getUid(), 5)['attributeval'] == 1;

$canChat =
    $DB->getpackagewiseuserright($LoginInfo->getUid(), 4)['attributeval'] == 1;

if (!$canDiamond && !$canJewellery && !$canRequest && !$canChat) {
?>
    <script>
        window.location = '<?php echo $config->getWeburl(); ?>home';
    </script>
<?php
    exit;
}

/* -----------------------------
   Existing dashboard banner
------------------------------ */
$imgpath = $config->getImageurl();

$bannerqry = "
    SELECT
        id,
        typeid,
        CASE
            WHEN(img != '') THEN CONCAT(:imgpath, img)
            ELSE CONCAT(:imgpath, 'images/d-banner.jpg')
        END AS image
    FROM `tblbannersetting`
    WHERE typeid = :typeid
";

$bannerparams = array(
    ':typeid' => 30,
    ':imgpath' => $imgpath,
);

$bannerres = $DB->getmenual($bannerqry, $bannerparams);
$rowchat = !empty($bannerres) ? $bannerres[0] : array(
    'image' => $config->getimageurl() . 'images/d-banner.jpg'
);
?>


<div class="has-sidebar-left tc-dashboard">
    <div class="tc-topbar">
        <div class="tc-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search diamonds, jewellery, or requests..." aria-label="Dashboard search">
        </div>

        <div class="tc-topbar-right">
            <div class="mobile-logo">
                <img class="user_avatar"
                    src="<?php echo $config->getimageurl() ?>images/defaultjewellery.png"
                    alt="<?php echo $LoginInfo->getFullname(); ?>">
            </div>
            <div class="d-flex align-items-center">
                <button class="tc-notification-btn add-screen mr-3" type="button" aria-label="Notifications">
                    <img src="<?php echo $config->getimageurl(); ?>images/notification.svg" alt="Notification">
                    <span class="tc-notification-dot"></span>
                </button>

                <div class="tc-user">
                    <!-- <div class="position-relative">
                        <img class="tc-user-avatar" src="<?php echo $LoginInfo->getProfilepic(); ?>"
                            alt="<?php echo htmlspecialchars($LoginInfo->getFullname(), ENT_QUOTES); ?>">
    
                        <div class="tc-user-copy">
                            <strong>Welcome, <?php echo htmlspecialchars($LoginInfo->getFullname(), ENT_QUOTES); ?></strong>
                            <span>Trust&nbsp;&nbsp;•&nbsp;&nbsp;Quality&nbsp;&nbsp;•&nbsp;&nbsp;Growth</span>
                        </div>
    
                        <i class="fas fa-chevron-down" style="font-size:9px;color:#89949b;"></i>
                    </div> -->
                    <div class="tc-user-dropdown">
                        <button class="tc-user" id="tcUserToggle" type="button" aria-haspopup="true" aria-expanded="false"
                            aria-controls="tcUserMenu">

                            <img class="tc-user-avatar" src="<?php echo $LoginInfo->getProfilepic(); ?>"
                                alt="<?php echo htmlspecialchars($LoginInfo->getFullname(), ENT_QUOTES); ?>">

                            <div class="tc-user-copy">
                                <strong>
                                    Welcome, <?php echo htmlspecialchars($LoginInfo->getFullname(), ENT_QUOTES); ?>
                                </strong>
                                <span>Trust&nbsp;&nbsp;•&nbsp;&nbsp;Quality&nbsp;&nbsp;•&nbsp;&nbsp;Growth</span>
                            </div>

                            <i class="fas fa-chevron-down tc-user-arrow"></i>
                        </button>

                        <!-- Replace these URLs with your existing page URLs -->
                        <div class="tc-user-menu" id="tcUserMenu" hidden>
                            <a href="<?php echo $config->getportalbaseurl(); ?>profile">
                                <i class="fas fa-user"></i>
                                <span>My Profile</span>
                            </a>



                            <a pagename="membershipplan" href="<?php echo $config->getWeburl(); ?>membershipplan">
                                <i class="fas fa-gem"></i>
                                <span>Membership Plan</span>
                            </a>


                            <!-- <a href="changepassword.php">
                                <i class="fas fa-lock"></i>
                                <span>Change Password</span>
                            </a> -->

                            <div class="tc-user-menu-divider"></div>

                            <a href="javascript:void(0)" id="btnlogout" class="tc-user-logout">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="set-btn-rs d-none pl-2">
                    <button class="res-btn-set p-0 border-0 bg-transparent">
                        <i class="fa-solid fa-bars fa"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Existing notification popup -->
        <div class="set-notification">
            <div class="set-deta-tab">
                <ul class="nav set-navnotices nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="allnotice-tab" data-toggle="tab" data-target="#allnotice"
                            type="button" role="tab" aria-controls="allnotice" aria-selected="true">
                            Notices
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="secoundnotics-tab" data-toggle="tab" data-target="#secoundnotics"
                            type="button" role="tab" aria-controls="secoundnotics" aria-selected="false">
                            Check
                        </button>
                    </li>
                </ul>

                <div class="tab-content set-popupdata" id="myTabContent">
                    <div class="tab-pane fade show active" id="allnotice" role="tabpanel"
                        aria-labelledby="allnotice-tab">
                        No new notices.
                    </div>

                    <div class="tab-pane fade" id="secoundnotics" role="tabpanel" aria-labelledby="secoundnotics-tab">
                        You're all caught up.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="tc-content">
        <div class="tc-welcome">
            <div>
                <div class="tc-eyebrow">DASHBOARD</div>
                <h1>Welcome back, <?php echo htmlspecialchars($LoginInfo->getFullname(), ENT_QUOTES, 'UTF-8'); ?></h1>
                <p>Manage your listings, connect with traders and discover new opportunities.</p>
            </div>
            <div class="tc-demo"><span><i class="fas fa-info-circle"></i> Demo data</span><small>Profile completion and
                    recent listings are illustrative examples.</small></div>
        </div>
        <div class="tc-stats-grid">

            <?php if ($canDiamond) { ?>
                <div class="tc-stat-card diamond">
                    <div class="tc-stat-top">
                        <div class="tc-stat-icon">
                            <i class="far fa-gem"></i>
                        </div>

                        <div>
                            <p class="tc-stat-title">My Diamonds</p>
                            <h2 class="tc-stat-value" id="TotalDiamondCount">0</h2>
                        </div>
                    </div>

                    <a class="tc-stat-link" href="<?php echo $config->getportalbaseurl(); ?>diamond?mmd=1">
                        View My Diamonds
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            <?php } ?>

            <?php if ($canJewellery) { ?>
                <div class="tc-stat-card jewellery">
                    <div class="tc-stat-top">
                        <div class="tc-stat-icon">
                            <i class="far fa-circle"></i>
                        </div>

                        <div>
                            <p class="tc-stat-title">My Jewellery</p>
                            <h2 class="tc-stat-value" id="TotalJewelleryCount">0</h2>
                        </div>
                    </div>

                    <a class="tc-stat-link" href="<?php echo $config->getportalbaseurl(); ?>jewellery?mmj=1">
                        View My Jewellery
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            <?php } ?>

            <?php if ($canRequest) { ?>
                <div class="tc-stat-card request">
                    <div class="tc-stat-top">
                        <div class="tc-stat-icon">
                            <i class="far fa-clipboard"></i>
                        </div>

                        <div>
                            <p class="tc-stat-title">Active Requests</p>
                            <h2 class="tc-stat-value" id="TotalRequestCount">0</h2>
                        </div>
                    </div>

                    <a class="tc-stat-link" href="<?php echo $config->getportalbaseurl(); ?>buyrequest?mmb=1">
                        View My Requests
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            <?php } ?>

            <?php if ($canChat) { ?>
                <div class="tc-stat-card message">
                    <div class="tc-stat-top">
                        <div class="tc-stat-icon">
                            <i class="far fa-comment-dots"></i>
                        </div>

                        <div>
                            <p class="tc-stat-title">Unread Messages</p>
                            <h2 class="tc-stat-value" id="TotalChatCount">0</h2>
                        </div>
                    </div>

                    <a class="tc-stat-link" href="<?php echo $config->getportalbaseurl(); ?>chat?mmc=1">
                        View My Chat
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            <?php } ?>

        </div>


        <div class="tc-main-grid">
            <section class="tc-hero">
                <div class="tc-hero-content">
                    <div class="tc-eyebrow">YOUR NEXT TRADE STARTS HERE</div>
                    <h2>Discover natural and lab-grown diamonds,<br class="tc-desktop-break"> showcase jewellery and
                        connect with buyers and sellers worldwide.</h2>
                    <div class="tc-buttons">
                        <?php if ($canDiamond) { ?><a class="tc-primary-btn"
                                href="<?php echo $config->getportalbaseurl(); ?>diamond?mmd=1">Explore Diamonds <i
                                    class="fas fa-arrow-right"></i></a><?php } ?>
                        <?php if ($canJewellery) { ?><a class="tc-outline-btn"
                                href="<?php echo $config->getportalbaseurl(); ?>jewellery?mmj=1">Explore Jewellery <i
                                    class="fas fa-arrow-right"></i></a><?php } ?>
                    </div>
                </div><img class="tc-hero-image"
                    src="data:image/webp;base64,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"
                    alt="Diamond and gold diamond ring">
            </section>
            <section class="tc-panel tc-actions">
                <h3>Quick Actions</h3>
                <p>Get started with the tools you use most.</p>
                <div class="tc-actions-grid">
                    <?php if ($canDiamond) { ?><a class="tc-action"
                            href="<?php echo $config->getportalbaseurl(); ?>diamond?mmd=1"><i
                                class="far fa-gem"></i><span>Add Diamond</span><i
                                class="fas fa-chevron-right"></i></a><?php } ?>
                    <?php if ($canJewellery) { ?><a class="tc-action"
                            href="<?php echo $config->getportalbaseurl(); ?>jewellery?mmj=1"><i
                                class="far fa-circle"></i><span>Add Jewellery</span><i
                                class="fas fa-chevron-right"></i></a><?php } ?>
                    <?php if ($canRequest) { ?><a class="tc-action"
                            href="<?php echo $config->getportalbaseurl(); ?>buyrequest?mmb=1"><i
                                class="far fa-clipboard"></i><span>Post Buy Request</span><i
                                class="fas fa-chevron-right"></i></a><?php } ?>
                    <?php if ($canChat) { ?><a class="tc-action"
                            href="<?php echo $config->getportalbaseurl(); ?>chat?mmc=1"><i
                                class="far fa-comment-dots"></i><span>Open Chat</span><i
                                class="fas fa-chevron-right"></i></a><?php } ?>
                </div>
            </section>
        </div>
        <div class="tc-bottom-grid">
            <section class="tc-panel">
                <h3>Request Overview</h3>
                <p>Manage and track your buying and selling requests.</p>
                <div class="tc-request-tabs" role="tablist" aria-label="Request type"><button type="button" role="tab"
                        id="tc-buying-tab" aria-selected="true" aria-controls="tc-request-panel"
                        class="tc-request-tab active" data-request-type="buying">Buying Requests</button><button
                        type="button" role="tab" id="tc-selling-tab" aria-selected="false"
                        aria-controls="tc-request-panel" class="tc-request-tab" data-request-type="selling">Selling
                        Requests</button></div>
                <div class="tc-empty" id="tc-request-panel" role="tabpanel" aria-live="polite"><span
                        class="tc-empty-icon"><i class="far fa-clipboard"></i></span>
                    <h4 id="tc-request-heading">No active requests yet</h4>
                    <p id="tc-request-description">Post a buying requirement or respond to enquiries from your listings.
                    </p><?php if ($canRequest) { ?><a id="tc-request-action" class="tc-primary-btn"
                            href="<?php echo $config->getportalbaseurl(); ?>buyrequest?mmb=1">Create Buy
                            Request</a><?php } ?>
                </div>
            </section>
            <section class="tc-panel">
                <h3>Account Overview</h3>
                <p>Complete your profile to build trust and reach more trading partners.</p>
                <div class="tc-account">
                    <div>
                        <div class="tc-progress" aria-label="Demo profile completion: 75 percent"><strong>75%</strong>
                        </div><span class="tc-progress-label">Profile Completion</span>
                    </div>
                    <div class="tc-checklist">
                        <p><i class="fas fa-check-circle"></i> Business details added</p>
                        <p><i class="fas fa-check-circle"></i> Contact details added</p>
                        <p><i class="far fa-circle"></i> Complete company profile</p><a class="tc-primary-btn"
                            href="<?php echo $config->getportalbaseurl(); ?>profile">Update Profile <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </section>
            <section class="tc-panel">
                <div class="tc-panel-head mb-2">
                    <h3>Recent Listings</h3><?php if ($canDiamond || $canJewellery) { ?><a href="<?php echo $config->getportalbaseurl();
                                                                                                    echo $canDiamond ? 'diamond?mmd=1' : 'jewellery?mmj=1'; ?>">View
                            All Listings <i class="fas fa-arrow-right"></i></a><?php } ?>
                </div>
                <p>Your latest diamonds and jewellery listings.</p>
                <div class="tc-listings">
                    <?php if ($canDiamond) { ?>
                        <article class="tc-listing">
                            <div class="tc-listing-photo"><img
                                    src="data:image/webp;base64,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"
                                    alt="Round Brilliant Diamond"><span>Active</span><i class="far fa-heart"
                                    aria-hidden="true"></i></div>
                            <div class="tc-listing-copy">
                                <h4>Round Brilliant Diamond</h4>
                                <p>1.02 ct | D | VS1 | Excellent</p><a
                                    href="<?php echo $config->getportalbaseurl(); ?>diamond?mmd=1">View listing <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </article><?php } ?>
                    <?php if ($canJewellery) { ?>
                        <article class="tc-listing">
                            <div class="tc-listing-photo"><img
                                    src="data:image/webp;base64,UklGRsIQAABXRUJQVlA4ILYQAACQQwCdASq6AFEAPjEUiUMiISEUCq44IAMEs4BoRELWJQad1P2O9J/ZD2xZwv9cP2A95bIAPLU/Zn4kK0j4S/jPzT9u/J7+x/s30kehf+B6C/yj7o/k/7r+2/sp/lfD/3/fxf27fIF+O/yb/Bfl7/cfcS9z/3v9m8mHUP8P/tPUO9Vvmv+b/vH7vf4X0i/6b+Ufrd7tfWn/XfmB9AP8r/of+w/NL4E/wH+V8Uz7j/j/+P7gH8r/rP/B/vv5SfSV/Mf9r/QfmB7cfzr/Cf9j/MfAN/K/6t/vP8B/mP2m+dn2Ufu/7Qv7hm+DAgywBF7/rkMTcbGMYxht/uh6RKbS/3hqVvKUXfrq2ukHPqM5sz9YVjEwmXu2koE2lhpawTtNtwyEfmWh/bAZReDpTdfMeUkytivR1WoFaJqmpf5+lSBr8qMEtaf+6wtb5koBbphv7l6sRKF11DHa4l6tehQIYwOsJrFZTHNrjfHN/F2/0irKaZwPOchCiyCT1S3pMaHkGzKEqYCsi5YlPtr1AMgX1kZpO6dUoa9vmD0Ui3snGpLpKKERj3CVIw7/V2nxS1U3MdY9bi0oIU9UELHunmr5lnx7+tTBvDTV86YEkDHAgp28hO9LIYA9C1qEkPdRd6j9HZ6jRqXPH2IMVZwf86CUYjxrulTFVV6fd2r9veW5dnA1IULCilXVo/9GiFHKuNG5q9sthbguvprla1+bCY0msrRoLTTTfAAA/v/49xwg/7takXrz8JlDgQHOe1/N62V8xLx2KF8pOCf4afhtz4frKr74UdQEWR5VdDtB4bGCmu7dOtaxPzx3HxjFfdAuuObbPz//k+201Lts8Qn/QsHjwsksJYhToWH4yPRwy2s3GVnNUMKQ+nNPaglSBbp686on/nQZEXzEhtEJrJ2ZfbMgEA/Q1tIuwOBb1Oos7fyPVIE8fdfwPl/VqyRK/JPcIP/a/K3uP9+tQU+BiwEi/6DrvbHHxM6B44O9aCJvxNTS0EI6HrDWi8IhYE4IRkFcOC9qReh/xuenDJFeOa6e6LGCikL8+iFPKFKANxZqipPV380OYgz8ZuQzDeERdhTKJ5AxFRR8eHN80XyE0T7XYVnWnptcC6thpwPS4M6vLKRyU5esTQI3eaqCfau81aoZbT2FXdRUVzGcg+0v1UO8r270/wsQQiA6LnxqLyH/rT2Y73H4V+KUyKtOt8d0y/jvoTub+GHHkcikbWtFPcFvauYoon2c9QRKJ/FjpsRSlXje8MSf2VtrjVQ4FtNDnRZGItDC/Xvn2ionQ7JZ7oy0IZBZV50BxbrWeztbMtqKMFKuRzYb68Js3u0fPV1imgghbKvzN45n+32vb/SUf/J5EC/1c+PpNuTgxIQGZX/MMu8/3PAjUMf90BE54vGr5ecGKsPBm5+wlUT0LibybQWq2THEVWpV0mTNOyuhCSlcvgIq8fT1XilOgzyw63MwFO2pKt/VzTxMyoAL4nTax1OT1LN3UnCAlJ18WEVTZ2V3xhGHgxfW/t9QLaO4hnq4Imqqr5+zmzzGnYfOKZuwdSeSjKc3T9HzsrDF4+t8rMSGG0KkKSFjuFRTni+EFXVrhqtkFwrVK6yIHCiaycR8mLPLPUH/CDAhaIojkHQhUojZPb+yjzIyRf1hvyXOxq2SQAHSNXuvUYduac86HGxQynROa80rQdjCzsGLMo5yQ6UbwxcDdqJROSG8/TFoR9DawC2nEuttRE/AHYcE9h9uk9cuH7QEvexeYGoTJX318piHwnzJyqiyoGNMDg7elQghX90fFy/A1PagcoJ2tv8UT6CTrdBT9gcShxrjkveyjx7N21AG/yZWJZnqgXOBpaFjQTe0EGlOKgGoOG/93nXjcQAazTR5da+2Lx6PfHTRwES5ePFsLTAp4DYUwtSPw2TOUpoGCfSwlcdqe3pY54fu2G+Qjn6yybl1RRYPatMuoovBBePftorTfNq0B02tlIOHtC4urosw09iI9UYoL7pLKYqS1YH/oAwwQgzDprsF9d8frUwCBnd9MQluSnBZX+v65cKHy/Zt4a5qNbg6+W8V6wJBFe30/Y8iReqX7kLqAXTmSxTo3hipk6p0tnPK8gdT26AG9LWX7fIR+oX7pJNc6kHWoUwqRwvq5UoQZnT0I8l7ML32LSRlKy0LCLoX6N3YQ5FYFgCtp0pNv0lgwuJH3uzInW7nJAvyLUt5jI9IHa5W+Qyn4rwFJRyd1YhMn4qxBaiTCpnarS/uYjZ2BIRrp/AazfnBrvuUcoJNQwH1/LyeL96RxQ2apmq56KuNjt3q62OafIZ+O3lXSvzkd3I9Uyt5u9P568l6Wkr7CMk6kNpy4J1Ujs8Ym4XYKLHeTG1IKl/nV35w3NgznEU30Q+kBYD3V2yqI01eYKPJaiwmmji17JI5p8bsO9ascDFFbfoiJ7ztXuRL38w3ogNTJahbqf+YghO1Lhr5XnSFg7v99gsLpe6/FZitKNzTLdPEmjCFuJHJoxy8oCWXI0vod1sE8yasC67FdSjNTQb03Tg8EQ2ciKmoaJw/7GJRzK2im6wZnt1CLC2P9rlmfCKQ4VEc8XSqyYnpPzr8dvO50mCes2C/iou80L442oJ8nCjxthYTzEfOsstNtxZQ6pCQOh9q48D57X2IDcHmte2twIdmlODZyB6KJ3RBmIPJ4zczAQCjIrrII9LtbrAkMFALUoROkMIvkGs+/St7OvSB80eA7AEA5uhipY3fO8ZNeLUmUdnZTijlVHXFpK7+eJBEgsBY6DGuENE3cE/q2WbByE5sMqOm/esbExdZq4SOKYwk4XEHsqYWNo8MFubtKcXNjkdDGUEYe4zs0YCvEgYWXCcjnvfIZO9Nsm3QRrILPrpdnHGmaQyxKIz3dW2rqXpqlHECd5P1wfs41+NHadOlGIgQViF0C9mHDIMrH454ZGbpGxrurjbwMDME0ohr43Ps+9aZDncw9la5wOBmPjFKMeytPP0cA89Xx5UKGunaPCyj6CEmTgUZjmHHcpH3XN56a6O2bwqJ/R+2XlDSoo3iDmlowQNjtk1QopKtdw2polZbxz+1zPImvpp54hl8PXK7usUCfn0tt1aXGB2dPsljzoVesySPRVVkrpaSc0rS4eDgYON4Z0c39LWY0ZRPpB8D6MDom5okqe1W/phpioV1aO92xDircnQF0nIdltyOdwjAWdXCRSdKgM+WhRtTxQQhoP8MEYgjnTZJy0ktKnBKNtHG+sKTcNesJKTtk8LQ3WQfguTXvOyw4Qk8O0zzhWZRbr9lwYbWRckoPwOQhJc7lcKGeYKUfJLLRqriNA3dKfyfTWm5uF6Ye7N3ZT1DAoVZ3oYR5Y85yi7ZeI1ZnjnVzUPjp3QHgfXFkoYfkq85vIMyB4AKYJyTKuSgxb2OZmtW9JrPhPxXx4IgMlYRWG5MbjXQGTJeIWX1+nLreMAv3I5u5KuAa43NEWLWgxjsehSWH4gp3GbFWRPVVliZ9W1duMHjaQpgHb0cAdYLGJwAUxjfqadzH+XsjiZVvoZ/Q1UG2WcmnIxOqkkhbKZcJuuRQYTZspOpY4dCeNGSi2Bwe/1ApSGGhYZgmvLjiWQ1LiqjxtIKOamLEHV2ntM6kdJwX0q41DYg+SgFRqffLhtefBOFFh6ZlKDM8vv5XgR4t2yTPCaRY5c62n+sjxWUG/4SdReDix/kzY6Tt3YJ7rHNOZaY9KHlhZquzVfWSMJfByCcqBabTgFSx62K17pZFOWdfwscdd0PanHYvQSnNmHK29AKHOLQuUnksrFclUEoukryANHHFocvfHUXbZrUZtGDhvkOSnGakuugx7hrghRm2dhFyDJawqb4fFA6c7DGAyThGC9px6Ex0ElQPKJheHuaKv+MMKinpgsh+cKflzfxWcJxtmNVKcTu9WPau0yij6nOootq6a470zaFUyW10Azi4kfWyQn+QaOXQTfNzbOCnfyGBnWXliMfbyjb5fJTVnW+f3iR1lG7ln6/YM1UEcnQfqNmOMieMEUBjpvPm8L6kZ6ikmKv9U7QDb+Ow3Tc26zmAPp6/YV3P4igp91WZFi5SZTbU9ozH3fvQ6CIjTXXs6qsmIa1bjn6l00xE9NQf4DMCMBtJ8q6yFBWOzMdQB9HdjvZ8/wl7cqzFX7iSOXkad8+pJbeBWXqpScCCx+ta7KzUcGwfgiKNrUdnuAb25/k1UiWpX9t9ECJf9wYz6ogm8LjWht3yLraMfUhpqhKgzwnHXB7Wx3expjRfooL417ZUnsvJhTRxnXKLOQ3Bnxj0G44Mwf6TwCqTjQEtyFbkw62gH6A+RevBB4ixpYJMYfh4qjQGTKwwBakcVSudLhBio0PnpC0+UZWhpMuNlHSGRl9XPJyY4Yh0tI1MkppsKVIOZOGZDCkuQ55DKwOVno3OeDLXYBOiCe8tD7Uu6aUMTh0PVF0Qwg37Szs103YObmoepw90a5X35tYUC/A/t0sdn6x8Fp8acOJviFy0UnAixIsxLDNw5aCkbEwLoSK5bYzIrVad/Yj5vkMCnWgFpEO+V/WNBcx7vopl1H44rgFIzlvnPlPIPvDOK0DsMNNdSStoD/3q1AatgC5Y3obnTq8K0OngNcJDavKxeJp+Af9xFIxcCvX1nqAzTGCaiHp8yxhyhJ0jSnDtNylmuDUfXYfuwplQ62JHkNNnypyv2rhOzrpImbS3C9P57YwEGhVeDaQ5jBs+kz/DIWiVl1yDSX5Pqt8ANCw/sEVIYE9xfHVo8P3KSfMYyysLCVCiG9Qzc0Ywgh0e9bxYEPJT9msw0WilbVLohiVDGr8dd6tkTbVhyJJOCeCr/gnKqRMRaoaMM5BX8C7QkDsqVQW2pCkLQsVqzkufubRrm6wn9tB6c5+kJvtAsSZ+ho16rvMnP5li4dkbQo/+BMSllwwp298fQjlOJ40pKbruSAGIkMBVf3Z85U+Odzo7qi2OAW/nfzlZzvAg6UOJoNYPaT3SG6j6EQsXXZthpfuR6ogIB7L7/xZpWrSAGJsL0tq18OrszI19cFOJ3/9gI0Z6zOIcHbbM6NxKvtMGnoSPSaPjpSDhvG84ITQ27Kt8gTdR3r5fOl6PlW22YA/t5ZD/8FRPec23fL0aevw4Mjo7Pk4Ak7XbCkc2k0kP53z064SZrAt8fGHz3L3oIVeZhkOzTJASBzHtvGwt0ANI+JJ0ewIY+S7JSYCurbCaLaMUIpQjNj5EHvhOLJomLKN90d+0PkPx02rUyq0Us0TlX+Dm+HER5SXtdJ97nukncYCMpzoN++tnFw7w+QnWQuj4kEQR5+fsYF4xywbL3Z17DosMBKJEJXR/jXrhKqFsEAPuw9kEtI31tAUjbZv4JN/Mpr/tx8se8lyCFKU6c417NCIhZz1hR6Z/DoaYDXoz9qBtKXGFI3Q3hOmBa2aSZh5G+Myl35A13IS9NHJsaOnY8qGm/5um8LTB0QO3tzAyVNA18coqIPhoEAjkEe38EmWjnM2X2+qWMlFtxMuUMtGnOjYh3UELG0CVWBvLdZ5w8kEpDtREOtRkHb1c+JhJ+2yvfl/5/I3EAj9clOdVb0UEyHSc0/oJ1WrW+TSGiaoOoEUJDbSVYK0z37CKmsuTfHWKR5qcj30OU9ifCIUalPw+GFSj6WYACufZwJ9QJG53zShCyHdgc4edz2Lk9jlXIkHmHMsfjMb31XExzwyB7duSP+dOpDxEnuIrl3Wm34AAAA="
                                    alt="Diamond Tennis Bracelet"><span>Active</span><i class="far fa-heart"
                                    aria-hidden="true"></i></div>
                            <div class="tc-listing-copy">
                                <h4>Diamond Tennis Bracelet</h4>
                                <p>18K White Gold | 5.20 ct | Round</p><a
                                    href="<?php echo $config->getportalbaseurl(); ?>jewellery?mmj=1">View listing <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </article><?php } ?>
                    <?php if ($canJewellery) { ?>
                        <article class="tc-listing">
                            <div class="tc-listing-photo"><img
                                    src="data:image/webp;base64,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"
                                    alt="Halo Diamond Ring"><span>Active</span><i class="far fa-heart"
                                    aria-hidden="true"></i></div>
                            <div class="tc-listing-copy">
                                <h4>Halo Diamond Ring</h4>
                                <p>18K White Gold | 1.50 ct | F | VVS2</p><a
                                    href="<?php echo $config->getportalbaseurl(); ?>jewellery?mmj=1">View listing <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </article><?php } ?>
                </div>
            </section>
            <section class="tc-panel">
                <div class="tc-panel-head">
                    <h3>Messages &amp; Activity</h3><?php if ($canChat) { ?><a
                            href="<?php echo $config->getportalbaseurl(); ?>chat?mmc=1">View All</a><?php } ?>
                </div>
                <p>Your latest messages and platform activity.</p>
                <div class="tc-empty"><span class="tc-empty-icon"><i class="far fa-comment-dots"></i></span>
                    <h4 id="tc-message-heading">You are all caught up</h4>
                    <p id="tc-message-description">New enquiries and unread messages will appear here.</p>
                    <?php if ($canChat) { ?><a class="tc-text-link"
                            href="<?php echo $config->getportalbaseurl(); ?>chat?mmc=1">View Chat <i
                                class="fas fa-arrow-right"></i></a><?php } ?>
                </div>
            </section>
        </div>
    </main>
</div>
<script>
    setTimeout(function() {
        $('#preloader').delay(1000).queue(function() {
            $('#preloader').addClass('d-none');
        });

        $('#ctn-preloader').addClass('loaded');
    }, 500);

    $(document).ready(function() {
        listdashboardcountdata();

        $('.tc-request-tab').on('click', function() {
            $('.tc-request-tab').removeClass('active').attr('aria-selected', 'false');
            $(this).addClass('active').attr('aria-selected', 'true');
            var selling = $(this).data('request-type') === 'selling';
            $('#tc-request-heading').text(selling ? 'No selling enquiries to display' : 'No active requests yet');
            $('#tc-request-description').text(selling ? 'Enquiries from buyers about your listings can be reviewed in Requests.' : 'Post a buying requirement or respond to enquiries from your listings.');
            $('#tc-request-action').text(selling ? 'View Requests' : 'Create Buy Request');
        });
        $('.tc-search input').on('keydown', function(event) {
            if (event.key === 'Enter' && this.value.trim()) {
                event.preventDefault();
                window.location = '<?php echo $config->getportalbaseurl(); ?>diamond?mmd=1&search=' + encodeURIComponent(this.value.trim());
            }
        });
    });

    $(document).on('click', '.add-screen', function(e) {
        e.stopPropagation();
        $('.set-notification').toggleClass('add-screen-popup');
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.set-notification, .add-screen').length) {
            $('.set-notification').removeClass('add-screen-popup');
        }
    });

    function listdashboardcountdata() {
        var pagename = getpagename();

        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false,
            responsetype: 'JSON'
        };

        var formdata = new FormData();

        formdata.append("action", "listdashboardcountdata");
        formdata.append("typeid", 30);

        ajaxrequest(
            "POST",
            '<?php echo $config->getEndpointurl(); ?>home',
            formdata,
            headersdata,
            Onsuccesslistdashboardcountdata,
            OnErrorlistdashboardcountdata
        );

        function Onsuccesslistdashboardcountdata(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);

            if (resultdata.IsPackageExpire == 1) {
                Notiflix.Report.Warning(
                    resultdata.ExpiryTitle,
                    resultdata.message,
                    false,
                    function() {
                        window.location = resultdata.ExpiryURL;
                    }
                );
            } else {
                $('#TotalDiamondCount').html(resultdata.totaldiamond || 0);
                $('#TotalJewelleryCount').html(resultdata.totaljewellery || 0);
                $('#TotalRequestCount').html(resultdata.totalbuyrequestlist || 0);
                $('#TotalChatCount').html(resultdata.totalunreadchatlist || 0);

                var diamondCount = parseInt(resultdata.totaldiamond || 0, 10);
                var jewelleryCount = parseInt(resultdata.totaljewellery || 0, 10);

                $('#TotalPortfolioItems').text(diamondCount + jewelleryCount);
                if (parseInt(resultdata.totalbuyrequestlist || 0, 10) > 0) {
                    $('#tc-request-heading').text('Your buying requests are ready to review');
                    $('#tc-request-description').text('Open Requests to manage your current requirements.');
                }
                if (parseInt(resultdata.totalunreadchatlist || 0, 10) > 0) {
                    $('#tc-message-heading').text('You have unread messages');
                    $('#tc-message-description').text('Open Chat to read and reply to your latest enquiries.');
                }
            }
        }

        function OnErrorlistdashboardcountdata(content) {
            console.log('Dashboard count request failed.', content);
        }
    }


    (function() {
        const wrapper = document.querySelector('.tc-user-dropdown');
        if (!wrapper) return;

        const toggle = wrapper.querySelector('#tcUserToggle');
        const menu = wrapper.querySelector('#tcUserMenu');

        function setOpen(open) {
            toggle.setAttribute('aria-expanded', String(open));
            menu.hidden = !open;
        }

        toggle.addEventListener('click', function() {
            setOpen(toggle.getAttribute('aria-expanded') !== 'true');
        });

        document.addEventListener('click', function(event) {
            if (!wrapper.contains(event.target)) {
                setOpen(false);
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !menu.hidden) {
                setOpen(false);
                toggle.focus();
            }
        });

        wrapper.addEventListener('focusout', function(event) {
            if (!wrapper.contains(event.relatedTarget)) {
                setOpen(false);
            }
        });
    })();
</script>