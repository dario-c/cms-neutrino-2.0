<?php namespace Neutrino;

use Neutrino\AbstractModel;
use Illuminate\Database\Eloquent\Collection;

class Resource extends AbstractModel {

	private static $enqueuedViews 	= array();
	private static $enqueuedStyles 	= array();
	private static $enqueuedScripts = array();

    protected $fillable = array();
    
    public static function enqueueView($view)
	{
		self::$enqueuedViews[] = $view;
	}
	
	public static function enqueueStyle($style)
	{
		self::$enqueuedStyles[] = $style;
	}
	
	public static function enqueueScript($script)
	{
		self::$enqueuedScripts[] = $script;
	}
	
	public static function getViews()
	{
		return array_unique(self::$enqueuedViews);
	}
	
	public static function getStyles()
	{
		return array_unique(self::$enqueuedStyles);
	}
	
	public static function getScripts()
	{
		return array_unique(self::$enqueuedScripts);
	}
}
