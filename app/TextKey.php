<?php namespace Neutrino;

use Config;
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
	
	public static function findOrAutoCreate($key, $value, $category = null)
	{
		$textCategory 	= (isset($category)) ? TextCategory::firstOrCreate(['title' => $category]) : TextCategory::all()->first();
		$textKey 		= TextKey::whereTitle($key)->first();
		
		$textKey = (!isset($textKey)) ? TextKey::create(array('title' => $key, 'text_category_id' => $textCategory->id)) : $textKey;
		
		if($textKey->values->first() != null)
		{
			return $textKey;
		}
		
		$language_id = Config::get('language_id', 1); // get current language id
		
		$textValue = TextValue::create(array('text_key_id' => $textKey->id, 'language_id' => $language_id, 'value' => $value));
		
		$textKey->values->add($textValue);

		return $textKey;
	}
}
