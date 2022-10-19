@extends('layouts.app')

@section('title', 'Dashboard')

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
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            </div>
        </div>
        @role('admin')
        <h2 class="section-title">Summary</h2>
        <div class="row sortable-card">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-primary">
                    <div class="card-logo p-3">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <x-heroicon-s-folder-open style="width:40px" />
                                </div>
                                <div class="my-auto ml-3 d-inline-block">
                                    <h6 class="mt-2 text-dark">Folder</h6>
                                </div>
                            </div>
                            <div class="text-left">
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                        </div>
                        <div class="d-flex py-auto mt-2">
                            <div class="text-center">
                                <p class="text-small mb-0 text-dark">999++ Folder</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-primary">
                    <div class="card-logo p-3">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <x-heroicon-s-document style="width:40px" />
                                </div>
                                <div class="my-auto ml-3 d-inline-block">
                                    <h6 class="mt-2 text-dark">Document</h6>
                                </div>
                            </div>
                            <div class="text-left">
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                        </div>
                        <div class="d-flex py-auto mt-2">
                            <div class="text-center">
                                <p class="text-small mb-0 text-dark">999++ Document</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-primary">
                    <div class="card-logo p-3">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <x-heroicon-s-photo style="width:40px" />
                                </div>
                                <div class="my-auto ml-3 d-inline-block">
                                    <h6 class="mt-2 text-dark">Image</h6>
                                </div>
                            </div>
                            <div class="text-left">
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                        </div>
                        <div class="d-flex py-auto mt-2">
                            <div class="text-center">
                                <p class="text-small mb-0 text-dark">999++ Image</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-primary">
                    <div class="card-logo p-3">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <x-heroicon-s-document-plus style="width:40px" />
                                </div>
                                <div class="my-auto ml-3 d-inline-block">
                                    <h6 class="mt-2 text-dark">Etc</h6>
                                </div>
                            </div>
                            <div class="text-left">
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                        </div>
                        <div class="d-flex py-auto mt-2">
                            <div class="text-center">
                                <p class="text-small mb-0 text-dark">999++ Etc</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @endrole
        <div>
            <div class="form-group form-group-sm">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <x-heroicon-s-magnifying-glass style="width:15px" />
                        </div>
                    </div>
                    <input type="search" class="form-control">
                    <button class="btn btn-primary btn-sm btn-icon" data-toggle="modal" data-target="#TambahFolder">
                        <x-heroicon-s-plus style="width:15px" />
                        <span>
                            Create
                        </span>
                    </button>
                </div>
            </div>

        </div>


        <h2 class="section-title row">
            Base Folder
        </h2>

        <div class="row sortable-card">
            @foreach ($baseFolders as $baseFolder)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card card-secondary cardClick" id="card-{{ $baseFolder->id }}"
                    onclick="cardClick('card-{{ $baseFolder->id }}')" style="cursor: pointer"
                    ondblclick="newtab('{{ route('EnterFolder', $baseFolder->slug) }}')">
                    <div class="card-logo p-3">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex text-primary">
                                <div class="my-auto">
                                    <x-heroicon-s-folder-open style="width:40px" />
                                </div>
                                <div class="my-auto ml-3 d-inline-block">
                                    <h6 class="mt-2 text-dark">{{ $baseFolder->name }}</h6>
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
                                                data-target="#Sidebar-Modal-Folder">
                                                <x-heroicon-s-information-circle style="width:15px" class="ml-0" />
                                                Detail
                                            </a>
                                            <a type="button" class="dropdown-item has-icon pl-2">
                                                <x-heroicon-s-cog-8-tooth style="width:15px" class="ml-0" />
                                                Manage
                                            </a>
                                            <a type="button" class="dropdown-item has-icon pl-2">
                                                <x-heroicon-s-arrow-path style="width:15px" class="ml-0" />
                                                Update
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
            @endforeach
        </div>
    </section>
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
                <form action="{{ route('Basefolder.create') }}" method="POST">
                    @csrf

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
                            <label class="custom-control-label" for="isPrivate2">Privates</label>
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

{{-- Side Bar Modal --}}
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
{{-- End Side Bar Modal --}}



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
        // $('#Sidebar-Modal').modal('show')
    };


    function newtab(route) {
        console.log(route);
        window.location.assign(route);
    }
</Script>
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
