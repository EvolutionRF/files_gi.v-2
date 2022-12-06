<div class="tab-content" id="side">
    <div class="tab-pane fade show active tab-custome" role="tabpanel">
        <div class="card-body d-flex align-content-center">
            <x-heroicon-s-folder-open style="width:20px" />
            <p class="my-auto pl-2">{{ $folder->name }}</p>
        </div>
        <div class="detail">
            <div class="col-12 p-0">
                <div class="d-flex justify-content-left p-0">
                    {{-- <select  name="" id="">
                        <option value="">Today</option>
                    </select> --}}
                    <div class=" dropdown">
                        <a class="dropdown-toggle">
                          Today
                        </a>
                    </div>
                </div>
                @foreach($folder_activity as $data)
                <div>
                    <div class="d-flex justify-content-between">
                        <div>{{ $data->created_at->format('H:i:s') }}</div>
                        <div>{{ $data->description }}</div>
                    </div>
                    <div>{{ $data->causer->name }}</div>
                    <div class="d-flex">
                        <div class="d-flex justify-content-beetween">
                          <x-heroicon-s-document style="width:18px"/>
                        </div>
                        <div>{{ $data->subject->name }}</div>
                    </div>
                </div>
                <hr>
                @endforeach

            </div>
        </div>
    </div>
</div>
