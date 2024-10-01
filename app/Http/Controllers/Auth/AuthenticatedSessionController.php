<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle manual login.
     */
    public function login(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed, redirect to the intended route
            $request->session()->regenerate();
            return redirect()->intended('/companies');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user via the LoginRequest validation
        $request->authenticate();

        // Regenerate the session after successful login
        $request->session()->regenerate();

        // Redirect to /companies after successful login
        return redirect()->intended('/companies');
    }

    /**
     * Destroy an authenticated session (logout).
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log out the authenticated user
        Auth::guard('web')->logout();

        // Invalidate the session and regenerate the session token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to home page after logout
        return redirect('/');
    }
}
