<?php namespace Neutrino\Http\Controllers;

use View;
use Auth;
use Neutrino\Post;
use Neutrino\PostType;
use Neutrino\Http\Requests;
use Neutrino\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CmsPostTypeController extends Controller {

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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($postTypeName)
	{
		$postType = PostType::findByNameOrFail($postTypeName);
		$posts 	  = Post::where('type', '=', $postType->name)->paginate(20); // needs to be config
		
		return $this->getView('index', compact('posts', 'postType'), $postType->singular_name);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($postTypeName)
	{
		$postType 		= PostType::findByNameOrFail($postTypeName);
		$postTypeFields = $postType->getFieldsByRoleId(Auth::user()->role->id);
        
        return $this->getView('create', compact('postType', 'postTypeFields'), $postType->singular_name); 
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		// store post
		$post = Post::create($request->all());
	
		// Add post meta storing
		// ..
			
		return redirect('cms/users');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string $postTypeName
	 * @param  int  $id
	 * @return Response
	 */
	public function show($postTypeName, $id)
	{
		return redirect('cms/'.$postTypeName.'/'.$id.'/edit');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($postTypeName, $id)
	{
		$postType 		= PostType::findByNameOrFail($postTypeName);
		$postTypeFields = $postType->getFieldsByRoleId(Auth::user()->role->id);
		$post			= Post::findOrFail($id);
        
        return $this->getView('edit', compact('postType', 'postTypeFields', 'post'), $postType->singular_name);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{		
		$postType 	= PostType::findByNameOrFail($postTypeName);
		$post 		= Post::findOrFail($id);

		$post->update($request->all());

		// Add post meta storing
		// ..
		
		return redirect('cms/users');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($postTypeName, $id)
	{
		$postType 	= PostType::findByNameOrFail($postTypeName);
		$post 		= Post::findOrFail($id);

		$post->delete();
		
		// delete post meta
		// ..

		return redirect('cms/'.$postTypeName);
	}
	
	/**
	 * getView function.
	 * 
	 * @param mixed $action
	 * @param $with $affix (default: '')
	 * @return View
	 */
	private function getView($action, $with, $affix = '')
	{
		if(View::exists('cms.posts.'.$action.'_'.$affix))
		{
		    return View::make('cms.posts.'.$action.'_'.$affix)->with($with);
		}
		
		return View::make('cms.posts.'.$action)->with($with); 
	}
}
