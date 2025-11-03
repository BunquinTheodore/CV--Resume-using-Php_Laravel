<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resume;

class ResumeController extends Controller
{
    /**
     * ✅ Dashboard - show all published resumes
     */
    public function dashboard()
    {
        $resumes = Resume::where('is_published', true)
            ->orderBy('updated_at', 'desc')
            ->get();
        
        return view('dashboard', compact('resumes'));
    }

    /**
     * ✅ Public view - anyone can see the resume
     */
    public function view()
    {
        // Get the first (and only) resume from database
        $resume = Resume::firstOrFail();
        
        return view('resume.view', compact('resume'));
    }

    /**
     * ✅ Edit page - requires authentication
     */
    public function edit(Request $request)
    {
        // Check if user is authenticated
        if (!session('user_logged_in') && !Auth::check()) {
            return redirect()->route('login.form')->with([
                'error' => 'Please log in to edit the resume.'
            ]);
        }

        // Get or create user's resume
        $user = Auth::user();
        
        // If admin (session-based), get the first resume
        if (session('user_logged_in') && session('username') === 'admin') {
            $resume = Resume::first();
            if (!$resume) {
                // Create default resume for admin
                $resume = Resume::create([
                    'user_id' => null,
                    'name' => 'Your Name',
                    'email' => 'your.email@example.com',
                    'is_published' => false,
                ]);
            }
        } else {
            // For authenticated users, get or create their resume
            $resume = Resume::where('user_id', $user->id)->first();
            
            if (!$resume) {
                // Create a new blank resume for the user
                $resume = Resume::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'is_published' => false,
                ]);
            }
        }
        
        return view('resume.edit', compact('resume'));
    }

    /**
     * ✅ Update and publish resume
     */
    public function update(Request $request, $id = null)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'headline' => 'nullable|string|max:255',
            'summary' => 'nullable|string',
            'expertise' => 'nullable|array',
            'expertise.*' => 'string|max:255',
            'achievements' => 'nullable|array',
            'achievements.*.title' => 'required|string|max:255',
            'achievements.*.description' => 'required|string',
            'experience' => 'nullable|string',
            'education' => 'nullable|string',
            'additional' => 'nullable|string',
        ]);

        // Get the user's resume
        $user = Auth::user();
        
        if (session('user_logged_in') && session('username') === 'admin') {
            // Admin updates the first resume
            $resume = Resume::first();
        } else {
            // Regular user updates their own resume
            $resume = Resume::where('user_id', $user->id)->firstOrFail();
        }

        // Prepare data for saving
        $data = [
            'name' => $validated['name'],
            'address' => $validated['address'] ?? '',
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? '',
            'headline' => $validated['headline'] ?? '',
            'summary' => $validated['summary'] ?? '',
            'expertise' => array_values(array_filter($validated['expertise'] ?? [])), // Remove empty values and reindex
            'achievements' => array_values(array_filter($validated['achievements'] ?? [], function($achievement) {
                return !empty($achievement['title']) && !empty($achievement['description']);
            })), // Remove empty achievements and reindex
            'experience' => $validated['experience'] ?? '',
            'education' => $validated['education'] ?? '',
            'additional' => $validated['additional'] ?? '',
            'is_published' => true,
        ];

        // Update the resume in database
        $resume->update($data);

        // Log out the user
        if (Auth::check()) {
            Auth::logout();
        }
        
        // Clear session
        $request->session()->forget('user_logged_in');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to dashboard with success message
        return redirect()->route('dashboard')->with('success', 'Resume published successfully! You have been logged out.');
    }

    /**
     * ✅ Show specific resume by ID
     */
    public function show($id)
    {
        $resume = Resume::where('id', $id)
            ->where('is_published', true)
            ->firstOrFail();
        
        return view('resume.view', compact('resume'));
    }

    /**
     * ✅ Print specific resume by ID
     */
    public function print($id)
    {
        $resume = Resume::where('id', $id)
            ->where('is_published', true)
            ->firstOrFail();
        
        return view('resume.view', compact('resume'));
    }
}