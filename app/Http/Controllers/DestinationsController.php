<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinations;
use Illuminate\Support\Facades\Auth;


class DestinationsController extends Controller
{
    public function showDestinations()
    {
        $destinations = Destinations::with('reviews')->get();
        foreach ($destinations as $destination) {
            $destination['averageRating'] = $destination->reviews->avg('rating');
        }

        $layout = 'app.layouts.app'; // Default layout

        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                $layout = 'admin.layouts.app';
            } elseif (Auth::user()->role === 'user') {
                $layout = 'user.layouts.app';
            }
        }
        return view('universal.destinations.index', compact('destinations', 'layout'));
    }
    public function index()
    {
        $destinations = Destinations::all();
        return view('welcome', compact('destinations'));
    }

    public function view()
    {
        $datas = Destinations::get();
        return view('admin.backend.destinations.view', compact('datas'));
    }


    public function add()
    {
        return view('admin.backend.destinations.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'price' => 'required',
        ]);

        $image = '';

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('assets/img/destinations/' . $request->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('assets/img/destinations/'),$filename);
            $image=$filename;
         }else {
            $image='default.jpg';
         }

        $data = Destinations::create([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'iframe' => $request->iframe,
            'image' => $image,
            'price' => $request->price,
        ]);

        $notification = array(
            'message' => 'Post Create Successfully!',
            'alert-type' => 'success'
        );

        if (Auth::user()->role === 'admin' || Auth::user()->role === 'employee') {
            return redirect()->route('view.destinations')->with($notification);
        }else{
            return redirect()->route('dashboard')->with($notification);
        }
    }

    public function edit($id)
{
    $destination = Destinations::find($id);
    return view('admin.backend.destinations.edit', compact('destination'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string',
        'description' => 'nullable|string',
        'location' => 'required|string',
        'iframe' => 'nullable|string',
        'image' => 'nullable|image',
        'price' => 'required|numeric',
    ]);

    $destination = Destinations::find($id);

    $destination->name = $request->name;
    $destination->description = $request->description;
    $destination->location = $request->location;
    $destination->iframe = $request->iframe;
    $destination->price = $request->price;

    // Handle image upload
    if ($request->hasFile('image')) {
        $oldImagePath = public_path('assets/img/destinations/' . $destination->image);

        // Delete old image if exists
        if ($destination->image && $destination->image !== 'default.jpg' && file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
        $image = $request->file('image');
        $imageName = date('YmdHi').$image->getClientOriginalExtension();
        $image->move(public_path('assets/img/destinations/'), $imageName);
        $destination->image = $imageName;
    }


    $destination->save();

    return redirect()->route('view.destinations')->with('success', 'Destination updated successfully');
}

public function destroy($id)
{
    $destination = Destinations::find($id);
    if ($destination) {
        // Delete image file if exists
        if ($destination->image) {
            $imagePath = public_path('assets/img/destinations/') . $destination->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $destination->delete();

        return redirect()->route('view.destinations')->with('success', 'Destination deleted successfully');
    } else {
        return redirect()->route('view.destinations')->with('error', 'Destination not found');
    }
}

public function show($id)
{
    $destination = Destinations::with(['facilities', 'reviews'])->findOrFail($id);

    $destination['averageRating'] = $destination->reviews->avg('rating');

    $facilities = $destination->facilities;
    $reviews = $destination->reviews;

    return view('admin.backend.destinations.show', compact('destination', 'facilities', 'reviews')); // Menampilkan view show dengan data destinasi
}

public function reviews()
    {
        $employee = Auth::user()->employee; // Ambil karyawan yang sedang login
        $destinations = Destinations::where('id', $employee->destination_id)
            ->with('reviews.booking.user') // Ambil relasi user melalui booking
            ->get();

        foreach ($destinations as $destination) {
            $destination->averageRating = $destination->reviews->avg('rating');
        }

        return view('employee.destinations.reviews', compact('destinations'));
    }


}
