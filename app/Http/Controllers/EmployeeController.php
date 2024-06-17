<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Facility;
use App\Models\Destinations;

class EmployeeController extends Controller
{
    //
    public function dashboard()
    {
        $user = Auth::user();
        $destination = $user->employee->destination;

        // Get total facilities count
        $totalFacilities = Facility::where('destination_id', $destination->id)->count();

        // Get latest facilities
        $latestFacilities = Facility::where('destination_id', $destination->id)
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return view('employee.dashboard', compact('destination', 'totalFacilities', 'latestFacilities'));
    }
}
