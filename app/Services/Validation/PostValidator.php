<?php
 
namespace Neutrino\Services\Validation;

class PostValidator extends Validator {
 
	/**
	 * @var array Validation rules for the test form, they can contain in-built Laravel rules or our custom rules
	 */
	protected $rules = array(
		'title' => array( 'required' ),
		'slug'	=> array( 'required' ),
		'state'	=> array( 'numeric' )
	);
} 