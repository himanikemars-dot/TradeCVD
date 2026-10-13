(function($) {
    "use strict";

    /*=============================================
      =            menu sticky and scroll to top            =
      =============================================*/

    /*----------  Menu sticky ----------*/

    var windows = $(window);
    var screenSize = windows.width();
    var sticky = $(".header-sticky");
    var stickyAbsolute = $(".header-sticky--absolute");
    var $html = $("html");
    var $body = $("body");

    windows.on("scroll", function() {
        var scroll = windows.scrollTop();
        var headerHeight = sticky.height();
        var headerHeightAbsolute = stickyAbsolute.height();

        // if (screenSize >= 768) {
            if (scroll < headerHeight) {
                sticky.removeClass("is-sticky");
            } else {
                sticky.addClass("is-sticky");
            }

            if (scroll < headerHeightAbsolute) {
                stickyAbsolute.removeClass("is-sticky--absolute");
            } else {
                stickyAbsolute.addClass("is-sticky--absolute");
            }
        // }
    });

    /*----------  Scroll to top  ----------*/

    function scrollToTop() {
        var $scrollUp = $("#scroll-top"),
            $lastScrollTop = 0,
            $window = $(window);

        $window.on("scroll", function() {
            var st = $(this).scrollTop();
            if (st > $lastScrollTop) {
                $scrollUp.removeClass("show");
            } else {
                if ($window.scrollTop() > 200) {
                    $scrollUp.addClass("show");
                } else {
                    $scrollUp.removeClass("show");
                }
            }
            $lastScrollTop = st;
        });

        $scrollUp.on("click", function(evt) {
            $("html, body").animate({ scrollTop: 0 }, 600);
            evt.preventDefault();
        });
    }

    scrollToTop();

    /*=====  End of menu sticky and scroll to top  ======*/

    windows.on("load", function() {
        /*=============================================
            =            preloader active            =
            =============================================*/
        setTimeout(function() {
            $(".preloader-activate").removeClass("preloader-active");
        }, 1000);
        /*=====  End of preloader active  ======*/
    });

    /*=============================================
      =            background image            =
      =============================================*/

    var bgSelector = $(".bg-img");
    bgSelector.each(function(index, elem) {
        var element = $(elem),
            bgSource = element.data("bg");
        element.css("background-image", "url(" + bgSource + ")");
    });

    /*=====  End of background image  ======*/

    /*=============================================
      =            mobile menu active            =
      =============================================*/

    $(".mobile-navigation-icon").on("click", function() {
        $("#mobile-menu-overlay").toggleClass("active");
        $(this).toggleClass("active");
        $body.toggleClass("no-overflow");
    });

    $("#mobile-menu-close-trigger").on("click", function() {
        $("#mobile-menu-overlay").removeClass("active");
        $(".mobile-navigation-icon").removeClass("active");
        $body.removeClass("no-overflow");
    });

    /*=====  End of mobile menu active  ======*/

    /*=============================================
      =            offcanvas mobile menu            =
      =============================================*/

    var $offCanvasNav = $(".offcanvas-navigation"),
        $offCanvasNavSubMenu = $offCanvasNav.find(".sub-menu");

    /*Add Toggle Button With Off Canvas Sub Menu*/
    $offCanvasNavSubMenu
        .parent()
        .prepend('<span class="menu-expand"><i></i></span>');

    /*Close Off Canvas Sub Menu*/
    $offCanvasNavSubMenu.slideUp();

    /*Category Sub Menu Toggle*/
    $offCanvasNav.on("click", "li a, li .menu-expand", function(e) {
        var $this = $(this);
        if (
            $this
            .parent()
            .attr("class")
            .match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/) &&
            ($this.attr("href") === "#" || $this.hasClass("menu-expand"))
        ) {
            e.preventDefault();
            if ($this.siblings("ul:visible").length) {
                $this.parent("li").removeClass("active");
                $this.siblings("ul").slideUp();
            } else {
                $this.parent("li").addClass("active");
                $this
                    .closest("li")
                    .siblings("li")
                    .removeClass("active")
                    .find("li")
                    .removeClass("active");
                $this.closest("li").siblings("li").find("ul:visible").slideUp();
                $this.siblings("ul").slideDown();
            }
        }
    });

    /*=====  End of offcanvas mobile menu  ======*/



    /*=============================================
      =            light gallery active            =
      =============================================*/

    $(".video-popup").lightGallery();
    $(".image-popup").lightGallery({
        selector: ".single-gallery-thumb"
    });

    /*=====  End of light gallery active  ======*/

    /*=============================================
      =            counter up active            =
      =============================================*/

    $(".counter").counterUp({
        delay: 10,
        time: 1000
    });

    /*=====  End of counter up active  ======*/

    /*=============================================
      =            overlay menu            =
      =============================================*/

    /*Variables*/
    var $verticalCollapsibleMenu = $("#vertical-collapsible-menu"),
        $verticalCollapsibleSubMenu = $verticalCollapsibleMenu.find(".sub-menu");

    /*Close Off Canvas Sub Menu*/
    $verticalCollapsibleSubMenu.slideUp();

    /*Category Sub Menu Toggle*/
    $verticalCollapsibleMenu.on("click", "li a", function(e) {
        var $this = $(this);
        if ($this.siblings(".sub-menu").length) {
            e.preventDefault();
            if ($this.siblings("ul:visible").length) {
                $this.siblings("ul").slideUp();
            } else {
                $this.closest("li").siblings("li").find("ul:visible").slideUp();
                $this.siblings("ul").slideDown();
            }
        }
    });

    $("#overlay-menu-icon").on("click", function() {
        $("#overlay-navigation-menu")
            .removeClass("overlay-navigation-inactive")
            .addClass("overlay-navigation-active");
    });

    $("#overlay-menu-close-icon").on("click", function() {
        $("#overlay-navigation-menu")
            .removeClass("overlay-navigation-active")
            .addClass("overlay-navigation-inactive");
    });

    /*=====  End of overlay menu  ======*/

    /*=============================================
      =            ajax contact form active            =
      =============================================*/

    /*=============================================
      =            isotope active            =
      =============================================*/

    // var activeId = $(".project-filter-menu li");
    // $(".project-isotope").isotope();

    // activeId.on("click", function () {
    //   var $this = $(this),
    //     filterValue = $this.data("filter");

    //   $(".project-isotope").isotope({
    //     filter: filterValue,
    //     layoutMode: "fitRows",
    //     hiddenStyle: {
    //       opacity: 0
    //     },
    //     visibleStyle: {
    //       opacity: 1
    //     }
    //   });

    //   activeId.removeClass("active");
    //   $this.addClass("active");
    // });

    /*=====  End of isotope active  ======*/
})(jQuery);