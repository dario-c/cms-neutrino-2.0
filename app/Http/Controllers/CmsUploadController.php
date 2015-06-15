<?php namespace Neutrino\Http\Controllers;
	
use Image;
use Neutrino\Http\Requests;
use Illuminate\Http\Request;
use Neutrino\Http\Controllers\Controller;

class CmsUploadController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
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
		$destination 	= public_path().'/uploads/'.$uniqueFileName;
		
		return $this->handleImage($file, $destination);
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
        
        while(file_exists(public_path().'/uploads/'.$newFilename))
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
    private function handleImage($file, $destination)
	{
		try
		{
			// get memory limit
			$memoryLimit = ini_get('memory_limit');
			
			// temporary set limit higher too handle larger images
			ini_set('memory_limit', '256M'); 
			
			$image = Image::make($file);
			
			$this->validateImage($image);
			$this->saveImageOnDisk($image, $destination);
			$this->addImageToDatabase($image, $destination);
			
			// put back memory limit
			ini_set('memory_limit', $memoryLimit);
			
			return response()->json(['success' => true, 'msg' => 'OK', 'filename' => basename($destination)]);
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
		// check file size
		// check other things if needed
		// else throw error
	}
	
	/**
	 * Save image after max resize to disk.
	 * 
	 * @param object $image
	 * @param string $destination
	 * @return void
	 */
	private function saveImageOnDisk($image, $destination)
	{
		$image->resize(1920, 1920, function ($constraint) {
		    $constraint->aspectRatio();
		    $constraint->upsize();
		});
		
		$image->save($destination, 80);
	}
	
	/**
	 * Add image to database table.
	 * 
	 * @param object $image
	 * @param string $destination
	 * @return Response
	 */
	private function addImageToDatabase($image, $destination)
	{
		// save to database
		
		return response()->json(['success' => true, 'msg' => 'OK', 'filename' => $destination]);
	}
}
