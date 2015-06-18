<?php
 
namespace Neutrino\Services\Validation;

class PostValidator extends Validator {
 
	/**
	 * @var array Validation rules for the test form, they can contain in-built Laravel rules or our custom rules
	 */
	protected $rules = array(
		'state'	=> array( 'numeric' )
	);

	/**
	 * Add different set of rules depending on if we know the Post's id or we are creating a new one
	 *
	 * @param string $id 
	 * @return Void
	 */
	public function setRules($id = null)
	{
		$rules = [];

		$rules['title'] = array( 'required', (isset($id)) ? 'unique:posts,title,'.$id : 'unique:posts,title');
		$rules['slug'] 	= array( 'required', (isset($id)) ? 'unique:posts,slug,'.$id  : 'unique:posts,slug' );

		self::addRules($rules);
	}
} 