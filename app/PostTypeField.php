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

	/**
	 * Returns true or false depending on 
	 * if two posts are related or not
	 *
	 * @param  string $relation  
	 * @param  integer $postId  
	 * @param  integer $relationId  
	 * @return Boolean
	 */
	public function isRelated($relation, $postId, $relationId)
	{
		$fill = PostRelation::where(['relation'=>$relation, 'post_id'=>$postId, 'related_id'=>$relationId ])->count();

		return ($fill > 0) ? true : false;
	}

	/**
	 * Save the field in the appropriate table
	 *
	 * @param  integer $postId
	 * @param  Request $request
	 * @return void
	 */
	public function save($postId, Request $request)
	{		
		($this->type == 'post_relation' && $this->parameters['multiple']) ? 
			self::saveInPostRelation($postId, $request) :
			self::saveInPostMeta($postId, $request);
	}

	/**
	 * Save the field in the PostMeta table
	 *
	 * @param  integer $postId
	 * @param  Request $request
	 * @return  void
	 */
	private function saveInPostMeta($postId, Request $request){
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

	/**
	 * Save the field in the PostRelation table
	 *
	 * @param  integer $postId
	 * @param  Request $request
	 * @return  void
	 */
	private function saveInPostRelation($postId, Request $request)
	{
		$relationName 		= $this->id;
		$postType			= $request->input('type');
		$values 			= $request->input('_liked_by');
		$relatedPostType 	= $this->attributes['parameters']['source']['data']['related_post'];

		PostRelation::where(['relation' => $relationName, 'post_id' => $postId])->delete();

		foreach($values as $value)
		{
			$postRelation = PostRelation::Create([
				'relation' 		=> $relationName,
				'post_type' 	=> $postType,
				'related_id' 	=> $value,
				'post_id'		=> $postId,
				'related_type'	=> $relatedPostType
				]);
		}
	}

	/**
	 * Return an array with possible options
	 * for checkboxes and selectboxes
	 *
	 * @param  array $source
	 * @return array $options
	 */
	private function getOptionsList(array $source)
	{
		$options = ($source['type'] == "model") ? 
			self::fetchModelList($source['data']) : 
			self::fetchPostTypeList($source['data']);

		return $options;
	}

	/**
	 * Fetch and return an array with options for
	 * checkboxes and selectboxes from a model
	 * with id as key and attibute as value
	 *
	 * @param  array   $data
	 * @param  string  $attribute (default: "title")
	 * @return array
	 */
	private function fetchModelList(array $data, $attribute="title")
	{
		$modelList = "Neutrino\\".$data['model_name']."::lists";

		return (call_user_func("$modelList", $attribute, 'id'));
	}

	/**
	 * Fetch and return an array with options for
	 * checkboxes and selectboxes from a post
	 * with id as key and title as value
	 *
	 * @param  array $data
	 * @return array
	 */
	private function fetchPostTypeList($data)
	{
		return Post::where('type','directors')->lists("title", "id");
	}
}