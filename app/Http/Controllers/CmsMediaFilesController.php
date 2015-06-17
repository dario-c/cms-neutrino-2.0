<?php namespace Neutrino\Http\Controllers;

use Image;
use Config;
use Neutrino\Facades\Media;
use Neutrino\MediaFile;
use Neutrino\Http\Requests;
use Illuminate\Http\Request;
use Neutrino\Http\Controllers\Controller;

class CmsMediaFilesController extends Controller {

	private $uploadPath = '';
	private $uploadUrl	= '';
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		
		$this->uploadPath 	= public_path().'/uploads/';
		$this->uploadUrl	= url().'/uploads/';
	}
	
	/**
	 * Get all media files.
	 * 
	 * @access public
	 * @return Response
	 */
	public function index()
	{
		$files = MediaFile::all();
		
		return view('cms.partials.media.files', compact('files'));
	}
	
	/**
	 * Upload a file
	 *
	 * @return JsonResponse
	 */
	public function store(Request $request)
	{
		$file = $request->file('uploadfile');
		
		$uniqueFileName = $this->getUniqueFilename(preg_replace('/\s+/', '_', urldecode($file->getClientOriginalName())));
		
		return $this->handleImage($file, $uniqueFileName);
	}
	
	/**
	 * Get upload progress (not sure if needed)
	 *
	 * @return JsonResponse
	 */
	public function progress()
	{
		if(!isset($_REQUEST['progresskey'])) 
        {
            exit(json_encode(array('success' => false)));
        }
            
        $laStatus = apc_fetch('upload_'.$_REQUEST['progresskey']);
                    
        $lnPct  = 0;
        $lnSize = 0;
        
        if(is_array($laStatus)) 
        {
            if(array_key_exists('total', $laStatus) && array_key_exists('current', $laStatus)) 
            {
                if ($laStatus['total'] > 0) 
                {
                    $lnPct = round(($laStatus['current'] / $laStatus['total']) * 100);
                    $lnSize = round($laStatus['total'] / 1024);
                }
            }
        }

        return response()->json(['success' => true, 'pct' => $lnPct, 'size' => $lnSize]);
	}

	/**
	 * Generate unique filename for uploaded image.
	 * 
	 * @param string $fileName
	 * @return string
	 */
	private function getUniqueFilename($fileName)
    {
        $index         = 1;
        $newFilename   = $fileName;
        $pathParts     = pathinfo($fileName);
        
        while(file_exists($this->uploadPath.$newFilename))
        {
            $newFilename = $pathParts['filename'].'_'.$index.'.'.$pathParts['extension'];
            $index++;
        }
        
        return $newFilename;
    }
    
    /**
     * Handle image upload, resizing, validating and saving
     * 
     * @access private
     * @param UploadedFile $file
     * @param string $destination
     * @return Response
     */
    private function handleImage($file, $filename)
	{
		try
		{
			// get memory limit
			$memoryLimit = ini_get('memory_limit');
			
			// temporary set limit higher too handle larger images
			ini_set('memory_limit', '256M'); 
			
			$image = Image::make($file);
			
			$this->validateImage($image);
			$this->saveImageOnDisk($image, $filename);
			$this->addImageToDatabase($image, $filename);
			
			// put back memory limit
			ini_set('memory_limit', $memoryLimit);
			
			return response()->json(['success' => true, 'msg' => 'OK', 'filename' => basename($filename)]);
		}
		catch(Exception $e)
		{
			return response()->json(['success' => false, 'msg' => $e->getMessage()]);
		}
	}
	
	/**
	 * Validate if image or throw error
	 * 
	 * @access private
	 * @param object $file
	 * @return void
	 */
	private function validateImage($image)
	{
		// check mime type
		if(!stristr($image->mime(), 'image'))
		{
			throw new BaseException('Unsafe file, please try to upload a correct file');
		}
		
		// check file size
		if($image->filesize() > Config::get('max_file_size', 5000000))
		{
			throw new BaseException('File is too big, please upload a smaller file');
		}
	}
	
	/**
	 * Save image after max resize to disk.
	 * 
	 * @param object $image
	 * @param string $destination
	 * @return void
	 */
	private function saveImageOnDisk($image, $filename)
	{
		$image->resize(1920, 1920, function ($constraint) {
		    $constraint->aspectRatio();
		    $constraint->upsize();
		});
		
		$image->save($this->uploadPath.$filename, 80);
	}
	
	/**
	 * Add image to database table.
	 * 
	 * @param object $image
	 * @param string $destination
	 * @return Response
	 */
	private function addImageToDatabase($image, $filename)
	{
		$mediaFile = MediaFile::create(array(
			'name'		=> basename($filename),
			'link'		=> $this->uploadUrl.$filename,
			'type'		=> 'image',
			'width'		=> $image->width(),
			'height'	=> $image->height(),
			'caption'	=> pathinfo($filename, PATHINFO_FILENAME)
		));
		
		$mediaFile->thumbnail = Media::getLink($mediaFile->id, 'thumbnail', '');
		
		$mediaFile->save();
	}
}