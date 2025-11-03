<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['web'])->group(function () {

    // ====================================
    // 🏠 PUBLIC ROUTES (No Authentication)
    // ====================================
    
    // ✅ Home page - Dashboard showing all resumes
    Route::get('/', [ResumeController::class, 'dashboard'])->name('dashboard');


    // ====================================
    // 🔐 AUTHENTICATION ROUTES
    // ====================================
    
    // ✅ Show login form
    Route::get('/login', function () {
        return view('login');
    })->name('login.form');

    // ✅ Custom login (username/password)
    Route::post('/login', function (Request $request) {
        $username = trim($request->input('username'));
        $password = trim($request->input('password'));

        if (empty($username) || empty($password)) {
            return back()->with('error', 'All fields are required!');
        }

        // ✅ Simple credential check (you can expand this to check database)
        if ($username === 'admin' && $password === '1234') {
            $request->session()->put('logged_in', true);
            $request->session()->put('user_logged_in', true);
            $request->session()->put('username', $username);
            return redirect()->route('resume.edit')->with('success', 'Login Successful');
        }

        return back()->with('error', 'Invalid Username or Password');
    })->name('login.custom');

    // ✅ Google OAuth login redirect
    Route::get('auth/google', function () {
        return Socialite::driver('google')->redirect();
    })->name('google.login');

    // ✅ Google OAuth callback
    Route::get('auth/google/callback', function () {
        try {
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

            // ✅ Mark session as logged in (for middleware compatibility)
            session([
                'logged_in' => true, 
                'user_logged_in' => true,
                'username' => $googleUser->getName()
            ]);

            return redirect()->route('resume.edit')->with('success', 'Logged in with Google successfully!');
        } catch (\Exception $e) {
            return redirect()->route('login.form')->with('error', 'Google login failed. Please try again.');
        }
    });

    // ✅ Registration route
    Route::post('/register', function (Request $request) {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // Create new user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            // Log the user in
            Auth::login($user);

            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            // Mark session as logged in
            $request->session()->put('logged_in', true);
            $request->session()->put('user_logged_in', true);
            $request->session()->put('username', $user->name);

            return redirect()->route('resume.edit')->with('success', 'Account created successfully! Start building your resume.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Registration failed: ' . $e->getMessage())->withInput();
        }
    })->name('register');

    // ✅ Logout route
    Route::post('/logout', function (Request $request) {
        // Logout from Laravel Auth if using Google login
        if (Auth::check()) {
            Auth::logout();
        }
        
        // Clear all session data
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('dashboard')->with('success', 'Logged out successfully!');
    })->name('logout');


    // ====================================
    // 🔒 PROTECTED ROUTES (Authentication Required)
    // ====================================
    
    Route::middleware([\App\Http\Middleware\EnsureUserIsLoggedIn::class])->group(function () {
        
        // ✅ Edit resume page
        Route::get('/resume/edit', [ResumeController::class, 'edit'])->name('resume.edit');
        
        // ✅ Update resume and publish (supports both POST and PUT)
        Route::match(['post', 'put'], '/resume/update/{id?}', [ResumeController::class, 'update'])->name('resume.update');
    });


    // ====================================
    // 📄 DYNAMIC RESUME ROUTES (Must be LAST)
    // ====================================
    
    // ✅ View specific resume by ID
    Route::get('/resume/{id}', [ResumeController::class, 'show'])->name('resume.show')->where('id', '[0-9]+');
    
    // ✅ Print specific resume by ID
    Route::get('/resume/{id}/print', [ResumeController::class, 'print'])->name('resume.print')->where('id', '[0-9]+');

});