<?php namespace Neutrino;

use Neutrino\AbstractModel;
use Illuminate\Http\Request;

class PostTypeField extends AbstractModel {

    protected $fillable = array('id', 'title', 'placeholder', 'type', 'parameters', 'source', 'post_type');

	public function template()
	{
		return Component::getTemplatePath() . Component::findByTypeOrFail($this->type)->template;
	}
	
	public function parameter($key, $default = '')
	{
		return (isset($this->parameters[$key])) ? $this->parameters[$key] : $default;
	}
	
	public function save($postId, Request $request)
	{
		$fields = Component::findByTypeOrFail($this->type)->getClass()->fields($this->id);
		
		foreach($fields as $field)
		{
			$postMeta = PostMeta::create(array(
				'post_id'	=> $postId,
				'key'		=> $field,
				'value'		=> $request->input($field, '')
			));
		}
	}
}