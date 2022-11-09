<div class="row sortable-card">
    @foreach ($trashcontentFolder as $folder)
    <div class="col-12 col-md-6 col-lg-3">

        <div class="card card-secondary cardClick" id="card-{{ $folder->id }}"
            onclick="cardClick('card-{{ $folder->id }}')" style="cursor: pointer">
            <div class="card-logo p-3">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('EnterFolder', $folder->slug) }}">
                        <div class="d-flex text-primary">
                            <div class="my-auto">
                                <x-heroicon-s-folder-open style="width:40px" />
                            </div>
                            <div class="my-auto ml-3 d-inline-block">
                                <p class="mt-2 text-base">{{ $folder->name }}</p>
                            </div>
                        </div>
                    </a>
                    <div class="text-left">
                        <ul class="navbar-nav">
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user p-0">
                                    <x-heroicon-s-ellipsis-vertical style="width:15px" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-right ml-0">
                                    <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                        data-target=".right_modal" data-title="Detail Folder " data-url="">
                                        <x-heroicon-s-information-circle style="width:15px" class="ml-0" />
                                        Detail
                                    </a>
                                    <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                        data-target=".show-modal" data-title="Restore {{ $folder->name }}"
                                        data-url="{{ route('trash.showrestore',$folder->slug) }}">
                                        <x-heroicon-s-arrow-path-rounded-square style="width:15px" class="ml-0" />
                                        Restore
                                    </a>
                                    <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                        data-target=".show-modal" data-title="Delete Folder"
                                        data-url="{{ route('trash.showforcedelete',$folder->slug) }}">
                                        <x-heroicon-s-trash style="width:15px" class="ml-0" /> Delete
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="d-flex justify-content-between py-auto mt-2">
                    <div>
                        <h6 class="text-small mb-0 ml-2">{{ $folder->user->name }}</h6>
                    </div>
                    <div>
                        @if ($folder->isPrivate == 'private')
                        <x-heroicon-s-lock-closed style="width:15px" />
                        @else
                        <x-heroicon-s-globe-americas style="width:15px" />
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
    @endforeach
</div>
{{-- {{ $trashcontentFolder->links() }} --}}
