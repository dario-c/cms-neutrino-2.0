<?php namespace Neutrino;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['title', 'slug', 'state', 'type', ''];
	
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
