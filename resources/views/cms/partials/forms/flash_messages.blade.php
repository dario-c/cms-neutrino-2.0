@if ( ! $errors->isEmpty() )
	<div class="row">
		@foreach ( $errors->all() as $error )
			<div class="alert alert-danger">{{ $error }}</div>
		@endforeach
	</div>
	
@elseif ( Session::has( 'message' ) )
	<div class="row">
		<div class="alert alert-success">{{ Session::get( 'message' ) }}</div>
	</div>
@endif