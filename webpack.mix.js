const mix = require('laravel-mix');
const del = require('del');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
    ]);
// .copy('resources/css/myStyle.css', 'public/css/style.css');

mix.copy('public/css/app.css', 'public/css/temp.css')
    .styles(['resources/css/style.css', 'public/css/temp.css'], 'public/css/app.css');

setTimeout(function () { console.log('test') }, 2000);

del('public/css/temp.css');
