@extends('app')

@section('content')

	{!! Form::model($user, ['method' => 'PATCH', 'action' => ['CmsUserController@update', $user->id]]) !!}
	
		@include('partials.forms._userForm', ['submitText' => 'Edit'])

	{!! Form::close() !!}	

	@if(Auth::user()->role->name === 'admin' )
		@include('partials.forms._deleteUserForm')
	@endif

@stop