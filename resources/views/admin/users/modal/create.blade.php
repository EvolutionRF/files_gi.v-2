<form action="{{ $url }}" method="POST" novalidate>
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label>Name <span class="text-danger">*</span> </label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name') }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                name="username" value="{{ old('username') }}">
            <span><small>Username harus lebih dari 8 karakter</small></span>
            @error('username')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Password(set as default)</label>
            <div class="input-group" id="show_hide_password">
                <input class="form-control" type="password" id="password" name="password" value="password" readonly>
                <div class="input-group-append">
                    <a href="" class="text-decoration-none">
                        <div class="input-group-text">
                            <i class="fas fa-eye-slash" aria-hidden="true"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Divisi <span class="text-danger">*</span></label>
            <select class="form-control @error('division') is-invalid @enderror" id="division" name="division">
                <option hidden value="">Select Divisi</option>
                @foreach ($divisions as $division)
                <option value="{{ $division->id }}" {{ old('division')==$division->id ? 'selected' : ''
                    }}>{{ $division->name }}
                </option>
                @endforeach>
            </select>
            @error('division')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Add Data</button>
    </div>
</form>

<script>
    $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("fa-eye-slash");
                    $('#show_hide_password i').removeClass("fa-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("fa-eye-slash");
                    $('#show_hide_password i').addClass("fa-eye");
                }
            });
        });

</script>
