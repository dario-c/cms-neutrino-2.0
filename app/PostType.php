<?php namespace Neutrino;

use App/AbstractModel;

class PostType extends AbstractModel {

    public function __construct(array $attributes = array())
    {
        this->fill($attributes);
    }
    
    /**
     * Return fields for the authenticated user role 
     * 
     * @access public
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

}
