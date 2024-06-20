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
            'booking_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'facilities' => 'array|exists:facilities,id',
            'total_price' => 'required|numeric',
        ]); 

        $booking = new Booking();
        $booking->user_id = auth()->user()->id;
        $booking->destination_id = $request->input('destination_id');
        $booking->booking_date = $request->input('booking_date');
        $booking->start_time = $request->input('start_time');
        $booking->end_time = $request->input('end_time');
        $booking->total_price = $request->input('total_price');
        $booking->status = 'pending';
        $booking->save();

        $facilities = $request->input('facilities');
        $booking->facilities()->sync($facilities);

        if (auth()->user()->role == 'user') {
            return redirect()->route('payment.show', $booking->id);
        }

        return redirect()->route('bookings.index');
    }



    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $destinations = Destinations::all();
        $facilities = Facility::all();
        return view('bookings.edit', compact('booking', 'destinations', 'facilities'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'booking_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'total_price' => 'required|numeric',
            'status' => 'required|in:pending,approved,rejected',
            'facilities' => 'array|exists:facilities,id'
        ]);

        $booking->update($request->only('destination_id', 'booking_date', 'start_time', 'end_time', 'total_price', 'status'));

        $facilities = $request->input('facilities', []);
        $booking->facilities()->sync($facilities);

        return redirect()->route('bookings.index');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index');
    }
}
