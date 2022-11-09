<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // return response()->json('Masuk');
        return view('components.notification');
    }
}
