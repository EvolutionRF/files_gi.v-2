<form action="{{ $url }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <h6>Folder Name</h6>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-folder-plus"></i></div>
            </div>
            <input type="text" class="form-control" id="name" name="name" value="{{ $folder->name }}">
        </div>
    </div>
    <div class="text-right">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Create</button>
    </div>

</form>
