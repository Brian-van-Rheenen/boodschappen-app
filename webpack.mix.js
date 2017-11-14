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

mix.js('resources/assets/js/groceries.js', 'public_html/js')
   .js('resources/assets/js/history.js', 'public_html/js')
   .js('resources/assets/js/buttons.js', 'public_html/js')
   .js('resources/assets/js/addItem.js', 'public_html/js')
   .sass('resources/assets/sass/login.scss', 'public_html/css')
   .sass('resources/assets/sass/groceries.scss', 'public_html/css')
   .sass('resources/assets/sass/users.scss', 'public_html/css')
   .copy('resources/assets/css/', 'public_html/css')
   .copy('resources/assets/images', 'public_html/images', false);
