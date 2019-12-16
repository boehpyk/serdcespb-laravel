const $ = require('jquery');
require('slick-carousel');

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
