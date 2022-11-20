<?php

namespace App\Http\Controllers;

use App\Models\BaseFolder;
use Illuminate\Http\Request;

class MyFilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myFiles()
    {
        $baseFolders = BaseFolder::with(['base_folders_accesses.user' => function ($query) {
            $query->select('id', 'name');
        }])->latest()->paginate(3);
        $data = [
            'type_menu' => 'myFiles',
            'baseFolders' => $baseFolders
        ];
        // $test = $baseFolders;
        // return response()->json($baseFolders);
        return view('myfiles.index', $data);
    }
}
