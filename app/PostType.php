<?php namespace Neutrino;

use Neutrino\AbstractModel;
use Illuminate\Database\Eloquent\Collection;

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
}
