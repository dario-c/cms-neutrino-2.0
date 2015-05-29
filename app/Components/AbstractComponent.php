<?php namespace Neutrino\Components;
	
abstract class AbstractComponent implements ComponentContract {
	
	protected $fields = array();
	
	public function __construct() {  }
	
	/**
	 * Get Component Fields.
	 * When a component consists of multiple fields, an affix can be added to the $fieldName.
	 * 
	 * @param string $fieldName
	 * @return array
	 */
	public function fields($fieldName)
    {
      	$fields = array();
      
      	foreach($this->fields as $field)
        {
          	$fields[] = $fieldName.$field;
        }
      
      	return (count($fields) > 0) ? $fields : array($fieldName);
    }
	
  	/**
  	 * Process (modify) the fields before they are stored.
  	 * 
  	 * @param string $fieldName
  	 * @param array $requestParameters
  	 * @return array
  	 */
  	public function process($fieldName, array $requestParameters)
    {
      	return $requestParameters;
    }
	
    /**
     * Get the rules to validate the field(s).
     * 
     * @param string $fieldName
     * @param array $parameters (default: array())
     * @return array
     */
    public function rules($fieldName, array $parameters = array())
    {
      	$rules  = array();
      	$fields = $this->fields($fieldName);
      
      	foreach($fields as $field)
        {
          	$rules[$field] = array_filter($this->getRulesFromParameters($parameters)); // not sure yet to use implode('|', array_filter($this->getRulesFromParameters($parameters)))
        }
      
      	return $rules;
    }
    
    /**
     * Get rules from parameters.
     * 
     * @param array $parameters (default: array())
     * @return array
     */
    protected function getRulesFromParameters(array $parameters = array())
    {
	    return array(
            (isset($parameters['required']) && $parameters['required'] == false) ? null : 'required'
        );
    }
}