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
		$array = [];

		if(isset($id))
		{
			$array['title'] = array( 'required', 'unique:posts,title,'.$id );
			$array['slug'] 	= array( 'required', 'unique:posts,slug,'.$id );
		} 
		else 
		{
			$array['title'] = array( 'required', 'unique:posts,title' );
			$array['slug'] 	= array( 'required', 'unique:posts,slug' );
		}

		self::addRules($array);
	}
} 