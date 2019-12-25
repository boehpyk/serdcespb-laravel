window.$ = window.jQuery = require('jquery');
require('slick-carousel');
require('@fancyapps/fancybox');

// enable carousel
$('[data-addon="carousel"]').slick({
    dots: false,
    arrows: false,
    infinite: true,
    speed: 800,
    autoplaySpeed: 5000,
    autoplay: true,
    fade: true,
    cssEase: 'linear'
});

$('#show-xs-menu').on('click', function () {
    $('#wrapper').toggleClass('moved');
    if ($('#wrapper').hasClass('moved')) {
        $('#show-xs-menu img').attr('src', '/assets/img/xs-menu-close.svg');
    }
    else {
        $('#show-xs-menu img').attr('src', '/assets/img/xs-menu.svg');
    }
});
