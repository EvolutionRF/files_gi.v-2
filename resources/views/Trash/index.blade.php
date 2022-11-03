@extends('layouts.app')

@section('title', 'Trash')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h2>Trash</h2>
    </div>
    <div class="section body ">
      <div class="section-header ">
        <select id="disabledSelect" class="form-control col-sm-2">
          <option>File</option>
        </select>
        <form action="/users" method="GET" class="form-inline my-10 my-lg-0 col-sm-12">
          <input class="form-control mr-sm-2 col-sm-8" name="search" value="" placeholder="enter search name">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">{{ @Request()->search ?? 'Search' }}</button>
        </form>
      </div>
      <div class="section-body">
            <div class="card">
              <table class="table mt-0">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Last Modify</th>
                    <th scope="col">Access</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>guruinovatif.docx</th>
                    <td>Nesya Nisrina</td>
                    <td>2022:10:10</td>
                    <td>Publik</td>
                    <td><x-heroicon-s-ellipsis-vertical style="width:15px" /></td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>guruinovatif.docx</th>
                    <td>Nesya Nisrina</td>
                    <td>2022:10:10</td>
                    <td>Privat</td>
                    <td><x-heroicon-s-ellipsis-vertical style="width:15px" /></td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>guruinovatif.docx</th>
                    <td>Nesya Nisrina</td>
                    <td>2022:10:10</td>
                    <td>Publik</td>
                    <td><x-heroicon-s-ellipsis-vertical style="width:15px" /></td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>guruinovatif.docx</th>
                    <td>Nesya Nisrina</td>
                    <td>2022:10:10</td>
                    <td>Publik</td>
                    <td><x-heroicon-s-ellipsis-vertical style="width:15px" /></td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>guruinovatif.docx</th>
                    <td>Nesya Nisrina</td>
                    <td>2022:10:10</td>
                    <td>Privat</td>
                    <td><x-heroicon-s-ellipsis-vertical style="width:15px" /></td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>guruinovatif.docx</th>
                    <td>Nesya Nisrina</td>
                    <td>2022:10:10</td>
                    <td>Publik</td>
                    <td><x-heroicon-s-ellipsis-vertical style="width:15px" /></td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Hafecs.docx</th>
                    <td>Nesya Nisrina</td>
                    <td>2022:10:10</td>
                    <td>Privat</td>
                    <td><x-heroicon-s-ellipsis-vertical style="width:15px" /></td>
                  </tr>
                </tbody>
              </table>
            </div>
          {{-- </div> --}}
        {{-- </div> --}}
      </div>
    </div>
  </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->

<!-- Page Specific JS File -->
{{-- <script src="{{ asset('js/page/index-0.js') }}"></script> --}}
@endpush