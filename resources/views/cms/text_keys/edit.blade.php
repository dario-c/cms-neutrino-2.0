@extends('cms.base')

@section('content')

	{!! Form::model($textKey, ['method' => 'PATCH', 'action' => ['CmsTextKeyController@update', $textKey->id]]) !!}

		@include('cms.partials.forms.text_keys', ['submitText' => 'Edit Text Key'])
	
	{!! Form::close() !!}

@stop