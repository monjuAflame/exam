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
mix.js('resources/js/exam/script.js', 'public/js/exam/script.js')
    .js('resources/js/app.js', 'public/js')
    .styles('resources/css/main.css', 'public/css/main.css')
    .styles('resources/css/exam/style.css', 'public/css/exam/style.css')
    .styles('resources/css/student/style.css', 'public/css/student/style.css')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/adminlte.scss', 'public/css')
    .sass('resources/sass/custom.scss', 'public/css')
    .sourceMaps()
    .version();
    