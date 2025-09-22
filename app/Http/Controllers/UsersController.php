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


public function edit($id)
    {
        $user = User::findOrFail($id);
        return Inertia::render('users/edit', [
            'user' => $user
        ]);
    }
    // Update an existing user
    public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        'password' => ['nullable', 'string', 'min:8', 'confirmed'],

    ]);

    if (!empty($validated['password'])) {
        $validated['password'] = Hash::make($validated['password']);
    } else {
        unset($validated['password']); // ✅ jangan update password kalau kosong
    }

    $user->update($validated);

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}


    // Delete a user
 public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully!');
}

}