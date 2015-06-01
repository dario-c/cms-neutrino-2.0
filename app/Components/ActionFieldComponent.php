<?php namespace Neutrino\Components;
	
class ActionFieldComponent extends AbstractComponent {
	
	protected $field = array('_name', '_url');
		
		/**
		 * Process (modify) the fields before they are stored.
		 * 
		 * @param string $fieldName
		 * @param array $requestParameters
		 * @return array
		 */
		public function process($fieldName, array $requestParameters)
		{
			$urlField = $fieldName.'_url';
			
			$requestParameters[$urlField] = $this->addScheme($requestParameters[$urlField]);
			
				return $requestParameters;
		}
		
		/**
		 * Overwrite getRulesFromParameters function.
		 * 
		 * @param string $field
		 * @param array $parameters (default: array())
		 * @return array
		 */
		protected function getRulesFromParameters($field, array $parameters = array())
		{
			if($this->stringEndsWith($field, '_url'))
			{
			return array(
				(isset($parameters['required']) && $parameters['required'] == false) ? null : 'required',
				'url'
			);    
			}
			
			// else rules for _name
				return array(
						(isset($parameters['required']) && $parameters['required'] == false) ? null : 'required'
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
		return (parse_url($url, PHP_URL_SCHEME) === null) ? $scheme . $url : $url;
	}
}