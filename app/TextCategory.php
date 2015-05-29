<?php namespace Neutrino;

use Illuminate\Database\Eloquent\Model;

class TextCategory extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['title'];
	
	/**
	 * A TextCategory has many TextKeys
	 *
	 * @var array
	 */

	public function keys()
	{
		return $this->hasMany('Neutrino\TextKey');
	}
}
