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

	/**
	 * Add scheme url if not exists
	 * 
	 * @param string $url
	 * @param string $scheme (default: 'http://')
	 * @return string
	 */
	private function addScheme($url, $scheme = 'http://')
	{
		return (parse_url($url, PHP_URL_SCHEME) === null && strlen($url) > 0) ? $scheme . $url : $url;
	}
}