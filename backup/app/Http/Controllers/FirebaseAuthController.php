<?php

namespace App\Http\Controllers;

class FirebaseAuthController extends Controller
{
    //

    protected $auth;
    public function __construct()
    {
        $this->auth = Firebase::auth();
    }
}
