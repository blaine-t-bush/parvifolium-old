const mix = require('laravel-mix');

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
    .js('resources/js/whitehack-char-gen/app.js', 'public/js/whitehack-char-gen.js')
    .js('resources/js/osrs-slayer-tasks/app.js', 'public/js/osrs-slayer-tasks.js')
    .sass('resources/scss/app.scss', 'public/css')
    .sass('resources/scss/home.scss', 'public/css')
    .sass('resources/scss/posts.scss', 'public/css')
    .sass('resources/scss/post.scss', 'public/css')
    .sass('resources/scss/about.scss', 'public/css')
    .sass('resources/scss/resume.scss', 'public/css')
    .sass('resources/scss/portfolio.scss', 'public/css')
    .vue();