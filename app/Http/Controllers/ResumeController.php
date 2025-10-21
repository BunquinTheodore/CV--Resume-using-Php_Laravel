<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    // ✅ Path to store JSON data
    private $filePath = 'data/resume.json';

    // ✅ Load resume data from file
    private function loadResumeData()
    {
        if (Storage::exists($this->filePath)) {
            return json_decode(Storage::get($this->filePath), true);
        }

        // Default data if JSON file not found
        return [
            'name' => 'THEODORE VON JOSHUA M. BUNQUIN',
            'address' => 'Alangilan, Batangas',
            'email' => 'bunquintheodore@gmail.com',
            'phone' => '(+63) 966 02 5692',
            'headline' => 'Creative AI Developer & Digital Content Specialist',
            'summary' => 'Passionate about delivering innovative, tech-driven solutions that captivate and engage.',
            'expertise' => ['Prompt Engineering', 'Programming', 'AI-Powered Development', 'Web Development'],
            'achievement1' => 'Designed and launched EduManageX, a Java-based School Management System with SQL integration.',
            'achievement2' => 'Built a Maze Solver in C++ using data structures and algorithmic logic.',
            'experience' => '<p class="job-title">Freelance Developer & Content Specialist | Self-Employed | 2025 - Present</p>
                             <ul>
                                 <li>Delivered websites, content, and social media visuals for diverse clients.</li>
                                 <li>Provided virtual assistance, graphic design, and creative support.</li>
                             </ul>',
            'education' => '<p><b>Bachelor of Science in Computer Science</b> | National Engineering University, Philippines | Aug 2023 – 2027</p>',
            'additional' => '<ul>
                                <li><b>Languages:</b> English, Filipino</li>
                                <li><b>Certifications:</b> Python Programming (CodeAlpha Internship)</li>
                                <li><b>Awards/Activities:</b> AI Vibe Coding Competition Participant (2025)</li>
                             </ul>',
        ];
    }

    // ✅ Save resume data to file
    private function saveResumeData($data)
    {
        Storage::put($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }

    // ✅ Anyone can view resume
    public function view()
    {
        $resume = (object) $this->loadResumeData();
        return view('resume.view', compact('resume'));
    }

    // ✅ Authenticated users can edit resume
    public function edit(Request $request)
    {
        if (!$request->session()->has('logged_in') && !$request->session()->has('user_logged_in')) {
            return redirect('/login')->with([
                'message' => 'Please log in first.',
                'type' => 'error'
            ]);
        }

        $resume = (object) $this->loadResumeData();
        return view('resume.edit', compact('resume'));
    }

    // ✅ Update resume data and save
    public function update(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'headline' => $request->input('headline'),
            'summary' => $request->input('summary'),
            'experience' => $request->input('experience'),
            'education' => $request->input('education'),
            'additional' => $request->input('additional'),
        ];

        $this->saveResumeData($data);

        return redirect()->route('resume.view')->with('success', 'Resume updated successfully!');
    }

    // ✅ Optional: show specific resume by ID (for future use)
    public function show($id)
    {
        $resume = (object) $this->loadResumeData();
        return view('resume.view', compact('resume'));
    }
}
