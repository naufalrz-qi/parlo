<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinations;
use App\Models\Facility;
use Illuminate\Support\Facades\Auth;



class HomeUserController extends Controller
{
    public function index()
    {
       // Limit the number of destinations and facilities to 6
    $destinations = Destinations::with('reviews')->take(6)->get();
    foreach ($destinations as $destination) {
        $destination['averageRating'] = $destination->reviews->avg('rating');
    }
    $facilities = Facility::take(6)->get();


        if(Auth::user()->role === 'user'){
            return view('user.home', compact('destinations', 'facilities'));



        }else{
            if(Auth::user()->role === 'admin'){
                return redirect()->route('admin.dashboard');
            }elseif (Auth::user()->role === 'employee') {
                return redirect()->route('employee.dashboard');
            }
        }



    }

    public function tfa()
    {
        return view('user.settings.tfa-activation');
    }


}
