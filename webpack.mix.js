let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('resources/assets/sass/app.scss', 'public/css')
    .scripts([
        'resources/assets/js/theme/jquery-2.2.0.min.js',
        'resources/assets/js/theme/chosen.min.js',
        'resources/assets/js/theme/magnific-popup.min.js',
        'resources/assets/js/theme/owl.carousel.min.js',
        'resources/assets/js/theme/rangeSlider.js',
        'resources/assets/js/theme/sticky-kit.min.js',
        'resources/assets/js/theme/slick.min.js',
        'resources/assets/js/theme/jquery.jpanelmenu.js',
        'resources/assets/js/theme/tooltips.min.js',
        'resources/assets/js/theme/masonry.min.js',
        'resources/assets/js/theme/jquery.counterup.min.js',
        'resources/assets/js/theme/dropzone.js',
        'resources/assets/js/theme/gmaps_api_v3.min.js',
        'resources/assets/js/theme/waypoints.min.js',
        'resources/assets/js/theme/maps.js',
        'resources/assets/js/theme/infobox.min.js',
        'resources/assets/js/theme/markerclusterer.js',
        'resources/assets/js/theme/hoverintent.js',
        'resources/assets/js/theme/custom.js',
        'resources/assets/js/custom.js',
    ], 'public/js/all.js');
