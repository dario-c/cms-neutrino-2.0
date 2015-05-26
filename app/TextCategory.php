<?php namespace Neutrino;

use Illuminate\Database\Eloquent\Model;

class TextCategory extends Model {

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
