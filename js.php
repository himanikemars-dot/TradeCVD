<!-- JS
    ============================================ -->

<!-- Modernizer JS -->
<!-- <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script> -->

<!-- jQuery JS -->
<?php
?>
<script src="<?php echo $config->getCdnurl(); ?>assets/js/dependencyhandler.js"></script>
<script src="<?php echo $config->getCdnurl(); ?>assets/js/vendor/jquery.min.js"></script>
<script src="<?php echo $config->getCdnurl(); ?>assets/js/vendor/bootstrap.min.js"></script>
<script src="<?php echo $config->getCdnurl(); ?>assets/js/vendor/popper.min.js"></script>

<script src="<?php echo $config->getCdnurl(); ?>assets/plugin/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php echo $config->getCdnurl(); ?>assets/plugin/wow/wow.js"></script>

<!-- Light gallery JS -->
<script src="<?php echo $config->getCdnurl(); ?>assets/js/plugins/lightgallery.min.js"></script>

<!-- Counter up JS -->
<script src="<?php echo $config->getCdnurl(); ?>assets/js/plugins/counterup.min.js"></script>

<!-- Isotope JS -->
<script src="<?php echo $config->getCdnurl(); ?>assets/js/plugins/isotope.min.js"></script>

<script src="<?php echo $config->getCdnurl(); ?>assets/js/464503.js"></script>



<!-- Main JS -->



<script src="<?php echo $config->getCdnurl(); ?>assets/js/main.js"></script>


<script src="<?php echo $config->getCdnurl(); ?>assets/plugin/toastr/toastr.min.js"></script>

<script src="<?php echo $config->getCdnurl(); ?>assets/js/IISMethods.js"></script>
<script src="<?php echo $config->getCdnurl(); ?>assets/plugin/swiper-8.0.6/swiper-bundle.min.js"></script>
<script src="<?php echo $config->getCdnurl(); ?>assets/js/select2.min.js"></script>
<script src="<?php echo $config->getCdnurl(); ?>assets/js/validate.js"></script>
<script src="<?php echo $config->getCdnurl(); ?>assets/js/notiflix-aio-2.7.0.min.js"></script>
<!-- <script src="https://apis.google.com/js/api:client.js"></script> -->
<!-- <script src="<?php echo $config->getCdnurl(); ?>assets/js/bootstrap-select.min.js"></script> -->

<script>
    var endpointurl = '<?php echo $config->getEndpointurl() ?>';
</script>
<script>
    var dirpath = '<?php echo $config->getDirpath() ?>';
</script>
<script>
    var page404url = '<?php echo $config->getPage404url() ?>';
</script>
<script>
    var Imageurl = '<?php echo $config->getImageurl() ?>';
