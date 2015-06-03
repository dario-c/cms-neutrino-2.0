<?php namespace Neutrino\Components;
	
class DropdownFieldComponent extends AbstractComponent {
	
	/**
	 * Overwrite getRulesFromParameters function.
	 * 
	 * @param array $parameters (default: array())
	 * @return array
	 */
	protected function getRulesFromParameters($field, array $parameters = array())
	{
		$array = (is_array($parameters['source'])) ? self::rulesCustomOptions($parameters) : self::rulesExistingOptions($parameters);
		
		return $array;
	}

	/**
	 * Return array with rules for custom options
	 * 
	 * @param array $parameters (default: array())
	 * @return array
	 */
	private function rulesCustomOptions(array $parameters)
	{
		return array(
				(isset($parameters['required']) && $parameters['required'] == false) ? null : 'required'
			);
	}

	/**
	 * Return array with rules for options in existing table 
	 * 
	 * @param array $parameters (default: array())
	 * @return array
	 */
	private function rulesExistingOptions(array $parameters)
	{
		return array(
				(isset($parameters['required']) && $parameters['required'] == false) ? null : 'required',
				'exists:'.$parameters['table']
			);
	}
}