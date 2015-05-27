<?php
 
namespace Neutrino\Services\Validation;

class TextValueValidator extends Validator {
 
    /**
     * @var array Validation rules for the test form, they can contain in-built Laravel rules or our custom rules
     */
    public $rules = array(
        'value' => array( 'required', 'alpha_dash', 'max:50', 'unique:text_values' ),
        'language_id' => array( 'required', 'numeric', 'min:20' ),
    );
 
} 