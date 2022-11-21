@extends('layouts.app')

@section('title', 'Shared')

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




<livewire:shared-index />


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
