$(document).ready(function () {
    if ($("body").hasClass("homepage2")) {
        var videoBlockHeight = $(".device-video").outerHeight();
        $(window).scroll(function () {
            var button = $(".homepage2 .schedule-box");
            var scrollTop = $(window).scrollTop();
            if (scrollTop > videoBlockHeight) {
                if (!button.hasClass("active")) {
                    $(".homepage2 .schedule-box").addClass("active");
                }
            } else {
                $(".homepage2 .schedule-box").removeClass("active");
            }
        });
    }
    // $('#counter-01').counterUp({
    //     delay: 10,
    //     time: 1000
    // });
    // $('#counter-02').counterUp({
    //     delay: 10,
    //     time: 1000
    // });
    // $('#counter-03').counterUp({
    //     delay: 10,
    //     time: 1000
    // });
    // $('#counter-04').counterUp({
    //     delay: 10,
    //     time: 1000
    // });
});

;;;

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
$(document).ready(function () {
    if (typeof redirectUrl != 'undefined' && getCookie("language") == '') {
        if (window.location.href.indexOf(redirectUrl) == -1) {
            window.location.href = redirectUrl;
        }
    }
    $(".lng-item").on("click", function (e) {
        setCookie("language", "true", 30);
    });
    $(".page_1146,a[href$='#chat']").on("click", function (e) {
        e.preventDefault();
        dataLayer.push({
            'event': 'trackerReady',
            'OnetrustActiveGroups': '3',
            'eventCallback': function () {
                Intercom('show');
            }
        });
        return false;
    });
    var bannerVersion = "" + $(".banner-close").data("version");
    if (getCookie("banner") !== bannerVersion) {
        $(".banner-block").removeClass("hidden");
    }
    $(".banner-close").on("click", function () {
        $(".banner-block").hide();
        setCookie("banner", bannerVersion, 365);
    });
    $(".questions-section .question").on('click', function (e) {
        if ($(this).hasClass("open")) {
            $(this).removeClass("open");
        } else {
            $(this).addClass("open");
        }
    })
    /* $(".box-plan .plan-heading").matchHeight(); */
    /* $(".box-plan .plans-text").matchHeight(); */ $('.plans-headline .nav-pills li a, .second-solutions .nav-pills li a').click(function () {
        if ($(this).parent().attr('id') == 'years-price') {
            $('.price.years').removeClass('hidden');
            $('.price.month').addClass('hidden');
            $('.button-save').removeClass('hidden');
            $('.label-year').addClass('hidden');
            $('.solution-second .plan-box').removeClass('month');
            $(".plans-list .plan-box").matchHeight();
            $('.plans-for-registration .box-plan').addClass('month');
            $(".plans-list .box-plan .middle-part").matchHeight();
        } else {
            $('.price.month').removeClass('hidden');
            $('.price.years').addClass('hidden');
            $('.button-save').addClass('hidden');
            $('.label-year').removeClass('hidden');
            $('.solution-second .plan-box').addClass('month');
            $(".plans-list .plan-box").matchHeight();
            $('.plans-for-registration .box-plan').addClass('month');
            $(".plans-list .box-plan .middle-part").matchHeight();
        }
    });
    $(window).on("scroll touchmove", function () {
        var bannerHeight = 0;
        if ($('.banner-block').length > 0) {
            if (!$(".banner-block").hasClass("hidden")) {
                bannerHeight = $('.banner-block').height();
            }
        }
        $('#header').toggleClass('scrolled', $(document).scrollTop() > bannerHeight);
    });
    if ($('.image-section').length == 0 && $('.benefits-section').length > 0) {
        $('.benefits-section .container').css("padding-top", "0");
    }
    $('[data-scroll]').click(function () {
        var next = $(this).closest('section').next().attr("id");
        $(this).attr("href", "#" + next);
        $('html, body').animate({
            scrollTop: ($($.attr(this, 'href')).offset().top - 82)
        }, 500);
        return false;
    });
    if ($('#SnapABug_Button').length > 0) {
        $('#SnapABug_Button').attr("data-category", "Homepage");
        $('#SnapABug_Button').attr("data-label", "Chat");
    }
    $('[data-category]').each(function () {
        var price = "";
        $(this).on("click", function () {
            var label = $(this).data("label");
            if ($(this).hasClass("apply-button")) {
                price = $(this).closest(".plan-box").find(".price").not('.hidden').data("price");
                label = $(this).data("label") + ", " + price;
            }
            dataLayer.push({
                'event': 'GAEvent',
                'eventCategory': $(this).data("category"),
                'eventAction': 'Click',
                'eventLabel': label,
                'eventValue': undefined
            });
        });
    });
    var period = getUrlVars()["period"];
    if (period == "Monthly" && $("#month-price").length > 0) {
        $("#month-price a").each(function () {
            $(this).trigger("click");
        });
    } else if ($("#years-price").length > 0) {
        $("#years-price a").each(function () {
            $(this).trigger("click");
        });
    }
});

