<?php

namespace App\Http\Controllers;

use App\Models\BaseFolder;
use App\Models\BaseFolderAccess;
use App\Models\Content;
use App\Models\ContentAccess;
use App\Models\Permission;
use App\Models\User;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FoldersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function EnterFolder($slug, SweetAlertFactory $flasher)
    {
        // dd('test');
        $folder = BaseFolder::where('slug', $slug)->first();
        $baseFolder = "";
        $parents = array();
        if ($folder) {
            $access_folder = $folder->base_folders_accesses;
            $parents[0] =  array(
                'slug' => $folder->slug,
                'name' => $folder->name
            );
        } else {
            $folder = Content::where('slug', $slug)->first();
            if ($folder == "") {
                return response()->json('Folder Deleted');
            }
            $baseFolder = BaseFolder::find($folder->basefolder_id);
            $access_folder = $folder->access;
        }

        // return response()->json(Request()->isShared);

        $data = [
            'folder' => $folder,
            'slug' => $slug,
            'type_menu' => 'dashboard',
        ];


        if (auth()->user()) {
            if (auth()->user()->getRoleNames()->first() == "admin") {
                return view('content.index', $data);
            } else {
                if ($folder->isPrivate == 'public') {
                    return view('content.index', $data);
                } else {
                    if ($baseFolder != "") {
                        if (auth()->user()->id == $folder->baseFolder->owner_id) {
                            return view('content.index', $data);
                        }
                    }
                    if (auth()->user()->id == $folder->owner_id) {
                        return view('content.index', $data);
                    } else {
                        if ($access_folder) {
                            foreach ($access_folder as $access) {
                                if (auth()->user()->id == $access->user_id && $access->status == 'accept') {
                                    return view('content.index', $data);
                                }
                            }
                        }
                        if ($baseFolder) {
                            $flasher->addError('You Dont have access');
                            return redirect()->route('EnterFolder', $folder->contentable->slug);
                        } else {
                            $flasher->addError('You Dont have access');
                            return redirect()->route('dashboard');
                        }
                    }
                }
            }
        } else {
            $flasher->addError('You Dont have access');
            return redirect()->route('dashboard');
        }
    }


    public function showDetail($slug)
    {
        $folder = BaseFolder::where('slug', $slug)->withTrashed()->first();
        // return response()->json($folder);

        if (!$folder) {
            $folder = Content::where('slug', $slug)->withTrashed()->first();
        }


        // return response()->json($folder);
        $data = [
            'folder' => $folder,
            'url' => route('dashboard')
        ];

        return view('folder.detail-folder', $data);
    }


    public function create($slug = "")
    {
        // return response()->json($slug);
        if ($slug) {
            $parent = BaseFolder::where('slug', $slug)->first();
            // return response()->json($parent);
            if ($parent) {
                $access_folder = $parent->base_folders_accesses;
            }
            if (!$parent) {
                $parent = Content::where('slug', $slug)->first();
                $access_folder = $parent->access;
            }
        } else {
            $parent = "";
        }

        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->where('id', '!=', auth()->user()->id)->get();

        $permissions = Permission::all();

        $data = [
            'users' => $users,
            'url' => route('folder.store'),
            'permissions' => $permissions,
            'parent' => $parent
        ];



        if ($parent == "") {
            return view('folder.create-folder', $data);
        } else {
            if (auth()->user()->getRoleNames()->first() == "admin") {
                return view('folder.create-folder', $data);
            } else {
                if ($parent->isPrivate == 'public') {
                    return view('folder.create-folder', $data);
                } else {
                    if (auth()->user()->id == $parent->owner_id) {
                        return view('folder.create-folder', $data);
                    } else {
                        if ($access_folder) {
                            foreach ($access_folder as $access) {
                                if (auth()->user()->id == $access->user_id && $access->permission_id == 2) {
                                    return view('folder.create-folder', $data);
                                }
                            }
                            $data['url'] = route('request.store', $slug);
                            return view('request.access-request', $data);;
                        }
                    }
                }
            }
        }
    }

    public function store(Request $request, SweetAlertFactory $flasher)
    {
        if ($request->parentSlug) {
            $parent = BaseFolder::where('slug', $request->parentSlug)->first();
            if (!$parent) {
                $parent = Content::where('slug', $request->parentSlug)->first();
                $baseFolder_id = $parent->basefolder_id;
            } else {
                $baseFolder_id = $parent->id;
            }
            // return response()->json($parent);

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
                            activity()->causedBy(auth()->user())->performedOn($doneCreate)->log('Create Folder');
                            $flasher->addSuccess('Folder has been Create successfully!');
                            return redirect()->route('EnterFolder', $request->parentSlug);
                        }
                    }
                }
                activity()->causedBy(auth()->user())->performedOn($doneCreate)->log('Create Folder');
                $flasher->addSuccess('Folder has been Create successfully!');
                return redirect()->route('EnterFolder', $request->parentSlug);
            }
        } else {
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
                            'user_id' => $request->invitedUser,
                            'status' => 'accept'
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
    }

    public function showRename($slug)
    {
        $folder = BaseFolder::where('slug', $slug)->first();
        if (!$folder) {
            $folder = Content::where('slug', $slug)->first();
        }

        $data = [
            'folder' => $folder,
            'url' => route('folder.storerename', $slug)
        ];

        return view('folder.rename-folder', $data);
    }

    public function storeRename(Request $request, $slug, SweetAlertFactory $flasher)
    {
        $folder = BaseFolder::where('slug', $slug)->first();
        $route = route('dashboard');
        if (!$folder) {
            $folder = Content::where('slug', $slug)->first();
            $route = route('EnterFolder', $folder->contentable->slug);
        }

        $data = [
            'name' => $request->name,
        ];


        $doneUpdate = $folder->update($data);
        if ($doneUpdate) {
            activity()->causedBy(auth()->user())->performedOn($folder)->log('Rename Folder');
            $flasher->addSuccess('Folder has been Rename successfully!');
            return redirect($route);
        }
    }

    public function showDelete($slug)
    {
        $folder = BaseFolder::where('slug', $slug)->first();
        if (!$folder) {
            $folder = Content::where('slug', $slug)->first();
        }

        $data = [
            'folder' => $folder,
            'url' => route('folder.delete', $slug)
        ];


        return view('folder.delete-folder', $data);
    }

    public function delete($slug, SweetAlertFactory $flasher)
    {
        $folder = BaseFolder::where('slug', $slug)->first();
        $back = $folder;
        if (!$folder) {
            $folder = Content::where('slug', $slug)->first();
            $back = $folder;
            // $folder->deleteWithInnerFolder();
            $folder->delete();
        } else {
            // $contentToDelete = Content::where('basefolder_id', $folder->id)->get();
            // foreach ($contentToDelete as $content) {
            //     if ($content->type == 'file') {
            //         $media_content = $content->getMedia('file')->first();
            //         $media_content->delete();
            //     }
            // }
            $folder->delete();
        }

        activity()->causedBy(auth()->user())->performedOn($back)->log('Delete Base Folder');
        $flasher->addSuccess('Folder has been Delete successfully!');
        if (!$back->contentable) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('EnterFolder', $back->contentable->slug);
        }
    }

    public function showManage($slug)
    {
        $folder = BaseFolder::where('slug', $slug)->first();
        if ($folder) {
            $user_manage = $folder->base_folders_accesses->where('status', 'accept')->pluck('user_id');
            $have_access = $folder->base_folders_accesses->where('status', 'accept');
        } else {
            $folder = Content::where('slug', $slug)->first();
            $user_manage = $folder->access->where('status', 'accept')->pluck('user_id');
            $have_access = $folder->access->where('status', 'accept');
        }

        // return response()->json($have_access);

        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->where('id', '!=', auth()->user()->id)
            ->where(function ($q) use ($user_manage) {
                $q->whereNotIn('id', $user_manage);
            })->get();

        $permissions = Permission::all();
        $data = [
            'folder' => $folder,
            'have_access' => $have_access,
            'url' => route('folder.storemanage', $slug),
            'users' => $users,
            'permissions' => $permissions
        ];

        return view('folder.manage-folder', $data);
    }

    public function storeManage(Request $request, $slug, SweetAlertFactory $flasher)
    {
        $dataAcccess = [
            'permission_id' => $request->accessType,
            'user_id' => $request->invitedUser,
            'status' => 'accept'
        ];


        $folder = BaseFolder::where('slug', $slug)->first();
        $route = route('dashboard');

        if (!$folder) {
            $folder = Content::where('slug', $slug)->first();
            $route = route('EnterFolder', $folder->contentable->slug);
            $dataAcccess['content_id'] = $folder->id;
            if ($request->isPrivate == 'public') {
                ContentAccess::where('content_id', $folder->id)->delete();
            } else {
                if ($request->invitedUser) {
                    ContentAccess::create($dataAcccess);
                }
            }
        } else {
            $dataAcccess['basefolder_id'] = $folder->id;
            if ($request->isPrivate == 'public') {
                BaseFolderAccess::where('basefolder_id', $folder->id)->delete();
            } else {
                if ($request->invitedUser) {
                    BaseFolderAccess::create($dataAcccess);
                }
            }
        }
        $data = [
            'isPrivate' => $request->isPrivate
        ];
        $doneUpdate = $folder->update($data);

        if ($doneUpdate) {
            activity()->causedBy(auth()->user())->performedOn($folder)->log('Manage Folder');
            $flasher->addSuccess('Folder has been Updated successfully!');
            return redirect($route);
        }
    }

    public function askRequest($id)
    {
        return view('folder.ask-request');
    }
}
