<?php namespace Neutrino;

use Illuminate\Database\Eloquent\Model;

class TextKey extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['title'];

	/**
	 * A TextKey has a TextCategory (belongs to a TextCategory)
	 *
	 * @var array
	 */
	public function category()
	{
		return $this->belongsTo('Neutrino\TextCategory', 'text_category_id');
	}

	/**
	 * A TextKey has many TextValues
	 *
	 * @var array
	 */

	public function values()
	{
		return $this->hasMany('Neutrino\TextValue');
	}
}
