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
        $subFields = array(
            'name' => $requestParameters[$fieldName.'_name'],
            'url'  => $this->addScheme($requestParameters[$fieldName.'_url'])
        );

        $requestParameters[$fieldName] = json_encode($subFields);

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
}