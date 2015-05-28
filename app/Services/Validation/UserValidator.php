<?php
 
namespace Neutrino\Services\Validation;

class UserValidator extends Validator {
 
	/**
	 * @var array Validation rules for the test form, they can contain in-built Laravel rules or our custom rules
	 */
	protected $rules = array(
		'name' => array( 'required', 'min:3', 'unique:users' ),
		// 'email' => array( 'required', 'email', 'unique:users,email'),
		'role_id' => array('required', 'numeric', 'exists:roles,id')
	);
} 