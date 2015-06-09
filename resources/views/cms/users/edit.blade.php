@extends('cms.base')

@section('content')

	<h1>Edit User</h1>

	@include('cms.partials.forms.flash_messages')

	{!! Form::model($user, ['method' => 'PATCH', 'action' => ['CmsUserController@update', $user->id], 'class' =>'form-validation']) !!}
	
		@include('cms.partials.forms.user', ['submitText' => 'Edit', 'passwordRequired' => 'false'])

	{!! Form::close() !!}	

	@if(Auth::user()->isAdmin() )

		@include('cms.partials.forms.delete_user')

	@endif

@stop