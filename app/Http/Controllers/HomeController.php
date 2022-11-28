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

        $data = [
            'type_menu' => 'dashboard',
        ];

        return view('dashboard.index', $data);
    }
}
