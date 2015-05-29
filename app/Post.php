<?php namespace Neutrino;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	const STATE_DRAFT 		= 0;
	const STATE_PUBLISHED 	= 1;
	const STATE_DELETED		= 4; // reserved 2 and 3 for other states
	
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
	
	/**
	 * Get title of the state.
	 * 
	 * @return string
	 */
	public function stateTitle()
	{
		switch($this->state)
		{
			case self::STATE_DRAFT: return 'Draft';
			case self::STATE_PUBLISHED: return 'Published';
			case self::STATE_DELETED: return 'Deleted';
			default: return 'Draft';
		}
	}

	/**
	 * Get meta value by post_id and key.
	 * 
	 * @param string $key
	 * @return mixed
	 */
	public function getMeta($key)
	{
		$postMetaCollection = PostMeta::where('post_id', $this->id)->where('key', $key)->get();
		
		return (isset($postMetaCollection->first()->value)) ? $postMetaCollection->first()->value : null;
	}
}
