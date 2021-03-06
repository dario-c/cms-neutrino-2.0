<?php namespace Neutrino;

use Neutrino\AbstractModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Component extends AbstractModel {

	private static $componentCollection;
	private static $templatePath = 'cms/partials/components/';
	
	private $classObject = null;

    protected $fillable = array('type', 'template', 'classname', 'resources');
    
    public function getClass()
    {
	    if($this->classObject == null)
	    {
		    $className = 'Neutrino\Components\\'.$this->classname;
		    
		    $this->classObject = new $className;
	    }
	    
	    return $this->classObject;
    }
    
	public static function addToCollection(Component $component)
	{
		self::$componentCollection = (self::$componentCollection instanceof Collection) ? self::$componentCollection : new Collection;
		
		self::$componentCollection->add($component);
	}
	
	public static function register($type, $template, $classname, array $resources = array())
	{
		$component = new Component(array(
			'type' 		=> $type, 
			'template'	=> $template, 
			'classname'	=> $classname, 
			'resources'	=> $resources
		));
		
		self::addToCollection($component);
	}

	public static function all()
	{
		return self::$componentCollection;
	} 
	
	public static function findByTypeOrFail($type)
	{
		foreach(self::$componentCollection as $item) 
		{	
			if(isset($item->type) && strcasecmp($item->type, $type) == 0) 
	        {
	            return $item;
	        }
	    }

	    throw (new ModelNotFoundException)->setModel(get_called_class());
	}
	
	public static function getTemplatePath()
	{
		return self::$templatePath;
	}
}
