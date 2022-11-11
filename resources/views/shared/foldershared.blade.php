@extends('layouts.app')

@section('title', 'shared')

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
            <h1>Shared</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('trash.index') }}">Shared</a></div>
            </div>
        </div>
        <div class="section body ">
            <div class="section-header ">
              <select id="disabledSelect" class="form-control col-sm-2">
                <option>File</option>
              </select>
              <form class="form-inline my-10 my-lg-0 col-sm-12">
                <input class="form-control mr-sm-2 col-sm-8" type="search" placeholder="Search">
                <button class="btn btn-outline-primary my-sm-0" type="submit">Search</button>
              </form>
            </div>
            <div class="row sortable-card">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-primary">
                        <div class="card-logo p-4">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <div class="my-auto">
                                        <x-heroicon-s-folder-open style="width:40px" />
                                    </div>
                                    <div class="my-auto ml-3 d-inline-block">
                                        <h6 class="mt-2 text-dark">Web Developer</h6>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between py-auto mt-2">
                                <div class="text-center">
                                    <p class="text-small mb-0 text-dark">M. syarbini</p>
                                </div>
                                <div class="">
                                    <x-heroicon-s-globe-americas style="width:15px" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-primary">
                        <div class="card-logo p-4">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <div class="my-auto">
                                        <x-heroicon-s-folder-open style="width:40px" />
                                    </div>
                                    <div class="my-auto ml-3 d-inline-block">
                                        <h6 class="mt-2 text-dark">Web Developer</h6>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between py-auto mt-2">
                                <div class="text-center">
                                    <p class="text-small mb-0 text-dark">M. syarbini</p>
                                </div>
                                <div class="">
                                    <x-heroicon-s-globe-americas style="width:15px" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-primary">
                        <div class="card-logo p-4">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <div class="my-auto">
                                        <x-heroicon-s-folder-open style="width:40px" />
                                    </div>
                                    <div class="my-auto ml-3 d-inline-block">
                                        <h6 class="mt-2 text-dark">Web Developer</h6>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between py-auto mt-2">
                                <div class="text-center">
                                    <p class="text-small mb-0 text-dark">M. syarbini</p>
                                </div>
                                <div class="">
                                    <x-heroicon-s-globe-americas style="width:15px" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-primary">
                        <div class="card-logo p-4">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <div class="my-auto">
                                        <x-heroicon-s-folder-open style="width:40px" />
                                    </div>
                                    <div class="my-auto ml-3 d-inline-block">
                                        <h6 class="mt-2 text-dark">Web Developer</h6>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between py-auto mt-2">
                                <div class="text-center">
                                    <p class="text-small mb-0 text-dark">M. syarbini</p>
                                </div>
                                <div class="">
                                    <x-heroicon-s-globe-americas style="width:15px" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-primary">
                        <div class="card-logo p-4">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <div class="my-auto">
                                        <x-heroicon-s-folder-open style="width:40px" />
                                    </div>
                                    <div class="my-auto ml-3 d-inline-block">
                                        <h6 class="mt-2 text-dark">Web Developer</h6>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between py-auto mt-2">
                                <div class="text-center">
                                    <p class="text-small mb-0 text-dark">M. syarbini</p>
                                </div>
                                <div class="">
                                    <x-heroicon-s-globe-americas style="width:15px" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-primary">
                        <div class="card-logo p-4">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <div class="my-auto">
                                        <x-heroicon-s-folder-open style="width:40px" />
                                    </div>
                                    <div class="my-auto ml-3 d-inline-block">
                                        <h6 class="mt-2 text-dark">Web Developer</h6>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between py-auto mt-2">
                                <div class="text-center">
                                    <p class="text-small mb-0 text-dark">M. syarbini</p>
                                </div>
                                <div class="">
                                    <x-heroicon-s-globe-americas style="width:15px" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<x-modal.basic />

<x-modal.detail />


@endsection

@push('scripts')
<script>
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
