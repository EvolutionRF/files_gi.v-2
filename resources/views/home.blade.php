@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
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
        <h2 class="section-title">Base Folder</h2>

        <div class="row sortable-card">
            @foreach($baseFolders as $baseFolder)
            <div class="col-12 col-md-6 col-lg-4">

                <div class="card card-secondary cardClick" id="card-{{ $baseFolder->id }}"
                    onclick="cardClick('card-{{ $baseFolder->id }}')">
                    <div class="card-logo p-3">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('EnterFolder',$baseFolder->slug) }}" style="text-decoration: none">
                                <div class="d-flex">
                                    <div class="my-auto">
                                        <x-heroicon-s-folder-open style="width:40px" />
                                    </div>
                                    <div class="my-auto ml-3 d-inline-block">
                                        <h6 class="mt-2 text-dark">{{ $baseFolder->name }}</h6>
                                    </div>
                                </div>
                            </a>
                            <div class="text-left">
                                <a href="">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between py-auto mt-2">
                            <div>
                                <h6 class="text-small mb-0 ml-2">{{ $baseFolder->user->name }}</h6>
                            </div>
                            <div>
                                @if($baseFolder->isPrivate =='private')
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
