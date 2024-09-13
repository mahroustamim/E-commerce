<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id) {

        $locale = app()->getLocale();
        $user = User::find($id);
        $governorates = Governorate::select('id', "governorate_{$locale} as name")->get();

        return view('website.profile', compact('user', 'governorates'));
    }

    public function update(Request $request, $id) {

        // Validation
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => ['required', 'regex:/^(010|011|012|015)\d{8}$/'],
            'governorate' => 'required|exists:governorates,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Find the user
        $user = User::findOrFail($id);
    
        // Update user details
        $user->name = $request->name;
    
        // If email has changed, reset email_verified_at
        if ($user->email !== $request->email) {
            $user->email = $request->email;
            $user->email_verified_at = null; // Reset email verification date
        } {
            $user->email = $request->email;
        }
    
        $user->phone = $request->phone;
        $user->governorate_id = $request->governorate;
    
        // Update password only if a new one is provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
    
        // Save the user
        $user->save();
    
        return redirect()->back()->with('success', __('words.saveSucc'));

    }
    
}
