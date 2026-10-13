var product = $('.ps-product--detail');
if (product.length > 0) {
    $('.ps-product__gallery').lightGallery({
        selector: '.item a',
        thumbnail: true,
        share: false,
        fullScreen: false,
        autoplay: false,
        autoplayControls: false,
        actualSize: false
    });
    if (product.hasClass('ps-product--sticky')) {
        $('.ps-product__thumbnail').lightGallery({
            selector: '.item a',
            thumbnail: true,
            share: false,
            fullScreen: false,
            autoplay: false,
            autoplayControls: false,
            actualSize: false
        });
    }
}
$('.ps-gallery-image').lightGallery({
    selector: '.ps-gallery-item',
    thumbnail: true,
    share: false,
    fullScreen: false,
    autoplay: false,
    autoplayControls: false,
    actualSize: false
});
$('.ps-video').lightGallery({
    thumbnail: false,
    share: false,
    fullScreen: false,
    autoplay: false,
    autoplayControls: false,
    actualSize: false
});



$('#sliderItemDetails').owlCarousel({
    loop: false,
    nav: true,
    dots: false,
    margin: 0,
    autoplay: true,
    responsive: {
        0: {
            items: 1
        },
        576: {
            items: 1
        },
        768: {
            items: 1
        },
        992: {
            items: 1
        },
        1200: {
            items: 1
        }
    }
});