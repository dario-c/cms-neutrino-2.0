<?php namespace Neutrino\Components;
	
class UrlFieldComponent extends AbstractComponent {
	
	/**
	 * Process (modify) the fields before they are stored.
	 * 
	 * @param string $fieldName
	 * @param array $requestParameters
	 * @return array
	 */
	public function process($fieldName, array $requestParameters)
	{		
		$requestParameters[$fieldName] = $this->addScheme($requestParameters[$fieldName]);
		
		return $requestParameters;
	}
	
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
			'url',
			(isset($parameters['contains'])) ? "regex:/^$|".preg_quote( $parameters['contains'], ".")."/" : null
		);
	}
}