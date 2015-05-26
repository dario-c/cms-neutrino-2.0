<!-- CATEGORY -->
<div class="form-group">
	{!! Form::label('category', "Category:") !!}
	{!! Form::select('category_id', $categories, $category_id) !!}
</div>

<!-- TITLE -->
<div class="form-group">
	{!! Form::label('title', "Key:") !!}
	{!! Form::text('title', null, ['required']) !!}
</div>

<!-- VALUE -->
<div class="form-group">
	{!! Form::label('value', "Value:") !!}
	{!! Form::text('value', $value, ['required']) !!}
</div>


<!-- SUBMIT -->
<div class="form-group">
	{!! Form::submit($submitText, ['class' => 'btn btn-info']) !!}
</div>
