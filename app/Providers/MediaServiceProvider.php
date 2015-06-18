<?php namespace Neutrino\Providers;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Register 'underlyingclass' instance container to our UnderlyingClass object
        $this->app['media'] = $this->app->share(function($app)
        {
            return new \Neutrino\Media;
        });

        // Shortcut so developers don't need to add an Alias in app/config/app.php
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Media', 'Neutrino\Facades\Media');
        });
    }
}