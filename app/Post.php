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

	public function getMeta($key)
	{
		$postMetaCollection = PostMeta::where('post_id', $this->id)->where('key', $key)->get();
		
		return (isset($postMetaCollection->first()->value)) ? $postMetaCollection->first()->value : null;
	}
}
