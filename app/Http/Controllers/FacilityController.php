<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::all();
        return view('admin.backend.facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('admin.backend.facilities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'opening_hours' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);

        Facility::create($request->all());

        return redirect()->route('facilities.index')
                         ->with('success', 'Facility created successfully.');
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
