<div class="modal" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you, want to delete?</p>
            </div>
            <div class="modal-footer">
                <div class="col-sm-4">
                    <a href="{{route('admin.deleteterm',$data->id)}}" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                </div>
                <button type="button" class="btn btn-secondary col-sm-3" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>