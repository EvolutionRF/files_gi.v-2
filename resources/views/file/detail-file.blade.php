<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail"
            onclick="Change('details')">Details</a>
    </li>
    <li class="nav-item">
        <a class="nav-link " id="activity-tab" data-toggle="tab" href="#activity" role="tab" aria-controls="activity"
            onclick="Change('activity')">Activity</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="content-detail" role="tabpanel" aria-labelledby="detail-tab">
        <div class="card-body text-center">
            <p class="my-auto text-bold text-dark"><i class="fas fa-file"></i> {{ $file->name }}</p>
            <small>{{ @$file->getMedia('file')->first()->file_name }}</small>
        </div>
        <div class="fileproperties">
            <h6>File Properties</h6>
            <div class="col-10 p-0">
                <div class="d-flex justify-content-between p-0">
                    <div class="text-left">
                        <p class="m-0">Type</p>
                        <p class="m-0">Owner</p>
                        <p class="m-0">Created at</p>
                        <p class="mb-0">Size</p>
                    </div>

                    <div class="text-left ml-3">
                        <p class="mb-0"> {{ $file->isPrivate }}</p>
                        <p class="mb-0">{{ $file->user->name }}</p>
                        <p class="mb-0">{{ $file->created_at }}</p>
                        <p>{{ @$file->getMedia('file')->first()->human_readable_size }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade show" id="content-activity" role="tabpanel" aria-labelledby="activity-tab">
        <div class="card-body">
            <p style="margin: 20px;"><i class="fas fa-file"></i> Brief terupdate.docx</p>
        </div>
        <div class="card">
            <div class="dropdown" style="margin-bottom: 20px;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Today
                </button>
                <div class="dropdown-menu" aria-labelledby="triggerId">
                    <a class="dropdown-item" href="#">Today</a>
                    <a class="dropdown-item" href="#">Yesterday</a>
                    <a class="dropdown-item" href="#">Last Week</a>
                    <a class="dropdown-item" href="#">Last Month</a>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="d-flex justify-content-between" style="padding-left:10px; padding-right:10px;">
                    <p class="jam">5.05 PM</p>
                    <p class="status-activity">Updated File</p>
                </div>
                <div style="padding-left: 10px; padding-right: 10px;">
                    <p class="owner" style="line-height: 0%;">Yoga</p>
                    <p class="file"><i class="fas fa-file"></i> Brief terupdate.docx</p>
                </div>
            </div>
            <div class="card">
                <div class="d-flex justify-content-between" style="padding-left:10px; padding-right:10px;">
                    <p class="jam">4.05 PM</p>
                    <p class="status-activity">Updated File</p>
                </div>
                <div style="padding-left: 10px; padding-right: 10px;">
                    <p class="owner" style="line-height: 0%;">Yoga</p>
                    <p class="file"><i class="fas fa-file"></i> Brief terupdate.docx</p>
                </div>
            </div>
        </div>
    </div>
</div>
