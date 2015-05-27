<?php namespace Neutrino\Http\Controllers;

use Neutrino\TextKey;
use Neutrino\TextCategory;
use Neutrino\TextValue;
use Neutrino\Http\Requests;
use Neutrino\Http\Controllers\Controller;

use Neutrino\Exceptions\ValidationException;
use Neutrino\Services\Validation\TextKeyValidator;
use Neutrino\Services\Validation\TextValueValidator;

use Illuminate\Http\Request;

class CmsTextKeyController extends Controller {

	/**
	 * @var Neutrino\Services\Validation\TextKeyValidator
	 */
	protected $_textKeyValidator;

	/**
	 * @var Neutrino\Services\Validation\TextValueValidator
	 */
	protected $_textValueValidator;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(TextKeyValidator $textKeyValidator, TextValueValidator $textValueValidator)
	{
		$this->middleware('auth');
		$this->_textKeyValidator = $textKeyValidator;
		$this->_textValueValidator = $textValueValidator;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$textKeys = TextKey::all();

		return view('cms.text_keys.index', compact('textKeys'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = TextCategory::lists('title','id');

		return view('cms.text_keys.create', compact('categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$textKey = new TextKey($request->all());


		try {
			$validate_data = $this->_textKeyValidator->validate( $textKey->toArray() );

			$textKey->save();
			$this->storeValue($textKey, $request, 1);


			return redirect()->action('CmsTextKeyController@index')->withMessage( 'Saved Successfully' );;

			} catch ( ValidationException $e ) {

				return redirect()->action('CmsTextKeyController@create')->withErrors( $e->get_errors() );
		}
	}

	/**
	 * Store the TextValue of a given TextKey
	 *
	 * @param  TextKey  $textKey
	 * @param  Request  $request
	 * @param  int  	$language_id (default: null)
	 * @return void
	 */
	public function storeValue(TextKey $textKey, Request $request, $language_id = null)
	{
		$textValue = new TextValue($request->all());
		$textValue->language_id = (isset($language_id)) ? $language_id : Config::get('language_id', 1);

		$textKey->values()->save($textValue);
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
		$textKey 		= TextKey::findOrfail($id);
		$categories 	= TextCategory::lists('title','id');
		$category_id 	= $textKey->text_category_id;
		$value 			= $textKey->values()->first()->value;

		return view('cms.text_keys.edit', compact('textKey', 'category_id', 'value', 'categories'));
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

		$this->updateCategory($textKey, $request->text_category_id);
		$textKey->values()->first()->update(["value" => $request->value]);

		return redirect()->action('CmsTextKeyController@index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateCategory(TextKey $textKey, $category_id)
	{
		$category = TextCategory::findOrfail($category_id);

		$textKey->category()->associate($category);
		$textKey->save();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$textKey = TextKey::findOrfail($id);
		
		$textKey->values->first()->delete();
		$textKey->delete();

		return redirect()->action('CmsTextKeyController@index');
	}

}
