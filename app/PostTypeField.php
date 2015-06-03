<?php namespace Neutrino;

use Neutrino\Language;
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
		
	public function source()
	{
		if(is_array($this->parameters['source'])) return $this->parameters['source'];

		if(is_string($this->parameters['source'])) return self::getOptionsList($this->parameters['source']);
	}

	public function save($postId, Request $request)
	{
		$fields = Component::findByTypeOrFail($this->type)->getClass()->fields($this->id);
		
		foreach($fields as $field)
		{
			$postMeta = PostMeta::updateOrCreate(array(
				'post_id'	=> $postId,
				'key'		=> $field 
			), array(
				'value'		=> $request->input($field, '')
			));
		}
	}

	private function getOptionsList($modelName, $attribute='title')
	{
		$modelList = "Neutrino\\$modelName::lists";

		return (call_user_func("$modelList", $attribute));
	}
	
}