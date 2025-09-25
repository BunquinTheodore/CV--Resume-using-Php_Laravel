<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// ----- Custom Login -----
Route::get('/login', function () {
    return view('login'); // resources/views/login.blade.php
})->name('login.form');

Route::post('/login', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    // Validation
    if (empty($username) || empty($password)) {
        return back()->with('error', 'All fields are required!');
    }

    // Check credentials
    if ($username === 'admin' && $password === '1234') {
        return redirect()->route('resume')->with('success', 'Login Successful');
    } else {
        return back()->with('error', 'Invalid Username or Password');
    }
})->name('login.custom');

// ----- Google Socialite Login -----
Route::get('auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => bcrypt(str()->random(16)),
        ]);
    }

    Auth::login($user);

    // ✅ Redirect to resume page
    return redirect()->route('resume');
});

// ----- Resume Page -----
Route::get('/resume', function () {
    return view('resume'); // resources/views/resume.blade.php
})->name('resume');
