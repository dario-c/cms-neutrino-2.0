{!! Form::open(array('route' => array('cms.users.destroy', $user->id), 'method' => 'delete')) !!}
      <button type="submit" class="btn btn-danger btn-mini">Delete</button>
{!! Form::close() !!}