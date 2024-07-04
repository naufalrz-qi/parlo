<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinations;
use App\Models\Facility;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        $destinationName = $role == 'employee' && $user->employee ? $user->employee->destination->name : '';
        if (Auth::user()->role == 'admin') {
            $bookings = Booking::with('destination', 'facilities', 'user')->get();
        } else if (Auth::user()->role == 'employee') {
            $employee = Auth::user()->employee;

            if (!$employee || !$employee->destination_id) {
                // Handle case where employee does not have an associated destination
                $bookings = collect(); // Return an empty collection
            } else {
                $bookings = Booking::with('destination', 'facilities', 'user')
                                    ->where('destination_id', $employee->destination_id)
                                    ->get();
            }
        }

        return view('admin.backend.bookings.index', compact('bookings','destinationName', 'role'));
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
            $facilitiesStringArray = $request->input('facilities');
            $facilitiesString = implode(',', $facilitiesStringArray);
            $facilityIds = explode(',', $facilitiesString);
            $facilityIds = array_map('intval', $facilityIds);
            $totalPrice = Facility::whereIn('id', $facilityIds)->sum('price');
            $booking->total_price = $totalPrice;
            $booking->status = 'pending';
            $booking->save();
            foreach ($facilityIds as $facilityId) {
                DB::table('booking_facility')->insert([
                    'booking_id' => $booking->id,
                    'facility_id' => $facilityId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        if (Auth::user()->role == 'user') {
            return redirect()->route('payment.show', $booking->id);
        }

        return redirect()->route('bookings.index');
    }

    public function history() {
        $userId = auth()->user()->id;
        $bookings = Booking::where('user_id', $userId)->with('destination', 'facilities')->get();

        return view('user.payment.history', compact('bookings'));
    }
}
