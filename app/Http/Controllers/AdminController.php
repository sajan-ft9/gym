<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.home');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function update(Request $request, User $admin)
    {
        $formFields = $request->validate([
            'email'  => ["required", "email", 'unique:users,email,' . $admin->id],
            'name'  => "required|string|max:50",
            'image_path' => ['image', 'mimes:png,jpg,jpeg', 'max:4096'],
        ]);
        if ($request->image_path) {

            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->storeAs('admin', $imageName, 'public');
            $formFields['image_path'] = '/storage/admin/' . $imageName;

            $trimmedPath = trim(str_replace("/storage/", "", $admin->image_path));

            if (Storage::disk('public')->exists($trimmedPath)) {

                Storage::disk('public')->delete($trimmedPath);
            }
        }

        $admin->update($formFields);

        return redirect(route('admin.profile'))->with('success', "Profile updated successfully");
    }

    public function updatePassword(Request $request, User $admin)
    {
        $validator = Validator::make($request->all(),[
            'old_password' => ["required"],
            'password' => ['required','string','min:8', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return redirect(url()->previous() .'#password')
                    ->withErrors($validator);
        }
        $oldPassword = $request->old_password;

        if (Hash::check($oldPassword, $admin->password)) {

            $admin->update(['password' => Hash::make($request->password)]);
            return redirect()->back()->with("success", "Password updated successfully");
        } else {
            return redirect((url()->previous() .'#password'))->with('danger', "Old password is incorrect");
        }
    }
}
