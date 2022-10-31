@extends('layouts.app')

@section('title', $folder->name)

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
                                    data-target="#TambahFile"
                                    onclick="createContentFile('{{ $folder->slug }}','{{ route('file.upload') }}')">
                                    <x-heroicon-s-document style="width:15px" class="ml-0" /> File
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


{{-- Side Bar modal --}}
<div class="modal fade right_modal" tabindex="-1" role="dialog" id="Sidebar-Modal-Folder">
    <div class="modal-dialog modal-dialog-right" role="document">
        <div class="modal-content modal-content-right">
            <div class="modal-header">
                <h5 class="modal-title">Details Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab"
                            aria-controls="details" aria-selected="true">Details</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                        <div class="card-body">
                            <p style="margin: 20px;"><i class="fas fa-folder"></i> Base Folder 1</p>
                        </div>
                        <div class="details">
                            <h6>Folder Properties</h6>
                            <div class="col-6">
                                <div class="d-flex justify-content-between">
                                    <div class="status"
                                        style="padding-top:30px; padding-left: 10px; padding-right:40px;">
                                        <p class="type-status" style="line-height: 0%;">Type</p>
                                        <p class="owner-status">Status</p>
                                    </div>
                                    <div class="body" style="padding-top:30px;">
                                        <p class="type-status" style="line-height: 0%;">Folder</p>
                                        <p class="owner-status">Yoga</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Side Bar modal --}}


{{-- Side Bar Modal File --}}
<div class="modal fade right_modal" tabindex="-1" role="dialog" id="Sidebar-Modal-File">
    <div class="modal-dialog modal-dialog-right" role="document">
        <div class="modal-content modal-content-right">
            <div class="modal-header">
                <h5 class="modal-title">Details File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab"
                            aria-controls="detail" aria-selected="true">Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="activity-tab" data-toggle="tab" href="#activity" role="tab"
                            aria-controls="activity" aria-selected="false">Activity</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                        <div class="card-body">
                            <p style="margin: 20px;"><i class="fas fa-file"></i> Brief terupdate.docx</p>
                        </div>
                        <div class="fileproperties">
                            <h6>File Properties</h6>
                            <div class="d-flex justify-content-between">
                                <div class="status">
                                    <ul>
                                        <li style="list-style: none;">Storage Used</li>
                                        <li style="list-style: none;">Type</li>
                                        <li style="list-style: none;">Owner</li>
                                    </ul>
                                </div>
                                <div class="detail">
                                    <ul>
                                        <li style="list-style: none;">100 MB</li>
                                        <li style="list-style: none;">Docx</li>
                                        <li style="list-style: none;">Yoga</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                        <div class="card-body">
                            <p style="margin: 20px;"><i class="fas fa-file"></i> Brief terupdate.docx</p>
                        </div>
                        <div class="card">
                            <div class="dropdown" style="margin-bottom: 20px;">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Today
                                </button>
                                <div class="dropdown-menu" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Yesterday</a>
                                    <a class="dropdown-item" href="#">Last Week</a>
                                    <a class="dropdown-item" href="#">Last Month</a>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="d-flex justify-content-between"
                                    style="padding-left:10px; padding-right:10px;">
                                    <p class="jam">5.05 PM</p>
                                    <p class="status-activity">Updated File</p>
                                </div>
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <p class="owner" style="line-height: 0%;">Yoga</p>
                                    <p class="file"><i class="fas fa-file"></i> Brief terupdate.docx</p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="d-flex justify-content-between"
                                    style="padding-left:10px; padding-right:10px;">
                                    <p class="jam">4.05 PM</p>
                                    <p class="status-activity">Updated File</p>
                                </div>
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <p class="owner" style="line-height: 0%;">Yoga</p>
                                    <p class="file"><i class="fas fa-file"></i> Brief terupdate.docx</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
{{-- End Side Bar Modal File --}}


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
@endpush
