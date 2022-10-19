@extends('layouts.app')

@section('title', $Folder->name)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">


<style>
    .modal-dialog-right {
        position: fixed;
        margin: auto;
        width: 20%;
        height: 100%;
        right: 0px;
    }

    .modal-content-right {
        height: auto;
        min-height: 100%;
        border-radius: 0;
    }

    .modal.right_modal .modal-dialog-right {
        /* position: fixed; */
        /* margin: auto; */
        /* width: 32%; */
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
        transition: 300ms;
    }

    .fade {
        transition: opacity .20s ease-in-out;
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $Folder->name }}</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>

                @foreach ($parents as $parent )
                @if($Folder->slug != $parent['slug'])
                <div class="breadcrumb-item"><a href="{{ route('EnterFolder',$parent['slug']) }}">{{ $parent['name']
                        }}</a>
                </div>
                @endif
                @endforeach
                <div class="breadcrumb-item"><a href="{{ route('EnterFolder', $Folder->slug) }}">{{ $Folder->name
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
                                    data-target="#TambahFolder"
                                    onclick="createContent('{{ $Folder->slug }}','{{ route('folder.create') }}')">
                                    <x-heroicon-s-folder-open style="width:15px" class="ml-0" />
                                    Folder
                                </a>
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target="#TambahFile"
                                    onclick="createContentFile('{{ $Folder->slug }}','{{ route('file.upload') }}')">
                                    <x-heroicon-s-document style="width:15px" class="ml-0" /> File
                                </a>
                            </div>
                        </li>
                    </div>
                </div>
            </div>

        </div>


        <div class="row sortable-card">
            @foreach($content_folder as $content)
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-secondary cardClick" id="card-{{ $content->id }}"
                    onclick="cardClick('card-{{ $content->id }}')" style="cursor: pointer"
                    ondblclick="newtab('{{ route('EnterFolder',$content->slug) }}')">
                    <div class="card-logo p-3">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex text-primary">
                                <div class="my-auto">
                                    <x-heroicon-s-folder-open style="width:40px" />
                                </div>
                                <div class="my-auto ml-3 d-inline-block">
                                    <h6 class="mt-2 text-dark">{{ $content->name }}</h6>
                                </div>
                            </div>
                            <div class="text-left">
                                <ul class="navbar-nav">
                                    <li class="dropdown">
                                        <a href="" data-toggle="dropdown"
                                            class="nav-link nav-link-lg nav-link-user p-0">
                                            <x-heroicon-s-ellipsis-vertical style="width:15px" />
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right ml-0">
                                            <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                                data-target="#Sidebar-Modal">
                                                <x-heroicon-s-information-circle style="width:15px" class="ml-0" />
                                                Detail
                                            </a>
                                            <a type="button" class="dropdown-item has-icon pl-2">
                                                <x-heroicon-s-cog-8-tooth style="width:15px" class="ml-0" /> Manage
                                            </a>
                                            <a type="button" class="dropdown-item has-icon pl-2">
                                                <x-heroicon-s-arrow-path style="width:15px" class="ml-0" /> Update
                                            </a>
                                            <a type="button" class="dropdown-item has-icon pl-2">
                                                <x-heroicon-s-pencil-square style="width:15px" class="ml-0" />
                                                Rename
                                            </a>
                                            <a type="button" class="dropdown-item has-icon pl-2">
                                                <x-heroicon-s-trash style="width:15px" class="ml-0" /> Delete
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between py-auto mt-2">
                            <div>
                                <h6 class="text-small mb-0 ml-2">{{ $content->user->name }}</h6>
                            </div>
                            <div>
                                @if($content->isPrivate =='private')
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
    </section>

    <div class="">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table-striped table-md table" id="example">
                    <tr class="text-bold">
                        <th>Nama</th>
                        <th>Owner</th>
                        <th>Last Modify</th>
                        <th>Access</th>
                        <th class="text-center">Action</th>
                    </tr>
                    @foreach($content_file as $file)
                    <tr>
                        <td>
                            <x-heroicon-s-document style="width:15px" class="ml-0" /> {{ $file->name }}
                        </td>
                        <td>{{ $file->user->name }}</td>
                        <td>x</td>
                        <td>{{ $file->isPrivate }}</td>
                        <td class="text-center">
                            x
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Create Folder Modal --}}
<div class="modal fade" tabindex="-1" role="dialog" id="TambahFolder">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="FormCreate">
                    @csrf
                    {{-- @method('PUT') --}}
                    <input type="text" name="parentSlug" id="parentSlug" hidden>
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
                            <input type="radio" id="isPrivate1" name="isPrivate" class="custom-control-input"
                                value="public" checked>
                            <label class="custom-control-label" for="isPrivate1">Public</label>
                            <p>This project would be available to anyone who has the link</p>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="isPrivate2" name="isPrivate" class="custom-control-input"
                                value="private">
                            <label class="custom-control-label" for="isPrivate2">Private</label>
                            <p>Only people with access can open with the link</p>
                        </div>
                    </div>

                    <div class="form-group" id="formPrivate" style="display: none">
                        <h6>Invite User</h6>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="" aria-label="">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Access</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">View</a>
                                        <a class="dropdown-item" href="#">Manage</a>
                                    </div>
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
            </div>

        </div>
    </div>
