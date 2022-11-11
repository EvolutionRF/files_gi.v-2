@extends('layouts.app')

@section('title', 'Data Users')

@push('style')
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Users</h1>
        </div>

        {{-- @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
        @endif --}}


        <div class="section-body">
            <h2 class="section-title">Manage Data Users</h2>
            <div class="card">
                <div class="card-header">
                    <div class="card-header-form col-12 my-auto">
                        <div class="input-group row d-flex justify-content-between ">
                            <div class="col-7 row d-flex align-items-center">
                                <form id="select-division-form">
                                    <div class="form-group my-auto">
                                        <select class="form-control" onchange="this.form.submit()" name="division"
                                            id="division-filter">
                                            <option value="0">Show All</option>
                                            @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}" {{ $division->id == @$_GET['division'] ?
                                                'selected' : '' }}>
                                                {{ $division->name }}</option>
                                            @endforeach>
                                        </select>
                                    </div>
                                </form>
                                <div class="ml-2">
                                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
                                        data-target=".show-modal" data-title="Create User"
                                        data-url="{{ route('users.create') }}"> + Add User
                                        Data
                                    </button>
                                </div>
                            </div>
                            <div class="search-element">
                                <form action="">
                                    <input class="form-control selectric" type="search" placeholder="Search"
                                        aria-label="Search" name="search" id="search">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped table-md table text-center" id="example">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Divisi</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ @$user->division->name }}</td>
                                        <td>{{ $user->getRoleNames()[0] }}</td>
                                        <td>
                                            <a type="button" href="" class="text-success" data-toggle="modal"
                                                data-target=".show-modal" data-title="Update User"
                                                data-url="{{ route('users.edit',$user->id) }}">
                                                <x-heroicon-s-pencil-square style="width:15px" />
                                            </a>

                                            {{-- <a class="btn  fas fa-key text-primary"></a> --}}
                                            <a type="button" href="" class="text-primary mx-2" data-toggle="modal"
                                                data-target=".show-modal" data-title="Reset Password User"
                                                data-url="{{ route('users.showreset',$user->id) }}">
                                                <x-heroicon-s-key style="width:15px" />
                                            </a>

                                            <a type="button" class="text-danger" data-toggle="modal"
                                                data-target=".show-modal" data-title="Delete User"
                                                data-url="{{ route('users.showdestroy',$user->id) }}">
                                                <x-heroicon-s-trash style="width:15px" />

                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="card-footer row d-flex justify-content-between ">
                            <p>Showing 1 to
                                @if ($users->perPage() >= $users->total())
                                {{ $users->total() }}
                                @else
                                {{ $users->perPage() }}
                                @endif
                                of {{ $users->total() }} entries
                            </p>
                            {{ $users->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<x-modal.basic />
@endsection


@push('scripts')
<script>
    const selectDivisionForm = document.querySelector('#select-division-form')
    const selectDivisionInput = document.querySelector('#division-filter')

    selectDivisionInput.addEventListener('input', e => {
    console.log()
    if (selectDivisionInput.value != 0) {
        selectDivisionForm.submit()
    } else {
        window.location.assign('{{ route('users.index') }}')
    }
    })
</script>


@endpush
