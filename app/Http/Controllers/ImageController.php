<?php namespace Neutrino\Http\Controllers;
	
use Image;
use Config;
use Neutrino\MediaFile;
use Neutrino\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImageController extends Controller {
	
	private $uploadPath = '';
	private $uploadUrl	= '';
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->uploadPath 	= public_path().'/uploads/cache/';
		$this->uploadUrl	= url().'/uploads/cache/';
	}

	public function show($option, $id, $extension = 'jpg')
	{
		$this->checkIfCached($option, $id);
		
		$file 	 = $this->findFileOrFail($id);

		$image = Image::make($file->link);
		$image = $this->applyChanges($image, $this->findChanges($option));
					
		$this->cacheImage($option, $id, $image, (isset($changes[3])) ? intval($changes[3]) : 70);
		
		return $image->response($extension);
	}
	
	private function checkIfCached($option, $id)
	{
		$filename = md5($option.'_'.$id);
			
		// if image exists, show image and die, else continue
		if(file_exists($this->uploadPath.$filename)) 
		{
			$imginfo = getimagesize($this->uploadPath.$filename);
			
			header('Content-Type: image/jpeg');
		    header('Content-type: '.$imginfo['mime']);
		    
		    echo file_get_contents($this->uploadPath.$filename);
		    exit();
		}
	}
	
	private function findFileOrFail($id)
	{
		if(!$file = MediaFile::find($id))
		{
			throw new NotFoundHttpException();
		}
		
		return $file;
	}
		
	private function findChanges($option)
	{
		$imageOptions = Config::get('media.image_options', array('thumbnail' => array(200, 200, true, 70, 'center')));
		
		if(!isset($imageOptions[strtolower($option)]))
		{
			throw new NotFoundHttpException(); // could not find option
		}
		
		if(count($imageOptions[strtolower($option)]) < 2)
		{
			throw new NotFoundHttpException(); // not a valid value for the option
		}
		
		return $imageOptions[$option];
	}	
	
	private function applyChanges($image, $changes)
	{
		if(isset($changes[2]) && $changes[2] === true)
		{	
			return $image->fit($changes[0], $changes[1], function ($constraint) {
			    $constraint->upsize();
			}, (isset($changes[4])) ? $changes[4] : 'center');
		}
		
		return $image->resize($changes[0], $changes[1], function ($constraint) {
		    $constraint->aspectRatio();
		    $constraint->upsize();
		});
	}
	
	private function cacheImage($option, $id, $image, $quality = 70)
	{
		$filename = md5($option.'_'.$id);
		
		// create cache folder if not exists
		if(!file_exists($this->uploadPath)) 
		{
		    mkdir($this->uploadPath, 0777, true);
		}
		
		$image->save($this->uploadPath.$filename, $quality);
	}
}