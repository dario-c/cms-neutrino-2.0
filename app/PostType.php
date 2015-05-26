<?php namespace Neutrino;

use Neutrino\AbstractModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostType extends AbstractModel {

	private static $postTypeCollection;

    protected $fillable = array('name', 'singular_name', 'slug', 'template_slug', 'fields', 'relation', 'parent');
    
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

	public static function addToCollection(PostType $postType)
	{
		self::$postTypeCollection = (self::$postTypeCollection instanceof Collection) ? self::$postTypeCollection : new Collection;
		
		self::$postTypeCollection->add($postType);
	}

	public static function all()
	{
		return self::$postTypeCollection;
	} 
	
	public static function findByNameOrFail($postTypeName)
	{
		foreach(self::$postTypeCollection as $item) 
		{	
			if(isset($item->name) && strcasecmp($item->name, $postTypeName) == 0) 
	        {
	            return $item;
	        }
	    }
	    
	    throw new NotFoundHttpException;
	    //throw (new ModelNotFoundException)->setModel(get_called_class());
	}
}
