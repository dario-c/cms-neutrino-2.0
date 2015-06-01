<?php namespace Neutrino\Providers;

use Neutrino\TextKey;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Debug\Exception\FatalErrorException;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /* @textkey($key, $default, [$category]) */
        \Blade::extend(function($view, $compiler)
        {
	        // get values from pattern
        	/*$values = $this->getTextKeyValues($view);
						
			$textKey = TextKey::findOrAutoCreate($values[0], $values[1], (isset($values[2])) ? $values[2] : null);
        	
        	return preg_replace("/(?<!\w)@textkey(\s*\(.*)\)/", ($textKey != null) ? $textKey->values->first()->value : 'hello', $view);*/
        	return $view;
        });
    }

    public function register()
    {
        //
    }
    
    /**
     * Get values from with extended field.
     * 
     * @access private
     * @param string $view
     * @return array
     */
    private function getTextKeyValues($view)
    {
	    preg_match('/\@textkey\((.+)\)/', $view, $matches);
        	
        $values = (substr(trim($matches[1]), 0, 1) == '"') ? str_getcsv($matches[1], ',', '"') : str_getcsv($matches[1], ',', "'");
	
		if(!is_array($values) || count($values) < 2 || count($values) > 3) 
		{
			throw new FatalErrorException('Invalid use of @textkey function pass 2 or 3 parameters.', -1, -1, __FILE__, __LINE__);
		}
		
		return $this->trimSlashes($values);
    }
    
    /**
     * Trim single and double quotes from strings in the given array.
     * 
     * @access private
     * @param array $values
     * @return array
     */
    private function trimSlashes($values)
    {
		foreach($values as $index => $value)
		{
			$values[$index] = stripslashes($value); //preg_replace('/^([\'"])(.*)\\1$/', '\\2', trim($value));
		}
		
		return $values;
    }
}