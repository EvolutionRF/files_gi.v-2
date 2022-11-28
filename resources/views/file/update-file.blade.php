<form action="{{ $url }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @if ($content->type=='file')
    <div class="form-group">
        <div class="text-center">
            <p>Upload new version of {{$content->name }} ({{ $content->getMedia('file')->first()->file_name }})</p>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="form-control" name="file">
            </div>
        </div>
    </div>
    @else
    <div class="form-group">
        <div class="text-center">
            <p>Upload new link of {{$content->name }}</p>
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span>
                        <x-heroicon-o-link style="height:15px "></x-heroicon-o-link>
                    </span>
                </div>
            </div>
            <input type="text" class="form-control" id="link" name="link" value="{{ $content->url }}">
        </div>
    </div>
    @endif

    <div class="text-right">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>

</form>
