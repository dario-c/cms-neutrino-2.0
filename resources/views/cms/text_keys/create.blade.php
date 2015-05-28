@extends('cms.base')

@section('content')
	@include('partials.forms.flash_messages')

	{!! Form::open(['method' => 'POST', 'action' => 'CmsTextKeyController@store']) !!}

		@include('cms.partials.forms.text_keys',
		[
			'submitText' => 'Create Text Key',
			'category_id' => null,
			'value'=>null
		])
	
	{!! Form::close() !!}

@stop