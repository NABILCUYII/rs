<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // Display a listing of users
    public function index()
    {
        return Inertia::render('users/index', [
            'users' => User::all()
        ]);
    }

    // Show a single user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Show the form for creating a new user
    public function create()
    {
        return Inertia::render('users/create');
    }

    // Store a new user
    // Store a new user
public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    // Simpan user baru
    User::create([
        'name'     => $validated['name'],
        'email'    => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    // Redirect kembali ke halaman users dengan flash message
    return redirect()->route('user.index')->with('success', 'User created successfully!');
}



    // Update an existing user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
        ]);

        if (isset($validated['name'])) {
            $user->name = $validated['name'];
        }
        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }
        if (isset($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return response()->json($user);
    }

    // Delete a user
 public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('user.index')->with('success', 'User deleted successfully!');
}

}