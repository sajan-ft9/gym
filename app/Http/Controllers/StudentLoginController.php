<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentLoginController extends Controller
{

    public function registerForm(){
        return view('website.register');
    }

    public function registerStudent(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'district' => 'required|integer',
            'address' => 'required|string',
            'age' => 'required|integer',
            'gender' => 'required|integer',
            'education' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'district' => $validatedData['district'],
            'address' => $validatedData['address'],
            'age' => $validatedData['age'],
            'gender' => $validatedData['gender'],
            'education' => $validatedData['education'],
            'image_path' => $imagePath,
            'role' => 'Student'
        ]);

        return redirect()->route('website.login.form')->with('success', 'Registration successful. Please login.');
    }

    public function loginForm(){
        return view('website.login');
    }

    public function loginStudent(Request $request)
    {
        // Validate the login form data
        $validatedData = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']], $request->filled('remember'))) {
            return redirect()->route('website.home')->with('success', 'You are logged in.');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

}
