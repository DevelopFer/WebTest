<div class="row">
    <div class="col-12">
        <div class="modal fade" id="tagModal" tabindex="-1" role="dialog" aria-labelledby="tagModal" aria-hidden="true">
            <form action="{{ route('storeTag') }}" class="ajaxForm">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tagModalLabel">New Tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name"><b>Tag Name</b></label>   
                            <input type="text" class="form-control input-sm" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary dismiss" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Tag</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>