<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// ----- Routes with 'web' middleware automatically applied -----
Route::middleware(['web'])->group(function () {

    // ✅ Public resume view (anyone can see)
    Route::get('/resume/view', [ResumeController::class, 'view'])->name('resume.view');

    // ✅ Authenticated resume edit (manual session-based)
    Route::get('/resume/edit', [ResumeController::class, 'edit'])->name('resume.edit');

    // ✅ Resume by ID (for dynamic viewing)
    Route::get('/resume/{id}', [ResumeController::class, 'show'])->name('resume.show');

    // ✅ Resume update route
    Route::post('/resume/update', [ResumeController::class, 'update'])->name('resume.update');

    // ----- Custom Login -----
    Route::get('/login', function () {
        return view('login');
    })->name('login.form');

    Route::post('/login', function (Request $request) {
        $username = trim($request->input('username'));
        $password = trim($request->input('password'));

        if (empty($username) || empty($password)) {
            return back()->with('error', 'All fields are required!');
        }

        // ✅ Temporary login simulation
        if ($username === 'admin' && $password === '1234') {
            $request->session()->put('logged_in', true);
            $request->session()->put('username', $username);
            return redirect()->route('resume.edit')->with('success', 'Login Successful');
        }

        return back()->with('error', 'Invalid Username or Password');
    })->name('login.custom');

    // ✅ Logout route
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

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

        // ✅ Also mark session as logged in (for consistency)
        session(['logged_in' => true, 'username' => $googleUser->getName()]);

        return redirect()->route('resume.edit');
    });
});
