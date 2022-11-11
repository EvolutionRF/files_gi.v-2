<?php

namespace App\Http\Controllers;

use App\Models\BaseFolder;
use App\Models\Content;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $trashBase = BaseFolder::where('owner_id', auth()->user()->id)->onlyTrashed()->latest()->paginate(6);

        $trashcontentFolder = Content::where('owner_id', auth()->user()->id)->where('type', 'folder')->onlyTrashed();

        $trashcontentFile  = Content::where('owner_id', auth()->user()->id)->where('type', 'file')->onlyTrashed();
        $data = [
            'type_menu' => 'Trash',
            'trashBase' => $trashBase,
            'trashcontentFile' => $trashcontentFile->latest()->paginate(10),
            'trashcontentFolder' => $trashcontentFolder->latest()->paginate(3)
        ];

        // return response()->json($data);
        return view('trash.index', $data);
    }
}
