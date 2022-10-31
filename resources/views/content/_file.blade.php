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
                <td>{{ @$file->getMedia('file')->first()->created_at->diffForHumans() }}</td>
                <td>{{ $file->isPrivate }}</td>
                <td class="text-center">
                    <button class="btn btn-info" data-toggle="modal" data-target="#Sidebar-Modal-File">Detail</button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
