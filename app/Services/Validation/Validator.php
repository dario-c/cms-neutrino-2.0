<?php
 
namespace Neutrino\Services\Validation;
 
use Illuminate\Validation\Factory as IlluminateValidator;
use Neutrino\Exceptions\ValidationException;
 
/**
 * Base Validation class. All entity specific validation classes inherit
 * this class and can override any function for respective specific needs
 */
abstract class Validator {
 
    /**
     * @var Illuminate\Validation\Factory
     */
    protected $_validator;

    /**
     * @var array()
     */
    protected $rules = array();
     
     /**
      * Create a new Validator instance
      *
      * @return void
      */
    public function __construct( IlluminateValidator $validator )
    {
        $this->_validator = $validator;
    }
    
    /**
     * Validate input and redirect to given action if any errors
     *
     * @param array $data
     * @param array $rules
     * @param array $custom_errors
     * @return Boolean OR Error
     */
    public function validate( array $data, array $rules = array(), array $custom_errors = array() )
    {
        if ( empty( $rules ) && ! empty( $this->rules ) && is_array( $this->rules ) ) {
            //no rules passed to function, use the default rules defined in sub-class
            $rules = $this->rules;
        }
 
        //use Laravel's Validator and validate the data
        $validation = $this->_validator->make( $data, $rules, $custom_errors );
 
        if ( $validation->fails() ) {
            //validation failed, throw an exception
            throw new ValidationException( $validation->messages() );
        }
 
        //all good and shiny
        return true;
    }

    /**
     * Validate input and redirect to given action if any errors
     *
     * @param array $inputs
     * @param $string action
     * @param array $parameters
     * @return Response OR void
     */
    public function validateOrRespond(array $inputs, $action, array $parameters = array()) 
    {
        try 
        {
            $this->validate( $inputs );
        } 
        catch ( ValidationException $e ) 
        {
            $response = redirect()->action($action, $parameters)->withErrors($e->get_errors())->withInput();
            \Session::driver()->save();
            $response->send();
            exit();
        }
    }

    /**
     * Add new rules to the validator
     *
     * @param array $rules
     * @return void
     */
    public function addRules(array $rules)
    {
        $this->rules = array_merge($this->rules, $rules);
    }
}