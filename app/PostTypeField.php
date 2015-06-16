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
		$source = $this->parameter('source');

		$options = ($source['type'] == "given") ?  $source['data'] :  self::getOptionsList($source);

		return $options;
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

	private function getOptionsList($source)
	{
		$options = ($source['type'] == "model") ? self::fetchModelList($source['data']) : self::fetchPostTypeList($source['data']);
		return $options;
	}

	private function fetchModelList($data, $attribute="title")
	{
		$modelList = "Neutrino\\".$data['model_name']."::lists";

		return (call_user_func("$modelList", $attribute, 'id'));
	}

	private function fetchPostTypeList($data)
	{
		return Post::where('type','directors')->lists("title", "id");
	}
}