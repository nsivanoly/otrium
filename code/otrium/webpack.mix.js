const mix = require('laravel-mix');

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

mix.scripts([
    'public/assets/vendor/jquery/jquery-3.3.1.min.js',
    'public/assets/vendor/bootstrap/js/bootstrap.bundle.js',
    'public/js/csv-form.js',
    'public/js/datatables.min.js',
], 'public/js/app.js')
    .styles([
            'public/assets/vendor/bootstrap/css/bootstrap.min.css',
            'public/assets/vendor/fonts/circular-std/style.css',
            'public/assets/libs/css/style.css',
            'public/assets/libs/css/datatables.min.css',
            'public/assets/vendor/fonts/fontawesome/css/fontawesome-all.css',
            'public/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css'
        ],
        'public/css/app.css');
