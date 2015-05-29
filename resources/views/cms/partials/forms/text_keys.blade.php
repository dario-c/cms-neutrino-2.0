<!-- CATEGORY -->
<div class="form-group">
	{!! Form::label('category', "Category:") !!}
	{!! Form::select('text_category_id', $categories, $category_id, ['class' => 'form-control']) !!}
</div>

<!-- TITLE -->
<div class="form-group">
	{!! Form::label('title', "Key:") !!}
	{!! Form::text('title', null, [
		'required' 	=> 'required',
		'class'		=> 'form-control'
	]) !!}
</div>

<!-- VALUE -->
<div class="form-group">
	{!! Form::label('value', "Value:") !!}
	{!! Form::text('value', $value, [
		'required'	=> 'required',
		'class'		=> 'form-control'
	]) !!}
</div>


<!-- SUBMIT -->
<div class="form-group">
	{!! Form::submit($submitText, ['class' => 'btn btn-info']) !!}
</div>
