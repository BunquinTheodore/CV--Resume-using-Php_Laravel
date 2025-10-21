<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $username = trim($request->input('username'));
        $password = trim($request->input('password'));

        // Validate inputs
        if (empty($username) || empty($password)) {
            return back()->with([
                'message' => 'All fields are required!',
                'type' => 'error'
            ]);
        }

        // Basic login check
        if ($username === 'admin' && $password === '1234') {

            // ✅ Store login info in session
            $request->session()->put('logged_in', true);
            $request->session()->put('username', $username);

            // ✅ Redirect to resume edit page
            return redirect('/resume/edit')->with([
                'message' => 'Login Successful',
                'type' => 'success'
            ]);
        }

        // Invalid credentials
        return back()->with([
            'message' => 'Invalid Username or Password',
            'type' => 'error'
        ]);
    }

    // ✅ Optional: logout function
    public function destroy(Request $request)
    {
        $request->session()->flush(); // clear all session data
        return redirect('/')->with([
            'message' => 'You have been logged out successfully.',
            'type' => 'success'
        ]);
    }
}
