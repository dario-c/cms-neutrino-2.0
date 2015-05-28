@extends('app')

@section('content')
	@include('partials.forms.flash_messages')

	{!! Form::model($textKey, ['method' => 'PATCH', 'action' => ['CmsTextKeyController@update', $textKey->id]]) !!}

		@include('partials.forms.text_keys', ['submitText' => 'Edit Text Key'])
	
	{!! Form::close() !!}

@stop