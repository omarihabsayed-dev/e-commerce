<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function edit()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,'.$admin->id,
        ]);

        $admin->update($validated);

        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function editPassword()
    {
        return view('admin.profile.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (! \Hash::check($validated['current_password'], $admin->password)) {
            return back()->withErrors(['current_password' => 'Does not match current password.'])
                ->with('error', 'Does not match current password.');
        }

        $admin->update([
            'password' => \Hash::make($validated['new_password']),
        ]);

        return redirect()->route('admin.password.edit')->with('success', 'Password updated successfully.');
    }
}
