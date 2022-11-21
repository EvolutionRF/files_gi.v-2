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
            @foreach($sharedContentFile as $file)
            <tr>
                <td>
                    @if($file->content->type =='file')
                    @if (@$file->content->getMedia('file')->first()->mime_type ==
                    'image/png'|| $file->content->getMedia('file')->first()->mime_type ==
                    'image/jpg'||$file->content->getMedia('file')->first()->mime_type == 'image/jpeg')
                    <x-heroicon-s-photo style="width:15px" class="ml-0" />
                    @else
                    <x-heroicon-s-document style="width:15px" class="ml-0" />
                    @endif
                    <a href="{{ route('file.showdownload', $file->content->slug) }}" type="button" data-toggle="modal"
                        data-target=".show-modal" data-title="Download File"
                        data-url="{{ route('file.showdownload', $file->content->slug) }}">
                        {{ $file->content->name }}
                    </a>
                    @else
                    <x-heroicon-s-link style="width:15px" class="ml-0" />
                    <a href="" type="button" data-toggle="modal" data-target=".show-modal" data-title="URL"
                        data-url="{{ route('url.showurl',$file->content->slug) }}">
                        {{ $file->content->name }}
                    </a>
                    @endif

                </td>
                <td>{{ $file->content->user->name }}</td>
                <td>{{ $file->content->updated_at->diffForHumans() }}</td>
                <td>{{ $file->content->isPrivate }}</td>
                <td class="text-center">
                    <ul class="navbar-nav">
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user p-0">
                                <x-heroicon-s-ellipsis-vertical style="width:15px" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right ml-0">
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target=".right_modal" data-title="Detail {{ ($file->content->type == " file")
                                    ? "File" : "URL" }}" data-url={{ ($file->content->type == "file") ?
                                    route('file.showdetail',
                                    $file->content->slug) : route('url.showdetail',
                                    $file->content->slug) }}>
                                    <x-heroicon-s-information-circle style="width:15px" class="ml-0" />
                                    Detail
                                </a>
                                @if($file->content->owner_id == auth()->user()->id)
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target=".show-modal" data-title="Manage {{ ($file->content->type == " file")
                                    ? "File" : "URL" }} {{ $file->content->name }}"
                                    data-url="{{ route('file.showmanage', $file->content->slug) }}">
                                    <x-heroicon-s-cog-8-tooth style="width:15px" class="ml-0" />
                                    Manage
                                </a>
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target=".show-modal" data-title="Rename {{ ($file->content->type == " file")
                                    ? "File" : "URL" }}"
                                    data-url="{{ route('file.showrename', $file->content->slug) }}">
                                    <x-heroicon-s-pencil-square style="width:15px" class="ml-0" />
                                    Rename
                                </a>
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target=".show-modal" data-title="Delete {{ ($file->content->type == " file")
                                    ? "File" : "URL" }}"
                                    data-url="{{ route('file.showdelete', $file->content->slug) }}">
                                    <x-heroicon-s-trash style="width:15px" class="ml-0" /> Delete
                                </a>
                                @else
                                <?php $param = "" ?>
                                @foreach($file->content->access as $haveAccess)
                                @if($haveAccess->user_id== auth()->user()->id)
                                <?php $param = "ada" ?>
                                @endif
                                @endforeach
                                @if($file->content->isPrivate=='private')
                                @if($param)
                                @else
                                <a type="button" class="dropdown-item has-icon pl-2" data-toggle="modal"
                                    data-target=".show-modal" data-title="Ask Request"
                                    data-url="{{ route('request',$file->content->id) }}">
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
