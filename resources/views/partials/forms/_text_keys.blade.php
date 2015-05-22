<!-- TITLE -->
<div class="form-group">
	{!! Form::label('title', "Title:") !!}
	{!! Form::text('title', null) !!}
</div>

<!-- VALUE -->
<div class="form-group">
	{!! Form::label('category', "Category:") !!}
	{!! Form::text('category', $category) !!}
</div>

<!-- VALUE -->
<div class="form-group">
	{!! Form::label('value', "Value:") !!}
	{!! Form::text('value', $value) !!}
</div>


<!-- SUBMIT -->
<div class="form-group">
	{!! Form::submit($submitText, ['class' => 'btn btn-info']) !!}
</div>
