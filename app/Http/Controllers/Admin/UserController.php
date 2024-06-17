<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Destinations;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.backend.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.backend.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'required|string|max:15|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:user,employee,admin',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('admin.backend.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        if ($user->role == 'employee') {
            $destinations = Destinations::all();
            return view('admin.backend.users.edit_employee', compact('user', 'destinations'));
        }

        return view('admin.backend.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $rules = [
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $id,
        'password' => 'nullable|string|min:8|confirmed',
        'phone_number' => 'required|string|max:15|unique:users,phone_number,' . $id,
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'role' => 'required|in:user,employee,admin',
    ];

    if ($request->role == 'employee') {
        $rules['destination_id'] = 'nullable|exists:destinations,id';
    }

    $request->validate($rules);

    $user->name = $request->name;
    $user->username = $request->username;
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }
    $user->phone_number = $request->phone_number;
    $user->email = $request->email;
    $user->role = $request->role;

     // Update or create entry in employees table if user role is employee
     if ($user->role === 'employee') {
        $employee = Employee::where('user_id', $user->id)->firstOrNew();
        $employee->user_id = $user->id;
        $employee->destination_id = $request->destination_id;
        $employee->save();
    } else {
        // Remove employee entry if user role changes from employee to other roles
        Employee::where('user_id', $user->id)->delete();
    }

    $user->save();

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}



    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