</script>
<script>
    $(document).ready(function() {

        var url = window.location.href;
        var homeurl = '<?php echo $config->getCdnurl(); ?>';
        if(homeurl==url)
        {
            window.location = '<?php echo $config->getWeburl(); ?>home';
        }

        $(".header-navigation nav>ul>li").removeClass("active");
        $(".header-navigation nav>ul>li.lihome").addClass("active");
        $(".show-more-filters").click(function() {
            $(this).parent().find(".filter-container").toggleClass("show-more-container");
            $(this).toggleClass("show-more-open");
        });
        $(".show-more-link").click(function() {
            $(this).toggleClass("show-more-open");
        });
        $(".shape-group input, .color-group input").change(function() {
            var shapeItem = $('.shape-group input:checkbox:checked');
            var colorItem = $('.color-group input:checkbox:checked');
            if (shapeItem.length > 0 && colorItem.length > 0) {
                $("#free-search-container .btn-primary.send-btn").attr("disabled", false);
            } else {
                $("#free-search-container .btn-primary.send-btn").attr("disabled", true);
            }
        });
        /* $('.form-btns input[type="submit"],.form-btns button[type="submit"').click(function() {
            event.preventDefault();
            $(".loader").css("display", "block");
            var model = PickData();
            if ($(window).width() > 767) {
                LoadData(model);
            } else {
                LoadDataMobile(model);
            }
        }); */
    });

    function SetMobileItemsCount(groupSelector, selector) {
        if ($(selector, groupSelector).length) {
            var count = 0;
            $(selector, groupSelector).each(function() {
                if ($(this)[0].offsetTop > 0) {
                    count++;
                }
            });
        }
    };



    function LoadData(model) {
        $("body").addClass("show-results");
        $("#wrapper").bind("mousewheel", function() {
            return false;
        });

        processing = false;
        var pageNumber = $("#free-search-container").data("pageNumber");
        alert(pageNumber);
        if (pageNumber == 1) {

            $("#free-search-container,.free-search-page h1.animated-title, .free-search-page h3.animated-title, .free-search-page .title-section .container").css("display", "none");
            /* $(".send-btn").click(function() {
                // alert();
                $('#free-search-result').removeClass('d-none');
            }) */
            $(".title-section").addClass("free-search-section");
            if ($(window).height() < 825) {
                $("#free-search-result .table-responsive").css("height", $(window).height() - 235 + "px");
                $("#free-search-result .table-responsive tbody").css("max-height", $(window).height() - 235 - 100 + "px");
            }
            $('html,body').animate({
                scrollTop: $("#free-search-result").offset().top - 150
            }, 400);
           /*  $(".back-link").click(function() {
                event.preventDefault();
                $("#free-search-container, .free-search-page h1.animated-title, .free-search-page h3.animated-title, .free-search-page .title-section .container").css("display", "block");
                $("#free-search-container").data("pageNumber", 1);
                $(".title-section").removeClass("free-search-section");
                $("#free-search-result").remove();
                $('html,body').animate({
                    scrollTop: $("#free-search-container").offset().top - 100
                }, 400);
                $(window).off('scroll');
                $("body").removeClass("show-results");
            }); */
            $('#free-search-result table tbody').on('scroll', function() {
                if ($(this).scrollTop() + $(this).innerHeight() + 50 >= $(this)[0].scrollHeight && !processing) {
                    processing = true;
                    $(".loader").css("display", "block");
                    LoadData(PickData());
                }
            })
        } else {
            $(data.responseText).insertAfter("#free-search-result table tbody tr:last");
            $(".number-result .current-count").text($(".elements-count:last").data("number"));
        }
        $(".loader").css("display", "none");
        $("#free-search-container").data("pageNumber", +$("#free-search-container").data("pageNumber") + 1);
        $("#wrapper").unbind("mousewheel")

    }

    function loadData() {
        $(".btn-primary.load-more").remove();
        LoadDataMobile(PickData());
    }

    $('.inr-testimonial-slider').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 3
            }
        }
    });

    $("#otpbtn").click(function() {
        $('.emailip').addClass('d-none');
        $('.emailtxt').removeClass('d-none');
        $('.codeip').removeClass('d-none');
        $('.otpbtn').addClass('d-none');
        $('.verifybtn').removeClass('d-none');
    })
    $("#verify").click(function() {
        $('.setpassword').removeClass('d-none');
        $('.emailip').addClass('d-none');
        $('.emailtxt').addClass('d-none');
        $('.codeip').addClass('d-none');
        $('.otpbtn').addClass('d-none');
        $('.verifybtn').addClass('d-none');
    })

    $('#backbtn').on('click', function() {
        $('.auth').addClass('auth-btn');
    });
    $("#backbtn-close").on('click', function() {
        $('.auth').removeClass('auth-btn');
    });
    
    $('#auth-secondary-button').on('click',function(){
        $('.auth').addClass('auth-active');
    });

    $('#auth-secondary-button-secure').on('click',function(){
        $('.auth').addClass('auth-active-secure');
    });

    $("#main-button-secure").on('click',function(){
        $('.auth').removeClass('auth-active-secure');
    });

   

    $("#forgot-close").on('click', function() {
        $('.auth').removeClass('auth-forgot');
    });

    $('#forgot1').on('click', function() {
        $('.auth').addClass('auth-forgot1');
    });

    $("#forgot-close1").on('click', function() {
        $('.auth').removeClass('auth-forgot1');
    });

    $(".lidiamond").on('click', function() {
        $('.mobilesubmenulist').toggleClass('dropdownshow');
    });
    
    $(".lijewelry").on('click', function() {
        $('.mobilesubmenulist2').toggleClass('dropdownshow');
    });
    /* $('.banner-slider').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    }); */

    $('.related-blog-slider').owlCarousel({
    loop:true,
    margin:5,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
})

    $('.jewelrysuits-info-slider').owlCarousel({
        loop: true,
        center: false,
        items: 3,
        nav: true,
        margin: 0,
        autoplay: true,
        dots: false,
        autoplayTimeout: 8500,
        smartSpeed: 450,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1170: {
                items: 4
            }
        }
    });

    $('.paymentmode-slider').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });

    $('.customers-testimonials').owlCarousel({
        loop: true,
        center: true,
        items: 3,
        nav: true,
        margin: 0,
        autoplay: false,
        dots: false,
        autoplayTimeout: 8500,
        smartSpeed: 450,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1170: {
                items: 3
            }
        }
    });

    /* $('.our-customers-slider').owlCarousel({
        loop: false,
        nav: true,
        dots: true,
        margin: 30,
        responsiveClass: true,
        autoplay: false,
        autoplayHoverPause: true,
        lazyLoad: true,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 5
            }
        }
    }); */

    new WOW().init();
    $(document).ready(function(){
        // if ($(window).width() < 992) {
        // $(document).on('click', function(event){ 
            // $(".mobile-menu-overlay").addClass("active");
            // $(".setmenu").addClass("active");
            // $("body").removeClass("no-overflow");
        // })
        // $(".mobile-menu-overlay, .mobile-navigation-icon").on('click', function(event) {
        //     event.stopPropagation();
        // });
  
        $('.mobile-navigation-icon').click(function() {
            if($('.mobile-menu-overlay').hasClass('inactive')) {  
                $('.mobile-menu-overlay').removeClass('inactive').addClass('active');
                $("body").removeClass("no-overflow").addClass('no-overflow');
                console.log("true"); 
            }
            else{
                $('.mobile-menu-overlay').addClass('inactive').removeClass('active');
                $("body").removeClass("no-overflow").addClass('no-overflow');
                console.log("false"); 
            }
        });
        $('.mobile-navigation-close-icon').click(function() {
            $('.mobile-menu-overlay').removeClass('active').addClass('inactive');
        });
    // }
    });
    //  setTimeout(function() {
    //     $('#cookiepolicypopup').addClass("show");
    // }, 1000);
    $("#cookiepolicypopup .btn-cookie-policy").click(function() {
        $('#cookiepolicypopup').removeClass("show");
    });

    var urlpath = window.location.pathname;
    if (urlpath == '<?php echo $config->getDirpath(); ?>') {
        var pagename = 'home';
    } else {
        var pagename = urlpath.split("/");
        pagename = pagename[pagename.length - 1];
    }   

    if (pagename == 'home') {
        $('body').addClass('home-page');
    }


    // For Frontend menu
    $('.clsparentmenu').on('click', function(e) {

        var pagename = $(this).attr('pagename');
        $('body').removeClass('home-page');
        if (pagename) {
            if (pagename == 'home') {
                $('body').addClass('home-page');
            } else {
                $('body').addClass('main-page');
            }

            e.preventDefault();
            if (e.ctrlKey) { //ctrl click event
                window.open(pagename, '_blank');
            } else {
                currentXhr.abort();
                render(pagename);
                window.history.pushState(pagename, 'Title', dirpath + pagename);

            }
            $('.mobile-footer-sidebar').removeClass('active');
            $('body').removeClass('sidenav-bar-visible');
            $('.navmobile-overlay').removeClass('open');
            $('.navmobile-overlay').addClass('close');
            $('.mobile-nav-toggler').removeClass('active');

            // $(".mobile-menu-overlay").removeClass("active");
            // $(".setmenu").removeClass("active");
            // $("body").removeClass("no-overflow");
        }
    });


    //contact validation 
    jQuery.validator.addMethod("contact", function(value, element) {
        return this.optional(element) || /^[0]?[6789]\d{9}$/i.test(value);
    }, "Invalid Contact");
    $('body').on('click', '.clssubmenu', function(e) {

        var pagename = $(this).attr('pagename');
        if (pagename) {
            e.preventDefault();
            if (e.ctrlKey) { //ctrl click event
                window.open(pagename, '_blank');
            } else {
                currentXhr.abort();
                render(pagename);
                window.history.pushState(pagename, 'Title', dirpath + pagename);
            }

            $(".navmobile-overlay, .menu-sidebar-close").click();
        }
    });

    function getwebredirecturl(type, n_name, unqid) //type 1-Item,2-Vendor,3-Service
    {
        var typename = '';
        var pagename = '';
        if (type == 1) //For Product
        {
            typename = 'pd';

            pagename = 'product-details';
        } else if (type == 2) //For Blog
        {
            typename = 'bd';

            pagename = 'blog-details';
        } else if (type == 3) //For Services
        {
            typename = 'sd';

            pagename = 'services-details';
        } else if (type == 4) //For Services
        {
            typename = 'ids';

            pagename = 'industries-details';
        }

        // var lastcurrurl = typename+'?'+unqid+'-'+n_name;
        var lastcurrurl = typename + '-' + unqid;

        currentXhr.abort();
        render(pagename);
        window.history.pushState(pagename, 'Title', dirpath + lastcurrurl);
    }

    function minusnumbonly(e) {
        var k = e.which;
        var ok = k >= 48 && k <= 57 || // 0-9
            k ==8 || //backspace
            k==0 || //arrow key
            k==45 || // Minus Sign
            k==46; //. sign
        if (!ok){
            e.preventDefault();
        }
    }

    /*********** Start For Cookies ***********/
    $('#acceptcookie').click(function() {

        var nDays = 999;
        var cookieName = "savanigemsElectroEngineerWebCookie";
        var cookieValue = "true";
        var today = new Date();
        var expire = new Date();
        var expiretime = today.getTime() + 3600000 * 24 * parseInt(nDays);
        expire.setTime(today.getTime() + 3600000 * 24 * parseInt(nDays));
        document.cookie = cookieName + "=" + escape(cookieValue) + ";expires=" + expire.toGMTString() + ";path=/";

        formdata = new FormData();
        formdata.append("action", "insertacceptcookie");
        formdata.append("expiretime", expiretime);
        var headersdata = {
            'Accept': 'application/json',
            platform: 4,
            userpagename: '',
            useraction: '',
            masterlisting: true,
            responsetype: 'JSON'
        };

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + 'home', formdata, headersdata, Onsuccessacceptcookie, OnErroracceptcookie)

        function Onsuccessacceptcookie(data) {

        }

        function OnErroracceptcookie() {

        }


    });

    $('body').on('change', '#addenquiryfrm #enqproductid', function() {
        var enqproductid = $('#addenquiryfrm #enqproductid :selected').val();
        $('#addenquiryfrm #enqcategoryid').val('');
        if (enqproductid) {
            var categoryid = $('#addenquiryfrm #enqproductid :selected').data('categoryid');
            $('#addenquiryfrm #enqcategoryid').val(categoryid);
        }
    })


    if ($('#addenquiryfrm').length) {
        $('#addenquiryfrm').validate({
            rules: {
                enqproductid: {
                    required: true,
                },
                enquiry_name: {
                    required: true,
                },
                enquiry_lastname: {
                    required: true,
                },
                enquiry_email: {
                    email: true
                },
                enquiry_phone: {
                    required: true,
                    contact: true,
                    maxlength: 10,
                },
                enquiry_message: {
                    required: true,
                }
            },
            messages: {
                enqproductid: {
                    required: "Product is required",
                },
                enquiry_name: {
                    required: "First name is required",
                },
                enquiry_lastname: {
                    required: "Last name is required",
                },
                enquiry_email: {
                    required: "Email is required",
                },
                enquiry_phone: {
                    required: "Phone number is required",
                },
                enquiry_message: {
                    required: "Message is required",
                }
            },
            submitHandler: function(form) {
                $('#addenquiryfrm .btn-loader').append('<div class="btn-preloader"><img src="<?php echo $config->getCdnurl(); ?>assets/images/btn-loader.gif" alt="btn-loader" /></div>');
                $('#addenquiryfrm .btn-preloader').show();
                $('#addenquiryfrm .btn-loader').attr('disabled', true);
                var productname = $('#addenquiryfrm #enqproductid :selected').text();
                // $('.preloader').show();
                var pagename = getpagename();
                var useraction = $('#formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "insertproductenquirydata");
                formdata.append("productname", productname);
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 4,
                    userpagename: pagename,
                    useraction: useraction,
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + 'enquiry', formdata, headersdata, OnsuccessenquiryDataSubmit, OnErrorEnquiry)

                function OnsuccessenquiryDataSubmit(data) {
                    var JsonData = JSON.stringify(data);
                    var resultdata = jQuery.parseJSON(JsonData);
                    // $('.preloader').hide();
                    $('#addenquiryfrm .btn-loader').append('<div class="btn-preloader"><img src="<?php echo $config->getCdnurl(); ?>assets/images/btn-loader.gif" alt="btn-loader" /></div>');
                    $('#addenquiryfrm .btn-preloader').hide();
                    $('#addenquiryfrm .btn-loader').removeAttr('disabled');
                    if (resultdata.status == 0) {
                        // alertify(resultdata.message,0);
                    } else if (resultdata.status == 1) {
                        $("#addenquiryfrm").validate().resetForm();
                        $('#addenquiryfrm').trigger("reset");


                        Notiflix.Notify.Success(resultdata.message);
                        $('.ion-ios-close-empty').click();
                    }

                }

                function OnErrorEnquiry(content) {
                    ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
                }
            },
        });
    }

    $('body').on('click', '.clsfootproduct', function() {
        var n_itemname = $(this).attr('data-product');
        var itemunqid = $(this).attr('data-unqid');

        getwebredirecturl(1, n_itemname, itemunqid) //type 1-Product,2=Blog
    });
    $(window).on('load', function() {
        setTimeout(function() {
            $("#loader").fadeOut();
        }, 1000);
    });


    function numbonly(e) {
        var k = e.which;
        var ok = k >= 48 && k <= 57 || // 0-9
            k == 8 || //backspace
            k == 0 || //arrow key
            k == 13 || //arrow key
            k == 46; //. sign
        if (!ok) {
            e.preventDefault();
        }
    }


    function logout() {
        $('.preloader-activate').addClass('preloader-active');
        var pagename = getpagename();
        var useraction = $('#formevent').val();
        formdata = new FormData();
        formdata.append("action", "logout");
        var headersdata = {
            'Accept': 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: useraction,
            masterlisting: false
        };
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>logout', formdata, headersdata, Onsuccesslogout, OnErrorlogout)

        function Onsuccesslogout(data) {
            $('.preloader-activate').removeClass('preloader-active');
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);

            if (resultdata.status == 0) {
                Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                window.location = resultdata.redirecturl;
            }

        }

        function OnErrorlogout(content) {

        }
    }

    $('#filterrightSidebar #btnCloseRightSidebar').click(function(){
        $("#filterrightSidebar").removeClass("active-right-sidebar");
        $('.overlay').removeClass('show');
        $("body").removeClass("overflow-hidden");
    });
    
    function checkuserlogin(typeid, packageid){
        if (packageid && typeid) {
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
            formdata.append("action", "checkuserlogin");
            formdata.append("packageid", packageid);
            formdata.append("typeid", typeid);
            formdata.append("btntype", 0);
            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>package', formdata, headersdata, Onsuccesscheckuserlogin, OnErrorcheckuserlogin);

            function Onsuccesscheckuserlogin(data) {
                var JsonData = JSON.stringify(data);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata = '';
                if (resultdata.status == 0) {
                    Notiflix.Notify.Failure(resultdata.message);
                } else if (resultdata.status == 1) {
                    if (resultdata.loginsuccess == 1) {
                        window.location = resultdata.redirecturl;
                    } else {
                        window.location = resultdata.redirecturl;
                    }
                }
            }

            function OnErrorcheckuserlogin(content) {
                // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
            }
        }

    }

    // Package Assign
    function packageassign(typeid, packageid,totalmonths=0,btntype=0) {
        if (packageid && typeid) {
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
            formdata.append("action", "packageassign");
            formdata.append("packageid", packageid);
            formdata.append("typeid", typeid);
            formdata.append("totalmonths", totalmonths);
            formdata.append("btntype", btntype);
            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>package', formdata, headersdata, Onsuccesspackageassign, OnErrorpackageassign);

            function Onsuccesspackageassign(data) {
                console.log(data);

                var JsonData = JSON.stringify(data);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata = '';
                // alert();
                if (resultdata.status == 0) {
                    Notiflix.Notify.Failure(resultdata.message);
                } else if (resultdata.status == 1) {
                    // alert(resultdata.checkout_sessionurl);
                    if (resultdata.loginsuccess == 1) {
                        // Payment Gateway Integration
                        
                        window.location = resultdata.checkout_sessionurl;

                        /* Notiflix.Confirm.Show(false,'Payment Gateway Integration!!', false, false, function() {
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
                            formdata.append("action", "checkpackageassignstatus");
                            formdata.append("packageassignid", resultdata.packageassignid);
                            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>package', formdata, headersdata, Onsuccesscheckpackageassignstatus, OnErrorcheckpackageassignstatus);

                            function Onsuccesscheckpackageassignstatus(data) {
                                var JsonData = JSON.stringify(data);
                                var resultdata = jQuery.parseJSON(JsonData);
                                var htmldata = '';
                                if (resultdata.status == 0) {
                                    Notiflix.Notify.Failure(resultdata.message);
                                } else if (resultdata.status == 1) {
                                    Notiflix.Notify.Success(resultdata.message);
                                    window.location = resultdata.redirecturl;
                                }
                            }

                            function OnErrorcheckpackageassignstatus(content) {
                                // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
                            }

                        }, function() {
           
                        }); */  

                        // if (confirm('Payment Gateway Integration') == true) {
                           
                        // } else {
                        //     window.location = resultdata.redirecturl;
                        // }

                    } else {
                        window.location = resultdata.redirecturl;
                    }
                }
            }

            function OnErrorpackageassign(content) {
                // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
            }
        }
    }

    //Fill Banner
    function fillbannerdetail(bannertypeid)
    {
        
        var pagename=getpagename();
        var headersdata= {Accept: 'application/json',platform: 4,userpagename:pagename,useraction:'',masterlisting:false,responsetype: 'JSON'};

        formdata = new FormData();
        formdata.append("action", "listbannerdetail");
        formdata.append("bannertypeid", bannertypeid);
        ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>home',formdata,headersdata,Onsuccessfillbannerdetail,OnErrorfillbannerdetail);
        function Onsuccessfillbannerdetail(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            if(resultdata.status==1)
            {   
                
                $('.commonbannerimg').css('background-image','url('+resultdata.banner[0].image+')');
               
                if(resultdata.banner[0].title)
                {
                    $('.commonbannertitle').html(resultdata.banner[0].title);
                }
                if(resultdata.banner[0].description)
                {
                    $('.commonbannerdescr').html(resultdata.banner[0].description);
                }
            }
        
        }
        function OnErrorfillbannerdetail(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }
    }
    $('.res-btn-set').click(function(){
      if($(".widthset").hasClass("width-mobile-set"))
      {
          $('.widthset').removeClass('width-mobile-set'); 
      }
      else{
          $('.widthset').addClass('width-mobile-set'); 
      }
      
  });

   
</script>