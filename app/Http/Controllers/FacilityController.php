<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Destinations;

use Illuminate\Support\Facades\Auth;


class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::all();
        return view('admin.backend.facilities.index', compact('facilities'));
    }

    public function create()
    {
               // Assume the logged-in employee is managing a single destination
               $user = Auth::user();



               $destinations = Destinations::all();


               return view('admin.backend.facilities.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'opening_hour_start' => 'required|string|max:5',
            'opening_hour_end' => 'required|string|max:5',
            'contact_info' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'destination_id' => 'required|exists:destinations,id',
        ]);

        $opening_hours = $request->input('opening_hour_start') . ' - ' . $request->input('opening_hour_end');

        $imagePath = $request->file('image') ? $request->file('image')->store('facilities', 'public') : 'default.jpg';

        Facility::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'location' => $validatedData['location'],
            'opening_hours' => $opening_hours,
            'contact_info' => $validatedData['contact_info'],
            'type' => $validatedData['type'],
            'price' => $validatedData['price'],
            'image' => $imagePath,
            'destination_id' => $validatedData['destination_id'],
        ]);

        return redirect()->route('facilities.index')->with('success', 'Facility created successfully.');
    }


    public function show(Facility $facility)
    {
        return view('admin.backend.facilities.show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        return view('admin.backend.facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'opening_hours' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);

        $facility->update($request->all());

        return redirect()->route('facilities.index')
                         ->with('success', 'Facility updated successfully.');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('facilities.index')
                         ->with('success', 'Facility deleted successfully.');
    }

}
