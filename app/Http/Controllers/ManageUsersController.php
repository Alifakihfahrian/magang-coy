<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ManageUsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('layouts.ManageUsers', compact('users'));
    }

    public function create()
    {
        return view('layouts.AddNew');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('ManageUsers')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('layouts.EditData', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => $request->filled('password') ? bcrypt($validatedData['password']) : $user->password,
        ]);

        return redirect()->route('ManageUsers')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('ManageUsers')->with('success', 'User deleted successfully.');
    }

    public function Navbar()
    {   
        $users = User::all(); 
        return view('layouts.ManageUsers', compact('users')); 
    }
}
