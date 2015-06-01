<?php namespace Neutrino\Components;
	
class TextFieldComponent extends AbstractComponent {
	
    
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
            (isset($parameters['length']) && is_numeric($parameters['length'])) ? 'max'.$parameters['length'] : null
        );
    }
}