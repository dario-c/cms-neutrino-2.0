<?php
 
namespace Neutrino\Services\Validation;

class UserValidator extends Validator {
 
	/**
	 * @var array Validation rules for the test form, they can contain in-built Laravel rules or our custom rules
	 */
	protected $rules = array(
		'role_id' => array( 'required', 'numeric', 'exists:roles,id' ),
	);

	/**
	 * Add different set of rules depending on if we know the user's id or we are creating a new one
	 *
	 * @param string $id 
	 * @return Void
	 */
	public function setRules($id = null)
	{
		$array = [];

		if(isset($id))
		{
			$array['name']		= array( 'required', 'min:3', 'unique:users,name,'.$id );
			$array['email'] 	= array( 'required', 'email', 'unique:users,email,'.$id );
			$array['password'] 	= array( 'null_or_min:6' );

		} 
		else 
		{
			$array['name']  	= array( 'required', 'min:3', 'unique:users,name' );
			$array['email'] 	= array( 'required', 'email', 'unique:users,email' );
			$array['password'] 	= array( 'required', 'min:6' );

		}

		self::addRules($array);
	}
} 