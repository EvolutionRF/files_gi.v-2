@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


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
        @include('dashboard._summary')
        <div>
            <div class="form-group form-group-sm">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <x-heroicon-s-magnifying-glass style="width:15px" />
                        </div>
                    </div>
                    <input type="search" class="form-control">
                    <button class="btn btn-primary btn-sm btn-icon" data-toggle="modal" data-target=".show-modal"
                        data-title="Create Folder" data-url="{{ route('basefolder.create') }}">
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
                                                data-target=".right_modal" data-title="Detail Folder "
                                                data-url="{{ route('basefolder.show', $baseFolder->id) }}">
                                                <x-heroicon-s-information-circle style="width:15px" class="ml-0" />
                                                Detail
                                            </a>
                                            @if($baseFolder->owner_id == auth()->user()->id)
                                            <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                                data-target=".show-modal"
                                                data-title="Manage Folder {{ $baseFolder->name }}"
                                                data-url="{{ route('basefolder.manage', $baseFolder->id) }}">
                                                <x-heroicon-s-cog-8-tooth style="width:15px" class="ml-0" />
                                                Manage
                                            </a>
                                            <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                                data-target=".show-modal" data-title="Rename Folder"
                                                data-url="{{ route('basefolder.rename', $baseFolder->id) }}">
                                                <x-heroicon-s-pencil-square style="width:15px" class="ml-0" />
                                                Rename
                                            </a>
                                            <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                                data-target=".show-modal" data-title="Delete Folder"
                                                data-url="{{ route('basefolder.showdelete', $baseFolder->id) }}">
                                                <x-heroicon-s-trash style="width:15px" class="ml-0" /> Delete
                                            </a>
                                            @else
                                            <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                                data-target=".show-modal" data-title="Ask Request"
                                                data-url="{{ route('request',$baseFolder->id) }}">
                                                <x-heroicon-s-pencil-square style="width:15px" class="ml-0" />
                                                Ask Request
                                            </a>
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
            @endforeach
        </div>
        {{ $baseFolders->links() }}
    </section>
</div>

<x-modal.basic />

<x-modal.detail />


@endsection

@push('scripts')
<script>
    function newtab(route) {
        console.log(route);
        window.location.assign(route);
    }

    function cardClick(target) {
            var get = '#' + target;
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

</Script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

@endpush
