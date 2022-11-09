<form action="{{ $url }}" method="POST" id="formDeleteBaseFolder">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <p>Are you sure to restore this ?</p>
        </div>
    </div>
    <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Restore</button>
    </div>
</form>
