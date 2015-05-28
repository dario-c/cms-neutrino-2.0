<?php
 
namespace Neutrino\Services\Validation;

class TextKeyValidator extends Validator {
 
	/**
	 * @var array Validation rules for the test form, they can contain in-built Laravel rules or our custom rules
	 */
	public $rules = array(
		'title' => array( 'required', 'alpha_dash', 'min:5', 'unique:text_keys' ),
		'text_category_id' => array( 'required', 'numeric', 'exists:text_categories,id'),
	);
 
} 