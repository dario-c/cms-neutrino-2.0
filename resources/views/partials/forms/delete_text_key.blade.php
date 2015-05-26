{!! Form::open(array('action' => ['CmsTextKeyController@destroy', $textKey->id], 'method' => 'delete')) !!}
      <button type="submit" class="btn btn-danger btn-mini">Delete</button>
{!! Form::close() !!}