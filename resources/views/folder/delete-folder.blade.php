<form action="{{ $url }}" method="POST" id="formDeleteBaseFolder">
    @csrf
    @method('DELETE')
    <div class="modal-body">
        <div class="form-group">
            <p>Are you sure to delete the Folder ?</p>
        </div>
    </div>
    <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete Data</button>
    </div>
</form>
