<?php namespace Neutrino\Components;
	
class CheckboxComponent extends AbstractComponent {

	/**
	 * Process (modify) the fields before they are stored.
	 * 
	 * @param string $fieldName
	 * @param array $requestParameters
	 * @return array
	 */
	public function process($fieldName, array $requestParameters)
	{		
		if(isset($requestParameters[$fieldName])) $requestParameters[$fieldName] = implode(',', $requestParameters[$fieldName]);

		return $requestParameters;
	}
}