<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resume;

class ResumeController extends Controller
{
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

        // Get the resume from database
        $resume = Resume::firstOrFail();
        
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

        // Get the resume (first record)
        $resume = Resume::firstOrFail();

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

        // Redirect to public view with success message
        return redirect()->route('resume.view')->with('success', 'Resume published successfully! You have been logged out.');
    }

    /**
     * ✅ Optional: specific resume view (for future expansion)
     */
    public function show($id = null)
    {
        return $this->view();
    }
}