<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details"
            aria-selected="true">Details</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
        <div class="card-body d-flex">
            <x-heroicon-s-folder-open style="width:15px" />
            <p class="my-auto pl-2">{{ $folder->name }}</p>
        </div>
        <div class="details">
            <h6>Folder Properties</h6>
            <div class="col-10 p-0">
                <div class="d-flex justify-content-between p-0">
                    <div class="text-left">
                        <p class="m-0">Type</p>
                        <p class="m-0">Owner</p>
                        <p class="m-0">Created at</p>
                    </div>

                    <div class="text-left ml-3">
                        <p class="type-status mb-0"> {{ $folder->isPrivate }}</p>
                        <p class="owner-status mb-0">{{ $folder->user->name }}</p>
                        <p class="created-status">{{ $folder->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
