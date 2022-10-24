<?php

namespace App\Http\Controllers;

use App\Models\BaseFolder;
use Illuminate\Http\Request;

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
        $baseFolders = BaseFolder::with(['base_folders_accesses.user' => function ($query) {
            $query->select('id', 'name');
        }])->latest()->paginate(3);
        $data = [
            'type_menu' => 'dashboard',
            'baseFolders' => $baseFolders
        ];
        // $test = $baseFolders;
        // return response()->json($baseFolders);
        return view('dashboard.index', $data);
    }
}
