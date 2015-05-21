<?php namespace Neutrino;

use Illuminate\Database\Eloquent\Model;

class TextLanguage extends Model {

	/**
	 * A TextLanguage has many TextValues
	 *
	 * @var array
	 */

	public function values()
	{
		return $this->hasMany('Neutrino\TextValue');
	}
}
