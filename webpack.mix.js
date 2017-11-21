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

mix.setPublicPath('public_html/');

mix.js(['resources/assets/js/buttons.js',
       'resources/assets/js/addItem.js'
    ], 'js/app.js').version();

mix.js('resources/assets/js/groceries.js', 'js/');
mix.js('resources/assets/js/history.js', 'js/');
mix.js('resources/assets/js/users.js', 'js/');

mix.sass('resources/assets/sass/login.scss', 'css/')
    .sass('resources/assets/sass/groceries.scss', 'css/')
    .sass('resources/assets/sass/users.scss', 'css/');

mix.copy('resources/assets/css/', 'public_html/css');
mix.copy('resources/assets/images', 'public_html/images', false);
