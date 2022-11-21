<?php

namespace App\Http\Controllers;

use App\Models\BaseFolder;
use App\Models\BaseFolderAccess;
use App\Models\Content;
use App\Models\ContentAccess;
use Illuminate\Http\Request;

class SharedController extends Controller
{
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
            'type_menu' => 'Shared',
        ];
        return view('shared.index', $data);
    }
}
