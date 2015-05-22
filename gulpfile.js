var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
	
	/***** WEBSITE / FRONTEND *****/
	
	elixir.config.assetsDir = 'resources/assets/website/';
    //mix.less('app.less');
    
    /***** CMS / BACKEND *****/
    
    elixir.config.assetsDir = 'resources/assets/cms/';
    
    mix.styles([
	    'libraries/bootstrap.min.css',
	    'libraries/font-awesome.min.css',
	    'libraries/form-validation.min.css'
    ], 'public/cms/css/libraries.css');
    
    mix.less('app.less', 'public/cms/css');
        
    mix.scripts([
	    'libraries/jquery-1.11.2.min.js',
	    'libraries/bootstrap.min.js',
	    'libraries/form-validation.min.js',
	    'libraries/form-validation-bootstrap.min.js',
	    'libraries/jquery.hotkeys.min.js'
    ], 'public/cms/js/libraries.js');
    
    mix.copy('resources/assets/cms/images', 'public/cms/images');
    mix.copy('resources/assets/cms/fonts', 'public/cms/fonts');
});
