<form action="{{ $url }}" method="POST" id="deleteForm" name="deleteForm">
    @csrf
    @method('DELETE')
    <div class="modal-body">
        <p class="text-center">Are you sure delete the entire data?</p>
    </div>
    <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
    </div>
</form>
