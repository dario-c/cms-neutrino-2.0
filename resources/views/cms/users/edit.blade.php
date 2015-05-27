@extends('app')

@section('content')
	@include('partials.forms.errors')

	{!! Form::model($user, ['method' => 'PATCH', 'action' => ['CmsUserController@update', $user->id]]) !!}
	
		@include('partials.forms.user', ['submitText' => 'Edit'])

	{!! Form::close() !!}	

	@if(Auth::user()->isAdmin() )
		@include('partials.forms.delete_user')
	@endif

@stop