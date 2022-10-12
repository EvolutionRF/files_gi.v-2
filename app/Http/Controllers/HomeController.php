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
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $baseFolders = BaseFolder::all();
        $data = [
            'type_menu' => 'dashboard',
            'baseFolders' => $baseFolders
        ];
        return view('home', $data);
    }
}
