@extends('app');

@section('content')

	{!! Form::model($user, ['method' => 'PATCH', 'action' => ['CmsUserController@update', $user->id]]) !!}
		
		@include('cms.users._editForm')

	    <div class="form-group">
		   	{!! Form::label('role', "Role:") !!}
		   	@if($user->role->name !== 'admin' )
			    {!! Form::select('role_id', $roles, null) !!}
		   	@else
			   	{{ $user->role->name }}
			@endif
	    </div>

	{!! Form::close() !!}	


	@if($user->role->name !== 'admin' )
		@include('cms.users._deleteUserForm');
	@endif

		<div class="form-group">
		    {!! Form::submit() !!}
		</div>
@stop