<?php namespace Neutrino\Http\Controllers;

use Config;
use Neutrino\TextKey;
use Neutrino\TextValue;
use Neutrino\TextCategory;
use Neutrino\Http\Requests;
use Illuminate\Http\Request;
use Neutrino\Http\Controllers\Controller;
use Neutrino\Exceptions\ValidationException;
use Neutrino\Services\Validation\TextKeyValidator;
use Neutrino\Services\Validation\TextValueValidator;


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
		$this->_textKeyValidator->validateOrRespond($request->all(), 'CmsTextKeyController@create');
				
		$textKey = TextKey::create($request->all());

		$this->storeValue($textKey->id, $request->input('value'));

		return redirect()->action('CmsTextKeyController@index')->withMessage( 'Saved Successfully' );	
	}

	/**
	 * Store the TextValue of a given TextKey
	 *
	 * @param  TextKey  $textKey
	 * @param  Request  $request
	 * @param  int  	$language_id (default: null)
	 * @return void
	 */
	private function storeValue($textKeyId, $value, $language_id = null)
	{
		$this->_textValueValidator->validateOrRespond(['value'=>$value], 'CmsTextKeyController@edit', [$textKeyId]);



		$language_id = (isset($language_id)) ? $language_id : Config::get('language_id', 1);

		$textValue = TextValue::updateOrCreate(array('text_key_id' => $textKeyId, 'language_id' => $language_id), array('value' => $value));
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
		$value 			= (isset($textKey->values()->first()->value)) ? $textKey->values()->first()->value : null;

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

		$this->storeValue($textKey->id, $request->input('value'));

		return redirect()->action('CmsTextKeyController@index')->withMessage( 'Saved Successfully' );
	}

	/**
	 * Update the category of a TextKey
	 *
	 * @param  TextKey  $textKey
	 * @param  int  $category_id
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
		
		$textKey->values()->delete();
		$textKey->delete();

		return redirect()->action('CmsTextKeyController@index');
	}

}
