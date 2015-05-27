<?php namespace Neutrino\Http\Controllers;

use Auth;
use Neutrino\User;
use Neutrino\Role;
use Neutrino\Http\Requests;
use Neutrino\Http\Controllers\Controller;
use Neutrino\Exceptions\ValidationException;
use Neutrino\Services\Validation\UserValidator;


use Illuminate\Http\Request;

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
		$user = new User($request->all());

		try {
			$this->_userValidator->validate( $user->toArray());
			$user->save();

			} catch ( ValidationException $e ) {
				return redirect()->action('CmsUserController@create')->withErrors($e->get_errors());
		}

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
		return redirect('cms/users/'.$id.'/edit');
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
	public function update(Requests\UserRequest $request, $id)
	{
		$user = User::findOrFail($id);

		// try {
		// 	$this->_userValidator->validate( $request->all());
		// 	dd('success');
		// 	} catch ( ValidationException $e ) {
		// 		dd($e->get_errors());
		// }


		// $user->update($request->all());

		return redirect('cms/users');
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

		return redirect('cms/users');
	}

}
