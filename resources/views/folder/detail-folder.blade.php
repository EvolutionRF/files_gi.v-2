<div class="tab-content" id="side">
    <div class="tab-pane fade show active tab-custome" role="tabpanel">
        <div class="card-body d-flex">
            <x-heroicon-s-folder-open style="width:15px" />
            <p class="my-auto pl-2">{{ $folder->name }}</p>
        </div>
        <div class="detail">
            <h6>Folder Properties</h6>
            <div class="col-12 p-0">
                <div class="d-flex justify-content-between p-0">
                    <div class="text-left">
                        <p class="m-0">Type</p>
                        <p class="m-0">Owner</p>
                        @if ($folder->deleted_at == "")

                        <p class="m-0">Created at</p>
                        @else
                        <p class="m-0">Deleted at</p>

                        @endif
                    </div>

                    <div class="text-left ml-3">
                        <p class="type-status mb-0"> {{ $folder->isPrivate }}</p>
                        <p class="owner-status mb-0">{{ $folder->user->name }}</p>

                        @if ($folder->deleted_at == "")
                        <p>{{ date('d M Y h:i A', strtotime($folder->created_at))}}</p>

                        @else
                        <p>{{ date('d M Y H:i A', strtotime($folder->deleted_at))}}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
