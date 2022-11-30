<?php

namespace App\Http\Controllers;

use App\Models\BaseFolder;
use App\Models\Content;
use App\Models\ContentAccess;
use App\Models\Permission;
use App\Models\User;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function upload(Request $request, SweetAlertFactory $flasher)
    {
        $parent = BaseFolder::where('slug', $request->FileparentSlug)->first();
        if (!$parent) {
            $parent = Content::where('slug', $request->FileparentSlug)->first();
            $baseFolder_id = $parent->basefolder_id;
        } else {
            $baseFolder_id = $parent->id;
        }

        $content = new Content(); //bikin object content
        $content->name = $request->get('name'); // mengisi content->name dengan request name
        $content->type = 'file'; //mengisi content->type dengan file
        $content->owner_id = auth()->user()->id; //mengisi owner_id dengan user yang login
        $content->slug = Str::random(32); //mengisi slug dengan $slugContent
        $content->basefolder_id = $baseFolder_id; //mengisi basefolder_id dengan $baseFolder
        $content->isPrivate = $request->FileisPrivate;

        $doneUploadFile = $parent->contents()->save($content);
        if ($doneUploadFile) {
            if ($request->hasFile('file')) {
                $done = $doneUploadFile->addMediaFromRequest('file')->toMediaCollection('file');
                if ($done) {
                    activity()->causedBy(auth()->user())->performedOn($doneUploadFile)->log('Upload File');
                    $flasher->addSuccess('File has been Uploaded successfully!');
                    return redirect()->route('EnterFolder', $request->FileparentSlug);
                }
            }
        }
    }

    public function showCreate($slug)
    {
        $parent = BaseFolder::where('slug', $slug)->first();
        if (!$parent) {
            $parent = Content::where('slug', $slug)->first();
        }
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->where('id', '!=', auth()->user()->id)->get();
        $permissions = Permission::all();

        $data = [
            'users' => $users,
            'url' => route('file.storecreate'),
            'permissions' => $permissions,
            'parent' => $parent
        ];
        return view('file.create-file', $data);
    }

    public function storeCreate(Request $request, SweetAlertFactory $flasher)
    {

        // return response()->json($request);
        $parent = BaseFolder::where('slug', $request->parentSlug)->first();
        if (!$parent) {
            $parent = Content::where('slug', $request->parentSlug)->first();
            $baseFolder_id = $parent->basefolder_id;
        } else {
            $baseFolder_id = $parent->id;
        }

        $content = new Content(); //bikin object content
        $content->name = $request->get('name'); // mengisi content->name dengan request name
        $content->type = 'file'; //mengisi content->type dengan file
        $content->owner_id = auth()->user()->id; //mengisi owner_id dengan user yang login
        $content->slug = Str::random(32); //mengisi slug dengan $slugContent
        $content->basefolder_id = $baseFolder_id; //mengisi basefolder_id dengan $baseFolder
        $content->isPrivate = $request->FileisPrivate;

        $doneUploadFile = $parent->contents()->save($content);
        if ($doneUploadFile) {
            if ($request->hasFile('file')) {
                $done = $doneUploadFile->addMediaFromRequest('file')->toMediaCollection('file');
                if ($done) {
                    if ($request->FileisPrivate == 'private') {
                        if ($request->invitedUser) {
                            $data_access = [
                                'content_id' => $doneUploadFile->id,
                                'permission_id' => $request->accessType,
                                'user_id' => $request->invitedUser,
                                'status' => 'accept'
                            ];
                            $accessDone = ContentAccess::create($data_access);
                            if ($accessDone) {
                                activity()->causedBy(auth()->user())->performedOn($doneUploadFile)->log('Upload File');
                                $flasher->addSuccess('File has been Uploaded successfully!');
                                return redirect()->route('EnterFolder', $request->parentSlug);
                            }
                        }
                    }

                    activity()->causedBy(auth()->user())->performedOn($doneUploadFile)->log('Upload File');
                    $flasher->addSuccess('File has been Uploaded successfully!');
                    return redirect()->route('EnterFolder', $request->parentSlug);
                }
            }
        }
    }

    public function showUpdate($slug)
    {
        $content = Content::where('slug', $slug)->first();

        if ($content->type == 'url') {
            $url = route('url.storeupdate', $slug);
        } else {
            $url = route('file.storeupdate', $slug);
        }

        $data = [
            'url' => $url,
            'content' => $content
        ];

        return view('file.update-file', $data);
    }

    public function storeUpdate($slug, Request $request, SweetAlertFactory $flasher)
    {
        $content = Content::where('slug', $slug)->first();
        $route = route('EnterFolder', $content->contentable->slug);
        if ($request->hasFile('file')) {
            $content->clearMediaCollection('file');
            $done =  $content->addMediaFromRequest('file')->toMediaCollection('file');
            if ($done) {
                activity()->causedBy(auth()->user())->performedOn($content)->log('Update Link');
                $flasher->addSuccess('File has been Updated successfully!');
                return redirect($route);
            }
        }
    }

    public function showDetail($slug)
    {

        // return response()->json($slug);
        $file = Content::where('slug', $slug)->withTrashed()->first();

        $data = [
            'file' => $file
        ];

        return view('file.detail-file', $data);
    }

    public function showManage($slug)
    {
        // return response()->json($slug);
        $file = Content::where('slug', $slug)->first();
        $user_manage = $file->access->pluck('user_id');
        $have_access = $file->access;

        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->where('id', '!=', auth()->user()->id)
            ->where(function ($q) use ($user_manage) {
                $q->whereNotIn('id', $user_manage);
            })->get();

        $permissions = Permission::all();
        $data = [
            'file' => $file,
            'have_access' => $have_access,
            'url' => route('file.storemanage', $slug),
            'users' => $users,
            'permissions' => $permissions
        ];

        return view('file.manage-file', $data);
    }

    public function storeManage($slug, Request $request, SweetAlertFactory $flasher)
    {
        $dataAcccess = [
            'permission_id' => $request->accessType,
            'user_id' => $request->invitedUser,
            'status' => 'accept'
        ];

        $file = Content::where('slug', $slug)->first();
        $route = route('EnterFolder', $file->contentable->slug);
        $dataAcccess['content_id'] = $file->id;
        if ($request->isPrivate == 'public') {
            ContentAccess::where('content_id', $file->id)->delete();
        } else {
            if ($request->invitedUser) {
                ContentAccess::create($dataAcccess);
            }
        }

        $data = [
            'isPrivate' => $request->isPrivate
        ];
        $doneUpdate = $file->update($data);

        if ($doneUpdate) {
            activity()->causedBy(auth()->user())->performedOn($file)->log('Manage File');
            $flasher->addSuccess('File has been Updated successfully!');
            return redirect($route);
        }
    }

    public function showRename($slug)
    {
        $file = Content::where('slug', $slug)->first();


        $data = [
            'file' => $file,
            'url' => route('file.storerename', $slug)
        ];

        return view('file.rename-file', $data);
    }

    public function storeRename(Request $request, $slug, SweetAlertFactory $flasher)
    {

        $file = Content::where('slug', $slug)->first();
        $route = route('EnterFolder', $file->contentable->slug);

        $data = [
            'name' => $request->name,
        ];

        $doneUpdate = $file->update($data);
        if ($doneUpdate) {
            activity()->causedBy(auth()->user())->performedOn($file)->log('Rename File');
            $flasher->addSuccess('File has been Rename successfully!');
            return redirect($route);
        }
    }

    public function showDelete($slug)
    {
        $file = Content::where('slug', $slug)->get();
        $data = [
            'file' => $file,
            'url' => route('file.delete', $slug)
        ];

        return view('file.delete-file', $data);
    }

    public function storeDelete($slug, SweetAlertFactory $flasher)
    {
        // return response()->json($slug);
        $file = Content::where('slug', $slug)->first();
        $back = $file;
        // $media_content = $file->getMedia('file')->first();
        // $done = $media_content->delete();
        $done = $file->delete();
        if ($done) {
            activity()->causedBy(auth()->user())->performedOn($back)->log('Delete Content');
            $flasher->addSuccess('Content has been Delete successfully!');
            return redirect()->route('EnterFolder', $back->contentable->slug);
        }
    }

    public function showDownloadFile($slug)
    {

        $file = Content::where('slug', $slug)->first();
        $data = [
            'file' => $file,
        ];
        if (auth()->user()) {
            if (auth()->user()->getRoleNames()->first() == "admin") {
                return view('file.download-file', $data);
            } else {
                if ($file->isPrivate == 'public') {
                    return view('file.download-file', $data);
                } else {
                    if ($file->baseFolder != "") {
                        if (auth()->user()->id == $file->baseFolder->owner_id) {
                            return view('file.download-file', $data);
                        }
                    }
                    if (auth()->user()->id == $file->owner_id) {
                        return view('file.download-file', $data);
                    } else {
                        if ($file->access) {
                            foreach ($file->access as $access) {
                                if (auth()->user()->id == $access->user_id && $access->status == 'accept') {
                                    return view('file.download-file', $data);
                                }
                            }
                        }
                        return redirect()->route('request', $file->slug);
                    }
                }
            }
        } else {
            // $flasher->addError('You Dont have access');
            return redirect()->route('request', $file->slug);
        }
    }

    public function downloadFile($slug)
    {
        $file = Content::where('slug', $slug)->first();
        $media = $file->getFirstMedia('file');

        return response()->download($media->getPath(), $file->name . '_' . $media->file_name);
    }
}
