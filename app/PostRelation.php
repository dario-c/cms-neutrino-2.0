<?php namespace Neutrino;

use Illuminate\Database\Eloquent\Model;

class PostRelation extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'post_relations';


	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['relation', 'post_type', 'post_id', 'related_type', 'related_id'];

}
