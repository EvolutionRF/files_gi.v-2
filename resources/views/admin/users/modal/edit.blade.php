<form action="{{ $url }}" method="POST" novalidate>
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ $user->name }}" required>
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                name="username" value="{{ $user->username }}" readonly>
            @error('username')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Divisi</label>
            <select class="form-control @error('division') is-invalid @enderror" id="division" name="division"
                value="{{ old('division') }}" required>
                <option hidden value="">Select Divisi</option>
                @foreach ($divisions as $division)
                <option value="{{ $division->id }}" {{ ($user->division_id == $division->id)?'selected':'' }} >{{
                    $division->name }}
                </option>
                @endforeach>
            </select>
            @error('division')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <p class="text-center">Are you sure update the entire data?</p>
    </div>
    <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
