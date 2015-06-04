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
    ], 'public/assets/cms/css/libraries.css');
    
    mix.less('app.less', 'public/assets/cms/css');
       
    // generatate libraries.js    
    mix.scripts([
	    'libraries/jquery-1.11.2.min.js',
	    'libraries/bentley.js',
	    'libraries/bootstrap.min.js',
	    'libraries/pubsub.js',
	    'libraries/form-validation.min.js',
	    'libraries/form-validation-bootstrap.min.js',
	    'libraries/bootstrap-wysiwyg.min.js',
	    'libraries/jquery.hotkeys.min.js'
    ], 'public/assets/cms/js/libraries.js');
    
    // copy scripts
    mix.copy('resources/assets/cms/js/app.js', 'public/assets/cms/js/app.js');
    mix.copy('resources/assets/cms/js/controllers', 'public/assets/cms/js/controllers');
    mix.copy('resources/assets/cms/js/components', 'public/assets/cms/js/components');
    
    // copy styles
    mix.copy('resources/assets/cms/css/components', 'public/assets/cms/css/components');
    
    // copy images / fonts / other assets
    mix.copy('resources/assets/cms/images', 'public/assets/cms/images');
    mix.copy('resources/assets/cms/fonts', 'public/assets/cms/fonts');
});
