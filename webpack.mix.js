const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');


mix.styles([
    'resources/css/app.css',
    'resources/css/dashboard.css',
], 'public/css/all.css');


mix.scripts([
    'resources/js/app.js',
    'node_modules/jquery/dist/jquery.min.js',
], 'public/js/all.js');