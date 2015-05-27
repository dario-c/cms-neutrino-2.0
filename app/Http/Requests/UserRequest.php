<?php namespace Neutrino\Http\Requests;

use Neutrino\Http\Requests\Request;

class UserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => array( 'required', 'alpha_dash', 'min:3', 'unique:users' ),
			'email' => array( 'required', 'email', 'unique:users,email' ),
			'role_id' => array('required', 'numeric')
		];
	}

}
