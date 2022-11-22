<div class="d-flex justify-content-between">
    <div>
        <h4>
            You Need Access
        </h4>
        <p>Request acces, or switch to an account with acces</p>
        <form action="{{ $url }}" method="POST">
            @csrf
            <select name="permission">
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </select>
            <div class="mt-5">
                <button type="button" class="btn btn-primary">Request Access</button>
            </div>
        </form>
    </div>

    <div>
        <img src=" " alt="">
    </div>
</div>
