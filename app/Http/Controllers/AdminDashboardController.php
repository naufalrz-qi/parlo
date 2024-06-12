<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinations;
use App\Models\Facility;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get total count of destinations and facilities
        $totalDestinations = Destinations::count();
        $totalFacilities = Facility::count();

        // Get latest destinations and facilites
        $latestDestinations = Destinations::orderBy('created_at', 'desc')->take(5)->get();
        $latestFacilities = Facility::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('totalDestinations', 'totalFacilities', 'latestDestinations','latestFacilities'));
    }
}
