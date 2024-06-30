<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinations;
use App\Models\Facility;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('destination', 'facilities')->get();
        return view('admin.backend.bookings.index', compact('bookings'));
    }

    public function create(Destinations $destination)
    {
        $facilities = $destination->facilities;
        return view('admin.backend.bookings.create', compact('destination', 'facilities'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'start_time' => 'required|date|date_format:Y-m-d\TH:i',
            'end_time' => 'required|date|date_format:Y-m-d\TH:i|after:start_time',
            'facilities' => 'nullable|array|exists:facilities,id',
        ]);

        $booking = new Booking();
        $booking->user_id = auth()->user()->id;
        $booking->destination_id = $request->input('destination_id');
        $booking->start_time = $request->input('start_time');
        $booking->end_time = $request->input('end_time');

        $destination = Destinations::find($request->input('destination_id'));
        $totalPrice = $destination->price; // calculate total price

        if ($request->has('facilities')) {
            $facilities = Facility::whereIn('id', $request->input('facilities'))->get();
            foreach ($facilities as $facility) {
                $totalPrice += $facility->price;
            }
        }

        $booking->total_price = $totalPrice;
        $booking->status = 'pending';
        $booking->save();

        if ($request->has('facilities')) {
            $booking->facilities()->sync($request->input('facilities'));
        }

        if (Auth::user()->role == 'user') {
            return redirect()->route('payment.show', $booking->id);
        }

        return redirect()->route('bookings.index');
    }

}
