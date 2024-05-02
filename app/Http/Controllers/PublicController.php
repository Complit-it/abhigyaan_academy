<?php

namespace App\Http\Controllers;

class PublicController extends Controller
{
    //

    public function gservices()
    {
        return view('govtServices', [
            'title' => 'Goverment services | Road Partner',

            // 'alertDescription' => 'Vehicle Brand name required',
            // 'alertTitle' => 'Error',
            // 'alertIcon' => 'error',
        ]);
    }

    public function roadSafety()
    {
        return view('roadSafety', [
            'title' => 'Goverment services | Road Partner',

            // 'alertDescription' => 'Vehicle Brand name required',
            // 'alertTitle' => 'Error',
            // 'alertIcon' => 'error',
        ]);
    }

    public function beforeJourney()
    {
        return view('beforeJourney', [
            'title' => 'Goverment services | Road Partner',

            // 'alertDescription' => 'Vehicle Brand name required',
            // 'alertTitle' => 'Error',
            // 'alertIcon' => 'error',
        ]);
    }
}
