let mix = require('laravel-mix');
const path = require('path');

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


mix.sass('resources/assets/sass/front.scss', 'public/assets/css/styles.css').version();

mix.js('resources/assets/js/front.app.js', 'public/assets/js/front.app.js').version();

mix.scripts([
    'resources/assets/js/vendor/nprogress.js',
    'resources/assets/js/vendor/sweetalert.min.js',
    'resources/assets/js/vendor/emojify.min.js',
    'resources/assets/js/vendor/emoji.js',
    'resources/assets/js/vendor/marked.min.js',
    'resources/assets/js/vendor/monent.min.js',
    'resources/assets/js/vendor/jquery.jscroll.js',
    'resources/assets/js/vendor/jquery.highlight.js',
    'resources/assets/js/main.js'
], 'public/assets/js/styles.js').version();

mix.scripts([
    'resources/assets/js/vendor/inline-attachment.js',
    'resources/assets/js/vendor/codemirror-4.inline-attachment.js',
    'resources/assets/js/vendor/simplemde.min.js',
], 'public/assets/js/editor.js').version();
mix.sass('resources/assets/sass/vendor/simplemde.min.scss', 'public/assets/css/editor.css').version();

mix.webpackConfig({
    resolve: {
        alias: {
            'components': 'assets/js/components',
            'config': 'assets/js/config',
            'lang': 'assets/js/lang',
            'plugins': 'assets/js/plugins',
            'vendor': 'assets/js/vendor',
            'views': 'assets/js/views',
        },
        modules: [
            'node_modules',
            path.resolve(__dirname, "resources")
        ]
    }
});


