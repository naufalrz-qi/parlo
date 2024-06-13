<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinations;
use App\Models\Facility;

class UserController extends Controller
{
    public function index()
    {
        $destinations = Destinations::all();
        $facilities = Facility::all();

        return view('user.home', compact('destinations', 'facilities'));
    }
}
