<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinations;
use App\Models\Facility;

class HomeUserController extends Controller
{
    public function index()
    {
        $destinations = Destinations::all();
        $facilities = Facility::all();

        return view('user.home', compact('destinations', 'facilities'));
    }

    public function tfa()
    {
        return view('user.settings.tfa-activation');
    }


}
