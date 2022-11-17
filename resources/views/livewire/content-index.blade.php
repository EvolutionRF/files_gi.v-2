<div>
    <div class="main-content">

        <section class="section">
            <div class="section-header">
                <h1>{{ $folder->name }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    @foreach ($parents as $parent )
                    @if($folder->slug != $parent['slug'])
                    <div class="breadcrumb-item"><a href="{{ route('EnterFolder',$parent['slug']) }}">{{ $parent['name']
                            }}</a>
                    </div>
                    @endif
                    @endforeach
                    <div class="breadcrumb-item"><a href="{{ route('EnterFolder', $folder->slug) }}">{{ $folder->name
                            }}</a>
                    </div>
                </div>
            </div>

            <div>
                <div class="form-group form-group-sm">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <x-heroicon-s-magnifying-glass style="width:15px" />
                            </div>
                        </div>
                        <input type="search" class="form-control">

                        <div class="navbar-nav">

                            <li class="dropdown">
                                <button class="btn btn-primary btn-sm btn-icon" data-toggle="dropdown"
                                    class="nav-link nav-link-lg nav-link-user p-0" style="height: 42px">
                                    <x-heroicon-s-plus style="width:15px" />
                                    <span>
                                        Create
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right ml-0">
                                    <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                        data-target=".show-modal" data-title="Create Folder"
                                        data-url="{{ route('folder.create',$folder->slug) }}">
                                        <x-heroicon-s-folder-open style="width:15px" class="ml-0" />
                                        Folder
                                    </a>
                                    <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                        data-target=".show-modal" data-title="Upload File"
                                        data-url="{{ route('file.showcreate',$folder->slug) }}">
                                        <x-heroicon-s-document style="width:15px" class="ml-0" /> File
                                    </a>
                                    <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                        data-target=".show-modal" data-title="URL"
                                        data-url="{{ route('url.showcreate',$folder->slug) }}">
                                        <x-heroicon-s-link style="width:15px" class="ml-0" /> Url
                                    </a>
                                </div>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if((count($content_folder) >= 1) || (count($content_file) >= 1) )
        @if((count($content_folder) >= 1))
        @include('content._folder')
        @else
        <div class="text-center">
            <p class="text-dark">There are no folder here </p>
        </div>
        @endif

        <hr>
        @if((count($content_file) >= 1))
        @include('content._file')
        @else
        <div class="text-center">
            <p class="text-dark">There are no files here </p>
        </div>
        @endif
        @else
        <div class="text-center">
            <p class="text-dark">There are nothing here </p>
        </div>
        @endif



    </div>
    <x-modal.basic />

    <x-modal.detail />
</div>
