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

		$validationErrors = $this->validateData($request, $textKey, $this->_textKeyValidator);
		if(isset($validationErrors)){ return redirect()->action('CmsTextKeyController@create')->withErrors( $validationErrors ); }

		$textKey->save();

		$validationErrors = $this->storeValue($textKey->id, $request, 1);
		if(isset($validationErrors)){ 
			return redirect()->action('CmsTextKeyController@edit', [$textKey->id])->withErrors( $validationErrors );
		}

		return redirect()->action('CmsTextKeyController@index')->withMessage( 'Saved Successfully' );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function validateData(Request $request, $checkObject, $validator)
	{
		try {
			$validator->validate( $checkObject->toArray());

			} catch ( ValidationException $e ) {
				return $e->get_errors();
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
	public function storeValue($textKeyId, Request $request, $language_id = null)
	{
		$textValue = new TextValue($request->all());

		$textValue->language_id = (isset($language_id)) ? $language_id : Config::get('language_id', 1);
		$textValue->text_key_id = $textKeyId;

		$validationErrors = $this->validateData($request, $textValue, $this->_textValueValidator);

		if(!isset($validationErrors)){ $textValue->save(); }
		return $validationErrors;
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



		if(count($textKey->values) > 0){
			$textValue = $textKey->values()->first(); 
			$textValue->value = $request->value;

		} else {
			$textValue = new TextValue($request->all());
			$textValue->language_id =  1;
			$textValue->text_key_id = $id;
		}


		$validationErrors = $this->validateData($request, $textValue, $this->_textValueValidator);

		if(isset($validationErrors)){ 
			return redirect()->action('CmsTextKeyController@edit', [$textKey->id])->withErrors( $validationErrors );
		}

		
		$textValue->save(); 
		return redirect()->action('CmsTextKeyController@index')->withMessage( 'Saved Successfully' );
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
