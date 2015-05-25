@extends('app')

@section('content')

	{!! Form::model($user, ['method' => 'PATCH', 'action' => ['CmsUserController@update', $user->id]]) !!}
	
		@include('partials.forms._user', ['submitText' => 'Edit'])

	{!! Form::close() !!}	

	@if(Auth::user()->isAdmin() )
		@include('partials.forms._delete_user')
	@endif

@stop