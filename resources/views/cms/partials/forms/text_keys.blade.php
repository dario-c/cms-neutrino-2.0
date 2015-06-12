<div class="btn-toolbar text-right">
	<button type="button" class="btn btn-success btn-submit">{{$submitText}}</button>
</div>

<!-- CATEGORY -->
<div class="form-group">
	{!! Form::label('category', "Category:") !!}
	{!! Form::select('text_category_id', $categories, $category_id, ['class' => 'form-control']) !!}
</div>

<!-- TITLE -->
<div class="form-group">
	{!! Form::label('title', "Key:") !!}
	{!! Form::text('title', null, [
		'required'      => 'required',
		'class'		=> 'form-control',
		'data-fv-notempty'			=> 'true',
		'data-fv-notempty-message' 	=> 'This field is required, cannot be left empty'
	]) !!}
</div>

<!-- VALUE -->
<div class="form-group">
	{!! Form::label('value', "Value:") !!}
	{!! Form::text('value', $value, [
		'required'	=> 'required',
		'class'		=> 'form-control',
		'data-fv-notempty'			=> 'true',
		'data-fv-notempty-message' 	=> 'This field is required, cannot be left empty'

	]) !!}
</div>
