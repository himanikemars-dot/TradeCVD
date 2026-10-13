<!-- jQuery JS -->

<?php

$CanShareJewellery = $DB->getpackagewiseuserright($LoginInfo->getUid(),3)['attributeval'];

$CanMemberToMemberChat = $DB->getpackagewiseuserright($LoginInfo->getUid(),4)['attributeval'];



?>





<!-- <script src="assets/js/app.js"></script> -->

<script src="<?php echo $config->getCdnurl(); ?>assets/js/dependencyhandler.js"></script>

<script src="<?php echo $config->getCdnurl(); ?>assets/js/vendor/jquery.min.js"></script>

<!-- Popper JS -->

<script src="<?php echo $config->getCdnurl(); ?>assets/js/vendor/popper.min.js"></script>

<!-- Bootstrap JS -->

<script src="<?php echo $config->getCdnurl(); ?>assets/js/vendor/bootstrap.min.js"></script>

<script src="<?php echo $config->getCdnurl(); ?>assets/js/vendor/jquery-ui.min.js"></script>



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



<script src="<?php echo $config->getCdnurl(); ?>assets/js/validate.js"></script>



<script src="<?php echo $config->getCdnurl(); ?>assets/plugin/toastr/toastr.min.js"></script>



<script src="<?php echo $config->getCdnurl(); ?>assets/js/IISMethods.js"></script>

<script src="<?php echo $config->getCdnurl(); ?>assets/plugin/swiper-8.0.6/swiper-bundle.min.js"></script>

<script src="<?php echo $config->getCdnurl(); ?>assets/js/dependencyhandler.js"></script>



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



<script src="<?php echo $config->getportalbaseurl(); ?>assets/js/slim.kickstart.min.js"></script>

<script src="<?php echo $config->getportalbaseurl(); ?>assets/js/toastr.min.js"></script>

<script src="<?php echo $config->getportalbaseurl(); ?>assets/js/perfect-scrollbar.min.js"></script>

<script src="<?php echo $config->getportalbaseurl(); ?>assets/js/sweet-alert/sweet-alert.min.js" type="text/javascript"></script>

<script src="<?php echo $config->getportalbaseurl(); ?>assets/js/tag-input-custom.js" type="text/javascript"></script>

<script src="<?php echo $config->getportalbaseurl(); ?>assets/js/validate.js" type="text/javascript"></script>

<script src="<?php echo $config->getportalbaseurl(); ?>assets/js/chat.js"></script>

<script src="<?php echo $config->getCdnurl(); ?>assets/js/main.js"></script>



<script src="<?php echo $config->getCdnurl(); ?>assets/js/validate.js"></script>



<script src="<?php echo $config->getCdnurl(); ?>assets/plugin/toastr/toastr.min.js"></script>



<script src="<?php echo $config->getCdnurl(); ?>assets/plugin/swiper-8.0.6/swiper-bundle.min.js"></script>



<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

<script src="<?php echo $config->getportalbaseurl(); ?>assets/js/select2.min.js"></script>

<script src="<?php echo $config->getportalbaseurl(); ?>assets/js/croppic.min.js"></script>

