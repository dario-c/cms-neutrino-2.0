@extends('cms.base')

@section('content')

	@include('cms.partials.forms.flash_messages')

	{!! Form::model($user, ['method' => 'PATCH', 'action' => ['CmsUserController@update', $user->id]]) !!}
	
		@include('cms.partials.forms.user', ['submitText' => 'Edit'])

	{!! Form::close() !!}	

	@if(Auth::user()->isAdmin() )

		@include('cms.partials.forms.delete_user')

	@endif

@stop