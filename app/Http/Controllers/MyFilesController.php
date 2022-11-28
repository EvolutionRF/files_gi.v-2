<?php

namespace App\Http\Controllers;

use App\Models\BaseFolder;
// use Faker\Provider\Base;
use Illuminate\Http\Request;

class MyFilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myFiles()
    {
        // $baseFolders = BaseFolder::with(['base_folders_accesses.user' => function ($query) {
        //     $query->select('id', 'name');
        // }])->latest()->paginate(6);

        $baseFolders = BaseFolder::where('owner_id', auth()->user()->id)->latest()->paginate(6);

        $data = [
            'type_menu' => 'myFiles',
            'baseFolders' => $baseFolders
        ];
        return view('myfiles.index', $data);
    }
}
