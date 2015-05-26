<?php namespace Neutrino;

use Illuminate\Database\Eloquent\Model;

class TextKey extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['title', 'text_category_id'];

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

	/**
	 * Returns the TextValue for a particular language
	 *
	 * @param int $language_id (default: null)
	 * @var array
	 */
	public function valueForLanguage($language_id = null)
	{
		return $this->values->where('language_id', $language_id)->first()->value;
	}
}
