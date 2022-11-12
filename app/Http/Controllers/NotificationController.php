<?php

namespace App\Http\Controllers;

use App\Models\BaseFolder;
use App\Models\BaseFolderAccess;
use App\Models\Content;
use App\Models\ContentAccess;
use App\Models\Permission;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notif = BaseFolderAccess::whereIn('basefolder_id', function ($query) {
            $query->select('id')
                ->from(with(new BaseFolder())->getTable())
                ->where('owner_id', auth()->user()->id);
        })->where('status', 'pending')->get();

        $contentReq = ContentAccess::whereIn('content_id', function ($query) {
            $query->select('id')
                ->from(with(new Content())->getTable())
                ->where('owner_id', auth()->user()->id);
        })->where('status', 'pending')->get();

        $data = [
            'BaseFolderRequests' => $notif,
            'ContentRequest' => $contentReq
        ];
        return view('components.notification', $data);
    }

    public function BaseRequestHandler(Request $request, $id, SweetAlertFactory $flasher)
    {

        // return response()->json($request);
        $access = BaseFolderAccess::findOrFail($id);

        $data = [
            'status' => $request->status
        ];
        $done = $access->update($data);


        // return response()->json($access->status);

        if ($access->status == 'accept') {
            activity()->causedBy(auth()->user())->performedOn($access)->log('Accept Access');
            $flasher->addSuccess('Request Has been Accept');
            return back();
        } else {
            activity()->causedBy(auth()->user())->performedOn($access)->log('Deciline Access');
            $flasher->addSuccess('Request Has been Deciline');
            return back();
        }
    }

    public function ContentRequestHandler(Request $request, $id, SweetAlertFactory $flasher)
    {
        $access = ContentAccess::findOrFail($id);

        $data = [
            'status' => $request->status
        ];
        $done = $access->update($data);


        // return response()->json($access->status);

        if ($access->status == 'accept') {
            activity()->causedBy(auth()->user())->performedOn($access)->log('Accept Access');
            $flasher->addSuccess('Request Has been Accept');
            return back();
        } else {
            activity()->causedBy(auth()->user())->performedOn($access)->log('Deciline Access');
            $flasher->addSuccess('Request Has been Deciline');
            return back();
        }
    }


    public function request($slug)
    {
        $data = [
            'url' => route('request.store', $slug),
            'permissions' => Permission::all()
        ];
        return view('request.access-request', $data);
    }

    public function storeRequest(Request $request, $slug, SweetAlertFactory $flasher)
    {


        $folder = BaseFolder::where('slug', $slug)->first();
        $done = "";
        if (!$folder) {
            $folder = Content::where('slug', $slug)->first();
            $data = [
                'content_id' => $folder->id,
                'user_id' => auth()->user()->id,
                'permission_id' => $request->permission,
                'status' => 'pending'
            ];
            $done = ContentAccess::create($data);
        } else {
            $data = [
                'basefolder_id' => $folder->id,
                'user_id' => auth()->user()->id,
                'permission_id' => $request->permission,
                'status' => 'pending'
            ];
            $done = BaseFolderAccess::create($data);
        }


        if ($done) {
            activity()->causedBy(auth()->user())->performedOn($folder)->log('Request Access');
            $flasher->addSuccess('Request Has been Send');
            // return redirect()->route('trash.index');
            return back();
        }
    }
}
