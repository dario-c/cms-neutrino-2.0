{!! Form::open(['method' => 'DELETE', 'action' => ['CmsUserController@update', $user->id]] ) !!}
	<button type="submit" class="btn btn-danger btn-mini">Delete</button>
{!! Form::close() !!}