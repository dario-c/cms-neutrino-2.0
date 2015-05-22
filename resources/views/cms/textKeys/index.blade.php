@extends('app')

@section('content')
	@if(isset($textKeys))

	<div class="panel panel-default">
		<table class="table">
			<tr>
				<th>Text Key</th>
				<th>Text Value (English)</th>
				<th>Category</th>
			</tr>

			@foreach ($textKeys as $textKey)
			<tr>
				<td>{{ $textKey->title }} 
					(	{!! Html::linkAction('CmsTextKeyController@edit', 'edit', [$textKey->id]) !!} | <a href="#">delete</a>)
				</td>
				<td>{{ $textKey->values->where('language_id','1')->first()->value }}</td>
				<td>{{ $textKey->category->title }} </td>
			</tr>
			@endforeach
		</table>
	</div>
	@endif
	(hidden) {!! Html::linkAction('CmsTextKeyController@create', 'Create a new Text Key') !!}
@stop



