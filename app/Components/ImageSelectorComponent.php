<?php namespace Neutrino\Components;
	
class ImageSelectorComponent extends AbstractComponent {
	
    
    /**
     * Overwrite getRulesFromParameters function.
     * 
     * @param array $parameters (default: array())
     * @return array
     */
    protected function getRulesFromParameters($field, array $parameters = array())
    {
      	return array(
            (isset($parameters['required']) && $parameters['required'] == false) ? null : 'required',
            'integer',
        	'exists:media_files,file_id'
        );
    }
}