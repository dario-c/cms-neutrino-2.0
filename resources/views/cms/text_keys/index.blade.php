@extends('app')

@section('content')
	@include('partials.forms.flash_messages')

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
					<br>
					{!! Html::linkAction('CmsTextKeyController@edit', 'edit', [$textKey->id]) !!}
					@include('partials.forms.delete_text_key')
					
				</td>
				<td>{{ $textKey->valueForLanguage('1') }}</td>
				<td>{{ $textKey->category->title }} </td>
			</tr>
			@endforeach
		</table>
	</div>
	@endif
	(hidden) {!! Html::linkAction('CmsTextKeyController@create', 'Create a new Text Key') !!}
@stop



