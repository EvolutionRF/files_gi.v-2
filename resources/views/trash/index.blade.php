@extends('layouts.app')

@section('title', 'Trash')

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
            <h1>Trash</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('trash.index') }}">Trash</a></div>
            </div>
        </div>

        @if((count($trashBase) >= 1) || (count($trashcontentFolder) >= 1)||(count($trashcontentFile) >= 1))
        @if((count($trashBase) >= 1))
        <h2 class="section-title row">
            Base Folder Deleted
        </h2>
        @include('trash._folder')
        @else
        {{-- <div class="text-center">
            <p class="text-dark">There are no Base Folder here </p>
        </div> --}}
        @endif

        @if((count($trashcontentFolder) >= 1))
        <h2 class="section-title row">
            Folder Deleted
        </h2>
        @include('trash.content._folder')
        @else
        @endif

        @if((count($trashcontentFile) >= 1))
        <h2 class="section-title row">
            File Deleted
        </h2>
        @include('trash.content._file')
        @else
        @endif



        @else
        <div class="text-center">
            <p class="text-dark">There are nothing here </p>
        </div>
        @endif





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
