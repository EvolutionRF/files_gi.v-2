<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class FoldersharedController extends Controller
{
    public function index()
    {
        $data = [
            'type_menu' => 'foldershared'
        ];

        return view('shared.foldershared', $data); 
    }
    
}
