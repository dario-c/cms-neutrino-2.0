<div class="form-group">
	{!! Form::label($postTypeField->id, $postTypeField->title.(($postTypeField->parameter('required') == true) ? ' *' : '' )) !!}
    {!! Form::select('role_id', [1,2,3], null,['class' => 'form-control']) !!}
</div>