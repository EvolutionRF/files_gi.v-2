@foreach ($BaseFolderRequests as $BaseFolderrequest)
<section class="dropdown-item p-1">
    <div class="d-flex">
        <div class="dropdown-item-desc">
            <p class="text-small">
                <strong>{{ $BaseFolderrequest->user->name }}</strong> requesting access to {{
                $BaseFolderrequest->permission->name }} a
                Base folder named {{
                $BaseFolderrequest->basefolder->name }}
            </p>
            <div class="d-flex align-items-center">
                <div class="text-small mr-4 px-auto">
                    <p class="text-small">
                        {{ $BaseFolderrequest->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="d-flex">
                    <form action="{{ route('base-request.status',$BaseFolderrequest->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="text" name="status" value="accept" hidden>
                        <button href="#" class="btn btn-icon btn-sm btn-success mr-2 p-auto text-small">
                            <x-heroicon-s-check style="width:13px" /> Accept
                        </button>
                    </form>
                    <form action="{{ route('base-request.status',$BaseFolderrequest->id) }}" method="POST">
                        @method('PUT')

                        @csrf
                        <input type="text" name="status" value="deciline" hidden>
                        <button href="#" class="btn btn-icon btn-sm btn-danger p-auto text-small">
                            <x-heroicon-s-x-mark style="width:13px" />Deciline
                        </button>
                    </form>

                </div>
            </div>
        </div>
        <div class="text-center my-auto mr-2">
            <x-heroicon-s-document style="width:25px" class="ml-0" />
        </div>
    </div>
</section>
@endforeach

<hr>
@foreach ($ContentRequest as $request)
<section class="dropdown-item p-1">
    <div class="d-flex">
        <div class="dropdown-item-desc">
            <p class="text-small">
                <strong>{{ $request->user->name }}</strong> requesting access to {{ $request->permission->name }} a
                folder named {{
                $request->content->name }}
            </p>
            <div class="d-flex align-items-center">
                <div class="text-small mr-4 px-auto">
                    <p class="text-small">
                        {{ $request->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="d-flex">
                    <form action="{{ route('content-request.status',$request->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="text" name="status" value="accept" hidden>
                        <button class="btn btn-icon btn-sm btn-success mr-2 p-auto text-small">
                            <x-heroicon-s-check style="width:13px" /> Accept
                        </button>
                    </form>
                    <form action="{{ route('content-request.status',$request->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="text" name="status" value="deciline" hidden>
                        <button class="btn btn-icon btn-sm btn-danger p-auto text-small">
                            <x-heroicon-s-x-mark style="width:13px" />Deciline
                        </button>
                    </form>

                </div>
            </div>
        </div>
        <div class="text-center my-auto mr-2">
            <x-heroicon-s-document style="width:25px" class="ml-0" />
        </div>
    </div>
</section>
@endforeach
