<?php namespace Neutrino;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	/**
	 * A Role has many users
	 *
	 * @var array
	 */

	public function users()
	{
		return $this->hasMany('Neutrino\User');
	}

}
