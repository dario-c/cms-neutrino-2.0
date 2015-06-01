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
	        preg_match_all('/\@textkey\((.+)\)/', $view, $matches, PREG_SET_ORDER);
	        
	        foreach($matches as $match)
	        {
		        $values  = $this->getTextKeyValues($match[0]);
		        
		        $textKey = TextKey::findOrAutoCreate($values[0], $values[1], (isset($values[2])) ? $values[2] : null);
        	
				$replace = ($textKey != null) ? $textKey->values->first()->value : $values[1];
				
				$view 	 = str_ireplace($match[0], $replace, $view);
	        }
			
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
    private function getTextKeyValues($match)
    {        	
        $values = (substr(trim($match), 0, 1) == '"') ? str_getcsv($match, ',', '"') : str_getcsv($match, ',', "'");
	
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