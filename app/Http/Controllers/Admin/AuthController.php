<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Show admin login form.
     */
    public function showLoginForm()
    {
        if (Session::has('admin_id')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * Handle admin login.
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::where('email', $validated['email'])->first();

        if (!$admin || !Hash::check($validated['password'], $admin->password)) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ])->onlyInput('email');
        }

        // Create session for admin
        Session::put('admin_id', $admin->id);
        Session::put('admin_name', $admin->name);
        Session::put('admin_email', $admin->email);

        return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
    }

    /**
     * Handle admin logout.
     */
    public function logout()
    {
        Session::forget(['admin_id', 'admin_name', 'admin_email']);
        Session::flush();

        return redirect('/')->with('success', 'Logged out successfully!');
    }
}
