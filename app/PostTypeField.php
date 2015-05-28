<?php namespace Neutrino;

use Neutrino\AbstractModel;

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
}