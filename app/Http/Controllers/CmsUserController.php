<?php namespace Neutrino\Http\Controllers;

use Auth;
use Neutrino\User;
use Neutrino\Role;
use Neutrino\Http\Requests;
use Illuminate\Http\Request;
use Neutrino\Http\Controllers\Controller;
use Neutrino\Exceptions\ValidationException;
use Neutrino\Services\Validation\UserValidator;

class CmsUserController extends Controller {

	/**
	 * @var Neutrino\Services\Validation\TextKeyValidator
	 */
	protected $_userValidator;


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(UserValidator $userValidator)
	{
		$this->middleware('auth');
		$this->_userValidator = $userValidator;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();

		return view('cms.users.index')->with('users', $users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles = Role::lists('name','id');

		return view('cms.users.create', compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{		
		$this->_userValidator->validateOrRespond($request->all(), 'CmsUserController@create'); 
		User::create($request->all());

		return redirect()->action('CmsUserController@index')->withMessage('User saved successfully!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return redirect()->action('CmsUserController@edit', [$id]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);
		$roles = Role::lists('name','id');

		return view('cms.users.edit', compact('user', 'roles'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$user = User::findOrFail($id);


		$this->_userValidator->validateOrRespond($request->all(), 'CmsUserController@edit', [$id]); 

		$user->update($request->all());

		return redirect()->action('CmsUserController@index')->withMessage( 'Edited Successfully' );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::findOrFail($id);

		$user->delete();

		return redirect()->action('CmsUserController@index')->withMessage( 'Destroyed Successfully' );
	}
}
