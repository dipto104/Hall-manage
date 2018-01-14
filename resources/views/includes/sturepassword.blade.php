<div class="modal" id="reset">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Reset Password</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you, want to reset password?</p>
            </div>
            <div class="modal-footer">
                <div class="col-sm-4">
                    <a href="{{route('admin.sturespassword',$data->id)}}" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> Yes</a>
                </div>
                <button type="button" class="btn btn-secondary col-sm-3" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>