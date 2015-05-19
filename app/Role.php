<?php namespace Neutrino;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	const ROLE_USER = 1;

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
