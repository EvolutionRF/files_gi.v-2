<form action="{{ $url }}" method="POST" id="isPrivateForm">
    @csrf
    @method('PUT')
    {{-- <input type="text" name="idBaseFolder" id="idBaseFolder" hidden> --}}
    <div class="access-radio">
        <h6>General Access</h6>
        <div class="custom-control custom-radio">
            <input type="radio" id="isPrivate-1" name="isPrivate" class="custom-control-input" value="public" {{
                ($folder->isPrivate=='public')?'checked':'' }}>
            <label class="custom-control-label" for="isPrivate-1">Public</label>
            <p>This project would be available to anyone who has the link</p>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" id="isPrivate-2" name="isPrivate" class="custom-control-input" value="private" {{
                ($folder->isPrivate=='private')?'checked':'' }}>
            <label class="custom-control-label" for="isPrivate-2">Privates</label>
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
        <div class="form-group">
            <h6>User with Access</h6>
            @foreach($have_access as $haveAccess)
            <div class="border rounded p-1 pl-2 pr-2 d-flex justify-content-between mb-1" style="height: 40px">
                <div class="d-flex justify-align-center">
                    <p class="m-0 mr-2 my-auto">🔘</p>
                    <p class="my-auto">{{ $haveAccess->user->name }}</p>
                </div>
                <div class="d-flex justify-align-center">
                    <select class="form-control-sm border-0">
                        @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}" {{ ($haveAccess->permission_id ==
                            $permission->id)?'selected':'' }}>{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @endforeach
        </div>
    </div>

    <div class="text-right">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

<script>
    $(document).ready(function () {

        const privateForm = document.querySelector('#formPrivate');

        if ($("#isPrivate-2").is(":checked")) {
            privateForm.style.display = 'block';
        }
        $('[name=isPrivate]').change(function() {
            if (this.value == 'private') {
                privateForm.style.display = 'block';
            } else {
                privateForm.style.display = 'none';
            }
        });
    });
</script>
