<form action="{{ $url }}" method="POST">
    @csrf

    <select name="permission">
        @foreach ($permissions as $permission)
        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary">
        Ask request
    </button>
</form>
