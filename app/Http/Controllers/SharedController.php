<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SharedController extends Controller
{
    public function index()
    {
        $data = [
            'type_menu' => 'Shared'
        ];

        return view('shared.share', $data); 
    }
    
}
