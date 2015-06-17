<?php namespace Neutrino;

use Config;
use Neutrino\MediaFile;

class Media {

	private static $lastId 		= null;
	private static $lastObject	= null;
	
	/**
     * Get media object by id.
     * 
     * @param integer $id
     * @return MediaFile
     */
    public function find($id)
    {
	    return $this->getObjectById($id);
    }
    
    /**
     * Get link of a media object by id.
     * Option are defined in config file and can be used to get different sizes of images or formates for videos.
     * 
     * @param integer $id
     * @param string $option (default: '')
     * @param string $default (default: '')
     * @return string
     */
    public function getLink($id, $option = '', $default = '')
    {
	    $object = $this->getObjectById($id);
	    
		if(isset($object))
		{
			$extension 	= pathinfo($object->link, PATHINFO_EXTENSION);
	    	$link 		= ($option != '') ? $this->generateOptionLink($id, $option, $extension) : $object->link;
	    
			return (isset($link)) ? $link : $default;
		}
		
		return $default;
    }
    
    /**
     * Get name of a media object by id.
     * 
     * @param integer $id
     * @param string $default (default: '')
     * @return string
     */
    public function getName($id, $default = '')
    {
	    $object = $this->getObjectById($id);
	    
        return (isset($object)) ? $object->name : $default;
    }
    
    /**
     * Get caption of a media object by id.
     * 
     * @param integer $id
     * @param string $default (default: '')
     * @return string
     */
    public function getCaption($id, $default = '')
    {
	    $object = $this->getObjectById($id);
	    
        return (isset($object)) ? $object->caption : $default;
    }
    
    /**
     * Get a media object, but will first check if the last required object is ask again (caching) for better performance.
     * The caching is only used for the last requested object to keep memory usage low.
     * 
     * @param integer $id
     * @return MediaFile
     */
    private function getObjectById($id)
    {
	    if(self::$lastId == $id)
	    {
		    return self::$lastObject;
	    }
	    
	    self::$lastId = $id;
	    
        return self::$lastObject = MediaFile::find($id);
    }

	/**
	 * Generate image link for dynamical sizes.
	 * 
	 * @access private
	 * @param integer $id
	 * @param string $option
	 * @param string $extension (default: 'jpg')
	 * @return string
	 */
	private function generateOptionLink($id, $option, $extension = 'jpg')
	{
		$imageOptions = Config::get('media.image_options', array('thumbnail' => array(200, 200, true, 70, 'center')));
		
		if(!isset($imageOptions[strtolower($option)]))
		{
			return null;
		}
		
		return url().'/image/'.$option.'/'.$id.'.'.$extension;
	}
}