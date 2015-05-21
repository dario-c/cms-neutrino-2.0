<?php namespace Neutrino;

use Illuminate\Database\Eloquent\Model;

class TextValue extends Model {

	/**
	 * A TextValue has a TextKey (belongs to a TextKey)
	 *
	 * @var array
	 */
	public function key()
	{
		return $this->belongsTo('Neutrino\TextKey', 'text_key_id');
	}

	/**
	 * A TextValue has a TextLanguage (belongs to a TextLanguage)
	 *
	 * @var array
	 */
	public function language()
	{
		return $this->belongsTo('Neutrino\TextLanguage', 'text_language_id');
	}
}
