<?php

namespace App\Http\Controllers;

use App\Models\BaseFolder;
use App\Models\Content;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $count_folder = count(BaseFolder::all()) + count(Content::where('type', 'folder')->get());
        // $count_image = count(Media::where('mime_type', 'like', '%' . 'image' . '%')->get());
        // $count_document = count(Media::where('mime_type', 'like', '%' . 'application' . '%')->get());
        // $count_link  = count(Content::where('type', 'url')->get());
        // return response()->json($count_document);

        $baseFolders = BaseFolder::with(['base_folders_accesses.user' => function ($query) {
            $query->select('id', 'name');
        }])->latest()->paginate(6);
        $data = [
            'type_menu' => 'dashboard',
            'baseFolders' => $baseFolders
        ];
        return view('dashboard.index', $data);
    }
}
