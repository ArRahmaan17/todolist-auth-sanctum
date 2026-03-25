<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $app_name = env('APP_NAME', 'TodoList');
        $title = $app_name . ' - Welcome';
        return view('home', compact('title', 'app_name'));
    }
}
