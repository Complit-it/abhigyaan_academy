<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class TokenController extends Controller
{
    public function installPassport()
    {
        // You might want to add some validation here to ensure this endpoint is only accessible to authorized users

        // Run the passport:install command
        Artisan::call('passport:install');

        return response()->json(['message' => 'Passport installed successfully']);
    }
}
