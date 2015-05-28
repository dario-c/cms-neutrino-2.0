<?php
 
namespace Neutrino\Services\Validation;

class TextValueValidator extends Validator {
 
	/**
	 * @var array Validation rules for the test form, they can contain in-built Laravel rules or our custom rules
	 */
	public $rules = array(
		'value' => array( 'required', 'min:5' ),
	);
 
} 
