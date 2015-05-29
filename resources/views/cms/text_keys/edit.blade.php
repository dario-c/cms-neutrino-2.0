@extends('cms.base')

@section('content')

	@include('cms.partials.forms.flash_messages')

	{!! Form::model($textKey, ['method' => 'PATCH', 'action' => ['CmsTextKeyController@update', $textKey->id]]) !!}

		@include('cms.partials.forms.text_keys', ['submitText' => 'Edit Text Key'])
	
	{!! Form::close() !!}

@stop