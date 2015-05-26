@extends('app')

@section('content')

	{!! Form::open(['method' => 'POST', 'action' => 'CmsTextKeyController@store']) !!}

		@include('partials.forms.text_keys',
		[
			'submitText' => 'Create Text Key',
			'category_id' => null,
			'value'=>null
		])
	
	{!! Form::close() !!}

@stop