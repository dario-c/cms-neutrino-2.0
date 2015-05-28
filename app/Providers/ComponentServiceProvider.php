<?php namespace Neutrino\Providers;

use Neutrino\Component;
use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider {
	
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerComponents();
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Register components for the CMS
	 * 
	 * @return void
	 */
	private function registerComponents()
    {
	    // try to include, if not exists this project doesn't use components
	    @include_once(app_path('Http/components.php'));
    }
}
