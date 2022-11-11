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
            <div class="section-body">
                  <div class="card">
                    <table class="table mt-0">
                      <thead>
                        <tr>
                          <div>
                          <th scope="col">Name  <x-heroicon-s-arrow-long-up style="width:15px" /></th>
                          </div>
                        </div>
                          <th scope="col">Owner</th>
                          <th scope="col">Last Modify <x-heroicon-s-arrow-long-up style="width:15px" /></th>
                          <th scope="col">Access</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th> <x-heroicon-s-document-text style="width:15px"/>  guruinovatif.docx</th>
                          <td>Nesya Nisrina</td>
                          <td>2022:10:10</td>
                          <td>Publik</td>
                          <td><x-heroicon-s-ellipsis-vertical style="width:15px" /></td>
                        </tr>
                      </tbody>
                      <tbody>
                        <tr>
                          <th><x-heroicon-s-link style="width:15px" />  guruinovatif.docx</th>
                          <td>Nesya Nisrina</td>
                          <td>2022:10:10</td>
                          <td>Privat</td>
                          <td><x-heroicon-s-ellipsis-vertical style="width:15px" /></td>
                        </tr>
                      </tbody>
                      <tbody>
                        <tr>
                          <th><x-heroicon-s-link style="width:15px" />  guruinovatif.docx</th>
                          <td>Nesya Nisrina</td>
                          <td>2022:10:10</td>
                          <td>Publik</td>
                          <td><x-heroicon-s-ellipsis-vertical style="width:15px" /></td>
                        </tr>
                      </tbody>
                      <tbody>
                        <tr>
                          <th><x-heroicon-s-link style="width:15px" />  guruinovatif.docx</th>
                          <td>Nesya Nisrina</td>
                          <td>2022:10:10</td>
                          <td>Publik</td>
                          <td><x-heroicon-s-ellipsis-vertical style="width:15px" /></td>
                        </tr>
                      </tbody>
                      <tbody>
                        <tr>
                          <th> <x-heroicon-s-document-text style="width:15px"/>  guruinovatif.docx</th>
                          <td>Nesya Nisrina</td>
                          <td>2022:10:10</td>
                          <td>Privat</td>
                          <td><x-heroicon-s-ellipsis-vertical style="width:15px" /></td>
                        </tr>
                      </tbody>
                      <tbody>
                        <tr>
                          <th> <x-heroicon-s-document-text style="width:15px"/>  guruinovatif.docx</th>
                          <td>Nesya Nisrina</td>
                          <td>2022:10:10</td>
                          <td>Publik</td>
                          <td><x-heroicon-s-ellipsis-vertical style="width:15px" /></td>
                        </tr>
                      </tbody>
                      <tbody>
                        <tr>
                          <th> <x-heroicon-s-document-text style="width:15px"/>  Hafecs.docx</th>
                          <td>Nesya Nisrina</td>
                          <td>2022:10:10</td>
                          <td>Privat</td>
                          <td><x-heroicon-s-ellipsis-vertical style="width:15px" /></td>
                        </tr>
                      </tbody>
                    </table>
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
