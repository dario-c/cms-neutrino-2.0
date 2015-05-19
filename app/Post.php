<?php namespace Neutrino;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	/**
	 * A Role has many users
	 *
	 * @var array
	 */

	public function user()
	{
		return $this->belongsTo('Neutrino\User');
	}

}
