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
        $employee = $user->employee;

        if (!$employee) {
            return redirect()->route('error')->with('message', 'You are not registered as an employee. Please contact the admin.');
        }

        // Check if destination is set for the employee
        if (!$employee->destination) {
            return redirect()->route('error')->with('message', 'You have not set your destination. Please contact the admin.');
        }

        $destination = $employee->destination;

        // Get total facilities count
        $totalFacilities = Facility::where('destination_id', $destination->id)->count();

        // Get latest facilities
        $latestFacilities = Facility::where('destination_id', $destination->id)
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return view('employee.dashboard', compact('destination', 'totalFacilities', 'latestFacilities'));
    }
}
