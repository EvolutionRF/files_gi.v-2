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
            @foreach($content_file as $file)
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
                                    data-target=".right_modal" data-title="Detail File"
                                    data-url="{{ route('file.showdetail', $file->slug) }}">
                                    <x-heroicon-s-information-circle style="width:15px" class="ml-0" />
                                    Detail
                                </a>
                                @if($file->owner_id == auth()->user()->id)
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target=".show-modal" data-title="Manage File {{ $file->name }}"
                                    data-url="{{ route('file.showmanage', $file->slug) }}">
                                    <x-heroicon-s-cog-8-tooth style="width:15px" class="ml-0" />
                                    Manage
                                </a>
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target=".show-modal" data-title="Rename Folder"
                                    data-url="{{ route('file.showrename', $file->slug) }}">
                                    <x-heroicon-s-pencil-square style="width:15px" class="ml-0" />
                                    Rename
                                </a>
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target=".show-modal" data-title="Delete Folder" data-url="">
                                    <x-heroicon-s-trash style="width:15px" class="ml-0" /> Delete
                                </a>
                                @else
                                <?php $param = "" ?>
                                @foreach($file->access as $haveAccess)
                                @if($haveAccess->user_id== auth()->user()->id)
                                <?php $param = "ada" ?>
                                @endif
                                @endforeach
                                @if($file->isPrivate=='private')
                                @if($param)
                                @else
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target=".show-modal" data-title="Ask Request"
                                    data-url="{{ route('request',$file->id) }}">
                                    <x-heroicon-s-pencil-square style="width:15px" class="ml-0" />
                                    Ask Request
                                </a>
                                @endif
                                @endif
                                @endif
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

</div>
