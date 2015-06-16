<?php namespace Neutrino\Http\Controllers;

use View;
use Auth;
use Neutrino\MediaFile;
use Neutrino\Http\Requests;
use Neutrino\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CmsMediaFilesController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function index()
	{
		$files = MediaFile::all();
		
		return view('cms.partials.media.files', compact('files'));
	}
	
}