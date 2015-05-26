<?php namespace Neutrino;
	
abstract class AbstractModel {

	/**
	 * attributes
	 * 
	 * @var array
	 */
	protected $attributes = array();
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = array();
	
	/**
	 * Create a new instance which extends AbstractModel.
	 *
	 * @param  array  $attributes
	 * @return void
	 */
    public function __construct(array $attributes = array())
    {
        $this->fill($attributes);
    }
    
    protected function fill(array $attributes)
    {
	    foreach ($this->fillableFromArray($attributes) as $key => $value)
		{
			// The developers may choose to place some attributes in the "fillable"
			// array, which means only those attributes may be set through mass
			// assignment to the model, and all others will just be ignored.
			if ($this->isFillable($key))
			{
				$this->setAttribute($key, $value);
			}
			elseif ($totallyGuarded)
			{
				throw new MassAssignmentException($key);
			}
		}

		return $this;
    }
	
	/**
	 * Get an attribute from the model.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function getAttribute($key)
	{
		$inAttributes = array_key_exists($key, $this->attributes);

		// If the key references an attribute, we can just go ahead and return the
		// plain attribute value from the model. This allows every attribute to
		// be dynamically accessed through the _get method without accessors.
		if ($inAttributes) // || $this->hasGetMutator($key))
		{
			return $this->getAttributeValue($key);
		}

		// If the key already exists in the relationships array, it just means the
		// relationship has already been loaded, so we'll just return it out of
		// here because there is no need to query within the relations twice.
		if (array_key_exists($key, $this->relations))
		{
			return $this->relations[$key];
		}

		// If the "attribute" exists as a method on the model, we will just assume
		// it is a relationship and will load and return results from the query
		// and hydrate the relationship's value on the "relationships" array.
		if (method_exists($this, $key))
		{
			return $this->getRelationshipFromMethod($key);
		}
	}
	
	/**
	 * Set a given attribute on the model.
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @return void
	 */
	public function setAttribute($key, $value)
	{	
		$this->attributes[$key] = $value;
	}
	
	/**
	 * Determine if the given attribute may be mass assigned.
	 *
	 * @param  string  $key
	 * @return bool
	 */
	public function isFillable($key)
	{
		if (in_array($key, $this->fillable)) return true;

		return empty($this->fillable) && ! starts_with($key, '_');
	}
	
	/**
	 * Get a plain attribute (not a relationship).
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	protected function getAttributeValue($key)
	{
		$value = $this->getAttributeFromArray($key);

		return $value;
	}
	
	/**
	 * Get an attribute from the $attributes array.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	protected function getAttributeFromArray($key)
	{
		if (array_key_exists($key, $this->attributes))
		{
			return $this->attributes[$key];
		}
	}
	
	/**
	 * Get the fillable attributes of a given array.
	 *
	 * @param  array  $attributes
	 * @return array
	 */
	protected function fillableFromArray(array $attributes)
	{
		if (count($this->fillable) > 0)
		{
			return array_intersect_key($attributes, array_flip($this->fillable));
		}

		return $attributes;
	}
	
	/**
	 * Dynamically retrieve attributes on the model.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function __get($key)
	{
		return $this->getAttribute($key);
	}
	
	/**
	 * Dynamically set attributes on the model.
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @return void
	 */
	public function __set($key, $value)
	{
		$this->setAttribute($key, $value);
	}
	
	/**
	 * Determine if an attribute exists on the model.
	 *
	 * @param  string  $key
	 * @return bool
	 */
	public function __isset($key)
	{
		return (isset($this->attributes[$key])); // || ($this->hasGetMutator($key) && ! is_null($this->getAttributeValue($key)));
	}
}