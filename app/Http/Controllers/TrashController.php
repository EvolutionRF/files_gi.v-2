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
        // $trash = BaseFolder::where('slug', $slug)->withTrashed()->first();
        // if (!$trash) {
        //     $trash = Content::where('slug', $slug)->withTrashed()->first();
        // }

        $data = [
            // 'trash' => $trash,
            'url' => route('trash.restore', $slug)
        ];


        return view('trash.modal.restore', $data);
    }

    public function storeRestore($slug, SweetAlertFactory $flasher)
    {
        $content = BaseFolder::where('slug', $slug)->withTrashed()->first();
        // $route = route('trash.index');
        if (!$content) {
            $content = Content::where('slug', $slug)->withTrashed()->first();
            // $route = route('EnterFolder', $content->contentable->slug);
        }
        $doneRestore = $content->restore();
        if ($doneRestore) {
            activity()->causedBy(auth()->user())->performedOn($content)->log('Restore');
            $flasher->addSuccess('Restore has been successfully!');
            return redirect()->route('trash.index');
        }
    }

    public function showForceDelete($slug)
    {
        // return response()->json($slug);
        $data = [
            'url' => route('trash.forcedelete', $slug)
        ];

        return view('trash.modal.forcedelete', $data);
    }

    public function storeForceDelete($slug, SweetAlertFactory $flasher)
    {
        $trash = BaseFolder::where('slug', $slug)->withTrashed()->first();
        $back = $trash;
        if (!$trash) {
            $trash = Content::where('slug', $slug)->withTrashed()->first();
            $back = $trash;
            // return response()->json($trash);
            if ($trash->type == 'file') {
                $trash->getMedia('file')->first()->delete();
            }
            $trash->deleteWithInnerFolder();
            $done =  $trash->forceDelete();
        } else {
            $contentToDelete = Content::where('basefolder_id', $trash->id)->get();
            foreach ($contentToDelete as $content) {
                if ($content->type == 'file') {
                    $media_content = $content->getMedia('file')->first();
                    $media_content->delete();
                }
            }
            $done =  $trash->forceDelete();
        }
        if ($done) {
            activity()->causedBy(auth()->user())->performedOn($back)->log('Force Delete');
            $flasher->addSuccess('Delete has been successfully!');
            return redirect()->route('trash.index');
        }
    }
}
