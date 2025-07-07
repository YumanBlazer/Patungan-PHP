<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Show the registration form
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle login attempt (database authentication)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Try database authentication first
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('dashboard'))->with('success', 
                'Welcome back, ' . Auth::user()->name . '!');
        }

        // Fallback to demo authentication for backward compatibility
        $email = $request->input('email');
        $password = $request->input('password');
        
        $demoPasswords = ['password123', 'admin123', 'test123', 'patungann123'];
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && in_array($password, $demoPasswords)) {
            // Store demo user in session
            session([
                'user' => [
                    'id' => 'demo-' . uniqid(),
                    'name' => 'Demo User',
                    'email' => $email,
                    'is_demo' => true
                ],
                'authenticated' => true
            ]);
            
            return redirect()->route('dashboard')->with('success', 'Welcome to Patungann! You are logged in as a demo user.');
        }
        
        return back()->withErrors([
            'email' => 'Invalid credentials. Try test@patungann.com with password123, or use demo mode.'
        ])->withInput();
    }

    /**
     * Handle registration (demo mode)
     */
    public function register(Request $request)
    {
        // Demo registration - just create a session without database
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'terms' => 'required|accepted'
        ]);

        // Store demo user in session
        session([
            'user' => [
                'id' => rand(1000, 9999),
                'name' => $request->full_name,
                'email' => $request->email,
                'username' => $request->username ?? explode('@', $request->email)[0],
                'phone' => $request->phone,
                'is_demo' => true
            ],
            'authenticated' => true
        ]);

        return redirect()->route('dashboard')->with('success', 'Welcome to Patungann! Your demo account has been created successfully.');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        session()->forget(['user', 'authenticated']);
        session()->flush();
        
        return redirect()->route('welcome')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Update user profile (demo mode)
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Update session data
        $user = session('user', []);
        $user['name'] = $request->name;
        $user['email'] = $request->email;
        session(['user' => $user]);

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Check authentication status (API endpoint)
     */
    public function checkAuth(Request $request)
    {
        $authenticated = session('authenticated', false);
        $user = session('user', null);

        return response()->json([
            'authenticated' => $authenticated,
            'user' => $user
        ]);
    }
}
