<form action="{{ $url }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <p class="text-center">Confirm to reset password {{$user->name }}</p>
    </div>
    <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-info">Reset Password</button>
    </div>
</form>
