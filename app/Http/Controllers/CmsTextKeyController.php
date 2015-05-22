<?php namespace Neutrino\Http\Controllers;

use Neutrino\TextKey;
use Neutrino\TextCategory;
use Neutrino\TextValue;
use Neutrino\Http\Requests;
use Neutrino\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CmsTextKeyController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$textKeys = TextKey::all();
		return view('cms.textKeys.index', compact('textKeys'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		return view('cms.textKeys.create');
	
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$category = TextCategory::where('title', $request->category)->first();
		
		// check if textKey exists or create
		$textKey = TextKey::where('title', $request->title)->first();

		if(! $textKey) {
			$textKey = new TextKey($request->all());
			$category->keys()->save($textKey);
		}

		$textValue = new TextValue($request->all());
		$textValue->language_id = 1;  // TODO: Remove

		$textKey->values()->save($textValue);

		return redirect()->action('CmsTextKeyController@index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return redirect()->action('CmsTextKeyController@edit', [$id]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$textKey = TextKey::findOrfail($id);
		$category = $textKey->category->title;
		$value = $textKey->values()->first()->value;
		return view('cms.textKeys.edit', compact('textKey', 'category', 'value'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$textKey = TextKey::findOrfail($id);
		$textKey->values()->first()->update(["value" => $request->value]);

		return redirect()->action('CmsTextKeyController@index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		return 'text keys destroy';

	}

}
