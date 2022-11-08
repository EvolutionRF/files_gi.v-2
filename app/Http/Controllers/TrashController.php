<?php

namespace App\Http\Controllers;

use App\Models\BaseFolder;
use App\Models\Content;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $trashBase = BaseFolder::where('owner_id', auth()->user()->id)->onlyTrashed()->latest()->get();
        $trashcontentFolder = Content::where('owner_id', auth()->user()->id)->where('type', 'folder')->onlyTrashed();
        $trashcontentFile  = Content::where('owner_id', auth()->user()->id)->where('type', 'file')->onlyTrashed();
        $data = [
            'type_menu' => 'Trash',
            'trashBase' => $trashBase,
            'trashcontentFile' => $trashcontentFile->latest()->get(),
            'trashcontentFolder' => $trashcontentFolder->latest()->get()
        ];

        // return response()->json($data);
        return view('trash.index', $data);
    }

    public function showRestore($slug)
    {
        // return response()->json($slug);
        $folder = BaseFolder::where('slug', $slug)->withTrashed()->first();
        if (!$folder) {
            $folder = Content::where('slug', $slug)->withTrashed()->first();
        }

        $data = [
            'folder' => $folder,
            'url' => route('trash.restore', $slug)
        ];


        return view('folder.restore-folder', $data);
    }

    public function storeRestore($slug, SweetAlertFactory $flasher)
    {
        $folder = BaseFolder::where('slug', $slug)->withTrashed()->first();
        $route = route('trash.index');
        if (!$folder) {
            $folder = Content::where('slug', $slug)->withTrashed()->first();
            $route = route('EnterFolder', $folder->contentable->slug);
        }
        $doneRestore = $folder->restore();
        if ($doneRestore) {
            activity()->causedBy(auth()->user())->performedOn($folder)->log('Restore Folder');
            $flasher->addSuccess('Folder has been Restore successfully!');
            return redirect()->route('trash.index');
        }
        return response()->json($slug);
    }

    public function showForceDelete($slug)
    {
        // return response()->json($slug);
        $data = [
            'url' => route('trash.forcedelete', $slug)
        ];

        return view('folder.forcedelete-folder', $data);
    }

    public function storeForceDelete($slug, SweetAlertFactory $flasher)
    {
        $folder = BaseFolder::where('slug', $slug)->withTrashed()->first();
        $back = $folder;
        if (!$folder) {
            $folder = Content::where('slug', $slug)->withTrashed()->first();
            $back = $folder;
            $folder->deleteWithInnerFolder();
            $done =  $folder->forceDelete();
        } else {
            $contentToDelete = Content::where('basefolder_id', $folder->id)->get();
            foreach ($contentToDelete as $content) {
                if ($content->type == 'file') {
                    $media_content = $content->getMedia('file')->first();
                    $media_content->delete();
                }
            }
            $done =  $folder->forceDelete();
        }
        if ($done) {
            activity()->causedBy(auth()->user())->performedOn($back)->log('Delete Base Folder');
            $flasher->addSuccess('Folder has been Delete successfully!');
            // if (!$back->contentable) {
            return redirect()->route('trash.index');
            // } else {
            //     return redirect()->route('EnterFolder', $back->contentable->slug);
            // }
        }
    }
}
