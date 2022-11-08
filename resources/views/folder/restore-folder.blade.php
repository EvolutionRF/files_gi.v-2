<form action="{{ $url }}" method="POST" id="formDeleteBaseFolder">
    @csrf
    {{-- @method('DELETE') --}}
    <div class="modal-body">
        <div class="form-group">
            <p>Are you sure to restore the Folder ?</p>
        </div>
    </div>
    <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Restore Folder</button>
    </div>
</form>