<script src="<?php echo $config->getportalbaseurl(); ?>assets/js/sidebar.js"></script>



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



    // $(window).on('load', function() {

    // $('.acr-preloader').delay(500).fadeOut(500);

    // });



    // $(window).on('load',function(){

    //     setTimeout(function(){ // allowing 3 secs to fade out loader

    //     $('.page-loader').fadeOut('slow');

    //     },500);

    // });





    function removefilterurl()

    {

        var data = {},

            fdata = [],

            loc = $('<a>', {

                href: window.location

            })[0];



        // get all keys.

        var keys = Object.keys(data);

        var fdata = "";



        // iterate over them and create the fdata

        keys.forEach(function(key, i) {

            if (i > 0) fdata += '&'; // if its not the first key add &

            fdata += key + "=" + data[key].join('+');

        });



        if (history.pushState) {

            if (fdata) {

                history.pushState(null, null, loc.pathname + '?' + fdata);

            } else {

                history.pushState(null, null, loc.pathname);

            }

        }     

    }



    function showloader()

    {

        // console.log('123');

        $('#preloader').removeClass('d-none');

        $('#ctn-preloader').removeClass('loaded');

    }



    function hideloader()

    {

        // console.log('456');

        // $('#preloader').delay(1000).queue(function() {

        //     $('#preloader').addClass('d-none');

        //     $('#ctn-preloader').addClass('loaded');

        // });

        setTimeout(function() {

            $('#preloader').addClass('d-none');

            $('#ctn-preloader').addClass('loaded');

        }, 500);

    }





    setInterval(function() {

        checkuserpackageexpiry();  

    }, 50000);

   

    function checkuserpackageexpiry(){

        var pagename = getpagename();

        var useraction = $('#formevent').val();

        formdata = new FormData();

        formdata.append("action", "checkuserpackageexpiry");

        var headersdata = {

            'Accept': 'application/json',

            platform: 4,

            userpagename: pagename,

            useraction: useraction,

            masterlisting: false

        };

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>home', formdata, headersdata, Onsuccesscheckuserpackageexpiry, OnErrorcheckuserpackageexpiry)



        function Onsuccesscheckuserpackageexpiry(data) {

            var JsonData = JSON.stringify(data);

            var resultdata = jQuery.parseJSON(JsonData);

            if (resultdata.IsSessionExpire == 1) {

                Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});

            } 

            else if(resultdata.IsPackageExpire == 1)

            {

                Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});

            }

        }



        function OnErrorcheckuserpackageexpiry(content) {



        }

    }

    



    // $(window).on('load',function(){

        

    // });

    



    $(document).ajaxStop(function () {



        



        setTimeout(function() {

            $('#preloader').delay(1000).queue(function() {

                $('#preloader').addClass('d-none');

            });

            $('#ctn-preloader').addClass('loaded');

        }, 500);

    });

    

    $(document).ready(function() {

        

        // setTimeout(function() {

        //     $('#ctn-preloader').addClass('loaded');

        //     // Una vez haya terminado el preloader aparezca el scroll

        //     $('body').removeClass('no-scroll-y');



        //     if ($('#ctn-preloader').hasClass('loaded')) {

        //         // Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader

        //         $('#preloader').delay(1000).queue(function() {

        //             $(this).addClass('d-none');

        //         });

        //     }

        //     else

        //     {

        //         $('#preloader').delay(1000).queue(function() {

        //             $(this).removeClass('d-none');

        //         });

        //     }

        // }, 3000);

        $(".header-navigation nav>ul>li").removeClass("active");

        $(".header-navigation nav>ul>li.lihome").addClass("active");

        /* $("body").on('click','.show-more-filters',function() {

            $(this).parent().find(".filter-container").toggleClass("show-more-container");

            $(this).toggleClass("show-more-open");

        }); */

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

        $('.form-btns input[type="submit"],.form-btns button[type="submit"').click(function() {

            event.preventDefault();

            $(".loader").css("display", "block");

            var model = PickData();

            if ($(window).width() > 767) {

                LoadData(model);

            } else {

                LoadDataMobile(model);

            }

        });

    });



    function numbonly(e) {

        var k = e.which;

        var ok = k >= 48 && k <= 57 || // 0-9

            k == 8 || //backspace

            k == 0 || //arrow key

            k == 46; //. sign

        if (!ok) {

            e.preventDefault();

        }

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

    function numbfloatonly(e) {

        var k = e.which;

        var ok = k >= 48 && k <= 57 || // 0-9

		  	k ==8 || //backspace

		    k==0 || //arrow key

		     

		    k==45 ||

		    k==46; //. sign

		    

		if (!ok){

            e.preventDefault();

        }

    }



    $.validator.addMethod("greaterThan",

        function(value, element, param) {

            var $otherElement = $(param);

            return parseFloat(value) >= parseFloat($otherElement.val());

        });

    $.validator.addMethod("lessThan",

        function(value, element, param) {

            var $otherElement = $(param);

            return parseFloat(value) <= parseFloat($otherElement.val());

        });





    // sidebar set 

    // $( '.main-sidebar .sidebar-menu a' ).on( 'click', function () {

    //     $( '.main-sidebar .sidebar-menu' ).find( 'li.active' ).removeClass( 'active' );

    //     $( this ).parent( 'li' ).addClass( 'active' );

    // });







    $('#btnlogout').click(function() {



        // $('.preloader-activate').addClass('preloader-active');

        // showloader();

        $('.mainloader').removeClass('d-none');

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

            // hideloader();

            

            // $('.preloader-activate').removeClass('preloader-active');

            var JsonData = JSON.stringify(data);

            var resultdata = jQuery.parseJSON(JsonData);

            $('.mainloader').addClass('d-none');

            if (resultdata.status == 0) {

                Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {

                window.location.href = '<?php echo $config->getWeburl(); ?>home';

            }

           

        }



        function OnErrorlogout(content) {



        }



    });





    $('body').on('click', '#listjewelleryData .showjewellerydetails', function() {



        $('.preloader-activate').addClass('preloader-active');

        var pagename = getpagename();

        var useraction = $('#formevent').val();



        var formdata = new FormData();

        formdata.append("action", "listjewellery");

        formdata.append("nextpage", 1);

        formdata.append("fltmanagemyjewellery", 0);

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

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>jewellery', formdata, headersdata, Onsuccessjewellerydetails, OnErrorjewellerydetails)



        function Onsuccessjewellerydetails(data) {

            $('.preloader-activate').removeClass('preloader-active');

            var JsonData = JSON.stringify(data);

            var resultdata = jQuery.parseJSON(JsonData);

            var htmldata = '';

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

                    htmldata += '        <div class="col-md-12 col-lg-8 col-xl-9">';

                    htmldata += '            <div class="row">';

                    htmldata += '                <div class="col-md-5 col-lg-4 col-xl-6">';

                    htmldata += '                    <div class="">';

                    

                    

                   

                         



                           

                            // htmldata+='<div class="owl-carousel our-jewellery-slider">';

                            

                            

                                // alert( jewellerydata.jewelleryimagesdetail[i].image );

                           

                            

                            // htmldata+='</div>';

                            if (jewellerydata.hasjewelleryimages == 1 || jewellerydata.hasjewelleryvideos == 1) {

                                htmldata += '<div class="simple-gallery owl-carousel owl-theme our-jewellery-slider1 " id="sync1">';

                                

                               

                                

                                    for (var k in jewellerydata.jewelleryimagesdetail) {

                                        var trtmp = k;

                                        htmldata += '<div class="item"><img class="maxi1 primary blur-up lazyloaded bigimgDiv'+jewellerydata.jewelleryimagesdetail[k].id+'" data-id="'+jewellerydata.jewelleryimagesdetail[k].id+'" data-index="'+trtmp+'" src="' + jewellerydata.jewelleryimagesdetail[k].image + '" alt="' + jewellerydata.itemtitle + '" title="' + jewellerydata.itemtitle + '"></div>';



                                        

                                    }

                                   

                                

                                    for (var h in jewellerydata.jewelleryvideosdetail) 

                                    {

                                     

                                        htmldata += '<div class="item"><video class="maxi1 primary blur-up lazyloaded " autoplay="" muted="" loop="">';

                                        htmldata += '<source class="videomaxi" src="' + jewellerydata.jewelleryvideosdetail[h].video + '">';

                                        htmldata += '</video></div>';

                                        

                                    }

                                



                                htmldata += '</div>';

                            }

                            // if (jewellerydata.jewelleryvideosdetail.length > 0) {

                            //     htmldata += '                    <div class="simple-gallery imagevideoDivclass owl-carousel our-jewellery-slider">';

                               

                            //     for (var k in jewellerydata.jewelleryvideosdetail) {

                            //         var imgclass = '';

                            //         if (k == 0) {

                            //             imgclass = 'active';

                            //         }

                            //     // htmldata += '<img class="maxi1 primary ' + imgclass + ' blur-up lazyloaded" src="' + jewellerydata.jewelleryvideosdetail[k].video + '" alt="' + jewellerydata.itemtitle + '" title="' + jewellerydata.itemtitle + '">';



                            //     htmldata += '<video class="maxi1 primary blur-up lazyloaded " autoplay="" muted="" loop="">';

                            //     htmldata += '<source class="videomaxi" src="' + jewellerydata.jewelleryvideosdetail[k].video + '">';

                            //     htmldata += '</video>';

                            //     }

                            //     htmldata += '</div>';

                               

                            //     }

                        

                            

                               

                        

                        // else

                        // {

                        //     if (jewellerydata.jewelleryimglink != '') {

                        //         // htmldata += '                        <div class="simple-gallery samplelinkimg">';

                        //         htmldata += '                        <img class="primary blur-up  mt-5 lazyloaded" src="' + jewellerydata.jewelleryimglink + '" alt="' + jewellerydata.itemtitle + '" title="' + jewellerydata.itemtitle + '">';

                        //         // htmldata += '                        </div>';

                        //     }  

                        //     else{

                            

                        //         htmldata += '                        <img class="maxi primary blur-up lazyloaded" src="' + jewellerydata.imgurl + '" alt="' + jewellerydata.itemtitle + '" title="' + jewellerydata.itemtitle + '">';



                        //     }  

                        // }

                  

                   

                    

                    htmldata += '<div class="col-12 searmedia">';

                            htmldata += '<div class="row">';

                            htmldata += '<div class="col-md-10 mediasearch">';



                            htmldata += '<h5>Media</h5>';

                            htmldata += '<div class="media row">';

                                if (jewellerydata.jewelleryimagesdetail.length > 0) {

                                    htmldata += '<div class="mini owl-carousel owl-theme" id="sync2" >';

                                    for (var ji in jewellerydata.jewelleryimagesdetail) {

                                        var imgclass = '';

                                        var trtmp = ji;

                                        if (ji == 0) {

                                            imgclass = 'active';

                                        }

                                        htmldata += '<div class="item"><img class="primary blur-up lazyloaded imageclass" data-id="' + jewellerydata.jewelleryimagesdetail[ji].id + '"  data-index="'+trtmp+'1" src="' + jewellerydata.jewelleryimagesdetail[ji].image + '" alt="' + jewellerydata.itemtitle + '" title="' + jewellerydata.itemtitle + '"></div>';

                                        

                                    }

                                    

                                    for (var jj in jewellerydata.jewelleryvideosdetail) {

                                        var imgclass = '';

                                        if (jj== 0) {

                                            imgclass = 'active';

                                        }

                                        htmldata += '<div class="item"><img class="primary ' + imgclass + ' blur-up lazyloaded videoclass" data-video="'+jewellerydata.jewelleryvideosdetail[jj].video+'" src="<?php echo $config->getImageurl(); ?>play-button.jpg" alt="' + jewellerydata.itemtitle + '" title="' + jewellerydata.itemtitle + '"></div>';

                                    }

                                    htmldata += '</div>';

                                }

                                else {



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

                                htmldata += '<a href="' + jewellerydata.jewelleryvideolink + '" target="_blank"><i class="fas fa-play"></i></a>';

                                htmldata += '</div>';

                                htmldata += '</div>'; 

                            } 

                           

                           



                            htmldata += '</div>';

                            htmldata += '</div>';

                            htmldata += '</div>';

                    htmldata += '                    </div>';

                   

                    htmldata += '                </div>';



                    htmldata += '                <div class="col-md-7 col-lg-8 col-xl-6 setpres">';

                    htmldata += '                    <div class="titjw">';

                    htmldata += '                        <h4>' + jewellerydata.itemtitle + '</h4>';

                    htmldata += '                        <div class="btn setbtntit">' + jewellerydata.jewellerytype + '</div>';

                    htmldata += '                        <p>' + jewellerydata.description + '</p>';

                    htmldata += '                        <h5>' + jewellerydata.stock + '</h5>';

                    htmldata += '                        <div class="contectse text-center">';

                  

                    <?php 

                    if($CanMemberToMemberChat==1)

                    {

                        ?>

                        if(jewellerydata.canresponse==1)

                        {

                            htmldata += ' <button type="button" class="btn contactjewelleryseller" data-jewelleryname="' + jewellerydata.itemtitle + '" data-jewelleryid="' + jewellerydata.id + '">Contact Seller</button>';

                        }

                     

                      <?php 

                        } ?>    

                   <?php  if($CanShareJewellery==1) 

                    { ?>

                     if (jewellerydata.sharable == 1) {

                        htmldata += '<button type="button" class="btn sharejewellery" data-jewelleryid="' + jewellerydata.id + '"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/share.svg" alt="' + jewellerydata.itemtitle + '" title="Share ' + jewellerydata.itemtitle + '"></button>';

                     }   

                    <?php  } ?>

                     if (jewellerydata.ismyfavoriteitem == 1) {

                        htmldata += '<a href="javascript:void(0);" data-jewellerytitle="' + jewellerydata.itemtitle + '" data-jewelleryid="' + jewellerydata.id + '" data-ismyfavoriteitem="' + jewellerydata.ismyfavoriteitem + '" class="pull-right myfavoriteitem' + jewellerydata.id + ' addtomyfavorite"><i class="fas fa-heart clsaddtomyfavorite"></i></a>';

                    } else {

                        htmldata += '<a href="javascript:void(0);" data-jewellerytitle="' + jewellerydata.itemtitle + '" data-jewelleryid="' + jewellerydata.id + '" data-ismyfavoriteitem="' + jewellerydata.ismyfavoriteitem + '" class="pull-right addtomyfavorite myfavoriteitem' + jewellerydata.id + '"><i class="far fa-heart clsaddtomyfavorite"></i></a>';

                    }

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

                            htmldata += '                                <li><b>Shipping From</b>: <span class="metalpurity1"  tabindex="0" data-toggle="tooltip" title="India">&nbsp; ' + pricelocationdata.shippingfrom + '</span></li>';

                            htmldata += '                                <li><b>Price Per Piece</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="$1500">&nbsp; $' + pricelocationdata.price + '</span></li>';

                            htmldata += '                                <li><b>Terms</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title=" Free Shipping across Russia,Easy Returns">&nbsp; ' + pricelocationdata.terms + '</span></li>';

                            htmldata += '                                <li><b>Msrp</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="$1652">&nbsp; $' + pricelocationdata.msrp + '</span></li>';

                            htmldata += '                                <li><b>Delivery Time</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="2 days">&nbsp; ' + pricelocationdata.deliverytimeindays + ' Days</span></li>';

                            htmldata += '                            </ul>';

                            htmldata += '                            </div>';

                        }



                        htmldata += '                        </div>';





                    }



                    htmldata += '                        <h3>Product Information</h3>';

                    htmldata += '                        <div class="card">';



                    htmldata += '                            <div class="card-body">';

                    htmldata += '                            <ul>';

                    htmldata += '                                <li><b>Jewellery Type</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="Temple Jewellery">&nbsp; ' + jewellerydata.jewellerytype + '</span></li>';

                    htmldata += '                                <li><b>Type Style</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="Filigree Jewellery,Fashion Jewellery">&nbsp; ' + jewellerydata.typestyle + '</span></li>';

                    htmldata += '                                <li><b>Jewellery Category</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="Minakari Jewellery,Navratna Jewellery">&nbsp; ' + jewellerydata.jewellerycategory + '</span></li>';

                    htmldata += '                                <li><b>Condition</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="Small to Extremely Large">&nbsp; ' + jewellerydata.conditionname + '</span></li>';

                    htmldata += '                                <li><b>Brand</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="Malabar Gold & Diamonds">&nbsp; ' + jewellerydata.brand + '</span></li>';

                    htmldata += '                                <li><b>Jewellery Quality</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="Tungsten,titanium,stainless steel">&nbsp; ' + jewellerydata.jewelleryquality + '</span></li>';

                    htmldata += '                                <li><b>Designer Maker</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="Xyz">&nbsp; ' + jewellerydata.designername + '</span></li>';

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

                    htmldata += '                                <li><b tabindex="0" data-toggle="tooltip" title="Jewellery Total Weight">Jewellery Total Weight</b>: <span class="metalpurity1">&nbsp; ' + jewellerydata.jewellerytotalweight + 'gr</span></li>';

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

                            htmldata += '                                <li><b>Gemstone Type</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="Alexandrite">&nbsp; ' + gemstonedata.gemstonetype + '</span></li>';

                            htmldata += '                                <li><b>Shape</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="Oval">&nbsp; ' + gemstonedata.shape + '</span></li>';

                            htmldata += '                                <li><b>Carat Weight</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="103.85">&nbsp; ' + gemstonedata.caratweight + '</span></li>';

                            htmldata += '                                <li><b>Lab</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="GAT">&nbsp; ' + gemstonedata.lab + '</span></li>';

                            htmldata += '                                <li><b>Lab#</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="GAT Lab Pvt. Ltd.">&nbsp; ' + gemstonedata.labtext + '</span></li>';

                            htmldata += '                                <li><b>Treatment</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="color enhance,Laser Drilling,Fracture Filling">&nbsp; ' + gemstonedata.treatment + '</span></li>';

                            htmldata += '                                <li><b>#Stone</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="STOSUR2">&nbsp; ' + gemstonedata.stones + '</span></li>';

                            // htmldata += '                                <li><b>Savani Lot#</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="LOTSUR2">&nbsp; ' + gemstonedata.savanilot + '</span></li>';

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



                    htmldata += '        <div class="col-md-12 col-lg-4 col-xl-3 profilediamnd-set">';

                    htmldata += '            <div class="card">';

                    htmldata += '                <div class="card-body">';

                    htmldata += '                    <div class="sellersearchd">';

                    htmldata += '                        <h5>Seller Details</h5>';

                    htmldata += '                        <div class=" ">';

                    htmldata += '                            <ul class="d-flex justify-content-between align-items-center">';

                    htmldata += '                                <li>';

                    htmldata += '                                    <div class="profileimg">';

                    htmldata += '                                        <img src="' + sellerdetails.profileimg + '" alt="' + sellerdetails.personname + '" title="' + sellerdetails.personname + '">';

                    htmldata += '                                    </div>';

                    htmldata += '                                </li>';

                    htmldata += '                                <li>';

                    htmldata += '                                    <div class="desc">';

                    htmldata += '                                        <h4>' + sellerdetails.companyname + '</h4>';

                    htmldata += '                                        <h5><b>ID No</b>&nbsp;  - <span class="metalpurity1">&nbsp; ' + sellerdetails.savaniid + '</span></h5>';

                    htmldata += '                                    </div>';

                    htmldata += '                                </li>';

                    htmldata += '                            </ul>';

                    htmldata += '                        </div>';

                    htmldata += '                        <ul class="locsetjw">';

                    htmldata += '                            <li><b>Loaction</b>: <span class="metalpurity1 "tabindex="0" data-toggle="tooltip" title="Surat">&nbsp; ' + sellerdetails.cityname + ',' + sellerdetails.statename + ', ' + sellerdetails.countryname + '</span></li>';

                    htmldata += '                            <li><b>Contact Person</b>: <span class="metalpurity1 "tabindex="0" data-toggle="tooltip" title="Abc">&nbsp; ' + sellerdetails.personname + '</span></li>';

                    htmldata += '<li class="hidephoneno1" data-id="'+jewellerydata.id+'"><b>Phone</b>: <span class="metalpurity1" title="Click To Unlock">&nbsp; ***** ***** <i class="fas fa-lock"></i></span></li>';

                    htmldata += '<li class="showphoneno'+jewellerydata.id+' d-none"><b>Phone</b>: <span class="metalpurity1">&nbsp; <a href="tel:' + sellerdetails.phonecode + '' + sellerdetails.businessphoneno + '" >' + sellerdetails.phonecode + ' ' + sellerdetails.businessphoneno + '</a></span></li>';

                    // htmldata += '                            <li class="hyp-contect">Contact Seller</li>';

                    htmldata += '                        </ul>';

                    htmldata += '                        ';

                    htmldata += '                    </div>';

                    htmldata += '                </div>';

                    htmldata += '            </div>';



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

                    htmldata += '                                <li><b>Available</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="yes">&nbsp;' + isavailabletext + '</span></li>';

                    htmldata += '                                <li><b>Memo</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="yes">&nbsp;' + isavailableformemotext + '</span></li>';

                    htmldata += '                                <li><b>Stock#</b>: <span class="metalpurity1 phonesearch" tabindex="0" data-toggle="tooltip" title="STk2541">&nbsp;' + jewellerydata.stock + '</span></li>';

                    htmldata += '                                <li><b>In Stock</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="15">&nbsp;' + jewellerydata.iteminstock + '</span></li>';

                    htmldata += '                                <li><b>Min Order</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="5">&nbsp;' + jewellerydata.minimumorder + '</span></li>';

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



                    // if(jewellerydata.keyworddescription!='')

                    // {

                    //     htmldata += '                <div class="card mt-4">';

                    //     htmldata += '                    <div class="card-body">';

                    //     htmldata += '                        <div class="Notessearchd">';

                    //     htmldata += '                            <h5 calss="avilabtnsetjw">Keyword Description</h5>';

                    //     htmldata += '                            <ul>';

                    //     htmldata += '                                <li><p>' + jewellerydata.keyworddescription + '</p></li>';

                    //     htmldata += '                            </ul>';

                    //     htmldata += '                        </div>';

                    //     htmldata += '                    </div>';

                    //     htmldata += '                </div>';

                    // }    

                    // if(jewellerydata.suppliercomment!='')

                    // {

                    //     htmldata += '                <div class="card mt-4">';

                    //     htmldata += '                    <div class="card-body">';

                    //     htmldata += '                        <div class="Notessearchd">';

                    //     htmldata += '                            <h5 calss="avilabtnsetjw">Suppliers Comment</h5>';

                    //     htmldata += '                            <ul>';

                    //     htmldata += '                                <li><p>' + jewellerydata.suppliercomment + '</p></li>';

                    //     htmldata += '                            </ul>';

                    //     htmldata += '                        </div>';

                    //     htmldata += '                    </div>';

                    //     htmldata += '                </div>';

                    // }



                    if (jewellerydata.keyworddescription != '') 

                    {

                    htmldata += '<div class="card mt-4">';

                        htmldata += '<div class="card-body">';

                            htmldata += '<h5 calss="avilabtnsetjw">Keyword Description</h5>';

                            htmldata += '<div class="Notessearchd Notessearchd-space">';

                                htmldata += '<ul>';

                                    htmldata += '<li><p>' + jewellerydata.keyworddescription + '</p></li>';

                                htmldata += '</ul>';

                            htmldata += '</div>';

                        htmldata += '</div>';

                    htmldata += '</div>';

                    }

                    if (jewellerydata.suppliercomment != '') 

                    {

                    htmldata += '<div class="card mt-4">';

                        htmldata += '<div class="card-body">';

                            htmldata += '<h5 calss="avilabtnsetjw">Suppliers Comment</h5>';

                            htmldata += '<div class="Notessearchd Notessearchd-space">';

                                htmldata += '<ul>';

                                    htmldata += '<li><p>' + jewellerydata.suppliercomment + '</p></li>';

                                htmldata += '</ul>';

                            htmldata += '</div>';

                        htmldata += '</div>';

                    htmldata += '</div>';

                    }

                        



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



                    // htmldata += '                <div class="card mt-4">';

                    // htmldata += '                    <div class="card-body">';

                    // htmldata += '                        <div class="Notessearchd">';

                    // htmldata += '                            <h5 calss="avilabtnsetjw">Visibility</h5>';

                    // htmldata += '                            <ul>';

                    // htmldata += '                                <li><b>Unpublished</b>: <span class="metalpurity1">&nbsp;' + unpublishedtext + '</span></li>';

                    // htmldata += '                                <li><b>Sharable</b>: <span class="metalpurity1">&nbsp;' + sharabletext + '</span></li>';

                    // htmldata += '                                <li><b>Own Stock Inventory</b>: <span class="metalpurity1">&nbsp;' + ownstockinventorytext + '</span></li>';

                    // htmldata += '                            </ul>';

                    // htmldata += '                        </div>';

                    // htmldata += '                    </div>';

                    // htmldata += '                </div>';







                    htmldata += '            </div>';

                    // htmldata+='            <div class="deliveysetjw">';

                    // htmldata+='                <div class="imgsttruk">';

                    // htmldata+='                    <img src="<?php echo $config->getImageurl(); ?>images/searchpage/truk.svg" alt="diamonds" title="diamonds">';

                    // htmldata+='                </div>';

                    // htmldata+='                <h5>Delivery Location -  </h5>';

                    // htmldata+='                <span>from UK</span>';

                    // htmldata+='            </div>';

                    // htmldata+='            <div class="docjw">';

                    // htmldata+='                <div class="imgdoc">';

                    // htmldata+='                    <img src="<?php echo $config->getImageurl(); ?>images/searchpage/doc.svg" alt="diamonds" title="diamonds">';

                    // htmldata+='                </div>';

                    // htmldata+='                Document & Links';

                    // htmldata+='            </div>';

                    htmldata += '        </div>';

                    htmldata += '    </div>';

                    htmldata += '</div>';





                }

                $('#jewellerydetailmodal #ListJewelleryDataDetail').html(htmldata);

                /* $('.our-jewellery-slider').owlCarousel({

                    loop: false,

                    center: false,

                    nav: true,

                    dots: true,

                    items: 1,  

                    navText: ['<i class="icon-left-chevron"></i>', '<i class="icon-right-chevron"></i>'],

                    margin: 0,

                    autoplay: true,

                    autoplayTimeout: 8500,

                    smartSpeed: 450,

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

                        1170: {

                            items: 1

                        }

                    }



                    

                }); */

                prodGallery();

                

                



                if ($("#jewellerydetailmodal img.active").attr("src")) {

                    $("#jewellerydetailmodal .maxi").attr("src", $("#jewellerydetailmodal img.active").attr("src").replace("100x100", "400x400"));

                }



                $("#jewellerydetailmodal .mini .imageclass").click(function() {





                    // $("#jewellerydetailmodal .owl-item").removeClass('active');

                    $("#jewellerydetailmodal .our-jewellery-slider .owl-item").removeClass('active');

                    // $("#jewellerydetailmodal .maxi1 ").attr("src", $(this).attr("src").replace("100x100", "400x400"));

                    var imgid = $(this).attr("data-id");

                    console.log(imgid);

                    $("#jewellerydetailmodal .our-jewellery-slider .bigimgDiv"+imgid).parent().addClass('active');

                     

                      





                     



                     

                        //  alert(image);

                        // var htmldata ="";

                        // if(image)

                        // {

                        //     htmldata += '<img class="maxi primary blur-up lazyloaded" src="' + image + '" alt="' + jewellerydata.itemtitle + '" title="' + jewellerydata.itemtitle + '">';

                        // }



                        // $('.imagevideoDivclass').html(htmldata);

                    

                });



                $("#jewellerydetailmodal .mini .videoclass").click(function() {

                       

                        

                       var video = $(this).attr('data-video');

                      

                        // $("#jewellerydetailmodal .maxi1").attr("src", $(this).attr("src").replace("100x100", "400x400"));

                    //    var htmldata ="";

                    //    if(video)

                    //    {

                          

                    //        htmldata += '<video class="maxi1 primary blur-up lazyloaded " autoplay="" muted="" loop="">';

                    //        htmldata += '<source class="videomaxi" src="' + video + '">';

                    //        htmldata += '</video>';

                    //    }

                    //    $('.imagevideoDivclass').html(htmldata);

                       

                });

                $('#jewellerydetailmodal').modal('show');



                $('#jewellerydetailmodal .sharejewellery').on('click', function() {

                    var id = $(this).attr('data-jewelleryid');

                    $("#form-jewellery-share").validate().resetForm();

                    $('#form-jewellery-share').trigger("reset");

                    $('#form-jewellery-share #sharejewelleryid').val(id);

                    $('#jewellerydetailmodal').modal('hide');

                    $('#sharejewellerysearch').modal('show');

                });



                $('.hidephoneno1').on('click',function(){

                        

                        var id =$(this).data('id');

                        

                        $(this).addClass('d-none');

                        $('.showphoneno'+id).removeClass('d-none');

                    });



                if ($('#form-jewellery-share').length) {

                    $('#form-jewellery-share').validate({

                        rules: {

                            jsharewithemail: {

                                required: true,

                                email: true

                            },

                        },

                        messages: {

                            jsharewithemail: {

                                required: "E-mail Address is required",

                            },

                        },

                        submitHandler: function(form) {



                            $('.preloader-activate').addClass('preloader-active');

                            var pagename = getpagename();

                            var useraction = $('#formevent').val();

                            formdata = new FormData(form);

                            formdata.append("action", "sharejewellery");

                            var headersdata = {

                                'Accept': 'application/json',

                                platform: 4,

                                userpagename: pagename,

                                useraction: useraction,

                                masterlisting: false

                            };

                            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>jewellery', formdata, headersdata, Onsuccesssharejewellery, OnErrorsharejewellery)



                            function Onsuccesssharejewellery(data) {

                                $('.preloader-activate').removeClass('preloader-active');

                                var JsonData = JSON.stringify(data);

                                var resultdata = jQuery.parseJSON(JsonData);



                                if (resultdata.status == 0) {

                                    Notiflix.Notify.Failure(resultdata.message);

                                } else if (resultdata.status == 1) {

                                    Notiflix.Notify.Success(resultdata.message);

                                    $('#sharejewellerysearch').modal('hide');

                                }else if(resultdata.status == -1)

                                {

                                    $('#btnlogout').trigger('click');

                                }



                            }



                            function OnErrorsharejewellery(content) {



                            }

                        },

                    });

                }





                $('body').on('click', '#jewellerydetailmodal .contactjewelleryseller', function() {

                    var id = $(this).attr('data-jewelleryid');

                    var jewelleryname = $(this).attr('data-jewelleryname');



                    $("#form-jewellery-contact-seller").validate().resetForm();

                    $('#form-jewellery-contact-seller').trigger("reset");

                    $('#form-jewellery-contact-seller #contactsellerjewelleryid').val(id);

                    $('#form-jewellery-contact-seller #contactsellerjewelleryname').val(jewelleryname);

                    $('#form-jewellery-contact-seller .jewellerynametext').html(jewelleryname);

                    $('#jewellerydetailmodal').modal('hide');

                    $('#contactjewelleryseller').modal('show');

                });





                if ($('#form-jewellery-contact-seller').length) {

                    $('#form-jewellery-contact-seller').validate({

                        rules: {

                            jewellerymessagetext: {

                                required: true,

                            },

                            jewelleryofferprice: {

                                required: true,

                                number: true

                            }

                        },

                        messages: {

                            jewellerymessagetext: {

                                required: "Message is required",

                            },

                            jewelleryofferprice: {

                                required: "Offer Price is required",

                            },

                        },

                        submitHandler: function(form) {



                            $('.preloader-activate').addClass('preloader-active');

                            var pagename = getpagename();

                            var useraction = $('#formevent').val();

                            formdata = new FormData(form);

                           // formdata.append("action", "contactjewelleryseller");

                            formdata.append("action", "addproductrequest");

                            var headersdata = {

                                'Accept': 'application/json',

                                platform: 4,

                                userpagename: pagename,

                                useraction: useraction,

                                masterlisting: false

                            };

                            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>productrequest', formdata, headersdata, Onsuccesscontactjewelleryseller, OnErrorcontactjewelleryseller)

                            // ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>jewellery', formdata, headersdata, Onsuccesscontactjewelleryseller, OnErrorcontactjewelleryseller)



                            function Onsuccesscontactjewelleryseller(data) {

                                $('.preloader-activate').removeClass('preloader-active');

                                var JsonData = JSON.stringify(data);

                                var resultdata = jQuery.parseJSON(JsonData);



                                if (resultdata.status == 0) {

                                    Notiflix.Notify.Failure(resultdata.message);

                                } else if (resultdata.status == 1) {

                                    Notiflix.Notify.Success(resultdata.message);

                                    $('#contactjewelleryseller').modal('hide');

                                }else if(resultdata.status == -1)

                                {

                                    $('#btnlogout').trigger('click');

                                }



                            }



                            function OnErrorcontactjewelleryseller(content) {



                            }

                        },

                    });

                }







            }else if(resultdata.status == -1)

            {

                $('#btnlogout').trigger('click');

            }





        }



        function OnErrorjewellerydetails(content) {



        }



    });



    var prodGallery = function() {



        var sync1 = $("#sync1");

        var sync2 = $("#sync2");

        var slidesPerPage = 5; //globaly define number of elements per page

        var syncedSecondary = true;

        sync1.owlCarousel({

            items: 1,

            loop: false,

            slideSpeed: 500,

            nav: false,

            autoplay: true,

            dots: false,

            responsiveRefreshRate: 200,

            // navText: ['<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],

        }).on('changed.owl.carousel', syncPosition);

        sync2

            .on('initialized.owl.carousel', function() {

                sync2.find(".owl-item").eq(0).addClass("current");

            })

            .owlCarousel({

                items: slidesPerPage,

                dots: false,

                nav: true,

                loop: false,

                navText: ['<i class="icon-left-chevron"></i>', '<i class="icon-right-chevron"></i>'], //we will be using font awesome icon here

                margin: 10,

                smartSpeed: 200,

                slideSpeed: 500,

                slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel

                responsiveRefreshRate: 100

            }).on('changed.owl.carousel', syncPosition2);



        function syncPosition(el) {

            //if you set loop to false, you have to restore this next line

            //var current = el.item.index;

            //if you disable loop you have to comment this block

            var count = el.item.count - 1;

            var current = Math.round(el.item.index - (el.item.count / slidesPerPage - 1) - .5);

            if (current < 0) {

                current = count;

            }

            if (current > count) {

                current = 0;

            }

            //end block

            sync2

                .find(".owl-item")

                .removeClass("current")

                .eq(current)

                .addClass("current");

            var onscreen = sync2.find('.owl-item.active').length - 1;

            var start = sync2.find('.owl-item.active').first().index();

            var end = sync2.find('.owl-item.active').last().index();

            if (current > end) {

                sync2.data('owl.carousel').to(current, 100, true);

            }

            if (current < start) {

                sync2.data('owl.carousel').to(current - onscreen, 100, true);

            }

        }



        function syncPosition2(el) {

            if (syncedSecondary) {

                var number = el.item.index;

                sync1.data('owl.carousel').to(number, 100, true);

            }

        }

        sync2.on("click", ".owl-item", function(e) {

            e.preventDefault();

            var number = $(this).index();

            sync1.data('owl.carousel').to(number, 300, true);

        });



    };



    $('body').on('click', '#listjewelleryData .addtomyfavorite,#jewellerydetailmodal .addtomyfavorite', function() {

        var jewelleryid = $(this).attr('data-jewelleryid');

        var isselect = 0;

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

        formdata.append("action", "addjewellerytofavorite");

        formdata.append("jewelleryid", jewelleryid);

        formdata.append("isselect", 0);

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>jewellery', formdata, headersdata, Onsuccessaddjewellerytofavorite, OnErroraddjewellerytofavorite);



        function Onsuccessaddjewellerytofavorite(data) {

            var JsonData = JSON.stringify(data);

            var resultdata = jQuery.parseJSON(JsonData);

            if (resultdata.status == 0) {

                Notiflix.Notify.Failure(resultdata.message);

            } else if (resultdata.status == 1) {

                Notiflix.Notify.Success(resultdata.message);

                if (resultdata.isaddtofavorite == 1) {

                    $('.myfavoriteitem' + jewelleryid + ' i').removeClass('far');

                    $('.myfavoriteitem' + jewelleryid + ' i').addClass('fas');

                } else {

                    $('.myfavoriteitem' + jewelleryid + ' i').addClass('far');

                    $('.myfavoriteitem' + jewelleryid + ' i').removeClass('fas');

                }

            }else if(resultdata.status == -1)

            {

                $('#btnlogout').trigger('click');

            }

            $('#listjewelleryData').attr('data-nextpage', 0);

            $("#listjewelleryData").animate({

                scrollTop: 0

            }, "slow");

            listjewellerydata(1);

        }



        function OnErroraddjewellerytofavorite(content) {

            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);

        }

    });



    $('.res-btn-set').click(function(){

        if($(".widthset").hasClass("width-mobile-set"))

        {

            $('.widthset').removeClass('width-mobile-set'); 

        }

        else{

            $('.widthset').addClass('width-mobile-set'); 

        }

        

    });





    // FOR PLAN UPGRADE & RENEW

    function checkuserlogin(typeid,packageid,btntype){



        if (packageid && typeid && btntype) {

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

            formdata.append("btntype", btntype);

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





</script>

