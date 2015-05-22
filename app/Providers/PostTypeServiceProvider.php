<?php namespace Neutrino\Providers;

use Neutrino\PostType;
use Illuminate\Support\ServiceProvider;

class PostTypeServiceProvider extends ServiceProvider {

	const POST_TYPE_FILE = '/config/json/post_types.json';
	
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->preloadPostTypes();
	}

	private function preloadPostTypes()
    {
        $postTypeJson	= file_get_contents(base_path() . self::POST_TYPE_FILE);
        $postTypes  	= json_decode($postTypeJson, true);
        
        // build json check
        // ..
        
        if(is_array($postTypes['post_types']))
        {
            foreach($postTypes['post_types'] as $rawPostType)
            {
                PostType::addToCollection(new PostType($rawPostType));
			}
        }
    }
}
