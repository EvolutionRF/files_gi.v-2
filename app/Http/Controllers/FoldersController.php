<?php

namespace App\Http\Controllers;

use App\Models\BaseFolder;
use App\Models\BaseFolderAccess;
use App\Models\Content;
use App\Models\Permission;
use App\Models\User;
use Faker\Provider\Base;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class FoldersController extends Controller
{
    public function EnterFolder($slug, SweetAlertFactory $flasher)
    {
        // $baseFolder = BaseFold;
        $Folder = BaseFolder::where('slug', $slug)->first();
        $baseFolder = "";

        $permission = Permission::all();
        $parents = array();
        if ($Folder) {
            // return response()->json('masuk');
            $access_folder = $Folder->base_folders_accesses;
            $parents[0] =  array(
                'slug' => $Folder->slug,
                'name' => $Folder->name
            );
            // return response()->json($parents);
        } else {
            $Folder = Content::where('slug', $slug)->first();
            $baseFolder = BaseFolder::find($Folder->basefolder_id);
            $access_folder = $Folder->accesses;

            $result = $Folder->contentable;
            $count = 0;
            do {
                //
                $parents[$count] = array(
                    'slug'  => $result->slug,
                    'name'  => $result->name,
                );
                $result = $result->contentable;
                $count++;
            } while ($result != null);
            // return response()->json($parents);
        }

        $data = [
            'baseFolder' => $baseFolder,
            'Folders_accesses' => $access_folder,
            'Folder' => $Folder,
            'content_folder' => $Folder->contents->where('type', 'folder'),
            'content_file' => $Folder->contents->where('type', 'file'),
            'permission' => $permission,
            'type_menu' => 'dashboard',
            'parents' => $parents
        ];
        // return response()->json($data['content_file'][1]->getMedia('file')->first());

        if (auth()->user()) {
            if (auth()->user()->getRoleNames()->first() == "admin") {
                return view('folders', $data);
            } else {
                if ($Folder->isPrivate == 'public') {
                    return view('folders', $data);
                } else {
                    if (auth()->user()->id == $Folder->owner_id) {
                        return view('folders', $data);
                    } else {
                        if ($access_folder) {
                            foreach ($access_folder as $access) {
                                if (auth()->user()->id == $access->user_id) {
                                    return view('folders', $data);
                                }
                            }
                        }
                        $flasher->addError('You Dont have access');
                        return redirect()->route('dashboard');
                    }
                }
            }
        } else {
            $flasher->addError('You Dont have access');
            return redirect()->route('dashboard');
        }
    }


    public function CreateFolder(Request $request, SweetAlertFactory $flasher)
    {
        $parent = BaseFolder::where('slug', $request->parentSlug)->first();
        if (!$parent) {
            $parent = Content::where('slug', $request->parentSlug)->first();
            $baseFolder_id = $parent->basefolder_id;
        } else {
            $baseFolder_id = $parent->id;
        }
        $content = new Content(); //bikin object content
        $content->name = $request->get('name'); // mengisi content->name dengan request name
        $content->type = 'folder'; //mengisi content->type dengan folder
        $content->owner_id = auth()->user()->id; //mengisi owner_id dengan user yang login
        $content->slug = Str::random(32); //mengisi slug dengan $slugContent
        $content->basefolder_id = $baseFolder_id; //mengisi basefolder_id dengan $baseFolder
        $content->isPrivate = $request->isPrivate;
        $data = [
            'parent' => $parent,
            'content' => $content
        ];
        $doneCreateFolder = $parent->contents()->save($content);
        if ($doneCreateFolder) {
            activity()->causedBy(auth()->user())->performedOn($doneCreateFolder)->log('Create Folder');
            $flasher->addSuccess('Folder has been Create successfully!');
            return redirect()->route('EnterFolder', $request->parentSlug);
        }

        // return response()->json($data);
    }


    public function show($id)
    {
        $data = [
            'folder' => BaseFolder::findOrFail($id),
            'url' => route('dashboard')
        ];
        // return response()->json($data);

        return view('folder.detail-folder', $data);
    }


    public function create()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->where('id', '!=', auth()->user()->id)->get();

        $permissions = Permission::all();
        $data = [
            'users' => $users,
            'url' => route('basefolder.store'),
            'permissions' => $permissions
        ];
        return view('folder.create-folder', $data);
    }

    public function store(Request $request, SweetAlertFactory $flasher)
    {
        // return response()->json($request);
        $data = [
            'name' => $request->name,
            'owner_id' => auth()->user()->id,
            'isPrivate' => $request->isPrivate,
            'slug' => Str::random(32)
        ];
        $doneCreate = BaseFolder::create($data);

        if ($doneCreate) {
            if ($request->isPrivate == 'private') {
                if ($request->invitedUser) {
                    $data_access = [
                        'basefolder_id' => $doneCreate->id,
                        'permission_id' => $request->accessType,
                        'user_id' => $request->invitedUser
                    ];
                    $accessDone = BaseFolderAccess::create($data_access);
                    if ($accessDone) {
                        activity()->causedBy(auth()->user())->performedOn($doneCreate)->log('Create Base Folder');
                        $flasher->addSuccess('Folder has been Create successfully!');
                        return redirect()->route('dashboard');
                    }
                }
            }
            activity()->causedBy(auth()->user())->performedOn($doneCreate)->log('Create Base Folder');
            $flasher->addSuccess('Folder has been Create successfully!');
            return redirect()->route('dashboard');
        }
    }

    public function showRename($id)
    {
        $data = [
            'folder' => BaseFolder::findOrFail($id),
            'url' => route('basefolder.storerename', $id)
        ];

        return view('folder.rename-folder', $data);
    }

    public function storeRename(Request $request, $id, SweetAlertFactory $flasher)
    {
        $baseFolder = BaseFolder::findOrFail($id);
        $data = [
            'name' => $request->name,
        ];
        $doneUpdate = $baseFolder->update($data);
        if ($doneUpdate) {
            activity()->causedBy(auth()->user())->performedOn($baseFolder)->log('Rename Base Folder');
            $flasher->addSuccess('Folder has been Rename successfully!');
            return redirect()->route('dashboard');
        }
    }

    public function showDelete($id, SweetAlertFactory $flasher)
    {
        $data = [
            'folder' => BaseFolder::findOrFail($id),
            'url' => route('basefolder.delete', $id)
        ];

        return view('folder.delete-folder', $data);
    }

    public function delete($id, SweetAlertFactory $flasher)
    {
        $backup = BaseFolder::findOrFail($id);
        $contentToDelete = Content::where('basefolder_id', $id)->get();
        foreach ($contentToDelete as $content) {
            if ($content->type == 'file') {
                $media_content = $content->getMedia('file')->first();
                $media_content->delete();
            }
        }
        $delete = BaseFolder::destroy($id);
        if ($delete) {
            activity()->causedBy(auth()->user())->performedOn($backup)->log('Delete Base Folder');
            $flasher->addSuccess('Folder has been Delete successfully!');
            return redirect()->route('dashboard');
        }
    }

    public function showManage($id)
    {
        $folder = BaseFolder::findOrFail($id);
        $user_manage = $folder->base_folders_accesses->pluck('user_id');
        // return response()->json($user_manage);
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->where('id', '!=', auth()->user()->id)
            ->where(function ($q) use ($user_manage) {
                $q->whereNotIn('id', $user_manage);
            })->get();
        $permissions = Permission::all();
        $data = [
            'folder' => $folder,
            'url' => route('basefolder.storemanage', $id),
            'users' => $users,
            'permissions' => $permissions
        ];
        // return response()->json($Folder->base_folders_accesses->first()->user->name);
        return view('folder.manage-folder', $data);
    }

    public function storeManage(Request $request, $id, SweetAlertFactory $flasher)
    {
        $baseFolder = BaseFolder::findOrFail($id);
        $data = [
            'isPrivate' => $request->isPrivate
        ];
        $doneUpdate = $baseFolder->update($data);
        if ($doneUpdate) {
            if ($request->invitedUser) {
                $dataAcccess = [
                    'basefolder_id' => $id,
                    'permission_id' => $request->accessType,
                    'user_id' => $request->invitedUser
                ];
                BaseFolderAccess::create($dataAcccess);
            }

            if ($request->isPrivate == 'public') {
                BaseFolderAccess::where('basefolder_id', $id)->delete();
            }
            activity()->causedBy(auth()->user())->performedOn($baseFolder)->log('Manage Base Folder');
            $flasher->addSuccess('Folder has been Updated successfully!');
            return redirect()->route('dashboard');
        }
    }

    public function askRequest($id)
    {
        return view('folder.ask-request');
    }
}
