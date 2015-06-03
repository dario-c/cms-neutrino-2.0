<div class="form-group">
	{!! Form::label($postTypeField->id, $postTypeField->title.(($postTypeField->parameter('required') == true) ? ' *' : '' )) !!}
	
	{!! Form::checkbox('agree', 'yes', null, [
		'class' 					=> 'form-control'
	]) !!}
	{!! Form::label('Agree!')!!}
	
	{!! Form::checkbox('agree', 'yes', null, [
		'class' 					=> 'form-control'
	]) !!}
	{!! Form::label('Agree!')!!}
</div>