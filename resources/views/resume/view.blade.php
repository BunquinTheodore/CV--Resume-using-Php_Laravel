<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $resume->name ?? 'Resume' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f9;
            margin: 0;
            padding: 30px;
            display: flex;
            justify-content: center;
        }
        .resume-container {
            background: #fff;
            width: 800px;
            min-height: 1100px;
            padding: 40px 60px;
            box-shadow: 0 0 15px rgba(0,0,0,0.15);
            border-radius: 6px;
        }
        h1, h2, h3 {
            margin-bottom: 5px;
        }
        h1 {
            font-size: 28px;
            color: #1a237e;
        }
        h2 {
            font-size: 20px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 4px;
            margin-top: 30px;
        }
        .section {
            margin-bottom: 20px;
        }
        ul {
            margin: 0;
            padding-left: 20px;
        }
        .contact {
            margin-bottom: 20px;
            font-size: 14px;
        }
        .job-title {
            font-weight: bold;
            color: #0d47a1;
        }
    </style>
</head>
<body>

<div class="resume-container">
    <h1>{{ $resume->name ?? 'THEODORE VON JOSHUA M. BUNQUIN' }}</h1>
    <p class="contact">
        {{ $resume->address ?? 'Alangilan, Batangas' }} | 
        <a href="mailto:{{ $resume->email ?? 'bunquintheodore@gmail.com' }}">{{ $resume->email ?? 'bunquintheodore@gmail.com' }}</a> | 
        {{ $resume->phone ?? '(+63) 966 02 5692' }}
    </p>
    <h3>{{ $resume->headline ?? 'Creative AI Developer & Digital Content Specialist' }}</h3>
    <p>{{ $resume->summary ?? 'Passionate about delivering innovative, tech-driven solutions...' }}</p>

    <div class="section">
        <h2>Area of Expertise</h2>
        <ul>
            @foreach($resume->expertise ?? ['Prompt Engineering', 'Programming', 'AI-Powered Development', 'Web Development'] as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>

    <div class="section">
        <h2>Key Achievements</h2>
        <ul>
            <li><b>System Development:</b> {{ $resume->achievement1 ?? 'Designed and launched EduManageX...' }}</li>
            <li><b>Algorithm Engineering:</b> {{ $resume->achievement2 ?? 'Built a Maze Solver in C++...' }}</li>
        </ul>
    </div>

    <div class="section">
        <h2>Professional Experience</h2>
        {!! $resume->experience ?? '
        <p class="job-title">Freelance Developer & Content Specialist | Self-Employed | 2025 - Present</p>
        <ul>
            <li>Delivered websites, content, and social media visuals for diverse clients.</li>
            <li>Provided virtual assistance, graphic design, and creative support.</li>
        </ul>' !!}
    </div>

    <div class="section">
        <h2>Education</h2>
        <p><b>Bachelor of Science in Computer Science</b> | {{ $resume->school ?? 'National Engineering University, Philippines' }} | {{ $resume->year ?? 'Aug 2023 – 2027' }}</p>
    </div>

    <div class="section">
        <h2>Additional Information</h2>
        {!! $resume->additional ?? '
        <ul>
            <li><b>Languages:</b> English, Filipino</li>
            <li><b>Certifications:</b> Python Programming (CodeAlpha Internship)</li>
            <li><b>Awards/Activities:</b> AI Vibe Coding Competition Participant (2025)</li>
        </ul>' !!}
    </div>

    <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>
</body>
</html>
