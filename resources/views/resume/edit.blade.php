<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Resume - {{ $resume->name ?? '' }}</title>
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
            padding: 40px 60px;
            box-shadow: 0 0 15px rgba(0,0,0,0.15);
            border-radius: 6px;
        }
        input, textarea {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background: #1a237e;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }
        h2 { margin-top: 25px; }
    </style>
</head>
<body>

<div class="resume-container">
    <h1>Edit Resume</h1>
    <form method="POST" action="{{ route('resume.update', $resume->id ?? 1) }}">
        @csrf
        @method('PUT')

        <label>Full Name</label>
        <input type="text" name="name" value="{{ old('name', $resume->name ?? 'THEODORE VON JOSHUA M. BUNQUIN') }}">

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $resume->email ?? 'bunquintheodore@gmail.com') }}">

        <label>Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $resume->phone ?? '(+63) 966 02 5692') }}">

        <label>Headline</label>
        <input type="text" name="headline" value="{{ old('headline', $resume->headline ?? 'Creative AI Developer & Digital Content Specialist') }}">

        <label>Summary</label>
        <textarea name="summary" rows="4">{{ old('summary', $resume->summary ?? 'Passionate about delivering innovative, tech-driven solutions...') }}</textarea>

        <label>Professional Experience</label>
        <textarea name="experience" rows="8">{{ old('experience', $resume->experience ?? '') }}</textarea>

        <label>Education</label>
        <textarea name="education" rows="4">{{ old('education', $resume->education ?? '') }}</textarea>

        <label>Additional Information</label>
        <textarea name="additional" rows="6">{{ old('additional', $resume->additional ?? '') }}</textarea>

        <button type="submit">Save Changes</button>
    </form>

    <br>
    <a href="{{ route('resume.view') }}">← Back to View</a>
</div>
</body>
</html>
