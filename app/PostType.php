<?php namespace Neutrino;

use Neutrino\AbstractModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostType extends AbstractModel {

	private static $postTypeCollection;

    protected $fillable = array('name', 'singular_name', 'slug', 'template_slug', 'fields', 'relation', 'parent');
    
    /**
	 * Overwrite the default constructor
	 *
	 * @param  array  $attributes
	 * @return void
	 */
    public function __construct(array $attributes = array())
    {
	    $this->setFields((isset($attributes['fields'])) ? $attributes['fields'] : array());
	    
		if(isset($attributes['fields'])) unset($attributes['fields']);
	    
	    parent::__construct($attributes);
	}
	
    /**
     * Return fields for the authenticated user role 
     * 
     * @param int $pnRoleId (default: Role::USER_ROLE)
     * @return array
     */
    public function getFieldsByRoleId($roleId = Role::ROLE_USER)
    {
        $fields = array();
        
        foreach($this->fields as $field)
        {
            // when roles are empty, not set or role appears in allowed roles, add field to return array
            if(!isset($field->roles) || count($field->roles) == 0 || in_array($roleId, $field->roles))
            {
                $fields[] = $field;
            }
        }
        
        return $fields;
    }
    
    /**
     * Get all (unique) script resources for the post type fields.
     * 
     * @return array
     */
    public function getScripts()
    {
	    return $this->getResourcesByType('script');
	}
	
	/**
     * Get all (unique) style resources for the post type fields.
     * 
     * @return array
     */
    public function getStyles()
    {
	    return $this->getResourcesByType('style');
	}
    
    /**
     * Loop through the post type fields and process one by one through their Component.
     * 
     * @param array $requestData
     * @return array
     */
    public function processFields(array $requestData)
    {
	    foreach($this->fields as $postTypeField)
        {
	        $requestData = Component::findByTypeOrFail($postTypeField->type)->getClass()->process($postTypeField->id, $requestData);
	    }
	    return $requestData;
    }
    
    /**
     * Loop through the post type fields and get the rules one by one through their Component.
     * 
     * @return array
     */
    public function fieldRules()
    {
	    $rules = array();
	    
	    foreach($this->fields as $postTypeField)
        {
	        $rules = array_merge($rules, Component::findByTypeOrFail($postTypeField->type)->getClass()->rules($postTypeField->id, $postTypeField->parameters));
	    }
	    
	    return $rules;
    }
    
    /**
     * Set fields as PostTypeField's.
     * 
     * @param array $fields
     * @return void
     */
    private function setFields($fields)
    {
	   	$fieldsCollection = new Collection();
	   	
	   	foreach($fields as $field)
	   	{
		   	$fieldsCollection->add(new PostTypeField((is_object($field)) ? get_object_vars($field) : $field));
	   	}
	   	
	    $this->setAttribute('fields', $fieldsCollection);
    }

	/**
     * Get all (unique) resources for the post type fields.
     * 
     * @return array
     */
    private function getResourcesByType($type)
    { 
	    $resources = array();
	    
	    foreach($this->fields as $postTypeField)
        {
	        $resources = array_merge($resources, Component::findByTypeOrFail($postTypeField->type)->resources);
	    }

	    return $this->prepareResources($type, $resources);
    }
    
    /**
     * Add assets path to resource by type.
     * 
     * @param array $resources (default: array())
     * @return array
     */
    private function prepareResources($type, array $resources = array())
    {
	    $return = array();
	    
	    foreach($resources as $filename => $filetype)
	    {
		    if($type == $filetype)
		    {
		    	$return[] = ($type == 'script') ? asset('assets/cms/js/components/'.$filename) : asset('assets/cms/css/components/'.$filename);
		    }
	    }
	    
	    return $return;
    }
    
	/**
	 * Add Post Type to static collection.
	 * 
	 * @static
	 * @param PostType $postType
	 * @return void
	 */
	public static function addToCollection(PostType $postType)
	{
		self::$postTypeCollection = (self::$postTypeCollection instanceof Collection) ? self::$postTypeCollection : new Collection;
		
		self::$postTypeCollection->add($postType);
	}

	/**
	 * Get all Post Types from static collection.
	 * 
	 * @static
	 * @return Collection
	 */
	public static function all()
	{
		return self::$postTypeCollection;
	} 
	
	/**
	 * Find Post Type by Name or Fail from static collection.
	 * 
	 * @static
	 * @return PostType
	 */
	public static function findByNameOrFail($postTypeName)
	{
		foreach(self::$postTypeCollection as $item) 
		{	
			if(isset($item->name) && strcasecmp($item->name, $postTypeName) == 0) 
	        {
	            return $item;
	        }
	    }
	    
	    throw new NotFoundHttpException; //throw (new ModelNotFoundException)->setModel(get_called_class());
	}
}
