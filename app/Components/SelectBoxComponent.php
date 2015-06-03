<?php namespace Neutrino\Components;
	
class SelectBoxComponent extends AbstractComponent {
	
	/**
	 * Overwrite getRulesFromParameters function.
	 * 
	 * @param array $parameters (default: array())
	 * @return array
	 */
	protected function getRulesFromParameters($field, array $parameters = array())
	{
		return array(
			(isset($parameters['required']) && $parameters['required'] == false) ? null : 'required'
		);
	}
}