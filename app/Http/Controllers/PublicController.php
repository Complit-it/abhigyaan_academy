<?php

namespace App\Http\Controllers;

class PublicController extends Controller
{
    //

    public function index()
    {
        return view('publicPages.welcome', [
            'title' => 'Welcome to Abhigyaan Academy',
        ]);
    }
}
