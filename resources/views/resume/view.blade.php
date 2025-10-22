<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $resume->name ?? 'Resume' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .wrapper {
            width: 100%;
            max-width: 900px;
        }
        
        /* Success Message */
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            animation: slideDown 0.5s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Resume Container */
        .resume-container {
            background: #fff;
            min-height: 1100px;
            padding: 50px 70px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            border-radius: 8px;
            position: relative;
        }
        
        /* Login Button */
        .login-btn {
            position: fixed;
            top: 30px;
            right: 30px;
            background: white;
            color: #667eea;
            padding: 12px 28px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            z-index: 100;
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            background: #667eea;
            color: white;
        }
        
        /* Header */
        h1 {
            font-size: 32px;
            color: #1a237e;
            margin-bottom: 8px;
            font-weight: 700;
        }
        
        .contact {
            margin-bottom: 10px;
            font-size: 14px;
            color: #555;
            line-height: 1.6;
        }
        
        .contact a {
            color: #667eea;
            text-decoration: none;
        }
        
        .contact a:hover {
            text-decoration: underline;
        }
        
        h3 {
            font-size: 18px;
            color: #764ba2;
            margin-bottom: 12px;
            font-weight: 600;
        }
        
        .summary {
            color: #444;
            line-height: 1.7;
            margin-bottom: 30px;
            font-size: 15px;
        }
        
        /* Sections */
        .section {
            margin-bottom: 28px;
        }
        
        h2 {
            font-size: 22px;
            color: #1a237e;
            border-bottom: 3px solid #667eea;
            padding-bottom: 6px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        ul {
            margin: 0;
            padding-left: 22px;
            line-height: 1.8;
        }
        
        ul li {
            margin-bottom: 8px;
            color: #444;
        }
        
        .job-title {
            font-weight: 600;
            color: #0d47a1;
            margin-bottom: 8px;
            font-size: 15px;
        }
        
        /* Expertise Tags */
        .expertise-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        
        .expertise-tag {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }
        
        /* Achievements */
        .achievement-item {
            margin-bottom: 15px;
            padding-left: 15px;
            border-left: 3px solid #764ba2;
        }
        
        .achievement-item strong {
            color: #1a237e;
        }
        
        /* Text Formatting */
        .formatted-text {
            white-space: pre-line;
            line-height: 1.8;
            color: #444;
        }
        
        /* Print Styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .resume-container {
                box-shadow: none;
                padding: 40px;
            }
            
            .login-btn {
                display: none;
            }
            
            .success-message {
                display: none;
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }
            
            .resume-container {
                padding: 30px 25px;
            }
            
            h1 {
                font-size: 26px;
            }
            
            .login-btn {
                top: 15px;
                right: 15px;
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<a href="{{ route('login.form') }}" class="login-btn">🔐 Login to Edit</a>

<div class="wrapper">
    @if(session('success'))
        <div class="success-message">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="resume-container">
        <!-- Header -->
        <h1>{{ $resume->name ?? 'THEODORE VON JOSHUA M. BUNQUIN' }}</h1>
        <p class="contact">
            {{ $resume->address ?? 'Alangilan, Batangas' }} | 
            <a href="mailto:{{ $resume->email ?? 'bunquintheodore@gmail.com' }}">{{ $resume->email ?? 'bunquintheodore@gmail.com' }}</a> | 
            {{ $resume->phone ?? '(+63) 966 02 5692' }}
        </p>
        <h3>{{ $resume->headline ?? 'Creative AI Developer & Digital Content Specialist' }}</h3>
        <p class="summary">{{ $resume->summary ?? 'Passionate about delivering innovative, tech-driven solutions that captivate and engage.' }}</p>

        <!-- Area of Expertise -->
        @if(!empty($resume->expertise))
        <div class="section">
            <h2>Area of Expertise</h2>
            <div class="expertise-list">
                @foreach($resume->expertise as $skill)
                    <span class="expertise-tag">{{ $skill }}</span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Key Achievements -->
        @if(!empty($resume->achievements))
        <div class="section">
            <h2>Key Achievements</h2>
            @foreach($resume->achievements as $achievement)
                <div class="achievement-item">
                    <strong>{{ $achievement['title'] ?? 'Achievement' }}:</strong> 
                    {{ $achievement['description'] ?? '' }}
                </div>
            @endforeach
        </div>
        @endif

        <!-- Professional Experience -->
        @if(!empty($resume->experience))
        <div class="section">
            <h2>Professional Experience</h2>
            <div class="formatted-text">{{ $resume->experience }}</div>
        </div>
        @endif

        <!-- Education -->
        @if(!empty($resume->education))
        <div class="section">
            <h2>Education</h2>
            <div class="formatted-text">{{ $resume->education }}</div>
        </div>
        @endif

        <!-- Additional Information -->
        @if(!empty($resume->additional))
        <div class="section">
            <h2>Additional Information</h2>
            <div class="formatted-text">{{ $resume->additional }}</div>
        </div>
        @endif
        
        @if($resume->updated_at)
<p style="text-align: center; color: #999; font-size: 12px; margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee;">
    Last Updated: {{ $resume->updated_at->format('F d, Y - g:i A') }}
</p>
@endif
    </div>
</div>

</body>
</html>