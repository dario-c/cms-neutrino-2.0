<?php namespace Neutrino\Http\Controllers;

use View;
use Auth;
use Config;
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
		$files = array(); // get files
		
		return view('cms.partials.media.files', compact('files'));
	}
	
}