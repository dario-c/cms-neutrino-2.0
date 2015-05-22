@extends('app')

@section('content')

	{!! Form::model($textKey, ['method' => 'PATCH', 'action' => ['CmsTextKeyController@update', $textKey->id]]) !!}

		@include('partials.forms._text_keys', ['submitText' => 'Edit Text Key'])
	
	{!! Form::close() !!}

@stop