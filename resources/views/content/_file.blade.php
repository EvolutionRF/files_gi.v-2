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
                    @if($file->type =='file')
                    @if (@$file->getMedia('file')->first()->mime_type ==
                    'image/png'|| $file->getMedia('file')->first()->mime_type ==
                    'image/jpg'||$file->getMedia('file')->first()->mime_type == 'image/jpeg')
                    <x-heroicon-s-photo style="width:15px" class="ml-0" />
                    @else
                    <x-heroicon-s-document style="width:15px" class="ml-0" />
                    @endif
                    <a href="{{ route('file.showdownload', $file->slug) }}" type="button" data-toggle="modal"
                        data-target=".show-modal" data-title="Download File"
                        data-url="{{ route('file.showdownload', $file->slug) }}">
                        {{ $file->name }}
                    </a>
                    @else
                    <x-heroicon-s-link style="width:15px" class="ml-0" />
                    <a href="" type="button" data-toggle="modal" data-target=".show-modal" data-title="URL" data-url="">
                        {{ $file->name }}
                    </a>
                    @endif


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
                                    data-target=".right_modal" data-title="Detail {{ ($file->type == " file") ? "File"
                                    : "URL" }}" data-url={{ ($file->type == "file") ? route('file.showdetail',
                                    $file->slug) : route('url.showdetail',
                                    $file->slug) }}>
                                    <x-heroicon-s-information-circle style="width:15px" class="ml-0" />
                                    Detail
                                </a>
                                @if($file->owner_id == auth()->user()->id)
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target=".show-modal" data-title="Manage {{ ($file->type == " file") ? "File"
                                    : "URL" }} {{ $file->name }}"
                                    data-url="{{ route('file.showmanage', $file->slug) }}">
                                    <x-heroicon-s-cog-8-tooth style="width:15px" class="ml-0" />
                                    Manage
                                </a>
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target=".show-modal" data-title="Rename {{ ($file->type == " file") ? "File"
                                    : "URL" }}" data-url="{{ route('file.showrename', $file->slug) }}">
                                    <x-heroicon-s-pencil-square style="width:15px" class="ml-0" />
                                    Rename
                                </a>
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target=".show-modal" data-title="Delete {{ ($file->type == " file") ? "File"
                                    : "URL" }}" data-url="{{ route('file.showdelete', $file->slug) }}">
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
