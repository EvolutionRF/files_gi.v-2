<div class="row sortable-card">
    @foreach ($baseFolders as $baseFolder)
    {{-- @if ($baseFolders->user->id == Auth::user()->id) --}}
        
    
    <div class="col-12 col-md-6 col-lg-4">

        <div class="card card-secondary cardClick" id="card-{{ $baseFolder->id }}"
            onclick="cardClick('card-{{ $baseFolder->id }}')" style="cursor: pointer">
            <div class="card-logo p-3">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('EnterFolder', $baseFolder->slug) }}">
                        <div class="d-flex text-primary">
                            <div class="my-auto">
                                <x-heroicon-s-folder-open style="width:40px" />
                            </div>
                            <div class="my-auto ml-3 d-inline-block">
                                <p class="mt-2 text-base">{{ $baseFolder->name }}</p>
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
                                        data-target=".right_modal" data-title="Detail Folder "
                                        data-url="{{ route('folder.show', $baseFolder->id) }}">
                                        <x-heroicon-s-information-circle style="width:15px" class="ml-0" />
                                        Detail
                                    </a>
                                    @if($baseFolder->owner_id == auth()->user()->id)
                                    <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                        data-target=".show-modal" data-title="Manage Folder {{ $baseFolder->name }}"
                                        data-url="{{ route('folder.manage', $baseFolder->slug) }}">
                                        <x-heroicon-s-cog-8-tooth style="width:15px" class="ml-0" />
                                        Manage
                                    </a>
                                    <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                        data-target=".show-modal" data-title="Rename Folder"
                                        data-url="{{ route('folder.rename', $baseFolder->slug) }}">
                                        <x-heroicon-s-pencil-square style="width:15px" class="ml-0" />
                                        Rename
                                    </a>
                                    <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                        data-target=".show-modal" data-title="Delete Folder"
                                        data-url="{{ route('folder.showdelete', $baseFolder->slug) }}">
                                        <x-heroicon-s-trash style="width:15px" class="ml-0" /> Delete
                                    </a>
                                    @else
                                    <?php $param = "" ?>
                                    @foreach($baseFolder->base_folders_accesses as $haveAccess)
                                    @if($haveAccess->user_id== auth()->user()->id)
                                    <?php $param = "ada" ?>
                                    @endif
                                    @endforeach
                                    @if($baseFolder->isPrivate=='private')
                                    @if($param)
                                    @else
                                    <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                        data-target=".show-modal" data-title="Ask Request"
                                        data-url="{{ route('request',$baseFolder->id) }}">
                                        <x-heroicon-s-pencil-square style="width:15px" class="ml-0" />
                                        Ask Request
                                    </a>
                                    @endif
                                    @endif
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="d-flex justify-content-between py-auto mt-2">
                    <div>
                        <h6 class="text-small mb-0 ml-2">{{ $baseFolder->user->name }}</h6>
                    </div>
                    <div>
                        @if ($baseFolder->isPrivate == 'private')
                        <x-heroicon-s-lock-closed style="width:15px" />
                        @else
                        <x-heroicon-s-globe-americas style="width:15px" />
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- @endif --}}
    @endforeach
</div>
{{ $baseFolders->links() }}