function getUrlVars() {
    var vars = [],
        hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
$(document).ready(function () {
    var totalHeight = $(".mobile-image-block").height();
    var height = totalHeight - 150;
    var $buttons = $('.btns.btns-mobile');
    var $tooltip = $('.homePage .tooltip-red');
    if ($tooltip.length) {
        height = height - ($tooltip.height() + 30);
    }
    $buttons.css({
        "top": height
    });
    $(window).scroll(function () {
        if ($(window).width() < 567) {
            if ($(window).scrollTop() >= 100) {
                $('.btns.btns-mobile').css({
                    "top": ""
                });
                $('.btns.btns-mobile').css({
                    "padding-bottom": "20px"
                });
                $('.btns.btns-mobile').addClass("btns-liner-gradient");
                $('.homePage .tooltip-red').hide();
            } else {
                $buttons.css({
                    "top": height
                });
                $('.btns.btns-mobile').removeClass("btns-liner-gradient");
                $('.homePage .tooltip-red').show();
            }
        } else {
            $('.btns.btns-mobile').css({
                "padding-bottom": ""
            });
            $('.btns.btns-mobile').css({
                "top": height
            });
            $('.btns.btns-mobile').removeClass("btns-liner-gradient");
        }
    });
    $(function () {
        $(window).on('hashchange', function (e) {
            var hash = window.location.hash;
            if (hash.includes("testemonial")) {
                $('html, body').animate({
                    scrollTop: $(hash).offset().top - 200
                }, 1000);
            } else {
                $('.del-03 a[href="' + hash + '"]').tab('show');
                if (hash) {
                    closeMobileMenue();
                }
            }
        });
        var hash = window.location.hash;
        if (hash) {
            $(window).trigger("hashchange");
        }
    });
});
$(".show-icon-save").click(function () {
    $(".save20-ico.annually").css("display", "block");
    $(".save20-ico.month").css("display", "none");
});
$(".hide-icon-save").click(function () {
    $(".save20-ico.annually").css("display", "none");
    $(".save20-ico.month").css("display", "block");
});
$(document).ready(function () {
    if (!$("#fixedMobile").length == 0 && $(window).width() <= 768) {
        var scrollTop = $(window).scrollTop();
        var stickyNavHeight = $("#fixedMobile").offset().top
        $(window).on("scroll touchmove", function () {
            $('#fixedMobile').toggleClass('sticky-mobile', $(document).scrollTop() > stickyNavHeight);
        });
    }
});
// $('.modal').on($.modal.OPEN, function (event, modal) {
//     $(".sticky-mobile").css("z-index", 0);
// });
// $('.modal').on($.modal.CLOSE, function (event, modal) {
//     $(".sticky-mobile").css("z-index", 1000);
// });
$('.modal').on('modal:open', function (event, modal) {
    $(".sticky-mobile").css("z-index", 0);
});

$('.modal').on('modal:close', function (event, modal) {
    $(".sticky-mobile").css("z-index", 1000);
});

// Check if the object exists before accessing .OPEN
// if (myConnection && myConnection.readyState === myConnection.OPEN) {
//     // Your logic here
// }

// Or, if referencing the constructor's constant (e.g., WebSocket.OPEN),
// ensure the constructor is available in the current scope.
function closeMobileMenue() {
    if ($(document).width() <= 991) {
        console.log("closing mobile menue");
        $('body').removeClass('open-menu');
        $('body').removeClass('stop-scrolling');
        $('.block #main-nav').removeClass('scroll-main-nav');
        $('#main-nav').slideUp(300);
        $('.intercom-launcher-frame').css("z-index", "100");
    };
    return false;
}

function secondFooterForm() {
    var submittedMessage = $('#footer').find($(".submitted-message")).clone();
    $(".second-footer-form-title").html(submittedMessage);
    $('#second-footer-form').modal();
}
$(document).ready(function () {
    $('html').addClass("csstransitions");
    appear({
        elements: function elements() {
            return document.getElementsByClassName('appear');
        },
        appear: function appear(el) {
            var item = $(el);
            item.addClass('visible-element');
            setTimeout(function () {
                item.find('.img').css('opacity', '1')
            }, 400);
        },
        bounds: 0,
        reappear: false
    });
    $('.tabs-toggle-js').click(function () {
        blockHeight();
    });
    $('.plans-list .plan-box').matchHeight();
    anchorTabs();
    if (window.location.hash && $('.tabs-toggle-js').length > 0) {
        $('.tabs-toggle-js ' + window.location.hash).tab('show');
    }
});
$(window).resize(function () {
    setRightOffsetRequestBox();
    if ($(window).width() > 974 && $("body").hasClass("open-menu")) {
        $(".btn-menu").click();
    }
});

function anchorTabs() {
    if ($('.tabs-toggle-js').length > 0) {
        var anchor = $('.links li a');
        anchor.click(function () {
            var href = $(this).attr('href')
            var linkTab = $('.tabs-toggle-js ' + href);
            linkTab.tab('show');
        });
    }
}

function toggleTabs() {
    $('.tabs-toggle-js').each(function (e) {
        var $this = $(this);
        setTimeout(function () {
            $this.find('li').eq(1).find('a').tab('show');
            blockHeight();
        }, 6000);
        setTimeout(function () {
            $this.find('li').eq(0).find('a').tab('show');
            blockHeight();
        }, 8000);
    });
}

function blockHeight() {
    $('.tabs-toggle-js a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $('.solution-list li .solution-item').matchHeight();
        $('.solution-list li .solution-item .descr').matchHeight();
    });
}

