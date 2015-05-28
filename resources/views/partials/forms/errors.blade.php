@if ( ! $errors->isEmpty() )
	<div class="row">
		@foreach ( $errors->all() as $error )
			<div class="col-md-6 col-md-offset-2 alert alert-danger">{{ $error }}</div>
		@endforeach
	</div>
	
@elseif ( Session::has( 'message' ) )
	<div class="row">
		<div class="col-md-6 col-md-offset-2 alert alert-success">{{ Session::get( 'message' ) }}</div>
	</div>
@endif