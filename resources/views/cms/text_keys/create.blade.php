@extends('cms.base')

@section('content')

	<h1>Add new Text Key</h1>

	@include('cms.partials.forms.flash_messages')

	{!! Form::open(['method' => 'POST', 'action' => 'CmsTextKeyController@store', 'class' => 'form-validation']) !!}

		@include('cms.partials.forms.text_keys',
		[
			'submitText' => 'Create Text Key',
			'category_id' => null,
			'value'=>null
		])
	
	{!! Form::close() !!}

@stop