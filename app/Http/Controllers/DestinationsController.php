<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinations;
use Illuminate\Support\Facades\Auth;


class DestinationsController extends Controller
{
    public function index()
    {
        $datas = Destinations::get();
        return view('admin.backend.destinations.view', compact('datas'));
    }

    public function indexUniversal()
    {
        $datas = Destinations::get();
        return view('universal.destinations.destinations', compact('datas'));
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
}
