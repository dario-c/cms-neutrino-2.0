<?php namespace Neutrino\Http\Controllers;

use Config;
use Neutrino\TextKey;
use Neutrino\TextValue;
use Neutrino\TextCategory;
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
		// TODO: Short?
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

		$validate = $this->validateData($request->all(), $this->_textKeyValidator, 'CmsTextKeyController@create');
		if(gettype($validate) === 'object') { return $validate; }; //TODO: REMOVE!
		
		$textKey = TextKey::create($request->all());

		$validateValue = $this->storeValue($textKey->id, $request->input('value'));
		if(gettype($validateValue) === 'object') { return $validateValue; }; //TODO: REMOVE!

		return redirect()->action('CmsTextKeyController@index')->withMessage( 'Saved Successfully' );
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	private function validateData($inputs, $validator, $action, array $parameters = array())
	{
		try 
		{
			$validator->validate( $inputs );
		} 
		catch ( ValidationException $e ) 
		{
			$errors = $e->get_errors();

			return redirect()->action($action, $parameters)->withErrors($errors)->withInput();
			// TODO: Redirect directly from here instead of returning
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
	private function storeValue($textKeyId, $value, $language_id = null)
	{
		$validate = $this->validateData(['value'=>$value], $this->_textValueValidator, 'CmsTextKeyController@edit', [$textKeyId]);
		if(gettype($validate) === 'object') { return $validate; }; //TODO: REMOVE!

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

		$validate = $this->storeValue($textKey->id, $request->input('value'));
		if(gettype($validate) === 'object') { return $validate; }; //TODO: REMOVE!

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
