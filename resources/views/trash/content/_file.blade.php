<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table-striped table-md table" id="example">
            <tr class="text-bold">
                <th>Nama</th>
                <th>Owner</th>
                <th>Last Modify</th>
                <th>Access</th>
                <th class="text-center">Action</th>
            </tr>
            @foreach($trashcontentFile as $file)
            <tr>
                <td>
                    <x-heroicon-s-document style="width:15px" class="ml-0" /> {{ $file->name }}
                </td>
                <td>{{ $file->user->name }}</td>
                {{-- <td>{{ @$file->getMedia('file')->first()->updated_at->diffForHumans() }}</td> --}}
                <td>{{ $file->updated_at->diffForHumans() }}</td>
                <td>{{ $file->isPrivate }}</td>
                <td class="text-center">
                    <ul class="navbar-nav">
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user p-0">
                                <x-heroicon-s-ellipsis-vertical style="width:15px" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right ml-0">
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target=".right_modal" data-title="Detail File" data-url="">
                                    <x-heroicon-s-information-circle style="width:15px" class="ml-0" />
                                    Detail
                                </a>
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target=".show-modal" data-title="Restore File {{ $file->name }}"
                                    data-url="{{ route('trash.showrestore',$file->slug) }}">
                                    <x-heroicon-s-arrow-path-rounded-square style="width:15px" class="ml-0" />
                                    Restore
                                </a>
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target=".show-modal" data-title="Delete File"
                                    data-url="{{ route('trash.showforcedelete',$file->slug) }}">
                                    <x-heroicon-s-trash style="width:15px" class="ml-0" /> Delete
                                </a>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

</div>
