<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $app_name = env('APP_NAME');
        $title = "Login " . env('APP_NAME') . " Page";
        return view('auth.index', compact('title', 'app_name'));
    }
}
