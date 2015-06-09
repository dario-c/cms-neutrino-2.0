@extends('cms.base')

@section('content')

	<h1>Add new User</h1>


	@include('cms.partials.forms.flash_messages')

	{!! Form::open(['method' => 'POST', 'action' => 'CmsUserController@store', 'class' =>'form-validation']) !!}

		@include('cms.partials.forms.user', [
			'submitText' => 'Register',
			'passwordRequired' => 'true',
			'passwordPlaceholder' => ''
		])
	
	{!! Form::close() !!}

@stop