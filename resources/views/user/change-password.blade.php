<form action="{{ $url }}" method="POST" novalidate>
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label>Old Passoword</label>
            <input type="password" class="form-control @error('oldPassword') is-invalid @enderror" id="oldPassword"
                name="oldPassword" value="" required>
            @error('oldPassword')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>New Password</label>
            <input type="password" class="form-control @error('newPassword') is-invalid @enderror" id="newPassword"
                name="newPassword" value="" required>
            @error('newPassword')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>New Password Confirmation</label>
            <input type="password" class="form-control @error('newPassword_confirmation') is-invalid @enderror"
                id="newPassword_confirm" name="newPassword_confirmation" value="" required>
            @error('newPassword_confirmation')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <p class="text-center">Are you sure Change the password?</p>
    </div>
    <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
