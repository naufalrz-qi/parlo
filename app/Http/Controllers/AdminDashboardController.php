<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinations;
use App\Models\Facility;
use App\Models\Booking;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get total count of destinations and facilities
        $totalDestinations = Destinations::count();
        $totalFacilities = Facility::count();
        $latestDestinations = Destinations::latest()->take(5)->get();
        $latestFacilities = Facility::latest()->take(5)->get();
        $currentDate = Carbon::now()->toDateString();

        // Get today's transactions
        $todayTransactions = Booking::whereDate('created_at', $currentDate)->get();
        $totalTransactions = Booking::count();
        $totalIncome = Booking::sum('total_price');
        $todayIncome = $todayTransactions->sum('total_price');


        return view('admin.dashboard', compact(
            'totalDestinations',
            'totalFacilities',
            'latestDestinations',
            'latestFacilities',
            'todayTransactions',
            'totalTransactions',
            'totalIncome',
            'todayIncome'
        ));
       
    }
}
