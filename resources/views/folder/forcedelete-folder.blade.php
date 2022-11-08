<form action="{{ $url }}" method="POST" id="formDeleteBaseFolder">
    @csrf
    @method('DELETE')
    <div class="modal-body">
        <div class="form-group">
            <p>Are you sure to <b>Delete</b> the Folder pemanently?</p>
        </div>
    </div>
    <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
    </div>
</form>
