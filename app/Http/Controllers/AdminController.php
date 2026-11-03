<?php

namespace App\Http\Controllers;

use App\AdminStatus;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            if (Auth::guard('admin')->user()->status !== AdminStatus::ACTIVE) {
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors(['email' => 'Your account is not active.']);
            }
            $request->session()->regenerate();

            return redirect()->route('admin.index')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function showRegister()
    {
        return view('admin.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'confirmed'],
        ]);

        Admin::create($validated);

        return redirect()->route('admin.login.form')->with('success', 'Admin account created successfully. Please log in.');
    }

    public function dashboard()
    {
        return view('admin.index');
    }

    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login.form')->with('success', 'Logged out successfully.');
    }
}
