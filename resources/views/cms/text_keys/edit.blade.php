@extends('cms.base')

@section('content')
	
	<h1>Edit Text Key</h1>

	@include('cms.partials.forms.flash_messages')

	{!! Form::model($textKey, ['method' => 'PATCH', 'action' => ['CmsTextKeyController@update', $textKey->id]]) !!}

		@include('cms.partials.forms.text_keys', ['submitText' => 'Edit Text Key'])
	
	{!! Form::close() !!}

@stop