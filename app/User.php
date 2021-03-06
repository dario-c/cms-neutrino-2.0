<?php namespace Neutrino;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'role_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * Passwords are hashed when set
	 *
	 * @var array
	 */
	public function setPasswordAttribute($password)
	{
		if(strlen($password) > 0) $this->attributes['password'] = \Hash::make($password);
	}

	/**
	 * Check if a user has Admin role
	 *
	 * @var array
	 * @return boolean
	 */
	public function isAdmin()
	{
		return strcasecmp($this->role->name, 'admin') == 0;
	}

	/**
	 * A user has a Role (belongs to a Role)
	 *
	 * @var array
	 */
	public function role()
	{
		return $this->belongsTo('Neutrino\Role');
	}

}
