<form action="{{ $url }}" method="POST">
    @csrf

    <input type="text" id="parentSlug" name="parentSlug" value="{{ @$parent->slug }}" hidden>
    <div class="form-group">
        <h6>Folder Name</h6>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-folder-plus"></i></div>
            </div>
            <input type="text" class="form-control" id="name" name="name">
        </div>
    </div>
    <div class="access-radio">
        <h6>General Access</h6>
        <div class="custom-control custom-radio">
            <input type="radio" id="is-private1" name="isPrivate" class="custom-control-input" value="public" checked>
            <label class="custom-control-label" for="is-private1">Public</label>
            <p>This project would be available to anyone who has the link</p>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" id="is-private2" name="isPrivate" class="custom-control-input" value="private">
            <label class="custom-control-label" for="is-private2">Privates</label>
            <p>Only people with access can open with the link</p>
        </div>
    </div>

    <div class="form-group" id="formPrivate" style="display: none">
        <h6>Invite User</h6>
        <div class="form-group">
            <div class="input-group mb-3">
                {{-- <input type="text" class="form-control" placeholder="" aria-label="" id="invited-user"
                    name="invited-user"> --}}
                <select class="form-control" name="invitedUser" id="invitedUser">
                    <option value="" hidden></option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <select class="form-control" name="accessType" id="accessType">
                        @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h6>Generate Password</h6>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="" aria-label="">
                <div class="input-group-append">
                    <button class="btn btn-success" type="button">Generate</button>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
</form>

<script>
    $(document).ready(function () {
        const privateForm = document.querySelector('#formPrivate');
        $('[name=isPrivate]').change(function() {
            if (this.value == 'private') {
                privateForm.style.display = 'block';
            } else {
                privateForm.style.display = 'none';
            }
        });
    });
</script>
