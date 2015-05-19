<?php namespace Neutrino;

use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'post_meta';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['post_id', 'key', 'value'];

}
