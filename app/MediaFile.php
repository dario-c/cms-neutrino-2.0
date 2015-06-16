<?php namespace Neutrino;

use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'link', 'thumbnail', 'type', 'width', 'height', 'caption'];
	
	public static function createAndReturnImage($link, $size)
	{
		return ''; // stub
	}

}
