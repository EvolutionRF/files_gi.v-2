@extends('layouts.app')

@section('title', 'Data Users')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">


@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Users</h1>
            {{-- <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div> --}}
        </div>

        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div>{{$error}}</div>
        @endforeach
        @endif


        <div class="section-body">
            <h2 class="section-title">Manage Data Users</h2>
            <div class="card">
                <div class="card-header">
                    <div class="card-header-form col-12 my-auto">
                        <div class="input-group row d-flex justify-content-between ">
                            <div class="col-7 row d-flex align-items-center">
                                <form action="{{ route('users.index') }}" method="get" id="select-division-form">
                                    <div class="form-group my-auto">
                                        <select class="form-control" id="division-filter" name="division">
                                            <option value="0">Show All</option>
                                            @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}" {{ ($division->id ==
                                                $users[0]->division_id)?'selected':'' }}>{{ $division->name }}</option>
                                            @endforeach>
                                        </select>
                                    </div>
                                </form>
                                <div class="ml-2">
                                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
                                        data-target="#AddUser"> + Add User
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
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ @ $user->division->name }}</td>
                                        <td>{{ $user->getRoleNames()[0] }}</td>
                                        <td>
                                            <button class="btn fas fa-pen-square text-success"
                                                onclick="editUser('{{ $user->name }}','{{ $user->username }}','{{ @$user->division->name }}')"></button>
                                            <a class="btn  fas fa-key text-primary"></a>
                                            <button class="btn fas fa-trash text-danger"
                                                onclick="deleteUser('{{ $user->name }}','{{ $user->username }}','{{ @$user->division_id }}','{{ route('users.destroy',$user->id) }}')"
                                                data-toggle="modal" data-target="#deleteUser"></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="card-footer row d-flex justify-content-between ">
                            <p>Showing 1 to
                                @if($users->perPage()>= $users->total())
                                {{ $users->total() }}
                                @else
                                {{ $users->perPage() }}
                                @endif
                                of {{ $users->total() }} entries</p>
                            {{ $users->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Modal Add Data Users --}}
<div class="modal fade" tabindex="-1" role="dialog" id="AddUser" name="AddUser">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="dropdown-divider"></div>

            <form action="{{ route('users.store') }}" method="POST" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name')  }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                            name="username" value="{{ old('username')}}">
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Password(set as default)</label>
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control" type="password" id="password" name="password" value="password"
                                readonly>
                            <div class="input-group-append">
                                <a href="" class="text-decoration-none">
                                    <div class="input-group-text">
                                        <i class="fas fa-eye-slash" aria-hidden="true"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Divisi</label>
                        <select class="form-control @error('division') is-invalid @enderror" id="division"
                            name="division">
                            <option hidden value="">Select Divisi</option>
                            @foreach ($divisions as $division)
                            <option value="{{ $division->id }}" {{ (old('division')==$division->id)?'selected':"" }}>{{
                                $division->name }}</option>
                            @endforeach>
                        </select>
                        @error('division')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal --}}


{{-- Modal Delete Data Users --}}
<div class="modal fade" tabindex="-1" role="dialog" id="deleteUser" name="deleteUser">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="dropdown-divider"></div>

            <form action="" method="POST" id="deleteForm" name="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="nameDelete" name="name" readonly>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="usernameDelete" name="usernameDelete" readonly>
                    </div>
                    <div class="form-group">
                        <label>Divisi</label>
                        <select class="form-control" id="divisionDelete" name="divisionDelete" readonly>
                            <option hidden value="">Select Divisi</option>
                            @foreach ($divisions as $division)
                            <option value="{{ $division->id }}">{{
                                $division->name }}</option>
                            @endforeach>
                        </select>
                    </div>
                    <p class="text-center">Are you sure delete the entire data?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal --}}




@endsection

@push('scripts')
<script>
    $(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});

// Show Modal with Error
@if($errors->first('name')||$errors->first('username')||$errors->first('divisions'))
    $('#AddUser').modal('show');
@elseif($errors->first('nameEdit')||$errors->first('usernameEdit')||$errors->first('divisionsEdit'))
    $('#editUser').modal('show');
@endif


function deleteUser(name,username,division,route) {
        var nameForm = document.querySelector('#nameDelete');
        var usernameForm = document.querySelector('#usernameDelete');
        var divisionForm = document.querySelector('#divisionDelete');
        var formDelete =document.querySelector('#deleteForm');

        nameForm.value = name;
        usernameForm.value = username;
        divisionForm.value = division;
        formDelete.action = route;
}
        const selectDivisionForm = document.querySelector('#select-division-form')
        const selectDivisionInput = document.querySelector('#division-filter')

        selectDivisionInput.addEventListener('input', e => {
            console.log()
            if (selectDivisionInput.value != 0) {
                selectDivisionForm.submit()
            }else{
                window.location.assign('{{ route('users.index') }}')
            }
        })



</script>


<!-- JS Libraies -->
{{-- <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script> --}}
{{-- <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script> --}}
{{-- <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script> --}}
{{-- <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script> --}}
{{-- <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script> --}}
<script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>




<!-- Page Specific JS File -->
{{-- <script src="{{ asset('js/page/index-0.js') }}"></script> --}}
@endpush
