<?php namespace Neutrino\Http\Controllers;

use Auth;
use Mail;
use Neutrino\Http\Requests;
use Illuminate\Http\Request;
use Neutrino\Http\Controllers\Controller;
use Neutrino\Exceptions\ValidationException;

class CmsEmailController extends Controller {

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
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('emails.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function send(Request $request)
	{		
		$name = $request->name;
		$random = $request->random;


		Mail::send('emails.template', compact('name', 'random'), function($message)
		{
			$message->from('suchawesome@neutrino.com', 'Neutrino');
			$message->to('foo@example.com', 'John Smith')->subject('Welcome!');
		});

		return view('emails.template', compact('name', 'random'));
	}
}