function getRequestBoxWidth() {
    el = $('.request-box');
    return el.outerWidth();
}

function setRightOffsetRequestBox() {
    el = $('body:not(.open-request) .request-box');
    el.css('margin-right', '-' + getRequestBoxWidth() + 'px');
}
window.addEventListener('DOMContentLoaded', function () {
    new ModalVideo(".js-video-btn", {
        autoplay: 1
    });
});

function TabContentAnchor() {
    $('html, body').animate({
        scrollTop: $(".tab-content").offset().top - 200
    }, 2000);
}
$("#applications-counter-close").click(function () {
    event.preventDefault();
    $(".applications-counter-tooltip").css("opacity", 0);
});;;
var processing = false;
$(document).ready(function () {
    if ($(window).width() <= 767) {
        SetMobileItemsCount(".shape-group", ".filter.custom-checkbox")
        SetMobileItemsCount(".color-group", ".filter.custom-checkbox")
        SetMobileItemsCount(".flu-group", ".filter.custom-checkbox")
        SetMobileItemsCount(".lab-group", ".filter.custom-checkbox")
    }
    SetGroupRange(".color-group");
    SetGroupRange(".clarity-group");
    SetGroupRange(".flu-group");
    /* $(".show-more-filters").click(function () {
        $(this).parent().find(".filter-container").toggleClass("show-more-container");
        $(this).toggleClass("show-more-open");
    }); */
    /* $(".show-more-link").click(function () {
        $(this).toggleClass("show-more-open");
    }); */
    $(".shape-group input, .color-group input").change(function () {
        var shapeItem = $('.shape-group input:checkbox:checked');
        var colorItem = $('.color-group input:checkbox:checked');
        if (shapeItem.length > 0 && colorItem.length > 0) {
            $("#free-search-container .btn-primary.send-btn").attr("disabled", false);
        } else {
            $("#free-search-container .btn-primary.send-btn").attr("disabled", true);
        }
    });
    $('.form-btns input[type="submit"],.form-btns button[type="submit"').click(function () {
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

function SetMobileItemsCount(groupSelector, selector) {
    if ($(selector, groupSelector).length) {
        var count = 0;
        $(selector, groupSelector).each(function () {
            if ($(this)[0].offsetTop > 0) {
                count++;
            }
        });
    }
}

function SetGroupRange(groupSelector) {
    $("input", groupSelector).change(function () {
        var checkedChekboxes = $('input:checkbox:checked', groupSelector).length;
        var firstCheckbox = $('input:checkbox:checked:first', groupSelector).parent().index();
        var lastCheckbox = $('input:checkbox:checked:last', groupSelector).parent().index();
        if (checkedChekboxes >= 2) {
            $("input", groupSelector).each(function () {
                $(this).prop("checked", false);
            });
            for (var i = firstCheckbox; i <= lastCheckbox; i++) {
                $(".custom-checkbox:eq(" + i + ") input", groupSelector).prop("checked", true);
            }
        }
    });
}
// function LoadData(model) {
//     $("body").addClass("show-results"); $("#wrapper").bind("mousewheel", function () { return false; }); $.ajax({
//         url: "/umbraco/surface/FreeSearch/FreeSearchResultDesktop", type: "POST", dataType: 'json', data: model, contentType: 'application/json; charset=utf-8', complete: function (data) {
//             processing = false; var pageNumber = $("#free-search-container").data("pageNumber"); if (pageNumber == 1) {
//                 $(data.responseText).insertAfter("#free-search-container"); $("#free-search-container,.free-search-page h1.animated-title, .free-search-page h3.animated-title, .free-search-page .title-section .container").css("display", "none"); $(".title-section").addClass("free-search-section"); if ($(window).height() < 825) { $("#free-search-result .table-responsive").css("height", $(window).height() - 235 + "px"); $("#free-search-result .table-responsive tbody").css("max-height", $(window).height() - 235 - 100 + "px"); }
//                 $('html,body').animate({ scrollTop: $("#free-search-result").offset().top - 150 }, 400); $(".back-link").click(function () { event.preventDefault(); $("#free-search-container, .free-search-page h1.animated-title, .free-search-page h3.animated-title, .free-search-page .title-section .container").css("display", "block"); $("#free-search-container").data("pageNumber", 1); $(".title-section").removeClass("free-search-section"); $("#free-search-result").remove(); $('html,body').animate({ scrollTop: $("#free-search-container").offset().top - 100 }, 400); $(window).off('scroll'); $("body").removeClass("show-results"); }); $('#free-search-result table tbody').on('scroll', function () { if ($(this).scrollTop() + $(this).innerHeight() + 50 >= $(this)[0].scrollHeight && !processing) { processing = true; $(".loader").css("display", "block"); LoadData(PickData()); } })
//             } else { $(data.responseText).insertAfter("#free-search-result table tbody tr:last"); $(".number-result .current-count").text($(".elements-count:last").data("number")); }
//             $(".loader").css("display", "none"); $("#free-search-container").data("pageNumber", +$("#free-search-container").data("pageNumber") + 1); $("#wrapper").unbind("mousewheel")
//         }
//     });
// }
function loadData() {
    $(".btn-primary.load-more").remove();
    LoadDataMobile(PickData());
}

function LoadDataMobile(model) {
    $("body").addClass("show-results");
    $.ajax({
        url: "/umbraco/surface/FreeSearch/FreeSearchResultMobile",
        type: "POST",
        dataType: 'json',
        data: model,
        contentType: 'application/json; charset=utf-8',
        complete: function (data) {
            var pageNumber = $("#free-search-container").data("pageNumber");
            if (pageNumber == 1) {
                $(data.responseText).insertAfter("#free-search-container");
                $("#free-search-container, h1.animated-title, h3.animated-title").css("display", "none");
                $('html,body').animate({
                    scrollTop: $("#free-search-result").offset().top - 50
                }, 400);
                $(".back-link").click(function () {
                    event.preventDefault();
                    $("#free-search-container, h1.animated-title, h3.animated-title").css("display", "block");
                    $("#free-search-container").data("pageNumber", 1);
                    $("#free-search-result").remove();
                    $('html,body').animate({
                        scrollTop: $("#free-search-container").offset().top - 100
                    }, 400);
                    $("body").removeClass("show-results");
                });
            } else {
                $(data.responseText).insertAfter("#free-search-result .mobile-table-cell .result-mobile-container:last");
                $(".number-result .current-count").text($(".elements-count:last").data("number"));
            }
            $(".loader").css("display", "none");
            $("#free-search-container").data("pageNumber", +$("#free-search-container").data("pageNumber") + 1);
        }
    });
}

function PickData() {
    var shapes = [];
    var sizeFrom = "";
    var sizeTo = "";
    var colors = [];
    var clarity = [];
    var cutFrom = "";
    var cutTo = "";
    var polishFrom = "";
    var polishTo = "";
    var symmetryFrom = "";
    var symmetryTo = "";
    var fluorescences = [];
    var lab = [];
    $(".shape-group input:checked").each(function () {
        shapes.push($.trim($(this).val()));
    });
    sizeFrom = $("#sizeFrom").val();
    sizeTo = $("#sizeTo").val();
    $(".color-group input:checked").each(function () {
        colors.push($.trim($(this).parent().find("label").text()));
    });
    $(".clarity-group input:checked").each(function () {
        clarity.push($.trim($(this).parent().find("label").text()));
    });
    cutFrom = $('.cut-group [name="cutFrom"]').val();
    cutTo = $('.cut-group [name="cutTo"]').val();
    polishFrom = $('.polish-group [name="polishFrom"]').val();
    polishTo = $('.polish-group [name="polishTo"]').val();
    symmetryFrom = $('.symmetry-group [name="symmetryFrom"]').val();
    symmetryTo = $('.symmetry-group [name="symmetryTo"]').val();
    $(".flu-group input:checked").each(function () {
        fluorescences.push($.trim($(this).val()));
    });
    $(".lab-group input:checked").each(function () {
        lab.push($.trim($(this).parent().find("label").text()));
    });
    var data = {
        'shapes': shapes,
        'sizeFrom': sizeFrom,
        'sizeTo': sizeTo,
        'colors': colors,
        'clarity': clarity,
        'cutFrom': cutFrom,
        'cutTo': cutTo,
        'polishFrom': polishFrom,
        'polishTo': polishTo,
        'symmetryFrom': symmetryFrom,
        'symmetryTo': symmetryTo,
        'fluorescences': fluorescences,
        'lab': lab,
        'showItems': $("#free-search-container").data("showItems"),
        'pageNumber': $("#free-search-container").data("pageNumber")
    }
    return JSON.stringify({
        'model': data
    });
};;;