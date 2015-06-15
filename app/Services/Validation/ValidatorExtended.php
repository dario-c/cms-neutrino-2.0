<?php
 
namespace Neutrino\Services\Validation;
 
use Illuminate\Validation\Validator as IlluminateValidator;
 
class ValidatorExtended extends IlluminateValidator {
 
	private $_custom_messages = array(
		"alpha_dash_spaces" => "The :attribute may only contain letters, spaces, and dashes.",
		"alpha_num_spaces" => "The :attribute may only contain letters, numbers, and spaces.",
		"null_or_min" => "The :attribute is too short"
	);
 
	public function __construct( $translator, $data, $rules, $messages = array(), $customAttributes = array() )
	{
		parent::__construct( $translator, $data, $rules, $messages, $customAttributes );
 
		$this->_set_custom_properties();
	}
 
	/**
	 * Setup any customizations etc
	 *
	 * @return void
	 */
	protected function _set_custom_properties()
	{
		//setup our custom error messages
		$this->setCustomMessages( $this->_custom_messages );
	}
 
	/**
	 * Allow only alphabets, spaces and dashes (hyphens and underscores)
	 *
	 * @param string $attribute
	 * @param mixed $value
	 * @return bool
	 */
	protected function validateAlphaDashSpaces( $attribute, $value )
	{
		return (bool) preg_match( "/^[A-Za-z\s-_]+$/", $value );
	}
 
	/**
	 * Allow only alphabets, numbers, and spaces
	 *
	 * @param string $attribute
	 * @param mixed $value
	 * @return bool
	 */
	protected function validateAlphaNumSpaces( $attribute, $value )
	{
		return (bool) preg_match( "/^[A-Za-z0-9\s]+$/", $value );
	}

	/**
	 * Allow only empty strings or at least bigger than the given minimum length
	 *
	 * @param string $attribute
	 * @param mixed $value
	 * @param mixed $minimum
	 * @return bool
	 */
	protected function validateNullOrMin( $attribute, $value, $minimum )
	{
		return (bool) (strlen($value) == 0 || strlen($value) >= $minimum[0]) ? true : false;
	}
 
}