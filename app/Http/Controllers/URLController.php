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


class URLController extends Controller
{
    public function showCreate($slug)
    {
        // return response()->json($slug)
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
            'url' => route('url.storecreate'),
            'permissions' => $permissions,
            'parent' => $parent
        ];
        return view('url.create-url', $data);
        // return view('url.create-file');
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
        // return response()->json($parent);

        $content = new Content();
        $content->name = $request->name;
        $content->type = 'url';
        $content->owner_id = auth()->user()->id;
        $content->slug = Str::random(32);
        $content->url = $request->link;
        $content->basefolder_id = $baseFolder_id;
        $content->isPrivate = $request->isPrivate;
        $data = [
            'parent' => $parent,
            'content' => $content
        ];
        $doneCreate = $parent->contents()->save($content);
        if ($doneCreate) {
            if ($request->isPrivate == 'private') {
                if ($request->invitedUser) {
                    $data_access = [
                        'content_id' => $doneCreate->id,
                        'permission_id' => $request->accessType,
                        'user_id' => $request->invitedUser,
                        'status' => 'accept'
                    ];
                    $accessDone = ContentAccess::create($data_access);
                    if ($accessDone) {
                        activity()->causedBy(auth()->user())->performedOn($doneCreate)->log('Create URL');
                        $flasher->addSuccess('URL has been Create successfully!');
                        return redirect()->route('EnterFolder', $request->parentSlug);
                    }
                }
            }
            activity()->causedBy(auth()->user())->performedOn($doneCreate)->log('Create URL');
            $flasher->addSuccess('URL has been Create successfully!');
            return redirect()->route('EnterFolder', $request->parentSlug);
        }
    }

    public function showDetail($slug)
    {

        // return response()->json($slug);
        $url = Content::where('slug', $slug)->withTrashed()->first();


        $data = [
            'url' => $url
        ];

        return view('url.detail-url', $data);
    }


    public function showURL($slug)
    {
        $url = Content::where('slug', $slug)->first();

        // return response()->json($slug);
        $data = [
            'Url' => $url,
        ];

        return view('url.show-url', $data);
    }

    public function storeUpdate($slug, Request $request, SweetAlertFactory $flasher)
    {
        // dd($request->link);
        $content = Content::where('slug', $slug)->first();
        // dd($content->contentable->slug);
        $route = route('EnterFolder', $content->contentable->slug);
        $data = [
            'url' => $request->link,
        ];

        $doneUpdate = $content->update($data);
        if ($doneUpdate) {
            activity()->causedBy(auth()->user())->performedOn($content)->log('Update Link');
            $flasher->addSuccess('File has been Updated successfully!');
            return redirect($route);
        }
    }
}
