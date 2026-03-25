<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $app_name = env('APP_NAME', 'TodoList');
        $title = $app_name.' - Welcome';

        return view('home', compact('title', 'app_name'));
    }
}