</div>
{{-- End Create Folder Modal --}}

{{-- Side Bar modal --}}
<div class="modal fade right_modal" tabindex="-1" role="dialog" id="Sidebar-Modal">
    <div class="modal-dialog modal-dialog-right" role="document">
        <div class="modal-content modal-content-right">
            <div class="modal-header">
                <h5 class="modal-title">Detail | Activity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>
{{-- End Side Bar modal --}}


{{-- Modal tambah file start --}}
<div class="modal fade" tabindex="-1" role="dialog" id="TambahFile">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" id="formUpload">
                    @csrf
                    <input type="text" name="FileparentSlug" id="FileparentSlug" hidden value="">
                    <div class="form-group">
                        <h6>File Title</h6>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="file">
                            <label class="custom-file-label" for="customFile">Upload File</label>
                        </div>
                    </div>
                    <div class="access-radio mt-2">
                        <h6>General Access</h6>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="FileisPrivate1" name="FileisPrivate" class="custom-control-input"
                                value="public" checked>
                            <label class="custom-control-label" for="FileisPrivate1">Public</label>
                            <p>This project would be available to anyone who has the link</p>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="FileisPrivate2" name="FileisPrivate" class="custom-control-input"
                                value="private">
                            <label class="custom-control-label" for="FileisPrivate2">Private</label>
                            <p>Only people with access can open with the link</p>
                        </div>
                    </div>

                    <div class="form-group" id="formFilePrivate" style="display: none">
                        <h6>Invite User</h6>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="" aria-label="">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Access</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">View</a>
                                        <a class="dropdown-item" href="#">Manage</a>
                                    </div>
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

            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- Modal tambah file end --}}

@endsection

@push('scripts')
<Script>
    function cardClick(target) {
        var get = '#'+target;
        console.log(get);
        var targetChange = document.querySelector(get);
        var otherCard = document.querySelector('.cardClick');
        const collection = document.getElementsByClassName("cardClick");
        for (let i = 0; i < collection.length; i++) {
            collection[i].classList.remove('card-primary');
            collection[i].classList.add('card-secondary');

        }

        otherCard.classList.add('card-secondary')
        targetChange.classList.add('card-primary');
        targetChange.classList.remove('card-secondary');
    };


    function newtab(route) {
        console.log(route);
        window.location.assign(route);
    }

    function createContent(slug,route) {
        var formCreate =document.querySelector('#FormCreate');
        var parentSlug = document.querySelector('#parentSlug');

        // nameForm.value = name;
        // usernameForm.value = username;
        parentSlug.value = slug;
        formCreate.action = route;

        const radioButtons = document.querySelectorAll('input[name="isPrivate"]');
        const privateForm = document.querySelector('#formPrivate');
            for (const radioButton of radioButtons) {
                radioButton.addEventListener('change', showSelectedFolder);
            }
        function showSelectedFolder(e) {
            // console.log(e);
            if (this.checked) {
                console.log(this.value)
                if (this.value=='private') {
                    // console.log('milih Private boy');
                    privateForm.style.display = 'block';
                }else{
                    // console.log('Milih Public boy');
                    privateForm.style.display='none';
                }
            }
        }
    }

    function createContentFile(slug,route) {
        var formCreate =document.querySelector('#formUpload');
        var FileparentSlug = document.querySelector('#FileparentSlug');

        // console.log(slug);
        // nameForm.value = name;
        // usernameForm.value = username;
        FileparentSlug.value = slug;
        formCreate.action = route;

        console.log(FileparentSlug);

        const FileradioButtons = document.querySelectorAll('input[name="FileisPrivate"]');
        const privateFileForm = document.querySelector('#formFilePrivate');
            for (const FileradioButton of FileradioButtons) {
                FileradioButton.addEventListener('change', showSelectedFile);
            }
        function showSelectedFile(e) {
            if (this.checked) {
                console.log(this.value)
                if (this.value=='private') {
                    // console.log('milih Private boy');
                    privateFileForm.style.display = 'block';
                }else{
                    // console.log('Milih Public boy');
                    privateFileForm.style.display='none';
                }
            }
        }
    }




</script>

<!-- JS Libraies -->
<script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

<!-- Page Specific JS File -->
{{-- <script src="{{ asset('js/page/index-0.js') }}"></script> --}}
@endpush
