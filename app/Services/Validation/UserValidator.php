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
		$rules = [];

		$rules['name']		= array( 'required', 'min:3', (isset($id)) ? 'unique:users,name,'.$id : 'unique:users,name');
		$rules['email'] 	= array( 'required', 'email', (isset($id)) ? 'unique:users,email,'.$id : 'unique:users,email');
		$rules['password'] 	= array( (isset($id)) ? null : 'required', 'null_or_min:6' );

		self::addRules($rules);
	}
} 