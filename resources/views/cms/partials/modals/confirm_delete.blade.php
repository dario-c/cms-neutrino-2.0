<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Confirm your action</h4>
                Are you sure you want to delete this?
            </div>
            <div class="modal-footer">
	            {!! Form::open(['method' => 'delete', 'id' => 'confirm-delete-form']) !!}

	                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-danger">Delete</button>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>