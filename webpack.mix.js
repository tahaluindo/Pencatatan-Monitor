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
mix.webpackConfig({
    resolve: {
        alias: {
             'jquery': path.join(__dirname, 'node_modules/jquery/src/jquery')
        }
    }
});
mix.js([
	'resources/js/bootstrap.bundle.min.js',
	'resources/js/app.js'
	], 'public/js/app.js').version()
    .styles([
    	'resources/css/bootstrap.min.css'
    	], 'public/css/app.css').version();
